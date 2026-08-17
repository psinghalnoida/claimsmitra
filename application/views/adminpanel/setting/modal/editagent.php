<div id="edit_agent" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bank_detail_title">Edit Agent</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="edit_agetn_form"  method="post" enctype="multipart/form-data">
                <input type="hidden" value="" name="id"/>
                <!-- <?php $this->load->view('adminpanel/setting/modal/select_insurance'); ?> -->
                <div class="form-group row">
                    <span class="label-text col-lg-3 col-form-label">Insurance Company <span style="color:red">*</span></span>
                    <div class="col-lg-9">
                        <input type="text" name="insurance_company" id="edit_insurance_company" class="form-control" placeholder="Licence number" required>
                    </div>
                    <!-- <select name="insurance_company" id="edit_insurance_company" class="form-control" required>
                        <option value="">Select an Insurance Company</option>
                    </select> -->
                </div>
                <div class="form-group row">
                    <span class="label-text col-lg-3 col-form-label">Licence Number <span style="color:red">*</span></span>
                    <div class="col-lg-9">
                        <input type="text" name="licence_number" id="edit_licence_number" class="form-control" placeholder="Licence number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <span class="label-text col-lg-3 col-form-label" for="date_picker">Licence Validity <span style="color:red">*</span></span>
                    <div class="col-lg-9">
                        <input type="date" name="licence_validity" id="edit_date_picker" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-rounded btn-success" id="btn_save_agent">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>