<!-- Name of Handler -->
<!-- <div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Name of Handler &nbsp;<span style="color:red">*</span></span>
    <div class="col-lg-9">
        <input type="text" name="claim_handler" id="claim_handler"
            placeholder="Enter Handler's Name"
            class="form-control firstLetterCapital">
    </div>
</div> -->

<!-- Search Professional -->
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Search Surveyor &nbsp;<span style="color:red">*</span></span>
    <div class="col-lg-9">
        <div>
            <input type="text" name="search_inspector" id="search_inspector" placeholder="Search Professional" class="form-control" autocomplete="new-password">
            <input type="hidden" name="inspectorid" id="inspectorid" class="form-control">
            <input type="hidden" name="departmentid" id="departmentid" class="form-control">
            <input type="hidden" name="companyid" id="cid_from" class="form-control">
            <div id="searchResults"></div>
        </div>
        <?php echo form_error('search_inspector', '<div class="error text-danger">', '</div>'); ?>
    </div>
</div>

<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Select Template </span>
    <div class="col-lg-9">
        <div>
            <select class="form-control editable-field" id="template_name" name="template_name">
                <option value="">-- Select Template --</option>
                <?php if (!empty($templatedata)) : ?>
                    <?php foreach ($templatedata as $template) : ?>
                        <?php
                            $templateId = $template['id'] ?? 0;
                            $templateName = htmlspecialchars($template['template_name'] ?? '');
                            $ila = !empty($template['send_ila']) ? 'ILA' : 'no ILA';
                            $lor = !empty($template['send_lor']) ? 'LOR' : 'no LOR';
                            $tat = (int) ($template['submission_tat_days'] ?? 15);
                        ?>
                        <option value="<?= $templateId ?>"
                            data-send-ila="<?= !empty($template['send_ila']) ? '1' : '0' ?>"
                            data-send-lor="<?= !empty($template['send_lor']) ? '1' : '0' ?>"
                            data-tat="<?= $tat ?>">
                            <?= $templateName ?> (<?= $ila ?>, <?= $lor ?>, <?= $tat ?>d)
                        </option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option disabled>No templates found</option>
                <?php endif; ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Assignment class</span>
    <div class="col-lg-9">
        <select class="form-control" name="assignment_class" id="assignment_class">
            <option value="REG">REG — ILA and LOR mandatory</option>
            <option value="STY">STY — ILA/LOR from template or mark below</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">After receipt</span>
    <div class="col-lg-3">
        <select class="form-control" name="send_ila" id="job_send_ila">
            <option value="1">ILA mandatory (3 days)</option>
            <option value="0">ILA skip (STY only)</option>
        </select>
    </div>
    <div class="col-lg-3">
        <select class="form-control" name="send_lor" id="job_send_lor">
            <option value="1">LOR mandatory (24 hours)</option>
            <option value="0">LOR skip (STY only)</option>
        </select>
    </div>
    <div class="col-lg-3">
        <select class="form-control" name="submission_tat_days" id="job_submission_tat">
            <option value="5">5 days to dispatch</option>
            <option value="15" selected>15 days to dispatch</option>
            <option value="30">30 days to dispatch</option>
        </select>
    </div>
</div>
<script>
$(function() {
    $('#template_name').on('change', function() {
        var opt = $(this).find('option:selected');
        if (!$(this).val()) {
            $('#assignment_class').val('REG');
            $('#job_send_ila').val('1');
            $('#job_send_lor').val('1');
            return;
        }
        $('#assignment_class').val('STY');
        $('#job_send_ila').val(opt.data('send-ila'));
        $('#job_send_lor').val(opt.data('send-lor'));
        if (opt.data('tat')) {
            $('#job_submission_tat').val(String(opt.data('tat')));
        }
    });
});
</script>


<!-- Instruction -->
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Instruction</span>
    <div class="col-lg-9">
        <input type="text" name="instruction" id="instruction"
            placeholder="Add any instruction (if any)"
            class="form-control">
    </div>
</div>