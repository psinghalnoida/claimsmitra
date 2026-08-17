<style>
    .upload-label {
        position: absolute;
        top: 29px;
        right: 21px;
        cursor: pointer;
        width: 107px;
        height: 39px;
        background-color: #2BB3C0;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
    }

    .btn-success,
    .btn-danger {
        width: 107px;
        height: 39px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
    }

    .hidden {
        display: none !important;
    }

    .note-popover .modal-backdrop {
        z-index: 1040 !important;
        display: none !important;
    }

    .note-popover .modal {
        z-index: 1050 !important;
    }
</style>
<div class="panel ">
    <form id="engineering_final_essential" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <i class="fa-solid fa-upload"></i></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <i class="fa-solid fa-upload"></i></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <?php $this->load->view("adminpanel/jobs/essential_forms/property/propertycommandata") ?>
        </div>
        <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
            <input class="btn case_btn toggle-edit" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="engineering_final_submit">
        </div>
    </form>
</div>


