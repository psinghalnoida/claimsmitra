<?php $this->load->view('adminpanel/layout/sidebar');?>

<main class="main--container" >
<!-- Tab Content Start -->
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab11">
            <section class="main--content" style="min-height:100vh; padding-top:0px;">
                <div class="container-fluid">
                    <div class="row gutter-20">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content mt-3">
                                    <form id="assetvaluation_indivi" method="post" enctype="multipart/form-data" >
                                        <input type="hidden" name="encrypted_data" value="<?= $url ?>">
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label ">Contact Person Name &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-3">
                                                <select class="form-control salutation" id="salutation" name="salutation">
                                                    <option value="">Select Salutation</option>
                                                    <option value="Mr">Mr.</option>
                                                    <option value="Ms">Ms.</option>
                                                    <option value="Mrs">Mrs.</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Full Name" class="form-control contact_person_name capitalizefirstletter">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label location_of_survey">Location of survey &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-3">
                                                <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Pincode" class="form-control location_of_survey">
                                                <div id="error_message" style="color: red;"></div>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" name="state" id="state" placeholder="City & State" class="form-control address">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" name="address" id="address" placeholder="Address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Contact Person Mobile &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Mobile Number (Please Enter Whatsapp number for further update)" class="form-control">
                                                <div id="error_message" style="color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Case Reference &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <input type="text" name="case_reference" id="case_reference" placeholder="Case Reference" class="form-control">
                                                <div id="error_message" style="color: red;"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Are you available at location? &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <select class="form-control available_at_location" id="available_at_location" name="available_at_location">
                                                    <option value="">Select option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row whatsapp_no" id="whatsapp_no" style="display:none">
                                            <span class="label-text col-lg-3 col-form-label">Enter WhatsApp Number of The Person available at location</span>
                                            <div class="col-lg-9">
                                                <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Enter Whatsapp Number" class="form-control whatsapp_number">
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Type of Valuation &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <select class="form-control" id="valuation_type" name="valuation_type">
                                                    <option value="">Select option</option>
                                                    <option value="Desktop">Desktop</option>
                                                    <option value="Physical">Physical</option>
                                                </select>
                                            </div>
                                        </div>
                                          <div class="form-group row visitdate" style="display:none">
                                            <span class="label-text col-lg-3 col-form-label" >Date of visit</span>
                                            <div class="col-lg-9">
                                                <input type="text" name="visitdate" id="visitdate" placeholder="Date of visit" class="form-control">
                                                <div id="error_message" style="color: red;"></div>
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Name of Firm &nbsp;<span style="color:red">*</span></span>
                                             <div class="col-lg-9">
                                                <input type="text" name="firm_name" id="firm_name" placeholder="Name of Firm" class="form-control">
                                                <div id="error_message" style="color: red;"></div>
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Approx asset value</span>
                                            <div class="col-lg-9">
                                                <input type="text" name="asset_value" id="asset_value" placeholder="Approx asset value" class="form-control">
                                                <div id="error_message" style="color: red;"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="natureofjob" name="natureofjob" value="77">

                                                                          
                                        <?php $this->load->view("adminpanel/outgoingcases/search_indivi_inspector") ?>

                                       
                                        <input type="hidden" name="button_action" class="button_action" id="button_action">
                                        <div class="modal-footer" style="padding-right:0px;">
                                        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
                                            <button type="submit" class="btn btn-rounded btn-success" id="assetvaluation_indivi_with_form">Submit</button> 
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view("adminpanel/outgoingcases/submitindividual") ?>
<?php $this->load->view('adminpanel/layout/footer');?>



