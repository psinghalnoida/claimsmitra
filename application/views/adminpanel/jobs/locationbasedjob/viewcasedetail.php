<style>
    .vendor-dropdown {
        display: none;
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        width: 100%;
    }

    .vendor-dropdown.active {
        display: block;
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .error {
        font-size: 12px;
    }

    .disabled-btn {
        pointer-events: none;
        opacity: 0.5;
    }

    .white-icon {
        filter: brightness(0) invert(1);
    }
</style>
<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<?php $this->load->view('adminpanel/layout/case-sidebar'); ?>

<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata'); ?>
            <div class="container-fluid">
                <?php $this->load->view('adminpanel/jobs/locationbasedjob/mediafile'); ?>
                <?php if ($natureofjob === 1) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_theft_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_theft_casedata'); ?>
                <?php } else if ($natureofjob === 2) { ?>
                    <!-- Add view for natureofjob 2 -->
                <?php } else if ($natureofjob === 3) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_tp_essential'); ?>
                <?php } else if ($natureofjob === 4) { ?>
                    <!-- Add view for natureofjob 4 -->
                <?php } else if ($natureofjob === 5) { ?>
                    <!-- Add view for natureofjob 5 -->
                <?php } else if ($natureofjob === 6) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/fire_investigation_essential'); ?>
                    <!-- Add view for natureofjob 6 -->
                <?php } else if ($natureofjob === 7) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_cargo_essential'); ?>
                <?php } else if ($natureofjob === 8) { ?>
                    <!-- Add view for natureofjob 8 -->
                <?php } else if ($natureofjob === 9) { ?>
                    <!-- Add view for natureofjob 9 -->
                <?php } else if ($natureofjob === 10) { ?>
                    <!-- Add view for natureofjob 10 -->
                <?php } else if ($natureofjob === 11) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/mediclaim_investigation_essential'); ?>
                <?php } else if ($natureofjob === 12) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/ebdeathcase_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/ebdeathcase_casedata'); ?>
                <?php } else if ($natureofjob === 13) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/paclaim_essential'); ?>
                <?php } else if ($natureofjob === 14) { ?>
                    <!-- Add view for natureofjob 14 -->
                <?php } else if ($natureofjob === 15) { ?>
                    <!-- Add view for natureofjob 15 -->
                <?php } else if ($natureofjob === 16) { ?>
                    <!-- Add view for natureofjob 16 -->
                <?php } else if ($natureofjob === 17) { ?>
                    <!-- Add view for natureofjob 17 -->
                <?php } else if ($natureofjob === 18) { ?>
                    <!-- Add view for natureofjob 18 -->
                <?php } else if ($natureofjob === 19) { ?>
                    <!-- Add view for natureofjob 19 -->
                <?php } else if ($natureofjob === 20) { ?>
                    <!-- Add view for natureofjob 20 -->
                <?php } else if ($natureofjob === 21) { ?>
                    <!-- Add view for natureofjob 21 -->
                <?php } else if ($natureofjob === 22) { ?>
                    <!-- Add view for natureofjob 22 -->
                <?php } else if ($natureofjob === 23) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_prein_essential'); ?>
                    <!-- Add view for natureofjob 23 -->
                <?php } else if ($natureofjob === 24) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_predispatch_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_predis_casedata'); ?>
                <?php } else if ($natureofjob === 61) { ?>
                    <!-- Add view for natureofjob 61 -->
                <?php } else if ($natureofjob === 62) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_spot_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_spot_casedata'); ?>
                <?php } else if ($natureofjob === 63) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marinespotinspection'); ?>
                <?php } else if ($natureofjob === 64) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/cattleessentialform'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/caseform'); ?>
                <?php } else if ($natureofjob === 65) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motorfinalessential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_final_casedata'); ?>
                <?php } else if ($natureofjob === 66) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marinefinal_essential'); ?>
                <?php } else if ($natureofjob === 67) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/fire_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 68) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/lop_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 69) { ?>
                    <!-- Not Complete-->
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/aviation_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 70) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/miscellaneous_final_essential'); ?>
                <?php } else if ($natureofjob === 71) { ?>
                    <!-- Add view for natureofjob 71 -->
                <?php } else if ($natureofjob === 72) { ?>
                    <!-- Not Complete-->
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_hull_final_survey'); ?>
                <?php } else if ($natureofjob === 73) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/engeneering_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 74) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/fire_insurance_pre_inspection'); ?>
                <?php } else if ($natureofjob === 75) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/engineering_preins_essential'); ?>
                <?php } else if ($natureofjob === 76) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/project_pre_inspection_essential'); ?>
                <?php } else if ($natureofjob === 77) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/assets_valuation_essential'); ?>
                <?php } else if ($natureofjob === 78) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/risk_inspection_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/risk_inspection_casedata'); ?>

                    <!-- Add view for natureofjob 76 -->
                <?php } ?>
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

    <div class="modal fade" id="templateListModal" tabindex="-1" role="dialog" aria-labelledby="templateListLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header  text-black">
                    <h5 class="modal-title" id="templateListLabel">All Templates</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="templateList">
                        <!-- Template items will be inserted here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('adminpanel/layout/footer'); ?>

    <?php $this->load->view('adminpanel/assessment/motor_final_assessment'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>

    <script type="text/javascript">
        function search_pincode(pincode) {
            $.ajax({
                url: "searchpincode", // Ensure this URL is correct
                method: "POST",
                data: {
                    pincode: pincode
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200) {
                        // Populate address field with city and state data
                        const city = response.data.City || '';
                        const state = response.data.State || '';

                        // Combine city and state into the address field
                        $(".city").val(`${city}`);
                        $(".state").val(`${state}`);

                    } else {
                        // Clear the address field if no data is returned
                        $(".address").val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching address data:", status, error);
                    $(".address").val(''); // Clear the address field on error
                }
            });
        }

        $(document).ready(function() {

            $(document).on('click', '#use_templates', function() {
                const templates = <?php echo json_encode($templatedata ?? []); ?>;
                const $list = $('#templateList');
                $list.empty();

                if (templates.length > 0) {
                    templates.forEach(template => {
                        const name = template.template_name ?? 'Untitled';
                        const id = template.id ?? '';
                        $list.append(`
                <li class="list-group-item">
                    <a href="javascript:void(0);" onclick="loadTemplateDetails(${id})">
                        <i class="far fa-file-alt"></i> ${name}
                    </a>
                </li>
            `);
                    });
                } else {
                    $list.append('<li class="list-group-item text-muted">No templates available</li>');
                }

                $('#templateListModal').modal('show');
            });

            $('#generate_assessment').on('click', function(e) {
                e.preventDefault(); // prevent default anchor behavior
                $('#addAssessment').modal('show'); // open modal properly
            });


            $(document).on('click', '.delete-vendor', function() {
                const vendorId = $(this).data('vendor-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won’t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'deletevendor', // Adjust the endpoint to your delete function
                            type: 'POST',
                            data: {
                                vendor_id: vendorId
                            },
                            success: function(response) {
                                if (response.status === 200) { // Check if the response status is 200
                                    Swal.fire('Deleted!', 'The vendor has been deleted.', 'success');
                                    // Reload the DataTable
                                    $('#vendorlist').DataTable().ajax.reload();
                                } else {
                                    $('#vendorlist').DataTable().ajax.reload();
                                }
                            },
                            error: function() {
                                Swal.fire('Error!', 'An error occurred while deleting the vendor.', 'error');
                            },
                        });
                    }
                });
            });




            $('.pincode').keyup(function() {
                var pincode = $(this).val();
                if (pincode.length === 6) { // Only trigger search if pincode is 6 digits long
                    search_pincode(pincode);
                }
            });

            // When the vendorNewModal is triggered from vendorModal
            $('#update_vendor_modal').click(function() {
                $('#vendorModal').css({
                    'opacity': '0.9', // Blur vendorModal
                    'z-index': '1040' // Ensure it's behind vendorNewModal
                });
                $('#vendorNewModal').css({
                    'opacity': '1', // Ensure vendorNewModal is fully visible
                    'z-index': '1050' // Bring vendorNewModal to the front
                }).modal('show'); // Show vendorNewModal
            });

            // When vendorNewModal is hidden
            $('#vendorNewModal').on('hide.bs.modal', function() {
                $('#vendorModal').css({
                    'opacity': '1', // Restore vendorModal opacity
                    'z-index': '1050' // Bring vendorModal back to the front
                });
            });

            // When any modal (addvendorModal, addbranchModal, adduserModal) is shown on top of vendorNewModal
            $('#addvendorModal, #addbranchModal, #adduserModal').on('show.bs.modal', function() {
                // Blur the vendorModal and vendorNewModal
                $('#vendorModal').css({
                    'opacity': '0.4',
                    'z-index': '1030' // Lower z-index for vendorModal
                });
                $('#vendorNewModal').css({
                    'opacity': '0.5',
                    'z-index': '1040' // Lower z-index for vendorNewModal
                });

                // Make the top modal fully visible and bring it to the front
                $(this).css({
                    'opacity': '1',
                    'z-index': '1050' // Highest z-index for topmost modal
                });
            });

            // When any of the top modals is hidden, reset opacity for vendorNewModal and vendorModal
            $('#addvendorModal, #addbranchModal, #adduserModal').on('hide.bs.modal', function() {
                $('#vendorNewModal').css({
                    'opacity': '1', // Restore vendorNewModal opacity
                    'z-index': '1050' // Bring vendorNewModal to the front again
                });
                $('#vendorModal').css({
                    'opacity': '0.5', // Keep vendorModal blurred
                    'z-index': '1040' // Ensure vendorModal is behind vendorNewModal
                });
            });
        });

        // Connect vendors
        $(document).ready(function() {

            // Handle modal show event
            // $('#vendorModal').on('show.bs.modal', function(event) {
            //     var button = $(event.relatedTarget);
            //     var modalType = button.data('modal-type');
            //     var modal = $(this);
            //     var addButton = modal.find('#add_vendor_casereference');
            //     addButton.data('modal-type', modalType);
            //     modal.find('#modalTitle').text(modalType.charAt(0).toUpperCase() + modalType.slice(1) + ' Vendor Selection');
            //     loadVendorTable();
            // });


            // $('#add_vendor_casereference').on('click', function() {
            //     var modalType = $(this).data('modal-type');
            //     var selectedRadio = $('#vendorlist input[name="vendor_select"]:checked');
            //     if (selectedRadio.length > 0) {
            //         var vendorId = selectedRadio.val();
            //         var vendorName = selectedRadio.data('vendor-name');
            //         var branchName = selectedRadio.data('branch-name');
            //         var billingto = selectedRadio.data('billing-id');
            //         var paymentsgstNumber = selectedRadio.data('gst');
            //         var userName = selectedRadio.data('user-name');
            //         var mobileNumber = selectedRadio.data('mobile-number');
            //         // Variable to track initial IDs
            //         let initialAppointmentVendorId = null;
            //         let initialPaymentVendorId = null;

            //         // if (modalType === 'policy' || modalType === 'appointment' || modalType === 'payment') {
            //         //     $('#update_vendor_modal').show(); // Show the button
            //         // } else {
            //         //     $('#update_vendor_modal').hide(); // Hide the button for other modal types
            //         // }
            //         switch (modalType) {
            //             case 'policy':

            //                 $('.insurance_company').val(vendorName);
            //                 if (billingto) {
            //                     $('.policybillingto,.appointbillingto,.paymentbillingto').val(billingto); // Set the value if billingto exists
            //                 } else {
            //                     $('.policybillingto,.appointbillingto,.paymentbillingto').val('NA'); // Clear the field if billingto does not exist
            //                 }
            //                 $('.payment_gst').val(paymentsgstNumber);
            //                 $('.appointment_gst').val(paymentsgstNumber);
            //                 $('#selected_policy_vendor_id, #selected_appointment_vendor_id, #selected_payment_vendor_id').val(vendorId);
            //                 initialAppointmentVendorId = vendorId;
            //                 initialPaymentVendorId = vendorId;
            //                 $('.policy_branch_name').val(branchName);
            //                 $('.policy_user_name').val(userName);
            //                 $('.policy_mobile_num').val(mobileNumber);
            //                 $('#show_policy_card').removeClass('hidden').addClass('visibility');
            //                 $('#show_appointment_card').removeClass('hidden').addClass('visibility');
            //                 $('#show_payment_card').removeClass('hidden').addClass('visibility');
            //                 break;

            //             case 'insured_name':
            //                 $('.insured_name').val(vendorName);
            //                 break;

            //             case 'consignor':
            //                 $('.consignor').val(vendorName);
            //                 break;

            //             case 'name_of_consignee':
            //                 $('.name_of_consignee').val(vendorName);
            //                 break;

            //             case 'appointment':
            //                 $('.appointedby_paymentby').val(vendorName);
            //                 if (initialAppointmentVendorId) {
            //                     $('#selected_appointment_vendor_id').val(initialAppointmentVendorId);
            //                 } else {
            //                     $('#selected_appointment_vendor_id').val(vendorId);
            //                 }
            //                 $('#selected_payment_vendor_id').val(vendorId);
            //                 initialAppointmentVendorId = vendorId;
            //                 initialPaymentVendorId = vendorId;
            //                 if (billingto) {
            //                     $('.appointbillingto,.paymentbillingto').val(billingto); // Set the value if billingto exists
            //                 } else {
            //                     $('.appointbillingto,.paymentbillingto').val('NA'); // Clear the field if billingto does not exist
            //                 }
            //                 $('.appointment_gst').val(paymentsgstNumber);
            //                 $('.appointment_branch_name').val(branchName);
            //                 $('.appointment_user_name').val(userName);
            //                 $('.appointment_mobile_num').val(mobileNumber);
            //                 $('#show_policy_card').removeClass('hidden').addClass('visibility');
            //                 $('#show_appointment_card').removeClass('hidden').addClass('visibility');
            //                 $('#show_payment_card').removeClass('hidden').addClass('visibility');
            //                 break;

            //             case 'payment':
            //                 $('.payment_by').val(vendorName);
            //                 $('#selected_payment_vendor_id').val(vendorId);
            //                 if (initialAppointmentVendorId) {
            //                     $('#selected_appointment_vendor_id').val(initialAppointmentVendorId);
            //                 }
            //                 initialPaymentVendorId = vendorId;
            //                 if (billingto) {
            //                     $('.paymentbillingto').val(billingto); // Set the value if billingto exists
            //                 } else {
            //                     $('.paymentbillingto').val('NA'); // Clear the field if billingto does not exist
            //                 }
            //                 $('.payment_branch_name').val(branchName);
            //                 $('.payment_gst').val(paymentsgstNumber);
            //                 $('.payment_user_name').val(userName);
            //                 $('.payment_mobile_num').val(mobileNumber);
            //                 $('#show_policy_card').removeClass('hidden').addClass('visibility');
            //                 $('#show_appointment_card').removeClass('hidden').addClass('visibility');
            //                 $('#show_payment_card').removeClass('hidden').addClass('visibility');
            //                 break;

            //             default:
            //                 break;
            //         }

            //         $('#notselect-error-alert').hide();
            //         $('#vendorModal').modal('hide');
            //     } else {
            //         $('#notselect-error-alert').show();
            //     }
            // });

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




            $.validator.addMethod('validBranchId', function(value, element) {
                return $(element).data('selected-branch-id') > 0;
            }, 'Please select a valid branch.');

            $.validator.addMethod('validUserId', function(value, element) {
                return $(element).data('selected-user-id') > 0;
            }, 'Please select a valid user.');

            // Form validation and submission
            $("#connect_vendor").validate({
                errorClass: 'error',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').show();
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').hide();
                },
                rules: {
                    vendor: {
                        required: true,
                    },
                    branch: {
                        required: true,
                        validBranchId: true
                    },
                    user: {
                        required: true,
                        validUserId: true

                    }
                },
                messages: {
                    vendor: {
                        required: "This field is required.",
                    },
                    branch: {
                        required: "This field is required.",
                        validBranchId: "Please select a valid branch."
                    },
                    user: {
                        required: "This field is required.",
                        validUserId: "Please select a valid user."
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();

                    // Retrieve the selected IDs from the data attributes
                    var userId = $('#user-search').data('selected-user-id');
                    var branchId = $('.branch-search').data('selected-branch-id');
                    var vendorId = $('.vendor-search').data('selected-vendor-id');
                    var cid = "<?php echo $defaultcompany; ?>";


                    // Validate IDs before adding them to form data
                    if (userId <= 0 || branchId <= 0 || vendorId <= 0) {
                        $('#vendor-error-alert').find('.alert-body').text('Please ensure all IDs are valid.').show();
                        return;
                    }
                    var companyid = "<?php echo $defaultcompany; ?>";
                    // Append IDs to form data
                    var formData = $(form).serialize();
                    formData += '&vendor=' + encodeURIComponent(vendorId);
                    formData += '&branch=' + encodeURIComponent(branchId);
                    formData += '&user=' + encodeURIComponent(userId);

                    formData += '&cid=' + encodeURIComponent(cid);
                    // Perform AJAX request
                    $.ajax({
                        url: "<?php echo base_url('connectNewVendor'); ?>",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Success case - record successfully connected
                            if (response.status === 200) {
                                $('#vendor-success-alert').find('.alert-body').html(
                                    'Vendor connected successfully.<br>' +
                                    '<strong>Vendor:</strong> ' + response.vendorName + '<br>' +
                                    '<strong>Branch:</strong> ' + response.branchAddress + '<br>' +
                                    '<strong>User:</strong> ' + response.userName
                                ).show();
                                $('#vendorNewModal').modal('hide');
                                $('#connect_vendor')[0].reset();
                                $('#vendorlist').DataTable().ajax.reload();
                            } else if (response.status === 409) {
                                $('.vendorerror').text('Record already exists.').show();
                                setTimeout(function() {
                                    $('.vendorerror').fadeOut(); // Hide the alert after 30 seconds
                                }, 1000);
                            } else {
                                // Show a generic error message if no specific message is provided
                                $('.vendorerror').text('An error occurred').show();
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            // Fallback error message
                            $('#vendor-error-alert').find('.alert-body').text('An error occurred. Please try again.').show();
                        }
                    });


                }
            });

        });

        // Fetch vendors
        function fetchVendors() {
            $.ajax({
                url: '<?php echo base_url('vendors'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200 && response.data && response.data.length) {
                        populateVendorDropdown(response.data);
                    } else {
                        $('.vendor-dropdown').html('<p>No vendors found</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching vendors:', xhr.responseText);
                    $('.vendor-dropdown').html('<p>Error loading vendors</p>');
                }
            });
        }




        function fetchVendorTypes() {
            $.ajax({
                url: '<?php echo base_url('vendortype'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response && response.length) {
                        populateVendorTypeDropdown(response);
                    } else {
                        $('#vendortype-dropdown').html('<option>No vendor types found</option>');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching vendor types:', xhr.responseText);
                    $('#vendortype-dropdown').html('<option>Error loading vendor types</option>');
                }
            });
        }
        $('#vendortype-dropdown').change(function() {
            var selectedVendorTypeId = $(this).val(); // Get the selected value (ID)
            $('#selected-vendortype-ids').val(selectedVendorTypeId); // Set the hidden input value
        });

        function populateVendorTypeDropdown(vendorTypes) {
            const dropdown = $('#vendortype-dropdown');
            dropdown.empty(); // Clear existing options

            // Append default placeholder option
            dropdown.append('<option value="">Select Vendor Type</option>');

            // Append fetched vendor types
            vendorTypes.forEach(function(vendorType) {
                dropdown.append(`<option value="${vendorType.id}">${vendorType.profession}</option>`);
            });
        }

        // Populate vendor dropdown
        function populateVendorDropdown(vendors) {
            const dropdown = $('.vendor-dropdown');
            dropdown.empty();
            let html = '<ul class="dropdown-list">';
            vendors.forEach(function(vendor) {
                html += `<li class="vendor-options" data-id="${vendor.id}">${vendor.companyName}</li>`;
            });
            html += '</ul>';
            dropdown.html(html);

            // Event listener for clicking vendor options
            $('.vendor-options').on('click', function() {
                const selectedVendorId = $(this).data('id');
                $('.vendor-search').val($(this).text());
                $('.vendor-dropdown').removeClass('active');
                $('.vendor-search').data('selected-vendor-id', selectedVendorId);
                $('.branch-search').val('');
                $('#user-search').val('');
                fetchBranches(); // Fetch branches based on selected vendor
            });
        }

        // Fetch branches based on the selected vendor
        function fetchBranches() {
            var vendorId = $('.vendor-search').data('selected-vendor-id');
            if (!vendorId) {
                console.error('Vendor ID is missing or not set.');
                return;

            }

            $.ajax({
                url: '<?php echo base_url('branch'); ?>',
                type: 'POST',
                data: {
                    vendor: vendorId
                },
                dataType: 'json',
                success: function(response) {
                    if (response && Array.isArray(response) && response.length > 0) {
                        $('.branch-dropdown').show(); // Ensure the dropdown is visible
                        populateBranchesDropdown(response);
                    } else {
                        $('.branch-dropdown').html('<p>No branches found</p>').show();
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching branches:', xhr.responseText);
                    $('.branch-dropdown').html('<p>Error loading branches</p>').show();
                }
            });
        }

        // Populate the branches dropdown with fetched data
        function populateBranchesDropdown(branches) {
            const dropdown = $('.branch-dropdown');
            dropdown.empty(); // Clear existing items
            let html = '<ul class="dropdown-list">';
            $.each(branches, function(index, branch) {
                html += `<li class="branch-dropdown-item" data-id="${branch.id}">${branch.address}, ${branch.city}, ${branch.state}</li>`;
            });
            html += '</ul>';
            dropdown.html(html);

            // Attach click event to each branch item
            $('.branch-dropdown-item').off('click').on('click', function() {
                const selectedBranchId = $(this).data('id');
                const selectedBranchText = $(this).text();
                $('.branch-search').val(selectedBranchText);
                $('.branch-dropdown').removeClass('active').hide(); // Hide dropdown
                $('.branch-search').data('selected-branch-id', selectedBranchId);
                $('#user-search').val(''); // Clear previous user selection
                // Fetch users based on selected branch
            });
        }

        // Fetch users based on selected branch


        // Populate users dropdown
        // function populateUsersDropdown(users) {
        //     const dropdown = $('#user-dropdown');
        //     dropdown.empty();
        //     let html = '<ul class="dropdown-list">';
        //     users.forEach(function(user) {
        //         html += `<li class="user-dropdown-item" data-id="${user.vendor_uid}">${user.firstname} ${user.lastname}, ${user.mobile}</li>`;
        //     });
        //     html += '</ul>';
        //     dropdown.html(html);

        //     $('.user-dropdown-item').off('click').on('click', function() {
        //         const selectedUserId = $(this).data('id');
        //         $('#user-search').val($(this).text());
        //         $('#user-dropdown').removeClass('active');
        //         $('#user-search').data('selected-user-id', selectedUserId);
        //         console.log('Selected User ID:', selectedUserId); // Debugging log
        //     });
        // }

        // function filterUsersByMobile(users, mobileNumber) {
        //     const dropdown = $('#user-dropdown');
        //     dropdown.empty(); // Clear existing items

        //     let matchFound = false;
        //     let html = '<ul class="dropdown-list">';

        //     // Iterate through the user list to find matching mobile numbers
        //     users.forEach(function(user) {
        //         const userMobile = user.mobile.toString();

        //         // If the entered number matches the user's mobile number
        //         if (userMobile === mobileNumber) {
        //             html += `<li class="user-dropdown-item" data-id="${user.vendor_uid}" data-mobile="${user.mobile}">
        //                         ${user.firstname} ${user.lastname}, ${user.mobile}
        //                      </li>`;
        //             matchFound = true;
        //         }
        //     });

        //     html += '</ul>';

        //     // Show dropdown or no result message based on matchFound status
        //     if (matchFound) {
        //         dropdown.html(html).addClass('active');
        //         attachUserSelectionEvent();
        //     } else {
        //         dropdown.html('<p>Please enter correct mobile number of user</p>').addClass('active');
        //     }
        // }

        function filterUsersByMobile(users, mobileNumber) {
            const dropdown = $('#user-dropdown');
            dropdown.empty(); // Clear existing items

            let matchFound = false;
            let html = '<ul class="dropdown-list">';

            users.forEach(function(user) {
                const userMobile = user.mobile.toString();

                // If the entered number matches the user's mobile number
                if (userMobile === mobileNumber) {
                    html += `<li class="user-dropdown-item" data-id="${user.vendor_uid}" data-mobile="${user.mobile}">
                        ${user.firstname} ${user.lastname}, ${user.mobile},${user.email}
                     </li>`;
                    matchFound = true;
                } else {
                    dropdown.html('<p>No such result found</p>').addClass('active');
                }

            });

            html += '</ul>';

            // Show dropdown or no result message
            if (matchFound) {
                dropdown.html(html).addClass('active');
                attachUserSelectionEvent();
            } else {
                dropdown.html('<p>Please enter correct mobile number of user</p>').addClass('active');
            }
        }

        // Attach click event to user dropdown items
        function attachUserSelectionEvent() {
            $('.user-dropdown-item').off('click').on('click', function() {
                const selectedUserId = $(this).data('id');
                $('#user-search').val($(this).text());
                $('#user-dropdown').removeClass('active');
                $('#user-search').data('selected-user-id', selectedUserId);
            });
        }

        function checkMobileExists(mobileNumber) {
            if (mobileNumber === '') {
                $('.mobile-error').text('Please enter a mobile number').show();
                return;
            }

            // Make AJAX request to check if the mobile number exists
            $.ajax({
                url: "<?php echo base_url('allusers'); ?>", // Assume baseUrl is set globally in your script
                type: 'POST',
                data: {
                    mobile: mobileNumber
                },
                dataType: 'json',
                success: function(response) {
                    if (response.exists) {
                        // Show the error message if mobile number exists
                        $('.mobile-error').text('This mobile number is already in use').show();

                        // Show user name and details if mobile number matches
                        const userData = response.data;
                        const fullName = `${userData.salutation} ${userData.firstname} ${userData.lastname}`;

                        // Populate the form fields with the retrieved user data
                        $('select[name="salutation"]').val(userData.salutation);
                        $('input[name="firstname"]').val(userData.firstname);
                        $('input[name="lastname"]').val(userData.lastname);
                        $('input[name="email"]').val(userData.email);

                    } else {
                        // Hide the error if the mobile number does not exist
                        $('.mobile-error').hide();

                        // Clear the user display if mobile number is not found
                        $('#user-name-display').text('');
                    }
                },
                error: function(xhr) {
                    console.error('Error checking mobile number:', xhr.responseText);
                    $('.mobile-error').text('Error checking mobile number').show();
                }
            });
        }




        $(document).ready(function() {
            fetchVendorTypes();
            fetchVendors();

            const mobileInputField = document.querySelector("#vendor_mobile");

            const mobileInput = window.intlTelInput(mobileInputField, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                initialCountry: 'auto',
                geoIpLookup: function(callback) {
                    callback('in');
                }
            });

            const new_vendor_mobile = document.querySelector("#new_vendor_mobile");
            const new_vendor_input = window.intlTelInput(new_vendor_mobile, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                initialCountry: 'auto',
                geoIpLookup: function(callback) {
                    callback('in');
                }
            });


            $('#vendor_mobile').keyup(function() {
                var iti = window.intlTelInputGlobals.getInstance(mobileInputField);
                var mobilewithcountrycode = iti.getNumber();
                var countryData = iti.getSelectedCountryData();
                var countryCode = `+${countryData.dialCode}`;
                var numberOnly = mobilewithcountrycode.replace(countryCode, '').replace(/\D/g, ''); // Remove country code & non-numeric chars
                if (numberOnly.length === 10) {
                    $('.mobile-error').hide();
                    checkMobileExists(mobilewithcountrycode); // Call function only if valid 10-digit number
                } else {
                    $('.mobile-error').show().text('Please enter a valid 10-digit mobile number');
                }
            });

            $('#new_vendor_mobile').keyup(function() {
                var iti = window.intlTelInputGlobals.getInstance(new_vendor_mobile);
                var mobilewithcountrycode = iti.getNumber();
                var countryData = iti.getSelectedCountryData();
                var countryCode = `+${countryData.dialCode}`;
                var numberOnly = mobilewithcountrycode.replace(countryCode, '').replace(/\D/g, ''); // Remove country code & non-numeric chars
                if (numberOnly.length === 10) {
                    $('.mobile-error').hide();
                    checkMobileExists(mobilewithcountrycode); // Call function only if valid 10-digit number
                } else {
                    $('.mobile-error').show().text('Please enter a valid 10-digit mobile number');
                }
            });
        });

        $('#newvendor, .newvendor').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });

        // Show dropdown on focus
        $('.vendor-search').on('focus', function() {
            $('.vendor-dropdown').addClass('active');
        });

        // Filter dropdown items based on search input
        $('.vendor-search').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.vendor-options').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });

        // Hide dropdown if clicked outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.dropdown-container').length) {
                $('.vendor-dropdown').removeClass('active');
            }
        });
        $('#vendorNewModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            $('#user-name-display').text('');
            $('.mobile-error').hide();
        });

        $('#addvendorModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset(); // Reset all form fields
            $('#user-name-display').text(''); // Clear user name display
            $('.mobile-error').hide(); // Hide any mobile error messages
        });

        $('#adduserModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset(); // Reset all form fields
            $('#user-name-display').text(''); // Clear user name display
            $('.mobile-error').hide(); // Hide any mobile error messages
        });

        $('#addbranchModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset(); // Reset all form fields
            $('#user-name-display').text(''); // Clear user name display
            $('.mobile-error').hide(); // Hide any mobile error messages
        });



        $('select[name="usertype"]').on('change', function() {
            if ($(this).val() === 'INDIVIDUAL') {
                // Hide business-related fields
                $(".business_details").hide();
            } else {
                // Show business-related fields
                $(".business_details").show();
            }
        });

        // Trigger change event on page load to set initial visibility
        $('select[name="usertype"]').trigger('change');



        // Form validation and submission for adding a new vendor
        $("#addvendor").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                vendor: {
                    required: true
                },
                vendortype: {
                    required: true
                },
                address: {
                    required: true
                },
                pincode: {
                    required: true,
                    digits: true
                },
                state: {
                    required: true
                },

                city: {
                    required: true
                },

                salutation: {
                    required: true
                },
                firstname: {
                    required: true
                },

                mobile: {
                    required: true,
                    minlength: 10, // Ensure mobile is 13 digits
                    maxlength: 10, // Ensure mobile is 13 digits
                    remote: { // Ajax call to check if the mobile number exists
                        url: "<?php echo base_url('allusers'); ?>",
                        type: "post",
                        data: {
                            mobile: function() {
                                return $('#mobile').val();
                            }
                        },
                        dataType: 'json',
                        dataFilter: function(response) {
                            var result = JSON.parse(response);
                            if (result.exists) {
                                return false; // Mobile exists, return false to trigger the remote message
                            } else {
                                return true; // Mobile does not exist, return true to allow form submission
                            }
                        }
                    }
                },
                gst: {
                    minlength: 15,
                    maxlength: 15
                }
            },
            messages: {
                vendor: {
                    required: "This field is required."
                },
                vendortype: {
                    required: "Vendor Type is mandatory."
                },
                address: {
                    required: "This field is required."
                },
                pincode: {
                    required: "This field is required.",
                    digits: "Please enter valid Pincode"
                },
                state: {
                    required: "This field is required."
                },

                city: {
                    required: "This field is required."
                },
                vendor: {
                    required: "Please select a vendor."
                },
                salutation: {
                    required: "This field is required."
                },
                firstname: {
                    required: "This field is required."
                },

                mobile: {
                    required: "This field is required.",
                    remote: "This number already in use",
                    minlength: "Mobile number must be 10 digits after +91.",
                    maxlength: "Mobile number must be 10 digits after +91."
                },
                gst: {
                    minlength: "Please enter a valid GST number.",
                    maxlength: "Please enter a valid GST number."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var formData = new FormData(form);
                var aid = "<?php echo $aid; ?>";
                formData.append('aid', aid);
                var companyid = "<?php echo $defaultcompany; ?>";
                formData.append('companyid', companyid);

                // AJAX request to add new vendor
                $.ajax({
                    url: "<?php echo base_url('Setting/addNewVendor'); ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 200) {


                            if (response.data) {
                                var newVendor = response.data.companyName;
                                var newVendorId = response.data.id;
                                var newcId = response.data.cid;

                                // Append the new vendor to the vendor type dropdown
                                $('#vendortype-dropdown').append('<option value="' + newVendorId + '">' + newVendor + '</option>');
                                $('#newvendor').val(newVendor);
                                $('#selected-vendortype-ids').val(newVendorId);

                                // Close modals
                                $('#addvendorModal').modal('hide');
                                $('#vendorNewModal').modal('hide');
                                $('#addNewvendor').modal('hide');

                                // Reset the form
                                $(form)[0].reset();
                                $('.error-message').hide();

                                // Reload the DataTable to show the new vendor
                                $('#vendorlist').DataTable().ajax.reload(null, false); // `false` keeps the current paging state

                            } else {
                                console.error("Response data is undefined.");
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        alert("An error occurred. Please try again.");
                    }
                });
            }


        });


        // Show dropdown on focus
        $('.branch-search').on('focus', function() {
            $('.branch-dropdown').addClass('active').show();
        });

        // Filter dropdown items based on search input
        $('.branch-search').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.branch-dropdown-item').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });

        // Hide dropdown if clicked outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.branch-dropdown-container').length) {
                $('.branch-dropdown').removeClass('active').hide();
            }
        });

        // Call fetchBranches when vendor search input changes
        $('.vendor-search').on('input', function() {
            var selectedVendorId = $('.vendor-search').data('selected-vendor-id');

            fetchBranches();
        });

        // Form validation and submission for adding a new branch
        $("#addbranch").validate({
            rules: {
                address: {
                    required: true
                },
                pincode: {
                    required: true,
                    digits: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                vendor: {
                    required: true
                },
                gst: {
                    maxlength: 15,
                    minlength: 15
                }
            },
            messages: {
                address: {
                    required: "This field is required."
                },
                pincode: {
                    required: "This field is required.",
                    digits: "Please enter valid Pincode"
                },
                state: {
                    required: "This field is required."
                },
                city: {
                    required: "This field is required."
                },
                vendor: {
                    required: "Please select a vendor."
                },
                gst: {
                    minlength: "Please enter a valid GST number.",
                    maxlength: "Please enter a valid GST number."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var selectedVendorId = $('.vendor-search').data('selected-vendor-id');

                var formData = $(form).serialize();
                var aid = "<?php echo $aid; ?>";
                formData += '&aid=' + encodeURIComponent(aid) + '&vendor_id=' + encodeURIComponent(selectedVendorId);
                $.ajax({
                    url: "<?php echo base_url('addNewBranch'); ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',

                    success: function(response) {


                        if (response.status === 200) {
                            var newBranch = response.data; // Ensure `data` is the correct property
                            var newBranchId = newBranch.id; // Ensure `id` is the correct property
                            var newBranchAddress = newBranch.address; // Ensure `address` is the correct property
                            var newBranchState = newBranch.state; // Ensure `state` is the correct property
                            var newBranchCity = newBranch.city; // Ensure `city` is the correct property

                            var newBranchFullName = newBranchAddress + ', ' + newBranchState + ', ' + newBranchCity;

                            // Update the dropdown menu with the new branch
                            $('#branch-dropdown').append('<div class="branch-item" data-id="' + newBranchId + '">' +
                                newBranchFullName + '</div>');

                            // Set the search input to the newly added branch
                            $('#branch-search').val(newBranchFullName);
                            $('#branch-search').data('selected-branch-id', newBranchId);

                            // Close the modal and reset the form
                            $('#addbranchModal').modal('hide');
                            $(form)[0].reset();
                        } else {
                            console.error('Error:', response.message); // Log the error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {

                        var errorAlert = $('#vendor-error-alert');
                        errorAlert.find('.alert-body').text('An error occurred. Please try again.');
                        errorAlert.show();
                    }
                });
            }
        });

        // Hide the dropdown if clicked outside the input or dropdown
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#user-dropdown, #user-search').length) {
                $('#user-dropdown').removeClass('active');
            }
        });

        // Trigger the fetch when user types a mobile number
        $('#user-search').on('keyup', function() {
            const searchTerm = $(this).val().trim(); // Use .trim() to remove spaces around the input

            // Validate if the input is a valid mobile number, with or without the country code, with or without "+"
            const isValidMobileNumber = /^(\+91)?\d{10}$/.test(searchTerm);
            if (isValidMobileNumber) {
                fetchUsers(searchTerm); // Fetch users if the number is valid
            } else {
                $('#user-dropdown').removeClass('active'); // Hide dropdown if input is not valid
            }
        });

        function fetchUsers(mobileNumber) {
            $.ajax({
                url: "<?php echo base_url('users'); ?>", // Your backend URL to fetch users
                type: 'POST',
                data: {
                    mobile: mobileNumber // Send the mobile number to the server
                },
                dataType: 'json',
                success: function(response) {
                    if (response && response.mobile) {
                        // Create the HTML content for the dropdown
                        let html = `<ul class="dropdown-list">
                                        <li class="user-dropdown-item" data-id="${response.id}" data-mobile="${response.mobile}">
                                            ${response.firstname} ${response.lastname}, ${response.mobile}
                                        </li>
                                    </ul>`;

                        // Display the results
                        $('#user-dropdown').html(html).addClass('active');

                        // Attach click event to the dropdown item
                        attachUserSelectionEvent();
                    } else {
                        $('#user-dropdown').html('<p>No users found</p>').addClass('active');
                    }
                },
                error: function(xhr) {
                    console.error('AJAX error:', xhr.responseText);
                    $('#user-dropdown').html('<p>Error loading users</p>').addClass('active');
                }
            });
        }



        // Form validation and submission for adding a new user
        // $("#adduser").validate({
        //     errorClass: 'error',
        //     errorElement: 'div',
        //     highlight: function (element) {
        //         $(element).addClass('is-invalid');
        //     },
        //     unhighlight: function (element) {
        //         $(element).removeClass('is-invalid');
        //     },
        //     rules: {
        //         salutation: { required: true },
        //         firstname: { required: true },
        //         mobile: {
        //             required: true,
        //             remote: {
        //                 url: "<?php echo base_url('allusers'); ?>",
        //                 type: "post",
        //                 data: {
        //                     mobile: function () { return $('#mobile').val(); }
        //                 },
        //                 dataFilter: function (response) {
        //                     var result = JSON.parse(response);
        //                     return result.exists ? false : true;
        //                 }
        //             }
        //         }
        //     },
        //     messages: {
        //         salutation: { required: "This field is required." },
        //         firstname: { required: "This field is required." },
        //         mobile: {
        //             required: "This field is required.",
        //             remote: "This mobile number is already in use."
        //         }
        //     },
        //     submitHandler: function (form, event) {
        //         event.preventDefault();

        //         $("#add_vendor").prop("disabled", true); // Disable the submit button
        //         var formData = $(form).serialize();

        //         $.ajax({
        //             url: "<?php echo base_url('Setting/addNewUser'); ?>",
        //             type: 'POST',
        //             data: formData,
        //             dataType: 'json',
        //             success: function (response) {
        //                 if (response.status === 200) {
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'User Added',
        //                         text: 'The user was added successfully!',
        //                     });

        //                     $('#adduserModal').modal('hide');
        //                     $(form)[0].reset();
        //                 } else {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Error',
        //                         text: response.message || 'An error occurred.',
        //                     });
        //                 }
        //             },
        //             error: function () {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Internal Server Error',
        //                     text: 'Something went wrong. Please try again later.',
        //                 });
        //             },
        //             complete: function () {
        //                 $("#add_vendor").prop("disabled", false); // Re-enable the submit button
        //             }
        //         });
        //     }
        // });


        $("#newuser").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                salutation: {
                    required: true
                },
                firstname: {
                    required: true
                },
                mobile: {
                    required: true,
                    minlength: 10, // Ensure mobile is 13 digits
                    maxlength: 10, // Ensure mobile is 13 digits
                }
            },
            messages: {
                salutation: {
                    required: "This field is required."
                },
                firstname: {
                    required: "This field is required."
                },
                mobile: {
                    required: "This field is required.",
                    minlength: "Mobile number must be 10 digits after +91", // Ensure mobile is 13 digits
                    maxlength: "Mobile number must be 10 digits after +91", // Ensure mobile is 13 digits

                }
            },
            submitHandler: function(form, event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(form).serialize();

                $.ajax({
                    url: "<?php echo base_url('Setting/addNewUser'); ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            var newUser = response.data;
                            var newUserId = newUser.id;
                            var newUserFullName = newUser.firstname + ' ' + newUser.lastname;
                            var newUserMobile = newUser.mobile;
                            $('#searchResults').append('<div class="search-result-item" data-id="' + newUserId + '">' +
                                newUserFullName + ' (' + newUserMobile + ')</div>');
                            $('#user-search').val(newUserFullName + ' ' + newUserMobile);
                            $('#user-search').data('selected-user-id', newUserId);
                            $('#adduserModal').modal('hide');
                            $(form)[0].reset();
                        } else {
                            console.error('Error:', response.message);
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Internal Server Error',
                            text: 'Something went wrong. Please try again later.',
                        });
                    }
                });
            }
        });


        /* ------------------------------------------------------------------------- *
         * GET INSURER LIST FOR SELECT FIELD
         * ------------------------------------------------------------------------- */
        // var selectedInsurer = "<?php echo isset($essentialdata->insurer) ? $essentialdata->insurer : null ?>";
        // $.ajax({
        //     url: '<?php echo base_url('allinsurer'); ?>',
        //     type: 'get',
        //     dataType: 'JSON',
        //     success: function(response) {
        //         $("#insurer").html('');
        //         $("#insurer").append('<option value="">Nothing Selected</option>');
        //         $.each(response, function(i, val) {
        //             $("#insurer").append("<option value='" + val.id + "'" + (val.id === selectedInsurer ? "selected='selected'" : "") + ">" + val.insurer + "</option>");
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //         console.error(xhr.responseText);
        //     }
        // });

        $("#marine_essential_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#marine_spot_inspection').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                // Submit the form
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                $("#generate_ila").css('display', 'block');
                $('#marine_spot_inspection').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        /* ------------------------------------------------------------------------- *
         * VALIDATE AND SUBMIT ESSENTIAL FORM (MARINE SPOT INSPECTION)
         * ------------------------------------------------------------------------- */
        $("#marine_spot_inspection").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                case_reference: {
                    required: true,
                    // caseReferenceFormat: true
                },
                insurer: {
                    required: true
                },
                consignee: {
                    required: true
                },
                cargo: {
                    required: true
                },
                policy_no: {
                    required: true
                },
                survey_allotment_date: {
                    required: true
                },
                consignment_value: {
                    required: true,
                },

                loss_data: {
                    required: true
                },
                type_of_loss: {
                    required: true
                },
                consignment_courie: {
                    required: true
                },
                consignment_date: {
                    required: true

                },
                invoice_stn_no: {
                    required: true
                },
                invoice_date: {
                    required: true
                },

                packing_description: {
                    required: true
                },
                claimant_representative: {
                    required: true
                },
                survey_place: {
                    required: true
                },
                survey_date: {
                    required: true
                },
                insured_name: {
                    required: true
                }
            },
            messages: {
                case_reference: {
                    required: "This field is required",
                    // caseReferenceFormat: "Invalid format! Please enter in the format: VP/I/24/05/115"
                },
                insurer: "Please select Insurance Company.",
                consignee: {
                    required: "Consignee is required"
                },
                cargo: {
                    required: "Cargo is required"
                },
                policy_no: {
                    required: "Policy number is required"
                },
                survey_allotment_date: {
                    required: "Survey allotment date is required"
                },
                consignment_value: {
                    required: "Consignment value is required",
                    number: true
                },

                loss_data: {
                    required: "Loss data is required"
                },
                type_of_loss: {
                    required: "Type of loss is required"
                },
                consignment_courie: {
                    required: "Consignment courier is required"
                },
                consignment_date: {
                    required: "Consignment date is required"
                },
                invoice_stn_no: {
                    required: "Invoice STN number is required"
                },
                invoice_date: {
                    required: "Invoice Date is required"
                },

                packing_description: {
                    required: "Packing description is required"
                },
                claimant_representative: {
                    required: "Claimant's representative is required"
                },
                survey_place: {
                    required: "Survey place is required"
                },
                survey_date: {
                    required: "Survey date is required"
                },
                insured_name: {
                    required: "Insured Name is required"
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var claim_assessment = $('#claim_assessment').val();
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);
                formdata.append('claim_assessment', claim_assessment);

                if (natureofjob == 63) {
                    $('.form-group', '#invoiceContainer').each(function(index, element) {
                        var invoicenumber = $(element).find('[name="invoicenumber[]"]').val();
                        var invoicedate = $(element).find('[name="invoicedate[]"]').val();
                        var invoicevalue = $(element).find('[name="invoicevalue[]"]').val(); // Only get the first file
                        // Append invoice data to FormData as an object
                        formdata.append('invoices[' + index + '][invoicenumber]', invoicenumber);
                        formdata.append('invoices[' + index + '][invoicedate]', invoicedate);
                        formdata.append('invoices[' + index + '][invoicevalue]', invoicevalue);
                    });

                    $('.form-group', '#grContainer').each(function(index, element) {
                        var grnumber = $(element).find('[name="grnumber[]"]').val();
                        var grdate = $(element).find('[name="grdate[]"]').val();
                        // Append invoice data to FormData as an object
                        formdata.append('gr[' + index + '][grnumber]', grnumber);
                        formdata.append('gr[' + index + '][grdate]', grdate);
                    });
                }

                $.ajax({
                    url: '<?php echo base_url('marinespotspotessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false, // Prevent jQuery from automatically transforming the data into a query string
                    contentType: false, // Set content type to false for FormData
                    success: function(response) {

                        if (response.status == 200) {
                            $('#marine_essential_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                            // scrollToNextForm("#caseForm");
                        }
                    }
                });
            }
        });

        $("#marinefinal_essential_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#marine_final_inspection').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $("#toggleManualEntry").prop("disabled", true);
                $("input[type='checkbox']").prop("disabled", true);

            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                // $(".add_more").addClass('disabled');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $("#toggleManualEntry").prop("disabled", false);
                $("input[type='checkbox']").prop("disabled", false);

            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#marine_final_inspection').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $("#toggleManualEntry").prop("disabled", true);
                $("input[type='checkbox']").prop("disabled", true);

            }
        });

        $("#marine_final_inspection").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                case_reference: {
                    required: true,
                    // caseReferenceFormat: true
                },
                insurer: {
                    required: true
                },
                consignee: {
                    required: true
                },
                cargo: {
                    required: true
                },
                policy_no: {
                    required: true
                },
                survey_allotment_date: {
                    required: true
                },
                consignment_value: {
                    required: true,
                },


                type_of_loss: {
                    required: true
                },
                consignment_courie: {
                    required: true
                },
                consignment_date: {
                    required: true

                },
                invoice_stn_no: {
                    required: true
                },
                invoice_date: {
                    required: true
                },

                packing_description: {
                    required: true
                },
                claimant_representative: {
                    required: true
                },
                survey_place: {
                    required: true
                },
                survey_date: {
                    required: true
                },
                insured_name: {
                    required: true
                }
            },
            messages: {
                case_reference: {
                    required: "This field is required",
                    // caseReferenceFormat: "Invalid format! Please enter in the format: VP/I/24/05/115"
                },
                insurer: "Please select Insurance Company.",
                consignee: {
                    required: "Consignee is required"
                },
                cargo: {
                    required: "Cargo is required"
                },
                policy_no: {
                    required: "Policy number is required"
                },
                survey_allotment_date: {
                    required: "Survey allotment date is required"
                },
                consignment_value: {
                    required: "Consignment value is required",
                    number: true
                },

                type_of_loss: {
                    required: "Type of loss is required"
                },
                consignment_courie: {
                    required: "Consignment courier is required"
                },
                consignment_date: {
                    required: "Consignment date is required"
                },
                invoice_stn_no: {
                    required: "Invoice STN number is required"
                },
                invoice_date: {
                    required: "Invoice Date is required"
                },

                packing_description: {
                    required: "Packing description is required"
                },
                claimant_representative: {
                    required: "Claimant's representative is required"
                },
                survey_place: {
                    required: "Survey place is required"
                },
                survey_date: {
                    required: "Survey date is required"
                },
                insured_name: {
                    required: "Insured Name is required"
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var claim_assessment = $('#claim_assessment').val();
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);
                formdata.append('claim_assessment', claim_assessment);
                // Check if the checkbox is checked or unchecked, and append the appropriate value
                var printEstimatedAmount = $("input[name='print_estimated_amt']").prop("checked") ? 1 : 0;
                formdata.append('print_estimated_amt', printEstimatedAmount);
                var printSalvageAmount = $("input[name='print_salvage_amt']").prop("checked") ? 1 : 0;
                formdata.append('print_salvage_amt', printSalvageAmount);

                if (natureofjob == 66) {
                    $('.form-group', '#invoiceContainer').each(function(index, element) {
                        var invoicenumber = $(element).find('[name="invoicenumber[]"]').val();
                        var invoicedate = $(element).find('[name="invoicedate[]"]').val();
                        var invoicevalue = $(element).find('[name="invoicevalue[]"]').val();
                        formdata.append('invoices[' + index + '][invoicenumber]', invoicenumber);
                        formdata.append('invoices[' + index + '][invoicedate]', invoicedate);
                        formdata.append('invoices[' + index + '][invoicevalue]', invoicevalue);
                    });

                    $('.form-group', '#grContainer').each(function(index, element) {
                        var grnumber = $(element).find('[name="grnumber[]"]').val();
                        var grdate = $(element).find('[name="grdate[]"]').val();
                        formdata.append('gr[' + index + '][grnumber]', grnumber);
                        formdata.append('gr[' + index + '][grdate]', grdate);
                    });
                }

                // // Log form data entries
                // for (let [key, value] of formdata.entries()) {
                //     console.log(`${key}: ${value}`);
                // }

                $.ajax({
                    url: '<?php echo base_url('marinefinalspotessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            $('#marinefinal_essential_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $(".disable_btn").addClass("disabled-btn");
                            $("#generate_ila").css('display', 'block');
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                        }
                    }
                });
            }

        });

        if ($("#marinefinal_essential_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".editable-field").prop("disabled", true);
            $("#toggleManualEntry").prop("disabled", true);
            $("input[type='checkbox']").prop("disabled", true);

        }

        function populateInvoices(data, disableFields) {
            const invoiceContainer = $('#invoiceContainer');
            invoiceContainer.empty();
            const invoices = Array.isArray(data) ? data : [data]; // If data is not already an array, wrap it in one
            invoices.forEach((invoice, index) => {
                const newInvoice = `
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="invoicenumber_${index}" style="color:black">Invoice Number</label>
                        <input type="text" name="invoicenumber[]" id="invoicenumber_${index}" ${disableFields && invoice.invoicenumber ? 'disabled' : ''} 
                        placeholder="Invoice Number" class="form-control editable-field" value="${invoice.invoicenumber || ''}">
                    </div>
                    <div class="col-lg-4">
                        <label for="invoicedate_${index}" style="color:black">Invoice Date</label>
                        <input type="date" name="invoicedate[]" id="invoicedate_${index}" ${disableFields && invoice.invoicedate ? 'disabled' : ''} 
                        placeholder="Invoice Date" class="form-control editable-field" value="${invoice.invoicedate || ''}">
                    </div>
                    <div class="col-lg-3">
                        <label for="invoicevalue_${index}" style="color:black">Invoice Value</label>
                        <input type="text" name="invoicevalue[]" id="invoicevalue_${index}" ${disableFields && invoice.invoicevalue ? 'disabled' : ''} 
                        placeholder="Invoice Value" class="form-control addinvoice editable-field" value="${invoice.invoicevalue || ''}">
                    </div>
                    <div class="col-lg-1" style="text-align:end; align-self:end">
                        ${index === 0 ? '<button type="button" onclick="addNewInvoice()"  style="width:100%;height:39px;" class="btn btn-rounded btn-success editable-field"><i class="fa fa-plus" style="font-size: 15px;"></i></button>' : ''}
                        ${index !== 0 ? '<button type="button" onclick="removeInvoice(this)" style="width:100%;height:39px;" class="btn btn-rounded btn-warning editable-field"><i class="fa fa-times" style="font-size: 15px;"></i></button>' : ''}
                    </div>
                </div>`;
                invoiceContainer.append(newInvoice);
            });


            if ($("#marinefinal_essential_submit,#marine_predis_essential_submit,#marine_essential_submit").val() === "Edit") {
                $(".disabledbtn").addClass('disabled-btn');
                $(".editable-field").prop("disabled", true);
                $("#toggleManualEntry").prop("disabled", true);
            }
            // Bind any input events needed after the dynamic content is generated
            bindInputEvents();
        }

        function populateGr(data) {

            const grContainer = $('#grContainer');
            grContainer.empty();

            // Check if data is an array (for example, in case the response was wrapped in an array)
            const grList = Array.isArray(data) ? data : [data]; // If data is not already an array, wrap it in one

            grList.forEach((gr, index) => {
                const newGr = `
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="grnumber_${index}" style="color:black">GR Number</label>
                        <input type="text" name="grnumber[]" id="grnumber_${index}" ${gr.grnumber ? 'disabled' : ''} 
                        placeholder="GR Number" class="form-control editable-field" value="${gr.grnumber || ''}">
                    </div>
                    <div class="col-lg-5">
                        <label for="grdate_${index}" style="color:black">GR Date</label>
                        <input type="date" name="grdate[]" id="grdate_${index}" ${gr.grdate ? 'disabled' : ''} 
                        placeholder="GR Date" class="form-control editable-field" value="${gr.grdate || ''}">
                    </div>
                    <div class="col-lg-1" style="text-align:end; align-self:end">
                        ${index === 0 ? '<button type="button" onclick="addNewgr()"  style="width:100%;height:39px" class="btn btn-rounded btn-success editable-field"><i class="fa fa-plus" style="font-size: 15px;"></i></button>' : ''}
                        ${index !== 0 ? '<button type="button" onclick="removeGR(this)" style="width:100%;height:39px" class="btn btn-rounded btn-warning editable-field"><i class="fa fa-times" style="font-size: 15px;"></i></button>' : ''}
                    </div>
                </div>`;
                grContainer.append(newGr);
            });

            if ($("#marinefinal_essential_submit,#marine_predis_essential_submit,#marine_essential_submit").val() === "Edit") {
                $(".disabledbtn").addClass('disabled-btn');
                $(".editable-field").prop("disabled", true);
                $("#toggleManualEntry").prop("disabled", true);
            }
        }



        function addtotalRow() {
            var newRowHtml = `
                <tr> <td  style="padding:0px;border-top:none;">Total</td></tr>
                <tr style="border-top:1px  solid black; border-bottom:1px solid black" >
                    <td style="padding:0px;border-top:none; width:280px"><input type="text" style="border:0px;" class="form-control editable-field description_goods" id="description_goods_result"  placeholder="" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field qty_kg_total"  id="qty_kg_result"   placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field amount_rs_total"  id="amount_rs_result"   ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field rate_kg_total"  id="rate_kg_result"  ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field claimed_bags_total"  id="claimed_bags_result" placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field dmg_qty_total"  id="dmg_qty_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_percent_total"  id="loss_percent_result"   ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_assd_total"  id="loss_assd_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_amount_total"  id="loss_amount_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none; width:218px"><input style="border:0px;" type="text" class="form-control editable-field remarks"  placeholder="" ></td>
                </tr>`;
            $('#data-body').html(newRowHtml);
        }

        /* ------------------------------------------------------------------------- *
         * ADD INVOICE FIELD
         * ------------------------------------------------------------------------- */
        function addNewInvoice() {
            var container = document.getElementById('invoiceContainer');
            var newRow = document.createElement('div');
            invoiceCounter = container.children.length + 1;
            newRow.className = 'form-group row';
            newRow.innerHTML = `<div class="col-lg-4">
                            <input type="text" name="invoicenumber[]" placeholder="Invoice Number" class="form-control editable-field">
                        </div>
                        <div class="col-lg-4">
                            <input type="date" name="invoicedate[]" placeholder="Invoice Date" class="form-control editable-field">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="invoicevalue[]" placeholder="Invoice Value" class="form-control editable-field">
                        </div>
                        <div class="col-lg-1" style="align-self:center">
                            <button type="button" onclick="removeInvoice(this)" style="width:100%; height:39px;" class="btn btn-rounded btn-warning editable-field"><i class="fa fa-times" style="font-size: 15px;"></i></button>
                        </div>`;
            container.appendChild(newRow);
            updateTotal();
            bindInputEvents();
        }

        function removeInvoice(element) {
            var rowToRemove = element.parentNode.parentNode;
            rowToRemove.parentNode.removeChild(rowToRemove);
            updateTotal();
        }


        // LOSS ASSD TOGGLE BUTTON OF LOSS ASSESSMENT          
        $(document).on('change', 'input[type="checkbox"][name="ls"]', function() {
            var $row = $(this).closest('tr'); // Get the closest row relative to the changed checkbox
            var $lossAssdInput = $row.find('.loss_assd'); // Find the loss_assd input field 
            // var $lossAssdTotal = $row.find('.loss_assd_total');

            // Check current value of loss_assd input
            var currentVal = parseFloat($lossAssdInput.val());

            if (isNaN(currentVal) || currentVal === 0) {
                var damaged_unit = parseFloat($row.find('.dmg_qty').val()) || 0;
                var loss_percentage = parseFloat($row.find('.loss_percent').val()) || 0;
                var loss_assd_amt = (damaged_unit * loss_percentage) / 100;
                $lossAssdInput.val(loss_assd_amt.toFixed(2)).prop('disabled', false); // Update loss_assd input with calculated value
                // $('.loss_assd_total').val(currentVal);

            } else {
                $lossAssdInput.val('0.00');
                $lossAssdInput.prop('disabled', true);
                // $('.loss_assd_total').val('0.00');
            }
            return false;
        });


        function formatRupees(value) {
            value = value.toString();
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        function formatnumber(value) {
            // Ensure the value is numeric
            if (value === null || value === undefined || value === "") {
                return ""; // Return an empty string for null, undefined, or empty values
            }
            if (isNaN(value)) {
                return value; // Return the value as it is if it's not a number
            }

            // Convert the value to a string
            value = value.toString();

            // Check for a negative number
            let isNegative = false;
            if (value.startsWith("-")) {
                isNegative = true;
                value = value.slice(1); // Remove the negative sign for formatting
            }

            // Split the value into integer and decimal parts
            let value_parts = value.split(".");
            let integer_part = value_parts[0];
            let decimal_part = value_parts.length > 1 ? value_parts[1] : "";

            // Apply Indian Numbering System formatting to the integer part
            if (integer_part.length > 3) {
                let last_three = integer_part.slice(-3);
                let rest = integer_part.slice(0, integer_part.length - 3);

                // Apply the comma after every two digits starting from the right
                integer_part = rest.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + "," + last_three;
            }

            // Combine the formatted integer part with the decimal part (if any)
            let formattedNumber = decimal_part ? `${integer_part}.${decimal_part}` : integer_part;

            // Add the negative sign back if the number is negative
            return isNegative ? `-${formattedNumber}` : formattedNumber;
        }




        $(document).on('input', 'input[name="invoicevalue[]"]', function() {
            updateTotal();
        });

        function bindInputEvents() {
            $('input[name="invoicevalue[]"]').off('input').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
                value = formatnumber((value / 100).toFixed(2)); // Format the value
                $(this).val(value);
                updateTotal();
            });

            $('input.only_numbers').off('input').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
                value = formatRupees((value / 100).toFixed(2)); // Format the value
                $(this).val(value);
                updateTotal();
                addtotalRow();
                grandtotalRow();
            });
        }


        $(document).on('input', 'input.only_numbers', function() {
            updateTotal();
        });

        function updateTotal() {
            let invoicevalue = 0;
            let qty_kg = 0;
            let amount_rs = 0;
            let rate_kg = 0;
            let claimed_bags = 0;
            let dmg_qty = 0;
            let loss_assd = 0;
            let loss_amount = 0;

            $('input[name="invoicevalue[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    invoicevalue += value;
                }
            });
            $('#consignment_value').val(formatRupees(invoicevalue.toFixed(2)));


            // TOTAL QUANTITY OF LOSS ASSESSMENT
            $('input[name="qty_kg[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    qty_kg += value;
                }
            });

            $('.qty_kg_total').val(formatRupees(qty_kg.toFixed(2)));


            // TOTAL AMOUNT OF LOSS ASSESSMENT
            $('input[name="amount_rs[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    amount_rs += value;
                }
            });
            $('.amount_rs_total').val(formatRupees(amount_rs.toFixed(2)));


            // TOTAL CLAIMED OF LOSS ASSESSMENT
            $('input[name="claimed_bags[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    claimed_bags += value;
                }
            });
            $('.claimed_bags_total').val(formatRupees(claimed_bags.toFixed(2)));


            // TOTAL DMG OF LOSS ASSESSMENT
            $('input[name="dmg_qty[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    dmg_qty += value;
                }
            });
            $('.dmg_qty_total').val(formatRupees(dmg_qty.toFixed(2)));

            // TOTAL LOSS ASSD OF LOSS ASSESSMENT
            $('input[name="loss_assd[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    loss_assd += value;
                }
            });
            $('.loss_assd_total').val(formatRupees(loss_assd.toFixed(2)));





            // CALCULATE RATE OF LOSS ASSESSMENT
            $('.amount_rs, .qty_kg').on('input', function() {
                var $row = $(this).closest('tr'); // Get the closest row

                var amount = parseFloat($row.find('.amount_rs').val().replace(/,/g, '')) || 0;
                var quantity = parseFloat($row.find('.qty_kg').val().replace(/,/g, '')) || 1; // Default to 1 if empty or zero to avoid division by zero

                // Calculate rate per kg
                var rate = amount / quantity;

                // Update rate_kg input
                $row.find('.rate_kg').val(rate.toFixed(2)); // Display rate with 2 decimal places
            });




            // CALCULATE LOSS AMOUNT AND ASSD AMOUNT OF LOSS ASSESSMENT
            // Function to calculate loss_amount
            function calculateLossAmount($row) {
                var loss_assd = parseFloat($row.find('.loss_assd').val().replace(/,/g, '')) || 0;
                var rate = parseFloat($row.find('.rate_kg').val().replace(/,/g, '')) || 1; // Default to 1 if empty or zero to avoid division by zero

                // Calculate loss_amount
                var loss_amount = loss_assd * rate;

                // Update .loss_amount input
                $row.find('.loss_amount').val(formatRupees(loss_amount.toFixed(2))); // Display loss_amount with 2 decimal places
            }

            // Event handler for .dmg_qty and .loss_percent inputs
            $('.dmg_qty, .loss_percent').on('input', function() {
                var $row = $(this).closest('tr'); // Get the closest row

                var damaged_unit = parseFloat($row.find('.dmg_qty').val().replace(/,/g, '')) || 0;
                var loss_percentage = parseFloat($row.find('.loss_percent').val().replace(/,/g, '')) || 0; // Default to 0 if empty or invalid

                // Calculate loss_assd_amt
                var loss_assd_amt = (damaged_unit * loss_percentage) / 100;

                // Update loss_assd input
                $row.find('.loss_assd').val(loss_assd_amt.toFixed(2)); // Display loss_assd_amt with 2 decimal places
                $('.loss_assd_toggle').removeClass('btn-secondary').addClass('btn-success');

                // Automatically calculate loss_amount
                calculateLossAmount($row);
            });

            // Event handler for .loss_assd and .rate_kg inputs
            $('.loss_assd, .rate_kg').on('input', function() {
                var $row = $(this).closest('tr'); // Get the closest row

                // Automatically calculate loss_amount
                calculateLossAmount($row);
            });


            $('.claimed_bags').on('input', function() {
                var $row = $(this).closest('tr'); // Get the closest row
                var claimedBagsValue = parseFloat($(this).val().replace(/,/g, ''));
                var qtyKgValue = parseFloat($row.find('.qty_kg').val().replace(/,/g, ''));
                if (claimedBagsValue > qtyKgValue) {
                    // alert('Claimed units cannot be greater than Inv qty.');
                    $(this).val('0.00'); // Reset the value to the maximum allowed
                }
            });


            $('.qty_kg').on('input', function() {
                var $row = $(this).closest('tr');
                var claimedBagsValue = parseFloat($row.find('.claimed_bags').val().replace(/,/g, ''));
                var qtyKgValue = parseFloat($(this).val().replace(/,/g, ''));

                if (claimedBagsValue > qtyKgValue) {
                    // alert('Claimed units cannot be greater than Inv qty.');
                    $(this).val('0.00'); // Reset the value to the maximum allowed
                }
            });



            $('.dmg_qty').on('input', function() {
                var $row = $(this).closest('tr');
                var damagedValue = parseFloat($(this).val().replace(/,/g, ''));
                var claimedUnitsValue = parseFloat($row.find('.claimed_bags').val().replace(/,/g, ''));
                if (damagedValue > claimedUnitsValue) {
                    // alert('Damaged units cannot be greater than claimed Units and than Inv qty.');
                    $(this).val('00'); // Reset the value to the maximum allowed
                }
            });




            $('.claimed_bags').on('input', function() {
                var $row = $(this).closest('tr');
                var damagedValue = parseFloat($row.find('.dmg_qty').val().replace(/,/g, ''));
                var claimedUnitsValue = parseFloat($(this).val().replace(/,/g, ''));

                if (damagedValue > claimedUnitsValue) {
                    // alert('Damaged units cannot be greater than claimed Units and than Inv qty.');
                    $(this).val('00'); // Reset the value to the maximum allowed
                }
            });

            $('.loss_percent').on('input', function() {
                var value = $(this).val();
                if (value !== '' && !isNaN(value)) {
                    $(this).val(value + ' ' + '%');
                }
            });

            // Trigger the input event on .amt when .fixed_percentage is set to 'percentage'
            $(".assessment-body select.fixed_percentage").on('change', function() {
                if ($(this).val() === 'percentage') {
                    $('.amt').trigger('input');
                }
            });

            // TOTAL LOSS AMOUNT OF LOSS ASSESSMENT
            $('input[name="loss_amount[]"]').each(function() {
                let value = $(this).val().replace(/[^0-9.]/g, '');
                value = parseFloat(value);
                if (!isNaN(value)) {
                    loss_amount += value;
                }
            });
            $('.loss_amount_total').val(formatRupees(loss_amount.toFixed(2)));
            /* ------------------------------------------------------------------------- *
             *  LOSS AMOUNT WITH  GST
             * ------------------------------------------------------------------------- */
            // Function to calculate total loss amount and update fields
            function calculateTotalLossAmount() {
                let loss_amount = 0;
                let gstPercent = 0;
                var net_loss_amount = 0; // Default value

                // Check if element exists before accessing its value
                let $netLossInput = $('.loss_amount_grand_total');
                if ($netLossInput.length > 0) {
                    let netLossValue = $netLossInput.val();
                    if (netLossValue !== undefined && netLossValue !== null) {
                        net_loss_amount = parseFloat(netLossValue.replace(/,/g, '').trim());
                    }
                }

                // Calculate total loss amount from input fields
                $('input[name="loss_amount[]"]').each(function() {
                    let value = $(this).val().replace(/[^0-9.]/g, '');
                    value = parseFloat(value);
                    if (!isNaN(value)) {
                        loss_amount += value;
                    }
                });

                // Calculate total GST amount dynamically
                $('input[name="gstamt[]"]').each(function() {
                    let value = $(this).val().replace(/[^0-9.]/g, '').trim();
                    if (value !== '') {
                        gstPercent = parseFloat(value);
                    }
                });

                // Calculate total amount including GST based on current add_less selection
                var selected_add_less_value = $('select[name="add_less[]"]').val();
                var total_amt;
                if (selected_add_less_value === 'add') {
                    total_amt = net_loss_amount + gstPercent;
                } else if (selected_add_less_value === 'less') {
                    total_amt = net_loss_amount - gstPercent;
                } else {
                    total_amt = loss_amount; // Default to loss_amount if add_less is not properly selected
                }

                // Update loss_amount_grand_total field with the formatted total amount
                $('.loss_amount_grand_total').val(formatRupees(total_amt.toFixed(2)));

                return loss_amount;
            }


            // Calculate initial total loss amount when the page loads
            var initial_loss_amount = calculateTotalLossAmount();

            // Display initial loss amount in loss_amount_grand_total
            $('.loss_amount_grand_total').val(formatRupees(initial_loss_amount.toFixed(2)));

            $(document).on('change', '.fixed_percentage', function() {
                var $percentageRow = $(this).closest('tr');
                var netAmount = parseFloat($('.loss_amount_total').val().replace(/,/g, '').trim());
                var selectedValue = $(this).val();
                var $inputs = $percentageRow.find('.gst');

                // Event handler for input within the percentageRow
                $inputs.off('input').on('input', function() {
                    var inputValue = $(this).val().trim();

                    if (selectedValue === 'percentage') {
                        if (inputValue.endsWith('%')) {
                            inputValue = inputValue.slice(0, -1);
                            $(this).val(inputValue);
                        }
                        if (inputValue !== '' && !inputValue.endsWith('%')) {
                            $(this).val(inputValue + '%');
                        }
                        if (inputValue !== '' && !isNaN(inputValue)) {
                            var enteredValue = parseFloat(inputValue);
                            var gstPercentage = (netAmount * enteredValue) / 100;

                            $percentageRow.find('input[name="gstamt[]"]').val(gstPercentage.toFixed(2).replace(/,/g, ''));
                        }
                    } else if (selectedValue === 'fixed') {
                        if (inputValue.endsWith('%')) {
                            inputValue = inputValue.slice(0, -1);
                            $(this).val(inputValue);
                        }
                        var enteredValue = parseFloat(inputValue);
                        if (!isNaN(enteredValue)) {
                            $percentageRow.find('input[name="gstamt[]"]').val(enteredValue.toFixed(2).replace(/,/g, ''));
                        }
                    }

                    calculateTotalLossAmount(); // Calculate total after input change
                }).trigger('input'); // Trigger input event to initialize calculation
            });

            // Initialize calculation on page load
            calculateTotalLossAmount();
        }

        /* ------------------------------------------------------------------------- *
         * ADD GR FIELD
         * ------------------------------------------------------------------------- */
        function addNewgr() {
            var container = document.getElementById('grContainer');
            var newRow = document.createElement('div');
            invoiceCounter = container.children.length + 1;
            newRow.className = 'form-group row';
            newRow.innerHTML = `<div class="col-lg-6">
                            <input type="text" name="grnumber[]" placeholder="GR Number" class="form-control editable-field">
                        </div>
                        <div class="col-lg-5">
                            <input type="date" name="grdate[]" placeholder="GR Date" class="form-control editable-field">
                        </div>
                        <div class="col-lg-1" style="align-self:center">
                            <button type="button" onclick="removeGR(this)" style="width:100%" class="btn btn-rounded btn-warning editable-field"><i class="fa fa-times"></i></button>
                        </div>`;
            container.appendChild(newRow);
        }

        function removeGR(element) {
            var rowToRemove = element.parentNode.parentNode;
            rowToRemove.parentNode.removeChild(rowToRemove);
        }

        /* ------------------------------------------------------------------------- *
         * DYNAMICALLY ADDING LOSS ASSESSMENT ROWS(KAJAL)
         * ------------------------------------------------------------------------- */

        var rowCount = 0;
        // Function to add new assessment rows
        function addNewAssessmentRow() {
            rowCount++; // Increment row count for unique IDs
            var newRowHtml = `
                <tr>
                    <td style="width: 180px;"><input type="text" class="form-control editable-field description_goods_second" name="description_goods_${rowCount}" placeholder="Description of Goods"></td>
                    <td style="width: 100px;">
                        <select class="form-control editable-field" id="units" name="units">
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
                        <!-- Checkbox -->
                        <input type="checkbox" name="ls" value="" class="" style="display: flex; justify-content: center; align-items: center;">
                    </td>
                    <td><input type="text" class="form-control editable-field only_numbers loss_assd" name="loss_assd[]" placeholder="0.00"></td>
                    <td><input type="text" class="form-control editable-field only_numbers loss_amount" name="loss_amount[]" placeholder="0.00"></td>
                    <td style="width: 180px;"><input type="text" class="form-control editable-field remarks" name="remarks[]" placeholder="Remarks"></td>
                    <td><button type="button" style="width: 100%; height: 40px;" onclick="removeAssessment(this)" class="btn btn-rounded btn-warning editable-field remove-btn"><i class="fa fa-times"></i></button></td>
                </tr>`;

            $('#form-row').append(newRowHtml); // Append new row after the existing form
            updateTotal();
            bindInputEvents();
        }

        // Event listener for the "+" button
        $('#add_more_btn').on('click', function() {
            addNewAssessmentRow();
        });

        // Function to remove assessment rows
        function removeAssessment(element) {
            var rowToRemove = element.parentNode.parentNode;
            rowToRemove.parentNode.removeChild(rowToRemove);
            updateTotal();
            if ($('#assessment-body tr').length === 0) {
                $('.add_new_table_body').show();
            }
        }


        /* ------------------------------------------------------------------------- *
         *  ADD NET AMOUNT ROW
         * ------------------------------------------------------------------------- */
        // Calculate Rate/Kg when Quantity or Amount changes

        function addtotalRow() {
            var newRowHtml = `
                <tr  style="border-top:1px  solid black; border-bottom:1px solid black" >
                    <td style="padding:0px;border-top:none; width:280px"><input type="text" style="border:0px;" class="form-control editable-field description_goods" id="description_goods_result"  placeholder="" value="Net Amount"></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control  editable-field qty_kg_total"  id="qty_kg_result"   placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field amount_rs_total"  id="amount_rs_result"   ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field rate_kg_total"  id="rate_kg_result"  ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field claimed_bags_total"  id="claimed_bags_result" placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field dmg_qty_total"  id="dmg_qty_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_percent_total"  id="loss_percent_result"   ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_assd_total"  id="loss_assd_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_amount_total"  id="loss_amount_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none; width:218px"><input style="border:0px;" type="text" class="form-control editable-field remarks"  placeholder="" ></td>
                </tr>`;
            $('#data-body').html(newRowHtml);
        }


        /* ------------------------------------------------------------------------- *
         * ADD GRAND TOTAL ROW
         * ------------------------------------------------------------------------- */

        function grandtotalRow() {
            var newRowHtml = `
                <tr  style="border-top:1px  solid black; border-bottom:1px solid black" >
                    <td style="padding:0px;border-top:none; width:280px"><input type="text" style="border:0px;" class="form-control editable-field description_goods" id="description_goods_result"  placeholder="" value="Grand Total"></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control  editable-field qty_kg_total"  id="qty_kg_result"   placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field amount_rs_total"  id="amount_rs_result"   ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field rate_kg_total"  id="rate_kg_result"  ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field claimed_bags_total"  id="claimed_bags_result" placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field dmg_qty_total"  id="dmg_qty_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_percent_total"  id="loss_percent_result"   ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_assd_total"  id="loss_assd_result"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none;"><input type="text" style="border:0px;" class="form-control editable-field loss_amount_grand_total"  id="loss_amount_grand_total" name="loss_amount_total"  placeholder="0.00" ></td>
                    <td style="padding:0px;border-top:none; width:218px"><input style="border:0px;" type="text" class="form-control editable-field remarks"  placeholder="" ></td>
                </tr>`;
            $('#data-body-new ').html(newRowHtml);
        }




        /* ------------------------------------------------------------------------- *
         * DYNAMICALLY ADDING LOSS ASSESSMENT ROWS(KAJAL)
         * ------------------------------------------------------------------------- */

        var rowCount = 1;
        // Function to add new assessment rows

        $('.add_new_table_body').on('click', function() {
            addNewRow();
        });


        function addNewRow() {
            rowCount++; // Increment row count for unique IDs
            var newRowHtml = `    
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
                <td><button type="button" style="width: 100%; height: 40px;" onclick="removeAssessment(this)" class="btn btn-rounded btn-warning editable-field remove-btn"><i class="fa fa-times"></i></button></td>
            </tr>
            `;

            $('#assessment-body').append(newRowHtml); // Append new row after the existing form
            updateTotal();
            bindInputEvents();
            $('.add_more_btn').show();

        }


        /* ------------------------------------------------------------------------- *
         * RESET ALL THE VALUES AFTER CLOSE THE MODAL BOdy
         * ------------------------------------------------------------------------- */
        // $('#assessmentModal').on('hidden.bs.modal', function() {
        //     // Reset form elements
        //     $('.add_less').val('');
        //     $('.fixed_percentage').val('');
        //     $('.editable-field').val('');
        //     $('.editable-field[type=checkbox]').prop('checked', false);
        // });


        $(document).ready(function() {
            $('#mobile').on('input', function() {
                var mobileNumber = $(this).val();
                checkMobileExists(mobileNumber); // Call the function with the entered mobile number
            });

            bindInputEvents();
            var invoices = <?php echo json_encode(isset($essentialdata->invoices) ? $essentialdata->invoices : 'NA'); ?>;
            var jobinvoices = <?php echo json_encode(isset($jobdata->invoices) ? $jobdata->invoices : 'NA'); ?>;
            var grs = <?php echo json_encode(isset($essentialdata->gr) ? $essentialdata->gr : 'NA'); ?>;

            // Determine the data source and disableFields flag
            var invoiceData = null;
            var disableFields = false;

            if (invoices !== 'NA' && invoices !== null) {
                // If invoices from essentialdata exist, use them and disable fields
                invoiceData = invoices;
                disableFields = true; // Disable fields for essentialdata
            } else if (jobinvoices !== 'NA' && jobinvoices !== null) {
                // If essentialdata invoices are not available, use jobinvoices and enable fields
                invoiceData = jobinvoices;
                disableFields = false; // Enable fields for jobdata
            }

            // Populate the invoices if available
            if (invoiceData) {
                populateInvoices(invoiceData, disableFields);
            }

            // Populate GRs if they exist
            if (grs !== 'NA' && grs !== null) {
                populateGr(grs);
            }
        });

        /* ------------------------------------------------------------------------- *
         * VALIDATE CASE REFERENCE
         * ------------------------------------------------------------------------- */
        $.validator.addMethod("caseReferenceFormat", function(value, element) {
            // Define the regex pattern for validation
            const pattern = /^[A-Z]{2}\/[A-Z]{1}(\/{0,2})\/\d{2}\/\d{2}\/\d{3}$/;
            // Test the value against the pattern
            return this.optional(element) || pattern.test(value);
        }, "Please enter in the format: VP/I/24/05/115 or VP/M//24/12/007");



        /* ------------------------------------------------------------------------- *
         * CALCULATE LOSS ASSESMENT VALUES(KAJAL)
         * ------------------------------------------------------------------------- */
        function addValues() {
            let total = 0;
            let num1 = parseFloat($('#qty_kg_first').val().trim());
            if (!isNaN(num1)) {
                total += num1;
            }
            $('.qty_kg_second').each(function() {
                let value = $(this).val().trim(); // Get the trimmed value
                value = parseFloat(value); // Parse the value as float
                if (!isNaN(value)) {
                    total += value; // Accumulate the total
                }
            });
            $('#qty_kg_result').val(total); // Assuming 'qty_kg_result' is an input field
        }


        /* ------------------------------------------------------------------------- *
         * VALIDATION FOR NUMBERS(KAJAL)
         * ------------------------------------------------------------------------- */

        // Function to initialize input restrictions
        function initializeInputRestrictions() {
            $('.only_numbers').on('input', function() {
                var inputValue = $(this).val();
                // Remove non-numeric characters using regex
                var sanitizedValue = inputValue.replace(/\D/g, '');
                // Update the input field value
                $(this).val(sanitizedValue);
            });
        }

        // Initialize input restrictions on document ready
        // initializeInputRestrictions();


        $('.open-modal').click(function() {
            var title = $(this).data('title');
            $('#imageModalLabel').text(title);
            $('#select_images').modal('show');
        });

        /* ------------------------------------------------------------------------- *
         * VALIDATE AND SUBMIT ESSENTIAL FORM
         * ------------------------------------------------------------------------- */
        $('.venorbtn').each(function() {
            // Apply .5 opacity to disabled buttons
            if ($(this).attr('disabled') || $(this).hasClass('disabled')) {
                $(this).css('opacity', '0.5');
                $(this).addClass('disabled'); // Add a class for styling purposes
            }
        });

        $('.venorbtn').click(function(event) {
            // Check if the button has the .disabled class
            if ($(this).hasClass('disabled')) {
                // Prevent the default action and stop propagation
                event.preventDefault();
                event.stopPropagation();
            }
        });

        /* ------------------------------------------------------------------------- *
         * MISCELLANEOUS  FORMS
         * ------------------------------------------------------------------------- */
        $("#essential_submit").click(function() {
            var editButtonText = $(this).val();

            // $(".editable-field").prop("disabled", false);
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#essentialForm').trigger('submit');
                $("#toggleManualEntry").prop("disabled", true);
                $(".disabledbtn").addClass('disabled-btn');
            } else if (editButtonText === "Edit") {
                $(".editable-field").prop("disabled", false);
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $("#toggleManualEntry").prop("disabled", false);
                $(".disabledbtn").removeClass('disabled-btn');
            } else if (editButtonText === "Update") {
                $("#generate_ila").css('display', 'block');
                $('#essentialForm').trigger('submit');
                // $(".editable-field").prop("disabled", true);
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                ("#toggleManualEntry").prop("disabled", true);
                $(".disabledbtn").addClass('disabled-btn');
                // $(this).val("Edit");
            }
        });

        if ($("#essential_submit").val() === "Edit") {
            $(".essential-field").prop("disabled", true);
            $("#toggleManualEntry").prop("disabled", true);
            $(".disabledbtn").addClass('disabled-btn');
        }

        $("#essentialForm").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                date_of_report: {
                    required: true
                },
                policy_by: {
                    required: true
                },
                policy_branch: {
                    required: true
                },
                policy_user: {
                    required: true
                },
                policy_mobile: {
                    required: true,

                },
                appoint_by: {
                    required: true
                },
                appointment_branch_name: {
                    required: true
                },
                appointment_user_name: {
                    required: true
                },
                appointment_mobile_num: {
                    required: true,

                },
                payment_by: {
                    required: true
                },
                payment_branch_name: {
                    required: true
                },
                payment_user_name: {
                    required: true
                },
                payment_mobile_num: {
                    required: true,

                },
                case_reference: {
                    required: true,
                    // caseReferenceFormat: true
                },
                insurer: {
                    required: true
                },
                nameofowner: {
                    required: true
                },
                district: {
                    required: true
                },
                state: {
                    required: true
                },
                periodOfCoverage: {
                    required: true
                },
                dateOfDisease: {
                    required: true
                },
                ContactNumber: {
                    required: true,
                    digits: true
                },
                tagNumber: {
                    required: true
                },
                typeOfAnimal: {
                    required: true
                },
                dateOfDeath: {
                    required: true
                },
                timeOfDeath: {
                    required: true
                },
                dateOfSurvey: {
                    required: true
                },
                timeOfSurvey: {
                    required: true
                },
                deathOrDisablement: {
                    required: true
                },
                SurveyConducted: {
                    required: true
                },
                tag_tempered: {
                    required: true
                },
                cattle_buried: {
                    required: true
                },
                whysurveyNotConducted: {
                    required: {
                        depends: function(element) {
                            $('#SurveyConducted').prop('disabled', false);
                            var value = $('#SurveyConducted').val();
                            $('#SurveyConducted').prop('disabled', true);
                            return value === "No";
                        }
                    }
                }
            },
            messages: {
                // Custom messages for validation
                policy_by: {
                    required: "This field is required"
                },
                policy_branch: {
                    required: "This field is required"
                },
                policy_user: {
                    required: "This field is required"
                },
                policy_mobile: {
                    required: "This field is required",

                },
                appoint_by: {
                    required: "This field is required"
                },
                appointment_branch_name: {
                    required: "This field is required"
                },
                appointment_user_name: {
                    required: "This field is required"
                },
                appointment_mobile_num: {
                    required: "This field is required",

                },
                payment_by: {
                    required: "This field is required"
                },
                payment_branch_name: {
                    required: "This field is required"
                },
                payment_user_name: {
                    required: "This field is required"
                },
                payment_mobile_num: {
                    required: "This field is required",

                },
                case_reference: {
                    required: "This field is required",
                    // caseReferenceFormat: "Invalid format! Please enter in the format: VP/I/24/05/115"
                },
                insurer: "Please select Insurance Company.",
                nameofowner: "Please enter the name of the owner.",
                district: "Please enter District.",
                state: "Please enter state.",
                periodOfCoverage: "Please enter Period of Coverage.",
                dateOfDisease: "Please enter date of disease.",
                ContactNumber: {
                    required: "Please enter contact number.",
                    digits: "Please enter a valid contact number."
                },
                tagNumber: "Please enter the tag number.",
                typeOfAnimal: "Please select an animal.",
                dateOfDeath: "Please select date of death.",
                timeOfDeath: "Please select time of death.",
                dateOfSurvey: "Please select survey date.",
                timeOfSurvey: "Please select survey time.",
                deathOrDisablement: "Please select an option.",
                SurveyConducted: "Please select an option.",
                tag_tempered: "Please select an option.",
                cattle_buried: "Please select an option.",
                whysurveyNotConducted: {
                    required: "Please explain why the survey was not conducted."
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    element.closest(".input-group").after(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault(); // Prevent default form submission

                // Validate the form again before proceeding
                if (!$("#essentialForm").valid()) {
                    return false; // Stop form submission if validation fails
                }

                var aid = "<?php echo $aid; ?>";
                var companyid = "<?php echo $defaultcompany; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                $('#days_between_policy_and_disease').prop('disabled', false);
                $('#SurveyConducted').prop('disabled', false);
                var days_between = $('#days_between_policy_and_disease').val();
                var survey_conducted = $('#SurveyConducted').val();
                var formData = $(form).serialize();


                // Add extra fields to formData
                if (survey_conducted === "Yes") {
                    $('#whysurveyNotConducted').val('');
                } else {
                    var survey_conducted_late = $('#whysurveyNotConducted').val();
                    formData += '&whysurveyNotConducted=' + encodeURIComponent(survey_conducted_late);
                }
                formData += '&aid=' + encodeURIComponent(aid);
                formData += '&days_between_policy_and_disease=' + encodeURIComponent(days_between);
                formData += '&SurveyConducted=' + encodeURIComponent(survey_conducted);
                formData += '&natureofjob=' + encodeURIComponent(natureofjob);
                $('#days_between_policy_and_disease').prop('disabled', true);
                $('#SurveyConducted').prop('disabled', true);
                $.ajax({
                    url: '<?php echo site_url('cattleessentialdata'); ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {

                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }

                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }

                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".editable-field").prop("disabled", true);
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#essential_submit').val("Edit");
                            $("#generate_ila").show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }
        });




        $("#marine_predis_essential_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#marine_predis_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").addClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", true);
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").removeClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", false);
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#marine_predis_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").addClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", true);
            }
        });

        if ($("#marine_predis_essential_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".editable-field").prop("disabled", true);
            $("#toggleManualEntry").prop("disabled", true);
        }

        $("#marine_predis_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    element.closest(".input-group").after(error);
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                // Existing fields
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },

                insured_name: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_inspection: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                subject_matter: {
                    required: true
                }

            },
            messages: {
                // Existing field messages
                case_reference: "This field is required",
                policytype: "This field is required",
                policyNumber: "This field is required",
                sum_insured: "This field is required",
                insured_name: "This field is required",
                claimant_name: "This field is required",
                cause_inspection: "This field is required",
                cause_loss: "This field is required",
                subject_matter: "This field is required"

            },

            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);
                $('.form-group', '#invoiceContainer').each(function(index, element) {
                    var invoicenumber = $(element).find('[name="invoicenumber[]"]').val();
                    var invoicedate = $(element).find('[name="invoicedate[]"]').val();
                    var invoicevalue = $(element).find('[name="invoicevalue[]"]').val();
                    formdata.append('invoices[' + index + '][invoicenumber]', invoicenumber);
                    formdata.append('invoices[' + index + '][invoicedate]', invoicedate);
                    formdata.append('invoices[' + index + '][invoicevalue]', invoicevalue);
                });

                var assignmentType = $(".assignmentType").val(); // or use the JS variable directly

                // Decide the URL
                var ajaxUrl = '';
                if (assignmentType === 'outgoing') {
                    ajaxUrl = '<?php echo base_url("marinepredispatchessential_outgoing"); ?>';
                } else {
                    ajaxUrl = '<?php echo base_url("marinepredispatchessential"); ?>';
                }

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#marine_predis_essential_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });




        /* ------------------------------------------------------------------------- *  
         * MOTOR SPOT CASE DATA  (KAJAL)
         * ------------------------------------------------------------------------- */
        $("#motor_spot_case_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Submit") {
                $('#motor_spot_casedata').trigger('submit');
                $("#toggleManualEntry").prop("disabled", true);
                $(".disabledbtn").addClass('disabled-btn');
            } else if (editButtonText === "Edit") {
                $(".case-field").prop("disabled", false);
                $(this).val("Update");
                $("#toggleManualEntry").prop("disabled", false);
                $(".disabledbtn").removeClass('disabled-btn');
            } else if (editButtonText === "Update") {
                $('#motor_spot_casedata').trigger('submit');
                $("#toggleManualEntry").prop("disabled", true);
                $(".disabledbtn").addClass('disabled-btn');
            }
        });

        if ($("#motor_spot_case_submit").val() === "Edit") {
            $(".case-field").prop("disabled", true);
            $("#toggleManualEntry").prop("disabled", true);
            $(".disabledbtn").addClass('disabled-btn');
        }

        $("#motor_spot_casedata").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                insured_address: {
                    required: true
                },
                appoint_by: {
                    required: true
                },
                loan_challan: {
                    required: true
                },
                gst_no: {
                    required: true
                },
                registered_owner: {
                    required: true
                },
                financers: {
                    required: true
                },
                registration_date: {
                    required: true
                },
                chasis_no: {
                    required: true
                },
                engine_no: {
                    required: true
                },
                physically_verified: {
                    required: true
                },
                body_type: {
                    required: true
                },
                tax_paid: {
                    required: true
                },
                vehicle_class: {
                    required: true
                },
                ulw: {
                    required: true
                },
                rlw: {
                    required: true
                },
                carrying_capacity: {
                    required: true
                },
                pre_acccident: {
                    required: true
                },
                fitness_certificate_no: {
                    required: true
                },
                fitness: {
                    required: true
                },
                fitness_date: {
                    required: true
                },
                date_of_birth: {
                    required: true
                },
                valid_up_to: {
                    required: true
                },
                permit_no: {
                    required: true
                },
                permit_validity: {
                    required: true
                },
                permit_type: {
                    required: true
                },
                area_of_operation: {
                    required: true
                },
                whether_valid: {
                    required: true
                },
                goods_tax: {
                    required: true
                },
                rc: {
                    required: true
                },
                docs_validity: {
                    required: true
                },
                issuing_authority: {
                    required: true
                },
                license_type: {
                    required: true
                },
                type_of_vehicle_allowed: {
                    required: true
                },
                verified_driving_license: {
                    required: true
                },
                repair_address: {
                    required: true
                },
                attending_survey: {
                    required: true
                },
                has_accidenty: {
                    required: true
                },
                if_yes: {
                    required: true
                },
                spot_survey: {
                    required: true
                },
                third_party_particulars: {
                    required: true
                },
                cause_nature_accident: {
                    required: true
                },
                particulars_loss_damage: {
                    required: true
                },
                cause_of_accident: {
                    required: true
                }
            },
            messages: {
                cause_nature_accident: "This field is required",
                particulars_loss_damage: "This field is required",
                loan_challan: "This field is required",
                appoint_by: "This field is required",
                cause_of_accident: "This field is required",
                insured_address: "Please enter the address of the insured.",
                gst_no: "Please enter the GST/No. of Insured.",
                registered_owner: "Please enter the registered owner.",
                financers: "Please enter the financers (if any).",
                registration_date: "Please enter the date of registration.",
                chasis_no: "Please enter the chasis number.",
                engine_no: "Please enter the engine number.",
                physically_verified: "Please enter whether the vehicle is physically verified.",
                body_type: "Please enter the type of body.",
                tax_paid: "Please enter the tax paid up to.",
                vehicle_class: "Please enter the class of vehicle.",
                ulw: "Please enter the ULW.",
                rlw: "Please enter the RLW.",
                carrying_capacity: "Please enter the carrying capacity.",
                pre_acccident: "Please enter the pre-accident condition.",
                fitness: "This field is required",
                fitness_certificate_no: "Please enter the fitness certificate number.",
                fitness_date: "This field is required",
                date_of_birth: "This field is required",
                valid_up_to: "Please enter the validity date.",
                permit_no: "Please enter the permit number.",
                permit_validity: "Please enter the permit validity.",
                permit_type: "Please enter the type of permit.",
                area_of_operation: "Please enter the route/area of operation.",
                whether_valid: "Please enter whether valid for the state where the accident took place.",
                goods_tax: "Please enter the goods/passenger tax.",
                rc: "Please enter the RC.",
                docs_validity: "Please enter the validity date of the documents.",
                issuing_authority: "Please enter the issuing authority.",
                license_type: "Please enter the type of license.",
                type_of_vehicle_allowed: "Please enter the type of vehicle allowed to drive.",
                verified_driving_license: "Please enter whether the driving license is verified.",
                repair_address: "Please enter the repairer's address.",
                attending_survey: "Please enter the insured's representative attending the survey.",
                has_accidenty: "Please enter whether the accident has been reported to the police.",
                if_yes: "Please enter the FIR/DD number if applicable.",
                spot_survey: "Please enter the spot survey details.",
                third_party_particulars: "Please enter the third party particulars."
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                // Extract selected option texts
                var goodsTaxText = $('#goods_tax option:selected').text();
                var rcText = $('#rc option:selected').text();
                var fitnessText = $('#fitness option:selected').text();
                var permitText = $('#permit option:selected').text();
                var vehicleclassText = $('#vehicle_class option:selected').text();

                // Serialize form data
                var formData = $(form).serialize();
                var aid = "<?php echo htmlspecialchars($aid, ENT_QUOTES, 'UTF-8'); ?>";

                // Append additional fields to formData
                formData += '&aid=' + encodeURIComponent(aid);
                formData += '&vehicle_classText=' + encodeURIComponent(vehicleclassText);
                formData += '&goods_taxText=' + encodeURIComponent(goodsTaxText);
                formData += '&rcText=' + encodeURIComponent(rcText);
                formData += '&fitnessText=' + encodeURIComponent(fitnessText);
                formData += '&permitText=' + encodeURIComponent(permitText);
                var assignmentType = $(".assignmentType").val(); // or use the JS variable directly

                // Decide the URL
                var ajaxUrl = '';
                if (assignmentType === 'outgoing') {
                    ajaxUrl = '<?php echo base_url("updatemotorspotcaseData_outgoing"); ?>';
                } else {
                    ajaxUrl = '<?php echo base_url("updatemotorspotcaseData"); ?>';
                }

                // AJAX request to update case data
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            $('#motor_spot_case_submit').val("Edit");
                            $(".case-field").prop("disabled", true);
                            scrollToNextForm("#motor_spot_casedata");
                        } else {
                            console.error('Unexpected response status:', response.status);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request failed:', status, error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            }
        });




        /* ------------------------------------------------------------------------- *  
         * MOTOR FORM
         * ------------------------------------------------------------------------- */
        $("#motor_theft_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#motor_theft_essential_form').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").addClass('disabled-btn');
            } else if (editButtonText === "Edit") {
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").removeClass('disabled-btn');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#motor_theft_essential_form').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").addClass('disabled-btn');
            }

        });

        $("#motor_theft_essential_form").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                policy_by: {
                    required: true
                },
                policy_branch: {
                    required: true
                },
                policy_user: {
                    required: true
                },
                policy_mobile: {
                    required: true,

                },
                appoint_by: {
                    required: true
                },
                appointment_branch_name: {
                    required: true
                },
                appointment_user_name: {
                    required: true
                },
                appointment_mobile_num: {
                    required: true,

                },
                payment_by: {
                    required: true
                },
                payment_branch_name: {
                    required: true
                },
                payment_user_name: {
                    required: true
                },
                payment_mobile_num: {
                    required: true,

                },
                case_reference: {
                    required: true
                },
                date_of_report: {
                    required: true
                },
                insurer: {
                    required: true
                },
                vehicle_no: {
                    required: true
                },
                account: {
                    required: true
                },
                policy_number: {
                    required: true
                },
                period_of_insurance: {
                    required: true
                },
                idv: {
                    required: true
                },
                register_no: {
                    required: true
                },
                registered_owner: {
                    required: true
                },
                time_of_incident: {
                    required: true
                },
                date_of_incident: {
                    required: true
                },
                brief_narration: {
                    required: true
                },
                fir_date: {
                    required: true
                },
                fir_no: {
                    required: true
                },
                police_station_name: {
                    required: true
                },
                appointment_date: {
                    required: true
                },

                vehicle_owner: {
                    required: true
                },
                name_of_insured: {
                    required: true
                },
                property_remarks: {
                    required: false // Optional field, adjust as needed
                },

            },
            messages: {
                policy_by: {
                    required: "This field is required"
                },
                policy_branch: {
                    required: "This field is required"
                },
                policy_user: {
                    required: "This field is required"
                },
                policy_mobile: {
                    required: "This field is required",

                },
                appoint_by: {
                    required: "This field is required"
                },
                appointment_branch_name: {
                    required: "This field is required"
                },
                appointment_user_name: {
                    required: "This field is required"
                },
                appointment_mobile_num: {
                    required: "This field is required",

                },
                payment_by: {
                    required: "This field is required"
                },
                payment_branch_name: {
                    required: "This field is required"
                },
                payment_user_name: {
                    required: "This field is required"
                },
                payment_mobile_num: {
                    required: "This field is required",

                },
                policy_by: {
                    required: "This field is required"
                },
                policy_branch: {
                    required: "This field is required"
                },
                policy_user: {
                    required: "This field is required"
                },
                policy_mobile: {
                    required: "This field is required",

                },
                appoint_by: {
                    required: "This field is required"
                },
                appointment_branch_name: {
                    required: "This field is required"
                },
                appointment_user_name: {
                    required: "This field is required"
                },
                appointment_mobile_num: {
                    required: "This field is required",

                },
                payment_by: {
                    required: "This field is required"
                },
                payment_branch_name: {
                    required: "This field is required"
                },
                payment_user_name: {
                    required: "This field is required"
                },
                payment_mobile_num: {
                    required: "This field is required",

                },
                case_reference: {
                    required: "Please enter the Case Reference."
                },
                date_of_report: {
                    required: "Please select the Date of Report."
                },
                insurer: {
                    required: "Please select Insurance Company."
                },
                vehicle_no: {
                    required: "Please enter the Vehicle No."
                },
                account: {
                    required: "Please enter the Account."
                },
                policy_number: {
                    required: "Please enter the Policy Number."
                },
                period_of_insurance: {
                    required: "Please enter the Period of Insurance."
                },
                idv: {
                    required: "Please enter the IDV."
                },
                register_no: {
                    required: "Please enter the Register No."
                },
                registered_owner: {
                    required: "Please enter the Registered Owner."
                },
                time_of_incident: {
                    required: "Please enter the Date & Time of Incident."
                },
                date_of_incident: {
                    required: "Please enter the Date & Time of Incident."
                },
                brief_narration: {
                    required: "Please enter the Brief narration of Incident."
                },
                fir_date: {
                    required: "Please select FIR date."
                },
                fir_no: {
                    required: "Please select FIR no."
                },
                police_station_name: {
                    required: "Please enter the Name of Police Station."
                },
                appointment_date: {
                    required: "Please enter the Date of Appointment."
                },
                vehicle_owner: {
                    required: "Please enter the Name of vehicle owner."
                },
                name_of_insured: {
                    required: "Please enter the Name of insured."
                },
                property_remarks: {
                    required: "Please enter Remarks."
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);
                $.ajax({
                    url: '<?php echo base_url('motortheftsessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {

                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }

                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }

                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#motor_theft_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                            // scrollToNextForm("#caseForm");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });

        if ($("#motor_theft_submit").val() === "Edit") {
            $(".editable-field").prop("disabled", true);
            $(".disabledbtn").addClass('disabled-btn');
            $("#toggleManualEntry").prop("disabled", true);
        }



        /* ------------------------------------------------------------------------- *  
         * MOTOR THEFT FINAL FORM (KAJAL)
         * ------------------------------------------------------------------------- */

        $("#motor_theft_case_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Submit") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", true);
                $('#motor_theft_case_form').trigger('submit');
            } else if (editButtonText === "Edit") {
                $(".case-field").prop("disabled", false);
                $(".disabledbtn").removeClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", false);
                $(this).val("Update");
            } else if (editButtonText === "Update") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", true);
                $('#motor_theft_case_form').trigger('submit');
            }
        });

        if ($("#motor_theft_case_submit").val() === "Edit") {
            $(".case-field").prop("disabled", true);
            $(".disabledbtn").addClass('disabled-btn');
            $("#toggleManualEntry").prop("disabled", true);
        }

        $("#motor_theft_case_form").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                insured_name: {
                    required: true,
                },
                claim_number: {
                    required: true
                },
                endorsement_details: {
                    required: true,
                },
                break_in_insurance: {
                    required: true
                },
                pre_inspection_details: {
                    required: true,
                },
                chasis_number: {
                    required: true
                },
                engine_number: {
                    required: true,
                },
                make_modal: {
                    required: true
                },

                year_of_manufacture: {
                    required: true,
                },
                colour: {
                    required: true
                },
                seatig_capacity: {
                    required: true,
                },
                tax_paid_up_to: {
                    required: true
                },
                date_of_loss: {
                    required: true,
                },
                validity: {
                    required: true
                },
                fitness_date: {
                    required: true,
                },
                details_of_ownership: {
                    required: true
                },

                rc_issuing_authority: {
                    required: true,
                },
                permit_number: {
                    required: true
                },
                permit_date_of_issue: {
                    required: true,
                },
                permit_period_of_validity: {
                    required: true
                },
                permit_type: {
                    required: true,
                },
                permit_area: {
                    required: true
                },
                permit_whether: {
                    required: true,
                },
                whether_the_vehicle: {
                    required: true
                },
                permit_authorization_number: {
                    required: true,
                },
                permit_authorization_date_of_issue: {
                    required: true
                },
                permit_authorization_period_of_validity: {
                    required: true,
                },
                permit_authorization_area: {
                    required: true
                },
                engine_and_chasis_number: {
                    required: true,
                },
                Whether_theft_details: {
                    required: true
                },
                last_vehicle_user: {
                    required: true,
                },
                relationship_with_insured: {
                    required: true
                },
                occupation: {
                    required: true,
                },
                address: {
                    required: true
                },
                financing_type: {
                    required: true,
                },
                type_of_loan_advanced: {
                    required: true
                },
                details_of_Loan_repayment: {
                    required: true,
                },
                outstanding_amount: {
                    required: true
                },
                vehicle_was_seized: {
                    required: true,
                },
                original_key: {
                    required: true
                },
                noc_status: {
                    required: true,
                },
                any_irregulaity_noticed: {
                    required: true
                },
                driving_license_details: {
                    required: true,
                },
                date_of_issue: {
                    required: true
                },
                valid_up_to: {
                    required: true,
                },
                type_of_vehicle: {
                    required: true
                },
                issue_authority: {
                    required: true,
                },
                verification_status: {
                    required: true
                },

                last_user_mentioned: {
                    required: true,
                },
                details_of_location: {
                    required: true
                },
                date_intimation: {
                    required: true,
                },
                time_intimation: {
                    required: true
                },
                by_the_complainant: {
                    required: true,
                },
                time_by_the_complainant: {
                    required: true
                },
                narration_of_incident: {
                    required: true,
                },
                police_station: {
                    required: true
                },
                verification_from_insured: {
                    required: true,
                },
                Verification_at_spot: {
                    required: true
                },
                loaded_commercial_vehicles: {
                    required: true,
                },
                locking_system: {
                    required: true
                },
                possession_of_keys: {
                    required: true,
                },
                no_of_keys: {
                    required: true
                },
                submitted_by_the_insured_to_insurer: {
                    required: true,
                },
                collected_from_insurer: {
                    required: true
                },
                irregularity_noted: {
                    required: true,
                },
                ipc_section: {
                    required: true
                },
                investigation_officer: {
                    required: true,
                },
                fir_lodged: {
                    required: true
                },
                property_involved: {
                    required: true,
                },
                police_final_report: {
                    required: true
                },
                vis_a_vis: {
                    required: true,
                },
                whether_fr_accepted: {
                    required: true
                },
                comments_on_any_irregularity: {
                    required: true,
                },
                pcr_100_report_details: {
                    required: true
                },
                gd_entry_details: {
                    required: true,
                },
                details_of_wireless: {
                    required: true
                },
                other_details: {
                    required: true,
                },
                intimated_ncrb: {
                    required: true
                },
                details_with_proof_of_intimation: {
                    required: true,
                },
                status_of_vehicle: {
                    required: true
                },
                intimated_to_rto: {
                    required: true,
                },
                proof_of_existence: {
                    required: true
                },
                date_of_theft: {
                    required: true,
                },
                fir_date: {
                    required: true
                },
                intimation_date: {
                    required: true,
                },
                comments: {
                    required: true
                },
                violation_aspects: {
                    required: true,
                },
                references: {
                    required: true
                },
                case_summary: {
                    required: true,
                },
                conclusion: {
                    required: true
                },
                annexures: {
                    required: true,
                }
            },
            messages: {
                insured_name: {
                    required: "Please enter the name of the insured."
                },
                claim_number: {
                    required: "Claim number is mandatory."
                },
                endorsement_details: {
                    required: "Endorsement details are required."
                },
                break_in_insurance: {
                    required: "Please provide details about any break in insurance."
                },
                pre_inspection_details: {
                    required: "Pre-inspection details are necessary."
                },
                chasis_number: {
                    required: "Chassis number is required."
                },
                engine_number: {
                    required: "Engine number must be provided."
                },
                make_modal: {
                    required: "Please specify the make and model of the vehicle."
                },
                year_of_manufacture: {
                    required: "Year of manufacture is required."
                },
                colour: {
                    required: "Vehicle colour is needed."
                },
                seatig_capacity: {
                    required: "Seating capacity must be stated."
                },
                tax_paid_up_to: {
                    required: "Tax paid up to date is required."
                },
                date_of_loss: {
                    required: "Date of loss is mandatory."
                },
                validity: {
                    required: "Please provide the validity period."
                },
                fitness_date: {
                    required: "Fitness date is required."
                },
                details_of_ownership: {
                    required: "Details of ownership must be provided."
                },
                rc_issuing_authority: {
                    required: "RC issuing authority is necessary."
                },
                permit_number: {
                    required: "Permit number is required."
                },
                permit_date_of_issue: {
                    required: "Permit date of issue is required."
                },
                permit_period_of_validity: {
                    required: "Permit period of validity must be provided."
                },
                permit_type: {
                    required: "Type of permit is required."
                },
                permit_area: {
                    required: "Permit area must be specified."
                },
                permit_whether: {
                    required: "Indicate whether permit is valid."
                },
                whether_the_vehicle: {
                    required: "Clarify whether the vehicle details are provided."
                },
                permit_authorization_number: {
                    required: "Permit authorization number is required."
                },
                permit_authorization_date_of_issue: {
                    required: "Permit authorization date of issue is necessary."
                },
                permit_authorization_period_of_validity: {
                    required: "Period of validity for permit authorization must be provided."
                },
                permit_authorization_area: {
                    required: "Permit authorization area is required."
                },
                engine_and_chasis_number: {
                    required: "Engine and chassis number must be provided."
                },
                Whether_theft_details: {
                    required: "Details regarding theft are required."
                },
                last_vehicle_user: {
                    required: "Last vehicle user must be mentioned."
                },
                relationship_with_insured: {
                    required: "Specify the relationship with the insured."
                },
                occupation: {
                    required: "Occupation of the insured is required."
                },
                address: {
                    required: "Address must be provided."
                },
                financing_type: {
                    required: "Type of financing is necessary."
                },
                type_of_loan_advanced: {
                    required: "Type of loan advanced must be specified."
                },
                details_of_Loan_repayment: {
                    required: "Provide details of loan repayment."
                },
                outstanding_amount: {
                    required: "Outstanding amount is required."
                },
                vehicle_was_seized: {
                    required: "Specify if the vehicle was seized."
                },
                original_key: {
                    required: "Status of the original key must be indicated."
                },
                noc_status: {
                    required: "NOC status is required."
                },
                any_irregulaity_noticed: {
                    required: "Any irregularities noticed must be reported."
                },
                driving_license_details: {
                    required: "Driving license details are necessary."
                },
                date_of_issue: {
                    required: "Date of issue for the driving license is required."
                },
                valid_up_to: {
                    required: "Validity period of the driving license must be provided."
                },
                type_of_vehicle: {
                    required: "Type of vehicle must be stated."
                },
                issue_authority: {
                    required: "Authority that issued the license is required."
                },
                verification_status: {
                    required: "Verification status is needed."
                },
                last_user_mentioned: {
                    required: "Last user mentioned must be provided."
                },
                details_of_location: {
                    required: "Details of the location are required."
                },
                date_intimation: {
                    required: "Date of intimation must be specified."
                },
                time_intimation: {
                    required: "Time of intimation is necessary."
                },
                by_the_complainant: {
                    required: "Provide details of the complainant."
                },
                time_by_the_complainant: {
                    required: "Time provided by the complainant is required."
                },
                narration_of_incident: {
                    required: "Narration of the incident is required."
                },
                police_station: {
                    required: "Police station details are needed."
                },
                verification_from_insured: {
                    required: "Verification from the insured is required."
                },
                Verification_at_spot: {
                    required: "Verification at the spot is necessary."
                },
                loaded_commercial_vehicles: {
                    required: "Details about loaded commercial vehicles must be provided."
                },
                locking_system: {
                    required: "Locking system details are required."
                },
                possession_of_keys: {
                    required: "Indicate whether keys are in possession."
                },
                no_of_keys: {
                    required: "Number of keys must be specified."
                },
                submitted_by_the_insured_to_insurer: {
                    required: "Details of what was submitted by the insured to the insurer are needed."
                },
                collected_from_insurer: {
                    required: "Details of what was collected from the insurer are required."
                },
                irregularity_noted: {
                    required: "Any irregularity noted must be reported."
                },
                ipc_section: {
                    required: "IPC section details are required."
                },
                investigation_officer: {
                    required: "Investigation officer details must be provided."
                },
                fir_lodged: {
                    required: "FIR lodging status is necessary."
                },
                property_involved: {
                    required: "Details of property involved are required."
                },
                police_final_report: {
                    required: "Police final report is necessary."
                },
                vis_a_vis: {
                    required: "Details about 'vis-a-vis' must be provided."
                },
                whether_fr_accepted: {
                    required: "Indicate whether FR (Final Report) is accepted."
                },
                comments_on_any_irregularity: {
                    required: "Comments on any irregularity must be provided."
                },
                pcr_100_report_details: {
                    required: "PCR 100 report details are required."
                },
                gd_entry_details: {
                    required: "GD entry details must be specified."
                },
                details_of_wireless: {
                    required: "Details of wireless communications are necessary."
                },
                other_details: {
                    required: "Any other relevant details must be included."
                },
                intimated_ncrb: {
                    required: "Intimation to NCRB is required."
                },
                details_with_proof_of_intimation: {
                    required: "Details with proof of intimation are required."
                },
                status_of_vehicle: {
                    required: "Vehicle status must be provided."
                },
                intimated_to_rto: {
                    required: "Intimation to RTO is required."
                },
                proof_of_existence: {
                    required: "Proof of existence must be provided."
                },
                date_of_theft: {
                    required: "Date of theft is required."
                },
                fir_date: {
                    required: "FIR date must be specified."
                },
                intimation_date: {
                    required: "Intimation date is necessary."
                },
                comments: {
                    required: "Comments are required."
                },
                violation_aspects: {
                    required: "Violation aspects must be detailed."
                },
                references: {
                    required: "References are required."
                },
                case_summary: {
                    required: "Case summary must be provided."
                },
                conclusion: {
                    required: "Conclusion is required."
                },
                annexures: {
                    required: "Annexures must be included."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault(); // Prevent default button action
                // Serialize form data
                var formData = $(form).serialize();
                var aid = "<?php echo $aid; ?>";
                formData += '&aid=' + encodeURIComponent(aid);

                // AJAX request to updatecasedata endpoint
                $.ajax({
                    url: "<?php echo base_url('updatemotortheftcasedata') ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            $('#motor_theft_case_submit').val("Edit");
                            $(".case-field").prop("disabled", true);
                            scrollToNextForm("#motor_theft_case_form"); // Assuming scrollToNextForm is defined elsewhere
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error as needed
                    }
                });
            }
        });

        if ($("#motor_theft_case_submit").val() === "Edit") {
            $(".case-field").prop("disabled", true);
            $(".disabledbtn").addClass('disabled-btn');
            $("#toggleManualEntry").prop("disabled", true);
        }

        $("#fire_investigation_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#fire_investigation_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#fire_investigation_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#fire_investigation_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                // Existing fields
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },

                insured_name: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_inspection: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                subject_matter: {
                    required: true
                }

            },
            messages: {
                // Existing field messages
                case_reference: "This field is required",

                policytype: "This field is required",
                policyNumber: "This field is required",
                sum_insured: "This field is required",
                insured_name: "This field is required",
                claimant_name: "This field is required",
                cause_inspection: "This field is required",
                cause_loss: "This field is required",
                subject_matter: "This field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                $.ajax({
                    url: '<?php echo base_url('marinepredispatchessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#fire_investigation_essential').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });



        /* ------------------------------------------------------------------------- *  
         * MARINE PRE DISPATCH CASE DATA  (KAJAL)
         * ------------------------------------------------------------------------- */


        $("#marine_predispatch_casedata_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Submit") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", true);
                $('#marine_predispatch_casedata').trigger('submit');
            } else if (editButtonText === "Edit") {
                $(".case-field").prop("disabled", false);
                $(".disabledbtn").removeClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", false);
                $(this).val("Update");
            } else if (editButtonText === "Update") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#toggleManualEntry").prop("disabled", true);
                $('#marine_predispatch_casedata').trigger('submit');
            }
        });

        if ($("#marine_predispatch_casedata_submit").val() === "Edit") {
            $(".case-field").prop("disabled", true);
            $(".disabledbtn").addClass('disabled-btn');
            $("#toggleManualEntry").prop("disabled", true);
        } else {
            $(".disabledbtn").removeClass('disabled-btn');
        }


        // jQuery Validation
        $("#marine_predispatch_casedata").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            rules: {
                bol_no: {
                    required: true
                },
                bol_date: {
                    required: true
                },
                be_no: {
                    required: true
                },
                be_date: {
                    required: true
                },
                consignment: {
                    required: true
                },
                gross_weight: {
                    required: true
                },
                marks_number: {
                    required: true
                },
                packing: {
                    required: true
                },
                cargo_type: {
                    required: true
                }

            },
            messages: {
                bol_no: "BOL Number is required.",
                bol_date: "BOL Date is required.",
                be_no: "BE Number is required.",
                be_date: "BE Date is required.",
                consignment: "Consignment field is required.",
                gross_weight: "Gross Weight / No. of Package is required.",
                marks_number: "Marks and Number is required.",
                packing: "Packing field is required."

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    error.insertAfter(element.closest(".input-group"));
                } else if (element.attr("name") === "cargo_type") {
                    error.insertAfter(".d-flex.align-items-center.justify-content-between"); // adjust selector if needed
                } else {
                    error.insertAfter(element);
                }
            },


            invalidHandler: function(event, validator) {
                if (!$("input[name='cargo_type']:checked").length) {
                    $("input[name='cargo_type']").css("outline", "1px solid red");
                }
            },

            submitHandler: function(form, event) {
                event.preventDefault();

                // Remove red outline if checkboxes are selected
                $("input[name='import'], input[name='export']").css("outline", "");

                var formData = new FormData(form);
                var aid = "<?php echo $aid; ?>";
                formData.append('aid', aid);

                $.ajax({
                    url: "<?php echo base_url('updatepredispatchcasedata') ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 200) {
                            $('#marine_predispatch_casedata_submit').val("Edit");
                            $(".case-field").prop("disabled", true);
                            $("input[name='cargo_type']").css("outline", "");

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to update case data. Please try again.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request failed:', status, error);
                        console.error('Response:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error!',
                            text: 'Something went wrong. Please check the console for details.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });

        $("input[name='cargo_type']").on('change', function() {
            if ($("input[name='cargo_type']:checked").length) {
                $("input[name='cargo_type']").css("outline", "");
            }
        });

        $('input[name="bol_no"]').on('input', function() {
            let value = $(this).val().toUpperCase();
            $(this).val(value);
            $('input[name="entry_number"]').val(value);
        });

        $('input[name="entry_number"]').on('input', function() {
            let value = $(this).val().toUpperCase();
            $(this).val(value);
            $('input[name="bol_no"]').val(value);
        });

        $('input[name="be_no"]').on('input', function() {
            let value = $(this).val().toUpperCase();
            $(this).val(value);
            $('input[name="hawb_no"]').val(value);
        });

        $('input[name="hawb_no"]').on('input', function() {
            let value = $(this).val().toUpperCase();
            $(this).val(value);
            $('input[name="be_no"]').val(value);
        });



        $("#project_preins_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#project_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#project_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#project_preins_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {

                policy_by: {
                    required: true
                },
                policy_branch: {
                    required: true
                },
                policy_user: {
                    required: true
                },
                policy_mobile: {
                    required: true,

                },
                appoint_by: {
                    required: true
                },
                appointment_branch_name: {
                    required: true
                },
                appointment_user_name: {
                    required: true
                },
                appointment_mobile_num: {
                    required: true,

                },
                payment_by: {
                    required: true
                },
                payment_branch_name: {
                    required: true
                },
                payment_user_name: {
                    required: true
                },
                payment_mobile_num: {
                    required: true,

                },
                // Existing fields
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },


                insured_name: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_inspection: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                address: {
                    required: true
                },
                inspection_place: {
                    required: true
                },
                policy: {
                    required: true
                }


            },
            messages: {
                policy_by: {
                    required: "This field is required"
                },
                policy_branch: {
                    required: "This field is required"
                },
                policy_user: {
                    required: "This field is required"
                },
                policy_mobile: {
                    required: "This field is required",

                },
                appoint_by: {
                    required: "This field is required"
                },
                appointment_branch_name: {
                    required: "This field is required"
                },
                appointment_user_name: {
                    required: "This field is required"
                },
                appointment_mobile_num: {
                    required: "This field is required",

                },
                payment_by: {
                    required: "This field is required"
                },
                payment_branch_name: {
                    required: "This field is required"
                },
                payment_user_name: {
                    required: "This field is required"
                },
                payment_mobile_num: {
                    required: "This field is required",

                },
                // Existing field messages
                case_reference: "This field is required",

                policytype: "This field is required",
                insured_name: "This field is required",
                claimant_name: "This field is required",
                cause_inspection: "This field is required",
                cause_loss: "This field is required",
                address: "This field is required",
                inspection_place: "This field is required",
                policy: "This field is required"



            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                $.ajax({
                    url: '<?php echo base_url('marinepredispatchessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#project_preins_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });


        $('#policytype').on('change', function() {
            if ($(this).val() === 'Other') {
                $('#otherPolicyTypeDiv').show(); // Show the "Other" field
            } else {
                $('#otherPolicyTypeDiv').hide(); // Hide the "Other" field
                $('#otherPolicyType').val(''); // Clear the value of the input field
            }
        });

        $('#natureofloss').on('change', function() {
            if ($(this).val() === 'Other') {
                $('#other_nature_TypeDiv').show(); // Show the "Other" field
            } else {
                $('#other_nature_TypeDiv').hide(); // Hide the "Other" field
                $('#other_nature_Type').val(''); // Clear the value of the input field
            }
        });

        $('.cause_inspection').on('change', function() {
            if ($(this).val() === 'Others') {
                $('#otherReasonDiv').show(); // Show the "Other" field
            } else {
                $('#otherReasonDiv').hide(); // Hide the "Other" field
                $('#otherReason').val(''); // Clear the value of the input field
            }
        });


        $("#firefinal_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#generate_ila").hide();
                $('#firefinal_essential').trigger('submit');
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".disabledbtn").removeClass('disabled-btn');
                $(".editable-field").prop("disabled", false);
                $(".venorbtn").removeClass('disabled').css('opacity', '1');
                $("#generate_ila").show();
                $(".statementcard, .observationcard").css("background-color", ""); // Remove background color
                $(".edit-statement, .delete-statement, .edit-observation, .delete-observation, .uploadButton,.disable_btn").prop("disabled", false);

                // Re-enable Fancybox and restore opacity
                $(".small-img").attr("data-fancybox", "gallery").removeClass("disabled-img").css("opacity", "1");
                $(this).val("Update");
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#generate_ila").show();
                $('#firefinal_essential').trigger('submit');
                $(".editable-field").prop("disabled", true);
                $(".venorbtn").addClass('disabled').css('opacity', '0.5');
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
                $(".statementcard, .observationcard").css("background-color", "#e9ecef"); // Grey background
                $(".edit-statement, .delete-statement, .edit-observation, .delete-observation, .uploadButton,.disable_btn").prop("disabled", true);

                // Disable Fancybox and reduce opacity
                $(".small-img").removeAttr("data-fancybox").addClass("disabled-img").css("opacity", "0.5");
                $(this).val("Edit");
            }
        });

        $("#firefinal_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                policy_by: {
                    required: true
                },

                appoint_by: {
                    required: true
                },

                payment_by: {
                    required: true
                },

                case_reference: {
                    required: true

                },
                insured_name: {
                    required: true
                },
                contact_person_name: {
                    required: true
                },
                address: {
                    required: true
                },
                Ofinstruction: {
                    required: true
                },
                visit_date_time: {
                    required: true
                },
                insured_activity: {
                    required: true
                },
                loss_area: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                survey_place: {
                    required: true
                },
                policyNumberfrom: {
                    required: true
                },
                policyNumberto: {
                    required: true
                },
                policytype: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                claimant_number: {
                    required: true
                }
            },
            messages: {
                policy_by: {
                    required: "This field is required"
                },

                appoint_by: {
                    required: "This field is required"
                },

                payment_by: {
                    required: "This field is required"
                },

                case_reference: {
                    required: "This field is required"
                },
                insured_name: {
                    required: "This field is required"
                },
                contact_person_name: {
                    required: "This field is required"
                },
                address: {
                    required: "This field is required"
                },
                Ofinstruction: {
                    required: "This field is required"
                },
                visit_date_time: {
                    required: "This field is required"
                },
                insured_activity: {
                    required: "This field is required"
                },
                loss_area: {
                    required: "This field is required"
                },
                cause_loss: {
                    required: "This field is required"
                },
                loss_data: {
                    required: "This field is required"
                },
                survey_place: {
                    required: "This field is required"
                },
                policyNumberfrom: {
                    required: "This field is required"
                },
                policyNumberto: {
                    required: "This field is required"
                },
                policytype: {
                    required: "This field is required"
                },
                claimant_name: {
                    required: "This field is required"
                },
                claimant_number: {
                    required: "This field is required"
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                const formdata = new FormData(form);
                const aid = "<?php echo $aid; ?>";
                const natureofjob = "<?php echo $natureofjob; ?>";
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                $("#descrplist .card").each(function(index, element) {
                    let statementData = $(element).find("input[name='imgdescrption[]']").val();
                    let statement = $(element).find(".statement-text").text().trim();

                    // Extract images
                    let images = [];
                    $(element).find("img").each(function(imgIndex, imgElement) {
                        let imageSrc = $(imgElement).attr("src");
                        if (imageSrc) {
                            images.push(imageSrc);
                        }
                    });

                    // Append statement and description
                    formdata.append(`imgdescrps[${index}][statement]`, statement);

                    // Append images correctly
                    images.forEach((imageSrc, imgIndex) => {
                        formdata.append(`imgdescrps[${index}][images][${imgIndex}]`, imageSrc);
                    });
                });

                $("#observationlist .card").each(function(index, element) {
                    let statementData = $(element).find("input[name='imgdescrption[]']").val();
                    let statement = $(element).find(".statement-text").text().trim();

                    // Extract images
                    let images = [];
                    $(element).find("img").each(function(imgIndex, imgElement) {
                        let imageSrc = $(imgElement).attr("src");
                        if (imageSrc) {
                            images.push(imageSrc);
                        }
                    });

                    // Append statement and description
                    formdata.append(`imgobdescrp[${index}][statement]`, statement);

                    // Append images correctly
                    images.forEach((imageSrc, imgIndex) => {
                        formdata.append(`imgobdescrp[${index}][images][${imgIndex}]`, imageSrc);
                    });
                });

                $.ajax({
                    url: '<?php echo base_url("firefinalessentialdata"); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Disable the submit button to prevent multiple submissions
                        $('#firefinal_submit').prop('disabled', true);
                        $('#submit_loader').show(); // Show loader if you have one
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            // On successful submission, update the UI
                            $('#show_policy_card, #show_appointment_card, #show_payment_card')
                                .removeClass('hidden').addClass('visibility');
                            $(".venor-btn, .venorbtn").addClass("disabled-btn");
                            $('#firefinal_submit').val("Edit"); // Change submit button text to "Edit"
                            $(".editable-field").prop("disabled", true); // Disable editable fields
                            $("#generate_ila").show(); // Show generate ILA button
                            $('.static-row').hide(); // Hide static rows
                        } else {
                            alert('Submission failed. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', xhr.responseText, status, error);

                        // Handle various types of errors
                        if (xhr.status === 500) {
                            alert('An error occurred on the server. Please try again later.');
                        } else if (xhr.status === 400) {
                            alert('There was a problem with your request. Please check your data and try again.');
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        // Re-enable the submit button and hide the loader after the request is complete
                        $('#property_submit').prop('disabled', false);
                        $('#submit_loader').hide();
                    }
                });
            }
        });

        /* ------------------------------------------------------------------------- *  
         * MOTOR FINAL ESSENTIAL FORM (KAJAL)
         * ------------------------------------------------------------------------- */

        $("#motor_final_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#generate_ila").css('display', 'none');
                $('#motor_final_essential_data').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".disabledbtn").removeClass('disabled-btn');
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".disabledbtn").addClass('disabled-btn');
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#motor_final_essential_data').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        if ($("#motor_final_essential_data").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".editable-field").prop("disabled", true);
        }

        $("#motor_final_essential_data").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                // Existing fields
                case_reference: {
                    required: true
                },
                insurancefrom: {
                    required: true
                },
                insuranceto: {
                    required: true
                },
                any_fir: {
                    required: true
                },

                date_of_report: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                register_no: {
                    required: true
                },
                make_model: {
                    required: true
                },
                name_of_driver: {
                    required: true
                },
                driving_license_no: {
                    required: true
                },
                place_of_accident: {
                    required: true
                },
                date_of_incident: {
                    required: true
                },

                survey_allotment_date: {
                    required: true
                },
                survey_date: {
                    required: true
                },
                survey_place: {
                    required: true
                },
                place_of_repairer: {
                    required: true
                },
                estimated_loss: {
                    required: true
                },
                reported_tp_loss: {
                    required: true
                },
                spot_survey_details: {
                    required: true
                },

                // New: Payment fields
                payment_method: {
                    required: true
                },
                payment_reference: {
                    required: true
                },
                payment_date: {
                    required: true
                },
                payment_amount: {
                    required: true,
                    number: true
                },

                // New: Vendor fields
                vendor_name: {
                    required: true
                },
                vendor_contact: {
                    required: true
                },
                vendor_address: {
                    required: true
                },

                // New: Appointment fields
                appointment_date: {
                    required: true
                },
                appointment_time: {
                    required: true
                },
                appointment_location: {
                    required: true
                }
            },
            messages: {
                // Existing field messages
                case_reference: "This field is required",

                insuranceto: "This field is required",
                insurancefrom: "This field is required",
                any_fir: "This field is required",
                date_of_report: "This field is required",
                insured_name: "This field is required",
                policyNumber: "This field is required",
                sum_insured: "This field is required",
                register_no: "This field is required",
                make_model: "This field is required",
                name_of_driver: "This field is required",
                driving_license_no: "This field is required",
                place_of_accident: "This field is required",
                date_of_incident: "This field is required",
                survey_allotment_date: "This field is required",
                survey_date: "This field is required",
                survey_place: "This field is required",
                place_of_repairer: "This field is required",
                estimated_loss: "This field is required",
                reported_tp_loss: "This field is required",
                spot_survey_details: "This field is required",

                // New: Payment field messages
                payment_method: "Please select a payment method",
                payment_reference: "Please enter the payment reference",
                payment_date: "Please select the payment date",
                payment_amount: {
                    required: "Please enter the payment amount",
                    number: "Please enter a valid number"
                },

                // New: Vendor field messages
                vendor_name: "Please enter the vendor name",
                vendor_contact: "Please enter the vendor contact details",
                vendor_address: "Please enter the vendor address",

                // New: Appointment field messages
                appointment_date: "Please select the appointment date",
                appointment_time: "Please select the appointment time",
                appointment_location: "Please enter the appointment location"
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                $.ajax({
                    url: '<?php echo base_url('motorfinalspotessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#motor_final_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });
        /* ------------------------------------------------------------------------- *  
         * MOTOR FINAL FINAL FORM (KAJAL)
         * ------------------------------------------------------------------------- */

        $("#motor_final_case_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Submit") {

                // $("#generate_ila").css('display','none');
                $('#motor_final_casedata').trigger('submit');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".case-field").prop("disabled", false);
                // $("#generate_ila").css('display','block');
                $(this).val("Update");
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                // $("#generate_ila").css('display','block');
                $('#motor_final_casedata').trigger('submit');
            }
        });

        $("#motor_final_casedata").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                insured_address: {
                    required: true
                },
                appoint_by: {
                    required: true
                },
                loan_challan: {
                    required: true
                },

                gst_no: {
                    required: true
                },
                registered_owner: {
                    required: true
                },
                financers: {
                    required: true
                },
                registration_date: {
                    required: true
                },
                chasis_no: {
                    required: true
                },
                engine_no: {
                    required: true
                },
                physically_verified: {
                    required: true
                },
                body_type: {
                    required: true
                },
                tax_paid: {
                    required: true
                },
                vehicle_class: {
                    required: true
                },
                ulw: {
                    required: true
                },
                rlw: {
                    required: true
                },
                carrying_capacity: {
                    required: true
                },
                pre_acccident: {
                    required: true
                },
                fitness_certificate_no: {
                    required: true
                },
                fitness: {
                    required: true
                },
                fitness_date: {
                    required: true
                },
                date_of_birth: {
                    required: true
                },
                valid_up_to: {
                    required: true
                },
                permit_no: {
                    required: true
                },
                permit_validity: {
                    required: true
                },
                permit_type: {
                    required: true
                },
                area_of_operation: {
                    required: true
                },
                whether_valid: {
                    required: true
                },
                goods_tax: {
                    required: true
                },
                rc: {
                    required: true
                },
                docs_validity: {
                    required: true
                },
                issuing_authority: {
                    required: true
                },
                license_type: {
                    required: true
                },
                type_of_vehicle_allowed: {
                    required: true
                },
                verified_driving_license: {
                    required: true
                },
                ebdst: {
                    required: true
                },
                badge_no: {
                    required: true
                },
                repairers_address: {
                    required: true
                },
                insured_rep_attending_survey: {
                    required: true
                },
                has_accidenty: {
                    required: true
                },
                if_yes: {
                    required: true
                },
                spot_survey: {
                    required: true
                },
                third_party_particulars: {
                    required: true
                },
                cause_nature_accident: {
                    required: true
                },
                particulars_loss_damage: {
                    required: true
                },
                cause_of_accident: {
                    required: true
                }
            },
            messages: {
                cause_nature_accident: "This field is required",
                particulars_loss_damage: "This field is required",
                loan_challan: "This field is required",

                appoint_by: "This field is required",
                cause_of_accident: "This field is required",
                insured_address: "Please enter the address of the insured.",
                gst_no: "Please enter the GST/No. of Insured.",
                registered_owner: "Please enter the registered owner.",
                financers: "Please enter the financers (if any).",
                registration_date: "Please enter the date of registration.",
                chasis_no: "Please enter the chasis number.",
                engine_no: "Please enter the engine number.",
                physically_verified: "Please enter whether the vehicle is physically verified.",
                body_type: "Please enter the type of body.",
                tax_paid: "Please enter the tax paid up to.",
                vehicle_class: "Please enter the class of vehicle.",
                ulw: "Please enter the ULW.",
                rlw: "Please enter the RLW.",
                carrying_capacity: "Please enter the carrying capacity.",
                pre_acccident: "Please enter the pre-accident condition.",
                fitness: "This field is required",
                fitness_certificate_no: "Please enter the fitness certificate number.",
                fitness_date: "This field is required",
                date_of_birth: "This field is required",
                valid_up_to: "Please enter the validity date.",
                permit_no: "Please enter the permit number.",
                permit_validity: "Please enter the permit validity.",
                permit_type: "Please enter the type of permit.",
                area_of_operation: "Please enter the route/area of operation.",
                whether_valid: "Please enter whether valid for the state where the accident took place.",
                goods_tax: "Please enter the goods/passenger tax.",
                rc: "Please enter the RC.",
                docs_validity: "Please enter the validity date of the documents.",
                issuing_authority: "Please enter the issuing authority.",
                license_type: "Please enter the type of license.",
                type_of_vehicle_allowed: "Please enter the type of vehicle allowed to drive.",
                verified_driving_license: "Please enter whether the driving license is verified.",
                ebdst: "Please enter the Ebdst.",
                badge_no: "Please enter the badge number.",
                repairers_address: "Please enter the repairer's address.",
                insured_rep_attending_survey: "Please enter the insured's representative attending the survey.",
                has_accidenty: "Please enter whether the accident has been reported to the police.",
                if_yes: "Please enter the FIR/DD number if applicable.",
                spot_survey: "Please enter the spot survey details.",
                third_party_particulars: "Please enter the third party particulars."
            },
            submitHandler: function(form, event) {
                event.preventDefault(); // Prevent default button action

                // Extract selected option texts
                var goodsTaxText = $('#goods_tax option:selected').text();
                var rcText = $('#rc option:selected').text();
                // Extract selected option texts
                var fitnessText = $('#fitness option:selected').text();
                var permitText = $('#permit option:selected').text();

                // Serialize form data
                var formData = $(form).serialize();
                var aid = "<?php echo htmlspecialchars($aid, ENT_QUOTES, 'UTF-8'); ?>";

                // Append additional fields to formData
                formData += '&aid=' + encodeURIComponent(aid);
                formData += '&goods_taxText=' + encodeURIComponent(goodsTaxText);
                formData += '&rcText=' + encodeURIComponent(rcText);
                formData += '&fitnessText=' + encodeURIComponent(fitnessText);
                formData += '&permitText=' + encodeURIComponent(permitText);

                // AJAX request to updatecasedata endpoint
                $.ajax({
                    url: "<?php echo base_url('Cases/updateMotorFinalCaseData') ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            $('#motor_final_case_submit').val("Edit");
                            $(".case-field").prop("disabled", true);
                            scrollToNextForm("#motor_final_casedata"); // Assuming scrollToNextForm is defined elsewhere
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error as needed
                    }
                });
            }
        });


        /* ------------------------------------------------------------------------- *  
         * MOTOR TP FINAL FORM (KAJAL)
         * ------------------------------------------------------------------------- */

        $("#motortp_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#motortp_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#motortp_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#motortp_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('motortpessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#motortp_essential').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });


        $("#mediclaim_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#mediclaim_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").addClass('disabled-btn');
                $(this).val("Edit");
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").removeClass('disabled-btn');
                $(this).val("Update");
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#mediclaim_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                $(".disabledbtn").addClass('disabled-btn');
            }
        });

        $("#mediclaim_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('mediclaimessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#mediclaim_essential').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });
        if ($("#mediclaim_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".editable-field").prop("disabled", true);
            $("#toggleManualEntry").prop("disabled", true);
        }

        $("#marine_cargo_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#marine_cargo_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#marine_cargo_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#marine_cargo_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('marinecargospotessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#marine_cargo_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });

        $("#paclaim_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#paclaim_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#paclaim_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#paclaim_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('paclaimessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#paclaim_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });

        $("#assets_valuation_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#assets_valuation_essential_data').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#assets_valuation_essential_data').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        if ($("#assets_valuation_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".editable-field").prop("disabled", true);
            $('.visitdate').css('display', 'block');

            // Only show "Other proposer policy" if "Other" is selected
            if ($('#proposer_policy').val() === "Other") {
                $('.other_proposer_policy').css('display', 'block');
            } else {
                $('.other_proposer_policy').css('display', 'none');
            }

        } else {
            $('.other_proposer_policy').css('display', 'none');
            $('.visitdate').css('display', 'none');
        }


        $('#proposer_policy').on('change', function() {
            if ($('#proposer_policy').val() === "Other") {
                $('.other_proposer_policy').css('display', 'block');
            } else {
                $('.other_proposer_policy').css('display', 'none');

            }
        });

        function toggleVisitDate() {
            if ($('#valuation_type').val() === "Physical") {
                $('.visitdate').css('display', 'block');
            } else {
                $('.visitdate').css('display', 'none');
            }
        }

        if ($('#valuation_type').val() === "Physical") {
            $('.visitdate').css('display', 'block');
        }

        // Call the function on page load
        toggleVisitDate();

        // Bind it to the change event
        $('#valuation_type').on('change', toggleVisitDate);

        $("#assets_valuation_essential_data").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                salutation: {
                    required: true
                },
                contact_person_name: {
                    required: true
                },
                contact_person_mobile: {
                    required: true
                },
                date_of_report: {
                    required: true
                },
                proposer: {
                    required: true
                },
                proposer_policy: {
                    required: true
                },

            },
            messages: {
                case_reference: "Case reference is required",
                salutation: "This Field is required",
                contact_person_name: "This Field is required",
                contact_person_mobile: "This Field is required",
                date_of_report: "This Field is required",
                proposer: "This Field is required",
                proposer_policy: "This Field is required"
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#assets_valuation_submit').prop('disabled', true).val('Processing...');

                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var companyid = "<?php echo $defaultcompany; ?>";

                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                var assignmentType = $(".assignmentType").val(); // or use the JS variable directly

                // Decide the URL
                var ajaxUrl = '';
                if (assignmentType === 'outgoing') {
                    ajaxUrl = '<?php echo base_url("assetsessential_outgoing"); ?>';
                } else {
                    ajaxUrl = '<?php echo base_url("assetsessential"); ?>';
                }

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
                            $(".venor-btn, .venorbtn").addClass("disabled-btn");
                            $('#assets_valuation_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }

        });


        $("#ebdeathcase_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#ebdeathcase_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#ebdeathcase_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#ebdeathcase_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('paclaimessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#ebdeathcase_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });

        // ENGINEERING FINAL  (KAJAL) 
        $("#engineering_final_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#generate_ila").hide();
                $('#engineering_final_essential').trigger('submit');
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".disabledbtn").removeClass('disabled-btn');
                $(".editable-field").prop("disabled", false);
                $(".venorbtn").removeClass('disabled').css('opacity', '1');
                $("#generate_ila").show();
                $(".statementcard, .observationcard").css("background-color", ""); // Remove background color
                $(".edit-statement, .delete-statement, .edit-observation, .delete-observation, .uploadButton,.disable_btn").prop("disabled", false);

                // Re-enable Fancybox and restore opacity
                $(".small-img").attr("data-fancybox", "gallery").removeClass("disabled-img").css("opacity", "1");
                $(this).val("Update");
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#generate_ila").show();
                $('#engineering_final_essential').trigger('submit');
                $(".editable-field").prop("disabled", true);
                $(".venorbtn").addClass('disabled').css('opacity', '0.5');
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
                $(".statementcard, .observationcard").css("background-color", "#e9ecef"); // Grey background
                $(".edit-statement, .delete-statement, .edit-observation, .delete-observation, .uploadButton,.disable_btn").prop("disabled", true);

                // Disable Fancybox and reduce opacity
                $(".small-img").removeAttr("data-fancybox").addClass("disabled-img").css("opacity", "0.5");
                $(this).val("Edit");
            }
        });

        $("#engineering_final_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                policy_by: {
                    required: true
                },

                appoint_by: {
                    required: true
                },

                payment_by: {
                    required: true
                },

                case_reference: {
                    required: true

                },
                insured_name: {
                    required: true
                },
                contact_person_name: {
                    required: true
                },
                address: {
                    required: true
                },
                Ofinstruction: {
                    required: true
                },
                visit_date_time: {
                    required: true
                },
                insured_activity: {
                    required: true
                },
                loss_area: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                survey_place: {
                    required: true
                },
                policyNumberfrom: {
                    required: true
                },
                policyNumberto: {
                    required: true
                },
                policytype: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                claimant_number: {
                    required: true
                }
            },
            messages: {
                policy_by: {
                    required: "This field is required"
                },

                appoint_by: {
                    required: "This field is required"
                },

                payment_by: {
                    required: "This field is required"
                },

                case_reference: {
                    required: "This field is required"
                },
                insured_name: {
                    required: "This field is required"
                },
                contact_person_name: {
                    required: "This field is required"
                },
                address: {
                    required: "This field is required"
                },
                Ofinstruction: {
                    required: "This field is required"
                },
                visit_date_time: {
                    required: "This field is required"
                },
                insured_activity: {
                    required: "This field is required"
                },
                loss_area: {
                    required: "This field is required"
                },
                cause_loss: {
                    required: "This field is required"
                },
                loss_data: {
                    required: "This field is required"
                },
                survey_place: {
                    required: "This field is required"
                },
                policyNumberfrom: {
                    required: "This field is required"
                },
                policyNumberto: {
                    required: "This field is required"
                },
                policytype: {
                    required: "This field is required"
                },
                claimant_name: {
                    required: "This field is required"
                },
                claimant_number: {
                    required: "This field is required"
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                const formdata = new FormData(form);
                const aid = "<?php echo $aid; ?>";
                const natureofjob = "<?php echo $natureofjob; ?>";
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                $("#descrplist .card").each(function(index, element) {
                    let statementData = $(element).find("input[name='imgdescrption[]']").val();
                    let statement = $(element).find(".statement-text").text().trim();

                    // Extract images
                    let images = [];
                    $(element).find("img").each(function(imgIndex, imgElement) {
                        let imageSrc = $(imgElement).attr("src");
                        if (imageSrc) {
                            images.push(imageSrc);
                        }
                    });

                    // Append statement and description
                    formdata.append(`imgdescrps[${index}][statement]`, statement);

                    // Append images correctly
                    images.forEach((imageSrc, imgIndex) => {
                        formdata.append(`imgdescrps[${index}][images][${imgIndex}]`, imageSrc);
                    });
                });

                $("#observationlist .card").each(function(index, element) {
                    let statementData = $(element).find("input[name='imgdescrption[]']").val();
                    let statement = $(element).find(".statement-text").text().trim();

                    // Extract images
                    let images = [];
                    $(element).find("img").each(function(imgIndex, imgElement) {
                        let imageSrc = $(imgElement).attr("src");
                        if (imageSrc) {
                            images.push(imageSrc);
                        }
                    });

                    // Append statement and description
                    formdata.append(`imgobdescrp[${index}][statement]`, statement);

                    // Append images correctly
                    images.forEach((imageSrc, imgIndex) => {
                        formdata.append(`imgobdescrp[${index}][images][${imgIndex}]`, imageSrc);
                    });
                });

                $.ajax({
                    url: '<?php echo base_url("firefinalessentialdata"); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Disable the submit button to prevent multiple submissions
                        $('#engineering_final_submit').prop('disabled', true);
                        $('#submit_loader').show(); // Show loader if you have one
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            // On successful submission, update the UI
                            $('#show_policy_card, #show_appointment_card, #show_payment_card')
                                .removeClass('hidden').addClass('visibility');
                            $(".venor-btn, .venorbtn").addClass("disabled-btn");
                            $('#engineering_final_submit').val("Edit"); // Change submit button text to "Edit"
                            $(".editable-field").prop("disabled", true); // Disable editable fields
                            $("#generate_ila").show(); // Show generate ILA button
                            $('.static-row').hide(); // Hide static rows
                        } else {
                            alert('Submission failed. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', xhr.responseText, status, error);

                        // Handle various types of errors
                        if (xhr.status === 500) {
                            alert('An error occurred on the server. Please try again later.');
                        } else if (xhr.status === 400) {
                            alert('There was a problem with your request. Please check your data and try again.');
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        // Re-enable the submit button and hide the loader after the request is complete
                        $('#engineering_final_submit').prop('disabled', false);
                        $('#submit_loader').hide();
                    }
                });
            }
        });

        if ($("#engineering_final_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".case-field").prop("disabled", true);
            $("#toggleManualEntry").prop("disabled", true);
        }


        /* ------------------------------------------------------------------------- *  
         * MISCELLANEOUS FINAL FORM (KAJAL)
         * ------------------------------------------------------------------------- */

        $("#miscellaneous_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#miscellaneous_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#miscellaneous_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        if ($("#miscellaneous_submit").val() === "Edit") {

            $(".editable-field").prop("disabled", true);

        }

        $("#miscellaneous_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('miscellaneousessentialdata'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#miscellaneous_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });


        $("#fire_preins_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#fire_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#fire_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#fire_preins_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('fireprinsessentialdata'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#fire_preins_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });

        $("#engineering_preins_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#engineering_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#engineering_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#engineering_preins_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },


                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",

                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"

            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('engipreinsessentialdata'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#engineering_preins_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });

        $("#motor_preins_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#motor_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#motor_preins_essential').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#motor_preins_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                case_reference: {
                    required: true
                },
                policytype: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                subject_matter: {
                    required: true
                },
                claimant_name: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
                loss_data: {
                    required: true
                },
                policy_report: {
                    required: true
                },
                investigation_date: {
                    required: true
                },
                natureofloss: {
                    required: true
                },
                loss_place: {
                    required: true
                }

            },
            messages: {
                case_reference: "Case reference is required",
                policytype: "Policy type is required",
                policyNumber: "Policy number is required",
                sum_insured: "Sum insured is required",
                insured_name: "Insured name is required",
                subject_matter: "Subject matter is required",
                claimant_name: "This Field is required",
                cause_loss: "This Field is required",
                loss_data: "This Field is required",
                policy_report: "This Field is required",
                investigation_date: "This Field is required",
                natureofloss: "This Field is required",
                loss_place: "This Field is required"
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Append selected policy type text
                var goodsTaxText = $('#policytype option:selected').text();
                formdata.append('policy_typeText', goodsTaxText);

                $.ajax({
                    url: '<?php echo base_url('motorpreinsessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#motor_preins_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
        });

        // MOTOR FINAL CASE FORM (KAJAL)
        $("#motor_final_case_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Submit") {
                $('#motor_final_casedata').trigger('submit');
                $(".disabledbtn").addClass('disabled-btn');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".case-field").prop("disabled", false);
                $(this).val("Update");
                $(".disabledbtn").removeClass('disabled-btn');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                $('#motor_final_casedata').trigger('submit');
                $(".disabledbtn").addClass('disabled-btn');
            }
        });

        $("#motor_final_casedata").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                insured_address: {
                    required: true
                },
                appoint_by: {
                    required: true
                },
                loan_challan: {
                    required: true
                },

                gst_no: {
                    required: true
                },
                registered_owner: {
                    required: true
                },
                financers: {
                    required: true
                },
                registration_date: {
                    required: true
                },
                chasis_no: {
                    required: true
                },
                engine_no: {
                    required: true
                },
                physically_verified: {
                    required: true
                },
                body_type: {
                    required: true
                },
                tax_paid: {
                    required: true
                },
                vehicle_class: {
                    required: true
                },
                ulw: {
                    required: true
                },
                rlw: {
                    required: true
                },
                carrying_capacity: {
                    required: true
                },
                pre_acccident: {
                    required: true
                },
                fitness_certificate_no: {
                    required: true
                },
                fitness: {
                    required: true
                },
                fitness_date: {
                    required: true
                },
                date_of_birth: {
                    required: true
                },
                valid_up_to: {
                    required: true
                },
                permit_no: {
                    required: true
                },
                permit_validity: {
                    required: true
                },
                permit_type: {
                    required: true
                },
                area_of_operation: {
                    required: true
                },
                whether_valid: {
                    required: true
                },
                goods_tax: {
                    required: true
                },
                rc: {
                    required: true
                },
                docs_validity: {
                    required: true
                },
                issuing_authority: {
                    required: true
                },
                license_type: {
                    required: true
                },
                type_of_vehicle_allowed: {
                    required: true
                },
                verified_driving_license: {
                    required: true
                },
                ebdst: {
                    required: true
                },
                badge_no: {
                    required: true
                },
                repairers_address: {
                    required: true
                },
                insured_rep_attending_survey: {
                    required: true
                },
                has_accidenty: {
                    required: true
                },
                if_yes: {
                    required: true
                },
                spot_survey: {
                    required: true
                },
                third_party_particulars: {
                    required: true
                },
                cause_nature_accident: {
                    required: true
                },
                particulars_loss_damage: {
                    required: true
                },
                cause_of_accident: {
                    required: true
                }
            },
            messages: {
                cause_nature_accident: "This field is required",
                particulars_loss_damage: "This field is required",
                loan_challan: "This field is required",

                appoint_by: "This field is required",
                cause_of_accident: "This field is required",
                insured_address: "Please enter the address of the insured.",
                gst_no: "Please enter the GST/No. of Insured.",
                registered_owner: "Please enter the registered owner.",
                financers: "Please enter the financers (if any).",
                registration_date: "Please enter the date of registration.",
                chasis_no: "Please enter the chasis number.",
                engine_no: "Please enter the engine number.",
                physically_verified: "Please enter whether the vehicle is physically verified.",
                body_type: "Please enter the type of body.",
                tax_paid: "Please enter the tax paid up to.",
                vehicle_class: "Please enter the class of vehicle.",
                ulw: "Please enter the ULW.",
                rlw: "Please enter the RLW.",
                carrying_capacity: "Please enter the carrying capacity.",
                pre_acccident: "Please enter the pre-accident condition.",
                fitness: "This field is required",
                fitness_certificate_no: "Please enter the fitness certificate number.",
                fitness_date: "This field is required",
                date_of_birth: "This field is required",
                valid_up_to: "Please enter the validity date.",
                permit_no: "Please enter the permit number.",
                permit_validity: "Please enter the permit validity.",
                permit_type: "Please enter the type of permit.",
                area_of_operation: "Please enter the route/area of operation.",
                whether_valid: "Please enter whether valid for the state where the accident took place.",
                goods_tax: "Please enter the goods/passenger tax.",
                rc: "Please enter the RC.",
                docs_validity: "Please enter the validity date of the documents.",
                issuing_authority: "Please enter the issuing authority.",
                license_type: "Please enter the type of license.",
                type_of_vehicle_allowed: "Please enter the type of vehicle allowed to drive.",
                verified_driving_license: "Please enter whether the driving license is verified.",
                ebdst: "Please enter the Ebdst.",
                badge_no: "Please enter the badge number.",
                repairers_address: "Please enter the repairer's address.",
                insured_rep_attending_survey: "Please enter the insured's representative attending the survey.",
                has_accidenty: "Please enter whether the accident has been reported to the police.",
                if_yes: "Please enter the FIR/DD number if applicable.",
                spot_survey: "Please enter the spot survey details.",
                third_party_particulars: "Please enter the third party particulars."
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault(); // Prevent default button action

                // Extract selected option texts
                var goodsTaxText = $('#goods_tax option:selected').text();
                var rcText = $('#rc option:selected').text();
                // Extract selected option texts
                var fitnessText = $('#fitness option:selected').text();
                var permitText = $('#permit option:selected').text();

                // Serialize form data
                var formData = $(form).serialize();
                var aid = "<?php echo htmlspecialchars($aid, ENT_QUOTES, 'UTF-8'); ?>";

                // Append additional fields to formData
                formData += '&aid=' + encodeURIComponent(aid);
                formData += '&goods_taxText=' + encodeURIComponent(goodsTaxText);
                formData += '&rcText=' + encodeURIComponent(rcText);
                formData += '&fitnessText=' + encodeURIComponent(fitnessText);
                formData += '&permitText=' + encodeURIComponent(permitText);

                // AJAX request to updatecasedata endpoint
                $.ajax({
                    url: "<?php echo base_url('Cases/updateMotorFinalCaseData') ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            $('#motor_final_case_submit').val("Edit");
                            $(".case-field").prop("disabled", true);
                            scrollToNextForm("#motor_final_casedata"); // Assuming scrollToNextForm is defined elsewhere
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error as needed
                    }
                });
            }
        });

        if ($("#motor_final_case_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".case-field").prop("disabled", true);
        }


        /* ------------------------------------------------------------------------- *  
         * MOTOR SPOT FORM (KAJAL)
         * ------------------------------------------------------------------------- */
        $("#motor_spot_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $(".disabledbtn").addClass('disabled-btn');
                $("#generate_ila").css('display', 'none');
                $('#motor_spot_essential_data').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".disabledbtn").removeClass('disabled-btn');
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".disabledbtn").addClass('disabled-btn');
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#motor_spot_essential_data').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        $("#motor_spot_essential_data").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                date_of_report: {
                    required: true
                },
                register_no: {
                    required: true
                },
                insured_name: {
                    required: true
                },
                policyNumber: {
                    required: true
                },

                insurer: {
                    required: true
                },
                insured_address: {
                    required: true
                },
                registered_owner: {
                    required: true
                },
                insurancefrom: {
                    required: true
                },
                insuranceto: {
                    required: true
                },
                financers: {
                    required: true
                },
                sum_insured: {
                    required: true
                },
                policy_by: {
                    required: true
                },
                policy_branch: {
                    required: true
                },
                policy_user: {
                    required: true
                },
                policy_mobile: {
                    required: true
                },
                appoint_by: {
                    required: true
                },
                appointment_branch_name: {
                    required: true
                },
                appointment_user_name: {
                    required: true
                },
                appointment_mobile_num: {
                    required: true
                },
                payment_by: {
                    required: true
                },
                payment_branch_name: {
                    required: true
                },
                payment_user_name: {
                    required: true
                },
                payment_mobile_num: {
                    required: true
                },
                case_reference: {
                    required: true,
                    // caseReferenceFormat: true
                }
            },
            messages: {
                date_of_report: {
                    required: "Please enter the date of the report."
                },
                register_no: {
                    required: "Please provide the registration number."
                },
                insured_name: {
                    required: "Please enter the insured name."
                },
                policyNumber: {
                    required: "Please provide the policy number."
                },

                insurer: {
                    required: "Please specify the insurer."
                },
                insured_address: {
                    required: "Please provide the insured address."
                },
                registered_owner: {
                    required: "Please enter the registered owner."
                },
                insurancefrom: {
                    required: "Please provide the start date of the insurance."
                },
                insuranceto: {
                    required: "Please provide the end date of the insurance."
                },
                financers: {
                    required: "Please specify the financers."
                },
                sum_insured: {
                    required: "Please enter the sum insured."
                },
                policy_by: {
                    required: "Please specify who the policy is by."
                },
                policy_branch: {
                    required: "Please provide the policy branch."
                },
                policy_user: {
                    required: "Please specify the policy user."
                },
                policy_mobile: {
                    required: "Please provide the policy user's mobile number."
                },
                appoint_by: {
                    required: "Please specify who appointed the user."
                },
                appointment_branch_name: {
                    required: "Please provide the appointment branch name."
                },
                appointment_user_name: {
                    required: "Please specify the appointment user name."
                },
                appointment_mobile_num: {
                    required: "Please provide the appointment user's mobile number."
                },
                payment_by: {
                    required: "Please specify who made the payment."
                },
                payment_branch_name: {
                    required: "Please provide the payment branch name."
                },
                payment_user_name: {
                    required: "Please specify the payment user name."
                },
                payment_mobile_num: {
                    required: "Please provide the payment user's mobile number."
                },
                case_reference: {
                    required: "Please provide the case reference number.",
                    // caseReferenceFormat: "Please enter a valid case reference format."
                }
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);
                var assignmentType = $(".assignmentType").val(); // or use the JS variable directly
                // Decide the URL
                var ajaxUrl = '';
                if (assignmentType === 'outgoing') {
                    ajaxUrl = '<?php echo base_url("motorspotessential_outgoing"); ?>';
                } else {
                    ajaxUrl = '<?php echo base_url("motorspotessential"); ?>';
                }

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {

                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }

                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }

                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#motor_spot_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                            // scrollToNextForm("#caseForm");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });

        if ($("#motor_spot_submit").val() === "Edit") {
            $(".disabledbtn").addClass('disabled-btn');
            $(".essential-field").prop("disabled", true);
        }

        $('#insured_name').on('input', function() {
            let insuredAddress = $(this).val();
            $('#registered_owner').val(insuredAddress);
        });



        var specialParaTextarea = $('#sb1');
        var storedStatement = localStorage.getItem('sb1');
        var predefinedText = "The caused & extent of damages appeared are probable under the circumstances as reported. Every possible care has been taken to note down the visible losses, other, if any found at the time of final survey, suitable action may please be taken in view the nature of accident.";

        if (storedStatement) {
            specialParaTextarea.val(storedStatement);
            // statement_of_insuredTextarea.prop('disabled', false); 
        } else {
            specialParaTextarea.val(predefinedText);
        }

        specialParaTextarea.on('input', function() {
            localStorage.setItem('sb1', specialParaTextarea.val());
        });

        var specialPara2Textarea = $('#sb2');
        var storedStatement = localStorage.getItem('sb2');
        var predefinedText = "After the spot inspection the party was advised to remove the above accidental vehicle to repair workshop & intimate to insurer for arranging final survey.";

        if (storedStatement) {
            specialPara2Textarea.val(storedStatement);
            // statement_of_insuredTextarea.prop('disabled', false); 
        } else {
            specialPara2Textarea.val(predefinedText);
        }

        specialPara2Textarea.on('input', function() {
            localStorage.setItem('sb2', specialPara2Textarea.val());
        });

        var particulars_loss = $('#particulars_loss_damage');
        var storedParticularsStatement = localStorage.getItem('particulars_loss_damage');
        var predefinedText = "On receipt of instruction from the underwrite office, our representative visited the spot of accident. The above vehicle was lying in accidental condition. Few Photographs of the vehicle taken from different angles to show the position of the vehicle and loss to the subject vehicle. The damages, which could be seen apparently, were noted as far as possible. The damages observed at spot are as under:.";

        // Check if there is a stored value
        if (storedParticularsStatement) {
            particulars_loss.val(storedParticularsStatement);
        } else {
            particulars_loss.val(predefinedText);
        }

        // Save the updated value to localStorage on input
        particulars_loss.on('input', function() {
            localStorage.setItem('particulars_loss_damage', particulars_loss.val());
        });


        function toggleLoadBody() {
            const selectedValue = $('#vehicle_class option:selected').text().trim();
            const showLoadBody = ['Tractor', 'Bus', 'Goods Carrier'].includes(selectedValue);

            if ($('.load_body_container').length) {
                $('.load_body_container').toggle(showLoadBody);
            }
        }

        // Trigger change event on page load to set initial visibility
        toggleLoadBody();

        // Listen for changes in the vehicle_class dropdown
        $('#vehicle_class').on('change', function() {
            toggleLoadBody();
        });


        /* ------------------------------------------------------------------------- *
         * PROPERTY FORM (KAJAL)
         * ------------------------------------------------------------------------- */






        /* ------------------------------------------------------------------------- *
         * PREDEFINED FIELD STATEMENT OF INSURED(KAJAL)
         * ------------------------------------------------------------------------- */
        var statement_of_insuredTextarea = $('#statement_of_insured');
        var storedStatement = localStorage.getItem('statement_of_insured');

        var predefinedText = "Our investigator has inquired from the above-named claimant/insured, who has confirmed the incident and provided a written statement to that effect. The statement is enclosed.";

        if (storedStatement) {
            statement_of_insuredTextarea.val(storedStatement);
            // statement_of_insuredTextarea.prop('disabled', false); 
        } else {
            statement_of_insuredTextarea.val(predefinedText);
        }

        statement_of_insuredTextarea.on('input', function() {
            localStorage.setItem('statement_of_insured', statement_of_insuredTextarea.val());
        });

        /* ------------------------------------------------------------------------- *
         * PREDEFINED FIELD STATEMENT OF VILLAGERS(KAJAL)
         * ------------------------------------------------------------------------- */
        var statement_of_villagersTextarea = $('#statement_of_villagers');
        var storedStatement = localStorage.getItem('statement_of_villagers');

        var predefinedText = "Our investigator has also inquired with the neighbors/villagers, who have confirmed the incident and provided a written statement to that effect. The statement is enclosed.";

        if (storedStatement) {
            statement_of_villagersTextarea.val(storedStatement);
            // statement_of_villagersTextarea.prop('disabled', false); 
        } else {
            statement_of_villagersTextarea.val(predefinedText);
        }
        statement_of_villagersTextarea.on('input', function() {
            localStorage.setItem('statement_of_villagers', statement_of_villagersTextarea.val());
        });

        /* ------------------------------------------------------------------------- *
         * PREDEFINED FIELD STATEMENT OF TWO AUTHORIZED PERSON(KAJAL)
         * ------------------------------------------------------------------------- */
        var statement_of_two_authorizedTextarea = $('#statement_of_two_authorized');
        var storedStatement = localStorage.getItem('statement_of_two_authorized');

        var predefinedText = "Our investigation has further inquired about the above matter. Many witnesses have confirmed the details provided. Signatures of the village sarpanch/block pramukh and doctors were also obtained on the documents, all confirming the circumstances of the loss as explained above. The relevant documents are enclosed.";

        if (storedStatement) {
            statement_of_two_authorizedTextarea.val(storedStatement);
            // statement_of_two_authorizedTextarea.prop('disabled', false); 
        } else {
            statement_of_two_authorizedTextarea.val(predefinedText);
        }
        statement_of_villagersTextarea.on('input', function() {
            localStorage.setItem('statement_of_two_authorized', statement_of_two_authorizedTextarea.val());
        });

        /* ------------------------------------------------------------------------- *
         * ON SUBMIT ESSENSTIONAL DATA SCROLL DOWN PAGE AND SHOW CASE FORM (KAJAL)
         * ------------------------------------------------------------------------- */
        function scrollToNextForm(caseForm) {
            // $("#essentialForm input, #essentialForm select, #essentialForm textarea").prop("disabled", true);
            $("html, body").animate({
                scrollTop: $(caseForm).offset().top
            }, {
                duration: 300,
                easing: "swing",
                complete: function() {
                    $(caseForm).show();
                }
            });
        }

        /* ------------------------------------------------------------------------- *
         * SUBMIT CASE FORM (KAJAL)
         * ------------------------------------------------------------------------- */
        $("#cattle_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Submit") {
                // $("#generate_ila").css('display','none');
                $('#caseDataForm').trigger('submit');
            } else if (editButtonText === "Edit") {
                $(".case-field").prop("disabled", false);
                // $("#generate_ila").css('display','block');
                $(this).val("Update");
            } else if (editButtonText === "Update") {
                // Submit the form
                // $("#generate_ila").css('display','block');
                $('#caseDataForm').trigger('submit');
            }
        });


        $("#caseDataForm").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                salutation: {
                    required: true,
                },
                address_of_insured: {
                    required: true,
                },
                guardian_name: {
                    required: true
                },
                aadhar_number: {
                    required: true
                },
                pan_number: {
                    required: true
                },
                familyIDNumber: {
                    required: true
                },
                dateofInsurance: {
                    required: true
                },
                insuredCategory: {
                    required: true
                },
                healthDatePicker: {
                    required: true,
                },
                HelthCertificate: {
                    required: true
                },
                policyNumber: {
                    required: true
                },
                periodCov: {
                    required: true
                },
                amount1: {
                    required: true,
                    digits: true
                },
                amount2: {
                    required: true,
                    digits: true
                },
                milkingCapacity: {
                    required: true
                },
                doctorName: {
                    required: true
                },
                breed: {
                    required: true
                },
                birthNaturalMark: {
                    required: true
                },
                Gender: {
                    required: true
                },
                totalAnimal: {
                    required: true,
                    digits: true
                },
                totalAnimalInsured: {
                    required: true
                },
                anyLoanTaken: {
                    required: true
                },
                individualFamily: {
                    required: true
                },
                loanRunning: {
                    required: true
                },
                accountNumberInput: {
                    required: true,
                },
                accountNumber_saving_account: {
                    required: true
                },
                accountHolder: {
                    required: true
                },
                ifscCode: {
                    required: true
                },
                bankDetails: {
                    required: true
                },
                diseaseDate: {
                    required: true
                },
                animalDisposal: {
                    required: true
                },
                calvingDate: {
                    required: true
                },
                pregnant: {
                    required: true
                },
                pmr: {
                    required: true
                },
                dateTimePostMortem: {
                    required: true
                },
                reason_of_death: {
                    required: true
                },
                nameOfdoctor: {
                    required: true
                },
                doctorContactNumber: {
                    required: true

                },
                type_of_animal_as_per_pmr: {
                    required: true
                },
                breedAsPerPMR: {
                    required: true
                },
                ageOfAnimal: {
                    required: true,
                },
                tagAsPerPMR: {
                    required: true
                },
                milk_capacity: {
                    required: true
                },
                clean_pmr: {
                    required: true
                },
                causeOfDeathAsPerPMR: {
                    required: true
                },
                causeOfDeathAsPerInsured: {
                    required: true
                },
                treatment_chart: {
                    required: true
                },
                treatmentDate: {
                    required: true
                },
                whoAdministeredTreatment: {
                    required: true
                },
                administeredTreatment: {
                    required: true
                },
                administeredTreatment: {
                    required: true
                },
                bankIOwnerAddress: {
                    required: true
                },
                physicalHealth: {
                    required: true
                },
                gapsBetweenTreatment: {
                    required: true
                },
                dateAndAmountOfPurchase: {
                    required: true
                },
                physicalHealthOfAnimal: {
                    required: true
                },
                anyDisavility: {
                    required: true
                },
                statement_of_insured: {
                    required: true
                },
                statement_of_two_authorized: {
                    required: true
                },
                observation_4: {
                    required: true
                },
                observation_1: {
                    required: true
                },
                observation_2: {
                    required: true
                },
                observation_3: {
                    required: true
                },
                observation_5: {
                    required: true
                },
                observation_6: {
                    required: true
                },
                observation_7: {
                    required: true
                },
                observation_8: {
                    required: true
                },
                observation_9: {
                    required: true
                },

                statement_of_villagers: {
                    required: true
                },
                nameOfBank: {
                    required: true
                },
                satisfactory_and_sufficient: {
                    required: true
                },
                policy_copy: {
                    required: true
                },
                health_certificate: {
                    required: true
                },
                claim_intimation_letter: {
                    required: true
                },
                discharge_voucher: {
                    required: true
                },
                sc_certificate: {
                    required: true
                },

                account_number: {
                    required: true
                },
                pmr_with_signature: {
                    required: true
                },
                treatment_chart_option: {
                    required: true
                },
                insured_statement: {
                    required: true
                },
                claim_form_with_signature: {
                    required: true
                },
                copy_of_adhar_card: {
                    required: true
                },
                photo_of_dead: {
                    required: true
                },
                investigator_report: {
                    required: true
                },
                tag_available: {
                    required: true
                },
                fir_attached: {
                    required: true
                },


                vs_signature_on_pmr: {
                    required: true
                },
                vs_stamp_on_pmr: {
                    required: true
                },
                period_of_treatment_days: {
                    required: true
                },
                signed_by_tehsildar: {
                    required: true
                },
                signed_by_sarpanch: {
                    required: true
                },
                tag_number_clear: {
                    required: true
                },
                dead_animal_photo_attached: {
                    required: true
                },
                tag_number_as_per_policy: {
                    required: true
                },
                health_certificate_option: {
                    required: true
                },
                pmr_option: {
                    required: true
                }
            },
            messages: {
                salutation: "Please select Salutation.",
                address_of_insured: "Please enter address of insured.",
                guardian_name: "Please entet Guardian Name.",
                aadhar_number: "Please enter the Aadhar Number.",
                pan_number: "Please enter Pan Number.",
                familyIDNumber: "Please enter Family ID.",
                dateofInsurance: "Please select date.",
                healthDatePicker: "Please select date.",
                HelthCertificate: "Please enter the health certificate number.",
                policyNumber: "Please enter the policy number.",
                periodCov: "Please select date.",
                amount1: {
                    required: "Please enter amount.",
                    digits: "Please enter a valid amount."
                },
                amount2: {
                    required: "Please enter amount.",
                    digits: "Please enter a valid amount."
                },
                milkingCapacity: "Please enter milking capacity.",
                doctorName: "Please enter name of doctor",
                breed: "Please enter breed",
                birthNaturalMark: "Please enter birth natural mark",
                Gender: "Please enter gender",
                totalAnimal: {
                    required: "Please enter total number of animal.",
                    digits: "Please enter a valid number."
                },
                totalAnimalInsured: "Please enter total animal.",
                anyLoanTaken: "Please select loan.",
                nameOfBank: "Please enter name of bank.",
                individualFamily: "Please enter family.",
                loanRunning: "Please select loan running",
                accountNumberInput: "Please enter account number",
                accountNumber_saving_account: "Please enter saving account number.",
                accountHolder: "Please enter name of account holder.",
                ifscCode: "Please enter account ifsc code.",
                bankDetails: "Please enter bank details",
                diseaseDate: "Please select disease date.",
                animalDisposal: "Please enter animal disposal.",
                calvingDate: "Please select caliving date",
                pregnant: "Please select pregnancy",
                pmr: "Please enter pmr",
                dateTimePostMortem: "Please select date.",
                reason_of_death: "Please enter reason of death.",
                nameOfdoctor: "Please enter name of doctor.",
                doctorContactNumber: {
                    required: "Please enter contact number"
                },
                type_of_animal_as_per_pmr: "Please select type of animal",
                breedAsPerPMR: "Please enter breed as per pmr",
                ageOfAnimal: {
                    required: "Please enter the age of animal",
                },
                tagAsPerPMR: "Please enter tag as per pmr",
                milk_capacity: "Please enter  milk capacity.",
                clean_pmr: "Please enter clean pmr",
                causeOfDeathAsPerPMR: "Please enter cause of death as per pmr",
                causeOfDeathAsPerInsured: "Please enter cause of death as per insured",
                treatment_chart: "Please select treatment chart",
                treatmentDate: "Please select date of treatment chart",
                whoAdministeredTreatment: "Please enter who administered treatment ",
                administeredTreatment: "Please enter Treatment administered",
                satisfactory_and_sufficient: "Please enter the treatment administered seems to be satisfactory and sufficient",
                bankIOwnerAddress: "Please enter address of bank owner",
                physicalHealth: "Please enter physical health",
                gapsBetweenTreatment: "Please enter Gap Between treatments.",
                dateAndAmountOfPurchase: "Please enter  date & amount of Purchase of animal .",
                physicalHealthOfAnimal: "Please enter if animal was purchased, Date & amount of Purchase of animal.",
                anyDisavility: "Please enter Any Disavility/special marks observed in animal.",
                statement_of_insured: "Please enter statement of Insured",
                statement_of_villagers: "Please enter statement of Villagers",
                statement_of_two_authorized: "Please enter Statement of Two Authorized Person on Form.",
                observation_4: "This field is required.",
                observation_1: "This field is required.",
                observation_2: "This field is required.",
                observation_3: "This field is required.",
                observation_5: "This field is required.",
                observation_6: "This field is required.",
                observation_7: "This field is required.",
                observation_8: "This field is required.",
                observation_9: "This field is required.",
                policy_copy: "This field is required.",
                health_certificate: "This field is required.",
                claim_intimation_letter: "This field is required.",
                discharge_voucher: "This field is required.",
                account_number: "This field is required.",
                pmr_with_signature: "This field is required.",
                treatment_chart_option: "This field is required.",
                insured_statement: "This field is required.",
                claim_form_with_signature: "This field is required.",
                copy_of_adhar_card: "This field is required.",
                photo_of_dead: "This field is required.",
                investigator_report: "This field is required.",
                tag_available: "This field is required.",
                fir_attached: "This field is required.",
                vs_signature_on_pmr: "This field is required.",
                vs_stamp_on_pmr: "This field is required.",
                period_of_treatment_days: "This field is required.",
                signed_by_tehsildar: "This field is required.",
                signed_by_sarpanch: "This field is required.",
                tag_number_clear: "This field is required.",
                dead_animal_photo_attached: "This field is required.",
                tag_number_as_per_policy: "This field is required.",
                health_certificate_option: "This field is required.",
                pmr_option: "This field is required.",
            },
            errorPlacement: function(error, element) {
                if (element.closest(".input-group").length) {
                    // Append the error after the input-group
                    element.closest(".input-group").after(error);
                } else {
                    // Default placement
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                event.preventDefault(); // Prevent default button action

                // Get selected option text from physicalHealth select
                var selectedOptionText = $('select[id="physicalHealth"] option:selected').text();

                // Enable observation_6 select temporarily to get its value
                $('#observation_6').prop('disabled', false);
                var observation6OptionText = $('select[id="observation_6"] option:selected').val();
                $('#observation_6').prop('disabled', true);

                // Serialize form data
                var formData = $(form).serialize();
                var aid = "<?php echo $aid; ?>";
                formData += '&aid=' + encodeURIComponent(aid);
                formData += '&physicalHealthText=' + encodeURIComponent(selectedOptionText);
                formData += '&observation_6=' + encodeURIComponent(observation6OptionText);

                // AJAX request to updatecasedata endpoint
                $.ajax({
                    url: "<?php echo base_url('updatecattlecaseData') ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            $('#cattle_submit').val("Edit");
                            $(".case-field").prop("disabled", true);
                            scrollToNextForm("#caseForm"); // Assuming scrollToNextForm is defined elsewhere
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error as needed
                    }
                });
            }
        });




        /* ------------------------------------------------------------------------- *
         * ON CHANGE SATISFACTORY AND SUFFICIENT FILED ENABLE AND DISABLE INPUT FIELD (KAJAL)
         * ------------------------------------------------------------------------- */
        $('#satisfactory_and_sufficient').change(function() {
            var selectedValue = $(this).val();
            $('#observation_4').val(selectedValue);
        });

        /* ------------------------------------------------------------------------- *
         * ON CHANGE TAG TEMPERED FILED ENABLE AND DISABLE INPUT FIELD (KAJAL)
         * ------------------------------------------------------------------------- */
        $('#tag_tempered').change(function() {
            if ($(this).val() === 'Yes') {
                $('#observation_6').val('No').prop('disabled', true);
            } else if ($(this).val() === 'No') {
                $('#observation_6').val('Yes').prop('disabled', true);
            } else if ($(this).val() === 'NA') {
                $('#observation_6').prop('enable', true);

            }
        });



        /* ------------------------------------------------------------------------- *
         * SHARE CASE WITH USERS
         * ------------------------------------------------------------------------- */
        $('#sharecase').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            var aid = "<?php echo $aid; ?>";
            var mobile_no = $('#mobile_no').val();
            $.ajax({
                url: '<?php echo base_url('cases/sharecase'); ?>', // Specify the URL of your controller method
                type: 'post',
                data: {
                    mobile_no: mobile_no,
                    aid: aid
                },
                success: function(response) {
                    // Handle success response

                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });

        /* ------------------------------------------------------------------------- *
         * IMAGE VIEWER (KAJAL)
         * ------------------------------------------------------------------------- */
        $('[data-fancybox="images"]').fancybox({
            loop: true, // Enable looping through images
            buttons: [
                'slideShow',
                'thumbs',
                'rotateLeft', // Add custom rotateLeft button
                'rotateRight', // Add custom rotateRight button
                'close'
            ],
            animationEffect: "fade",
            transitionEffect: "slide",
            transitionDuration: 500, // Duration of the slide animation in milliseconds
            infobar: false, // Disable the bottom bar showing image count and caption
            arrows: true, // Enable navigation arrows
            clickContent: false, // Disable navigation by clicking the content
            clickSlide: false, // Disable navigation by clicking the slide

        });
        /* ------------------------------------------------------------------------- *
         * VIDEO PLAYER (KAJAL)
         * ------------------------------------------------------------------------- */
        function updateVideo(videoUrl) {
            $('#videoSource').attr('src', videoUrl);
            $('#videoPlayer').get(0).load();
        }

        // Click event for thumbnails(Created by Kajal)
        $('.thumbnail').click(function() {
            var videoUrl = $(this).data('video');
            updateVideo(videoUrl);
            $('#videoModal').modal('show');
        });

        /* ------------------------------------------------------------------------- *
         * CALCULATE DAYS BETWEEN PERIOD OF COVERAGE AND DATE OF DISEASE (KAJAL)
         * ------------------------------------------------------------------------- */
        $('.fa-exclamation-triangle').hide();

        function calculateDays() {
            var startDate = $('#periodOfCoverage').datepicker('getDate');
            var endDate = $('#dateOfDisease').datepicker('getDate');
            if (startDate && endDate) {
                // Adjust endDate to include the whole day
                endDate.setDate(endDate.getDate() + 1);

                var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                $('#days_between_policy_and_disease').val(diffDays);

                // Check if days between are 21 or fewer, then show the hazard symbol
                if (diffDays <= 21 || diffDays === 0) {
                    $('.fa-exclamation-triangle').show(); // Show the icon
                } else {
                    $('.fa-exclamation-triangle').hide(); // Hide the icon
                }
            } else {
                $('#days_between_policy_and_disease').val(''); // Clear the input field if either date is not selected
                $('.fa-exclamation-triangle').hide(); // Hide the icon if dates are not selected
            }
        }

        /* ------------------------------------------------------------------------- *
         * FIRST LETTER CAPITAL (KAJAL)
         * ------------------------------------------------------------------------- */
        // Function to capitalize the first letter of a string
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        // Event handler for input 
        $(' #insured_name, #consignor,#address,#state,#city,#firstname,#lastname,#guardian_name,#nameofowner,#district,#state,#marine_insured_name,#marine_consignor,#marine_consignee,#name_of_driver').on('input', function() {
            var currentVal = $(this).val();
            var newVal = capitalizeFirstLetter(currentVal);
            $(this).val(newVal);
        });

        function capitalizeAllLetters(string) {
            return string.toUpperCase();
        }
        $('#chasis_no,#engine_no,#permit_no,#authorization').on('input', function() {
            var currentVal = $(this).val();
            var newVal = capitalizeAllLetters(currentVal);
            $(this).val(newVal);
        });

        $('#vehicle_number').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });




        /* ------------------------------------------------------------------------- *
         * ON CHANGE TAG TEMPERED FILED ENABLE AND DISABLE INPUT FIELD (KAJAL)
         * ------------------------------------------------------------------------- */
        $('#tag_tempered').change(function() {
            if ($(this).val() === 'Yes') {
                $('#observation_6').val('No').prop('disabled', true);
            } else if ($(this).val() === 'No') {
                $('#observation_6').val('Yes').prop('disabled', true);
            }
        });

        /* ------------------------------------------------------------------------- *
         * SHARE CASE WITH USERS
         * ------------------------------------------------------------------------- */
        $('#sharecase').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            var aid = "<?php echo $aid; ?>";
            var mobile_no = $('#mobile_no').val();
            $.ajax({
                url: '<?php echo base_url('cases/sharecase'); ?>', // Specify the URL of your controller method
                type: 'post',
                data: {
                    mobile_no: mobile_no,
                    aid: aid
                },
                success: function(response) {
                    // Handle success response

                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });

        /* ------------------------------------------------------------------------- *
         * IMAGE VIEWER (KAJAL)
         * ------------------------------------------------------------------------- */
        $('[data-fancybox="images"]').fancybox({
            loop: true, // Enable looping through images
            buttons: [
                'slideShow',
                'thumbs',
                'rotateLeft', // Add custom rotateLeft button
                'rotateRight', // Add custom rotateRight button
                'close'
            ],
            animationEffect: "fade",
            transitionEffect: "slide",
            transitionDuration: 500, // Duration of the slide animation in milliseconds
            infobar: false, // Disable the bottom bar showing image count and caption
            arrows: true, // Enable navigation arrows
            clickContent: false, // Disable navigation by clicking the content
            clickSlide: false, // Disable navigation by clicking the slide

        });
        /* ------------------------------------------------------------------------- *
         * VIDEO PLAYER (KAJAL)
         * ------------------------------------------------------------------------- */
        function updateVideo(videoUrl) {
            $('#videoSource').attr('src', videoUrl);
            $('#videoPlayer').get(0).load();
        }

        // Click event for thumbnails(Created by Kajal)
        $('.thumbnail').click(function() {
            var videoUrl = $(this).data('video');
            updateVideo(videoUrl);
            $('#videoModal').modal('show');
        });

        /* ------------------------------------------------------------------------- *
         * CALCULATE DAYS BETWEEN PERIOD OF COVERAGE AND DATE OF DISEASE (KAJAL)
         * ------------------------------------------------------------------------- */
        $('.fa-exclamation-triangle').hide();

        function calculateDays() {
            var startDate = $('#periodOfCoverage').datepicker('getDate');
            var endDate = $('#dateOfDisease').datepicker('getDate');
            if (startDate && endDate) {
                // Adjust endDate to include the whole day
                endDate.setDate(endDate.getDate() + 1);

                var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                $('#days_between_policy_and_disease').val(diffDays);

                // Check if days between are 21 or fewer, then show the hazard symbol
                if (diffDays <= 21 || diffDays === 0) {
                    $('.fa-exclamation-triangle').show(); // Show the icon
                } else {
                    $('.fa-exclamation-triangle').hide(); // Hide the icon
                }
            } else {
                $('#days_between_policy_and_disease').val(''); // Clear the input field if either date is not selected
                $('.fa-exclamation-triangle').hide(); // Hide the icon if dates are not selected
            }
        }


        /* ------------------------------------------------------------------------- *
         * DATE PICKER VALIDATION (KAJAL)
         * ------------------------------------------------------------------------- */
        $('#periodOfCoverage,#dateOfDeath,#dateOfSurvey,#dateOfDisease').datepicker({
            dateFormat: 'dd-mm-yy', // Set the date format as desired
            minDate: null,
            maxDate: 0, // Allow selection of all past dates initially
            onSelect: function(selectedDate, instance) {
                switch (instance.id) {
                    case 'periodOfCoverage':
                        $('#dateOfDisease').datepicker('option', 'minDate', selectedDate);
                        break;
                    case 'dateOfDisease':
                        $('#periodOfCoverage').datepicker('option', 'maxDate', selectedDate);
                        $('#dateOfDeath').datepicker('option', 'minDate', selectedDate);
                        $('#dateOfSurvey').datepicker('option', 'minDate', selectedDate);
                        break;
                    case 'dateOfDeath':
                        $('#dateOfDisease').datepicker('option', 'maxDate', selectedDate);
                        $('#dateOfSurvey').datepicker('option', 'minDate', selectedDate);
                        break;
                    case 'dateOfSurvey':
                        $('#dateOfDeath').datepicker('option', 'maxDate', selectedDate);
                        break;

                }
                calculateDays(); // Calculate days between selected dates if needed
                checkSurveyConducted(); // Check survey conducted if needed
            }
        });

        $(' #by_the_complainant,#date_of_theft,#fir_date,#intimation_date,.registration_date, .valid_up_to, .date_of_birth, .docs_validity, #date_of_theft,#date_intimation,#valid_up_to,#date_of_issue,#permit_date_of_issue,.grdate,.invoicedate, #survey_date,#loss_data,#consignment_date,.select_survey_date,.date_of_accident, .property_survey_date, .date_of_loss, #date_of_report, .date_of_report, #date_of_incident,#fir_date,#dateOfDisease,#report_date,#family_id,#health_issuance_date,#diseaseDate,#treatmentDate,#dateTimePostMortem, #dateTimePostMortem,.period_of_insurancemotor_final_essential_data, .appointment_date,.appointmentdate,#accident_date,#death_date,.policyNumberfrom,.policyNumberto').datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1900:+10',
            defaultDate: new Date(), // sets default date in the picker popup
            onSelect: function(selectedDate, instance) {}
        });

        $('.insuranceto, .insurancefrom,.permit_validity,.fitness_date,.survey_allotment_date').datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            yearRange: '1900:+10',
            minDate: null,
            maxDate: '+10Y',
            onSelect: function(selectedDate, instance) {
                // Custom actions after a date is selected
            }
        });



        $('#toggleManualEntry').on('click', function() {
            Swal.fire({
                title: 'Enter Value',
                input: 'text',
                inputValue: '',
                inputPlaceholder: 'Enter any value',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    const inputValue = result.value.trim();
                    $('#loss_date_text').val(inputValue); // Save value in the hidden input
                    $('.loss_date_text').text(inputValue); // Display value in the visible div
                }
            });
        });


        /* ------------------------------------------------------------------------- *
         * CHECK SURVEY CONDUCTED AT SAME DAY OR NOT (KAJAL)
         * ------------------------------------------------------------------------- */
        function checkSurveyConducted() {
            var deathDate = $('#dateOfDeath').datepicker('getDate');
            var surveyDate = $('#dateOfSurvey').datepicker('getDate');

            if (deathDate != null && surveyDate != null) {
                if (deathDate.getTime() === surveyDate.getTime()) {
                    // Dates are the same, set "Yes" and disable the select
                    $('#SurveyConducted').val('Yes').prop('disabled', true);
                    // Hide the reason input field
                    $('#whysurveyNotcon').css('display', 'none');
                    $('#whysurveyNotcon').val('NA').prop('disabled', true);

                } else {
                    // Dates are different, set "No" and disable the select
                    $('#SurveyConducted').val('No').prop('disabled', true);
                    // Show the reason input field
                    $('#whysurveyNotcon').val('NA').prop('disabled', true);
                    $('#whysurveyNotcon').css('display', 'block');
                }
            }
        }

        // Listen for changes on the PMR select field
        $('#pmr').change(function() {
            // Get the selected text of PMR
            toggleAdditionalFields($(this).find("option:selected").text());
        });

        // Function to show or hide additional fields based on PMR text value
        function toggleAdditionalFields(value) {
            if (value === 'Yes') {
                // Show additional fields if PMR is Yes
                $('.additional_field').show();
            } else {
                // Hide additional fields if PMR is not Yes
                $('.additional_field').hide();
            }
        }

        // Initial check in case the page is loaded with a pre-selected value
        treatmenteFields($('#treatment_chart option:selected').text());


        $('#treatment_chart').change(function() {
            // Get the selected text of PMR
            treatmenteFields($(this).find("option:selected").text());
        });

        // Function to show or hide additional fields based on PMR text value
        function treatmenteFields(value) {
            if (value === 'Yes') {
                // Show additional fields if PMR is Yes
                $('.basedontreatment').show();
            } else {
                // Hide additional fields if PMR is not Yes
                $('.basedontreatment').hide();
            }
        }

        // Initial check in case the page is loaded with a pre-selected value
        toggleAdditionalFields($('#pmr option:selected').text());



        /* ------------------------------------------------------------------------- *
         * CREATE TIME SELECTION BOX (KAJAL)
         * ------------------------------------------------------------------------- */
        $('#time_of_accident, #timeOfDeath,#pmr_time,#accident_time,#time_of_incident,#time_intimation,#time_by_the_complainant,.insurancetotime,.insurancefromtime').timepicker({
            timeFormat: 'h:mm p', // Display time in 12-hour format with AM/PM
            interval: 60,
            minTime: '10:00 AM', // Set the minimum time to 10:00 AM
            maxTime: '9:00 PM', // Set the maximum time to 9:00 PM
            defaultTime: '00 AM', // Set the default time to 10:00 AM
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            onChangeTime: function(selectedTime) {
                // Set the minTime of Time of Survey to the selected time of Time of Death
                $('#timeOfSurvey').timepicker('option', 'minTime', selectedTime);
                // Disable all times before the selected time of Time of Death in Time of Survey
                var allInputs = $('.editable-field');
                var selectedInput = $('#timeOfSurvey');
                var selectedTimeIndex = allInputs.index(selectedInput);
                allInputs.each(function(index) {
                    if (index < selectedTimeIndex) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
            }
        });

        // Initialize timepicker for Time of Survey
        $('#timeOfSurvey').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10:00 AM',
            maxTime: '9:00 PM',
            defaultTime: '00 AM',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        // Click event for carousel previous button(Created by Kajal)
        $('#videoModal').on('click', '.carousel-control-prev', function(e) {
            e.preventDefault(); // Prevent default carousel behavior
            var currentIndex = $('.thumbnail.active').index();
            var prevIndex = (currentIndex - 1 + $('.thumbnail').length) % $('.thumbnail').length; // Handle negative index
            var videoUrl = $('.thumbnail').eq(prevIndex).data('video');
            updateVideo(videoUrl);
            $('.thumbnail').eq(prevIndex).addClass('active').siblings().removeClass('active');
        });

        // Click event for carousel next button(Created by Kajal)
        $('#videoModal').on('click', '.carousel-control-next', function() {
            var currentIndex = $('.thumbnail.active').index();
            var nextIndex = (currentIndex + 1) % $('.thumbnail').length;
            var videoUrl = $('.thumbnail').eq(nextIndex).data('video');
            updateVideo(videoUrl);
            $('.thumbnail').eq(nextIndex).addClass('active').siblings().removeClass('active');
        });

        // Click event for pause video 
        $(document).on('click', function(e) {
            if ($(e.target).closest('.modal').length === 0) {
                $('#videoPlayer').trigger('pause');
            }
        });
        // Close video player
        $('#customCloseButton').click(function() {
            $('#videoModal').modal('hide');
        });


        $('#select_images').on('shown.bs.modal', function() {
            $('.image-checkbox').prop('checked', false).attr('disabled', false);
        });

        var selectedImages = [];
        var selectedCount = 0;

        const selectCounts = {
            "Photo ILA": 2,
            "Report": 2,
            "Photo Sheet": 8
        };

        $('.image-checkbox').change(function() {
            var title = $('#imageModalLabel').text();
            selectedCount = $('.image-checkbox:checked').length;

            if (selectCounts[title]) {
                if (selectedCount >= selectCounts[title]) {
                    $('.image-checkbox').not(':checked').attr('disabled', true);
                } else {
                    $('.image-checkbox').not(':checked').attr('disabled', false);
                }
            }

            selectedImages = $('.image-checkbox:checked').map(function() {
                return this.value;
            }).get();
        });

        //  $('#images').on('change', function() {
        //     var files = this.files;
        //     var formData = new FormData();
        //     var aid = "<?php echo $aid; ?>";

        //     $.each(files, function(i, file) {
        //         formData.append('images[]', file);
        //     });

        //     formData.append('aid', aid);
        //     formData.append('filetype', "images");

        //     $('#progressModal').modal('show');

        //     $.ajax({
        //         url: '<?php echo base_url('cases/uploadimages'); ?>',
        //         type: 'POST',
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         dataType: 'json',
        //         xhr: function() {
        //             var xhr = new XMLHttpRequest();
        //             xhr.upload.addEventListener('progress', function(e) {
        //                 if (e.lengthComputable) {
        //                     var percentComplete = Math.round((e.loaded / e.total) * 100);
        //                     $('#progressBar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete).text(percentComplete + '%');
        //                 }
        //             });
        //             return xhr;
        //         },
        //         success: function(response) {
        //             if (response.status == 200) {
        //                 location.reload(); // Refresh page to update gallery
        //             } else {
        //                 alert(response.message || 'Upload failed.');
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Upload failed.', error);
        //         },
        //         complete: function() {
        //             $('#progressModal').modal('hide');
        //         }
        //     });
        // });

        $('#saveImages').click(function() {
            var title = $('#imageModalLabel').text();
            var aid = "<?php echo $aid; ?>";
            // Check if the required number of images are selected
            if (selectCounts[title] && selectedCount === 0) {
                $('#error-message').text(`Select ${selectCounts[title]} images for ${title}`).show();
                return;
            }
            // Show loading indicator
            $('#loading-indicator').show();

            // Send the selected images to the server using AJAX
            $.ajax({
                url: '<?php echo base_url('cases/updateimages'); ?>',
                type: 'POST',
                data: {
                    images: selectedImages,
                    title: title,
                    aid: aid
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#loading-indicator').hide();
                    try {
                        if (response.status === 200) {
                            $("#select_images").modal('hide');
                        } else {
                            $('#error-message').text(response.message).show();
                        }
                    } catch (e) {
                        console.error("JSON Parse Error:", e);
                        $('#error-message').text("Invalid response format").show();
                    }
                }
            });
        });

        $(document).ready(function() {
            // Function to convert numbers to words (Indian format)
            function numberToWordsIndian(num) {
                const ones = [
                    '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
                    'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen',
                    'Seventeen', 'Eighteen', 'Nineteen'
                ];
                const tens = [
                    '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'
                ];
                const places = ['', 'Thousand', 'Lakh', 'Crore'];

                if (num === 0) return 'Zero';

                let words = '';
                let placeIndex = 0;

                // Helper function for numbers < 1000
                function helper(num) {
                    let str = '';
                    if (num >= 100) {
                        str += ones[Math.floor(num / 100)] + ' Hundred ';
                        num %= 100;
                    }
                    if (num >= 20) {
                        str += tens[Math.floor(num / 10)] + ' ';
                        num %= 10;
                    }
                    if (num > 0) {
                        str += ones[num] + ' ';
                    }
                    return str.trim();
                }

                // Handle numbers in chunks (last 3 digits first, then 2-digit groups)
                while (num > 0) {
                    let chunk;
                    if (placeIndex === 0) {
                        chunk = num % 1000; // Process the last three digits
                        num = Math.floor(num / 1000);
                    } else {
                        chunk = num % 100; // Process the next two digits
                        num = Math.floor(num / 100);
                    }

                    if (chunk > 0) {
                        words = helper(chunk) + ' ' + places[placeIndex] + ' ' + words;
                    }
                    placeIndex++;
                }

                return words.trim();
            }

            // Convert decimal part to words
            function convertDecimalToWords(decimal) {
                const ones = [
                    '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'
                ];
                let decimalWords = '';
                for (let digit of decimal) {
                    decimalWords += ones[parseInt(digit)] + ' ';
                }
                return decimalWords.trim();
            }

            // For #estimated_loss_per_ila input
            $("#estimated_loss_per_ila").on("input", function() {
                let rawValue = $(this).val().replace(/,/g, ''); // Remove commas
                if (!rawValue) {
                    $(".number-in-words").text(""); // Clear output if input is empty
                    return;
                }
                let [integerPart, decimalPart] = rawValue.split('.'); // Split into integer and decimal
                let num = parseInt(integerPart, 10); // Convert the integer part to a number

                if (!isNaN(num)) {
                    let words = numberToWordsIndian(num); // Convert integer part to words
                    if (decimalPart) {
                        let decimalWords = convertDecimalToWords(decimalPart); // Convert decimal part to words
                        words += ` and ${decimalWords} Paise`;
                    }
                    $(".number-in-words").text(words); // Update the words display
                } else {
                    $(".number-in-words").text(""); // Clear the display if input is invalid
                }
            });
            // $('input[name="salvage_amount"]').off('input').on('input', function() {
            //     let value = $(this).val().replace(/[^0-9]/g, ''); 
            //     value = formatnumber((value / 100).toFixed(2)); 
            //     $(this).val(value);
            // });



            // Preview selected images
            $("#fileUpload").on("change", function() {
                $("#imagePreview").html(""); // Clear previous images
                let files = this.files;
                if (files.length > 0) {
                    $.each(files, function(index, file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $("#imagePreview").append(`
                            <div class="preview-img-container">
                                <img src="${e.target.result}" class="preview-img" alt="Selected Image" style="width:20%;height:auto;max-width:20%;">
                            </div>
                        `);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            });

            // Save Statement with Images
            $("#saveSpecialInfo").click(function() {
                let text = $("#specialInfoText").val().trim();
                let files = $("#fileUpload")[0].files;

                if (text === "") {
                    alert("Please enter a statement before saving.");
                    return;
                }

                let imageHTML = "";
                if (files.length > 0) {
                    $.each(files, function(index, file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            imageHTML += `
                            <div class="image-container" style:"display:flex">
                                <img src="${e.target.result}" class="statement-img" alt="Uploaded Image" style="width:20%;height:auto;max-width:20%;">
                            </div>
                        `;
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    imageHTML = "<p><strong>No images attached</strong></p>";
                }

                // Delay appending the statement until images are loaded
                setTimeout(() => {
                    let statementHTML = `
                    <div class="card mt-2">
                        <div class="card-body">
                            <p>${text}</p>
                            <div class="image-list">${imageHTML}</div>
                            <button class="btn btn-danger btn-sm deleteStatement">Delete</button>
                        </div>
                    </div>
                `;

                    $("#statementsList").append(statementHTML);

                    // Clear input fields
                    $("#specialInfoText").val("");
                    $("#fileUpload").val("");
                    $("#imagePreview").html(""); // Clear preview images

                    // Close modal
                    $("#specialInfoModal").modal("hide");
                }, 500);
            });

            // Delete Statement
            $("#statementsList").on("click", ".deleteStatement", function() {
                $(this).closest(".card").remove();
            });

            let annexureCount = 1;

            $("#addAnnexure").click(function() {
                annexureCount++;
                let newAnnexure = `
            <div class="row mt-2">
             <div class="col-xl-12 col-md-12">
                <div class="form-group">
                    <div class="d-flex">
                        <input type="text" class="form-control case-field annexure-input" 
                            name="conclusion[]" placeholder="Annexure ${annexureCount}">
                        <button type="button" class="btn btn-danger ml-2 removeAnnexure">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div
            </div>`;
                $("#annexureContainer").append(newAnnexure);
            });

            // Remove Annexure
            $(document).on("click", ".removeAnnexure", function() {
                $(this).closest(".row").remove();
            });

            function initializeDatepicker(buttonSelector, inputSelector) {
                $(document).on("click", buttonSelector, function(e) {
                    e.preventDefault();

                    // Initialize datepicker when clicking the button
                    $(inputSelector).datepicker({
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                        autoclose: true
                    }).datepicker("show");
                });

                // Allow manual typing in input field
                $(document).on("focus", inputSelector, function() {
                    $(this).off("focus"); // Prevent automatic reopening of datepicker
                });

                // Keep manually typed or selected date without reopening the datepicker
                $(document).on("change", inputSelector, function() {
                    let selectedDate = $(this).val();
                    $(this).val(selectedDate);
                });
            }
            initializeDatepicker(".fir_datebtn", ".fir_date");
            initializeDatepicker(".fir_datebtn", ".fir_date");
            initializeDatepicker(".register_datebtn", ".register_date");
            initializeDatepicker(".ofinstruction_btn", ".ofinstruction");
            initializeDatepicker(".permit_validity_btn", ".permitvalidity");
            initializeDatepicker(".authorization_from_btn", ".authorization_from");
            initializeDatepicker(".autharity_validity_btn", ".autharity_validity");
            initializeDatepicker(".pucdatebtn", ".pucdate");
            initializeDatepicker(".dateofsurveybtn", ".date_of_survey");
            initializeDatepicker(".dl_issuedatebtn", ".dl_issuedate");
            initializeDatepicker(".dlvaliditybtn", ".dlvalidity");
            initializeDatepicker(".dobbtn", ".dob");
            initializeDatepicker(".policy_number_to_btn", ".policy_number_to");
            initializeDatepicker(".policy_number_from_btn", ".policy_number_from");
            initializeDatepicker(".visit_date_btn", ".visit_date");
            initializeDatepicker(".permit_validity_from_btn", ".permit_validity_from");
            initializeDatepicker(".bol_date_btn", ".bol_date");
            initializeDatepicker(".be_date_btn", ".be_date");
            initializeDatepicker(".dispatch_date_btn", ".dispatch_date");
            initializeDatepicker(".reciept_date_btn", ".reciept_date");
            initializeDatepicker(".expected_dispatch_btn", ".expected_dispatch");
            initializeDatepicker(".report_date_btn", ".dateofreport");
        });

        function updateSerialNumbers() {
            let counter = 1;
            $('#assessmentTable tbody tr.assessment_row').each(function() {
                $(this).find('td.serial').text(counter);
                counter++;
            });
        }



        /* ------------------------------------------------------------------------- *
         * Motor Assessment 
         * ------------------------------------------------------------------------- */

        /**
         *  Add Row
         */

        let assessmentCount = 0;

        function addNewAssessment() {
            const partsFromData = getassessmentdata.parts || [];
            const otherPartsFromData = getassessmentdata.other_parts || [];
            const dpnFromData = getassessmentdata.dpn || [];
            const formOptions = new Map();

            // Collect parts from form input
            $('#partsContainer .form-group.row').each(function() {
                const partSelect = $(this).find('select[name="parts[]"]').val();
                const otherInput = $(this).find('input[name="other_parts[]"]').val().trim();
                const dpnInputRaw = $(this).find('input[name="dpn[]"]').val();
                const dpnInput = dpnInputRaw !== undefined && dpnInputRaw !== null && dpnInputRaw.trim() !== '' ? dpnInputRaw.trim() : null;

                if (dpnInput !== null) {
                    if (partSelect === 'others' && otherInput !== '') {
                        const key = `${otherInput} @ ${dpnInput}`;
                        const label = `${capitalize(otherInput)} @ ${dpnInput}%`;
                        formOptions.set(key, label);
                    } else if (partSelect && partSelect.trim() !== '') {
                        const key = `${partSelect} @ ${dpnInput}`;
                        const label = `${capitalize(partSelect)} @ ${dpnInput}%`;
                        formOptions.set(key, label);
                    }
                }
            });

            // Merge parts from backend data (if any)
            (partsFromData || []).forEach((part, index) => {
                const dpnRaw = dpnFromData[index];
                const dpnVal = dpnRaw !== undefined && dpnRaw !== null && dpnRaw.toString().trim() !== '' ? dpnRaw.toString().trim() : null;

                if (dpnVal !== null && part && part.trim() !== '') {
                    if (part.toLowerCase() === 'others' && otherPartsFromData[index]) {
                        const other = otherPartsFromData[index];
                        if (other && other.trim() !== '') {
                            const key = `${other} @ ${dpnVal}`;
                            const label = `${capitalize(other)} @ ${dpnVal}%`;
                            if (!formOptions.has(key)) formOptions.set(key, label);
                        }
                    } else {
                        const key = `${part} @ ${dpnVal}`;
                        const label = `${capitalize(part)} @ ${dpnVal}%`;
                        if (!formOptions.has(key)) formOptions.set(key, label);
                    }
                }
            });

            // Build dynamic select options
            let dynamicOptions = '';
            for (const [val, label] of formOptions.entries()) {
                dynamicOptions += `<option value="${val}">${label}</option>`;
            }

            const salvageExists = $('#assessmentTable th.salvage').length > 0 || $('input[name="radio02"]:checked').val() === "1";

            // Create and append new row
            const newRow = $(`
                <tr class="assessment_row">
                    <td class="serial">${$('#assessmentTable tbody tr.assessment_row').length + 1}</td>
                    <td>
                        <select name="type_particulars[]" class="typeSelector type_particulars">
                            <option value="parts">Parts</option>
                            <option value="labour">Labour</option>
                        </select>
                        <select name="type_parts[]" class="dynamicOptions type_parts">
                            ${dynamicOptions}
                        </select>
                    </td>
                    <td contenteditable="true" class="particularsname"></td>
                    <td contenteditable="true" class="estimate">0</td>
                    <td contenteditable="true" class="billNo">0</td>
                    <td contenteditable="true" class="amount">0</td>
                    <td contenteditable="true" class="gst">0</td>
                    <td contenteditable="true" class="assessment">0</td>
                    ${salvageExists ? '<td class="salvage" contenteditable="true">0</td>' : ''}
                    <td class="remove-cell"><button type="button" class="removeRowBtn" style="color:red; font-weight:bold; border:none; background:transparent;">✖</button></td>
                </tr>
            `);

            $('#assessmentTable tbody').append(newRow);
            updateSerialNumbers();
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function updateAssessment() {
            const formOptions = new Map();

            // Step 1: Extract updated options from modal
            $('#partsContainer .form-group.row').each(function() {
                const partInput = $(this).find('input[name="parts[]"]').val()?.trim();
                const otherInput = $(this).find('input[name="other_parts[]"]').val()?.trim();
                const dpnInput = $(this).find('input[name="dpn[]"]').val()?.trim() || '0';

                const partType = (partInput === 'others' && otherInput) ? otherInput : partInput;
                if (!partType) return;

                const key = partType.toLowerCase(); // e.g., 'imt'
                const label = `${capitalize(partType)} @ ${dpnInput}%`;
                formOptions.set(key, label);
            });

            // Step 2: Update each select box in the table
            $('#assessmentTable tbody tr.assessment_row').each(function() {
                const $select = $(this).find('select.type_parts');
                const currentValue = $select.val(); // e.g., 'IMT @ 98%'

                let selectedKey = '';
                if (currentValue && currentValue.includes('@')) {
                    selectedKey = currentValue.split('@')[0].trim().toLowerCase(); // e.g., 'imt'
                }

                // Build new options HTML
                let optionsHtml = '';
                for (const [key, label] of formOptions.entries()) {
                    optionsHtml += `<option value="${label}" ${selectedKey === key ? 'selected' : ''}>${label}</option>`;
                }

                $select.html(optionsHtml);
            });

            autoSaveTable();
            updateSerialNumbers(); // Update serial numbers after update
        }




        function calculateTotal() {
            let totalAmount = 0,
                totalSalvage = 0;
            $('#assessmentTable tbody tr').each(function() {
                totalAmount += parseFloat($(this).find('td:eq(2)').text()) || 0;
                if ($(".salvage-col").is(":visible")) {
                    totalSalvage += parseFloat($(this).find('td:eq(3)').text()) || 0;
                }
            });
            $('#totalAmount').text(totalAmount);
            $('#totalSalvage').text(totalSalvage);
        }

        function showTable() {
            $('a[onclick="addAssesmentRow()"]').css('opacity', '1').prop('disabled', false);
            $('.panel-body').show();
        }

        function addSalvageCol(radio) {
            const $thead = $('#assessmentTable thead');
            const $tbody = $('#assessmentTable tbody');

            // Check if "Salvage" column exists
            let $salvageHeader = $thead.find('th.salvage');
            const salvageExists = $salvageHeader.length > 0;

            if (!salvageExists) {
                // Find index before the last th (assumes last one is for the ✖ button)
                const $headerCells = $thead.find('tr').children('th');
                const removeIndex = $headerCells.length - 1;

                // Add "Salvage" header before remove (✖) column
                $('<th class="salvage" style="font-size:13px;">Salvage</th>').insertBefore($headerCells.eq(removeIndex));

                // For each body row, insert salvage td before last td
                $tbody.find('tr').each(function() {
                    const $cells = $(this).children('td');
                    const removeCellIndex = $cells.length - 1;
                    $('<td class="salvage" contenteditable="true" style="font-size:13px;">0</td>').insertBefore($cells.eq(removeCellIndex));
                });

                // Update reference after inserting
                $salvageHeader = $thead.find('th.salvage');
            }

            // Show/hide logic
            if (radio.value === "1") {
                $salvageHeader.show();
                $tbody.find('td.salvage').show();
            } else if (radio.value === "2") {
                $salvageHeader.hide();
                $tbody.find('td.salvage').hide();
            }
        }



        let rowsCount = 0;

        function addMoreParts() {
            const count = $('#partsContainer .form-group.row').length + 1;
            const newRow = `
            <div class="form-group row ">
                <span class="label-text col-lg-3 col-form-label">Type of parts ${count}</span>
                <div class="col-lg-5 particularselection">
                <select class="form-control parts-select option dynamicSelect" name="parts[]">
                    <option value="Metal" data-dpn="50">Metal</option>
                    <option value="Rubber" data-dpn="40">Rubber</option>
                    <option value="Glass" data-dpn="30">Glass</option>
                    <option value="IMT" data-dpn="10">IMT</option>
                    <option value="Composite / Fiber" data-dpn="20">Composite / Fiber</option>
                    <option value="Second Hand" data-dpn="60">Second Hand</option>
                    <option value="others" data-dpn="0">Others</option>
                </select>
                </div>
                <div class="col-lg-2 othersBox  py-0 px-0" style="display:none">
                  <input type="text" name="other_parts[]" placeholder="Enter other part type" class="form-control  custom-other-input" >
                </div>
                    
                <div class="col-lg-2 "  >
                <input type="text" name="dpn[]" placeholder="Dpn" class="form-control dpn" >
                </div>
                <div class="col-lg-1" style="align-self:center">
                <button type="button" onclick="removeInvoice(this)" class="btn btn-warning"><i class="fa fa-times"></i></button>
                </div>
            </div>`;
            $('#partsContainer').append(newRow);
        }

        let getassessmentdata = <?= json_encode($getassessmentdata ?? []); ?>;

        if (Object.keys(getassessmentdata).length > 0) {
            $('#assessmentcard').show();
        }


        // Open modal and populate form
        function openAssessmentModal() {
            const container = $('#partsContainer');
            container.empty();

            if (getassessmentdata.parts && getassessmentdata.parts.length > 0) {
                getassessmentdata.parts.forEach((part, index) => {
                    const dpnValue = getassessmentdata.dpn?.[index] ?? '';
                    const otherPartValue = getassessmentdata.other_parts?.[index] ?? '';
                    const isOthers = part === "others";

                    const showAddButton = index === getassessmentdata.parts.length - 1;

                    const html = `
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Type of parts ${index + 1}</label>
                  <div class="${isOthers ? 'col-lg-3' : 'col-lg-5'} particularselection" readonly>
                    <select class="form-control option dynamicSelect" disabled>
                      <option value="Metal" ${part === "Metal" ? "selected" : ""}>Metal</option>
                      <option value="Rubber" ${part === "Rubber" ? "selected" : ""}>Rubber</option>
                      <option value="Glass" ${part === "Glass" ? "selected" : ""}>Glass</option>
                      <option value="IMT" ${part === "IMT" ? "selected" : ""}>IMT</option>
                      <option value="Composite / Fiber" ${part === "Composite / Fiber" ? "selected" : ""}>Composite / Fiber</option>
                      <option value="Second Hand" ${part === "Second Hand" ? "selected" : ""}>Second Hand</option>
                      <option value="others" ${isOthers ? "selected" : ""}>Others</option>
                    </select>
                    <input type="hidden" name="parts[]" value="${part}">
                  </div>

                  ${(isOthers || otherPartValue)
                    ? `<div class="col-lg-2 othersBox" style="display:block">
                         <input type="text" name="other_parts[]" value="${otherPartValue}" class="form-control custom-other-input" placeholder="Enter other part type" readonly>
                       </div>`
                    : `<div class="col-lg-2 othersBox" style="display:none">
                         <input type="text" name="other_parts[]" value="" class="form-control custom-other-input" placeholder="Enter other part type" readonly>
                       </div>`
                  }

                  <div class="col-lg-2">
                    <input type="text" name="dpn[]" class="form-control" data-part="${part}" value="${dpnValue}" placeholder="DPN">
                  </div>

                  ${showAddButton ? `
                  <div class="col-lg-1" style="align-self:center">
                    <button type="button" onclick="addMoreParts()" class="btn btn-rounded btn-success">
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>` : ''}
                </div>`;

                    container.append(html);
                });

            }

            // Set and lock other inputs
            $('input[name="radio02"][value="' + getassessmentdata.radio02 + '"]').prop("checked", true);
            $('input[name="radio02"]').prop("readonly", true);
            $('input[name="lumpsum_value"]').val(getassessmentdata.lumpsum_value);
            $('input[name="towing_estimated"]').val(getassessmentdata.towing_estimated);
            $('input[name="towing_allowed"]').val(getassessmentdata.towing_allowed);
            $('select[name="nil_dep"]').val(getassessmentdata.nil_dep);
            $('input[name="imposed_excess"]').val(getassessmentdata.imposed_excess);
            $('input[name="normal_excess"]').val(getassessmentdata.normal_excess);

            toggleLumpsum($('input[name="radio02"]:checked')[0]);
            $('#addAssessment').modal('show');
        }


        // Toggle Lumpsum field
        function toggleLumpsum(radio) {
            if (radio.value === "2") {
                $('#lumpsumField').show();
            } else {
                $('#lumpsumField').hide();
            }
        }

        function addAssesmentRow() {
            const salvageVisible = $("#salvageType").val() === 'parts_wise';
            const salvageCell = salvageVisible ? '<td contenteditable="true">0</td>' : '';
            addNewAssessment();
            calculateTotal();
            autoSaveTable();
        }

        function autoSaveTable() {

            updateSerialNumbers();
            // Fix selected attribute on <select> elements so outerHTML captures correct selected option
            $('#assessmentTable select').each(function() {
                var selectedVal = $(this).val();
                $(this).find('option').each(function() {
                    if ($(this).val() === selectedVal) {
                        $(this).attr('selected', 'selected');
                    } else {
                        $(this).removeAttr('selected');
                    }
                });
            });

            // Get the full outer HTML of the table including current contenteditable values
            var tableHTML = $('#assessmentTable')[0].outerHTML;

            var aid = '<?= $aid ?>'; // set dynamically or retrieve from hidden field

            $.ajax({
                url: '<?= base_url('assignment/save_table_data'); ?>',
                type: 'POST',
                data: {
                    table_html: tableHTML,
                    aid: aid
                },
                success: function() {
                    console.log("Table saved");
                },
                error: function() {
                    console.log("Save failed");
                }
            });

        }



        $(document).ready(function() {

            $(document).on('click', '.removeRowBtn', function() {
                $(this).closest('tr').remove();
                updateSerialNumbers();
                autoSaveTable();
            });


            $(document).on('input', '.dpn-input', function() {
                const newDpn = $(this).val();
                const partType = $(this).data('part');

                if (partType) {
                    const newLabel = `${partType} @ ${newDpn}%`;

                    // Update modal select options
                    $('#partsContainer select').each(function() {
                        const value = $(this).val();
                        if (value.startsWith(partType)) {
                            $(this).val(newLabel);
                            $(this).find('option').remove();
                            $(this).append(`<option value="${newLabel}" selected>${newLabel}</option>`);
                        }
                    });

                    // Update table select options
                    $('#assessmentTable .type_parts').each(function() {
                        const selected = $(this).val();
                        if (selected.startsWith(partType)) {
                            $(this).val(newLabel);
                            $(this).find('option').remove();
                            $(this).append(`<option value="${newLabel}" selected>${newLabel}</option>`);
                        }
                    });
                }
            });


            // Trigger modal on edit icon
            $(document).on('click', '#editAssessmentBtn', function() {
                $('.form_mode').val('edit'); // Set form_mode to "edit"
                var form_mode = $('.form_mode').val();
                openAssessmentModal();
            });



            // Simulate radio02 setting (show/hide Salvage column)
            if (getassessmentdata.radio02 === "1") {
                addSalvageCol({
                    value: "1"
                });
            } else {
                addSalvageCol({
                    value: "2"
                });
            }

            // Show table only if parts data exists
            if (Array.isArray(getassessmentdata.parts) && getassessmentdata.parts.length > 0) {
                $('#assessmentTable').show();

                if ($('#assessmentTable tbody tr').length === 0) {
                    addNewAssessment();

                }

                const $addRowBtn = $('a[onclick="addAssesmentRow()"]');
                $addRowBtn.css('opacity', '1').removeAttr('disabled');
            }

            // Change event handler for dynamic select boxes
            $('#partsContainer').on('change', '.dynamicSelect', function() {
                var selected = $(this).val();
                var row = $(this).closest('.form-group');

                if (selected === 'others') {
                    row.find('.othersBox').show();
                    row.find('.particularselection')
                        .removeClass('col-lg-5')
                        .addClass('col-lg-3');
                } else {
                    row.find('.othersBox').hide();
                    row.find('.particularselection')
                        .removeClass('col-lg-3')
                        .addClass('col-lg-5');
                }
            });

            // Trigger change to show/hide othersBox based on preselected value
            $('#partsContainer .dynamicSelect').each(function() {
                $(this).trigger('change');
            });

            $('input[name="radio02"]').on('change', function() {
                if ($(this).val() == '2') {
                    $('#lumpsumField').show();
                    $('.salvage').hide();
                } else {
                    $('#lumpsumField').hide();
                    $('.salvage').show();

                }
            });

            $('#finilize_btn').on('click', function(e) {
                e.preventDefault();
                $('#finalize_panel').show();


                // 1. Capture HTML of table (if dynamic rows are being appended)
                let tableHTML = '';
                $('#assessmentcard .table').each(function() {
                    tableHTML += `<table class="table table-bordered">${$(this).html()}</table><br>`;
                });

                $('#table_html').val(tableHTML); // Assign to hidden input

                // 2. Validate and submit
                if ($("#finilize_assessment").valid()) {
                    $("#finilize_assessment").submit();
                }
            });

            $("#finilize_assessment").validate({
                errorClass: 'error',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').show();
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').hide();
                },
                rules: {
                    'particulars[]': {
                        required: true
                    },
                    'particularsname[]': {
                        required: true
                    },
                    'estimate[]': {
                        required: true
                    },
                    'billNo[]': {
                        required: true
                    },
                    'amount[]': {
                        required: true
                    },
                    'gst[]': {
                        required: true
                    },
                    'assessment[]': {
                        required: true
                    },
                    'salvage[]': {
                        required: true
                    },
                },
                messages: {
                    'particulars[]': "Please select a part type",
                    'particularsname[]': "Please select a part type",
                    'estimate[]': "Please enter DPN",
                    'billNo[]': "Please select salvage type",
                    'amount[]': "Please enter amount",
                    'gst[]': "Please enter GST",
                    'assessment[]': "Enter estimated towing amount",
                    'salvage[]': "Enter salvage amount",
                },
                errorPlacement: function(error, element) {
                    if (element.closest(".input-group").length) {
                        element.closest(".input-group").after(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    const aid = "<?php echo $aid; ?>";
                    const formdata = new FormData();
                    formdata.append('aid', aid);

                    let partsArray = [];
                    let labourArray = [];

                    $("#assessmentrow .assessment_row").each(function(index, element) {
                        const parttype = $(element).find(".type_particulars").val(); // "parts" or "labour"

                        const dynamicOptionVal = parttype === 'parts' ? $(element).find(".type_parts").val() : '';
                        let partName = "",
                            percentage = "";

                        if (dynamicOptionVal && dynamicOptionVal.includes('@')) {
                            const parts = dynamicOptionVal.split('@');
                            partName = parts[0].trim();
                            percentage = parts[1].trim().replace('%', '');
                        }

                        $("#assessmentrow .assessment_row").each(function(index, element) {
                            let typeSelector = $(element).find(".typeSelector").val(); //selection values
                            let dynamicOptions = $(element).find(".dynamicOptions").val(); //selection values
                            let particularsname = $(element).find(".particularsname").val();
                            let estimate = $(element).find(".estimate").val();
                            let billNo = $(element).find(".billNo").val();
                            let amount = $(element).find(".amount").val();
                            let gst = $(element).find(".gst").val();
                            let assessment = $(element).find(".assessment").val();
                            let salvage = $(element).find(".salvage").val();
                        });

                        const estimate = parseFloat($(element).find(".estimate").text()) || 0;
                        const billNo = $(element).find(".billNo").text().trim();
                        const billAmount = parseFloat($(element).find(".amount").text()) || 0;
                        const gst = parseFloat($(element).find(".gst").text()) || 0;
                        const assessmentText = $(element).find(".assessment").text();
                        const assessment = parseFloat(assessmentText) || 0;

                        const salvageText = $(element).find(".salvage").text() || "0";
                        const salvagePer = parseFloat(salvageText) || 0;

                        const rowData = {
                            part: partName || (parttype === 'labour' ? 'Labour' : ''),
                            dpn: percentage || (parttype === 'labour' ? '0' : ''),
                            particulars: $(element).find(".particularsname").text().trim(),
                            estimate_part: parttype === 'parts' ? estimate : 0,
                            estimate_lab: parttype === 'labour' ? estimate : 0,
                            assessment_lab: parttype === 'labour' ? assessment : 0,
                            bill_no: billNo,
                            bill_amount: billAmount,
                            gst: gst,
                            assessment: assessment,
                            salvage_per: salvagePer,
                            salvage: calculateSalvage(assessment, salvagePer)
                        };

                        if (parttype === "parts") {
                            partsArray.push(rowData);
                        } else if (parttype === "labour") {
                            labourArray.push(rowData);
                        }
                    });




                    const finalAssessmentJSON = {
                        parts: partsArray,
                        labour: labourArray
                    };

                    formdata.append('assessmentrow', JSON.stringify(finalAssessmentJSON));

                    $.ajax({
                        url: '<?php echo base_url('finalizeAssessment'); ?>',
                        type: 'POST',
                        data: formdata,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {

                            if (response.status == 200) {
                                $('#generateassessment').html(response.data);
                                $('#addAssessment').modal('hide');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                }
            });



            function calculateSalvage(assessment, percent) {
                const assessVal = parseFloat(assessment) || 0;
                const perc = parseFloat(percent) || 0;
                return (assessVal * perc) / 100;
            }


            // Handle .typeSelector changes independently (once, on DOM ready)
            $(document).on('change', '.typeSelector', function() {
                const value = $(this).val();
                const $td = $(this).closest('td');
                let $labourOptions = $td.find('.dynamicOptions');

                if (value === 'labour') {
                    $labourOptions.prop('selectedIndex', 0).hide();

                } else {
                    $labourOptions.show(); // Show if not labour
                }
            });


            // Validate and handle form submission
            $('.assesment_submitdata').on('click', function(e) {
                e.preventDefault();
                if ($("#assessment").valid()) {
                    $("#assessment").submit();
                }
            });

            $("#assessment").validate({
                errorClass: 'error',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').show();
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').hide();
                },
                rules: {
                    'parts[]': {
                        required: true
                    },
                    'dpn[]': {
                        required: true,
                        number: true,
                        min: 0,
                        max: 100
                    },

                    radio01: {
                        required: true
                    },
                    radio02: {
                        required: true
                    },
                    towing_estimated: {
                        required: true
                    },
                    towing_allowed: {
                        required: true
                    },
                    nil_dep: {
                        required: true
                    },
                    imposed_excess: {
                        required: true
                    },
                    normal_excess: {
                        required: true
                    }
                },
                messages: {
                    'parts[]': "Please select a part type",
                    'dpn[]': {
                        required: "Please enter DPN",
                        number: "DPN must be a valid number",
                        min: "DPN must be at least 1",
                        max: "DPN must not be greater than 100"
                    },
                    radio01: "Please select salvage type",
                    radio02: "Please select salvage type",
                    towing_estimated: "Enter estimated towing amount",
                    towing_allowed: "Enter allowed towing amount",
                    nil_dep: "Please select an option",
                    imposed_excess: "Enter imposed excess amount",
                    normal_excess: "Enter normal excess amount"
                },
                errorPlacement: function(error, element) {
                    if (element.closest(".input-group").length) {
                        element.closest(".input-group").after(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var aid = "<?php echo $aid; ?>";
                    var formdata = new FormData(form);
                    var formmode = $('.form_mode').val();
                    formdata.append('aid', aid);
                    $.ajax({
                        url: '<?php echo base_url('assessment'); ?>',
                        type: 'POST',
                        data: formdata,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                console.log(response.data);
                                $('#assessmentcard').show();
                                if (response.data) {
                                    getassessmentdata = response.data;
                                }
                                if (formmode === 'create') {
                                    addNewAssessment(getassessmentdata);

                                } else {
                                    updateAssessment();
                                }
                                $('#addAssessment').modal('hide');
                                $('#assessment')[0].reset();
                                $('#assessment').validate().resetForm();
                                $('#assessment .is-invalid').removeClass('is-invalid');
                            }
                        },

                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                }
            });

        });

        let debounceTimer;
        $(document).ready(function() {
            $('#addAssessmentRowBtn').on('click', function(e) {
                e.preventDefault();
                addAssesmentRow();
            });
            $('#assessmentTable').on('input change', 'input, select', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(autoSaveTable, 1000); // wait 1 second
            });

            $('#assessmentTable').on('blur', '[contenteditable="true"]', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(autoSaveTable, 1000);
            });

            let receivedAmount = $('.outgoing_status').val();
            console.log("Received Amount:", receivedAmount);
        });
    </script>