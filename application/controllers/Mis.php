<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Mis extends CI_Controller{
    public function __construct()
    {
       parent::__construct();
       $this->load->library('form_validation');
       $this->load->model('Mis_model','mismodel');
       $this->load->model('case_model',"case");
       $this->load->model('company_model', 'company');
    }
  
    public function getMisFilter() {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $postData = $_POST;
              
                // Retrieve selectedAttributes from POST
                $selectedAttributes = isset($postData['selectedAttributes']) ? $postData['selectedAttributes'] : [];
                // $data = array();
                // $i = $postData['start']; 
                $pricingData = $this->mismodel->getPricingData($postData);
                $data = array();
                $i = $postData['start']; 
                foreach ($pricingData as $pricingValue) {
                    $i++;
                    $row = [$i]; 
                    foreach ($selectedAttributes as $col) {
                        if (property_exists($pricingValue, $col)) {
                            $row[] = $pricingValue->{$col}; // Add the value if property exists
                        } else {
                            $row[] = ''; // Add an empty string or a placeholder if property does not exist
                        }
                    }
                    $data[] = $row; // Add the row to the data array
                }

                // Prepare the output for DataTable response
                $output = array(
                    "draw" => $_POST['draw'], // Draw counter for DataTable
                    "recordsTotal" => $this->mismodel->countAllPricingData(), // Total records
                    "recordsFiltered" => $this->mismodel->countFilteredPricingData($_POST), // Filtered records based on the query
                    "selectedAttributes" => $selectedAttributes, // Return selected attributes
                    "data" => $data, // Data rows for the table
                );

                // Send the response as JSON
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
                            'companyName' => $this->company->getCompanyName($defaultcompany),
                            'fields' => $this->case->get_field_names(),
                            'surveyors' => $this->case->get_survey_names(),
                            'view' => "Generate Query",
                        ];
                       
                        $this->load->view("adminpanel/query/generatemis", $data);
                    }
                }         
            }
        } else {
            redirect('user_logout');
        }
    }

    
    
    // public function savequery() {
    //     if ($this->session->userdata('id') != null) {
    //         $this->load->model('mismodel');
    
    //         // Retrieve input data
    //         $inputText = $this->input->post('text');
    //         $attributes = $this->input->post('attributes');

    //         if (empty($inputText) || empty($attributes)) {
    //             echo json_encode(['status' => 'error', 'message' => 'Text and attributes are required.']);
    //             return;
    //         }
           
    //         $userId = $this->session->userdata('id');
    //         $isSaved = $this->mismodel->saveQueryData($inputText, $userId, $attributes);
    //         if ($isSaved) {
    //             echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
    //         } else {
    //             echo json_encode(['status' => 'error', 'message' => 'Failed to save data']);
    //         }
    //     } else {
    //         redirect('user_logout');
    //     }
    // }
   
    public function savequery() {
        if ($this->session->userdata('id') != null) {
            $this->load->model('mismodel');
        
            // Retrieve input data
            $inputText = $this->input->post('text');
            $attributes = $this->input->post('attributes');

            if (empty($inputText) || empty($attributes)) {
                echo json_encode(['status' => 'error', 'message' => 'Text and attributes are required.']);
                return;
            }
            
            $userId = $this->session->userdata('id');
            
            // Check if the query already exists for the user
            $queryExists = $this->mismodel->checkIfQueryExists($userId, $inputText);
            
            if ($queryExists) {
                echo json_encode(['status' => 'error', 'message' => 'Query with this name already exists.']);
                return;
            }

            // Save the new query with attributes
            $isSaved = $this->mismodel->saveQueryData($inputText, $userId, $attributes);
            if ($isSaved) {
                echo json_encode(['status' => 'success', 'message' => 'Query saved successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save query']);
            }
        } else {
            redirect('user_logout');
        }
    }

    public function getSavedQueries() {
        $saveAs = $this->input->post('save_as');
        $id = $this->input->post('id');
        $userId = $this->session->userdata('id');
        $this->load->model('mismodel');
    
        if ($saveAs) {
            $result = $this->mismodel->getSavedQueriesData($userId, $saveAs,$id);
            if (!empty($result)) {
                echo json_encode(['status' => 'success', 'data' => $result]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No attributes found for the selected query.']);
            }
        } else {
            $result = $this->mismodel->getSavedQueriesData($userId);
            if (!empty($result)) {
                echo json_encode(['status' => 'success', 'data' => $result]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No saved queries found.']);
            }
        }
    } 
    
    

    public function deleteSavedQuery() {
        $attribute = $this->input->post('attribute', true); 
        $save_as = $this->input->post('save_as', true); 
        if ($attribute && $save_as) {
            $isDeleted = $this->mismodel->deleteAttribute($attribute);
            if ($isDeleted) {
                echo json_encode(['status' => 'success', 'message' => 'Attribute deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete attribute.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid parameters provided.']);
            
        }
    }
    
    public function updateQueryData($userId, $newAttributes) {
        $this->db->select('attributes');
        $this->db->where(['userid' => $userId]);
        $query = $this->db->get('claims_saved_query');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $existingAttributes = json_decode($row->attributes, true) ?? []; // Ensure it's an array

            // Merge existing and new attributes, ensuring uniqueness
            $updatedAttributes = array_unique(array_merge($existingAttributes, json_decode($newAttributes, true) ?? []));

            // Update the database
            $this->db->where(['userid' => $userId]);
            return $this->db->update('claims_saved_query', ['attributes' => json_encode($updatedAttributes)]);
        } else {
            // If no existing attributes, insert new ones
            return $this->db->insert('claims_saved_query', [
                'userid' => $userId,
                'attributes' => json_encode(json_decode($newAttributes, true) ?? [])
            ]);
        }
    }
    public function getExistingAttributes() {
        if ($this->session->userdata('id')) {
            $userId = $this->session->userdata('id');

            $this->db->select('attributes');
            $this->db->where(['userid' => $userId]);
            $query = $this->db->get('claims_saved_query');

            if ($query->num_rows() > 0) {
                echo json_encode($query->row()->attributes);
            } else {
                echo json_encode([]);
            }
        } else {
            echo json_encode([]);
        }
    }

    
    
}