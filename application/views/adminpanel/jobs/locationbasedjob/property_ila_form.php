<div class="panel">
    <form id="property_essential_form" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">PROPERTY ESSENTIAL DATA</h3>
             <div class="dropdown">
                <div class="button d-flex justify-content-end">            
                    <!-- <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;"  href="<?php echo base_url('cases/generate_ila/'.$aid.''); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a> -->
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <i class="fa-solid fa-upload"></i></a>
                    <a class="btn case_btn open-modal"  type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <i class="fa-solid fa-upload"></i></a>
                    <a class="btn case_btn"  type="button" href="<?php echo base_url('downloadmedia/'.$aid.''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <!-- FORM START -->
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) ? $essentialdata->case_reference : ""; ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>"  name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="companyselection" style="color:black">Select Insurance Company &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field " <?php echo isset($essentialdata->insurer) ? "disabled" : "enable"; ?> id="insurer" name="insurer" required>
                        </select>
                    </div>
                    <div class="error-message" style="color: red; display: none;">Please select Insurance Company.</div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_client" style="color:black">Insured / Client <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="insured_client" name="insured_client" placeholder="Insured / Client" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="item_stolen" style="color:black">Item Stolen <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="item_stolen" name="item_stolen" placeholder="Item Stolen" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policy_number" style="color:black">Policy Number <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="policy_number" name="policy_number" placeholder="Policy Number" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_allotment_date" style="color:black">Survey Allotment Date <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="survey_allotment_date" name="survey_allotment_date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="property_survey_date" style="color:black">Survey Date <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field property_survey_date" id="property_survey_date" name="property_survey_date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="damage_type" style="color:black">Type of Damage <span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="damage_type" name="damage_type" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cause_of_loss" style="color:black">Cause of Loss <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="cause_of_loss" name="cause_of_loss" placeholder="Cause of Loss" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for=" claimant_representative_during_survey" style="color:black">Claimant's Representative <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id=" claimant_representative_during_survey" name=" claimant_representative_during_survey" placeholder="Claimant's Representative" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claimant_mobile_number" style="color:black">Mobile Number <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="claimant_mobile_number" name="claimant_mobile_number" placeholder="Mobile Number" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Survey Place <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="survey_place" name="survey_place" placeholder="Survey Place" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_loss_property" style="color:black">Date of Loss <span style="color:red">*</span></label>
                        <input type="date" class="form-control editable-field date_of_loss" id="date_of_loss_property" name="date_of_loss_property" placeholder="Date of Loss" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="estimated_loss" style="color:black">Estimated Loss <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="estimated_loss" name="estimated_loss" placeholder="Estimated Loss" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_amount" style="color:black">Salvage Amount / % / Remarks <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="salvage_amount" name="salvage_amount" placeholder="Salvage Amount" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_liability" style="color:black">Loss Liability Net of Salvage <span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" id="loss_liability" name="loss_liability" placeholder="Loss Liability Net of Salvage" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="property_remarks" style="color:black">Remarks </label>
                        <textarea class="form-control editable-field" id="property_remarks" name="property_remarks" placeholder="Remarks" ></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <button class="btn case_btn" type="submit" id="property_submit">Submit</button>
            </div>
        </div>
    </form>
</div>





