<div class="panel pb-4">
    <form id="assets_valuation_essential_data_indivi" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                 <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                <div class="button d-flex justify-content-end">
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <?php
                        $salutation = $essentialdata->salutation ?? $jobdata->salutation ?? '';
                        // Disable if a value exists
                        ?>
                        <select class="form-control salutation editable-field" id="salutation" name="salutation" >
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
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)? $essentialdata->case_reference : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>

                  <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="proposer" style="color:black">Proposer &nbsp;<span style="color:red">*</span></label>
                         <select class="form-control editable-field" id="proposer" name="proposer" <?php echo isset($essentialdata->proposer) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Insurance" <?php echo ($essentialdata->proposer ?? '') == 'Insurance' ? 'selected' : ''; ?>>Insurance</option>
                            <option value="Non-Insurance" <?php echo ($essentialdata->proposer ?? '') == 'Non-Insurance' ? 'selected' : ''; ?>>Non-Insurance</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="proposer_policy" style="color:black">Proposer Policy &nbsp;<span style="color:red">*</span></label>
                         <select class="form-control editable-field" id="proposer_policy" name="proposer_policy" <?php echo isset($essentialdata->proposer_policy) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Fire" <?php echo ($essentialdata->proposer_policy ?? '') == 'Fire' ? 'selected' : ''; ?>>Fire</option>
                            <option value="IAR" <?php echo ($essentialdata->proposer_policy ?? '') == 'IAR' ? 'selected' : ''; ?>>IAR</option>
                            <option value="Other" <?php echo ($essentialdata->proposer_policy ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 other_proposer_policy" >
                    <div class="form-group">
                        <label for="other_proposer_policy" style="color:black">Other type proposer policy</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->other_proposer_policy) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->other_proposer_policy) ? $essentialdata->other_proposer_policy : ""; ?>" id="other_proposer_policy" name="other_proposer_policy" placeholder="Other type proposer policy">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Insured</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) ? $essentialdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name of Proposer">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Claim No</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claim_no) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->claim_no) ? $essentialdata->claim_no : ""; ?>" id="claim_no" name="claim_no" placeholder="Claim No">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumber) ? $essentialdata->policyNumber : ""; ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="loss_data" style="color:black">Date of Loss</label>
                        <input type="text" class="form-control editable-field appointmentdate" <?php echo isset($essentialdata->loss_data) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->loss_data) ? $essentialdata->loss_data : ""; ?>" id="loss_data" name="loss_data" placeholder="Date of Loss">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="address" style="color:black">Address of Risk</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address)? $essentialdata->address : (isset($jobdata->address) ? $jobdata->address : ""); ?>" id="address" name="address" placeholder="Address of Risk">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="appointment_date" style="color:black">Date of appointment</label>
                        <input type="text" class="form-control editable-field appointmentdate" <?php echo isset($essentialdata->appointment_date) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->appointment_date) ? $essentialdata->appointment_date : ""; ?>" id="appointment_date" name="appointment_date" placeholder="Date of appointment">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="valuation_type" style="color:black">Type of Valuation</label>
                         <?php
                        $valuationtype = $essentialdata->valuation_type ?? $jobdata->valuation_type ?? '';
                        // Disable if a value exists
                        
                        ?>
                        <select class="form-control valuationtype editable-field" id="valuation_type" name="valuation_type" >
                            <option value="">Select Salutation</option>
                            <option value="Desktop" <?= ($valuationtype == 'Desktop') ? 'selected' : ''; ?>>Desktop</option>
                            <option value="Physical" <?= ($valuationtype == 'Physical') ? 'selected' : ''; ?>>Physical</option>
                            <option value="Other" <?= ($valuationtype == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 visitdate" >
                    <div class="form-group">
                        <label for="visitdate" style="color:black">Date of visit</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->visitdate) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->visitdate) && !empty($essentialdata->visitdate)? $essentialdata->visitdate : (isset($jobdata->visitdate) ? $jobdata->visitdate : ""); ?>" id="visitdate" name="visitdate" placeholder="Date of visit">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 visitdate">
                    <div class="form-group">
                        <label for="asset_value" style="color:black">Approx asset value</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->asset_value) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->asset_value) && !empty($essentialdata->asset_value)? $essentialdata->asset_value : (isset($jobdata->asset_value) ? $jobdata->asset_value : ""); ?>" id="asset_value" name="asset_value" placeholder="Approx asset value">
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
                <input class="btn case_btn toggle-edit" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="assets_valuation_submit_indivi">
            </div>
        </div>
    </form>
</div>