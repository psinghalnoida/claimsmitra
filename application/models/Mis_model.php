<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Mis_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->helper('array');
        $this->load->helper('date');
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = now();
        $this->formattedDateTime = date('d-m-Y H:i:s', $currentDateTime);
    }

    public function getPricingData($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function countAllPricingData(){
        $this->db->from('claims_livelocationjob');
        return $this->db->count_all_results();
    }

    public function countFilteredPricingData($postData){
        $this->_get_datatables_query($postData);
        // return $this->db->count_all_results(); 
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData) {
        $columns = $postData['selectedAttributes'];
        $this->column_search = $columns;
    
        // Keys to extract from JSON column jobdata
        $jsonKeys = [
            'contact_person_name', 'contact_person_mobile', 'policyNumber', 'tag_vehicle', 'cause_loss',
            'location_survey', 'type_of_vehicle', 'vehicle_number'
        ];
    
        // Keys to extract from JSON column essentialdata
        $jsonKeysessential = [
            'policy_by', 'policy_user', 'policy_mobile', 'appoint_by',
            'case_reference', 'payment_by', 'date_of_report', 'insured_name','tagNumber','broker_no','invoicenumber','grnumber',
            'description_goods','estimated_amount','sum_insured','survey_place','survey_date','loss_data','natureofloss','sum_insured',
            'survey_place','survey_date','loss_data','natureofloss'
        ];
    
        // Keys to extract from JSON column casedata
        $jsonKeyscasedata = ['claim_number'];
    
        // Dynamically build JSON_EXTRACT fields for jobdata
        foreach ($jsonKeys as $key) {
            $this->db->select("JSON_UNQUOTE(JSON_EXTRACT(ca.jobdata, '$.$key')) AS $key");
        }
    
        // Dynamically build JSON_EXTRACT fields for essentialdata
        foreach ($jsonKeysessential as $key) {
            $this->db->select("JSON_UNQUOTE(JSON_EXTRACT(ca.essentialdata, '$.$key')) AS $key");
        }
    
        // Dynamically build JSON_EXTRACT fields for casedata
        foreach ($jsonKeyscasedata as $key) {
            $this->db->select("JSON_UNQUOTE(JSON_EXTRACT(ca.casedata, '$.$key')) AS $key");
        }

    
        // Select the necessary fields
        $this->db->select("ca.id, ca.aid, ca.case_reference, ca.natureofjob, ctl.investigator_type,DATE(ca.createdAt) as createdAt, cd.dispatchdate,cd.description,cd.dispatchmode , cb.ti_number, cb.grandtotal,cb.ti_datetime");
        $this->db->from('claims_livelocationjob as ca');
        $this->db->join('claims_task_list as ctl', 'ca.natureofjob = ctl.id', 'LEFT');
        $this->db->join('claims_dispatch as cd', 'cd.aid = ca.aid', 'LEFT');  
        $this->db->join('claims_billing as cb', 'cb.aid = ca.aid', 'RIGHT');  
        $this->db->where('ca.natureofjob = ctl.id'); 
        $this->db->group_by('ca.case_reference'); 
        // print_r(json_encode($this->db->get()->result_array()));
        // exit;

        // Filter by the selected investigatorId (natureofjob)
        if (isset($postData['investigatorId']) && !empty($postData['investigatorId'])) {
            $investigatorId = $postData['investigatorId']; 
            $this->db->where('ca.natureofjob', $investigatorId);  
        }
    
        // Apply custom filters dynamically based on filter key and value
        if (isset($postData['filters']) && !empty($postData['filters'])) {
            foreach ($postData['filters'] as $filterKey => $filterValue) {
                if (in_array($filterKey, $jsonKeys)) {
                    $this->db->like("JSON_UNQUOTE(JSON_EXTRACT(ca.jobdata, '$.$filterKey'))", $filterValue);
                } elseif (in_array($filterKey, $jsonKeysessential)) {
                    $this->db->like("JSON_UNQUOTE(JSON_EXTRACT(ca.essentialdata, '$.$filterKey'))", $filterValue);
                } elseif (in_array($filterKey, $jsonKeyscasedata)) {
                    $this->db->like("JSON_UNQUOTE(JSON_EXTRACT(ca.casedata, '$.$filterKey'))", $filterValue);
                } else {
                    $this->db->like($filterKey, $filterValue);
                }
            }
        }
    
        // Search filters
        $i = 0;
        foreach ($this->column_search as $item) {
            if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                }
                if (in_array($item, $jsonKeys)) {
                    $this->db->or_like("JSON_UNQUOTE(JSON_EXTRACT(ca.jobdata, '$.$item'))", $postData['search']['value']);
                } elseif (in_array($item, $jsonKeysessential)) {
                    $this->db->or_like("JSON_UNQUOTE(JSON_EXTRACT(ca.essentialdata, '$.$item'))", $postData['search']['value']);
                } elseif (in_array($item, $jsonKeyscasedata)) {
                    $this->db->or_like("JSON_UNQUOTE(JSON_EXTRACT(ca.casedata, '$.$item'))", $postData['search']['value']);
                } 
                else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
    
                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end(); 
                }
            }
            $i++;
        }

        if (!empty($postData['startDate']) && !empty($postData['endDate'])) {
            $startDate = $postData['startDate'];
            $endDate = $postData['endDate'];
            
            if (!empty($postData['date_type']) && $postData['date_type'] === 'ti_datetime') {
                $this->db->where("STR_TO_DATE(cb.ti_datetime, '%d-%m-%Y') BETWEEN '{$startDate}' AND '{$endDate}'");
            } else {
                $this->db->where("
                    (STR_TO_DATE(ca.createdAt, '%Y-%m-%d') BETWEEN '{$startDate}' AND '{$endDate}'
                    OR STR_TO_DATE(ca.createdAt, '%d-%m-%Y') BETWEEN '{$startDate}' AND '{$endDate}'
                    OR STR_TO_DATE(ca.createdAt, '%m/%d/%Y') BETWEEN '{$startDate}' AND '{$endDate}')
                ");
            }
        }

        // Ordering logic
        if (isset($postData['order'])) {
            $this->db->order_by($columns[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else {
            $this->db->order_by('ca.id', 'asc');
        }
    }
    
    
    public function saveQueryData($inputText, $userId, $attributes) {
        $data = [
            'save_as' => $inputText,
            'userid' => $userId,
            'attributes' => json_encode($attributes),
        ];
        return $this->db->insert('claims_saved_query', $data);
    }
  
    public function getSavedQueriesData($userId, $saveAs = null,$id = null) {
        if ($saveAs) {
            $this->db->select('claims_saved_query.id, claims_form_fields.key_name, claims_form_fields.fields_name');
            $this->db->from('claims_saved_query');
            $this->db->join('claims_form_fields', 'JSON_CONTAINS(claims_saved_query.attributes, JSON_QUOTE(claims_form_fields.key_name))', 'left');
            $this->db->where('claims_saved_query.save_as', $saveAs);
            $this->db->where('claims_saved_query.userid', $userId);
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select('claims_saved_query.id, claims_saved_query.save_as');
            $this->db->from('claims_saved_query');
            $this->db->where('claims_saved_query.userid', $userId);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    public function deleteAttribute($attribute) {
        $save_as = $this->input->post('save_as');
        if ($save_as) {
            $this->db->select('attributes');
            $this->db->from('claims_saved_query');
            $this->db->where('save_as', $save_as);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $attributes = json_decode($row->attributes, true); 
                if (($key = array_search($attribute, $attributes)) !== false) {
                    unset($attributes[$key]); 
                    $attributes = array_values($attributes); 
                    $this->db->where('save_as', $save_as);
                    return $this->db->update('claims_saved_query', [
                        'attributes' => json_encode($attributes)
                    ]);
                }
            }
        }
    
        return false; 
    }
    public function checkIfQueryExists($userId, $queryName) {
        // Check if a query already exists with the given 'save_as' value and user ID
        $this->db->where('userid', $userId);
        $this->db->where('save_as', $queryName);
        $query = $this->db->get('claims_saved_query'); // Assuming the table is 'saved_queries'

        // If the query exists, return true; otherwise, return false
        return $query->num_rows() > 0;
    }

    public function updateQueryData($userId, $newAttributes) {
        // Fetch the existing attributes
        $this->db->select('attributes');
        $this->db->where(['userid' => $userId]);
        $query = $this->db->get('claims_saved_query');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $existingAttributes = json_decode($row->attributes, true); // Decode JSON to array

            // Ensure it's an array
            if (!is_array($existingAttributes)) {
                $existingAttributes = [];
            }

            // Merge new attributes, ensuring uniqueness
            $updatedAttributes = array_unique(array_merge($existingAttributes, json_decode($newAttributes, true)));

            // Update the database
            $this->db->where(['userid' => $userId]);
            return $this->db->update('claims_saved_query', ['attributes' => json_encode($updatedAttributes)]);
        } else {
            // If no existing record, insert new one
            return $this->db->insert('claims_saved_query', [
                'userid' => $userId,
                'attributes' => json_encode(json_decode($newAttributes, true))
            ]);
        }
    }

    
}