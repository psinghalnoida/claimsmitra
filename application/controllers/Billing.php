<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Billing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('assignment_model', 'assignment');
        $this->load->model('billing_model', 'billing');
        $this->load->model('company_model', 'company');
        $this->load->model('case_model');
        $this->load->model('home_model');
        $this->load->helper('upload_helper');
        $this->load->library('encryption');
        $this->load->helper('custom_helper');
        $this->load->model('setting_model');
    }
    public function fetchBillingDatabyaid($aid)
    {
        $billingData = $this->case_model->getbillingdatabyAid($aid);
        return $billingData;
    }

    public function fetchShippingDatabyaid($aid)
    {
        $shippingData = $this->case_model->getshippingdatabyAid($aid);
        return $shippingData;
    }

    public function addPayment(){

        $this->form_validation->set_rules("payment_mode", "Payment Mode", "required");
        $this->form_validation->set_rules("reference_number", "Reference Number", "required");
        $this->form_validation->set_rules("amount", "Amount", "required|numeric");
        $this->form_validation->set_rules("payment_date", "Payment Date", "required");

        if ($this->form_validation->run() == FALSE) {
            $errors = [
                "payment_mode"     => form_error("payment_mode"),
                "reference_number" => form_error("reference_number"),
                "amount"           => form_error("amount"),
                "payment_date"     => form_error("payment_date"),
            ];

            echo json_encode(["status" => "error", "errors" => $errors]);
            return;
        }

        $aid = $this->input->post("aid");
        $final_payment = $this->input->post("final_payment") ? 1 : 0;
        $tds_deduct = $this->input->post("tds_deduct") ? 1 : 0;

        $data = [
            "payment_mode"     => $this->input->post("payment_mode"),
            "reference_number" => $this->input->post("reference_number"),
            "amount"           => $this->input->post("amount"),
            "payment_date"     => $this->input->post("payment_date")
        ];
        if ($this->billing->update_payment_data($aid, $data, $final_payment, $tds_deduct)) {
            $payment_detail  = $this->billing->get_payment_data($aid);
            echo json_encode(["status" => "success", "message" => "Payment added successfully", "data" => $payment_detail]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update payment"]);
        }
    }

    // public function livelocationbilling()
    // {
    //     $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
    //     if (!$aid) {
    //         log_message('error', 'Invalid or missing aid.');
    //         show_404();
    //         return;
    //     }

    //     // Load models
    //     $this->load->model('setting_model');
    //     $this->load->model('case_model');

    //     $data['casereports'] = $this->case_model->getAllReports($aid, "reports");

    //     // Fetch primary data
    //     $data['reportdata'] = json_decode($this->case_model->getcasedatabyAid($aid));
    //     $data['casedata'] = json_decode($this->case_model->get_jobdata_case($aid));
    //     $data['essentialdata'] = json_decode($this->case_model->getessentialdatabyAid($aid));

    //     // Fetch billing data
    //     $billing_data = $this->case_model->getBillingByAid($aid);
    //     $data['getbillingdata'] = is_array($billing_data) ? $billing_data : json_decode($billing_data, true);

    //     // Prepare additional data for the view
    //     $data['detailedInfo'] = $this->setting_model->getDetailedInfo($aid);
    //     $data['aid'] = $aid;

    //     // Check if billing data exists and meets criteria
    //     $data['billingDataExists'] = null;
    //     if (!empty($billing_data)) {
    //         foreach ($billing_data as $row) {
    //             if (!empty($row['gst_number']) && !empty($row['gst_percentage']) && !empty($row['grand_total']) && !empty($row['invoice'])) {
    //                 $data['billingDataExists'] = $row; // Store the entire row
    //                 break; // Stop after finding the first match
    //             }
    //         }
    //     }


    //     if (is_array($billing_data)) {
    //         $data['paymentreceipt'] = isset($billing_data[0]['paymentreceipt']) ? json_decode($billing_data[0]['paymentreceipt'], true) : [];
    //     }

    //     if (is_array($billing_data)) {
    //         $data['additionalExpenses'] = isset($billing_data[0]['additional_expenses']) ? json_decode($billing_data[0]['additional_expenses'], true) : [];
    //     }


    //     // Handle bill_to and ship_to data, considering both array and JSON formats
    //     if (is_array($billing_data)) {
    //         $data['bill_to'] = isset($billing_data[0]['bill_to']) ? json_decode($billing_data[0]['bill_to'], true) : [];
    //         $data['ship_to'] = isset($billing_data[0]['ship_to']) ? json_decode($billing_data[0]['ship_to'], true) : [];
    //     } else {
    //         $billing_data_decoded = json_decode($billing_data, true);

    //         if (is_array($billing_data_decoded)) {
    //             $data['bill_to'] = isset($billing_data_decoded[0]['bill_to']) ? json_decode($billing_data_decoded[0]['bill_to'], true) : [];
    //             $data['ship_to'] = isset($billing_data_decoded[0]['ship_to']) ? json_decode($billing_data_decoded[0]['ship_to'], true) : [];
    //         } else {
    //             log_message('error', 'Billing data JSON decode failed: ' . json_last_error_msg());
    //             $data['bill_to'] = [];
    //             $data['ship_to'] = [];
    //         }
    //     }

    //     $data['view'] = "Billing";

    //     // Load the view with the prepared data
    //     $this->load->view('adminpanel/accounts/billing', $data);
    // }

    public function index()
    {
        if ($this->session->userdata('id') != null) {
            $bill = null;
            $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));
            $encryptedUrl = $this->encryption->decrypt(base64_decode($this->input->get('data')));
            if (!$aid) {
                log_message('error', 'Invalid or missing aid.');
                show_404();
                return;
            }
            $data['casereports'] = $this->assignment->getAllReports($aid, "reports");
            $data['reportdata'] = json_decode($this->assignment->getcasedatabyAid($aid));
            $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
            $data['essentialdata'] = json_decode($this->assignment->getessentialdatabyAid($aid));
            $billingData = $this->getBilling($aid);
            
            if ($billingData) {
                $bill = array(
                    'aid' => $billingData['aid'],
                    "ti_number" => $billingData['ti_number'],
                    "bill_to" => ($billingData['bill_to'] !== null) ? json_decode($billingData['bill_to'], true) : null,
                    "ship_to" => ($billingData['ship_to'] !== null) ? json_decode($billingData['ship_to'], true) : null,
                    "currency" => ($billingData['currency'] !== null) ? json_decode($billingData['currency'], true) : null,
                    "invoice" => ($billingData['invoice'] !== null) ? json_decode($billingData['invoice'], true) : null,
                    "branchid" => $billingData['branchid'],
                    "sub_total" => $billingData['sub_total'],
                    "tax" => ($billingData['tax'] !== null) ? json_decode($billingData['tax'], true) : null,
                    "total" => $billingData['total'],
                    "additional_expenses" => ($billingData['additional_expenses'] !== null) ? json_decode($billingData['additional_expenses'], true) : null,
                    "grandtotal" => $billingData['grandtotal'],
                    "paymentreceipt" => ($billingData['paymentreceipt'] !== null) ? json_decode($billingData['paymentreceipt'], true) : null,
                    "status" => $billingData['status'],
                    "ti_datetime" => $billingData['ti_datetime'],
                    "created_at" => $billingData['created_at']
                );
            } else {
                echo "No billing data found";
            }

            $data['billing_data'] = $bill;
            if ($aid != null && $encryptedUrl) {
                $data_array = json_decode($encryptedUrl, true);
                $defaultcompany = $data_array['defaultcompany'] ?? null;
                $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                $usertype = $data_array['usertype'] ?? null;

                $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
                $data['reportdata'] = json_decode($this->assignment->getcasedatabyAid($aid));
                $data['essentialdata'] = json_decode($this->assignment->getessentialdatabyAid($aid));
                $data['natureofjob'] = json_decode($this->assignment->getnatureofjobbyAid($aid));
                $data['gstDetail'] = $this->billing->getGstNumbersByCompanyId($defaultcompany);
                // $data['caseimages'] = $this->assignment->getAllFiles($aid, "images");
                // $data['casevideos'] = $this->assignment->getAllFiles($aid, "videos");
                $data['casedocuments'] = $this->assignment->getAllFiles($aid, "documents");
                $data['casereports'] = $this->assignment->getAllReports($aid, "reports");
                $data['aid'] = $aid;

                $data['defaultcompany'] = $defaultcompany;
                $data['defaultdepartment'] = $defaultdepartment;
                $data['usertype'] = $usertype;
                $data['companyName'] = $this->company->getCompanyName($defaultcompany);
                
                $data['departmentName'] = $this->company->getDepartmentName($defaultdepartment);
                $data['view'] = "Billing";
                $this->load->view('adminpanel/accounts/billing', $data);
            }
        } else {
            redirect('user_logout');
        }
    }

    private function getBilling($aid)
    {
        return $this->billing->getBillingByAid($aid);
    }

    // public function handleBillingData()
    // {
    //     if ($this->session->userdata('id') != null) {
    //         if ($this->input->method() === 'post') {

    //             // $postData = $this->input->post();
    //             $result = $this->insertBillingData($postData);
    //             echo json_encode(['status' => 'success', 'message' => 'Data inserted.']);
    //         } else {
    //             echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }

    // private function insertBillingData($postData)
    // {
    //     if ($this->session->userdata('id') != null) {
    //         $aid = $this->input->post('aid');
    //         $requiredFields = ['ship_to', 'bill_to', 'invoice', 'tax', 'additional_expenses', 'subtotal', 'total', 'grandtotal'];
    //         foreach ($requiredFields as $field) {
    //             if (!$this->input->post($field)) {
    //                 echo json_encode(['status' => 'error', 'message' => 'Missing field: ' . $field]);
    //                 return;
    //             }
    //         }

    //         // Get and decode JSON data
    //         $shippingdata = json_decode($this->input->post('ship_to'), true);
    //         $billingdata = json_decode($this->input->post('bill_to'), true);
    //         $invoice_data = json_decode($this->input->post('invoice'), true);
    //         $branchid = $this->input->post('branchid');
    //         $tax_data = json_decode($this->input->post('tax'), true);
    //         $additional_expenses = json_decode($this->input->post('additional_expenses'), true);

    //         // Validate JSON data
    //         if (json_last_error() !== JSON_ERROR_NONE) {
    //             echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data provided.']);
    //             return;
    //         }

    //         // Get subtotal, total, and grand total
    //         $subtotal = floatval($this->input->post('subtotal'));
    //         $total = floatval($this->input->post('total'));
    //         $grandtotal = floatval($this->input->post('grandtotal'));

    //         // Add index to invoice data
    //         if (empty($invoice_data)) {
    //             echo json_encode(['status' => 'error', 'message' => 'Invoice data is empty.']);
    //             return;
    //         }

    //         $indexed_invoice_data = [];
    //         foreach ($invoice_data as $index => $item) {
    //             $item['index'] = $index + 1;
    //             $indexed_invoice_data[] = $item;
    //         }

    //         // Prepare billing data array
    //         $billing_data = [
    //             'bill_to' => json_encode($billingdata),
    //             'ship_to' => json_encode($shippingdata),
    //             'invoice' => json_encode($indexed_invoice_data),
    //             'branchid' => $branchid,
    //             'sub_total' => $subtotal,
    //             'tax' => json_encode($tax_data),
    //             'total' => $total,
    //             'grandtotal' => $grandtotal,
    //             'additional_expenses' => json_encode($additional_expenses),
    //             'status' => 1
    //         ];

    //         // Check if the aid already exists
    //         $existingBilling = $this->billing->getBillingByAid($aid);

    //         if ($existingBilling) {
    //             // Update existing record
    //             if (!$this->billing->updateBilling($aid, $billing_data)) {
    //                 echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
    //             } else {
    //                 echo json_encode(['status' => 'success', 'message' => 'Billing data updated successfully.']);
    //             }
    //         } else {
    //             // Insert new record
    //             if (!$this->billing->insertBilling($aid, $billing_data)) {
    //                 echo json_encode(['status' => 'error', 'message' => 'Database insert failed.']);
    //             } else {
    //                 echo json_encode(['status' => 'success', 'message' => 'Billing data inserted successfully.']);
    //             }
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }

    public function insertBillingData()
    {
        $aid = $this->input->post('aid');

        // Process the request and handle validation, data preparation, and database operations
        $result = $this->handleBillingOperation($aid);

        // Return the result as a JSON response
        echo json_encode($result);
    }

    private function handleBillingOperation($aid)
    {
        // Validate required fields
        $requiredFields = ['ship_to', 'bill_to', 'invoice', 'tax', 'additional_expenses', 'subtotal', 'total', 'grandtotal'];
        foreach ($requiredFields as $field) {
            if (!$this->input->post($field)) {
                return ['status' => 'error', 'message' => 'Missing field: ' . $field];
            }
        }

        // Decode JSON data
        $shippingData = json_decode($this->input->post('ship_to'), true);
        $billingData = json_decode($this->input->post('bill_to'), true);
        $invoiceData = json_decode($this->input->post('invoice'), true);
        $taxData = json_decode($this->input->post('tax'), true);
        $additionalExpenses = json_decode($this->input->post('additional_expenses'), true);
        $currency = json_decode($this->input->post('currency'), true);
        $branchid = $this->input->post('branchid');

        // Validate JSON decoding
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['status' => 'error', 'message' => 'Invalid JSON data provided.'];
        }

        // Add index to invoice data
        if (empty($invoiceData)) {
            return ['status' => 'error', 'message' => 'Invoice data is empty.'];
        }
        foreach ($invoiceData as $index => &$item) {
            $item['index'] = $index + 1; // Add index starting from 1
        }

        $additionalExpenses = empty($additionalExpenses) ? null : json_encode($additionalExpenses);


        // Prepare billing data for insertion or update
        $billingDataArray = [
            'bill_to' => json_encode($billingData),
            'ship_to' => json_encode($shippingData),
            'invoice' => json_encode($invoiceData),
            'sub_total' => floatval($this->input->post('subtotal')),
            'tax' => json_encode($taxData),
            'total' => floatval($this->input->post('total')),
            'grandtotal' => floatval($this->input->post('grandtotal')),
            'additional_expenses' => $additionalExpenses,
            'currency' => json_encode($currency),

            'branchid' => $branchid
        ];

        

        // Log data for debugging
        log_message('debug', 'Billing Data for Insert/Update: ' . print_r($billingDataArray, true));

        // Check if the aid already exists
        $existingBilling = $this->case_model->getBillingByAid($aid);

       if ($existingBilling) {
            // Update existing record
            $updateResponse = $this->case_model->updateBilling($aid, $billingDataArray);

            if ($updateResponse['status'] === 'success') {
                return $updateResponse;
            } else {
                log_message('error', 'Database update failed for aid: ' . $aid);
                return $updateResponse;
            }
        } else {
            // Insert new record
            $insertResponse = $this->case_model->insertBilling($aid, $billingDataArray);

            if ($insertResponse['status'] === 'success') {
                return $insertResponse;
            } else {
                log_message('error', 'Database insert failed for billing data: ' . print_r($billingDataArray, true));
                return $insertResponse;
            }
        }

    }



    public function updatestatus()
    {
        $aid = $this->input->post('aid');
        if (empty($aid)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid aid']);
            return;
        }
        $result = $this->billing->update_status($aid);
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
        }
    }
    public function getBillingData(){
        if ($this->session->userdata('id') != null) {
            $bill = array();
            $aid = $this->input->post('aid');
            $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
            $data['essentialdata'] = json_decode($this->assignment->getessentialdatabyAid($aid));
            $essentialdata = isset($data['essentialdata']) ? $data['essentialdata'] : null;
            $billingData = $this->getBilling($aid);
            if ($billingData) {
                $bill = array(
                    'aid' => $billingData['aid'],
                    "ti_number" => $billingData['ti_number'],
                    "bill_to" => ($billingData['bill_to'] !== null) ? json_decode($billingData['bill_to'], true) : null,
                    "ship_to" => ($billingData['ship_to'] !== null) ? json_decode($billingData['ship_to'], true) : null,
                    "invoice" => ($billingData['invoice'] !== null) ? json_decode($billingData['invoice'], true) : null,
                    "branchid" => $billingData['branchid'],
                    "sub_total" => $billingData['sub_total'],
                    "tax" => ($billingData['tax'] !== null) ? json_decode($billingData['tax'], true) : null,
                    "currency" => ($billingData['currency'] !== null) ? json_decode($billingData['currency'], true) : null,
                    "total" => $billingData['total'],
                    "additional_expenses" => ($billingData['additional_expenses'] !== null) ? json_decode($billingData['additional_expenses'], true) : null,
                    "grandtotal" => $billingData['grandtotal'],
                    "paymentreceipt" => ($billingData['paymentreceipt'] !== null) ? json_decode($billingData['paymentreceipt'], true) : null,
                    "status" => $billingData['status'],
                    "ti_datetime" => $billingData['ti_datetime'],
                    "created_at" => $billingData['created_at']
                );
            } else {
                echo "No billing data found";
            }
            $data['billing_data'] = $bill;
            
            // print_r(json_encode($data));
            // exit;
            $response = array('status'=>200, 'message'=>'Billing data fetched', 'data'=> $data);
            echo json_encode($response);
           
        } else {
            redirect('user_logout');
        }
    }

    public function getTaxinvoice(){
        if ($this->session->userdata('id') != null) {
            $bill = array();
            $aid = $this->input->post('aid');
        
            $data['casedata'] = json_decode($this->assignment->get_jobdata_case($aid));
            $data['essentialdata'] = json_decode($this->assignment->getessentialdatabyAid($aid));
            $essentialdata = isset($data['essentialdata']) ? $data['essentialdata'] : null;
            $billingData = $this->getBilling($aid);
            
            if ($billingData) {
              $bill = array(
                    'aid' => $billingData['aid'],
                    'ti_number' => $billingData['ti_number'],
                    'bill_to' => is_string($billingData['bill_to']) ? json_decode($billingData['bill_to'], true) : null,
                    'ship_to' => is_string($billingData['ship_to']) ? json_decode($billingData['ship_to'], true) : null,
                    'invoice' => is_string($billingData['invoice']) ? json_decode($billingData['invoice'], true) : null,
                    'branchid' => $billingData['branchid'],
                    'sub_total' => $billingData['sub_total'],
                    'tax' => is_string($billingData['tax']) ? json_decode($billingData['tax'], true) : null,
                    'currency' => is_string($billingData['currency']) ? json_decode($billingData['currency'], true) : null,
                    'total' => $billingData['total'],
                    'additional_expenses' => is_string($billingData['additional_expenses']) ? json_decode($billingData['additional_expenses'], true) : null,
                    'grandtotal' => $billingData['grandtotal'],
                    'paymentreceipt' => is_string($billingData['paymentreceipt']) ? json_decode($billingData['paymentreceipt'], true) : null,
                    'status' => $billingData['status'],
                    'ti_datetime' => $billingData['ti_datetime'],
                    'created_at' => $billingData['created_at']
                );

            } else {
                echo "No billing data found";
            }
            $data['billing_data'] = $bill;
            $response = array('status'=>200, 'message'=>'Billing data fetched', 'data'=> $data);
            echo json_encode($response);
           
        } else {
            redirect('user_logout');
        }
    }
    
    
    public function fetchBillingData()
    {
        $aid = $this->input->post('aid');
        $billingData = $this->case_model->getBillingByAid($aid);
        // print_r(json_encode($billingData));
        // exit;
        if ($billingData) {
            $invoiceItems = [];

            // Iterate over fetched billing data
            foreach ($billingData as $data) {
                // Prepare billing-related variables
                $subtotal = $data['sub_total'] ?? '';
                $total = $data['total'] ?? '';
                $grandTotal = $data['grandtotal'] ?? '';
                $gstNumber = $data['gst_number'] ?? '';
                $gstPercentage = $data['gst_percentage'] ?? '';
                $igstPercentage = $data['igst_percentage'] ?? '';
                $cgstPercentage = $data['cgst_percentage'] ?? '';
                $sgstPercentage = $data['sgst_percentage'] ?? '';
                $calculatedgst = $data['calculatedgst'] ?? '';
                $brachid = $data['branchid'] ?? '';
                $currency = $data['currency'] ?? '';

                // Collect invoice items
                if (isset($data['invoice']) && is_array($data['invoice'])) {
                    foreach ($data['invoice'] as $invoiceItem) {
                        // Include bill_to and ship_to in each invoice item
                        $invoiceItems[] = [
                            'item' => $invoiceItem['item'] ?? '',
                            'description' => $invoiceItem['description'] ?? '',
                            'uom' => $invoiceItem['uom'] ?? '',
                            'rate' => $invoiceItem['rate'] ?? '',
                            'qty' => $invoiceItem['qty'] ?? '',
                            'amount' => $invoiceItem['amount'] ?? '',
                            'subtotal' => $subtotal,
                            'total' => $total,
                            'grand_total' => $grandTotal,
                            'gst_number' => $gstNumber,
                            'gst_percentage' => $gstPercentage,
                            'igst_percentage' => $igstPercentage,
                            'cgst_percentage' => $cgstPercentage,
                            'sgst_percentage' => $sgstPercentage,
                            'calculatedgst' => $calculatedgst,
                            'branchid' => $brachid,
                            'additional_expenses' => $data['additional_expenses'] ?? [],
                            'currency' => $data['currency'] ?? [],
                            'bill_to' => $data['bill_to'] ?? [],
                           
                            'ship_to' => $data['ship_to'] ?? []
                        ];
                    }
                }
            }

            // Combine all data into a structured response
            $response = [
                'status' => 'success',
                'billing_data' => $invoiceItems, // Invoice items with bill_to and ship_to
            ];

            // Log response for debugging
            log_message('debug', 'Billing Response Data: ' . print_r($response, true));

            // Return response as JSON
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No billing data found']);
        }
    }




    // public function updateBillingPayment()
    // {
    //     $aid = $this->input->post('aid'); // Aid is sent directly

    //     // Capture payment data from POST request
    //     $paymentData = [
    //         'payment_for' => $this->input->post('payment_for'),
    //         'amount' => $this->input->post('amount'),
    //         'date' => $this->input->post('date')
    //     ];

    //     // Ensure all required fields are provided
    //     if (empty($paymentData['payment_for']) || empty($paymentData['amount']) || empty($paymentData['date'])) {
    //         echo json_encode(['status' => 'error', 'message' => 'Received empty required fields']);
    //         return;
    //     }

    //     // Convert payment data to JSON
    //     $paymentReceiptJson = json_encode($paymentData);

    //     // Prepare the data array with JSON for paymentreceipt column
    //     $updateData = [
    //         'aid' => $aid,
    //         'paymentreceipt' => $paymentReceiptJson,
    //         'created_at' => date('Y-m-d H:i:s') // Optional timestamp for record keeping
    //     ];

    //     // Load model and update the record
    //     $this->load->model('case_model');
    //     if ($this->case_model->updatePaymentData($aid, $updateData)) {
    //         echo json_encode(['status' => 'success', 'message' => 'Payment data added successfully!']);
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Failed to add payment data.']);
    //     }
    // }


    public function updateBillingPayment()
    {
        if ($this->session->userdata('id') != null) {
            $aid = $this->input->post('aid');

            // Decode the JSON-encoded array of payments
            $paymentData = json_decode($this->input->post('paymentData'), true);

            // Ensure paymentData is valid
            if (is_array($paymentData)) {
                // Encode the payment data as JSON
                $paymentDataJson = json_encode($paymentData);

                // Pass the encoded payment data to the model for insertion
                if ($this->case_model->updatePaymentData($aid, $paymentDataJson)) {
                    echo json_encode(["status" => 200, 'message' => "Payment data updated successfully"]);
                } else {
                    echo json_encode(["status" => 500, 'message' => "Failed to update payment data"]);
                }
            } else {
                echo json_encode(["status" => 500, 'message' => "Invalid payment data"]);
            }
        } else {
            redirect('user_logout');
        }
    }


    public function fetchAmountData()
    {
        $aid = $this->input->post('aid');
        $this->load->model('case_model');

        // Fetch the payment data for the given aid
        $paymentData = $this->case_model->getPaymentData($aid);

        if (!empty($paymentData)) {
            // Return the decoded payment data as a successful response
            echo json_encode(['status' => 'success', 'data' => $paymentData]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No payment data found.']);
        }
    }


    /* ------------------------------------------------------------------------- *
    * GET TAX INVOICE REQUEST
    * ------------------------------------------------------------------------- */
    public function getTaxinvoiceRequest()
    {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $data = array();
                $cancel = null;
                $cid = $_POST['company'] ?? null;
                
                $billingData = $this->billing->fetchRequest($_POST);

                $accepteduser = null;
                $i = $_POST['start'];
                $billing_status = null;
                $viewCaseUrl = encryptUrl($_POST['company'], $_POST['department'], $_POST['user_role']);
                foreach ($billingData as $billing) {
                    $billingTo = json_decode($billing->bill_to);
                    $tax = json_decode($billing->tax);
                    $billing_to = 'Company Name: <span style="color:#0884c7;font-size:14px;font-weight: bold;">' . $billingTo->billing_payment_by . '</span>' . "\n" .
                   'Address: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billingTo->billing_branch_name . '</span>';

                    if (!empty($billingTo->billing_gst)) {
                        $billing_to .= "\n" . 'GSTIN: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . htmlspecialchars($billingTo->billing_gst) . '</span>';
                    }

                    $billing_to = nl2br($billing_to);

                    if ($billing->billingstatus === '2') {
                        $billing_status = '<span class="label label-warning">Pending for TI</span>';
                    } else if ($billing->billingstatus === '3') {
                        $billing_status = '<span class="label label-info">TI Generated</span>';
                    }
                    if ($billing->additional_expenses === NULL) {
                        $billing_amount = nl2br('Total Amount: <span style="color:#0884c7;font-size:14px;font-weight: bold;">' . $billing->sub_total . '</span>' . "\n" . 'Tax: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $tax->calculatedgst . '</span>' . "\n" . 'Grand Total: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->grandtotal . '</span>');
                    } else {
                        $billing_amount = nl2br('Total Amount: <span style="color:#0884c7;font-size:14px;font-weight: bold;">' . $billing->sub_total . '</span>' . "\n" . 'Tax: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $tax->calculatedgst . '</span>' . "\n" . 'Additional Amount: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->additional_expenses . '</span>' . "\n" . 'Grand Total: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->grandtotal . '</span>');
                    }

                    $action = ' <div class="row">
                                    <div class="col mb-1">
                                        <a href="#submit_ti" style="width:100%" class="btn btn-outline-info" data-value="' . $billing->aid . '" onclick="submit_ti(\'' . $billing->aid . '\')">Submit TI</a>
                                    </div>
                                    <div class="col mb-1">
                                        <a href="#add_receipt" style="width:100%" class="btn btn-outline-success"  data-value="' . $billing->aid . '" onclick="add_receipt(\'' . $billing->aid . '\')">Add Receipt</a>
                                    </div>
                                </div>';
                    // $action = '<a href="#largeModal" class="btn btn-outline-secondary generateti" data-value="' . $billing->aid . '"  data-toggle="modal">Submit TI</a>';
                    $data[] = array(
                        nl2br('Assignment ID: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->aid . '</span>' . "\n" . 'Case Reference: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->case_reference . '</span>'),
                        nl2br('Nature of Assignment: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->investigator_type . '</span>' . "\n" . 'Case Handler: <span style="color:#0884c7; font-size:14px;font-weight: bold;">' . $billing->salutation . ' ' . $billing->firstname . ' ' . $billing->lastname . '</span>'),
                        $billing_to,
                        $billing_amount,
                        nl2br('TI Number: <span style="color:#0884c7;font-size:14px;font-weight: bold;">' . $billing->ti_number . '</span>' . "\n" . 'TI Date: <span style="color:#0884c7;font-size:14px;font-weight: bold;">' . $billing->ti_datetime . '</span>'),
                        $billing_status,
                        $action
                    );
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->billing->countallti_request(),
                    "recordsFiltered" => $this->billing->countFilteredti_request($_POST),
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
                        $this->load->view("adminpanel/accounts/ti_request", $data);
                    }
                }
            }
        } else {
            redirect('user_logout');
        }
    }
   
    function savetiNumber(){
        if ($this->session->userdata('id') != null) {
            // $aid = $this->input->post('aid');
            $tidata = $this->input->post();
            // print_r($tidata);
            // exit;
            if (isset($tidata['gst_data'])) {
                $gstData = json_decode($tidata['gst_data'], true);
                if (isset($tidata['aid'])) {
                    $updateData = [
                        'aid' => $tidata['aid'], 
                        'tax' => json_encode($gstData), 
                        'ti_number' => $tidata['ti_number'],  
                        'ti_datetime' => $tidata['ti_datetime'],
                        'branchid' => $gstData['branchid']
                    ];

                    $result = $this->billing->updateTiNumber($updateData);
                    if ($result) {
                        echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to update record']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Aid is required']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'GST data is missing']);
            }
        } else {
            redirect('user_logout');
        }
    }

    // getting gst number dynamically(by nandini)
    public function get_gstnumber()
    {
        $companyId = $this->input->get('companyId');
        if ($companyId) {
            $gstData = $this->billing->getGstNumbersByCompanyId($companyId);
            echo json_encode(['gstnumbers' => $gstData]);
        } else {
            echo json_encode(['gstnumbers' => []]);
        }
    }
}
