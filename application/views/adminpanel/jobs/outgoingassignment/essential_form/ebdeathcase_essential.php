<div class="panel pb-4">
    <form id="eb_deathcase_investigation_indivi" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
            <div class="button d-flex justify-content-end">
                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid .'/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name)? $essentialdata->contact_person_name: (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile)
                          ? $essentialdata->contact_person_mobile : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)? $essentialdata->case_reference                                                                                                                                                     : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of insured &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field insured_name" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name)
                               ? $essentialdata->insured_name: (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Insured Name" required>
                            <div class="input-group-append venor-btn">
                                <a data-toggle="modal" data-target="#vendorModal" data-modal-type="insured_name" class="btn btn-rounded btn-info venorbtn " <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?>
                                    href="#" style="padding: 10px 12px;">
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                  <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policytype" style="color:black">Type of Policy &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field" id="policytype" name="policytype" <?php echo isset($essentialdata->policytype) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Group Personal accident" <?php echo ($essentialdata->policytype ?? '') == 'Group Personal accident' ? 'selected' : ''; ?>>Group Personal accident</option>
                            <option value="Motor vehicle TP" <?php echo ($essentialdata->policytype ?? '') == 'Motor vehicle TP' ? 'selected' : ''; ?>>Motor vehicle TP</option>
                            <option value="Workman compulsation" <?php echo ($essentialdata->policytype ?? '') == 'Workman compulsation' ? 'selected' : ''; ?>>Workman compulsation</option>
                            <option value="Employee Benefits" <?php echo ($essentialdata->policytype ?? '') == 'Employee Benefits' ? 'selected' : ''; ?>>Employee Benefits</option>
                            <option value="Other" <?php echo ($essentialdata->policytype ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                  <div class="col-xl-4 col-md-4" 
                     id="otherPolicyTypeDiv" 
                     style="<?php echo isset($essentialdata->otherPolicyType) && !empty($essentialdata->otherPolicyType) ? '' : 'display: none;'; ?>">
                    <div class="form-group">
                        <label for="otherPolicyType" style="color:black">
                            Specify Other Policy &nbsp;<span style="color:red;">*</span>
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="otherPolicyType" 
                               name="otherPolicyType" 
                               placeholder="Enter policy type" 
                               <?php echo isset($essentialdata->otherPolicyType) ? 'disabled' : ''; ?> 
                               value="<?php echo isset($essentialdata->otherPolicyType) ? htmlspecialchars($essentialdata->otherPolicyType) : ''; ?>">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber)
                               ? $essentialdata->policyNumber: (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                    </div>
                </div>
                 <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validityfrom" style="color:black">
                            Policy Date (From) 
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field  policy_number_from" <?php echo isset($essentialdata->policyNumberfrom) ? "disabled" : ""; ?>
                             value="<?php echo isset($essentialdata->policyNumberfrom) ? $essentialdata->policyNumberfrom : ""; ?>" id="policyNumberfrom" name="policyNumberfrom" placeholder="From">
                            <div class="input-group-append disabledbtn <?php echo isset($essentialdata->policyNumberfrom) ? "disabled" : ""; ?>">
                                <span class="input-group-text policy_number_from_btn disabledbtn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validity" style="color:black">
                            Policy Date (To) 
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field policy_number_to" <?php echo isset($essentialdata->policyNumberto) ? "disabled" : ""; ?>
                             value="<?php echo isset($essentialdata->policyNumberto) ? $essentialdata->policyNumberto : ""; ?>" id="policyNumberto" name="policyNumberto" placeholder="To">
                            <div class="input-group-append disabledbtn <?php echo isset($essentialdata->policyNumberto) ? "disabled" : ""; ?>">
                                <span class="input-group-text policy_number_to_btn disabledbtn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                  
                  <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="address" style="color:black">Address &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->address) ? $essentialdata->address : ""; ?>" id="address" name="address" placeholder="Address">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="affected_person" style="color:black">Name of affected person </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->affected_person) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->affected_person) ? $essentialdata->affected_person : ""; ?>" id="address" name="affected_person" placeholder="Name of affected person">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="loss_amt" style="color:black">Loss Amount </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->loss_amt) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->loss_amt) ? $essentialdata->loss_amt : ""; ?>" id="loss_amt" name="loss_amt" placeholder="Loss Amount">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="cause_loss" style="color:black">Cause of loss &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->cause_loss) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->cause_loss) ? $essentialdata->cause_loss : ""; ?>" id="cause_loss" name="cause_loss" placeholder="Cause of loss">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="fir" style="color:black">FIR </label>
                        <select class="form-control editable-field" id="fir" name="fir" <?php echo isset($essentialdata->fir) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->fir ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->fir ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($essentialdata->fir ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label style="color:black">Date & Time of Loss</label>
                        <div class="input-group">
                            <!-- Date of Loss -->
                            <input type="text" class="form-control editable-field"
                                <?php echo isset($essentialdata->loss_data) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->loss_data) ? $essentialdata->loss_data : ""; ?>"
                                name="loss_data"
                                id="loss_data"
                                placeholder="Loss Date"  style="margin-right:8px;">
                            <input type="hidden"
                                class="form-control editable-field loss_date_text"
                                value="<?php echo isset($essentialdata->loss_date_text) ? $essentialdata->loss_date_text : ""; ?>"
                                name="loss_date_text">
                            <!-- Time of Loss -->
                            <input type="time" class="form-control editable-field"
                                <?php echo isset($essentialdata->loss_time) ? "disabled" : ""; ?>
                                value="<?php echo isset($essentialdata->loss_time) ? $essentialdata->loss_time : ""; ?>"
                                name="loss_time"
                                id="loss_time" style="margin-right:8px;">
                            <!-- Button -->
                            <button type="button" class="btn btn-info toggle-manual-entry"
                                id="toggleManualEntry">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                            </button>
                        </div>
                        <!-- Loss Date Text -->
                        <div class="text-success mt-1 loss_date_text">
                            <?php echo isset($essentialdata->loss_date_text) ? $essentialdata->loss_date_text : ""; ?>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="cause_inspection" style="color:black">Reason of Inspection &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field cause_inspection" id="cause_inspection" name="cause_inspection" <?php echo isset($essentialdata->cause_inspection) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Death" <?php echo ($essentialdata->cause_inspection ?? '') == 'Death' ? 'selected' : ''; ?>>Death</option>
                            <option value="Injury" <?php echo ($essentialdata->cause_inspection ?? '') == 'Injury' ? 'selected' : ''; ?>>Injury</option>
                            <option value="Others" <?php echo ($essentialdata->cause_inspection ?? '') == 'Others' ? 'selected' : ''; ?>>Other</option>                           
                        </select>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4" 
                     id="otherReasonDiv" 
                     style="<?php echo isset($essentialdata->otherReason) && !empty($essentialdata->otherReason) ? '' : 'display: none;'; ?>">
                    <div class="form-group">
                        <label for="otherReason" style="color:black">
                            Specify other reason&nbsp;<span style="color:red;">*</span>
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="otherReason" 
                               name="otherReason" 
                               placeholder="Specify other reason" 
                               <?php echo isset($essentialdata->otherReason) ? 'disabled' : ''; ?> 
                               value="<?php echo isset($essentialdata->otherReason) ? htmlspecialchars($essentialdata->otherReason) : ''; ?>">
                    </div>
                </div> 
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="inspection_place" style="color:black">Place of Inspection </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->inspection_place) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->inspection_place) ? $essentialdata->inspection_place : ""; ?>" id="inspection_place" name="inspection_place" placeholder="Place of Inspection">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks</label>
                        <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> id="remark" placeholder="Remarks" name="remark"><?php echo isset($essentialdata->remark) ? htmlspecialchars($essentialdata->remark) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="eb_deathcase_investigation_submit_indivi">
            </div>
        </div>
    </form>
</div>