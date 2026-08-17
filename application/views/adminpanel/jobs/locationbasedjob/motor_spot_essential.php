<div class="panel ">
    <form id="motor_spot_essential_data" method="post" enctype="multipart/form-data">
         <input type="hidden" class="assignmentType" value="<?= $assignmentType ?>">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <select class="form-control salutation editable-field" id="salutation" name="salutation" <?php echo isset($essentialdata->salutation) ? 'disabled' : ''; ?>>
                            <option value="">Select Salutation</option>
                            <?php
                            $salutation = $essentialdata->salutation ?? $jobdata->salutation ?? '';
                            ?>
                            <option value="Mr" <?php echo ($salutation == 'Mr') ? 'selected' : ''; ?>>Mr.</option>
                            <option value="Ms" <?php echo ($salutation == 'Ms') ? 'selected' : ''; ?>>Ms.</option>
                            <option value="Mrs" <?php echo ($salutation == 'Mrs') ? 'selected' : ''; ?>>Mrs.</option>
                            <option value="Other" <?php echo ($salutation == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_name" style="color:black">Contact Person Name<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name)? $essentialdata->contact_person_name : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile)? $essentialdata->contact_person_mobile : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_number" style="color:black">Claim for vehicle registration number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field register_no" <?php echo isset($essentialdata->vehicle_number) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->vehicle_number) && !empty($essentialdata->vehicle_number)? $essentialdata->vehicle_number: (isset($jobdata->vehicle_number) ? $jobdata->vehicle_number : ""); ?>" name="vehicle_number" id="registration_number" placeholder="Registration No." required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of insured &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field insured_name" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name)
                               ? $essentialdata->insured_name: (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Insured Name" required>
                            <div class="input-group-append venor-btn disabledbtn">
                                <a data-toggle="modal" data-target="#vendorModal" data-modal-type="insured_name" class="btn btn-rounded btn-info venorbtn "
                                    href="#" style="padding: 10px 12px;">
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" id="date_of_report" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policyNumber" style="color: black;">Policy number &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber)
                         ? $essentialdata->policyNumber : (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" id="policyNumber" name="policyNumber" placeholder="Policy number" required>
                    </div>
                </div>
                <!-- <div class="col-xl-2 col-md-2">
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
                </div> -->

                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="claim_no" style="color: black;">Claim Number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claim_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->claim_no) && !empty($essentialdata->claim_no)  ? $essentialdata->claim_no: (isset($jobdata->claim_no) ? $jobdata->claim_no : ""); ?>" id="claim_no" name="claim_no" placeholder="Claim Number">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)? $essentialdata->case_reference: (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="insured_address" style="color:black">Address of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_address) ? $essentialdata->insured_address : ""; ?>" id="insured_address" name="insured_address" placeholder="Address of Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="registered_owner" style="color:black">Registered Owner &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->registered_owner) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->registered_owner) ? $essentialdata->registered_owner : ""; ?>" name="registered_owner" id="registered_owner" placeholder="Registered Owner">
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
                        <input type="text" class="form-control editable-field  mt-4 insurancefromtime" <?php echo isset($essentialdata->insurancefromtime) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insurancefromtime) ? $essentialdata->insurancefromtime : ""; ?>" name="insurancefromtime" placeholder="Select Time" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="period_of_insurance" style="color: black;">Period of Insurance (To) &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field insuranceto " <?php echo isset($essentialdata->insuranceto) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insuranceto) ? $essentialdata->insuranceto : ""; ?>" name="insuranceto" placeholder="Select Date" >
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group ">
                        <input type="text" class="form-control editable-field  mt-4 insurancetotime" <?php echo isset($essentialdata->insurancetotime) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->insurancetotime) ? $essentialdata->insurancetotime : ""; ?>" name="insurancetotime" placeholder="Select Time" >
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="state" style="color:black">Place of Survey</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control editable-field" style="width: 50%;"
                                <?php echo isset($essentialdata->state) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->state) && !empty($essentialdata->state) ? $essentialdata->state : ($jobdata->state ?? ""); ?>"
                                id="state" name="state" placeholder="State" >

                            <input type="text" class="form-control editable-field" style="width: 50%;"
                                <?php echo isset($essentialdata->address) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address) ? $essentialdata->address : ($jobdata->address ?? ""); ?>"
                                id="address" name="address" placeholder="Address" >
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="financers" style="color:black">Financers (if any) &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->financers) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->financers) ? $essentialdata->financers : ""; ?>" id="financers" name="financers" placeholder="Financers">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black"> Sum Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->sum_insured) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->sum_insured) ? $essentialdata->sum_insured : ""; ?>" value="" name="sum_insured" id="sum_insured" placeholder="Sum Insured" required>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="motor_spot_submit">
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#policyNumber, #claim_no, #vehicle_number, #registration_number').on('input', function() {
            let value = $(this).val().replace(/[^a-zA-Z0-9 /]/g, '').toUpperCase();
            $(this).val(value);
        });
    });
</script>