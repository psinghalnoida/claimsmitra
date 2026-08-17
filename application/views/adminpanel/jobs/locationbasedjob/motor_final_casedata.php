<div class="panel" id="caseForm">
    <form id="motor_final_casedata" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">CASE DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end"> 
                   <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>            
                    <a href="<?php echo base_url('generatepdf/'.$aid.'/' . $companyid); ?>" target="_blank" style="display: <?php echo isset($reportdata) ? "block" : "none"; ?>;"  class="btn case_btn">Generate Report</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Report" data-toggle="modal" href="javascript:void(0)" id="report_images" style="padding-right: 5px; margin-right:8px;">Report Images  <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="insured_address" style="color:black">Address of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_address) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->insured_address) ? $reportdata->insured_address : ""; ?>" id="insured_address" name="insured_address" placeholder="Address of Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="gst_no" style="color:black">GST /No. of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->gst_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->gst_no) ? $reportdata->gst_no : ""; ?>" id="gst_no" name="gst_no" placeholder="GST /No. of Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="registered_owner" style="color:black">Registered Owner &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->registered_owner) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->registered_owner) ? $reportdata->registered_owner : ""; ?>" name="registered_owner" id="registered_owner" placeholder="Registered Owner">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="financers" style="color:black">Financers (if any) &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->financers) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->financers) ? $reportdata->financers : ""; ?>" id="financers" name="financers" placeholder="Financers">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="appointed_by" style="color:black">Appointed by </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->appointed_by) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->appointed_by) ? $reportdata->appointed_by : ""; ?>" id="appointed_by" name="appointed_by" placeholder="Appointed by">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="registration_date" style="color:black">Date of Registration &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field registration_date" <?php echo isset($reportdata->registration_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->registration_date) ? $reportdata->registration_date : ""; ?>" id="registration_date" name="registration_date" placeholder="Date of Registration">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="chasis_no" style="color:black">Chasis No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->chasis_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->chasis_no) ? $reportdata->chasis_no : ""; ?>" name="chasis_no" id="chasis_no" placeholder="Chasis No.">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="engine_no" style="color:black">Engine No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->engine_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->engine_no) ? $reportdata->engine_no : ""; ?>" id="engine_no" name="engine_no" placeholder="Engine No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="physically_verified" style="color:black">Physically Verified &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->physically_verified) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->physically_verified) ? $reportdata->physically_verified : ""; ?>" id="physically_verified" name="physically_verified" placeholder="Physically Verified">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="body_type" style="color:black">Type of Body &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->body_type) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->body_type) ? $reportdata->body_type : ""; ?>" name="body_type" id="body_type" placeholder="Type of Body">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="tax_paid" style="color:black">Tax Paid Up To &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->tax_paid) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->tax_paid) ? $reportdata->tax_paid : ""; ?>" id="tax_paid" name="tax_paid" placeholder="Tax Paid Up To">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="vehicle_class" style="color:black">Class of Vehicle &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="vehicle_class" name="vehicle_class" required <?php echo isset($reportdata->vehicle_classText) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="motor_car" <?php echo ($reportdata->vehicle_classText ?? '') == 'motor_car' ? 'selected' : ''; ?>>Motor Car</option>
                            <option value="motor_cab" <?php echo ($reportdata->vehicle_classText ?? '') == 'motor_cab' ? 'selected' : ''; ?>>Motor Cab</option>
                            <option value="Tractor" <?php echo ($reportdata->vehicle_classText ?? '') == 'Tractor' ? 'selected' : ''; ?>>Tractor</option>
                            <option value="motor_cycle" <?php echo ($reportdata->vehicle_classText ?? '') == 'motor_cycle' ? 'selected' : ''; ?>>Motor Cycle</option>
                            <option value="construction_equipment" <?php echo ($reportdata->vehicle_classText ?? '') == 'construction_equipment' ? 'selected' : ''; ?>>Construction Equipment</option>
                             <option value="goods_carrier" <?php echo ($reportdata->vehicle_classText ?? '') == 'goods_carrier' ? 'selected' : ''; ?>>Goods and Carrier</option>
                            <option value="Bus" <?php echo ($reportdata->vehicle_classText ?? '') == 'Bus' ? 'selected' : ''; ?>>Bus</option>
                            <option value="Others" <?php echo ($reportdata->vehicle_classText ?? '') == 'Others' ? 'selected' : ''; ?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="ulw" style="color:black">ULW&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ulw) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ulw) ? $reportdata->ulw : ""; ?>" name="ulw" id="ulw" placeholder="ULW">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="rlw" style="color:black">RLW &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->rlw) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->rlw) ? $reportdata->rlw : ""; ?>" id="rlw" name="rlw" placeholder="Tax Paid Up To">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="carrying_capacity" style="color:black">Carrying Capacity &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->carrying_capacity) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->carrying_capacity) ? $reportdata->carrying_capacity : ""; ?>" id="carrying_capacity" name="carrying_capacity" placeholder="Carrying Capacity">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="pre_acccident" style="color:black">Pre Accident Condition &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pre_acccident) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->pre_acccident) ? $reportdata->pre_acccident : ""; ?>" name="pre_acccident" id="pre_acccident" placeholder="Pre Accident Condition">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="fitness_certificate_no" style="color:black">Fitness Certificate No &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->fitness_certificate_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->fitness_certificate_no) ? $reportdata->fitness_certificate_no : ""; ?>" id="fitness_certificate_no" name="fitness_certificate_no" placeholder="Fitness Certificate No ">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="valid_up_to" style="color:black">Valid up to &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field valid_up_to" <?php echo isset($reportdata->valid_up_to) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->valid_up_to) ? $reportdata->valid_up_to : ""; ?>" id="valid_up_to" name="valid_up_to" placeholder="Valid up to">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="permit_no" style="color:black">Permit No &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->permit_no) ? $reportdata->permit_no : ""; ?>" name="permit_no" id="permit_no" placeholder="Permit No">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="permit_validityfrom" style="color:black">Permit No. (From) </label>
                        <input type="text" class="form-control case-field permit_validity" <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->permit_validityfrom) ? $reportdata->permit_validityfrom : ""; ?>" id="permit_validityfrom" name="permit_validityfrom" placeholder="From">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="permit_validity" style="color:black">Permit No. Valid up to &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field permit_validity" <?php echo isset($reportdata->permit_validity) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->permit_validity) ? $reportdata->permit_validity : ""; ?>" id="permit_validity" name="permit_validity" placeholder="To">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="permit_type" style="color:black">Type of Permit &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_type) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->permit_type) ? $reportdata->permit_type : ""; ?>" id="permit_type" name="permit_type" placeholder="Type of Permit">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="area_of_operation" style="color:black">Route / Area of operation &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->area_of_operation) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->area_of_operation) ? $reportdata->area_of_operation : ""; ?>" name="area_of_operation" id="area_of_operation" placeholder="Route / Area of operation">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="whether_valid" style="color:black">Whether valid for the state in which the accident took place? &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->whether_valid) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->whether_valid) ? $reportdata->whether_valid : ""; ?>" id="whether_valid" name="whether_valid" placeholder="whether valid for the state in which the accident took place">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="goods_tax" style="color:black">Goods/Passenger Tax &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="goods_tax" name="goods_tax" required <?php echo isset($reportdata->goods_tax) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->goods_tax ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="NO" <?php echo ($reportdata->goods_tax ?? '') == 'NO' ? 'selected' : ''; ?>>NO</option>
                            <option value="NA" <?php echo ($reportdata->goods_tax ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            <option value="yes_from_rto_site" <?php echo ($reportdata->goods_tax ?? '') == 'yes_from_rto_site' ? 'selected' : ''; ?>>Yes From RTO site</option>
                        </select>                 
                       </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="rc" style="color:black">RC &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="rc" name="rc" required <?php echo isset($reportdata->rc) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->rc ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="NO" <?php echo ($reportdata->rc ?? '') == 'NO' ? 'selected' : ''; ?>>NO</option>
                            <option value="NA" <?php echo ($reportdata->rc ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            <option value="yes_from_rto_site" <?php echo ($reportdata->rc ?? '') == 'yes_from_rto_site' ? 'selected' : ''; ?>>Yes From RTO site</option>
                        </select>                    
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="fitness" style="color:black">Fitness &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="fitness" name="fitness" required <?php echo isset($reportdata->fitness) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->fitness ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="NO" <?php echo ($reportdata->fitness ?? '') == 'NO' ? 'selected' : ''; ?>>NO</option>
                            <option value="NA" <?php echo ($reportdata->fitness ?? '') == 'NA' ? 'selected' : ''; ?>>Na</option>
                            <option value="yes_from_rto_site" <?php echo ($reportdata->fitness ?? '') == 'yes_from_rto_site' ? 'selected' : ''; ?>>Yes From RTO site</option>
                        </select>                     
                     </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="permit" style="color:black">Permit &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="permit" name="permit" required <?php echo isset($reportdata->permit) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->permit ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="NO" <?php echo ($reportdata->permit ?? '') == 'NO' ? 'selected' : ''; ?>>NO</option>
                            <option value="NA" <?php echo ($reportdata->permit ?? '') == 'NA' ? 'selected' : ''; ?>>Na</option>
                            <option value="yes_from_rto_site" <?php echo ($reportdata->permit ?? '') == 'yes_from_rto_site' ? 'selected' : ''; ?>>Yes From RTO site</option>
                        </select>                     
                     </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="fitness_date" style="color:black">Date of issue &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field fitness_date" <?php echo isset($reportdata->fitness_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->fitness_date) ? $reportdata->fitness_date : ""; ?>" id="fitness_date" name="fitness_date" placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="date_of_birth" style="color:black">Date of birth &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field date_of_birth" <?php echo isset($reportdata->date_of_birth) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->date_of_birth) ? $reportdata->date_of_birth : ""; ?>" name="date_of_birth" id="date_of_birth" placeholder="Date of birth">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="docs_validity" style="color:black">Valid up to: &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field docs_validity" <?php echo isset($reportdata->docs_validity) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->docs_validity) ? $reportdata->docs_validity : ""; ?>" id="docs_validity" name="docs_validity" placeholder="Valid up to">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="issuing_authority" style="color:black">Issuing Authority &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->issuing_authority) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->issuing_authority) ? $reportdata->issuing_authority : ""; ?>" id="issuing_authority" name="issuing_authority" placeholder="Issuing Authority">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="license_type" style="color:black">Type of License &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->license_type) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->license_type) ? $reportdata->license_type : ""; ?>" name="license_type" id="license_type" placeholder="Type of License">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="type_of_vehicle_allowed" style="color:black">Type of vehicle allowed to drive &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->type_of_vehicle_allowed) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->type_of_vehicle_allowed) ? $reportdata->type_of_vehicle_allowed : ""; ?>" id="type_of_vehicle_allowed" name="type_of_vehicle_allowed" placeholder="Type of vehicle allowed to drive">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="verified_driving_license" style="color:black">Driving License Verified &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->verified_driving_license) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->verified_driving_license) ? $reportdata->verified_driving_license : ""; ?>" id="verified_driving_license" name="verified_driving_license" placeholder="Driving License Verified">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="ebdst" style="color:black">Ebdst. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ebdst) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ebdst) ? $reportdata->ebdst : ""; ?>" name="ebdst" id="ebdst" placeholder="Ebdst">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="badge_no" style="color:black">Badge No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->badge_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->badge_no) ? $reportdata->badge_no : ""; ?>" id="badge_no" name="badge_no" placeholder="Badge No">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="repairers_address" style="color:black">Repairers address &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->repairers_address) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->repairers_address) ? $reportdata->repairers_address : ""; ?>" id="repairers_address" name="repairers_address" placeholder="Repairers address">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_rep_attending_survey" style="color:black">Insured's rep. attending survey &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_rep_attending_survey) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->insured_rep_attending_survey) ? $reportdata->insured_rep_attending_survey : ""; ?>" name="insured_rep_attending_survey" id="insured_rep_attending_survey" placeholder="Insured's rep. attending survey">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="has_accidenty" style="color:black">Has accidenty been reported to police &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->has_accidenty) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->has_accidenty) ? $reportdata->has_accidenty : ""; ?>" id="has_accidenty" name="has_accidenty" placeholder="Has accidenty been reported to police">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="if_yes" style="color:black">If Yes, FIR/DD No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->if_yes) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->if_yes) ? $reportdata->if_yes : ""; ?>" id="if_yes" name="if_yes" placeholder="If Yes, FIR/DD No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="claim_no" style="color:black">Claim No </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->claim_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->claim_no) ? $reportdata->claim_no : ""; ?>" id="claim_no" name="claim_no" placeholder="Claim Number">
                    </div>
                </div>
               
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="cause_nature_accident" style="color:black">Cause and nature of accident &nbsp;<span style="color:red">*</span></label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->cause_nature_accident) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->cause_nature_accident) ? $reportdata->cause_nature_accident : ""; ?>" id="cause_nature_accident" name="cause_nature_accident" ><?php echo isset($reportdata->cause_nature_accident) ? htmlspecialchars($reportdata->cause_nature_accident) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="loan_challan" style="color:black">Loan Challan &nbsp;<span style="color:red">*</span></label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->loan_challan) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->loan_challan) ? $reportdata->loan_challan : ""; ?>" id="loan_challan" name="loan_challan" ><?php echo isset($reportdata->loan_challan) ? htmlspecialchars($reportdata->loan_challan) : ""; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="spot_survey" style="color:black">Spot Survey &nbsp;<span style="color:red">*</span></label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->spot_survey) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->spot_survey) ? $reportdata->spot_survey : ""; ?>" id="spot_survey" name="spot_survey" ><?php echo isset($reportdata->spot_survey) ? htmlspecialchars($reportdata->spot_survey) : ""; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="third_party_particulars" style="color:black">Third Party Particulars &nbsp;<span style="color:red">*</span></label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->third_party_particulars) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->third_party_particulars) ? $reportdata->third_party_particulars : ""; ?>" id="third_party_particulars" name="third_party_particulars" ><?php echo isset($reportdata->spot_survey) ? htmlspecialchars($reportdata->spot_survey) : ""; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="particulars_loss_damage" style="color:black">Particulars of loss/Damage </label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->particulars_loss_damage) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->particulars_loss_damage) ? $reportdata->particulars_loss_damage : ""; ?>" id="particulars_loss_damage" name="particulars_loss_damage" ><?php echo isset($reportdata->particulars_loss_damage) ? htmlspecialchars($reportdata->particulars_loss_damage) : ""; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="cause_of_accident" style="color:black">The Damage were fresh in nature and were correlating to the cause of accident&nbsp;<span style="color:red">*</span></label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->cause_of_accident) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->cause_of_accident) ? $reportdata->cause_of_accident : ""; ?>" id="cause_of_accident" name="cause_of_accident" ><?php echo isset($reportdata->cause_of_accident) ? htmlspecialchars($reportdata->cause_of_accident) : ""; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="remarks" style="color:black">Remarks</label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->remarks) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->remarks) ? $reportdata->remarks : ""; ?>" id="remarks" name="remarks" ><?php echo isset($reportdata->remarks) ? htmlspecialchars($reportdata->remarks) : ""; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button" id="motor_final_case_submit">
            </div>
        </div>
    </form>
</div>