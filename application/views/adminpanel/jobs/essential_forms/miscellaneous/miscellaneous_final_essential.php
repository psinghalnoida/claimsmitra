<div class="panel ">
    <form id="miscellaneous_essential" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . ''); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <i class="fa-solid fa-upload"></i></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <i class="fa-solid fa-upload"></i></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <!-- FORM START -->
            <div class="row my-3">
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
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->date_of_report) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" id="date_of_report" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <!-- <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of owner &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo (isset($essentialdata->insured_name) || isset($essentialdata->nameofowner)) ? "disabled" : "enable"; ?>
                            value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name) ? $essentialdata->insured_name : (isset($essentialdata->nameofowner) ? $essentialdata->nameofowner : ""); ?>" name="insured_name" id="insured_name" placeholder="Name of Owner" required>
                    </div>
                </div> -->
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) ? $essentialdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name of Insured">
                    </div>
                </div>
            </div>
            <div class="row my-3">
               
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
            </div>

            <div class="row my-3">
               
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policyNumberfrom" style="color:black">Policy Number(From) </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumberfrom) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumberfrom) ? $essentialdata->policyNumberfrom : ""; ?>" id="policyNumberfrom" name="policyNumberfrom" placeholder="From">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policyNumberto" style="color:black">Policy Number(To) </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumberto) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumberto) ? $essentialdata->policyNumberto : ""; ?>" id="policyNumberto" name="policyNumberto" placeholder="To">
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
                
            </div>
             <div class="row my-3">
               
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="loss_data" style="color:black">Date of Loss &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->loss_data) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->loss_data) ? $essentialdata->loss_data : ""; ?>" id="loss_data" name="loss_data" placeholder="Date of Loss">
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
            </div>
            <div class="row my-3">
              
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="investigation_date" style="color:black">Date of Investigation &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->investigation_date) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->investigation_date) ? $essentialdata->investigation_date : ""; ?>" id="investigation_date" name="investigation_date" placeholder="Date of Investigation">
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
            </div>
            <div class="row my-3">
               
                
                <div class="col-xl-4 col-md-4"
                    id="otherPolicyTypeDiv"
                    style="<?php echo isset($essentialdata->otherPolicyType) && !empty($essentialdata->otherPolicyType) ? '' : 'display: none;'; ?>">
                    <div class="form-group">
                        <label for="otherPolicyType" style="color:black">
                            Specify Other Policy 
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

                <div class="col-xl-4 col-md-4"
                    id="other_nature_TypeDiv"
                    style="<?php echo isset($essentialdata->other_nature_Type) && !empty($essentialdata->other_nature_Type) ? '' : 'display: none;'; ?>">
                    <div class="form-group">
                        <label for="other_nature_Type" style="color:black">
                            Specify Other Nature of Job
                        </label>
                        <input type="text"
                            class="form-control"
                            id="other_nature_Type"
                            name="other_nature_Type"
                            placeholder="Other Nature of Loss"
                            <?php echo isset($essentialdata->other_nature_Type) ? 'disabled' : ''; ?>
                            value="<?php echo isset($essentialdata->other_nature_Type) ? htmlspecialchars($essentialdata->other_nature_Type) : ''; ?>">
                    </div>
                </div>
             <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="fidelity" style="color:black">Fidelity </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->fidelity) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->fidelity) ? $essentialdata->fidelity : ""; ?>" id="fidelity" name="fidelity" placeholder="Fidelity">
                    </div>
                </div>
            </div>


            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="miscellaneous_submit">
            </div>
        </div>
    </form>
</div>

