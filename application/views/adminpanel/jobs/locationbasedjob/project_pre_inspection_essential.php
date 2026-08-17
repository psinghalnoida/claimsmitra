<div class="panel pb-4">
    <form id="project_preins_essential" method="post" enctype="multipart/form-data">
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
             <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)? $essentialdata->case_reference                                                                                                                                                     : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? format_date($essentialdata->date_of_report, 'd-m-Y') : ""; ?>" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="subject_matter" style="color:black">Subject Matter / Detail of Project / consignment </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->subject_matter) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->subject_matter) ? $essentialdata->subject_matter : ""; ?>" id="subject_matter" name="subject_matter" placeholder="Subject Matter">
                    </div>
                </div>  
            </div>
            <div class="row my-3">
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policytype" style="color:black">Type of Policy &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field" id="policytype" name="policytype" <?php echo isset($essentialdata->policytype) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Marine" <?php echo ($essentialdata->policytype ?? '') == 'Marine' ? 'selected' : ''; ?>>Marine</option>
                            <option value="Property" <?php echo ($essentialdata->policytype ?? '') == 'Property' ? 'selected' : ''; ?>>Property</option>
                            <option value="Fire" <?php echo ($essentialdata->policytype ?? '') == 'Fire' ? 'selected' : ''; ?>>Fire</option>
                            <option value="Motor" <?php echo ($essentialdata->policytype ?? '') == 'Motor' ? 'selected' : ''; ?>>Motor</option>
                            <option value="Other" <?php echo ($essentialdata->policytype ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policy" style="color:black">Policy &nbsp;<span style="color:red;">*</span></label>
                        <select class="form-control editable-field" id="policy" name="policy" <?php echo isset($essentialdata->policy) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Existing" <?php echo ($essentialdata->policy ?? '') == 'Existing' ? 'selected' : ''; ?>>Existing</option>
                            <option value="Expiry" <?php echo ($essentialdata->policy ?? '') == 'Expiry' ? 'selected' : ''; ?>>Expiry</option>
                            <option value="NA" <?php echo ($essentialdata->policy ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->policyNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->policyNumber) ? $essentialdata->policyNumber : ""; ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 policy-dates">
                    <div class="form-group">
                        <label for="policyNumberfrom" style="color:black">Policy Number (From)</label>
                        <input type="text" class="form-control editable-field date_of_report"
                            <?php echo isset($essentialdata->policyNumberfrom) ? "disabled" : ""; ?>
                            value="<?php echo isset($essentialdata->policyNumberfrom) ? format_date($essentialdata->policyNumberfrom, 'd-m-Y') : ""; ?>"
                            id="policyNumberfrom" name="policyNumberfrom" placeholder="From">
                    </div>
                </div>

                <div class="col-xl-2 col-md-2 policy-dates">
                    <div class="form-group">
                        <label for="policyNumberto" style="color:black">Policy Number (To)</label>
                        <input type="text" class="form-control editable-field date_of_report"
                            <?php echo isset($essentialdata->policyNumberto) ? "disabled" : ""; ?>
                            value="<?php echo isset($essentialdata->policyNumberto) ? $essentialdata->policyNumberto : ""; ?>"
                            id="policyNumberto" name="policyNumberto" placeholder="To">
                    </div>
                </div>  
            </div>
            <div class="row my-3">
                  <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Proposer &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) ? $essentialdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name of Proposer">
                    </div>
                </div>
                  <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="address" style="color:black">Address of proposer &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->address) ? $essentialdata->address : ""; ?>" id="address" name="address" placeholder="Address">
                    </div>
                </div>
               
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="cause_inspection" style="color:black">Reason of Inspection &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field" id="cause_inspection" name="cause_inspection" <?php echo isset($essentialdata->cause_inspection) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="New" <?php echo ($essentialdata->cause_inspection ?? '') == 'New' ? 'selected' : ''; ?>>New</option>
                            <option value="Gap" <?php echo ($essentialdata->cause_inspection ?? '') == 'Gap' ? 'selected' : ''; ?>>Gap</option>
                            <option value="Renewal" <?php echo ($essentialdata->cause_inspection ?? '') == 'Renewal' ? 'selected' : ''; ?>>Renewal</option>
                            
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="row my-3"> 
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="inspection_place" style="color:black">Place of Inspection &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->inspection_place) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->inspection_place) ? $essentialdata->inspection_place : ""; ?>" id="inspection_place" name="inspection_place" placeholder="Place of Inspection">
                    </div>
                </div>
               <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black">Sum Proposed </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->sum_insured) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->sum_insured) ? $essentialdata->sum_insured : ""; ?>" id="sum_insured" name="sum_insured" placeholder="Sum Proposed">
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
                        <label for="survey_data" style="color:black">Date of Survey &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->survey_data) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->survey_data) ? format_date($essentialdata->survey_data, 'd-m-Y') : ""; ?>" id="survey_data" name="survey_data" placeholder="Date of Survey">
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
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="project_preins_submit">
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        function togglePolicyFields() {
            if ($('#policy').val() === 'NA') {
                $('.policy-dates').hide(); // Hide policy number fields
            } else {
                $('.policy-dates').show(); // Show policy number fields
            }
        }

        // Call function on page load
        togglePolicyFields();

        // Trigger function on change
        $('#policy').on('change', function () {
            togglePolicyFields();
        });
    });
</script>