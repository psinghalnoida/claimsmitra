<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
class Accounts extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('accounts_model','accountsmodel');
        $this->load->model('billing_model','billing');
      
    }

    public function index() {
        
        $this->load->view('adminpanel/accounts/invoice');
    }

    public function dashboard() {

        $this->load->view('adminpanel/accounts/receivable');
    }  
    public function mis(){
        
    }


    public function updatePaymentinBulk(){

        $filePath = FCPATH . 'sheet1.xlsx'; // Change path as needed
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // Get total rows

        $missing_references = []; // To store case references that don't exist

        for ($row = 2; $row <= $highestRow; $row++) { // Assuming row 1 is the header
            $case_reference = trim($worksheet->getCell("A$row")->getValue()); // Get case reference
            $tds = trim($worksheet->getCell("B$row")->getValue()); // Get billing amount
            $amount = trim($worksheet->getCell("C$row")->getValue()); // Get billing amount
            $tds_amount = trim($worksheet->getCell("D$row")->getValue()); // Get billing amount
            $total_amount = trim($worksheet->getCell("E$row")->getValue()); // Get billing amount
            $remaining = trim($worksheet->getCell("F$row")->getValue()); // Get billing amount
            $final = trim($worksheet->getCell("G$row")->getValue()); // Get billing amount
            $description = $worksheet->getCell("H$row")->getValue(); // Get billing amount

            if (!empty($case_reference)) {
                // Check if case_reference exists
                $this->db->where('case_reference', $case_reference);
                $this->db->where('status !=', 11);

                $case = $this->db->get('claims_livelocationjob')->row();
                // print_r($case->aid);
                // exit;
                if ($case) {
                    // $data = [
                    //     "payment_mode"     => "neft",
                    //     "reference_number" => $description,
                    //     "amount"           => $amount,
                    //     "payment_date"     => NULL,
                    //     "tds" => $tds,
                    //     "total_amount" => $total_amount,
                    // ];
                    $data = NULL;
                    $final = NULL;
                    $tds = NULL;


                    if ($this->billing->update_payment_data($case->aid, $data, $final, $tds)) {
                        if($this->billing->updateStatus($case->aid)){
                            print_r($case->aid , "Payment Update Successfully");
                            // $payment_detail  = $this->billing->get_payment_data($aid);
                            // echo json_encode(["status" => "success", "message" => "Payment added successfully", "data" => $payment_detail]);
                        }else{
                            print_r($case_reference , "Failed to update status");
                            // echo json_encode(["status" => "failed", "message" => "Payment Failed"]);
                        }
                    } else {
                        print_r($case_reference , "Failed to update payment");
                    }
                } else {
                    // Store missing case references
                    print_r($case_reference , "Case number does not exist");
                }
            }
        }

        // // Show missing reference numbers
        // if (!empty($missing_references)) {
        //     echo "The following case references do not exist in the database:<br>";
        //     echo implode(', ', $missing_references);
        // } else {
        //     echo "All records updated successfully!";
        // }
        
    }
}

?>
