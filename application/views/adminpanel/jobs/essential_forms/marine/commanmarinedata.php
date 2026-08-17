<style>
    .hidden {
        display: none;
    }

    .visibility {
        display: block;
    }
</style>
<?php
// Determine if inputs have values
$consignorSet = isset($essentialdata->consignor) && !empty($essentialdata->consignor);
$consigneeSet = isset($essentialdata->name_of_consignee) && !empty($essentialdata->name_of_consignee);
$insuredSet = isset($essentialdata->insured_name) && !empty($essentialdata->insured_name);

// Determine button states
$policyButtonDisabled = $consignorSet ? 'disabled' : '';
$appointmentButtonDisabled = $consigneeSet ? 'disabled' : '';
$paymentButtonDisabled = $insuredSet ? 'disabled' : '';
?>


<!-- /* ------------------------------------------------------------------------- *  
* ESSENTIAL DATA INPUT FIELDS  (KAJAL)
* ------------------------------------------------------------------------- */ -->

<div class="row mt-2">
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="consignor" style="color: black;">
                Consignor &nbsp;<span style="color:red">*</span>
            </label>
            <div class="input-group">
                <input type="text" class="form-control editable-field consignor" <?php echo isset($essentialdata->consignor) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->consignor) && !empty($essentialdata->consignor)                                                                                                                                                ? $essentialdata->consignor : (isset($jobdata->consignor) ? $jobdata->consignor : ""); ?>" name="consignor" id="consignor" placeholder="Consignor">
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
                    id="name_of_consignee"
                    placeholder="Consignee">
                <div class="input-group-append venor-btn disable_btn">
                    <a data-toggle="modal" data-target="#vendorModal" data-modal-type="name_of_consignee" class="btn btn-rounded btn-info disable_btn venorbtn <?php echo isset($essentialdata->name_of_consignee) ? 'disabled' : ''; ?>"
                        href="#" style="padding: 10px 12px;">
                        <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                    </a>
                </div>
            </div>
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
</div>

<div class="row">
    <!-- Policy Card -->
    <div class="col-xl-4 col-md-4 <?php echo $consignorSet ? '' : 'hidden'; ?>" id="show_consignor_card">
        <div class="card p-0" style="background-color:#edede1;color: black;">
            <div class="card-header p-2" style="height: 138px;">
                <div class="d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <input type="hidden" id="selected_policy_vendor_id" name="selected_policy_vendor_id" value="" class="selected_vendor_id " id="">
                        <b style="font-size: 12px;font-weight:600;">Vendor Name:</b>
                        <input type="text" class="form-control editable-field  consignor_company"
                            <?php echo $consignorSet ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->consigno_name) ? $essentialdata->consigno_name : ""); ?>"
                            name="consigno_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;" required>
                    </div>

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                        <input type="text" class="form-control editable-field consignor_branch_name"
                            <?php echo isset($essentialdata->consignor_branch) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->consignor_branch) ? $essentialdata->consignor_branch : ""); ?>"
                            name="consignor_branch"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">User Name:</b>
                        <input type="text" class="form-control editable-field consignor_user_name"
                            <?php echo isset($essentialdata->consignor_user) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->consignor_user) ? $essentialdata->consignor_user : ""); ?>"
                            name="consignor_user"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                        <input type="text" class="form-control editable-field consignor_mobile_num"
                            <?php echo isset($essentialdata->consignor_mobile) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->consignor_mobile) ? $essentialdata->consignor_mobile : ""); ?>"
                            name="consignor_mobile"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Billing ID:</b>
                        <input type="text" class="form-control editable-field consignorbillingto"
                            <?php echo isset($essentialdata->consignobillingid) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->consignobillingid) ? $essentialdata->consignobillingid : ""); ?>"
                            name="consignobillingid"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Appointed By Card -->
    <div class="col-xl-4 col-md-4 <?php echo $consigneeSet ? '' : 'hidden'; ?>" id="show_consignee_card">
        <div class="card p-0" style="background-color:#edede1;color: black;">
            <div class="card-header p-2" style="height: 138px;">
                <div class="d-flex flex-column">
                    <input type="hidden" id="selected_appointment_vendor_id" name="selected_appointment_vendor_id" value="" class="selected_vendor_id">

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Vendor Name:</b>
                        <input type="text" class="form-control editable-field consignee_company"
                            <?php echo $consigneeSet ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->consignee_name) ? $essentialdata->consignee_name : ""); ?>"
                            name="consignee_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                        <input type="text" class="form-control editable-field consignee_branch_name"
                            <?php echo isset($essentialdata->appointment_branch_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->consignee_branch_name) ? $essentialdata->consignee_branch_name : ""); ?>"
                            name="consignee_branch_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">User Name:</b>
                        <input type="text" class="form-control editable-field consignee_user_name"
                            <?php echo isset($essentialdata->consignee_user_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->consignee_user_name) ? $essentialdata->consignee_user_name : ""); ?>"
                            name="consignee_user_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                        <input type="text" class="form-control editable-field consignee_mobile_num"
                            <?php echo isset($essentialdata->appointment_mobile_num) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->appointment_mobile_num) ? $essentialdata->appointment_mobile_num : ""); ?>"
                            name="appointment_mobile_num"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Billing ID:</b>
                        <input type="text" class="form-control editable-field consigneebillingto"
                            <?php echo isset($essentialdata->consigneebillingid) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->consigneebillingid) ? $essentialdata->consigneebillingid : ""); ?>"
                            name="consigneebillingid"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment By Card -->
    <div class="col-xl-4 col-md-4 <?php echo $insuredSet ? '' : 'hidden'; ?>" id="show_insured_card">
        <div class="card p-0" style="background-color:#edede1;color: black;">
            <div class="card-header p-2" style="height: 138px;">
                <div class="d-flex flex-column">
                    <input type="hidden" id="selected_payment_vendor_id" name="selected_payment_vendor_id" value="" class="selected_vendor_id">

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Vendor Name:</b>
                        <input type="text" class=" form-control editable-field insured_company"
                            <?php echo $insuredSet ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->payment_by) ? $essentialdata->payment_by : ""); ?>"
                            name="payment_by"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                        <input type="text" class="form-control editable-field insured_branch_name"
                            <?php echo isset($essentialdata->payment_branch_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->insured_branch_name) ? $essentialdata->insured_branch_name : ""); ?>"
                            name="insured_branch_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">User Name:</b>
                        <input type="text" class="form-control editable-field insured_user_name"
                            <?php echo isset($essentialdata->payment_user_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->insured_user_name) ? $essentialdata->insured_user_name : ""); ?>"
                            name="insured_user_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                        <input type="text" class="form-control editable-field insured_mobile_num"
                            <?php echo isset($essentialdata->payment_mobile_num) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->insured_mobile_num) ? $essentialdata->insured_mobile_num : ""); ?>"
                            name="insured_mobile_num"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Billing ID:</b>
                        <input type="text" class="form-control editable-field insuredbillingto"
                            <?php echo isset($essentialdata->paymentbillingto) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->insuredbillingid) ? $essentialdata->insuredbillingid : ""); ?>"
                            name="insuredbillingid"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>