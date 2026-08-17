<div class="col-xl-4 col-md-6 col-sm-12">
    <div class="form-group">
        <label style="color:black">Date & Time of Loss</label>
        <div class="input-group">
            <!-- Date of Loss -->
            <input type="text" class="form-control editable-field"
                <?php echo isset($essentialdata->loss_data) ? "disabled" : ""; ?>
                value="<?php echo isset($essentialdata->loss_data) ? $essentialdata->loss_data : ""; ?>"
                name="loss_data"
                id="loss_data"
                placeholder="Loss Date" style="margin-right:8px;">
            <input type="hidden"
                class="form-control editable-field loss_date_text"
                value="<?php echo isset($essentialdata->loss_date_text) ? $essentialdata->loss_date_text : ""; ?>"
                name="loss_date_text">
            <!-- Time of Loss -->
            <input type="time" class="form-control editable-field"
                <?php echo isset($essentialdata->loss_time) ? "disabled" : ""; ?>
                value="<?php echo isset($essentialdata->loss_time) ? $essentialdata->loss_time : ""; ?>"
                name="loss_time"
                id="loss_time" style="margin-right:8px;">
            <!-- Button -->
            <button type="button" class="btn btn-info toggle-manual-entry"
                id="toggleManualEntry">
                <i class="fa fa-comment" aria-hidden="true"></i>
            </button>
        </div>
        <!-- Loss Date Text -->
        <div class="text-success mt-1 loss_date_text">
            <?php echo isset($essentialdata->loss_date_text) ? $essentialdata->loss_date_text : ""; ?>
        </div>
    </div>
</div>