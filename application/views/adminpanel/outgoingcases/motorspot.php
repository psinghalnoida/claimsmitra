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
                                    <form id="motorspotindiviform" method="post" enctype="multipart/form-data" >
                                        <input type="hidden" name="encrypted_data" value="<?= $url ?>">
                                       <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Contact Person Name &nbsp;<span style="color:red">*</span></span>
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
                                            <span class="label-text col-lg-3 col-form-label">Contact Person Mobile &nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Mobile Number (Please Enter Whatsapp number for further update)" class="form-control">
                                                <div id="error_message" style="color: red;"></div>
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
                                                <input type="text" name="address" id="address" placeholder="Address" class="form-control ">
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
                                            <span class="label-text col-lg-3 col-form-label">Are you available at location? </span>
                                            <div class="col-lg-9">
                                                <select class="form-control available_at_location" id="available_at_location" name="available_at_location">
                                                    <option value="">Select option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" id="whatsapp_no" style="display:none">
                                            <span class="label-text col-lg-3 col-form-label">Enter WhatsApp Number of The Person available at location </span>
                                            <div class="col-lg-9">
                                                <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Enter Whatsapp Number" class="form-control whatsapp_no">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Type of Vehicle</span>
                                            <div class="col-lg-3">
                                                <select class="form-control" name="prvt_cmrcl">
                                                    <option value="">Select option</option>
                                                    <option value="Private">Private</option>
                                                    <option value="Commercial">Commercial</option>
                                                </select>
                                                <div id="error_message" style="color: red;"></div>
                                            </div>

                                            <div class="col-lg-6">
                                                <select class="form-control type_of_vehicle" id="type_of_vehicle" name="type_of_vehicle">
                                                    <option value="">Select option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row other_type_container"  style="display:none;">
                                            <span class="label-text col-lg-3 col-form-label">Specify Other Type of Vehicle</span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="other_type" name="other_type" placeholder="Specify Other Type of Vehicle">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Vehicle No.&nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" placeholder="Vehicle No.">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Name of Insured</span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control capitalizefirstletter" id="insured_name" name="insured_name" placeholder="Name of Insured">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Claim Number</span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="claim_no" name="claim_no" placeholder="Claim Number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Policy Number</span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Date of Loss&nbsp;<span style="color:red">*</span></span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control selectdate" id="loss_data" name="loss_data" placeholder="Date of Loss">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Cause of Loss</span>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control capitalizefirstletter" id="cause_loss" name="cause_loss" placeholder="Cause of Loss">
                                            </div>
                                        </div>
                                        <?php $this->load->view("adminpanel/outgoingcases/search_indivi_inspector") ?>
                                        <input type="hidden" class="natureofjob" name="natureofjob" value="62">
                                        <input type="hidden" name="button_action" class="button_action" id="button_action">
                                        <div class="modal-footer  ml-auto" style="padding: 0px;border-top:0px;">
                                            <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
                                            <button type="submit" class="btn btn-rounded btn-success" id="motorspotindivi_with_form">Submit</button>
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

<script type="text/javascript">
    $(document).ready(function () {
        const vehicleOptions = {
            private: `
                <option value="">Select option</option>
                <option value="motor_car">Motor Car</option>
                <option value="Tractor">Tractor</option>
                <option value="motor_cycle">Motor Cycle</option>
                <option value="other">Other</option>
            `,
            commercial: `
                <option value="">Select option</option>
                <option value="motor_cab">Motor Cab</option>
                <option value="Tractor">Tractor</option>
                <option value="motor_cycle">Motor Cycle</option>
                <option value="construction_equipment">Construction Equipment</option>
                <option value="goods_carrier">Goods and Carrier</option>
                <option value="Bus">Bus</option>
                <option value="other">Other</option>
            `
        };

        $('select[name="prvt_cmrcl"]').on('change', function () {
            const selected = $(this).val().toLowerCase();
            if (selected === "private") {
                $('.type_of_vehicle').html(vehicleOptions.private);
            } else if (selected === "commercial") {
                $('.type_of_vehicle').html(vehicleOptions.commercial);
            } else {
                $('.type_of_vehicle').html('<option value="">Select option</option>');
            }
        });
    });

</script>


