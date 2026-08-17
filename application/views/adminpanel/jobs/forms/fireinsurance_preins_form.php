<form id="fireinsuranceform" method="post" enctype="multipart/form-data" style="display:block">
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
                <option value="Fire" selected>Fire</option>
                <option value="Engineering ">Engineering </option>
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
    <?php $this->load->view("adminpanel/jobs/forms/search_inspector") ?>
    <input type="hidden" name="natureofjob" id="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" name="button_action" class="button_action" id="button_action">

    <div class="modal-footer  ml-auto" style="padding: 0px;border-top:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <!-- <button type="submit" class="btn btn-rounded btn-success" id="btn_fireinsurance_form">Submit With Payment</button> -->
        <button type="submit" class="btn btn-rounded btn-success" id="btn_fireinsurance_without_form">Submit </button>
    </div>
</form>
