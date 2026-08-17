<form id="assetsvaluationform" method="post" enctype="multipart/form-data" style="display:block">
 <?php $this->load->view("adminpanel/jobs/forms/commanjobdata"); ?>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Type of Valuation</span>
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
        <span class="label-text col-lg-3 col-form-label">Approx asset value</span>
        <div class="col-lg-9">
            <input type="text" name="asset_value" id="asset_value" placeholder="Approx asset value" class="form-control">
            <div id="error_message" style="color: red;"></div>
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
    <input type="hidden" class="button_action" name="button_action" id="button_action">
    <div class="modal-footer" style="padding-right:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>

       <?php if ($usertype == 1): ?>
       <button type="submit" class="btn btn-rounded btn-success" id="assets_valuation_without_form">Submit With Payment</button>
        <?php else: ?>
            <button type="submit" class="btn btn-rounded btn-success" id="assets_valuation_form">Submit</button>
        <?php endif; ?>

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

         $('#valuation_type').on('change', function() {
            if ($('#valuation_type').val() === "Physical") {
                $('.visitdate').css('display', 'flex');
            } 
        });
         
        $('#claim_no,#vehicle_number,#registration_number').on('input', function() {
            let value = $(this).val().replace(/[^a-zA-Z0-9 ]/g, '').toUpperCase();
            $(this).val(value);
        });

    });
</script>