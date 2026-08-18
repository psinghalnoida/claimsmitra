<?php $this->load->view('adminpanel/layout/case-sidebar'); ?>
<style>
    .error-message {
        color: red;
        display: none;
    }

    .error {
        color: red;
        display: block;
    }

    /* .form-control.disabled {
        pointer-events: none;
    } */

    .billing td {
        min-width: 100px;
    }

    .case th {
        width: 20%;
    }

    .form-control,
    .table,
    .table th,
    .table td,
    .col-form-label,
    .input-group-append button {
        font-size: 14px !important;
        /* padding: 0.40rem; */
    }

    select.form-control,
    input.form-control,
    button.btn {
        font-size: 14px !important;
    }

    .btn {
        font-size: 14px !important;
    }
      .hidden {
        display: none !important;
    }
</style>

<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata'); ?>
        </div>
    </div>

    <div class="row gutter-20">
        <!-- Determine the class based on the availability of documents -->
        <div class="<?php echo empty($casereports) ? 'col-xl-12 col-md-12' : 'col-xl-6 col-md-6'; ?>">
            <section class="panel" style="border: 1px solid #E5E4E2; margin-left: 15px;margin-right: 15px; margin-bottom:18px; height:90%;">
                <div class="row gutter-20">
                    <div class="col-xl-12 col-md-6">
                        <div class="">
                            <div class="panel-heading">
                                <h3 class="panel-title">Action</h3>
                            </div>
                            <div class="panel-content">
                                <button type="button" id="requestForTI" class="btn btn-rounded btn-default mr-1" <?php echo isset($billing_data['invoice']) && $billing_data['invoice'] ? '' : 'disabled'; ?>> Request for TI </button>
                                <button id="toggleBillBtn" class="btn btn-rounded btn-warning mr-1">Create Bill</button>
                                <a href="#PayModal" class="btn btn-rounded btn-success" data-toggle="modal">Add Receipt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Only show the documents section if documents are available -->
        <?php if (!empty($casereports)) { ?>
            <div class="col-xl-6 col-md-6">
                <section class="panel" style="border: 1px solid #E5E4E2; margin-right:15px; margin-bottom:20px; overflow-x: auto;">
                    <div class="panel-heading" style="padding-bottom: 0px;">
                        <h3 class="panel-title">Documents</h3>
                    </div>
                    <div class="row m-2 no-gutters" style="border-top: 1px solid #eee;">
                        <?php foreach ($casereports as $index => $report) { ?>
                            <?php $fileExtension = pathinfo($report, PATHINFO_EXTENSION); ?>
                            <div class="col-md-1 col-lg-1 mx-2 my-2">
                                <div class="item">
                                    <div class="thumb">
                                        <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                            <a href="<?php echo base_url('uploads/' . $aid . '/reports/' . $report); ?>" data-fancybox="images">
                                                <img class="img-responsive" src="<?php echo base_url('uploads/' . $aid . '/reports/' . $report); ?>" alt="Image" style="max-height: 106px;">
                                            </a>
                                        <?php } else if ($fileExtension == 'pdf') { ?>
                                            <a href="<?php echo base_url('uploads/' . $aid . '/reports/' . $report); ?>" target="_blank">
                                                <img class="img-responsive pdf-thumb" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF" style="height:89;width:90px;">
                                            </a>
                                        <?php } ?>
                                        <div class="file-name" style="font-size: 12px; margin-top: 2px; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <?php echo truncateFileName(basename($report), 30); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        <?php } ?>
    </div>

    <div id="PayModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="paymentForm" method="post" enctype="multipart/form-data"> <!-- Add form tag here -->
                    <div class="modal-header">
                        <h5 class="modal-title">Add Receipt</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="form-group row modal-body">
                        <span class="label-text col-md-3 col-form-label text-md-left">Payment Ref:</span>
                        <div class="col-md-9 mt-1">
                            <input type="text" id="paymentFor" name="payment_for[]" class="form-control" required>
                        </div>
                        <span class="label-text col-md-3 col-form-label text-md-left">Amount:</span>
                        <div class="col-md-9 mt-1">
                            <input type="text" id="amount" name="amount[]" class="form-control" required>
                        </div>
                        <span class="label-text col-md-3 col-form-label text-md-left">Date:</span>
                        <div class="col-md-9 mt-1">
                            <input type="date" id="paymentDate" name="date[]" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send</button> <!-- Change button to submit type -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <div id="addfieldmodal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Field</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">
                    <div class="panel" style="box-shadow:none">
                        <form method="post" enctype="multipart/form-data">
                            <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="fieldname" style="color:black;">Field Name&nbsp;<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control fieldname" id="fieldname" name="fieldname[]" placeholder="Field Name" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="fieldvalue" style="color:black;">Field Value:&nbsp;<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control fieldvalue" id="fieldvalue" name="fieldvalue[]" placeholder="Field Value" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                    <input class="btn case_btn" type="button" value="Add" id="add_field">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <section class="panel" style="margin-left: 15px; margin-right:15px;margin-bottom:15px;">
        <div class="panel--header">
            <div class="panel-heading ">
                <h3 class="panel-title">INVOICE</h3>
            </div>
        </div>
        <hr style="padding: 0;margin:0px">
        <div class="row">
            <div class="col-xl-6 col-md-6" style="padding-right:0px;">
                <div class="card" style="border:none;padding:16px 0px 16px 16px;">
                    <div class="card-header p-2" style="height: auto;background-color:#edede1;color: black;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title" style="background-color: #edede1; padding: 0; border-bottom: 1px solid #b3b39d; margin-bottom: 0;">
                                Bill To:
                            </h5>
                            <a data-toggle="modal" data-target="#vendorModal" data-modal-type="billing" class="btn btn-rounded btn-info venorbtn">
                                <i class="fa fa-plus" style="font-size: 12px;color:#FFF"></i>
                            </a>
                        </div>
                        </a>

                        <div class="d-flex flex-column billing_row_data">
                            <input type="hidden" id="selected_payment_vendor_id" name="selected_payment_vendor_id" value="" class="selected_vendor_id">

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Payment By:</b>
                                <input type="text"
                                    class=" billing_payment_by payment_by form-control editable-field payment_vendor_name billing_insurance_company insurance_company appointment_vendor_name appointedby_paymentby"
                                    value="<?php echo htmlspecialchars_decode(
                                                !empty($billing_data['bill_to']['billing_payment_by']) ? $billing_data['bill_to']['billing_payment_by'] : ''
                                            ); ?>"
                                    name="billing_payment_by"
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                                <input type="text" class="form-control editable-field billing_branch_name payment_branch_name appointment_branch_name policy_branch_name"
                                    <?php echo !empty($billing_data['bill_to']['billing_branch_name']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars_decode(
                                                !empty($billing_data['bill_to']['billing_branch_name']) ? $billing_data['bill_to']['billing_branch_name'] : ''
                                            ); ?>"
                                    name="billing_branch_name"
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">User Name:</b>
                                <input type="text" class="form-control editable-field billing_user_name payment_user_name appointment_user_name policy_user_name"
                                    <?php echo !empty($billing_data['bill_to']['billing_user_name']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars_decode(
                                                !empty($billing_data['bill_to']['billing_user_name']) ? $billing_data['bill_to']['billing_user_name'] : ''
                                            ); ?>"
                                    name="billing_user_name"
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                                <input type="text" class="form-control editable-field billing_mobile billing_mobile_num payment_mobile_num appointment_mobile_num policy_mobile_num"
                                    <?php echo !empty($billing_data['bill_to']['billing_mobile_num']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars(
                                                !empty($billing_data['bill_to']['billing_mobile_num']) ? $billing_data['bill_to']['billing_mobile_num'] : ''
                                            ); ?>"
                                    name="billing_mobile_num"
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px; font-weight: 600;">GST Number:</b>
                                <input type="text"
                                    class=" billing_gst form-control editable-field billing_payment_gst payment_gst"
                                    id="gstn"
                                    name="billing_gst"
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;"
                                    <?php echo !empty($billing_data['bill_to']['billing_gst']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars(!empty($billing_data['bill_to']['billing_gst']) ? $billing_data['bill_to']['billing_gst'] : 'NA'
                                    ); ?>
                                    "
                                    placeholder="">
                            </div>
                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px; font-weight: 600;">Billing Id:</b>
                                <input type="text"
                                    class="form-control editable-field billingto"
                                    name="billing_id"
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;"
                                    <?php echo !empty($billing_data['bill_to']['billing_id']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars(
                                                !empty($billing_data['bill_to']['billing_id']) ? $billing_data['bill_to']['billing_id'] : 'NA'
                                            ); ?>"
                                    placeholder="">
                            </div>
                           
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6" style="padding-left:0px;">
                <div class="card" style="border:none;padding:16px">
                    <div class="card-header p-2" style="height: auto;background-color:#edede1;color: black;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title" style="background-color: #edede1; padding: 0; border-bottom: 1px solid #b3b39d; margin-bottom: 0;">
                                Ship To:
                            </h5>
                            <a data-toggle="modal" data-target="#vendorModal" data-modal-type="shipping" class="btn btn-rounded btn-info venorbtn">
                                <i class="fa fa-plus" style="font-size: 12px;color:#FFF"></i>
                            </a>
                        </div>
                        <div class="d-flex flex-column shipping_row_data">
                            <input type="hidden" id="selected_payment_vendor_id" name="selected_payment_vendor_id" value="" class="selected_vendor_id">

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Ship To:</b>
                                <input type="text" class=" shipping_payment_by shipping_insurance_company payment_by form-control editable-field payment_vendor_name insurance_company appointment_vendor_name appointedby_paymentby"
                                    value="<?php echo htmlspecialchars_decode(
                                                !empty($billing_data['ship_to']['shipping_payment_by']) ? $billing_data['ship_to']['shipping_payment_by'] : (isset($ship_to['payment_by']) ? $ship_to['payment_by'] : '')
                                            ); ?>"
                                    name="shipping_payment_by"
                                    placeholder=""
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Branch Name:</b>
                                <input type="text" class=" shipping_branch_name form-control editable-field payment_branch_name appointment_branch_name policy_branch_name"
                                    <?php echo isset($billing_data['ship_to']['shipping_branch_name']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars_decode(
                                                !empty($billing_data['ship_to']['shipping_branch_name']) ? $billing_data['ship_to']['shipping_branch_name'] : (isset($ship_to['payment_branch_name']) ? $ship_to['payment_branch_name'] : '')
                                            ); ?>"
                                    name="shipping_branch_name"
                                    placeholder=""
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">User Name:</b>
                                <input type="text" class="shipping_user_name form-control editable-field payment_user_name appointment_user_name policy_user_name"
                                    <?php echo isset($billing_data['ship_to']['shipping_user_name']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars_decode(
                                                !empty($billing_data['ship_to']['shipping_user_name']) ? $billing_data['ship_to']['shipping_user_name'] : (isset($ship_to['payment_user_name']) ? $ship_to['payment_user_name'] : '')
                                            ); ?>"
                                    name="shipping_user_name"
                                    placeholder=""
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Mobile Number:</b>
                                <input type="text" class="shipping_mobile shipping_mobile_num form-control editable-field payment_mobile_num appointment_mobile_num policy_mobile_num"
                                    <?php echo isset($billing_data['ship_to']['shipping_mobile_num']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars(
                                                !empty($billing_data['ship_to']['shipping_mobile_num']) ? $billing_data['ship_to']['shipping_mobile_num'] : ""
                                            ); ?>"
                                    name="shipping_mobile_num"
                                    placeholder=""
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">GST Number:</b>
                                <input type="text" class=" shipping_gst form-control editable-field shipping_payment_gst payment_gst"
                                    <?php echo isset($billing_data['ship_to']['shipping_gst']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars(!empty($billing_data['ship_to']['shipping_gst']) ? $billing_data['ship_to']['shipping_gst'] : 'NA'
                                    ); ?>"
                                    name="shipping_gst"
                                    placeholder=""
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>

                            <div class="d-flex align-items-center">
                                <b style="font-size: 12px;font-weight:600;">Billing Id:</b>
                                <input type="text" class="form-control editable-field shippingto"
                                    <?php echo isset($billing_data['ship_to']['shipbilling_id']) ? "disabled" : ""; ?>
                                    value="<?php echo htmlspecialchars(
                                        !empty($billing_data['ship_to']['shipbilling_id']) ? $billing_data['ship_to']['shipbilling_id'] : 'NA'
                                    ); ?>
                                    "
                                    name="shipbilling_id"
                                    placeholder=""
                                    style="font-size: 12px; height: 20px; background-color: #edede1; border: none; flex: 1;">
                            </div>
                           
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="panel" id="billingSection" style="border: 1px solid #E5E4E2; margin-left: 15px; margin-right:15px;margin-bottom:15px; ">
        <div class="panel-content">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 style="font-weight:bold;color:black;font-size:14px;">BILLING DETAILS</h5>
                <!-- <a data-toggle="modal" data-target="#addfieldmodal" data-modal-type="addfieldmodal" class="btn btn-rounded btn-info addfieldmodal">
                    <i class="fa fa-plus" style="font-size: 15px; color: #FFF"></i>
                </a> -->
            </div>

            <div class="row">

                <table class="table table-bordered text-left m-3 case fieldtablebody">
                    <tbody id="fieldtablebody">
                        <?php if (!empty($essentialdata->case_reference)): ?>
                            <tr>
                                <th>Case Reference</th>
                                <td colspan="6">
                                    <span><?php echo htmlspecialchars($essentialdata->case_reference); ?></span>
                                    <input type="text" name="case_reference" value="<?php echo htmlspecialchars($essentialdata->case_reference); ?>" class="form-control" style="display:none;">
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (!empty($essentialdata->insured_name) || !empty($casedata->insured_name)): ?>
                            <tr>
                                <th>Name of Insured</th>
                                <td colspan="6">
                                    <span><?php echo !empty($essentialdata->insured_name) ? htmlspecialchars_decode($essentialdata->insured_name) : htmlspecialchars_decode($casedata->insured_name); ?></span>
                                    <input type="text" name="insured_name" value="<?php echo !empty($essentialdata->insured_name) ? htmlspecialchars($essentialdata->insured_name) : htmlspecialchars($casedata->insured_name); ?>" class="form-control" style="display:none;">
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (!empty($essentialdata->policyNumber) || !empty($casedata->policyNumber)): ?>
                            <tr>
                                <th>Policy No.</th>
                                <td colspan="6">
                                    <span><?php echo !empty($essentialdata->policyNumber) ? htmlspecialchars($essentialdata->policyNumber) : htmlspecialchars($casedata->policyNumber); ?></span>
                                    <input type="text" name="policyNumber" value="<?php echo !empty($essentialdata->policyNumber) ? htmlspecialchars($essentialdata->policyNumber) : htmlspecialchars($casedata->policyNumber); ?>" class="form-control" style="display:none;">
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (!empty($reportdata->date_of_incident) || !empty($reportdata->time_of_incident)): ?>
                            <tr>
                                <th>Date of Loss</th>
                                <td colspan="6">
                                    <span>
                                        <?php
                                        $dateOfIncident = isset($reportdata->date_of_incident) ? htmlspecialchars($reportdata->date_of_incident) : '-';
                                        $timeOfIncident = isset($reportdata->time_of_incident) ? htmlspecialchars($reportdata->time_of_incident) : '-';
                                        echo $dateOfIncident . ' ' . $timeOfIncident;
                                        ?>
                                    </span>
                                    <input type="date" name="date_of_incident" value="<?php echo isset($reportdata->date_of_incident) ? htmlspecialchars($reportdata->date_of_incident) : ''; ?>" class="form-control" style="display:none;">
                                    <input type="time" name="time_of_incident" value="<?php echo isset($reportdata->time_of_incident) ? htmlspecialchars($reportdata->time_of_incident) : ''; ?>" class="form-control" style="display:none;">
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (!empty($essentialdata->claim_no)): ?>
                            <tr>
                                <th>Claim No.</th>
                                <td colspan="6">
                                    <span><?php echo htmlspecialchars($essentialdata->claim_no); ?></span>
                                    <input type="text" name="claim_no" value="<?php echo htmlspecialchars($essentialdata->claim_no); ?>" class="form-control" style="display:none;">
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
            <div class="row">
                <table class="table table-bordered text-center m-3 billing" id="billing" style="font-size:14px;">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>UOM</th>
                            <th>Rate (Rs)</th>
                            <th>Qty</th>
                            <th>Amount (Rs)</th>
                            <th>Add More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td>
                                <select class="form-control item-select editable-field" name="item[]" style="font-size:14px;">
                                    <option value="" style="font-size:14px;" disabled selected>Select Item</option>
                                    <option style="font-size:14px;">Survey Fee</option>
                                    <option style="font-size:14px;">Professional Fee</option>
                                    <option style="font-size:14px;">DA</option>
                                    <option style="font-size:14px;">Conveyance Outstation</option>
                                    <option style="font-size:14px;">Conveyance Local</option>
                                    <option style="font-size:14px;">Hotel Bill</option>
                                    <option style="font-size:14px;">Investigation Fee</option>
                                    <option style="font-size:14px;">Out of Pocket Expenses</option>
                                    <option style="font-size:14px;">Photos</option>
                                    <option style="font-size:14px;">Photos on CD</option>
                                    <option style="font-size:14px;">Videos on CD</option>
                                    <option style="font-size:14px;">Others</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control description-input editable-field" name="description[]" style="font-size:14px;" placeholder="Description">
                            </td>
                            <td>
                                <select class="form-control uom-select editable-field" name="uoms[]" style="font-size:14px;">
                                    <option style="font-size:14px;" disabled selected>Select</option>
                                    <option style="font-size:14px;" >Per Day</option>
                                    <option style="font-size:14px;">Per Pc</option>
                                    <option style="font-size:14px;">Per Incident</option>
                                    <option style="font-size:14px;">Per Km</option>
                                    <option style="font-size:14px;">N/A</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control rate-input editable-field" name="rate[]" style="font-size:14px;" step="any" min="0">
                            </td>
                            <td>
                                <input type="text" class="form-control qty-input editable-field" name="quantitie[]" style="font-size:14px;" step="any" min="0">
                            </td>
                            <td>
                                <input type="text" class="form-control amount-input" name="amount[]" style="font-size:14px;" pattern="\d*" step="any" min="0">
                            </td>
                            <td>
                                <button class="btn btn-success editable-field" id="addNewRow" onclick="populateNewRow()"><i class="fa fa-plus" style="font-size: 12px;color:#FFF"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row" style="font-size:14px;">
                <div class="col-md-12" style="padding-right:0px">
                    <div class="panel m-3 mt-0" style="box-shadow:none; border-radius:0px;">
                        <div class="panel-content" style="box-shadow:none; border-radius:0px; border-top:0px;padding-left:0;padding-right:0;">
                            <!-- <?php 
                                // Filter out empty GST values
                                $filteredGstDetails = array_filter($gstDetail, function ($item) {
                                    return !empty(trim($item['gst']));
                                });

                                // Determine if GST fields should be shown
                                $showGstFields = !empty($filteredGstDetails);
                            ?> -->

                            <div class="row">
                                <div class="col-lg-4" style="padding-left:0px;">
                                    <div class="form-group row align-items-center hidegstfield">
                                        <label for="refNo" class="col-sm-4 col-form-label" style="font-size:14px;"><b>GST Number</b></label>
                                        <div class="col-sm-8">
                                            <select name="gstnumber" class="form-control editable-field" id="gstnumber" style="font-size:14px;">
                                                <?php foreach ($gstDetail as $gst): ?>
                                                    <option value="<?= htmlspecialchars($gst['id']) ?>" style="font-size:14px;">
                                                        <?= htmlspecialchars(empty(trim($gst['gst'])) ? 'NA' : $gst['gst']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group row align-items-center hidegstfield">
                                        <label for="address" class="col-sm-4 col-form-label" style="font-size:14px;"><b>GSTIN</b></label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" name="gst_percentage" class="form-control editable-field" id="gst_percentage" style="font-size:14px;" placeholder="18.00">
                                            <div class="input-group-append">
                                                <button type="button" onclick="toggleGSTInput()" class="btn btn-rounded btn-info gst editable-field" style="width:37px;">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dynamically adjust column width for Sub Total -->
                                <div class="col-lg-5">
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-5 col-form-label" style="padding-top:0px;font-size:14px;text-align:end;align-self:center;">
                                            <b>Sub Total</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" name="subtotal" value="<?= htmlspecialchars($billing_data['sub_total'] ?? 'NA'); ?>" class="form-control editable-field" id="subtotal" style="font-size:14px;" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="row currency_row">
            <!-- Currency Selection -->
            <div class="col-lg-4" style="padding-left:0px;">
                <div class="form-group row align-items-center">
                    <label for="refNo" class="col-sm-4 col-form-label" style="font-size:14px;"><b>Select Currency</b></label>
                    <div class="col-sm-8">
                        <select name="currency_conversion" class="form-control currency_conversion editable-field" style="font-size:14px;">
                            <option value="INR" <?= isset($billing_data['currency']['currency_conversion']) && $billing_data['currency']['currency_conversion'] == 'INR' ? 'selected' : '' ?>>INR</option>
                            <option value="USD" <?= isset($billing_data['currency']['currency_conversion']) && $billing_data['currency']['currency_conversion'] == 'USD' ? 'selected' : '' ?>>USD</option>
                            <option value="NPR" <?= isset($billing_data['currency']['currency_conversion']) && $billing_data['currency']['currency_conversion'] == 'NPR' ? 'selected' : '' ?>>NPR</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Conditional Input -->
            <div class="col-lg-3 currency_input_section" style="<?= !empty($billing_data['currency']['currency_value']) ? '' : 'display: none;' ?>">
                <div class="form-group row align-items-center">
                    <label for="currency_value" class="col-sm-4 col-form-label" style="font-size:14px;"><b>VALUE</b></label>
                    <div class="col-sm-8">
                        <input type="text" name="currency_value" class="form-control currency_value editable-field" value="<?= htmlspecialchars_decode(!empty($billing_data['currency']['currency_value']) ? $billing_data['currency']['currency_value'] : '') ?>" style="font-size:14px;" placeholder="Enter conversion value">
                    </div>
                </div>
            </div>
        </div>



                            <div id="gst">
                            </div>
                            <div class="form-group row align-items-center mr-0">
                                <label for="address" class="col-sm-9 col-form-label" style="text-align:end;font-size:14px;"><b>Total</b></label>
                                <div class="col-sm-3">
                                    <input type="text" value="<?= htmlspecialchars($billing_data['total'] ?? 'NA'); ?>" name="total_amount" class="form-control editable-field" id="total_amount" style="font-size:14px;margin-left:18px;" placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <div class="col-sm-12" style="text-align:end">
                                    <button class="btn btn-rounded btn-info editable-field" type="button" onclick="populateRow()"><b>+ More</b></button>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-bordered text-center mr-3 mb-2">
                                    <tbody id="dynamicTable"></tbody>
                                </table>
                            </div>
                            <div class="form-group row align-items-center mr-0" id="grandtotal">
                                <label for="grand_total" class="col-form-label" style="text-align: end; font-size: 14px; width: 77%;">
                                    <b>Grand Total</b>
                                </label>
                                <div style="width: 20.8%; margin-left: 17px;">
                                    <input type="text" name="grand_total" value="<?= htmlspecialchars($billing_data['grand_total'] ?? 'NA'); ?>" class="form-control editable-field" id="grand_total" style="font-size: 14px;" placeholder="0.00">
                                </div>
                            </div>
                            <!-- <div class="form-group row align-items-center mr-0" id="grandtotal">
                                
                                <div style="width: 100%; margin-left: 17px;">
                                <label for="remark" class="col-form-label" style="text-align: end; font-size: 14px; width: 100%;">Remark
                               
                               </label>
                                    <input type="text" name="remark" value="<?= htmlspecialchars($billing_data['remark'] ?? 'NA'); ?>" class="form-control editable-field" id="remark" style="font-size: 14px;" placeholder="Remark">
                                </div>
                            </div> -->
                            <div class="" style="text-align:end">
                                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                                <button type="submit" class="btn btn-rounded btn-default p-0" style="display: none;">
                                    <a href="<?php echo base_url('cases/generate_taxinvoice/' . $aid. '/' . $companyid); ?>" id="taxinvoice" target="_blank" class="btn btn-rounded btn-warning">Tax Invoice</a>
                                </button>
                                
                                <button type="submit" class="btn btn-rounded btn-default p-0" id="generateBillBtn" <?php echo isset($billing_data['invoice']) && $billing_data['invoice'] ? '' : 'style="display: none;"'; ?>>
                                   
                                    <a href="<?php echo base_url('cases/generate_bill/' . $aid . '/' . $companyid ); ?>" id="generate_bill" target="_blank" class="btn btn-rounded btn-info">Preview</a>

                                </button>
                                <button type="button" class="btn btn-rounded btn-success" id="submitData" value="<?php echo isset($billing_data['invoice']) ? 'Edit' : 'Submit'; ?>">
                                    <?php echo isset($billing_data['invoice']) ? 'Edit' : 'Submit'; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="row gutter-20 payment-receipt" style="margin-bottom:65px;">
        <div class="col-xl-12 col-md-12">
            <section class="panel" style="border: 1px solid #E5E4E2; margin-right:15px;margin-left: 15px; margin-bottom:18px;">
                <div class="row gutter-20">
                    <div class="col-xl-12 col-md-6">
                        <div>
                            <div class="panel-heading d-flex justify-content-between">
                                <h3 class="panel-title col-xl-6 pl-0">Payment Receipt</h3>
                                <a class="panel-title col-xl-6 pr-0" id="balanceAmount" style="text-align:end;">
                                    Balance: <span id="balanceValue">0.00</span>
                                </a>
                            </div>
                            <div class="panel-content">
                                <table class="table-bordered paymentdetail" style="width:100%;">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="text-align:left; padding-left:8px;">Date</th>
                                            <th style="text-align:left; padding-left:8px;">Payment for</th>
                                            <th style="text-align:right; padding-right:8px;">Received Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <!-- Dynamic rows will be appended here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="vendorModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width:1100px;max-width:1100px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vendor List</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="panel" style="box-shadow:none;margin-bottom:5px;">
                                <div class="panel-content panel-activity" style=" padding-bottom:10px;  border-top:none;">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php $this->load->view('adminpanel/vendor/index'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button d-flex justify-content-space-between " class="vendor-btn-modal" style="margin:0px 25px 25px 25px;display:flex !important; justify-content: space-between">
                    <input class="btn case_btn" type="button" value="Add New Vendor" id="update_vendor_modal">

                    <input class="btn case_btn" type="button" value="Add" id="add_vendor_casereference" style="background-color: #e16123;">
                </div>
            </div>
        </div>
    </div>
    <div id="addvendorModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width:1100px;max-width:1100px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New vendor</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="panel" style="box-shadow:none">
                        <form id="addvendor" method="post" enctype="multipart/form-data">
                            <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                                <div class="form-group">
                                    <label for="usertype" style="color:black;">Select User type&nbsp;<span style="color:red;">*</span></label>
                                    <select class="form-control editable-field" name="usertype" required>
                                        <option>Select User Type</option>
                                        <option value="INDIVIDUAL">Individual</option>
                                        <option value="BUINESS" selected>Business</option>
                                    </select>
                                </div>
                                <h4 class="business_details" style="color:#e16123;">Add Vendor</h4>
                                <div class="row business_details">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="vendor" style="color:black;">Vendor&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control" id="newvendor" name="vendor" placeholder="Vendor" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="vendortype" style="color:black;">Vendor Type&nbsp;<span style="color:red;">*</span> </label>
                                            <select id="vendortype-dropdown" class="form-control " name="vendortype">
                                                <option value="">Select Vendor Type</option>
                                            </select>
                                            <input type="hidden" id="selected-vendortype-ids" name="selected-vendortype-ids" value="">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="cinmum" style="color:black;">CIN Number </label>
                                            <input type="text" class="form-control " id="cinmum" name="cinmum" placeholder="CIN Number" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row business_details">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="licencenum" style="color:black;">Licence No</label>
                                            <input type="text" class="form-control " id="licencenum" name="licencenum" placeholder="Licence No" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="licenseimg" style="color:black;">License Image</label>
                                            <input type="file" class="form-control " id="licenseimg" name="licenseimg" accept="image/*" style="padding:3px;">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="website" style="color:black;">Website</label>
                                            <input type="text" class="form-control " id="website" name="website" placeholder="Website" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="business_details" style="color: #e16123;">Add Branch</h4>
                                <div class="row business_details">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="address" style="color:black;">Address&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control address" value="" id="address" name="address" placeholder="Address" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="pincode" style="color:black;">Pincode&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control pincode" value="" id="pincode" name="pincode" placeholder="Pincode" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="state" style="color:black;">State&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control state" value="" id="state" name="state" placeholder="State" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row business_details">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="city" style="color:black;">City&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control city" value="" id="city" name="city" placeholder="city" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="gst" style="color:black;">GST</label>
                                            <input type="text" class="form-control " value="" id="gst" name="gst" placeholder="GST" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <h4 style="color:#e16123;">Add User</h4>
                                <div class="row">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="mobile" style="color:black;">Mobile Number&nbsp;<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control mobile" id="mobile" name="mobile" placeholder="Mobile number" required autocomplete="off">
                                            <!-- <span id="mobile-error" class="text-danger" style="display: none;">Mobile number already exists</span> Error message -->
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="salutation" style="color:black;">Salutation&nbsp;<span style="color:red;">*</span></label>
                                            <select class="form-control " name="salutation" required>
                                                <option value="">Select Salutation</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="firstname" style="color:black;">First Name&nbsp;<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control " id="firstname" name="firstname" placeholder="First Name" required autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="lastname" style="color:black;">Last Name</label>
                                            <input type="text" class="form-control " id="lastname" name="lastname" placeholder="Last Name" autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                                <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                    <input class="btn case_btn" type="submit" value="Connect" id="add_vendor">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal HTML -->
    <div id="addbranchModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New branch</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="panel" style="box-shadow:none">
                        <form id="addbranch" method="post" enctype="multipart/form-data">
                            <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                                <div class="row ">

                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="address" style="color:black;">Address&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control " value="" id="address" name="address" placeholder="Address" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="pincode" style="color:black;">Pincode&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control pincode" value="" id="pincode" name="pincode" placeholder="Pincode" required autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="state" style="color:black;">State&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control state" value="" id="state" name="state" placeholder="State" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="city" style="color:black;">City&nbsp;<span style="color:red;">*</span> </label>
                                            <input type="text" class="form-control city" value="" id="city" name="city" placeholder="city" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="gst" style="color:black;">GST </label>
                                            <input type="text" class="form-control " value="" id="gst" name="gst" placeholder="GST" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                    <input class="btn case_btn" type="submit" value="Add">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal HTML -->
    <div id="adduserModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Success Alert -->
                <div id="user-success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong> <span class="alert-body"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Error Alert -->
                <div id="use-error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Error!</strong> <span class="alert-body"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="panel" style="box-shadow:none">
                        <form id="adduser" method="post" enctype="multipart/form-data">
                            <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="mobile" style="color:black;">Mobile Number&nbsp;<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control editable-field usermobile" id="mobile" name="mobile" placeholder="Mobile number" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="salutation" style="color:black;">Salutation&nbsp;<span style="color:red;">*</span></label>
                                            <select class="form-control editable-field" name="salutation" required>
                                                <option>Select Salutation</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="firstname" style="color:black;">First Name&nbsp;<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control editable-field" id="firstname" name="firstname" placeholder="First Name" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="lastname" style="color:black;">Last Name</label>
                                            <input type="text" class="form-control editable-field" id="lastname" name="lastname" placeholder="Last Name" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                    <input class="btn case_btn" type="submit" value="Add" id="add_vendor">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="vendorNewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height:350px">
                <div class="modal-header">
                    <h5 class="modal-title">Vendor List</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="vendor-center-alert-container">
                    <div id="vendor-success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Success!</strong> Vendor Selected successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="vendor-error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Error!</strong> An error occurred. Please try again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
                <div class="modal-body py-0 mt-4">
                    <!-- Vendor Section -->
                    <div class="panel" style="box-shadow:none ; margin-bottom:10px;">
                        <form id="connect_vendor" method="post" enctype="multipart/form-data">
                            <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group">
                                            <label for="vendor" style="color:black;">Select Vendor&nbsp;<span style="color:red;">*</span>
                                                <span style="float:right;">
                                                    <a href="#addvendorModal" data-toggle="modal">Add Vendor</a>
                                                </span>
                                            </label>
                                            <div class="dropdown-container">
                                                <input type="text" class="form-control vendor-search" id="vendor-search" name="vendor" placeholder="Search Vendor" autocomplete="off">
                                                <div id="vendor-dropdown" class="dropdown-menu vendor-dropdown">
                                                    <input type="hidden" name="selected_vendor_id" value="" class="selected_vendor_id">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="branch" style="color:black;">Select Branch&nbsp;<span style="color:red;">*</span>
                                                <span style="float:right;">
                                                    <a href="#addbranchModal" data-toggle="modal">Add Branch</a>
                                                </span>
                                            </label>
                                            <div class="branch-dropdown-container">
                                                <input type="text" class="form-control branch-search" id="branch-search" name="branch" placeholder="Search Branch" autocomplete="off">
                                                <div id="branch-dropdown" class="branch-dropdown-menu branch-dropdown">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="user" style="color:black;">Select User&nbsp;<span style="color:red;">*</span>
                                                <span style="float:right;">
                                                    <a href="#adduserModal" data-toggle="modal">Add user</a>
                                                </span>
                                            </label>
                                            <input type="text" id="user-search" name="user" class="form-control" placeholder="Search User" autocomplete="off">
                                            <div id="user-dropdown" class="dropdown-container scroll-container px-2">
                                            </div>
                                            <input type="hidden" id="inspectorid" name="inspectorid">
                                        </div>
                                    </div>
                                </div>
                                <div class="button d-flex justify-content-end " style="padding-bottom:10px;">
                                    <input class="btn case_btn" type="submit" value="Connect" id="connect_with_vendor" style="background-color: #e16123;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php $this->load->view('adminpanel/layout/footer'); ?>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>


<script type="text/javascript">

 $(document).ready(function() {
    // Event handler for currency type change
    $('.currency_conversion').change(function() {
        const selected = $(this).val();
        const row = $(this).closest('.currency_row');

        // Show or hide the currency input section based on the selected currency type
        if (selected === 'USD' || selected === 'NPR') {
            row.find('.currency_input_section').show();
        } else {
            row.find('.currency_input_section').hide();
            // Optionally, clear the currency value when INR is selected
            $('input[name="currency_value"]').val('');
        }
    });

    // Check if currency value exists and show/hide the currency input section accordingly
    var currencyConversion = "<?php echo htmlspecialchars_decode(!empty($billing_data['currency']['currency_conversion']) ? $billing_data['currency']['currency_conversion'] : ''); ?>";
    var currencyValue = "<?php echo htmlspecialchars_decode(!empty($billing_data['currency']['currency_value']) ? $billing_data['currency']['currency_value'] : ''); ?>";

    // If the currency is not INR, show the currency input section, otherwise hide it and set currency value to null
    if (currencyConversion !== 'INR' && currencyValue) {
        $('.currency_input_section').show();
    } else {
        $('.currency_input_section').hide();
        // Optionally set the currency value to null for INR
        $('input[name="currency_value"]').val('');
    }
});



    /* ------------------------------------------------------------------------- *
     * Request for TI (By Nandini)
     * ------------------------------------------------------------------------- */
    var defaultCompany = "<?php echo $defaultcompany; ?>";
    var companyName = "<?php echo $companyName; ?>";

    $('#requestForTI').click(function() {
        if (!$(this).prop('disabled')) {
            var aid = "<?php echo $aid; ?>";
            $.ajax({
                url: '<?php echo base_url('billing/updatestatus'); ?>',
                type: 'POST',
                data: {
                    aid: aid,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        Swal.fire({
                            title: "Request Sent",
                            text: "Request for TI has been sent successfully!",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: data.message || 'Error updating status.',
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert('There was an error. Please try again later.');
                }
            });
        }
    });
    /* ------------------------------------------------------------------------- *
     * Getting GST Number dynamically (By Nandini)
     * ------------------------------------------------------------------------- */

    var defaultCompany = "<?php echo $defaultcompany; ?>";
    var selectedBranchId = "<?php echo $billing_data['branchid'] ?? ''; ?>";
    
    // $.ajax({
    //     url: '<?php echo base_url("billing/get_gstnumber"); ?>',
    //     method: 'GET',
    //     data: {
    //         companyId: defaultCompany
    //     },
    //     success: function(response) {
    //         if (typeof response === 'string') {
    //             response = JSON.parse(response);
    //         }
    //         if (response && response.gstnumbers) {
    //             var gstSelect = $("#gstnumber");
    //             gstSelect.empty();
    //             response.gstnumbers.forEach(function(item) {
    //                 var selectedAttr = (item.id == selectedBranchId) ? 'selected' : '';
    //                 gstSelect.append('<option value="' + item.id + '" ' + selectedAttr + ' style="font-size:14px;">' + item.gst + '</option>');
    //             });
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         console.error("Error fetching GST numbers:", error);
    //     }
    // });

    // Enable the "Request for TI" button
    $('#submitData').on('click', function() {
        $('#requestForTI').prop('disabled', false);
        $('#generateBillBtn').show();
    });


    /* ------------------------------------------------------------------------- *
     * Show City, State by Pincode (By KAJAL)
     * ------------------------------------------------------------------------- */
    function search_pincode(pincode) {
        $.ajax({
            url: "searchpincode",
            method: "POST",
            data: {
                pincode: pincode
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    const city = response.data.City || '';
                    const state = response.data.State || '';
                    $(".city").val(city);
                    $(".state").val(state);
                } else {
                    $(".city").val('');
                    $(".state").val('');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching address data:", status, error);
                $(".city").val('');
                $(".state").val('');
            }
        });
    }

    // Fetch vendors
    function fetchVendors() {
        $.ajax({
            url: '<?php echo base_url('vendors'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 200 && response.data && response.data.length) {
                    populateVendorDropdown(response.data);
                } else {
                    $('.vendor-dropdown').html('<p>No vendors found</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching vendors:', xhr.responseText);
                $('.vendor-dropdown').html('<p>Error loading vendors</p>');
            }
        });
    }

    /* ------------------------------------------------------------------------- *
     * Show All Vendors(Company)(By KAJAL)
     * ------------------------------------------------------------------------- */
    function fetchVendorTypes() {
        $.ajax({
            url: '<?php echo base_url('vendortype'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.length) {
                    populateVendorTypeDropdown(response);
                } else {
                    $('#vendortype-dropdown').html('<option>No vendor types found</option>');
                }
            },
            error: function(xhr) {
                console.error('Error fetching vendor types:', xhr.responseText);
                $('#vendortype-dropdown').html('<option>Error loading vendor types</option>');
            }
        });
    }


    function populateVendorTypeDropdown(vendorTypes) {
        const dropdown = $('#vendortype-dropdown');
        dropdown.empty(); // Clear existing options

        // Append default placeholder option
        dropdown.append('<option value="">Select Vendor Type</option>');

        // Append fetched vendor types
        vendorTypes.forEach(function(vendorType) {
            dropdown.append(`<option value="${vendorType.id}">${vendorType.profession}</option>`);
        });
    }

    /* ------------------------------------------------------------------------- *
     * TO POPULATE VENDOR DROPDOWN (By KAJAL)
     * ------------------------------------------------------------------------- */
    function populateVendorDropdown(vendors) {
        const dropdown = $('.vendor-dropdown');
        dropdown.empty();
        let html = '<ul class="dropdown-list">';
        vendors.forEach(function(vendor) {
            html += `<li class="vendor-options" data-id="${vendor.id}">${vendor.companyName}</li>`;
        });
        html += '</ul>';
        dropdown.html(html);

        $('.vendor-options').off('click').on('click', function() {
            const selectedVendorId = $(this).data('id');
            $('.vendor-search').val($(this).text());
            $('.vendor-dropdown').removeClass('active');
            $('.vendor-search').data('selected-vendor-id', selectedVendorId);
            $('.branch-search').val(''); // Clear previous branch selection
            $('#user-search').val(''); // Clear previous user selection
            fetchBranches(); //user Fetch branches based on selected vendor
        });
    }


    /* ------------------------------------------------------------------------- *
     * TO SHOW ADDRESS ACCORDING TO SELECTED VENDOR (By KAJAL)
     * ------------------------------------------------------------------------- */
    // Fetch branches based on the selected vendor
    function fetchBranches() {
        var vendorId = $('.vendor-search').data('selected-vendor-id');
        if (!vendorId) {
            console.error('Vendor ID is missing or not set.');
            return;
        }

        $.ajax({
            url: '<?php echo base_url('branch'); ?>',
            type: 'POST',
            data: {
                vendor: vendorId
            },
            dataType: 'json',
            success: function(response) {
                if (response && Array.isArray(response) && response.length > 0) {
                    $('.branch-dropdown').show(); // Ensure the dropdown is visible
                    populateBranchesDropdown(response);
                } else {
                    $('.branch-dropdown').html('<p>No branches found</p>').show();
                }
            },
            error: function(xhr) {
                console.error('Error fetching branches:', xhr.responseText);
                $('.branch-dropdown').html('<p>Error loading branches</p>').show();
            }
        });
    }

    // Populate the branches dropdown with fetched data
    function populateBranchesDropdown(branches) {
        const dropdown = $('.branch-dropdown');
        dropdown.empty(); // Clear existing items
        let html = '<ul class="dropdown-list">';
        $.each(branches, function(index, branch) {
            html += `<li class="branch-dropdown-item" data-id="${branch.id}">${branch.address}, ${branch.city}, ${branch.state}</li>`;
        });
        html += '</ul>';
        dropdown.html(html);

        // Attach click event to each branch item
        $('.branch-dropdown-item').off('click').on('click', function() {
            const selectedBranchId = $(this).data('id');
            const selectedBranchText = $(this).text();
            $('.branch-search').val(selectedBranchText);
            $('.branch-dropdown').removeClass('active').hide(); // Hide dropdown
            $('.branch-search').data('selected-branch-id', selectedBranchId);
            $('#user-search').val(''); // Clear previous user selection
            fetchUsers(); // Fetch users based on selected branch
        });
    }

    /* ------------------------------------------------------------------------- *
     *SHOW ALL USERS  (By KAJAL)
     * ------------------------------------------------------------------------- */
    // Fetch users based on selected branch
    function fetchUsers(mobileNumber) {
        $.ajax({
            url: "<?php echo base_url('users'); ?>", // Your backend URL to fetch users
            type: 'POST',
            data: {
                mobile: mobileNumber // Send the mobile number to the server
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.mobile) {
                    // Create the HTML content for the dropdown
                    let html = `<ul class="dropdown-list">
                                <li class="user-dropdown-item" data-id="${response.id}" data-mobile="${response.mobile}">
                                    ${response.firstname} ${response.lastname}, ${response.mobile}
                                </li>
                            </ul>`;

                    // Display the results
                    $('#user-dropdown').html(html).addClass('active');

                    // Attach click event to the dropdown item
                    attachUserSelectionEvent();
                } else {
                    $('#user-dropdown').html('<p>No users found</p>').addClass('active');
                }
            },
            error: function(xhr) {
                console.error('AJAX error:', xhr.responseText);
                $('#user-dropdown').html('<p>Error loading users</p>').addClass('active');
            }
        });
    }

    function filterUsersByMobile(users, mobileNumber) {
        const dropdown = $('#user-dropdown');
        dropdown.empty(); // Clear existing items

        let matchFound = false;
        let html = '<ul class="dropdown-list">';

        users.forEach(function(user) {
            const userMobile = user.mobile.toString();

            // If the entered number matches the user's mobile number
            if (userMobile === mobileNumber) {
                html += `<li class="user-dropdown-item" data-id="${user.vendor_uid}" data-mobile="${user.mobile}">
                    ${user.firstname} ${user.lastname}, ${user.mobile}
                 </li>`;
                matchFound = true;
            } else {
                dropdown.html('<p>No such result found</p>').addClass('active');
            }

        });

        html += '</ul>';

        // Show dropdown or no result message
        if (matchFound) {
            dropdown.html(html).addClass('active');
            attachUserSelectionEvent();
        } else {
            dropdown.html('<p>Please enter correct mobile number of user</p>').addClass('active');
        }
    }
    // Attach click event to user dropdown items
    function attachUserSelectionEvent() {
        $('.user-dropdown-item').off('click').on('click', function() {
            const selectedUserId = $(this).data('id');
            $('#user-search').val($(this).text());
            $('#user-dropdown').removeClass('active');
            $('#user-search').data('selected-user-id', selectedUserId);
        });
    }

    /* ------------------------------------------------------------------------- *
     *TO CHECK MOBILE NUMBER EXISTENCE (By KAJAL)
     * ------------------------------------------------------------------------- */
    function checkMobileExists(mobileNumber) {
        if (mobileNumber === '') {
            $('#mobile-error').text('Please enter a mobile number').show();
            return;
        }

        $.ajax({
            url: "<?php echo base_url('allusers'); ?>", // Assume baseUrl is set globally in your script
            type: 'POST',
            data: {
                mobile: mobileNumber
            },
            dataType: 'json',
            success: function(response) {
                if (response.exists) {
                    // Show user name when mobile number matches
                    const userData = response.data;
                    const fullName = `${userData.salutation} ${userData.firstname} ${userData.lastname}`;

                    $('#user-name-display').text(fullName); // Show the full name

                    // Populate the form fields with the retrieved user data
                    $('select[name="salutation"]').val(userData.salutation) // Populate and disable
                    $('input[name="firstname"]').val(userData.firstname) // Populate and disable
                    $('input[name="lastname"]').val(userData.lastname) // Populate and disable
                    $('input[name="mobile"]').val(userData.mobile);

                } else {
                    $('#mobile-error').hide();
                    $('#user-name-display').text(''); // Clear name display if no match
                }
            },
            error: function(xhr) {
                console.error('Error checking mobile number:', xhr.responseText);
                $('#mobile-error').text('Error checking mobile number').show();
            }
        });
    }

    /* ------------------------------------------------------------------------- *
     *TO SUBMIT BILLING DATA
     * ------------------------------------------------------------------------- */
    function submitData() {
        if (!validateRows()) {
            return; // Stop the function if validation fails
        }
        const invoiceData = collectRowData('.item-row');
        const additionalExpensesData = collectAdditionalRowData('.itemr');
       
        let formData = {
            aid: $('#aid').val(),
            invoice: JSON.stringify(invoiceData), // Collect your invoice data here
     
            additional_expenses: JSON.stringify(additionalExpensesData), // Collect your additional expenses data
            subtotal: $('#subtotal').val(),
            total: $('#total').val(),
            grandtotal: $('#grandtotal').val()
        };

        // If no rows are valid, show an alert
        if (invoiceData.length === 0) {
            showErrorAlert("Please fill in all required fields before submitting.");
            return; // Stop the function if no valid data
        }

        // Prepare data for AJAX submission
        let postData = preparePostData(invoiceData, additionalExpensesData);

        // Log prepared data for debugging


        // Sending data via AJAX
        $.ajax({
            url: '<?php echo base_url('billing/insertBillingData'); ?>',
            type: 'POST',
            data: postData,
            success: function(response) {
                

                handleAjaxResponse(response);
                if (response.status === 'success') {
                    fetchBilling();

                    $('#billingSection').show();
                    $(".venorbtn").prop('disabled', true).css('opacity', '0.6');
                    $(".addfieldmodal").prop('disabled', true).css('opacity', '0.6');



                    // Show the billing section here
                } else {
                    // $('#billingSection').hide();
                    // showErrorAlert(response.message || 'Failed to submit data.');
                }
            },
            error: function(xhr) {
                console.error('AJAX error: ', xhr.responseText);
                showErrorAlert('An error occurred. Please try again later.');
            }
        });
    }

    /* ------------------------------------------------------------------------- *
     *TO SHOW BILLING DATA
     * ------------------------------------------------------------------------- */
   function fetchBilling() {
    let aid = "<?php echo htmlspecialchars($aid); ?>";

    $.ajax({
        url: '<?php echo base_url('billing/fetchBillingData'); ?>',
        type: 'POST',
        data: {
            aid: aid
        },
        cache: false,
        success: function(response) {
            let data;
            try {
                data = JSON.parse(response);
            } catch (e) {
                console.error("JSON parsing error:", e);
                return;
            }

            if (data.status === 'success') {
                let billing_data = data.billing_data;
              

                if (!billing_data || billing_data.length === 0) {
                    alert("No billing data found.");
                    return;
                }

                // Clear existing rows in the billing table
                $('#billing tbody').empty();

                // Add new rows for each item in billing_data
                billing_data.forEach((row) => {
                    addNewRow([row]); // Wrap row in an array for addNewRow
                });

                // Update totals and other fields if needed
                let billingSummary = billing_data[0] || {};

                // Set total_amount dynamically
                $('#total_amount').val(billingSummary.total || '0.00');

                // Update other fields as needed
                $('#subtotal').val(billingSummary.subtotal || '0.00');
                $('#grand_total').val(billingSummary.grand_total || '0.00');
                $('#gst_percentage').val(billingSummary.gst_percentage || '0.00');
                $('#igst_percentage').val(billingSummary.igst_percentage || '0.00');
                $('#cgst_percentage').val(billingSummary.cgst_percentage || '0.00');
                $('#sgst_percentage').val(billingSummary.sgst_percentage || '0.00');
                $('.calculatedgst').val(billingSummary.calculatedgst || '0.00');

                // Extract billing and shipping information
                const billingInfo = billingSummary.bill_to ? billingSummary.bill_to : {};
                const shippingInfo = billingSummary.ship_to ? billingSummary.ship_to : {};

                // Set currency dropdown and value input
                // let currencyType = billingSummary.currency?.currency_type || 'INR';
                // let currencyValue = billingSummary.currency?.currency_value || '';

                // console

                // // Set the currency dropdown
                // $('select.currency_conversion').val(currencyType);

                // // Show/hide the currency value input based on selection
                // if (currencyType !== 'INR') {
                //     $('.currency_input_section').show();
                //     $('input.currency_value').val(currencyValue);
                // } else {
                //     $('.currency_input_section').hide();
                //     $('input.currency_value').val('');
                // }

                // Populate billing details
                $('#billing_payment_by').val(billingInfo.billing_payment_by || '');
                $('#billing_branch_name').val(billingInfo.billing_branch_name || '');
                $('#billing_user_name').val(billingInfo.billing_user_name || '');
                $('#billing_mobile_num').val(billingInfo.billing_mobile_num || '');
                $('#billing_gst').val(billingInfo.billing_gst || '');

                // Populate shipping details
                $('#shipping_payment_by').val(shippingInfo.shipping_payment_by || '');
                $('#shipping_branch_name').val(shippingInfo.shipping_branch_name || '');
                $('#shipping_user_name').val(shippingInfo.shipping_user_name || '');
                $('#shipping_mobile_num').val(shippingInfo.shipping_mobile_num || '');
                $('#shipping_gst').val(shippingInfo.shipping_gst || '');

                // Update GST dropdown if necessary
                $("#gstnumber option").each(function() {
                    if ($(this).val() === billingSummary.branchid) {
                        $(this).prop("selected", true);
                    }
                });

                // Update payment detail table if needed
                const currentDate = new Date().toLocaleDateString();
                const paymentMode = "Receivable Invoice";
                const grandTotal = billingSummary.grand_total || '0.00';

                $('.paymentdetail tbody').append(`
                    <tr>
                        <td class="text-start" style="text-align:left;padding-left:8px;">
                            <a href="#" class="btn-link">${currentDate}</a>
                        </td>
                        <td class="text-start" style="text-align:left;padding-left:8px;">
                            <a href="#" class="btn-link text-start">${paymentMode}</a>
                        </td>
                        <td class="text-end" style="text-align:right;padding-left:8px;">${grandTotal}</td>
                    </tr>
                `);
            } else {
                alert('Failed to fetch billing data. Please try again later.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('An error occurred while fetching billing data. Please try again.');
        }
    });
}


    /* ------------------------------------------------------------------------- *
     * ROW FOR INVOICES WITH DATA (By KAJAL)
     * ------------------------------------------------------------------------- */
    function addNewRow(data) {
        // Ensure data is an array
        if (!Array.isArray(data)) {
            // console.error('Expected an array for data, but got:', data);
            return;
        }
        const currentRows = $('#billing tbody tr.item-row').length;

        // Loop through the provided data to create new rows
        data.forEach((invoice) => {
            const isDisabled = invoice ? 'disabled' : '';

            const newRow = $(`
            <tr class="item-row">
                <td>
                    <select class="form-control item-select editable-field" name="item[]" ${isDisabled} style="font-size:14px;">
                        <option >Select Item</option>
                        <option value="Survey Fee" ${invoice.item === 'Survey Fee' ? 'selected' : ''}>Survey Fee</option>
                        <option value="Professional Fee" ${invoice.item === 'Professional Fee' ? 'selected' : ''}>Professional Fee</option>
                        <option value="DA" ${invoice.item === 'DA' ? 'selected' : ''}>DA</option>
                        <option value="Conveyance Outstation" ${invoice.item === 'Conveyance Outstation' ? 'selected' : ''}>Conveyance Outstation</option>
                        <option value="Conveyance Local" ${invoice.item === 'Conveyance Local' ? 'selected' : ''}>Conveyance Local</option>
                        <option value="Hotel Bill" ${invoice.item === 'Hotel Bill' ? 'selected' : ''}>Hotel Bill</option>
                        <option value="Investigation Fee" ${invoice.item === 'Investigation Fee' ? 'selected' : ''}>Investigation Fee</option>
                        <option value="Out of Pocket Expenses" ${invoice.item === 'Out of Pocket Expenses' ? 'selected' : ''}>Out of Pocket Expenses</option>
                        <option value="Photos" ${invoice.item === 'Photos' ? 'selected' : ''}>Photos</option>
                        <option value="Photos on CD" ${invoice.item === 'Photos on CD' ? 'selected' : ''}>Photos on CD</option>
                        <option value="Videos on CD" ${invoice.item === 'Videos on CD' ? 'selected' : ''}>Videos on CD</option>
                        <option value="Others" ${invoice.item === 'Others' ? 'selected' : ''}>Others</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="description[]" class="form-control description-input editable-field" ${isDisabled} style="font-size:14px;" placeholder="Description" value="${invoice.description || ''}">
                </td>
                <td>
                    <select class="form-control uom-select editable-field" name="uoms[]" ${isDisabled} style="font-size:14px;">
                        <option  ${invoice.uom ? '' : 'selected'}>Select</option>
                        <option value="Per Day" ${invoice.uom === 'Per Day' ? 'selected' : ''}>Per Day</option>
                        <option value="Per Pc" ${invoice.uom === 'Per Pc' ? 'selected' : ''}>Per Pc</option>
                        <option value="Per Incident" ${invoice.uom === 'Per Incident' ? 'selected' : ''}>Per Incident</option>
                        <option value="Per Km" ${invoice.uom === 'Per Km' ? 'selected' : ''}>Per Km</option>
                        <option value="N/A" ${invoice.uom === 'N/A' ? 'selected' : ''}>N/A</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="rate[]" ${invoice.rate ? 'disabled' : ''} class="form-control rate-input editable-field" placeholder="Rate" value="${invoice.rate || ''}">
                </td>
                <td>
                    <input type="text" name="quantitie[]" ${invoice.qty ? 'disabled' : ''} class="form-control qty-input editable-field"  placeholder="Quantity" value="${invoice.qty || ''}">
                </td>
                <td>
                    <input type="text" name="amount[]" ${invoice.amount ? 'disabled' : ''} class="form-control amount-input " pattern="\\d*" placeholder="Amount" value="${invoice.amount || ''}">
                </td>
               <td class="text-end align-self-end">
                ${currentRows === 0 ? `<button class="btn btn-success editable-field" onclick="populateNewRow()" id="addNewRow" ${invoice ? 'disabled' : ''}><i class="fa fa-plus" style="font-size: 12px;color:#FFF"></i></button>` : ''}
                ${currentRows > 0 ? `<button class="btn btn-danger remove-btn" onclick="removeRow(this)" ${invoice ? 'disabled' : ''}><i class="fa fa-times" style="font-size: 12px;color:#FFF"></i></button>` : ''}
            </td>


            </tr>
        `);

            $('#billing tbody').append(newRow); // Append the new row to the table
        });
    }

    /* ------------------------------------------------------------------------- *
     * ROW FOR INVOICES  (By KAJAL)
     * ------------------------------------------------------------------------- */
    function populateNewRow() {
        var newRow = `
        <tr class="item-row">
            <td>
                <select class="form-control item-select editable-field" name="item[]" style="font-size:14px;">
                     <option value="" style="font-size:14px;" disabled selected>Select Item</option>
                    <option style="font-size:14px;">Survey Fee</option>
                    <option style="font-size:14px;">Professional Fee</option>
                    <option style="font-size:14px;">DA</option>
                    <option style="font-size:14px;">Conveyance Outstation</option>
                    <option style="font-size:14px;">Conveyance Local</option>
                    <option style="font-size:14px;">Hotel Bill</option>
                    <option style="font-size:14px;">Investigation Fee</option>
                    <option style="font-size:14px;">Out of Pocket Expenses</option>
                    <option style="font-size:14px;">Photos</option>
                    <option style="font-size:14px;">Photos on CD</option>
                    <option style="font-size:14px;">Videos on CD</option>
                    <option style="font-size:14px;">Others</option>
                </select>
            </td>
            <td><input type="text" name="description[]" class="form-control description-input editable-field" style="font-size:14px;" placeholder="Description"></td>
            <td>
                <select class="form-control uom-select editable-field" name="uoms[]" style="font-size:14px;">
                    <option  disabled selected>Select</option>
                    <option  selected style="font-size:14px;">Per Day</option>
                    <option style="font-size:14px;">Per Pc</option>
                    <option style="font-size:14px;">Per Incident</option>
                    <option style="font-size:14px;">Per Km</option>
                    <option style="font-size:14px;">N/A</option>
                </select>
            </td>
            <td><input type="text" name="rate[]" class="form-control rate-input editable-field" step="any" min="0"></td>
            <td><input type="text" name="quantitie[]" class="form-control qty-input editable-field" pattern="\\d*" step="any" min="0"></td>
            <td><input type="text"  name="amount[]" class="form-control amount-input "  pattern="\\d*" step="any" min="0"></td>
            <td><button class="btn btn-danger remove-row"><i class="fa fa-times" style="font-size: 12px;color:#FFF"></i></button></td>
        </tr>
     `;

        // Append the new row to the billing table body
        $('.billing tbody').append(newRow);

        // Attach event listeners and update totals
        attachRowEventListeners($('.billing tbody tr:last-child'), 'item-row'); // Attach listeners for new row
        calculateTotals(); // Update totals after adding the new row

        // Attach a click event for removing the row
        $('.remove-row').click(function() {
            $(this).closest('tr').remove();
            calculateTotals(); // Recalculate totals after removing the row
        });
    }


    /* ------------------------------------------------------------------------- *
     * FETCH PAYMENT RECEIPT DATA
     * ------------------------------------------------------------------------- */
    function fetchAmount() {
        let aid = "<?php echo htmlspecialchars($aid); ?>"; // Ensure this is available
        var paymentreceipt = <?php echo json_encode(isset($paymentreceipt) ? $paymentreceipt : null); ?>;

        $.ajax({
            url: '<?php echo base_url('billing/fetchAmountData'); ?>',
            type: 'POST',
            data: {
                aid: aid
            },
            success: function(response) {
                let data;

                // Try parsing the response
                try {
                    data = JSON.parse(response);
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    alert('An error occurred while processing data. Please try again later.');
                    return;
                }

                if (data.status === 'success' && Array.isArray(data.data)) {
                    let tbody = $('.paymentdetail tbody');
                    tbody.empty(); // Clear any existing rows
                    let totalReceived = 0;

                    // Loop through the array of payment data
                    data.data.forEach(function(paymentDataRow) {
                        let paymentReceipts = paymentDataRow.paymentreceipt;

                        // Ensure that paymentreceipt is an array
                        if (Array.isArray(paymentReceipts)) {
                            paymentReceipts.forEach(function(paymentInfo) {
                                // Create a new row for each payment record
                                const newRow = $(`
                                <tr>
                                    <td style="text-align:left; padding-left:8px;">
                                        <a href="#" class="btn-link">${paymentInfo.date || '-'}</a>
                                    </td>
                                    <td style="text-align:left; padding-left:8px;">
                                        <a href="#" class="btn-link">${paymentInfo.payment_for || '-'}</a>
                                    </td>
                                    <td style="text-align:right; padding-right:8px;">
                                        <a href="#" class="btn-link">${paymentInfo.amount || '-'}</a>
                                    </td>
                                </tr>
                            `);

                                tbody.append(newRow); // Append the row to the table
                                totalReceived += parseFloat(paymentInfo.amount) || 0; // Add to the total amount
                            });
                        }
                    });

                    // Optionally update the total received value
                    $('#balanceValue').text(totalReceived.toFixed(2) + '/-');
                } else {
                    console.warn('No valid data found.');
                    // alert(data.message || 'No payment data found.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('An error occurred while fetching data. Please try again.');
            }
        });
    }

    function showAlert(title, message) {
        alert(`${title}: ${message}`);
    }
    /* ------------------------------------------------------------------------- *
     * CALCULATE CGST, SGST OR IGST ON THE BASIS OF GST NUMBER OF BILL TO (GST NUMBER)
     * ------------------------------------------------------------------------- */
    function updateGSTFields() {
        const gstInput = parseFloat($('#gst_percentage').val()) || 0; // GST percentage
        const gst1 = $('input[type="text"]#gstn').val().trim();
        const gst2 = $('#gstnumber option:selected').text().trim();

        // console.log(gstInput);
        // console.log(gst1);
        // console.log(gst2);
        // if (!gst1 || !gst2 || gstInput <= 0 || gstInput > 100) {
        //     $('.hidegstfield').addClass('hidden');
        //     $('#cgst_percentage, #sgst_percentage, #igst_percentage').val('');
        //     return;
        // } else {
        //     $('.hidegstfield').removeClass('hidden');
        // }

        const stateCode1 = gst1.substring(0, 2);
        const stateCode2 = gst2.substring(0, 2);
        if (stateCode1 === stateCode2) {
            // Intra-state: Half CGST and half SGST
            const halfGST = (gstInput / 2).toFixed(2);
            $('#cgst_percentage').val(`${halfGST}%`);
            $('#sgst_percentage').val(`${halfGST}%`);
            $('#igst_percentage').val(''); // Clear IGST
        } else if(stateCode1 != stateCode2) {
            // Inter-state: Full IGST
            $('#igst_percentage').val(`${gstInput.toFixed(2)}%`);
            $('#cgst_percentage, #sgst_percentage').val(''); // Clear CGST and SGST
        }
        calculateTotals();
    }

    updateGSTFields();
    /* ------------------------------------------------------------------------- *
     * APPLY VALIDATION ON INVOICE ROW  (By KAJAL)
     * ------------------------------------------------------------------------- */
    function validateRow(row) {
        const item = $(row).find('select.item-select').val(); // Item
        const description = $(row).find('input.description-input'); // Description
        const uom = $(row).find('select.uom-select').val(); // UOM
        const rate = $(row).find('input.rate-input'); // Rate
        const qty = $(row).find('input.qty-input'); // Quantity
        const amount = $(row).find('input.amount-input'); // Amount

        const errorMessages = []; // Array to hold error messages

        //Reset error classes before validation
        description.removeClass('error');
        rate.removeClass('error');
        qty.removeClass('error');
        amount.removeClass('error');

        // Validate fields
        if (!item) errorMessages.push("Item is required.");
        if (!uom) errorMessages.push("UOM is required.");
        if (!rate.val()) {
            errorMessages.push("Rate is required.");
            rate.addClass('error');
        }
        if (!qty.val()) {
            errorMessages.push("Quantity is required.");
            qty.addClass('error');
        }
        if (!amount.val()) {
            errorMessages.push("Amount is required.");
            amount.addClass('error');
        }

        return errorMessages; // Return the array of error messages
    }


    /* ------------------------------------------------------------------------- *
     * APPLY VALIDATION ON INVOICE ROW (By KAJAL)
     * ------------------------------------------------------------------------- */
    function validateRows() {
        let isValid = true; // Flag to track overall validity
        const allErrorMessages = []; // Array to collect all error messages

        // Check each row for required fields
        $('.item-row').each(function() {
            const rowErrors = validateRow(this); // Validate the current row
            if (rowErrors.length > 0) {
                isValid = false; // Set validity to false if errors found
                allErrorMessages.push(...rowErrors); // Add row-specific errors to the overall array
            }
        });

        if (!isValid) {
            // Show all collected error messages in a single alert
            alert(allErrorMessages.join("\n")); // Display all error messages at once
        }

        return isValid; // Return the overall validity
    }


    /* ------------------------------------------------------------------------- *
     * ADD BILL TO  FROM VENDOR DATA (By KAJAL)
     * ------------------------------------------------------------------------- */
    function collectBillingData(selector) {
        let data = [];
        $(selector).each(function(index) {
            let paymentBy = $(this).find('.billing_payment_by').val();
            let branchName = $(this).find('.billing_branch_name').val();
            let userName = $(this).find('.billing_user_name').val();
            let mobileNumber = $(this).find('.billing_mobile_num').val();
            let gstNumber = $(this).find('.billing_gst').val();
            let billingid = $(this).find('.billingto').val();
            // Push the data to the array
            data.push({
                billing_payment_by: paymentBy,
                billing_branch_name: branchName,
                billing_user_name: userName,
                billing_mobile_num: mobileNumber,
                billing_gst: gstNumber,
                billing_id: billingid
            });
        });
        return data;
    }

    /* ------------------------------------------------------------------------- *
     * ADD  SHIP TO FROM VENDOR DATA (By KAJAL)
     * ------------------------------------------------------------------------- */
    function collectShippingData(selector) {
        let data = [];
        $(selector).each(function(index) {
            let paymentBy = $(this).find('.shipping_payment_by').val();
            let branchName = $(this).find('.shipping_branch_name').val();
            let userName = $(this).find('.shipping_user_name').val();
            let mobileNumber = $(this).find('.shipping_mobile_num').val();
            let gstNumber = $(this).find('.shipping_gst').val();
            let shippingtoid = $(this).find('.shippingto').val();
            // Push the data to the array
            data.push({
                shipping_payment_by: paymentBy,
                shipping_branch_name: branchName,
                shipping_user_name: userName,
                shipping_mobile_num: mobileNumber,
                shipping_gst: gstNumber,
                shipbilling_id: shippingtoid
            });
        });
        return data;
    }

    /* ------------------------------------------------------------------------- *
     * CALCULATE ROW DATA OF INVOICE (By KAJAL)
     * ------------------------------------------------------------------------- */
    function collectRowData(selector) {
        let data = [];
        $(selector).each(function(index) {
            let item = $(this).find('select.item-select').val();
            let description = $(this).find('input[type="text"]').val();
            let uom = $(this).find('select.uom-select').val();
            let rate = parseFloat($(this).find('.rate-input').val()?.replace(/,/g, '')) || 0;
            let qty = parseFloat($(this).find('.qty-input').val()?.replace(/,/g, '')) || 0;
            let amount = parseFloat($(this).find('.amount-input').val()?.replace(/,/g, '')) || 0;
            // Check for invalid or missing data
            if (item && uom && !isNaN(rate) && rate > 0 && qty > 0) {
                data.push({
                    item: item,
                    description: description,
                    uom: uom,
                    rate: rate.toFixed(2),
                    qty: qty,
                    amount: amount.toFixed(2)
                });
            } else {
                console.log(`One or more fields in row ${index + 1} are invalid. Skipping this row.`);
            }
        });
        return data;
    }


    /* ------------------------------------------------------------------------- *
     * CALCULATE ADDITIONAL EXPENSES ROW DATA OF INVOICE (By KAJAL) 
     * ------------------------------------------------------------------------- */
    function collectAdditionalRowData(selector) {
        let data = [];
        $(selector).each(function(index) {
            // Collect the values from each field in the row
            let item = $(this).find('select.item-select').val();
            let description = $(this).find('input[type="text"]').val();
            let uom = $(this).find('select.uom-select').val();
            let rate = parseFloat($(this).find('.rate-input').val()?.replace(/,/g, '')) || 0;
            let qty = parseFloat($(this).find('.qty-input').val()?.replace(/,/g, '')) || 0;
            let amount = parseFloat($(this).find('.amount-input').val()?.replace(/,/g, '')) || 0;

            // Log data for debugging

            // Check for invalid or missing data
            if (item && uom && !isNaN(rate) && rate > 0 && qty > 0) {
                data.push({
                    item: item,
                    description: description,
                    uom: uom,
                    rate: rate.toFixed(2),
                    qty: qty,
                    amount: amount.toFixed(2)
                });
            } else {
                console.log(`Row ${index + 1} is either disabled or has invalid data. Skipping this row.`);
            }
        });
        return data;
    }

    function collectcurrencyRowData(selector) {
        let data = [];
        $(selector).each(function() {
            let currency_conversion = $(this).find('select.currency_conversion').val();
            let currency_value = $(this).find('input[name="currency_value"]').val() || '';
            
            data.push({
                currency: currency_conversion,
                value: currency_value
            });
        });
        return data;
    }




    /* ------------------------------------------------------------------------- *
     * ADD RECEIPT
     * ------------------------------------------------------------------------- */
    function sendAmount() {
        var payment_for = $('input[name="payment_for"]').val();
        var amount = $('input[name="amount"]').val();
        var date = $('input[name="date"]').val();
        let aid = "<?php echo htmlspecialchars($aid); ?>";

        let payment_data = {
            payment_for: payment_for,
            amount: amount,
            date: date
        };

        $.ajax({
            url: 'billing/updateBillingPayment',
            type: 'POST',
            data: {
                payment_data: JSON.stringify(payment_data),
                aid: aid
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert('Payment data added successfully!');
                } else {
                    alert('Failed to add payment data.');
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }


    /* ------------------------------------------------------------------------- *
     * TO FORMAT VALUES
     * ------------------------------------------------------------------------- */
    function formatRupees(value) {
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    /* ------------------------------------------------------------------------- *
     * Parses a formatted currency string into a numeric value.
     * ------------------------------------------------------------------------- */
    function parseCurrency(value) {
        return parseFloat(value.replace(/,/g, '')) || 0;
    }

    /* ------------------------------------------------------------------------- *
     * Calculates the total amount for a row based on rate and quantity.
     * ------------------------------------------------------------------------- */
    function calculateRowAmount(rate, qty) {
        return rate * qty;
    }

    /* ------------------------------------------------------------------------- *
     * TO CALCULATE AMOUNT, BASED ON QTY AND RATE
     * ------------------------------------------------------------------------- */
    function calculateTotals() {
        let subtotal = 0;

        $('.item-row').each(function () {
            let $row = $(this);
            let rate = parseCurrency($row.find('.rate-input').val());
            let qty = parseCurrency($row.find('.qty-input').val());

            if (isNaN(rate) || isNaN(qty)) {
                console.warn('Invalid rate or quantity in row:', $row);
                return;
            }

            let amount = calculateRowAmount(rate, qty);
            $row.find('.amount-input').val(formatIndianCurrency(amount));
            subtotal += amount;
        });

        $('#subtotal').val(formatIndianCurrency(subtotal));
        let gstNumber = $.trim($('#gstnumber option:selected').text()); // Trim spaces
        // console.log('Selected GST Number:', gstNumber);

        // If no GST number is selected or it's blank, skip GST calculation
        if (!gstNumber || gstNumber === "" || gstNumber === "NA") {
            // console.log('No GST Number selected, skipping GST calculation.');
            $('.calculatedgst').val('0.00');
            $('#total_amount').val(formatIndianCurrency(subtotal));
            return; 
        }
        let gstPercentage = parseCurrency($('#gst_percentage').val());
        if (isNaN(gstPercentage) || gstPercentage <= 0) {
            gstPercentage = 0;
        }
        let gstAmount = (subtotal * gstPercentage) / 100;
        let total = subtotal + gstAmount;

        $('.calculatedgst').val(gstAmount);
        $('#total_amount').val(formatIndianCurrency(total));
    }


    /* ------------------------------------------------------------------------- *
     * TO CALCULATE GRAND TOTAL
     * ------------------------------------------------------------------------- */
    function updateGrandTotalOnly() {
        let dynamicTotal = 0;

        // Iterate through dynamic rows with class 'itemr'
        $('.itemr').each(function() {
            let rate = parseCurrency($(this).find('.rate-input').val()) || 0;
            let qty = parseCurrency($(this).find('.qty-input').val()) || 0;

            // Calculate row amount (rate * qty)
            let amount = rate * qty;
            $(this).find('.amount-input').val(formatIndianCurrency(amount));

            // Accumulate the dynamic total
            dynamicTotal += amount;
        });

        // Get the initial total amount (subtotal + GST) from the form
        let totalAmount = parseCurrency($('#total_amount').val()) || 0;

        // Calculate the grand total (initial total + dynamic total)
        let grandTotal = totalAmount + dynamicTotal;

        // Update the grand total field with formatted currency
        $('#grand_total').val(formatIndianCurrency(grandTotal));
    }

    /* ------------------------------------------------------------------------- *
     * TO SHOW IGST, CGST, SGST BASED ON VENDOR GST
     * ------------------------------------------------------------------------- */
    function gstdetail(gst1, gst2) {
        var tax = <?php echo json_encode(isset($billing_data['tax']) ? $billing_data['tax'] : null); ?>;
        $('#gst').html(""); // Clear previous results
            const stateCode1 = gst1.substring(0, 2);
            const stateCode2 = gst2.substring(0, 2);
            let gstfield = '';
            if($('#gstnumber option:selected').text() != "NA"){
              
                if(stateCode1 === stateCode2){
                    // Intra-state transaction (same state codes)
                    gstfield = `
                    <div class="form-group row align-items-center mr-0">
                        <label for="cgst_percentage" class="col-sm-9 col-form-label" style="text-align:end;font-size:14px;"><b>CGST %</b></label>
                        <div class="col-sm-3">
                            <input type="text" name="cgst_percentage" style="font-size:14px;margin-left:18px;" class="form-control editable-field" id="cgst_percentage" placeholder="0.00" ${tax ? 'disabled' : ''}>
                        </div>
                    </div>
                    <div class="form-group row align-items-center mr-0">
                        <label for="sgst_percentage" class="col-sm-9 col-form-label " style="text-align:end;font-size:14px;"><b>SGST %</b></label>
                        <div class="col-sm-3">
                            <input type="text" name="sgst_percentage" style="font-size:14px;margin-left:18px;" class="form-control editable-field" id="sgst_percentage" placeholder="0.00" ${tax ? 'disabled' : ''}>
                        </div>
                    </div>  
                    <input type="hidden" name="calculatedgst" class="form-control editable-field calculatedgst" placeholder="0.00">
                `;
                } else if(stateCode1 != stateCode2){
                    
                    // Inter-state transaction (different state codes)
                    gstfield = `
                    <div class="form-group row align-items-center mr-0">
                        <label for="igst_percentage" class="col-sm-9 col-form-label" style="text-align:end;font-size:14px;"><b>IGST %</b></label>
                        <div class="col-sm-3">
                            <input type="text" name="igst_percentage" style="font-size:14px;margin-left:18px;" class="form-control editable-field" id="igst_percentage" placeholder="0.00" ${tax ? 'disabled' : ''}>
                        </div>
                    </div>
                    <input type="hidden" name="calculatedgst" class="form-control editable-field calculatedgst" placeholder="0.00">
                `;
                }
            }

            $('#gst').append(gstfield);
            updateGSTFields(); // Update GST values
            if ("<?php echo $billing_data['ti_number']; ?>") {
                $('#taxinvoice').closest('button').show();
                $('#requestForTI').closest('button').prop('disabled', true);
            } else {
                $('#taxinvoice').closest('button').hide();
            }
    }


    /* ------------------------------------------------------------------------- *
     * TO ENTER GST MANULALLY
     * ------------------------------------------------------------------------- */
    function toggleGSTInput() {
        const gstInput = document.getElementById('gst_percentage');
        const gstButton = document.querySelector('.gst');

        if (gstInput.disabled) {
            // Enable the input field
            gstInput.disabled = false;
            gstButton.classList.remove('btn-info');
            gstButton.classList.add('btn-success');
        } else {
            // Disable the input field and revert button color
            gstInput.disabled = true;
            gstButton.classList.remove('btn-success');
            gstButton.classList.add('btn-info');
        }
    }

    /* ------------------------------------------------------------------------- *
     * TO COMPARE GST
     * ------------------------------------------------------------------------- */
    function checkGSTDetails() {
        const gst1 = $('input[type="text"]#gstn').val().trim(); // Get GST text from a <p> tag
        const gst2 = $('#gstnumber option:selected').text().trim(); // Get selected GST number from dropdown

        // Call the gstdetail function to compare or perform actions
        gstdetail(gst1, gst2);
        calculateTotals();
    }


    /* ------------------------------------------------------------------------- *
     * TO FORMAT CURRENCY IN INDIAN FORMAT (FOR INPUT ELEMENTS)
     * ------------------------------------------------------------------------- */
    function formatCurrency(input) {
        // Ensure the input has a value before processing
        let value = input.value ? input.value.replace(/,/g, '') : '0';

        // Parse the value as a float
        let numericValue = parseFloat(value) || 0;

        // Format the number in Indian currency style and update the input value
        input.value = new Intl.NumberFormat('en-IN', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        }).format(numericValue);
    }

    /* ------------------------------------------------------------------------- *
     * TO FORMAT CURRENCY IN INDIAN FORMAT (FOR DISPLAY PURPOSES)
     * ------------------------------------------------------------------------- */
    function formatIndianCurrency(amount) {
        // Format a numeric value as a string in Indian currency style
        return new Intl.NumberFormat('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);
    }

    /* ------------------------------------------------------------------------- *
     * TO ATTACH EVENT LISTENERS FOR ROW CALCULATIONS
     * ------------------------------------------------------------------------- */
    function attachRowEventListeners(row, type) {
        // Determine the appropriate calculation function based on type
        const updateTotals = type === 'item-row' ? calculateTotals : updateGrandTotalOnly;

        // Attach event listeners for rate and quantity inputs
        $(row).find('.rate-input').on('input', function() {
            // formatCurrency(this);
            updateTotals(); // Update totals based on type
        });

        $(row).find('.qty-input').on('input', function() {
            updateTotals(); // Update totals based on type
        });
    }

    /* ------------------------------------------------------------------------- *
     * TO INSERT ALL BILLING DETAILS (By KAJAL)
     * ------------------------------------------------------------------------- */
    function preparePostData(invoiceData, additionalExpensesData) {
        let aid = "<?php echo htmlspecialchars($aid); ?>";
        let gstValue = $('#gstnumber').val();
        var gstNumber = $('#gstnumber option:selected').text();
        let gstPercentage = parseFloat($('#gst_percentage').val()) || 0;
        let subtotal = parseFloat($('#subtotal').val().replace(/,/g, '')) || 0;
        let total = parseFloat($('#total_amount').val().replace(/,/g, '')) || 0;
        let grandtotal = parseFloat($('#grand_total').val().replace(/,/g, '')) || 0;
        let cgstPercentage = parseFloat($('#cgst_percentage').val()) || 0;
        let sgstPercentage = parseFloat($('#sgst_percentage').val()) || 0;
        let igstPercentage = parseFloat($('#igst_percentage').val()) || 0;
        let calculatedgst = parseFloat($('.calculatedgst').val()) || 0;

        let billingpaymentBy = $('.billing_payment_by').val();
        let billingbranchName = $('.billing_branch_name').val();
        let billinguserName = $('.billing_user_name').val();
        let billingmobileNumber = $('.billing_mobile_num').val();
        let billingstNumber = $('.billing_gst').val();
        let shippingpaymentBy = $('.shipping_payment_by').val();
        let shippingbranchName = $('.shipping_branch_name').val();
        let shippinguserName = $('.shipping_user_name').val();
        let shippingmobileNumber = $('.shipping_mobile_num').val();
        let shippinggstNumber = $('.shipping_gst').val();
        let outsourceservices = $('.outsource-services').val();
        let outsourcedescription = $('.outsource-description').val();
        let outsourceuom = $('.outsource-uom').val();
        let outsourcerate = $('.outsource-rate').val();
        let outsourceqty = $('.outsource-qty').val();
        let outsourceamount = $('.outsource-amount').val();
        let currencyconversion = $('.currency_conversion').val();
        let currencyvalue = $('.currency_value').val();

        return {
            aid: aid,
            invoice: JSON.stringify(invoiceData),
            additional_expenses: JSON.stringify(additionalExpensesData),
            subtotal: subtotal.toFixed(2),
            tax: JSON.stringify({
                gst_number: gstNumber,
                gst_percentage: gstPercentage.toFixed(2),
                cgst_percentage: cgstPercentage,
                sgst_percentage: sgstPercentage,
                igst_percentage: igstPercentage,
                calculatedgst: calculatedgst
            }),
            bill_to: JSON.stringify({
                billing_payment_by: billingpaymentBy,
                billing_branch_name: billingbranchName,
                billing_user_name: billinguserName,
                billing_mobile_num: billingmobileNumber,
                billing_gst: billingstNumber,
                billing_id: $('.billingto').val() || $('.billing_id').val() || ''
            }),

            ship_to: JSON.stringify({
                shipping_payment_by: shippingpaymentBy,
                shipping_branch_name: shippingbranchName,
                shipping_user_name: shippinguserName,
                shipping_mobile_num: shippingmobileNumber,
                shipping_gst: shippinggstNumber,
                shipbilling_id: $('.shipbillingto').val() || ''
            }),
            total: total.toFixed(2),
            grandtotal: grandtotal.toFixed(2),
            branchid: gstValue,
            currency: JSON.stringify({
                currency_conversion: currencyconversion,
                currency_value: currencyvalue
            })
        };
    }

    /* ------------------------------------------------------------------------- *
     * TO SHOW SUCCESS MSG
     * ------------------------------------------------------------------------- */
    function handleAjaxResponse(response) {
        let data;
        try {
            data = JSON.parse(response);
        } catch (e) {
            return;
        }

        if (data.status === 'error') {
            showErrorAlert('Error: ' + data.message);
        } else {
            $(".editable-field").prop("disabled", true);
            showSuccessAlert();
        }
    }

    // Function to show the success alert
    function showSuccessAlert() {
        const successAlert = $('#billing-alert');
        successAlert.show().removeClass('fade').addClass('show');
        setTimeout(function() {
            successAlert.alert('close');
        }, 3000);
    }

    // Function to show the error alert
    function showErrorAlert(message) {
        const errorAlert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">' +
            '<strong>Error!</strong> ' + message +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button></div>');

        $('.center-alert-container').append(errorAlert);
        errorAlert.show().removeClass('fade').addClass('show');
        setTimeout(function() {
            errorAlert.alert('close');
        }, 5000);
    }

    /* ------------------------------------------------------------------------- *
     * TO DISABLE FIELDS AFTER SUBMIT (By KAJAL)
     * ------------------------------------------------------------------------- */
    function disableFields() {
        $(".editable-field, select.item-select, select.uom-select").prop("disabled", true);
        $("#submitData").text("Edit");
        $("#toggleBillBtn").prop('disabled', true).css('opacity', '0.6');
        $(".remove-btn").prop("disabled", true);
        $("#cgst_percentage").prop("disabled", true);
        $("#sgst_percentage").prop("disabled", true);
        $("#sgst_percentage").prop("disabled", true);
        $(".venorbtn").prop('disabled', true).css('opacity', '0.6');
        $(".addfieldmodal").prop('disabled', true).css('opacity', '0.6');
    }

    /* ------------------------------------------------------------------------- *
     * TO ENABLE FIELDS AFTER SUBMIT(By KAJAL)
     * ------------------------------ ------------------------------------------- */
    function enableFields() {
        $(".editable-field, select.item-select, select.uom-select").prop("disabled", false);
        $("#submitData").text("Update");
        $("#addRowBtn").prop('disabled', false).css('opacity', '1');
        $("#cgst_percentage").prop("disabled", false);
        $("#sgst_percentage").prop("disabled", false);
        $(".remove-btn").prop("disabled", false);
        $(".venorbtn").prop('disabled', false).css('opacity', '1');
        $(".addfieldmodal").prop('disabled', false).css('opacity', '1');
    }

    /* ------------------------------------------------------------------------- *
     * TO SHOW 1 IN QTY IF SLECTED UOM IS NA IN INVOICES (By KAJAL)
     * ------------------------------------------------------------------------- */
    function updateQuantityBasedOnUOM(uomElement) {
        let $row = $(uomElement).closest('.item-row'); // Get the current row
        let selectedUOM = $(uomElement).val(); // Get the selected UOM value

        if (selectedUOM === "N/A") {
            $row.find('.qty-input').val(1); // Set quantity to 1 for "N/A" UOM
        } else {
            $row.find('.qty-input').val(''); // Clear quantity if other UOM selected
        }
    }

    /* ------------------------------------------------------------------------- *
     * TO SHOW 1 IN QTY IF SLECTED UOM IS NA IN ADDITIONAL EXPENSES (By KAJAL)
     * ------------------------------------------------------------------------- */
    function updateadditionalQuantityBasedOnUOM(uomElement) {
        let $row = $(uomElement).closest('.itemr'); // Get the current row
        let selectedUOM = $(uomElement).val(); // Get the selected UOM value

        if (selectedUOM === "N/A") {
            $row.find('.outsource-qty').val(1); // Set quantity to 1 for "N/A" UOM
        } else {
            $row.find('.outsource-qty').val(''); // Clear quantity if other UOM selected
        }
    }

    /* ------------------------------------------------------------------------- *
     * Function to escape HTML characters to prevent XSS attacks
     * ------------------------------------------------------------------------- */
    function htmlspecialchars(str) {
        return str.replace(/&/g, "AND;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    /* ------------------------------------------------------------------------- *
     * ADDITIONAL EXPENSES ROW WITH DATA (By KAJAL)
     * ------------------------------------------------------------------------- */
    function addNew() {
        // Get additional expenses from PHP variable
        var additionalExpenses = <?php echo json_encode(isset($billing_data['additional_expenses']) ? $billing_data['additional_expenses'] : null); ?>;

        // Check if additionalExpenses is not null or an empty array
        if (additionalExpenses !== null && Array.isArray(additionalExpenses) && additionalExpenses.length > 0) {

            // Helper to normalize strings
            const normalizeString = (str) => str ? str.trim().toLowerCase() : '';

            // Function to create a new row
            const createRow = (expense = null) => {
                const isDisabled = expense ? 'disabled' : '';
                return `
            <tr class="itemr">
                <td>
                    <select class="form-control item-select editable-field outsource-services" ${isDisabled} name="item[]">
                        <option ${expense?.item ? '' : 'selected'} disabled>Select</option>
                        <option value="Outsourced Services" ${expense?.item === 'Outsourced Services' ? 'selected' : ''}>Outsourced Services</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control description-input editable-field outsource-description" name="description[]"
                        value="${expense?.description || ''}" placeholder="Description" ${isDisabled}>
                </td>
                <td>
                    <select class="form-control uom-select editable-field outsource-uom" ${isDisabled} name="uom[]">
                        <option disabled>Select</option>
                        <option value="Per Day" ${expense?.uom === 'Per Day' ? 'selected' : ''}>Per Day</option>
                        <option value="Per Pc" ${expense?.uom === 'Per Pc' ? 'selected' : ''}>Per Pc</option>
                        <option value="Per Incident" ${expense?.uom === 'Per Incident' ? 'selected' : ''}>Per Incident</option>
                        <option value="Per Km" ${expense?.uom === 'Per Km' ? 'selected' : ''}>Per Km</option>
                        <option value="N/A" ${expense?.uom === 'N/A' ? 'selected' : ''}>N/A</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control rate-input editable-field outsource-rate" name="rate[]" 
                        value="${expense?.rate || ''}" step="any" min="0" ${isDisabled}>
                </td>
                <td>
                    <input type="text" class="form-control qty-input editable-field outsource-qty" name="qty[]"
                        value="${expense?.qty || ''}" step="any" min="0" ${isDisabled}>
                </td>
                <td>
                    <input type="text" class="form-control amount-input outsource-amount" name="amount[]" 
                        value="${expense?.amount || ''}" readonly>
                </td>
                <td>
                    <button class="btn btn-danger remove-btn" onclick="removeField(this)">
                        <i class="fa fa-times" style="font-size: 12px;"></i>
                    </button>
                </td>
            </tr>`;
            };

            // Iterate through additionalExpenses and append rows
            additionalExpenses.forEach((expense) => {
                // Skip the expense if it's null or has no valid properties
                if (expense && expense.item) {
                    const existingRow = $('#dynamicTable tr').filter(function() {
                        return normalizeString($(this).find('.item-select').val()) === normalizeString(expense?.item) &&
                            normalizeString($(this).find('.description-input').val()) === normalizeString(expense?.description);
                    });

                    if (existingRow.length === 0) {
                        $('#dynamicTable').append(createRow(expense));
                    }
                }
            });
        }

        // Update totals
        updateGrandTotalOnly();
    }


    /* ------------------------------------------------------------------------- *
     * ADDITIONAL EXPENSES ROW WITHOUT DATA (By KAJAL)
     * ------------------------------------------------------------------------- */
    function populateRow() {
        var newRow = `     
           <tr class="itemr">
                    <td>
                        <select class="form-control item-select editable-field outsource-services" style="font-size:14px;" name="item[]">
                            <option selected>Select</option>
                            <option value="Outsourced Services">Outsourced Services</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control description-input editable-field outsource-description" name="description[]"
                            style="font-size:14px;" placeholder="Description">
                    </td>
                    <td>
                        <select class="form-control uom-select editable-field outsource-uom" style="font-size:14px;" name="uom[]">
                            <option disabled selected>Select</option>
                            <option value="Per Day">Per Day</option>
                            <option value="Per Pc">Per Pc</option>
                            <option value="Per Incident">Per Incident</option>
                            <option value="Per Km">Per Km</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control rate-input editable-field outsource-rate" name="rate[]"
                            step="any" min="0">
                    </td>
                    <td>
                        <input type="text" class="form-control qty-input editable-field outsource-qty" name="qty[]"
                            step="any" min="0">
                    </td>
                    <td>
                        <input type="text" class="form-control amount-input editable-field outsource-amount" name="amount[]"
                            readonly>
                    </td>
                    <td>
                        <button class="btn btn-danger remove-btn" onclick="removeField(this)"><b>×</b></button>
                    </td>
                </tr>
        
     `;

        // Append the new row to the billing table body
        $('#dynamicTable').append(newRow);

        // Attach event listeners and update totals
        attachRowEventListeners($('#dynamicTable tr:last-child'), 'itemr'); // Attach listeners for new row
        calculateTotals(); // Update totals after adding the new row

        // Attach a click event for removing the row
        $('.remove-btn').click(function() {
            $(this).closest('tr').remove();
            calculateTotals(); // Recalculate totals after removing the row
        });
    }

    $(document).ready(function() {

        $(document).on('click', '.delete-vendor', function() {
                const vendorId = $(this).data('vendor-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won’t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'deletevendor', // Adjust the endpoint to your delete function
                            type: 'POST',
                            data: {
                                vendor_id: vendorId
                            },
                            success: function(response) {
                                if (response.status === 200) { // Check if the response status is 200
                                    Swal.fire('Deleted!', 'The vendor has been deleted.', 'success');
                                    // Reload the DataTable
                                    $('#vendorlist').DataTable().ajax.reload();
                                } else {
                                    $('#vendorlist').DataTable().ajax.reload();
                                }
                            },
                            error: function() {
                                Swal.fire('Error!', 'An error occurred while deleting the vendor.', 'error');
                            },
                        });
                    }
                });
            });
        $('.outsource-uom').on('change', function() {
            calculateTotals();
        });

        $("#paymentForm").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            rules: {
                'payment_for[]': {
                    required: true
                },
                'amount[]': {
                    required: true
                },
                'date[]': {
                    required: true
                }
            },
            messages: {
                'payment_for[]': "This field is required",
                'amount[]': "This field is required",
                'date[]': "This field is required"
            },
            submitHandler: function(form) {
                var aid = "<?php echo $aid; ?>";

                // Gather all the payment data
                var paymentData = [];
                $('input[name="payment_for[]"]').each(function(index) {
                    paymentData.push({
                        payment_for: $(this).val(),
                        amount: $('input[name="amount[]"]').eq(index).val(),
                        date: $('input[name="date[]"]').eq(index).val()
                    });
                });

                // Create FormData and add JSON-encoded 2D array
                var formdata = new FormData();
                formdata.append('aid', aid);
                formdata.append('paymentData', JSON.stringify(paymentData));

                $.ajax({
                    url: '<?php echo base_url('billing/updateBillingPayment'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        if (response.status === 200) {
                            alert(response.message);
                            $('.payment-receipt').show();
                        } else {
                            alert(response.message || 'An error occurred.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred: ', error);

                    }
                });
            }
        });

        $('.payment-reciept').hide();

        $('#add_field').click(function() {
            // Get field name and value from the input fields
            var fieldName = $('#fieldname').val();
            var fieldValue = $('#fieldvalue').val();

            // Check if the fields are not empty
            if (fieldName && fieldValue) {
                // Create a new table row with the field name, field value, and a delete button in a separate td
                var newRow = `<tr>
                        <th style="font-size:14;">${htmlspecialchars(fieldName)}</th>
                        <td>
                            <span>${htmlspecialchars(fieldValue)}</span>
                            <input type="text" class="form-control" name="fieldvalue[]" value="${htmlspecialchars(fieldValue)}" style="border:none;display:none;">
                        </td>
                        <td style="width:4%;">
                            <button class="btn btn-danger editable-field delete-row" ><b>×</b></button>
                        </td>
                    </tr>`;

                // Append the new row to the table body
                $('#fieldtablebody').append(newRow);

                // Clear the input fields after adding
                $('#fieldname').val('');
                $('#fieldvalue').val('');

                // Close the modal
                $('#addfieldmodal').modal('hide');
            } else {
                alert('Please fill in both fields.');
            }
        });

        // Event delegation to handle dynamic content
        $('#fieldtablebody').on('click', '.delete-row', function() {
            // Remove the row that contains the clicked delete button
            $(this).closest('tr').remove();
        });

        /* ------------------------------------------------------------------------- *
         * PINCODE VALIDATION (By KAJAL)
         * ------------------------------------------------------------------------- */
        $('.pincode').keyup(function() {
            var pincode = $(this).val();
            if (pincode.length === 6) {
                search_pincode(pincode);
            }
        });


        $('#update_vendor_modal').click(function() {
            $('#vendorModal').css({
                'opacity': '0.5',
                'z-index': '1040'
            });
            $('#vendorNewModal').css({
                'opacity': '1',
                'z-index': '1050'
            }).modal('show');
        });

        $('#vendorNewModal').on('hide.bs.modal', function() {
            $('#vendorModal').css({
                'opacity': '1', // Restore vendorModal opacity
                'z-index': '1050' // Bring vendorModal back to the front
            });
        });

        // When any modal (addvendorModal, addbranchModal, adduserModal) is shown on top of vendorNewModal
        $('#addvendorModal, #addbranchModal, #adduserModal').on('show.bs.modal', function() {
            // Blur the vendorModal and vendorNewModal
            $('#vendorModal').css({
                'opacity': '0.4',
                'z-index': '1030'
            });
            $('#vendorNewModal').css({
                'opacity': '0.5',
                'z-index': '1040'
            });

            // Make the top modal fully visible and bring it to the front
            $(this).css({
                'opacity': '1',
                'z-index': '1050' // Highest z-index for topmost modal
            });
        });

        // When any of the top modals is hidden, reset opacity for vendorNewModal and vendorModal
        $('#addvendorModal, #addbranchModal, #adduserModal').on('hide.bs.modal', function() {
            $('#vendorNewModal').css({
                'opacity': '1', // Restore vendorNewModal opacity
                'z-index': '1050' // Bring vendorNewModal to the front again
            });
            $('#vendorModal').css({
                'opacity': '0.5', // Keep vendorModal blurred
                'z-index': '1040' // Ensure vendorModal is behind vendorNewModal
            });
        });

        /* ------------------------------------------------------------------------- *
         * Handle modal show event
         * ------------------------------------------------------------------------- */

         $('#add_vendor_casereference').on('click', function() {
            var modalType = $(this).data('modal-type'); // Get the modal type (billing, shipping, etc.)
            var selectedRadio = $('#vendorlist input[name="vendor_select"]:checked'); // Get selected vendor

            if (selectedRadio.length > 0) {
                var vendorName = selectedRadio.data('vendor-name');
                var branchName = selectedRadio.data('branch-name');
                var billingto = selectedRadio.data('billing-id');
                var paymentsgstNumber = selectedRadio.data('gst');
                var userName = selectedRadio.data('user-name');
                var mobileNumber = selectedRadio.data('mobile-number');
                var vendorId = selectedRadio.val();

                // Variable to hold the structured data
                let billingstructuredData = {
                    "billing_payment_by": vendorName,
                    "billing_branch_name": branchName,
                    "billing_user_name": userName,
                    "billing_mobile_num": mobileNumber,
                    "billing_gst": paymentsgstNumber,
                    "billingto": billingto
                };

                let shippingstructuredData = {
                    "shipping_payment_by": vendorName,
                    "shipping_branch_name": branchName,
                    "shipping_user_name": userName,
                    "shipping_mobile_num": mobileNumber,
                    "shipping_gst": paymentsgstNumber,
                    "shipbillingto": billingto
                };


                switch (modalType) {
                    case 'billing':

                        // Store data in the billing fields
                        $('.billing_insurance_company').val(vendorName);
                        $('.billing_payment_gst').val(paymentsgstNumber);
                        $('.billing_branch_name').val(branchName);
                        $('.billing_user_name').val(userName);
                        $('.billing_mobile').val(mobileNumber);
                         if (billingto) {
                                $('.billingto').val(billingto);  // Set the value if billingto exists
                            }else {
                              $('.billingto').val('NA');  // Clear the field if billingto does not exist
                            }



                        // Update hidden fields or data object with the new array structure
                        let billingDataArray = [billingstructuredData]; // Store as array

                        break;

                    case 'shipping':

                        // Store data in the shipping fields
                        $('.shipping_insurance_company').val(vendorName);
                        $('.shipping_payment_gst').val(paymentsgstNumber);
                        $('.shipping_branch_name').val(branchName);
                        $('.shipping_user_name').val(userName);
                        $('.shipping_mobile').val(mobileNumber);
                        if (billingto) {
                                $('.shipbillingto').val(billingto);  // Set the value if billingto exists
                            }else {
                              $('.shipbillingto').val('NA');  // Clear the field if billingto does not exist
                            }

                        // Update hidden fields or data object with the new array structure
                        let shippingDataArray = [shippingstructuredData]; // Store as array

                        break;

                    default:
                        break;
                }

                $('#notselect-error-alert').hide();
                $('#vendorModal').modal('hide');
            } else {
                $('#notselect-error-alert').show();
            }
        });


        /* ------------------------------------------------------------------------- *
         * DATA TABLE FOR ALL CONNECTED VENDORS
         * ------------------------------------------------------------------------- */
        var $ourgointcases = $('#vendorlist');
        var vendorTable;
        var companyid = "<?php echo $defaultcompany; ?>";

        if ($ourgointcases.length) {
            vendorTable = $ourgointcases.DataTable({
                "serverSide": true,
                "paging": true,
                "fixedHeader": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: {
                    searchPlaceholder: "Search Vendor",
                    "lengthMenu": "View _MENU_ records"
                },
                "order": [], // Default no ordering
                "ajax": {
                    url: "<?php echo base_url('connectedvendor'); ?>", // Server-side URL
                    type: "POST",
                    dataType: "JSON",
                     data: { companyid: companyid },
                }
            });


            $('#vendorModal').on('show.bs.modal', function(event) {
                vendorTable.ajax.reload(null, true); // Reload and reset pagination to page 1
                var button = $(event.relatedTarget); // Button that triggered the modal
                var modalType = button.data('modal-type'); // Extract modal type from data-* attribute
                var modal = $(this);
                var addButton = modal.find('#add_vendor_casereference');
                // Set the modal type for the Add button
                addButton.data('modal-type', modalType);
                // Optionally, you can update the modal title or any other element based on the modalType
                modal.find('#modalTitle').text(modalType.charAt(0).toUpperCase() + modalType.slice(1) + ' Vendor Selection');
            });

        }
        /* ------------------------------------------------------------------------- *
         * CONNECT VENDOR WHEN ALL DATA ARE EXIST
         * ------------------------------------------------------------------------- */
        $("#connect_vendor").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                vendor: {
                    required: true,

                },
                branch: {
                    required: true,

                },
                user: {
                    required: true,

                }
            },
            messages: {
                vendor: {
                    required: "This field is required.",

                },
                branch: {
                    required: "This field is required.",

                },
                user: {
                    required: "This field is required.",


                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();

                // Retrieve the selected IDs from the data attributes
                var userId = $('#user-search').data('selected-user-id'); // Ensure this is correct
                var branchId = $('.branch-search').data('selected-branch-id'); // Ensure this is correct
                var vendorId = $('.vendor-search').data('selected-vendor-id'); // Ensure this is correct
                 var cid = "<?php echo $defaultcompany; ?>";

                // Print the IDs to the console


                // Validate IDs before adding them to form data
                if (userId <= 0 || branchId <= 0 || vendorId <= 0) {
                    $('#vendor-error-alert').find('.alert-body').text('Please ensure all IDs are valid.').show();
                    return;
                }


                // Append IDs to form data
                var formData = $(form).serialize();
                formData += '&vendor=' + encodeURIComponent(vendorId);
                formData += '&branch=' + encodeURIComponent(branchId);
                formData += '&user=' + encodeURIComponent(userId);
                 formData += '&cid=' + encodeURIComponent(cid);

                // Perform AJAX request
                $.ajax({
                    url: "<?php echo base_url('connectNewVendor'); ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            $('#vendor-success-alert').find('.alert-body').html(
                                'Vendor connected successfully.<br>' +
                                '<strong>Vendor:</strong> ' + response.vendorName + '<br>' +
                                '<strong>Branch:</strong> ' + response.branchAddress + '<br>' +
                                '<strong>User:</strong> ' + response.userName
                            ).show();
                            $('#vendorNewModal').modal('hide');
                            $('#connect_vendor')[0].reset();
                            $ourgointcases.DataTable().ajax.reload();
                        } else {
                            $('#vendor-error-alert').find('.alert-body').text(response.message).show();
                        }
                    },
                    error: function(xhr) {
                        // console.error(xhr.responseText);
                        $('#vendor-error-alert').find('.alert-body').text('An error occurred. Please try again.').show();
                    }
                });
            }
        });


        $('#vendortype-dropdown').change(function() {
            var selectedVendorTypeId = $(this).val(); // Get the selected value (ID)
            $('#selected-vendortype-ids').val(selectedVendorTypeId); // Set the hidden input value
        });


        $(document).on('input change', '.rate-input, .qty-input, #gst_percentage', function() {
            calculateTotals();
            updateGrandTotalOnly();
        });

        <?php
        function truncateFileName($filename, $maxLength)
        {
            if (strlen($filename) > $maxLength) {
                return substr($filename, 0, $maxLength - 3) . '...';
            }
            return $filename;
        }
        ?>

        $('#addvendorModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            $('#user-name-display').text('');
            $('#mobile-error').hide();
        });

        $('#adduserModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            $('#user-name-display').text('');
            $('#mobile-error').hide();
        });

        $('#addbranchModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            $('#user-name-display').text('');
            $('#mobile-error').hide();
        });
        $('#vendorNewModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            $('#user-name-display').text('');
            $('#mobile-error').hide();
        });
        fetchVendorTypes();
        fetchVendors();

        // Initialize intlTelInput for each mobile and usermobile input
        $('.mobile, .usermobile').each(function() {
            const phoneInputField = $(this); // Get the current input field
            const iti = window.intlTelInput(phoneInputField[0], { // Initialize intl-tel-input
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                initialCountry: 'auto',
                geoIpLookup: function(callback) {
                    callback('in'); // Default to India if no IP-based detection
                }
            });
            phoneInputField.val('+91');

            // Set up keyup event listener for the current input field
            phoneInputField.on('keyup', function() {
                const inputNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164); // Get full international number
                const cleanedNumber = inputNumber.replace(/[^\d+]/g, ''); // Remove any non-numeric or non-plus characters

                // Check if the number is valid using intlTelInput's validation
                if (iti.isValidNumber()) {
                    checkMobileExists(cleanedNumber); // Custom function to check if the mobile number exists
                    $('#mobile-error').hide();
                } else {
                    $('#mobile-error').show();
                    $('#user-name-display').text('');
                    $('select[name="salutation"]').val('');
                    $('input[name="firstname"]').val('');
                    $('input[name="lastname"]').val('');
                }
            });
            phoneInputField.on('countrychange', function() {
                const countryData = iti.getSelectedCountryData();
                const countryCode = `+${countryData.dialCode}`; // Get the dial code
                // Optionally, set the country code as the value of the input field
                phoneInputField.val(countryCode); // This will update the input with the dial code
            })
        });

        // Convert input to uppercase on vendor input
        $('#newvendor,.newvendor').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });

        // Show dropdown on focus
        $('.vendor-search').on('focus', function() {
            $('.vendor-dropdown').addClass('active');
        });

        // Filter dropdown items based on search input
        $('.vendor-search').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.vendor-options').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });

        // Hide dropdown if clicked outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.dropdown-container').length) {
                $('.vendor-dropdown').removeClass('active');
            }
        });

        /* ------------------------------------------------------------------------- *
         * CONNECT VENDOR FROM SCRATCH
         * ------------------------------------------------------------------------- */

         $('select[name="usertype"]').on('change', function() {
                if ($(this).val() === 'INDIVIDUAL') {
                    // Hide business-related fields
                    $(".business_details").hide();
                } else {
                    // Show business-related fields
                    $(".business_details").show();
                }
            });

            // Trigger change event on page load to set initial visibility
            $('select[name="usertype"]').trigger('change');

         $("#addvendor").validate({
                errorClass: 'error',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').show();
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    $(element).closest('.form-group').find('.error-message').hide();
                },
                rules: {
                    vendor: {
                        required: true
                    },
                    vendortype: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    pincode: {
                        required: true,
                        digits: true
                    },
                    state: {
                        required: true
                    },

                    city: {
                        required: true
                    },

                    salutation: {
                        required: true
                    },
                    firstname: {
                        required: true
                    },
                   
                   mobile: {
                        required: true,
                        minlength: 13, // Ensure mobile is 13 digits
                        maxlength: 13, // Ensure mobile is 13 digits
                        remote: { // Ajax call to check if the mobile number exists
                            url: "<?php echo base_url('allusers'); ?>",
                            type: "post",
                            data: {
                                mobile: function() {
                                    return $('#mobile').val();
                                }
                            },
                            dataType: 'json',
                            dataFilter: function(response) {
                                var result = JSON.parse(response);
                                if (result.exists) {
                                    return false; // Mobile exists, return false to trigger the remote message
                                } else {
                                    return true; // Mobile does not exist, return true to allow form submission
                                }
                            }
                        }
                    },
                     gst:{
                       minlength: 15,
                       maxlength: 15
                    }
                },
                messages: {
                    vendor: {
                        required: "This field is required."
                    },
                    vendortype: {
                        required: "Vendor Type is mandatory."
                    },
                    address: {
                        required: "This field is required."
                    },
                    pincode: {
                        required: "This field is required.",
                        digits: "Please enter valid Pincode"
                    },
                    state: {
                        required: "This field is required."
                    },

                    city: {
                        required: "This field is required."
                    },
                    vendor: {
                        required: "Please select a vendor."
                    },
                    salutation: {
                        required: "This field is required."
                    },
                    firstname: {
                        required: "This field is required."
                    },
                    
                    mobile: {
                        required: "This field is required.",
                        remote:"This number already in use",
                        minlength: "Mobile number must be 10 digits after +91.",
                        maxlength: "Mobile number must be 10 digits after +91."
                    },
                     gst:{
                      minlength: "Please enter a valid GST number.",
                      maxlength: "Please enter a valid GST number."
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    var formData = new FormData(form);
                    var aid = "<?php echo $aid; ?>";
                    formData.append('aid', aid);
                    var companyid = "<?php echo $defaultcompany; ?>";
                    formData.append('companyid', companyid);

                    // AJAX request to add new vendor
                    $.ajax({
                        url: "<?php echo base_url('Setting/addNewVendor'); ?>",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status === 200) {
                                

                                if (response.data) {
                                    var newVendor = response.data.companyName;
                                    var newVendorId = response.data.id;
                                    var newcId = response.data.cid;

                                    // Append the new vendor to the vendor type dropdown
                                    $('#vendortype-dropdown').append('<option value="' + newVendorId + '">' + newVendor + '</option>');
                                    $('#newvendor').val(newVendor);
                                    $('#selected-vendortype-ids').val(newVendorId);

                                    // Close modals
                                    $('#addvendorModal').modal('hide');
                                    $('#vendorNewModal').modal('hide');
                                    $('#addNewvendor').modal('hide');

                                    // Reset the form
                                    $(form)[0].reset();
                                    $('.error-message').hide();

                                    // Reload the DataTable to show the new vendor
                                    $('#vendorlist').DataTable().ajax.reload(null, false); // `false` keeps the current paging state

                                } else {
                                    console.error("Response data is undefined.");
                                }
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                            alert("An error occurred. Please try again.");
                        }
                    });
                }

            });


        // Show dropdown on focus
        $('.branch-search').on('focus', function() {
            $('.branch-dropdown').addClass('active').show();
        });

        // Filter dropdown items based on search input
        $('.branch-search').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.branch-dropdown-item').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });

        // Hide dropdown if clicked outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.branch-dropdown-container').length) {
                $('.branch-dropdown').removeClass('active').hide();
            }
        });

        // Call fetchBranches when vendor search input changes
        $('.vendor-search').on('input', function() {
            var selectedVendorId = $('.vendor-search').data('selected-vendor-id');
            fetchBranches();
        });

        /* ------------------------------------------------------------------------- *
         * ADD NEW BRANCH
         * ------------------------------------------------------------------------- */
        $("#addbranch").validate({
            rules: {
                address: {
                    required: true
                },
                pincode: {
                    required: true,
                    digits: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                vendor: {
                    required: true
                }
            },
            messages: {
                address: {
                    required: "This field is required."
                },
                pincode: {
                    required: "This field is required.",
                    digits: "Please enter valid Pincode"
                },
                state: {
                    required: "This field is required."
                },
                city: {
                    required: "This field is required."
                },
                vendor: {
                    required: "Please select a vendor."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var selectedVendorId = $('.vendor-search').data('selected-vendor-id');

                var formData = $(form).serialize();
                var aid = "<?php echo $aid; ?>";
                formData += '&aid=' + encodeURIComponent(aid) + '&vendor_id=' + encodeURIComponent(selectedVendorId);
                $.ajax({
                    url: "<?php echo base_url('addNewBranch'); ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',

                    success: function(response) {

                        if (response.status === 200) {
                            var newBranch = response.data; // Ensure `data` is the correct property
                            var newBranchId = newBranch.id; // Ensure `id` is the correct property
                            var newBranchAddress = newBranch.address; // Ensure `address` is the correct property
                            var newBranchState = newBranch.state; // Ensure `state` is the correct property
                            var newBranchCity = newBranch.city; // Ensure `city` is the correct property

                            var newBranchFullName = newBranchAddress + ', ' + newBranchState + ', ' + newBranchCity;



                            // Update the dropdown menu with the new branch
                            $('#branch-dropdown').append('<div class="branch-item" data-id="' + newBranchId + '">' +
                                newBranchFullName + '</div>');

                            // Set the search input to the newly added branch
                            $('#branch-search').val(newBranchFullName);
                            $('#branch-search').data('selected-branch-id', newBranchId);

                            // Close the modal and reset the form
                            $('#addbranchModal').modal('hide');
                            $(form)[0].reset();
                        } else {
                            console.error('Error:', response.message); // Log the error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {

                        var errorAlert = $('#vendor-error-alert');
                        errorAlert.find('.alert-body').text('An error occurred. Please try again.');
                        errorAlert.show();
                    }
                });
            }
        });

        // Hide the dropdown if clicked outside the input or dropdown
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#user-dropdown, #user-search').length) {
                $('#user-dropdown').removeClass('active');
            }
        });

        $('#user-search').on('keyup', function() {
            const searchTerm = $(this).val().trim(); // Use .trim() to remove spaces around the input
            // Validate if the input is a valid mobile number, with or without the country code, with or without "+"
            const isValidMobileNumber = /^(\+91)?\d{10}$/.test(searchTerm);
            if (isValidMobileNumber) {
                fetchUsers(searchTerm); // Fetch users if the number is valid
            } else {
                $('#user-dropdown').removeClass('active'); // Hide dropdown if input is not valid
            }
        });

        /* ------------------------------------------------------------------------- *
         * ADD NEW USER
         * ------------------------------------------------------------------------- */
        $("#adduser").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                salutation: {
                    required: true
                },
                firstname: {
                    required: true
                },
                mobile: {
                    required: true,

                }
            },
            messages: {
                salutation: {
                    required: "This field is required."
                },
                firstname: {
                    required: "This field is required."
                },
                mobile: {
                    required: "This field is required.",
                    // remote: "This mobile number is already in use."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(form).serialize();

                $.ajax({
                    url: "<?php echo base_url('Setting/addNewUser'); ?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 200) {
                            var newUser = response.data;
                            var newUserId = newUser.id;
                            var newUserFullName = newUser.firstname + ' ' + newUser.lastname;
                            var newUserMobile = newUser.mobile;

                            $('#searchResults').append('<div class="search-result-item" data-id="' + newUserId + '">' +
                                newUserFullName + ' (' + newUserMobile + ')</div>');

                            $('#user-search').val(newUserFullName);
                            $('#user-search').data('selected-user-id', newUserId);
                            $('#adduserModal').modal('hide');
                            $(form)[0].reset();
                        } else {
                            console.error('Error:', response.message);
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Internal Server Error',
                            text: 'Something went wrong. Please try again later.',
                        });
                    }
                });
            }
        });

        $('.rate-input, .qty-input, #total_amount').on('change keyup', updateGrandTotalOnly);

        $(document).on('change', '.uom-select', function() {
            updateQuantityBasedOnUOM(this);
            calculateTotals(); // Recalculate totals after UOM change
            updateGrandTotalOnly();
        });

        $(document).on('change', '.outsource-uom', function() {
            updateadditionalQuantityBasedOnUOM(this);
            calculateTotals(); // Recalculate totals after UOM change
            updateGrandTotalOnly();
        });


        $('#toggleBillBtn').on('click', function() {
            $('#billingSection').toggle();
        });

        setTimeout(function() {
            const gst1 = $('#gstn').val().trim();
            const gst2 = $('#gstnumber option:selected').text().trim();
            if (gst1.length === 15 && gst2.length === 15) {
                gstdetail(gst1, gst2);
            } else {
                console.warn('One or both GST numbers are not valid or not 15 characters long on load.');
            }
        }, 500);

        $('#gst_percentage').on('input', updateGSTFields);

        // Event listener for GST number changes
        $('#gstn, #gstnumber').on('change', function() {
            const gst1 = $('#gstn').val().trim();
            const gst2 = $('#gstnumber option:selected').text().trim();
            if (gst1.length === 15 && gst2.length === 15) {
                gstdetail(gst1, gst2);
            } else {
                console.warn('One or both GST numbers are not valid.');
            }
        });

        var invoice = <?php echo json_encode(isset($billing_data['invoice']) ? $billing_data['invoice'] : null); ?>;
        var paymentreceipt = <?php echo json_encode(isset($billing_data['paymentreceipt']) ? $billing_data['paymentreceipt'] : null); ?>;
        var additionalExpenses = <?php echo json_encode(isset($billing_data['additional_expenses']) ? $billing_data['additional_expenses'] : null); ?>;

        $("#submitData").text(invoice ? "Edit" : "Submit");
        $('.payment-receipt').hide();
        if (paymentreceipt) {
            $('.payment-receipt').show();
        }
        if (Array.isArray(additionalExpenses) && additionalExpenses.length > 0) {
            addNew(additionalExpenses);
            updateGrandTotalOnly(additionalExpenses);
            // fetchBilling(additionalExpenses);

        }

        if (invoice) {
            $(".venorbtn").prop('disabled', true).css('opacity', '0.6');
            $(".addfieldmodal").prop('disabled', true).css('opacity', '0.6');
            $("#cgst_percentage, #sgst_percentage").prop("disabled", true);
            $(".editable-field, .description-input, select.item-select, select.uom-select, .remove-btn").prop("disabled", true);
            fetchBilling();
            addNewRow(invoice);
            addNew(additionalExpenses);

            $('#billingSection').show();
            $('#toggleBillBtn').prop("disabled", true).css('opacity', '0.6');
            $("select.item-select").prop("disabled", true);
        } else {
            $('#billingSection').hide();
        }

        var additionalexpensesexists = <?php echo json_encode(isset($additionalExpenses) ? $additionalExpenses : null); ?>;
        if (additionalexpensesexists) {
            addNew(additionalexpensesexists);
        }

        fetchAmount();

        $("#submitData").click(function() {
            const buttonText = $(this).text();
            if (buttonText === "Submit" || buttonText === "Update") {
                if (validateRows()) {
                    submitData();
                    if (buttonText === "Submit") {
                        disableFields();
                    } else if (buttonText === "Update") {
                        disableFields();
                    }
                }
            } else if (buttonText === "Edit") {
                enableFields();
            }
        });

        // Update amount calculation without formatting during input
        $(document).on('input', '.rate-input, .qty-input', function() {
            const $row = $(this).closest('.item-row');
            const rate = parseFloat(($row.find('.rate-input').val() || '0').replace(/,/g, ''));
            const qty = parseFloat(($row.find('.qty-input').val() || '0').replace(/,/g, ''));

            // Calculate the amount and update without formatting (raw amount)
            const amount = (rate * qty).toFixed(2);
            $row.find('.amount-input').val(amount);
        });

        // Format currency on blur
        $(document).on('blur', '.rate-input, .qty-input', function() {
            formatCurrency(this); // Format value on blur
        });

        const defaultGST = 18;
        $('#gst_percentage').val(defaultGST);
        checkGSTDetails();

        // Event listener for change in GST number select
        $('#gstnumber').on('change', function() {
            checkGSTDetails();
        });

        // Event listener for input in GST percentage field
        $('#gst_percentage').on('input', function() {
            updateGSTFields();
            // Call calculateTotals to update totals
        });

        $('.gst').on('click', function() {
            toggleGSTInput();
        });

        // Add row button for itemr
        // $("#addRowBtn").on("click", function() {
        //     $(".editable-field, select.item-select, select.uom-select, .remove-btn").prop("disabled", false);
        // });

        window.removeField = function(button) {
            var $rowToRemove = $(button).closest('tr'); // Find the closest row using jQuery
            var $amountInput = $rowToRemove.find('.amount-input'); // Find the input with the 'amount-input' class

            var removedAmount = parseFloat($amountInput.val().replace(/,/g, ''));
            removedAmount = isNaN(removedAmount) ? 0 : removedAmount;

            var $grandTotalElement = $('#grand_total'); // Get the grand total input
            var existingGrandTotal = parseFloat($grandTotalElement.val().replace(/,/g, ''));
            existingGrandTotal = isNaN(existingGrandTotal) ? 0 : existingGrandTotal;

            // Subtract the removed row's amount from the grand total
            var newGrandTotal = existingGrandTotal - removedAmount;

            // Remove the row
            $rowToRemove.remove();

            // Update the grand total field
            $grandTotalElement.val(formatIndianCurrency(newGrandTotal));
            updateGrandTotalOnly();
        };

        window.removeRow = function(button) {
            $(button).closest('tr').remove(); // Remove the closest row
            calculateTotals();
            updateGrandTotalOnly();
        };

        window.removeField = function(button) {
            $(button).closest('tr').remove(); // Remove the closest row
            updateGrandTotalOnly(); // Call the function to update the grand total
        };

        // Attach event listeners to all rows with the 'item-row' class
        $('.item-row').each(function() {
            attachRowEventListeners(this, 'item-row'); // Use jQuery's `each` to iterate and attach event listeners
        });

        $(' .amount-input').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');

        });

    });
</script>