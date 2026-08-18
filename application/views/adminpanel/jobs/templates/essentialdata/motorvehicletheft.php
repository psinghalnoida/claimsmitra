<div class="panel" style="margin-top:15px;">
    <form id="motor_theft_essential_form" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">
                ESSENTIAL DATA
            </h3>
        </div>
        <div class="panel-body essentialdata" style="padding-top:0px; padding-bottom: 0px;">
            <!-- FORM START -->
            <div class="row mt-2">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="template_name" style="color:black">Template Name<span style="color:red"> *</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->template_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->template_name) && !empty($essentialdata->contact_person_name) ? $essentialdata->template_name : (isset($jobdata->template_name) ? $jobdata->template_name : ""); ?>" id="template_name" name="template_name" placeholder="Template Name" required>
                    </div>
                </div>
            </div>
            <?php $this->load->view('adminpanel/jobs/templates/include/ila_lor_flags'); ?>
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <div class="row">
                <input type="hidden" name="natureofjob" value="<?php echo $natureofjob; ?>">

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation </label>
                        <select class="form-control salutation editable-field" id="salutation" name="salutation" <?= $isDisabled; ?>>
                            <option value="">Select Salutation</option>
                            <option value="Mr">Mr.</option>
                            <option value="Ms">Ms.</option>
                            <option value="Mrs">Mrs.</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_name" style="color:black">Contact Person Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field contact_person_name" value="" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" value="" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="nameInput" style="color:black">Case Reference <span style="color:red">*</span></label>
                            <input
                                type="text"
                                class="form-control editable-field "
                                <?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)
                                            ? $essentialdata->case_reference
                                            : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>"
                                name="case_reference"
                                id="case_reference"
                                placeholder="Case Reference"
                                required>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" id="report_date" <?php echo isset($essentialdata->date_of_report) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Type of Vehicle</label>
                        <div class="d-flex gap-2 editable-field">
                            <?php
                            $prvt_cmrcl = $essentialdata->prvt_cmrcl ?? $jobdata->prvt_cmrcl ?? '';
                            $type_of_vehicle = $essentialdata->type_of_vehicle ?? $jobdata->type_of_vehicle ?? '';

                            // Check if both fields have values
                            $isDisabled = (!empty($prvt_cmrcl) && !empty($type_of_vehicle)) ? 'disabled' : '';
                            ?>
                            <select class="form-control salutation me-2 editable-field" id="prvt_cmrcl" name="prvt_cmrcl" style="width: 50%;" <?= $isDisabled; ?>>
                                <option value="">Select Type</option>
                                <option value="Private" <?= ($prvt_cmrcl == 'Private') ? 'selected' : ''; ?>>Private</option>
                                <option value="Commercial" <?= ($prvt_cmrcl == 'Commercial') ? 'selected' : ''; ?>>Commercial</option>
                            </select>

                            <select class="form-control type_of_vehicle editable-field" id="type_of_vehicle" name="type_of_vehicle" style="width: 50%;" <?= $isDisabled; ?>>
                                <option value="">Select Vehicle</option>
                                <option value="Motor Car" <?= ($type_of_vehicle == 'Motor Car') ? 'selected' : ''; ?>>Motor Car</option>
                                <option value="Motor Cab" <?= ($type_of_vehicle == 'Motor Cab') ? 'selected' : ''; ?>>Motor Cab</option>
                                <option value="Tractor" <?= ($type_of_vehicle == 'Tractor') ? 'selected' : ''; ?>>Tractor</option>
                                <option value="Motor Cycle" <?= ($type_of_vehicle == 'Motor Cycle') ? 'selected' : ''; ?>>Motor Cycle</option>
                                <option value="Construction Equipment" <?= ($type_of_vehicle == 'Construction Equipment') ? 'selected' : ''; ?>>Construction Equipment</option>
                                <option value="Goods and Carrier" <?= ($type_of_vehicle == 'Goods and Carrier') ? 'selected' : ''; ?>>Goods and Carrier</option>
                                <option value="Bus" <?= ($type_of_vehicle == 'Bus') ? 'selected' : ''; ?>>Bus</option>
                                <option value="other" <?= ($type_of_vehicle == 'other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_number" style="color:black">Vehicle No. <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field vehicle_no" <?php echo isset($essentialdata->vehicle_number) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->vehicle_number) && !empty($essentialdata->vehicle_number) ? $essentialdata->vehicle_number : (isset($jobdata->vehicle_number) ? $jobdata->vehicle_number : ""); ?>" id="vehicle_no" name="vehicle_number" placeholder="Vehicle No." required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="registered_owner" style="color:black">Name of Registered Owner <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field registered_owner" <?php echo isset($essentialdata->registered_owner) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->registered_owner) && !empty($essentialdata->registered_owner) ? $essentialdata->registered_owner : (isset($jobdata->registered_owner) ? $jobdata->registered_owner : ""); ?>" id="registered_owner" name="registered_owner" placeholder="Name of Registered Owner" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Place of Survey <span style="color:red">*</span></label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control editable-field" style="width: 50%;"
                                <?php echo isset($essentialdata->state) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->state) && !empty($essentialdata->state) ? $essentialdata->state : (isset($jobdata->state) ? $jobdata->state : ""); ?>"
                                id="state" name="state" placeholder="State" required>

                            <input type="text" class="form-control editable-field" style="width: 50%;"
                                <?php echo isset($essentialdata->address) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address) ? $essentialdata->address : (isset($jobdata->address) ? $jobdata->address : ""); ?>"
                                id="address" name="address" placeholder="Address" required>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="account" style="color:black">A/c <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->account) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->account) ? $essentialdata->account : ""; ?>" id="account" name="account" placeholder="Account" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cause_loss" style="color:black">Cause of Loss <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->cause_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->cause_loss) && !empty($essentialdata->cause_loss) ? $essentialdata->cause_loss : (isset($jobdata->cause_loss) ? $jobdata->cause_loss : ""); ?>" id="cause_loss" name="cause_loss" placeholder="Cause of Loss" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable- policyNumber" <?php echo isset($essentialdata->policyNumber) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber) ? $essentialdata->policyNumber : (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validityfrom" style="color:black">
                            Policy Number(From)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field  policy_number_from" <?php echo isset($essentialdata->policyNumberfrom) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumberfrom) ? $essentialdata->policyNumberfrom : ""; ?>" id="policyNumberfrom" name="policyNumberfrom" placeholder="From">
                            <div class="input-group-append disabledbtn <?php echo isset($essentialdata->policyNumberfrom) ? "disabled" : ""; ?>">
                                <span class="input-group-text policy_number_from_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validity" style="color:black">
                            Policy Number(To)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field policy_number_to" <?php echo isset($essentialdata->policyNumberto) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumberto) ? $essentialdata->policyNumberto : ""; ?>" id="policyNumberto" name="policyNumberto" placeholder="To">
                            <div class="input-group-append disabledbtn <?php echo isset($essentialdata->policyNumberto) ? "disabled" : ""; ?>">
                                <span class="input-group-text policy_number_to_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="insurancefrom" style="color:black">Period of Insurance <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field insurancefrom" <?php echo isset($essentialdata->insurancefrom) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insurancefrom) ? $essentialdata->insurancefrom : ""; ?>" id="insurancefrom" name="insurancefrom" placeholder="From" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control editable-field insuranceto" <?php echo isset($essentialdata->insuranceto) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insuranceto) ? $essentialdata->insurancefrom : ""; ?>" id="insuranceto" name="insuranceto" placeholder="To" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="idv" style="color:black">IDV <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->idv) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->idv) ? $essentialdata->idv : ""; ?>" id="idv" name="idv" placeholder="IDV" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label style="color:black">Date & Time of incident <span style="color:red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field date_of_incident"
                                <?php echo isset($essentialdata->date_of_incident) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->date_of_incident) ? $essentialdata->date_of_incident : ""; ?>"
                                name="date_of_incident"
                                id="date_of_incident"
                                placeholder="Incident Date" style="margin-right:8px;">
                            <input type="hidden"
                                class="form-control editable-field loss_date_text dtt_text"
                                value="<?php echo isset($essentialdata->dtt_text) ? $essentialdata->dtt_text : ""; ?>"
                                name="dtt_text">
                            <input type="time" class="form-control editable-field"
                                <?php echo isset($essentialdata->time_of_incident) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->time_of_incident) ? $essentialdata->time_of_incident : ""; ?>"
                                name="time_of_incident"
                                style="margin-right:8px;">
                            <button type="button" class="btn btn-info toggle-manual-entry toggleManualEntry"
                                id="toggleManualEntry">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="text-success mt-1 dtt_text">
                            <?php echo isset($essentialdata->dtt_text) ? $essentialdata->dtt_text : ""; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="brief_narration" style="color:black">Brief narration of Incident as per claim papers <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->brief_narration) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->brief_narration) ? $essentialdata->brief_narration : ""; ?>" id="brief_narration" name="brief_narration" placeholder="Brief narration of Incident as per claim papers" required>
                    </div>
                </div>
                <!-- <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="fir_date" style="color:black">FIR Date </label>
                        <input type="text" class="form-control editable-field" id="fir_date" <?php echo isset($essentialdata->fir_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->fir_date) ? $essentialdata->fir_date : ""; ?>" id="fir_date" name="fir_date" placeholder="FIR  Date" required>
                    </div>
                </div> -->


                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policy_by" style="color: black;">
                            FIR Date <span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field fir_date" <?php echo isset($essentialdata->fir_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->fir_date) ? $essentialdata->fir_date : ""; ?>" id="fir_date" name="fir_date" placeholder="Fir date" required>

                            <!-- <div class="input-group-append venor-btn">
                                <a data-toggle="modal"  data-modal-type="policy" class="btn btn-rounded btn-info venorbtn"
                                     href="#" style="align-content: center">
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="fir_no" style="color:black">FIR No.<span style="color:red">*</span> </label>
                        <input type="text" class="form-control editable-field fir_no" <?php echo isset($essentialdata->fir_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->fir_no) ? $essentialdata->fir_no : ""; ?>" id="fir_no" name="fir_no" placeholder="FIR No. " required>
                    </div>
                </div>



                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="police_station_name" style="color:black">Name of Police Station <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field police_station_name" <?php echo isset($essentialdata->police_station_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->police_station_name) ? $essentialdata->police_station_name : ""; ?>" id="police_station_name" name="police_station_name" placeholder="Name of Police Station" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="appointment_date" style="color:black">Date of Appointment <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field appointment_date" id="appointment_date" <?php echo isset($essentialdata->appointment_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->appointment_date) ? $essentialdata->appointment_date : ""; ?>" id="appointment_date" name="appointment_date" placeholder="Date of Appointment" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_owner" style="color:black">Name of vehicle owner <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field vehicle_owner" <?php echo isset($essentialdata->vehicle_owner) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->vehicle_owner) ? $essentialdata->vehicle_owner : ""; ?>" id="vehicle_owner" name="vehicle_owner" placeholder="Name of vehicle owner" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of insured (As per policy) <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field insured_name" <?php echo isset($essentialdata->insured_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name) ? $essentialdata->insured_name : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Name of insured" required>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks </label>
                        <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->remark) ? $essentialdata->remark : ""; ?>" id="remark" name="remark" placeholder="Remarks"></textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="panel-body casedata" style="padding-top:0px; padding-bottom: 0px;">
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Insured Name </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->insured_name) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->insured_name) ? $reportdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Insured Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claim_number" style="color:black">Claim Number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->claim_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->claim_number) ? $reportdata->claim_number : ""; ?>" id="claim_number" name="claim_number" placeholder="Claim Number" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="endorsement_details" style="color:black">Endorsement details, if any: </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->endorsement_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->endorsement_details) ? $reportdata->endorsement_details : ""; ?>" id="policyNumber" name="endorsement_details" placeholder="Endorsement details" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="break_in_insurance" style="color:black">Break-in insurance details, if any: </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->break_in_insurance) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->break_in_insurance) ? $reportdata->break_in_insurance : ""; ?>" id="break_in_insurance" name="break_in_insurance" placeholder="Break-in insurance details" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pre_inspection_details" style="color:black">Pre inspection details, if any: </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->pre_inspection_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->pre_inspection_details) ? $reportdata->pre_inspection_details : ""; ?>" id="pre_inspection_details" name="pre_inspection_details" placeholder="Pre inspection details" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="chasis_number" style="color:black">Chasis number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->chasis_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->chasis_number) ? $reportdata->chasis_number : ""; ?>" id="chasis_number" name="chasis_number" placeholder="Chasis number" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="engine_number" style="color:black">Engine number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->engine_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->engine_number) ? $reportdata->engine_number : ""; ?>" id="engine_number" name="engine_number" placeholder="Engine number" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="make_modal" style="color:black">Make/Model </label>
                        <input type="text" class="form-control editable-field" id="make_modal" <?php echo isset($reportdata->make_modal) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->make_modal) ? $reportdata->make_modal : ""; ?>" id="make_modal" name="make_modal" placeholder="Make/Model" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="year_of_manufacture" style="color:black">Year of Manufacture </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->year_of_manufacture) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->year_of_manufacture) ? $reportdata->year_of_manufacture : ""; ?>" id="year_of_manufacture" name="year_of_manufacture" placeholder="Year of Manufacture" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="colour" style="color:black">Colour </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->colour) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->colour) ? $reportdata->colour : ""; ?>" id="colour" name="colour" placeholder="Colour" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="seatig_capacity" style="color:black">Seating Capacity / GVW </label>
                        <input type="text" class="form-control editable-field" id="seatig_capacity" <?php echo isset($reportdata->seatig_capacity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->seatig_capacity) ? $reportdata->seatig_capacity : ""; ?>" id="seatig_capacity" name="seatig_capacity" placeholder="Seating Capacity / GVW" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="tax_paid_up_to" style="color:black">Tax Paid up to </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->tax_paid_up_to) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->tax_paid_up_to) ? $reportdata->tax_paid_up_to : ""; ?>" id="tax_paid_up_to" name="tax_paid_up_to" placeholder="Tax Paid up to" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="validity" style="color:black">Fitness Certificate Validity</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->validity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->validity) ? $reportdata->validity : ""; ?>" id="validity" name="validity" placeholder="Fitness Certificate Validity" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="hypothecation_details" style="color:black">Hypothecation details, if any:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->hypothecation_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->hypothecation_details) ? $reportdata->hypothecation_details : ""; ?>" id="hypothecation_details" name="hypothecation_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="rc_issuing_authority" style="color:black">RC Issuing authority </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->rc_issuing_authority) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->rc_issuing_authority) ? $reportdata->rc_issuing_authority : ""; ?>" id="rc_issuing_authority" name="rc_issuing_authority" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_number" style="color:black">Permit number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_number) ? $reportdata->permit_number : ""; ?>" id="permit_number" name="permit_number" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_date_of_issue" style="color:black">Permit date of issue</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_date_of_issue) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_date_of_issue) ? $reportdata->permit_date_of_issue : ""; ?>" id="permit_date_of_issue" name="permit_date_of_issue" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_period_of_validity" style="color:black"> Permit Period of validity</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_period_of_validity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_period_of_validity) ? $reportdata->permit_period_of_validity : ""; ?>" id="permit_period_of_validity" name="permit_period_of_validity" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_type" style="color:black">Permit Type</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_type) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_type) ? $reportdata->permit_type : ""; ?>" id="permit_type" name="permit_type" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_area" style="color:black">Permit area</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_area) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_area) ? $reportdata->permit_area : ""; ?>" id="permit_area" name="permit_area" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_number" style="color:black">Permit authorization number</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_authorization_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_number) ? $reportdata->permit_authorization_number : ""; ?>" id="permit_authorization_number" name="permit_authorization_number" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_date_of_issue" style="color:black">Permit authorization date of issue</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_authorization_date_of_issue) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_date_of_issue) ? $reportdata->permit_authorization_date_of_issue : ""; ?>" id="permit_authorization_date_of_issue" name="permit_authorization_date_of_issue" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_period_of_validity" style="color:black">Permit authorization period of validity </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_authorization_period_of_validity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_period_of_validity) ? $reportdata->permit_authorization_period_of_validity : ""; ?>" id="permit_authorization_period_of_validity" name="permit_authorization_period_of_validity" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_area" style="color:black">Permit authorization area</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->permit_authorization_area) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_area) ? $reportdata->permit_authorization_area : ""; ?>" id="permit_authorization_area" name="permit_authorization_area" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="Whether_theft_details" style="color:black">Are Theft Details Mentioned in RC/RTO Records? (Y/N):</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->Whether_theft_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->Whether_theft_details) ? $reportdata->Whether_theft_details : ""; ?>" id="Whether_theft_details" name="Whether_theft_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="last_vehicle_user" style="color:black">Name of Last user of vehicle </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->last_vehicle_user) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->last_vehicle_user) ? $reportdata->last_vehicle_user : ""; ?>" id="last_vehicle_user" name="last_vehicle_user" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="relationship_with_insured" style="color:black">Relationship with insured </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->relationship_with_insured) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->relationship_with_insured) ? $reportdata->relationship_with_insured : ""; ?>" id="relationship_with_insured" name="relationship_with_insured" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="occupation" style="color:black">Occupation</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->occupation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->occupation) ? $reportdata->occupation : ""; ?>" id="occupation" name="occupation" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="address" style="color:black">Address</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->address) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->address) ? $reportdata->address : ""; ?>" id="address" name="address" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="financing_type" style="color:black">Financing type -Lease/HPA etc</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->financing_type) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->financing_type) ? $reportdata->financing_type : ""; ?>" id="financing_type" name="financing_type" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_loan_advanced" style="color:black">Type of loan Advanced - Pvt or Commercial:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->type_of_loan_advanced) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->type_of_loan_advanced) ? $reportdata->type_of_loan_advanced : ""; ?>" id="type_of_loan_advanced" name="type_of_loan_advanced" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="details_of_Loan_repayment" style="color:black">Details of Loan repayment(latest):</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->details_of_Loan_repayment) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_Loan_repayment) ? $reportdata->details_of_Loan_repayment : ""; ?>" id="details_of_Loan_repayment" name="details_of_Loan_repayment" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="outstanding_amount" style="color:black">Outstanding Amount</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->outstanding_amount) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->outstanding_amount) ? $reportdata->outstanding_amount : ""; ?>" id="outstanding_amount" name="outstanding_amount" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_was_seized" style="color:black">Whether vehicle was seized?</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->vehicle_was_seized) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->vehicle_was_seized) ? $reportdata->vehicle_was_seized : ""; ?>" id="vehicle_was_seized" name="vehicle_was_seized" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="original_key" style="color:black">Whether original key(s) retained by financier?</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->original_key) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->original_key) ? $reportdata->original_key : ""; ?>" id="original_key" name="original_key" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="any_irregulaity_noticed" style="color:black">Any irregulaity noticed in loan repayment?</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->any_irregulaity_noticed) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->any_irregulaity_noticed) ? $reportdata->any_irregulaity_noticed : ""; ?>" id="any_irregulaity_noticed" name="any_irregulaity_noticed" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="name_of_driver" style="color:black">Name of driver</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->name_of_driver) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->name_of_driver) ? $reportdata->name_of_driver : ""; ?>" id="name_of_driver" name="name_of_driver" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="driving_license_details" style="color:black">Driving License details with all previous DL particulars:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->driving_license_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->driving_license_details) ? $reportdata->driving_license_details : ""; ?>" id="driving_license_details" name="driving_license_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_issue" style="color:black">Date of issue:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->date_of_issue) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_of_issue) ? $reportdata->date_of_issue : ""; ?>" id="date_of_issue" name="date_of_issue" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="valid_up_to" style="color:black">Valid up to:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->valid_up_to) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->valid_up_to) ? $reportdata->valid_up_to : ""; ?>" id="valid_up_to" name="valid_up_to" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_vehicle" style="color:black">Type of vehicle authorized to drive:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->type_of_vehicle) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->type_of_vehicle) ? $reportdata->type_of_vehicle : ""; ?>" id="type_of_vehicle" name="type_of_vehicle" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="issue_authority" style="color:black">Issue Authority</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->issue_authority) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->issue_authority) ? $reportdata->issue_authority : ""; ?>" id="issue_authority" name="issue_authority" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="verification_status" style="color:black">Verification status</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->verification_status) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->verification_status) ? $reportdata->verification_status : ""; ?>" id="verification_status" name="verification_status" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="details_of_location" style="color:black">Theft/Snatching Location:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->details_of_location) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_location) ? $reportdata->details_of_location : ""; ?>" id="details_of_location" name="details_of_location" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_intimation" style="color:black">Date of intimation of loss to insured by the driver/ last user</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->date_intimation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_intimation) ? $reportdata->date_intimation : ""; ?>" id="date_intimation" name="date_intimation" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="time_intimation" style="color:black"> Time of intimation of loss to insured by the driver/ last user</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->time_intimation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->time_intimation) ? $reportdata->time_intimation : ""; ?>" id="time_intimation" name="time_intimation" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="by_the_complainant" style="color:black">Date of intimation of loss to police by the complainant </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->by_the_complainant) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->by_the_complainant) ? $reportdata->by_the_complainant : ""; ?>" id="by_the_complainant" name="by_the_complainant" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="time_by_the_complainant" style="color:black">Time of intimation of loss to police by the complainant </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->time_by_the_complainant) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->time_by_the_complainant) ? $reportdata->time_by_the_complainant : ""; ?>" id="time_by_the_complainant" name="time_by_the_complainant" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="narration_of_incident" style="color:black">Brief narration of incident as per police investigation:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->narration_of_incident) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->narration_of_incident) ? $reportdata->narration_of_incident : ""; ?>" id="narration_of_incident" name="narration_of_incident" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="police_station" style="color:black">Police station and other independant checks:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->police_station) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->police_station) ? $reportdata->police_station : ""; ?>" id="police_station" name="police_station" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="verification_from_insured" style="color:black">Verification from insured /driver/last user: </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->verification_from_insured) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->verification_from_insured) ? $reportdata->verification_from_insured : ""; ?>" id="verification_from_insured" name="verification_from_insured" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="Verification_at_spot" style="color:black">Verification at spot along with photographs:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->Verification_at_spot) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->Verification_at_spot) ? $reportdata->Verification_at_spot : ""; ?>" id="Verification_at_spot" name="Verification_at_spot" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="locking_system" style="color:black">Type of locking system</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->locking_system) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->locking_system) ? $reportdata->locking_system : ""; ?>" id="locking_system" name="locking_system" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="possession_of_keys" style="color:black">Possession of Keys </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->possession_of_keys) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->possession_of_keys) ? $reportdata->possession_of_keys : ""; ?>" id="possession_of_keys" name="possession_of_keys" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="no_of_keys" style="color:black">No of keys</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->no_of_keys) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->no_of_keys) ? $reportdata->no_of_keys : ""; ?>" id="no_of_keys" name="no_of_keys" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="irregularity_noted" style="color:black">Comments on any irregularity noted:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->irregularity_noted) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->irregularity_noted) ? $reportdata->irregularity_noted : ""; ?>" id="irregularity_noted" name="irregularity_noted" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="ipc_section" style="color:black">IPC section mentioned in the FIR</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->ipc_section) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->ipc_section) ? $reportdata->ipc_section : ""; ?>" id="ipc_section" name="ipc_section" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="investigation_officer" style="color:black">Name of Investigation Officer</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->investigation_officer) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->investigation_officer) ? $reportdata->investigation_officer : ""; ?>" id="investigation_officer" name="investigation_officer" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="fir_lodged" style="color:black">Fir Lodged By:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->fir_lodged) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->fir_lodged) ? $reportdata->fir_lodged : ""; ?>" id="fir_lodged" name="fir_lodged" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="property_involved" style="color:black">Property Involved</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->property_involved) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->property_involved) ? $reportdata->property_involved : ""; ?>" id="property_involved" name="property_involved" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="police_final_report" style="color:black">Police final report(FR) No. and Date</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->police_final_report) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->police_final_report) ? $reportdata->police_final_report : ""; ?>" id="police_final_report" name="police_final_report" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vis_a_vis" style="color:black">Reason for Change in Section(s) Compared to FIR::</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->vis_a_vis) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->vis_a_vis) ? $reportdata->vis_a_vis : ""; ?>" id="vis_a_vis" name="vis_a_vis" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="comments_on_any_irregularity" style="color:black">Comments on any irregularity noted:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->comments_on_any_irregularity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->comments_on_any_irregularity) ? $reportdata->comments_on_any_irregularity : ""; ?>" id="comments_on_any_irregularity" name="comments_on_any_irregularity" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pcr_100_report_details" style="color:black">PCR 100 no. report details:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->pcr_100_report_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->pcr_100_report_details) ? $reportdata->pcr_100_report_details : ""; ?>" id="pcr_100_report_details" name="pcr_100_report_details" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="gd_entry_details" style="color:black">GD Entry details</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->gd_entry_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->gd_entry_details) ? $reportdata->gd_entry_details : ""; ?>" id="gd_entry_details" name="gd_entry_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="details_of_wireless" style="color:black">Details of wireless messaged flashed by police:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->details_of_wireless) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_wireless) ? $reportdata->details_of_wireless : ""; ?>" id="details_of_wireless" name="details_of_wireless" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="other_details" style="color:black">other details, it any:</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->other_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->other_details) ? $reportdata->other_details : ""; ?>" id="other_details" name="other_details" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="status_of_vehicle" style="color:black">Vehicle Status as per Report & Date: (Attach report copy)</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->status_of_vehicle) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->status_of_vehicle) ? $reportdata->status_of_vehicle : ""; ?>" id="status_of_vehicle" name="status_of_vehicle" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_theft" style="color:black">Date of Theft :</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->date_of_theft) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_of_theft) ? $reportdata->date_of_theft : ""; ?>" id="date_of_theft" name="date_of_theft" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="fir_date" style="color:black">Date of FIR/ intimation to Police and delay, if any : </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->fir_date) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->fir_date) ? $reportdata->fir_date : ""; ?>" name="fir_date" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="intimation_date" style="color:black">Date of Intimation to Insurer and delay, if any :</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->intimation_date) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->intimation_date) ? $reportdata->intimation_date : ""; ?>" id="intimation_date" name="intimation_date" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="comments" style="color:black">Comments on Delay in Intimation to Police & Insurer: </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->comments) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->comments) ? $reportdata->comments : ""; ?>" id="comments" name="comments" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="details_with_proof_of_intimation" style="color:black">If yes, details with proof of intimation (postal receipt/postal order to be collected) :</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->details_with_proof_of_intimation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_with_proof_of_intimation) ? $reportdata->details_with_proof_of_intimation : ""; ?>" id="details_with_proof_of_intimation" name="details_with_proof_of_intimation" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="details_of_ownership" style="color:black">Details of all transfer of ownership, if any, from the date of first purchase registration: </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->details_of_ownership) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_ownership) ? $reportdata->details_of_ownership : ""; ?>" id="details_of_ownership" name="details_of_ownership" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="loaded_commercial_vehicles" style="color:black">For loaded commercial vehicles, verify the Marine policy details against the claim status, and review the Goods Receipt from the transporter and the invoice from the consignor.</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->loaded_commercial_vehicles) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->loaded_commercial_vehicles) ? $reportdata->loaded_commercial_vehicles : ""; ?>" id="loaded_commercial_vehicles" name="loaded_commercial_vehicles" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="intimated_to_rto" style="color:black">Whether intimated to RTO (Y/N):(Proof of intimation along with RTO acknowledgement to be collected)</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->intimated_to_rto) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->intimated_to_rto) ? $reportdata->intimated_to_rto : ""; ?>" id="intimated_to_rto" name="intimated_to_rto" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="last_user_mentioned" style="color:black">Verify if the driver or last user listed in the claim form or intimation matches the one mentioned in the FIR. If there is a discrepancy, obtain clarification.</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->last_user_mentioned) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->last_user_mentioned) ? $reportdata->last_user_mentioned : ""; ?>" id="last_user_mentioned" name="last_user_mentioned" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="whether_fr_accepted" style="color:black">Has the FR (Final Report) been accepted by the court? (Y/N) If yes, provide the date of acceptance. If not, has the court taken cognizance of the charge sheet? If so, include brief details of the order passed and the date.</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->whether_fr_accepted) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->whether_fr_accepted) ? $reportdata->whether_fr_accepted : ""; ?>" id="whether_fr_accepted" name="whether_fr_accepted" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="proof_of_existence" style="color:black">Proof of the vehicle's existence before the theft can be collected through the following: servicing records, petrol pump bills, toll booth records, consignment delivery documents, load challans, and statements from people who last saw the vehicle before it was stolen</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($reportdata->proof_of_existence) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->proof_of_existence) ? $reportdata->proof_of_existence : ""; ?>" id="proof_of_existence" name="proof_of_existence" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="violation_aspects" style="color:black">Violation Aspects</label>
                        <input type="text" class="form-control editable-field"
                            id="violation_aspects" name="violation_aspects"
                            placeholder=""
                            value="<?php echo isset($reportdata->violation_aspects) ? htmlspecialchars($reportdata->violation_aspects) : ""; ?>"
                            <?php echo isset($reportdata->violation_aspects) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="references" style="color:black">References (Reference to NCDRC/SC judgements in relation to the current claim may be made)</label>
                        <input type="text" class="form-control editable-field"
                            id="references" name="references"
                            placeholder=""
                            value="<?php echo isset($reportdata->references) ? htmlspecialchars($reportdata->references) : ""; ?>"
                            <?php echo isset($reportdata->references) ? "disabled" : ""; ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="case_summary" style="color:black">Case Summary</label>
                        <input type="text" class="form-control editable-field"
                            id="case_summary" name="case_summary"
                            placeholder=""
                            value="<?php echo isset($reportdata->case_summary) ? htmlspecialchars($reportdata->case_summary) : ""; ?>"
                            <?php echo isset($reportdata->case_summary) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="conclusion" style="color:black">Conclusion (Reference to NCDRC/SC judgements in relation to the current claim may be made)</label>
                        <input type="text" class="form-control editable-field"
                            id="conclusion" name="conclusion"
                            placeholder=""
                            value="<?php echo isset($reportdata->conclusion) ? htmlspecialchars($reportdata->conclusion) : ""; ?>"
                            <?php echo isset($reportdata->conclusion) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="annexures" style="color:black">Annexures (Reference to NCDRC/SC judgements in relation to the current claim may be made)</label>
                        <input type="text" class="form-control editable-field"
                            id="annexures" name="annexures"
                            placeholder=""
                            value="<?php echo isset($reportdata->annexures) ? htmlspecialchars($reportdata->annexures) : ""; ?>"
                            <?php echo isset($reportdata->annexures) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <table id="documents_attached" style="width: 100%;" border="1" class="mt-2">
                <tbody>
                    <tr>
                        <td><label class="ml-2" for="date_of_loss" style="color:black">Tax whether paid up to the date of loss? &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="date_of_loss" name="date_of_loss" required <?php echo isset($reportdata->date_of_loss) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->date_of_loss ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->date_of_loss ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->date_of_loss ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="fitness_date" style="color:black">Fitness Certificate,whether Fitness is valid on the date of loss? &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="fitness_date" name="fitness_date" required <?php echo isset($reportdata->fitness_date) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->fitness_date ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->fitness_date ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->fitness_date ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="permit_whether" style="color:black">Permit, Whether place of loss falls within the permitted area? &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="permit_whether" name="permit_whether" required <?php echo isset($reportdata->permit_whether) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->permit_whether ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->permit_whether ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->permit_whether ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="whether_the_vehicle" style="color:black">Whether the vehicle was used for the purpose , as stated in the permit? &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="whether_the_vehicle" name="whether_the_vehicle" required <?php echo isset($reportdata->whether_the_vehicle) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->whether_the_vehicle ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->whether_the_vehicle ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->whether_the_vehicle ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="whether_registered_owner" style="color:black">Whether registered owner and insured name are the name?(Y/N) In case of any discrepancy explanation to be provided &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="whether_registered_owner" name="whether_registered_owner" required <?php echo isset($reportdata->whether_registered_owner) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->whether_registered_owner ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->whether_registered_owner ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->whether_registered_owner ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="engine_and_chasis_number" style="color:black">Are the engine and chassis numbers the same on the RC, policy, and purchase invoice? (Y/N) If there are any discrepancies, clarification should be obtained from the insured. &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="engine_and_chasis_number" name="engine_and_chasis_number" required <?php echo isset($reportdata->engine_and_chasis_number) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->engine_and_chasis_number ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->engine_and_chasis_number ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->engine_and_chasis_number ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="submitted_by_the_insured_to_insurer" style="color:black">Whether Submitted by the insured to insurer?(Y/N) &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="submitted_by_the_insured_to_insurer" name="submitted_by_the_insured_to_insurer" required <?php echo isset($reportdata->submitted_by_the_insured_to_insurer) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->submitted_by_the_insured_to_insurer ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->submitted_by_the_insured_to_insurer ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->submitted_by_the_insured_to_insurer ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="collected_from_insurer" style="color:black">If not submitted, Wheather collected from insurer?(Y/N) &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="collected_from_insurer" name="collected_from_insurer" required <?php echo isset($reportdata->collected_from_insurer) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->collected_from_insurer ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->collected_from_insurer ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->collected_from_insurer ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="intimated_ncrb" style="color:black">Whether intimated to NCRB: (Y/N) &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="intimated_ncrb" name="intimated_ncrb" required <?php echo isset($reportdata->intimated_ncrb) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->intimated_ncrb ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->intimated_ncrb ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->intimated_ncrb ?? '') == 'NA' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="noc_status" style="color:black">>NOC Status(Y/N) &nbsp;</label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control editable-field" id="noc_status" name="noc_status" required <?php echo isset($reportdata->noc_status) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="yes" <?php echo ($reportdata->noc_status ?? '') == 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo ($reportdata->noc_status ?? '') == 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </td>
                    </tr>


                </tbody>
            </table>
            <div class="button d-flex justify-content-end mt-2" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="motor_theft_submit">
            </div>
        </div>
    </form>
</div>