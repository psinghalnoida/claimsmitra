<style>
    .table_head {
        text-align: center;
        font-weight: 400;
        /* border: 1px solid #ebebea; */
    }

    #vendorModal {
        padding: 10px 12px;
    }

    .summernote-table {
        width: 100%;
        border-collapse: collapse;
    }

    .summernote-table th,
    .summernote-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }
</style>
<div class="panel ">
    <!-- <div class="panel-heading  pt-4 Essential_heading" style="padding-left:0px; font-size:14px; color:#232A2B;font-weight:700;">Marine Essential Data</div> -->
    <form id="marine_final_inspection" method="post" enctype="multipart/form-data">
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
            <!-- FORM START -->

            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>

            <div class="row">
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <?php
                        $salutation = $essentialdata->salutation ?? $jobdata->salutation ?? '';
                        // Disable if a value exists
                        $isDisabled = (!empty($salutation)) ? 'disabled' : '';
                        ?>
                        <select class="form-control  editable-field" id="salutation" name="salutation" <?= $isDisabled; ?>>
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name)? $essentialdata->contact_person_name: (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile) ? $essentialdata->contact_person_mobile: (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
               
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color: black;">
                            Insured / Client &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field insured_name" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name) ? $essentialdata->insured_name : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Insured Name" required>
                            <div class="input-group-append venor-btn">
                                <a data-toggle="modal" data-target="#vendorModal" data-modal-type="insured_name" 
                                   class="btn btn-rounded btn-info venorbtn <?php echo isset($essentialdata->insured_name) ? 'disabled' : ''; ?>"
                                   href="#" style="padding: 10px 12px;" 
                                   <?php echo isset($essentialdata->insured_name) ? 'disabled' : ''; ?>>
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignor" style="color: black;">
                            Consignor &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control editable-field consignor" <?php echo isset($essentialdata->consignor) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->consignor) && !empty($essentialdata->consignor) ? $essentialdata->consignor : (isset($jobdata->consignor) ? $jobdata->consignor : ""); ?>" name="consignor" id="marine_consignor" placeholder="Consignor">
                            <div class="input-group-append venor-btn disable_btn ">
                                <a data-toggle="modal" data-target="#vendorModal" data-modal-type="consignor" class="btn btn-rounded btn-info venorbtn <?php echo isset($essentialdata->consignor) ? 'disabled' : ''; ?>"
                                    href="#" style="padding: 10px 12px;">
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignor" style="color: black;">
                            Consignee &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                           <input 
                                type="text" 
                                class="form-control editable-field name_of_consignee" 
                                <?php echo (isset($essentialdata->name_of_consignee) && !empty($essentialdata->name_of_consignee)) ? "disabled" : ""; ?> 
                                value="<?php echo isset($essentialdata->name_of_consignee) && !empty($essentialdata->name_of_consignee)
                                ? $essentialdata->name_of_consignee
                                : (isset($jobdata->name_of_consignee) ? $jobdata->name_of_consignee : ""); ?>" 
                                name="name_of_consignee" 
                                id="marine_consignee" 
                                placeholder="Consignee"
                            >


                            <div class="input-group-append venor-btn disable_btn">
                                <a data-toggle="modal" data-target="#vendorModal" data-modal-type="name_of_consignee" class="btn btn-rounded btn-info disable_btn venorbtn <?php echo isset($essentialdata->name_of_consignee) ? 'disabled' : ''; ?>"
                                    href="#" style="padding: 10px 12px;">
                                    <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
               

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo  " style="color:black">Cargo Damged &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->cargo) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->cargo) ? $essentialdata->cargo : ""; ?>" name="cargo" id="cargo" placeholder="Cargo">
                    </div>
                </div>
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
                            placeholder="Case Reference" 
                            required
                        >
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">
                            Date of Report &nbsp;<span style="color:red">*</span>
                        </label>
                        <input type="date" class="form-control editable-field" 
                            <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> 
                            value="<?php echo isset($essentialdata->date_of_report) ? $essentialdata->date_of_report : ""; ?>" 
                            name="date_of_report" 
                           
                            placeholder="Select Date" 
                            required>
                    </div>
                </div>

                  <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Claim No. </label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->claim_no) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->claim_no) ? $essentialdata->claim_no : ""; ?>" name="claim_no" placeholder="Claim No" required>
                    </div>
                </div>
            </div>

            <div class="row">
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
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_allotment_date" style="color:black">Survey Allotment Date</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->survey_allotment_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_allotment_date) ? format_date($essentialdata->survey_allotment_date, 'd-m-Y') : ""; ?>" name="survey_allotment_date" id="survey_allotment_date" placeholder="Survey allotment Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_loss" style="color:black">Type of Damage</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->type_of_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->type_of_loss) ? $essentialdata->type_of_loss : ""; ?>" name="type_of_loss" id="type_of_loss" placeholder="Type of Damage">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cause_loss" style="color:black">Cause of Loss</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->cause_loss) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->cause_loss) ? $essentialdata->cause_loss : ""; ?>" name="cause_loss" id="cause_loss" placeholder="Cause of Loss">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claimant_representative" style="color:black">Claimant's representative during Survey</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->claimant_representative) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->claimant_representative) && !empty($essentialdata->claimant_representative) 
                                            ? $essentialdata->claimant_representative 
                                            : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" name="claimant_representative" id="claimant_representative" placeholder="Claimant's representative during Survey">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="representative_mobile" style="color:black">Mobile no of representative during Survey</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->representative_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->representative_mobile) && !empty($essentialdata->representative_mobile) 
                                            ? $essentialdata->representative_mobile 
                                            : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" name="representative_mobile" id="representative_mobile" placeholder="Mobile number of representative during Survey">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Survey Place</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->survey_place) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_place) ? $essentialdata->survey_place : ""; ?>" name="survey_place" id="survey_place" placeholder="Survey Place">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Pincode</label>
                        <input type="text" class="form-control editable-field pincode" <?php echo isset($essentialdata->pincode) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->pincode) && !empty($essentialdata->pincode) 
                                            ? $essentialdata->pincode 
                                            : (isset($jobdata->location_of_survey) ? $jobdata->location_of_survey : ""); ?>" name="pincode" id="pincode" placeholder="Pincode">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_date" style="color:black">Survey Date</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->survey_date) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->survey_date) ? format_date($essentialdata->survey_date, 'd-m-Y') : ""; ?>" name="survey_date" id="survey_date" placeholder="Survey Date">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy No.</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->policyNumber) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->policyNumber) && !empty($essentialdata->policyNumber) 
                                            ? $essentialdata->policyNumber 
                                            : (isset($jobdata->policyNumber) ? $jobdata->policyNumber : ""); ?>" name="policyNumber" id="policyNumber" placeholder="Policy No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_description" style="color:black">Packing Description</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->packing_description) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->packing_description) ? $essentialdata->packing_description : ""; ?>" name="packing_description" id="packing_description" placeholder="Packing description">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="broker_no" style="color:black">Broker Reference No.</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->broker_no) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->broker_no) ? $essentialdata->broker_no : ""; ?>" name="broker_no" id="broker_no" placeholder="Broker Reference No.">
                    </div>
                </div>
            </div>

            <?php $this->load->view("adminpanel/jobs/locationbasedjob/invoicedata") ?>

            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="claim_assessment" style="color:black">Further Action </span></label>
                        <textarea name="claim_assessment" id="claim_assessment" spellcheck="true" class="form-control editable-field"  <?php echo isset($essentialdata->claim_assessment) ? "disabled" : ""; ?>><?php echo isset($essentialdata->claim_assessment) ? $essentialdata->claim_assessment : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-6 video-div"> <!-- Adjust column size as needed -->
                    <div class="card " style="width: 100%; margin: 2px; cursor: pointer;">
                        <a class="text-center" href="#" data-toggle="modal" data-target="#assessmentModal">Loss Assessment</a>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="marinefinal_essential_submit">
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="assessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 91%;" role="document">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h5 class="modal-title">Loss Assessment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" style=" width: 100%;">
                    <table class="mb-0">
                        <tbody id="data-body-new">
                            <!-- Rows will be dynamically added here -->
                        </tbody>
                    </table>

                    <table class="mt-4 border_collapse">
                        <thead>
                            <tr>
                                <th class="table_head" style="width: 180px; ">Description of Goods</th>
                                <th class="table_head" style="width: 100px;">Unit</th>
                                <th class="table_head">Inv. Qty</th>
                                <th class="table_head">Inv. Amount</th>
                                <th class="table_head">Rate/Unit</th>
                                <th class="table_head">Claimed Units</th>
                                <th class="table_head">Damaged Units</th>
                                <th class="table_head">Loss %</th>
                                <th class="table_head">L/S</th>
                                <th class="table_head">Loss Assd</th>
                                <th class="table_head">Loss Amount</th>
                                <th class="table_head" style="width: 150px;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="form-row">
                            <tr>
                                <td class="col-margin" style="width: 150px;"><input type="text" class="form-control editable-field description_goods" name="description_goods[]" placeholder="Description of Goods"></td>
                                <td style="width: 100px;">
                                    <select class="form-control" name="units">
                                        <option>Select</option>
                                        <option value="unit_1">Cft</option>
                                        <option value="unit_2">Package</option>
                                        <option value="unit_3">Each</option>
                                        <option value="unit_3">Kg</option>
                                        <option value="unit_3">Lot</option>
                                        <option value="unit_3">MT</option>
                                        <option value="unit_3">Mtr</option>
                                        <option value="unit_3">Pieces</option>
                                        <option value="unit_3">Sq Ft</option>
                                        <option value="unit_3">Bag/s</option>
                                        <option value="unit_3">Jar</option>
                                        <option value="unit_3">Carton</option>
                                        <option value="unit_3">Drum</option>
                                        <option value="unit_3">Box</option>
                                        <option value="unit_3">Bundle</option>
                                        <option value="unit_3">Rim</option>
                                        <option value="unit_3">Ltr</option>
                                        <option value="unit_3">KL</option>
                                        <option value="unit_3">Sheet</option>
                                        <option value="unit_3">Reel</option>
                                        <option value="unit_3">Pouches</option>
                                        <option value="unit_3">Item</option>
                                        <option value="unit_3">Unit</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control editable-field only_numbers qty_kg" name="qty_kg[]" placeholder="0.00"></td>
                                <td><input type="text" class="form-control editable-field only_numbers amount_rs" name="amount_rs[]" placeholder="0.00"></td>
                                <td><input type="text" class="form-control editable-field only_numbers rate_kg" name="rate_kg[]" placeholder="0.00"></td>
                                <td><input type="text" class="form-control editable-field only_numbers claimed_bags" name="claimed_bags[]" placeholder="0.00"></td>
                                <td><input type="text" class="form-control editable-field only_numbers dmg_qty" name="dmg_qty[]" placeholder="0.00"></td>
                                <td><input type="text" class="form-control editable-field only_numbers loss_percent" name="loss_percent[]" placeholder="0.00"></td>
                                <td style="width: 30px; text-align: center;">
                                    <input type="checkbox" name="ls" value="" class="" style="display: flex; justify-content: center; align-items: center;">
                                </td>
                                <td><input type="text" class="form-control editable-field only_numbers loss_assd" name="loss_assd[]" placeholder="0.00"></td>
                                <td><input type="text" class="form-control editable-field only_numbers loss_amount" name="loss_amount[]" placeholder="0.00"></td>
                                <td style="width: 150px;"><input type="text" class="form-control editable-field remarks" name="remarks[]" placeholder="Remarks"></td>
                                <td><button type="button" id="add_more_btn" style="width:100%;height:40px;" class="btn btn-rounded btn-success"><i class="fa fa-sign-in"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-2" style="display: flex; justify-content: flex-end;">
                        <table style="width: 16.5%;">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;"><button type="button" style="width: 100%; height: 40px;" class="btn btn-rounded btn btn-warning"><i class="fa fa-plus"></i></button></td>
                                    <td style="width: 20%;"><button type="button" style="width: 100%; height: 40px;" class="btn btn-rounded btn-secondary"><i class="fa fa-plus"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <table class="table mt-4 ">
                        <tbody id="data-body">
                            <!-- Rows will be dynamically added here -->
                        </tbody>
                    </table>


                    <table class="mt-4 mb-0 border_collapse">
                        <tbody id="assessment-body">
                            <tr>
                                <td style="width:14.3%">
                                    <select class="form-control editable-field add_less" name="add_less[]">
                                        <option value="">Select</option>
                                        <option value="add">Add</option>
                                        <option value="less">Less</option>
                                    </select>
                                </td>
                                <td style="width: 36.37%;"><input type="text" class="form-control editable-field gst" name="description" placeholder="Description"></td>

                                <td style="width:14.3%">
                                    <select class="form-control editable-field fixed_percentage " name="fixed_percentage[]">
                                        <option value="">Select</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control editable-field only_numbers gst" name="gst[]" placeholder="0.00"></td>
                                <td style="width:18%"><input type="text" class="form-control editable-field only_numbers gstamt" name="gstamt[]" placeholder="GST"></td>

                                <td style="height:40px;"><button type="button" style="width:100%; height:40px;" class="add_new_table_body btn btn-rounded btn-success"><i class="fa fa-sign-in" style="font-size: 15px;"></i></button></td>
                                <td style="height:40px;"><button type="button" style="width:100%; height:40px;" class="add_more_btn btn btn-rounded btn-success"><i class="fa fa-plus" style="font-size: 15px;"></i></button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="modal-footer" style="border-top: none;padding:0px;">
                        <button class="mt-3" id="marinefinal_essential_submit" type="button" style="background-color:#2BB3C0" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function() {
        // Listen for change in the 'lumsum' select field
        $('#lumsum').change(function() {
            var salvagevalue = $('#salvage_amount').val();
            if ($(this).val() == 'Percentage') {
                $('#salvage_amount').val(salvagevalue + ' %');
                $('#salvage_amount').on('input', addPercentageSymbol);
            } else {
                $('#salvage_amount').val(salvagevalue.replace('%', '').trim());
                $('#salvage_amount').off('input', addPercentageSymbol);
                removePercentSymbol();
            }
        });

        function addPercentageSymbol() {
            var value = $('#salvage_amount').val();
            if (value && !value.includes('%')) {
                $('#salvage_amount').val(value + ' %');
            }
        }

        function removePercentSymbol() {
            var value = $('#salvage_amount').val();
            if (value.includes('%')) {
                $('#salvage_amount').val(value.replace('%', '').trim());
            }
        }

        if ($('#lumsum').val() == 'Percentage') {
            $('#salvage_amount').on('input', addPercentageSymbol);
        }
    });
</script>

