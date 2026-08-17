<div class="panel mt-4" id="caseForm">
    <form id="motor_spot_casedata" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">CASE DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a href="<?php echo base_url('generatepdf/' . $aid . '/' . $companyid); ?>" target="_blank" class="btn case_btn">Generate Report</a>
                    <!-- <a href="<?php echo base_url('generatepdf/' . $aid . ''); ?>" target="_blank" class="btn case_btn">Generate Report</a> -->
                    <a class="btn case_btn open-modal" type="button" data-title="Report" data-toggle="modal" href="javascript:void(0)" id="report_images" style="padding-right: 5px; margin-right:8px;">Report Images <i class="fa-solid fa-upload"></i></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <label for="registration_date" style="color:black">
                        Date of Registration &nbsp;<span style="color:red">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control case-field register_date"
                            <?php echo isset($reportdata->registration_date) ? "disabled" : ""; ?>
                            value="<?php echo isset($reportdata->registration_date) ? $reportdata->registration_date : ""; ?>"
                            name="registration_date" placeholder="Date of Registration">

                        <div class="input-group-append disabledbtn  <?php echo isset($reportdata->registration_date) ? "disabled" : ""; ?>">
                            <span class="input-group-text register_datebtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size:15px; color:white;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="chasis_no" style="color:black">Chasis No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->chasis_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->chasis_no) ? $reportdata->chasis_no : ""; ?>" name="chasis_no" id="chasis_no" placeholder="Chasis No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="engine_no" style="color:black">Engine No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->engine_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->engine_no) ? $reportdata->engine_no : ""; ?>" id="engine_no" name="engine_no" placeholder="Engine No.">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="make_model" style="color:black">Make /Model &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->make_model) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->make_model) ? $reportdata->make_model : ""; ?>" name="make_model" id="make_model" placeholder="Make /Model" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="body_type" style="color:black">Type of Body &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->body_type) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->body_type) ? $reportdata->body_type : ""; ?>" name="body_type" id="body_type" placeholder="Type of Body">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="tax_paid" style="color:black">Tax Paid Up To &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->tax_paid) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->tax_paid) ? $reportdata->tax_paid : ""; ?>" id="tax_paid" name="tax_paid" placeholder="Tax Paid Up To">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="vehicle_class" style="color:black">Class of Vehicle &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field vehicle_class" id="vehicle_class" name="vehicle_class" required <?php echo isset($reportdata->vehicle_class) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="motor_car" <?php echo ($reportdata->vehicle_class ?? '') == 'motor_car' ? 'selected' : ''; ?>>Motor Car</option>
                            <option value="motor_cab" <?php echo ($reportdata->vehicle_class ?? '') == 'motor_cab' ? 'selected' : ''; ?>>Motor Cab</option>
                            <option value="Tractor" <?php echo ($reportdata->vehicle_class ?? '') == 'Tractor' ? 'selected' : ''; ?>>Tractor</option>
                            <option value="motor_cycle" <?php echo ($reportdata->vehicle_class ?? '') == 'motor_cycle' ? 'selected' : ''; ?>>Motor Cycle</option>
                            <option value="construction_equipment" <?php echo ($reportdata->vehicle_class ?? '') == 'construction_equipment' ? 'selected' : ''; ?>>Construction Equipment</option>
                            <option value="goods_carrier" <?php echo ($reportdata->vehicle_class ?? '') == 'goods_carrier' ? 'selected' : ''; ?>>Goods and Carrier </option>
                            <option value="Bus" <?php echo ($reportdata->vehicle_class ?? '') == 'Bus' ? 'selected' : ''; ?>>Bus</option>
                            <option value="Others" <?php echo ($reportdata->vehicle_class ?? '') == 'Others' ? 'selected' : ''; ?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="ulw" style="color:black">ULW&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ulw) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ulw) ? $reportdata->ulw : ""; ?>" name="ulw" id="ulw" placeholder="ULW">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="rlw" style="color:black">RLW &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->rlw) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->rlw) ? $reportdata->rlw : ""; ?>" id="rlw" name="rlw" placeholder="RLW">
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
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="fitness_certificate_no" style="color:black">Fitness Certificate No &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->fitness_certificate_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->fitness_certificate_no) ? $reportdata->fitness_certificate_no : ""; ?>" id="fitness_certificate_no" name="fitness_certificate_no" placeholder="Fitness Certificate No">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <label for="valid_up_to" style="color:black">Valid up to &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field " <?php echo isset($reportdata->valid_up_to) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->valid_up_to) ? $reportdata->valid_up_to : ""; ?>" name="valid_up_to" placeholder="Valid up to">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="permit_no" style="color:black">Permit No &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->permit_no) ? $reportdata->permit_no : ""; ?>" name="permit_no" id="permit_no" placeholder="Permit No">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validityfrom" style="color:black">
                            Permit No. (From) &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control case-field permit_validity_from"
                                <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>
                                value="<?php echo isset($reportdata->permit_validityfrom) ? $reportdata->permit_validityfrom : ""; ?>"
                                name="permit_validityfrom" placeholder="From">

                            <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                                <span class="input-group-text permit_validity_from_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validity" style="color:black">
                            Valid up (to) &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control case-field permit_validity_to"
                                <?php echo isset($reportdata->permit_validity) ? "disabled" : ""; ?>
                                value="<?php echo isset($reportdata->permit_validity) ? $reportdata->permit_validity : ""; ?>"
                                name="permit_validity" placeholder="Valid up to">

                            <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                                <span class="input-group-text permit_validity_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
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
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="authorization" style="color:black">Authorization &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->authorization) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->authorization) ? $reportdata->authorization : ""; ?>" name="authorization" id="area_of_operation" placeholder="Authorization">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="authorization_from" style="color:black">
                            Authorization (From) &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control case-field authorization_from"
                                <?php echo isset($reportdata->authorization_from) ? "disabled" : ""; ?>
                                value="<?php echo isset($reportdata->authorization_from) ? $reportdata->authorization_from : ""; ?>"
                                name="authorization_from" placeholder="From">

                            <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                                <span class="input-group-text authorization_from_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="autharity_validity" style="color:black">
                            Authorization (To)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control case-field autharity_validity"
                                <?php echo isset($reportdata->autharity_validity) ? "disabled" : ""; ?>
                                value="<?php echo isset($reportdata->autharity_validity) ? $reportdata->autharity_validity : ""; ?>"
                                name="autharity_validity" placeholder="Authorization Validity">

                            <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                                <span class="input-group-text autharity_validity_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <label for="puc" style="color:black">PUC </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field pucdate" <?php echo isset($reportdata->puc) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->puc) ? $reportdata->puc : ""; ?>" id="pucdate" name="puc" placeholder="PUC">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text pucdatebtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <label for="survey_date" style="color:black">Date of survey </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field date_of_survey" <?php echo isset($reportdata->survey_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->survey_date) ? $reportdata->survey_date : ""; ?>" name="survey_date" placeholder="Date of survey">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text dateofsurveybtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="name_of_driver" style="color:black">Name of Driver</label>
                        <input type="text" class="form-control case-field " <?php echo isset($reportdata->name_of_driver) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->name_of_driver) ? $reportdata->name_of_driver : ""; ?>" id="name_of_driver" name="name_of_driver" placeholder="Name of Driver">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="driving_license_no" style="color:black">Driving License No. </label>
                        <input type="text" class="form-control case-field " <?php echo isset($reportdata->driving_license_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->driving_license_no) ? $reportdata->driving_license_no : ""; ?>" id="driving_license_no" name="driving_license_no" placeholder="Driving License No.">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <label for="dl_issuedate" style="color:black">Date of issue </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field dl_issuedate" <?php echo isset($reportdata->dl_issuedate) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dl_issuedate) ? $reportdata->dl_issuedate : ""; ?>" name="dl_issuedate" placeholder="Date of issue">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text dl_issuedatebtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <label for="dl_valid" style="color:black">Valid Up to </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field dlvalidity" <?php echo isset($reportdata->dl_valid) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dl_valid) ? $reportdata->dl_valid : ""; ?>" id="dl_valid" name="dl_valid" placeholder="Valid Up to">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text dlvaliditybtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <label for="dob" style="color:black">Date of Birth </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field dob" <?php echo isset($reportdata->dob) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dob) ? $reportdata->dob : ""; ?>" name="dob" placeholder="Date of Birth">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text dobbtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
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
                        <label for="endorse" style="color:black">Endorse. </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->endorse) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->endorse) ? $reportdata->endorse : ""; ?>" name="endorse" id="endorse" placeholder="endorse">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="place_of_accident" style="color: black;">Place of accident &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->place_of_accident) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->place_of_accident) ? $reportdata->place_of_accident : ""; ?>" id="place_of_accident" name="place_of_accident" required placeholder="Place of accident">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label style="color:black">Date & Time of incident</label>
                        <div class="input-group">
                            <input type="text" class="form-control case-field"
                                <?php echo !empty($reportdata->date_of_incident) ? "disabled" : ""; ?>
                                value="<?php echo !empty($reportdata->date_of_incident) ? $reportdata->date_of_incident : (!empty($essentialdata->date_of_incident) ? $essentialdata->date_of_incident : ""); ?>"
                                name="date_of_incident"
                                id="date_of_incident"
                                placeholder="Incident Date" style="margin-right:8px;">

                            <input type="hidden"
                                class="form-control case-field loss_date_text dtt_text"
                                value="<?php echo !empty($essentialdata->dtt_text) ? $essentialdata->dtt_text : ""; ?>"
                                name="dtt_text">

                            <input type="time" class="form-control case-field"
                                <?php echo !empty($reportdata->time_of_incident) ? "disabled" : ""; ?>
                                value="<?php echo !empty($reportdata->time_of_incident) ? $reportdata->time_of_incident : (!empty($essentialdata->time_of_incident) ? $essentialdata->time_of_incident : ""); ?>"
                                name="time_of_incident"
                                id="time_of_incident"
                                style="margin-right:8px;">

                            <button type="button" class="btn btn-info toggle-manual-entry disabledbtn <?php echo isset($reportdata->date_of_incident) ? "disabled" : ""; ?>"
                                id="toggleManualEntry"
                                <?php echo (!empty($reportdata->date_of_incident) && !empty($reportdata->time_of_incident)) ? "disabled" : ""; ?>>
                                <i class="fa fa-comment" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="text-success mt-1 dtt_text">
                            <?php echo !empty($reportdata->dtt_text) ? $reportdata->dtt_text : (!empty($essentialdata->dtt_text) ? $essentialdata->dtt_text : ""); ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-2">
                    <label for="allotment_date" style="color:black">Date of allotment of inspection </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field allotment_date" <?php echo isset($reportdata->survey_allotment_date) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->survey_allotment_date) ? $reportdata->survey_allotment_date : ""; ?>" name="survey_allotment_date" required placeholder="Date of allotment of inspection">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text survey_allotment_datebtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <label for="date_of_inspection" style="color:black">Date of inspection </label>
                    <div class="input-group ">
                        <input type="text" class="form-control case-field " <?php echo isset($reportdata->date_of_inspection) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_of_inspection) ? $reportdata->date_of_inspection : ""; ?>" name="date_of_inspection" required placeholder="Date of inspection">
                        <div class="input-group-append disabledbtn <?php echo isset($reportdata->permit_validityfrom) ? "disabled" : ""; ?>">
                            <span class="input-group-text date_of_inspectionbtn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="place_of_inspection" style="color: black;">Place of inspection &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control case-field place_of_inspection" <?php echo isset($reportdata->place_of_inspection) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->place_of_inspection) ? $reportdata->place_of_inspection : ""; ?>" id="place_of_inspection" name="place_of_inspection" required placeholder="Place of inspection">
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="third_party_particulars" style="color:black">Third Party Particulars &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->third_party_particulars) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->third_party_particulars) ? $reportdata->third_party_particulars : ""; ?>" id="third_party_particulars" name="third_party_particulars" placeholder="Third Party Particulars">
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="loan_challan" style="color:black">Loan Challan &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" placeholder="Loan Challan" <?php echo isset($reportdata->loan_challan) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->loan_challan) ? $reportdata->loan_challan : ""; ?>" id="loan_challan" name="loan_challan">
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="cause_nature_accident" style="color:black">Cause and nature of accident &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" placeholder="Cause and nature of accident" <?php echo isset($reportdata->cause_nature_accident) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->cause_nature_accident) ? $reportdata->cause_nature_accident : ""; ?>" id="cause_nature_accident" name="cause_nature_accident">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="particulars_loss_damage" style="color:black">Particulars of loss / Damage </label>
                        <input type="text" class="form-control case-field" placeholder="Particulars of loss / Damage" <?php echo isset($reportdata->particulars_loss_damage) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->particulars_loss_damage) ? $reportdata->particulars_loss_damage : "On receipt of instruction from the underwrite office, our representative visited the spot of accident. The above vehicle was lying in accidental condition. Few Photographs of the vehicle taken from different angles to show the position of the vehicle and loss to the subject vehicle. The damages, which could be seen apparently, were noted as far as possible. The damages observed at spot are as under:."; ?>" id="particulars_loss_damage" name="particulars_loss_damage">
                    </div>
                </div>


                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="show_cabin" style="color:black">Front Show / Cabin </label>
                        <input type="text" class="form-control case-field" placeholder="Front Show / Cabin " <?php echo isset($reportdata->show_cabin) ? "disabled" : ""; ?> id="show_cabin" placeholder="" name="show_cabin" value="<?php echo isset($reportdata->show_cabin) ? htmlspecialchars($reportdata->show_cabin) : ""; ?>">
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 load_body_container" id="load_body_container" style="display: none;">
                    <div class="form-group ">
                        <label for="load_body" style="color:black">Load Body</label>
                        <input type="text" class="form-control case-field" placeholder="Load Body" <?php echo isset($reportdata->load_body) ? "disabled" : ""; ?> id="load_body" placeholder="" name="load_body" value="<?php echo isset($reportdata->load_body) ? htmlspecialchars($reportdata->load_body) : ""; ?>">
                    </div>
                </div>


                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="cooling_system" style="color:black">Cooling System </label>
                        <input type="text" class="form-control case-field" placeholder="Cooling System" <?php echo isset($reportdata->cooling_system) ? "disabled" : ""; ?> id="cooling_system" placeholder="" name="cooling_system" value="<?php echo isset($reportdata->cooling_system) ? htmlspecialchars($reportdata->cooling_system) : ""; ?>">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="steering_system" style="color:black">Steering System </label>
                        <input type="text" class="form-control case-field" placeholder="Steering System" <?php echo isset($reportdata->steering_system) ? "disabled" : ""; ?> id="steering_system" placeholder="" name="steering_system" value="<?php echo isset($reportdata->steering_system) ? htmlspecialchars($reportdata->steering_system) : ""; ?>">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="suspension" style="color:black">Suspension </label>
                        <input type="text" class="form-control case-field" placeholder="Suspension" <?php echo isset($reportdata->suspension) ? "disabled" : ""; ?> id="suspension" placeholder="" name="suspension" value="<?php echo isset($reportdata->suspension) ? htmlspecialchars($reportdata->suspension) : ""; ?>">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="electrical_system" style="color:black">Electrical System </label>
                        <input type="text" class="form-control case-field" name="electrical_system" placeholder="Electrical System" <?php echo isset($reportdata->electrical_system) ? "disabled" : ""; ?> id="electrical_system" value="<?php echo isset($reportdata->electrical_system) ? htmlspecialchars($reportdata->electrical_system) : ""; ?>">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="engine_transmission" style="color:black">Engine & Transmission System </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->engine_transmission) ? "disabled" : ""; ?> id="engine_transmission" placeholder="Engine & Transmission System" name="engine_transmission" value="<?php echo isset($reportdata->engine_transmission) ? htmlspecialchars($reportdata->engine_transmission) : ""; ?>">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="axles_chassis" style="color:black">Axles & Chassis </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->axles_chassis) ? "disabled" : ""; ?> id="axles_chassis" placeholder="Axles & Chassis" name="axles_chassis" value="<?php echo isset($reportdata->axles_chassis) ? htmlspecialchars($reportdata->axles_chassis) : ""; ?>">
                    </div>
                </div>



                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="sb1" style="color:black">SB1</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->sb1) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->sb1) ? $reportdata->sb1 : "The caused & extent of damages appeared are probable under the circumstances as reported. Every possible care has been taken to note down the visible losses, other, if any found at the time of final survey, suitable action may please be taken in view the nature of accident."; ?>" id="sb1" name="sb1" placeholder="SB1">
                    </div>
                </div>


                <div class="col-xl-12 col-md-12">
                    <div class="form-group ">
                        <label for="sb2" style="color:black">SB2</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->sb2) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->sb2) ? $reportdata->sb2 : "After the spot inspection the party was advised to remove the above accidental vehicle to repair workshop & intimate to insurer for arranging final survey."; ?>" id="sb2" name="sb2" placeholder="SB2">
                    </div>
                </div>
            </div>
            <table style="width: 100%;" border="1" class="mt-4">
                <tbody>
                    <tr>
                        <td><label class="ml-2" for="whether_valid" style="color:black">whether valid for the state in which the accident took place? &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" <?php echo isset($reportdata->whether_valid) ? 'disabled' : ''; ?> name="whether_valid" id="whether_valid" required>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->whether_valid ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" class="text-center" <?php echo ($reportdata->whether_valid ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->whether_valid ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="rc" class="ml-2" style="color:black">RC &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="rc" name="rc" required <?php echo isset($reportdata->rc) ? 'disabled' : ''; ?>>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->rc ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="NO" class="text-center" <?php echo ($reportdata->rc ?? '') == 'NO' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->rc ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="ml-2" for="fitness" style="color:black">Fitness &nbsp;<span style="color:red">*</span></label>
                        </td>
                        <td>
                            <select class="form-control case-field" id="fitness" name="fitness" required <?php echo isset($reportdata->fitness) ? 'disabled' : ''; ?>>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->fitness ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="NO" class="text-center" <?php echo ($reportdata->fitness ?? '') == 'NO' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->fitness ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ml-2" for="fitness" style="color:black">Goods/Passenger Tax &nbsp;<span style="color:red">*</span></label>
                        </td>
                        <td>
                            <select class="form-control case-field" id="goods_tax" name="goods_tax" required <?php echo isset($reportdata->goods_tax) ? 'disabled' : ''; ?>>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->goods_tax ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="NO" class="text-center" <?php echo ($reportdata->goods_tax ?? '') == 'NO' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->goods_tax ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ml-2" for="permit" style="color:black">Permit &nbsp;<span style="color:red">*</span></label>
                        </td>
                        <td>
                            <select class="form-control case-field" id="permit" name="permit" required <?php echo isset($reportdata->permit) ? 'disabled' : ''; ?>>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->permit ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="NO" class="text-center" <?php echo ($reportdata->permit ?? '') == 'NO' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->permit ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ml-2" for="has_accidenty" style="color:black">Has accident been reported to police &nbsp;<span style="color:red">*</span></label>
                        </td>
                        <td>
                            <select class="form-control case-field" id="has_accidenty" name="has_accidenty" required <?php echo isset($reportdata->has_accidenty) ? 'disabled' : ''; ?>>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->has_accidenty ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="NO" class="text-center" <?php echo ($reportdata->has_accidenty ?? '') == 'NO' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->has_accidenty ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ml-2" for="if_yes" style="color:black">If Yes, FIR/DD No. &nbsp;<span style="color:red">*</span></label>
                        </td>
                        <td>
                            <select class="form-control case-field" id="if_yes" name="if_yes" required <?php echo isset($reportdata->if_yes) ? 'disabled' : ''; ?>>
                                <option value="" class="text-center">Select</option>
                                <option value="Yes" class="text-center" <?php echo ($reportdata->if_yes ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="NO" class="text-center" <?php echo ($reportdata->if_yes ?? '') == 'NO' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" class="text-center" <?php echo ($reportdata->if_yes ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remarks" style="color:black">Remark</label>
                        <textarea class="form-control case-field"
                            id="remarks"
                            name="remarks"
                            rows="5"
                            <?php echo isset($reportdata->remarks) ? "disabled" : ""; ?>><?php echo isset($reportdata->remarks) ? htmlspecialchars($reportdata->remarks) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end mt-4" style="padding-bottom:10px;">
                <input class="btn case_btn" value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button" id="motor_spot_case_submit">
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(' #claim_no, #vehicle_number, #registration_number').on('input', function() {
            let value = $(this).val().replace(/[^a-zA-Z0-9 /]/g, '').toUpperCase();
            $(this).val(value);
        });
    });
</script>