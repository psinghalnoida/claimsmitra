           <div id="invoiceContainer">
                <div class="form-group row" id="invoice">
                    <div class="col-lg-4">
                        <label for="invoicenumber" style="color:black">Invoice Number</label>
                        <input type="text" name="invoicenumber[]" id="invoicenumber" placeholder="Invoice Number" class="form-control editable-field">
                    </div>
                    <div class="col-lg-4">
                        <label for="invoicedate" style="color:black">Invoice Date</label>
                        <input type="date" name="invoicedate[]" id="invoicedate" placeholder="Invoice Date" class="form-control editable-field">
                    </div>
                    <div class="col-lg-3">
                        <label for="invoicevalue" style="color:black">Invoice Value</label>
                        <input type="text" name="invoicevalue[]" id="invoicevalue" placeholder="Invoice Value" class="form-control addinvoice editable-field">
                    </div>
                    <div class="col-lg-1 disabledbtn" style="text-align:end">
                        <label for="add_more" style="color:black; text-align:center">Add More</label>
                        <button type="button" onclick="addNewInvoice()"  style="width:100%;height:39px;" class="btn btn-rounded btn-success editable-field disabledbtn"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>

          <?php if ($natureofjob === 66 || $natureofjob === 62) { ?>
            <div class="row my-3">
                <div class="col-xl-3 col-md-3">
                    <div class="form-group">
                        <label for="consignment_value" style="color:black">Total Consignment Value </label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->consignment_value) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->consignment_value) ? $essentialdata->consignment_value : ""; ?>" value="" name="consignment_value" id="consignment_value" placeholder="Total consignment Value">
                    </div>
                </div>
                <div class="col-xl-1 col-md-1 form-inline">
                    <label class="form-check">
                        <!-- Checkbox will be checked by default unless print_estimated_amt is 0 -->
                        <input type="checkbox" name="print_estimated_amt" value="1" class="form-check-input disable_btn" <?php echo (isset($essentialdata->print_estimated_amt) && $essentialdata->print_estimated_amt != 0) ? 'checked' : ''; ?> >
                        <span class="form-check-label">Print</span>
                    </label>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="estimated_amount" style="color:black">Estimated Loss </label>
                        <input type="text" 
                               class="form-control editable-field" 
                               <?php echo isset($essentialdata->estimated_amount) ? "disabled" : ""; ?> 
                               value="<?php echo isset($essentialdata->estimated_amount) ? $essentialdata->estimated_amount : ""; ?>" 
                               name="estimated_amount"
                               id="estimated_loss_per_ila" 
                               placeholder="Estimated Loss">
                        <div class="number-in-words" style="color: green; margin-top: 5px;"></div> <!-- For number in words -->
                    </div>
                </div>

                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="lumsum" style="color:black">Select</label>
                        <select class="form-control editable-field" id="lumsum" name="lumsum" <?php echo isset($essentialdata->lumsum) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Percentage" <?php echo ($essentialdata->lumsum ?? '') == 'Percentage' ? 'selected' : ''; ?>>Percentage</option>
                            <option value="Fixed" <?php echo ($essentialdata->lumsum ?? '') == 'Fixed' ? 'selected' : ''; ?>>Fixed</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-1 col-md-1">
                    <div class="form-group">
                        <label for="salvage_amount" style="color:black">Salvage Amount</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->salvage_amount) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->salvage_amount) ? $essentialdata->salvage_amount : ""; ?>" name="salvage_amount" id="salvage_amount" placeholder="Salvage Amount">
                    </div>
                </div>
                 <div class="col-xl-1 col-md-1 form-inline">
                    <label class="form-check">
                        <!-- Checkbox will be checked by default unless print_estimated_amt is 0 -->
                        <input type="checkbox" name="print_salvage_amt" value="1" class="form-check-input" <?php echo (isset($essentialdata->print_salvage_amt) && $essentialdata->print_salvage_amt != 0) ? 'checked' : ''; ?> >

                        <span class="form-check-label">Print</span>
                    </label>
                </div>
            </div>
            <div id="grContainer">
                <div class="form-group row" id="gr">
                    <div class="col-lg-6">
                        <label for="grnumber" style="color:black">GR Number</label>
                        <input type="text" name="grnumber[]" id="grnumber" placeholder="GR Number" class="form-control editable-field">
                    </div>
                    <div class="col-lg-5">
                        <label for="grdate" style="color:black">GR Date</label>
                        <input type="date" name="grdate[]" id="grdate" placeholder="GR Date" class="form-control editable-field">
                    </div>
                    <div class="col-lg-1 disabledbtn" style="text-align:end">
                        <label for="add_more_gr" style="color:black; text-align:center">Add More</label>
                        <button type="button" onclick="addNewgr()"  style="width:100%;height:39px;" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
          <?php } ?>