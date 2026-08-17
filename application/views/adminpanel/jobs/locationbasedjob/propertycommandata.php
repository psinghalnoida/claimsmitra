<style>
    #selectpropertyimg.modal {
        z-index: 1070 !important;
    }

    #selectpropertyimg.modal .modal-backdrop {
        z-index: 1060 !important;
    }

    .dimmed {
        filter: brightness(70%);
        transition: filter 0.1s ease;
    }
</style>

<div class="row">
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="case_reference" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
            <input
                type="text"
                class="form-control editable-field"
                <?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) ? "disabled" : ""; ?>
                value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference)
                            ? $essentialdata->case_reference
                            : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>"
                name="case_reference"
                id="case_reference"
                placeholder="Case Reference">
        </div>
    </div>
    <div class="col-xl-2 col-md-2">
        <div class="form-group">
            <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
            <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" name="date_of_report" placeholder="Select Date" required>
        </div>
    </div>
    <div class="col-xl-2 col-md-2">
        <div class="form-group">
            <label for="insured_name" style="color: black;">Name of insured &nbsp;<span style="color:red">*</label>
            <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name)  ? $essentialdata->insured_name : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Name of insured">
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="contact_person_name" style="color:black">Contact Person Name &nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control editable-field " <?php echo (isset($essentialdata->contact_person_name) || isset($essentialdata->contact_person_name)) ? "disabled" : "enable"; ?>
                value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name)
                            ? $essentialdata->contact_person_name
                            : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" name="contact_person_name" id="contact_person_name" placeholder="Name of Owner">
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="address" style="color:black">Address of insured &nbsp;<span style="color:red">*</span></label>
            <input
                type="text"
                class="form-control editable-field"
                <?php echo isset($essentialdata->address) && !empty($essentialdata->address) ? "disabled" : ""; ?>
                value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address)
                            ? $essentialdata->address
                            : (isset($jobdata->address) ? $jobdata->address : ""); ?>"
                name="address"
                id="address"
                placeholder="Address of insured">
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="loss_data" style="color:black">Date of Loss &nbsp;<span style="color:red">*</span></label>
            <input
                type="text"
                class="form-control editable-field"
                <?php echo isset($essentialdata->loss_data) && !empty($essentialdata->loss_data) ? "disabled" : ""; ?>
                value="<?php echo isset($essentialdata->loss_data) && !empty($essentialdata->loss_data)
                            ? $essentialdata->loss_data
                            : (isset($jobdata->loss_data) ? $jobdata->loss_data : ""); ?>"
                name="loss_data"
                id="loss_data"
                placeholder="Date of Loss">
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="loss_place" style="color:black">Place of Survey &nbsp;<span style="color:red">*</span></label>
            <input
                type="text"
                class="form-control editable-field"
                <?php echo isset($essentialdata->survey_place) && !empty($essentialdata->survey_place) ? "disabled" : ""; ?>
                value="<?php echo isset($essentialdata->survey_place) && !empty($essentialdata->survey_place)
                            ? $essentialdata->survey_place: (isset($jobdata->survey_place) ? $jobdata->survey_place : ""); ?>"
                name="survey_place"
                id="survey_place"
                placeholder="Place of Survey">
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="contact_person_mobile" style="color:black">Contact Person Number &nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control editable-field " <?php echo (isset($essentialdata->contact_person_mobile) || isset($essentialdata->contact_person_mobile)) ? "disabled" : "enable"; ?>
                value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile)
                ? $essentialdata->contact_person_mobile: (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" name="contact_person_mobile" id="contact_person_mobile" placeholder="Name of Owner">
        </div>
    </div>

    <div class="col-xl-2 col-md-2">
        <div class="form-group">
            <label for="Ofinstruction" style="color:black">
                Date of Instruction &nbsp;<span style="color:red">*</span>
            </label>
            <div class="input-group">
                <input type="text" class="form-control editable-field ofinstruction"
                    <?php echo isset($essentialdata->Ofinstruction) ? "disabled" : ""; ?>
                    value="<?php echo isset($essentialdata->Ofinstruction) ? $essentialdata->Ofinstruction : ""; ?>"
                    name="Ofinstruction" placeholder="From">

                <div class="input-group-append disable_btn">
                    <span class="input-group-text ofinstruction_btn disabledbtn" style="cursor: pointer;">
                        <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-2">
        <div class="form-group">
            <label for="instruction_time" style="color:black">Time of Instruction </label>
            <div class="input-group">
                <input type="text"
                    class="form-control editable-field insurancetotime"
                    <?php echo isset($essentialdata->instruction_time) ? "disabled" : ""; ?>
                    value="<?php echo isset($essentialdata->instruction_time) ? $essentialdata->instruction_time : ""; ?>"
                    name="instruction_time"
                    placeholder="Time of Instruction">
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-2">
        <div class="form-group">
            <label for="policyNumberfrom" style="color:black">
                Date of Visit
            </label>
            <div class="input-group">
                <input type="text" class="form-control editable-field visit_date"
                    <?php echo isset($essentialdata->visit_date) ? "disabled" : ""; ?>
                    value="<?php echo isset($essentialdata->visit_date) ? $essentialdata->visit_date : ""; ?>"
                    name="visit_date" placeholder="From">

                <div class="input-group-append disable_btn">
                    <span class="input-group-text visit_date_btn disabledbtn" style="cursor: pointer;">
                        <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-2">
        <div class="form-group">
            <label for="instruction_time" style="color:black">Time of Visit </label>
            <div class="input-group">
                <input type="text"
                    class="form-control editable-field insurancetotime"
                    <?php echo isset($essentialdata->visit_time) ? "disabled" : ""; ?>
                    value="<?php echo isset($essentialdata->visit_time) ? $essentialdata->visit_time : ""; ?>"
                    name="visit_time"
                    placeholder="Time of Instruction">
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="policyNumber" style="color:black">Policy Number &nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control editable-field " <?php echo (isset($essentialdata->policyNumber) || isset($essentialdata->policyNumber)) ? "disabled" : "enable"; ?>
                value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber)? $essentialdata->policyNumber: (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" name="policyNumber" id="policyNumber" placeholder="Policy Details">
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
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="policytype" style="color:black">Type of Policy &nbsp;<span style="color:red">*</span></label>
            <select class="form-control editable-field" id="policytype" name="policytype" <?php echo isset($essentialdata->policytype) ? 'disabled' : ''; ?>>
                <option value="">Select</option>
                <option value="motor_tp" <?php echo ($essentialdata->policytype ?? '') == 'motor_tp' ? 'selected' : ''; ?>>Motor TP</option>
                <option value="pa" <?php echo ($essentialdata->policytype ?? '') == 'pa' ? 'selected' : ''; ?>>PA</option>
                <option value="wc" <?php echo ($essentialdata->policytype ?? '') == 'wc' ? 'selected' : ''; ?>>WC</option>
                <option value="Other" <?php echo ($essentialdata->policytype ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
    </div>

     <div class="col-xl-4 col-md-4" style="display: none;">
        <div class="form-group">
            <label for="otherPolicyType" style="color:black">Other Policy Type &nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->otherPolicyType) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->otherPolicyType) ? $essentialdata->otherPolicyType : ""; ?>" id="otherPolicyType" name="otherPolicyType" placeholder="Other Policy Type">
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="claimant_name" style="color:black">Name of claimant &nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claimant_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->claimant_name) ? $essentialdata->claimant_name : ""; ?>" id="claimant_name" name="claimant_name" placeholder="Name of Claimant">
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="claimant_number" style="color:black">Claimant Mobile Number &nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->claimant_number) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->claimant_number) ? $essentialdata->claimant_number : ""; ?>" id="claimant_number" name="claimant_number" placeholder="Claimant Number">
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="insured_activity" style="color:black">Activity of Insured in Brief &nbsp;<span style="color:red">*</span></label>
            <textarea
                class="form-control editable-field"
                <?php echo isset($essentialdata->insured_activity) && !empty($essentialdata->insured_activity) ? "disabled" : ""; ?>
                name="insured_activity"
                id="insured_activity"><?php echo isset($essentialdata->insured_activity) ? $essentialdata->insured_activity : ""; ?></textarea>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="loss_area" style="color:black">Item Surveyed / Area of Loss (Machine / Stock/FFF / Building ETC) &nbsp;<span style="color:red">*</span></label>
            <textarea
                class="form-control editable-field"
                <?php echo isset($essentialdata->loss_area) && !empty($essentialdata->loss_area) ? "disabled" : ""; ?>
                name="loss_area"
                id="loss_area"><?php echo isset($essentialdata->loss_area) ? $essentialdata->loss_area : ""; ?></textarea>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xl-12 col-md-12">
        <div class="form-group" style="position: relative;">
            <label for="cause_loss" style="color: black; display: flex; align-items: center; width: 100%; margin-bottom: 2px;">
                Cause of loss, its origin & nature & extent of loss &nbsp;<span style="color:red">*</span>
                <button type="button" id="uploadButton" class="btn btn-primary uploadButton" data-toggle="modal" data-target="#descImgmodal" data-modal-type="cause_loss" style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <img src="<?php echo base_url('assets/gallery.png'); ?>" alt="img" style="width: 30px; height: 30px;">
                </button>
            </label>

            <!-- Container for Textarea and Image Upload -->
            <div class="textarea-container" style="position: relative;">
                <!-- Textarea -->
                <textarea
                    class="form-control editable-field"
                    <?php echo isset($essentialdata->cause_loss) && !empty($essentialdata->cause_loss) ? "disabled" : ""; ?>
                    name="cause_loss"
                    id="cause_loss"
                    placeholder="Enter details here"
                    style="padding-right: 40px;"><?php echo isset($essentialdata->cause_loss) ? $essentialdata->cause_loss : ""; ?></textarea>
            </div>
        </div>
    </div>
</div>
<div id="descrplist" class="mt-3"></div>
<div class="row ">
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="observation" style="color: black; display: flex; align-items: center; width: 100%; margin-bottom: 2px;">
                Observation

                <button type="button" id="uploadButton" class="btn btn-primary uploadButton" data-toggle="modal" data-target="#descImgmodal" data-modal-type="observation" style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <img src="<?php echo base_url('assets/gallery.png'); ?>" alt="img" style="width: 30px; height: 30px;">
                </button>
                <div style="flex-grow: 1;"></div>
                <div id="observationDataContainer" style="display: flex; gap: 2px; margin-top: 10px;"></div>
            </label>

            <textarea
                class="form-control editable-field"
                <?php echo isset($essentialdata->observation) && !empty($essentialdata->observation) ? "disabled" : ""; ?>
                name="observation"
                id="observation"><?php echo isset($essentialdata->observation) ? $essentialdata->observation : ""; ?></textarea>
        </div>
    </div>
</div>
<div id="observationlist" class="mt-3"></div>

<div class="row ">
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="stocks" style="color:black">Stocks </label>
            <input
                class="form-control editable-field"
                <?php echo isset($essentialdata->stocks) && !empty($essentialdata->stocks) ? "disabled" : ""; ?>
                name="stocks"
                id="stocks" placeholder="Stocks" value="<?php echo isset($essentialdata->stocks) ? $essentialdata->stocks : ""; ?>">
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="pm" style="color:black">P&M</label>
            <input
                class="form-control editable-field"
                <?php echo isset($essentialdata->pm) && !empty($essentialdata->pm) ? "disabled" : ""; ?>
                name="pm" value="<?php echo isset($essentialdata->pm) ? $essentialdata->pm : ""; ?>"
                id="pm" placeholder="P&M">
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="building" style="color:black">Building </label>
            <input
                class="form-control editable-field"
                <?php echo isset($essentialdata->building) && !empty($essentialdata->building) ? "disabled" : ""; ?>
                name="building"
                id="building" value="<?php echo isset($essentialdata->building) ? $essentialdata->building : ""; ?>" placeholder="Building">
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="total" style="color:black">Total </label>
            <input
                class="form-control editable-field"
                <?php echo isset($essentialdata->total) && !empty($essentialdata->total) ? "disabled" : ""; ?>
                name="total" value="<?php echo isset($essentialdata->total) ? $essentialdata->total : ""; ?>"
                id="total" placeholder="Total">
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="recovery" style="color:black">Recoveries and Reductions</label>
            <input
                class="form-control editable-field"
                <?php echo isset($essentialdata->recovery) && !empty($essentialdata->recovery) ? "disabled" : ""; ?>
                name="recovery"
                id="recovery" placeholder="Recoveries and Reductions" value="<?php echo isset($essentialdata->recovery) ? $essentialdata->recovery : ""; ?>">
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="expected_liability" style="color:black">Expected Liability </label>
            <input class="form-control editable-field" <?php echo isset($essentialdata->expected_liability) && !empty($essentialdata->expected_liability) ? "disabled" : ""; ?> name="expected_liability" id="expected_liability" placeholder="Expected Liability" value="<?php echo isset($essentialdata->expected_liability) ? $essentialdata->expected_liability : ""; ?>">
        </div>
    </div>
</div>
<div class="row my-3">
    <div class="col-xl-12 col-md-12">
        <div class="form-group">
            <label for="remark" style="color:black">
                Remark
            </label>
            <textarea name="remark" id="remark" spellcheck="true"
                class="form-control editable-field p-0"  <?php echo isset($essentialdata->remark) && !empty($essentialdata->remark) ? "disabled" : ""; ?>  style="white-space:normal;"><?php echo isset($essentialdata->remark) ? $essentialdata->remark : ""; ?>
                        </textarea>
        </div>
    </div>
</div>

<div class="modal fade" id="descImgmodal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg custom-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Special Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Details -->
                <div class="mb-3">
                    <label for="descrp" class="form-label">Write your statement:</label>
                    <textarea class="form-control" id="descrp" placeholder="Enter your statement here"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Attach a photo:</label>
                    <!-- Hidden file input example (you may replace with your own file input handling) -->
                    <input type="file" id="fileUpload" accept="image/*" multiple style="display: none;">
                    <!-- Button to open inner modal for image upload -->
                    <a class="btn btn-primary" href="javascript:void(0)" id="uploadpropertyimg" data-toggle="modal" data-target="#selectpropertyimg">
                        Upload Images
                    </a>
                    <div id="selectedpropFiles" style="margin-top: 10px; font-size: 14px; color: #555;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:#CA571F;">Close</button>
                <button type="button" class="btn btn-secondary" id="savepropimg">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="selectpropertyimg" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row gutter-20">
                    <div class="col-lg-12">
                        <div class="panel">
                            <!-- <div id="error-message" style="color: red; display: none;"></div>
                            <div id="success-message" style="color: green; display: none;"></div> -->
                            <div class="panel-content">
                                <div class="row">
                                    <?php $index = 1; ?>
                                    <?php foreach ($caseimages as $index => $image) { ?>
                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 mb-3" style="display:flex">
                                            <input type="checkbox" name="image[]" value="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="image-checkbox" id="checkbox_<?php echo $index; ?>" style="align-self:baseline" />
                                            <div class="card border-bottom" style="width:1000%;">
                                                <a href="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" data-fancybox="images">
                                                    <div class="card-img-container">
                                                        <img src="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="card-img-top" alt="Image <?php echo $index; ?>" style="width:125px;height:100px;">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php $index++; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" target="_blank" class="btn btn-success" id="savepropertyimages">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

         function toggleOtherPolicyField() {
        var selectedValue = $("#policytype").val();
        if (selectedValue === "Other") {
            $("#otherPolicyType").closest(".col-xl-4").show();
        } else {
            $("#otherPolicyType").closest(".col-xl-4").hide();
        }
    }

    // Run on page load (to check if "Other" is pre-selected)
    toggleOtherPolicyField();

    // Run when dropdown selection changes
    $("#policytype").change(function () {
        toggleOtherPolicyField();
    });
        //================= OPEN MODAL IN CASE OF EDIT AND NEW STATEMENT =================== 
        // Store modal type globally
        var modalType = '';

        $('#descImgmodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            // Get modalType from the button triggering the modal
            let modalTypeValue = button.data('modal-type');
            if (modalTypeValue) {
                modalType = modalTypeValue; // Update global variable
                $(this).data('modal-type', modalTypeValue); // Store it in modal data
            } else {
                console.warn("modalType is undefined when opening modal.");
            }

            // Get editIndex (for editing existing statements)
            let editIndex = button.data('index');
            if (editIndex !== undefined) {
                $(this).data('editIndex', editIndex); // Store editIndex in modal data
                console.log('Opening modal in EDIT mode for:', modalType);
            }
        });

        // Check modal type when clicking #uploadpropertyimg
        $('#uploadpropertyimg').on('click', function(event) {
            event.stopPropagation();
            event.preventDefault();
            console.log('Opening Image Modal for modal type:', modalType);

            $('#select_images').modal('hide');
            $('#selectpropertyimg').modal('show');
        });

        $('#savepropimg').on('click', function() {
            let modalType = $('#descImgmodal').data('modal-type') || '';
            let editIndex = $('#descImgmodal').data('editIndex');

            console.log("Modal Type on Save:", modalType);
            console.log("Edit Index on Save:", editIndex);

            if (!modalType) {
                console.warn("modalType is undefined on save!");
                return;
            }

            let imgdescrption = $('#descrp').val().trim();
            if (imgdescrption === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Description Required',
                    text: 'Please enter a description before saving.'
                });
                return;
            }

            let imagesArray = [];
            let imagesHtml = '';
            $('#selectedpropFiles img').each(function() {
                let imgSrc = $(this).attr('src');
                imagesArray.push(imgSrc);
                imagesHtml += `<a href="${imgSrc}" class="view-img">
            <img src="${imgSrc}" class="img-thumbnail small-img" style="width:50px;height:50px;object-fit:cover;margin-left:5px;">
            </a>`;
            });

            if (imagesArray.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Images Selected',
                    text: 'Please upload at least one image before saving.'
                });
                return;
            }

            let imgdescrptionData = {
                statement: imgdescrption,
                images: imagesArray
            };
            let jsonData = JSON.stringify(imgdescrptionData);

            let targetContainer, cardClass, inputName;
            if (modalType === 'observation') {
                targetContainer = '#observationlist';
                cardClass = 'observationcard';
                inputName = 'imgobdescrp[]';
            } else if (modalType === 'cause_loss') {
                targetContainer = '#descrplist';
                cardClass = 'statementcard';
                inputName = 'imgdescrp[]';
            } else {
                console.warn("Invalid modalType on save:", modalType);
                return;
            }

            // Check if we are editing an existing card
            if (editIndex !== undefined && editIndex !== null && editIndex !== '') {
                let card = $(`${targetContainer} .${cardClass}[data-index="${editIndex}"]`);

                if (card.length > 0) {
                    console.log("Updating existing card at index:", editIndex);

                    card.find(`input[name="${inputName}"]`).val(jsonData);
                    card.find('.statement-text').text(imgdescrption);
                    card.find('.d-flex.gap-2').html(imagesHtml);
                } else {
                    console.warn("Edit target not found:", targetContainer, "Index:", editIndex);
                }
            } else {
                console.log("Adding new card.");

                let newIndex = $(`${targetContainer} .${cardClass}`).length;
                let newCard = `
                    <div class="${cardClass} card mt-2 p-2 shadow-sm position-relative" data-index="${newIndex}" style="border-color:#ced4da;border-radius:0px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-sm text-white edit-${modalType} px-2 py-1" data-index="${newIndex}" style="background-color:#2BB3C0;width:50px;height:30px;">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger delete-${modalType} ml-2 px-2 py-1" data-index="${newIndex}" style="width:60px;height:30px;border-radius:0px;">
                                    Delete
                                </button>
                            </div>
                            <div class="d-flex gap-2">${imagesHtml}</div>
                        </div>
                        <input type="hidden" name="${inputName}" value='${jsonData}'>
                        <p class="statement-text">${imgdescrption}</p>
                    </div>
                    `;
                $(targetContainer).append(newCard);
            }

            // Clear modal data after saving
            $('#descImgmodal').removeData('editIndex').removeData('modal-type');
            $('#descrp').val('');
            $('#selectedpropFiles').html('');
            $('#descImgmodal').modal('hide');
            $('#selectpropertyimg').modal('hide');
        });

        // ================= SHOW UPLOADED  =================== 
        $(".uploadButton").on("click", function() {
            let modalType = $(this).data("modal-type");
            $("#descImgmodal").attr("data-active-section", modalType);
        });

        // ================= FOR SELCET AND SAVE IMAGES =================== 
        $('#savepropertyimages').on('click', function() {
            let selectedImages = [];

            // Get all checked checkboxes
            $('.image-checkbox:checked').each(function() {
                selectedImages.push($(this).val()); // Store image URL
            });

            if (selectedImages.length === 0) {
                Swal.fire("No images selected!", "Please select at least one image.", "warning");
                return;
            }

            // Generate image previews
            let imageHtml = '';
            selectedImages.forEach(function(src) {
                imageHtml += `<img src="${src}" class="selected-image-preview" style="width:80px; height:80px; margin-right:5px; border-radius:5px;">`;
            });

            // Append to `#selectedpropFiles`
            $('#selectedpropFiles').html(imageHtml);

            // Close the current modal
            $('#selectpropertyimg').modal('hide');
        });

        $('#selectpropertyimg').on('show.bs.modal', function() {
            // Add dim effect to the parent modal's content
            $('#descImgmodal .modal-content').addClass('dimmed');
        });

        // When the inner modal is hidden:
        $('#selectpropertyimg').on('hidden.bs.modal', function() {
            // Remove dim effect from the parent modal's content
            $('#descImgmodal .modal-content').removeClass('dimmed');
        });

        // Save Edited Statement 
        $('#saveStatementBtn').off('click').on('click', function() {
            let index = $('#descImgmodal').data('editIndex');
            let statementValue = $('#descrp').val();

            // Collect remaining images after deletion
            let updatedImages = [];
            $('#selectedpropFiles .image-container img').each(function() {
                updatedImages.push($(this).attr('src'));
            });

            // Update the hidden input field with new data (without heading)
            let updatedData = JSON.stringify({
                statement: statementValue,
                images: updatedImages
            }).replace(/"/g, '&quot;'); // Escape JSON for hidden input

            $(`div[data-index="${index}"] input[name="imgdescrption[]"]`).val(updatedData);

            // Update UI
            $(`div[data-index="${index}"] .statement-text`).text(statementValue);

            $('#descImgmodal').modal('hide'); // Close modal
        });

        var statements = <?php echo json_encode(isset($essentialdata->imgdescrps) ? $essentialdata->imgdescrps : 'NA'); ?>;
        var observationstatement = <?php echo json_encode(isset($essentialdata->imgobdescrp) ? $essentialdata->imgobdescrp : 'NA'); ?>;

        if (statements !== "NA" && statements !== null && statements !== "null") {
            populateCards('descrplist', statements, 'statement');
        }

        if (observationstatement !== "NA" && observationstatement !== null && observationstatement !== "null") {
            populateCards('observationlist', observationstatement, 'observation');
        }

        // ================= POPULATE CARDS (Reusable Function) =================== 
        function populateCards(containerId, data, type) {
            const container = $('#' + containerId);
            container.empty();
            const dataArray = Array.isArray(data) ? data : [data];

            dataArray.forEach((item, index) => {
                let imagesHtml = generateImagesHtml(item.images, `${type}-${index}`, item.statement);
                // Use a different name for observations vs. statements:
                let inputName = type === 'observation' ? 'imgobdescrp[]' : 'imgdescrp[]';
                let jsonData = JSON.stringify(item).replace(/"/g, '&quot;'); // Escape JSON for hidden input

                let newCard = `
                    <div class="${type}card card mt-2 p-2 shadow-sm position-relative" data-index="${index}" style="border-color:#ced4da;border-radius:0px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-sm text-white edit-${type} px-2 py-1" data-index="${index}" 
                                    style="background-color:#2BB3C0;width:50px;height:30px;">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger delete-${type} ml-2 px-2 py-1" style="width:60px;height:30px;border-radius:0px" data-index="${index}">
                                    Delete
                                </button>
                            </div>
                            <div class="d-flex gap-2">${imagesHtml}</div>
                        </div>
                        <input type="hidden" name="${inputName}" value='${jsonData}'>
                        <p class="statement-text">${item.statement || ''}</p>
                    </div>
                    `;
                container.append(newCard);
            });

            // Reinitialize Fancybox
            $('[data-fancybox]').fancybox();

            // Enable sorting
            container.sortable({
                placeholder: "sortable-placeholder",
                update: function() {
                    type === 'statement' ? updateStatementOrder() : updateObservationOrder();
                }
            }).disableSelection();
        }

        // ================= GENERATE IMAGE HTML (Reusable) =================== 
        function generateImagesHtml(images, galleryName, caption) {
            if (!images || !Array.isArray(images) || images.length === 0) return '';

            return images.map(imgSrc => `
                <a href="${imgSrc}" class="view-img" data-fancybox="gallery-${galleryName}" data-caption="${caption || ''}">
                    <img src="${imgSrc}" class="img-thumbnail small-img" 
                    style="width: 50px; height: 50px; object-fit: cover; margin-left: 5px;">
                </a>
            `).join('');
        }

        // ================= FOR DRAG AND DROP CARDS =================== 
        function updateStatementOrder() {
            let updatedOrder = [];
            $('.statementcard').each(function(index) {
                let data = JSON.parse($(this).find('input[name="imgdescrption[]"]').val());
                updatedOrder.push(data);
                $(this).attr('data-index', index);
            });
            console.log("Updated Statement Order:", updatedOrder);
        }

        function updateObservationOrder() {
            let updatedOrder = [];
            $('.observationcard ').each(function(index) {
                let data = JSON.parse($(this).find('input[name="imgdescrption[]"]').val());
                updatedOrder.push(data);
                $(this).attr('data-index', index);
            });
            console.log("Updated Statement Order:", updatedOrder);
        }

        $(document).off('click', '.delete-statement, .delete-observation').on('click', '.delete-statement, .delete-observation', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index');
            let type = $(this).hasClass('delete-statement') ? "statement" : "observation"; // Determine type
            let cardSelector = `.${type}card[data-index="${index}"]`;

            Swal.fire({
                title: "Are you sure?",
                text: `This ${type} will be removed!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(cardSelector).remove();
                    type === "statement" ? updateStatementOrder() : updateObservationOrder();
                    Swal.fire("Deleted!", `The ${type} has been removed.`, "success");
                }
            });
        });

        // ================= EDIT STATEMENT ===================
        $(document).off('click', '.edit-statement').on('click', '.edit-statement', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index');
            let imgdescrption = $(`.statementcard[data-index="${index}"] input[name="imgdescrp[]"]`).val();

            console.log("Editing statement:", imgdescrption);

            if (imgdescrption) {
                let statement = JSON.parse(imgdescrption);
                let statementValue = statement.statement || '';

                // Set modal data attributes
                $('#descrp').val(statementValue);
                $('#descImgmodal').data('editIndex', index).data('modal-type', 'cause_loss'); // Store modal type

                // Clear and populate image container
                $('#selectedpropFiles').html('');
                if (statement.images && statement.images.length > 0) {
                    statement.images.forEach((imgSrc, imgIndex) => {
                        $('#selectedpropFiles').append(`
                <div class="position-relative d-inline-block image-container" data-img-index="${imgIndex}">
                    <img src="${imgSrc}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; margin: 5px;">
                    <button class="btn btn-sm btn-danger delete-image-modal" style="background-color: transparent; position: absolute; top: 7px; right: 7px; border-radius: 50%; padding: 2px 5px; font-size: 19px; border:none;">X</button>
                </div>
            `);
                    });
                }

                // Open the modal
                $('#descImgmodal').modal('show');
            }
        });

        // ================= EDIT OBSERVATION ===================
        $(document).off('click', '.edit-observation').on('click', '.edit-observation', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index');
            let imgdescrption = $(`.observationcard[data-index="${index}"] input[name="imgobdescrp[]"]`).val();

            console.log("Editing observation:", imgdescrption);

            if (imgdescrption) {
                let observation = JSON.parse(imgdescrption);
                let observationValue = observation.statement || '';

                // Set modal data attributes
                $('#descrp').val(observationValue);
                $('#descImgmodal').data('editIndex', index).data('modal-type', 'observation'); // Store modal type

                // Clear and populate image container
                $('#selectedpropFiles').html('');
                if (observation.images && observation.images.length > 0) {
                    observation.images.forEach((imgSrc, imgIndex) => {
                        $('#selectedpropFiles').append(`
                <div class="position-relative d-inline-block image-container" data-img-index="${imgIndex}">
                    <img src="${imgSrc}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; margin: 5px;">
                    <button class="btn btn-sm btn-danger delete-image-modal" style="background-color: transparent; position: absolute; top: 7px; right: 7px; border-radius: 50%; padding: 2px 5px; font-size: 19px; border:none;">X</button>
                </div>
            `);
                    });
                }

                // Open the modal
                $('#descImgmodal').modal('show');
            }
        });

        // ================= HANDLE IMAGE DELETION INSIDE MODAL ===================
        $(document).off('click', '.delete-image-modal').on('click', '.delete-image-modal', function() {
            $(this).parent().remove(); // Remove the image container
        });

        // ================= DISABLE FIELDS IN EDIT MODE ===================
        $(".toggle-edit").each(function() {
            let buttonText = $(this).val();

            if (buttonText === "Edit") {
                $(".statementcard, .observationcard").css("background-color", "#e9ecef"); // Grey background
                $(".edit-statement, .delete-statement, .edit-observation, .delete-observation, .uploadButton, .editable-field,.disable_btn").prop("disabled", true);

                $(".small-img").removeAttr("data-fancybox").addClass("disabled-img").css("opacity", "0.5");
                $(".disabledbtn").addClass('disabled-btn');
            } else {
                // Reset styles and re-enable inputs
                $(".statementcard, .observationcard").css("background-color", ""); // Remove background color
                $(".edit-statement, .delete-statement, .edit-observation, .delete-observation, .uploadButton, .editable-field,.disable_btn").prop("disabled", false);

                // Re-enable Fancybox and restore opacity
                $(".small-img").attr("data-fancybox", "gallery").removeClass("disabled-img").css("opacity", "1");
                $(".disabledbtn").removeClass('disabled-btn');
            }
        });

    });
</script>