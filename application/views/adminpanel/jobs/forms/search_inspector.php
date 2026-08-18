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
                        ?>
                        <option value="<?= $templateId ?>"><?= $templateName ?> (<?= $ila ?>, <?= $lor ?>)</option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option disabled>No templates found</option>
                <?php endif; ?>
            </select>
        </div>
    </div>
</div>


<!-- Instruction -->
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Instruction</span>
    <div class="col-lg-9">
        <input type="text" name="instruction" id="instruction"
            placeholder="Add any instruction (if any)"
            class="form-control">
    </div>
</div>