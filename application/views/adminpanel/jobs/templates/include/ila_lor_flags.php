<?php
$sendIla = isset($essentialdata->send_ila) ? $essentialdata->send_ila : (isset($jobdata->send_ila) ? $jobdata->send_ila : '0');
$sendLor = isset($essentialdata->send_lor) ? $essentialdata->send_lor : (isset($jobdata->send_lor) ? $jobdata->send_lor : '0');
$sendIla = workflow_flag_on($sendIla) ? '1' : '0';
$sendLor = workflow_flag_on($sendLor) ? '1' : '0';
$tatDays = isset($essentialdata->submission_tat_days) ? (int) $essentialdata->submission_tat_days : (isset($jobdata->submission_tat_days) ? (int) $jobdata->submission_tat_days : 15);
$tatOptions = array(5, 15, 30);
if (!in_array($tatDays, $tatOptions, true)) {
    $tatDays = 15;
}
?>
<div class="row mt-2">
    <div class="col-xl-6 col-md-6">
        <div class="form-group">
            <label style="color:black">Send ILA on STY jobs that use this template</label>
            <select class="form-control editable-field" name="send_ila" id="send_ila">
                <option value="0" <?php echo $sendIla === '0' ? 'selected' : ''; ?>>Optional — skip ILA</option>
                <option value="1" <?php echo $sendIla === '1' ? 'selected' : ''; ?>>Mandatory — send ILA (3 days from ack)</option>
            </select>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="form-group">
            <label style="color:black">Send LOR on STY jobs that use this template</label>
            <select class="form-control editable-field" name="send_lor" id="send_lor">
                <option value="0" <?php echo $sendLor === '0' ? 'selected' : ''; ?>>Optional — skip LOR</option>
                <option value="1" <?php echo $sendLor === '1' ? 'selected' : ''; ?>>Mandatory — send LOR (24 hours from ack)</option>
            </select>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="form-group">
            <label style="color:black">Submission TAT (acknowledgement → dispatch)</label>
            <select class="form-control editable-field" name="submission_tat_days" id="submission_tat_days">
                <?php foreach ($tatOptions as $d) { ?>
                    <option value="<?php echo $d; ?>" <?php echo $tatDays === $d ? 'selected' : ''; ?>><?php echo $d; ?> days</option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<p class="text-muted" style="font-size:13px;">REG jobs ignore skip: ILA and LOR stay mandatory. STY follows this template unless the handler marks otherwise after receipt. Clock starts at acknowledgement.</p>
