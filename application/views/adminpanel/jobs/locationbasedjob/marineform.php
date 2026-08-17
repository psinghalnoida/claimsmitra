<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">


<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    td {
        border: 1px solid #000;
        padding-left: 3px;
        font-weight: 400;
    }
    th {
        border: 1px solid #000;
        text-align: left;
        padding-left: 5px;
        font-weight: 400;
    }
</style>

<div class="panel ">
    <div class="panel-heading  pt-4 Essential_heading" style="padding-left:0px; font-size:14px; color:#232A2B;font-weight:700;">Marine Essential Data</div>
    <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
        <!-- FORM START -->
        <form id="marine_form" method="post" enctype="multipart/form-data">
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="report_number" style="color:black">Report Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="report_number" id="report_number" placeholder="Report Number">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claims_ref_no" style="color:black">Claim Ref No: &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="claims_ref_no" id="claims_ref_no" placeholder="Claim Ref No">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_client" style="color:black">Insured / Client &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="insured_client" id="insured_client" placeholder="Insured / Client">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignee" style="color:black">Consignee &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="consignee" id="consignee" placeholder="Consignee">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo  " style="color:black">Cargo &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="cargo" id="cargo" placeholder="Cargo">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policy_no" style="color:black">Policy No.</label>
                        <input type="text" class="form-control editable-field " value="" name="policy_no" id="policy_no" placeholder="Policy No.">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_allotment_date" style="color:black">Survey allotment Date</label>
                        <input type="text" class="form-control editable-field " value="" name="survey_allotment_date" id="survey_allotment_date" placeholder="Survey allotment Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_date" style="color:black">Survey Date(s) </label>
                        <input type="text" class="form-control editable-field " value="" name="survey_date" id="survey_date" placeholder="Survey Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_value" style="color:black">Total consignment Value</label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_value" id="consignment_value" placeholder="Total consignment Value">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="estimated_loss_per_ila" style="color:black">Estimated Loss as per ILA</label>
                        <input type="text" class="form-control editable-field " value="" name="estimated_loss_per_ila" id="estimated_loss_per_ila" placeholder="Estimated Loss as per ILA">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_data" style="color:black">Loss Date</label>
                        <input type="text" class="form-control editable-field " value="" name="loss_data" id="loss_data" placeholder="Loss Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_loss" style="color:black">Type of Loss</label>
                        <input type="text" class="form-control editable-field " value="" name="type_of_loss" id="type_of_loss" placeholder="Type of Loss">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_courie" style="color:black">Consignment Courier Receipt / BL / AWB /LR / GRN / Postal No.</label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_courie" id="consignment_courie" placeholder="Consignment Courier">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_date" style="color:black">Consignment Date</label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_date" id="consignment_date" placeholder="Consignment Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="invoice_stn_no" style="color:black">Invoice STN / Invoice No.</label>
                        <input type="text" class="form-control editable-field " value="" name="invoice_stn_no" id="invoice_stn_no" placeholder="Invoice STN / Invoice No.">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="invoice_date" style="color:black">Invoice Date</label>
                        <input type="text" class="form-control editable-field " value="" name="invoice_date" id="invoice_date" placeholder="Invoice Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_amount" style="color:black">Salvage Amount</label>
                        <input type="text" class="form-control editable-field " value="" name="salvage_amount" id="salvage_amount" placeholder="Salvage Amount">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_description" style="color:black">Packing Description</label>
                        <input type="text" class="form-control editable-field " value="" name="packing_description" id="packing_description" placeholder="Packing Description">
                    </div>
                </div>
            </div>
            <div class="row my-3">
               <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claimant_representative" style="color:black">Claimant's representative during Survey</label>
                        <input type="text" class="form-control editable-field " value="" name="claimant_representative" id="claimant_representative" placeholder="Claimant's representative during Survey">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Survey Place</label>
                        <input type="text" class="form-control editable-field " value="" name="survey_place" id="survey_place" placeholder="Survey Place">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_date" style="color:black">Survey Date</label>
                        <input type="text" class="form-control editable-field " value="" name="survey_date" id="survey_date" placeholder="Survey Date">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="surveyour_remarks" style="color:black">Surveyour Remark</label>
                        <textarea type="text" class="form-control editable-field " value="" name="surveyour_remarks" id="surveyour_remarks" placeholder="Surveyour Remark"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="button d-flex justify-content-end" style="padding:10px">
                    <input class="btn" type="button" value="Next" id="essential_submit" style=" width: 130px;border-radius: 5px;background-color: #2BB3C0;color: #fff;margin: 5px;">
                    <a class="btn" type="button" target="_blank" href="" value="Generate ILA" id="generate_ila" style=" width: 130px;border-radius: 5px;background-color: #2BB3C0;color: #fff;margin: 5px;">Generate ILA</a>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="panel ">
    <div class="panel-heading  pt-4 Essential_heading" style="padding-left:0px; font-size:14px; color:#232A2B;font-weight:700;">Marine Cargo Case Data</div>
    <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
        <!-- FORM START -->
        <form id="marine_form" method="post" enctype="multipart/form-data">
            <div class="row my-3">

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="web_urn_no" style="color:black">Web URN No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="web_urn_no" id="web_urn_no" placeholder="Report Number">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date" style="color:black">Date &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="date" id="date" placeholder="Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="final_documents_submission_date" style="color:black">Final Doc. Submisssion Date &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="final_documents_submission_date" id="final_documents_submission_date" placeholder="Final Doc. Submisssion Date">
                    </div>
                </div>
            </div>
            
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="dv_submission_date" style="color:black">Consent / DV Submission date &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="dv_submission_date" id="dv_submission_date" placeholder="Consent / DV Submission date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="reason_for_delay" style="color:black">Reason for delay in Submitting FSR &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="reason_for_delay" id="reason_for_delay" placeholder="Reason for delay in Submitting FSR">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignor" style="color:black">Consignor &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="consignor" id="consignor" placeholder="Consignor">
                    </div>
                </div>
            </div>  
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_type" style="color:black">Type of Packing &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="packing_type" name="packing_type">
                            <option value="">Select</option>
                            <option value="packing_1">THe Drums filled with paints & further kept inside the carrying vehicle</option>
                            <option value="packing_2">THe Drums filled with paints & further kept inside the carrying vehicle</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo_type" style="color:black">Cargo Type &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="" name="cargo_type">
                            <option value="">Select</option>
                            <option value="cargo_type_1">As Above</option>
                            <option value="cargo_type_2">As Above</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="gross_weight" style="color:black">Vehicle's Gross Weight &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="gross_weight" id="gross_weight" placeholder="Vehicle's Gross Weight">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loaded_weight" style="color:black">Vehicle's Loaded Weight &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="loaded_weight" id="loaded_weight" placeholder="Vehicle's Loaded Weight">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="empty_vehicle_weight" style="color:black">Empty Vehicle Weight &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " value="" name="empty_vehicle_weight" id="empty_vehicle_wight" placeholder="Empty Vehicle Weight">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_weight" style="color:black">Consignment Weight(Kgs) </label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_weight" id="consignment_weight" placeholder="Consignment Weight(Kgs)">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_arrival_date" style="color:black">Consignment arrival date </label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_arrival_date" id="consignment_arrival_date" placeholder="Consignment arrival date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured" style="color:black">Insured </label>
                        <input type="text" class="form-control editable-field " value="" name="insured" id="insured" placeholder="Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insurer" style="color:black">Insurer </label>
                        <input type="text" class="form-control editable-field " value="" name="insurer" id="insurer" placeholder="Insurer">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policy_period_from" style="color:black">Policy Period From </label>
                        <input type="text" class="form-control editable-field " value="" name="policy_period_from" id="policy_period_from" placeholder="Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policy_period_to" style="color:black">Policy Period To </label>
                        <input type="text" class="form-control editable-field " value="" name="policy_period_to" id="policy_period_to" placeholder="Insurer">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policy_type" style="color:black">Type of Policy</label>
                        <select class="form-control editable-field" id="policy_type" name="policy_type">
                            <option value="">Select</option>
                            <option value="policy_type_1">Marine Expert Import Insurance Policy</option>
                            <option value="policy_type_2">Marine Expert Import Insurance Policy</option>
                        </select>
                    </div>
                </div>
            </div>
           
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="previous_report_date" style="color:black">Previous Report(s) / ILA dated</label>
                        <input type="text" class="form-control editable-field " value="" name="previous_report_date" id="previous_report_date" placeholder="Previous Report(s) / ILA dated">
                    </div>
                </div>
               <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="final_assessedloss_value" style="color:black">Final Value of assessed Loss</label>
                        <input type="text" class="form-control editable-field " value="" name="final_assessedloss_value" id="final_assessedloss_value" placeholder="Final Value of assessed Loss">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="designated_claims_manager" style="color:black">Designated Claims Manager in ILGIC</label>
                        <input type="text" class="form-control editable-field " value="" name="designated_claims_manager" id="designated_claims_manager" placeholder="Designated Claims Manager in ILGIC">
                    </div>
                </div>
            </div>
            <div class="row my-3">   
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="mode_of_transit" style="color:black">Mode of Transit</label>
                        <input type="text" class="form-control editable-field " value="" name="mode_of_transit" id="mode_of_transit" placeholder="Mode of Transit">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vassel_type" style="color:black">Vessel Type</label>
                        <input type="text" class="form-control editable-field " value="" name="vassel_type" id="vassel_type" placeholder="Vessel Type">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vessel_name" style="color:black">Vessel Name</label>
                        <input type="text" class="form-control editable-field " value="" name="vessel_name" id="vessel_name" placeholder="Vessel Name">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vassel_sailing_date" style="color:black">Vessel Sailing date</label>
                        <input type="text" class="form-control editable-field " value="" name="vassel_sailing_date" id="vassel_sailing_date" placeholder="Vessel Sailing date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vessel_imo_no" style="color:black">Vessel IMO No.</label>
                        <input type="text" class="form-control editable-field " value="" name="vessel_imo_no" id="vessel_imo_no" placeholder="Vessel IMO No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vessel_age" style="color:black">Vessel age</label>
                        <input type="text" class="form-control editable-field " value="" name="vessel_age" id="vessel_age" placeholder="Vessel age">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="load_port" style="color:black">Load Port</label>
                        <input type="text" class="form-control editable-field " value="" name="load_port" id="load_port" placeholder="Load Port">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="discharge_port" style="color:black">Discharge Port</label>
                        <input type="text" class="form-control editable-field " value="" name="discharge_port" id="discharge_port" placeholder="Discharge Port">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vessel_age" style="color:black">Vessel age</label>
                        <input type="text" class="form-control editable-field " value="" name="vessel_age" id="vessel_age" placeholder="Vessel age">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="load_port" style="color:black">Load Port</label>
                        <input type="text" class="form-control editable-field " value="" name="load_port" id="load_port" placeholder="Load Port">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="discharge_port" style="color:black">Discharge Port</label>
                        <input type="text" class="form-control editable-field " value="" name="discharge_port" id="discharge_port" placeholder="Discharge Port">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo_on_deck" style="color:black">Cargo on Deck</label>
                        <input type="text" class="form-control editable-field " value="" name="cargo_on_deck" id="cargo_on_deck" placeholder="Cargo on Deck">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="bill_of_ladding_no" style="color:black">Bill of Lading No. & Date</label>
                        <input type="text" class="form-control editable-field " value="" name="bill_of_ladding_no" id="bill_of_ladding_no" placeholder="Bill of Lading No. & Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="containerized_cargo" style="color:black">Containerized Cargo</label>
                        <input type="text" class="form-control editable-field " value="" name="containerized_cargo" id="containerized_cargo" placeholder="Containerized Cargo">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="container_type" style="color:black">Container Type</label>
                        <input type="text" class="form-control editable-field " value="" name="container_type" id="container_type" placeholder="Container Type">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_due_to_transshipment" style="color:black">Loss due to Transshipment</label>
                        <input type="text" class="form-control editable-field " value="" name="loss_due_to_transshipment" id="loss_due_to_transshipment" placeholder="Loss due to Transshipment">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_details" style="color:black">Packing Details</label>
                        <input type="text" class="form-control editable-field " value="" name="packing_details" id="packing_details" placeholder="Packing Details">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transit_from" style="color:black">Transit From</label>
                        <input type="text" class="form-control editable-field " value="" name="transit_from" id="transit_from" placeholder="Transit From">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transit_to" style="color:black">Transit To</label>
                        <input type="text" class="form-control editable-field " value="" name="transit_to" id="transit_to" placeholder="Transit To">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_details" style="color:black">Packing Details</label>
                        <input type="text" class="form-control editable-field " value="" name="packing_details" id="packing_details" placeholder="Packing Details">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transit_from" style="color:black">Date of dispatch of cargo from origin</label>
                        <input type="text" class="form-control editable-field " value="" name="transit_from" id="transit_from" placeholder="Date of dispatch of cargo from origin">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo_location" style="color:black">Arrival of cargo Loctaion</label>
                        <input type="text" class="form-control editable-field " value="" name="cargo_location" id="cargo_location" placeholder="Arrival of cargo Loctaion">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="arrival_cargo_date" style="color:black">Arrival of cargo Date </label>
                        <input type="text" class="form-control editable-field " value="" name="arrival_cargo_date" id="arrival_cargo_date" placeholder="Arrival of cargo Date">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="arrival_cargo_time" style="color:black">Arrival of cargo Time</label>
                        <input type="text" class="form-control editable-field " value="" name="arrival_cargo_time" id="arrival_cargo_time" placeholder="Arrival of cargo Time">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo_location" style="color:black">Delivery of cargo Loctaion</label>
                        <input type="text" class="form-control editable-field " value="" name="cargo_location" id="cargo_location" placeholder="Delivery of cargo Loctaion">
                    </div>
                </div>
            </div>
            <div class="row my-3">
               <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="delivery_cargo_date" style="color:black">Delivery of cargo Date </label>
                        <input type="text" class="form-control editable-field " value="" name="delivery_cargo_date" id="delivery_cargo_date" placeholder="Delivery of cargo Date">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="delivery_cargo_time" style="color:black">Delivery of cargo Time</label>
                        <input type="text" class="form-control editable-field " value="" name="delivery_cargo_time" id="delivery_cargo_time" placeholder="Delivery of cargo Time">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_load" style="color:black">Type of Load</label>
                        <input type="text" class="form-control editable-field " value="" name="type_of_load" id="type_of_load" placeholder="Type of Load">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_delivery" style="color:black">Type of Delivery</label>
                        <input type="text" class="form-control editable-field " value="" name="type_of_delivery" id="type_of_delivery" placeholder="Type of Delivery">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="total_packages" style="color:black">Total No. of packages</label>
                        <input type="text" class="form-control editable-field " value="" name="total_packages" id="total_packages" placeholder="Total No. of packages">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_data" style="color:black">Loss Date</label>
                        <input type="text" class="form-control editable-field " value="" name="loss_data" id="loss_data" placeholder="Loss Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_loss" style="color:black">Type of Loss</label>
                        <input type="text" class="form-control editable-field " value="" name="type_of_loss" id="type_of_loss" placeholder="Type of Loss">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="days_of_storage" style="color:black">Days of storage as per policy</label>
                        <input type="text" class="form-control editable-field " value="" name="days_of_storage" id="days_of_storage" placeholder="Days of storage as per policy">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="actual_number_of_days" style="color:black">Actual number of days stored</label>
                        <input type="text" class="form-control editable-field " value="" name="actual_number_of_days" id="actual_number_of_days" placeholder="Actual number of days stored">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="location_of_storage" style="color:black">Location of storage</label>
                        <input type="text" class="form-control editable-field " value="" name="location_of_storage" id="location_of_storage" placeholder="Location of storage">
                    </div>
                </div>
            </div>
            <div class="row my-3">   
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_storage" style="color:black">Type of storage</label>
                        <input type="text" class="form-control editable-field " value="" name="type_of_storage" id="type_of_storage" placeholder="Type of storage">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_duty_claimed" style="color:black">Duty Claimed by Insured</label>
                        <input type="text" class="form-control editable-field " value="" name="insured_duty_claimed" id="insured_duty_claimed" placeholder="Duty Claimed by Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insurer_duty_payable" style="color:black">Duty Payable by Insurer</label>
                        <input type="text" class="form-control editable-field " value="" name="insurer_duty_payable" id="insurer_duty_payable" placeholder="Duty Payable by Insurer">
                    </div>
                </div>
            </div>
            <div class="row my-3">  
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_expected" style="color:black">Salvage Expected</label>
                        <input type="text" class="form-control editable-field " value="" name="salvage_expected" id="salvage_expected" placeholder="Salvage Expected">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="total_salvage_value" style="color:black">Total Value of Salvage</label>
                        <input type="text" class="form-control editable-field " value="" name="total_salvage_value" id="total_salvage_value" placeholder="Total Value of Salvage">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="ga_value" style="color:black">Total value of GA</label>
                        <input type="text" class="form-control editable-field " value="" name="ga_value" id="ga_value" placeholder="Total value of GA">
                    </div>
                </div>
            </div>
            <div class="row my-3">    
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="ga_contribution" style="color:black">Contribution of GA</label>
                        <input type="text" class="form-control editable-field " value="" name="ga_contribution" id="ga_contribution" placeholder="Contribution of GA">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contribution_of_salvage" style="color:black">Contribution of Salvage</label>
                        <input type="text" class="form-control editable-field " value="" name="contribution_of_salvage" id="contribution_of_salvage" placeholder="Contribution of Salvage">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="ga_adjuster" style="color:black">Name of GA Adjuster</label>
                        <input type="text" class="form-control editable-field " value="" name="ga_adjuster" id="ga_adjuster" placeholder="Name of GA Adjuster">
                    </div>
                </div>

            </div>
            <div class="row my-3">
               
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salver_name" style="color:black">Name of Salver</label>
                        <input type="text" class="form-control editable-field " value="" name="salver_name" id="salver_name" placeholder="Name of Salver">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_address_location" style="color:black">Location of Loss Address</label>
                        <input type="text" class="form-control editable-field " value="" name="loss_address_location" id="loss_address_location" placeholder="Location of Loss Address">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="location_latitude" style="color:black">Location of Latitude</label>
                        <input type="text" class="form-control editable-field " value="" name="location_latitude" id="location_latitude" placeholder="Location of Latitude">
                    </div>
                </div>

            </div>

            <div class="row my-3">
               
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="location_latitude" style="color:black">Location of Longitude</label>
                        <input type="text" class="form-control editable-field " value="" name="location_latitude" id="location_latitude" placeholder="Location of Longitude">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_type" style="color:black">Loss Type</label>
                        <input type="text" class="form-control editable-field " value="" name="loss_type" id="loss_type" placeholder="Loss Type">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="catastrophic_event" style="color:black">Catastrophic Event</label>
                        <input type="text" class="form-control editable-field " value="" name="catastrophic_event" id="catastrophic_event" placeholder="Catastrophic Event">
                    </div>
                </div>
            </div>


            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="if_case_yes" style="color:black">If Catastrophic event Yes</label>
                        <input type="text" class="form-control editable-field " value="" name="if_case_yes" id="if_case_yes" placeholder="If Catastrophic event Yes">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pincode" style="color:black">Pin Code</label>
                        <input type="text" class="form-control editable-field " value="" name="pincode" id="pincode" placeholder="Pin Code">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_under_import_leg" style="color:black">Loss under Import leg</label>
                        <input type="text" class="form-control editable-field " value="" name="loss_under_import_leg" id="loss_under_import_leg" placeholder="Loss under Import leg">
                    </div>
                </div>
             
            </div>

            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="final_destination_port" style="color:black">If Under Import Leg: No Final Destination Port / Airport</label>
                        <input type="text" class="form-control editable-field " value="" name="final_destination_port" id="final_destination_port" placeholder="If Under Import Leg: No Final Destination Port / Airport">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vessel_aircraft" style="color:black">If Under Import Leg: Vessel / Aircraft Name</label>
                        <input type="text" class="form-control editable-field " value="" name="vessel_aircraft" id="vessel_aircraft" placeholder="If Under Import Leg: Vessel / Aircraft Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="inter_depot_movement" style="color:black">Inter Depot Movement</label>
                        <input type="text" class="form-control editable-field " value="" name="inter_depot_movement" id="inter_depot_movement" placeholder="Inter Depot Movement">
                    </div>
                </div>
                
            </div>
            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="inter_depot_movement" style="color:black">Identification Marks Details</label>
                        <input type="text" class="form-control editable-field " value="" name="inter_depot_movement" id="inter_depot_movement" placeholder="Identification Marks Details">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                <div class="form-group">
                        <label for="carrier_transporter" style="color:black">Carrier / Transporter</label>
                        <input type="text" class="form-control editable-field " value="" name="carrier_transporter" id="carrier_transporter" placeholder="Carrier / Transporter">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                <div class="form-group">
                        <label for="vehile_registration_no" style="color:black">Vehicle Registration No.</label>
                        <input type="text" class="form-control editable-field " value="" name="vehile_registration_no" id="vehile_registration_no" placeholder="Vehicle Registration No.">
                    </div>
                </div>
               
            </div>

            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                <div class="form-group">
                        <label for="vehicle_ownership" style="color:black">Ownership of vehicle</label>
                        <input type="text" class="form-control editable-field " value="" name="vehicle_ownership" id="vehicle_ownership" placeholder="Ownership of vehile">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                <div class="form-group">
                        <label for="vehicle" style="color:black">Vehicle</label>
                        <input type="text" class="form-control editable-field " value="" name="vehicle" id="vehicle" placeholder="Vehicle">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_type" style="color:black">Types of vehicle</label>
                        <input type="text" class="form-control editable-field " value="" name="vehicle_type" id="vehicle_type" placeholder="Types of vehicle">
                    </div>
                </div>
              
            </div>

            <div class="row my-3">
               <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="road" style="color:black">Road</label>
                        <input type="text" class="form-control editable-field " value="" name="road" id="road" placeholder="Road">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="driver_name" style="color:black">Driver Name</label>
                        <input type="text" class="form-control editable-field " value="" name="driver_name" id="driver_name" placeholder="Driver Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="driving_license_no" style="color:black">Driver License No</label>
                        <input type="text" class="form-control editable-field " value="" name="driving_license_no" id="driving_license_no" placeholder="Driver License No">
                    </div>
                </div>

            </div>
            
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="liability_exist" style="color:black">Liability exists</label>
                        <input type="text" class="form-control editable-field " value="" name="liability_exist" id="liability_exist" placeholder="Liability exists">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="if_liability_exist" style="color:black"> If Yes, recommanded reserve after deducting policy excess, if any</label>
                        <input type="text" class="form-control editable-field " value="" name="if_liability_exist" id="if_liability_exist" placeholder="If Yes, recommanded reserve after deducting policy excess, if any">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="if_liability_not_exist" style="color:black"> If No, Reason for Repudiation / Non Repudiation</label>
                        <input type="text" class="form-control editable-field " value="" name="if_liability_not_exist" id="if_liability_not_exist" placeholder=" If No, Reason for Repudiation / Non Repudiation">
                    </div>
                </div>
               
            </div>
            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_expected" style="color:black">Salvage expected</label>
                        <input type="text" class="form-control editable-field " value="" name="salvage_expected" id="salvage_expected" placeholder="Salvage expected">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_pickup_date" style="color:black">Salvage Pickup date</label>
                        <input type="text" class="form-control editable-field " value="" name="salvage_pickup_date" id="salvage_pickup_date" placeholder="Salvage Pickup date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_buyer_name" style="color:black">Salvage buyer Name</label>
                        <input type="text" class="form-control editable-field " value="" name="salvage_buyer_name" id="salvage_buyer_name" placeholder="Salvage buyer Name">
                    </div>
                </div>

            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salvage_team_involved" style="color:black">Insurer's Salvage Team involved</label>
                        <input type="text" class="form-control editable-field " value="" name="salvage_team_involved" id="salvage_team_involved" placeholder="Insurer's Salvage Team involved">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="original_vehicle_reg_no" style="color:black">Original Vehicle Reg. No.</label>
                        <input type="text" class="form-control editable-field " value="" name="original_vehicle_reg_no" id="original_vehicle_reg_no" placeholder="Original Vehicle Reg. No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transshiped_vehicle_no" style="color:black">Transshipped Vehicle Reg.</label>
                        <input type="text" class="form-control editable-field " value="" name="transshiped_vehicle_no" id="transshiped_vehicle_no" placeholder="Transshipped Vehicle Reg.">
                    </div>
                </div>

            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transshiped_location" style="color:black">Transshipped Location</label>
                        <input type="text" class="form-control editable-field " value="" name="transshiped_location" id="transshiped_location" placeholder="Transshipped Location">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="original_vehicle_gross_weight" style="color:black">Original Vehicle's Gross weight(kgs)</label>
                        <input type="text" class="form-control editable-field " value="" name="original_vehicle_gross_weight" id="original_vehicle_gross_weight" placeholder="Original Vehicle's Gross Weight(kgs)">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="original_vehicle_unladed_weight" style="color:black">Original Vehicle's Unladed weight(kgs)</label>
                        <input type="text" class="form-control editable-field " value="" name="original_vehicle_unladed_weight" id="original_vehicle_unladed_weight" placeholder="Original Vehicle's Unladed Weight(kgs)">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transshiped_vehicle_gross_weight" style="color:black">Transshipped Vehicle gross weight</label>
                        <input type="text" class="form-control editable-field " value="" name="transshiped_vehicle_gross_weight" id="transshiped_vehicle_gross_weight" placeholder="Transshipped Vehicle gross weight">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="transshipped_vehicle_unladed_weight" style="color:black">Transshipped Vehicle unladed weight</label>
                        <input type="text" class="form-control editable-field " value="" name="transshipped_vehicle_unladed_weight" id="transshipped_vehicle_unladed_weight" placeholder="Transshipped Vehicle unladed weight">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_original_vehicle_weight" style="color:black">Consignment original vehicle Weight</label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_original_vehicle_weight" id="consignmwnt_original_vehicle_weight" placeholder="Consignmwnt original vehicle Weight">
                    </div>
                </div>

            </div>
            
            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="consignment_transshipped_vehicle_weight" style="color:black">Consignment transshipped Vehicle weight</label>
                        <input type="text" class="form-control editable-field " value="" name="consignment_transshipped_vehicle_weight" id="consignmwnt_transshipped_vehicle_weight" placeholder="Consignmwnt transshipped Vehicle  weight">
                    </div>
                </div>
               
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_material" style="color:black">Packing Material</label>
                        <input type="text" class="form-control editable-field " value="" name="packing_material" id="packing_material" placeholder="Packing Material">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="packing_status" style="color:black">Packing Status: Customary</label>
                        <input type="text" class="form-control editable-field " value="" name="packing_status" id="packing_status" placeholder="Packing Status: Customary">
                    </div>
                </div>
               
            </div>

            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="external_condition_packing_survey" style="color:black">External Condition of Packing during Survey</label>
                        <input type="text" class="form-control editable-field " value="" name="external_condition_packing_survey" id="external_condition_packing_survey" placeholder="External Condition of Packing during Survey
                         ">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="adequacy_packing" style="color:black">Adequacy of Packing</label>
                        <input type="text" class="form-control editable-field " value="" name="adequacy_packing" id="adequacy_packing" placeholder="Adequacy of Packing">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                <div class="form-group">
                        <label for="has_open_delivery_taken" style="color:black">Has open Delivery taken</label>
                        <input type="text" class="form-control editable-field " value="" name="has_open_delivery_taken" id="has_open_delivery_taken" placeholder="Has open Delivery taken">
                    </div>
                </div>

               
            </div>
            <div class="row my-3">
            <div class="col-xl-4 col-md-4">
                  <div class="form-group">
                        <label for="mail_phone" style="color:black">Survey schedule details from Claimant's Mail / Phone</label>
                        <input type="text" class="form-control editable-field " value="" name="mail_phone" id="mail_phone" placeholder="Survey schedule details from Claimant's Mail / Phone
                         ">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_mail_call" style="color:black">Survey schedule details from Claimant's Date of mail / Call</label>
                        <input type="text" class="form-control editable-field " value="" name="date_of_mail_call" id="date_of_mail_call" placeholder="Survey schedule details from Claimant's Date of mail / Call
                          ">
                    </div>
                </div>
               
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="survey_place" style="color:black">Survey Place</label>
                        <input type="text" class="form-control editable-field " value="" name="survey_place" id="survey_place" placeholder="Survey Place">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nature_of_loss" style="color:black">Survey Date</label>
                        <input type="text" class="form-control editable-field " value="" name="nature_of_loss" id="nature_of_loss" placeholder="Nature of Loss">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="deputed_surveyor_name" style="color:black">Deputed surveyor Name</label>
                        <input type="text" class="form-control editable-field " value="" name="deputed_surveyor_name" id="deputed_surveyor_name" placeholder="Deputed surveyor Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="deputed_surveyor_contact_no" style="color:black">Deputed surveyor Contact No.</label>
                        <input type="text" class="form-control editable-field " value="" name="deputed_surveyor_contact_no" id="deputed_surveyor_contact_no" placeholder="Deputed surveyor Contact No.">
                    </div>
                </div>

            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="custodian_of_cargo" style="color:black">Custodian of cargo</label>
                        <input type="text" class="form-control editable-field " value="" name="custodian_of_cargo" id="custodian_of_cargo" placeholder="Custodian of cargo">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="cargo_segregated" style="color:black">Cargo Segregated</label>
                        <input type="text" class="form-control editable-field " value="" name="cargo_segregated" id="cargo_segregated" placeholder="Cargo Segregated">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="storage_condition_of_cargo" style="color:black">Storage condition of cargo</label>
                        <input type="text" class="form-control editable-field " value="" name="storage_condition_of_cargo" id="storage_condition_of_cargo" placeholder="Storage condition of cargo">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black">Sum Insured</label>
                        <input type="text" class="form-control editable-field " value="" name="sum_insured" id="sum_insured" placeholder="Sum Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="covergae_clause" style="color:black">Coverage Clause</label>
                        <input type="text" class="form-control editable-field " value="" name="covergae_clause" id="covergae_clause" placeholder="Coverage Clause">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="basis_of_valuation" style="color:black">Basis of Valuation</label>
                        <input type="text" class="form-control editable-field " value="" name="basis_of_valuation" id="basis_of_valuation" placeholder="Basis of Valuationo">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="subject_matter_insured" style="color:black">Subject Matter insured</label>
                        <input type="text" class="form-control editable-field " value="" name="subject_matter_insured" id="subject_matter_insured" placeholder="Subject Matter insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="mode_of-transport_insured" style="color:black">Mode of transport insured</label>
                        <input type="text" class="form-control editable-field " value="" name="mode_of-transport_insured" id="mode_of-transport_insured" placeholder="Mode of transport insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="voyages_insured" style="color:black">Voyages Insured</label>
                        <input type="text" class="form-control editable-field " value="" name="voyages_insured" id="voyages_insured" placeholder="Voyages Insured">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="warranties_applicable" style="color:black">Warranties applicable</label>
                        <input type="text" class="form-control editable-field " value="" name="warranties_applicable" id="warranties_applicable" placeholder="Warranties applicable">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="limit_per_location" style="color:black">Limit Per Location</label>
                        <input type="text" class="form-control editable-field " value="" name="limit_per_location" id="limit_per_location" placeholder="Limit Per Location">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="per_sending_limit" style="color:black">Per Sending Limit INR</label>
                        <input type="text" class="form-control editable-field " value="" name="per_sending_limit" id="per_sending_limit" placeholder="Per Sending Limit INR">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="excess_per_policy" style="color:black">Excess as per policy</label>
                        <input type="text" class="form-control editable-field " value="" name="excess_per_policy" id="excess_per_policy" placeholder="Excess as per policy">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="franchise_limit" style="color:black">Franchise Limit as per policy</label>
                        <input type="text" class="form-control editable-field " value="" name="franchise_limit" id="franchise_limit" placeholder="Franchise Limit as per policy">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="any_other_details" style="color:black">Any other Details</label>
                        <input type="text" class="form-control editable-field " value="" name="any_other_details" id="any_other_details" placeholder="Any other Details">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="under_insurance" style="color:black">Under-Insurance</label>
                        <input type="text" class="form-control editable-field " value="" name="under_insurance" id="under_insurance" placeholder="Under-Insurance">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="reason_for_under_insurance" style="color:black">Reason for under Insurance</label>
                        <input type="text" class="form-control editable-field " value="" name="reason_for_under_insurance" id="reason_for_under_insurance" placeholder="Reason for under Insurance">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="declaration_status" style="color:black">Declaration Status</label>
                        <input type="text" class="form-control editable-field " value="" name="declaration_status" id="declaration_status" placeholder="Declaration Status">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="gross_loss" style="color:black">Gross Loss</label>
                        <input type="text" class="form-control editable-field " value="" name="gross_loss" id="gross_loss" placeholder="Sum Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="excess" style="color:black">Excess</label>
                        <input type="text" class="form-control editable-field " value="" name="excess" id="excess" placeholder="Coverage Clause">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="non_standard_settlement" style="color:black">Non Standard Settlement</label>
                        <input type="text" class="form-control editable-field " value="" name="non_standard_settlement" id="non_standard_settlement" placeholder="Non Standard Settlement">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="nature_of_loss_text" style="color:black">Nature of Loss</label>
                        <textarea type="text" class="form-control editable-field " value="" name="nature_of_loss_text" id="nature_of_loss_text" placeholder="Nature of Loss"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="extent_of_loss" style="color:black">Extent of loss</label>
                        <textarea type="text" class="form-control editable-field " value="" name="extent_of_loss" id="extent_of_loss" placeholder="Extent of loss"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="cause_of_loss" style="color:black">Cause of loss</label>
                        <textarea type="text" class="form-control editable-field " value="" name="cause_of_loss" id="cause_of_loss" placeholder="Cause of loss"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="policy_report" style="color:black">Policy Report</label>
                        <textarea type="text" class="form-control editable-field " value="" name="policy_report" id="policy_report" placeholder="Policy Report"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="salvage" style="color:black">Salvage</label>
                        <textarea type="text" class="form-control editable-field " value="" name="salvage" id="salvage" placeholder="Salvage"></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="intimation" style="color:black">Intimation</label>
                        <textarea type="text" class="form-control editable-field " value="" name="intimation" id="intimation" placeholder="Intimation"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="salvage_on_date" style="color:black">Salvage on 28/05/2024</label>
                        <div id="summernote"></div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="any_breach_condition_warranties" style="color:black">Any Breach of Conditions Warranties</label>
                        <textarea type="text" class="form-control editable-field " value="" name="any_breach_condition_warranties" id="any_breach_condition_warranties" placeholder="Any Breach of Conditions Warranties"></textarea>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="surveyor_findings_observations" style="color:black">Surveyor Findings / observations</label>
                        <textarea type="text" class="form-control editable-field " value="" name="surveyor_findings_observations" id="surveyor_findings_observations" placeholder="Surveyor Findings / observations"></textarea>
                    </div>
                </div>
                
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="surveyor_opinion_conclusion" style="color:black">Surveyor Opinion & Conclusion</label>
                        <textarea type="text" class="form-control editable-field" value="" name="surveyor_opinion_conclusion" id="surveyor_opinion_conclusion" placeholder="Surveyor Opinion & Conclusion"></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="assessment_of_loss" style="color:black">Assessment of Loss</label>
                        <textarea type="text" class="form-control editable-field " value="" name="assessment_of_loss" id="assessment_of_loss" placeholder="Assessment of Loss"></textarea>
                    </div>
                </div>
            </div>
            <h5 style="color:black;">Documents Checklist</h5>
            <table>
                <tr>
                    <td class="text-center">A</td>
                    <th><label for="intimation_mail" style="color:black">Intimation Mail with intimation sheet</label></th>
                    <td style="width: 200px;">
                        <select class="form-control editable-field" id="intimation_mail" name="intimation_mail">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td style="width: 200px;">
                        <select class="form-control editable-field" id="original1" name="original1">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-center">B</td>
                    <th><label for="policy_copy" style="color:black">Policy Copy</label></th>
                    <td>
                        <select class="form-control editable-field" id="policy_copy" name="policy_copy">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="original2" name="original2">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-center">C</td>
                    <th><label for="tax_invoice" style="color:black">Tax Invoice</label></th>
                    <td>
                        <select class="form-control editable-field" id="tax_invoice" name="tax_invoice">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="original3" name="original3">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">D</td>
                    <th><label for="gr" style="color:black">GR</label></th>
                    <td>
                        <select class="form-control editable-field" id="gr" name="gr">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="origina4" name="origina4">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-center">E</td>
                    <th><label for="return_gr" style="color:black">Return GR</label></th>
                    <td>
                        <select class="form-control editable-field" id="return_gr" name="return_gr">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="original5" name="original5">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-center">F</td>
                    <th><label for="claims_bill" style="color:black">Claim Bill</label></th>
                    <td>
                        <select class="form-control editable-field" id="claims_bill" name="claims_bill">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="origina6" name="origina6">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-center">G</td>
                    <th><label for="consent_mail" style="color:black">Consent mail</label></th>
                    <td>
                        <select class="form-control editable-field" id="consent_mail" name="consent_mail">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="original7" name="original7">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-center">H</td>
                    <th><label for="photographs_taken_by_us" style="color:black">Photographs taken by us</label></th>
                    <td>
                        <select class="form-control editable-field" id="photographs_taken_by_us" name="photographs_taken_by_us">
                            <option class="text-center" value="">Yes / No /NA</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                            <option class="text-center" value="No">NA</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control editable-field" id="original8" name="original8">
                            <option class="text-center" value="">Original</option>
                            <option class="text-center" value="Yes">Yes</option>
                            <option class="text-center" value="No">No</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="surveyor_remark" style="color:black">Additional information (if any):</label>
                        <textarea type="text" class="form-control editable-field " value="" name="surveyor_remark" id="surveyor_remark" placeholder="Additional information (if any):"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn" style="background-color: #2BB3C0; margin-bottom: 10px;" id="marine_form_submit">Submit</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#marine_form').submit(function(e) {
            e.preventDefault(); // Prevent normal form submission
            // Serialize the form data
            var formData = $(this).serialize();
            // Perform AJAX request
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('cases/submitMarineData'); ?>',
                data: formData,
                dataType: 'json', // Assuming you expect JSON response
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#date,#transit_from #final_documents_submission_date, #dv_submission_date, #consignment_arrival_date, #policy_period_from,#survey_allotment_date,#survey_date,#previous_report_date, #vassel_sailing_date,#loss_data,#invoice_date,#consignment_date,#salvage_pickup_date,#delivery_cargo_date,#arrival_cargo_date').datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: null,
            maxDate: 0,
            onSelect: function(selectedDate, instance) {
                // This function is called when a date is selected
            }
        });

        $('#delivery_cargo_time,#arrival_cargo_time').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10:00 AM',
            maxTime: '9:00 PM',
            defaultTime: '00 AM',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
        });
    });
</script>