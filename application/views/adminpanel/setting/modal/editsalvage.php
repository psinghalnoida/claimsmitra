<style>
    .textwrap{
        overflow: hidden; 
    }
</style>
<div class="modal" id="edit_salvage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Salvage</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" style="font-size:14px;">Selected Subcategories</label>
                    <div class="col-lg-8">
                        <div id="selected_subcategories" class="form-control textwrap" style="white-space: nowrap;"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" style="font-size:14px;">Buy Range</label>
                    <div class="col-lg-8">
                        <div id="buyer_range" class="form-control"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" style="font-size:14px;">Selected Region</label>
                    <div class="col-lg-8">
                        <div id="selected_region" class="form-control textwrap" style="white-space: nowrap;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

