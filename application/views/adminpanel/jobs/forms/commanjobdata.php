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
        <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Full Name" class="form-control contact_person_name">
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
     <?php
    $label = (isset($natureofjob) && in_array($natureofjob, [77,78])) 
        ? "Address of Risk" 
        : "Location of survey";
    ?>
    <span class="label-text col-lg-3 col-form-label location_of_survey">
        <?= $label ?> &nbsp;<span style="color:red">*</span>
    </span>

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

<script type="text/javascript">
    $(document).ready(function() {
        $('#available_at_location').on('change', function() {
            if ($(this).val() === "yes") {
                $('#whatsapp_no').hide();                  
            } else if ($(this).val() === "no") {
                $('#whatsapp_no').show();                 
            } else {
                $('#whatsapp_no').hide();
            }
        });
    });
</script>