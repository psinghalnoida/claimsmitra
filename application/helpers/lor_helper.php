<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * LOR chase (R-33, W-06). Parser has no DB dependency.
 */

if (!function_exists('lor_ensure_schema')) {
    function lor_ensure_schema()
    {
        $CI =& get_instance();
        if (!$CI->db->table_exists('claims_sendlor')) {
            return;
        }

        $columns = array(
            'reminder_frequency_days' => 'INT NULL',
            'next_due_on' => 'DATE NULL',
            'appointment_subject' => 'TEXT NULL',
            'our_ref' => 'VARCHAR(100) NULL',
        );
        foreach ($columns as $name => $ddl) {
            if (!$CI->db->field_exists($name, 'claims_sendlor')) {
                $CI->db->query('ALTER TABLE `claims_sendlor` ADD `' . $name . '` ' . $ddl);
            }
        }

        if (!$CI->db->table_exists('claims_lor_party')) {
            $CI->db->query("CREATE TABLE `claims_lor_party` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `aid` VARCHAR(100) NOT NULL,
                `name` VARCHAR(255) DEFAULT NULL,
                `email` VARCHAR(255) NOT NULL,
                `header_kind` VARCHAR(16) DEFAULT NULL,
                `send_as` VARCHAR(8) NOT NULL DEFAULT 'cc',
                `source` VARCHAR(32) NOT NULL DEFAULT 'paste',
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `aid_email` (`aid`,`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        }
    }
}

if (!function_exists('lor_compose_subject')) {
    function lor_compose_subject($appointmentSubject, $ourRef)
    {
        $subject = trim((string) $appointmentSubject);
        $ref = trim((string) $ourRef);
        if ($subject === '' && $ref === '') {
            return 'Letter of Requirement';
        }
        if ($subject === '') {
            return 'LOR / Our Ref: ' . $ref;
        }
        if ($ref === '') {
            return $subject;
        }
        if (stripos($subject, $ref) !== false) {
            return $subject;
        }
        return $subject . ' / Our Ref: ' . $ref;
    }
}

if (!function_exists('lor_pending_descriptions')) {
    function lor_pending_descriptions($lorJson)
    {
        $items = is_array($lorJson) ? $lorJson : json_decode((string) $lorJson, true);
        if (!is_array($items)) {
            return array();
        }
        $out = array();
        foreach ($items as $item) {
            if (is_string($item)) {
                $out[] = $item;
                continue;
            }
            if (!is_array($item)) {
                continue;
            }
            $received = !empty($item['received']);
            $desc = isset($item['description']) ? trim((string) $item['description']) : '';
            if ($desc !== '' && !$received) {
                $out[] = $desc;
            }
        }
        return $out;
    }
}

if (!function_exists('lor_count_pending')) {
    function lor_count_pending($lorJson)
    {
        return count(lor_pending_descriptions($lorJson));
    }
}

if (!function_exists('lor_split_address_list')) {
    function lor_split_address_list($list)
    {
        $list = trim((string) $list);
        if ($list === '') {
            return array();
        }
        $parts = preg_split('/[;,]+/', $list);
        $out = array();
        foreach ($parts as $part) {
            $part = trim($part);
            if ($part === '') {
                continue;
            }
            $name = '';
            $email = '';
            if (preg_match('/^(.+?)\s*<([^>]+)>/', $part, $m)) {
                $name = trim($m[1], " \t\"'");
                $email = trim($m[2]);
            } elseif (preg_match('/([A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,})/i', $part, $m)) {
                $email = $m[1];
                $name = trim(str_replace($email, '', $part), " \t\"'<>");
            }
            if ($email !== '') {
                $out[] = array('name' => $name, 'email' => strtolower($email));
            }
        }
        return $out;
    }
}

if (!function_exists('lor_parse_appointment_mail')) {
    /**
     * Parse pasted appointment headers/body into subject + people.
     *
     * @return array{subject: string, parties: array<int, array{name:string,email:string,header_kind:string,send_as:string}>}
     */
    function lor_parse_appointment_mail($raw)
    {
        $raw = str_replace(array("\r\n", "\r"), "\n", (string) $raw);
        $subject = '';
        if (preg_match('/^\s*subject\s*:\s*(.+)$/im', $raw, $m)) {
            $subject = trim($m[1]);
        }

        $parties = array();
        $seen = array();
        $add = function ($email, $name, $kind) use (&$parties, &$seen) {
            $email = strtolower(trim((string) $email));
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return;
            }
            if (isset($seen[$email])) {
                return;
            }
            $seen[$email] = true;
            $kind = strtolower((string) $kind);
            if (!in_array($kind, array('to', 'cc', 'bcc'), true)) {
                $kind = 'unknown';
            }
            $sendAs = ($kind === 'unknown') ? 'cc' : $kind;
            $parties[] = array(
                'name' => trim((string) $name),
                'email' => $email,
                'header_kind' => $kind,
                'send_as' => $sendAs,
            );
        };

        foreach (array('to', 'cc', 'bcc') as $kind) {
            if (preg_match('/^\s*' . $kind . '\s*:\s*(.+)$/im', $raw, $m)) {
                foreach (lor_split_address_list($m[1]) as $p) {
                    $add($p['email'], $p['name'], $kind);
                }
            }
        }

        if (preg_match_all('/[A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,}/i', $raw, $mm)) {
            foreach ($mm[0] as $em) {
                $add($em, '', 'unknown');
            }
        }

        return array(
            'subject' => $subject,
            'parties' => $parties,
        );
    }
}

if (!function_exists('lor_next_due_date')) {
    function lor_next_due_date($frequencyDays, $from = null)
    {
        $days = (int) $frequencyDays;
        if ($days < 1) {
            $days = 7;
        }
        $from = $from ? strtotime($from) : time();
        return date('Y-m-d', strtotime('+' . $days . ' days', $from));
    }
}
