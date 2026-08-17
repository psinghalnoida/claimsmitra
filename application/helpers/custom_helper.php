<?php

function sendwhatsapptextmessage($message,$receiver){
	$sender = '918368292279';
	$data = [
		'api_key' => 'yScE3okJrysO93QLhfY3KrpqMhTOiV',
		'sender' => $sender,
		'number' => $receiver,
		'message' => $message
	];
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apinew.getitsms.com/send-message',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => json_encode($data),
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
	  ),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	if ($err) {
	//echo "cURL Error #:" . $err;
	return false;
	} else {
	//echo $response;
	return true;
	}
}




function checkmail($email,$sub,$body,$form='info@claimsmitra.com'){
		$ci = & get_instance();
		$ci->load->library('email');
		$s_name = $ci->session->userdata('s_name');
			$ci->email->initialize(array(
											'protocol' => 'smtp',
											'smtp_host' => 'smtp.sendgrid.net',
											'smtp_user' => 'psinghal',
											'smtp_pass' => 'red@12321',
											'smtp_port' => 587,
											'mailtype'  => 'html',
											));
												     
			$ci->email->from($form, $s_name);
			$ci->email->to(array($email));
			//$this->email->cc($example_emailB);
			$ci->email->subject($sub);
			$ci->email->message($body);

			$ci->email->send();
		    return true;


}

function encryptUrl($company,$department,$user_role){
	$ci = &get_instance();
	$data_array = [
		'defaultcompany' => $company,
		'defaultdepartment' => $department,
		'usertype' => $user_role
	];

	// Convert the array to JSON
	$json_data = json_encode($data_array);

	// Encrypt the JSON string
	return base64_encode($ci->encryption->encrypt($json_data));
}

function decryptUrl($encryptUrl){
	$ci = &get_instance();
	$decrypted_json = $ci->encryption->decrypt(base64_decode($encryptUrl));
	if ($decrypted_json === false) {
      $response = array("status" => 500, "message" => "Decryption failed. Invalid data.");
      echo json_encode($response);
      return;
  }
  $data_array = json_decode($decrypted_json, true);   
  return $data_array;           
}

function sendHtmlMail($email,$sub,$body,$form='info@claimsmitra.com')
{
		$ci = & get_instance();
		$ci->load->library('email');
		$s_name = $ci->session->userdata('s_name');
		
			$ci->email->initialize(array(
											'protocol' => 'smtp',
											'smtp_host' => 'smtp.sendgrid.net',
											'smtp_user' => 'psinghal',
											'smtp_pass' => 'red@12321',
											'smtp_port' => 587,
											'mailtype'  => 'html',
											));
												     
			$ci->email->from($form, $s_name);
			$ci->email->to(array($email));
			$ci->email->cc($form);
			$ci->email->subject($sub);
			$ci->email->message($body);

			$ci->email->send();
		    return true;

		    
			// $url = 'https://api.sendgrid.com/';
			// $user = 'psinghal';
			// $pass = 'red@12321';

			// $json_string = array(
			// 'to' => array($email),
			// 'category' => 'claimsmitra'
			// );
			// $params = array(
			// 'api_user'  => $user,
			// 'api_key'   => $pass,
			// 'x-smtpapi' => json_encode($json_string),
			// 'to'        => $email,
			// 'subject'   => $sub,
			// 'html'      => $body.'<br><br><br>
			// Cheers,<br>
			//       <a href="'.base_url().'" class="navbar-brand">Team Claims Mitra</a> <br/>
   //                  <br/>',
			// 'from'      => $form,
			// );

			// $request =  $url.'api/mail.send.json';
			// $session = curl_init($request);
			// curl_setopt ($session, CURLOPT_POST, true);
			// curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
			// curl_setopt ($session, CURLOPT_HEADER, false);
			// curl_setopt ($session, CURLOPT_SSLVERSION, 6);
			// //curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
			// curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			// $response = curl_exec($session);
			// curl_close($session);
		 //    return true;
}

function sendHtmlToEmail($email,$ccemail,$sub,$body,$form='info@claimsmitra.com')
{
			$url = 'https://api.sendgrid.com/';
			$user = 'psinghal';
			$pass = 'red@12321';

			$json_string = array(
			'to' => array($email),
			'category' => 'claimsmitra'
			);
			$params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'x-smtpapi' => json_encode($json_string),
			'to'        => $email,
			'cc' 		=> $ccemail,
			'subject'   => $sub,
			'html'      => $body.'<br><br><br>
			Cheers,<br>
			      <a href="'.base_url().'" class="navbar-brand">Team Claims Mitra</a> <br/>
                    <br/>',
			'from'      => $form,
			);

			$request =  $url.'api/mail.send.json';
			$session = curl_init($request);
			curl_setopt ($session, CURLOPT_POST, true);
			curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_SSLVERSION, 6);
			//curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($session);
			curl_close($session);
		    return true;
}



function sendNotification($notificationData){
	    $ci =& get_instance();

			// $notificationData = array(
			// 	                    'user_id' =>$get_user_code,
			// 						'case_id'=>$caseid,
			// 						'reference'=>$reference,
			// 						'title'=>$title,
			// 						'massage'=>$massage,
			// 						'status'=>$status,
			// 						);
		$ci->db->insert('notification_status', $notificationData);
		return true;
}

function update_status($reference_no, $casestatus,$casestatusvalue,$casestatusdate){
	     //print_r($casestatus); die();

    	 $ci =& get_instance();
    	    $ess = $ci->db->query("SELECT case_id FROM essential_data WHERE  `reference_no`=" . "'" .$reference_no."' ")->result_array();
			$case_status = array();
			$case_status_date = array();
			$case_status_value = array();
			$condition = "reference_no =" . "'" . $reference_no . "'";
			$ci->db->select('*');
			$ci->db->from('case_management');
			$ci->db->where($condition);
			$ci->db->limit(1);
			$res = $ci->db->get();

			if($res->num_rows() == 1){  
				$query = $res->result_array();
				// print_r(end($query[0]['casestatus'])); die(); 
	             $j=$k=$i=count(unserialize($query[0]['casestatus']));
				//	$case_status = array();
				$status=unserialize($query[0]['casestatus']);
				        foreach($status   as $key=>$val){ $case_status[$key] =  $val; }
				        $case_status[$i] =  $casestatus; 
				//$case_status_date = array();
				$CaseStatusDate=unserialize($query[0]['casestatusdate']);
				        foreach($CaseStatusDate   as $key=>$val){ $case_status_date[$key] =  $val; }
				         $case_status_date[$j] =  $casestatusdate;
				//$case_status_value = array();
				$CaseStatusValue=unserialize($query[0]['casestatusvalue']);
				        foreach($CaseStatusValue   as $key=>$val){ $case_status_value[$key] =  $val; }
				        $case_status_value[$k] =  $casestatusvalue;
				        	$lastStatus  = end($status);
				        	//print_r($lastStatus); die();
				        	
				        
				    
				$data  = array(
								'last_status'=>$casestatus,
								'created_at'=>$casestatusdate,
								'casestatus'=>serialize($case_status),
								'casestatusvalue'=>serialize($case_status_value),
								'casestatusdate'=>serialize($case_status_date),
								'file_path'=>'',
								);
				if($lastStatus != 'Report dispatched'){
				$ci->db->where('reference_no', $reference_no);
				$ci->db->update('case_management', $data);
}
	         }else{
	         	        $j=$k=$i=0;
	         	        $case_status[$i] =  $casestatus; 
						$case_status_date[$j] =  $casestatusdate;
				        $case_status_value[$k] =  date('d-m-Y');
						$data  = array(
										'reference_no'=>$reference_no,
										'created_at'=>$casestatusdate,
										'update_dispatch_mode'=>'',
										'update_dispatch_value'=>'',
										'update_dispatch_date'=>'',
										'Payment_mode'=>"",
										'Payment_mode_value'=>"",
										'Payment_mode_date'=>"",
										'last_status'=>$casestatus,
										'casestatus'=>serialize($case_status),
										'casestatusvalue'=>serialize($case_status_value),
										'casestatusdate'=>serialize($case_status_date),
										'file_path'=>'',
								 );

	         		$ci->db->insert('case_management', $data);
	              }
	              	              urlupdate($ess[0]['case_id']);

	            		return true;
  
    }

function htmltbl($surveorusers){

		 $check_device = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
		if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')){
		$width = '100% !important';
		}else{
		$width = '132%  !important';
		} 
	    $ci =& get_instance();
		$result= $ci->db->select('*')->where('status', '1')->where("vendor_type", "Surveyor")->get('vendor');
        $htmltbl = '';

$htmltbl .='
	    <div class="modal fade modal-side-fall" id="vendorModal" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1" width="100%">
          <div class="modal-dialog modal-simple modal-top">
            <div class="modal-content"  style="width:'.$width.';font-size: 11px; ">
              <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Vendor List </h4>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table id="vendoe-data" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
						       <th>#</th>
                                <th>Vendor Type </th>
                                <th>Vendor Name </th>
                                <th>Location </th>
                                <th>City </th>
                                <th>Email </th>
                                <th>Mobile </th>
                                <th>Vendor Code </th>  
                      </tr>
                    </thead>
                    <tbody>';
     
 					if (!empty($surveorusers)) { foreach ($surveorusers as $key => $value) {
                           
        			$htmltbl .='<tr>
                                <td>
                                  <div class="radio-custom radio-primary">
                                  <input type="radio" id="inputuser" class="Surveyor_rad" name="Surveyor_vendor" value="'.$value->user_id.'">
                                  <label for="inputuser"></label>
                                  </div></td>
                                  <td>Surveyor</td>
                                  <td class="Name">'.$value->user_name.'</td>
                                  <td  class="Location">'.$value->user_address.'</td>
                                  <td  class="City"> '.$value->user_city.'</td>
                                  <td  class="Email">'.$value->user_email.'</td>     
                                  <td>'.$value->user_mobile.'</td>
                                  <td>'.$value->user_id.'</td>                   
                                  </tr>';
                                  } }

            if ($result->num_rows() > 1) { foreach ($result->result() as $key => $value) {
                                 
                    $htmltbl .='<tr>
                                 <td>
                                    <div class="radio-custom radio-primary">
                                    <input type="radio" id="inputuser" class="Surveyor_rad" name="Surveyor_vendor" value="'.$value->Vendor_Code.'">
                                    <label for="inputuser"></label>
                                    </div>
                                    </td>
                                  <td>'.$value->vendor_type.' </td>
                                  <td class="Name">'.$value->Vendor_Name.'</td>
                                  <td class="Location">'.$value->Address.'</td>
                                  <td class="City">'.$value->City.'</td>   
                                  <td class="Email">'.$value->Email.'</td>
                                  <td>'.$value->Contact_No.' </td>
                                  <td>'.$value->Vendor_Code.'</td>                           
                                  </tr>';
							 } }   
                     $htmltbl .='</tbody>
                  </table>
             </div>
           <div class="modal-footer" style="float:left;">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info btn-sm btn-grad btn-rect" id="vendorlistrefresh" style=" float: right !important;">Refresh</button>

                    <a href="'.base_url('surveyor/add-vendor').'" target="_blank" style=" float: right !important;">
                    <button type="button" class="btn btn-warning btn-sm btn-grad btn-rect"> Add New</button></a>

                    <a href="#" id="onvalue1" class="" >
                    <button type="button" class="btn btn-info btn-sm btn-grad btn-rect" data-dismiss="modal" id="Assigneddone">Done</button></a>
              </div>
               </div>
            </div>
          </div>
      </div>
	  ';



		return $htmltbl;
}

function htmldatatbl(){
	
	    $ci =& get_instance();
		$result= $ci->db->select('*')->where('status', '1')->get('vendor');
        $htmltbl = '';
	    $htmltbl .='
	    <div class="modal fade modal-side-fall" id="myModal" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content"  style="font-size: 11px; ">
              <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Vendor List </h4>
              </div>
              <div class="modal-body" >
               
				 <select class="column_filter" id="col2_filter">
				<option value="">[ select User Type ]</option>
				<option value="Surveyor">Surveyor</option>        
				<option value="Insurer">Insurer</option>        
				<option value="Place Of Survey">Place Of Survey</option>              
				<option value="Insured">Insured</option>        
				<option value="Broker/Intermediary">Broker/Intermediary</option>        
				</select>
				<div class="table-responsive">	            
                  <table id="item-list" id="dtVerticalScrollExample" class="table table-bordered table-striped table-hover  filter-table-data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-name="VendorCode">Vendor Code</th>
                        <th data-name="VendorType">Vendor Type</th>
                        <th data-name="VendorCode">Vendor Name</th>
                        <th data-name="VendorType">Email ID</th>
                        <th data-name="Location">Location</th>
                        <th data-name="Office">Office Type</th>
                        <th data-name="mobile">mobile</th>
                      </tr>
                    </thead>
                    <tbody>';    
                    foreach($result->result() as $value) {	
                    $htmltbl .='<tr>
                                  <td>
                                    <div class="radio-custom radio-primary">
                                     <input type="radio"  name="vendor_d" checked="" value="'.$value->Vendor_Code.'"> <label for="inputRadiosChecked"></label></div>
                                    </td>
                                  <td>'.$value->Vendor_Code.' </td>
                                  <td class="VendorType">'.$value->vendor_type.'</td>
                                  <td class="Name">'.$value->Vendor_Name.'</td>
                                  <td class="Email">'.$value->Email.'</td>   
                                  <td class="Location">'.$value->Address.'</td>
                                  <td class="Office">'.$value->OfficeType.' </td>
                                  <td class="mobile">'.$value->Contact_No.' </td>
                                  </tr>';
							  }     

                     $htmltbl .='</tbody>
                  </table>
                   </div>
                  <div class="modal-footer" style="float:left;">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info btn-sm btn-grad btn-rect" id="vendorlistrefresh" style=" float: right !important;">Refresh</button>
                    <a href="'.base_url('surveyor/add-vendor').'" target="_blank" style=" float: right !important;">
                    <button type="button" class="btn btn-warning btn-sm btn-grad btn-rect"> Add New</button></a>
                    <a href="#" id="onvalue" class="insurer" value="xyz">
                    <button type="button" class="btn btn-info btn-sm btn-grad btn-rect" data-dismiss="modal" id="done">Done</button></a>

             
              </div>
              </div>
              
            </div>
          </div>
      </div>
	  ';
		return $htmltbl;
}
function vendor_info($vendorcode){
	    $ci =& get_instance();
		$result= $ci->db->select('*')->where('status', '1')->where('Vendor_Code', $vendorcode)->get('vendor')->result();
		//print_r($result); die();
        $htmltbl = '';
        if (!empty($result)) {
 			$htmltbl .='<div class="panel panel-info panel-line" style="padding: 2px; margin-bottom: 0px;font-size: 9px;"> <div class="panel-heading"> </div> <div class="panel-body" style="padding: 3px 6px; background-color: #f1f4f5;">  <strong> OfficeType :</strong>'. $result[0]->OfficeType .'<br>    <strong>Vendor Name :</strong>'. $result[0]->Vendor_Name  .'<br>   <strong>Address :</strong>'. $result[0]->Address .'<br> <strong>Email :</strong>'. $result[0]->Email .'<br>  <strong>Mobile :</strong>'. $result[0]->Contact_No .'<br>    </div>    </div>';
   		}          
		return $htmltbl;
}

   function getCaseInfo($caseid){
  		    $ci =& get_instance();
  	   $essentialdata = $ci->db->query("SELECT * FROM essential_data where case_id ='".$caseid."'")->result_array();
  	  
  	     $qbrokar =$ci->db->select('*')->where('Vendor_Code',$essentialdata[0]['brokar'] )->get('vendor');
            if ($qbrokar->num_rows() > 0){ $brokardata=$qbrokar->result_array();
            $brokar_location =  $brokardata[0]['Vendor_Name'];   $brokar_code =$brokardata[0]['Vendor_Code'];       
            }
            else{  $brokar_code = "";  $brokar_location = $essentialdata[0]['brokar'];
            }

            $survey_firm =$ci->db->select('*')->where('Vendor_Code',$essentialdata[0]['survey_firm'] )->get('vendor'); 
            if ($survey_firm->num_rows() > 0){ $surveyfirmdata=$survey_firm->result_array();
            $survey_firm_location =  $surveyfirmdata[0]['Vendor_Name'];   $survey_firm_code =$surveyfirmdata[0]['Vendor_Code'];       
            }
            else{  $survey_firm_code = "";  $survey_firm_location = $essentialdata[0]['survey_firm'];
            }

                $qplace_of_survey =$ci->db->select('*')->where('Vendor_Code',$essentialdata[0]['place_of_survey'] )->get('vendor'); 
            if ($qplace_of_survey->num_rows() > 0){ $place_of_survey_data=$qplace_of_survey->result_array();
            $place_of_survey_location =  $place_of_survey_data[0]['Vendor_Name'];   $place_of_survey_code =$place_of_survey_data[0]['Vendor_Code'];       
            }
            else{  $place_of_survey_code = "";  $place_of_survey_location = $essentialdata[0]['place_of_survey'];
            }

                   $qinsured =$ci->db->select('*')->where('Vendor_Code',$essentialdata[0]['insured'] )->get('vendor'); 
            if ($qinsured->num_rows() > 0){ $qinsured_data=$qinsured->result_array();
            $insured_location =  $qinsured_data[0]['Vendor_Name'];   $insured_code =$qinsured_data[0]['Vendor_Code'];       
            }
            else{  $insured_code = "";  $insured_location = $essentialdata[0]['insured'];
            }

                      $qappointment_by =$ci->db->select('*')->where('Vendor_Code',$essentialdata[0]['appointment_by'] )->get('vendor'); 
            if ($qappointment_by->num_rows() > 0){ $appointment_by_data=$qappointment_by->result_array();
             $appointment_by_location =  $appointment_by_data[0]['Vendor_Name'];   $appointment_by_code =$appointment_by_data[0]['Vendor_Code'];       
            }
            else{  $appointment_by_code = "";  $appointment_by_location = $essentialdata[0]['appointment_by'];
            }
            
  	   $getCaseInfo = '  <table width="100%" border="1" style="font-size: 15px; border-collapse: collapse;">
  	    <tr>
          <th>Party</th><th>Party Name</th><th>Vendor Code</th><th>Party Reference</th>
       </tr>
     <tr>
       <th>Surveyor</th><td> '.$survey_firm_location.'</td><td>'.$survey_firm_code.'</td><td>'.$essentialdata[0]['ref_surveyor'] .'</td>
     </tr>
     <tr>
       <th>Insured</th><td>'.$insured_location .'</td><td>'.$insured_code.'</td><td>'.$essentialdata[0]['ref_insured'] .'</td>
     </tr>
          <tr>
       <th>Insurer</th><td>'.$appointment_by_location .'</td><td>'.$appointment_by_code.'</td><td>'.$essentialdata[0]['ref_insurer'] .'</td>
     </tr>
          <tr>
       <th>Broker</th><td>'.$brokar_location .'</td><td>'.$brokar_code.'</td><td>'.$essentialdata[0]['ref_broker'] .'</td>
     </tr>
      <tr>
       <th>Location</th><td>'.$place_of_survey_location.'</td><td>'.$place_of_survey_code.'</td><td>'.$essentialdata[0]['ref_place_or_workshop'] .'</td>
     </tr>
     
   </table>

    ';
    return $getCaseInfo;
  	   
  }


function urlupdate($case_id){
	    $ci =& get_instance();

		$ess = $ci->db->query("SELECT os.name as os_name, e.id, e.reference_no, e.your_reference, e.ref_insured, e.ref_place_or_workshop, e.ref_surveyor, e.ref_broker, e.ref_insurer, e.case_id, department.department_name AS type_of_survey, e.survey_type_option, e.surveyor_name, e.user_email, e.contact_no AS `insured_mob`, e.contact_person, e.vehicleNumber, e.caseReference, e.itemSurveyed, e.doi, e.policyLoss_date, e.policy_no, e.inv_no, e.cargo, e.lossLiability, e.couseof_loss, e.dos, e.survey_pending, e.usercode, e.intimation_id, e.case_surveyedby, e.status, e.created_at, e.subject, e.active, e.insured_address, e.place_address, e.place_email, c.last_status, c.update_dispatch_mode, c.update_dispatch_date, c.update_dispatch_value,
			e.appointment_by, CONCAT_WS(' ', v.Vendor_Name, v.Address) AS `appointment_by_info`,  
			e.survey_firm, CONCAT_WS(' ', vs.Vendor_Name, vs.Address) AS `survey_firm_info`,  
			e.place_of_survey, CONCAT_WS(' ', vp.Vendor_Name, vp.Address) AS `place_of_survey_info`, 
			e.insured, CONCAT_WS(' ', vi.Vendor_Name, vi.Address) AS `insured_info`,  
			vi.Contact_No AS `insured_mob_one`, 
			e.policy_by, CONCAT_WS(' ', vpo.Vendor_Name, vpo.Address) AS `policy_by_info`, 
			e.payment_by, CONCAT_WS(' ', vpa.Vendor_Name, vpa.Address) AS `payment_by_info`, 
			e.brokar, CONCAT_WS(' ', vb.Vendor_Name, vb.Address) AS `brokar_info`

          FROM essential_data e 
          LEFT JOIN case_management c ON e.reference_no = c.reference_no
          LEFT JOIN vendor v ON e.appointment_by = v.vendor_code
          LEFT JOIN vendor vs ON e.survey_firm = vs.vendor_code
          LEFT JOIN vendor vp ON e.place_of_survey = vp.vendor_code
          LEFT JOIN vendor vi ON e.insured = vi.vendor_code
          LEFT JOIN vendor vpo ON e.payment_by = vpo.vendor_code
          LEFT JOIN vendor vpa ON e.policy_by = vpa.vendor_code
          LEFT JOIN vendor vb ON e.brokar = vb.Vendor_Code 
          LEFT JOIN case_os os ON e.case_id = os.case_id
          LEFT join department ON e.type_of_survey  = department.id
          LEFT join url ON e.case_id  = url.case_id  WHERE  `e`.`case_id`=" . "'" .$case_id."' ")->result();



foreach ($ess as $key => $value) {


	
       $url= $value->reference_no.'|'. $value->ref_insured.'|'. $value->ref_place_or_workshop.'|'. $value->ref_surveyor.'|'. $value->ref_broker.'|'. $value->ref_insurer.'|'. $value->type_of_survey.'|'. $value->survey_type_option.'|'. $value->surveyor_name.'|'. $value->user_email.'|'. $value->insured_mob.'|'. $value->contact_person.'|'. $value->vehicleNumber.'|'. $value->caseReference.'|'. $value->itemSurveyed.'|'. $value->doi.'|'. $value->policyLoss_date.'|'. $value->policy_no.'|'. $value->inv_no.'|'. $value->cargo.'|'. $value->lossLiability.'|'. $value->couseof_loss.'|'. $value->dos.'|'. $value->survey_pending.'|'. $value->usercode.'|'. $value->intimation_id.'|'.$value->case_surveyedby.'|'. $value->status.'|'. $value->created_at.'|'. $value->subject.'|'. $value->active.'|'. $value->insured_address.'|'.$value->place_address.'|'. $value->place_email.'|'.$value->last_status.'|'.$value->update_dispatch_mode.'|'. $value->update_dispatch_date.'|'.$value->update_dispatch_value.'|'. $value->appointment_by.'|'. $value->appointment_by_info.'|'. $value->survey_firm.'|'. $value->survey_firm_info.'|'. $value->place_of_survey.'|'.$value->place_of_survey_info.'|'. $value->insured.'|'. $value->insured_info.'|'. $value->insured_mob_one.'|'.$value->policy_by.'|'.$value->policy_by_info.'|'.$value->payment_by.'|'. $value->payment_by_info.'|'. $value->brokar.'|'. $value->brokar_info;


       $data = array(
							'case_id' => $value->case_id,
							'insured' => $value->insured.'|'. $value->insured_info,
							'surveyor_name' => $value->surveyor_name,
							'brokar' =>  $value->brokar.'|'. $value->brokar_info,
							'payment_by' =>$value->payment_by.'|'. $value->payment_by_info,
							'appointment_by' => $value->appointment_by.'|'. $value->appointment_by_info,
							'policy_by' =>$value->policy_by.'|'.$value->policy_by_info,
							'place_of_survey'=>$value->place_of_survey.'|'.$value->place_of_survey_info,
							'status' => $value->status,
							'search_query' => $value->os_name.'|'.$url, 
							'type_of_survey' => $value->type_of_survey, 
					);

			$ci->db->where('case_id', $value->case_id);
			$url_num= $ci->db->get('url');

			if($url_num->num_rows() > 0)
			{ 
				$ci->db->where('case_id',  $value->case_id);
				 $ci->db->update('url',$data);
			}else{
				$ci->db->insert('url',$data);
			}
        break;
}
	    return true;
	

}

function urlupdate_old($case_id){
	    $ci =& get_instance();

		$ess = $ci->db->query("SELECT e.*, `c`.`last_status`, `c`.`casestatusvalue`, `os`.`name`, (SELECT COUNT(*) FROM `docs_file` df WHERE df.reference_no=e.reference_no) as document,  (SELECT SUM(less_amount) FROM `survey_payment` sp WHERE sp.case_id=e.case_id) as syrveyFeeLess,  (SELECT SUM(add_amount) FROM `survey_payment` sp WHERE sp.case_id=e.case_id) as syrveyFeeAdd  FROM essential_data e LEFT JOIN `case_os` os ON `e`.`reference_no` = `os`.`agrn`  LEFT JOIN `case_management` c ON `e`.`reference_no` = `c`.`reference_no` LEFT JOIN `url` u ON `e`.`case_id` = `u`.`case_id` WHERE  `e`.`case_id`=" . "'" .$case_id."' ")->result_array();

		if ($ess) {

			if($ess[0]['payment_by']!=''){
				$Pay_num = $ci->db->where('Vendor_Code', $ess[0]['payment_by'])->get('vendor');
				$Pay= $Pay_num->result();
				if($Pay_num->num_rows() > 0)
				{ 
				$payment_by_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
				}else
				{
				$payment_by_val="";
				}
			}else
				{
				$payment_by_val="";
				}

			if($ess[0]['insured']!=''){
				$Pay_num= $ci->db->where('Vendor_Code', $ess[0]['insured'])->get('vendor');
				$Pay= $Pay_num->result();
				if($Pay_num->num_rows() > 0)
				{ 
				$insured_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
				}else
				{
				$insured_val="";
				}
			}else
				{
				$insured_val="";
				}

			if($ess[0]['surveyor_name']!=''){ 
				$Pay_num= $ci->db->where('Vendor_Code', $ess[0]['surveyor_name'])->get('vendor');
				$Pay= $Pay_num->result();
				if($Pay_num->num_rows() > 0)
				{ 
				$Place_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
				}else
				{
				$HandlerName = $ci->db->query("SELECT user_name FROM `s_users` WHERE user_id='".$ess[0]['surveyor_name']."' ");
				$HandlerName = $HandlerName->result_array();
				if (!empty($HandlerName)) {  $Place_val = $HandlerName[0]['user_name']; }
				else{  $Place_val = "";   }
				}
			}else{  $Place_val = "";   }
				

			if($ess[0]['brokar']!=''){
				$Pay_num= $ci->db->where('Vendor_Code', $ess[0]['brokar'])->get('vendor');
				$Pay= $Pay_num->result();
				if($Pay_num->num_rows() > 0)
				{ 
				$brokar_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
				}else
				{
				$brokar_val="";
				}
			}else
				{
				$brokar_val="";
				}

			if($ess[0]['appointment_by']!=''){
				$Pay_num=  $ci->db->where('Vendor_Code', $ess[0]['appointment_by'])->get('vendor');
				$Pay= $Pay_num->result();
				if($Pay_num->num_rows() > 0)
				{ 
				$appointment_by_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
				}else
				{
				$appointment_by_val="";
				}
			}else
				{
				$appointment_by_val="";
				}

			   if($ess[0]['policy_by']!=''){
				$ci->db->where('Vendor_Code', $ess[0]['policy_by']);
				$Pay_num= $ci->db->get('vendor');
				$Pay= $Pay_num->result();
			    if($Pay_num->num_rows() > 0)
			    { 
			  		  $policy_by_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
			    }else
			        {
			          $policy_by_val="";
			        }
			}else
			        {
			          $policy_by_val="";
			        }

	       if($ess[0]['place_of_survey']!=''){
				$ci->db->where('Vendor_Code', $ess[0]['place_of_survey']);
				$Pay_num= $ci->db->get('vendor');
				$Pay= $Pay_num->result();
			    if($Pay_num->num_rows() > 0)
			    { 
			  		  $place_of_survey_val=$Pay[0]->Vendor_Name.", ".$Pay[0]->City;
			    }else
			        {
			          $place_of_survey_val="";
			        }
			}else
			        {
			          $place_of_survey_val="";
			        }




			$status=$ess[0]['last_status'];//end(unserialize($ess[0]['casestatus']));
			$sfees=$ess[0]['syrveyFeeAdd']-$ess[0]['syrveyFeeLess'];

            $url= $ess[0]['ref_surveyor']."|".$ess[0]['insured']." ".$insured_val.'|'.$ess[0]['policy_by']." ".$policy_by_val.'|'.$ess[0]['surveyor_name']." ".$Place_val.'|'. $ess[0]['brokar']." ".$brokar_val.'|'.$ess[0]['payment_by']." ".$payment_by_val.'|'.$ess[0]['appointment_by']." ".$appointment_by_val.'|'.$ess[0]['name']."|".$ess[0]['survey_type_option'].'|'.$sfees.'|'.$ess[0]['contact_person'].'|'.$ess[0]['policyLoss_date'].'|'.$ess[0]['policy_no'].'|'.$ess[0]['place_of_survey']." ".$place_of_survey_val.'|'.$ess[0]['doi'].'|'.$ess[0]['dos'].'|'.$ess[0]['vehicleNumber'].'|'. $ess[0]['caseReference'].'|'. $ess[0]['inv_no'].'|'.$ess[0]['itemSurveyed']."|".$status;

			$data = array(
							'case_id' => $case_id,
							'insured' => $ess[0]['insured']." ".$insured_val,
							'surveyor_name' => $ess[0]['surveyor_name']." ".$Place_val,
							'brokar' => $ess[0]['brokar']." ".$brokar_val,
							'payment_by' => $ess[0]['payment_by']." ".$payment_by_val,
							'appointment_by' =>$ess[0]['appointment_by']." ".$appointment_by_val,
							'policy_by' => $ess[0]['policy_by']." ".$policy_by_val,
							'place_of_survey'=>$ess[0]['place_of_survey']." ".$place_of_survey_val,
							'status' => $status,
							'search_query' => $url, 
							'type_of_survey' => $ess[0]['type_of_survey'], 
					);

			$ci->db->where('case_id',$case_id);
			$url_num= $ci->db->get('url');

			if($url_num->num_rows() > 0)
			{ 
				$ci->db->where('case_id',$ess[0]['case_id']);
				 $ci->db->update('url',$data);
			}else{
				$ci->db->insert('url',$data);
			}
		}
    return true;

//exit;print_r($data);

}

function numberTowords(float $number)
{
  $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . ' ' : '') . $paise;

}

function sendotp($otp,$mob) {
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://2factor.in/API/V1/e05e2067-06ec-11eb-9fa5-0200cd936042/SMS/".$mob."/".$otp."/Claimsmitra+Phone+Verification",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	//echo "cURL Error #:" . $err;
	return false;
	} else {
	//echo $response;
	return true;
	}
	


				// $curl = curl_init();

				// curl_setopt_array($curl, array(
				// CURLOPT_URL => "https://2factor.in/API/V1/e05e2067-06ec-11eb-9fa5-0200cd936042/SMS/".$mob."/".$otp."/Claimsmitra Phone Verification",
				// CURLOPT_RETURNTRANSFER => true,
				// CURLOPT_ENCODING => '',
				// CURLOPT_MAXREDIRS => 10,
				// CURLOPT_TIMEOUT => 0,
				// CURLOPT_FOLLOWLOCATION => true,
				// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// CURLOPT_CUSTOMREQUEST => 'GET',
				// ));


	





				// curl_setopt_array($curl, array(
				// CURLOPT_URL => "https://2factor.in/API/V1/e05e2067-06ec-11eb-9fa5-0200cd936042/SMS/".$mob."/".$otp."/Adwiti Technocrats Pvt Ltd",
				// CURLOPT_RETURNTRANSFER => true,
				// CURLOPT_ENCODING => "",
				// CURLOPT_MAXREDIRS => 10,
				// CURLOPT_TIMEOUT => 30,
				// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// CURLOPT_CUSTOMREQUEST => "GET",
				// CURLOPT_POSTFIELDS => "",
				// CURLOPT_HTTPHEADER => array(
				// "content-type: application/x-www-form-urlencoded"
				// ),
				// ));
			// $response = curl_exec($curl);
			// $err = curl_error($curl);
			// curl_close($curl);
			

}




function permession(){
   	$ci = & get_instance();		
   	if($ci->session->userdata('s_u_usertype') =='Surveyor-user'){ 
         $permision = $ci->db->query("SELECT * FROM `users_permission` WHERE vendor_code='".$ci->session->userdata('s_u_vendorcode')."' ")->result();
 		  }else{
          $permision = $ci->db->query("SELECT * FROM `users_permission` WHERE vendor_code='".$ci->session->userdata('s_vendorcode')."' ")->result();
    }
    return $permision;
}

function get_caseInfo($case_info){

	$output = '';
	if(!empty($case_info[0]->insured_code)){ 

		$xyz= $case_info[0]->insured_code .' / '. $case_info[0]->insured_OfficeType .' / '. $case_info[0]->insured_Name.' / '. $case_info[0]->insured_address ; 
	} else{ $xyz= $case_info[0]->insured;	} 

	if(!empty($case_info[0]->doi)){ 
	$date=date_create($case_info[0]->doi);
	$xyz_doi= date_format($date,"d/m/Y");
	}else{$xyz_doi="";}

	 if(!empty($case_info[0]->dos)){ 
	 	$xyz_dos= $case_info[0]->dos;  
	 		}else{$xyz_dos="";}

			 $type_of_survey=$case_info[0]->type_of_survey;

           if(!empty($case_info[0]->ref_surveyor)){
           	$ref_surveyor = $case_info[0]->ref_surveyor;
           	}else{
           		$ref_surveyor =  "Null";
           	} 

      	$output .=  '
      			<div class="row"> 
                    <div class="col-md-12">
                      <div class="card border border-info">
                        <div class="card" style="padding: 0.529rem;margin-bottom: 0px;">
                           <h5 class="card-title">
                             <div class ="row">
                             	 <div class="col-md-6 "> <span>AGRN:'.$case_info[0]->reference_no.'  </span></div>
                             	 <div class="col-md-6 text-right">Your Reference:'.$case_info[0]->ref_surveyor.'</div>
                             </div>
                           </h5>

                           	<div class="row"  id="case_detail"> 
                                  <div class="col-md-4"> <span><strong>Insured:</strong> '.$xyz.'
                                  
                                   	</span>
                                  </div>';
                                  if($case_info[0]->appointment_code){  
                                  	$output .=  '<div class="col-md-4"> <span><strong>Insurer:</strong>  '. $case_info[0]->appointment_code.' / '. $case_info[0]->appointment_officetype .'/ '. $case_info[0]->appointment_name.' / '. $case_info[0]->appointment_address .'</span>
                                  </div>';
                                   } if($case_info[0]->survey_firm){ 
                                 	$output .=  ' <div class="col-md-4"> <span><strong>Surveyor:</strong>  '. $case_info[0]->survey_firm .' / '. $case_info[0]->surveyor_name .'</span> 
                                  </div>';
                                   } if($case_info[0]->doi){
                                 	$output .=  ' <div class="col-md-4"> <span><strong>Imp. Date:</strong> DOI: '.$xyz_doi.'  / DOS:  '.$xyz_dos.'</span>
                                  </div>';
                                   } 

                                   if($type_of_survey){ 
                                 	$output .=  '<div class="col-md-4"> <span><strong>Survey Type:</strong>'. $type_of_survey .' / '. $case_info[0]->survey_type_option .'</span>
                                  </div>';
                                  } 

                                  if($case_info[0]->place_of_survey){ 
                                  	$output .=  '<div class="col-md-4"> <span><strong>Place Of Survey:</strong> '. $case_info[0]->place_of_survey .'</span>
                                  </div>';
                                   } 

                                 if($type_of_survey ==2){ 
                                  	$output .=  ' <div class="col-md-4"><span><strong>Inv No./ GR No. :</strong>'. $case_info[0]->caseReference.' / '. $case_info[0]->inv_no.'</span></div> ';
                                  } 

                                  if(!empty($case_info[0]->subject)){ 
                                	$output .=  ' <div class="col-md-10">
	                                  <strong>Subject :</strong> '.$case_info[0]->subject.'
	                                 </div>';
	                              }
	                              // if($case_info[0]->last_status == 'Report dispatched'){
                              // 	$output .= '<div class ="col-md-2">
                              //    <span class="badge badge-primary"> '.$case_info[0]->last_status.' </span>
                              // 	</div>';
                              // }
                              if($case_info[0]->last_status == 'Under Survey'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge  bg-dark"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                              if($case_info[0]->last_status == 'Survey Done'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge badge-success"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                              if($case_info[0]->last_status == 'LOR Issued / Dox Pending'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge badge-warning"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                              if($case_info[0]->last_status == 'Report Prepared'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge  bg-warning"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                               if($case_info[0]->last_status == 'Report dispatched' OR $case_info[0]->last_status == 'Dispatch By Hand' OR $case_info[0]->last_status == 'Dispatch By Post'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge badge-primary"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                               if($case_info[0]->last_status == 'Survey Fee Pending'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge badge-danger"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                              if($case_info[0]->last_status == 'Case Completed'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge badge-default"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }
                              if($case_info[0]->last_status == 'Case Cancelled'){
                              	$output .= '<div class ="col-md-2">
                                 <span class="badge badge-dark"> '.$case_info[0]->last_status.' </span>
                              	</div>';
                              }



                          	$output .=  '</div>

                        
                        </div>  
                    </div>
                    </div>
      			</div>';


     return $output;
         
}



?>
     

