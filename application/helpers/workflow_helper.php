<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('workflow_status_search_map')) {
    function workflow_status_search_map()
    {
        $CI =& get_instance();
        $statuses = $CI->config->item('workflow_statuses');
        $map = array();
        if (!is_array($statuses)) {
            return $map;
        }
        foreach ($statuses as $id => $row) {
            $map[strtolower($row['label'])] = (int) $id;
            if (!empty($row['search_aliases']) && is_array($row['search_aliases'])) {
                foreach ($row['search_aliases'] as $alias) {
                    $map[strtolower($alias)] = (int) $id;
                }
            }
        }
        return $map;
    }
}

if (!function_exists('workflow_status_badge_html')) {
    function workflow_status_badge_html($status)
    {
        $CI =& get_instance();
        $statuses = $CI->config->item('workflow_statuses');
        $status = (int) $status;
        if (!isset($statuses[$status])) {
            return '<span class="label label-default">Unknown</span>';
        }
        $row = $statuses[$status];
        $class = htmlspecialchars($row['bootstrap'], ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($row['label'], ENT_QUOTES, 'UTF-8');
        return '<span class="label label-' . $class . '">' . $label . '</span>';
    }
}

/**
 * Restrict a job list to the current seat (docs/WORKFLOW.md, R-17).
 *
 * @param string $assignAlias alias of claims_livelocationjob_assign (e.g. CJA, clja)
 * @param string $jobAlias    alias of claims_livelocationjob (e.g. CJ, clj); used for accounts
 * @param mixed  $userRole    connect usertype 1–4
 * @param int    $userId      session user id
 */
if (!function_exists('workflow_apply_assignee_visibility')) {
    function workflow_apply_assignee_visibility($assignAlias, $jobAlias, $userRole, $userId)
    {
        $CI =& get_instance();
        $role = (string) $userRole;
        $uid = (int) $userId;

        if ($role === '3' || $role === '1') {
            $CI->db->where($assignAlias . '.uid_to', $uid);
            return;
        }

        if ($role === '4') {
            $accountsStatuses = $CI->config->item('workflow_accounts_statuses');
            if (!is_array($accountsStatuses) || empty($accountsStatuses)) {
                $accountsStatuses = array(5, 6, 7, 8, 9, 10);
            }
            $CI->db->where_in($jobAlias . '.status', $accountsStatuses);
        }
        // Seat 2 (surveyor admin / acting supervisor): all jobs on the selected CIN + LOB.
    }
}

if (!function_exists('workflow_flag_on')) {
    function workflow_flag_on($value)
    {
        if (is_array($value)) {
            $value = end($value);
        }
        $value = strtolower(trim((string) $value));
        return in_array($value, array('1', 'yes', 'true', 'on'), true);
    }
}

if (!function_exists('workflow_ensure_template_schema')) {
    function workflow_ensure_template_schema()
    {
        $CI =& get_instance();
        if (!$CI->db->table_exists('claims_templates')) {
            return;
        }
        if (!$CI->db->field_exists('send_ila', 'claims_templates')) {
            $CI->db->query('ALTER TABLE `claims_templates` ADD `send_ila` TINYINT(1) NOT NULL DEFAULT 0');
        }
        if (!$CI->db->field_exists('send_lor', 'claims_templates')) {
            $CI->db->query('ALTER TABLE `claims_templates` ADD `send_lor` TINYINT(1) NOT NULL DEFAULT 0');
        }
    }
}

/**
 * ILA/LOR follow the field template when one is applied (R-34).
 * No template = REG path: both required.
 */
if (!function_exists('workflow_requires_ila')) {
    function workflow_requires_ila($jobdata)
    {
        $data = is_string($jobdata) ? json_decode($jobdata, true) : (array) $jobdata;
        if (empty($data['template_name']) && !isset($data['send_ila'])) {
            return true;
        }
        if (isset($data['send_ila'])) {
            return workflow_flag_on($data['send_ila']);
        }
        return true;
    }
}

if (!function_exists('workflow_requires_lor')) {
    function workflow_requires_lor($jobdata)
    {
        $data = is_string($jobdata) ? json_decode($jobdata, true) : (array) $jobdata;
        if (empty($data['template_name']) && !isset($data['send_lor'])) {
            return true;
        }
        if (isset($data['send_lor'])) {
            return workflow_flag_on($data['send_lor']);
        }
        return true;
    }
}
