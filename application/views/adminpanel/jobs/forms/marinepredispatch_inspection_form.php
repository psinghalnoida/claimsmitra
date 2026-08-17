<form id="marinepredisform" method="post" enctype="multipart/form-data" style="display:block">
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Contact Person Name</span>
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
        <span class="label-text col-lg-3 col-form-label location_of_survey">Location of survey</span>
        <div class="col-lg-3">
            <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Pincode" class="form-control location_of_survey">
            <div id="error_message" style="color: red;"></div>
        </div>
        <div class="col-lg-6">
            <input type="text" name="address" id="address" placeholder="Address" class="form-control address">
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Contact Person Mobile</span>
        <div class="col-lg-9">
            <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Mobile Number (Please Enter Whatsapp number for further update)" class="form-control">
            <div id="error_message" style="color: red;"></div>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Case Reference</span>
        <div class="col-lg-9">
            <input type="text" name="case_reference" id="contact_person_mobile" placeholder="Case Reference" class="form-control">
            <div id="error_message" style="color: red;"></div>
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Are you available at location?</span>
        <div class="col-lg-9">
            <select class="form-control available_at_location" id="available_at_location" name="available_at_location">
                <option value="">Select option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
    </div>

    <div class="form-group row" id="whatsapp_no" style="display:none">
        <span class="label-text col-lg-3 col-form-label">Enter WhatsApp Number of The Person available at location</span>
        <div class="col-lg-9">
            <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Enter Whatsapp Number" class="form-control whatsapp_number">
        </div>
    </div>



    <div class="form-group row" id="consignee">
        <span class="label-text col-lg-3 col-form-label">Name of consignee</span>
        <div class="col-lg-9">
            <input type="text" name="name_of_consignee" id="name_of_consignee" placeholder="Name of Consignee" class="form-control name_of_consignee">
        </div>
    </div>

    <div class="form-group row" id="commodity">
        <span class="label-text col-lg-3 col-form-label">Commodity</span>
        <div class="col-lg-9">
            <input type="text" name="name_of_commodity" id="name_of_commodity" placeholder="Commodity" class="form-control">
        </div>
    </div>

   

    <div id="invoiceContainer">
        <div class="form-group row" id="invoice">
            <span class="label-text col-lg-3 col-form-label">Invoice 1</span>
            <div class="col-lg-3">
                <input type="text" name="invoicenumber[]" id="invoicenumber" placeholder="Invoice Number" class="form-control">
            </div>
            <div class="col-lg-2">
                <input type="date" name="invoicedate[]" id="invoicedate" placeholder="Invoice Date" class="form-control">
            </div>
            <div class="col-lg-3">
                <input type="file" name="addinvoice[]" class="form-control addinvoice">
            </div>
            <div class="col-lg-1" style="align-self:center">
                <button type="button" onclick="addMoreInvoice()" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i></button>
            </div>
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

    <input type="hidden" name="button_action" class="button_action" id="button_action">
    <div class="modal-footer" style="padding-right:0px;">
        <button type="reset" class="btn btn-rounded btn-secondary" id="btn_reset_form">Reset</button><br>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_marinepredis_form">Submit With Payment</button>
        <button type="submit" class="btn btn-rounded btn-success" id="btn_marinepredis_without_form">Submit Without Payment</button>
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

  });


     let invoiceCounter = 0;

        function addMoreInvoice() {
            var container = document.getElementById('invoiceContainer');
            var newRow = document.createElement('div');
            invoiceCounter = container.children.length + 1;
            newRow.className = 'form-group row';
            newRow.innerHTML = `<span class="label-text col-lg-3 col-form-label">Invoice ${invoiceCounter}</span>
                            <div class="col-lg-3">
                                <input type="text" name="invoicenumber[]" placeholder="Invoice Number" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <input type="date" name="invoicedate[]" placeholder="Invoice Date" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <input type="file" name="addinvoice[]" class="form-control">
                            </div>
                            <div class="col-lg-1" style="align-self:center">
                                <button type="button" onclick="removeInvoice(this)" class="btn btn-rounded btn-warning"><i class="fa fa-times"></i></button>
                            </div>`;
            container.appendChild(newRow);
        }

        function removeInvoice(element) {
            var rowToRemove = element.parentNode.parentNode;
            rowToRemove.parentNode.removeChild(rowToRemove);
            updateInvoiceLabels();
        }

        function updateInvoiceLabels() {
            invoiceCounter = 1;
            var invoiceRows = document.querySelectorAll('#invoiceContainer .form-group.row');
            invoiceRows.forEach(row => {
                var label = row.querySelector('.label-text');
                label.textContent = `Invoice ${invoiceCounter}`;
                invoiceCounter++;
            });
        }
</script>