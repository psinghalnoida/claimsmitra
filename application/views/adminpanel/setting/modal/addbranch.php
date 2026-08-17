<div id="addbranch" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="branch_detail_title">Add Branch</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="add_branch" method="post" enctype="multipart/form-data">            
                    <input type="hidden" value="" name="cid" id="cid"/>
                    <div class="form-group row">
                        <span class="label-text col-lg-4 col-form-label">Address <span style="color:red">*</span></span>
                        <div class="col-lg-8">
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-lg-4 col-form-label">Pincode <span style="color:red">*</span></span>
                        <div class="col-lg-8">
                        <input type="text" name="pincode" id="pincode" placeholder="Pincode" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-lg-4 col-form-label">State <span style="color:red">*</span></span>
                        <div class="col-lg-8">
                            <input type="text" name="state" id="state" placeholder="State" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-lg-4 col-form-label">City <span style="color:red">*</span></span>
                        <div class="col-lg-8">
                            <input type="text" name="city" id="city" placeholder="City" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-lg-4 col-form-label">GST <span style="color:red">*</span></span>
                        <div class="col-lg-8">
                            <input type="text" name="gst" id="gst" placeholder="GST" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="addnewbranch()" class="btn btn-sm btn-rounded btn-success" id="btn_save_branch">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>