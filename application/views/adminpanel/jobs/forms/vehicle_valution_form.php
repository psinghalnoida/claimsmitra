<form id="motorvehiclevalueform" method="post" enctype="multipart/form-data" style="display:block">
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Contact Person Name</span>
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
            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Full Name" class="form-control contact_person_name">
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label location_of_survey">Location of survey</span>
        <div class="col-lg-3">
            <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Pincode" class="form-control location_of_survey">
            <div id="error_message" style="color: red;"></div>
        </div>
        <div class="col-lg-6">
            <input type="text" name="address" id="address" placeholder="Address" class="form-control address">
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Contact Person Mobile</span>
        <div class="col-lg-9">
            <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Mobile Number (Please Enter Whatsapp number for further update)" class="form-control">
            <div id="error_message" style="color: red;"></div>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Case Reference</span>
        <div class="col-lg-9">
            <input type="text" name="case_reference" id="case_reference" placeholder="Case Reference" class="form-control">
            <div id="error_message" style="color: red;"></div>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Are you available at location?</span>
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
        <span class="label-text col-lg-3 col-form-label">Type of Vehicle</span>
        <div class="col-lg-9">
            <select class="form-control" id="type_of_vehicle" name="type_of_vehicle">
                <option value="">Select option</option>
                <option value="motor_car">Motor Car</option>
                <option value="motor_cab">Motor Cab</option>
                <option value="Tractor">Tractor</option>
                <option value="motor_cycle">Motor Cycle</option>
                <option value="construction_equipment">Construction Equipment</option>
                <option value="goods_carrier">Goods and Carrier</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>

    <div class="form-group row" id="other_type_container" style="display: none;">
        <span class="label-text col-lg-3 col-form-label">Specify Other Type of Vehicle</span>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="other_type" name="other_type" placeholder="Specify Other Type of Vehicle">
        </div>
    </div>

    <div class="form-group row" id="vehicle_owner">
        <span class="label-text col-lg-3 col-form-label">Name of Vehicle Owner</span>
        <div class="col-lg-9">
            <input type="text" name="name_of_owner" id="name_of_owner" placeholder="Name of Vehicle Owner" class="form-control">
        </div>
    </div>

    <div class="form-group row" id="vehicle_no">
        <span class="label-text col-lg-3 col-form-label">Vehicle Number</span>
        <div class="col-lg-9">
            <input type="text" name="vehicle_number" id="vehicle_number" placeholder="Vehicle Number" class="form-control">
        </div>
    </div>

    <div class="form-group row" id="insured_name">
        <span class="label-text col-lg-3 col-form-label">Name of Insured</span>
        <div class="col-lg-9">
            <input type="text" name="insured_name" id="insured_name" placeholder="Name of Insured" class="form-control name_of_insured">
        </div>
    </div>

    <div class="form-group row" id="policynumber">
        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
        <div class="col-lg-9">
            <input type="text" name="policyNumber" id="policyNumber" placeholder="Policy Number" class="form-control">
        </div>
    </div>
    <div class="form-group row cause_loss">
        <span class="label-text col-lg-3 col-form-label">Cause of Loss</span>
        <div class="col-lg-9">
            <input type="text" name="cause_loss" id="cause_loss" placeholder="Cause of Loss" class="form-control">
        </div>
    </div>
    <?php $this->load->view("adminpanel/jobs/locationbasedjob/search_inspector") ?>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Instructions</span>
        <div class="col-lg-9">
            <input type="text" name="instruction" id="instruction" placeholder="Instruction (if any)" class="form-control">
        </div>
    </div>
    <input type="hidden" class="natureofjob" name="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" name="button_action" class="button_action" id="button_action">
    <div class="modal-footer" style="padding-right:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_motorvehiclevalue_form">Submit With Payment</button>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_motorvehiclevalue_without_form">Submit Without Payment</button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#available_at_location').on('change', function() {
            if ($('#available_at_location').val() === "yes") {
                $('#whatsapp_no').css('display', 'none');
            } else if ($('#available_at_location').val() === "no") {
                $('#whatsapp_no').css('display', 'flex');
            }
        });

       
    });
</script>