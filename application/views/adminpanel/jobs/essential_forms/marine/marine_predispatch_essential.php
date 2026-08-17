<div class="panel ">
    <form id="marine_predispatch_essential" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
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
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name) ? $essentialdata->contact_person_name : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
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
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->case_reference) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) ? $essentialdata->case_reference : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" name="case_reference" id="case_reference" placeholder="Case Reference" required>
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
                        <label for="subject_matter" style="color:black">Subject Matter &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->subject_matter) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->subject_matter) ? $essentialdata->subject_matter : ""; ?>" id="subject_matter" name="subject_matter" placeholder="Subject Matter">
                    </div>
                </div>
           
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Proposer &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name) ? $essentialdata->insured_name : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Name of Proposer">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="address" style="color:black">Address</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address) ? $essentialdata->address : (isset($jobdata->address) ? $jobdata->address : ""); ?>" id="address" name="address" placeholder="Address">
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
          
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="inspection_place" style="color:black">Place of Inspection </label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->inspection_place) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->inspection_place) ? $essentialdata->inspection_place : ""; ?>" id="inspection_place" name="inspection_place" placeholder="Place of Inspection">
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
            </div>

            <?php $this->load->view("adminpanel/jobs/essential_forms/marine/marineinvoicedata") ?>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks</label>
                        <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> id="remark" placeholder="Remarks" name="remark"><?php echo isset($essentialdata->remark) ? htmlspecialchars($essentialdata->remark) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="marine_predispatch_essential_submit">
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