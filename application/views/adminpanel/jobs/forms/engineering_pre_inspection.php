<form id="engineerpreform" method="post" enctype="multipart/form-data" style="display:block">
    <?php $this->load->view("adminpanel/jobs/forms/commanjobdata"); ?>
     <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of Insured / Firm</span>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="cause_loss" name="insured_name" placeholder="Name of Insured">
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Type of Inspection</span>
        <div class="col-lg-9">
            <select class="form-control" id="valuation_type" name="valuation_type">
                <option value="">Select option</option>
                <option value="Fire" >Fire</option>
                <option value="Engineering" selected>Engineering</option>
                <option value="Project">Project</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Sum Insured</span>
        <div class="col-lg-9">
            <input type="text" name="sum_insured" id="sum_insured" placeholder="Sum Insured" class="form-control">
        </div>
    </div>

    

    <?php $this->load->view("adminpanel/jobs/locationbasedjob/search_inspector") ?>


    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Instructions</span>
        <div class="col-lg-9">
            <input type="text" name="instruction" id="instruction" placeholder="Instruction (if any)" class="form-control">
        </div>
    </div>

    <input type="hidden" name="natureofjob" id="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" name="button_action" class="button_action" id="button_action">

    <div class="modal-footer" style="padding-right:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_engineerpre_form">Submit With Payment</button>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_engineerpre_without_form">Submit Without Payment</button>
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

        $('#claim_no,#vehicle_number,#registration_number').on('input', function() {
            let value = $(this).val().replace(/[^a-zA-Z0-9 ]/g, '').toUpperCase();
            $(this).val(value);
        });


        
    });
</script>