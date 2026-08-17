<div id="invoiceContainer">
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Invoice 1</span>
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
            <button type="button" onclick="addMoreInvoice()" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    let invoiceCounter = 1; 

    function addMoreInvoice() {
        invoiceCounter = $('#invoiceContainer .form-group.row').length + 1;
        var newRow = `<div class="form-group row">
                        <span class="label-text col-lg-3 col-form-label">Invoice ${invoiceCounter}</span>
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
                        </div>
                    </div>`;
        $('#invoiceContainer').append(newRow);
    }

    function removeInvoice(element) {
        $(element).closest('.form-group.row').remove();
        updateInvoiceLabels();
    }

    function updateInvoiceLabels() {
        let invoiceRows = $('#invoiceContainer .form-group.row');
        invoiceRows.each(function(index) {
            $(this).find('.label-text').text(`Invoice ${index + 1}`);
        });
    }
</script>
