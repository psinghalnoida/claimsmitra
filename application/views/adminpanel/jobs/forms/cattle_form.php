<form id="cattlesurveyform" method="post" enctype="multipart/form-data" style="display:block">
    <?php $this->load->view("adminpanel/jobs/forms/commanjobdata"); ?>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of beneficiary</span>
        <div class="col-lg-9">
            <input type="text" name="name_of_beneficiary" id="name_of_beneficiary" placeholder="Name of Beneficiary" class="form-control name_of_beneficiary" value="<?php echo set_value('name_of_beneficiary'); ?>">
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Animal Tag Number</span>
        <div class="col-lg-9">
            <input type="text" name="tagNumber" id="tagNumber" placeholder="Animal Tag Number" class="form-control" value="<?php echo set_value('animal_tag_number'); ?>">
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
        <div class="col-lg-9">
            <input type="text" name="policyNumber" id="policyNumber" placeholder="Policy Number" class="form-control" value="<?php echo set_value('policyNumber'); ?>">
        </div>
    </div>
   
    <?php $this->load->view("adminpanel/jobs/forms/search_inspector") ?>
    <input type="hidden" class="natureofjob" name="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" class="button_action" name="button_action" id="button_action">
    <div class="modal-footer ml-auto" style="padding: 0px;border-top:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_cattle_without_form">Submit</button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#available_at_location').on('change', function() {
            if ($(this).val() === "yes") {
                $('#whatsapp_no').hide(); // Hide the WhatsApp number field
                $('.available_at_location').removeClass('col-md-2').addClass('col-md-4'); // Revert back to the default width
            } else if ($(this).val() === "no") {
                $('#whatsapp_no').show(); // Show the WhatsApp number field
                $('.available_at_location').removeClass('col-md-4').addClass('col-md-2'); // Adjust the width of the select field
            } else {
                $('#whatsapp_no').hide(); // Hide for the default option
                $('.available_at_location').removeClass('col-md-2').addClass('col-md-4'); // Revert back to the default width
            }
        });
    });

    $('#claim_no,#vehicle_number,#registration_number').on('input', function() {
        let value = $(this).val().replace(/[^a-zA-Z0-9 ]/g, '').toUpperCase();
        $(this).val(value);
    });
</script>