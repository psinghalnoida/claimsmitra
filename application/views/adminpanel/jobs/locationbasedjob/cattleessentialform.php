<div class="panel ">
    <form id="essentialForm" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">  
                  <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" 
                       id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                  <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                  <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
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
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <select class="form-control salutation" id="salutation" name="salutation" <?php echo isset($essentialdata->salutation) ? 'disabled' : ''; ?>>
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
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->date_of_report) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->date_of_report) ? format_date($essentialdata->date_of_report, 'd-m-Y') : ""; ?>" id="date_of_report" name="date_of_report" placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of owner &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo (isset($essentialdata->insured_name) || isset($essentialdata->nameofowner)) ? "disabled" : "enable"; ?>
                            value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name) ? $essentialdata->insured_name : (isset($essentialdata->nameofowner) ? $essentialdata->nameofowner : ""); ?>" name="insured_name" id="insured_name" placeholder="Name of Owner">
                    </div>
                </div>
            
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">District &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->district) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->district) ? $essentialdata->district : ""; ?>" name="district" id="district" placeholder="Enter your district">

                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">State &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->state) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->state) ? $essentialdata->state : ""; ?>" name="state" id="state" placeholder="Enter your state">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="periodOfCoverage" style="color: black;">Period of Coverage &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->periodOfCoverage) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->periodOfCoverage) ? $essentialdata->periodOfCoverage : ""; ?>" id="periodOfCoverage" name="periodOfCoverage" placeholder="Select Date">
                    </div>
                </div>
            
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="dateOfDisease" style="color:black">Date of disease &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->dateOfDisease) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->dateOfDisease) ? format_date($essentialdata->dateOfDisease, 'd-m-Y') : ""; ?>" name="dateOfDisease" id="dateOfDisease" placeholder="Select Date">
                    </div>
                </div>
               
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="tagNumber" style="color:black">Tag Number &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->tagNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->tagNumber) && !empty($essentialdata->tagNumber) 
                                        ? $essentialdata->tagNumber 
                                        : (isset($jobdata->tagNumber) ? $jobdata->tagNumber : ""); ?>" name="tagNumber" id="tagNumber" placeholder="Tag Number">
                    </div>
                </div>

            
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="typeOfanimal" style="color:black">Type Of Animal &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="typeOfAnimal" name="typeOfAnimal" <?php echo isset($essentialdata->typeOfAnimal) ? 'disabled' : ''; ?>>
                            <option selected disabled>Choose an animal</option>
                            <option value="Calf" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Calf' ? 'selected' : ''; ?>>Calf</option>
                            <option value="Buff" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Buff' ? 'selected' : ''; ?>>Buff</option>
                            <option value="Cow" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Cow' ? 'selected' : ''; ?>>Cow</option>
                            <option value="Buffalo" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Buffalo' ? 'selected' : ''; ?>>Buffalo</option>
                            <option value="Bull" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Bull' ? 'selected' : ''; ?>>Bull</option>
                            <option value="Horse" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Horse' ? 'selected' : ''; ?>>Horse</option>
                            <option value="Yak" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Yak' ? 'selected' : ''; ?>>Yak</option>
                            <option value="Camel" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Camel' ? 'selected' : ''; ?>>Camel</option>
                            <option value="Donkey" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Donkey' ? 'selected' : ''; ?>>Donkey</option>
                            <option value="Goat" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Goat' ? 'selected' : ''; ?>>Goat</option>
                            <option value="Sheep" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Sheep' ? 'selected' : ''; ?>>Sheep</option>
                            <option value="Pig" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Pig' ? 'selected' : ''; ?>>Pig</option>
                            <option value="Ox" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Ox' ? 'selected' : ''; ?>>Ox</option>
                            <option value="Mule" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Mule' ? 'selected' : ''; ?>>Mule</option>

                        </select>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="dateOfDeath" style="color: black;">Select date of death &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->dateOfDeath) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->dateOfDeath) ? format_date($essentialdata->dateOfDeath, 'd-m-Y') : ""; ?>" id="dateOfDeath" name="dateOfDeath"  placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="dateOfDeath" style="color: black;">Select time of death &nbsp; <span style="color:red">*</span> </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->timeOfDeath) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->timeOfDeath) ? $essentialdata->timeOfDeath : ""; ?>" id="timeOfDeath" name="timeOfDeath" placeholder="Select Time">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="dateTimeOfSurvey" style="color:black">Select Survey Date &nbsp;<span style="color:red">* </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->dateOfSurvey) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->dateOfSurvey) ? format_date($essentialdata->dateOfSurvey, 'd-m-Y') : ""; ?>" name="dateOfSurvey" id="dateOfSurvey" placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="dateTimeOfSurvey" style="color:black">Select Survey Time &nbsp;<span style="color:red">* </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->timeOfSurvey) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->timeOfSurvey) ? $essentialdata->timeOfSurvey : ""; ?>" id="timeOfSurvey" name="timeOfSurvey" placeholder="Select Time">
                    </div>
                </div>

            
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="days_between_policy_and_disease" style="color:black">Days Between Policy and Disease Start &nbsp;<span style="color:red">* <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->days_between_policy_and_disease) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->days_between_policy_and_disease) ? $essentialdata->days_between_policy_and_disease : ""; ?>" id="days_between_policy_and_disease" placeholder="Days Between Policy and Disease Start" name="days_between_policy_and_disease" disabled>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="deathOrDisablement" style="color:black">Death / Disablement&nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="deathOrDisablement" name="deathOrDisablement" <?php echo isset($essentialdata->deathOrDisablement) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Death" <?php echo isset($essentialdata->deathOrDisablement) && $essentialdata->deathOrDisablement == 'Death' ? 'selected' : ''; ?>>Death</option>
                            <option value="Disablement" <?php echo isset($essentialdata->deathOrDisablement) && $essentialdata->deathOrDisablement == 'Disablement' ? 'selected' : ''; ?>>Disablement</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="SurveyConducted" style="color:black">Survey Conducted Same day of death &nbsp;<span style="color:red; ">*</span></label>
                        <select class="form-control editable-field" id="SurveyConducted" name="SurveyConducted" <?php echo isset($essentialdata->SurveyConducted) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->SurveyConducted ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->SurveyConducted ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
           
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="tag_tempered" style="color:black">Tag Tempered &nbsp;<span style="color:red">*</label>
                        <select class="form-control editable-field" id="tag_tempered" name="tag_tempered" <?php echo isset($essentialdata->tag_tempered) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->tag_tempered ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->tag_tempered ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($essentialdata->tag_tempered ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="cattle_buried" style="color:black">Cattle Buried &nbsp;<span style="color:red">*</label>
                        <select class="form-control editable-field" id="cattle_buried" name="cattle_buried" <?php echo isset($essentialdata->cattle_buried) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($essentialdata->cattle_buried ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($essentialdata->cattle_buried ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="totalDays" style="color:black">Remark </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->remark) ? $essentialdata->remark : ""; ?>" id="remark" placeholder="Remark" name="remark">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group" id="whysurveyNotcon" style="display: <?php echo ($essentialdata->SurveyConducted ?? '') == 'No' ? 'block' : 'none'; ?>;">
                        <label for="whysurveyNotConducted" style="color:black;">Reason for not conducting survey&nbsp;<span style="color:red;">*</span></label>
                        <select class="form-control editable-field" id="whysurveyNotConducted" name="whysurveyNotConducted" <?php echo isset($essentialdata->whysurveyNotConducted) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="surveylateconducted_1" <?php echo ($essentialdata->whysurveyNotConducted ?? '') == 'surveylateconducted_1' ? 'selected' : ''; ?>>Received late intimation</option>
                            <option value="surveylateconducted_2" <?php echo ($essentialdata->whysurveyNotConducted ?? '') == 'surveylateconducted_2' ? 'selected' : ''; ?>>Owner not available</option>
                            <option value="surveylateconducted_3" <?php echo ($essentialdata->whysurveyNotConducted ?? '') == 'surveylateconducted_3' ? 'selected' : ''; ?>>Weather not permitting</option>
                            <option value="surveylateconducted_4" <?php echo ($essentialdata->whysurveyNotConducted ?? '') == 'surveylateconducted_4' ? 'selected' : ''; ?>>Animal not available / already buried</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- <div class="row my-3">
                <div class="col-xl-6 col-md-6">
                    <div class="form-group" id="whysurveyNotcon">
                        <label for="whysurveyNotConducted" style="color:black;">Photographs for ILA<span style="color:red;">*</span></label>
                        <div id="ila_images" class="pdf_thumb row" style="border-style: solid;border-width: 1px; border-color: lightgrey;height:auto; min-height:100px; margin-left:0px; margin-right: 0px;">
                            <a class="btn case_btn open-modal" type="button" style="max-height:40px;max-width:40px;"  data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;"><i class="fa-solid fa-upload"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="form-group" id="whysurveyNotcon">
                        <label for="whysurveyNotConducted" style="color:black;">Photographs for Photo Sheet<span style="color:red;">*</span></label>
                        <div id="ila_images" class="pdf_thumb row" style="border-style: solid;border-width: 1px; border-color: lightgrey;height:auto; min-height:100px; margin-left:0px; margin-right: 0px;">
                            <a class="btn case_btn open-modal" type="button" style="max-height:40px;max-width:40px;"  data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;"><i class="fa-solid fa-upload"></i></a>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="essential_submit">
            </div>
        </div>
    </form>
</div>