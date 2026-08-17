<form id="motorspotform" method="post" enctype="multipart/form-data" style="display:block">
    <?php $this->load->view("adminpanel/jobs/forms/commanjobdata"); ?>
    <?php $this->load->view("adminpanel/jobs/forms/motorcommanjobdat"); ?>
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
        <span class="label-text col-lg-3 col-form-label">Cause of Loss</span>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="cause_loss" name="cause_loss" placeholder="Cause of Loss">
        </div>
    </div>
    <?php $this->load->view("adminpanel/jobs/forms/search_inspector") ?>
    <input type="hidden" class="natureofjob" name="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" name="button_action" class="button_action" id="button_action">
    <div class="modal-footer  ml-auto" style="padding: 0px;border-top:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <?php if($usertype == 1): ?>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_motorspot_with_form">Submit With Payment</button>
        <?php else: ?>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_motorspot_without_form">Submit</button>
         <?php endif; ?>
    </div>
</form>