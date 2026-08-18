<?php defined('BASEPATH') or exit('No direct script access allowed');
class Assignment_model extends CI_Model
{
  public $formattedDateTime;
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('array');
    $this->load->helper('date');
    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = now();
    $this->formattedDateTime = date('d-m-Y H:i:s', $currentDateTime);
    $this->load->helper('workflow_helper');
  }

  private function assigneeVisibilityFromPost($postData, $assignAlias = 'CJA', $jobAlias = 'CJ')
  {
    $userRole = $postData['user_role'] ?? ($postData['usertype'] ?? '');
    $userid = (int) $this->session->userdata('id');
    workflow_apply_assignee_visibility($assignAlias, $jobAlias, $userRole, $userid);
  }

  public function getAdditionalDataByaid($aid)
  {
    $this->db->select('parameterized');
    $this->db->from('claims_assessment'); // Replace with your actual table name
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row()->parameterized;
    } else {
      return false;
    }
  }

  public function getAssessmentById($aid)
  {
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_assessment');

    if ($query->num_rows() > 0) {
      return $query->row(); // Return a single result as object
    } else {
      return false;
    }
  }

  public function insert_dispatch($data)
  {
    $this->db->insert('claims_dispatch', $data);
    if ($this->db->affected_rows() > 0) {
      // After successful insert, update the status in claims_livelocationjobs
      return $this->update_claim_status($data['aid']);
    }
    return false;
  }

  public function update_claim_status($aid)
  {
    $this->db->where('aid', $aid); // Assuming 'id' is the primary key in claims_livelocationjobs
    return $this->db->update('claims_livelocationjob', ['status' => 8]);
  }

  public function createcase($data)
  {
    $this->db->trans_start();

    try {
      $query = $this->db->insert('claims_livelocationjob', $data);
      $this->db->trans_complete();

      if ($this->db->trans_status() === true) {
        return ['aid' => $data['aid'], 'status' => true];
      } else {
        $error = $this->db->error();
        return ['aid' => null, 'status' => false, 'error_code' => $error['code'], 'error_message' => $error['message']];
      }
    } catch (Exception $e) {
      return ['aid' => null, 'status' => false, 'error_code' => $e->getCode(), 'error_message' => $e->getMessage()];
    }
  }

  public function createoutgoingcase($casedata)
  {
    $this->db->trans_start();

    try {
      $query = $this->db->insert('claims_outgoingjobs', $casedata);
      $this->db->trans_complete();

      if ($this->db->trans_status() === true) {
        return ['aid' => $casedata['aid'], 'status' => true];
      } else {
        $error = $this->db->error();
        return ['aid' => null, 'status' => false, 'error_code' => $error['code'], 'error_message' => $error['message']];
      }
    } catch (Exception $e) {
      return ['aid' => null, 'status' => false, 'error_code' => $e->getCode(), 'error_message' => $e->getMessage()];
    }
  }

  public function insertJob($data = null)
  {
    if ($data === null || !is_array($data)) {
      return array(
        'aid' => null,
        'status' => 'Invalid input data'
      );
    }
    $query = $this->db->insert('claims_outgoingjobs', $data);
    if ($query) {
      $result = array(
        'aid' => $data['aid'],
        'status' => true
      );
    } else {
      $result = array(
        'aid' => null,
        'status' => $this->db->error()
      );
    }

    return $result;
  }

  public function insert_quick_survey($data)
  {
    $this->db->insert('claims_quicksurvey', $data);

    if ($this->db->affected_rows() > 0) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }

  public function updateorder($response)
  {
    $this->db->insert('claims_payment', $response);

    if ($this->db->affected_rows() > 0) {
      return $this->db->insert_id(); // Returns the auto-incremented ID
    } else {
      return false;
    }
  }

  public function getjobData($aid)
  {
    return $this->db->select('jobdata')
      ->where('aid', $aid)
      ->get('claims_livelocationjob')
      ->row_array();
  }

  public function getoutgoingjobData($aid)
  {
    return $this->db->select('jobdata')
      ->where('aid', $aid)
      ->get('claims_outgoingjobs')
      ->row_array();
  }
  public function updateCaseReferenceAndJobdata($aid, $case_reference, $jobdata)
  {
    if (!is_string($jobdata)) {
      $jobdata = json_encode($jobdata);
    }
    $data = array(
      'case_reference' => $case_reference,
      'jobdata' => $jobdata
    );
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updateoutgoingCaseReference($aid, $case_reference, $jobdata)
  {
    if (!is_string($jobdata)) {
      $jobdata = json_encode($jobdata);
    }
    $data = array(
      'case_reference' => $case_reference,
      'jobdata' => $jobdata
    );
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_outgoingjobs', $data)) {
      return true;
    } else {
      return false;
    }
  }

  function updateCaseData_outgoing($data, $aid)
  {
    $data = array('casedata' => $data);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_outgoingjobs', $data)) {
      return true;
    } else {
      return false;
    }
  }

  function updatetemplateCaseData($data, $aid)
  {
    $data = array('casedata' => $data);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_templates', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updateoutgoingEssentialData($data, $aid)
  {
    $dataArray = array('essentialdata' => $data);
    $this->db->where('aid', $aid);
    return $this->db->update('claims_outgoingjobs', $dataArray);
  }

  public function getUsersByDepartment($departmentId)
  {
    try {
      // Query setup
      $this->db->select('
              u.id AS user_id, 
              u.firstname, 
              u.lastname, 
              u.mobile, 
              u.email, 
              u.usertype, 
              d.department, 
              d.taskid,
              cc.companyName
          ');
      $this->db->from('claims_users AS u');
      $this->db->join('claims_connect_with_department AS c', 'u.id = c.uid', 'LEFT');
      $this->db->join('claims_department AS d', 'FIND_IN_SET(d.id, c.departmentid) > 0', 'LEFT');
      $this->db->join('claims_company AS cc', 'FIND_IN_SET(cc.id, c.cid) > 0', 'LEFT');
      $this->db->where('d.id', $departmentId);
      $query = $this->db->get();

      // Check for query errors
      if (!$query) {
        log_message('error', 'SQL Error: ' . print_r($this->db->error(), true));
        return false;
      }

      // Return results if any rows are found
      if ($query->num_rows() > 0) {
        return $query->result_array();
      } else {
        log_message('debug', 'No users found for department ID: ' . $departmentId);
        return false;
      }
    } catch (Exception $e) {
      log_message('error', 'Exception: ' . $e->getMessage());
      return false;
    }
  }

  public function jobassignTo($data)
  {
    $query = $this->db->insert('claims_livelocationjob_assign', $data);
    return $query ? true : $this->db->error();
  }

  public function outgoingjobassignTo($data)
  {
    $query = $this->db->insert('claims_outgoingjobs_assign', $data);
    return $query ? true : $this->db->error();
  }

  public function getjobdatabyAid($aid)
  {
    $this->db->select('jobdata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->jobdata;
    } else {
      return false;
    }
  }

  public function gettemplateessential($templateid)
  {
    return $this->getTemplateFieldById($templateid, 'essentialdata');
  }

  public function gettemplatcase($templateid)
  {
    return $this->getTemplateFieldById($templateid, 'casedata');
  }

  private function getTemplateFieldById($templateid, $field)
  {
    $this->db->select($field);
    $this->db->from('claims_templates');
    $this->db->where('id', $templateid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->$field;
    } else {
      return false;
    }
  }



  public function getassessmentdatabyaid($aid)
  {
    $this->db->select('parameterized');
    $this->db->from('claims_assessment');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->parameterized;
    } else {
      return false;
    }
  }

  public function getassessmentdatabyid($aid)
  {
    $this->db->select('assessment');
    $this->db->from('claims_assessment');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->assessment;
    } else {
      return false;
    }
  }

  public function getoutgoingjobdatabyAid($aid)
  {
    $this->db->select('jobdata');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->jobdata;
    } else {
      return false;
    }
  }


  public function getLocationJob()
  {
    $this->db->select('*');
    $this->db->from('claims_task_list');
    $this->db->where('find_in_set("1", based_on) <> 0');
    $this->db->where('find_in_set("2", based_on) <> 0');
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      return $result->result_array();
    } else {
      return false;
    }
  }

  public function getCaseFormByid($formid)
  {
    $this->db->select('id, form,investigator_type');
    $this->db->from('claims_task_list');
    $this->db->where('id', $formid);
    $result = $this->db->get();
    if ($this->db->error()['code'] != 0) {
      log_message('error', 'Database error: ' . json_encode($this->db->error()));
      return false;
    }
    if ($result->num_rows() > 0) {
      return $result->row();
    }
    return false;
  }

  public function insertTemplate($data)
  {
    return $this->db->insert('claims_email', $data);
  }

  public function get_email_config()
  {
    $query = $this->db->get('claims_email_setting');
    return $query->row_array();
  }
  public function getAllTemplates()
  {
    $query = $this->db->select('templatename')
      ->from('claims_email')
      ->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  public function getTemplateBody($templateName)
  {
    $query = $this->db->select('templatebody')
      ->from('claims_email')
      ->where('templatename', $templateName)
      ->get();
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }
  function get_jobdata_case($aid)
  {
    $this->db->select('jobdata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->jobdata;
    } else {
      return false;
    }
  }
  function get_outgoing_jobdata_case($aid)
  {
    $this->db->select('jobdata');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->jobdata;
    } else {
      return false;
    }
  }



  public function getcasedatabyAid($aid)
  {
    $this->db->select('casedata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->casedata;
    } else {
      return false;
    }
  }

  public function getoutgoingcasedatabyAid($aid)
  {
    $this->db->select('casedata');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->casedata;
    } else {
      return false;
    }
  }

  // public function getpreparelor($departments)
  // {
  //     $this->db->select('id, description'); 
  //     $this->db->from('claims_lor'); 
  //     $this->db->where_in('department', $departments);
  //     $query = $this->db->get();
  //     return $query->result(); 
  // }
  // public function getSendlorStatus($aid)
  // {
  //     $this->db->select('status');
  //     $this->db->from('claims_sendlor');
  //     $this->db->where('aid', $aid);
  //     $query = $this->db->get();
  //     return $query->row() ? $query->row()->status : null;
  // }
  // LOR SECTION START
  public function getpreparelor($departments)
  {
    $this->db->select('id, description');
    $this->db->from('claims_lor');
    $this->db->where_in('department', $departments);
    $query = $this->db->get();

    if (!$query) {
      log_message('error', 'Query Error: ' . $this->db->last_query());
      return false;
    }
    return $query->result();
  }
  public function getLorByAidUid($aid, $uid)
  {
    $query = $this->db->get_where('claims_sendlor', ['aid' => $aid, 'uid' => $uid]);
    return $query->row_array();
  }

  public function getSendlorStatus($aid)
  {
    $this->db->select('status');
    $this->db->from('claims_sendlor');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    return $query->row() ? $query->row()->status : null;
  }
  public function updateLorQuestions($aid, $data)
  {
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_sendlor');

    if ($query->num_rows() > 0) {
      // Record exists – perform update
      $this->db->where('aid', $aid);
      $this->db->update('claims_sendlor', [
        'sent_to' => $data['sent_to'],
        'special_note' => $data['special_note'],
        'date_of_letter' => $data['date_of_letter'],
        'automail_fix' => $data['automail_fix'],
        'sent_date' => $data['sent_date'],
        'mail_automation' => $data['mail_automation'],
        'status' => $data['status'],
      ]);
    } else {
      // Record does not exist – perform insert
      $insert_data = [
        'aid' => $aid, // include primary key in insert
        'sent_to' => $data['sent_to'],
        'special_note' => $data['special_note'],
        'date_of_letter' => $data['date_of_letter'],
        'automail_fix' => $data['automail_fix'],
        'sent_date' => $data['sent_date'],
        'mail_automation' => $data['mail_automation'],
        'status' => $data['status'],
      ];
      $this->db->insert('claims_sendlor', $insert_data);
    }

    return $this->db->affected_rows() > 0;
  }
  public function insertLorQuestions($data)
  {
    $this->db->insert('claims_sendlor', [
      'aid' => $data['aid'],
      'uid' => $data['uid'],
      'lor' => $data['lor']
    ]);
    return $this->db->affected_rows() > 0;
  }
  public function updateLor($aid, $uid, $updatedLorJson)
  {
    $this->db->where('aid', $aid);
    $this->db->where('uid', $uid);
    $this->db->update('claims_sendlor', ['lor' => $updatedLorJson]);
    return $this->db->affected_rows() > 0;
  }

  public function appendQuestion($aid, $newQuestion)
  {
    $this->db->select('lor');
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_sendlor');
    $result = $query->row();

    if ($result) {
      $existingQuestions = json_decode($result->lor, true);
      if (!is_array($existingQuestions)) {
        $existingQuestions = [];
      }
      $existingQuestions[] = $newQuestion;
      $updatedData = ['lor' => json_encode($existingQuestions)];

      // Update the database
      $this->db->where('aid', $aid);
      if ($this->db->update('claims_sendlor', $updatedData)) {
        return true;
      } else {
        log_message('error', 'Database update failed for aid ' . $aid);
      }
    } else {
      log_message('error', 'No record found for aid ' . $aid);
    }

    return false;
  }

  public function updateQuestion($aid, $description, $questionId)
  {
    // Select the 'lor' field for the given 'aid'
    $this->db->select('lor');
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_sendlor');

    if ($query->num_rows() > 0) {
      $row = $query->row();
      $lorArray = json_decode($row->lor, true); // Decode the JSON string into an array

      if (is_array($lorArray)) {
        // Loop through the 'lor' array to find the matching 'questionId'
        foreach ($lorArray as $key => $item) {
          if (isset($item['id']) && $item['id'] == $questionId) {
            // Update the description for the matched question
            error_log("Matched questionId: $questionId, old description: " . $item['description']);
            $lorArray[$key]['description'] = $description;
            break;
          }
        }

        // Re-encode the 'lor' array into a JSON string and update the database
        $updatedLor = json_encode(array_values($lorArray));
        $this->db->set('lor', $updatedLor);
        $this->db->where('aid', $aid);

        // Execute the update query
        $result = $this->db->update('claims_sendlor');
        if ($result) {
          return true; // Successfully updated
        } else {
          echo $this->db->last_query(); // For debugging purposes
          return false;
        }
      }
    }
    return false; // If no matching 'aid' or 'lor' array
  }


  public function getInsertedQuestions($aid)
  {
    $this->db->select('lor');
    $this->db->from('claims_sendlor');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $questions = $query->result_array();
      foreach ($questions as &$question) {
        $question['description'] = json_decode($question['lor']);
      }
      return $questions;
    } else {
      return false;
    }
  }



  public function deleteQuestionById($aid, $questionId)
  {
    $this->db->select('lor');
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_sendlor');

    if ($query->num_rows() > 0) {
      $row = $query->row();
      $lorArray = json_decode($row->lor, true);

      if (is_array($lorArray)) {
        foreach ($lorArray as $key => $item) {
          if (isset($item['id']) && $item['id'] == $questionId) {
            unset($lorArray[$key]);
            break;
          }
        }
        $updatedLor = json_encode(array_values($lorArray));
        $this->db->set('lor', $updatedLor);
        $this->db->where('aid', $aid);
        return $this->db->update('claims_sendlor');
      }
    }
    return false;
  }

  public function getSentToByAid($aid)
  {
    $this->db->select('sent_to');
    $this->db->from('claims_sendlor');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      return json_decode($result['sent_to'], true);
    }
    return [];
  }

  public function getSendlorRow($aid)
  {
    $query = $this->db->get_where('claims_sendlor', ['aid' => $aid]);
    return $query->row_array();
  }

  public function getCaseReferenceByAid($aid)
  {
    $query = $this->db->select('case_reference, status')
      ->from('claims_livelocationjob')
      ->where('aid', $aid)
      ->get();
    return $query->row_array();
  }

  public function getLorParties($aid)
  {
    if (!$this->db->table_exists('claims_lor_party')) {
      return [];
    }
    return $this->db->order_by('id', 'asc')->get_where('claims_lor_party', ['aid' => $aid])->result_array();
  }

  public function upsertLorParties($aid, $parties, $overwriteSendAs = true)
  {
    if (!is_array($parties)) {
      return false;
    }
    foreach ($parties as $p) {
      $email = strtolower(trim($p['email'] ?? ''));
      if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        continue;
      }
      $sendAs = $p['send_as'] ?? 'cc';
      if (!in_array($sendAs, ['to', 'cc', 'bcc', 'none'], true)) {
        $sendAs = 'cc';
      }
      $row = [
        'aid' => $aid,
        'name' => $p['name'] ?? '',
        'email' => $email,
        'header_kind' => $p['header_kind'] ?? 'unknown',
        'source' => $p['source'] ?? 'paste',
      ];
      if ($overwriteSendAs) {
        $row['send_as'] = $sendAs;
      }
      $existing = $this->db->get_where('claims_lor_party', ['aid' => $aid, 'email' => $email])->row();
      if ($existing) {
        $this->db->where('id', $existing->id)->update('claims_lor_party', $row);
      } else {
        $row['send_as'] = $sendAs;
        $this->db->insert('claims_lor_party', $row);
      }
    }
    return true;
  }

  public function markLorReceived($aid, $questionId, $received)
  {
    $row = $this->getSendlorRow($aid);
    if (!$row) {
      return false;
    }
    $lorArray = json_decode($row['lor'], true);
    if (!is_array($lorArray)) {
      return false;
    }
    foreach ($lorArray as $key => $item) {
      if (isset($item['id']) && (string) $item['id'] === (string) $questionId) {
        $lorArray[$key]['received'] = $received ? 1 : 0;
        $lorArray[$key]['received_at'] = $received ? date('Y-m-d H:i:s') : null;
        break;
      }
    }
    $this->db->where('aid', $aid)->update('claims_sendlor', ['lor' => json_encode(array_values($lorArray))]);
    return true;
  }

  public function saveLorChaseMeta($aid, $data)
  {
    $row = $this->getSendlorRow($aid);
    $payload = [];
    foreach (['appointment_subject', 'our_ref', 'reminder_frequency_days', 'next_due_on', 'mail_subject', 'sent_to', 'special_note', 'date_of_letter', 'sent_date', 'status', 'lor'] as $key) {
      if (array_key_exists($key, $data)) {
        $payload[$key] = $data[$key];
      }
    }
    if (empty($payload)) {
      return false;
    }
    if ($row) {
      $this->db->where('aid', $aid)->update('claims_sendlor', $payload);
    } else {
      $payload['aid'] = $aid;
      $payload['uid'] = (int) $this->session->userdata('id');
      if (!isset($payload['lor'])) {
        $payload['lor'] = '[]';
      }
      $this->db->insert('claims_sendlor', $payload);
    }
    return true;
  }

  public function markJobLorSent($aid)
  {
    $job = $this->getCaseReferenceByAid($aid);
    if (!$job) {
      return false;
    }
    $status = (int) $job['status'];
    if ($status > 0 && $status < 3) {
      $this->db->where('aid', $aid)->update('claims_livelocationjob', ['status' => 3]);
    }
    return true;
  }

  public function getLorDueJobs($companyid, $departmentid, $userRole, $userId)
  {
    lor_ensure_schema();
    if (!$this->db->field_exists('next_due_on', 'claims_sendlor')) {
      return [];
    }
    $this->db->select('SL.aid, SL.next_due_on, SL.reminder_frequency_days, SL.appointment_subject, SL.lor, SL.our_ref, CJ.case_reference, CJ.status, CJA.uid_to');
    $this->db->from('claims_sendlor as SL');
    $this->db->join('claims_livelocationjob as CJ', 'CJ.aid = SL.aid', 'inner');
    $this->db->join('claims_livelocationjob_assign as CJA', 'CJA.aid = SL.aid', 'left');
    $this->db->where('SL.next_due_on IS NOT NULL', null, false);
    $this->db->where('SL.next_due_on <=', date('Y-m-d'));
    $this->db->where_not_in('CJ.status', [10, 11]);
    if ($companyid) {
      $this->db->where('CJA.cid_to', $companyid);
    }
    if ($departmentid) {
      $this->db->where('CJA.departmentid', $departmentid);
    }
    workflow_apply_assignee_visibility('CJA', 'CJ', $userRole, (int) $userId);
    $this->db->order_by('SL.next_due_on', 'asc');
    $rows = $this->db->get()->result_array();
    $due = [];
    foreach ($rows as $row) {
      $pending = lor_count_pending($row['lor']);
      if ($pending < 1) {
        continue;
      }
      $row['pending_count'] = $pending;
      $due[] = $row;
    }
    return $due;
  }
  // LOR SECTION END

  public function getessentialdatabyAid($aid)
  {
    $this->db->select('essentialdata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->essentialdata;
    } else {
      return false;
    }
  }

  public function getparamenterdatabyAid($aid)
  {
    $this->db->select('parameterized');
    $this->db->from('claims_assessment');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->parameterized;
    } else {
      return false;
    }
  }
  public function getassessmentdataAid($aid)
  {
    $this->db->select('assessment');
    $this->db->from('claims_assessment');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->assessment;
    } else {
      return false;
    }
  }

  public function getoutgoingessentialdatabyAid($aid)
  {
    $this->db->select('essentialdata');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->essentialdata;
    } else {
      return false;
    }
  }
  public function getTemplateById($id)
  {
    workflow_ensure_template_schema();
    $query = $this->db->get_where('claims_templates', ['id' => $id]);
    return $query->row_array();
  }

  public function gettemplateessentialdatabyAid($userid)
  {
    workflow_ensure_template_schema();
    $this->db->select('id, case_reference, template_name, essentialdata, casedata, createdAt, send_ila, send_lor');
    $this->db->from('claims_templates');
    $this->db->where('userId', $userid);
    $this->db->order_by('createdAt', 'DESC'); // optional

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_encode($query->result());  // return all rows
    }
  }



  public function getnatureofjobbyAid($aid)
  {
    $this->db->select('natureofjob');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->natureofjob;
    } else {
      return false;
    }
  }

  public function getnatureofjob($id)
  {
    $this->db->select('id');
    $this->db->from('claims_task_list');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row(); // returns single object
  }


  public function getoutgoingnatureofjobbyAid($aid)
  {
    $this->db->select('natureofjob');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->natureofjob;
    } else {
      return false;
    }
  }

  public function getAllFiles($aid, $filetype)
  {
    $directory = 'uploads/' . $aid . '/' . $filetype;
    // Get all files in the directory
    $files = $this->getFiles($directory);
    return $files;
  }

  public function getAllReports($aid, $filetype)
  {
    $directory = 'uploads/' . $aid . '/' . $filetype;
    // Get all files in the directory
    $files = $this->getFiles($directory);
    return $files;
  }


  private function getFiles($directory)
  {
    $files = array();
    if ($handle = opendir($directory)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $files[] = $file;
        }
      }
      closedir($handle);
    }
    return $files;
  }

  /* ------------------------------------------------------------------------- *
  * FETCH INCOMING ASSIGNMENT FROM CLAIMS_ASSIGNMENT
  * ------------------------------------------------------------------------- */
  public function fetchIncomingAssignment($postData)
  {
    $this->_get_incoming_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countallIncomingAssignement()
  {
    $this->db->from('claims_livelocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredIncomingAssignment($postData)
  {
    $this->_get_incoming_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_incoming_datatables_query($postData)
  {
    $departmentid = $postData['department'];
    $companyid = $postData['company'];

    // Define column names for searching
    $this->column_search = array('CJ.case_reference', 'CJ.aid', 'CTL.investigator_type');
    $status_map = workflow_status_search_map();

    // Select required fields
    $this->db->select("CJ.id, CJ.case_reference, CJA.uid_from, CJA.departmentid, CJ.status, 
                       CJA.uid_to, CJA.cid_from, CJA.cid_to, CJ.aid, CTL.investigator_type, 
                       CJ.jobdata,CJ.essentialdata, JSON_UNQUOTE(JSON_EXTRACT(CJ.essentialdata, '$.insured_name')) AS insured_name, CJ.status, CJ.createdAt, CJ.latitude, CJ.longitude");
    $this->order = array('CJ.id' => 'desc');
    $this->db->from('claims_livelocationjob as CJ');
    $this->db->join('claims_livelocationjob_assign as CJA', 'CJA.aid = CJ.aid', 'left');
    $this->db->join('claims_task_list as CTL', 'CTL.id = CJ.natureofjob', 'left');
    $this->db->where("CJA.departmentid", $departmentid);
    $this->db->where("CJA.cid_to", $companyid);
    $this->assigneeVisibilityFromPost($postData);
    // print_r(json_encode($this->db->get()->result_array()));
    // exit;
    // Check if there is a search value
    if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
      $search_value = strtolower(trim($postData['search']['value']));

      // Check if the search term matches a status
      if (isset($status_map[$search_value])) {
        // If searching by status, filter by numeric value
        $this->db->where("CJ.status", $status_map[$search_value]);
      } else {
        // General search across defined columns
        $i = 0;
        foreach ($this->column_search as $item) {
          if ($i === 0) {
            $this->db->group_start();
            $this->db->like($item, $search_value);
          } else {
            $this->db->or_like($item, $search_value);
          }

          if (count($this->column_search) - 1 == $i) {
            $this->db->group_end();
          }
          $i++;
        }
      }
    }

    // Order by column if provided
    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  private function _get_outgoing_datatables_query($postData)
  {
    $departmentid = $postData['department'];
    $companyid = $postData['company'];
    $userid = $this->session->userdata('id');

    // Define column names for searching
    $this->column_search = array('CJ.case_reference', 'CJ.aid', 'CTL.investigator_type');
    $status_map = workflow_status_search_map();

    // Select required fields
    $this->db->select("CJ.id, CJ.case_reference, CJA.uid_from, CJA.departmentid, CJ.status, 
                       CJA.uid_to, CJA.cid_from, CJ.natureofjob, CJA.cid_to, CJ.aid, CTL.investigator_type, 
                       CJ.jobdata,CJ.essentialdata,JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.language_from')) AS language_from,JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.affected_person')) AS affected_person, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.state')) AS state, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.loss_data')) AS loss_data, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.language_to')) AS language_to, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.affected_person')) AS affected_person,JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.valuation_type')) AS valuation_type, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.vehicle_number')) AS vehicle_number, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.firm_name')) AS firm_name, JSON_UNQUOTE(JSON_EXTRACT(CJ.jobdata, '$.consignor')) AS consignor, CJ.status, CJ.createdAt, CJ.latitude, CJ.longitude, CP.receivedamount");
    $this->order = array('CJ.id' => 'desc');
    $this->db->from('claims_outgoingjobs as CJ');
    $this->db->join('claims_outgoingjobs_assign as CJA', 'CJA.aid = CJ.aid', 'left');
    $this->db->join('claims_task_list as CTL', 'CTL.id = CJ.natureofjob', 'left');
    $this->db->join('claims_payment as CP', 'CP.aid = CJ.aid', 'left');    // $this->db->where("CJA.departmentid", $departmentid);
    // $this->db->where("CJA.cid_to", $companyid);
    // $this->db->where("CJ.status != ", 0);


    // Check if there is a search value
    if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
      $search_value = strtolower(trim($postData['search']['value']));

      // Check if the search term matches a status
      if (isset($status_map[$search_value])) {
        // If searching by status, filter by numeric value
        $this->db->where("CJ.status", $status_map[$search_value]);
      } else {
        // General search across defined columns
        $i = 0;
        foreach ($this->column_search as $item) {
          if ($i === 0) {
            $this->db->group_start();
            $this->db->like($item, $search_value);
          } else {
            $this->db->or_like($item, $search_value);
          }

          if (count($this->column_search) - 1 == $i) {
            $this->db->group_end();
          }
          $i++;
        }
      }
    }

    // Order by column if provided
    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  /* ------------------------------------------------------------------------- *
  * CANCEL INCOMING ASSIGNMENT (BY NANDINI)
  * ------------------------------------------------------------------------- */
  public function updateAssignmentStatus($aid, $data)
  {
    $this->db->where('aid', $aid);
    $this->db->update('claims_livelocationjob', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function getCancelReason($aid)
  {
    $this->db->select('reasonforcancel');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $this->db->where('status', 11);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->reasonforcancel;
    }
    return null;
  }

  /* ------------------------------------------------------------------------- *
  * FETCH OUTGOING ASSIGNMENT FROM CLAIMS_ASSIGNMENT
  * ------------------------------------------------------------------------- */
  public function fetchOutgoingAssignment($postData)
  {
    $this->_get_outgoing_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countallOutgoingAssignement()
  {
    $this->db->from('claims_outgoingjobs');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredOutgoingAssignment($postData)
  {
    $this->_get_outgoing_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  // private function _get_outgoing_datatables_query($postData)
  // {
  //   $userid = $this->session->userdata('id');
  //   $this->column_search = array(
  //     'CJ.id',
  //     'CJ.case_reference',
  //     'CJ.status',
  //     'CJA.uid_from',
  //     'CJA.uid_to',
  //     'CJA.cid_from',
  //     'CJA.cid_to',
  //     'CJ.aid',
  //     'ctl.investigator_type',
  //     'CJ.jobdata',
  //     'CJ.status',
  //     'CJ.createdAt',
  //     'CJ.latitude',
  //     'CJ.longitude'
  //   );

  //   $this->db->select("CJ.id,
  //                     CJ.case_reference,
  //                     CJA.uid_from,
  //                     CJ.status,
  //                     CJA.uid_to,
  //                     CJA.cid_from,
  //                     CJA.cid_to,
  //                     CJ.aid,
  //                     ctl.investigator_type,
  //                     CJ.jobdata,
  //                     CJ.status,
  //                     CJ.createdAt,
  //                     CJ.latitude,
  //                     CJ.longitude");
  //   // Set default order
  //   $this->order = array('CJ.id' => 'desc');
  //   $this->db->from('claims_outgoingjobs as CJ');
  //   $this->db->join('claims_outgoingjobs_assign as CJA', 'CJA.aid = CJ.aid', 'left');
  //   $this->db->join('claims_task_list as ctl', 'ctl.id = CJ.natureofjob', 'left');
  //   $this->db->where("CJA.departmentid", $postData['departmentid']);
  //   $this->db->where("CJA.cid_to", $postData['companyid']);
  //   $this->db->where("CJ.status != ", 1);
  //   $i = 0;
  //   // loop searchable columns 
  //   foreach ($this->column_search as $item) {
  //     // if datatable send POST for search
  //     if (isset($postData['search']['value'])) {
  //       // first loop
  //       if ($i === 0) {
  //         // open bracket
  //         $this->db->group_start();
  //         $this->db->like($item, $postData['search']['value']);
  //       } else {
  //         $this->db->or_like($item, $postData['search']['value']);
  //       }

  //       // last loop
  //       if (count($this->column_search) - 1 == $i) {
  //         // close bracket
  //         $this->db->group_end();
  //       }
  //     }
  //     $i++;
  //   }

  //   if (isset($postData['order'])) {
  //     $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
  //   } else if (isset($this->order)) {
  //     $order = $this->order;
  //     $this->db->order_by(key($order), $order[key($order)]);
  //   }
  // }

  public function fetchCompletedAssignment($postData)
  {
    $this->_get_completed_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countallCompletedAssignment()
  {
    $this->db->from('claims_livelocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredCompletedAssignment($postData)
  {
    $this->_get_completed_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_completed_datatables_query($postData)
  {
    $departmentid = $postData['department'];
    $companyid = $postData['company'];
    $userid = $this->session->userdata('id');

    // Define column names for searching
    $this->column_search = array('CJ.case_reference', 'CJ.aid', 'CTL.investigator_type');
    $status_map = workflow_status_search_map();

    // Select required fields
    $this->db->select("CJ.id, CJ.case_reference, CJA.uid_from, CJA.departmentid, CJ.status, 
                       CJA.uid_to, CJA.cid_from, CJA.cid_to, CJ.aid, CTL.investigator_type, 
                       CJ.jobdata, CJ.status, CJ.createdAt, CJ.latitude, CJ.longitude");
    $this->order = array('CJ.id' => 'desc');
    $this->db->from('claims_livelocationjob as CJ');
    $this->db->join('claims_livelocationjob_assign as CJA', 'CJA.aid = CJ.aid', 'left');
    $this->db->join('claims_task_list as CTL', 'CTL.id = CJ.natureofjob', 'left');
    $this->db->where("CJ.status", 10);
    $this->db->where("CJA.departmentid", $departmentid);
    $this->db->where("CJA.cid_to", $companyid);
    $this->assigneeVisibilityFromPost($postData);

    // Check if there is a search value
    if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
      $search_value = strtolower(trim($postData['search']['value']));

      // Check if the search term matches a status
      if (isset($status_map[$search_value])) {
        // If searching by status, filter by numeric value
        $this->db->where("CJ.status", $status_map[$search_value]);
      } else {
        // General search across defined columns
        $i = 0;
        foreach ($this->column_search as $item) {
          if ($i === 0) {
            $this->db->group_start();
            $this->db->like($item, $search_value);
          } else {
            $this->db->or_like($item, $search_value);
          }

          if (count($this->column_search) - 1 == $i) {
            $this->db->group_end();
          }
          $i++;
        }
      }
    }

    // Order by column if provided
    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
  /* ------------------------------------------------------------------------- *
  * COUNT FILES IMAGES, VIDEOS AND DOCUMENTS
  * ------------------------------------------------------------------------- */
  public function countFiles($aid, $filetype)
  {
    $directory = 'uploads/' . $aid . '/' . $filetype;
    // Count files with specific extensions
    $totalitem = $this->countFilesWithExtension($directory);
    return $totalitem;
  }
  private function countFilesWithExtension($directory)
  {
    $count = 0;
    if ($handle = opendir($directory)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $count++;
        }
      }
      closedir($handle);
    }
    return $count;
  }

  public function checkCaseReferenceExists($case_reference)
  {
    $this->db->select('case_reference');
    $this->db->from('claims_livelocationjob');
    $this->db->where('case_reference', $case_reference);
    $this->db->where('status !=', 11); // Change here: status should not be 11
    $query = $this->db->get();
    return $query->num_rows() > 0;
  }

  public function checkOutgoingCaseReferenceExists($case_reference)
  {
    $this->db->select('case_reference');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('case_reference', $case_reference);
    $this->db->where('status !=', 11); // Change here: status should not be 11
    $query = $this->db->get();
    return $query->num_rows() > 0;
  }



  /* ------------------------------------------------------------------------- *
  * Essential Data
  * ------------------------------------------------------------------------- */
  public function updateEssentialData($data, $aid)
  {
    $dataArray = array('essentialdata' => $data);
    $this->db->where('aid', $aid);
    return $this->db->update('claims_livelocationjob', $dataArray);
  }

  public function updateEssentialDatatemplate($data, $id)
  {
    $this->db->where('id', $id);
    return $this->db->update('claims_templates', $data);
  }

  public function insertEssentialDatatemplate($data)
  {
    $this->db->insert('claims_templates', $data);
    return $this->db->insert_id(); // ✅ returns inserted ID
  }



  //   public function updatAssesmentData($data)
  // {
  //     $dataArray = array('claims_assessment' => $data);

  //     return $this->db->update('parameterized', $dataArray);
  // }

  public function updatAssesmentData($data)
  {
    $this->db->trans_start();

    try {
      // Check if record exists for given aid
      $this->db->where('aid', $data['aid']);
      $query = $this->db->get('claims_assessment');

      if ($query->num_rows() > 0) {
        // Update existing row
        $this->db->where('aid', $data['aid']);
        $result = $this->db->update('claims_assessment', $data);
      } else {
        // Insert new row
        $result = $this->db->insert('claims_assessment', $data);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === TRUE && $result) {
        return ['aid' => $data['aid'], 'status' => true];
      } else {
        $error = $this->db->error();
        // Log DB error for debugging
        log_message('error', 'DB Error (Code ' . $error['code'] . '): ' . $error['message']);
        return ['aid' => null, 'status' => false, 'error_code' => $error['code'], 'error_message' => $error['message']];
      }
    } catch (Exception $e) {
      $this->db->trans_rollback();
      log_message('error', 'Exception: ' . $e->getMessage());
      return ['aid' => null, 'status' => false, 'error_code' => $e->getCode(), 'error_message' => $e->getMessage()];
    }
  }


  public function getAssessmentByAid($aid)
  {
    $query = $this->db->get_where('claims_assessment', ['aid' => $aid]);
    return $query->row_array();
  }



  public function updatfinalizeAssesmentData($data)
  {
    $this->db->trans_start();

    try {
      // Check if record exists for given aid
      $this->db->where('aid', $data['aid']);
      $query = $this->db->get('claims_assessment');

      if ($query->num_rows() > 0) {
        // Update existing row
        $this->db->where('aid', $data['aid']);
        $result = $this->db->update('claims_assessment', $data);
      } else {
        // Insert new row
        $result = $this->db->insert('claims_assessment', $data);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === TRUE && $result) {
        return ['aid' => $data['aid'], 'status' => true];
      } else {
        $error = $this->db->error();
        // Log DB error for debugging
        log_message('error', 'DB Error (Code ' . $error['code'] . '): ' . $error['message']);
        return ['aid' => null, 'status' => false, 'error_code' => $error['code'], 'error_message' => $error['message']];
      }
    } catch (Exception $e) {
      $this->db->trans_rollback();
      log_message('error', 'Exception: ' . $e->getMessage());
      return ['aid' => null, 'status' => false, 'error_code' => $e->getCode(), 'error_message' => $e->getMessage()];
    }
  }



  public function insertPaymentEssentialData($data, $aid)
  {
    $dataArray = array(
      'bill_to' => $data
    );

    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_billing');

    if ($query->num_rows() > 0) {
      $this->db->where('aid', $aid);
      return $this->db->update('claims_billing', $dataArray);
    } else {
      $dataArray['aid'] = $aid;
      return $this->db->insert('claims_billing', $dataArray);
    }
  }

  public function insertshippingEssentialData($data, $aid)
  {
    $dataArray = array(
      'ship_to' => $data
    );

    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_billing');

    if ($query->num_rows() > 0) {
      $this->db->where('aid', $aid);
      return $this->db->update('claims_billing', $dataArray);
    } else {
      $dataArray['aid'] = $aid;
      return $this->db->insert('claims_billing', $dataArray);
    }
  }


  /* ------------------------------------------------------------------------- *
  * Case Data
  * ------------------------------------------------------------------------- */

  function updateCaseData($data, $aid)
  {
    $data = array('casedata' => $data);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function getQuickSurveyCases($userId)
  {
    $this->_get_quicksurvey_datatables_query($_POST);
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countAllquicksurvey()
  {
    $this->db->from('claims_quicksurvey');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredquicksurvey($postData)
  {
    $this->_get_quicksurvey_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  private function _get_quicksurvey_datatables_query($postData)
  {
    $this->column_search = array(
      'CPJ.id',
      'CPJ.userid',
      'CPJ.beneficiaryname',
      'CPJ.itemnumber',
      'CPJ.directoryname',
      'CPJ.status',
      'CPJ.createdat',
      'CJA.salutation',
      'CJA.firstname',
      'CJA.lastname',
      'CTL.companyName'
    );

    $this->db->select("CPJ.id, CPJ.userid, CTL.companyName, CPJ.beneficiaryname, CPJ.itemnumber, CPJ.directoryname, CPJ.status, CPJ.createdat, CJA.salutation, CJA.firstname, CJA.lastname");

    // Set default order by 'createdat' descending to show most recent entries first
    $this->order = array('CPJ.createdat' => 'desc');
    $this->db->from('claims_quicksurvey as CPJ');
    $this->db->join('claims_users as CJA', 'CJA.id = CPJ.userid', 'INNER');
    $this->db->join('claims_company as CTL', 'CTL.id = CPJ.cid', 'INNER');

    $i = 0;
    foreach ($this->column_search as $item) {
      if (isset($postData['search']['value'])) {
        // First loop
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        if (count($this->column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }


  public function getquicksurveyAllFiles($directoryname, $filetype)
  {
    $directoryname = basename($directoryname);
    $filetype = basename($filetype);

    $directory = FCPATH . 'quicksurvey' . DIRECTORY_SEPARATOR . $directoryname . DIRECTORY_SEPARATOR . $filetype;

    if (!is_dir($directory)) {
      log_message('error', 'Directory does not exist: ' . $directory);
      return 0;
    }

    return count($this->getquicksurveyFiles($directory));
  }

  private function getquicksurveyFiles($directory)
  {
    $files = [];
    try {
      if ($handle = opendir($directory)) {
        while (false !== ($file = readdir($handle))) {
          // Exclude system entries
          if ($file != "." && $file != "..") {
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

            // If you want to filter for specific file types (e.g., jpg, png, mp4)
            $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'pdf', 'docx']; // Add necessary file types
            if (in_array(strtolower($fileExtension), $validExtensions)) {
              $files[] = $file;
            }
          }
        }
        closedir($handle);
      }
    } catch (Exception $e) {
      log_message('error', 'Error reading directory: ' . $directory . ' - ' . $e->getMessage());
    }

    return $files;
  }
}
