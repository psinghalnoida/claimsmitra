<div class="panel ">
    <form id="mediclaim_essential" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <!-- FORM START -->
            <div class="row ">
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name) ? $essentialdata->contact_person_name: (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
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

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->date_of_report) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->investigation_date) ? format_date($essentialdata->investigation_date, 'd-m-Y') : ""; ?>" id="date_of_report" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) ? $essentialdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name of Insured">
                    </div>
                </div>
           
               
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black">Sum Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->sum_insured) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->sum_insured) ? $essentialdata->sum_insured : ""; ?>" id="sum_insured" name="sum_insured" placeholder="Sum Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="claimant_name" style="color:black">Name of claimant &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claimant_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->claimant_name) ? $essentialdata->claimant_name : ""; ?>" id="claimant_name" name="claimant_name" placeholder="Name of Claimant">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumber) ? $essentialdata->policyNumber : ""; ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                    </div>
                </div>
             
                 <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="permit_validityfrom" style="color:black">
                            Policy Number (From) &nbsp;<span style="color:red">*</span>
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
                            Policy Number (To) &nbsp;<span style="color:red">*</span>
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
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="vehicle_number" style="color:black">Vehicle Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->vehicle_number) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->vehicle_number) && !empty($essentialdata->vehicle_number)
                                        ? $essentialdata->vehicle_number
                                        : (isset($jobdata->vehicle_number) ? $jobdata->vehicle_number : ""); ?>" id="vehicle_number" name="vehicle_number" placeholder="Vehicle Number">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="cause_loss" style="color:black">Cause of Loss &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->cause_loss) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->cause_loss) ? $essentialdata->cause_loss : ""; ?>" id="cause_loss" name="cause_loss" placeholder="Cause of Loss">
                    </div>
                </div>
                
            
               
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="loss_data" style="color:black">Date of Loss &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->loss_data) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->loss_data) ? format_date($essentialdata->loss_data, 'd-m-Y') : ""; ?>" id="loss_data" name="loss_data" placeholder="Date of Loss">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="loss_place" style="color:black">Place of Loss&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->loss_place) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->loss_place) ? $essentialdata->loss_place : ""; ?>" id="loss_place" name="loss_place" placeholder="Place of Loss">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policy_report" style="color:black">Policy Report &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="policy_report" name="policy_report" <?php echo isset($essentialdata->policy_report) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->policy_report ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->policy_report ?? '') == 'No' ? 'selected' : ''; ?>>No</option>   
                        </select>
                    </div>
                </div>
           
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="investigation_date" style="color:black">Date of Investigation &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->investigation_date) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->investigation_date) ? format_date($essentialdata->investigation_date, 'd-m-Y') : ""; ?>" id="investigation_date" name="investigation_date" placeholder="Date of Investigation">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="natureofloss" style="color:black">Nature of Loss &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field" id="natureofloss" name="natureofloss" <?php echo isset($essentialdata->natureofloss) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Injury" <?php echo ($essentialdata->natureofloss ?? '') == 'Injury' ? 'selected' : ''; ?>>Injury</option>
                            <option value="Death" <?php echo ($essentialdata->natureofloss ?? '') == 'Death' ? 'selected' : ''; ?>>Death</option>
                            <option value="PTD" <?php echo ($essentialdata->natureofloss ?? '') == 'PTD' ? 'selected' : ''; ?>>PTD</option>
                            <option value="TTD" <?php echo ($essentialdata->natureofloss ?? '') == 'TTD' ? 'selected' : ''; ?>>TTD</option>
                            <option value="PPD" <?php echo ($essentialdata->natureofloss ?? '') == 'PPD' ? 'selected' : ''; ?>>PPD</option>
                            <option value="Theft" <?php echo ($essentialdata->natureofloss ?? '') == 'Theft' ? 'selected' : ''; ?>>Theft</option>
                            <option value="Other" <?php echo ($essentialdata->natureofloss ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policytype" style="color:black">Type of Policy &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field" id="policytype" name="policytype" <?php echo isset($essentialdata->policytype) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="motor_tp" <?php echo ($essentialdata->policytype ?? '') == 'motor_tp' ? 'selected' : ''; ?>>Motor TP</option>
                            <option value="pa" <?php echo ($essentialdata->policytype ?? '') == 'pa' ? 'selected' : ''; ?>>PA</option>
                            <option value="wc" <?php echo ($essentialdata->policytype ?? '') == 'wc' ? 'selected' : ''; ?>>WC</option>
                            <option value="Other" <?php echo ($essentialdata->policytype ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
              
                <div class="col-xl-4 col-md-4"
                    id="otherPolicyTypeDiv"
                    style="<?php echo isset($essentialdata->otherPolicyType) && !empty($essentialdata->otherPolicyType) ? '' : 'display: none;'; ?>">
                    <div class="form-group ">
                        <label for="otherPolicyType" style="color:black">
                            Specify Other Policy 
                        </label>
                        <input type="text"
                            class="form-control editable-field"
                            id="otherPolicyType"
                            name="otherPolicyType"
                            placeholder="Enter policy type"
                          
                            value="<?php echo isset($essentialdata->otherPolicyType) ? htmlspecialchars($essentialdata->otherPolicyType) : ''; ?>">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4"
                    id="other_nature_TypeDiv"
                    style="<?php echo isset($essentialdata->other_nature_Type) && !empty($essentialdata->other_nature_Type) ? '' : 'display: none;'; ?>">
                    <div class="form-group ">
                        <label for="other_nature_Type" style="color:black">
                            Specify Other Nature of Job
                        </label>
                        <input type="text"
                            class="form-control editable-field"
                            id="other_nature_Type"
                            name="other_nature_Type"
                            placeholder="Other Nature of Loss"
                           
                            value="<?php echo isset($essentialdata->other_nature_Type) ? htmlspecialchars($essentialdata->other_nature_Type) : ''; ?>">
                    </div>
                </div>
            </div>


            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="mediclaim_submit">
            </div>
        </div>
    </form>
</div>

