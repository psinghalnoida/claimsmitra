<?php defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
require_once APPPATH . 'libraries/stripe-php/init.php';


use Dompdf\Dompdf;
use Dompdf\Options;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class Cases extends CI_Controller
{

    public function check_version()
    {
        echo 'CodeIgniter Version: ' . CI_VERSION;
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('case_model');
        $this->load->model('home_model');
        $this->load->helper('upload_helper');
        $this->load->library('encryption');
        $this->load->helper('custom_helper');
        $this->load->model('setting_model');
    }


    public function search_inspector()
    {
        $searchItem = $this->input->post('search');
        $result = $this->case_model->search($searchItem);
        echo json_encode($result);
    }

    public function search_inspector_individual()
    {
        $searchItem = $this->input->post('search');
        $sessionUser = $this->session->userdata('id'); // Get session user ID

        // Check if session user is set
        if (empty($sessionUser)) {
            echo json_encode(['status' => 'error', 'message' => 'User session not found']);
            return;
        }

        $result = $this->case_model->searchInspectorIndividual($searchItem, $sessionUser);

        if (empty($result)) {
            echo json_encode(['status' => 'error', 'message' => 'No records found']);
        } else {
            echo json_encode($result);
        }
    }

    public function showcreatecase()
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
                    $this->load->view('adminpanel/jobs/locationbasedjob/createcase', $data);
                }
            }
        } else {
        }
    }

    public function createtemplate()
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
                        'view' => "Templates",
                    ];
                    $this->load->view('adminpanel/jobs/locationbasedjob/createtemplate', $data);
                }
            }
        } else {
        }
    }

    
    public function showdashboard()
    {
        if ($this->session->userdata('id') != null) {
            $this->load->view('adminpanel/jobs/locationbasedjob/createcase');
        }
    }

    public function listUsersWithDetails()
    {
        $this->load->model('case_model');
        $userid = $this->session->userdata('id'); // Get logged-in user ID
        // $company_id = $this->case_model->getCompanyId();
        $companydata = $this->case_model->getUsersWithBankDepartmentAndCompany($userid);

        header('Content-Type: application/json');
        echo json_encode($companydata, JSON_PRETTY_PRINT);
        exit();
    }


    // public function checkout()
    // {
    //     $amount  = $this->input->post('amount');
    //     $product  = $this->input->post('product');
    //     $aid  = $this->input->post('aid');
    //     $gst  = $this->input->post('gst');
    //     $partial_amount  = $this->input->post('partial_amount');
    //     $servicecharge  = $this->input->post('servicecharge');
    //     $casetype  = $this->input->post('casetype');
    //     $productname = $product . ' ' . $aid;
    //     $stripeamount = round($amount * 100, 2);
    //     $stripe = new \Stripe\StripeClient($this->config->item('stripe_secret'));
    //     $checkout_session = $stripe->checkout->sessions->create([
    //         'line_items' => [[
    //             'price_data' => [
    //                 'product_data' => [
    //                     'name' => $productname

    //                 ],
    //                 'unit_amount' => $stripeamount,
    //                 'currency' => $this->config->item('stripe_currency')

    //             ],
    //             'quantity' => 1
    //         ]],
    //         'mode' => 'payment',
    //         'metadata' => [
    //             'product' => $product,
    //             'aid' => $aid,
    //             'gst' => $gst,
    //             'casetype' => $casetype,
    //             'partial_amount' => $partial_amount,
    //             'servicecharge' => $servicecharge
    //         ],
    //         'success_url' => base_url('cases/success') . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => base_url('cases/cancel'),
    //         'phone_number_collection' => ['enabled' => true]
    //     ]);
    //     echo json_encode($checkout_session);
    // }


    public function marineForm()
    {
        $this->load->view("adminpanel\jobs\locationbasedjob\marine_form");
    }

    public function success()
    {
        $dateFormat = 'Y-m-d H:i:s';
        $stripe = new \Stripe\StripeClient($this->config->item('stripe_secret'));
        $session_id = $this->input->get('session_id');
        try {
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }

        $additionalcharges = $this->getadditionalcharges($checkout_session['amount_total']);
        $updatedamount = array(
            'aid' => $checkout_session['metadata']['aid'],
            'receivedamount' => $additionalcharges['realamount']
        );
        $customer_detail = array(
            'email' => $checkout_session['customer_details']['email'],
            'name' => $checkout_session['customer_details']['name'],
            'phone' => $checkout_session['customer_details']['phone']
        );
        $cgst = $checkout_session['metadata']['gst'] / 2;
        $sgst = $checkout_session['metadata']['gst'] / 2;
        $casetype = $checkout_session['metadata']['casetype'];
        if ($checkout_session['payment_status'] == "paid") {
            $status = true;
        }
        $data = array(
            'aid' => $checkout_session['metadata']['aid'],
            'paymentid' => $checkout_session['payment_intent'],
            'paymentBy' => $this->session->userdata('id'),
            'paymentint' => json_encode($customer_detail),
            'receivedamount' => $checkout_session['amount_total'] / 100,
            'servicecharge' => $additionalcharges['servicecharge'],
            'cgst' => $cgst,
            'sgst' => $sgst,
            'igst' => null,
            'paymentat' => date($dateFormat, $checkout_session['created']),
            'status' => $status
        );
        $payin = $this->case_model->paymentIn($data);
        if ($payin) {
            $updatepayment  = $this->case_model->updatePayment($updatedamount, $casetype);
            if ($updatepayment) {
                $this->load->view('adminpanel/paymentsuccess');
            }
        }
    }

    public function cancel()
    {
        $this->load->view('adminpanel/paymentcancel');
    }

    public function getcasedatatype()
    {
        $data = $this->case_model->getAllCaseform();
        echo json_encode($data);
    }

    public function getadditionalcharges($amount)
    {
        $amount = $amount / 100;
        $gst = $amount - $amount / 1.18;
        $servicecharge = ($amount / 1.18) - (($amount / 1.18) / 1.05);
        $realamount = $amount - $gst - $servicecharge;
        $data = array(
            'gst' => number_format($gst, 2),
            'servicecharge' => number_format($servicecharge, 2),
            'realamount' => $realamount
        );
        return $data;
    }

    public function caseapproved()
    {
        if ($this->session->userdata('id') != null) {
            $aid = "14122312313348";
            $additioncharges = $this->case_model->getTaxation();
            $result = $this->case_model->getCaseDetails($aid);
            print_r(json_encode($result));
            die;
            if ($result) {
                if ($result['status'] == 1) {
                }
            }
        } else {
            redirect('user_logout');
        }
    }

    /**
     * Get non location incoming case
     */
    public function getnonlocationincoming()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Incoming case";
            $this->load->view("adminpanel/jobs/nonlocationbasedjob/incomingcase", $data);
        } else {
            redirect('user_logout');
        }
    }


    public function getnonlocationpending()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Pending case";
            $this->load->view("adminpanel/jobs/nonlocationbasedjob/pendingcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    public function sharecase()
    {
        $mobileno = $this->input->post('mobile_no');
        $aid = $this->input->post('aid');

        $id = $this->case_model->mobileExists($mobileno);

        if ($id !== false) {
            $affectedRows = $this->case_model->sharedById($aid, $id);
            if ($affectedRows > 0) {
                echo "Column ($columnName) has been updated for AID ($aid).";
            } else {
                echo "Error updating column for AID ($aid).";
            }
        } else {
            $userdata = array(
                'mobile' => "+91" . $mobileno,
                'is_active' => 0
            );
            if ($this->home_model->createuser($userdata)) {
                $id = $this->case_model->mobileExists($mobileno);
                $affectedRows = $this->case_model->sharedById($aid, $id);
                if ($affectedRows > 0) {
                    echo "user created successfully";
                } else {
                    echo "Error updating column for AID ($aid).";
                }
            } else {
                $response = array("status" => 500, "message" => "500 Internal server error!");
                echo json_encode($response);
            }
        }
    }

    public function getnonlocationpendingcase()
    {
        if ($this->session->userdata('id') != null) {
            $data = array();
            $jobData = $this->case_model->getPendingCases($_POST);

            $i = $_POST['start'];
            foreach ($jobData as $jobValue) {
                $i++;
                $case_status = null;
                if ($jobValue->status == "Action not initiated") {
                    $case_status = '<span class="label label-warning">Action not initiated</span>';
                } else if ($jobValue->status == "Accepted") {
                    $case_status = '<span class="label label-success">Accepted</span>';
                }
                $language = explode(',', $jobValue->jobdata);
                $action = '<div class="dropleft">
                                <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu">
                                    <a href="' . base_url() . 'viewnonlocationpendingjobs/' . $jobValue->id . '" class="dropdown-item">View</a>
                                </div>
                            </div>';
                $created = date('Y/m/d H:i', strtotime($jobValue->createdat));
                $data[] = array(
                    nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
                    nl2br($jobValue->salutation . " " . $jobValue->firstname . " " . $jobValue->lastname . "\n" . '<span style="color:#2bb3c0">' . $jobValue->mobile . '</span>'),
                    nl2br($jobValue->investigator_type . "\n" . '<span style="color:#2bb3c0">' . $language[0] . '</span>'),
                    $case_status,
                    $action
                );
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->case_model->countAllPendingcase(),
                "recordsFiltered" => $this->case_model->countFilteredPendingCase($_POST),
                "data" => $data,
            );
            echo json_encode($output);
        } else {
            redirect('user_logout');
        }
    }

    /**
     * Action View,Reject,Archive
     * Form Field-> Name of contact person, Mobile of Contact Person, Location for verification (Text Box *)
     */
    public function getnonlocationincomingjobs()
    {
        if ($this->session->userdata('id') != null) {
            $data = array();
            $jobData = $this->case_model->getRows($_POST);

            $i = $_POST['start'];
            foreach ($jobData as $jobValue) {
                $i++;
                $case_status = null;
                if ($jobValue->status == "Action not initiated") {
                    $case_status = '<span class="label label-warning">Action not initiated</span>';
                } else if ($jobValue->status == "Accepted") {
                    $case_status = '<span class="label label-success">Accepted</span>';
                }

                $action = '<div class="dropleft">
                                    <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu">
                                    <a href="' . base_url() . 'viewnonlocationincomingjobs/' . $jobValue->id . '" class="dropdown-item">View</a>
                                </div>
                            </div>';
                $jobdata = json_decode($jobValue->extracted_value, true);
                $language_from = isset($jobdata['language_from']) ? $jobdata['language_from'] : null;
                $language_to = isset($jobdata['language_to']) ? $jobdata['language_to'] : null;
                $created = date('Y/m/d H:i', strtotime($jobValue->createdat));
                $data[] = array(
                    nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
                    nl2br($jobValue->salutation . " " . $jobValue->firstname . " " . $jobValue->lastname . "\n" . '<span style="color:#2bb3c0">' . $jobValue->mobile . '</span>'),
                    nl2br($jobValue->investigator_type . "\n" . '<span style="color:#2bb3c0">Language from:<span style="color:#e16123">' . $language_from . '</span><br>Language to:<span style="color:#e16123">' . $language_to . '</span></span>'),
                    $case_status,
                    $action
                );
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->case_model->countAll(),
                "recordsFiltered" => $this->case_model->countFiltered($_POST),
                "data" => $data,
            );
            echo json_encode($output);
        } else {
            redirect('user_logout');
        }
    }

    public function acceptincomingjob()
    {
        if ($this->input->method() == 'post') {
            $aid = $this->input->post('aid');
            $acceptcase = $this->case_model->acceptnonlocationcase($aid);
            print_r($acceptcase);
            exit;
            if ($acceptcase) {
                $updatestatus = $this->case_model->updatecasestatus($aid);
                if ($updatestatus) {
                    $response = array('status' => 200, 'message' => "Case accepted.");
                    echo json_encode($response);
                }
            } else {
                $response = array('status' => 500, 'message' => "Something went wrong. Please contact with admin");
            }
        }
    }

    public function viewnonlocationIncomingJobs($id)
    {
        if ($id != null) {
            $data = null;
            $case = null;
            $casedata = $this->case_model->getIncomingCasebyId($id);
            if ($casedata != false) {
                if (isset($casedata)) {
                    $case = $casedata['investigator_type'];
                }
                $data['case'] = $case;
                $data['casedata'] = $casedata;
                $data['view'] = "View Incoming Case";
                $this->load->view('adminpanel/jobs/nonlocationbasedjob/viewnonlocation', $data);
            }
        }
    }

    public function viewnonlocationOutgoingJobs($id)
    {
        if ($id != null) {
            $data['casedata'] = $this->case_model->getIncomingCasebyId($id);
            $data['case'] = $data['casedata']['investigator_type'];
            $data['view'] = "View Outgoing Case";
            $this->load->view('adminpanel/jobs/nonlocationbasedjob/viewnonlocation', $data);
        }
    }

    /**
     * Get non location outgoing case
     */
    public function getnonlocationoutgoing()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Outgoing case";
            $this->load->view("adminpanel/jobs/nonlocationbasedjob/outgoingcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    public function getnonlocationoutgoingjobs()
    {
        if ($this->session->userdata('id') != null) {
            $data = array();
            $cancel = null;
            $jobData = $this->case_model->getnonlocationoutgoingcases($_POST);
            $accepteduser = null;
            $i = $_POST['start'];
            foreach ($jobData as $jobValue) {
                $i++;
                $case_status = null;
                if ($jobValue->status == "Action not initiated") {
                    $case_status = '<span class="label label-warning">Action not initiated</span>';
                    $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
                } else if ($jobValue->status == "Accepted") {
                    $case_status = '<span class="label label-success">Accepted</span>';
                }
                if ($jobValue->uid_to != 0) {
                    $assignTo = $this->home_model->getuserdatabyid($jobValue->uid_to);
                    $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">' . $assignTo[0]['mobile'] . '</span>');
                } else {
                    $accepteduser = '<span class="label label-warning">Waiting</span>';
                }

                $language = explode(',', $jobValue->jobdata);
                $action = '<div class="dropleft">
                                <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu">
                                    <a href="' . base_url() . 'viewnonlocationoutgoingjobs/' . $jobValue->id . '" class="dropdown-item">View</a>
                                    ' . $cancel . '
                                </div>
                            </div>';
                $created = date('Y/m/d H:i', strtotime($jobValue->createdat));
                $data[] = array(
                    nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
                    $accepteduser,
                    nl2br($jobValue->investigator_type),
                    $case_status,
                    $action
                );
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->case_model->countAllnonlocationoutgoing(),
                "recordsFiltered" => $this->case_model->countFilterednonlocationoutgoing($_POST),
                "data" => $data,
            );
            echo json_encode($output);
        } else {
            redirect('user_logout');
        }
    }

    public function getlocationoutgoingjobs()
    {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $data = array();
                $cancel = null;
                $jobData = $this->case_model->getlocationoutgoingcases($_POST);
                $accepteduser = null;
                $i = $_POST['start'];
                foreach ($jobData as $jobValue) {
                    $insureddata = json_decode($jobValue->jobdata);
                    $i++;
                    $case_status = null;
                    $address = null;
                    if ($jobValue->status == 2) {
                        $case_status = '<span class="label label-warning">Running</span>';
                        // $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
                    } else if ($jobValue->status == 1) {
                        $case_status = '<span class="label label-info">Accepted</span>';
                    } else if ($jobValue->status == 4) {
                        $case_status = '<span class="label label-success">Completed</span>';
                    }
                    if ($jobValue->uid_to != 0) {
                        $assignTo = $this->home_model->getuserdatabyid($jobValue->uid_to);
                        $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">' . $assignTo[0]['mobile'] . '</span>');
                    } else {
                        $accepteduser = '<span class="label label-warning">Waiting</span>';
                    }
                    $action = '<a href="' . base_url() . 'viewcasedetail?q=' . base64_encode($this->encryption->encrypt($jobValue->aid)) . '" id="' . $jobValue->aid . '" class="btn btn-outline-info">View Case</a>';
                    $totalimages = $this->case_model->countFiles($jobValue->aid, "images", 'uploads');
                    $totalvideos = $this->case_model->countFiles($jobValue->aid, "videos", 'uploads');
                    $totaldocuments = $this->case_model->countFiles($jobValue->aid, "documents", 'uploads');
                    if ($jobValue->latitude != "" || $jobValue->longitude != "") {
                        $address = $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude);
                    } else {
                        $address = "Location Not Found";
                    }
                    $language = explode(',', $jobValue->jobdata);
                    $media = '<div class="navbar--nav ml-auto">
                            <ul class="nav" style="flex-wrap:unset">
                                <li class="nav-item">
                                    <a href="' . base_url() . 'locationoutgoingimages/' . $jobValue->aid . '" class="nav-link" style="padding-left:15px; padding-right:15px;">
                                        <i class="fa fa-images"></i>
                                        <span class="badge text-white bg-blue">' . $totalimages . '</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="' . base_url() . 'locationoutgoingvideos/' . $jobValue->aid . '" class="nav-link" style="padding-left:15px; padding-right:15px;">
                                        <i class="fa fa-video"></i>
                                        <span class="badge text-white bg-blue">' . $totalvideos . '</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="' . base_url() . 'locationoutgoingdocuments/' . $jobValue->aid . '" class="nav-link" style="padding-left:15px; padding-right:15px;">
                                        <i class="fa fa-file"></i>
                                        <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                                    </a>
                                </li>
                            </ul>
                        </div>';
                    $created = date('Y/m/d H:i', strtotime($jobValue->createdAt));
                    $data[] = array(
                        nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
                        $jobValue->case_reference,
                        $accepteduser,
                        nl2br($jobValue->investigator_type . "\n" . 'Insured Name: <span style="color:#2bb3c0">' . $insureddata->contact_person_name . '</span>' . "\n" . 'Contact no: <span style="color:#2bb3c0">' . $insureddata->contact_person_mobile . '</span>'),
                        $address,
                        $media,
                        $case_status,
                        $action
                    );
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->case_model->countAlllocationoutgoing(),
                    "recordsFiltered" => $this->case_model->countFilteredlocationoutgoing($_POST),
                    "data" => $data,
                );
                echo json_encode($output);
            } else {
                $data['view'] = "Outgoing case";
                $this->load->view("adminpanel/jobs/locationbasedjob/outgoingcase", $data);
            }
        } else {
            redirect('user_logout');
        }
    }

    function getlocationcompleted()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Completed case";
            $this->load->view("adminpanel/jobs/locationbasedjob/completedcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    function getlocationcompletedjobs()
    {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $data = array();
                $cancel = null;
                $jobData = $this->case_model->getlocationcompletedcases($_POST);
                $accepteduser = null;
                $i = $_POST['start'];
                foreach ($jobData as $jobValue) {
                    $i++;
                    $case_status = null;
                    $address = null;
                    if ($jobValue->status == 2) {
                        $case_status = '<span class="label label-warning">Running</span>';
                        // $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
                    } else if ($jobValue->status == 1) {
                        $case_status = '<span class="label label-info">Accepted</span>';
                    } else if ($jobValue->status == 4) {
                        $case_status = '<span class="label label-success">Completed</span>';
                    }
                    if ($jobValue->uid_to != 0) {
                        $assignTo = $this->home_model->getuserdatabyid($jobValue->uid_to);

                        $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">' . $assignTo[0]['mobile'] . '</span>');
                    } else {
                        $accepteduser = '<span class="label label-warning">Waiting</span>';
                    }
                    $sharecase = '<a href="' . base_url() . 'viewcasedetail/' . $jobValue->aid . '" id="' . $jobValue->aid . '" class="btn btn-outline-info">View Case</a>';
                    $totalimages = $this->case_model->countFiles($jobValue->aid, "images");
                    $totalvideos = $this->case_model->countFiles($jobValue->aid, "videos");
                    $totaldocuments = $this->case_model->countFiles($jobValue->aid, "documents");
                    if ($jobValue->latitude != "" || $jobValue->longitude != "") {
                        $address = $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude);
                    } else {
                        $address = "Location Not Found";
                    }
                    $language = explode(',', $jobValue->jobdata);
                    $action = '<div class="navbar--nav ml-auto">
                            <ul class="nav" style="flex-wrap:unset">
                                <li class="nav-item">
                                    <a href="' . base_url() . 'locationoutgoingimages/' . $jobValue->aid . '" class="nav-link">
                                        <i class="fa fa-images"></i>
                                        <span class="badge text-white bg-blue">' . $totalimages . '</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="' . base_url() . 'locationoutgoingvideos/' . $jobValue->aid . '" class="nav-link">
                                        <i class="fa fa-video"></i>
                                        <span class="badge text-white bg-blue">' . $totalvideos . '</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="' . base_url() . 'locationoutgoingdocuments/' . $jobValue->aid . '" class="nav-link">
                                        <i class="fa fa-file"></i>
                                        <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                                    </a>
                                </li>
                            </ul>
                        </div>';
                    $created = date('Y/m/d H:i', strtotime($jobValue->createdAt));
                    $data[] = array(
                        nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
                        $accepteduser,
                        nl2br($jobValue->investigator_type),
                        $address,
                        $case_status
                    );
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->case_model->countAlllocationcompleted(),
                    "recordsFiltered" => $this->case_model->countFilteredlocationcompleted($_POST),
                    "data" => $data,
                );
                echo json_encode($output);
            } else {
                $data['view'] = "Outgoing case";
                $this->load->view("adminpanel/jobs/locationbasedjob/outgoingcase", $data);
            }
        } else {
            redirect('user_logout');
        }
    }

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

    public function viewlocationimages($aid)
    {
        if ($aid != null) {
            $data['caseimages'] = $this->case_model->getAllFiles($aid, "images");
            $data['aid'] = $aid;
            $data['view'] = "Images";
            $this->load->view('adminpanel/jobs/locationbasedjob/images', $data);
        }
    }

    //     public function viewlocationimages($aid)
    // {
    //     // Check if the user is logged in
    //     if ($this->session->userdata('id') != null) {
    //         // Get the query parameters 'q' and 'data'
    //         $q_param = $this->input->get('q');
    //         $data_param = $this->input->get('data');

    //         // Check if both 'q' and 'data' parameters are present
    //         if ($q_param == null || $data_param == null) {
    //             // Log an error message if parameters are missing
    //             log_message('error', 'Missing q or data parameters. q: ' . var_export($q_param, true) . ' data: ' . var_export($data_param, true));

    //             // Optionally, redirect the user or show an error message
    //             show_error('Required parameters are missing.');
    //             return;
    //         }

    //         // Decrypt the 'q' and 'data' parameters
    //         $aid = $this->encryption->decrypt(base64_decode($q_param));
    //         $encryptedUrl = $this->encryption->decrypt(base64_decode($data_param));

    //         // Check if decryption was successful and if 'aid' is valid
    //         if ($aid != null && $encryptedUrl) {
    //             // Decode the JSON string from 'data' parameter
    //             $data_array = json_decode($encryptedUrl, true);

    //             // Access the individual values from the decoded data
    //             $defaultcompany = $data_array['defaultcompany'] ?? null;
    //             $defaultdepartment = $data_array['defaultdepartment'] ?? null;
    //             $usertype = $data_array['usertype'] ?? null;

    //             // Fetch image files for the specified 'aid'
    //             $data['caseimages'] = $this->case_model->getAllFiles($aid, "images");
    //             $data['aid'] = $aid;
    //             $data['view'] = "Images";
    //             $data['defaultcompany'] = $defaultcompany;
    //             $data['defaultdepartment'] = $defaultdepartment;
    //             $data['usertype'] = $usertype;
    //             $data['companyName'] = $this->company->getCompanyName($defaultcompany);
    //             $data['departmentName'] = $this->company->getDepartmentName($defaultdepartment);

    //             // Load the view with the data
    //             $this->load->view('adminpanel/jobs/locationbasedjob/images', $data);
    //         } else {
    //             // Log an error if decryption fails
    //             log_message('error', 'Decryption failed. Invalid parameters.');
    //             show_error('Decryption failed. Invalid parameters.');
    //         }
    //     } else {
    //         // If the user is not logged in, redirect to the logout page
    //         redirect('user_logout');
    //     }
    // }



    public function viewlocationreports($aid)
    {
        if ($aid != null) {
            $data['casereports'] = $this->case_model->getAllFiles($aid, "reports");
            $data['aid'] = $aid;
            $data['view'] = "Images";
            // $this->load->view('adminpanel/jobs/locationbasedjob/images', $data);
        }
    }

    public function viewlocationvideos($aid)
    {
        if ($aid != null) {
            $data['casevideos'] = $this->case_model->getAllFiles($aid, "videos");
            $data['aid'] = $aid;
            $data['view'] = "Videos";
            $this->load->view('adminpanel/jobs/locationbasedjob/videos', $data);
        }
    }

    public function viewlocationdocuments($aid)
    {
        if ($aid != null) {
            $data['casedocuments'] = $this->case_model->getAllFiles($aid, "documents");

            $data['aid'] = $aid;
            $data['view'] = "Documents";
            $this->load->view('adminpanel/jobs/locationbasedjob/documents', $data);
        }
    }


    /**
     *  FOR DELETE IMAGES (BY KAJAL)
     */
    public function delete_images()
    {
        $this->load->helper('file');

        // Get POST data
        $images = $this->input->post('images');
        $aid = $this->input->post('aid');

        // Validate input
        if (empty($images) || !is_array($images) || empty($aid)) {
            echo json_encode(['status' => 400, 'message' => 'Invalid input']);
            return;
        }

        // Initialize deletion counters
        $deleted = 0;

        // Process each image for deletion
        foreach ($images as $image) {
            $imagePath = './uploads/' . $aid . '/images/' . basename($image);

            if (file_exists($imagePath) && unlink($imagePath)) {
                $deleted++;
            }
        }

        // Return appropriate response
        echo json_encode([
            'status' => 200,
            'message' => $deleted > 0 ? "$deleted image(s) deleted successfully." : 'No images were deleted.'
        ]);
    }


    /**
     *  FOR DELETE VIDEOS (BY KAJAL)
     */

    public function delete_videos()
    {
        // Load the file helper for file operations
        $this->load->helper('file');

        // Get POST data
        $videos = $this->input->post('videos'); // Changed from 'images' to 'videos'
        $aid = $this->input->post('aid');

        // Validate input
        if (empty($videos) || !is_array($videos) || empty($aid)) {
            $response = ['status' => 400, 'message' => 'Invalid input'];
            log_message('error', 'Invalid input: ' . print_r($response, true));
            echo json_encode($response);
            return;
        }

        // Initialize counters for deleted and not found videos
        $deleted = 0;
        $notFound = 0;

        // Process each video for deletion
        foreach ($videos as $video) {
            // Sanitize file name to prevent directory traversal attacks
            $video = basename($video);
            $videoPath = './uploads/' . $aid . '/videos/' . $video; // Changed 'images' to 'videos'

            // Log the path being checked
            log_message('debug', 'Checking path: ' . $videoPath);

            if (file_exists($videoPath)) {
                if (unlink($videoPath)) {
                    $deleted++;
                    log_message('debug', 'Deleted: ' . $videoPath);
                } else {
                    $notFound++;
                    log_message('error', 'Failed to delete: ' . $videoPath);
                }
            } else {
                $notFound++;
                log_message('error', 'File not found: ' . $videoPath);
            }
        }

        // Determine status and message
        if ($deleted > 0) {
            $status = 200;
            $message = "$deleted video(s) deleted successfully.";
        } else {
            $status = 500;
            $message = ($notFound > 0) ? "$notFound video(s) not found." : 'No videos were deleted.';
        }

        // Log the response for debugging
        log_message('debug', 'Response: ' . json_encode(['status' => $status, 'message' => $message]));

        // Return JSON response
        echo json_encode(['status' => $status, 'message' => $message]);
    }

    /**
     *  FOR DELETE DOCS (BY KAJAL)
     */
    public function delete_documents()
    {
        // Load the file helper for file operations
        $this->load->helper('file');

        // Get POST data
        $documents = $this->input->post('documents');
        $aid = $this->input->post('aid');

        // Log the received data for debugging
        log_message('debug', 'Received documents: ' . print_r($documents, true));
        log_message('debug', 'Received aid: ' . $aid);

        // Validate input
        if (empty($documents) || !is_array($documents) || empty($aid)) {
            $response = ['status' => 400, 'message' => 'Invalid input'];
            log_message('error', 'Invalid input: ' . print_r($response, true));
            echo json_encode($response);
            return;
        }

        // Initialize counters for deleted and not found documents
        $deleted = 0;
        $notFound = 0;

        // Process each document for deletion
        foreach ($documents as $document) {
            // Sanitize file name to prevent directory traversal attacks
            $document = basename($document);
            $documentPath = './uploads/' . $aid . '/documents/' . $document;

            // Log the path being checked
            log_message('debug', 'Checking path: ' . $documentPath);

            if (file_exists($documentPath)) {
                if (unlink($documentPath)) {
                    $deleted++;
                    log_message('debug', 'Deleted: ' . $documentPath);
                } else {
                    $notFound++;
                    log_message('error', 'Failed to delete: ' . $documentPath);
                }
            } else {
                $notFound++;
                log_message('error', 'File not found: ' . $documentPath);
            }
        }

        // Determine status and message
        if ($deleted > 0) {
            $status = 200;
            $message = "$deleted document(s) deleted successfully.";
        } else {
            $status = 500;
            $message = ($notFound > 0) ? "$notFound document(s) not found." : 'No documents were deleted.';
        }

        // Log the response for debugging
        log_message('debug', 'Response: ' . json_encode(['status' => $status, 'message' => $message]));

        // Return JSON response
        echo json_encode(['status' => $status, 'message' => $message]);
    }


    /**
     *  FOR DELETE IMAGES (BY KAJAL)
     */
    public function delete_quicksurveyimages()
    {
        // Get POST data
        $images = $this->input->post('images');
        $directoryname = $this->input->post('directoryname');

        // Validate input
        if (empty($images) || !is_array($images) || empty($directoryname)) {
            echo json_encode(['status' => 400, 'message' => 'Invalid input']);
            return;
        }

        // Initialize counters for deleted and not found images
        $deleted = 0;
        $notFound = 0;

        // Process each image for deletion
        foreach ($images as $image) {
            // Sanitize file name and build the file path
            $image = basename($image);
            $imagePath = './quicksurvey/' . $directoryname . '/images/' . $image;

            if (file_exists($imagePath)) {
                if (unlink($imagePath)) {
                    $deleted++;
                } else {
                    $notFound++;
                }
            } else {
                $notFound++;
            }
        }

        // Determine status and message
        if ($deleted > 0) {
            $status = 200;
            $message = "$deleted image(s) deleted successfully.";
        } else {
            $status = 500;
            $message = ($notFound > 0) ? "$notFound image(s) not found." : 'No images were deleted.';
        }

        // Return JSON response
        echo json_encode(['status' => $status, 'message' => $message]);
    }


    /**
     *  FOR DELETE VIDEOS (BY KAJAL)
     */

    public function delete_quicksurveyvideos()
    {
        // Get POST data
        $videos = $this->input->post('videos');
        $directoryname = $this->input->post('directoryname');

        // Validate input
        if (empty($videos) || !is_array($videos) || empty($directoryname)) {
            echo json_encode(['status' => 400, 'message' => 'Invalid input']);
            return;
        }

        // Initialize counters for deleted and not found videos
        $deleted = 0;
        $notFound = 0;

        // Process each video for deletion
        foreach ($videos as $video) {
            // Sanitize file name and build the file path
            $video = basename($video);
            $videoPath = './quicksurvey/' . $directoryname . '/videos/' . $video;

            if (file_exists($videoPath)) {
                if (unlink($videoPath)) {
                    $deleted++;
                } else {
                    $notFound++;
                }
            } else {
                $notFound++;
            }
        }

        // Determine status and message
        if ($deleted > 0) {
            $status = 200;
            $message = "$deleted video(s) deleted successfully.";
        } else {
            $status = 500;
            $message = ($notFound > 0) ? "$notFound video(s) not found." : 'No videos were deleted.';
        }

        // Return JSON response
        echo json_encode(['status' => $status, 'message' => $message]);
    }


    /**
     *  FOR DELETE DOCS (BY KAJAL)
     */
    public function delete_quicksurveydocuments()
    {
        // Get POST data
        $documents = $this->input->post('documents');
        $directoryname = $this->input->post('directoryname');

        // Validate input
        if (empty($documents) || !is_array($documents) || empty($directoryname)) {
            echo json_encode(['status' => 400, 'message' => 'Invalid input']);
            return;
        }

        // Initialize counters for deleted and not found documents
        $deleted = 0;
        $notFound = 0;

        // Process each document for deletion
        foreach ($documents as $document) {
            // Sanitize file name and build the file path
            $document = basename($document);
            $documentPath = './quicksurvey/' . $directoryname . '/documents/' . $document;

            if (file_exists($documentPath)) {
                if (unlink($documentPath)) {
                    $deleted++;
                } else {
                    $notFound++;
                }
            } else {
                $notFound++;
            }
        }

        // Determine status and message
        if ($deleted > 0) {
            $status = 200;
            $message = "$deleted document(s) deleted successfully.";
        } else {
            $status = 500;
            $message = ($notFound > 0) ? "$notFound document(s) not found." : 'No documents were deleted.';
        }

        // Return JSON response
        echo json_encode(['status' => $status, 'message' => $message]);
    }



    /**
     *  FOR DELETE IMAGES (BY KAJAL)
     */
    public function delete_reports()
    {
        $this->load->helper('file');

        $reports = $this->input->post('reports'); // Ensure this is 'reports'
        $aid = $this->input->post('aid');

        log_message('debug', 'Received reports: ' . print_r($reports, true));
        log_message('debug', 'Received aid: ' . $aid);

        if (empty($reports) || !is_array($reports) || empty($aid)) {
            $response = ['status' => 400, 'message' => 'Invalid input'];
            log_message('error', 'Invalid input: ' . print_r($response, true));
            echo json_encode($response);
            return;
        }

        $deleted = 0;
        $notFound = 0;

        foreach ($reports as $report) {
            $report = basename($report);
            $reportPath = './uploads/' . $aid . '/reports/' . $report;

            log_message('debug', 'Checking path: ' . $reportPath);

            if (file_exists($reportPath)) {
                if (unlink($reportPath)) {
                    $deleted++;
                    log_message('debug', 'Deleted: ' . $reportPath);
                } else {
                    $notFound++;
                    log_message('error', 'Failed to delete: ' . $reportPath);
                }
            } else {
                $notFound++;
                log_message('error', 'File not found: ' . $reportPath);
            }
        }

        if ($deleted > 0) {
            $status = 200;
            $message = "$deleted report(s) deleted successfully.";
        } else {
            $status = 500;
            $message = ($notFound > 0) ? "$notFound report(s) not found." : 'No reports were deleted.';
        }

        log_message('debug', 'Response: ' . json_encode(['status' => $status, 'message' => $message]));

        echo json_encode(['status' => $status, 'message' => $message]);
    }


    /**
     * Created by @Arpit Singh
     * Create assignment for user
     * Only company admin and individual user can create assignment
     * status 0->Action not initiated, 1->Accepted, 2->Rejected, 3->Running,  4->Waiting for Query / Approval, 5->Report ready for download, 6->Completed
     */
    public function createnonlocationcase()
    {
        $nonLocation = "Non Location";
        $upload = new UPLOAD();
        $casedata = array();
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() === 'post') {
                $this->form_validation->set_rules('nature_of_job', 'Nature of Job', 'required');
                $this->form_validation->set_rules('language_list_from', 'Language From', 'required');
                $this->form_validation->set_rules('language_list_to', 'Language To', 'required');
                if ($this->form_validation->run() != FALSE) {
                    $files = $upload->multipleuploadFile('docfortranslation', './assets/upload/');
                    $filename = implode(',', $files);
                    $aid = date("dmyhis") . rand(10, 100);
                    $language = array(
                        "language_from" => $this->input->post('language_list_from'),
                        "language_to" => $this->input->post('language_list_to')
                    );
                    $jobdata = json_encode($language);
                    $natureofjob = $this->input->post('nature_of_job');
                    $totalpage = $this->input->post('totalpages');
                    $casedata = array(
                        "aid" => $aid,
                        "natureofjob" => $natureofjob,
                        "jobdata" => $jobdata,
                        "userId" => $this->session->userdata('id'),
                        "docs" => $filename,
                        "status" => 'Action not initiated'
                    );
                    $createdjob = $this->case_model->insertJob($casedata);
                    if ($createdjob['aid'] != null) {
                        $casedata = $this->case_model->getCosting($natureofjob);
                        if ($casedata != false) {
                            $amount = $casedata['rate'] * $totalpage;
                        }
                        if (!empty($amount)) {
                            $jobassigned = array(
                                "aid" => $createdjob['aid'],
                                "uid_from" => $this->session->userdata('id'),
                                "totalamount" => $amount
                            );
                            $jobassign  = $this->case_model->jobassignTo($jobassigned, $nonLocation);
                        }

                        if ($jobassign) {
                            $data['natureofjob'] = urlencode($this->encryption->encrypt($this->input->post('nature_of_job')));
                            $data['filedata'] = array(
                                'total-file' => urlencode($this->encryption->encrypt($this->input->post('totalfile'))),
                                'total-pages' => urlencode($this->encryption->encrypt($totalpage))
                            );
                            $data['aid'] = urlencode($this->encryption->encrypt($createdjob['aid']));
                            $data['casetype'] = urlencode($this->encryption->encrypt("1"));
                            $response = array("status" => 200, 'message' => "You have successfully created job", 'data' => $data);
                            echo json_encode($response);
                        }
                    } else {
                        $response = array("status" => 500, 'message' => "Internal Server error");
                        echo json_encode($response);
                    }
                }
            } else {
                $nonlocationjob['listofjobs'] = $this->case_model->getNonLocationJob();
                $this->load->view('adminpanel/jobs/nonlocationbasedjob/createcase', $nonlocationjob);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function createlocationcase()
    {
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() === 'post') {
                $case_data = $this->input->post();
                $jobdata = array(
                    'contact_person_name' => $case_data['contact_person_name'],
                    'contact_person_mobile' => $case_data['contact_person_mobile'],
                    'policyNumber' => $case_data['policyNumber'],
                    'insured_name' => !empty($case_data['name_of_owner']) ? $case_data['name_of_owner'] : $case_data['name_of_beneficiary'],
                    'tag_vehicle' => !empty($case_data['animal_tag_number']) ? $case_data['animal_tag_number'] : $case_data['vehicle_number'],
                    'cause_loss' => $case_data['cause_of_loss'],
                    'location_survey' => $case_data['location_of_survey'],
                    'workshop_name' => $case_data['name_of_workshop'],
                    'workshop_advisor_name' => $case_data['name_of_advisor'],
                    'instruction' => $case_data['instruction'],
                    // 'period_of_coverge'=>$case_data['period_of_coverge'],
                    'surveyor_observation' => null
                );
                $data = array(
                    'aid' => date("dmyhis") . rand(10, 100),
                    'userId' => $this->session->userdata('id'),
                    'jobdata' => json_encode($jobdata),
                    'natureofjob' => isset($case_data['natureofjob']) ? $case_data['natureofjob'] : null,
                    'status' => "1"
                );
                $result = $this->case_model->createcase($data);
                if ($result['aid'] != null) {
                    $casedata = $this->case_model->getCosting($case_data['natureofjob']);
                    if (!is_dir('./uploads/' . $result['aid'] . '/images')) {
                        mkdir('./uploads/' . $result['aid'] . '/images', 0777, TRUE);
                    }
                    if (!is_dir('./uploads/' . $result['aid'] . '/videos')) {
                        mkdir('./uploads/' . $result['aid'] . '/videos', 0777, TRUE);
                    }
                    if (!is_dir('./uploads/' . $result['aid'] . '/documents')) {
                        mkdir('./uploads/' . $result['aid'] . '/documents', 0777, TRUE);
                    }
                    if (!is_dir('./uploads/' . $result['aid'] . '/reports')) {
                        mkdir('./uploads/' . $result['aid'] . '/reports', 0777, TRUE);
                    }
                    if ($casedata != false) {
                        $amount = $casedata['rate'];
                    }
                    if (!empty($amount)) {
                        if ($case_data['available_at_location'] == 'yes') {
                            $this->sendwhatsapp($case_data['contact_person_mobile'], $result['aid'], "2");
                        } else if ($case_data['available_at_location'] == 'no') {
                            $this->sendwhatsapp($case_data['whatsapp_number'], $result['aid'], "2");
                        }
                        $this->sendwhatsapptoinspector($case_data['inspectorid'], $result['aid'], "2");
                        $jobassigned = array(
                            "aid" => $result['aid'],
                            "uid_from" => $this->session->userdata('id'),
                            "uid_to" => $case_data['inspectorid'],
                            "totalamount" => $amount
                        );
                        $location = "location";
                        $jobassign  = $this->case_model->jobassignTo($jobassigned, $location);
                    }
                    if ($jobassign) {
                        $data['natureofjob'] = urlencode($this->encryption->encrypt($this->input->post('natureofjob')));
                        $data['aid'] = urlencode($this->encryption->encrypt($result['aid']));
                        $data['casetype'] = urlencode($this->encryption->encrypt("2"));
                        $response = array("status" => 200, 'message' => "You have successfully created job", 'data' => $data);
                        echo json_encode($response);
                    }
                } else {
                    $response = array("status" => 500, 'message' => "Internal Server error");
                    echo json_encode($response);
                }
            } else {
                $locationjob['listofjobs'] = $this->case_model->getLocationJob();
                $this->load->view('adminpanel/jobs/locationbasedjob/createcase', $locationjob);
            }
        }
    }

    public function createlocationcasewithout()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            if ($this->input->method() === 'post') {
                $case_data = $this->input->post();
                if ($case_data['natureofjob'] == 63) {
                    $jobdata = array(
                        'contact_person_name' => $case_data['contact_person_name'],
                        'contact_person_mobile' => $case_data['contact_person_mobile'],
                        'name_of_consignee' => $case_data['name_of_consignee'],
                        'name_of_commodity' => $case_data['name_of_commodity'],
                        'invoicenumber' => json_encode($case_data['invoices']),
                        'cause_loss' => $case_data['cause_of_loss'],
                        'location_survey' => $case_data['location_of_survey'],
                        'instruction' => $case_data['instruction'],
                        'surveyor_observation' => null
                    );
                } else {
                    $jobdata = array(
                        'contact_person_name' => $case_data['contact_person_name'],
                        'contact_person_mobile' => $case_data['contact_person_mobile'],
                        'policyNumber' => $case_data['policyNumber'],
                        'insured_name' => !empty($case_data['name_of_owner']) ? $case_data['name_of_owner'] : $case_data['name_of_beneficiary'],
                        'tag_vehicle' => !empty($case_data['animal_tag_number']) ? $case_data['animal_tag_number'] : $case_data['vehicle_number'],
                        'cause_loss' => $case_data['cause_of_loss'],
                        'location_survey' => $case_data['location_of_survey'],
                        'workshop_name' => $case_data['name_of_workshop'],
                        'workshop_advisor_name' => $case_data['name_of_advisor'],
                        'instruction' => $case_data['instruction'],
                        'surveyor_observation' => null
                    );
                }
                $data = array(
                    'aid' => date("dmyhis") . rand(10, 100),
                    'userId' => $this->session->userdata('id'),
                    'jobdata' => json_encode($jobdata),
                    'natureofjob' => isset($case_data['natureofjob']) ? $case_data['natureofjob'] : null,
                    'status' => "1"
                );
                $result = $this->case_model->createcase($data);
                if ($result['aid'] != null) {
                    $casedata = $this->case_model->getCosting($case_data['natureofjob']);
                    if (!is_dir('./uploads/' . $result['aid'] . '/images')) {
                        mkdir('./uploads/' . $result['aid'] . '/images', 0777, TRUE);
                    }
                    if (!is_dir('./uploads/' . $result['aid'] . '/videos')) {
                        mkdir('./uploads/' . $result['aid'] . '/videos', 0777, TRUE);
                    }
                    if (!is_dir('./uploads/' . $result['aid'] . '/documents')) {
                        mkdir('./uploads/' . $result['aid'] . '/documents', 0777, TRUE);
                    }
                    if (!is_dir('./uploads/' . $result['aid'] . '/reports')) {
                        mkdir('./uploads/' . $result['aid'] . '/reports', 0777, TRUE);
                    }
                    if ($case_data['natureofjob'] == 63) {
                        if (!is_dir('./uploads/' . $result['aid'] . '/invoice')) {
                            mkdir('./uploads/' . $result['aid'] . '/invoice', 0777, TRUE);
                        }
                        $files = $upload->multipleuploadFile('addinvoice', './uploads/' . $result['aid'] . '/invoice');
                    }
                    if ($casedata != false) {
                        $amount = $casedata['rate'];
                    }
                    if (!empty($amount)) {
                        if ($case_data['available_at_location'] == 'yes') {
                            $this->sendwhatsapp($case_data['contact_person_mobile'], $result['aid'], "2");
                        } else if ($case_data['available_at_location'] == 'no') {
                            $this->sendwhatsapp($case_data['whatsapp_number'], $result['aid'], "2");
                        }
                        $this->sendwhatsapptoinspector($case_data['inspectorid'], $result['aid'], "2");
                        $jobassigned = array(
                            "aid" => $result['aid'],
                            "uid_from" => $this->session->userdata('id'),
                            "uid_to" => $case_data['inspectorid'],
                            "totalamount" => $amount
                        );
                        $location = "location";
                        $jobassign  = $this->case_model->jobassignTo($jobassigned, $location);
                    }
                    if ($jobassign) {
                        $response = array("status" => 200, 'message' => "You have successfully created job");
                        echo json_encode($response);
                    }
                } else {
                    $response = array("status" => 500, 'message' => "Internal Server error");
                    echo json_encode($response);
                }
            } else {
                $locationjob['listofjobs'] = $this->case_model->getLocationJob();
                $this->load->view('adminpanel/jobs/locationbasedjob/createcase', $locationjob);
            }
        }
    }





    public function sharelocation($param1, $param2)
    {

        // Pass other parameters to the view
        $data['aid'] = $param1;
        $data['casetype'] = $param2;

        // Load the view with data
        $this->load->view('location/index', $data);
    }



    public function storelocation()
    {
        $data = $this->input->post();
        $locationdata = array(
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude']
        );
        $storesurveylocation = $this->case_model->updateRecord($locationdata, $data['aid'], $data['casetype']);
        if ($storesurveylocation) {
            echo json_encode($storesurveylocation);
        }
    }

    public function thank_you()
    {
        $this->load->view('location/thankyoupage');
    }

    public function createothercase()
    {
        $nonLocation = "Non Location";
        $upload = new UPLOAD();
        $casedata = array();
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() === 'post') {
                print_r($this->input->post());
                $this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required');
                $this->form_validation->set_rules('contact_person_mobile', 'Contact Person Mobile', 'required');
                $this->form_validation->set_rules('pincode', 'Pincode', 'required');
                if ($this->input->post('vehicleno') != null) {
                    $this->form_validation->set_rules('vehicleno', 'Vehicle No', 'required');
                }
                if ($this->form_validation->run() != FALSE) {
                    $files = $upload->multipleuploadFile('documents', './assets/upload/');
                    $filename = implode(',', $files);
                    $aid = date("dmyhis") . rand(10, 100);
                    $case_data = array(
                        "contact_person_name" => $this->input->post('contact_person_name'),
                        "contact_person_mobile" => $this->input->post('contact_person_mobile'),
                        "pincode" => $this->input->post('pincode'),
                        "state" => $this->input->post('state'),
                        "city" => $this->input->post('city'),
                        "vehicleno" => $this->input->post('vehicleno'),
                        "add_on_information" => $this->input->post('add_on_information'),
                        "agree" => $this->input->post('agree')
                    );
                    $jobdata = json_encode($case_data);
                    $casedata = array(
                        "aid" => $aid,
                        "natureofjob" => $this->input->post('nature_of_job'),
                        "jobdata" => $jobdata,
                        "userId" => $this->session->userdata('id'),
                        "docs" => $filename,
                        "status" => 'Action not initiated'
                    );
                    $createdjob = $this->case_model->insertJob($casedata);
                    if ($createdjob['aid'] != null) {
                        $casedata = $this->case_model->getCosting($this->input->post('nature_of_job'));
                        if ($casedata != false) {
                            $amount = $casedata['rate'];
                        }
                        if (!empty($amount)) {
                            $jobassigned = array(
                                "aid" => $createdjob['aid'],
                                "uid_from" => $this->session->userdata('id'),
                                "totalamount" => $amount
                            );
                            $jobassign  = $this->case_model->jobassignTo($jobassigned, $nonLocation);
                        }
                        if ($jobassign) {
                            $data['natureofjob'] = urlencode($this->encryption->encrypt($this->input->post('nature_of_job')));
                            $data['aid'] = urlencode($this->encryption->encrypt($createdjob['aid']));
                            $data['casetype'] = urlencode($this->encryption->encrypt("1"));
                            $response = array("status" => 200, 'message' => "You have successfully created job", 'data' => $data);
                            echo json_encode($response);
                        }
                    } else {
                        $response = array("status" => 500, 'message' => "Internal Server error");
                        echo json_encode($response);
                    }
                }
            } else {
                $nonlocationjob['listofjobs'] = $this->case_model->getNonLocationJob();
                $this->load->view('adminpanel/jobs/nonlocationbasedjob/createcase', $nonlocationjob);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function paychekout()
    {
        $data['natureofjob'] = $this->encryption->decrypt(urldecode($this->input->get('natureofjob')));
        $data['files'] = $this->encryption->decrypt(urldecode($this->input->get('files')));
        $data['pages'] = $this->encryption->decrypt(urldecode($this->input->get('pages')));
        $data['aid'] = $this->encryption->decrypt(urldecode($this->input->get('aid')));
        $data['case_type'] = $this->encryption->decrypt(urldecode($this->input->get('casetype')));
        $data['costing'] = $this->case_model->getCosting($data['natureofjob']);

        $this->load->view('adminpanel/jobs/nonlocationbasedjob/paymentcheckout', $data);
    }

    public function uploadFile()
    {
        $aid = date("dmyhis") . rand(10, 100);

        $pdfname = basename($_FILES["file"]["name"]);

        if ($pdfname != null) {
            preg_match('/(?<extension>\.\w+)$/im', $pdfname, $matches);
            $extension = $matches['extension'];
            $thumbnail = $aid . '_' . sha1($pdfname . time()) . $extension;

            if ($_FILES["file"] != null) {
                $config['upload_path'] = './assets/profile';
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $thumbnail;

                $this->load->library('upload', $config);
                if (!is_dir('./assets/profile')) {
                    mkdir('./assets/profile', 0777, TRUE);
                }
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode($error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    echo json_encode($data);
                }
                //$this->upload->do_upload('uploadpdf');
            }
        }
    }

    public function uploadreport()
    {
        $upload = new UPLOAD();
        $files = $upload->singleuploadFile('uploadpdf', './assets/upload/');
        if ($files) {
            $this->updatestatus();
        } else {
        }
    }

    public function updatecasestatus()
    {
        if ($this->session->userdata('id') != null) {
            $casestatus = $this->input->post('status');
            $aid = $this->input->post('aid');
            $updatestatus = $this->case_model->updatestatus($aid, $casestatus);
            if ($updatestatus) {
                $response = array("status" => 200, 'message' => "Case updated successfully");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }



    public function get_pdf($file_name)
    {
        $pdf_path = './assets/profile' . $file_name;
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file_name . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($pdf_path);
    }

    /**
     * Get non location completed case
     */
    public function getnonlocationcompleted()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Completed case";
            $this->load->view("adminpanel/jobs/nonlocationbasedjob/completedcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    // Pincode based jobs

    /**
     * Get pincode incoming case
     */
    public function getpincodeincoming()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Incoming case";
            $this->load->view("adminpanel/jobs/pincodebasedjob/incomingcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    /**
     * Get pin code outgoing case
     */
    public function getpincodeoutgoing()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Outgoing case";
            $this->load->view("adminpanel/jobs/pincodebasedjob/outgoingcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    /**
     *  Get pin code completed case
     */
    public function getpincodecompleted()
    {
        if ($this->session->userdata('id') != null) {
            $data['case'] = "Completed case";
            $this->load->view("adminpanel/jobs/pincodebasedjob/outgoingcase", $data);
        } else {
            redirect('user_logout');
        }
    }

    /**
     * Created by @Arpit Singh
     * Create assignment for user
     * Only company admin and individual user can create assignment
     * status 0->Action not initiated, 1->Accepted, 2->Rejected, 3->running,  4->Waiting for Query, 5->Archive, 6->Completed
     */
    public function createpincodecase()
    {
        $caseType = "Pincode";
        $upload = new UPLOAD();
        $casedata = array();
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() === 'post') {
                $this->form_validation->set_rules('nature_of_job', 'Nature of Job', 'required');
                $this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required');
                $this->form_validation->set_rules('contact_person_mobile', 'Contact Person Mobile', 'required');
                $this->form_validation->set_rules('pincode', 'Pincode', 'required');
                if ($this->form_validation->run() != FALSE) {
                    $files = $upload->multipleuploadFile('uploadpdf', './assets/upload/');
                    $filename = implode(',', $files);
                    $aid = date("dmyhis") . rand(10, 100);
                    $case_data = array(
                        "natureofjob" => $this->input->post('nature_of_job'),
                        "contact_person_name" => $this->input->post('contact_person_name'),
                        "contact_person_mobile" => $this->input->post('contact_person_mobile'),
                        "pincode" => $this->input->post('pincode'),
                        "state" => $this->input->post('state'),
                        "city" => $this->input->post('city'),
                        "docs" => $filename,
                        "add_on_information" => $this->input->post('add_on_information'),
                        "agree" => $this->input->post('agree')
                    );
                    $jobdata = json_encode($case_data);
                    $casedata = array(
                        "aid" => $aid,
                        "natureofjob" => $this->input->post('nature_of_job'),
                        "jobdata" => $jobdata,
                        "userId" => $this->session->userdata('id'),
                        "docs" => $filename,
                        "status" => 'Action not initiated'
                    );
                    $createdjob = $this->case_model->insertPinCodeJob($casedata);
                    if ($createdjob['aid'] != null) {
                        $casedata = $this->case_model->getCosting($this->input->post('nature_of_job'));
                        if ($casedata != false) {
                            $amount = $casedata['rate'];
                        }
                        if (!empty($amount)) {
                            $jobassigned = array(
                                "aid" => $createdjob['aid'],
                                "uid_from" => $this->session->userdata('id'),
                                "totalamount" => $amount
                            );
                            $jobassign  = $this->case_model->jobassignTo($jobassigned, $caseType);
                        }
                        if ($jobassign) {
                            $data['natureofjob'] = urlencode($this->encryption->encrypt($this->input->post('nature_of_job')));
                            $data['aid'] = urlencode($this->encryption->encrypt($createdjob['aid']));
                            $data['casetype'] = urlencode($this->encryption->encrypt("0"));
                            $response = array("status" => 200, 'message' => "You have successfully created job", 'data' => $data);
                            echo json_encode($response);
                        }
                    } else {
                        $response = array("status" => 500, 'message' => "Internal Server error");
                        echo json_encode($response);
                    }
                }
            } else {
                $pincodejob['listofjobs'] = $this->case_model->getPincodeJob();
                $this->load->view('adminpanel/jobs/pincodebasedjob/createcase', $pincodejob);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function assignTask()
    {
        $upload = new UPLOAD();
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() == 'post') {
                $filename = $upload->multipleuploadFile('docfortranslation', './assets/upload/');
                $files = "";
                foreach ($filename as $value) {
                    $files .= $value['file_name'] . ", ";
                }
                $language_from = $this->input->post('language_list_from');
                $language_to = $this->input->post('language_list_to');
                $nature_of_job = $this->input->post('nature_of_job');
                $languagedata = array(
                    'language_from' => $language_from,
                    'language_to' => $language_to
                );
                $jobdata = implode(',', $languagedata);
                $data = array(
                    'aid' => date("ymdhis") . rand(10, 100),
                    'jobdata' => $jobdata,
                    'userId' => $this->session->userdata('id'),
                    'docs' => $files,
                    'natureofjob' => $nature_of_job
                );
                $job  = $this->case_model->insertjob($data);
                if ($job['status']) {
                    $this->session->set_userdata('job_data', $data);
                    $response = array("status" => 200, 'message' => "Job created successfully");
                    echo json_encode($response);
                }
            } else {
                $this->load->view('adminpanel/jobs/assigntask');
            }
        } else {
            redirect('user_logout');
        }
    }

    public function getvendorlist()
    {
        if ($this->session->userdata('id') != null) {
            $jobdata = $this->session->userdata('job_data');
            $natureofjob = $this->case_model->getnatureofjob($jobdata['natureofjob']);
            if ($natureofjob == "Document Translation") {
                $language = explode(',', $jobdata['jobdata']);
                $_POST['language'] = $language[0];
            }
            $vendordata = $this->case_model->getVendorRows($_POST);
            $i = $_POST['start'];
            foreach ($vendordata as $vendorValue) {
                $i++;
                $action = '<div class="dropleft">
                                <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-paper-plane"></i></a>
                            </div>';
                $data[] = array(
                    $vendorValue->userId,
                    $vendorValue->firstname . " " . $vendorValue->lastname,
                    $vendorValue->mobile,
                    $vendorValue->state,
                    $vendorValue->city,
                    $vendorValue->address,
                    $vendorValue->pincode,
                    $action
                );
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->case_model->countAllVendor(),
                "recordsFiltered" => $this->case_model->countVendorFiltered($_POST),
                "data" => $data,
            );
            echo json_encode($output);
        } else {
            redirect('user_logout');
        }
    }
    /**
     * Live location based jobs
     * */

    /**
     * Get non location incoming case
     */
    public function getlocationincoming()
    {
        if ($this->session->userdata('id') != null) {
            $data['view'] = "Incoming case";
            $this->load->view("adminpanel/jobs/locationbasedjob/incomingcase", $data);
        } else {
            redirect('user_logout');
        }
    }


    public function getlocationoutgoing()
    {
        if ($this->session->userdata('id') != null) {
            $data['view'] = "Outgoing case";
            $this->load->view("adminpanel/jobs/locationbasedjob/outgoingcase", $data);
        } else {
            redirect('user_logout');
        }
    }


    /**
     * Get Pincode based outgoing cases
     * */

    public function getpincodeoutgoingjobs()
    {
        if ($this->session->userdata('id') != null) {
            $data = array();
            $cancel = null;
            $jobData = $this->case_model->getpincodeoutgoingcases($_POST);
            $accepteduser = null;
            $i = $_POST['start'];
            foreach ($jobData as $jobValue) {
                $i++;
                $case_status = null;
                if ($jobValue->status == "2") {
                    $case_status = '<span class="label label-warning">Running</span>';
                    // $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
                } else if ($jobValue->status == "1") {
                    $case_status = '<span class="label label-info">Accepted</span>';
                } else if ($jobValue->status == "4") {
                    $case_status = '<span class="label label-success">Completed</span>';
                }
                if ($jobValue->uid_to != 0) {
                    $assignTo = $this->home_model->getuserdatabyid($jobValue->uid_to);

                    $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">' . $assignTo[0]['mobile'] . '</span>');
                } else {
                    $accepteduser = '<span class="label label-warning">Waiting</span>';
                }

                $language = explode(',', $jobValue->jobdata);
                $action = '<div class="dropleft">
                                <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu">
                                    <a href="' . base_url() . 'viewpincodeOutgoingJobs/' . $jobValue->id . '" class="dropdown-item">View</a>
                                    ' . $cancel . '
                                </div>
                            </div>';
                $created = date('Y/m/d H:i', strtotime($jobValue->createdat));
                $data[] = array(
                    nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">' . $created . '</span>'),
                    $accepteduser,
                    nl2br($jobValue->investigator_type),
                    $case_status,
                    $action
                );
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->case_model->countAllpincodeoutgoing(),
                "recordsFiltered" => $this->case_model->countFilteredpincodeoutgoing($_POST),
                "data" => $data,
            );
            echo json_encode($output);
        } else {
            redirect('user_logout');
        }
    }

    public function viewallcases()
    {
        if ($this->session->userdata('id') != null) {
            $data['view'] = "All case";
            $this->load->view('adminpanel/jobs/alljobs/index', $data);
        } else {
            redirect('user_logout');
        }
    }


    public function getlivelocationjobs()
    {
        if ($this->session->userdata('id') != null) {
            $data = array();
            $cancel = null;
            $jobData = $this->case_model->getlive_location_Rows($_POST);
            print_r($jobData);
            exit;
            //     $accepteduser = null;
            //     $i = $_POST['start'];
            //     foreach($jobData as $jobValue){
            //         $i++;
            //         $case_status = null;
            //         if($jobValue->status == "2"){
            //             $case_status = '<span class="label label-warning">Running</span>';
            //             // $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
            //         }else if($jobValue->status == "1"){
            //             $case_status = '<span class="label label-info">Accepted</span>';
            //         }else if($jobValue->status == "4"){
            //             $case_status = '<span class="label label-success">Completed</span>';
            //         }
            //         if($jobValue->uid_to != 0){
            //             $assignTo = $this->home_model->getuserdatabyid($jobValue->uid_to);

            //             $accepteduser  = nl2br($assignTo[0]['salutation']." ".$assignTo[0]['firstname']." ".$assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">'.$assignTo[0]['mobile'] .'</span>');
            //         } else{
            //             $accepteduser = '<span class="label label-warning">Waiting</span>';
            //         }

            //         $language = explode(',',$jobValue->jobdata);
            //         $action = '<div class="dropleft">
            //                         <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
            //                         <div class="dropdown-menu">
            //                             <a href="'.base_url().'viewpincodeOutgoingJobs/'.$jobValue->id.'" class="dropdown-item">View</a>
            //                             '.$cancel.'
            //                         </div>
            //                     </div>';
            //         $created = date( 'Y/m/d H:i', strtotime($jobValue->createdat));
            //         $data[] = array(nl2br($jobValue->aid . "\n" . '<span style="color:#2bb3c0">'.$created.'</span>'),
            //             $accepteduser, 
            //             nl2br($jobValue->investigator_type),
            //             $case_status,
            //             $action);
            //     }
            //     $output = array(    
            //         "draw" => $_POST['draw'],
            //         "recordsTotal" => $this->case_model->countAllpincodeoutgoing(),
            //         "recordsFiltered" => $this->case_model->countFilteredpincodeoutgoing($_POST),
            //         "data" => $data,
            //     );
            //     echo json_encode($output);
            // }else{
            //     redirect('user_logout');
        }
    }


    /**
     *  FOR SUBMIT ALL ESSENTIAL DATA (BY KAJAL)
     */
    public function updateessentialdata()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];

            // Update case reference
            if (!$this->case_model->update_case_reference($aid, $case_reference)) {
                return json_encode(array("status" => 500, "message" => "Failed to update case reference"));
            }

            // Prepare essential data for `claims_livelocationjob`
            $essentialDataArray = array();

            if (!empty($essential['policy_by'])) {
                $essentialDataArray['policy_by'] = $essential['policy_by'];
            }

            if (!empty($essential['permit_validityfrom'])) {
                $essentialDataArray['permit_validityfrom'] = $essential['permit_validityfrom'];
            }
            if (!empty($essential['authorization'])) {
                $essentialDataArray['authorization'] = $essential['authorization'];
            }
            if (!empty($essential['authorization_from'])) {
                $essentialDataArray['authorization_from'] = $essential['authorization_from'];
            }
            if (!empty($essential['insurancefrom'])) {
                $essentialDataArray['insurancefrom'] = $essential['insurancefrom'];
            }

            if (!empty($essential['insuranceto'])) {
                $essentialDataArray['insuranceto'] = $essential['insuranceto'];
            }

            if (!empty($essential['insurancefromtime'])) {
                $essentialDataArray['insurancefromtime'] = $essential['insurancefromtime'];
            }

            if (!empty($essential['insurancetotime'])) {
                $essentialDataArray['insurancetotime'] = $essential['insurancetotime'];
            }

            if (!empty($essential['claim_no'])) {
                $essentialDataArray['claim_no'] = $essential['claim_no'];
            }

            if (!empty($essential['lumsum'])) {
                $essentialDataArray['lumsum'] = $essential['lumsum'];
            }
            if (!empty($essential['claim_assessment'])) {
                $essentialDataArray['claim_assessment'] = $essential['claim_assessment'];
            }
            if (!empty($essential['pincode'])) {
                $essentialDataArray['pincode'] = $essential['pincode'];
            }

            if (!empty($essential['policy_branch'])) {
                $essentialDataArray['policy_branch'] = $essential['policy_branch'];
            }

            if (!empty($essential['policy_user'])) {
                $essentialDataArray['policy_user'] = $essential['policy_user'];
            }

            if (!empty($essential['policy_mobile'])) {
                $essentialDataArray['policy_mobile'] = $essential['policy_mobile'];
            }
            if (!empty($essential['selected_policy_vendor_id'])) {
                $essentialDataArray['selected_policy_vendor_id'] = $essential['selected_policy_vendor_id'];
            }

            if (!empty($essential['appoint_by'])) {
                $essentialDataArray['appoint_by'] = $essential['appoint_by'];
            }
            if (!empty($essential['broker_no'])) {
                $essentialDataArray['broker_no'] = $essential['broker_no'];
            }

            if (!empty($essential['appointment_branch_name'])) {
                $essentialDataArray['appointment_branch_name'] = $essential['appointment_branch_name'];
            }

            if (!empty($essential['appointment_user_name'])) {
                $essentialDataArray['appointment_user_name'] = $essential['appointment_user_name'];
            }

            if (!empty($essential['appointment_mobile_num'])) {
                $essentialDataArray['appointment_mobile_num'] = $essential['appointment_mobile_num'];
            }
            if (!empty($essential['selected_appointment_vendor_id'])) {
                $essentialDataArray['selected_appointment_vendor_id'] = $essential['selected_appointment_vendor_id'];
            }

            if (!empty($essential['case_reference'])) {
                $essentialDataArray['case_reference'] = $essential['case_reference'];
            }

            if (!empty($essential['insurer'])) {
                $essentialDataArray['insurer'] = $essential['insurer'];
            }

            if (!empty($essential['insured_name'])) {
                $essentialDataArray['insured_name'] = $essential['insured_name'];
            }

            // if (!empty($essential['nameofowner'])) {
            //     $essentialDataArray['nameofowner'] = $essential['nameofowner'];
            // }

            if (!empty($essential['district'])) {
                $essentialDataArray['district'] = $essential['district'];
            }

            if (!empty($essential['state'])) {
                $essentialDataArray['state'] = $essential['state'];
            }

            if (!empty($essential['periodOfCoverage'])) {
                $essentialDataArray['periodOfCoverage'] = $essential['periodOfCoverage'];
            }

            if (!empty($essential['dateOfDisease'])) {
                $essentialDataArray['dateOfDisease'] = $essential['dateOfDisease'];
            }

            if (!empty($essential['contact_person_mobile'])) {
                $essentialDataArray['contact_person_mobile'] = $essential['contact_person_mobile'];
            }

            if (!empty($essential['tagNumber'])) {
                $essentialDataArray['tagNumber'] = $essential['tagNumber'];
            }

            if (!empty($essential['typeOfAnimal'])) {
                $essentialDataArray['typeOfAnimal'] = $essential['typeOfAnimal'];
            }

            if (!empty($essential['dateOfDeath'])) {
                $essentialDataArray['dateOfDeath'] = $essential['dateOfDeath'];
            }

            if (!empty($essential['timeOfDeath'])) {
                $essentialDataArray['timeOfDeath'] = $essential['timeOfDeath'];
            }

            if (!empty($essential['dateOfSurvey'])) {
                $essentialDataArray['dateOfSurvey'] = $essential['dateOfSurvey'];
            }

            if (!empty($essential['timeOfSurvey'])) {
                $essentialDataArray['timeOfSurvey'] = $essential['timeOfSurvey'];
            }

            if (!empty($essential['deathOrDisablement'])) {
                $essentialDataArray['deathOrDisablement'] = $essential['deathOrDisablement'];
            }

            if (!empty($essential['SurveyConducted'])) {
                $essentialDataArray['SurveyConducted'] = $essential['SurveyConducted'];
            }

            if (!empty($essential['tag_tempered'])) {
                $essentialDataArray['tag_tempered'] = $essential['tag_tempered'];
            }

            if (!empty($essential['cattle_buried'])) {
                $essentialDataArray['cattle_buried'] = $essential['cattle_buried'];
            }

            if (!empty($essential['whysurveyNotConducted'])) {
                $essentialDataArray['whysurveyNotConducted'] = $essential['whysurveyNotConducted'];
            }

            if (!empty($essential['payment_by'])) {
                $essentialDataArray['payment_by'] = $essential['payment_by'];
            }

            if (!empty($essential['payment_branch_name'])) {
                $essentialDataArray['payment_branch_name'] = $essential['payment_branch_name'];
            }

            if (!empty($essential['payment_gst'])) {
                $essentialDataArray['payment_gst'] = $essential['payment_gst'];
            }

            if (!empty($essential['appointment_gst'])) {
                $essentialDataArray['appointment_gst'] = $essential['appointment_gst'];
            }

            if (!empty($essential['payment_user_name'])) {
                $essentialDataArray['payment_user_name'] = $essential['payment_user_name'];
            }

            if (!empty($essential['payment_mobile_num'])) {
                $essentialDataArray['payment_mobile_num'] = $essential['payment_mobile_num'];
            }

            if (!empty($essential['selected_payment_vendor_id'])) {
                $essentialDataArray['selected_payment_vendor_id'] = $essential['selected_payment_vendor_id'];
            }

            if (!empty($essential['date_of_report'])) {
                $essentialDataArray['date_of_report'] = $essential['date_of_report'];
            }

            if (!empty($essential['days_between_policy_and_disease'])) {
                $essentialDataArray['days_between_policy_and_disease'] = $essential['days_between_policy_and_disease'];
            }

            if (!empty($essential['remark'])) {
                $essentialDataArray['remark'] = $essential['remark'];
            }

            if (!empty($essential['name_of_consignee'])) {
                $essentialDataArray['name_of_consignee'] = $essential['name_of_consignee'];
            }

            if (!empty($essential['consignor'])) {
                $essentialDataArray['consignor'] = $essential['consignor'];
            }

            if (!empty($essential['cargo'])) {
                $essentialDataArray['cargo'] = $essential['cargo'];
            }

            if (!empty($essential['packing_description'])) {
                $essentialDataArray['packing_description'] = $essential['packing_description'];
            }

            if (!empty($essential['policyNumber'])) {
                $essentialDataArray['policyNumber'] = $essential['policyNumber'];
            }

            if (!empty($essential['consignment_date'])) {
                $essentialDataArray['consignment_date'] = $essential['consignment_date'];
            }

            if (!empty($essential['survey_allotment_date'])) {
                $essentialDataArray['survey_allotment_date'] = $essential['survey_allotment_date'];
            }

            if (!empty($essential['type_of_loss'])) {
                $essentialDataArray['type_of_loss'] = $essential['type_of_loss'];
            }

            if (!empty($essential['cause_loss'])) {
                $essentialDataArray['cause_loss'] = $essential['cause_loss'];
            }

            if (!empty($essential['claimant_representative'])) {
                $essentialDataArray['claimant_representative'] = $essential['claimant_representative'];
            }

            if (!empty($essential['representative_mobile'])) {
                $essentialDataArray['representative_mobile'] = $essential['representative_mobile'];
            }

            if (!empty($essential['loss_data'])) {
                $essentialDataArray['loss_data'] = $essential['loss_data'];
            }

            if (!empty($essential['loss_date_text'])) {
                $essentialDataArray['loss_date_text'] = $essential['loss_date_text'];
            }

            if (!empty($essential['survey_place'])) {
                $essentialDataArray['survey_place'] = $essential['survey_place'];
            }

            if (!empty($essential['survey_date'])) {
                $essentialDataArray['survey_date'] = $essential['survey_date'];
            }

            if (!empty($essential['consignment_value'])) {
                $essentialDataArray['consignment_value'] = $essential['consignment_value'];
            }

            if (!empty($essential['estimated_amount'])) {
                $essentialDataArray['estimated_amount'] = $essential['estimated_amount'];
            }

            if (!empty($essential['print_estimated_amt'])) {
                $essentialDataArray['print_estimated_amt'] = $essential['print_estimated_amt'];
            }
            if (!empty($essential['print_salvage_amt'])) {
                $essentialDataArray['print_salvage_amt'] = $essential['print_salvage_amt'];
            }
            if (!empty($essential['any_fir'])) {
                $essentialDataArray['any_fir'] = $essential['any_fir'];
            }
            if (!empty($essential['any_pir'])) {
                $essentialDataArray['any_pir'] = $essential['any_pir'];
            }

            if (!empty($essential['salvage_amount'])) {
                $essentialDataArray['salvage_amount'] = $essential['salvage_amount'];
            }
            if (!empty($essential['remarks'])) {
                $essentialDataArray['remarks'] = $essential['remarks'];
            }
            if (!empty($essential['invoices'])) {
                $essentialDataArray['invoices'] = $essential['invoices'];
            }
            if (!empty($essential['gr'])) {
                $essentialDataArray['gr'] = $essential['gr'];
            }

            if (!empty($essential['vehicle_no'])) {
                $essentialDataArray['vehicle_no'] = $essential['vehicle_no'];
            }
            if (!empty($essential['vehicle_number'])) {
                $essentialDataArray['vehicle_number'] = $essential['vehicle_number'];
            }
            if (!empty($essential['account'])) {
                $essentialDataArray['account'] = $essential['account'];
            }
            if (!empty($essential['idv'])) {
                $essentialDataArray['idv'] = $essential['idv'];
            }
            if (!empty($essential['period_of_insurance'])) {
                $essentialDataArray['period_of_insurance'] = $essential['period_of_insurance'];
            }
            if (!empty($essential['register_no'])) {
                $essentialDataArray['register_no'] = $essential['register_no'];
            }
            if (!empty($essential['registered_owner'])) {
                $essentialDataArray['registered_owner'] = $essential['registered_owner'];
            }
            if (!empty($essential['date_of_incident'])) {
                $essentialDataArray['date_of_incident'] = $essential['date_of_incident'];
            }
            if (!empty($essential['time_of_incident'])) {
                $essentialDataArray['time_of_incident'] = $essential['time_of_incident'];
            }
            if (!empty($essential['brief_narration'])) {
                $essentialDataArray['brief_narration'] = $essential['brief_narration'];
            }
            if (!empty($essential['fir_date'])) {
                $essentialDataArray['fir_date'] = $essential['fir_date'];
            }
            if (!empty($essential['fir_no'])) {
                $essentialDataArray['fir_no'] = $essential['fir_no'];
            }
            if (!empty($essential['police_station_name'])) {
                $essentialDataArray['police_station_name'] = $essential['police_station_name'];
            }
            if (!empty($essential['vehicle_owner'])) {
                $essentialDataArray['vehicle_owner'] = $essential['vehicle_owner'];
            }
            if (!empty($essential['appointment_date'])) {
                $essentialDataArray['appointment_date'] = $essential['appointment_date'];
            }
            if (!empty($essential['sum_insured'])) {
                $essentialDataArray['sum_insured'] = $essential['sum_insured'];
            }
            if (!empty($essential['make_model'])) {
                $essentialDataArray['make_model'] = $essential['make_model'];
            }
            if (!empty($essential['name_of_driver'])) {
                $essentialDataArray['name_of_driver'] = $essential['name_of_driver'];
            }
            if (!empty($essential['driving_license_no'])) {
                $essentialDataArray['driving_license_no'] = $essential['driving_license_no'];
            }
            if (!empty($essential['place_of_accident'])) {
                $essentialDataArray['place_of_accident'] = $essential['place_of_accident'];
            }
            if (!empty($essential['place_of_repairer'])) {
                $essentialDataArray['place_of_repairer'] = $essential['place_of_repairer'];
            }
            if (!empty($essential['estimated_loss'])) {
                $essentialDataArray['estimated_loss'] = $essential['estimated_loss'];
            }
            if (!empty($essential['reported_tp_loss'])) {
                $essentialDataArray['reported_tp_loss'] = $essential['reported_tp_loss'];
            }
            if (!empty($essential['spot_survey_details'])) {
                $essentialDataArray['spot_survey_details'] = $essential['spot_survey_details'];
            }
            if (!empty($essential['expected_mode_settlement'])) {
                $essentialDataArray['expected_mode_settlement'] = $essential['expected_mode_settlement'];
            }
            if (!empty($essential['expected_insurer_liability'])) {
                $essentialDataArray['expected_insurer_liability'] = $essential['expected_insurer_liability'];
            }

            if (!empty($essential['documents_checked_original'])) {
                $essentialDataArray['documents_checked_original'] = $essential['documents_checked_original'];
            }
            if (!empty($essential['verification_from_rto'])) {
                $essentialDataArray['verification_from_rto'] = $essential['verification_from_rto'];
            }
            if (!empty($essential['no_of_photographs_attached'])) {
                $essentialDataArray['no_of_photographs_attached'] = $essential['no_of_photographs_attached'];
            }
            if (!empty($essential['brief_cause_of_loss'])) {
                $essentialDataArray['brief_cause_of_loss'] = $essential['brief_cause_of_loss'];
            }
            if (!empty($essential['major_damaged_parts'])) {
                $essentialDataArray['major_damaged_parts'] = $essential['major_damaged_parts'];
            }
            if (!empty($essential['special_observation_suggestion'])) {
                $essentialDataArray['special_observation_suggestion'] = $essential['special_observation_suggestion'];
            }
            if (!empty($essential['insured_address'])) {
                $essentialDataArray['insured_address'] = $essential['insured_address'];
            }
            if (!empty($essential['financers'])) {
                $essentialDataArray['financers'] = $essential['financers'];
            }
            if (!empty($essential['address'])) {
                $essentialDataArray['address'] = $essential['address'];
            }
            if (!empty($essential['policytype'])) {
                $essentialDataArray['policytype'] = $essential['policytype'];
            }
            if (!empty($essential['cause_inspection'])) {
                $essentialDataArray['cause_inspection'] = $essential['cause_inspection'];
            }
            if (!empty($essential['inspection_place'])) {
                $essentialDataArray['inspection_place'] = $essential['inspection_place'];
            }
            if (!empty($essential['subject_matter'])) {
                $essentialDataArray['subject_matter'] = $essential['subject_matter'];
            }
            if (!empty($essential['otherPolicyType'])) {
                $essentialDataArray['otherPolicyType'] = $essential['otherPolicyType'];
            }
            if (!empty($essential['other_nature_Type'])) {
                $essentialDataArray['other_nature_Type'] = $essential['other_nature_Type'];
            }
            if (!empty($essential['subject_matter'])) {
                $essentialDataArray['subject_matter'] = $essential['subject_matter'];
            }
            if (!empty($essential['natureofloss'])) {
                $essentialDataArray['natureofloss'] = $essential['natureofloss'];
            }
            if (!empty($essential['investigation_date'])) {
                $essentialDataArray['investigation_date'] = $essential['investigation_date'];
            }
            if (!empty($essential['loss_place'])) {
                $essentialDataArray['loss_place'] = $essential['loss_place'];
            }
            if (!empty($essential['policy_report'])) {
                $essentialDataArray['policy_report'] = $essential['policy_report'];
            }
            if (!empty($essential['policyNumberfrom'])) {
                $essentialDataArray['policyNumberfrom'] = $essential['policyNumberfrom'];
            }
            if (!empty($essential['policyNumberto'])) {
                $essentialDataArray['policyNumberto'] = $essential['policyNumberto'];
            }
            if (!empty($essential['claimant_name'])) {
                $essentialDataArray['claimant_name'] = $essential['claimant_name'];
            }
            if (!empty($essential['fidelity'])) {
                $essentialDataArray['fidelity'] = $essential['fidelity'];
            }

            // Remove null values from the array
            $essentialDataArray = array_filter($essentialDataArray, function ($value) {
                return $value !== null;
            });

            // Convert to JSON for updating in the database
            if (!empty($essentialDataArray)) {
                $essentialDataJson = json_encode($essentialDataArray);

                // Update essential data in `claims_livelocationjob`
                $is_update = $this->case_model->updateEssentialData($essentialDataJson, $aid);
            } else {
                $is_update = true; // Nothing to update
            }

            // Prepare payment data for `claims_billing`
            $paymentDetails = array();
            if (!empty($essential['payment_by'])) {
                $paymentDetails['billing_payment_by'] = $essential['payment_by']; // Use 'payment_by' for both billing and shipping.
            }

            if (!empty($essential['payment_branch_name'])) {
                $paymentDetails['billing_branch_name'] = $essential['payment_branch_name'];
            }

            if (!empty($essential['payment_user_name'])) {
                $paymentDetails['billing_user_name'] = $essential['payment_user_name']; // Fixed typo 'billingt_user_name'
            }

            if (!empty($essential['payment_mobile_num'])) {
                $paymentDetails['billing_mobile_num'] = $essential['payment_mobile_num'];
            }

            if (!empty($essential['payment_gst'])) {
                $paymentDetails['billing_gst'] = $essential['payment_gst'];
            }

            $shippingpaymentDetails = array();
            if (!empty($essential['appoint_by'])) {
                $shippingpaymentDetails['shipping_payment_by'] = $essential['appoint_by']; // Same key 'payment_by'
            }

            if (!empty($essential['appointment_branch_name'])) {
                $shippingpaymentDetails['shipping_branch_name'] = $essential['appointment_branch_name'];
            }

            if (!empty($essential['appointment_user_name'])) {
                $shippingpaymentDetails['shipping_user_name'] = $essential['appointment_user_name'];
            }

            if (!empty($essential['appointment_mobile_num'])) {
                $shippingpaymentDetails['shipping_mobile_num'] = $essential['appointment_mobile_num'];
            }

            if (!empty($essential['appointment_gst'])) {
                $shippingpaymentDetails['shipping_gst'] = $essential['appointment_gst'];
            }


            // Insert payment data if any fields exist
            if (!empty($paymentDetails)) {
                $paymentDetailsJson = json_encode($paymentDetails);
                $is_payment_insert = $this->case_model->insertPaymentEssentialData($paymentDetailsJson, $aid);
            } else {
                $is_payment_insert = true; // No payment details to insert
            }

            if (!empty($shippingpaymentDetails)) {
                $shippingpaymentDetailsJson = json_encode($shippingpaymentDetails);
                $is_payment_insert = $this->case_model->insertshippingEssentialData($shippingpaymentDetailsJson, $aid);
            } else {
                $is_payment_insert = true; // No payment details to insert
            }

            // Return response
            if ($is_update && $is_payment_insert) {
                $response = array("status" => 200, 'message' => "Data updated successfully");
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
            }

            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }

    public function updatpropertyeessentialdata()
    {
        if ($this->session->userdata('id') !== null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];

            // Update case reference
            if (!$this->case_model->update_case_reference($aid, $case_reference)) {
                echo json_encode(["status" => 500, "message" => "Failed to update case reference"]);
                return;
            }

            $essentialDataArray = [];
            // Map other input fields
            $fieldsToMap = [
                'contact_person_name',
                'policy_by',
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
                $is_update = $this->case_model->updateEssentialData($essentialDataJson, $aid);
            }

            // Handle payment and shipping data
            $paymentDetails = $this->mapFields($essential, [
                'payment_by' => 'billing_payment_by',
                'payment_branch_name' => 'billing_branch_name',
                'payment_user_name' => 'billing_user_name',
                'payment_mobile_num' => 'billing_mobile_num',
                'payment_gst' => 'billing_gst',
            ]);

            $shippingDetails = $this->mapFields($essential, [
                'appoint_by' => 'shipping_payment_by',
                'appointment_branch_name' => 'shipping_branch_name',
                'appointment_user_name' => 'shipping_user_name',
                'appointment_mobile_num' => 'shipping_mobile_num',
                'appointment_gst' => 'shipping_gst',
            ]);

            $is_payment_insert = true;
            $is_shipping_insert = true;

            if (!empty($paymentDetails)) {
                $is_payment_insert = $this->case_model->insertPaymentEssentialData(json_encode($paymentDetails), $aid);
            }

            if (!empty($shippingDetails)) {
                $is_shipping_insert = $this->case_model->insertShippingEssentialData(json_encode($shippingDetails), $aid);
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

    // public function cattleJobData()
    // {
    //     if ($this->session->userdata('id') !== null) {
    //         $upload = new UPLOAD();

    //         if ($this->input->method() === 'post') {
    //             $case_data = $this->input->post();

    //             // Prepare job data based on the received post data
    //             $jobdata = array();

    //             // Existing fields
    //             if (!empty($case_data['contact_person_name'])) {
    //                 $jobdata['contact_person_name'] = $case_data['contact_person_name'];
    //             }

    //             if (!empty($case_data['contact_person_mobile'])) {
    //                 $jobdata['contact_person_mobile'] = $case_data['contact_person_mobile'];
    //             }

    //             if (!empty($case_data['policyNumber'])) {
    //                 $jobdata['policyNumber'] = $case_data['policyNumber'];
    //             }

    //             if (!empty($case_data['name_of_owner']) || !empty($case_data['name_of_beneficiary'])) {
    //                 $jobdata['insured_name'] = $case_data['name_of_owner'] ?? $case_data['name_of_beneficiary'];
    //             }

    //             if (!empty($case_data['animal_tag_number']) || !empty($case_data['vehicle_number'])) {
    //                 $jobdata['tag_vehicle'] = $case_data['animal_tag_number'] ?? $case_data['vehicle_number'];
    //             }

    //             if (!empty($case_data['insured_name'])) {
    //                 $jobdata['insured_name'] = $case_data['insured_name'];
    //             }
    //             if (!empty($case_data['cause_loss'])) {
    //                 $jobdata['cause_loss'] = $case_data['cause_loss'];
    //             }

    //             if (!empty($case_data['location_of_survey'])) {
    //                 $jobdata['location_survey'] = $case_data['location_of_survey'];
    //             }

    //             if (!empty($case_data['name_of_workshop'])) {
    //                 $jobdata['workshop_name'] = $case_data['name_of_workshop'];
    //             }

    //             if (!empty($case_data['name_of_advisor'])) {
    //                 $jobdata['workshop_advisor_name'] = $case_data['name_of_advisor'];
    //             }

    //             if (!empty($case_data['instruction'])) {
    //                 $jobdata['instruction'] = $case_data['instruction'];
    //             }

    //             // New fields
    //             if (!empty($case_data['name_of_consignee'])) {
    //                 $jobdata['name_of_consignee'] = $case_data['name_of_consignee'];
    //             }

    //             if (!empty($case_data['available_at_location'])) {
    //                 $jobdata['available_at_location'] = $case_data['available_at_location'];
    //             }

    //             if (!empty($case_data['whatsapp_number'])) {
    //                 $jobdata['whatsapp_number'] = $case_data['whatsapp_number'];
    //             }

    //             if (!empty($case_data['type_of_vehicle'])) {
    //                 $jobdata['type_of_vehicle'] = $case_data['type_of_vehicle'];
    //             }

    //             if (!empty($case_data['other_type'])) {
    //                 $jobdata['other_type'] = $case_data['other_type'];
    //             }

    //             if (!empty($case_data['vehicle_number'])) {
    //                 $jobdata['vehicle_number'] = $case_data['vehicle_number'];
    //             }

    //             if (!empty($case_data['address'])) {
    //                 $jobdata['address'] = $case_data['address'];
    //             }
    //             if (!empty($case_data['loss_item'])) {
    //                 $jobdata['loss_item'] = $case_data['loss_item'];
    //             }
    //             if (!empty($case_data['name_of_commodity'])) {
    //                 $jobdata['name_of_commodity'] = $case_data['name_of_commodity'];
    //             }

    //             // Prepare the data array for insertion
    //             $data = array(
    //                 'aid' => date("dmyhis") . rand(10, 100),
    //                 'userId' => $this->session->userdata('id'),
    //                 'natureofjob' => $case_data['natureofjob'],
    //                 'jobdata' => json_encode($jobdata),
    //                 'status' => "1" // Default status
    //             );

    //             // Insert the case into the database
    //             $result = $this->case_model->createcase($data);

    //             if ($result['aid'] !== null) {
    //                 // Create directories for file uploads
    //                 $uploadDirs = ['images', 'videos', 'documents', 'reports'];
    //                 foreach ($uploadDirs as $dir) {
    //                     $uploadPath = './uploads/' . $result['aid'] . '/' . $dir;
    //                     if (!is_dir($uploadPath)) {
    //                         mkdir($uploadPath, 0777, TRUE);
    //                     }
    //                 }

    //                 // Handle invoice files if applicable
    //                 if (isset($_FILES['invoices']) && !empty($_FILES['invoices']['name'][0])) {
    //                     $invoicePath = './uploads/' . $result['aid'] . '/invoice';
    //                     if (!is_dir($invoicePath)) {
    //                         mkdir($invoicePath, 0777, TRUE);
    //                     }
    //                     $files = $upload->multipleuploadFile('invoices', $invoicePath);
    //                 }

    //                 // Send notifications if required
    //                 $contactNumber = ($case_data['available_at_location'] === 'yes')
    //                     ? $case_data['contact_person_mobile']
    //                     : ($case_data['whatsapp_number'] ?? null);

    //                 if ($contactNumber) {
    //                     $this->sendwhatsapp($contactNumber, $result['aid'], "2");
    //                 }

    //                 if (!empty($case_data['inspectorid'])) {
    //                     $this->sendwhatsapptoinspector($case_data['inspectorid'], $result['aid'], "2");

    //                     $jobassigned = array(
    //                         "aid" => $result['aid'],
    //                         "uid_from" => $this->session->userdata('id'),
    //                         "uid_to" => $case_data['inspectorid'],
    //                         "totalamount" => null // Adjust as needed if no costing data is available
    //                     );

    //                     $location = "location";
    //                     $jobassign = $this->case_model->jobassignTo($jobassigned, $location);

    //                     if ($jobassign) {
    //                         $response = array("status" => 200, 'message' => "You have successfully created job");
    //                         echo json_encode($response);
    //                     } else {
    //                         $response = array("status" => 500, 'message' => "Failed to assign job");
    //                         echo json_encode($response);
    //                     }
    //                 } else {
    //                     $response = array("status" => 200, 'message' => "Job created successfully without assignment.");
    //                     echo json_encode($response);
    //                 }
    //             } else {
    //                 $response = array("status" => 500, 'message' => "Internal Server error");
    //                 echo json_encode($response);
    //             }
    //         } else {
    //             // Load the view if the method is not POST
    //             $locationjob['listofjobs'] = $this->case_model->getLocationJob();
    //             $this->load->view('adminpanel/jobs/locationbasedjob/createcase', $locationjob);
    //         }
    //     }
    // }








    // public function updateEssentialData()
    // {
    //     // Ensure the user is logged in
    //     if ($this->session->userdata('id') !== null) {
    //         // Get form data
    //         $data = $this->input->post();
    //         $aid = $data['aid'];

    //         // Load the model
    //         $this->load->model('case_model'); // Replace 'YourModel' with the actual model name

    //         // Call the update function
    //         $result = $this->case_model->updateEssentialData($data, $aid);

    //         // Return response
    //         echo json_encode($result);
    //     } else {
    //         redirect('user_logout');
    //     }
    // }




    //ESSENTIAL FORM METHOD
    public function updateCaseData()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->case_model->updateCaseData(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Essential data created successful");
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
     * MOTOR VEHICLE THEFT FORM (KAJAL)
     * ------------------------------------------------------------------------- */
    public function motortheftilaform()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];
            $this->case_model->update_case_reference($aid, $case_reference);
            $job_data = $this->case_model->get_jobdata_case($aid);
            $data_array = json_decode($job_data, true);
            $data_array['insured_name'] = $essential['name_of_insured'];
            $data_array['policyNumber'] = $essential['policyNumber'];

            $updated_json_data = json_encode($data_array);
            $is_update = $this->case_model->update_job_data($aid, $updated_json_data);
            if ($is_update) {
                $is_saved = $this->case_model->updateEssentialData(json_encode($essential), $aid);
                if ($is_saved) {
                    $response = array("status" => 200, 'message' => "Essential data created successful");
                    echo json_encode($response);
                } else {
                    $response = array("status" => 500, 'message' => "Internal server error");
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function updateMotorTheftCaseData()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->case_model->updateCaseData(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Essential data created successful");
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
     * MOTOR FINAL FORM (KAJAL)
     * ------------------------------------------------------------------------- */
    public function motorfinalilaform()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];
            $this->case_model->update_case_reference($aid, $case_reference);
            $job_data = $this->case_model->get_jobdata_case($aid);
            $data_array = json_decode($job_data, true);
            $data_array['insured_name'] = $essential['name_of_insured'];

            $updated_json_data = json_encode($data_array);
            $is_update = $this->case_model->update_job_data($aid, $updated_json_data);
            if ($is_update) {
                $is_saved = $this->case_model->updateEssentialData(json_encode($essential), $aid);
                if ($is_saved) {
                    $response = array("status" => 200, 'message' => "Essential data created successful");
                    echo json_encode($response);
                } else {
                    $response = array("status" => 500, 'message' => "Internal server error");
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function updateMotorFinalCaseData()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->case_model->updateCaseData(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Essential data created successful");
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
     * MOTOR SPOT FORM (KAJAL)
     * ------------------------------------------------------------------------- */

    public function motorspotilaform()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];
            $this->case_model->update_case_reference($aid, $case_reference);
            $job_data = $this->case_model->get_jobdata_case($aid);
            $data_array = json_decode($job_data, true);
            $data_array['insured_name'] = $essential['name_of_insured'];

            $updated_json_data = json_encode($data_array);
            $is_update = $this->case_model->update_job_data($aid, $updated_json_data);
            if ($is_update) {
                $is_saved = $this->case_model->updateEssentialData(json_encode($essential), $aid);
                if ($is_saved) {
                    $response = array("status" => 200, 'message' => "Essential data created successful");
                    echo json_encode($response);
                } else {
                    $response = array("status" => 500, 'message' => "Internal server error");
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }







    public function updateMotorSpotCaseData()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $is_saved = $this->case_model->updateCaseData(json_encode($essential), $aid);
            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Essential data created successful");
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
     *PROPERTY FORM (KAJAL)
     * ------------------------------------------------------------------------- */

    public function propertyilaform()
    {
        if ($this->session->userdata('id') != null) {
            $essential = $this->input->post();
            $aid = $essential['aid'];
            $case_reference = $essential['case_reference'];
            $this->case_model->update_case_reference($aid, $case_reference);
            $job_data = $this->case_model->get_jobdata_case($aid);
            $is_update = $this->case_model->update_job_data($aid, $updated_json_data);
            if ($is_update) {
                $is_saved = $this->case_model->updateEssentialData(json_encode($essential), $aid);
                if ($is_saved) {
                    $response = array("status" => 200, 'message' => "Essential data created successful");
                    echo json_encode($response);
                } else {
                    $response = array("status" => 500, 'message' => "Internal server error");
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }









    //CASE DATA FORM METHOD
    // public function submitCaseDataForm(){ 
    //     if($this->session->userdata('id') != null){
    //         $casedata = $this->input->post();
    //         $aid = $casedata['aid'];
    //         $updated_json_data = json_encode($data_array);
    //         $is_update = $this->case_model->update_job_data($aid, $updated_json_data);
    //         if($is_update){
    //         $is_saved = $this->case_model->updateCaseData(json_encode($casedata),$aid);
    //         if($is_saved){
    //             $response = array("status"=>200,'message'=>"Case data created successful");
    //             echo json_encode($response);
    //         }else{
    //             $response = array("status"=>500,'message'=>"Internal server error");
    //             echo json_encode($response);
    //         }
    //     }else{
    //             $response = array("status"=>500,'message'=>"Internal server error");
    //             echo json_encode($response);
    //         }
    //     }else{
    //         redirect('user_logout');
    //     }
    // }

    /**
     *  FOR GENERATE BILL PDF (BY KAJAL)
     */
    public function generate_bill($aid, $companyid)
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
            $companyName = $this->input->get('companyName');
            $essential_data = $this->case_model->getessentialdatabyAid($aid);
            $essentialData = $essential_data->essentialdata ? json_decode($essential_data->essentialdata, true) : null;
            // $essentialData = json_decode($essentialData->essentialdata, true);
            $jobdata = $this->case_model->getjobdatabyAid($aid);
            $invoicedata = $this->case_model->getinvoicetaxdata($aid);
            $additionaldata = $this->case_model->getadditionaldata($aid);
            $casedata = $this->case_model->getcasedatabyAid($aid);
            $caseData = $casedata ? json_decode($casedata, true) : null;
            $billingData = $this->case_model->getbillingdatabyAid($aid);
            $shippingData = $this->case_model->getshippingdatabyAid($aid);
            $amount = $this->case_model->gettotalamount($aid);
            $taxData = $this->case_model->getalltaxdata($aid);
            $currency = $this->case_model->conversiondata($aid);
            $natureofjob = $this->case_model->getnatureofjobbyAid($aid);
            $investigatortype = $this->case_model->getInvestigatorTypeByNatureOfJob($natureofjob);
            $userid = $this->session->userdata('id');
            // $companyid = $this->session->userdata('company_id');
            $companydata = $this->case_model->getUsersWithBankDepartmentAndCompany($userid, $companyid);
            $letterheadPath = $this->case_model->getLetterheadPathByCompanyId($companyid);

            $data = [
                'companyName' => $companyName,
                'essentialData' => $essentialData,
                'caseData' => $caseData,
                'jobData' => $jobdata ? json_decode($jobdata, true) : null,
                'billingData' => $billingData,
                'shippingData' => $shippingData,
                'amount' => $amount,
                'taxData' => $taxData,
                'invoicedata' => $invoicedata,
                'additionaldata' => $additionaldata,
                'aid' => $aid,
                'companyid' => $companyid,
                'natureofjob' => $natureofjob,
                'investigator_type' => $investigatortype,
                'companydata' => $companydata,
                'letterheadUrl' => $letterheadPath, // Passing the letterhead URL to the view
                'currency' => $currency // Passing the letterhead URL to the view
            ];



            // Load HTML content for the PDF
            try {
                $html = $this->load->view('adminpanel/accounts/billingpdf', $data, true);
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
                $pdfFilePath = './uploads/' . $aid . '/reports/bill_' . $aid . '.pdf';

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

    /**
     *  FOR GENERATE TAXINVOICE (BY KAJAL)
     */
    public function generate_taxinvoice($aid, $companyid)
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
            $invoicedata = $this->case_model->getinvoicetaxdata($aid);
            $additionaldata = $this->case_model->getadditionaldata($aid);
            $jobdata = $this->case_model->getjobdatabyAid($aid);
            $casedata = $this->case_model->getcasedatabyAid($aid);
            $caseData = $casedata ? json_decode($casedata, true) : null;
            $billingData = $this->case_model->getbillingdatabyAid($aid);
            $shippingData = $this->case_model->getshippingdatabyAid($aid);
            $amount = $this->case_model->gettotalamount($aid);
            $taxData = $this->case_model->getalltaxdata($aid);
            $userid = $this->session->userdata('id');
            $natureofjob = $this->case_model->getnatureofjobbyAid($aid);
            $investigatortype = $this->case_model->getInvestigatorTypeByNatureOfJob($natureofjob);
            $letterheadPath = $this->case_model->getLetterheadPathByCompanyId($companyid);
            $companydata = $this->case_model->getUsersWithBankDepartmentAndCompany($userid, $companyid);

            $currency = $this->case_model->conversiondata($aid);


            // Prepare data for the view
            $data = [
                'essentialData' => $essentialData,
                'jobData' => $jobdata ? json_decode($jobdata, true) : null,
                'caseData' => $caseData,
                'billingData' => $billingData,
                'shippingData' => $shippingData,
                'amount' => $amount,
                'taxData' => $taxData,
                'additionaldata' => $additionaldata,
                'investigator_type' => $investigatortype,
                'invoicedata' => $invoicedata,
                'aid' => $aid,
                'companydata' => $companydata,
                'companyid' => $companyid,
                'natureofjob' => $natureofjob,
                'investigator_type' => $investigatortype,
                'letterheadUrl' => $letterheadPath,
                'currency' => $currency // Passing the letterhead URL to the view
            ];



            // Load HTML content for the PDF
            try {
                $html = $this->load->view('adminpanel/accounts/taxinvoice', $data, true);
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
                $pdfFilePath = './uploads/' . $aid . '/reports/taxinvoice_' . $aid . '.pdf';

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

    // public function generate_RI($aid)
    // {
    //     // $aid = $this->input->post('aid');
    //     if (!$aid) {
    //         $response = array('error' => 'Missing aid parameter');
    //         $this->output
    //             ->set_content_type('application/json')
    //             ->set_output(json_encode($response));
    //         return;
    //     }
    //     // Generate QR Code
    //     $qrCode = new QrCode('https://claimsmitra.com/generateqrdata/' . $aid);
    //     $writer = new PngWriter();
    //     $qrCodeImage = $writer->write($qrCode)->getString();

    //     // Convert QR code to base64
    //     $qrCodeBase64 = base64_encode($qrCodeImage);

    //     // Load essential data
    //     $essentialdata = $this->case_model->getessentialdatabyAid($aid);
    //     $jobdata = json_decode($this->case_model->get_jobdata_case($aid));
    //     $natureofjob = $this->case_model->getnatureofjobbyAid($aid);
    //     $ilaImages = json_decode($this->case_model->getIlaImagesByAid($aid));
    //     $essentialData = isset($essentialdata) ? json_decode($essentialdata, true) : null;
    //     // Prepare data for the view
    //     $data['qrCodeBase64'] = $qrCodeBase64;
    //     $data['essentialData'] = $essentialData;
    //     $data['jobdata'] = $jobdata;
    //     $data['images'] = $ilaImages;
    //     // $data['aid'] = $aid;
    //     // print_r(json_encode($data));
    //     // exit;
    //     // Load HTML content with QR code
    //     if ($natureofjob == 63) {
    //         $html = $this->load->view('adminpanel/accounts/receivable', $data, true);
    //     } else {
    //         $html = $this->load->view('adminpanel/accounts/dispatch', $data, true);
    //     }


    //     // Generate PDF using Dompdf
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Send PDF to browser for inline display
    //     $output = $dompdf->output();
    //     $dompdf->stream("report.pdf", array("Attachment" => 0));
    //     // Terminate script execution
    //     exit;
    // }
    public function getQrData($aid)
    {
        $aid = $this->uri->segment(2);
        $data['caseimages'] = $this->case_model->getAllFiles($aid, "images");
        $data['casevideos'] = $this->case_model->getAllFiles($aid, "videos");
        $data['casedocuments'] = $this->case_model->getAllFiles($aid, "documents");
        $caseData = $this->case_model->getessentialdatabyAid($aid);

        $data['casedata'] = json_decode($caseData->essentialdata, true);

        // $data['data'] = json_decode($this->case_model->getcasedatabyAid($aid));
        $data['aid'] = $aid;
        $this->load->view('adminpanel/qrFile/custom', $data);
    }

    public function generateoutgoing_pdf($aid)
    {
        if ($this->session->userdata('id') !== null) { // Check session
            if (!$aid) {
                $response = ['error' => 'Missing aid parameter'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            // Generate QR Code
            try {
                $qrCode = new QrCode('https://claimsmitra.com/generateqrdata/' . $aid);
                $writer = new PngWriter();
                $qrCodeImage = $writer->write($qrCode)->getString();
                $qrCodeBase64 = base64_encode($qrCodeImage);
            } catch (Exception $e) {
                log_message('error', 'Error generating QR code: ' . $e->getMessage());
                show_error('Error generating QR code. Please try again later.', 500);
                return;
            }


            // Fetch essential and case data
            try {
                $essentialData = $this->case_model->getoutgoingessentialdatabyAid($aid);
                $essential_data = json_decode($essentialData->essentialdata, true);
                $case_data = json_decode($this->case_model->getoutgoingcasedatabyAid($aid), true);
                $reportImages = json_decode($this->case_model->getReportImagesByAid($aid));
                $letterheadPath = $this->case_model->getLetterheadPathByCompanyId($companyid);
                $companyname = $this->case_model->getcompanynamebycid($companyid);
                if (!is_array($essential_data) || !is_array($case_data)) {
                    throw new Exception('Invalid data format');
                }
            } catch (Exception $e) {
                log_message('error', 'Error fetching data from models: ' . $e->getMessage());
                show_error('Error fetching data. Please try again later.', 500);
                return;
            }

            $natureofjob = $this->case_model->getnatureofjobbyAid($aid);

            switch ($natureofjob) {
                case 64:
                    $view = 'adminpanel/jobs/locationbasedjob/cattle_report';
                    break;
                case 65:
                    $view = 'adminpanel/jobs/locationbasedjob/motor_final_report';
                    break;
                case 6:
                    $view = 'adminpanel/jobs/locationbasedjob/motorfinal_ila';
                    break;
                case 62:
                    $view = 'adminpanel/jobs/locationbasedjob/motor_spot_report';
                    break;
                case 12:
                    $view = 'adminpanel/jobs/locationbasedjob/ebdeath_report';
                    break;
                case 24:
                    $view = 'adminpanel/jobs/locationbasedjob/marine_predis_report';
                    break;
                default:
                    $view = 'adminpanel/jobs/locationbasedjob/default_report';
                    break;
            }

            // Prepare data for the view
            $report = [
                'qrCodeBase64' => $qrCodeBase64,
                'essentialData' => $essential_data,
                'caseData' => $case_data,
                'images' => $reportImages,
                'aid' => $aid,
                'companyid' => $companyid,
                'companyname' => $companyname,
                'letterheadUrl' => $letterheadPath,
                'username' => $essentialData->salutation . ' ' . $essentialData->firstname . ' ' . $essentialData->lastname
            ];
            // Load HTML content
            try {
                $html = $this->load->view($view, $report, true);
                if (!$html) {
                    throw new Exception('View did not return any content.');
                }
            } catch (Exception $e) {
                log_message('error', 'Error loading view: ' . $e->getMessage());
                show_error('Error loading view. Please try again later.', 500);
                return;
            }

            try {
                $dompdf = new Dompdf();
                $dompdf->set_option('isHtml5ParserEnabled', true);
                $dompdf->set_option('isPhpEnabled', true);
                $dompdf->set_option('isRemoteEnabled', true);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $canvas = $dompdf->getCanvas();

                $canvas->page_script(function ($pageNumber, $pageCount, $canvas) use ($aid, $companyname, $essential_data) {
                    $dompdf = $canvas->get_dompdf();
                    $fontMetrics = $dompdf->getFontMetrics();
                    $font = $fontMetrics->getFont("Helvetica", "normal");

                    // Define Common Line Properties
                    $lineStartX = 30;
                    $lineEndX = 570;
                    $lineThickness = 1.0; // Make it the same for header & footer

                    // HEADER SETTINGS
                    if ($pageNumber > 1) {
                        $caseReference = isset($essential_data['case_reference']) ? $essential_data['case_reference'] : 'N/A';

                        $headerX = 30; // Left margin of the header
                        $headerY = 15; // Top margin of the header
                        $headerWidth = 538; // Width of the header background
                        $headerHeight = 20; // Increased height to allow for padding

                        $paddingX = 10;  // Left padding inside the header
                        $paddingY = 5;  // Top padding inside the header
                        $paddingRight = 10; // Right padding inside the header

                        // Draw black header background
                        $canvas->filled_rectangle($headerX, $headerY, $headerWidth, $headerHeight, array(0, 0, 0));

                        // Adjust text position inside the header to add padding
                        $textY = $headerY + $paddingY; // Apply top padding
                        $textX = $headerX + $paddingX; // Apply left padding

                        // Adjust right-aligned text position (shift it left by paddingRight)
                        $rightTextX = ($headerX + $headerWidth) - $paddingRight - $fontMetrics->getTextWidth("Page $pageNumber of $pageCount", $font, 10);

                        // Draw white text with padding inside the black header
                        $canvas->text($textX, $textY, $caseReference, $font, 10, array(255, 255, 255));
                        $canvas->text($rightTextX, $textY, "Page $pageNumber of $pageCount", $font, 10, array(255, 255, 255));
                    }


                    // FOOTER SETTINGS
                    $footerY = 800;
                    $footerTextPadding = -7; // Space between text and underline
                    $footerUnderlineY = $footerY + $footerTextPadding;

                    // Underline for Footer (Same as Header)
                    $canvas->line($lineStartX, $footerUnderlineY, $lineEndX, $footerUnderlineY, array(0, 0, 0), $lineThickness);

                    // Footer text
                    $canvas->text(30, $footerY, $aid, $font, 10);
                    $companyText = isset($companyname['companyName']) ? $companyname['companyName'] : 'N/A';
                    $fontSize = (strlen($companyText) > 30) ? 10 : 12;
                    $textWidth = $fontMetrics->getTextWidth($companyText, $font, $fontSize);
                    $companyX = max(400, 570 - $textWidth);
                    $canvas->text($companyX, $footerY, $companyText, $font, $fontSize);
                });

                // Save PDF to file
                $pdfFilePath = './uploads/' . $aid . '/reports/report_' . $aid . '.pdf';
                if (!is_dir(dirname($pdfFilePath))) {
                    mkdir(dirname($pdfFilePath), 0777, true);
                }

                if (file_put_contents($pdfFilePath, $dompdf->output()) === false) {
                    throw new Exception('Failed to write PDF to file.');
                }

                // Stream PDF to browser
                $dompdf->stream("report_$aid.pdf", ["Attachment" => 0]);
            } catch (Exception $e) {
                log_message('error', 'Error generating PDF: ' . $e->getMessage());
                show_error('Error generating PDF. Please try again later.', 500);
            }
            exit;
        } else {
            redirect('user_logout');
        }
    }

    public function generate_pdf($aid, $companyid)
    {
        if ($this->session->userdata('id') !== null) { // Check session
            if (!$aid) {
                $response = ['error' => 'Missing aid parameter'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            // Generate QR Code
            try {
                $qrCode = new QrCode('https://claimsmitra.com/generateqrdata/' . $aid);
                $writer = new PngWriter();
                $qrCodeImage = $writer->write($qrCode)->getString();
                $qrCodeBase64 = base64_encode($qrCodeImage);
            } catch (Exception $e) {
                log_message('error', 'Error generating QR code: ' . $e->getMessage());
                show_error('Error generating QR code. Please try again later.', 500);
                return;
            }


            // Fetch essential and case data
            try {
                $essentialData = $this->case_model->getessentialdatabyAid($aid);
                $essential_data = json_decode($essentialData->essentialdata, true);
                $case_data = json_decode($this->case_model->getcasedatabyAid($aid), true);
                $reportImages = json_decode($this->case_model->getReportImagesByAid($aid));
                $letterheadPath = $this->case_model->getLetterheadPathByCompanyId($companyid);
                $companyname = $this->case_model->getcompanynamebycid($companyid);
                if (!is_array($essential_data) || !is_array($case_data)) {
                    throw new Exception('Invalid data format');
                }
            } catch (Exception $e) {
                log_message('error', 'Error fetching data from models: ' . $e->getMessage());
                show_error('Error fetching data. Please try again later.', 500);
                return;
            }

            $natureofjob = $this->case_model->getnatureofjobbyAid($aid);

            switch ($natureofjob) {
                case 64:
                    $view = 'adminpanel/jobs/locationbasedjob/cattle_report';
                    break;
                case 65:
                    $view = 'adminpanel/jobs/locationbasedjob/motor_final_report';
                    break;
                case 6:
                    $view = 'adminpanel/jobs/locationbasedjob/motorfinal_ila';
                    break;
                case 62:
                    $view = 'adminpanel/jobs/locationbasedjob/motor_spot_report';
                    break;
                case 12:
                    $view = 'adminpanel/jobs/locationbasedjob/ebdeath_report';
                    break;
                case 24:
                    $view = 'adminpanel/jobs/locationbasedjob/marine_predis_report';
                    break;
                default:
                    $view = 'adminpanel/jobs/locationbasedjob/default_report';
                    break;
            }

            // Prepare data for the view
            $report = [
                'qrCodeBase64' => $qrCodeBase64,
                'essentialData' => $essential_data,
                'caseData' => $case_data,
                'images' => $reportImages,
                'aid' => $aid,
                'companyid' => $companyid,
                'companyname' => $companyname,
                'letterheadUrl' => $letterheadPath,
                'username' => $essentialData->salutation . ' ' . $essentialData->firstname . ' ' . $essentialData->lastname
            ];
            // Load HTML content
            try {
                $html = $this->load->view($view, $report, true);
                if (!$html) {
                    throw new Exception('View did not return any content.');
                }
            } catch (Exception $e) {
                log_message('error', 'Error loading view: ' . $e->getMessage());
                show_error('Error loading view. Please try again later.', 500);
                return;
            }

            try {
                $dompdf = new Dompdf();
                $dompdf->set_option('isHtml5ParserEnabled', true);
                $dompdf->set_option('isPhpEnabled', true);
                $dompdf->set_option('isRemoteEnabled', true);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $canvas = $dompdf->getCanvas();

                $canvas->page_script(function ($pageNumber, $pageCount, $canvas) use ($aid, $companyname, $essential_data) {
                    $dompdf = $canvas->get_dompdf();
                    $fontMetrics = $dompdf->getFontMetrics();
                    $font = $fontMetrics->getFont("Helvetica", "normal");

                    // Define Common Line Properties
                    $lineStartX = 30;
                    $lineEndX = 570;
                    $lineThickness = 1.0; // Make it the same for header & footer

                    // HEADER SETTINGS
                    if ($pageNumber > 1) {
                        $caseReference = isset($essential_data['case_reference']) ? $essential_data['case_reference'] : 'N/A';

                        $headerX = 30; // Left margin of the header
                        $headerY = 15; // Top margin of the header
                        $headerWidth = 538; // Width of the header background
                        $headerHeight = 20; // Increased height to allow for padding

                        $paddingX = 10;  // Left padding inside the header
                        $paddingY = 5;  // Top padding inside the header
                        $paddingRight = 10; // Right padding inside the header

                        // Draw black header background
                        $canvas->filled_rectangle($headerX, $headerY, $headerWidth, $headerHeight, array(0, 0, 0));

                        // Adjust text position inside the header to add padding
                        $textY = $headerY + $paddingY; // Apply top padding
                        $textX = $headerX + $paddingX; // Apply left padding

                        // Adjust right-aligned text position (shift it left by paddingRight)
                        $rightTextX = ($headerX + $headerWidth) - $paddingRight - $fontMetrics->getTextWidth("Page $pageNumber of $pageCount", $font, 10);

                        // Draw white text with padding inside the black header
                        $canvas->text($textX, $textY, $caseReference, $font, 10, array(255, 255, 255));
                        $canvas->text($rightTextX, $textY, "Page $pageNumber of $pageCount", $font, 10, array(255, 255, 255));
                    }


                    // FOOTER SETTINGS
                    $footerY = 800;
                    $footerTextPadding = -7; // Space between text and underline
                    $footerUnderlineY = $footerY + $footerTextPadding;

                    // Underline for Footer (Same as Header)
                    $canvas->line($lineStartX, $footerUnderlineY, $lineEndX, $footerUnderlineY, array(0, 0, 0), $lineThickness);

                    // Footer text
                    $canvas->text(30, $footerY, $aid, $font, 10);
                    $companyText = isset($companyname['companyName']) ? $companyname['companyName'] : 'N/A';
                    $fontSize = (strlen($companyText) > 30) ? 10 : 12;
                    $textWidth = $fontMetrics->getTextWidth($companyText, $font, $fontSize);
                    $companyX = max(400, 570 - $textWidth);
                    $canvas->text($companyX, $footerY, $companyText, $font, $fontSize);
                });

                // Save PDF to file
                $pdfFilePath = './uploads/' . $aid . '/reports/report_' . $aid . '.pdf';
                if (!is_dir(dirname($pdfFilePath))) {
                    mkdir(dirname($pdfFilePath), 0777, true);
                }

                if (file_put_contents($pdfFilePath, $dompdf->output()) === false) {
                    throw new Exception('Failed to write PDF to file.');
                }

                // Stream PDF to browser
                $dompdf->stream("report_$aid.pdf", ["Attachment" => 0]);
            } catch (Exception $e) {
                log_message('error', 'Error generating PDF: ' . $e->getMessage());
                show_error('Error generating PDF. Please try again later.', 500);
            }
            exit;
        } else {
            redirect('user_logout');
        }
    }

    public function generatereport_pdf($aid, $companyid)
    {
        if ($this->session->userdata('id') !== null) { // Check session
            if (!$aid) {
                $response = ['error' => 'Missing aid parameter'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            // Generate QR Code
            try {
                $qrCode = new QrCode('https://claimsmitra.com/generateqrdata/' . $aid);
                $writer = new PngWriter();
                $qrCodeImage = $writer->write($qrCode)->getString();
                $qrCodeBase64 = base64_encode($qrCodeImage);
            } catch (Exception $e) {
                log_message('error', 'Error generating QR code: ' . $e->getMessage());
                show_error('Error generating QR code. Please try again later.', 500);
                return;
            }

            // Fetch essential and case data
            try {

                $essentialData = json_decode($this->case_model->getcasedatabyAid($aid), true);
                $case_data = json_decode($this->case_model->getessentialdatabyAid($aid), true);
                $reportImages = json_decode($this->case_model->getReportImagesByAid($aid));

                if (!is_array($case_data)) {
                    throw new Exception('Invalid data format');
                }
            } catch (Exception $e) {
                log_message('error', 'Error fetching data from models: ' . $e->getMessage());
                show_error('Error fetching data. Please try again later.', 500);
                return;
            }

            $natureofjob = $this->case_model->getnatureofjobbyAid($aid);

            switch ($natureofjob) {
                case 64:
                    $view = 'adminpanel/jobs/locationbasedjob/cattle_report';
                    break;
                case 62:
                    $view = 'adminpanel/jobs/locationbasedjob/motor_spot_report';
                    break;
                default:
                    $view = 'adminpanel/jobs/locationbasedjob/default_report';
                    break;
            }

            // Prepare data for the view
            $report = [
                'qrCodeBase64' => $qrCodeBase64,
                'essentialData' => $essentialData,
                'caseData' => $case_data,
                'images' => $reportImages,
                'aid' => $aid,
                'companyid' => $companyid,
                'username' => $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname')
            ];

            // Load HTML content
            try {
                $html = $this->load->view($view, $report, true);
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

                // Prepare to save PDF to a file
                $pdfFilePath = './uploads/' . $aid . '/reports/report_' . $aid . '.pdf';

                // Ensure the directory exists
                if (!is_dir(dirname($pdfFilePath))) {
                    mkdir(dirname($pdfFilePath), 0777, true); // Create directory if it doesn't exist
                }

                // Attempt to save the PDF file
                if (file_put_contents($pdfFilePath, $dompdf->output()) === false) {
                    throw new Exception('Failed to write PDF to file.');
                }

                // Optionally, stream PDF to browser for inline display
                $dompdf->stream("report_$aid.pdf", ["Attachment" => 0]);
            } catch (Exception $e) {
                log_message('error', 'Error generating PDF: ' . $e->getMessage());
                show_error('Error generating PDF. Please try again later.', 500);
            }

            exit;
        } else {
            redirect('user_logout');
        }
    }

    /* ------------------------------------------------------------------------- *  
      *Generate ILA (KAJAL)
      * ------------------------------------------------------------------------- */
    public function generate_ila($aid, $companyid)
    {
        if ($this->session->userdata('id') !== null) {
            if (!$aid) {
                $response = ['error' => 'Missing aid parameter'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            // Generate QR Code
            try {
                $qrCode = new QrCode('https://claimsmitra.com/generateqrdata/' . $aid);
                $writer = new PngWriter();
                $qrCodeImage = $writer->write($qrCode)->getString();
                $qrCodeBase64 = base64_encode($qrCodeImage);
            } catch (Exception $e) {
                log_message('error', 'Error generating QR code: ' . $e->getMessage());
                show_error('Error generating QR code. Please try again later.', 500);
                return;
            }

            $jobdata = json_decode($this->case_model->get_jobdata_case($aid));
            $natureofjob = $this->case_model->getnatureofjobbyAid($aid);
            $ilaImages = json_decode($this->case_model->getIlaImagesByAid($aid));
            $companyname = $this->case_model->getcompanynamebycid($companyid);
            $letterheadPath = $this->case_model->getLetterheadPathByCompanyId($companyid);
            $essential_data = $this->case_model->getessentialdatabyAid($aid);
            $essentialData = json_decode($essential_data->essentialdata, true);


            // Prepare data for the view
            $data = [
                'qrCodeBase64' => $qrCodeBase64,
                'essentialData' => $essentialData,
                'jobdata' => $jobdata,
                'images' => $ilaImages,
                'companyid' => $companyid,
                'companyname' => $companyname,
                'letterheadUrl' => $letterheadPath,
                'aid' => $aid,
                'username' => $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname')
            ];

            // Load the appropriate view based on nature of job
            $view = null;
            switch ($natureofjob) {
                case 65:
                    $view = 'adminpanel/jobs/locationbasedjob/motorfinal_ila';
                    break;
                case 1:
                    $view = 'adminpanel/jobs/locationbasedjob/motortheft_ila';
                    break;
                case 63:
                    $view = 'adminpanel/jobs/locationbasedjob/marinespotinspectionreport';
                    break;
                case 62:
                    $view = 'adminpanel/jobs/locationbasedjob/motor_spot_ila';
                    break;
                case 64:
                    $view = 'adminpanel/jobs/locationbasedjob/cattle_ila';
                    break;
                case 66:
                    $view = 'adminpanel/jobs/locationbasedjob/marinefinal_ila';
                    break;
                case 67:
                    $view = 'adminpanel/jobs/locationbasedjob/firefinal_ila';
                    break;
                case 70:
                    $view = 'adminpanel/jobs/locationbasedjob/miscellaneous_ila';
                    break;
                case 73:
                    $view = 'adminpanel/jobs/locationbasedjob/property_ila';
                    break;
                case 74:
                    $view = 'adminpanel/jobs/locationbasedjob/fire_inspectionila';
                    break;
                case 77:
                    $view = 'adminpanel/jobs/locationbasedjob/assets_valuation_ila';
                    break;
                case 12:
                    $view = 'adminpanel/jobs/locationbasedjob/ebdeath_ila';
                    break;
                case 24:
                    $view = 'adminpanel/jobs/locationbasedjob/marine_predispatch_ila';
                    break;
                case 78:
                    $view = 'adminpanel/jobs/locationbasedjob/risk_inspection_ila';
                    break;
                default:
                    $view = 'adminpanel/jobs/locationbasedjob/default_ila';
                    break;
            }



            // Load HTML content
            try {
                $html = trim($this->load->view($view, $data, true));
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
                $dompdf->set_option('isHtml5ParserEnabled', false);
                $dompdf->set_option('isPhpEnabled', true);
                $dompdf->set_option('isRemoteEnabled', true);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $canvas = $dompdf->getCanvas();

                $canvas->page_script(function ($pageNumber, $pageCount, $canvas) use ($aid, $companyname, $essentialData) {
                    $dompdf = $canvas->get_dompdf();
                    $fontMetrics = $dompdf->getFontMetrics();
                    $font = $fontMetrics->getFont("Helvetica", "normal");

                    // Define Common Line Properties
                    $lineStartX = 30;
                    $lineEndX = 570;
                    $lineThickness = 1.0; // Make it the same for header & footer

                    // HEADER SETTINGS
                    if ($pageNumber > 1) {
                        $caseReference = 'NOT SET';
                        if (is_array($essentialData)) {
                            $caseReference = isset($essentialData['case_reference']) ? $essentialData['case_reference'] : 'N/A';
                        }


                        $headerX = 30; // Left margin of the header
                        $headerY = 15; // Top margin of the header
                        $headerWidth = 538; // Width of the header background
                        $headerHeight = 20; // Increased height to allow for padding

                        $paddingX = 10;  // Left padding inside the header
                        $paddingY = 5;  // Top padding inside the header
                        $paddingRight = 10; // Right padding inside the header

                        // Draw black header background
                        $canvas->filled_rectangle($headerX, $headerY, $headerWidth, $headerHeight, array(0, 0, 0));

                        // Adjust text position inside the header to add padding
                        $textY = $headerY + $paddingY; // Apply top padding
                        $textX = $headerX + $paddingX; // Apply left padding

                        // Adjust right-aligned text position (shift it left by paddingRight)
                        $rightTextX = ($headerX + $headerWidth) - $paddingRight - $fontMetrics->getTextWidth("Page $pageNumber of $pageCount", $font, 10);

                        // Draw white text with padding inside the black header
                        $canvas->text($textX, $textY, $caseReference, $font, 10, array(255, 255, 255));
                        $canvas->text($rightTextX, $textY, "Page $pageNumber of $pageCount", $font, 10, array(255, 255, 255));
                    }


                    // FOOTER SETTINGS
                    $footerY = 812; // Move text up (30px from bottom)
                    $footerTextPadding = -7; // Space between text and underline
                    $footerUnderlineY = $footerY + $footerTextPadding;

                    // Underline for Footer (Same as Header)
                    $canvas->line($lineStartX, $footerUnderlineY, $lineEndX, $footerUnderlineY, array(0, 0, 0), $lineThickness);

                    // Footer text
                    $canvas->text(30, $footerY, $aid, $font, 10);

                    $companyText = isset($companyname['companyName']) ? $companyname['companyName'] : 'N/A';
                    $fontSize = (strlen($companyText) > 30) ? 10 : 12;
                    $textWidth = $fontMetrics->getTextWidth($companyText, $font, $fontSize);
                    $companyX = max(400, 570 - $textWidth);
                    $canvas->text($companyX, $footerY, $companyText, $font, $fontSize);
                });

                // Save PDF to file
                $pdfFilePath = './uploads/' . $aid . '/reports/ila_' . $aid . '.pdf';
                if (!is_dir(dirname($pdfFilePath))) {
                    mkdir(dirname($pdfFilePath), 0777, true);
                }

                if (file_put_contents($pdfFilePath, $dompdf->output()) === false) {
                    throw new Exception('Failed to write PDF to file.');
                }

                // Stream PDF to browser
                $dompdf->stream("report_$aid.pdf", ["Attachment" => 0]);
            } catch (Exception $e) {
                log_message('error', 'Error generating PDF: ' . $e->getMessage());
                show_error('Error generating PDF. Please try again later.', 500);
            }
            exit;
        } else {
            redirect('user_logout');
        }
    }


    /* ------------------------------------------------------------------------- *  
      *Generate Status (KAJAL)
      * ------------------------------------------------------------------------- */
    public function generate_status($aid)
    {
        if ($this->session->userdata('id') !== null) {
            if (!$aid) {
                $response = ['error' => 'Missing aid parameter'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            // Generate QR Code
            try {
                $qrCode = new QrCode('https://claimsmitra.com/generateqrdata/' . $aid);
                $writer = new PngWriter();
                $qrCodeImage = $writer->write($qrCode)->getString();
                $qrCodeBase64 = base64_encode($qrCodeImage);
            } catch (Exception $e) {
                log_message('error', 'Error generating QR code: ' . $e->getMessage());
                show_error('Error generating QR code. Please try again later.', 500);
                return;
            }

            // Load essential data
            try {
                $essentialdata = $this->case_model->getessentialdatabyAid($aid);
                $essentialData = json_decode($essentialdata->essentialdata, true);
                $jobdata = json_decode($this->case_model->get_jobdata_case($aid));
                $natureofjob = $this->case_model->getnatureofjobbyAid($aid);
                $ilaImages = json_decode($this->case_model->getIlaImagesByAid($aid));
            } catch (Exception $e) {
                log_message('error', 'Error loading essential data: ' . $e->getMessage());
                show_error('Error loading data. Please try again later.', 500);
                return;
            }

            // Prepare data for the view
            $data = [
                'qrCodeBase64' => $qrCodeBase64,
                'essentialData' => $essentialData,
                'jobdata' => $jobdata,
                'images' => $ilaImages,
                'aid' => $aid,
                'username' => $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname')
            ];

            // Load the appropriate view based on nature of job
            $view = null;
            switch ($natureofjob) {
                case 65:
                    $view = 'adminpanel/jobs/locationbasedjob/motorfinal_status';
                    break;
                case 62:
                    $view = 'adminpanel/jobs/locationbasedjob/motorspot_status';
                    break;
                default:
                    $view = 'adminpanel/jobs/locationbasedjob/default_status'; // Fallback view
                    break;
            }

            // Load HTML content
            try {
                $html = $this->load->view($view, $data, true);
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
                $pdfFilePath = './uploads/' . $aid . '/reports/status_' . $aid . '.pdf';

                // Ensure the directory exists
                if (!is_dir(dirname($pdfFilePath))) {
                    mkdir(dirname($pdfFilePath), 0777, true); // Create directory recursively
                }

                // Write the PDF to a file
                if (file_put_contents($pdfFilePath, $output) === false) {
                    throw new Exception('Failed to write PDF to file.');
                }

                // Stream PDF to browser
                $dompdf->stream("status_report_$aid.pdf", ["Attachment" => 0]);
            } catch (Exception $e) {
                log_message('error', 'Error generating PDF: ' . $e->getMessage());
                show_error('Error generating PDF. Please try again later.', 500);
            }
            exit;
        } else {
            redirect('user_logout');
        }
    }


    /* ------------------------------------------------------------------------- *  
      *Generate Checklist (KAJAL)
      * ------------------------------------------------------------------------- */


    public function generate_checklist($aid, $companyid)
    {
        // Validate $aid
        if (!$aid) {
            $response = array('error' => 'Missing aid parameter');
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Load essential data

        $essentialdata = $this->case_model->getessentialdatabyAid($aid);
        $essentialData = json_decode($essentialdata->essentialdata, true);

        $companyname = $this->case_model->getcompanynamebycid($companyid);
        $case_data = json_decode($this->case_model->getcasedatabyAid($aid), true);
        $jobdata = json_decode($this->case_model->get_jobdata_case($aid), true); // Ensuring it's an associative array
        $natureofjob = $this->case_model->getnatureofjobbyAid($aid);
        $ilaImages = json_decode($this->case_model->getIlaImagesByAid($aid), true); // Ensure proper JSON decoding


        // Prepare data array
        $data = [
            'essentialData' => $essentialData,
            'jobdata' => $jobdata,
            'caseData' => $case_data,
            'companyname' => $companyname,
            'companyid' => $companyid
        ];

        // Load the appropriate view
        $html = $this->load->view('adminpanel/jobs/locationbasedjob/cattle_checklist.php', $data, true);

        try {
            // Initialize Dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf = new Dompdf($options);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Save PDF
            $pdfDirectory = './uploads/' . $aid . '/reports/';
            $pdfFilePath = $pdfDirectory . 'checklist_' . $aid . '.pdf';

            if (!is_dir($pdfDirectory)) {
                mkdir($pdfDirectory, 0777, true);
            }

            file_put_contents($pdfFilePath, $dompdf->output());

            // Stream PDF
            $dompdf->stream("checklist_{$aid}.pdf", ["Attachment" => 0]);
        } catch (Exception $e) {
            echo 'Dompdf Error: ' . $e->getMessage();  // Debugging output
            exit;
        }
    }

    public function updateimages()
    {
        // Ensure user is authenticated
        if ($this->session->userdata('id') === null) {
            return $this->jsonResponse(401, 'User not authenticated.');
        }

        $data = $this->input->post();
        $title = $data['title'] ?? null;
        $aid = $data['aid'] ?? null;
        $selectedImages = $data['images'] ?? null;

        // Validate input data
        if (is_null($title) || is_null($aid) || is_null($selectedImages)) {
            return $this->jsonResponse(400, 'Invalid input data');
        }

        $selectedImagesJson = json_encode($selectedImages);

        try {
            // Handle the different titles
            switch ($title) {
                case "Photo ILA":
                    $this->update_images($selectedImagesJson, $aid, "ilaImages");
                    break;
                case "Report":
                    $this->update_images($selectedImagesJson, $aid, "reportImages");
                    break;
                case "Statement":
                    $this->update_images($selectedImagesJson, $aid, "statementImages");
                    break;
                case "Photo Sheet":
                    if ($this->createfolder($aid, "reports")) {
                        $this->createphotosheet($selectedImagesJson, $aid);
                    } else {
                        throw new Exception('Failed to create folder for photo sheet.');
                    }
                    break;
                default:
                    throw new Exception('Invalid title provided.');
            }

            return $this->jsonResponse(200, 'Images updated successfully.');
        } catch (Exception $e) {
            return $this->jsonResponse(500, $e->getMessage());
        }
    }

    public function update_images($selectedImages, $aid, $title)
    {
        // Update images in the database
        $update = $this->case_model->updateImages($selectedImages, $aid, $title);
        return $update
            ? $this->jsonResponse(200, "Images updated successfully")
            : $this->jsonResponse(500, "Internal server error");
    }

    private function jsonResponse($status, $message)
    {
        // Return JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => $status, 'message' => $message]));
    }

    public function createphotosheet($images, $aid)
    {
        // Get case reference and essential data
        $casereference = $this->case_model->getReferenceByAid($aid);
        $essentialData = $this->case_model->getessentialdatabyAid($aid);

        // Debugging log
        log_message('info', 'Essential Data Retrieved: ' . json_encode($essentialData));

        if (!$essentialData || empty($essentialData->essentialdata)) {
            log_message('error', 'Essential Data is missing for AID: ' . $aid);
            return $this->jsonResponse(400, 'Essential data is missing.');
        }

        $essentialdata = json_decode($essentialData->essentialdata, true);

        if (!$essentialdata) {
            log_message('error', 'Essential Data decoding failed for AID: ' . $aid);
            return $this->jsonResponse(400, 'Failed to decode essential data.');
        }

        // Ensure essential data has required fields
        $insured_name = $essentialdata['insured_name'] ?? 'N/A';
        $nameofowner = $essentialdata['nameofowner'] ?? 'N/A';
        $dateOfDeath = $essentialdata['dateOfDeath'] ?? 'N/A';

        // Prepare data for the view
        $data = [
            'images' => json_decode($images),
            'aid' => $aid,
            'reference' => $casereference,
            'insured_name' => $insured_name,
            'nameofowner' => $nameofowner,
            'datofdeath' => $dateOfDeath
        ];

        try {
            // Generate photo sheet HTML
            $html = $this->load->view('adminpanel/jobs/locationbasedjob/photo_sheet', $data, true);
            if (!$html) {
                throw new Exception('View did not return any content.');
            }

            // Generate the PDF
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Save the PDF to the server
            $pdfDir = "./uploads/{$aid}/reports/";
            $pdfFilePath = "{$pdfDir}photo_sheet{$aid}.pdf";

            // Ensure directory exists
            if (!is_dir($pdfDir)) {
                mkdir($pdfDir, 0777, true);
            }

            file_put_contents($pdfFilePath, $dompdf->output());

            // Stream the PDF to the browser
            $dompdf->stream("photo_sheet{$aid}.pdf", ["Attachment" => 0]);
            exit;
        } catch (Exception $e) {
            log_message('error', 'Error generating PDF: ' . $e->getMessage());
            return $this->jsonResponse(500, 'Error generating PDF. Please try again later.');
        }
    }

    public function createfolder($aid, $foldername)
    {
        $directory = './uploads/' . $aid . '/' . $foldername;
        if (!is_dir($directory) && !mkdir($directory, 0777, true)) {
            return false;
        }
        return true;
    }

    public function uploadimages()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            $filename = $_FILES['images']['name']; // Change 'file_name' to 'file'
            $filetype = $this->input->post('filetype');
            $aid = $this->input->post('aid');

            if (!is_dir('uploads/' . $aid . '/' . $filetype)) {
                mkdir('./uploads/' . $aid . '/' . $filetype, 0777, TRUE);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $files = $upload->multipleuploadFile('images', './uploads/' . $aid . '/' . $filetype);
                $response = array("status" => 200, 'message' => "Case data created successful", 'data' => $filename);
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function uploadvideos()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            $filename = $_FILES['videos']['name']; // Change 'file_name' to 'file'
            $filetype = $this->input->post('filetype');
            $aid = $this->input->post('aid');

            if (!is_dir('uploads/' . $aid . '/' . $filetype)) {
                mkdir('./uploads/' . $aid . '/' . $filetype, 0777, TRUE);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $files = $upload->multipleuploadFile('videos', './uploads/' . $aid . '/' . $filetype);
                $response = array("status" => 200, 'message' => "Case data created successful", 'data' => $filename);
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function uploaddocuments()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            $filename = $_FILES['documents']['name']; // Change 'file_name' to 'file'
            $filetype = $this->input->post('filetype');
            $aid = $this->input->post('aid');

            if (!is_dir('uploads/' . $aid . '/' . $filetype)) {
                mkdir('./uploads/' . $aid . '/' . $filetype, 0777, TRUE);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $files = $upload->multipleuploadFile('documents', './uploads/' . $aid . '/' . $filetype);
                $response = array("status" => 200, 'message' => "Case data created successful", 'data' => $filename);
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function sendEmail()
    {
        $from_email = "claimsmitra@gmail.com";
        $to_email = "arpitsingh791@gmail.com";

        //Load email library 
        $this->load->library('email');

        $this->email->from($from_email, 'Your Name');
        $this->email->to($to_email);
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        //Send mail 
        if ($this->email->send())
            $this->session->set_flashdata("email_sent", "Email sent successfully.");
        else
            $this->session->set_flashdata("email_sent", "Error in sending Email.");
        $this->load->view('email_form');
    }

    public function download_zip($aid)
    {
        $this->load->library('zip');
        // Specify the directory you want to zip
        $directory = './uploads/' . $aid;

        // Read the directory content
        $this->zip->read_dir($directory, FALSE);

        // Set the name of the zip file
        $zip_filename = $aid . 'zip';

        // Download the zip file
        $this->zip->download($zip_filename);
    }


    // public function getQuicksurvey()
    // {
    //     if ($this->session->userdata('id') != null) {
    //         if ($_POST) {
    //             $data = array();
    //             $jobData = $this->case_model->getQuickSurveyCases($_POST);
    //             $accepteduser = null;
    //             $i = $_POST['start'];
    //             foreach($jobData as $jobValue){
    //                 $insureddata = json_decode($jobValue->beneficiaryname);
    //                 $i++;
    //                 $case_status = null;
    //                 $address = null;
    //                 if($jobValue->status == 2){
    //                     $case_status = '<span class="label label-warning">Running</span>';
    //                     // $cancel = '<a href="#" class="dropdown-item">Cancel</a>';
    //                 }else if($jobValue->status == 1){
    //                     $case_status = '<span class="label label-info">Accepted</span>';
    //                 }else if($jobValue->status == 4){
    //                     $case_status = '<span class="label label-success">Completed</span>';
    //                 }
    //                 if($jobValue->userid != 0){
    //                     $assignTo = $this->home_model->getuserdatabyid($jobValue->userid);
    //                     $accepteduser  = nl2br($assignTo[0]['salutation']." ".$assignTo[0]['firstname']." ".$assignTo[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">'.$assignTo[0]['mobile'] .'</span>');
    //                 } else{
    //                     $accepteduser = '<span class="label label-warning">Waiting</span>';
    //                 }
    //                 $action = '<a href="'.base_url().'viewcasedetail/'.$jobValue->itemnumber.'" id="'.$jobValue->itemnumber.'" class="btn btn-outline-info">View Case</a>';
    //                 $totalimages = $this->case_model->countQuickFiles($jobValue->itemnumber,"images");
    //                 $totalvideos = $this->case_model->countQuickFiles($jobValue->itemnumber,"videos");
    //                 $totaldocuments = $this->case_model->countQuickFiles($jobValue->itemnumber,"documents");
    //                 if($jobValue->latitude != "" || $jobValue->longitude != ""){
    //                     $address = $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude);
    //                 }else{
    //                     $address = "Location Not Found";
    //                 }
    //                 $language = explode(',',$jobValue->beneficiaryname);
    //                 $media = '<div class="navbar--nav ml-auto">
    //                             <ul class="nav" style="flex-wrap:unset">
    //                                 <li class="nav-item">
    //                                     <a href="'.base_url().'locationoutgoingimages/'.$jobValue->itemnumber.'" class="nav-link"  style="padding-left:15px; padding-right:15px;">
    //                                         <i class="fa fa-images"></i>
    //                                         <span class="badge text-white bg-blue">'.$totalimages.'</span>
    //                                     </a>
    //                                 </li>
    //                                 <li class="nav-item">
    //                                     <a href="'.base_url().'locationoutgoingvideos/'.$jobValue->itemnumber.'" class="nav-link" style="padding-left:15px; padding-right:15px;">
    //                                         <i class="fa fa-video"></i>
    //                                         <span class="badge text-white bg-blue">'.$totalvideos.'</span>
    //                                     </a>
    //                                 </li>
    //                                 <li class="nav-item">
    //                                     <a href="'.base_url().'locationoutgoingdocuments/'.$jobValue->itemnumber.'" class="nav-link" style="padding-left:15px; padding-right:15px;">
    //                                         <i class="fa fa-file"></i>
    //                                         <span class="badge text-white bg-blue">'.$totaldocuments.'</span>
    //                                     </a>
    //                                 </li>
    //                             </ul>
    //                         </div>';
    //                 $created = date( 'Y/m/d H:i', strtotime($jobValue->createdat));
    //                 $data[] = array(nl2br($jobValue->itemnumber . "\n" . '<span style="color:#2bb3c0">'.$created.'</span>'),

    //                     $accepteduser, 
    //                     nl2br( 'Insured Name: <span style="color:#2bb3c0">'.$insureddata->contact_person_name.'</span>'. "\n" . 'Contact no: <span style="color:#2bb3c0">'.$insureddata->contact_person_mobile.'</span>'),
    //                     $address,
    //                     // $media,
    //                     $case_status,
    //                     $action);
    //             }
    //             $output = array(
    //                 "draw" => $_POST['draw'],
    //                 "recordsTotal" => $this->case_model->countAllquicksurvey(),
    //                 "recordsFiltered" => $this->case_model->countFilteredquicksurvey($_POST),
    //                 "data" => $data,
    //             );
    //             echo json_encode($output);
    //         } else {
    //             $data['view'] = "Quick Survey";
    //             $this->load->view("adminpanel/quicksurveyfile/index", $data);
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }





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
                $surveyData = $this->case_model->getQuickSurveyCases($userId);

                foreach ($surveyData as $surveyValue) {
                    // Define directory paths
                    $totalimages = $this->case_model->getquicksurveyAllFiles($surveyValue->directoryname, "images");
                    $totalvideos = $this->case_model->getquicksurveyAllFiles($surveyValue->directoryname, "videos");
                    $totaldocuments = $this->case_model->getquicksurveyAllFiles($surveyValue->directoryname, "documents");


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
                        <input class="btn case_btn movemediafiles" type="button" value="Submit" style="width: 20%; padding: 8px; background-color: #E16123; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    </div>'
                    );
                }

                // Prepare output for DataTables
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->case_model->countAllquicksurvey(),
                    "recordsFiltered" => $this->case_model->countFilteredquicksurvey($_POST),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                $data['view'] = "Quick Survey";
                $this->load->view("adminpanel/quicksurveyfile/index", $data);
            }
        } else {
            redirect('user_logout');
        }
    }



    public function viewquicksurveyimages($directoryname)
    {
        if ($directoryname != null) {
            // Fetch file names instead of just count
            $data['quicksurveyimages'] = $this->case_model->getquicksurveyAllFiles($directoryname, "images", true);

            if (empty($data['quicksurveyimages']) || !is_array($data['quicksurveyimages'])) {
                $data['quicksurveyimages'] = [];
            }

            $data['directoryname'] = $directoryname;
            $data['view'] = "Images";

            // Load the view
            $this->load->view('adminpanel/jobs/locationbasedjob/quicksurveyimg', $data);
        }
    }



    public function uploadquicksurveyimages()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            $filetype = $this->input->post('filetype');
            $directoryname = $this->input->post('directoryname');

            // Create directory if it doesn't exist
            if (!is_dir('quicksurvey/' . $directoryname . '/' . $filetype)) {
                mkdir('./quicksurvey/' . $directoryname . '/' . $filetype, 0777, TRUE);
            }

            // Upload files
            if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
                $files = $upload->multipleuploadFile('images', './quicksurvey/' . $directoryname . '/' . $filetype);
                $response = $files ?
                    array("status" => 200, 'message' => "Files uploaded successfully") :
                    array("status" => 500, 'message' => 'File upload failed.');
            } else {
                $response = array("status" => 400, 'message' => 'No files uploaded.');
            }

            echo json_encode($response);
        } else {
            echo json_encode(array("status" => 401, 'message' => 'User not authenticated.'));
        }
    }


    public function viewquicksurveyvideos($directoryname)
    {
        if ($directoryname != null) {
            // Get the quick survey videos
            $data['quicksurveyvideos'] = $this->case_model->getquicksurveyAllFiles($directoryname, "videos", true);

            // Check the output of the method
            log_message('debug', 'Files returned: ' . print_r($data['quicksurveyvideos'], true));

            // Check if it's an array
            if (!is_array($data['quicksurveyvideos'])) {
                log_message('error', 'Expected an array for videos, but got: ' . gettype($data['quicksurveyvideos']));
                $data['quicksurveyvideos'] = []; // Ensure it's always an array
            }

            $data['directoryname'] = $directoryname;
            $data['view'] = "Videos";
            $this->load->view('adminpanel/jobs/locationbasedjob/quicksurveyvideos', $data);
        }
    }




    public function uploadquicksurveyvideos()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            $filetype = $this->input->post('filetype');
            $directoryname = $this->input->post('directoryname');

            // Create directory if it doesn't exist
            if (!is_dir('quicksurvey/' . $directoryname . '/' . $filetype)) {
                mkdir('./quicksurvey/' . $directoryname . '/' . $filetype, 0777, TRUE);
            }

            // Upload files
            if (isset($_FILES['videos']) && count($_FILES['videos']['name']) > 0) {
                $files = $upload->multipleuploadFile('videos', './quicksurvey/' . $directoryname . '/' . $filetype);
                $response = $files ?
                    array("status" => 200, 'message' => "Video(s) uploaded successfully") :
                    array("status" => 500, 'message' => 'Video upload failed.');
            } else {
                $response = array("status" => 400, 'message' => 'No videos uploaded.');
            }

            echo json_encode($response);
        } else {
            echo json_encode(array("status" => 401, 'message' => 'User not authenticated.'));
        }
    }


    public function viewquicksurveydocs($directoryname)
    {
        if ($directoryname != null) {
            // Ensure that the function returns files, not just the count
            $data['quicksurveydocs'] = $this->case_model->getquicksurveyAllFiles($directoryname, "documents", true); // Pass true for $returnFiles to get the actual files array

            // Check if the returned value is an array
            if (!is_array($data['quicksurveydocs'])) {
                log_message('error', 'Expected an array for documents, but got: ' . gettype($data['quicksurveydocs']));
                $data['quicksurveydocs'] = []; // Ensure it's always an array
            }

            $data['directoryname'] = $directoryname;
            $data['view'] = "Documents";
            $this->load->view('adminpanel/jobs/locationbasedjob/quicksurveydocs', $data);
        }
    }


    public function uploadquicksurveydocuments()
    {
        if ($this->session->userdata('id') != null) {
            $upload = new UPLOAD();
            $filetype = $this->input->post('filetype');
            $directoryname = $this->input->post('directoryname');

            // Create directory if it doesn't exist
            if (!is_dir('quicksurvey/' . $directoryname . '/' . $filetype)) {
                mkdir('./quicksurvey/' . $directoryname . '/' . $filetype, 0777, TRUE);
            }

            // Upload files
            if (isset($_FILES['documents']) && count($_FILES['documents']['name']) > 0) {
                $files = $upload->multipleuploadFile('documents', './quicksurvey/' . $directoryname . '/' . $filetype);
                $response = $files ?
                    array("status" => 200, 'message' => "Document(s) uploaded successfully") :
                    array("status" => 500, 'message' => 'Document upload failed.');
            } else {
                $response = array("status" => 400, 'message' => 'No documents uploaded.');
            }

            echo json_encode($response);
        } else {
            echo json_encode(array("status" => 401, 'message' => 'User not authenticated.'));
        }
    }


    public function moveMediaFiles()
    {
        $aid = $this->input->post('aid');
        $itemnumber = $this->input->post('itemnumber');
        $directoryname = $this->input->post('directoryname');

        if ($aid && $directoryname) {
            // Define source directories
            $sourceImageDir = FCPATH . 'quicksurvey/' . $directoryname . '/images';
            $sourceVideoDir = FCPATH . 'quicksurvey/' . $directoryname . '/videos';
            $sourceDocumentDir = FCPATH . 'quicksurvey/' . $directoryname . '/documents';

            // Define target directories
            $targetDir = FCPATH . 'uploads/' . $aid;
            $targetImageDir = $targetDir . '/images';
            $targetVideoDir = $targetDir . '/videos';
            $targetDocumentDir = $targetDir . '/documents';

            // Create target directories if they don't exist
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            if (!is_dir($targetImageDir)) mkdir($targetImageDir, 0777, true);
            if (!is_dir($targetVideoDir)) mkdir($targetVideoDir, 0777, true);
            if (!is_dir($targetDocumentDir)) mkdir($targetDocumentDir, 0777, true);

            // Move files
            $this->moveFiles($sourceImageDir, $targetImageDir);
            $this->moveFiles($sourceVideoDir, $targetVideoDir);
            $this->moveFiles($sourceDocumentDir, $targetDocumentDir);

            echo json_encode(['status' => 'success', 'message' => 'Files moved successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
        }
    }

    private function moveFiles($sourceDir, $targetDir)
    {
        if (is_dir($sourceDir)) {
            $files = glob($sourceDir . '/*');
            foreach ($files as $file) {
                $fileName = basename($file);
                rename($file, $targetDir . DIRECTORY_SEPARATOR . $fileName);
            }
        }
    }

    public function viewlivelocationcasedetail()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
            $data['reportdata'] = json_decode($this->case_model->getcasedatabyAid($aid));
            $data['essentialdata'] = json_decode($this->case_model->getessentialdatabyAid($aid));
            $data['jobdata'] = json_decode($this->case_model->getjobdatabyAid($aid));
            $data['natureofjob'] = json_decode($this->case_model->getnatureofjobbyAid($aid));
            // $data['vendordata'] = json_decode($this->setting_model->getConnectedVendorById($postData));
            $data['caseimages'] = $this->case_model->getAllFiles($aid, "images");
            $data['casevideos'] = $this->case_model->getAllFiles($aid, "videos");
            $data['casedocuments'] = $this->case_model->getAllFiles($aid, "documents");
            $data['casereports'] = $this->case_model->getAllReports($aid, "reports");
            $data['aid'] = $aid;
            $data['view'] = "Case Data";
            $this->load->view('adminpanel/jobs/locationbasedjob/viewcasedetail', $data);
        }
    }

    // public function livelocationbilling()
    // {
    //     $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
    //     if ($aid != null) {
    //         $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
    //         $data['aid'] = $aid;
    //         $data['view'] = "Billing";
    //         $this->load->view('adminpanel/accounts/billing', $data);
    //     }
    // }

    public function livelocationdispatch()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
            $data['aid'] = $aid;
            $data['view'] = "Dispatch";
            $this->load->view('adminpanel/accounts/dispatch', $data);
        }
    }





    public function saveDispatchData()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Extract POST data
            $aid = $this->input->post('aid');
            $dispatchmode = $this->input->post('dispatchmode');
            $tracking_no = $this->input->post('tracking_no');
            $description = $this->input->post('description');
            $dispatchdate = $this->input->post('dispatchdate');
            $dispatch_to = $this->input->post('dispatch_to');

            if (empty($dispatch_to)) {
                $response = array(
                    'success' => false,
                    'message' => 'Dispatch to (paying office or other concerned office) is required'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(400)
                    ->set_output(json_encode($response));
                return;
            }

            $to_label = ($dispatch_to === 'other_office') ? 'Other concerned office' : 'Paying office';
            $description = '[To: ' . $to_label . '] ' . $description;

            // If Dispatch By Post is selected, tracknumber will be required
            if ($dispatchmode == '2' && empty($tracking_no)) {
                $response = array(
                    'success' => false,
                    'message' => 'Tracking number is required for Dispatch By Post'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(400)
                    ->set_output(json_encode($response));
                return;
            }
            // Fetch the 'uid_to' from claims_liveloaction_assign based on the 'aid'
            $this->load->model('Case_model');
            $uid_to = $this->Case_model->getUidToByAid($aid);

            if (!$uid_to) {
                $response = array(
                    'success' => false,
                    'message' => 'No user found for the provided aid'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode($response));
                return;
            }
            // Prepare data array
            $data = array(
                'userid' => $uid_to,
                'aid' => $aid,
                'dispatchmode' => $dispatchmode,
                'tracking_no' => $tracking_no,
                'description' => $description,
                'dispatchdate' => $dispatchdate,
                'status' => '1',
                'createdat' => date('Y-m-d H:i:s')
            );

            // Save data using model method
            $this->load->model('Case_model');
            $result = $this->Case_model->saveDispatchData($data);

            if ($result) {
                $response = array(
                    'success' => true,
                    'message' => 'Data saved successfully'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to save data'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode($response));
            }
        } else {
            // Handle invalid request
            $response = array(
                'success' => false,
                'message' => 'Invalid request method'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode($response));
        }
    }

    public function getLatestRecordByAid($aid)
    {
        $this->load->model('Case_model');
        $record = $this->Case_model->getLatestRecordByAid($aid);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($record));
    }

    public function saveSurveyFeeData()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Extract POST data
            $aid = $this->input->post('aid');
            $operation = $this->input->post('operation');
            $date = $this->input->post('date');
            $amount = $this->input->post('amount');
            $description = $this->input->post('description');

            // Prepare data array
            $data = array(
                'aid' => $aid,
                'operation' => $operation,
                'date' => $date,
                'amount' => $amount,
                'description' => $description,
                'status' => '1',
                'createdat' => date('Y-m-d H:i:s')
            );
            // Save data using model method
            $this->load->model('Case_model');
            $result = $this->Case_model->saveSurveyFeeData($data);

            if ($result) {
                $response = array(
                    'success' => true,
                    'message' => 'Data saved successfully'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to save data'
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode($response));
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'Invalid request method'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode($response));
        }
    }

    public function getSurveyFeeRecordByAid($aid)
    {
        $this->load->model('Case_model');
        $records = $this->Case_model->getSurveyFeeRecordByAid($aid);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($records));
    }

    public function deleteSurveyFee()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('id')) {
            $id = $this->input->post('id');
            $this->load->model('case_model');
            $success = $this->case_model->deletesurvey($id);
            if ($success) {
                echo json_encode(['status' => 200, 'message' => 'Record deleted successfully']);
            } else {
                echo json_encode(['status' => 500, 'message' => 'Failed to delete record']);
            }
        } else {
            echo json_encode(['status' => 400, 'message' => 'Invalid request']);
        }
    }

    public function livelocationsurveyfee()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
            $data['aid'] = $aid;
            $data['view'] = "Survey Fee";
            $this->load->view('adminpanel/accounts/surveyfee', $data);
        }
    }

    public function preparelor()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $status = $this->case_model->getSendlorStatus($aid);
            if ($status === '1') {
                $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
                $data['view'] = "View LOR";
                $data['aid'] = $aid;
                $this->load->view('adminpanel/accounts/viewlor', $data);
            }
            // elseif ($status === '0') {
            //     $questions = $this->case_model->getpreparelor($aid);
            //     $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
            //     $data['aid'] = $aid;
            //     $data['view'] = "Prepare LOR";
            //     $this->load->view('adminpanel/accounts/lor', $data);
            // } 
            else {
                $questions = $this->case_model->getpreparelor($aid);
                $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
                $data['aid'] = $aid;
                $data['view'] = "Prepare LOR";
                $this->load->view('adminpanel/accounts/lor', $data);
            }
        } else {
            show_error('Invalid or missing aid parameter.');
        }
    }

    public function viewlor()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
            $data['aid'] = $aid;
            $data['view'] = "View LOR";
            $this->load->view('adminpanel/accounts/viewlor', $data);
        }
    }

    public function fetchQuestions()
    {
        $departments = $this->input->get('department');
        if (!empty($departments)) {
            $results = $this->case_model->getpreparelor($departments);
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
        $aid = $this->input->post('aid');
        $uid = $this->input->post('uid');
        $questions_json = $this->input->post('questions_json');
        $question_ids = $this->input->post('question_ids');

        if ($aid && $uid && $questions_json) {
            $questions = json_decode($questions_json, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->load->model('case_model');
                $existingLOR = $this->case_model->getLorByAidUid($aid, $uid);
                if ($existingLOR) {
                    $existingLorJson = json_decode($existingLOR['lor'], true);
                    $newQuestions = json_decode($questions_json, true);
                    $updatedLorJson = array_merge($existingLorJson, $newQuestions);
                    $updatedLorJson = json_encode($updatedLorJson);
                    $updated = $this->case_model->updateLor($aid, $uid, $updatedLorJson);
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
                    $inserted = $this->case_model->insertLorQuestions($data);
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
    }

    public function addnewtitle()
    {
        $aid = $this->input->post('aid');
        $uid = $this->input->post('uid');
        $newQuestion = $this->input->post('newQuestion');
        $questions = json_decode($newQuestion, true);

        if ($this->case_model->appendQuestion($aid, $newQuestion)) {
            echo json_encode(['success' => true, 'message' => 'Questions updated successfully']);
        } else {
            log_message('error', 'Failed to append question for aid: ' . $aid);
            echo json_encode(['success' => false, 'error' => 'Failed to update the questions']);
        }
    }



    public function updatequestions()
    {
        $inputData = json_decode(file_get_contents('php://input'), true);
        $description = isset($inputData['description']) ? $inputData['description'] : null;
        $aid = isset($inputData['aid']) ? $inputData['aid'] : null;

        // Check and clean description
        if (is_array($description)) {
            $cleanedDescriptions = [];
            foreach ($description as $item) {
                // Ensure we are extracting only strings
                if (isset($item['description']) && is_string($item['description'])) {
                    $cleanedDescriptions[] = trim($item['description']);
                }
            }
            $description = $cleanedDescriptions;
        }
        if ($this->case_model->updateQuestion($aid, $description)) {
            echo json_encode(['status' => 'success', 'message' => 'Questions updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update the questions']);
        }
    }

    public function prepareila()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
            $data['aid'] = $aid;
            $data['view'] = "ILA";
            $this->load->view('adminpanel/accounts/ila', $data);
        }
    }

    public function preview()
    {
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
        if ($aid != null) {
            $this->load->view('adminpanel/accounts/preview');
        }
    }

    public function sendmail($recipients, $attachmentPath = null, $emailBody = '')
    {
        $config = $this->case_model->get_email_config();

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
            $sender_name = ($this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname')) ?? 'Adwiti Technocrats';
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

                    $this->email->subject('Adwiti');
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

    public function submit_viewlor()
    {
        $aid = $this->input->post('aid');
        $sent_to = json_decode($this->input->post('sent_to'), true);
        $special_note = $this->input->post('special_note');
        $date_of_letter = $this->input->post('date_of_letter');
        $automail_fix = json_decode($this->input->post('automail_fix'), true);
        $sent_date = $this->input->post('sent_date');
        $mail_automation = $this->input->post('mail_automation');
        $questions = json_decode($this->input->post('questions'), true);
        $email_body = $this->input->post('email_body');
        print_r($email_body);
        if ($aid && is_array($sent_to) && !empty($sent_to)) {
            $data = [
                'sent_to' => json_encode($sent_to),
                'special_note' => $special_note,
                'date_of_letter' => $date_of_letter,
                'automail_fix' => json_encode($automail_fix),
                'sent_date' => $sent_date,
                'mail_automation' => $mail_automation,
                'status' => 1,
            ];

            $this->load->model('case_model');

            // Update LOR data
            $updated = $this->case_model->updateLorQuestions($aid, $data);

            if ($updated) {
                $attachmentPath = $this->generate_new_pdf($questions, $special_note, $aid);

                // If the PDF was successfully generated, send the email
                if ($attachmentPath && file_exists($attachmentPath)) {
                    $this->sendmail($sent_to, $attachmentPath, $email_body); // Send questions as the body
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
    }


    public function fetchInsertedQuestions($aid)
    {
        $questions = $this->case_model->getInsertedQuestions($aid);
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
        $description = $this->input->post('description');

        if ($this->case_model->deleteQuestionByDescription($description)) {
            echo json_encode(['status' => 'success', 'message' => 'Question deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete the question']);
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

            $essentialdata = $this->case_model->getessentialdatabyAid($aid);
            $essentialData = $essentialdata ? json_decode($essentialdata, true) : null;

            $casedata = $this->case_model->getcasedatabyAid($aid);
            $caseData = $casedata ? json_decode($casedata, true) : null;

            $jobdata = $this->case_model->get_jobdata_case($aid);
            $jobData = $jobdata ? json_decode($jobdata, true) :  null;

            // Ensure the special note is not empty before appending
            if (!empty($special_note)) {
                $formattedSpecialNote = nl2br(htmlspecialchars($special_note));
                $emailBody .= "<br><strong>Special Note:</strong><br>" . $formattedSpecialNote . "<br>";
            }

            // Prepare the data to be passed to the view
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


    // get type of case
    public function getTypeofCase()
    {
        if ($this->session->userdata('id') != null) {
            $departmentid = $this->input->post('departmentid');
            if ($departmentid != null) {
                $caselist = $this->case_model->gettypeofcase($departmentid);
                $response = array("data" => $caselist);
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }



    public function getCaseForm()
    {
        if ($this->input->method() === 'post') {
            $natureofjob = $this->input->post('casevalue');

            if (empty($natureofjob)) {
                log_message('error', 'No case value provided');
                echo json_encode(['error' => 'No case value provided']);
                return;
            }

            // Fetch form details by ID
            $form = $this->case_model->getCaseFormByid($natureofjob);

            if ($form !== false) {
                log_message('debug', 'Form found: ' . print_r($form, true));

                echo json_encode([
                    'form' => $form->form,
                    'id' => $form->id
                ]);
            } else {
                log_message('error', 'Form not found for ID: ' . $natureofjob);
                echo json_encode(['error' => 'Form not found']);
            }
        } else {
            log_message('error', 'Invalid request method');
            echo json_encode(['error' => 'Invalid request method']);
        }
    }





    public function getCaseFormData()
    {
        $formname = $this->input->get('formname');
        $natureofjob = $this->input->get('id');

        log_message('debug', 'Formname: ' . $formname);
        log_message('debug', 'Natureofjob: ' . $natureofjob);
        $casetype = $this->case_model->getcasename($natureofjob);

        if (!$formname) {
            echo json_encode(['error' => 'Invalid form name']);
            return;
        }
        if (!$natureofjob) {
            echo json_encode(['error' => 'Invalid form type']);
            return;
        }

        $data['view'] = "Cattle Case";
        $data['formname'] = $formname;
        $data['natureofjob'] = $natureofjob;
        $data['casetype'] = $casetype;

        $this->load->view('adminpanel/jobs/createcaseform', $data);
    }



    // public function insertBillingData()
    // {
    //     if ($this->session->userdata('id') != null) {
    //         $item = $this->input->post();
    //         $aid = $item['aid'];

    //         // Prepare billing data for `claims_billing`
    //         $billingDetails = array(
    //             'item' => isset($item['item']) ? $item['item'] : null,
    //             'description' => isset($item['description']) ? $item['description'] : null,
    //             'uom' => isset($item['uom']) ? $item['uom'] : null,
    //             'rate' => isset($item['rate']) ? $item['rate'] : null,
    //             'qty' => isset($item['qty']) ? $item['qty'] : null,
    //             'amount' => isset($item['amount']) ? $item['amount'] : null,
    //             'subtotal' => isset($item['subtotal']) ? $item['subtotal'] : null,
    //             'total' => isset($item['total']) ? $item['total'] : null,
    //             'grandtotal' => isset($item['grandtotal']) ? $item['grandtotal'] : null,
    //             'payment_by' => isset($item['payment_by']) ? $item['payment_by'] : null,
    //             'payment_branch_name' => isset($item['payment_branch_name']) ? $item['payment_branch_name'] : null,
    //             'payment_user_name' => isset($item['payment_user_name']) ? $item['payment_user_name'] : null,
    //             'payment_mobile_num' => isset($item['payment_mobile_num']) ? $item['payment_mobile_num'] : null,
    //             'payment_gst' => isset($item['payment_gst']) ? $item['payment_gst'] : null,

    //         );

    //         // Encode the billing details array to JSON
    //         $billingDetailsJson = json_encode($billingDetails);

    //         // Insert the payment data into `claims_billing`
    //         $is_billing_insert = $this->case_model->insertBillingData($billingDetailsJson, $aid);

    //         if ($is_update && $is_billing_insert) {
    //             $response = array("status" => 200, 'message' => "Data updated successfully");
    //         } else {
    //             $response = array("status" => 500, 'message' => "Internal server error");
    //         }

    //         echo json_encode($response);
    //     } else {
    //         redirect('user_logout');
    //     }
    // }
}
