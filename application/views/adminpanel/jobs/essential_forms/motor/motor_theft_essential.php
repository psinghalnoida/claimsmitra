<div class="panel">
    <form id="motor_theft_essential_form" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">
                ESSENTIAL DATA
            </h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <i class="fa fa-upload"></i></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <i class="fa fa-image"></i></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media <i class="fa fa-download"></i></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <!-- FORM START -->
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <?php
                        $salutation = $essentialdata->salutation ?? $jobdata->salutation ?? '';
                        // Disable if a value exists
                        $isDisabled = (!empty($salutation)) ? 'disabled' : '';
                        ?>
                        <select class="form-control salutation editable-field" id="salutation" name="salutation" <?= $isDisabled; ?>>
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name)
                                                                                                                                                                        ? $essentialdata->contact_person_name
                                                                                                                                                                        : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile)
                                                                                                                                                                        ? $essentialdata->contact_person_mobile
                                                                                                                                                                        : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                            <input
                                type="text"
                                class="form-control editable-field"
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->vehicle_number) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->vehicle_number) && !empty($essentialdata->vehicle_number)
                                                                                                                                                                    ? $essentialdata->vehicle_number
                                                                                                                                                                    : (isset($jobdata->vehicle_number) ? $jobdata->vehicle_number : ""); ?>" id="vehicle_no" name="vehicle_number" placeholder="Vehicle No." required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="registered_owner" style="color:black">Name of Registered Owner <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->registered_owner) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->registered_owner) && !empty($essentialdata->registered_owner)
                                                                                                                                                                    ? $essentialdata->registered_owner
                                                                                                                                                                    : (isset($jobdata->registered_owner) ? $jobdata->registered_owner : ""); ?>" id="registered_owner" name="registered_owner" placeholder="Name of Registered Owner" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Place of Survey</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control editable-field" style="width: 50%;"
                                <?php echo isset($essentialdata->state) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->state) && !empty($essentialdata->state) ? $essentialdata->state : ($jobdata->state ?? ""); ?>"
                                id="state" name="state" placeholder="State" required>

                            <input type="text" class="form-control editable-field" style="width: 50%;"
                                <?php echo isset($essentialdata->address) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address) ? $essentialdata->address : ($jobdata->address ?? ""); ?>"
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->cause_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->cause_loss) ? $essentialdata->cause_loss : ""; ?>" id="cause_loss" name="cause_loss" placeholder="cause_loss" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber)
                                                                                                                                                                ? $essentialdata->policyNumber
                                                                                                                                                                : (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validityfrom" style="color:black">
                            Policy Number(From) &nbsp;<span style="color:red">*</span>
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
                            Policy Number(To) &nbsp;<span style="color:red">*</span>
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
                        <label style="color:black">Date & Time of incident</label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field"
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
                            <button type="button" class="btn btn-info toggle-manual-entry"
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
                        <label for="fir_date" style="color:black">FIR Date <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="fir_date" <?php echo isset($essentialdata->fir_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->fir_date) ? $essentialdata->fir_date : ""; ?>" id="fir_date" name="fir_date" placeholder="FIR  Date" required>
                    </div>
                </div> -->


                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policy_by" style="color: black;">
                            FIR Date &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->fir_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->fir_date) ? $essentialdata->fir_date : ""; ?>" id="fir_date" name="fir_date" placeholder="Fir date" required>

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
                        <label for="fir_no" style="color:black">FIR No. <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->fir_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->fir_no) ? $essentialdata->fir_no : ""; ?>" id="fir_no" name="fir_no" placeholder="FIR No. " required>
                    </div>
                </div>



                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="police_station_name" style="color:black">Name of Police Station <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->police_station_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->police_station_name) ? $essentialdata->police_station_name : ""; ?>" id="police_station_name" name="police_station_name" placeholder="Name of Police Station" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="appointment_date" style="color:black">Date of Appointment <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="appointment_date" <?php echo isset($essentialdata->appointment_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->appointment_date) ? $essentialdata->appointment_date : ""; ?>" id="appointment_date" name="appointment_date" placeholder="Date of Appointment" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_owner" style="color:black">Name of vehicle owner<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->vehicle_owner) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->vehicle_owner) ? $essentialdata->vehicle_owner : ""; ?>" id="vehicle_owner" name="vehicle_owner" placeholder="Loss Liability Net of Salvage" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of insured (As per policy)<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name)
                                                                                                                                                                ? $essentialdata->insured_name
                                                                                                                                                                : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Name of insured(As per policy)" required>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks </label>
                        <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->remark) ? $essentialdata->remark : ""; ?>" id="remark" name="remark" placeholder="Remarks"></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="motor_theft_submit">
            </div>
        </div>
    </form>
</div>