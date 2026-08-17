<div id="uploadfiles" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bank_detail_title">Upload Files</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="upload_file" method="post" enctype="multipart/form-data"> 
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group row">
                        <span class="label-text col-lg-3 col-form-label">Upload File <span style="color:red">*</span></span>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="file" id="uploadreport" name="uploadreport[]" class="custom-file-input form-control" multiple='multiple'>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 20px; margin-left: 24%">
                        <div class="col-lg-9">
                            <div id="report_thumb" class="pdf_thumb">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-rounded btn-success" id="btn_save_bank">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>