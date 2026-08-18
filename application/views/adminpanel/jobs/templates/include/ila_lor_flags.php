<?php
$sendIla = isset($essentialdata->send_ila) ? $essentialdata->send_ila : (isset($jobdata->send_ila) ? $jobdata->send_ila : '0');
$sendLor = isset($essentialdata->send_lor) ? $essentialdata->send_lor : (isset($jobdata->send_lor) ? $jobdata->send_lor : '0');
$sendIla = workflow_flag_on($sendIla) ? '1' : '0';
$sendLor = workflow_flag_on($sendLor) ? '1' : '0';
?>
<div class="row mt-2">
    <div class="col-xl-6 col-md-6">
        <div class="form-group">
            <label style="color:black">Send ILA on jobs that use this template</label>
            <select class="form-control editable-field" name="send_ila" id="send_ila">
                <option value="0" <?php echo $sendIla === '0' ? 'selected' : ''; ?>>No — skip ILA</option>
                <option value="1" <?php echo $sendIla === '1' ? 'selected' : ''; ?>>Yes — send ILA</option>
            </select>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="form-group">
            <label style="color:black">Send LOR on jobs that use this template</label>
            <select class="form-control editable-field" name="send_lor" id="send_lor">
                <option value="0" <?php echo $sendLor === '0' ? 'selected' : ''; ?>>No — skip LOR</option>
                <option value="1" <?php echo $sendLor === '1' ? 'selected' : ''; ?>>Yes — send LOR</option>
            </select>
        </div>
    </div>
</div>
<p class="text-muted" style="font-size:13px;">This is the field template, not an email template. Default is skip. Turn on only if this repeat product still needs ILA or LOR.</p>
