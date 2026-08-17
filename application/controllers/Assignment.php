<?php defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
require_once APPPATH . 'libraries/stripe-php/init.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Assignment extends CI_Controller
{
    private $OPENSSL_CIPHER_NAME;
    private $CIPHER_KEY_LEN;
    public function __construct()
    {
        parent::__construct();
        $this->OPENSSL_CIPHER_NAME = "aes-128-cbc";
        $this->CIPHER_KEY_LEN = 16;
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model('assignment_model', 'assignment');
        $this->load->model('company_model', 'company');
        $this->load->model('home_model', 'home');
        $this->load->model('setting_model');
        $this->load->helper('upload_helper');
        $this->load->helper('custom_helper');
        $this->load->helper('data_format');
        $this->load->model('case_model');
    }

    /* ------------------------------------------------------------------------- *
	* GET INCOMING ASSIGNMENT
	* ------------------------------------------------------------------------- */
    public function getIncomingAssignment()
    {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $data = array();
                $cancel = null;
                $jobData = $this->assignment->fetchIncomingAssignment($_POST);
                $accepteduser = null;
                $i = $_POST['start'];
                $viewCaseUrl = encryptUrl($_POST['company'], $_POST['department'], $_POST['user_role']);
                foreach ($jobData as $jobValue) {
                    $insureddata = json_decode($jobValue->jobdata);
                    $i++;
                    $case_status = null;
                    $address = null;
                    if ($jobValue->status == 1) {
                        $case_status = '<span class="label label-info">Under Survey</span>';
                    } else if ($jobValue->status == 2) {
                        $case_status = '<span class="label label-success">Photo Upload</span>';
                    } else if ($jobValue->status == 3) {
                        $case_status = '<span class="label label-success">LOR Sent</span>';
                    } else if ($jobValue->status == 4) {
                        $case_status = '<span class="label label-success">FSR</span>';
                    } else if ($jobValue->status == 5) {
                        $case_status = '<span class="label label-success">Bill Generated</span>';
                    } else if ($jobValue->status == 6) {
                        $case_status = '<span class="label label-warning">Waiting for TI</span>';
                    } else if ($jobValue->status == 7) {
                        $case_status = '<span class="label label-warning">Pending for Dispatch</span>';
                    } else if ($jobValue->status == 8) {
                        $case_status = '<span class="label label-success">Dispatched</span>';
                    } else if ($jobValue->status == 11) {
                        $case_status = '<span class="label label-danger">Cancelled</span>';
                        $cancelReason = $this->assignment->getCancelReason($jobValue->aid);
                    }
                    if ($jobValue->uid_to != 0) {
                        $assignTo = $this->home->getuserdatabyid($jobValue->uid_to);
                        $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#0884c7">' . $assignTo[0]['mobile'] . '</span>');
                    } else {
                        $accepteduser = '<span class="label label-warning">Waiting</span>';
                    }

                    $totalimages = $this->assignment->countFiles($jobValue->aid, "images");
                    $totalvideos = $this->assignment->countFiles($jobValue->aid, "videos");
                    $totaldocuments = $this->assignment->countFiles($jobValue->aid, "documents");

                    $action  = '<div class="panel-heading">
                                    <div class="dropdown" style="float:none;">
                                        <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                            ' . $case_status . '
                                        </button>

                                        <ul class="dropdown-menu">
                                            <input type ="hidden" class ="incoming" name ="hidden">
                                            <li><a target="_blank" href="' . base_url() . 'viewcasedetail?q=' . base64_encode($this->encryption->encrypt($jobValue->aid)) . '&data=' . $viewCaseUrl . '" id="' . $jobValue->aid . '"><i class="fa fa-sync"></i>View Case</a></li>
                                            <li><a href="#cancel_case" data-toggle="modal" onclick="cancelJob(\'' . $jobValue->aid . '\')"><i class="fa fa-cogs"></i>Cancel</a></li>
                                            <li><a href="#"><i class="fa fa-images"></i>Images <span class="text-grey">' . $totalimages . '</span></a></li>
                                            <li><a href="#"><i class="fa fa-video"></i>Videos <span class=" text-grey">' . $totalvideos . '</span></a></li>
                                            <li><a href="#"><i class="fa fa-file"></i>Documents <span class=" text-grey">' . $totaldocuments . '</span></a></li>
                                            <li><a href="#"><i class="fa fa-folder"></i>System Driven <span class=" text-grey">' . $totaldocuments . '</span></a></li>
                                        </ul>
                                    </div>
                                </div>';

                    if ($jobValue->latitude != "" || $jobValue->longitude != "") {
                        $address = $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude);
                    } else {
                        $address = "Location Not Found";
                    }
                    $language = explode(',', $jobValue->jobdata);
                    $media = '<div class="navbar--nav ml-auto">
                                <ul class="nav" style="flex-wrap:unset">
                                    <li class="nav-item">
                                        <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-images"></i>
                                            <span class="badge text-white bg-blue">' . $totalimages . '</span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-video"></i>
                                            <span class="badge text-white bg-blue">' . $totalvideos . '</span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-file"></i>
                                            <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-folder"></i>
                                            <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>';
                    $created = date('Y/m/d', strtotime($jobValue->createdAt));
                    $insuredName = !empty($jobValue->insured_name) ? 'Insured Name: <span style="color:#0884c7">' . $jobValue->insured_name . '</span>' . "\n" : '';
                    $data[] = array(
                        nl2br($jobValue->aid . "\n" . '<span style="color:#e16123">' . $jobValue->case_reference . '</span>' . "\n" . '<span style="color:#0884c7">' . $created . '</span>'),
                        $accepteduser,
                        nl2br($jobValue->investigator_type . "\n" . $insuredName . 'Contact no: <span style="color:#0884c7">' . $insureddata->contact_person_mobile . '</span>'),
                        // $address,
                        $media,
                        $action
                    );
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->assignment->countallIncomingAssignement(),
                    "recordsFiltered" => $this->assignment->countFilteredIncomingAssignment($_POST),
                    "data" => $data,
                );
                echo json_encode($output);
            } else {
                $encrypted_json = $this->input->get('data');
                if ($encrypted_json) {
                    // Decrypt the JSON string
                    $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));

                    if ($decrypted_json) {
                        // Decode the JSON string back into an array
                        $data_array = json_decode($decrypted_json, true);

                        // Access the individual values
                        $defaultcompany = $data_array['defaultcompany'] ?? null;
                        $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                        $usertype = $data_array['usertype'] ?? null;

                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'view' => "Incoming case",
                        ];
                        $this->load->view("adminpanel/jobs/locationbasedjob/incomingcase", $data);
                    }
                }
            }
        } else {
            redirect('user_logout');
        }
    }

    /* ------------------------------------------------------------------------- *
    * GET OUTGOING ASSIGNMENT (BY KAJAL)
    * ------------------------------------------------------------------------- */
    public function getOutgoingAssignment()
    {
        if ($this->session->userdata('id') === null) {
            redirect('user_logout');
            return;
        }

        if ($_POST) {
            $data = [];
            $jobData = $this->assignment->fetchOutgoingAssignment($_POST);
            $i = $_POST['start'];
            $outgoing = 'outgoing';
            $viewCaseUrl = encryptUrl($_POST['company'], $_POST['department'], $_POST['user_role']);

            foreach ($jobData as $jobValue) {
                $i++;
                $created = date('d F Y', strtotime($jobValue->createdAt));
                $case_status = $this->getCaseStatusLabel($jobValue->status);
                $address = ($jobValue->latitude && $jobValue->longitude)
                    ? $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude)
                    : "Location Not Found";

                $accepteduser = $this->getAcceptedUserDisplay($jobValue->uid_to);

                // Count media files
                $totalimages = $this->assignment->countFiles($jobValue->aid, "images");
                $totalvideos = $this->assignment->countFiles($jobValue->aid, "videos");
                $totaldocuments = $this->assignment->countFiles($jobValue->aid, "documents");

                // Action HTML
                $action = '<div class="panel-heading"><div class="dropdown"><button type="button" class="btn-link">' . $case_status . '</button></div></div>';

                // Status HTML
                $status = '<div class="panel-heading"><div class="dropdown"><input type="hidden" id="outgoing_status" class="outgoing" name="hidden" value="outgoing">';

                $status .= '<a href="' . base_url() . 'viewoutgoincasedetail?q=' . base64_encode($this->encryption->encrypt($jobValue->aid)) . '&data=' . $viewCaseUrl . '&type=outgoing" class="btn btn-outline-info" target="_blank" style="width:80%">View Case</a><br/>';
                if (empty($jobValue->receivedamount)) {
                    $status .= '<a href="#cancel_case" class="btn_danger btn-rounded btn-outline-danger" style="margin-top:10px;width:80%" data-toggle="modal" onclick="cancelJob(\'' . $jobValue->aid . '\')">Pay Now</a>';
                }
                $status .= '</div></div>';

                // Job-specific details
                $jobDetailsHtml = $this->getJobDetailsHTML($jobValue);

                // First column: Basic case info
                $caseInfo = 'AID: ' . $jobValue->aid . '<br>' .
                    '<span style="color:#e16123">My Reference No: ' . $jobValue->case_reference . '</span><br>' .
                    '<span style="color:#0884c7">Created Date: ' . $created . '</span>';

                $data[] = [$caseInfo, $accepteduser, $jobDetailsHtml, $action, $status];
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->assignment->countallOutgoingAssignement(),
                "recordsFiltered" => $this->assignment->countFilteredOutgoingAssignment($_POST),
                "data" => $data,
            ];

            echo json_encode($output);
        } else {
            $encrypted_json = $this->input->get('data');
            if ($encrypted_json) {
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    $data_array = json_decode($decrypted_json, true);
                    $data = [
                        'defaultcompany' => $data_array['defaultcompany'] ?? null,
                        'defaultdepartment' => $data_array['defaultdepartment'] ?? null,
                        'usertype' => $data_array['usertype'] ?? null,
                        'view' => "Outgoingcase case",
                    ];
                    $this->load->view("adminpanel/jobs/locationbasedjob/outgoingcase", $data);
                }
            }
        }
    }

    // Helper: Get status label
    private function getCaseStatusLabel($status)
    {
        $labels = [
            1 => ['Under Survey', 'info'],
            2 => ['Photo Upload', 'success'],
            3 => ['LOR Sent', 'success'],
            4 => ['FSR', 'success'],
            5 => ['Bill Generated', 'success'],
            6 => ['Waiting for TI', 'warning'],
            7 => ['Pending for Dispatch', 'warning'],
            8 => ['Dispatched', 'success'],
            11 => ['Cancelled', 'danger'],
        ];

        if (isset($labels[$status])) {
            [$label, $class] = $labels[$status];
            return "<span class=\"label label-{$class}\">{$label}</span>";
        }

        return '<span class="label label-default">Unknown</span>';
    }

    // Helper: Get user display
    private function getAcceptedUserDisplay($uid_to)
    {
        if ($uid_to == 0) {
            return '<span class="label label-warning">Waiting for investigator</span>';
        }

        $assignTo = $this->home->getuserdatabyid($uid_to);
        return nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n<span style=\"color:#0884c7\">" . $assignTo[0]['mobile'] . "</span>");
    }

    // Helper: Job Details HTML by nature of job
    private function getJobDetailsHTML($job)
    {
        $balance = empty($job->receivedamount) ? '0' : $job->receivedamount;
        $balanceColor = empty($job->receivedamount) ? 'red' : '#109d10';
        $balanceHtml = "<span style='color:{$balanceColor}'>Balance: {$balance}</span><br>";

        switch ($job->natureofjob) {
            case 8:
                return "{$job->investigator_type}<br>
                <span style='color:#e16123'>Language From: {$job->language_from}</span><br>
                <span style='color:#0884c7'>Language To: {$job->language_to}</span><br>
                {$balanceHtml}<span style='color:#b305b3'>Location: NIL</span>";

            case 12:
                return "{$job->investigator_type}<br>
                <span style='color:#e16123'>Name of Injury: {$job->affected_person}</span><br>
                <span style='color:#0884c7'>Date of Loss: {$job->loss_data}</span><br>
                {$balanceHtml}<span style='color:#b305b3'>Location: {$job->state}</span>";

            case 62:
                return "{$job->investigator_type}<br>
                <span style='color:#e16123'>Vehicle Number: {$job->vehicle_number}</span><br>
                <span style='color:#0884c7'>Date of Loss: {$job->loss_data}</span><br>
                {$balanceHtml}<span style='color:#b305b3'>Location: {$job->state}</span>";

            case 77:
                return "{$job->investigator_type}<br>
                <span style='color:#e16123'>Name of Firm: {$job->firm_name}</span><br>
                <span style='color:#0884c7'>Type of Valuation: {$job->valuation_type}</span><br>
                {$balanceHtml}<span style='color:#b305b3'>Location: {$job->state}</span>";

            case 24:
                return "{$job->investigator_type}<br>
                <span style='color:#e16123'>Consignor: {$job->consignor}</span><br>
                {$balanceHtml}<span style='color:#b305b3'>Location: {$job->state}</span>";

            default:
                return "<span style='color:#888'>Default view for natureofjob {$job->natureofjob}</span>";
        }
    }


    /* ------------------------------------------------------------------------- *
	* GET COMPLETED ASSIGNMENT
	* ------------------------------------------------------------------------- */
    public function getCompletedAssignment()
    {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {

                $data = array();
                $cancel = null;
                $jobData = $this->assignment->fetchCompletedAssignment($_POST);
                $accepteduser = null;
                $i = $_POST['start'];
                foreach ($jobData as $jobValue) {
                    $insureddata = json_decode($jobValue->jobdata);
                    $i++;
                    $case_status = null;
                    if ($jobValue->status == 1) {
                        $case_status = '<span class="label label-info">Under Survey</span>';
                    } else if ($jobValue->status == 2) {
                        $case_status = '<span class="label label-success">Photo Upload</span>';
                    } else if ($jobValue->status == 3) {
                        $case_status = '<span class="label label-success">LOR Sent</span>';
                    } else if ($jobValue->status == 4) {
                        $case_status = '<span class="label label-success">FSR</span>';
                    } else if ($jobValue->status == 5) {
                        $case_status = '<span class="label label-success">Bill Generated</span>';
                    } else if ($jobValue->status == 6) {
                        $case_status = '<span class="label label-warning">Waiting for TI</span>';
                    } else if ($jobValue->status == 7) {
                        $case_status = '<span class="label label-warning">Pending for Dispatch</span>';
                    } else if ($jobValue->status == 8) {
                        $case_status = '<span class="label label-success">Dispatched</span>';
                    } else if ($jobValue->status == 11) {
                        $case_status = '<span class="label label-danger">Cancelled</span>';
                        $cancelReason = $this->assignment->getCancelReason($jobValue->aid);
                    } else if ($jobValue->status == 10) {
                        $case_status = '<span class="label label-success">Case Completed</span>';
                    }
                    if ($jobValue->uid_to != 0) {
                        $assignTo = $this->home->getuserdatabyid($jobValue->uid_to);
                        $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#0884c7">' . $assignTo[0]['mobile'] . '</span>');
                    } else {
                        $accepteduser = '<span class="label label-warning">Waiting</span>';
                    }
                    $created = date('Y/m/d H:i', strtotime($jobValue->createdAt));
                    $data[] = array(
                        nl2br($jobValue->aid . "\n" . '<span style="color:#0884c7">' . $created . '</span>'),
                        $jobValue->case_reference,
                        $accepteduser,
                        nl2br($jobValue->investigator_type . "\n" . 'Insured Name: <span style="color:#0884c7">' . $insureddata->contact_person_name . '</span>' . "\n" . 'Contact no: <span style="color:#0884c7">' . $insureddata->contact_person_mobile . '</span>'),
                        $case_status
                    );
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->assignment->countallCompletedAssignment(),
                    "recordsFiltered" => $this->assignment->countFilteredCompletedAssignment($_POST),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                $encrypted_json = $this->input->get('data');
                if ($encrypted_json) {
                    // Decrypt the JSON string
                    $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));

                    if ($decrypted_json) {
                        // Decode the JSON string back into an array
                        $data_array = json_decode($decrypted_json, true);

                        // Access the individual values
                        $defaultcompany = $data_array['defaultcompany'] ?? null;
                        $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                        $usertype = $data_array['usertype'] ?? null;

                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'view' => "Incoming case",
                        ];
                        $this->load->view("adminpanel/jobs/locationbasedjob/completedcase", $data);
                    }
                }
            }
        } else {
            redirect('user_logout');
        }
    }

    /*------------------------------------------------------------------------- *
    * CANCEL INCOMING ASSIGNMENT (BY NANDINI)
    *------------------------------------------------------------------------- */
    public function cancelassignment()
    {
        if (isset($_POST['cancel_reason']) && isset($_POST['aid'])) {
            $cancel_reason = $_POST['cancel_reason'];
            $aid = $_POST['aid'];
            if (!empty($aid) && !empty($cancel_reason)) {
                $data = array(
                    'reasonforcancel' => $cancel_reason,
                    'status' => 11,
                );
                $updateStatus = $this->assignment->updateAssignmentStatus($aid, $data);
                if ($updateStatus) {
                    $updatedCancelReason = $this->assignment->getCancelReason($aid);
                    echo json_encode(array('status' => 'success', 'cancelReason' => $updatedCancelReason));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Failed to cancel the case.'));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid data.'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Missing data.'));
        }
    }

    public function createOutgoingAssignment()
    {
        if ($this->session->userdata('id') != null) {
            $encrypted_json = $this->input->get('data');
            if ($encrypted_json) {
                // Decrypt the JSON string
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    // Decode the JSON string back into an array
                    $data_array = json_decode($decrypted_json, true);

                    // Access the individual values
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;

                    $data = [
                        'url' => $encrypted_json,
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'view' => "Incoming case",
                    ];
                    $this->load->view('adminpanel/jobs/outgoingassignment/createoutgoingcase', $data);
                }
            }
        } else {
            redirect('user_logout');
        }
    }


    /* ------------------------------------------------------------------------- *
    * GET OUTGOING ASSIGNMENT FOR INDIVIDUALS (BY KAJAL)
    * ------------------------------------------------------------------------- */
    public function documentsTranslation()
    {
        if ($this->session->userdata('id') != null) {

            $encrypted_json = $this->input->get('data') ?? $this->input->post('encrypted_data');

            $defaultcompany = null;
            $defaultdepartment = null;
            $usertype = null;

            if ($encrypted_json) {
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    $data_array = json_decode($decrypted_json, true);
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;
                } else {
                    show_error('Decryption failed.');
                    return;
                }
            } else {
                show_error('No encrypted data provided.');
                return;
            }

            if ($this->input->method() === 'post') {

                // Set validation rules
                $this->form_validation->set_rules('language_list_from', 'Language From', 'required');
                $this->form_validation->set_rules('language_list_to', 'Language To', 'required');
                $this->form_validation->set_rules('natureofjob', 'Nature of Job', 'required');
                $this->form_validation->set_rules('case_reference', 'Case Reference', 'required');

                if ($this->form_validation->run() === FALSE) {
                    $response = [
                        "status" => 400,
                        "message" => validation_errors()
                    ];
                    echo json_encode($response);
                    return;
                }

                // Prepare case data from POST request
                $case_data = $this->input->post();

                // Prepare job data
                $jobdata = array_filter([
                    'language_from' => $case_data['language_list_from'] ?? null,
                    'language_to' => $case_data['language_list_to'] ?? null,
                    'totalfile' => $case_data['totalfile'] ?? null,
                    'totalpages' => $case_data['totalpages'] ?? null,
                ], fn($value) => !is_null($value) && $value !== '');

                // Data to insert
                $data = [
                    'aid' => date("dmyhis") . rand(10, 100),
                    'userId' => $this->session->userdata('id'),
                    'natureofjob' => $case_data['natureofjob'],
                    'case_reference' => $case_data['case_reference'],
                    'jobdata' => json_encode($jobdata),
                    'status' => "1",
                ];

                // Create outgoing case
                $result = $this->assignment->createoutgoingcase($data);

                if (!empty($result['aid'])) {

                    $uploadDirs = ['images', 'videos', 'documents', 'reports'];
                    foreach ($uploadDirs as $dir) {
                        $uploadPath = './uploads/' . $result['aid'] . '/' . $dir;
                        if (!is_dir($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
                    }



                    $natureofjob = $case_data['natureofjob'];
                    $casedata = $this->case_model->getCosting($natureofjob);

                    if ($casedata !== false) {
                        $totalpages = $case_data['totalpages'] ?? 0;
                        $amount = $casedata['rate'] * $totalpages;
                        $rate = $casedata['rate'];
                        $aid = $result['aid']; // Correct aid from the created case
                        $casename = $casedata['investigator_type'];
                        $checkoutData = $this->checkout($amount, $defaultcompany, $defaultdepartment, $usertype, $aid);
                    } else {
                        $amount = 0;
                    }

                    if (!empty($amount)) {
                        $jobassigned = [
                            "aid" => $result['aid'],
                            "uid_from" => $this->session->userdata('id'),
                            "totalamount" => $amount
                        ];

                        $jobassign = $this->assignment->outgoingjobassignTo($jobassigned);

                        if ($jobassign) {
                            // Combine all necessary data
                            $alldata = [
                                'aid' => $result['aid'],
                                'natureofjob' => $case_data['natureofjob'],
                                'totalfile' => $case_data['totalfile'],
                                'totalpages' => $case_data['totalpages'],
                                'casetype' => "1", // 1 = outgoing case
                                'totalamount' => $amount,
                                'rate' => $rate,
                                'defaultcompany' => $defaultcompany,
                                'casename' => $casename,
                                'defaultdepartment' => $defaultdepartment,
                                'usertype' => $usertype,
                                'checkoutdata' => $checkoutData
                            ];


                            // Encrypt
                            $alldata_json = json_encode($alldata);
                            $encrypted_data = urlencode(base64_encode($this->encryption->encrypt($alldata_json)));

                            $response = [
                                "status" => 200,
                                "message" => "Job created and assigned successfully.",
                                "data" => [
                                    'url' => $encrypted_data,
                                    'case_data' => $case_data
                                ]
                            ];
                            echo json_encode($response);
                            return;
                        } else {
                            $response = [
                                "status" => 500,
                                "message" => "Failed to assign job."
                            ];
                            echo json_encode($response);
                            return;
                        }
                    } else {
                        $response = [
                            "status" => 500,
                            "message" => "Failed to calculate amount."
                        ];
                        echo json_encode($response);
                        return;
                    }
                } else {
                    $response = [
                        "status" => 500,
                        "message" => "Internal Server Error. Job creation failed."
                    ];
                    echo json_encode($response);
                    return;
                }
            } else {

                $data = [
                    'url' => $encrypted_json,
                    'defaultcompany' => $defaultcompany,
                    'defaultdepartment' => $defaultdepartment,
                    'usertype' => $usertype,
                    'view' => "Incoming case",
                ];
                $this->load->view('adminpanel/outgoingcases/document_translation_form', $data);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function ebdeathIndivi()
    {
        if ($this->session->userdata('id') == null) {
            redirect('user_logout');
            return;
        }

        // Handle both GET and POST for encrypted data
        $encrypted_json = $this->input->get('data') ?? $this->input->post('encrypted_data');
        $defaultcompany = null;
        $defaultdepartment = null;
        $usertype = null;

        if ($encrypted_json) {
            $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
            if ($decrypted_json) {
                $data_array = json_decode($decrypted_json, true);
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;
            } else {
                show_error('Decryption failed.');
                return;
            }
        } else {
            show_error('No encrypted data provided.');
            return;
        }

        if ($this->input->method() === 'post') {
            // Set validation rules
            $this->form_validation->set_rules('salutation', 'Salutation', 'required');
            $this->form_validation->set_rules('contact_person_name', 'Full Name', 'required');
            $this->form_validation->set_rules('contact_person_mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('case_reference', 'Case Reference', 'required');
            $this->form_validation->set_rules('available_at_location', 'Language To', 'required');
            $this->form_validation->set_rules('affected_person', 'Name of Affected Person', 'required');
            $this->form_validation->set_rules('natureofjob', 'Nature of Job', 'required');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    "status" => 400,
                    "message" => validation_errors()
                ]);
                return;
            }

            $case_data = $this->input->post();

            $jobdata = array_filter([
                'salutation' => $case_data['salutation'],
                'contact_person_name' => $case_data['contact_person_name'],
                'contact_person_mobile' => $case_data['contact_person_mobile'],
                'case_reference' => $case_data['case_reference'],
                'available_at_location' => $case_data['available_at_location'],
                'whatsapp_number' => $case_data['whatsapp_number'] ?? null,
                'insured_name' => $case_data['insured_name'] ?? null,
                'loss_item' => $case_data['loss_item'] ?? null,
                'policyNumber' => $case_data['policyNumber'] ?? null,
                'cause_loss' => $case_data['cause_loss'] ?? null,
                'natureofjob' => $case_data['natureofjob'],
                'affected_person' => $case_data['affected_person'],
                'loss_data' => $case_data['loss_data'] ?? null,
                'nature_loss' => $case_data['nature_loss'] ?? null,
                'state' => $case_data['state'] ?? null,
            ], fn($val) => !is_null($val) && $val !== '');

            $data = [
                'aid' => date("dmyhis") . rand(10, 100),
                'userId' => $this->session->userdata('id'),
                'natureofjob' => $case_data['natureofjob'],
                'case_reference' => $case_data['case_reference'],
                'jobdata' => json_encode($jobdata),
                'status' => "1",
            ];

            $result = $this->assignment->createoutgoingcase($data);

            if (!empty($result['aid'])) {
                // Folder creation
                $uploadDirs = ['images', 'videos', 'documents', 'reports'];
                foreach ($uploadDirs as $dir) {
                    $uploadPath = './uploads/' . $result['aid'] . '/' . $dir;
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                }

                // Costing & assignment
                $natureofjob = $case_data['natureofjob'];
                $casedata = $this->case_model->getCosting($natureofjob);

                if ($casedata !== false && isset($casedata['rate'])) {
                    $rate = (float) str_replace(',', '', $casedata['rate']);
                    $totalpages = 1;
                    $totalfile = 1;
                    $amount = $rate * $totalpages;
                    $aid = $result['aid'];
                    $casename = $casedata['investigator_type'] ?? 'Unknown';
                    $checkoutData = $this->checkout($amount, $defaultcompany, $defaultdepartment, $usertype, $aid);
                } else {
                    $amount = 0;
                }

                if (!empty($amount)) {
                    $jobassigned = [
                        "aid" => $result['aid'],
                        "uid_from" => $this->session->userdata('id'),
                        "totalamount" => $amount
                    ];

                    $jobassign = $this->assignment->outgoingjobassignTo($jobassigned);

                    if ($jobassign) {
                        $alldata = [
                            'aid' => $result['aid'],
                            'natureofjob' => $case_data['natureofjob'],
                            'totalfile' => $totalfile,
                            'totalpages' => $totalpages,
                            'casetype' => "1",
                            'totalamount' => $amount,
                            'rate' => $rate,
                            'defaultcompany' => $defaultcompany,
                            'casename' => $casename,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'checkoutdata' => $checkoutData
                        ];

                        $alldata_json = json_encode($alldata);
                        $encrypted_data = urlencode(base64_encode($this->encryption->encrypt($alldata_json)));

                        echo json_encode([
                            "status" => 200,
                            "message" => "Job created and assigned successfully.",
                            "data" => [
                                'url' => $encrypted_data,
                                'case_data' => $case_data
                            ]
                        ]);
                        return;
                    } else {
                        echo json_encode([
                            "status" => 500,
                            "message" => "Failed to assign job."
                        ]);
                        return;
                    }
                } else {
                    echo json_encode([
                        "status" => 500,
                        "message" => "Failed to calculate amount."
                    ]);
                    return;
                }
            } else {
                echo json_encode([
                    "status" => 500,
                    "message" => "Internal Server Error. Job creation failed.",
                    "debug" => $result // Optional: help during testing
                ]);
                return;
            }
        } else {
            $data = [
                'url' => $encrypted_json,
                'defaultcompany' => $defaultcompany,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'view' => "Incoming case"
            ];
            $this->load->view('adminpanel/outgoingcases/ebdeath', $data);
        }
    }

    public function motorspotsurveyIndi()
    {
        if ($this->session->userdata('id') == null) {
            redirect('user_logout');
            return;
        }

        // Handle both GET and POST for encrypted data
        $encrypted_json = $this->input->get('data') ?? $this->input->post('encrypted_data');
        $defaultcompany = null;
        $defaultdepartment = null;
        $usertype = null;

        if ($encrypted_json) {
            $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
            if ($decrypted_json) {
                $data_array = json_decode($decrypted_json, true);
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;
            } else {
                show_error('Decryption failed.');
                return;
            }
        } else {
            show_error('No encrypted data provided.');
            return;
        }

        if ($this->input->method() === 'post') {
            // Validate form
            $this->form_validation->set_rules('salutation', 'Salutation', 'required');
            $this->form_validation->set_rules('contact_person_name', 'Full Name', 'required');
            $this->form_validation->set_rules('contact_person_mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('case_reference', 'Case Reference', 'required');
            $this->form_validation->set_rules('available_at_location', 'Language To', 'required');
            $this->form_validation->set_rules('natureofjob', 'Nature of Job', 'required');
            $this->form_validation->set_rules('search_inspector', 'Search Surveyor', 'required');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    "status" => 400,
                    "message" => validation_errors()
                ]);
                return;
            }

            $case_data = $this->input->post();

            // Prepare job data
            $jobdata = array_filter([
                'salutation' => $case_data['salutation'] ?? null,
                'contact_person_name' => $case_data['contact_person_name'] ?? null,
                'contact_person_mobile' => $case_data['contact_person_mobile'] ?? null,
                'case_reference' => $case_data['case_reference'] ?? null,
                'available_at_location' => $case_data['available_at_location'] ?? null,
                'whatsapp_number' => $case_data['whatsapp_number'] ?? null,
                'insured_name' => $case_data['insured_name'] ?? null,
                'policyNumber' => $case_data['policyNumber'] ?? null,
                'cause_loss' => $case_data['cause_loss'] ?? null,
                'natureofjob' => $case_data['natureofjob'] ?? null,
                'loss_data' => $case_data['loss_data'] ?? null,
                'nature_loss' => $case_data['nature_loss'] ?? null,
                'state' => $case_data['state'] ?? null,
                'address' => $case_data['address'] ?? null,
                'prvt_cmrcl' => $case_data['prvt_cmrcl'] ?? null,
                'type_of_vehicle' => $case_data['type_of_vehicle'] ?? null,
                'vehicle_number' => $case_data['vehicle_number'] ?? null,
                'other_type' => $case_data['other_type'] ?? null,
            ], fn($val) => !is_null($val) && $val !== '');

            $data = [
                'aid' => date("dmyhis") . rand(10, 100),
                'userId' => $this->session->userdata('id'),
                'natureofjob' => $case_data['natureofjob'],
                'case_reference' => $case_data['case_reference'],
                'jobdata' => json_encode($jobdata),
                'status' => "1",
            ];

            $result = $this->assignment->createoutgoingcase($data);

            if (!empty($result['aid'])) {
                // Create folders
                $uploadDirs = ['images', 'videos', 'documents', 'reports'];
                foreach ($uploadDirs as $dir) {
                    $uploadPath = './uploads/' . $result['aid'] . '/' . $dir;
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                }

                // Costing
                $casedata = $this->case_model->getCosting($case_data['natureofjob']);
                if ($casedata !== false && isset($casedata['rate'])) {
                    $rate = (float)str_replace(',', '', $casedata['rate']);
                    $totalpages = 1;
                    $totalfile = 1;
                    $amount = $rate * $totalpages;
                    $aid = $result['aid'];
                    $casename = $casedata['investigator_type'] ?? 'Unknown';
                    $checkoutData = $this->checkout($amount, $defaultcompany, $defaultdepartment, $usertype, $aid);
                } else {
                    $amount = 0;
                }

                if (!empty($amount)) {
                    $jobassigned = [
                        "aid" => $result['aid'],
                        "uid_from" => $this->session->userdata('id'),
                        "totalamount" => $amount
                    ];

                    $jobassign = $this->assignment->outgoingjobassignTo($jobassigned);

                    if ($jobassign) {
                        $alldata = [
                            'aid' => $result['aid'],
                            'natureofjob' => $case_data['natureofjob'],
                            'totalfile' => $totalfile,
                            'totalpages' => $totalpages,
                            'casetype' => "1",
                            'totalamount' => $amount,
                            'rate' => $rate,
                            'defaultcompany' => $defaultcompany,
                            'casename' => $casename,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'checkoutdata' => $checkoutData
                        ];

                        $alldata_json = json_encode($alldata);
                        $encrypted_data = urlencode(base64_encode($this->encryption->encrypt($alldata_json)));

                        echo json_encode([
                            "status" => 200,
                            "message" => "Job created and assigned successfully.",
                            "data" => [
                                'url' => $encrypted_data,
                                'case_data' => $case_data
                            ]
                        ]);
                        return;
                    } else {
                        echo json_encode([
                            "status" => 500,
                            "message" => "Failed to assign job."
                        ]);
                        return;
                    }
                } else {
                    echo json_encode([
                        "status" => 500,
                        "message" => "Failed to calculate amount."
                    ]);
                    return;
                }
            } else {
                echo json_encode([
                    "status" => 500,
                    "message" => "Internal Server Error. Job creation failed."
                ]);
                return;
            }
        } else {
            // GET method: load the form view
            $data = [
                'url' => $encrypted_json,
                'defaultcompany' => $defaultcompany,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'view' => "Incoming case"
            ];
            $this->load->view('adminpanel/outgoingcases/motorspot', $data);
        }
    }

    public function assetvaluationIndivi()
    {
        if ($this->session->userdata('id') == null) {
            redirect('user_logout');
            return;
        }

        // Handle encrypted data in GET or POST
        $encrypted_json = $this->input->get('data') ?? $this->input->post('encrypted_data');

        $defaultcompany = null;
        $defaultdepartment = null;
        $usertype = null;

        // Decrypt data if exists
        if ($encrypted_json) {
            $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
            if ($decrypted_json) {
                $data_array = json_decode($decrypted_json, true);
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;
            } else {
                show_error('Decryption failed.');
                return;
            }
        } else {
            show_error('No encrypted data provided.');
            return;
        }

        if ($this->input->method() === 'post') {
            // Form validation rules
            $this->form_validation->set_rules('salutation', 'Salutation', 'required');
            $this->form_validation->set_rules('contact_person_name', 'Full Name', 'required');
            $this->form_validation->set_rules('contact_person_mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('case_reference', 'Case Reference', 'required');
            $this->form_validation->set_rules('available_at_location', 'Location', 'required');
            $this->form_validation->set_rules('natureofjob', 'Nature of Job', 'required');
            $this->form_validation->set_rules('search_inspector', 'Search Surveyor', 'required');


            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    "status" => 400,
                    "message" => validation_errors()
                ]);
                return;
            }

            // Prepare case data
            $case_data = $this->input->post();

            // Prepare job data
            $jobdata = array_filter([
                'salutation' => $case_data['salutation'] ?? null,
                'contact_person_name' => $case_data['contact_person_name'] ?? null,
                'contact_person_mobile' => $case_data['contact_person_mobile'] ?? null,
                'case_reference' => $case_data['case_reference'] ?? null,
                'available_at_location' => $case_data['available_at_location'] ?? null,
                'whatsapp_number' => $case_data['whatsapp_number'] ?? null,
                'valuation_type' => $case_data['valuation_type'] ?? null,
                'visitdate' => $case_data['visitdate'] ?? null,
                'firm_name' => $case_data['firm_name'] ?? null,
                'address' => $case_data['address'] ?? null,
                'state' => $case_data['state'] ?? null,
                'asset_value' => $case_data['asset_value'] ?? null,
            ], fn($val) => $val !== null && $val !== '');

            // Data to insert into the database
            $data = [
                'aid' => date("dmyhis") . rand(10, 100),
                'userId' => $this->session->userdata('id'),
                'natureofjob' => $case_data['natureofjob'],
                'case_reference' => $case_data['case_reference'],
                'jobdata' => json_encode($jobdata),
                'status' => "1",
            ];

            // Create an outgoing case
            $result = $this->assignment->createoutgoingcase($data);

            if (empty($result['aid'])) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Internal Server Error. Job creation failed."
                ]);
                return;
            }

            // Create upload directories
            foreach (['images', 'videos', 'documents', 'reports'] as $dir) {
                $uploadPath = "./uploads/{$result['aid']}/$dir";
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
            }

            $natureofjob = $case_data['natureofjob'];
            $casedata = $this->case_model->getCosting($natureofjob);

            if ($casedata !== false && isset($casedata['rate'])) {
                $rate = (float) str_replace(',', '', $casedata['rate']);
                $totalpages = 1;
                $totalfile = 1;
                $amount = $rate * $totalpages;
                $aid = $result['aid'];
                $casename = $casedata['investigator_type'] ?? 'Unknown';

                $checkoutData = $this->checkout($amount, $defaultcompany, $defaultdepartment, $usertype, $aid);
            } else {
                $amount = 0;
            }

            if (empty($amount)) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to calculate amount."
                ]);
                return;
            }

            $jobassigned = [
                "aid" => $result['aid'],
                "uid_from" => $this->session->userdata('id'),
                "totalamount" => $amount
            ];

            $jobassign = $this->assignment->outgoingjobassignTo($jobassigned);

            if (!$jobassign) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to assign job."
                ]);
                return;
            }

            // Prepare final response data
            $alldata = [
                'aid' => $result['aid'],
                'natureofjob' => $case_data['natureofjob'],
                'totalfile' => $totalfile,
                'totalpages' => $totalpages,
                'casetype' => "1",
                'totalamount' => $amount,
                'rate' => $rate,
                'defaultcompany' => $defaultcompany,
                'casename' => $casename,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'checkoutdata' => $checkoutData
            ];

            // Encrypt and encode the response data
            $alldata_json = json_encode($alldata);
            $encrypted_data = urlencode(base64_encode($this->encryption->encrypt($alldata_json)));

            echo json_encode([
                "status" => 200,
                "message" => "Job created and assigned successfully.",
                "data" => [
                    'url' => $encrypted_data,
                    'case_data' => $case_data
                ]
            ]);
        } else {
            // Handle the GET method to render the form
            $data = [
                'url' => $encrypted_json,
                'defaultcompany' => $defaultcompany,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'view' => "Incoming case",
            ];
            $this->load->view('adminpanel/outgoingcases/assetsvaluation', $data);
        }
    }

    public function marinepredisIndivi()
    {
        if ($this->session->userdata('id') == null) {
            redirect('user_logout');
            return;
        }

        // Handle encrypted data in GET or POST
        $encrypted_json = $this->input->get('data') ?? $this->input->post('encrypted_data');

        $defaultcompany = null;
        $defaultdepartment = null;
        $usertype = null;

        // Decrypt data if exists
        if ($encrypted_json) {
            $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
            if ($decrypted_json) {
                $data_array = json_decode($decrypted_json, true);
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;
            } else {
                show_error('Decryption failed.');
                return;
            }
        } else {
            show_error('No encrypted data provided.');
            return;
        }

        if ($this->input->method() === 'post') {
            // Form validation rules
            $this->form_validation->set_rules('salutation', 'Salutation', 'required');
            $this->form_validation->set_rules('contact_person_name', 'Full Name', 'required');
            $this->form_validation->set_rules('contact_person_mobile', 'Mobile Number', 'required');
            $this->form_validation->set_rules('case_reference', 'Case Reference', 'required');
            $this->form_validation->set_rules('available_at_location', 'Location', 'required');
            $this->form_validation->set_rules('natureofjob', 'Nature of Job', 'required');
            $this->form_validation->set_rules('search_inspector', 'Search Surveyor', 'required');


            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    "status" => 400,
                    "message" => validation_errors()
                ]);
                return;
            }

            // Prepare case data
            $case_data = $this->input->post();

            // Prepare job data
            $jobdata = array_filter([
                'salutation' => $case_data['salutation'] ?? null,
                'contact_person_name' => $case_data['contact_person_name'] ?? null,
                'contact_person_mobile' => $case_data['contact_person_mobile'] ?? null,
                'case_reference' => $case_data['case_reference'] ?? null,
                'available_at_location' => $case_data['available_at_location'] ?? null,
                'whatsapp_number' => $case_data['whatsapp_number'] ?? null,
                'consignor' => $case_data['consignor'] ?? null,
                'name_of_commodity' => $case_data['name_of_commodity'] ?? null,
                'invoices' => $case_data['invoices'] ?? null
            ], fn($val) => $val !== null && $val !== '');

            // Data to insert into the database
            $data = [
                'aid' => date("dmyhis") . rand(10, 100),
                'userId' => $this->session->userdata('id'),
                'natureofjob' => $case_data['natureofjob'],
                'case_reference' => $case_data['case_reference'],
                'jobdata' => json_encode($jobdata),
                'status' => "1",
            ];

            // Create an outgoing case
            $result = $this->assignment->createoutgoingcase($data);

            if (empty($result['aid'])) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Internal Server Error. Job creation failed."
                ]);
                return;
            }

            // Create upload directories
            foreach (['images', 'videos', 'documents', 'reports'] as $dir) {
                $uploadPath = "./uploads/{$result['aid']}/$dir";
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
            }

            $natureofjob = $case_data['natureofjob'];
            $casedata = $this->case_model->getCosting($natureofjob);

            if ($casedata !== false && isset($casedata['rate'])) {
                $rate = (float) str_replace(',', '', $casedata['rate']);
                $totalpages = 1;
                $totalfile = 1;
                $amount = $rate * $totalpages;
                $aid = $result['aid'];
                $casename = $casedata['investigator_type'] ?? 'Unknown';

                $checkoutData = $this->checkout($amount, $defaultcompany, $defaultdepartment, $usertype, $aid);
            } else {
                $amount = 0;
            }

            if (empty($amount)) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to calculate amount."
                ]);
                return;
            }

            $jobassigned = [
                "aid" => $result['aid'],
                "uid_from" => $this->session->userdata('id'),
                "totalamount" => $amount
            ];

            $jobassign = $this->assignment->outgoingjobassignTo($jobassigned);

            if (!$jobassign) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to assign job."
                ]);
                return;
            }

            // Prepare final response data
            $alldata = [
                'aid' => $result['aid'],
                'natureofjob' => $case_data['natureofjob'],
                'totalfile' => $totalfile,
                'totalpages' => $totalpages,
                'casetype' => "1",
                'totalamount' => $amount,
                'rate' => $rate,
                'defaultcompany' => $defaultcompany,
                'casename' => $casename,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'checkoutdata' => $checkoutData
            ];

            // Encrypt and encode the response data
            $alldata_json = json_encode($alldata);
            $encrypted_data = urlencode(base64_encode($this->encryption->encrypt($alldata_json)));

            echo json_encode([
                "status" => 200,
                "message" => "Job created and assigned successfully.",
                "data" => [
                    'url' => $encrypted_data,
                    'case_data' => $case_data
                ]
            ]);
        } else {
            // Handle the GET method to render the form
            $data = [
                'url' => $encrypted_json,
                'defaultcompany' => $defaultcompany,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'view' => "Incoming case",
            ];
            $this->load->view('adminpanel/outgoingcases/marinepredispatch', $data);
        }
    }


    /* ------------------------------------------------------------------------- *
    * GET OUTGOING ASSIGNMENT (BY KAJAL)
    * ------------------------------------------------------------------------- */

    public function calculated_amount()
    {
        $this->load->helper('url');
        $this->load->library('encryption');
        $encrypted_data = $this->input->get('data');
        if (!empty($encrypted_data)) {
            $base64_decoded = base64_decode(urldecode($encrypted_data));
            $decrypted_json = $this->encryption->decrypt($base64_decoded);

            if ($decrypted_json) {

                $data_array = json_decode($decrypted_json, true);

                $data = [
                    'aid' => $data_array['aid'] ?? '',
                    'natureofjob' => $data_array['natureofjob'] ?? '',
                    'totalfile' => $data_array['totalfile'] ?? '',
                    'rate' => $data_array['rate'] ?? '',
                    'casename' => $data_array['casename'] ?? '',
                    'totalpages' => $data_array['totalpages'] ?? '',
                    'casetype' => $data_array['casetype'] ?? '',
                    'totalamount' => $data_array['totalamount'] ?? '',
                    'defaultcompany' => $data_array['defaultcompany'] ?? '',
                    'defaultdepartment' => $data_array['defaultdepartment'] ?? '',
                    'usertype' => $data_array['usertype'] ?? '',
                    'checkoutdata' => $data_array['checkoutdata'] ?? '',
                    'view' => 'Documents Translation'
                ];



                $this->load->view('adminpanel/outgoingcases/calculated_amount', $data);
            } else {

                show_error('Invalid data received.', 400);
            }
        } else {

            show_error('No data found.', 400);
        }
    }


    /* ------------------------------------------------------------------------- *
    * SABPAISA PAYMENT GATEWAY 
    * ------------------------------------------------------------------------- */
    public function checkout($amount, $defaultcompany, $defaultdepartment, $usertype, $aid)
    {
        if ($this->session->userdata('id') != null) {

            $userid = $this->session->userdata('id');

            $clientCode = 'DCRBP';
            $username = 'userph.jha_3036';
            $password = 'DBOI1_SP3036';
            $authKey = '0jeOYcu3UnfmWyLC';
            $authIV = 'C28LAmGxXTqmK0QJ';
            $channelId = 'W';

            $billingaddress1 = "C-56";
            $billingaddress2 = "Sector 8 Noida";
            $billingstate = "Uttar Pradesh";
            $billingcity = "Noida";
            $billingpincode = "201301";
            $payerName = "Arpit Singh";
            $payerEmail = "arpitsingh791@gmail.com";
            $payerMobile = "+918619589872";
            $amount = 10;
            $payerAddress = "$billingaddress1 $billingaddress2 $billingstate $billingcity $billingpincode";

            $clientTxnId = sprintf('%015d', mt_rand(0, 999999999999999));

            $callbackUrl = base_url('assignment/sabpaisaresponse');

            $encData = "?clientCode=$clientCode"
                . "&transUserName=$username"
                . "&transUserPassword=$password"
                . "&clientTxnId=$clientTxnId"
                . "&callbackUrl=$callbackUrl"
                . "&channelId=$channelId"
                . "&payerName=$payerName"
                . "&payerEmail=$payerEmail"
                . "&payerMobile=$payerMobile"
                . "&payerAddress=$payerAddress"
                . "&amount=$amount"
                . "&amountType=INR"
                . "&udf1=$defaultcompany"
                . "&udf2=$defaultdepartment"
                . "&udf3=$usertype"
                . "&udf4=$userid"
                . "&udf5=$aid";

            $data['encryptedData'] = $this->encrypt($authKey, $authIV, $encData);

            // Additional frontend data (optional)
            $data['clientCode'] = $clientCode;
            $data['amount'] = $amount;
            $data['amountType'] = 'INR';
            $data['platform_fee'] = $amount * 0.02;
            $data['gst'] = $amount * 0.18;
            $data['payerName'] = $payerName;
            $data['payerEmail'] = $payerEmail;
            $data['payerMobile'] = $payerMobile;
            $data['payerAddress'] = $payerAddress;
            $data['userid'] = $userid;
            $data['defaultcompany'] = $defaultcompany;
            $data['defaultdepartment'] = $defaultdepartment;
            $data['usertype'] = $usertype;
            $data['aid'] = $aid;

            return $data;
        } else {
            redirect('user_logout');
        }
    }


    public function makepayment()
    {
        $data['encryptedData'] = $this->input->get('enrxceptdata');
        $data['clientCode'] = $this->input->get('client');
        $data['cartitem'] = $this->cart_model->get_cart_items();
        $this->load->view('web/makepayment', $data);
    }

    private  function fixKey($key)
    {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            return str_pad("$key", $this->CIPHER_KEY_LEN, "0");
        }

        if (strlen($key) > $this->CIPHER_KEY_LEN) {
            return substr($key, 0, $this->CIPHER_KEY_LEN);
        }
        return $key;
    }

    private function encrypt($key, $iv, $data)
    {
        //echo 'Data value is :' .$data;
        //echo "<br>";
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $this->fixKey($key), OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData . ":" . $encodedIV;
        //echo '$encryptedPayload value is :' .$encryptedPayload;
        return $encryptedPayload;
    }

    private function decrypt($key, $iv, $data)
    {
        $parts = explode(':', $data);
        $encrypted = $parts[0];
        $iv = $parts[1];
        $decryptedData = openssl_decrypt(base64_decode($encrypted), $this->OPENSSL_CIPHER_NAME, $this->fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));
        return $decryptedData;
    }


    public function sabpaisaresponse()
    {
        // Get the encrypted response from SabPaisa
        $query = $_REQUEST['encResponse'] ?? '';

        // SabPaisa decryption keys
        $authKey = '0jeOYcu3UnfmWyLC';
        $authIV = 'C28LAmGxXTqmK0QJ';

        // Decrypt the response
        $decText = $this->decrypt($authKey, $authIV, $query);

        // Split the decrypted response into key-value pairs
        $fields = explode("&", $decText);
        $values = [];

        foreach ($fields as $field) {
            list($key, $value) = explode("=", $field, 2);
            $values[] = $value;
        }

        // Assign fields by position (1-based)
        $payerName = $values[0] ?? null;
        $payerEmail = $values[1] ?? null;
        $payerMobile = $values[2] ?? null;
        $clientTxnId = $values[3] ?? null;
        $payerAddress = $values[4] ?? null;
        $amount = $values[5] ?? null;
        $clientCode = $values[6] ?? null;
        $paidAmount = $values[7] ?? null;
        $paymentMode = $values[8] ?? null;
        $bankName = $values[9] ?? null;
        $amountType = $values[10] ?? null;
        $status = 1;
        $statusCode = $values[12] ?? null;
        $challanNumber = $values[13] ?? null;
        $sabpaisaTxnId = $values[14] ?? null;
        $sabpaisaMessage = $values[15] ?? null;
        $bankMessage = $values[16] ?? null;
        $bankErrorCode = $values[17] ?? null;
        $sabpaisaErrorCode = $values[18] ?? null;
        $bankTxnId = $values[19] ?? null;
        $transDate = $values[20] ?? null;
        $udf1 = $values[21] ?? null;  // defaultcompany
        $udf2 = $values[22] ?? null;  // defaultdepartment
        $udf3 = $values[23] ?? null;  // usertype
        $udf4 = $values[24] ?? null;  // userid
        $udf5 = $values[25] ?? null;  // aid

        // Calculate 5% service charge
        $serviceCharge = 0.05 * $paidAmount;

        $gstRate = 0.18;
        $gstAmount = $serviceCharge * $gstRate;

        // Split into CGST and SGST
        $cgst = $gstAmount / 2;
        $sgst = $gstAmount / 2;

        // Format the payment date to 'YYYY-MM-DD HH:MM:SS'
        $paymentAt = date('d F Y', strtotime($transDate));

        // JSON-formatted payer details
        $paymentintJson = json_encode([
            'payerName'    => $payerName,
            'payerEmail'   => $payerEmail,
            'payerMobile'  => $payerMobile,
            'payerAddress' => $payerAddress
        ]);

        // Prepare data to update the order
        $data = [
            'aid'            => $udf5,
            'paymentid'      => $sabpaisaTxnId,
            'paymentBy'      => $udf4,
            'paymentint'     => $paymentintJson,
            'receivedamount' => $paidAmount,
            'servicecharge'  => $serviceCharge,
            'cgst'           => $cgst,
            'sgst'           => $sgst,
            'paymentat'      => $paymentAt,
            'status'         => $status
        ];

        // Update the order with the payment details
        $update = $this->assignment->updateorder($data);

        $userdata = $this->home->getUserById($udf4);

        if ($update) {
            $session_data = array(
                "id"             => $userdata['id'],
                "salutation"     => $userdata['salutation'],
                "firstname"      => $userdata['firstname'],
                "lastname"       => $userdata['lastname'],
                "mobile"         => $userdata['mobile'],
                "alt_mobile"     => $userdata['alt_mobile'],
                "email"          => $userdata['email'],
                "state"          => $userdata['state'],
                "city"           => $userdata['city'],
                "address"        => $userdata['address'],
                "pincode"        => $userdata['pincode'],
                "profilephoto"   => $userdata['profilephoto'],
                "email_verified" => $userdata['email_verified'],
                "mobile_verified" => $userdata['mobile_verified'],
                "is_active"      => $userdata['is_active'],
                "usertype"       => $userdata['usertype'],
                "corporateId"    => $userdata['corporateId'],
                "app_user"       => $userdata['app_user'],
                "isLogin"        => "loggedIn"
            );

            $this->session->set_userdata($session_data);

            // Create the data array
            $data_array = [
                'defaultcompany' => $udf1,
                'defaultdepartment' => $udf2,
                'usertype' => $udf3
            ];
            $json_data = json_encode($data_array);
            $encrypted_json = base64_encode($this->encryption->encrypt($json_data));
            $url = base_url('outgoingassignment') . '?data=' . $encrypted_json;
            redirect($url);
        } else {
            // Log failure if the order update failed
            log_message('error', 'Failed to insert SabPaisa response.');
        }
    }


    public function success()
    {
        // $dateFormat = 'Y-m-d H:i:s';
        // $stripe = new \Stripe\StripeClient($this->config->item('stripe_secret')); 
        // $session_id = $this->input->get('session_id');
        // try { 
        //     $checkout_session = $stripe->checkout->sessions->retrieve($session_id); 
        // } catch(Exception $e) {  
        //     $api_error = $e->getMessage();
        // } 

        // $additionalcharges = $this->getadditionalcharges($checkout_session['amount_total']);
        // $updatedamount = array('aid'=>$checkout_session['metadata']['aid'],
        //                         'receivedamount' => $additionalcharges['realamount']);
        // $customer_detail = array('email'=> $checkout_session['customer_details']['email'],
        //                         'name' => $checkout_session['customer_details']['name'],
        //                         'phone' => $checkout_session['customer_details']['phone']);
        // $cgst = $checkout_session['metadata']['gst'] / 2 ;
        // $sgst = $checkout_session['metadata']['gst'] / 2 ;
        // $casetype = $checkout_session['metadata']['casetype'];
        // if($checkout_session['payment_status'] == "paid"){
        //     $status = true;
        // }
        // $data = array('aid' => $checkout_session['metadata']['aid'],
        //                 'paymentid' => $checkout_session['payment_intent'],
        //                 'paymentBy' => $this->session->userdata('id'),
        //                 'paymentint' => json_encode($customer_detail),
        //                 'receivedamount' => $checkout_session['amount_total'] / 100,
        //                 'servicecharge' => $additionalcharges['servicecharge'],
        //                 'cgst'=> $cgst,
        //                 'sgst'=> $sgst,
        //                 'igst'=> null,
        //                 'paymentat'=>date($dateFormat, $checkout_session['created']),
        //                 'status'=> $status);
        // $payin = $this->case_model->paymentIn($data);
        // if($payin){
        //     $updatepayment  = $this->case_model->updatePayment($updatedamount,$casetype);
        //     if($updatepayment){
        //         $this->load->view('adminpanel/paymentsuccess');
        //     } 
        // }
    }

    public function cancel()
    {
        // $this->load->view('adminpanel/paymentcancel');
    }



    // Method to check folder existence
    public function checkFolderExistence($folderName)
    {
        $directoryPath = FCPATH . 'uploads/'; // Define the directory path
        $folderPath = $directoryPath . $folderName;

        if (is_dir($folderPath)) {
            return true;
        } else {
            return false;
        }
    }

    private function fetchFolderFromRemoteServer($folderName)
    {
        $remoteApiUrl = 'https://www.claimsmitra.com/auth/getFolder'; // Replace with your remote API URL
        $apiUrl = $remoteApiUrl . '?folderName=' . urlencode($folderName);

        // Use cURL to fetch data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $folderContent = json_decode($result, true); // Assuming the remote API returns folder content as JSON

            if (!empty($folderContent['files'])) {
                $this->saveFolderLocally($folderName, $folderContent['files']);
                return [
                    'status' => true,
                    'message' => 'Folder fetched and copied locally',
                    'folderPath' => FCPATH . 'uploads/' . $folderName
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'No files found in the folder on the remote server'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Failed to fetch folder from remote server'
            ];
        }
    }

    public function getUsersByDepartment()
    {
        // Get the department ID from the POST data
        $departmentId = $this->input->post('departmentid');

        if ($departmentId) {
            // Load the model


            // Get users associated with the department
            $users = $this->assignment->getUsersByDepartment($departmentId);

            if ($users) {
                // Send the users as JSON response
                echo json_encode(['status' => 200, 'data' => $users]);
            } else {
                // No users found for the department
                echo json_encode(['status' => 404, 'message' => 'No users found for the selected department']);
            }
        } else {
            // Invalid department ID
            echo json_encode(['status' => 400, 'message' => 'Invalid department ID']);
        }
    }

    // Save folder locally
    private function saveFolderLocally($folderName, $files)
    {
        $localDirectory = FCPATH . 'uploads/' . $folderName;

        // Create folder if it doesn't exist
        if (!is_dir($localDirectory)) {
            mkdir($localDirectory, 0755, true);
        }

        // Save files to the local directory
        foreach ($files as $fileName => $fileContent) {
            file_put_contents($localDirectory . '/' . $fileName, base64_decode($fileContent));
        }
    }

    public function viewlivelocationcasedetail()
    {
        if ($this->session->userdata('id') != null) {
            $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
            $encryptedUrl = $this->encryption->decrypt(base64_decode($this->input->get('data')));
            if ($aid != null && $encryptedUrl) {
                $userid = $this->session->userdata('id');
                $data_array = json_decode($encryptedUrl, true);
                // Access the individual values
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;

                $exist_assessment = $this->assignment->getAssessmentById($aid);
                if ($exist_assessment) {
                    $data['assessment_table'] = !empty($exist_assessment->assesment_structure) ? $exist_assessment->assesment_structure : $this->assessmentTable();
                } else {
                    // If assessment doesn't exist, generate default table
                    $data['assessment_table'] = $this->assessmentTable();
                }

                // $data['assessment_table'] = $this->assessmentTable();
                $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
                $data['jobdata'] = json_decode($this->assignment->getjobdatabyAid($aid));
                $data['getassessmentdata'] = json_decode($this->assignment->getassessmentdatabyaid($aid));
                $data['reportdata'] = json_decode($this->assignment->getcasedatabyAid($aid));
                $data['essentialdata'] = json_decode($this->assignment->getessentialdatabyAid($aid));
                $data['natureofjob'] = json_decode($this->assignment->getnatureofjobbyAid($aid));
                $data['caseimages'] = $this->assignment->getAllFiles($aid, "images");
                $data['casevideos'] = $this->assignment->getAllFiles($aid, "videos");
                $data['casedocuments'] = $this->assignment->getAllFiles($aid, "documents");
                $data['casereports'] = $this->assignment->getAllReports($aid, "reports");
                $data['aid'] = $aid;

                // Get all template data as JSON string, then decode to array
                $templatedata_json = $this->assignment->gettemplateessentialdatabyAid($userid);
                $data['templatedata'] = json_decode($templatedata_json, true);

                // Ensure jobdata is present before accessing template_name
                $templateid = isset($data['jobdata']->template_name) ? $data['jobdata']->template_name : null;

                if ($templateid) {
                    $data['template_essentialdata'] = json_decode($this->assignment->gettemplateessential($templateid));
                    $data['template_casedata'] = json_decode($this->assignment->gettemplatcase($templateid));
                } else {
                    $data['template_essentialdata'] = null;
                    $data['template_casedata'] = null;
                }


                $data['defaultcompany'] = $defaultcompany;
                $data['defaultdepartment'] = $defaultdepartment;
                $data['usertype'] = $usertype;
                $data['companyName'] = $this->company->getCompanyName($defaultcompany);
                $data['departmentName'] = $this->company->getDepartmentName($defaultdepartment);
                $data['view'] = "View Case";
                $this->load->view('adminpanel/jobs/locationbasedjob/viewcasedetail', $data);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function viewoutgoingcasedetail()
    {
        if ($this->session->userdata('id') != null) {
            $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
            $encryptedUrl = $this->encryption->decrypt(base64_decode($this->input->get('data')));
            $type = $this->input->get('type'); // Get type from URL (e.g., outgoing)

            if ($aid != null && $encryptedUrl) {
                $data_array = json_decode($encryptedUrl, true);

                // Extract values from decrypted data
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;

                // Prepare data for view
                $data['casedata'] = json_decode($this->assignment->get_outgoing_jobdata_case($aid));
                $data['jobdata'] = json_decode($this->assignment->getoutgoingjobdatabyAid($aid));
                $data['reportdata'] = json_decode($this->assignment->getoutgoingcasedatabyAid($aid));
                $data['essentialdata'] = json_decode($this->assignment->getoutgoingessentialdatabyAid($aid));
                $data['natureofjob'] = json_decode($this->assignment->getoutgoingnatureofjobbyAid($aid));
                $data['caseimages'] = $this->assignment->getAllFiles($aid, "images");
                $data['casevideos'] = $this->assignment->getAllFiles($aid, "videos");
                $data['casedocuments'] = $this->assignment->getAllFiles($aid, "documents");
                $data['casereports'] = $this->assignment->getAllReports($aid, "reports");

                $data['aid'] = $aid;
                $data['defaultcompany'] = $defaultcompany;
                $data['defaultdepartment'] = $defaultdepartment;
                $data['usertype'] = $usertype;
                $data['companyName'] = $this->company->getCompanyName($defaultcompany);
                $data['departmentName'] = $this->company->getDepartmentName($defaultdepartment);
                $data['assignmentType'] = $type; // outgoing, incoming, etc.
                $data['view'] = "View Case";

                // Load the view
                $this->load->view('adminpanel/jobs/locationbasedjob/viewcasedetail', $data);
            } else {
                show_error('Invalid request parameters.', 400);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function createlivelocationcasedetail()
    {
        $encrypted = $this->input->get('data'); // Or ->post('data') if you're using POST

        if (!empty($encrypted)) {
            $id = $this->encryption->decrypt(base64_decode($this->input->get('q')));
            $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted));
            $decrypted = json_decode($decrypted_json, true);

            // Extract values from array
            $caseTypeId = $decrypted['id'] ?? null;
            $company = $decrypted['company'] ?? null;
            $department = $decrypted['department'] ?? null;
            $user_role = $decrypted['user_role'] ?? null;

            if (!empty($caseTypeId)) {
                $natureObj = $this->assignment->getnatureofjob($caseTypeId);
                $data['natureofjob'] = isset($natureObj->id) ? (int)$natureObj->id : null;
                $data['defaultcompany'] = $company;
                $data['defaultdepartment'] = $department;
                $data['usertype'] = $user_role;
                // $data['templatedata'] = json_decode($this->assignment->gettemplateessentialdatabyAid());
                $data['view'] = "Templates";


                $this->load->view('adminpanel/jobs/templates/templateforms', $data);
            } else {
                show_error("Invalid or missing case type ID.");
            }
        } else {
            show_error("Missing encrypted data parameter.");
        }
    }


    public function createtemplate()
    {
        if ($this->session->userdata('id') != null) {

            $userid = $this->session->userdata('id');
            $encrypted_json = $this->input->get('data');

            if ($encrypted_json) {
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));

                if ($decrypted_json) {
                    $data_array = json_decode($decrypted_json, true);

                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;

                    $data = [
                        'url' => $encrypted_json,
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'view' => "Templates",
                    ];

                    // Get all template data as JSON string, then decode to array
                    $templatedata_json = $this->assignment->gettemplateessentialdatabyAid($userid);
                    $data['templatedata'] = json_decode($templatedata_json, true); // decode to array of templates

                    $this->load->view('adminpanel/jobs/templates/createtemplate', $data);
                }
            }
        }
    }


    /* ------------------------------------------------------------------------- *
    * GET COMPLETED ASSIGNMENT
    * ------------------------------------------------------------------------- */
    // function getCompletedAssignment()
    // {
    //     if ($this->session->userdata('id') != null) {
    //         if ($_POST) {
    //             $data = array();
    //             $cancel = null;
    //             $jobData = $this->assignment->fetchCompletedAssignment($_POST);
    //             $accepteduser = null;
    //             $i = $_POST['start'];
    //             foreach ($jobData as $jobValue) {
    //                 $i++;
    //                 $case_status = null;
    //                 $address = null;
    //                 if ($jobValue->status == 2) {
    //                     $case_status = '<span class="label label-warning">Running</span>';
    //                     // $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
    //                 } else if ($jobValue->status == 1) {
    //                     $case_status = '<span class="label label-info">Accepted</span>';
    //                 } else if ($jobValue->status == 4) {
    //                     $case_status = '<span class="label label-success">Completed</span>';
    //                 }
    //                 if ($jobValue->uid_to != 0) {
    //                     $assignTo = $this->home->getuserdatabyid($jobValue->uid_to);

    //                     $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">' . $assignTo[0]['mobile'] . '</span>');
    //                 } else {
    //                     $accepteduser = '<span class="label label-warning">Waiting</span>';
    //                 }
    //                 $sharecase = '<a href="' . base_url() . 'viewcasedetail/' . $jobValue->aid . '" id="' . $jobValue->aid . '" class="btn btn-outline-info">View Case</a>';
    //                 $totalimages = $this->assignment->countFiles($jobValue->aid, "images");
    //                 $totalvideos = $this->assignment->countFiles($jobValue->aid, "videos");
    //                 $totaldocuments = $this->assignment->countFiles($jobValue->aid, "documents");
    //                 if ($jobValue->latitude != "" || $jobValue->longitude != "") {
    //                     $address = $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude);
    //                 } else {
    //                     $address = "Location Not Found";
    //                 }
    //                 $language = explode(',', $jobValue->jobdata);
    //                 $action = '<div class="navbar--nav ml-auto">
    //                         <ul class="nav" style="flex-wrap:unset">
    //                             <li class="nav-item">
    //                                 <a href="' . base_url() . 'locationoutgoingimages/' . $jobValue->aid . '" class="nav-link">
    //                                     <i class="fa fa-images"></i>
    //                                     <span class="badge text-white bg-blue">' . $totalimages . '</span>
    //                                 </a>
    //                             </li>

    //                             <li class="nav-item">
    //                                 <a href="' . base_url() . 'locationoutgoingvideos/' . $jobValue->aid . '" class="nav-link">
    //                                     <i class="fa fa-video"></i>
    //                                     <span class="badge text-white bg-blue">' . $totalvideos . '</span>
    //                                 </a>
    //                             </li>

    //                             <li class="nav-item">
    //                                 <a href="' . base_url() . 'locationoutgoingdocuments/' . $jobValue->aid . '" class="nav-link">
    //                                     <i class="fa fa-file"></i>
    //                                     <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
    //                                 </a>
    //                             </li>
    //                         </ul>
    //                     </div>';
    //                 $created = date('Y/m/d H:i', strtotime($jobValue->createdAt));
    //                 $data[] = array(
    //                     nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
    //                     $accepteduser,
    //                     nl2br($jobValue->investigator_type),
    //                     // $address,
    //                     $case_status
    //                 );
    //             }
    //             $output = array(
    //                 "draw" => $_POST['draw'],
    //                 "recordsTotal" => $this->assignment->countallCompletedAssignment(),
    //                 "recordsFiltered" => $this->assignment->countFilteredCompletedAssignment($_POST),
    //                 "data" => $data,
    //             );
    //             echo json_encode($output);
    //         } else {
    //             $data['view'] = "Outgoing case";
    //             $this->load->view("adminpanel/jobs/locationbasedjob/completedcase", $data);
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }



    /* ------------------------------------------------------------------------- *
    * CREATE NEW ASSIGNMENT
    * ------------------------------------------------------------------------- */
    public function generateForm()
    {
        if ($this->session->userdata('id') != null) {

            $userid = $this->session->userdata('id');
            $encrypted_json = $this->input->get('data');
            $assignmentvalue = $this->input->post('check_case');

            if ($encrypted_json && $assignmentvalue) {
                // Decrypt the JSON string
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                $form = $this->assignment->getCaseFormByid($assignmentvalue);
                if ($decrypted_json && $form) {
                    // Decode the JSON string back into an array
                    $data_array = json_decode($decrypted_json, true);
                    // Access the individual values
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;

                    $data = [
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'view' => $form->investigator_type,
                        'natureofjob' => $form->id,
                        'formname' => $form->form,
                        'url' => $encrypted_json
                    ];

                    $templatedata_json = $this->assignment->gettemplateessentialdatabyAid($userid);
                    $data['templatedata'] = json_decode($templatedata_json, true); // decode to array of templates

                    $this->load->view('adminpanel/jobs/createcaseform', $data);
                }
            }
        } else {
        }
    }

    public function generateoutgoingForm()
    {
        if ($this->session->userdata('id') != null) {
            $encrypted_json = $this->input->get('data');
            $assignmentvalue = $this->input->get('check_case');

            if ($encrypted_json && $assignmentvalue) {
                // Decrypt the JSON string
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                $form = $this->assignment->getCaseFormByid($assignmentvalue);
                if ($decrypted_json && $form) {
                    // Decode the JSON string back into an array
                    $data_array = json_decode($decrypted_json, true);
                    // Access the individual values
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;

                    $data = [
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'view' => $form->investigator_type,
                        'natureofjob' => $form->id,
                        'formname' => $form->form,
                        'url' => $encrypted_json
                    ];
                    $this->load->view('adminpanel/outgoingcases/document_translation_form', $data);
                }
            }
        } else {
        }
    }

    public function submitJobData()
    {
        if ($this->session->userdata('id') !== null) {
            $urldata = decryptUrl($this->input->get('data'));
            if (empty($urldata)) {
                echo json_encode(["status" => 400, "message" => "Missing or invalid data."]);
                return;
            }
            $upload = new UPLOAD();
            if ($this->input->method() === 'post') {
                $case_data = $this->input->post();
                // Prepare job data
                $jobdata = array_filter([
                    'name_of_consignee' => $case_data['name_of_consignee'] ?? null,
                    'consignor' => $case_data['consignor'] ?? null,
                    'subject_matter' => $case_data['subject_matter'] ?? null,
                    'name_of_owner' => $case_data['name_of_owner'] ?? null,
                    'casetype' => $case_data['casetype'] ?? null,
                    'type_of_vehicle' => $case_data['type_of_vehicle'] ?? null,
                    'registered_owner' => $case_data['registered_owner'] ?? null,
                    'salutation' => $case_data['salutation'] ?? null,
                    'name_of_commodity' => $case_data['name_of_commodity'] ?? null,
                    'address' => $case_data['address'] ?? null,
                    'available_at_location' => $case_data['available_at_location'] ?? null,
                    'cause_loss' => $case_data['cause_loss'] ?? null,
                    'contact_person_name' => $case_data['contact_person_name'] ?? null,
                    'invoices' => $case_data['invoices'] ?? null,
                    'claim_no' => $case_data['claim_no'] ?? null,
                    'tagNumber' => $case_data['tagNumber'] ?? null,
                    'item' => $case_data['item'] ?? null,
                    'case_reference' => $case_data['case_reference'] ?? null,
                    'contact_person_mobile' => $case_data['contact_person_mobile'] ?? null,
                    'policyNumber' => $case_data['policyNumber'] ?? null,
                    'insured_name' => $case_data['name_of_owner'] ?? $case_data['name_of_beneficiary'] ?? $case_data['insured_name'] ?? null,
                    'tag_vehicle' => $case_data['tagNumber'] ?? $case_data['vehicle_number'] ?? null,
                    'vehicle_number' => $case_data['vehicle_number'] ?? null,
                    'claim_handler' => $case_data['claim_handler'] ?? null,
                    'state' => $case_data['state'] ?? null,
                    'location_of_survey' => $case_data['location_of_survey'] ?? null,
                    'prvt_cmrcl' => $case_data['prvt_cmrcl'] ?? null,
                    'instruction' => $case_data['instruction'] ?? null,
                    'valuation_type' => $case_data['valuation_type'] ?? null,
                    'visitdate' => $case_data['visitdate'] ?? null,
                    'template_name' => $case_data['template_name'] ?? null,
                    'asset_value' => $case_data['asset_value'] ?? null
                ], fn($value) => !is_null($value) && $value !== '');

                // Prepare data for database insertion
                $data = [
                    'aid' => date("dmyhis") . rand(10, 100),
                    'userId' => $this->session->userdata('id'),
                    'natureofjob' => $case_data['natureofjob'],
                    'case_reference' => $case_data['case_reference'],
                    'jobdata' => json_encode($jobdata),
                    'status' => "1",
                ];

                $result = $this->assignment->createcase($data);

                if ($result['aid'] !== null) {
                    // Create directories for file uploads
                    $uploadDirs = ['images', 'videos', 'documents', 'reports'];
                    foreach ($uploadDirs as $dir) {
                        $uploadPath = './uploads/' . $result['aid'] . '/' . $dir;
                        if (!is_dir($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
                    }

                    // Handle invoice uploads
                    if (isset($_FILES['invoices']) && !empty($_FILES['invoices']['name'][0])) {
                        $invoicePath = './uploads/' . $result['aid'] . '/invoice';
                        if (!is_dir($invoicePath)) {
                            mkdir($invoicePath, 0777, true);
                        }
                        $files = $upload->multipleuploadFile('invoices', $invoicePath);
                    }

                    // Send notifications
                    $contactNumber = ($case_data['available_at_location'] === 'yes')
                        ? $case_data['contact_person_mobile']
                        : ($case_data['whatsapp_number'] ?? null);

                    if ($contactNumber) {
                        $this->sendwhatsapp($contactNumber, $result['aid'], "2");
                    }

                    if (!empty($case_data['inspectorid'])) {
                        $this->sendwhatsapptoinspector($case_data['inspectorid'], $result['aid'], "2");

                        $jobassigned = [
                            "aid" => $result['aid'],
                            "uid_from" => $this->session->userdata('id'),
                            "uid_to" => $case_data['inspectorid'],
                            "departmentid" => $urldata['defaultdepartment'],
                            "cid_to" => $urldata['defaultcompany'],
                            "totalamount" => $case_data['rate'] ?? 0,
                        ];

                        $jobassign = $this->assignment->jobassignTo($jobassigned);

                        if ($jobassign) {
                            $url = $this->input->get('data');
                            echo json_encode(["status" => 200, "message" => "You have successfully created the job and assigned it.", "data" => $url]);
                        } else {
                            echo json_encode(["status" => 500, "message" => "Failed to assign job."]);
                        }
                    } else {
                        echo json_encode(["status" => 200, "message" => "Job created successfully without assignment."]);
                    }
                } else {
                    echo json_encode(["status" => 500, "message" => "Internal Server error."]);
                }
            } else {
                $locationjob['listofjobs'] = $this->assignment->getLocationJob();
                $this->load->view('adminpanel/jobs/locationbasedjob/createcase', $locationjob);
            }
        }
    }



    public function createnonlocationcase()
    {
        if ($this->session->userdata('id') !== null) {
            // Load form validation library
            $this->load->library('form_validation');

            if ($this->input->method() === 'post') {
                // Set validation rules
                $this->form_validation->set_rules('language_list_from', 'Language From', 'required');
                $this->form_validation->set_rules('language_list_to', 'Language To', 'required');
                $this->form_validation->set_rules('natureofjob', 'Nature of Job', 'required');
                $this->form_validation->set_rules('case_reference', 'Case Reference', 'required');

                // Run validation
                if ($this->form_validation->run() === FALSE) {
                    // If validation fails, return errors
                    $response = [
                        "status" => 400,
                        "message" => validation_errors()
                    ];
                    echo json_encode($response);
                    return;
                }

                // Prepare case data
                $case_data = $this->input->post();

                // Prepare job data from incoming case data
                $jobdata = array_filter([
                    'language_from' => $case_data['language_list_from'] ?? null,
                    'language_to' => $case_data['language_list_to'] ?? null,
                    'totalfile' => $case_data['totalfile'] ?? null,
                    'totalpages' => $case_data['totalpages'] ?? null,
                ], fn($value) => !is_null($value) && $value !== '');

                // Prepare data for database insertion
                $data = [
                    'aid' => date("dmyhis") . rand(10, 100),  // Generate a unique ID
                    'userId' => $this->session->userdata('id'),
                    'natureofjob' => $case_data['natureofjob'],
                    'case_reference' => $case_data['case_reference'],
                    'jobdata' => json_encode($jobdata),
                    'status' => "1",  // Assuming 1 means active/created
                ];

                // Create outgoing case
                $result = $this->assignment->createoutgoingcase($data);

                if ($result['aid'] != null) {
                    // Fetch costing data
                    $natureofjob = $case_data['natureofjob'];  // Assuming it's sent in the request
                    $casedata = $this->case_model->getCosting($natureofjob);

                    if ($casedata !== false) {
                        $totalpages = $case_data['totalpages'] ?? 0;  // Ensure totalpages is defined
                        $amount = $casedata['rate'] * $totalpages;
                    }

                    if (!empty($amount)) {
                        // Prepare job assignment data
                        $jobassigned = [
                            "aid" => $result['aid'],  // Use the created job aid
                            "uid_from" => $this->session->userdata('id'),
                            "totalamount" => $amount,
                        ];

                        // Assign job
                        $jobassign = $this->assignment->outgoingjobassignTo($jobassigned);

                        if ($jobassign) {
                            // Generate response data with encrypted details
                            $aid = urlencode($this->encryption->encrypt($result['aid']));
                            $natureofjob = urlencode($this->encryption->encrypt($case_data['natureofjob']));
                            $totalfile = urlencode($this->encryption->encrypt($case_data['totalfile']));
                            $totalpages = urlencode($this->encryption->encrypt($totalpages));
                            $casetype = urlencode($this->encryption->encrypt("1")); // Adjust if needed

                            // Success response
                            $response = [
                                "status" => 200,
                                "message" => "Job created and assigned successfully.",
                                "data" => [
                                    'aid' => $aid,
                                    'natureofjob' => $natureofjob,
                                    'totalfile' => $totalfile,
                                    'totalpages' => $totalpages,
                                    'casetype' => $casetype
                                ]
                            ];
                            echo json_encode($response);
                        } else {
                            // Job assignment failed
                            $response = [
                                "status" => 500,
                                'message' => "Failed to assign job."
                            ];
                            echo json_encode($response);
                        }
                    } else {
                        // Error calculating amount
                        $response = [
                            "status" => 500,
                            'message' => "Failed to calculate amount."
                        ];
                        echo json_encode($response);
                    }
                } else {
                    // Creation failed
                    $response = [
                        "status" => 500,
                        'message' => "Internal Server Error. Job creation failed."
                    ];
                    echo json_encode($response);
                }
            } else {
                // If the request is not POST, load the view
                $locationjob['listofjobs'] = $this->assignment->getLocationJob();
                $this->load->view('adminpanel/jobs/locationbasedjob/createcase', $locationjob);
            }
        } else {
            // User is not logged in
            echo json_encode(["status" => 401, "message" => "Unauthorized access."]);
        }
    }




    public function sendwhatsapptoinspector($inspectorid, $aid, $casetype)
    {
        // $url = base_url('sharelivelocation/' . $aid . '/' . $casetype);
        $message = "New case assigned:" . $aid . "";
        sendwhatsapptextmessage($message, "+91" . $inspectorid);
    }

    public function sendwhatsapp($mobilenumber, $aid, $casetype)
    {
        $url = base_url('sharelivelocation/' . $aid . '/' . $casetype);
        $message = "Please share your location:" . $url . "";
        sendwhatsapptextmessage($message, "+91" . $mobilenumber);
    }

    /* ------------------------------------------------------------------------- *
	* GET ADDRESS FROM LONGITUDE AND LATITUDE
	* ------------------------------------------------------------------------- */
    function getAddressFromLatLng($lat, $lng)
    {
        // Google Maps Geocoding API endpoint
        $apiEndpoint = "https://maps.googleapis.com/maps/api/geocode/json";

        // Google Maps API Key (replace with your own API key)
        $apiKey = "AIzaSyBKTLjJ3rqRm_qVpjVn9gP-efBlO1ivdCo&q=";

        // Construct the request URL
        $requestUrl = "$apiEndpoint?latlng=$lat,$lng&key=$apiKey";

        // Send HTTP request to the API
        $response = file_get_contents($requestUrl);

        // Decode JSON response
        $data = json_decode($response, true);

        // Check if API request was successful
        if ($data['status'] === 'OK') {
            // Extract address from the response
            $address = $data['results'][0]['formatted_address'];
            return $address;
        } else {
            // If API request failed, return an error message
            return "Error: Unable to fetch address.";
        }
    }
    /* ------------------------------------------------------------------------- *
    * PREPARE LOR
    * ------------------------------------------------------------------------- */
    public function preparelor()
    {
        if ($this->session->userdata('id') != null) {
            // Get encrypted data from URL
            $encrypted_json = $this->input->get('data');
            if ($encrypted_json) {
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    $data_array = json_decode($decrypted_json, true);
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;

                    // Get the 'aid' parameter from the URL
                    $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));

                    // Check LOR status
                    $lorStatus = $this->assignment->getSendlorStatus($aid); // Assuming this is a method that returns the status

                    if ($lorStatus == 1) {
                        // Redirect to viewlor if the status is 1
                        redirect('viewlor?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data'));
                        return; // Exit to prevent further processing
                    }

                    // If status is not 1, load the Prepare LOR view
                    $data = [
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'aid' => $aid,
                        'view' => "Preview LOR",
                    ];

                    $this->load->view("adminpanel/accounts/lor", $data);
                }
            }
        } else {
            redirect('user_logout');
        }
    }

    public function viewlor()
    {
        if ($this->session->userdata('id') != null) {
            // Get encrypted data from URL
            $encrypted_json = $this->input->get('data');
            if ($encrypted_json) {
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    $data_array = json_decode($decrypted_json, true);
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;

                    // Get the 'aid' parameter from the URL
                    $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));

                    // Get the LOR status
                    $lorStatus = $this->assignment->getSendlorStatus($aid);

                    if ($lorStatus == 1) {
                        // If status is 1, proceed to load the "View LOR" view
                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'lorStatus' => $lorStatus,
                            'aid' => $aid,
                            'view' => "View LOR",
                        ];

                        $this->load->view('adminpanel/accounts/viewlor', $data);
                    } else {
                        // If status is not 1, load the "Prepare LOR" view
                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'lorStatus' => $lorStatus,
                            'aid' => $aid,
                            'view' => "Prepare LOR",
                        ];
                        $this->load->view('adminpanel/accounts/viewlor', $data);
                    }
                }
            }
        } else {
            redirect('user_logout');
        }
    }
    public function fetchQuestions()
    {
        $departments = $this->input->get('department');
        if (!empty($departments)) {
            $results = $this->assignment->getpreparelor($departments);
            $response = [];
            foreach ($results as $row) {
                $response[] = [
                    'id' => $row->id,
                    'description' => $row->description
                ];
            }
            echo json_encode($response);
        } else {
            echo json_encode([]);
        }
    }

    public function submit_lor()
    {
        if ($this->session->userdata('id') != null) {
            $aid = $this->input->post('aid');
            $uid = $this->input->post('uid');
            $questions_json = $this->input->post('questions_json');
            $question_ids = $this->input->post('question_ids');

            if ($aid && $uid && $questions_json) {
                $questions = json_decode($questions_json, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $existingLOR = $this->assignment->getLorByAidUid($aid, $uid);
                    if ($existingLOR) {
                        $existingLorJson = json_decode($existingLOR['lor'], true);
                        $newQuestions = json_decode($questions_json, true);
                        $updatedLorJson = array_merge($existingLorJson, $newQuestions);
                        $updatedLorJson = json_encode($updatedLorJson);
                        $updated = $this->assignment->updateLor($aid, $uid, $updatedLorJson);
                        if ($updated) {
                            echo json_encode(['status' => 'success']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Failed to update LOR data']);
                        }
                    } else {
                        $data = array(
                            'aid' => $aid,
                            'uid' => $uid,
                            'lor' => $questions_json
                        );
                        $inserted = $this->assignment->insertLorQuestions($data);
                        if ($inserted) {
                            echo json_encode(['status' => 'success']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Failed to save LOR data']);
                        }
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON format']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function addnewtitle()
    {
        $aid = $this->input->post('aid');
        $uid = $this->input->post('uid');
        $newQuestion = $this->input->post('newQuestion');
        $questions = json_decode($newQuestion, true);

        if ($this->assignment->appendQuestion($aid, $newQuestion)) {
            echo json_encode(['success' => true, 'message' => 'Questions updated successfully']);
        } else {
            log_message('error', 'Failed to append question for aid: ' . $aid);
            echo json_encode(['success' => false, 'error' => 'Failed to update the questions']);
        }
    }

    public function updatequestions()
    {
        $inputData = json_decode(file_get_contents('php://input'), true);

        $descriptions = isset($inputData['description']) ? $inputData['description'] : null;
        $aid = isset($inputData['aid']) ? $inputData['aid'] : null;

        if (is_array($descriptions)) {
            foreach ($descriptions as $item) {
                $description = isset($item['description']) ? $item['description'] : null;
                $questionId = isset($item['id']) ? $item['id'] : null;
                if ($description && $questionId) {
                    if (!$this->assignment->updateQuestion($aid, $description, $questionId)) {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to update the question with ID: ' . $questionId]);
                        return;
                    }
                }
            }
            echo json_encode(['status' => 'success', 'message' => 'Questions updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid descriptions format']);
        }
    }

    public function fetchInsertedQuestions($aid)
    {
        $questions = $this->assignment->getInsertedQuestions($aid);
        $username = $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');
        $aid = $this->input->post('aid');
        if ($questions) {
            echo json_encode(array(
                'status' => 'success',
                'questions' => $questions,
                'username' => $username,
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'No questions found for the provided policy ID.'
            ));
        }
    }

    public function deleteQuestion()
    {
        $inputData = json_decode(file_get_contents('php://input'), true);
        $aid = $inputData['aid'];
        $questionId = $inputData['question_id'];
        if (empty($aid) || empty($questionId)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input parameters']);
            return;
        }
        $result = $this->assignment->deleteQuestionById($aid, $questionId);
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Question deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete the question']);
        }
    }

    public function submit_viewlor()
    {
        if ($this->session->userdata('id') != null) {
            $aid = $this->input->post('aid');
            $sent_to = json_decode($this->input->post('sent_to'), true);
            $special_note = $this->input->post('special_note');
            $subject = $this->input->post('subject');
            $date_of_letter = $this->input->post('date_of_letter');
            $automail_fix = json_decode($this->input->post('automail_fix'), true);
            $sent_date = $this->input->post('sent_date');
            $mail_automation = $this->input->post('mail_automation');
            $questions = json_decode($this->input->post('questions'), true);
            $email_body = $this->input->post('email_body');

            if ($aid && is_array($sent_to) && !empty($sent_to)) {
                $data = [
                    'sent_to' => json_encode($sent_to),
                    'special_note' => $special_note,
                    'mail_subject' => $subject,
                    'date_of_letter' => $date_of_letter,
                    'automail_fix' => json_encode($automail_fix),
                    'sent_date' => $sent_date,
                    'mail_automation' => $mail_automation,
                    'status' => 1,
                ];

                // Update LOR data
                $updated = $this->assignment->updateLorQuestions($aid, $data);

                if ($updated) {
                    $attachmentPath = $this->generate_new_pdf($questions, $special_note, $aid);

                    // If the PDF was successfully generated, send the email
                    if ($attachmentPath && file_exists($attachmentPath)) {
                        $this->sendmail($sent_to, $attachmentPath, $email_body, $subject); // Send questions as the body
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to generate PDF']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update LOR data']);
                }
            } else {
                log_message('error', 'Invalid sent_to data: ' . json_encode($sent_to));
                echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            redirect('user_logout');
        }
    }
    public function generate_new_pdf($questions, $special_note, $aid)
    {

        if ($this->session->userdata('id') !== null) {
            if (empty($questions)) {
                show_error('Questions are required.');
                return;
            }

            // Format questions as HTML

            $formattedQuestions = nl2br(htmlspecialchars(implode("\n", $questions)));
            $emailBody = $formattedQuestions . "<br>";

            $essentialdata = $this->assignment->getessentialdatabyAid($aid);
            $essentialData = $essentialdata ? json_decode($essentialdata, true) : null;

            $casedata = $this->assignment->getcasedatabyAid($aid);
            $caseData = $casedata ? json_decode($casedata, true) : null;

            $jobdata = $this->assignment->get_jobdata_case($aid);
            $jobData = $jobdata ? json_decode($jobdata, true) :  null;

            $sent_to = $this->assignment->getSentToByAid($aid);
            // Ensure the special note is not empty before appending
            if (!empty($special_note)) {
                $formattedSpecialNote = nl2br(htmlspecialchars($special_note));
                $emailBody .= "<br><strong>Special Note:</strong><br>" . $formattedSpecialNote . "<br>";
            }

            // Prepare the data to be passed to the view
            $data['sent_to'] = $sent_to;
            $data['emailBody'] = $emailBody;
            $data['formattedQuestions'] = $formattedQuestions;
            $data['specialNote'] = $formattedSpecialNote ?? '';
            $data['essentialData'] = $essentialData;
            $data['caseData'] = $caseData;
            $data['jobData'] = $jobData;
            $html = $this->load->view('adminpanel/accounts/sendmailpdf', $data, true);

            // Initialize Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Save PDF file
            $baseUploadPath = './uploads/' . $aid . '/lor';
            if (!is_dir($baseUploadPath)) {
                mkdir($baseUploadPath, 0777, true);
            }

            $filename = "lor_" . date('Ymd_His') . ".pdf";
            $filePath = $baseUploadPath . '/' . $filename;

            file_put_contents($filePath, $dompdf->output());

            return $filePath;  // Return the path to the generated PDF
        } else {
            redirect('user_logout');
        }
    }
    public function preview_pdf()
    {
        $aid = $this->input->post('aid');
        $questions = $this->input->post('questions');
        $special_note = $this->input->post('special_note');
        $questionsArray = explode("\n", $questions);
        $attachmentPath = $this->generate_new_pdf($questionsArray, $special_note, $aid);
        if ($attachmentPath && file_exists($attachmentPath)) {
            header("Content-Type: application/pdf");
            header("Content-Disposition: inline; filename=" . basename($attachmentPath));
            readfile($attachmentPath);
        } else {
            echo "Failed to generate PDF.";
        }
    }
    public function sendmail($recipients, $attachmentPath = null, $emailBody = '', $subject = '')
    {
        $config = $this->assignment->get_email_config();

        if ($config && !empty($recipients)) {
            $this->load->library('email');
            $email_config = [
                'protocol'  => 'smtp',
                'smtp_host' => $config['host'],
                'smtp_port' => $config['port'],
                'smtp_user' => $config['username'],
                'smtp_pass' => $config['password'],
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'smtp_crypto' => $config['encryption'],
                'newline'   => "\r\n",
            ];

            $this->email->initialize($email_config);
            $sender_name = "VP Singhal & Co.";
            $formattedEmailBody = nl2br($emailBody);
            foreach ($recipients as $recipient) {
                $to = $recipient['to'] ?? null;
                $cc = $recipient['cc'] ?? null;

                if ($to) {
                    $this->email->from($config['username'], $sender_name);
                    $this->email->to($to);

                    if ($cc) {
                        $this->email->cc($cc);
                    }

                    $this->email->subject($subject);
                    $this->email->message($formattedEmailBody);

                    // Attach the PDF if it exists
                    if ($attachmentPath && file_exists($attachmentPath)) {
                        $this->email->attach($attachmentPath);
                    }

                    if (!$this->email->send()) {
                        echo $this->email->print_debugger();
                    }
                }
            }
        } else {
            log_message('error', 'Email configuration or recipient data is missing.');
        }
    }

    /* ------------------------------------------------------------------------- *
	* SURVEYOR FEE
	* ------------------------------------------------------------------------- */
    public function surveyorfee()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        $company = $this->encryption->decrypt(base64_decode($this->input->get('company')));
        $department = $this->encryption->decrypt(base64_decode($this->input->get('department')));
        $user_role = $this->encryption->decrypt(base64_decode($this->input->get('userrole')));
        if ($aid != null) {
            $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
            $data['aid'] = $aid;
            $data['companyid'] = $company;
            $data['departmentid'] = $department;
            $data['user_role'] = $user_role;
            $data['companyName'] = $this->company->getCompanyName($company);
            $data['departmentName'] = $this->company->getDepartmentName($department);
            $data['view'] = "Surveyor Fee";
            $this->load->view('adminpanel/accounts/surveyfee', $data);
        }
    }
    /* ------------------------------------------------------------------------- *
	* DISPATCH
	* ------------------------------------------------------------------------- */
    // public function dispatch(){
    //     if ($this->session->userdata('id') !== null) {
    //         if($this->input->method() === "post"){
    //             $encrypted_json = $this->input->get('data');
    //             if ($encrypted_json) {
    //                 $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
    //                 if ($decrypted_json) {
    //                     $data_array = json_decode($decrypted_json, true);
    //                     $defaultcompany = $data_array['defaultcompany'] ?? null;
    //                     $defaultdepartment = $data_array['defaultdepartment'] ?? null;
    //                     $usertype = $data_array['usertype'] ?? null;
    //                     $data = [
    //                         'defaultcompany' => $defaultcompany,
    //                         'defaultdepartment' => $defaultdepartment,
    //                         'usertype' => $usertype,
    //                     ];
    //                 }
    //             }
    //             $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
    //             if($aid != null){
    //                 $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
    //                 $data['aid'] = $aid;
    //                 $data['view'] = "Dispatch";
    //                 $this->load->view('adminpanel/accounts/dispatch', $data);
    //             }
    //         }else{
    //             $data = $this->input->post();
    //             print_r(json_encode($data));
    //             exit;
    //             // Set validation rules
    //             $this->form_validation->set_rules('dispatchmode', 'Dispatch Mode', 'required');
    //             $this->form_validation->set_rules('tracking_no', 'Tracking Number', 'trim');
    //             $this->form_validation->set_rules('description', 'Description', 'trim');
    //             $this->form_validation->set_rules('dispatchdate', 'Dispatch Date', 'required');

    //             if ($this->form_validation->run() == FALSE) {
    //                 // Validation failed, reload the form with errors
    //                 $this->load->view('adminpanel/accounts/dispatch'); 
    //             } else {
    //                 // Collect form data
    //                 $data = array(
    //                     'aid' => $this->input->post('aid'),
    //                     'dispatchmode' => $this->input->post('dispatchmode'),
    //                     'tracking_no' => $this->input->post('tracking_no'),
    //                     'description' => $this->input->post('description'),
    //                     'dispatchdate' => $this->input->post('dispatchdate')
    //                 );

    //                 // Insert data into database
    //                 if ($this->Dispatch_model->insert_dispatch($data)) {
    //                     $this->session->set_flashdata('success', 'Dispatch data submitted successfully.');
    //                 } else {
    //                     $this->session->set_flashdata('error', 'Failed to submit dispatch data.');
    //                 }

    //                 // Redirect back to form or another page
    //                 redirect('dispatch');
    //             }
    //         }
    //     }else{

    //     }
    // }

    public function dispatchFile()
    {
        if ($this->session->userdata('id') !== null) {
            if ($this->input->method() === "post") {
                print_r($this->input->post());
                exit;
                // Set validation rules
                $this->form_validation->set_rules('dispatchmode', 'Dispatch Mode', 'required');
                $this->form_validation->set_rules('description', 'Description', 'trim');
                $this->form_validation->set_rules('dispatchdate', 'Dispatch Date', 'required');
                if ($this->input->post('dispatchmode') == "2") {
                    $this->form_validation->set_rules('tracking_no', 'Tracking Number', 'required|trim');
                }

                if ($this->form_validation->run() == FALSE) {
                    echo json_encode([
                        "status" => "error",
                        "message" => validation_errors()
                    ]);
                } else {

                    // Collect form data
                    $data = array(
                        'aid' => $this->input->post('aid'),
                        'dispatchmode' => $this->input->post('dispatchmode'),
                        'tracking_no' => $this->input->post('tracking_no'),
                        'description' => $this->input->post('description'),
                        'dispatchdate' => $this->input->post('dispatchdate'),
                        'status' => '1',
                        'userid' => $this->session->userdata('id')
                    );
                    // Insert data into the database
                    if ($this->assignment->insert_dispatch($data)) {
                        echo json_encode([
                            "status" => "success",
                            "message" => "Dispatch data submitted successfully."
                        ]);
                    } else {
                        echo json_encode([
                            "status" => "error",
                            "message" => "Failed to submit dispatch data."
                        ]);
                    }
                }
            } else {
                $encrypted_json = $this->input->get('data');
                if ($encrypted_json) {
                    $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                    if ($decrypted_json) {
                        $data_array = json_decode($decrypted_json, true);
                        $defaultcompany = $data_array['defaultcompany'] ?? null;
                        $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                        $usertype = $data_array['usertype'] ?? null;
                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                        ];
                    }
                }
                $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
                if ($aid != null) {
                    $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
                    $data['aid'] = $aid;
                    $data['view'] = "Dispatch";
                    $this->load->view('adminpanel/accounts/dispatch', $data);
                }
            }
        } else {
            redirect('user_logout'); // Redirect if user is not logged in
        }
    }


    // public function prepareemail()
    // {
    //     $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
    //     $company = $this->encryption->decrypt(base64_decode($this->input->get('company')));
    //     $department = $this->encryption->decrypt(base64_decode($this->input->get('department')));
    //     $user_role = $this->encryption->decrypt(base64_decode($this->input->get('userrole')));
    //     if ($aid != null) {
    //         $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
    //         $data['aid'] = $aid;
    //         $data['companyid'] = $company;
    //         $data['departmentid'] = $department;
    //         $data['user_role'] = $user_role;
    //         $data['companyName'] = $this->company->getCompanyName($company);
    //         $data['departmentName'] = $this->company->getDepartmentName($department);
    //         $data['view'] = "Email";
    //         $this->load->view('adminpanel/accounts/email', $data);
    //     }
    // }
    /* ------------------------------------------------------------------------- *
    * EMAIL(ILA)
    * ------------------------------------------------------------------------- */
    public function prepareemail()
    {
        $encrypted_json = $this->input->get('data');
        if ($encrypted_json) {
            $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
            if ($decrypted_json) {
                $data_array = json_decode($decrypted_json, true);
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;
                $data = [
                    'defaultcompany' => $defaultcompany,
                    'defaultdepartment' => $defaultdepartment,
                    'usertype' => $usertype,
                ];
            }
        }
        if ($this->session->userdata('id') !== null) {
            $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
            // $company = $this->encryption->decrypt(base64_decode($this->input->get('company')));
            // $department = $this->encryption->decrypt(base64_decode($this->input->get('department')));
            // $user_role = $this->encryption->decrypt(base64_decode($this->input->get('userrole')));
            if ($aid != null) {
                $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
                $data['aid'] = $aid;
                // $data['companyid'] = $company;
                // $data['departmentid'] = $department;
                // $data['user_role'] = $user_role;
                // $data['companyName'] = $this->company->getCompanyName($company);
                // $data['departmentName'] = $this->company->getDepartmentName($department);
                $data['view'] = "Email";
                $this->load->view('adminpanel/accounts/email', $data);
            }
        } else {
            redirect('user_logout');
        }
    }







    // for inserting attachments of email in profile folder
    public function uploadImage()
    {
        // Directory for storing images
        $uploadPath = './assets/profile/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // File upload configuration
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = uniqid() . '_' . $_FILES['image']['name'];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $imageUrl = base_url('assets/profile/' . $uploadData['file_name']);

            // Respond with the image URL
            echo json_encode(array('status' => 'success', 'image_url' => $imageUrl));
        } else {
            echo json_encode(array('status' => 'error', 'message' => $this->upload->display_errors()));
        }
    }
    public function saveTemplate()
    {
        if ($this->session->userdata('id') !== null) {
            $userId = $this->session->userdata('id');
            $templateName = $this->input->post('template_name');
            $templateBody = $this->input->post('template_body');
            if (empty($templateName) || empty($templateBody)) {
                echo json_encode(array('status' => 'error', 'message' => 'Please provide both a template name and body.'));
                return;
            }
            $templateName = trim($templateName);
            $templateBody = trim($templateBody);
            $data = array(
                'company' => "97",
                'department' => "2",
                'userid' => $userId,
                'templatename' => $templateName,
                'templatebody' => $templateBody
            );
            $saved = $this->assignment->insertTemplate($data);
            if ($saved) {
                echo json_encode(array('status' => 'success', 'message' => 'Template saved successfully.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to save template.'));
            }
        } else {
            redirect('user_logout');
        }
    }
    public function fetchTemplate()
    {
        $templates = $this->assignment->getAllTemplates();

        if ($templates) {
            $templateName = $this->input->post('template_name');
            $templateBody = null;
            if ($templateName) {
                $template = $this->assignment->getTemplateBody($templateName);

                if ($template) {
                    $templateBody = $template->templatebody;

                    // Assuming your images are saved in the 'uploads/images/' directory
                    // $baseUrl = base_url('assets/profile/');

                    // // Find all image file names in the template body and update the src attribute
                    // preg_match_all('/src=["\']([^"\']+)["\']/', $templateBody, $matches);
                    // if (!empty($matches[1])) {
                    //     foreach ($matches[1] as $imageName) {
                    //         // Generate the full URL for each image
                    //         $imageUrl = $baseUrl . $imageName;
                    //         // Replace the file name with the full URL
                    //         $templateBody = str_replace($imageName, $imageUrl, $templateBody);
                    //     }
                    // }
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Template body not found.'));
                    return;
                }
            }

            echo json_encode(array(
                'status' => 'success',
                'data' => array('templates' => $templates, 'templateBody' => $templateBody)
            ));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No templates found.'));
        }
    }
    public function emailsend()
    {
        $recipients = json_decode($this->input->post('recipients'), true);
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        // $attachments = isset($_FILES['attachments']) ? $_FILES['attachments'] : [];
        // $message = $this->prepare_email_html($message);
        // Extract images from HTML content
        // $images = [];
        // $directoryPath = './assets/profile/';
        // preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $message, $matches, PREG_SET_ORDER);
        // foreach ($matches as $match) {
        //     $src = $match[1];
        //     $filePath = str_replace(base_url(), './', $src);

        //     if (file_exists($filePath)) {
        //         $fileName = basename($filePath);
        //         $images[] = ['path' => $filePath, 'name' => $fileName];
        //         $cid = uniqid();
        //         $message = str_replace($src, 'cid:' . $cid, $message);
        //     }
        // }

        // SMTP Configuration
        $config = $this->assignment->get_email_config();
        if (!$config) {
            echo json_encode(['success' => false, 'message' => 'SMTP configuration is missing.']);
            return;
        }

        $this->load->library('email');
        $email_config = [
            'protocol' => 'smtp',
            'smtp_host' => $config['host'],
            'smtp_port' => $config['port'],
            'smtp_user' => $config['username'],
            'smtp_pass' => $config['password'],
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'smtp_crypto' => $config['encryption'],
            'newline' => "\r\n",
        ];

        $this->email->initialize($email_config);
        $sender_name = ($this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname')) ?? 'Adwiti Technocrats';
        $email_sent = false;

        foreach ($recipients as $recipient) {
            $to = $recipient['to'] ?? null;
            $cc = $recipient['cc'] ?? null;

            if ($to) {
                $this->email->from($config['username'], $sender_name);
                $this->email->to($to);

                if ($cc) {
                    $this->email->cc($cc);
                }

                $this->email->subject($subject);
                $this->email->message($message);

                // Attach inline images
                // foreach ($images as $image) {
                //     $this->email->attach($image['path'], 'inline', $image['name']);
                // }

                // Attach additional files if provided
                // if (!empty($attachments['name'])) {
                //     foreach ($attachments['name'] as $key => $attachment_name) {
                //         $attachment_tmp_name = $attachments['tmp_name'][$key];
                //         $this->email->attach($attachment_tmp_name, 'attachment', $attachment_name);
                //     }
                // }

                // Send the email and handle errors
                if ($this->email->send()) {
                    $email_sent = true;
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to send email. ' . $this->email->print_debugger()]);
                    return;
                }
            }
        }

        if ($email_sent) {
            echo json_encode(['success' => true, 'message' => 'Email sent successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Email sending failed.']);
        }
    }



    /**
     * Prepare email HTML content with inline styles.
     */
    private function prepare_email_html($html)
    {
        // Add default inline styles for tables (if not already styled)
        $styled_html = str_replace('<table', '<table style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;"', $html);
        $styled_html = str_replace('<th', '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;"', $styled_html);
        $styled_html = str_replace('<td', '<td style="border: 1px solid #ddd; padding: 8px;"', $styled_html);

        return $styled_html;
    }
    public function check_case_reference()
    {

        $case_reference = $this->input->post('case_reference'); // Get the case_reference from the POST data

        // Check if the case reference exists in the database
        $exists = $this->assignment->checkCaseReferenceExists($case_reference);

        // Return a JSON response indicating whether it exists or not
        echo json_encode(['exists' => $exists]);
    }

    public function outgoing_check_case_reference()
    {

        $case_reference = $this->input->post('case_reference'); // Get the case_reference from the POST data

        // Check if the case reference exists in the database
        $exists = $this->assignment->checkOutgoingCaseReferenceExists($case_reference);

        // Return a JSON response indicating whether it exists or not
        echo json_encode(['exists' => $exists]);
    }

    /* ------------------------------------------------------------------------- *
    * CATTLE CASE DATA
    * ------------------------------------------------------------------------- */
    public function updatecattlecaseData()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->assignment->updateCaseData(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Case data created successful");
                echo json_encode($response);
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }

    /* ------------------------------------------------------------------------- *
    * MOTOR CASE DATA
    * ------------------------------------------------------------------------- */

    public function updatemotorspotcaseData()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->assignment->updateCaseData(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Case data created successful");
                echo json_encode($response);
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }



    /* ------------------------------------------------------------------------- *
    * CATTLE ESSENTIAL DATA
    * ------------------------------------------------------------------------- */
    // public function cattleessentialdata()
    // {
    //     if ($this->session->userdata('id') !== null) {
    //         $essential = $this->input->post();

    //         // Validate required fields
    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
    //         $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
    //         $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

    //         if ($this->form_validation->run() === FALSE) {
    //             echo json_encode(array("status" => 400, "message" => validation_errors()));
    //             return;
    //         }

    //         // Sanitize input data
    //         $aid = $essential['aid'];
    //         $essentialSanitized = array_map('html_escape', $essential);

    //         // Begin database transaction
    //         // $this->db->trans_start();

    //         // Update case data
    //         $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $essential['aid']);
    //         print_r(json_encode($is_saved));
    //         exit;
    //         if ($is_saved) {
    //             // Prepare payment data
    //             $paymentDetails = array_filter([
    //                 'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
    //                 'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
    //                 'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
    //                 'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
    //                 'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
    //                 'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
    //             ]);

    //             // Prepare shipping data
    //             $shippingpaymentDetails = array_filter([
    //                 'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
    //                 'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
    //                 'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
    //                 'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
    //                 'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
    //                 'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

    //             ]);

    //             // Insert payment details if provided
    //             if (!empty($paymentDetails)) {
    //                 $paymentDetailsJson = json_encode($paymentDetails);
    //                 $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $essential['aid']);
    //             }

    //             // Insert shipping details if provided
    //             if (!empty($shippingpaymentDetails)) {
    //                 $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
    //                 $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $essential['aid']);
    //             }

    //             // Fetch existing jobdata using the model method
    //             $jobdataRow = $this->assignment->getjobData($essential['aid']);
    //             $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

    //             // Update jobdata fields
    //             $updateFields = array_filter([
    //                 'case_reference' => $essentialSanitized['case_reference'] ?? null,
    //                 'tagNumber' => $essentialSanitized['tagNumber'] ?? null,
    //                 'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
    //             ]);

    //             if (!empty($jobdata) && is_array($jobdata)) {
    //                 foreach ($updateFields as $key => $value) {
    //                     if ($value !== null) {
    //                         $jobdata[$key] = $value; // Update common fields in jobdata
    //                     }
    //                 }
    //                 $updateFields['jobdata'] = json_encode($jobdata);
    //             }

    //             // Perform the update for jobdata
    //             if (!empty($updateFields)) {
    //                 $this->assignment->updateCaseReferenceAndJobdata(
    //                     $essential['aid'],
    //                     $updateFields['case_reference'] ?? null,
    //                     $updateFields['jobdata'] ?? null
    //                 );
    //             }
    //         }

    //         // Complete transaction
    //         // $this->db->trans_complete();

    //         if ($this->db->trans_status() === FALSE) {
    //             echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
    //             log_message('error', 'Failed transaction for aid: ' . $essential['aid']);
    //         } else {
    //             echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }

    public function cattleessentialdata()
    {
        if ($this->session->userdata('id') === null) {
            redirect('user_logout');
        }

        $essential = $this->input->post();

        // Load form validation library
        $this->load->library('form_validation');

        // Define validation rules
        $this->form_validation->set_rules('aid', 'Assignment ID', 'required|trim');
        $this->form_validation->set_rules('payment_by', 'Payment By', 'trim|required');
        $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim|required');
        $this->form_validation->set_rules('case_reference', 'Case Reference', 'trim|required');
        $this->form_validation->set_rules('tagNumber', 'Tag Number', 'trim|required');

        // Run validation
        if ($this->form_validation->run() === FALSE) {
            echo json_encode([
                "status" => 400,
                "message" => validation_errors()
            ]);
            return;
        }

        // Sanitize input data
        $aid = $essential['aid'];
        $essentialSanitized = array_map('html_escape', $essential);

        // Start database transaction
        $this->db->trans_start();

        // Update essential data
        $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);

        if (!$is_saved) {
            $this->db->trans_rollback();
            echo json_encode([
                "status" => 500,
                "message" => "Failed to update essential data."
            ]);
            log_message('error', 'Failed to update essential data for aid: ' . $aid);
            return;
        }

        // Prepare payment details
        $paymentDetails = array_filter([
            'billing_payment_by'  => $essentialSanitized['payment_by'] ?? null,
            'billing_branch_name' => $essentialSanitized['payment_branch_name'] ?? null,
            'billing_user_name'   => $essentialSanitized['payment_user_name'] ?? null,
            'billing_mobile_num'  => $essentialSanitized['payment_mobile_num'] ?? null,
            'billing_gst'         => $essentialSanitized['payment_gst'] ?? null,
            'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
        ]);

        // Prepare shipping details
        $shippingDetails = array_filter([
            'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
            'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
            'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
            'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
            'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
            'shipbilling_id'       => $essentialSanitized['appointbillingto'] ?? null,
        ]);

        // Insert payment details if provided
        if (!empty($paymentDetails)) {
            $paymentDetailsJson = json_encode($paymentDetails);
            if (!$this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid)) {
                $this->db->trans_rollback();
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to insert payment details."
                ]);
                log_message('error', 'Failed to insert payment details for aid: ' . $aid);
                return;
            }
        }

        // Insert shipping details if provided
        if (!empty($shippingDetails)) {
            $shippingDetailsJson = json_encode($shippingDetails);
            if (!$this->assignment->insertshippingEssentialData($shippingDetailsJson, $aid)) {
                $this->db->trans_rollback();
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to insert shipping details."
                ]);
                log_message('error', 'Failed to insert shipping details for aid: ' . $aid);
                return;
            }
        }

        // Fetch existing job data
        $jobdataRow = $this->assignment->getjobData($aid);
        $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

        // Update job data fields
        $updateFields = array_filter([
            'case_reference'         => $essentialSanitized['case_reference'] ?? null,
            'tagNumber'              => $essentialSanitized['tagNumber'] ?? null,
            'contact_person_mobile'  => $essentialSanitized['contact_person_mobile'] ?? null,
        ]);

        if (!empty($jobdata) && is_array($jobdata)) {
            foreach ($updateFields as $key => $value) {
                if ($value !== null) {
                    $jobdata[$key] = $value; // Update common fields in jobdata
                }
            }
            $updateFields['jobdata'] = json_encode($jobdata);
        }

        // Perform the update for jobdata
        if (!empty($updateFields)) {
            $updated = $this->assignment->updateCaseReferenceAndJobdata(
                $aid,
                $updateFields['case_reference'] ?? null,
                $updateFields['jobdata'] ?? null
            );

            if (!$updated) {
                $this->db->trans_rollback();
                echo json_encode([
                    "status" => 500,
                    "message" => "Failed to update case reference and job data."
                ]);
                log_message('error', 'Failed to update jobdata for aid: ' . $aid);
                return;
            }
        }

        // Complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode([
                "status" => 500,
                "message" => "Database transaction failed"
            ]);
            log_message('error', 'Failed transaction for aid: ' . $aid);
        } else {
            echo json_encode([
                "status" => 200,
                "message" => "Essential data updated successfully"
            ]);
        }
    }

    /* ------------------------------------------------------------------------- *
    * RISK INSPECTION ESSENTIAL 
    * ------------------------------------------------------------------------- */

    public function riskeessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essentialSanitized['case_reference'] ?? null,
                    'insured_name'  => $essentialSanitized['insured_name'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function motorspotessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'claim_no' => $essential['claim_no'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'cause_loss' => $essential['cause_loss'] ?? null,
                    'insured_name' => $essential['insured_name'] ?? null,
                    'vehicle_number' => $essential['vehicle_number'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'address' => $essentialSanitized['address'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }


    /* ------------------------------------------------------------------------- *
    * ESSENTIAL DATA FOR INDIVIDUAL 
    * ------------------------------------------------------------------------- */

    public function motorspotessential_outgoing()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateoutgoingEssentialData(json_encode($essentialSanitized), $aid)) {

                // Skip payment & shipping details (completely removed)

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getoutgoingjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'claim_no' => $essential['claim_no'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'cause_loss' => $essential['cause_loss'] ?? null,
                    'insured_name' => $essential['insured_name'] ?? null,
                    'vehicle_number' => $essential['vehicle_number'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'address' => $essentialSanitized['address'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Update jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateoutgoingCaseReference(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function assetsessential_outgoing()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateoutgoingEssentialData(json_encode($essentialSanitized), $aid)) {

                // Skip payment & shipping details (completely removed)

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getoutgoingjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                // Update jobdata with new values
                $updateFields = array_filter([
                    'case_reference' => $essentialSanitized['case_reference'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'date_of_report' => $essentialSanitized['date_of_report'] ?? null,
                    'address' => $essentialSanitized['address'] ?? null,
                    'valuation_type' => $essentialSanitized['valuation_type'] ?? null,
                    'visitdate' => $essentialSanitized['visitdate'] ?? null,
                    'asset_value' => $essentialSanitized['asset_value'] ?? null
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Update jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateoutgoingCaseReference(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function ebdeathessential_outgoing()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateoutgoingEssentialData(json_encode($essentialSanitized), $aid)) {

                // Skip payment & shipping details (completely removed)

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getoutgoingjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference'        => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name'   => $essentialSanitized['contact_person_name'] ?? null,
                    'insured_name'          => $essentialSanitized['insured_name'] ?? null,
                    'salutation'            => $essentialSanitized['salutation'] ?? null,
                    'policyNumber'          => $essential['policyNumber'] ?? null,
                    'address'               => $essential['address'] ?? null
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Update jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateoutgoingCaseReference(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function marinepredispatchessential_outgoing()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateoutgoingEssentialData(json_encode($essentialSanitized), $aid)) {

                // Skip payment & shipping details (completely removed)

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getoutgoingjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'name_of_consignee' => $essentialSanitized['name_of_consignee'] ?? null,
                    'name_of_commodity' => $essentialSanitized['name_of_commodity'] ?? null,
                    'insured_name' => $essentialSanitized['insured_name'] ?? null,
                    'available_at_location' => $essentialSanitized['available_at_location'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'invoices' => isset($essential['invoices']) ? json_encode($essential['invoices']) : null, // Adding invoices field
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Update jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateoutgoingCaseReference(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }


    /* ------------------------------------------------------------------------- *
    * CASE DATA FOR INDIVIDUAL 
    * ------------------------------------------------------------------------- */
    public function updateebdeathcasedata_outgoing()
    {
        if ($this->session->userdata('id') === null) {
            echo json_encode(["status" => 401, "message" => "Session expired. Please log in again."]);
            return;
        }

        $essential = $this->input->post();
        if (empty($essential['aid']) || !is_numeric($essential['aid'])) {
            echo json_encode(["status" => 400, "message" => "Invalid input: 'aid' is required and must be a number."]);
            return;
        }

        $aid = intval($essential['aid']);
        unset($essential['aid']);

        function sanitizeData($data)
        {
            if (is_array($data)) {
                return array_map('sanitizeData', $data);
            }
            return html_escape(trim($data));
        }

        $sanitizedData = sanitizeData($essential);

        $is_saved = $this->assignment->updateCaseData_outgoing(json_encode($sanitizedData), $aid);

        if ($is_saved) {
            echo json_encode(["status" => 200, "message" => "Report data updated successfully."]);
        } else {
            echo json_encode(["status" => 500, "message" => "Failed to update case data."]);
        }
    }

    public function updatemotorspotcaseData_outgoing()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->assignment->updateCaseData_outgoing(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Case data created successful");
                echo json_encode($response);
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }



    /* ------------------------------------------------------------------------- *
    * MOTOR FINAL ESSENTIAL 
    * ------------------------------------------------------------------------- */
    public function motorfinalessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'claim_no' => $essential['claim_no'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'insured_name' => $essential['insured_name'] ?? null,
                    'vehicle_number' => $essential['vehicle_number'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null

                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    /* ------------------------------------------------------------------------- *
    * MOTOR PRE INSURANCE ESSENTIAL 
    * ------------------------------------------------------------------------- */

    public function motorpreinsessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }

    public function motortheftsessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }


    public function motortheftsessentialtemplate()
    {
        if ($this->session->userdata('id') === null) {
            redirect('user_logout');
            return;
        }

        // Raw JSON input
        $essentialJson = $this->input->post('essentialdata', false); // Don't XSS clean
        $caseJson = $this->input->post('casedata', false);

        // Decode into arrays
        $essential = json_decode($essentialJson, true);
        $casedata = json_decode($caseJson, true);

        // Validate required essential fields
        $this->load->library('form_validation');
        if (!isset($essential['payment_by']) || !isset($essential['appoint_by'])) {
            echo json_encode(["status" => 400, "message" => "Payment By and Appoint By are required."]);
            return;
        }

        // Start DB transaction
        $this->db->trans_start();

        if (!empty($essential['id'])) {
            // Update
            $updateData = [
                'essentialdata' => $essentialJson,
                'casedata' => $caseJson,
                'natureofjob' => $essential['natureofjob'] ?? '',
                'template_name' => $essential['template_name'] ?? '',
            ];
            $is_saved = $this->assignment->updateEssentialDatatemplate($updateData, $essential['id']);
            $recordId = $essential['id'];
        } else {
            // Insert
            $insertData = [
                'userId' => $this->session->userdata('id'),
                'case_reference' => $essential['case_reference'] ?? '',
                'template_name' => $essential['template_name'] ?? '',
                'natureofjob' => $essential['natureofjob'] ?? '',
                'essentialdata' => $essentialJson,
                'casedata' => $caseJson,
                'createdAt' => date('Y-m-d H:i:s')
            ];


            $is_saved = $this->assignment->insertEssentialDatatemplate($insertData);
            $recordId = $this->db->insert_id();
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE || !$is_saved) {
            echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
        } else {
            echo json_encode(["status" => 200, "message" => "Essential and Case data saved successfully", "id" => $recordId]);
        }
    }

    // public function motortheftsessentialtemplate()
    // {
    //     if ($this->session->userdata('id') !== null) {
    //         $essential = $this->input->post();

    //         // Validate required fields
    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('payment_by', 'Payment By', 'trim|required');
    //         $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim|required');

    //         if ($this->form_validation->run() === FALSE) {
    //             echo json_encode(array("status" => 400, "message" => validation_errors()));
    //             return;
    //         }

    //         $essentialSanitized = array_map('html_escape', $essential);

    //         // Begin DB transaction
    //         $this->db->trans_start();

    //         if (!empty($essential['id'])) {
    //             // Update existing
    //             $is_saved = $this->assignment->updateEssentialDatatemplate(json_encode($essentialSanitized), $essential['id']);
    //         } else {
    //             // Insert new
    //             $insertData = array(
    //                 'userId' => $this->session->userdata('id'),
    //                 'case_reference' => $essentialSanitized['case_reference'] ?? '',
    //                 'natureofjob' => $essentialSanitized['natureofjob'] ?? '',
    //                 'essentialdata' => json_encode($essentialSanitized),
    //                 'createdAt' => date('Y-m-d H:i:s')
    //             );
    //             $is_saved = $this->assignment->insertEssentialDatatemplate($insertData);
    //         }

    //         $this->db->trans_complete();

    //         if ($this->db->trans_status() === FALSE || !$is_saved) {
    //             echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
    //         } else {
    //             echo json_encode(array("status" => 200, "message" => "Essential data saved successfully"));
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }



    /* ------------------------------------------------------------------------- *
    * MARINE ESSENTIAL  
    * ------------------------------------------------------------------------- */
    public function motortpessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }

    private function assessmentTable()
    {
        $editIconUrl = base_url('assets/edit.png');

        return '<table class="table table-bordered" id="assessmentTable">
                  <thead>
                    <tr>
                      <th contenteditable="false" style="font-size:13px;">S.No</th>
                      <th contenteditable="true" style="font-size:13px;min-width:200px;">
                        Type of Particulars 
                        <img src="' . $editIconUrl . '" alt="Edit" 
                             style="max-height:16px; margin-left:5px; cursor:pointer;margin-bottom:5px;" 
                             id="editAssessmentBtn">
                      </th>
                      <th contenteditable="true" style="font-size:13px;min-width:250px;">Particulars</th>
                      <th contenteditable="true" style="font-size:13px;min-width:50px;">Estimate</th>
                      <th contenteditable="true" style="font-size:13px;">Bill S.No</th>
                      <th contenteditable="true" style="font-size:13px;">Amount</th>
                      <th contenteditable="true" style="font-size:13px;">GST</th>
                      <th contenteditable="true" style="font-size:13px;">Assessment</th>
                      <th contenteditable="true" class="remove-header" style="font-size:13px; width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody id="assessmentrow">
                  </tbody>
                </table>';
    }

    public function assessmentdata()
    {
        if ($this->session->userdata('id') !== null) {
            $assessment = $this->input->post();

            $aid = $assessment['aid'] ?? null;
            $assessmentSanitized = array_map('html_escape', $assessment);

            if (!$aid) {
                echo json_encode(["status" => 400, "message" => "Assignment ID is required."]);
                return;
            }

            // Prepare data to save
            $dataToSave = [
                'aid' => $aid,
                'parameterized' => json_encode($assessmentSanitized)
            ];

            $result = $this->assignment->updatAssesmentData($dataToSave);

            if (!$result['status']) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Database transaction failed",
                    "error_code" => $result['error_code'] ?? null,
                    "error_message" => $result['error_message'] ?? 'Unknown error'
                ]);
            } else {
                echo json_encode([
                    "status" => 200,
                    "message" => "Assessment data updated successfully",
                    "data" => $assessmentSanitized
                ]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function get_assessment_data()
    {
        $aid = $this->input->post('aid');
        $this->load->model('assignment');

        $data = $this->assignment->getAssessmentByAid($aid);
        if ($data) {
            echo json_encode(["status" => 200, "data" => $data]);
        } else {
            echo json_encode(["status" => 404, "message" => "Assessment not found"]);
        }
    }


    public function finalizeAssessment()
    {
        if ($this->session->userdata('id') !== null) {
            $assessment = $this->input->post();

            $aid = $this->input->post('aid');
            $assessmentJson = $this->input->post('assessmentrow');

            $assessmentRows = json_decode($assessmentJson, true);

            if (!$aid || !$assessmentRows) {
                echo json_encode(["status" => 400, "message" => "Missing data"]);
                return;
            }


            $assessmentRows = array_map(function ($row) {
                return array_map('html_escape', $row);
            }, $assessmentRows);

            // Save or update
            $data = [
                'aid' => $aid,
                'assessment' => json_encode($assessmentRows)
            ];

            $result = $this->assignment->updatfinalizeAssesmentData($data);

            $assessmentview = $this->assessment_view($assessmentRows, $aid);
            if (!$result['status']) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Database transaction failed",
                    "error_code" => $result['error_code'] ?? null,
                    "error_message" => $result['error_message'] ?? 'Unknown error'

                ]);
                log_message('error', 'Failed transaction for aid: ' . $aid . ' DB Error: ' . ($result['error_message'] ?? ''));
            } else {
                echo json_encode(["status" => 200, "message" => "Assessment data updated successfully", "data" => $assessmentview]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function submitfinalassessment()
    {
        if ($this->session->userdata('id') !== null) {
            $aid = $this->input->post('aid');
            $assessmentRows = $this->input->post('rows'); // this will be an array

            if (!$aid || !$assessmentRows || !is_array($assessmentRows)) {
                echo json_encode(["status" => 400, "message" => "Missing or invalid data"]);
                return;
            }

            // Sanitize each row and its fields
            $assessmentRows = array_map(function ($row) {
                return array_map('html_escape', $row);
            }, $assessmentRows);

            // Prepare data to save
            $data = [
                'aid' => $aid,
                'finalize_assessment' => json_encode($assessmentRows)
            ];

            // Call your model to update
            $result = $this->assignment->updatfinalizeAssesmentData($data);

            if (!$result['status']) {
                echo json_encode([
                    "status" => 500,
                    "message" => "Database transaction failed",
                    "error_code" => $result['error_code'] ?? null,
                    "error_message" => $result['error_message'] ?? 'Unknown error'
                ]);
                log_message('error', 'Failed transaction for aid: ' . $aid . ' DB Error: ' . ($result['error_message'] ?? ''));
            } else {
                echo json_encode([
                    "status" => 200,
                    "message" => "Assessment data updated successfully",
                    "data" => $assessmentRows // or return processed data if needed
                ]);
            }
        } else {
            redirect('user_logout');
        }
    }


    // public function assessment_view($data, $aid)
    // {
    //     $html_rows = '';

    //     if (is_string($data)) {
    //         $json_data = json_decode($data, true);
    //         if ($json_data === null) {
    //             // You may throw an error or return empty string
    //             return "Invalid JSON data";
    //         }
    //     } else {
    //         $json_data = $data;
    //     }

    //     $parametarized_data = $this->assignment->getassessmentdatabyaid($aid);
    //     $parametarData = $parametarized_data ? json_decode($parametarized_data, true) : null;


    //     // Step 1: Get unique assessment parts
    //     $assessment_parts = [];
    //     foreach (['parts', 'labour'] as $category) {
    //         if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
    //             continue;  // or handle error
    //         }
    //         foreach ($json_data[$category] as $item) {
    //             if (is_array($item) && isset($item['part'])) {
    //                 $part = $item['part'];
    //             } else {
    //                 // If item is string (like for parts), use item itself
    //                 $part = $item;
    //             }
    //             if (!in_array($part, $assessment_parts)) {
    //                 $assessment_parts[] = $part;
    //             }
    //         }
    //     }


    //     $total_count = count($assessment_parts);
    //     // Prepare optional salvage column
    //     $salvage_th = '';
    //     if ($parametarData['radio02'] == 1) {
    //         $salvage_th = '<th colspan="2" style="font-size:13px;">Salvage</th>';
    //     }

    //     // Build table HTML
    //     $html_rows .= '<table>
    //             <thead>
    //                 <tr>
    //                     <th colspan="5">Estimate</th>
    //                     <th colspan="3">Bill</th>
    //                     <th colspan="' . $total_count . '">Assessment</th>' .
    //         $salvage_th .
    //         '</tr>
    //                 <tr>
    //                     <th>S.No</th>
    //                     <th colspan ="2">Item</th>
    //                     <th>Prt Amt</th>
    //                     <th>Lab Amt</th>
    //                     <th>Bill S.No</th>
    //                     <th>Prt/Lab Amt</th>
    //                     <th>GST</th>';



    //     foreach ($assessment_parts as $part_type) {
    //         $dpn_value = '';
    //         foreach (['parts', 'labour'] as $category) {
    //             if (!isset($json_data[$category])) continue;
    //             foreach ($json_data[$category] as $item) {
    //                 if (($item['part'] ?? '') === $part_type && isset($item['dpn'])) {
    //                     $dpn_value = $item['dpn'];
    //                     break 2;
    //                 }
    //             }
    //         }
    //         $html_rows .= '<th>' . $part_type . '</br> ' . ' DPN @ ' . $dpn_value . '% </th>';
    //     }


    //     if (isset($parametarData['radio02']) && $parametarData['radio02'] == 1) {
    //         $html_rows .= '<th>%</th><th>Amt</th>';
    //     }


    //     $html_rows .= '</tr></thead><tbody>';


    //     $sl = 1;
    //     $total_prt_amt = 0;
    //     $total_lab_amt = 0;
    //     $total_bill_amt = 0;
    //     $assessment_totals = array_fill_keys($assessment_parts, 0);
    //     $total_salvage_amt = 0;

    //     foreach (['parts', 'labour'] as $category) {
    //         if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
    //             continue;
    //         }

    //         foreach ($json_data[$category] as $item) {
    //             if (!is_array($item)) {
    //                 $item = [
    //                     'particulars'    => $item,
    //                     'estimate_part'  => 0,
    //                     'estimate_lab'   => 0,
    //                     'bill_no'        => '',
    //                     'bill_amount'    => 0,
    //                     'gst'            => 0,
    //                     'part'           => $item,
    //                     'assessment'     => 0,
    //                     'assessment_lab' => 0,
    //                     'salvage_per'    => 0,
    //                     'salvage'        => 0,
    //                 ];
    //             }
    //             if ($category == 'parts') {
    //                 $particular = 'P';
    //             } else {
    //                 $particular = 'L';
    //             }
    //             $html_rows .= '<tr>';
    //             $html_rows .= '<td>' . $sl . '</td>';
    //             $html_rows .= '<td>' . $particular . '</td>';
    //             $html_rows .= '<td>' . $item['particulars'] . '</td>';
    //             $html_rows .= '<td>' . $item['estimate_part'] . '</td>';
    //             $total_prt_amt += (float)$item['estimate_part'];

    //             if ($category === 'labour') {
    //                 $html_rows .= '<td>' . $item['estimate_lab'] . '</td>';
    //                 $total_lab_amt += (float)$item['estimate_lab'];
    //             } else {
    //                 $html_rows .= '<td>0</td>';
    //             }

    //             $html_rows .= '<td>' . $item['bill_no'] . '</td>';
    //             $html_rows .= '<td>' . $item['bill_amount'] . '</td>';
    //             $html_rows .= '<td>' . $item['gst'] . '%</td>';
    //             $total_bill_amt += (float)$item['bill_amount'];

    //             foreach ($assessment_parts as $part_type) {
    //                 if ($part_type === 'Labour') {
    //                     $val = isset($item['assessment_lab']) ? $item['assessment_lab'] : 0;
    //                     if ($item['part'] === 'Labour' && isset($item['assessment'])) {
    //                         $val = $item['assessment'];
    //                     }
    //                     $html_rows .= '<td>' . $val . '</td>';
    //                     $assessment_totals['Labour'] += (float)$val;
    //                 } elseif ($item['part'] === $part_type) {
    //                     $html_rows .= '<td>' . $item['assessment'] . '</td>';
    //                     $assessment_totals[$part_type] += (float)$item['assessment'];
    //                 } else {
    //                     $html_rows .= '<td>0</td>';
    //                 }
    //             }

    //             $salvage_per = is_numeric($item['salvage_per']) ? $item['salvage_per'] : 0;
    //             $salvage_val = is_numeric($item['salvage']) ? $item['salvage'] : 0;

    //             if ($parametarData['radio02'] == 1) {
    //                 $html_rows .= '<td>' . $salvage_per . '</td>';
    //                 $html_rows .= '<td>' . $salvage_val . '</td>';
    //             }

    //             $total_salvage_amt += (float)$salvage_val;

    //             $html_rows .= '</tr>';
    //             $sl++;
    //         }
    //     }

    //     // Total row with round figures
    //     $html_rows .= '<tr style="font-weight:bold; background-color:#f0f0f0">';
    //     $html_rows .= '<td colspan="3">Total</td>';
    //     $html_rows .= '<td>' . round($total_prt_amt) . '</td>';
    //     $html_rows .= '<td>' . round($total_lab_amt) . '</td>';
    //     $html_rows .= '<td colspan="2">-</td><td>-</td>';

    //     foreach ($assessment_parts as $part_type) {
    //         $html_rows .= '<td>' . round($assessment_totals[$part_type]) . '</td>';
    //     }

    //     if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
    //         $html_rows .= '<td>0</td><td>' . round($total_salvage_amt) . '</td>';
    //     }

    //     $html_rows .= '</tr>';


    //     $html_rows .= '</tr>';

    //     // GST-wise grouping
    //     $gst_groups = [];
    //     $gst_sl_map = [];
    //     $sl_counter = 1;

    //     $grand_part_gst = 0;
    //     $grand_lab_gst = 0;
    //     $grand_assessment_gst = array_fill_keys($assessment_parts, 0);

    //     foreach (['parts', 'labour'] as $category) {
    //         // Skip if category doesn't exist or is not an array
    //         if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
    //             continue;
    //         }

    //         foreach ($json_data[$category] as $item) {
    //             if (!is_array($item)) {
    //                 continue;
    //             }

    //             $gst = $item['gst'] ?? 0;
    //             $part = $item['part'] ?? 'Unknown';

    //             // Initialize GST group if not already set
    //             if (!isset($gst_groups[$gst])) {
    //                 $gst_groups[$gst] = [];

    //                 // Initialize all assessment parts
    //                 foreach ($assessment_parts as $part_name) {
    //                     $gst_groups[$gst][$part_name] = 0;
    //                 }

    //                 // Always ensure 'Labour' is initialized
    //                 $gst_groups[$gst]['Labour'] = 0;

    //                 $gst_sl_map[$gst] = [];
    //             }

    //             $gst_sl_map[$gst][] = $sl_counter;

    //             if ($part !== 'Labour') {
    //                 $gst_groups[$gst][$part] += $item['assessment'] ?? 0;
    //                 $gst_groups[$gst]['Labour'] += $item['assessment_lab'] ?? 0;
    //             } else {
    //                 $gst_groups[$gst]['Labour'] += $item['assessment'] ?? 0;
    //             }

    //             $sl_counter++;
    //         }
    //     }



    //     foreach ($gst_groups as $gst => $parts_data) {
    //         $row_nos = implode(',', $gst_sl_map[$gst]);

    //         $html_rows .= '<tr style="background-color:#e8f7ff; font-style:italic;">';
    //         $html_rows .= '<td colspan="3">GST @' . $gst . '% - (' . $row_nos . ')</td>';

    //         $total_part_amt = 0;
    //         $total_lab_amt_gst = 0;

    //         foreach (['parts', 'labour'] as $category) {
    //             foreach ($json_data[$category] as $item) {
    //                 if ($item['gst'] == $gst) {
    //                     if ($category === 'parts') {
    //                         $total_part_amt += $item['estimate_part'] ?? 0;
    //                     }
    //                     if ($category === 'labour') {
    //                         $total_lab_amt_gst += $item['estimate_lab'] ?? 0;
    //                     }
    //                 }
    //             }
    //         }

    //         $part_gst_amount = ($total_part_amt * $gst) / 100;
    //         $lab_gst_amount = ($total_lab_amt_gst * $gst) / 100;

    //         $grand_part_gst += $part_gst_amount;
    //         $grand_lab_gst += $lab_gst_amount;

    //         $html_rows .= '<td>' . number_format($part_gst_amount, 2) . '</td>';
    //         $html_rows .= '<td>' . number_format($lab_gst_amount, 2) . '</td>';
    //         $html_rows .= '<td colspan="2">-</td><td>0.00</td>';

    //         foreach ($assessment_parts as $part_type) {
    //             $part_assessment_sum = $parts_data[$part_type];
    //             $part_gst = ($part_assessment_sum * $gst) / 100;
    //             $grand_assessment_gst[$part_type] += $part_gst;
    //             $html_rows .= '<td>' . number_format($part_gst, 2) . '</td>';
    //         }

    //         if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
    //             $html_rows .= '<td>-</td><td>0.00</td>';
    //         }
    //         $html_rows .= '</tr>';
    //     }

    //     // Grand Total including GST
    //     $html_rows .= '<tr style="font-weight:bold; background-color:#d1f0d1;">';
    //     $html_rows .= '<td colspan="3">Grand Total (Incl. GST)</td>';
    //     $html_rows .= '<td>' . number_format($total_prt_amt + $grand_part_gst, 2) . '</td>';
    //     $html_rows .= '<td>' . number_format($total_lab_amt + $grand_lab_gst, 2) . '</td>';
    //     $html_rows .= '<td colspan="2">-</td><td>-</td>';

    //     foreach ($assessment_parts as $part_type) {
    //         $total_with_gst = $assessment_totals[$part_type] + $grand_assessment_gst[$part_type];
    //         $html_rows .= '<td>' . number_format($total_with_gst, 2) . '</td>';
    //     }

    //     if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
    //         $html_rows .= '<td>0</td><td>' . $total_salvage_amt . '</td>';
    //     }

    //     $html_rows .= '</tr>';

    //     // DPN value row (12% of assessment+gst)
    //     $html_rows .= '<tr style="background-color:#fff0f5;">';
    //     $html_rows .= '<td colspan="8"><strong>Depriciation Amount</strong></td>';

    //     foreach ($assessment_parts as $part_type) {
    //         $dpn_value = 0;

    //         foreach (['parts', 'labour'] as $category) {
    //             // Check if the category exists and is an array
    //             if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
    //                 continue;
    //             }

    //             foreach ($json_data[$category] as $item) {
    //                 // Skip invalid items
    //                 if (!is_array($item)) {
    //                     continue;
    //                 }

    //                 if (($item['part'] ?? '') === $part_type && is_numeric($item['dpn'] ?? null)) {
    //                     $dpn_value = $item['dpn'];
    //                     break 2; // Break both loops once found
    //                 }
    //             }
    //         }

    //         $base_amount = ($assessment_totals[$part_type] ?? 0) + ($grand_assessment_gst[$part_type] ?? 0);
    //         $dpn_amount = ($dpn_value / 100) * $base_amount;

    //         $html_rows .= '<td>' . number_format($dpn_amount, 2) . '</td>';
    //     }


    //     if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
    //         $html_rows .= '<td colspan="2">-</td>';
    //     }

    //     $html_rows .= '</tr>';

    //     // Final Grand Total row including GST + DPN
    //     $html_rows .= '<tr style="font-weight:bold; background-color:#fffacc;">';
    //     $html_rows .= '<td colspan="8"><strong>Total</strong></td>';

    //     $total_all_parts = 0; // Initialize total
    //     $total_all_labour = 0; // Initialize total
    //     foreach ($assessment_parts as $part_type) {
    //         $dpn_value = 0;
    //         $current_category = ''; // To track whether it's parts or labour
    //         foreach (['parts', 'labour'] as $category) {
    //             foreach ($json_data[$category] as $item) {
    //                 if ($item['part'] === $part_type && is_numeric($item['dpn'])) {
    //                     $dpn_value = $item['dpn'];
    //                     $current_category = $category; // Save the category
    //                     break 2;
    //                 }
    //             }
    //         }

    //         $base_amount = $assessment_totals[$part_type] + $grand_assessment_gst[$part_type];
    //         $dpn_amount = ($dpn_value / 100) * $base_amount;
    //         $total_with_all = $base_amount - $dpn_amount;

    //         // Add to respective total
    //         if ($current_category === 'parts') {
    //             $total_all_parts += $total_with_all;
    //         } elseif ($current_category === 'labour') {
    //             $total_all_labour += $total_with_all;
    //         }

    //         $html_rows .= '<td>' . number_format($total_with_all, 2) . '</td>';
    //     }

    //     if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
    //         $html_rows .= '<td colspan="2">-</td>';
    //     }

    //     $html_rows .= '</tr>';

    //     $html_rows .= '</table>';

    //     $summary = '';

    //     $additional_data = json_decode($this->assignment->getAdditionalDataByaid($aid), true);

    //     // Set defaults to avoid undefined index warnings
    //     $towing_estimated = isset($additional_data['towing_estimated']) ? $additional_data['towing_estimated'] : 0;
    //     $towing_allowed = isset($additional_data['towing_allowed']) ? $additional_data['towing_allowed'] : 0;
    //     $nil_dep = isset($additional_data['nil_dep']) ? $additional_data['nil_dep'] : 'no';
    //     $normal_excess = isset($additional_data['normal_excess']) ? $additional_data['normal_excess'] : 0;
    //     $imposed_excess = isset($additional_data['imposed_excess']) ? $additional_data['imposed_excess'] : 0;
    //     $lumpsum_value = isset($parametarData['lumpsum_value']) ? $parametarData['lumpsum_value'] : 0;
    //     $radio02 = isset($parametarData['radio02']) ? $parametarData['radio02'] : null;

    //     $summary .= '<table style="width:100%; margin-top:15px; float:left">
    //                     <thead>
    //                       <tr style="font-weight:bold">
    //                         <th>Summary</th>
    //                         <th>Estimated</th>
    //                         <th>Assessed</th>
    //                         <th style="border:none;"></th>


    //                       </tr>
    //                     </thead>';

    //     // Cost of Parts row
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Cost of Parts</td>';
    //     $summary .= '<td>' . number_format($total_prt_amt, 2) . '</td>';
    //     $summary .= '<td>' . number_format($total_all_parts, 2) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;"></td>';

    //     $summary .= '</tr>';

    //     // Labour row
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Labour</td>';
    //     $summary .= '<td>' . number_format($total_lab_amt, 2) . '</td>';
    //     $summary .= '<td>' . number_format($total_all_labour, 2) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;"></td>';

    //     $summary .= '</tr>';

    //     // Total row
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Total</td>';
    //     $summary .= '<td>' . number_format($total_prt_amt + $total_lab_amt, 2) . '</td>';
    //     $summary .= '<td>' . number_format($total_all_parts + $total_all_labour, 2) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;"></td>';

    //     $summary .= '</tr>';

    //     // Add Towing
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Add Towing</td>';
    //     $summary .= '<td>' . number_format($towing_estimated, 2) . '</td>';
    //     $summary .= '<td>' . number_format($towing_allowed, 2) . '</td>';
    //     $summary .= '<td style="border:none;">(Subject to Bill to be provided by Insured / Repairer)</td>';

    //     $summary .= '</tr>';

    //     // Less Salvage
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Less Salvage</td>';
    //     $summary .= '<td>0.00</td>';


    //     if (!empty($radio02) && $radio02 == 1) {
    //         $summary .= '<td>' . number_format($total_salvage_amt, 2) . '</td>';
    //     } else {
    //         $summary .= '<td>' . number_format($lumpsum_value, 2) . '</td>';
    //     }
    //     $summary .= '<td colspan="4" style="border:none;">(Subject to insurer approval)</td>';
    //     $summary .= '</tr>';

    //     // Add Nil Dep
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Add Nil Dep</td>';
    //     $summary .= '<td>0.00</td>';
    //     $summary .= '<td >' . ($nil_dep === "yes" ? '0.00' : number_format($dpn_amount, 2)) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;"></td>';

    //     $summary .= '</tr>';

    //     // Less Excess
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Less Excess</td>';
    //     $summary .= '<td>0.00</td>';
    //     $summary .= '<td>' . number_format($normal_excess, 2) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;">(Compulsory Excess)</td>';

    //     $summary .= '</tr>';

    //     // Less Imposed Excess
    //     $summary .= '<tr>';
    //     $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Less Imposed Excess</td>';
    //     $summary .= '<td>0.00</td>';
    //     $summary .= '<td>' . number_format($imposed_excess, 2) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;"></td>';

    //     $summary .= '</tr>';

    //     // Calculations for final values (use raw numbers here, no formatting)
    //     $final_estimated = $total_prt_amt + $total_lab_amt + $towing_estimated + 0 + 0 + 0 + 0;

    //     $final_assessed = $total_all_parts + $total_all_labour + $towing_allowed;

    //     if (!empty($radio02) && $radio02 == 1) {
    //         $final_assessed -= $total_salvage_amt;
    //     } else {
    //         $final_assessed -= $lumpsum_value;
    //     }

    //     $final_assessed -= ($nil_dep === "yes" ? 0 : $dpn_amount);
    //     $final_assessed -= $normal_excess;
    //     $final_assessed -= $imposed_excess;

    //     // Net Assessed Loss row
    //     $summary .= '<tr style="font-weight:bold;">';
    //     $summary .= '<td>Net Assessed Loss</td>';
    //     $summary .= '<td>' . number_format($final_estimated, 2) . '</td>';
    //     $summary .= '<td>' . number_format($final_assessed, 2) . '</td>';
    //     $summary .= '<td colspan="4" style="border:none;"></td>';

    //     $summary .= '</tr>';

    //     $summary .= '</table>';

    //     // $summary .= '<div style="padding:70px; font-size:12px;">
    //     //                 <p>(Subject to Bill to be provided by Insured / Repairer)</p>
    //     //                 <p>(Subject to insurer approval)</p>
    //     //                 <p>(Compulsory Excess)</p>
    //     //             </div>';

    //     return $html_rows . $summary;
    // }

    public function assessment_view($data, $aid)
    {

        $html_rows = '';
        if (is_string($data)) {
            $json_data = json_decode($data, true);
            if ($json_data === null) {
                // You may throw an error or return empty string
                return "Invalid JSON data";
            }
        } else {
            $json_data = $data;
        }

        $parametarized_data = $this->assignment->getassessmentdatabyaid($aid);
        $parametarData = $parametarized_data ? json_decode($parametarized_data, true) : null;


        // Step 1: Get unique assessment parts
        $assessment_parts = [];
        foreach (['parts', 'labour'] as $category) {
            if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
                continue;  // or handle error
            }
            foreach ($json_data[$category] as $item) {
                if (is_array($item) && isset($item['part'])) {
                    $part = $item['part'];
                } else {
                    // If item is string (like for parts), use item itself
                    $part = $item;
                }
                if (!in_array($part, $assessment_parts)) {
                    $assessment_parts[] = $part;
                }
            }
        }


        $total_count = count($assessment_parts);
        // Prepare optional salvage column
        $salvage_th = '';
        if ($parametarData['radio02'] == 1) {
            $salvage_th = '<th colspan="2" style="font-size:13px;">Salvage</th>';
        }

        // Build table HTML
        $html_rows .= '<table>
        <thead>
        <tr>
        <th colspan="5">Estimate</th>
        <th colspan="3">Bill</th>
        <th colspan="' . $total_count . '">Assessment</th>' .
            $salvage_th .
            '</tr>
        <tr>
        <th>S.No</th>
        <th colspan ="2">Item</th>
        <th>Prt Amt</th>
        <th>Lab Amt</th>
        <th>Bill S.No</th>
        <th>Prt/Lab Amt</th>
        <th>GST</th>';



        foreach ($assessment_parts as $part_type) {
            $dpn_value = '';
            foreach (['parts', 'labour'] as $category) {
                if (!isset($json_data[$category])) continue;
                foreach ($json_data[$category] as $item) {
                    if (($item['part'] ?? '') === $part_type && isset($item['dpn'])) {
                        $dpn_value = $item['dpn'];
                        break 2;
                    }
                }
            }
            $html_rows .= '<th>' . $part_type . '</br> ' . ' DPN @ ' . $dpn_value . '% </th>';
        }


        if (isset($parametarData['radio02']) && $parametarData['radio02'] == 1) {
            $html_rows .= '<th>%</th><th>Amt</th>';
        }


        $html_rows .= '</tr></thead><tbody>';


        $sl = 1;
        $total_prt_amt = 0;
        $total_lab_amt = 0;
        $total_bill_amt = 0;
        $assessment_totals = array_fill_keys($assessment_parts, 0);
        $total_salvage_amt = 0;

        foreach (['parts', 'labour'] as $category) {
            if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
                continue;
            }

            foreach ($json_data[$category] as $item) {
                if (!is_array($item)) {
                    $item = [
                        'particulars'    => $item,
                        'estimate_part'  => 0,
                        'estimate_lab'   => 0,
                        'bill_no'        => '',
                        'bill_amount'    => 0,
                        'gst'            => 0,
                        'part'           => $item,
                        'assessment'     => 0,
                        'assessment_lab' => 0,
                        'salvage_per'    => 0,
                        'salvage'        => 0,
                    ];
                }
                if ($category == 'parts') {
                    $particular = 'P';
                } else {
                    $particular = 'L';
                }
                $html_rows .= '<tr>';
                $html_rows .= '<td style="text-align:center;">' . $sl . '</td>';
                $html_rows .= '<td style="text-align:center;">' . $particular . '</td>';
                $html_rows .= '<td style="text-align:left;">' . $item['particulars'] . '</td>';
                $html_rows .= '<td style="text-align:right;">' . $item['estimate_part'] . '</td>';
                $total_prt_amt += (float)$item['estimate_part'];

                if ($category === 'labour') {
                    $html_rows .= '<td style="text-align:right;">' . $item['estimate_lab'] . '</td>';
                    $total_lab_amt += (float)$item['estimate_lab'];
                } else {
                    $html_rows .= '<td style="text-align:right;">0</td>';
                }

                $html_rows .= '<td style="text-align:right;">' . $item['bill_no'] . '</td>';
                $html_rows .= '<td style="text-align:right;">' . $item['bill_amount'] . '</td>';
                $html_rows .= '<td style="text-align:right;">' . $item['gst'] . '%</td>';
                $total_bill_amt += (float)$item['bill_amount'];

                foreach ($assessment_parts as $part_type) {
                    if ($part_type === 'Labour') {
                        $val = isset($item['assessment_lab']) ? $item['assessment_lab'] : 0;
                        if ($item['part'] === 'Labour' && isset($item['assessment'])) {
                            $val = $item['assessment'];
                        }
                        $html_rows .= '<td style="text-align:right;">' . $val . '</td>';
                        $assessment_totals['Labour'] += (float)$val;
                    } elseif ($item['part'] === $part_type) {
                        $html_rows .= '<td style="text-align:right;">' . $item['assessment'] . '</td>';
                        $assessment_totals[$part_type] += (float)$item['assessment'];
                    } else {
                        $html_rows .= '<td style="text-align:right;">0</td>';
                    }
                }

                $salvage_per = is_numeric($item['salvage_per']) ? $item['salvage_per'] : 0;
                $salvage_val = is_numeric($item['salvage']) ? $item['salvage'] : 0;

                if ($parametarData['radio02'] == 1) {
                    $html_rows .= '<td style="text-align:right;">' . $salvage_per . '</td>';
                    $html_rows .= '<td style="text-align:right;">' . $salvage_val . '</td>';
                }

                $total_salvage_amt += (float)$salvage_val;

                $html_rows .= '</tr>';
                $sl++;
            }
        }


        // Total row
        $html_rows .= '<tr style="font-weight:bold; background-color:#f0f0f0">';
        $html_rows .= '<td colspan="3" >Total</td>';
        $html_rows .= '<td style="text-align:right;">' . round($total_prt_amt) . '</td>';
        $html_rows .= '<td style="text-align:right;">' . round($total_lab_amt) . '</td>';
        $html_rows .= '<td colspan="2">-</td><td>-</td>';

        foreach ($assessment_parts as $part_type) {
            $html_rows .= '<td style="text-align:right;">' . $assessment_totals[$part_type] . '</td>';
        }

        if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
            $html_rows .= '<td style="text-align:right;">0</td><td style="text-align:right;">' . $total_salvage_amt . '</td>';
        }

        $html_rows .= '</tr>';

        // GST-wise grouping
        $gst_groups = [];
        $gst_sl_map = [];
        $sl_counter = 1;

        $grand_part_gst = 0;
        $grand_lab_gst = 0;
        $grand_assessment_gst = array_fill_keys($assessment_parts, 0);

        foreach (['parts', 'labour'] as $category) {
            // Skip if category doesn't exist or is not an array
            if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
                continue;
            }

            foreach ($json_data[$category] as $item) {
                if (!is_array($item)) {
                    continue;
                }

                $gst = $item['gst'] ?? 0;
                $part = $item['part'] ?? 'Unknown';

                // Initialize GST group if not already set
                if (!isset($gst_groups[$gst])) {
                    $gst_groups[$gst] = [];

                    // Initialize all assessment parts
                    foreach ($assessment_parts as $part_name) {
                        $gst_groups[$gst][$part_name] = 0;
                    }

                    // Always ensure 'Labour' is initialized
                    $gst_groups[$gst]['Labour'] = 0;

                    $gst_sl_map[$gst] = [];
                }

                $gst_sl_map[$gst][] = $sl_counter;

                if ($part !== 'Labour') {
                    $gst_groups[$gst][$part] += $item['assessment'] ?? 0;
                    $gst_groups[$gst]['Labour'] += $item['assessment_lab'] ?? 0;
                } else {
                    $gst_groups[$gst]['Labour'] += $item['assessment'] ?? 0;
                }

                $sl_counter++;
            }
        }



        foreach ($gst_groups as $gst => $parts_data) {
            $row_nos = implode(',', $gst_sl_map[$gst]);

            $html_rows .= '<tr style="background-color:#e8f7ff; font-style:italic;">';
            $html_rows .= '<td colspan="3" >GST @' . $gst . '% - (' . $row_nos . ')</td>';

            $total_part_amt = 0;
            $total_lab_amt_gst = 0;

            foreach (['parts', 'labour'] as $category) {
                foreach ($json_data[$category] as $item) {
                    if ($item['gst'] == $gst) {
                        if ($category === 'parts') {
                            $total_part_amt += $item['estimate_part'] ?? 0;
                        }
                        if ($category === 'labour') {
                            $total_lab_amt_gst += $item['estimate_lab'] ?? 0;
                        }
                    }
                }
            }

            $part_gst_amount = ($total_part_amt * $gst) / 100;
            $lab_gst_amount = ($total_lab_amt_gst * $gst) / 100;

            $grand_part_gst += $part_gst_amount;
            $grand_lab_gst += $lab_gst_amount;

            $html_rows .= '<td style="text-align:right;">' . $this->rf($part_gst_amount, 0) . '</td>';
            $html_rows .= '<td style="text-align:right;">' . $this->rf($lab_gst_amount, 0) . '</td>';
            $html_rows .= '<td colspan="2" style="text-align:right;">-</td><td>0.00</td>';

            foreach ($assessment_parts as $part_type) {
                $part_assessment_sum = $parts_data[$part_type];
                $part_gst = ($part_assessment_sum * $gst) / 100;
                $grand_assessment_gst[$part_type] += $part_gst;
                $html_rows .= '<td style="text-align:right;">' .  $this->rf($part_gst, 0) . '</td>';
            }

            if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
                $html_rows .= '<td style="text-align:right;">-</td><td style="text-align:right;">0.00</td>';
            }
            $html_rows .= '</tr>';
        }

        $material_expenses = $total_prt_amt + $grand_part_gst;
        $lab_expenses = $total_lab_amt + $grand_lab_gst;

        // Grand Total including GST
        $html_rows .= '<tr style="font-weight:bold; background-color:#d1f0d1;">';
        $html_rows .= '<td colspan="3">Grand Total (Incl. GST)</td>';
        $html_rows .= '<td style="text-align:right;">' . $this->rf($total_prt_amt + $grand_part_gst, 0) . '</td>';
        $html_rows .= '<td style="text-align:right;">' . $this->rf($total_lab_amt + $grand_lab_gst, 0) . '</td>';
        $html_rows .= '<td colspan="2">-</td><td>-</td>';

        foreach ($assessment_parts as $part_type) {
            $total_with_gst = $assessment_totals[$part_type] + $grand_assessment_gst[$part_type];
            $html_rows .= '<td style="text-align:right;">' . $this->rf($total_with_gst, 0) . '</td>';
        }

        if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
            $html_rows .= '<td style="text-align:right;">0</td><td>' . $total_salvage_amt . '</td>';
        }

        $html_rows .= '</tr>';

        // DPN value row (12% of assessment+gst)
        $html_rows .= '<tr style="background-color:#fff0f5;">';
        $html_rows .= '<td colspan="8"><strong>Depriciation Amount</strong></td>';

        foreach ($assessment_parts as $part_type) {
            $dpn_value = 0;

            foreach (['parts', 'labour'] as $category) {
                // Check if the category exists and is an array
                if (!isset($json_data[$category]) || !is_array($json_data[$category])) {
                    continue;
                }

                foreach ($json_data[$category] as $item) {
                    // Skip invalid items
                    if (!is_array($item)) {
                        continue;
                    }

                    if (($item['part'] ?? '') === $part_type && is_numeric($item['dpn'] ?? null)) {
                        $dpn_value = $item['dpn'];
                        break 2; // Break both loops once found
                    }
                }
            }

            $base_amount = ($assessment_totals[$part_type] ?? 0) + ($grand_assessment_gst[$part_type] ?? 0);
            $dpn_amount = ($dpn_value / 100) * $base_amount;

            $html_rows .= '<td style="text-align:right;">' .  $this->rf($dpn_amount, 0) . '</td>';
        }


        if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
            $html_rows .= '<td colspan="2">-</td>';
        }

        $html_rows .= '</tr>';

        // Final Grand Total row including GST + DPN
        $html_rows .= '<tr style="font-weight:bold; background-color:#fffacc;">';
        $html_rows .= '<td colspan="8"><strong>Total</strong></td>';

        $total_all_parts = 0; // Initialize total
        $total_all_labour = 0; // Initialize total
        foreach ($assessment_parts as $part_type) {
            $dpn_value = 0;
            $current_category = ''; // To track whether it's parts or labour
            foreach (['parts', 'labour'] as $category) {
                foreach ($json_data[$category] as $item) {
                    if ($item['part'] === $part_type && is_numeric($item['dpn'])) {
                        $dpn_value = $item['dpn'];
                        $current_category = $category; // Save the category
                        break 2;
                    }
                }
            }

            $base_amount = $assessment_totals[$part_type] + $grand_assessment_gst[$part_type];
            $dpn_amount = ($dpn_value / 100) * $base_amount;
            $total_with_all = $base_amount - $dpn_amount;

            // Add to respective total
            if ($current_category === 'parts') {
                $total_all_parts += $total_with_all;
            } elseif ($current_category === 'labour') {
                $total_all_labour += $total_with_all;
            }

            $html_rows .= '<td style="text-align:right;">' . $this->rf($total_with_all, 0) . '</td>';
        }

        if (!empty($parametarData['radio02']) && $parametarData['radio02'] == 1) {
            $html_rows .= '<td colspan="2">-</td>';
        }

        $html_rows .= '</tr>';

        $html_rows .= '</table>';

        $summary = '';

        $additional_data = json_decode($this->assignment->getAdditionalDataByaid($aid), true);

        // Set defaults to avoid undefined index warnings
        $towing_estimated = isset($additional_data['towing_estimated']) ? $additional_data['towing_estimated'] : 0;
        $towing_allowed = isset($additional_data['towing_allowed']) ? $additional_data['towing_allowed'] : 0;
        $nil_dep = isset($additional_data['nil_dep']) ? $additional_data['nil_dep'] : 'no';
        $normal_excess = isset($additional_data['normal_excess']) ? $additional_data['normal_excess'] : 0;
        $imposed_excess = isset($additional_data['imposed_excess']) ? $additional_data['imposed_excess'] : 0;
        $lumpsum_value = isset($parametarData['lumpsum_value']) ? $parametarData['lumpsum_value'] : 0;
        $radio02 = isset($parametarData['radio02']) ? $parametarData['radio02'] : null;

        $summary .= '<table style="width:100%; margin-top:15px; float:left">
        <thead>
        <tr style="font-weight:bold">
        <th>Summary</th>
        <th>Estimated</th>
        <th>Assessed</th>
        <th style="border:none;"></th>
        </tr>
        </thead>';

        // Cost of Parts row
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Cost of Parts</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($material_expenses, 0) . '</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($total_all_parts, 0) . '</td>';
        $summary .= '<td colspan="4" style="border:none;"></td>';

        $summary .= '</tr>';

        // Labour row
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Labour</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($lab_expenses, 0) . '</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($total_all_labour, 0) . '</td>';
        $summary .= '<td colspan="4" style="border:none;"></td>';

        $summary .= '</tr>';

        // Total row
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Total</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($total_prt_amt + $total_lab_amt, 0) . '</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($total_all_parts + $total_all_labour, 0) . '</td>';
        $summary .= '<td colspan="4" style="border:none;"></td>';

        $summary .= '</tr>';

        // Add Towing
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Add Towing</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($towing_estimated, 0) . '</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($towing_allowed, 0) . '</td>';
        $summary .= '<td style="border:none;">(Subject to Bill to be provided by Insured / Repairer)</td>';

        $summary .= '</tr>';

        // Less Salvage
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Less Salvage</td>';
        $summary .= '<td style="text-align:right;">0.00</td>';


        if (!empty($radio02) && $radio02 == 1) {
            $summary .= '<td style="text-align:right;">' .  $this->rf($total_salvage_amt, 0) . '</td>';
        } else {
            $summary .= '<td style="text-align:right;">' .  $this->rf($lumpsum_value, 0) . '</td>';
        }
        $summary .= '<td colspan="4" style="border:none;">(Subject to insurer approval)</td>';
        $summary .= '</tr>';

        // Step 1: Initialize total dpn amount
        $dpnamount = 0;

        foreach ($json_data['parts'] as $item) {
            if (!is_array($item)) continue;

            if (
                isset($item['dpn'], $item['assessment'], $item['gst']) &&
                is_numeric($item['dpn']) && is_numeric($item['assessment']) && is_numeric($item['gst'])
            ) {
                $dpn_percent = (float) $item['dpn'];
                $assessment_amount = (float) $item['assessment'];
                $gst_rate = (float) $item['gst'];

                // DPN amount based on assessment
                $dpn_value = ($dpn_percent / 100) * $assessment_amount;

                // Add GST on DPN
                $dpn_with_gst = $dpn_value + ($dpn_value * $gst_rate / 100);

                $dpnamount += $dpn_with_gst;
            }
        }



        $nildepriciation = $parametarData['nil_dep'] ?? null;

        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Add Nil Dep</td>';
        $summary .= '<td style="text-align:right;">0.00</td>';
        $summary .= '<td style="text-align:right;">' . ($nildepriciation === "yes" ? $this->rf($dpnamount, 0) : '0.00') . '</td>';
        $summary .= '<td colspan="4" style="border:none;"></td>';
        $summary .= '</tr>';


        // Less Excess
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Less Excess</td>';
        $summary .= '<td style="text-align:right;">0.00</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($normal_excess, 0) . '</td>';
        $summary .= '<td colspan="4" style="border:none;">(Compulsory Excess)</td>';

        $summary .= '</tr>';

        // Less Imposed Excess
        $summary .= '<tr>';
        $summary .= '<td style="font-weight:bold; background-color:#f0f0f0">Less Imposed Excess</td>';
        $summary .= '<td style="text-align:right;">0.00</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($imposed_excess, 0) . '</td>';
        $summary .= '<td colspan="4" style="border:none;"></td>';

        $summary .= '</tr>';

        // Calculations for final values (use raw numbers here, no formatting)
        $final_estimated = $total_prt_amt + $total_lab_amt + $towing_estimated + 0 + 0 + 0 + 0;

        $final_assessed = $total_all_parts + $total_all_labour + $towing_allowed + $dpnamount;

        if (!empty($radio02) && $radio02 == 1) {
            $final_assessed -= $total_salvage_amt;
        } else {
            $final_assessed -= $lumpsum_value;
        }

        $final_assessed -= ($nil_dep === "yes" ? 0 : $dpn_amount);
        $final_assessed -= $normal_excess;
        $final_assessed -= $imposed_excess;

        // Net Assessed Loss row
        $summary .= '<tr style="font-weight:bold;">';
        $summary .= '<td>Net Assessed Loss</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($final_estimated, 0) . '</td>';
        $summary .= '<td style="text-align:right;">' .  $this->rf($final_assessed, 0) . '</td>';
        $summary .= '<td colspan="4" style="border:none;"></td>';

        $summary .= '</tr>';

        $summary .= '</table>';
        $checklist = '';

        $checklist .= '<table border="1" cellpadding="5" cellspacing="0" style="width:100%;">';
        $checklist .= '<thead>';
        $checklist .= '<tr>';
        $checklist .= '<th>Particulars</th>';
        $checklist .= '<th>Expenses Incurred</th>';
        $checklist .= '<th>Gross Amount Considered by Insurance</th>';
        $checklist .= '<th>Depreciation</th>';
        $checklist .= '<th>Net Amount</th>';
        $checklist .= '<th>Amount Not Considered by Insurance</th>';
        $checklist .= '</tr>';
        $checklist .= '</thead>';
        $checklist .= '<tbody>';

        $gross_parts = 0;
        $gross_labour = 0;
        $depn_parts = 0;
        $depn_labour = 0;

        foreach ($assessment_parts as $part_type) {
            $is_labour = strtolower($part_type) === 'labour';

            $amount = isset($assessment_totals[$part_type]) ? floatval($assessment_totals[$part_type]) : 0;
            $gst    = isset($grand_assessment_gst[$part_type]) ? floatval($grand_assessment_gst[$part_type]) : 0;
            $dpn    = 0;

            // Get depreciation value for the part_type
            foreach (['parts', 'labour'] as $category) {
                if (isset($json_data[$category])) {
                    foreach ($json_data[$category] as $item) {
                        if ($item['part'] === $part_type && is_numeric($item['dpn'])) {
                            $dpn = floatval($item['dpn']);
                            break 2;
                        }
                    }
                }
            }

            $gross = $amount + $gst;
            $dpn_amt = ($dpn / 100) * $gross;
            $net_amt = $gross - $dpn_amt;

            if ($is_labour) {
                $grand_lab_gst += $gst;
                $gross_labour += $gross;
                $depn_labour += $dpn_amt;
            } else {

                $grand_part_gst += $gst;
                $gross_parts += $gross;
                $depn_parts += $dpn_amt;
            }
        }

        // ---------- Material Row ----------
        $net_parts = $gross_parts - $depn_parts;
        $not_considered_parts = $material_expenses - $net_parts;

        $checklist .= '<tr>';
        $checklist .= '<td>Material</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($material_expenses, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($gross_parts, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($depn_parts, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($net_parts, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($not_considered_parts, 0) . '</td>';
        $checklist .= '</tr>';

        // ---------- Labour Row ----------
        $net_labour = $gross_labour - $depn_labour;
        $not_considered_labour = $lab_expenses - $net_labour;

        $checklist .= '<tr>';
        $checklist .= '<td>Labour</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($lab_expenses, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($gross_labour, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($depn_labour, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($net_labour, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($not_considered_labour, 0) . '</td>';
        $checklist .= '</tr>';

        // ---------- Less ----------
        $checklist .= '<tr>';
        $checklist .= '<td>Less:</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '</tr>';

        // ---------- Salvage ----------
        $checklist .= '<tr>';
        $checklist .= '<td>Salvage</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;">' . (!empty($parametarData['lumpsum_value']) ? $parametarData['lumpsum_value'] : '0') . '</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '</tr>';

        // ---------- Policy Excess ----------
        $imposedexcess = $parametarData['imposed_excess'];
        $normalexcess = $parametarData['normal_excess'];
        $policyexcess = $imposedexcess + $normalexcess;

        $checklist .= '<tr>';
        $checklist .= '<td>Policy Excess</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;">' . $policyexcess . '</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '</tr>';

        // ---------- Net Amount to be received ----------
        $checklist .= '<tr>';
        $checklist .= '<td>Net Amount to be received</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '</tr>';

        // ---------- Total ----------

        $salvageandexcess = floatval($parametarData['lumpsum_value']);
        $policyexcess = floatval($parametarData['imposed_excess']) + floatval($parametarData['normal_excess']);

        $total_expenses = $material_expenses + $lab_expenses;
        $totalgrossamt = $gross_parts + $gross_labour;
        $totalnetlabour = $net_parts + $net_labour;
        $normalexcess = $salvageandexcess + $policyexcess;
        $totalnetamt = $totalnetlabour - $normalexcess;

        $checklist .= '<tr style="font-weight:bold;">';
        $checklist .= '<td>Total</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($total_expenses, 0) . '</td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($totalgrossamt, 0) . '</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '<td style="text-align:right;">' . $this->rf($totalnetamt, 0) . '</td>';
        $checklist .= '<td style="text-align:right;"></td>';
        $checklist .= '</tr>';

        $checklist .= '</tbody>';
        $checklist .= '</table>';




        $computation = '';
        $computation .= '<table class="claimtable">';
        $computation .= '<tr>';
        $computation .= '<th style="width: 5%">Sr. No</th>';
        $computation .= '<th style="width: 10%">Allowed / Dis-allowed</th>';
        $computation .= '<th style="width: 10%">Item Type</th>';
        $computation .= '<th style="width: 20%">Type of Repair-Metal / Rubber, Nylon &/or Plastic / Consumable / Glass / Damage Not approved by Surveyor</th>';
        $computation .= '<th style="width: 9%">% Deducted</th>';
        $computation .= '<th style="width: 9%">Bill Amount</th>';
        $computation .= '<th style="width: 9%">Amt. approved by surveyor</th>';
        $computation .= '<th style="width: 9%">Net Claim Amount Payable</th>';
        $computation .= '<th style="width: 9%">Depreciation</th>';
        $computation .= '<th style="width: 10%" colspan="3">Claim Amount Not Payable</th>';
        $computation .= '</tr>';

        $sr_no = 1;
        $total_billamount_with_gst = 0;
        $total_estimate_with_gst = 0;
        $total_assessment = 0;
        $total_claim_not_payable = 0;
        $total_dpn_percantage_amt = 0;

        // Process Parts
        foreach ($json_data['parts'] as $item) {
            $estimate = (float) $item['estimate_part'];
            $gst_rate = (float) $item['gst'];
            $assessment = (float) $item['assessment'];
            $billamount = (float) $item['bill_amount'];
            $dpn_percentage =  $item['dpn'];



            $gst_estimate_amount = ($estimate * $gst_rate) / 100;
            $estimate_with_gst = $estimate + $gst_estimate_amount;

            $gst_bill_amount = ($billamount * $gst_rate) / 100;
            $billamount_with_gst = $billamount + $gst_bill_amount;

            $status = ($estimate > 0 && $assessment > 0) ? 'Allowed' : 'Disallowed';
            $claim_not_payable = $billamount_with_gst - $assessment;

            $total_billamount_with_gst += $billamount_with_gst;
            $total_estimate_with_gst += $estimate_with_gst;

            $total_claim_not_payable += $claim_not_payable;
            $total_dpn_value += $dpn_value;
            $dpnpercentage = ($dpn_percentage * $billamount_with_gst) / 100;
            $approvedamt = $estimate_with_gst - $dpnpercentage;
            $total_assessment += $approvedamt;
            $total_dpn_percantage_amt += $dpnpercentage;

            $computation .= '<tr>';
            $computation .= "<td style='text-align:left'>{$sr_no}</td>";
            $computation .= "<td style='text-align:left'>{$status}</td>";
            $computation .= "<td style='text-align:left'>{$item['particulars']}</td>";
            $computation .= "<td></td>";
            $computation .= "<td style='text-align:right'>{$item['dpn']}%</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($billamount_with_gst, 0) . "</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($estimate_with_gst, 0) . "</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($approvedamt, 0) . "</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($dpnpercentage, 0) . "</td>";
            $computation .= "<td colspan='3' style='text-align:right'>" . $this->rf($claim_not_payable, 0) . "</td>";
            $computation .= '</tr>';
            $sr_no++;
        }

        // Process Labour
        foreach ($json_data['labour'] as $item) {
            $estimate_lab = (float) $item['estimate_lab'];
            $assessment_lab = (float) $item['assessment_lab'];
            $gst_rate = (float) $item['gst'];
            $billamount = (float) $item['bill_amount'];
            $lab_dpn_percentage =  $item['dpn'];

            $gst_estimate_amount = ($estimate_lab * $gst_rate) / 100;
            $estimate_with_gst = $estimate_lab + $gst_estimate_amount;

            $gst_bill_amount = ($billamount * $gst_rate) / 100;
            $billamount_with_gst = $billamount + $gst_bill_amount;

            $status = ($estimate_lab > 0 && $assessment_lab > 0) ? 'Allowed' : 'Disallowed';
            $claim_not_payable = $billamount_with_gst - $assessment_lab;

            $total_billamount_with_gst += $billamount_with_gst;
            $total_estimate_with_gst += $estimate_with_gst;

            $total_claim_not_payable += $claim_not_payable;
            $labdpnpercentage = ($dpn_percentage * $lab_dpn_percentage) / 100;
            $approvedlabamt = $estimate_with_gst - $labdpnpercentage;
            $total_assessment += $approvedlabamt;
            $total_dpn_percantage_amt += $labdpnpercentage;

            $computation .= '<tr>';
            $computation .= "<td style='text-align:left'>{$sr_no}</td>";
            $computation .= "<td style='text-align:left'>{$status}</td>";
            $computation .= "<td style='text-align:left'>{$item['particulars']}</td>";
            $computation .= "<td></td>";
            $computation .= "<td style='text-align:right'>{$item['dpn']}%</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($billamount_with_gst, 0) . "</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($estimate_with_gst, 0) . "</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($approvedlabamt, 0) . "</td>";
            $computation .= "<td style='text-align:right'>" . $this->rf($labdpnpercentage, 0) . "</td>";
            $computation .= "<td colspan='3' style='text-align:right'>" . $this->rf($claim_not_payable, 0) . "</td>";
            $computation .= '</tr>';
            $sr_no++;
        }


        // Total row
        $computation .= '<tr>';
        $computation .= '<td colspan="5" style="text-align: left;"><stronge>Total</stronge></td>';
        $computation .= '<td style="text-align:right"><strong>' . $this->rf($total_billamount_with_gst, 0) . '</strong></td>';
        $computation .= '<td style="text-align:right"><strong>' . $this->rf($total_estimate_with_gst, 0) . '</strong></td>';
        $computation .= '<td style="text-align:right"><strong>' . $this->rf($total_assessment, 0) . '</strong></td>';
        $computation .= '<td style="text-align:right"><strong>' . $this->rf($total_dpn_percantage_amt, 0) . '</strong></td>';
        $computation .= '<td colspan="3" style="text-align:right"><strong>' . $this->rf($total_claim_not_payable, 0) . '</strong></td>';
        $computation .= '</tr>';

        $computation .= '</table>';

        $computation .= '<div class="container">';
        $computation .= '<table class="assessmenttable">';
        $computation .= '<tbody>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Total Bill Paid</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $this->rf($total_billamount_with_gst, 0) . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Total Amount of Bill Admissiable for Claim</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $this->rf($total_estimate_with_gst, 0) . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Total Depreciation Charged</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $this->rf($total_dpn_percantage_amt, 0) . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Total Amount Not Allowed</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $this->rf($total_claim_not_payable, 0) . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Net Claim Amount</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $this->rf($total_assessment, 0) . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Gross Claim Amount</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $this->rf($total_estimate_with_gst, 0) . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Policy Excess</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . $policyexcess . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right">Salvage</td>';
        $computation .= '<td style="width: 2%; align-items: right; text-align:right">' . (!empty($parametarData['lumpsum_value']) ? $parametarData['lumpsum_value'] : '0') . '</td>';
        $computation .= '</tr>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 20%; align-items: right; font-weight: bold">Claim Admissiable</td>';
        $computation .= '<td style="width: 2%; align-items: right; font-weight: bold"></td>';
        $computation .= '</tr>';
        $computation .= '</tbody>';
        $computation .= '</table>';
        $computation .= '</div>';

        $computation .= '<div class="bottom">';
        $computation .= '<table style="width:100%">';
        $computation .= '<tbody>';
        $computation .= '<tr>';
        $computation .= '<td style="width: 100%; align-items: right; font-weight: bold; margin-left: 20px;" class="bg">% of Claim Assessment of Claim</td>';

        $computation .= '</tr>';
        $computation .= '</tbody>';
        $computation .= '</table>';
        $computation .= '</div>';

        $computation .= '<div style="width: 100%; background: #fff;">';
        $computation .= '<table>';
        // Process Labour
        foreach ($json_data['labour'] as $item) {
            $estimate_lab = (float) $item['estimate_lab'];
            $assessment_lab = (float) $item['assessment_lab'];
            $gst_rate = (float) $item['gst'];
            $billamount = (float) $item['bill_amount'];
            $lab_dpn_percentage =  $item['dpn'];

            $gst_estimate_amount = ($estimate_lab * $gst_rate) / 100;
            $estimate_with_gst = $estimate_lab + $gst_estimate_amount;

            $gst_bill_amount = ($billamount * $gst_rate) / 100;
            $billamount_with_gst = $billamount + $gst_bill_amount;

            $status = ($estimate_lab > 0 && $assessment_lab > 0) ? 'Allowed' : 'Disallowed';
            $claim_not_payable = $billamount_with_gst - $assessment_lab;

            $total_billamount_with_gst += $billamount_with_gst;
            $total_estimate_with_gst += $estimate_with_gst;

            $total_claim_not_payable += $claim_not_payable;
            $labdpnpercentage = ($dpn_percentage * $lab_dpn_percentage) / 100;
            $approvedlabamt = $estimate_with_gst - $labdpnpercentage;
            $total_assessment += $approvedlabamt;
            $total_dpn_percantage_amt += $labdpnpercentage;

            $computation .= '<tr>';
            $computation .= '<th style="width: 46%">Labour</th>';
            $computation .= '<td style="width: 9%">' . $item['dpn'] . '%</td>';
            $computation .= '<td style="width: 9%">' . $this->rf($billamount_with_gst, 0) . '</td>';
            $computation .= '<td style="width: 9%">' . $this->rf($estimate_with_gst, 0) . '</td>';
            $computation .= '<td style="width: 9%">' . $this->rf($approvedlabamt, 0) . '</td>';
            $computation .= '<td style="width: 9%">' . $this->rf($labdpnpercentage, 0) . '</td>';
            $computation .= '<td  style="width: 9%">' . $this->rf($claim_not_payable, 0) . '</td>';
            $computation .= '</tr>';

            $sr_no++;
        }


        $computation .= '</table>';
        $computation .= '</div>';
        return [
            'html_rows'    => $html_rows,
            'summary'      => $summary,
            'checklist'    => $checklist,
            'computation'  => $computation
        ];
    }




    public function generate_assessment($aid)
    {
        if ($this->session->userdata('id') !== null) {
            // 1. Get assessment data
            $data['assessment'] = $this->assignment->getassessmentdatabyid($aid);

            // 2. Render the assessment table HTML
            $assessment['assessment_data'] = $this->assessment_view($data['assessment'], $aid);

            // 3. Load essential data
            $essential_data = $this->case_model->getessentialdatabyAid($aid);
            $essentialData = $essential_data->essentialdata ? json_decode($essential_data->essentialdata, true) : null;

            // 4. Add essential data to view data
            $assessment['essential_data'] = $essentialData;

            // 5. Render the view with all data
            $html = $this->load->view('adminpanel/assessment/assessment_pdf', $assessment, true);

            // 6. Generate the PDF
            $dompdf = new Dompdf();
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isPhpEnabled', true);
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $dompdf->stream("assessment_report.pdf", array("Attachment" => false));
        } else {
            redirect('login'); // Or handle unauthorized access
        }
    }



    public function generatechecklist($aid)
    {
        // Check if the user is logged in
        if ($this->session->userdata('id') !== null) {
            // Validate the aid parameter
            if (!$aid) {
                $response = ['error' => 'Missing aid parameter'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            // Load essential data
            $essential_data = $this->case_model->getessentialdatabyAid($aid);
            $essentialData = $essential_data->essentialdata ? json_decode($essential_data->essentialdata, true) : null;

            $parametarized_data = $this->assignment->getassessmentdatabyaid($aid);
            $parametarData = $parametarized_data ? json_decode($parametarized_data, true) : null;

            // print_r($parametarData['radio02']);
            // exit();


            $assessment = $this->assignment->getassessmentdatabyid($aid);
            $assessmentData = $assessment ? json_decode($assessment, true) : null;


            // Prepare data for the view
            $data = [
                'essentialData' => $essentialData,
                'parametarData' => $parametarData,
                'assessmentData' => $assessmentData

            ];



            // Load HTML content for the PDF
            try {
                $html = $this->load->view('adminpanel/assessment/motor_checklist', $data, true);
                if (!$html) {
                    throw new Exception('View did not return any content.');
                }
            } catch (Exception $e) {
                log_message('error', 'Error loading view: ' . $e->getMessage());
                show_error('Error loading view. Please try again later.', 500);
                return;
            }

            // Generate PDF using Dompdf
            try {
                $dompdf = new Dompdf();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                // Save PDF to a file
                $output = $dompdf->output();
                $pdfFilePath = './uploads/' . $aid . '/reports/motorchecklist_' . $aid . '.pdf';

                // Ensure the directory exists
                if (!is_dir(dirname($pdfFilePath))) {
                    mkdir(dirname($pdfFilePath), 0777, true); // Create directory recursively
                }

                // Write the PDF to a file
                if (file_put_contents($pdfFilePath, $output) === false) {
                    throw new Exception('Failed to write PDF to file.');
                }

                // Stream PDF to browser
                $dompdf->stream("billing_$aid.pdf", ["Attachment" => 0]);
            } catch (Exception $e) {
                log_message('error', 'Error generating PDF: ' . $e->getMessage());
                show_error('Error generating PDF. Please try again later.', 500);
            }



            exit; // Stop further execution
        } else {
            redirect('user_logout'); // Redirect to logout if user is not logged in
        }
    }



    public function save_table_data()
    {
        $tableHTML = $this->input->post('table_html');
        $aid = $this->input->post('aid');

        if (!$aid || !$tableHTML) {
            echo json_encode(['status' => 'error', 'message' => 'Missing data']);
            return;
        }

        $data = array(
            'assesment_structure' => $tableHTML
        );

        $this->db->where('aid', $aid);
        $updated = $this->db->update('claims_assessment', $data);

        echo json_encode(['status' => $updated ? 'success' : 'error']);
    }

    public function loadassessmantform()
    {
        $this->load->view("adminpanel/jobs/locationbasedjob/assesmentform");
    }

    public function marinefinalessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'name_of_consignee' => $essentialSanitized['name_of_consignee'] ?? null,
                    'name_of_commodity' => $essentialSanitized['name_of_commodity'] ?? null,
                    'insured_name' => $essentialSanitized['insured_name'] ?? null,
                    'available_at_location' => $essentialSanitized['available_at_location'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'invoices' => isset($essential['invoices']) ? json_encode($essential['invoices']) : null, // Adding invoices field

                ]);




                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }


    public function mediclaimessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'name_of_consignee' => $essentialSanitized['name_of_consignee'] ?? null,
                    'name_of_commodity' => $essentialSanitized['name_of_commodity'] ?? null,
                    'insured_name' => $essentialSanitized['insured_name'] ?? null,
                    'available_at_location' => $essentialSanitized['available_at_location'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'invoices' => isset($essential['invoices']) ? json_encode($essential['invoices']) : null, // Adding invoices field

                ]);




                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }


    public function marinecargoessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'name_of_consignee' => $essentialSanitized['name_of_consignee'] ?? null,
                    'name_of_commodity' => $essentialSanitized['name_of_commodity'] ?? null,
                    'insured_name' => $essentialSanitized['insured_name'] ?? null,
                    'available_at_location' => $essentialSanitized['available_at_location'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'invoices' => isset($essential['invoices']) ? json_encode($essential['invoices']) : null, // Adding invoices field

                ]);




                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function marinepredispatchessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'name_of_consignee' => $essentialSanitized['name_of_consignee'] ?? null,
                    'name_of_commodity' => $essentialSanitized['name_of_commodity'] ?? null,
                    'insured_name' => $essentialSanitized['insured_name'] ?? null,
                    'available_at_location' => $essentialSanitized['available_at_location'] ?? null,
                    'state' => $essentialSanitized['state'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'invoices' => isset($essential['invoices']) ? json_encode($essential['invoices']) : null, // Adding invoices field
                ]);


                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function engipreinsessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
                // Fetch existing jobdata
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata with new values
                $updateFields = array_filter([
                    'case_reference' => $essentialSanitized['case_reference'] ?? null,
                    'subject_matter' => $essentialSanitized['subject_matter'] ?? null,
                    'address' => $essentialSanitized['address'] ?? null,
                    'policyNumber' => $essentialSanitized['policyNumber'] ?? null,
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    // Update jobdata with non-null values
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata if necessary
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }

    public function fireprinsessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }

    public function ebdeathessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                // Prepare payment details
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }

                // Insert shipping details if provided
                if (!empty($shippingDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata using the model method
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata fields
                $updateFields = array_filter([
                    'case_reference' => $essential['case_reference'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'insured_name' => $essentialSanitized['insured_name'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'policyNumber' => $essential['policyNumber'] ?? null,
                    'address' => $essential['address'] ?? null
                ]);




                if (!empty($jobdata) && is_array($jobdata)) {
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value; // Update common fields in jobdata
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }




    public function updateebdeathcasedata()
    {
        if ($this->session->userdata('id') === null) {
            echo json_encode(["status" => 401, "message" => "Session expired. Please log in again."]);
            return;
        }

        $essential = $this->input->post();
        if (empty($essential['aid']) || !is_numeric($essential['aid'])) {
            echo json_encode(["status" => 400, "message" => "Invalid input: 'aid' is required and must be a number."]);
            return;
        }

        $aid = intval($essential['aid']);
        unset($essential['aid']);

        function sanitizeData($data)
        {
            if (is_array($data)) {
                return array_map('sanitizeData', $data);
            }
            return html_escape(trim($data));
        }

        $sanitizedData = sanitizeData($essential);

        $is_saved = $this->case_model->updateCaseData(json_encode($sanitizedData), $aid);

        if ($is_saved) {
            echo json_encode(["status" => 200, "message" => "Report data updated successfully."]);
        } else {
            echo json_encode(["status" => 500, "message" => "Failed to update case data."]);
        }
    }



    public function updatepredispatchcasedata()
    {
        if ($this->session->userdata('id') === null) {
            echo json_encode(["status" => 401, "message" => "Session expired. Please log in again."]);
            return;
        }

        $essential = $this->input->post();
        if (empty($essential['aid']) || !is_numeric($essential['aid'])) {
            echo json_encode(["status" => 400, "message" => "Invalid input: 'aid' is required and must be a number."]);
            return;
        }

        $aid = intval($essential['aid']);
        unset($essential['aid']);

        function sanitizeData($data)
        {
            if (is_array($data)) {
                return array_map('sanitizeData', $data);
            }
            return html_escape(trim($data));
        }

        $sanitizedData = sanitizeData($essential);

        $is_saved = $this->case_model->updateCaseData(json_encode($sanitizedData), $aid);

        if ($is_saved) {
            echo json_encode(["status" => 200, "message" => "Report data updated successfully."]);
        } else {
            echo json_encode(["status" => 500, "message" => "Failed to update case data."]);
        }
    }

    public function riskinspection()
    {
        if ($this->session->userdata('id') === null) {
            echo json_encode(["status" => 401, "message" => "Session expired. Please log in again."]);
            return;
        }

        $essential = $this->input->post();
        if (empty($essential['aid']) || !is_numeric($essential['aid'])) {
            echo json_encode(["status" => 400, "message" => "Invalid input: 'aid' is required and must be a number."]);
            return;
        }

        $aid = intval($essential['aid']);
        unset($essential['aid']);

        function sanitizeData($data)
        {
            if (is_array($data)) {
                return array_map('sanitizeData', $data);
            }
            return html_escape(trim($data));
        }

        $sanitizedData = sanitizeData($essential);

        $is_saved = $this->case_model->updateCaseData(json_encode($sanitizedData), $aid);

        if ($is_saved) {
            echo json_encode(["status" => 200, "message" => "Report data updated successfully."]);
        } else {
            echo json_encode(["status" => 500, "message" => "Failed to update case data."]);
        }
    }

    public function updateMotorTheftCaseData()
    {
        if ($this->session->userdata('id') === null) {
            echo json_encode(["status" => 401, "message" => "Session expired. Please log in again."]);
            return;
        }

        $essential = $this->input->post();
        if (empty($essential['aid']) || !is_numeric($essential['aid'])) {
            echo json_encode(["status" => 400, "message" => "Invalid input: 'aid' is required and must be a number."]);
            return;
        }

        $aid = intval($essential['aid']);
        unset($essential['aid']);

        function sanitizeData($data)
        {
            if (is_array($data)) {
                return array_map('sanitizeData', $data);
            }
            return html_escape(trim($data));
        }

        $sanitizedData = sanitizeData($essential);

        $is_saved = $this->case_model->updateCaseData(json_encode($sanitizedData), $aid);

        if ($is_saved) {
            echo json_encode(["status" => 200, "message" => "Report data updated successfully."]);
        } else {
            echo json_encode(["status" => 500, "message" => "Failed to update case data."]);
        }
    }

    public function templatecasedata()
    {
        if ($this->session->userdata('id') === null) {
            echo json_encode(["status" => 401, "message" => "Session expired. Please log in again."]);
            return;
        }

        $essential = $this->input->post();
        if (empty($essential['id']) || !is_numeric($essential['id'])) {
            echo json_encode(["status" => 400, "message" => "Invalid input: 'aid' is required and must be a number."]);
            return;
        }

        $aid = intval($essential['id']);
        unset($essential['id']);

        function sanitizeData($data)
        {
            if (is_array($data)) {
                return array_map('sanitizeData', $data);
            }
            return html_escape(trim($data));
        }

        $sanitizedData = sanitizeData($essential);

        $is_saved = $this->case_model->updatetemplateCaseData(json_encode($sanitizedData), $aid);

        if ($is_saved) {
            echo json_encode(["status" => 200, "message" => "Report data updated successfully."]);
        } else {
            echo json_encode(["status" => 500, "message" => "Failed to update case data."]);
        }
    }


    public function miscellaneousessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }

    public function paclaimessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();

            // Validate required fields
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');
            $this->form_validation->set_rules('appoint_by', 'Appoint By', 'trim');
            $this->form_validation->set_rules('payment_by', 'Payment By', 'trim');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode(array("status" => 400, "message" => validation_errors()));
                return;
            }

            // Sanitize input data
            $aid = $essential['aid'];
            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update case data
            $is_saved = $this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid);
            if ($is_saved) {
                // Prepare payment data
                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if provided
                if (!empty($paymentDetails)) {
                    $paymentDetailsJson = json_encode($paymentDetails);
                    $this->assignment->insertPaymentEssentialData($paymentDetailsJson, $aid);
                }

                // Insert shipping details if provided
                if (!empty($shippingpaymentDetails)) {
                    $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                    $this->assignment->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array("status" => 500, "message" => "Database transaction failed"));
                log_message('error', 'Failed transaction for aid: ' . $aid);
            } else {
                echo json_encode(array("status" => 200, "message" => "Essential data updated successfully"));
            }
        } else {
            redirect('user_logout');
        }
    }


    public function firefinalessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'] ?? null;  // Ensure aid exists in the input
            if (!$aid) {
                echo json_encode(["status" => 400, "message" => "Invalid request, missing aid"]);
                return;
            }

            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'          => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if available
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }


                // Insert shipping details if available
                if (!empty($shippingpaymentDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingpaymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata with new values
                $updateFields = array_filter([
                    'case_reference' => $essentialSanitized['case_reference'] ?? null,
                    'subject_matter' => $essentialSanitized['subject_matter'] ?? null,
                    'address' => $essentialSanitized['address'] ?? null,
                    'policyNumber' => $essentialSanitized['policyNumber'] ?? null,
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    // Update jobdata with non-null values
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata if necessary
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete the transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function assetsessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'] ?? null;  // Ensure aid exists in the input
            if (!$aid) {
                echo json_encode(["status" => 400, "message" => "Invalid request, missing aid"]);
                return;
            }

            $essentialSanitized = array_map('html_escape', $essential);

            // Begin database transaction
            $this->db->trans_start();

            // Update essential data
            if ($this->assignment->updateEssentialData(json_encode($essentialSanitized), $aid)) {

                $paymentDetails = array_filter([
                    'billing_payment_by'   => $essentialSanitized['payment_by'] ?? null,
                    'billing_branch_name'  => $essentialSanitized['payment_branch_name'] ?? null,
                    'billing_user_name'    => $essentialSanitized['payment_user_name'] ?? null,
                    'billing_mobile_num'   => $essentialSanitized['payment_mobile_num'] ?? null,
                    'billing_gst'          => $essentialSanitized['payment_gst'] ?? null,
                    'billing_id'          => $essentialSanitized['paymentbillingto'] ?? null,
                ]);

                // Prepare shipping data
                $shippingpaymentDetails = array_filter([
                    'shipping_payment_by'  => $essentialSanitized['appoint_by'] ?? null,
                    'shipping_branch_name' => $essentialSanitized['appointment_branch_name'] ?? null,
                    'shipping_user_name'   => $essentialSanitized['appointment_user_name'] ?? null,
                    'shipping_mobile_num'  => $essentialSanitized['appointment_mobile_num'] ?? null,
                    'shipping_gst'         => $essentialSanitized['appointment_gst'] ?? null,
                    'shipbilling_id'       => $essentialSanitized['appointbillingto'] ?? null,

                ]);

                // Insert payment details if available
                if (!empty($paymentDetails)) {
                    if (!$this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert payment details"]);
                        return;
                    }
                }


                // Insert shipping details if available
                if (!empty($shippingpaymentDetails)) {
                    if (!$this->assignment->insertShippingEssentialData(json_encode($shippingpaymentDetails), $aid)) {
                        $this->db->trans_rollback();
                        echo json_encode(["status" => 500, "message" => "Failed to insert shipping details"]);
                        return;
                    }
                }

                // Fetch existing jobdata
                $jobdataRow = $this->assignment->getjobData($aid);
                $jobdata = isset($jobdataRow['jobdata']) ? json_decode($jobdataRow['jobdata'], true) : [];

                // Update jobdata with new values
                $updateFields = array_filter([
                    'case_reference' => $essentialSanitized['case_reference'] ?? null,
                    'salutation' => $essentialSanitized['salutation'] ?? null,
                    'contact_person_name' => $essentialSanitized['contact_person_name'] ?? null,
                    'contact_person_mobile' => $essentialSanitized['contact_person_mobile'] ?? null,
                    'date_of_report' => $essentialSanitized['date_of_report'] ?? null,
                    'address' => $essentialSanitized['address'] ?? null,
                    'valuation_type' => $essentialSanitized['valuation_type'] ?? null,
                    'visitdate' => $essentialSanitized['visitdate'] ?? null,
                    'asset_value' => $essentialSanitized['asset_value'] ?? null
                ]);

                if (!empty($jobdata) && is_array($jobdata)) {
                    // Update jobdata with non-null values
                    foreach ($updateFields as $key => $value) {
                        if ($value !== null) {
                            $jobdata[$key] = $value;
                        }
                    }
                    $updateFields['jobdata'] = json_encode($jobdata);
                }

                // Perform the update for jobdata if necessary
                if (!empty($updateFields)) {
                    $this->assignment->updateCaseReferenceAndJobdata(
                        $aid,
                        $updateFields['case_reference'] ?? null,
                        $updateFields['jobdata'] ?? null
                    );
                }
            }

            // Complete the transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["status" => 500, "message" => "Database transaction failed"]);
            } else {
                echo json_encode(["status" => 200, "message" => "Essential data updated successfully"]);
            }
        } else {
            redirect('user_logout');
        }
    }


    public function lopfinalessential()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];

            $essentialDataArray = [];
            // Map other input fields
            $fieldsToMap = [
                'contact_person_name',
                'policy_by',
                'policybillingto',
                'paymentbillingto',
                'appointbillingto',
                'policy_branch',
                'policy_user',
                'date_of_report',
                'policy_mobile',
                'selected_policy_vendor_id',
                'appoint_by',
                'appointment_branch_name',
                'appointment_user_name',
                'appointment_mobile_num',
                'selected_appointment_vendor_id',
                'case_reference',
                'insured_name',
                'payment_by',
                'payment_branch_name',
                'payment_gst',
                'appointment_gst',
                'payment_user_name',
                'payment_mobile_num',
                'selected_payment_vendor_id',
                'address',
                'Ofinstruction',
                'visit_date_time',
                'insured_activity',
                'loss_area',
                'loss_data',
                'survey_place',
                'cause_loss',
                'stocks',
                'pm',
                'building',
                'total',
                'recovery',
                'expected_liability',
                'observation',
                'xlsheetFile',
            ];

            foreach ($fieldsToMap as $field) {
                if (!empty($essential[$field])) {
                    $essentialDataArray[$field] = $essential[$field];
                }
            }

            $uploadedImages = $this->handleFileUploads('descImage', $aid, $essential['descrp']);
            if (isset($_POST['obdescrp'])) {
                $uploadedobImages = $this->handleFileUploads('obdescImage', $aid, $_POST['obdescrp']);
                if (!empty($uploadedobImages)) {
                    $essentialDataArray['obimages'] = json_encode($uploadedobImages); // Store uploaded image paths and descriptions in the database
                }
            } else {

                $uploadedobImages = [];
            }
            if (!empty($uploadedImages)) {
                $essentialDataArray['images'] = json_encode($uploadedImages); // Store uploaded image paths and descriptions in the database
            }

            if (!empty($uploadedobImages)) {
                $essentialDataArray['obimages'] = json_encode($uploadedobImages); // Store uploaded image paths and descriptions in the database
            }


            // Update essential data in the database
            $is_update = true;
            if (!empty($essentialDataArray)) {
                $essentialDataJson = json_encode($essentialDataArray);
                $is_update = $this->assignment->updateEssentialData($essentialDataJson, $aid);
            }

            // Handle payment and shipping data
            $paymentDetails = $this->mapFields($essential, [
                'payment_by' => 'billing_payment_by',
                'payment_branch_name' => 'billing_branch_name',
                'payment_user_name' => 'billing_user_name',
                'payment_mobile_num' => 'billing_mobile_num',
                'payment_gst' => 'billing_gst',
                'paymentbillingto' => 'billing_id'

            ]);

            $shippingDetails = $this->mapFields($essential, [
                'appoint_by' => 'shipping_payment_by',
                'appointment_branch_name' => 'shipping_branch_name',
                'appointment_user_name' => 'shipping_user_name',
                'appointment_mobile_num' => 'shipping_mobile_num',
                'appointment_gst' => 'shipping_gst',
                'appointbillingto' => 'shipbilling_id'

            ]);

            $is_payment_insert = true;
            $is_shipping_insert = true;

            if (!empty($paymentDetails)) {
                $is_payment_insert = $this->assignment->insertPaymentEssentialData(json_encode($paymentDetails), $aid);
            }

            if (!empty($shippingDetails)) {
                $is_shipping_insert = $this->assignment->insertShippingEssentialData(json_encode($shippingDetails), $aid);
            }

            // Final response
            if ($is_update && $is_payment_insert && $is_shipping_insert) {
                echo json_encode(["status" => 200, "message" => "Successfully updated property essential data."]);
            } else {
                echo json_encode(["status" => 500, "message" => "Failed to update essential data."]);
            }
        } else {
            echo json_encode(["status" => 401, "message" => "Unauthorized access"]);
        }
    }

    // Handling image uploads and descriptions
    private function handleFileUploads($inputName, $aid, $descriptions = [])
    {
        $uploadedFiles = [];

        if (!empty($_FILES[$inputName]['name'][0])) {
            $fileCount = count($_FILES[$inputName]['name']);
            $uploadFolder = './uploads/' . $aid . '/propertyimage/';

            // Create folders if they don't exist
            if (!is_dir($uploadFolder) && !mkdir($uploadFolder, 0777, true)) {
                return ["error" => "Failed to create upload folders."];
            }

            $this->load->library('upload');

            for ($i = 0; $i < $fileCount; $i++) {
                $_FILES['userfile'] = [
                    'name' => $_FILES[$inputName]['name'][$i],
                    'type' => $_FILES[$inputName]['type'][$i],
                    'tmp_name' => $_FILES[$inputName]['tmp_name'][$i],
                    'error' => $_FILES[$inputName]['error'][$i],
                    'size' => $_FILES[$inputName]['size'][$i]
                ];

                $config = [
                    'upload_path' => $uploadFolder,
                    'allowed_types' => 'jpg|jpeg|png|gif',
                    'max_size' => 2048,
                    'file_name' => time() . '_' . $_FILES['userfile']['name']
                ];
                $this->upload->initialize($config);

                if ($this->upload->do_upload('userfile')) {
                    $fileData = $this->upload->data();
                    $uploadedFiles[] = [
                        'file_name' => $fileData['file_name'],
                        'description' => $descriptions[$i] ?? '' // Attach description
                    ];
                } else {
                    return ["error" => $this->upload->display_errors()];
                }
            }
        } else {
            return ["error" => "No files uploaded."];
        }

        return $uploadedFiles;
    }

    public function upload_image()
    {
        // Retrieve posted data
        $essential = $this->input->post();
        $aid = isset($essential['aid']) ? $essential['aid'] : null; // Ensure 'aid' is set

        // Check if 'aid' is provided, else handle the error
        if (!$aid) {
            echo json_encode([
                'status' => 'error',
                'message' => 'The aid parameter is missing'
            ]);
            return;
        }

        // Ensure a file is selected for upload
        if (empty($_FILES['image']['name'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'No file selected for upload.'
            ]);
            return;
        }

        // Set the upload path dynamically based on the 'aid'
        $upload_path = './uploads/' . $aid . '/propertyimage/';

        // Make sure the directory exists, if not create it
        if (!is_dir($upload_path)) {
            if (!mkdir($upload_path, 0777, true)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to create upload directory.'
                ]);
                return;
            }
        }

        // Set the upload configuration
        $config['upload_path'] = $upload_path; // Dynamic path based on 'aid'
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image types
        $config['max_size'] = 2048;  // Max file size in KB (2MB)
        $config['file_name'] = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);  // Unique file name to avoid overwriting

        // Load the upload library with the config
        $this->load->library('upload', $config);

        // Check if the file is uploaded
        if (!$this->upload->do_upload('image')) {
            // If upload fails, return an error message
            $error = array('error' => $this->upload->display_errors());
            echo json_encode([
                'status' => 'error',
                'message' => $error['error']
            ]);
        } else {
            // If upload succeeds, get the image data
            $upload_data = $this->upload->data();

            // Create the URL for the uploaded image
            $image_url = base_url('uploads/' . $aid . '/propertyimage/' . $upload_data['file_name']);

            // Return the URL of the uploaded image as a JSON response
            echo json_encode([
                'status' => 'success',
                'imageUrl' => $image_url
            ]);
        }
    }

    // Utility function for mapping fields
    private function mapFields(array $input, array $fieldMappings): array
    {
        $mappedData = [];
        foreach ($fieldMappings as $inputKey => $dbField) {
            if (!empty($input[$inputKey])) {
                $mappedData[$dbField] = $input[$inputKey];
            }
        }
        return $mappedData;
    }


    public function quicksurveycase()
    {
        if ($this->session->userdata('id') !== null) {
            if ($this->input->method() === 'post') {
                $case_data = $this->input->post();

                // Validate required fields
                if (empty($case_data['itemnumber']) || empty($case_data['beneficiaryname']) || empty($case_data['companyName'])) {
                    $response = array(
                        "status" => 400,
                        "message" => "All required fields (Tag Number, Beneficiary Name, and Company Name) must be filled."
                    );
                    echo json_encode($response);
                    return;
                }

                $directoryname = preg_replace('/[^a-zA-Z0-9]/', '', $case_data['itemnumber']); // Remove special characters

                $baseDir = './quicksurvey/' . $directoryname;

                // Create directories if they do not exist
                $uploadDirs = ['images', 'videos', 'documents'];
                foreach ($uploadDirs as $dir) {
                    $uploadPath = $baseDir . '/' . $dir;
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, TRUE);
                    }
                }

                // Prepare data for database insertion
                $data = array(
                    'directoryname' => $directoryname,
                    'itemnumber' => $case_data['itemnumber'], // Correct reference to itemnumber
                    'userid' => $this->session->userdata('id'),
                    'cid' => $case_data['companyName'],  // Storing company as 'cid'
                    'beneficiaryname' => $case_data['beneficiaryname'],
                    'status' => "1" // Default status
                );

                // Insert the case into the database
                $result = $this->assignment->insert_quick_survey($data);

                // Check if insertion was successful
                if ($result) {
                    $response = array(
                        "status" => 200,
                        "message" => "Directories created successfully and case submitted."
                    );
                } else {
                    $response = array(
                        "status" => 500,
                        "message" => "Failed to save case."
                    );
                }
                echo json_encode($response);
            } else {
                $encrypted_json = $this->input->get('data');
                if ($encrypted_json) {
                    // Decrypt the JSON string
                    $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));

                    if ($decrypted_json) {
                        // Decode the JSON string back into an array
                        $data_array = json_decode($decrypted_json, true);

                        // Access the individual values
                        $defaultcompany = $data_array['defaultcompany'] ?? null;
                        $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                        $usertype = $data_array['usertype'] ?? null;

                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'view' => "Add Survey",
                        ];
                        $this->load->view('adminpanel/quicksurveyfile/quicksurveyform', $data);
                    }
                }
            }
        } else {
            redirect('login'); // Redirect to login if the session is not valid
        }
    }



    public function getQuicksurvey()
    {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $data = array();
                // Use the 'id' from the POST data as the userId from the quicksurvey table
                $userId = $this->session->userdata('id');
                $itemnumber = $this->input->post('itemnumber');
                $directoryname = $this->input->post('directoryname');

                // Fetch survey data along with user information related to the userId from the quicksurvey table
                $surveyData = $this->assignment->getQuickSurveyCases($userId);

                foreach ($surveyData as $surveyValue) {
                    // Define directory paths
                    $totalimages = $this->assignment->getquicksurveyAllFiles($surveyValue->directoryname, "images");
                    $totalvideos = $this->assignment->getquicksurveyAllFiles($surveyValue->directoryname, "videos");
                    $totaldocuments = $this->assignment->getquicksurveyAllFiles($surveyValue->directoryname, "documents");


                    // Generate media file icons with counts
                    $media = '<div class="navbar--nav ml-auto">
                                <ul class="nav" style="flex-wrap:unset">
                                    <li class="nav-item">
                                        <a href="' . base_url() . 'quicksurveyimages/' . $surveyValue->directoryname . '" class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-images"></i>
                                            <span class="badge text-white bg-blue">' . $totalimages . '</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="' . base_url() . 'quicksurveyvideos/' . $surveyValue->directoryname . '" class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-video"></i>
                                            <span class="badge text-white bg-blue">' . $totalvideos . '</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="' . base_url() . 'quicksurveydocs/' . $surveyValue->directoryname . '" class="nav-link" style="padding-left:15px; padding-right:15px;">
                                            <i class="fa fa-file"></i>
                                            <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                                        </a>
                                    </li>
                                </ul>
                              </div>';

                    // Combine username and mobile number from the surveyValue
                    $username = trim($surveyValue->beneficiaryname);
                    $mobileNumber = !empty($surveyValue->mobile) ? $surveyValue->mobile : 'N/A'; // Use 'N/A' or any default value if mobile is not set

                    // Prepare each row of data
                    $data[] = array(
                        $surveyValue->companyName, // ID column
                        $username, // Combined username
                        $surveyValue->itemnumber,  // Tag Number
                        $media,  // Media Files
                        '<div class="input-group" style="display: flex; gap: 10px; align-items: center; justify-content: space-between; max-width: 100%;">
                            <input type="text" name="aid[]" value="" class="form-control aidnumber" style="width: 50%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;">
                            <input type="hidden" name="itemnumber[]" value="' . $surveyValue->itemnumber . '" class="itemnumber"> <!-- Hidden input to store item number -->
                            <input type="hidden" name="directoryname[]" value="' . $surveyValue->directoryname . '" class="directoryname"> <!-- Hidden input to store item number -->
                            <input class="btn case_btn movemediafiles" type="button" value="Submit" style="width: 20%; padding: 8px; background-color: green; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        </div>'
                    );
                }

                // Prepare output for DataTables
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->assignment->countAllquicksurvey(),
                    "recordsFiltered" => $this->assignment->countFilteredquicksurvey($_POST),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {

                $encrypted_json = $this->input->get('data');
                if ($encrypted_json) {
                    // Decrypt the JSON string
                    $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));

                    if ($decrypted_json) {
                        // Decode the JSON string back into an array
                        $data_array = json_decode($decrypted_json, true);

                        // Access the individual values
                        $defaultcompany = $data_array['defaultcompany'] ?? null;
                        $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                        $usertype = $data_array['usertype'] ?? null;

                        $data = [
                            'defaultcompany' => $defaultcompany,
                            'defaultdepartment' => $defaultdepartment,
                            'usertype' => $usertype,
                            'view' => "Quick Survey",
                        ];
                        $this->load->view("adminpanel/quicksurveyfile/index", $data);
                    }
                }
            }
        } else {
            redirect('user_logout');
        }
    }
}
