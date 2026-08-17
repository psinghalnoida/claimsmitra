<div class="panel pb-4">
    <form id="marine_predis_essential" method="post" enctype="multipart/form-data">
          <input type="hidden" class="assignmentType" value="<?= $assignmentType ?>">
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name) ? $essentialdata->contact_person_name : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile) ? $essentialdata->contact_person_mobile : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color:black">Date of Report<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) && !empty($essentialdata->date_of_report) ? $essentialdata->date_of_report : (isset($jobdata->date_of_report) ? $jobdata->date_of_report : ""); ?>" id="date_of_report" name="date_of_report" placeholder="Date of Report" required>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Place of Survey<span style="color:red"> *</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->survey_place) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_place) && !empty($essentialdata->survey_place) ? $essentialdata->survey_place : (isset($jobdata->address) ? $jobdata->address : ""); ?>" id="survey_place" name="survey_place" placeholder="Place of Survey" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)? $essentialdata->case_reference: (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="consignment" style="color:black">Consignment </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->consignment) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->consignment) ? $essentialdata->consignment : ""; ?>" id="consignment" name="consignment" placeholder="Consignment">
                    </div>
                </div> 
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
                        <label for="policy" style="color:black">Policy </label>
                        <select class="form-control editable-field" id="policy" name="policy" <?php echo isset($essentialdata->policy) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Existing" <?php echo ($essentialdata->policy ?? '') == 'Existing' ? 'selected' : ''; ?>>Existing</option>
                            <option value="Expiry" <?php echo ($essentialdata->policy ?? '') == 'Expiry' ? 'selected' : ''; ?>>Expiry</option>
                            <option value="NA" <?php echo ($essentialdata->policy ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
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
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Proposer &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) ? $essentialdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name of Proposer">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="address" style="color:black">Address of proposer </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->address) ? $essentialdata->address : ""; ?>" id="address" name="address" placeholder="Address">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="inspection_place" style="color:black">Final destination </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->inspection_place) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->inspection_place) ? $essentialdata->inspection_place : ""; ?>" id="inspection_place" name="inspection_place" placeholder="Final destination">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4" id="otherPolicyTypeDiv" style="<?php echo isset($essentialdata->otherPolicyType) && !empty($essentialdata->otherPolicyType) ? '' : 'display: none;'; ?>">
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
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_data" style="color:black">Date of Survey </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field date_of_survey" <?php echo isset($essentialdata->survey_data) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->survey_data) ? format_date($essentialdata->survey_data, 'd-m-Y') : ""; ?>" id="survey_data" name="survey_data" placeholder="Date of Survey">
                            <div class="input-group-append disabledbtn <?php echo isset($essentialdata->policyNumberto) ? "disabled" : ""; ?>">
                                <span class="input-group-text dateofsurveybtn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view("adminpanel/jobs/locationbasedjob/invoicedata") ?>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                      <label for="remark" style="color:black">Remarks</label>
                      <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> id="remark" placeholder="Remarks" name="remark"><?php echo isset($essentialdata->remark) ? htmlspecialchars($essentialdata->remark) : ""; ?></textarea>
                  </div>
                </div>
            </div>
  
  
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="marine_predis_essential_submit">
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