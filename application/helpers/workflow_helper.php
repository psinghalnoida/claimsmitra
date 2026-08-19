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
 * @param string   $assignAlias    alias of claims_livelocationjob_assign (e.g. CJA, clja)
 * @param string   $jobAlias       alias of claims_livelocationjob (e.g. CJ, clj); used for accounts
 * @param mixed    $userRole       connect usertype 1–4
 * @param int      $userId         session user id
 * @param int|null $explicitStatus a specific clj.status the caller already filters to (if any).
 *                                 When set and outside the accounts scope, the accounts-only
 *                                 status restriction is skipped instead of being AND-ed on top
 *                                 of the caller's filter (which would always yield zero rows).
 */
if (!function_exists('workflow_apply_assignee_visibility')) {
    function workflow_apply_assignee_visibility($assignAlias, $jobAlias, $userRole, $userId, $explicitStatus = null)
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
            if ($explicitStatus !== null && !in_array((int) $explicitStatus, $accountsStatuses, true)) {
                // Caller already scopes to a status outside the accounts range (e.g. "under
                // survey" = 1) — applying the accounts filter on top would always match zero
                // rows, so leave the caller's own status filter as the only restriction.
                return;
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
        if (!$CI->db->field_exists('submission_tat_days', 'claims_templates')) {
            $CI->db->query('ALTER TABLE `claims_templates` ADD `submission_tat_days` INT NOT NULL DEFAULT 15');
        }
    }
}

if (!function_exists('workflow_assignment_class')) {
    function workflow_assignment_class($jobdata)
    {
        $data = is_string($jobdata) ? json_decode($jobdata, true) : (array) $jobdata;
        $class = strtoupper(trim((string) ($data['assignment_class'] ?? '')));
        if ($class === 'STY' || $class === 'REG') {
            return $class;
        }
        return !empty($data['template_name']) ? 'STY' : 'REG';
    }
}

/**
 * REG: always required. STY: template / post-receipt send_ila (R-29).
 */
if (!function_exists('workflow_requires_ila')) {
    function workflow_requires_ila($jobdata)
    {
        if (workflow_assignment_class($jobdata) === 'REG') {
            return true;
        }
        $data = is_string($jobdata) ? json_decode($jobdata, true) : (array) $jobdata;
        return workflow_flag_on($data['send_ila'] ?? 0);
    }
}

if (!function_exists('workflow_requires_lor')) {
    function workflow_requires_lor($jobdata)
    {
        if (workflow_assignment_class($jobdata) === 'REG') {
            return true;
        }
        $data = is_string($jobdata) ? json_decode($jobdata, true) : (array) $jobdata;
        return workflow_flag_on($data['send_lor'] ?? 0);
    }
}

if (!function_exists('workflow_submission_tat_days')) {
    function workflow_submission_tat_days($jobdata)
    {
        $CI =& get_instance();
        $allowed = $CI->config->item('workflow_tat');
        $allowedDays = isset($allowed['submission_days']) ? $allowed['submission_days'] : array(5, 15, 30);
        $default = isset($allowed['submission_default']) ? (int) $allowed['submission_default'] : 15;
        $data = is_string($jobdata) ? json_decode($jobdata, true) : (array) $jobdata;
        $days = (int) ($data['submission_tat_days'] ?? $default);
        return in_array($days, $allowedDays, true) ? $days : $default;
    }
}
