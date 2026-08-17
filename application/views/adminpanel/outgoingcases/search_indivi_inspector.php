
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


<!-- Instruction -->
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Instruction</span>
    <div class="col-lg-9">
        <input type="text" name="instruction" id="instruction"
            placeholder="Add any instruction (if any)"
            class="form-control">
    </div>
</div>







