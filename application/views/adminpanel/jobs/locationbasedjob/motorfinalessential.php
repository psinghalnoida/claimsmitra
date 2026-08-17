<div class="panel pb-4">
    <form id="motor_final_essential_data" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" id="generate_assessment" style="padding-right: 5px; color: white; margin-right:8px;">Create Assessment</a>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_status/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Status Report</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <?php
                        // Check if template is used
                        if (!empty($template_essentialdata)) {
                            $salutation = $template_essentialdata->salutation ?? '';
                        } else {
                            $salutation = $essentialdata->salutation ?? $jobdata->salutation ?? '';
                        }
                        ?>
                        <select class="form-control salutation editable-field" id="salutation" name="salutation" <?php echo isset($essentialdata->salutation) ? "disabled" : ""; ?>>
                            <option value="">Select Salutation</option>
                            <option value="Mr" <?= ($salutation == 'Mr') ? 'selected' : ''; ?>>Mr.</option>
                            <option value="Ms" <?= ($salutation == 'Ms') ? 'selected' : ''; ?>>Ms.</option>
                            <option value="Mrs" <?= ($salutation == 'Mrs') ? 'selected' : ''; ?>>Mrs.</option>
                            <option value="Other" <?= ($salutation == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_name" style="color:black">Contact Person Name<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name) ? $essentialdata->contact_person_name : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile) ? $essentialdata->contact_person_mobile : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) ? $essentialdata->case_reference : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="period_of_insurance" style="color: black;">Period of Insurance (From) &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field insurancefrom" <?php echo isset($essentialdata->insurancefrom) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insurancefrom) ? $essentialdata->insurancefrom : ""; ?>" name="insurancefrom" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <input type="text" class="form-control editable-field insurancefromtime mt-4" <?php echo isset($essentialdata->insurancefromtime) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insurancefromtime) ? $essentialdata->insurancefromtime : ""; ?>" name="insurancefromtime" placeholder="Select Time" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="period_of_insurance" style="color: black;">Period of Insurance (To)</label>
                        <input type="text" class="form-control editable-field insuranceto " <?php echo isset($essentialdata->insuranceto) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insuranceto) ? $essentialdata->insuranceto : ""; ?>" name="insuranceto" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="period_of_insurance" style="color: black;"></label>
                        <input type="text" class="form-control editable-field insurancetotime mt-4" <?php echo isset($essentialdata->insurancetotime) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insurancetotime) ? $essentialdata->insurancetotime : ""; ?>" name="insurancetotime" placeholder="Select time" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color: black;">
                            Insured / Client &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field insured_name"
                                <?php echo isset($essentialdata->insured_name) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name) ? $essentialdata->insured_name : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>"
                                id="insured_name" name="insured_name" placeholder="Insured Name" required>
                            <div class="input-group-append venor-btn">
                                <a data-toggle="modal" data-target="#vendorModal" data-modal-type="insured_name"
                                    class="btn btn-rounded btn-info venorbtn <?php echo isset($essentialdata->insured_name) ? 'disabled' : ''; ?>"
                                    href="#" style="padding: 10px 12px;">
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policyNumber" style="color: black;">Policy number &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber) ? $essentialdata->policyNumber : (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" id="policyNumber" name="policyNumber" placeholder="Policy number" required>
                    </div>
                </div>


                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="claim_no" style="color: black;">Claim Number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claim_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->claim_no) && !empty($essentialdata->claim_no) ? $essentialdata->claim_no : (isset($jobdata->claim_no) ? $jobdata->claim_no : ""); ?>" id="claim_no" name="claim_no" placeholder="Claim Number" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="vehicle_number" style="color: black;">Vehicle Number &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claim_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->vehicle_number) && !empty($essentialdata->vehicle_number) ? $essentialdata->vehicle_number : (isset($jobdata->vehicle_number) ? $jobdata->vehicle_number : ""); ?>" id="vehicle_number" name="vehicle_number" placeholder="Vehicle Number" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black">Sum Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->sum_insured) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->sum_insured) ? $essentialdata->sum_insured : ""; ?>" value="" name="sum_insured" id="sum_insured" placeholder="Sum Insured" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cause_loss" style="color:black">Cause of loss &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->cause_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->cause_loss) && !empty($essentialdata->cause_loss) ? $essentialdata->cause_loss : (isset($jobdata->cause_loss) ? $jobdata->cause_loss : ""); ?>" name="cause_loss" placeholder="Cause of loss" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="make_model" style="color:black">Make /Model &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->make_model) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->make_model) ? $essentialdata->make_model : ""; ?>" name="make_model" id="make_model" placeholder="Make /Model" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="name_of_driver" style="color:black">Name of Driver &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->name_of_driver) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->name_of_driver) ? $essentialdata->name_of_driver : ""; ?>" value="" name="name_of_driver" id="name_of_driver" placeholder="Name of Driver" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="driving_license_no" style="color:black">Driving License No. &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->driving_license_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->driving_license_no) ? $essentialdata->driving_license_no : ""; ?>" value="" name="driving_license_no" id="driving_license_no" placeholder="Driving License No" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="place_of_accident" style="color: black;">Place of accident &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->place_of_accident) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->place_of_accident) ? $essentialdata->place_of_accident : ""; ?>" id="place_of_accident" name="place_of_accident" required placeholder="Place of accident">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="date_of_incident" style="color: black;">Date of Accident &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control editable-field date_of_incident" <?php echo isset($essentialdata->date_of_incident) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_incident) ? $essentialdata->date_of_incident : ""; ?>" id="date_of_incident" name="date_of_incident" required placeholder="Date of Accident">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="time_of_incident" style="color: black;">Time of Accident &nbsp; <span style="color:red">*</span> </label>
                        <input type="time" class="form-control editable-field " <?php echo isset($essentialdata->time_of_incident) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->time_of_incident) ? $essentialdata->time_of_incident : ""; ?>" id name="time_of_incident" placeholder="Time of Accident">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_allotment_date" style="color: black;">Date of allotment of survey &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control editable-field survey_allotment_date" <?php echo isset($essentialdata->survey_allotment_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_allotment_date) ? $essentialdata->survey_allotment_date : ""; ?>" id="survey_allotment_date" name="survey_allotment_date" required placeholder="Date of allotment of survey">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_date" style="color:black">Select Survey Date &nbsp;<span style="color:red">* </label>
                        <input type="text" class="form-control editable-field survey_date" <?php echo isset($essentialdata->survey_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_date) ? $essentialdata->survey_date : ""; ?>" name="survey_date" id="select_survey_date" required placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Place of survey &nbsp;<span style="color:red">* </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->survey_place) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_place) ? $essentialdata->survey_place : ""; ?>" id="survey_place" name="survey_place" required placeholder="Place of survey">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="place_of_repairer" style="color:black">Place of repair / will be repaired &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->place_of_repairer) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->place_of_repairer) ? $essentialdata->place_of_repairer : ""; ?>" id="place_of_repairer" placeholder="Repairers address" name="place_of_repairer" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="estimated_loss" style="color:black">Estimated Loss by Insured&nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->estimated_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->estimated_loss) ? $essentialdata->estimated_loss : ""; ?>" id="estimated_loss" placeholder="Estimated loss" name="estimated_loss" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="reported_tp_loss" style="color:black">Reported TP Loss &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->reported_tp_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->reported_tp_loss) ? $essentialdata->reported_tp_loss : ""; ?>" id="reported_tp_loss" placeholder="Reported TP Loss" name="reported_tp_loss" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="spot_survey_details" style="color:black">Spot Survey details required &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->spot_survey_details) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->spot_survey_details) ? $essentialdata->spot_survey_details : ""; ?>" id="spot_survey_details" placeholder="Spot survey details" name="spot_survey_details" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="expected_mode_settlement" style="color:black">Expected Mode of settlement &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->expected_mode_settlement) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->expected_mode_settlement) ? $essentialdata->expected_mode_settlement : ""; ?>" id="expected_mode_settlement" placeholder="Expected Mode of settlement" name="expected_mode_settlement" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="expected_insurer_liability" style="color:black">Expected insurer's Liability &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->expected_insurer_liability) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->expected_insurer_liability) ? $essentialdata->expected_insurer_liability : ""; ?>" id="expected_insurer_liability" placeholder="Expected insurer's Liability" name="expected_insurer_liability" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="documents_checked_original" style="color:black">Documents checked from original &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->documents_checked_original) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->documents_checked_original) ? $essentialdata->documents_checked_original : ""; ?>" id="documents_checked_original" placeholder="Documents checked from original" name="documents_checked_original" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="verification_from_rto" style="color:black">Documents attached for verification from RTO if required &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->verification_from_rto) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->verification_from_rto) ? $essentialdata->verification_from_rto : ""; ?>" id="verification_from_rto" placeholder="Documents attached for verification from RTO if required" name="verification_from_rto" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="no_of_photographs_attached" style="color:black">No. of photographs attached showing major damage &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->no_of_photographs_attached) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->no_of_photographs_attached) ? $essentialdata->no_of_photographs_attached : ""; ?>" id="no_of_photographs_attached" placeholder="No. of photographs attached showing major damage" name="no_of_photographs_attached" required>
                    </div>
                </div>

                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="any_fir" style="color:black">FIR, If Any </label>
                        <select class="form-control editable-field" <?php echo isset($essentialdata->any_fir) ? 'disabled' : ''; ?> name="any_fir" id="any_fir">
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->any_fir ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->any_fir ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($essentialdata->any_fir ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="any_pir" style="color:black">PIR</label>
                        <select class="form-control editable-field" <?php echo isset($essentialdata->any_pir) ? 'disabled' : ''; ?> name="any_pir" id="any_pir">
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->any_pir ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->any_pir ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($essentialdata->any_pir ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="verification_from_rto" style="color:black">Documents attached for verification from RTO if required &nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->verification_from_rto) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->verification_from_rto) ? $essentialdata->verification_from_rto : ""; ?>" id="verification_from_rto" placeholder="Documents attached for verification from RTO if required" name="verification_from_rto" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="badge_number" style="color:black">Badge Number</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->badge_number) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->badge_number) ? $essentialdata->badge_number : ""; ?>" id="badge_number" placeholder="Badge Number" name="badge_number">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="major_damaged_parts" style="color:black">Major Damaged parts with nature of damage &nbsp;<span style="color:red">* </span></label>
                        <textarea type="text" class="form-control editable-field" <?php echo isset($essentialdata->major_damaged_parts) ? "disabled" : ""; ?> id="major_damaged_parts" placeholder="" name="major_damaged_parts" required><?php echo isset($essentialdata->major_damaged_parts) ? htmlspecialchars($essentialdata->major_damaged_parts) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="special_observation_suggestion" style="color:black">Special observation & suggestion &nbsp;<span style="color:red">* </span></label>
                        <textarea type="text" class="form-control editable-field" <?php echo isset($essentialdata->special_observation_suggestion) ? "disabled" : ""; ?> id="special_observation_suggestion" placeholder="" name="special_observation_suggestion" required><?php echo isset($essentialdata->special_observation_suggestion) ? htmlspecialchars($essentialdata->special_observation_suggestion) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks</label>
                        <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> id="remark" placeholder="Remarks" name="remark"><?php echo isset($essentialdata->remark) ? htmlspecialchars($essentialdata->remark) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn toggle-edit" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="motor_final_submit">
            </div>
        </div>
    </form>
</div>

<div class="panel assessmentcard" id="assessmentcard" style="display: none;">
    <div class="col-xl-12">
        <div class="panel assessmentcard">
            <form id="finilize_assessment" method="post" enctype="multipart/form-data">
                <div class="panel-heading px-0">
                    <h3 class="panel-title">Assessment</h3>
                    <div class="dropdown">
                        <a id="addAssessmentRowBtn" class="btn case_btn" style="color:white;">Add Row</a>
                        <!-- <a href="javascript:void(0)" onclick="generateJsonFromTable()" class="btn btn-outline-secondary" data-toggle="modal">Finalize Assessment</a> -->
                        <a class="btn case_btn" type="submit" value="Finalize Assessment" id="finilize_btn" style="width:152px;color:white;">Finalize Assessment</a>
                    </div>
                </div>
                <div class="panel-body pt-0 assesmentcard px-0" style="line-height:8px; font-size:11px;">
                    <div class="table-responsive">
                        <input type="hidden" name="table_html" id="table_html">
                        <?php echo $assessment_table; ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel" id="finalize_panel" style="display:none;">
    <div class="col-xl-12">
        <div class="panel ">
            <form method="post" enctype="multipart/form-data">
                <div class="panel-heading px-0">
                    <h3 class="panel-title">Assessment</h3>
                    <div class="dropdown">
                        <a href="<?php echo base_url('assignment/generate_assessment/' . $aid); ?>" target="_blank" class="btn case_btn">Generate PDF</a>
                        <a href="<?php echo base_url('assignment/generatechecklist/' . $aid); ?>" target="_blank" class="btn case_btn">Generate Checklist</a>
                    </div>
                </div>
                <div class="panel-body pt-0  px-0" style="line-height:8px; font-size:11px;">
                    <div class="table-responsive" id="generateassessment"></div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="addAssessment" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:1px solid #e9ecef">
                <h5 class="modal-title">Add Assessment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php $this->load->view("adminpanel/jobs/locationbasedjob/assesmentform") ?>
        </div>
    </div>
</div>