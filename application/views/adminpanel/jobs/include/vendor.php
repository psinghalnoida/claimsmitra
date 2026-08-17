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
$policyBySet = isset($essentialdata->policy_by) && !empty($essentialdata->policy_by);
$appointBySet = isset($essentialdata->appoint_by) && !empty($essentialdata->appoint_by);
$paymentBySet = isset($essentialdata->payment_by) && !empty($essentialdata->payment_by);

// Determine button states
$policyButtonDisabled = $policyBySet ? 'disabled' : '';
$appointmentButtonDisabled = $appointBySet ? 'disabled' : '';
$paymentButtonDisabled = $paymentBySet ? 'disabled' : '';
?>


<!-- /* ------------------------------------------------------------------------- *  
* ESSENTIAL DATA INPUT FIELDS  (KAJAL)
* ------------------------------------------------------------------------- */ -->
<div class="row ">
    <!-- Policy Section -->
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="policy_by" style="color: black;">
                Policy By &nbsp;<span style="color:red">*</span>
            </label>
            <div class="input-group">
                <input type="text" id="policy_by" name="policy_by" class="form-control insurance_company editable-field"
                    <?php echo $policyBySet ? "disabled" : ""; ?>
                    value="<?php echo htmlspecialchars_decode(isset($essentialdata->policy_by) ? $essentialdata->policy_by : ""); ?>" required placeholder="Policy By">
                <div class="input-group-append venor-btn">
                    <a data-toggle="modal" data-target="#vendorModal" data-modal-type="policy" class="btn btn-rounded btn-info venorbtn"
                        <?php echo $policyButtonDisabled; ?> href="#" style="align-content: center">
                        <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Section -->
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="appointment_by" style="color: black;">
                Appointment By &nbsp;<span style="color:red">*</span>
            </label>
            <div class="input-group">
                <input type="text" id="appointment_by" name="appoint_by" class="form-control insurance_company appointedby_paymentby editable-field"
                    <?php echo $appointBySet ? "disabled" : ""; ?>
                    value="<?php echo htmlspecialchars_decode(isset($essentialdata->appoint_by) ? $essentialdata->appoint_by : ""); ?>" required placeholder="Appointment By">
                <div class="input-group-append venor-btn">
                    <a data-toggle="modal" data-target="#vendorModal" data-modal-type="appointment" class="btn btn-rounded btn-info venorbtn"
                        <?php echo $appointmentButtonDisabled; ?> href="#" style="align-content: center;">
                        <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Section -->
    <div class="col-xl-4 col-md-4">
        <div class="form-group">
            <label for="payment_by" style="color: black;">
                Payment By &nbsp;<span style="color:red">*</span>
            </label>
            <div class="input-group">
                <input type="text" id="payment_by" name="payment_by" class="form-control insurance_company payment_by appointedby_paymentby editable-field"
                    <?php echo $paymentBySet ? "disabled" : ""; ?>
                    value="<?php echo htmlspecialchars_decode(isset($essentialdata->payment_by) ? $essentialdata->payment_by : ""); ?>" required placeholder="Payment By">
                <div class="input-group-append venor-btn">
                    <a data-toggle="modal" data-target="#vendorModal" data-modal-type="payment" class="btn btn-rounded btn-info venorbtn"
                        <?php echo $paymentButtonDisabled; ?> href="#" style="align-content: center;">
                        <i class="fa fa-plus" style="font-size: 15px;color:#FFF"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /* ------------------------------------------------------------------------- *  
*SHOW  POLICY CARD, APPOINTMENT CARD, PAYMENT CARD BASED ON ESSENTIAL FIELD (KAJAL)
* ------------------------------------------------------------------------- */ -->


<div class="row">
    <!-- Policy Card -->
    <div class="col-xl-4 col-md-4 <?php echo $policyBySet ? '' : 'hidden'; ?>" id="show_policy_card">
        <div class="card p-0" style="background-color:#edede1;color: black;">
            <div class="card-header p-2" style="height: 138px;">
                <div class="d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <input type="hidden" id="selected_policy_vendor_id" name="selected_policy_vendor_id" value="" class="selected_vendor_id " id="">
                        <b style="font-size: 12px;font-weight:600;">Vendor Name:</b>
                        <input type="text" class="form-control editable-field policy_vendor_name insurance_company"
                            <?php echo $policyBySet ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->policy_by) ? $essentialdata->policy_by : ""); ?>"
                            name="policy_by"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;" required>
                    </div>

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                        <input type="text" class="form-control editable-field policy_branch_name"
                            <?php echo isset($essentialdata->policy_branch) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->policy_branch) ? $essentialdata->policy_branch : ""); ?>"
                            name="policy_branch"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">User Name:</b>
                        <input type="text" class="form-control editable-field policy_user_name"
                            <?php echo isset($essentialdata->policy_user) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->policy_user) ? $essentialdata->policy_user : ""); ?>"
                            name="policy_user"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                        <input type="text" class="form-control editable-field policy_mobile_num"
                            <?php echo isset($essentialdata->policy_mobile) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->policy_mobile) ? $essentialdata->policy_mobile : ""); ?>"
                            name="policy_mobile"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Billing ID:</b>
                        <input type="text" class="form-control editable-field policybillingto"
                            <?php echo isset($essentialdata->policybillingto) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->policybillingto) ? $essentialdata->policybillingto : ""); ?>"
                            name="policybillingto"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointed By Card -->
    <div class="col-xl-4 col-md-4 <?php echo $appointBySet ? '' : 'hidden'; ?>" id="show_appointment_card">
        <div class="card p-0" style="background-color:#edede1;color: black;">
            <div class="card-header p-2" style="height: 138px;">
                <div class="d-flex flex-column">
                    <input type="hidden" id="selected_appointment_vendor_id" name="selected_appointment_vendor_id" value="" class="selected_vendor_id">

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Vendor Name:</b>
                        <input type="text" class="form-control editable-field appointment_vendor_name insurance_company appointedby_paymentby"
                            <?php echo $appointBySet ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->appoint_by) ? $essentialdata->appoint_by : ""); ?>"
                            name="appoint_by"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>


                    <div class="d-flex align-items-center">
                        <input type="hidden" class="form-control editable-field appointment_gst"
                            <?php echo isset($essentialdata->appointment_gst) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->appointment_gst) ? $essentialdata->appointment_gst : ""); ?>"
                            name="appointment_gst"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                        <input type="text" class="form-control editable-field appointment_branch_name policy_branch_name"
                            <?php echo isset($essentialdata->appointment_branch_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->appointment_branch_name) ? $essentialdata->appointment_branch_name : ""); ?>"
                            name="appointment_branch_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">User Name:</b>
                        <input type="text" class="form-control editable-field appointment_user_name policy_user_name"
                            <?php echo isset($essentialdata->appointment_user_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->appointment_user_name) ? $essentialdata->appointment_user_name : ""); ?>"
                            name="appointment_user_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                        <input type="text" class="form-control editable-field appointment_mobile_num policy_mobile_num"
                            <?php echo isset($essentialdata->appointment_mobile_num) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->appointment_mobile_num) ? $essentialdata->appointment_mobile_num : ""); ?>"
                            name="appointment_mobile_num"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Billing ID:</b>
                        <input type="text" class="form-control editable-field appointbillingto"
                            <?php echo isset($essentialdata->appointbillingto) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->appointbillingto) ? $essentialdata->appointbillingto : ""); ?>"
                            name="appointbillingto"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment By Card -->
    <div class="col-xl-4 col-md-4 <?php echo $paymentBySet ? '' : 'hidden'; ?>" id="show_payment_card">
        <div class="card p-0" style="background-color:#edede1;color: black;">
            <div class="card-header p-2" style="height: 138px;">
                <div class="d-flex flex-column">
                    <input type="hidden" id="selected_payment_vendor_id" name="selected_payment_vendor_id" value="" class="selected_vendor_id">

                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Vendor Name:</b>
                        <input type="text" class=" payment_by form-control editable-field payment_vendor_name insurance_company appointment_vendor_name appointedby_paymentby"
                            <?php echo $paymentBySet ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->payment_by) ? $essentialdata->payment_by : ""); ?>"
                            name="payment_by"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="hidden" class="form-control editable-field payment_gst"
                            <?php echo isset($essentialdata->payment_gst) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->payment_gst) ? $essentialdata->payment_gst : ""); ?>"
                            name="payment_gst"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                        <input type="text" class="form-control editable-field payment_branch_name appointment_branch_name policy_branch_name"
                            <?php echo isset($essentialdata->payment_branch_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars_decode(isset($essentialdata->payment_branch_name) ? $essentialdata->payment_branch_name : ""); ?>"
                            name="payment_branch_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">User Name:</b>
                        <input type="text" class="form-control editable-field payment_user_name appointment_user_name policy_user_name"
                            <?php echo isset($essentialdata->payment_user_name) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->payment_user_name) ? $essentialdata->payment_user_name : ""); ?>"
                            name="payment_user_name"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                        <input type="text" class="form-control editable-field payment_mobile_num appointment_mobile_num policy_mobile_num"
                            <?php echo isset($essentialdata->payment_mobile_num) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->payment_mobile_num) ? $essentialdata->payment_mobile_num : ""); ?>"
                            name="payment_mobile_num"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                    <div class="d-flex align-items-center">
                        <b style="font-size: 12px;font-weight:600;">Billing ID:</b>
                        <input type="text" class="form-control editable-field paymentbillingto"
                            <?php echo isset($essentialdata->paymentbillingto) ? "disabled" : ""; ?>
                            value="<?php echo htmlspecialchars(isset($essentialdata->paymentbillingto) ? $essentialdata->paymentbillingto : ""); ?>"
                            name="paymentbillingto"
                            placeholder=""
                            style="font-size: 12px; height: 20px; background-color: #E6E6DA; border: none; flex: 1;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="vendorModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="width:1100px;max-width:1100px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vendor List</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="container-fluid" style="max-height: 400px; overflow-y: auto;">
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="panel" style="box-shadow:none;margin-bottom:5px;">
                            <div class="panel-content panel-activity" style=" padding-bottom:10px;  border-top:none;">
                                <div class="row">
                                    <div class="col-12">
                                        <?php $this->load->view('adminpanel/vendor/index'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-space-between " class="vendor-btn-modal" style="margin:0px 25px 25px 25px;display:flex !important; justify-content: space-between">
                <input class="btn case_btn" type="button" value="Add New Vendor" id="update_vendor_modal">
                <input class="btn case_btn" type="button" value="Add" id="add_vendor_casereference" style="background-color: #e16123;">
            </div>
        </div>
    </div>
</div>

<div id="addvendorModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="width:1100px;max-width:1100px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New vendor</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="panel" style="box-shadow:none">
                    <form id="addvendor" method="post" enctype="multipart/form-data">
                        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                            <div class="form-group">
                                <label for="usertype" style="color:black;">Select User type&nbsp;<span style="color:red;">*</span></label>
                                <select class="form-control editable-field" name="usertype" required>
                                    <option>Select User Type</option>
                                    <option value="INDIVIDUAL">Individual</option>
                                    <option value="BUINESS" selected>Business</option>
                                </select>
                            </div>
                            <h4 class="business_details" style="color:#e16123;">Add Vendor</h4>
                            <div class="row business_details">
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="vendor" style="color:black;">Vendor&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control " id="newvendor" name="vendor" placeholder="Vendor" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="vendortype" style="color:black;">Vendor Type&nbsp;<span style="color:red;">*</span> </label>
                                        <select id="vendortype-dropdown" class="form-control " name="vendortype">
                                            <option value="">Select Vendor Type</option>
                                        </select>
                                        <input type="hidden" id="selected-vendortype-ids" name="selected-vendortype-ids" value="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="cinmum" style="color:black;">CIN Number </label>
                                        <input type="text" class="form-control " id="cinmum" name="cinmum" placeholder="CIN Number" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row business_details">
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="licencenum" style="color:black;">Licence No</label>
                                        <input type="text" class="form-control " id="licencenum" name="licencenum" placeholder="Licence No" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="licenseimg" style="color:black;">License Image</label>
                                        <input type="file" class="form-control " id="licenseimg" name="licenseimg" accept="image/*" style="padding:3px;">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="website" style="color:black;">Website</label>
                                        <input type="text" class="form-control " id="website" name="website" placeholder="Website" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <h4 class="business_details" style="color: #e16123;">Add Branch</h4>
                            <div class="row business_details">
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="address" style="color:black;">Address&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control " value="" id="address" name="address" placeholder="Address" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="pincode" style="color:black;">Pincode&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control  pincode" value="" id="pincode" name="pincode" placeholder="Pincode" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="state" style="color:black;">State&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control  state" value="" id="state" name="state" placeholder="State" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row business_details">
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="city" style="color:black;">City&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control  city" value="" id="city" name="city" placeholder="city" required>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="gst" style="color:black;">GST</label>
                                        <input type="text" class="form-control  " value="" id="gst" name="gst" placeholder="GST" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <h4 style="color:#e16123;">Add User</h4>
                            <div class="row">
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="mobile" style="color:black;">Mobile Number&nbsp;<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control mobile usermobile" id="vendor_mobile" name="mobile" placeholder="Mobile number" required autocomplete="off">
                                        <div id="mobile-error" class="error-message mobile-error" style="display:none; color: red;"></div>

                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="salutation" style="color:black;">Salutation&nbsp;<span style="color:red;">*</span></label>
                                        <select class="form-control " name="salutation" required>
                                            <option value="">Select Salutation</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Ms.">Ms.</option>
                                            <option value="Mrs.">Mrs.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="firstname" style="color:black;">First Name&nbsp;<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control " id="firstname" name="firstname" placeholder="First Name" required autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="lastname" style="color:black;">Last Name</label>
                                        <input type="text" class="form-control " id="lastname" name="lastname" placeholder="Last Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <label for="email" style="color:black;">Email</label>
                                        <input type="email" class="form-control editable-field" id="email" name="email" placeholder="Email" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                <input class="btn case_btn" type="submit" value="Connect" id="add_vendor">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML -->
<div id="addbranchModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New branch</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="panel" style="box-shadow:none">
                    <form id="addbranch" method="post" enctype="multipart/form-data">
                        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                            <div class="row ">

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="address" style="color:black;">Address&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control " value="" id="address" name="address" placeholder="Address" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="pincode" style="color:black;">Pincode&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control  pincode" value="" id="pincode" name="pincode" placeholder="Pincode" required autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="state" style="color:black;">State&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control  state" value="" id="state" name="state" placeholder="State" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="city" style="color:black;">City&nbsp;<span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control  city" value="" id="city" name="city" placeholder="city" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="gst" style="color:black;">GST</label>
                                        <input type="text" class="form-control  " value="" id="gst" name="gst" placeholder="GST" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                <input class="btn case_btn" type="submit" value="Add" id="add_vendor">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML -->
<div id="adduserModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Success Alert -->
            <div id="user-success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Success!</strong> <span class="alert-body"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Error Alert -->
            <div id="use-error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Error!</strong> <span class="alert-body"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="panel" style="box-shadow:none">
                    <form id="newuser" method="post" enctype="multipart/form-data">
                        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="mobile" style="color:black;">Mobile Number&nbsp;<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control  mobile usermobile" id="new_vendor_mobile" name="mobile" placeholder="Mobile number" required autocomplete="off">
                                        <div id="mobile-error" class="error-message mobile-error" style="display:none; color: red;"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="salutation" style="color:black;">Salutation &nbsp;<span style="color:red;">*</span></label>
                                        <select class="form-control " name="salutation" required>
                                            <option selected disabled>Select Salutation</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Ms.">Ms.</option>
                                            <option value="Mrs.">Mrs.</option>
                                        </select>
                                        <div id="salutation-error" class="error-message" style="display:none; color:red;"></div> <!-- Add this -->

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl- col-md-6">
                                    <div class="form-group">
                                        <label for="firstname" style="color:black;">First Name&nbsp;<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control " id="firstname" name="firstname" placeholder="First Name" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="lastname" style="color:black;">Last Name</label>
                                        <input type="text" class="form-control " id="lastname" name="lastname" placeholder="Last Name" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="email" style="color:black;">Email</label>
                                        <input type="email" class="form-control " id="email" name="email" placeholder="Email" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                <input class="btn case_btn" type="submit" value="Add">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="vendorNewModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height:350px">
            <div class="modal-header">
                <h5 class="modal-title">ADD VENDOR</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="vendorerror alert alert-danger" style="display: none; margin-bottom: 5px;">

            </div>

            <div class="modal-body py-0 mt-4">
                <!-- Vendor Section -->
                <div class="panel" style="box-shadow:none ; margin-bottom:10px;">
                    <form id="connect_vendor" method="post" enctype="multipart/form-data">
                        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group">
                                        <label for="vendor" style="color:black;">Select Vendor&nbsp;<span style="color:red;">*</span>
                                            <span style="float:right;">
                                                <a href="#addvendorModal" data-toggle="modal">Add Vendor</a>
                                            </span>
                                        </label>
                                        <!-- HTML structure -->
                                        <div class="dropdown-container">
                                            <input type="text" class="form-control vendor-search" id="vendor-search" name="vendor" placeholder="Search Vendor" autocomplete="off">
                                            <div class="vendor-dropdown"> <!-- Removed dropdown-menu -->
                                                <input type="hidden" name="selected_vendor_id" value="" class="selected_vendor_id">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="branch" style="color:black;">Select Branch&nbsp;<span style="color:red;">*</span>
                                            <span style="float:right;">
                                                <a href="#addbranchModal" data-toggle="modal">Add Branch</a>
                                            </span>
                                        </label>
                                        <div class="branch-dropdown-container">
                                            <input type="text" class="form-control branch-search" id="branch-search" name="branch" placeholder="Search Branch" autocomplete="off">
                                            <div id="branch-dropdown" class="branch-dropdown-menu branch-dropdown">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="user" style="color:black;">Select User&nbsp;<span style="color:red;">*</span> <span style="color:#e16123;">(Search by Mobile Number)</span>
                                            <span style="float:right;">
                                                <a href="#adduserModal" data-toggle="modal">Add user</a>
                                            </span>
                                        </label>
                                        <input type="text" id="user-search" name="user" class="form-control user-search" placeholder="Search User" autocomplete="off">
                                        <div id="user-dropdown" class="dropdown-container scroll-container px-2">
                                        </div>
                                        <input type="hidden" id="inspectorid" name="inspectorid">
                                    </div>
                                </div>
                            </div>
                            <div class="button d-flex justify-content-end " style="padding-bottom:10px;">
                                <input class="btn case_btn" type="submit" value="Connect" id="connect_with_vendor" style="background-color: #e16123;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

       var isVendorTableLoaded = false;

            function loadVendorTable() {
                var $vendorList = $('#vendorlist');
                var companyid = "<?php echo $defaultcompany; ?>";
                if (!isVendorTableLoaded) { // Initialize the table only once
                    $vendorList.DataTable({
                        "serverSide": true,
                        "paging": true,
                        "fixedHeader": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "language": {
                            searchPlaceholder: "Search Vendor",
                            "lengthMenu": "View _MENU_ records"
                        },
                        "order": [],
                        "ajax": {
                            url: "<?php echo base_url('connectedvendor'); ?>", // URL to your CodeIgniter function
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                companyid: companyid
                            },
                            error: function(xhr, error, code) {
                                console.error('DataTables Ajax error: ', error);
                                alert('Error loading data from server. Please check the console for details.');
                            },
                            // Ensure the server returns data in the correct format
                            dataSrc: function(json) {
                                return json.data; // Ensure "data" is an array of records
                            }
                        }
                    });
                    isVendorTableLoaded = true; // Set the flag to true after initialization
                }
            }
    // Connect vendors
    $(document).ready(function() {

        // Handle modal show event
        $('#vendorModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modalType = button.data('modal-type');
            var modal = $(this);
            var addButton = modal.find('#add_vendor_casereference');
            addButton.data('modal-type', modalType);
            modal.find('#modalTitle').text(modalType.charAt(0).toUpperCase() + modalType.slice(1) + ' Vendor Selection');
            loadVendorTable();
        });


        $('#add_vendor_casereference').on('click', function() {
            var modalType = $(this).data('modal-type');
            var selectedRadio = $('#vendorlist input[name="vendor_select"]:checked');
            if (selectedRadio.length > 0) {
                var vendorId = selectedRadio.val();
                var vendorName = selectedRadio.data('vendor-name');
                var branchName = selectedRadio.data('branch-name');
                var billingto = selectedRadio.data('billing-id');
                var paymentsgstNumber = selectedRadio.data('gst');
                var userName = selectedRadio.data('user-name');
                var mobileNumber = selectedRadio.data('mobile-number');
                // Variable to track initial IDs
                let initialAppointmentVendorId = null;
                let initialPaymentVendorId = null;

                // if (modalType === 'policy' || modalType === 'appointment' || modalType === 'payment') {
                //     $('#update_vendor_modal').show(); // Show the button
                // } else {
                //     $('#update_vendor_modal').hide(); // Hide the button for other modal types
                // }
                switch (modalType) {
                    case 'policy':

                        $('.insurance_company').val(vendorName);
                        if (billingto) {
                            $('.policybillingto,.appointbillingto,.paymentbillingto').val(billingto); // Set the value if billingto exists
                        } else {
                            $('.policybillingto,.appointbillingto,.paymentbillingto').val('NA'); // Clear the field if billingto does not exist
                        }
                        $('.payment_gst').val(paymentsgstNumber);
                        $('.appointment_gst').val(paymentsgstNumber);
                        $('#selected_policy_vendor_id, #selected_appointment_vendor_id, #selected_payment_vendor_id').val(vendorId);
                        initialAppointmentVendorId = vendorId;
                        initialPaymentVendorId = vendorId;
                        $('.policy_branch_name').val(branchName);
                        $('.policy_user_name').val(userName);
                        $('.policy_mobile_num').val(mobileNumber);
                        $('#show_policy_card').removeClass('hidden').addClass('visibility');
                        $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                        $('#show_payment_card').removeClass('hidden').addClass('visibility');
                        break;

                    case 'insured_name':
                        $('.insured_name').val(vendorName);
                        break;

                    case 'consignor':
                        $('.consignor').val(vendorName);
                        break;

                    case 'name_of_consignee':
                        $('.name_of_consignee').val(vendorName);
                        break;

                    case 'appointment':
                        $('.appointedby_paymentby').val(vendorName);
                        if (initialAppointmentVendorId) {
                            $('#selected_appointment_vendor_id').val(initialAppointmentVendorId);
                        } else {
                            $('#selected_appointment_vendor_id').val(vendorId);
                        }
                        $('#selected_payment_vendor_id').val(vendorId);
                        initialAppointmentVendorId = vendorId;
                        initialPaymentVendorId = vendorId;
                        if (billingto) {
                            $('.appointbillingto,.paymentbillingto').val(billingto); // Set the value if billingto exists
                        } else {
                            $('.appointbillingto,.paymentbillingto').val('NA'); // Clear the field if billingto does not exist
                        }
                        $('.appointment_gst').val(paymentsgstNumber);
                        $('.appointment_branch_name').val(branchName);
                        $('.appointment_user_name').val(userName);
                        $('.appointment_mobile_num').val(mobileNumber);
                        $('#show_policy_card').removeClass('hidden').addClass('visibility');
                        $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                        $('#show_payment_card').removeClass('hidden').addClass('visibility');
                        break;

                    case 'payment':
                        $('.payment_by').val(vendorName);
                        $('#selected_payment_vendor_id').val(vendorId);
                        if (initialAppointmentVendorId) {
                            $('#selected_appointment_vendor_id').val(initialAppointmentVendorId);
                        }
                        initialPaymentVendorId = vendorId;
                        if (billingto) {
                            $('.paymentbillingto').val(billingto); // Set the value if billingto exists
                        } else {
                            $('.paymentbillingto').val('NA'); // Clear the field if billingto does not exist
                        }
                        $('.payment_branch_name').val(branchName);
                        $('.payment_gst').val(paymentsgstNumber);
                        $('.payment_user_name').val(userName);
                        $('.payment_mobile_num').val(mobileNumber);
                        $('#show_policy_card').removeClass('hidden').addClass('visibility');
                        $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                        $('#show_payment_card').removeClass('hidden').addClass('visibility');
                        break;

                    default:
                        break;
                }

                $('#notselect-error-alert').hide();
                $('#vendorModal').modal('hide');
            } else {
                $('#notselect-error-alert').show();
            }
        });
    });
</script>