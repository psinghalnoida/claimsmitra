<form id="marinehullform" method="post" enctype="multipart/form-data" style="display:block">
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
        <span class="label-text col-lg-3 col-form-label">Location of Survey</span>
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
            <div id="error_message_contact_person_mobile" style="color: red;"></div>
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

    <div class="form-group row" id="whatsapp_no" style="display:none">
        <span class="label-text col-lg-3 col-form-label">Enter WhatsApp Number of The Person available at location</span>
        <div class="col-lg-9">
            <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Enter Whatsapp Number" class="form-control whatsapp_number">
        </div>
    </div>

    <div class="form-group row" id="beneficiary">
        <span class="label-text col-lg-3 col-form-label beneficiary">Name of Insured</span>
        <div class="col-lg-9">
            <input type="text" name="insured_name" id="insured_name" placeholder="Name of Insured" class="form-control name_of_insured">
        </div>
    </div>


    <div class="form-group row" id="loss_item">
        <span class="label-text col-lg-3 col-form-label loss_item">Loss Item</span>
        <div class="col-lg-9">
            <input type="text" name="loss_item" id="loss_item" placeholder="Loss Item" class="form-control">
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
    <input type="hidden" name="button_action" class="button_action" id="button_action">
    <input type="hidden" class="natureofjob" name="natureofjob" value="<?php echo intval($natureofjob); ?>">

    <div class="modal-footer" style="padding-right:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_marinehull_form">Submit With Payment</button>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_marinehull_without_form">Submit Without Payment</button>
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