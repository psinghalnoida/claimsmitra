<form id="misscellaneousform" method="post" enctype="multipart/form-data" style="display:block">
    <?php $this->load->view("adminpanel/jobs/forms/commanjobdata"); ?>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of Insured</span>
        <div class="col-lg-9">
            <input type="text" name="insured_name" id="insured_name" placeholder="Name of Insured" class="form-control name_of_insured">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Loss Item</span>
        <div class="col-lg-9">
            <input type="text" name="loss_item" id="loss_item" placeholder="Loss Item" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Policy Number &nbsp;<span style="color:red">*</span></span>
        <div class="col-lg-9">
            <input type="text" name="policyNumber" id="policyNumber" placeholder="Policy Number" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Cause of Loss</span>
        <div class="col-lg-9">
            <input type="text" name="cause_loss" id="cause_loss" placeholder="Cause of Loss" class="form-control firstLetterCapital">
        </div>
    </div>

    <?php $this->load->view("adminpanel/jobs/forms/search_inspector") ?>
    <input type="hidden" name="natureofjob" id="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" name="button_action" class="button_action" id="button_action">
    <div class="modal-footer  ml-auto" style="padding: 0px;border-top:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <!-- <button type="submit" class="btn btn-rounded btn-success" id="btn_misscellaneous_form">Submit With Payment</button> -->
        <button type="submit" class="btn btn-rounded btn-success" id="btn_misscellaneous_without_form">Submit</button>
    </div>
</form>