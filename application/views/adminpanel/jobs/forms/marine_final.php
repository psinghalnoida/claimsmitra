<form id="marinefinalform" method="post" enctype="multipart/form-data" style="display:block">
    <?php $this->load->view("adminpanel/jobs/forms/commanjobdata"); ?>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of consignee  &nbsp;<span style="color:red">*</span></span>
        <div class="col-lg-9">
            <input type="text" name="name_of_consignee" id="name_of_consignee" placeholder="Name of consignee" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of consignor  &nbsp;<span style="color:red">*</span></span>
        <div class="col-lg-9">
            <input type="text" name="consignor" id="consignor" placeholder="Name of consignor" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of Insured  &nbsp;<span style="color:red">*</span></span>
        <div class="col-lg-9">
            <input type="text" name="insured_name" id="insured_name" placeholder="Name of Insured" class="form-control name_of_insured">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Commodity</span>
        <div class="col-lg-9">
            <input type="text" name="name_of_commodity" id="name_of_commodity" placeholder="Commodity" class="form-control firstLetterCapital">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
        <div class="col-lg-9">
            <input type="text" name="policyNumber" id="policyNumber" placeholder="Policy Number" class="form-control">
        </div>
    </div>

    <?php $this->load->view("adminpanel/jobs/forms/invoicedata"); ?>
    <?php $this->load->view("adminpanel/jobs/forms/search_inspector") ?>
    <input type="hidden" class="natureofjob" name="natureofjob" value="<?php echo intval($natureofjob); ?>">
    <input type="hidden" name="button_action" class="button_action" id="button_action">
    <div class="modal-footer ml-auto" style="border-top:0px;padding:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button>
        <!-- <button type="submit" class="btn btn-rounded btn-success" id="btn_marinefinal_form">Submit With Payment</button> -->
        <button type="submit" class="btn btn-rounded btn-success" id="btn_marinefinal_without_form">Submit </button>
    </div>
</form>