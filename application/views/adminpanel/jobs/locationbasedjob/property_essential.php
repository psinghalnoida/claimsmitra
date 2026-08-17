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

.btn-success, .btn-danger {
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
    <form id="property_essential" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                     <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;"  >
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <!-- FORM START -->
            <div class="row">
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="case_reference" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input 
                        type="text" 
                        class="form-control editable-field" 
                        <?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) ? "disabled" : ""; ?> 
                        value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) 
                                        ? $essentialdata->case_reference 
                                        : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" 
                        name="case_reference" 
                        id="case_reference" 
                        placeholder="Case Reference" 
                        
                    >
                    </div>
                </div>
                 <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field date_of_report" <?php echo isset($essentialdata->date_of_report) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->date_of_report) ? format_date($essentialdata->date_of_report, 'd-m-Y') : ""; ?>" name="date_of_report" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color: black;">Name of insured &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) ? $essentialdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name of insured" >
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_name" style="color:black">Contact Person Name &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo (isset($essentialdata->contact_person_name) || isset($essentialdata->contact_person_name)) ? "disabled" : "enable"; ?>
                            value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name) 
                                        ? $essentialdata->contact_person_name 
                                        : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" name="contact_person_name" id="contact_person_name" placeholder="Name of Owner" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="address" style="color:black">Address of insured &nbsp;<span style="color:red">*</span></label>
                        <input 
                        type="text" 
                        class="form-control editable-field" 
                        <?php echo isset($essentialdata->address) && !empty($essentialdata->address) ? "disabled" : ""; ?> 
                        value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address) 
                                        ? $essentialdata->address 
                                        : (isset($jobdata->address) ? $jobdata->address : ""); ?>" 
                        name="address" 
                        id="address" 
                        placeholder="Address of insured" 
                        
                      > 
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_data" style="color:black">Date of Loss &nbsp;<span style="color:red">*</span></label>
                        <input 
                        type="text" 
                        class="form-control editable-field" 
                        <?php echo isset($essentialdata->loss_data) && !empty($essentialdata->loss_data) ? "disabled" : ""; ?> 
                        value="<?php echo isset($essentialdata->loss_data) && !empty($essentialdata->loss_data) 
                                        ? $essentialdata->loss_data 
                                        : (isset($jobdata->loss_data) ? $jobdata->loss_data : ""); ?>" 
                        name="loss_data" 
                        id="loss_data" 
                        placeholder="Date of Loss" 
                        
                      > 
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loss_place" style="color:black">Place of Survey &nbsp;<span style="color:red">*</span></label>
                        <input 
                        type="text" 
                        class="form-control editable-field" 
                        <?php echo isset($essentialdata->survey_place) && !empty($essentialdata->survey_place) ? "disabled" : ""; ?> 
                        value="<?php echo isset($essentialdata->survey_place) && !empty($essentialdata->survey_place) 
                                        ? $essentialdata->survey_place 
                                        : (isset($jobdata->survey_place) ? $jobdata->survey_place : ""); ?>" 
                        name="survey_place" 
                        id="survey_place" 
                        placeholder="Place of Survey" 
                        
                      > 
                    </div>
                </div>     
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="Ofinstruction" style="color:black">Date and Time of Instruction &nbsp;<span style="color:red">*</span></label>
                        <textarea
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->Ofinstruction) && !empty($essentialdata->Ofinstruction) ? "disabled" : ""; ?>
                            name="Ofinstruction"
                            id="Ofinstruction"
                            
                        ><?php echo isset($essentialdata->Ofinstruction) ? $essentialdata->Ofinstruction : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="xlsheet" style="color:black">
                            Further Action <span style="color:red">(For table do not use more than 10 columns)</span>
                        </label>
                        <textarea name="xlsheetFile" id="xlsheetFile" spellcheck="true" 
                            class="form-control editable-field">        
                        </textarea>
                    </div>
                </div>
                
                </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="visit_date_time" style="color:black">Date and Time of Visit &nbsp;<span style="color:red">*</span></label>
                        <textarea
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->visit_date_time) && !empty($essentialdata->visit_date_time) ? "disabled" : ""; ?>
                            name="visit_date_time"
                            id="visit_date_time"
                            
                        ><?php echo isset($essentialdata->visit_date_time) ? format_date($essentialdata->visit_date_time, 'd-m-Y') : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="insured_activity" style="color:black">Activity of Insured in Brief &nbsp;<span style="color:red">*</span></label>
                        <textarea
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->insured_activity) && !empty($essentialdata->insured_activity) ? "disabled" : ""; ?>
                            name="insured_activity"
                            id="insured_activity"><?php echo isset($essentialdata->insured_activity) ? $essentialdata->insured_activity : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="loss_area" style="color:black">Area of Loss (Machine / Stock/FFF / Building ETC) &nbsp;<span style="color:red">*</span></label>
                        <textarea
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->loss_area) && !empty($essentialdata->loss_area) ? "disabled" : ""; ?>
                            name="loss_area"
                            id="loss_area" 
                            
                        ><?php echo isset($essentialdata->loss_area) ? $essentialdata->loss_area : ""; ?></textarea>
                    </div>
                </div>
            </div>

           <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group" style="position: relative;">
                          <label for="cause_loss" style="color: black; display: flex; align-items: center; width: 100%; margin-bottom: 2px;">
                            Cause of loss, its origin & nature & extent of loss
                                <button type="button" id="uploadButton" class="btn btn-primary" data-toggle="modal" data-target="#descImgmodal" data-modal-type="cause_loss" style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="<?php echo base_url('assets/gallery.png'); ?>" alt="img" style="width: 40px; height: 40px;">
                                </button>
                                <div style="flex-grow: 1;"></div>

                                <!-- Container for Dynamically Created Buttons -->
                               <div id="uploadedDataContainer" style="display: flex; gap: 2px; margin-top: 10px;"></div>
                          </label>
                        <div class="form-group" style="display: none;">
                            <label for="descrp[]">Description:</label>
                            <textarea class="form-control" id="descrp" name="descrp[]" rows="4" placeholder="Enter description"></textarea>
                        </div>

                        <!-- Image Upload Input -->
                        <div class="form-group" style="display: none;">
                            <label for="descImage[]">Upload Image:</label>
                            <input type="file" class="form-control-file" id="descImage" name="descImage[]">
                        </div>
                         <div id="imgPreviewContainer"></div>

                        <!-- Container for Textarea and Image Upload -->
                        <div class="textarea-container" style="position: relative;">
                            <!-- Textarea -->
                            <textarea
                                class="form-control editable-field"
                                <?php echo isset($essentialdata->cause_loss) && !empty($essentialdata->cause_loss) ? "disabled" : ""; ?>
                                name="cause_loss"
                                id="cause_loss"
                                placeholder="Enter details here"
                                style="padding-right: 40px;"
                            ><?php echo isset($essentialdata->cause_loss) ? $essentialdata->cause_loss : ""; ?></textarea>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="observation" style="color: black; display: flex; align-items: center; width: 100%; margin-bottom: 2px;">
                                Observation 
                                <button type="button" id="uploadobButton" class="btn btn-primary" data-toggle="modal" data-target="#observationImgmodal" data-modal-type="observation" style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="<?php echo base_url('assets/gallery.png'); ?>" alt="img" style="width: 40px; height: 40px;">
                                </button>
                                <div style="flex-grow: 1;"></div>
                                <div id="observationDataContainer" style="display: flex; gap: 2px; margin-top: 10px;"></div>
                            </label>
                                                    
                        <textarea
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->observation) && !empty($essentialdata->observation) ? "disabled" : ""; ?>
                            name="observation"
                            id="observation"><?php echo isset($essentialdata->observation) ? $essentialdata->observation : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row ">
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="stocks" style="color:black">Stocks </label>
                        <input
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->stocks) && !empty($essentialdata->stocks) ? "disabled" : ""; ?>
                            name="stocks"
                            id="stocks" placeholder="Stocks" value="<?php echo isset($essentialdata->stocks) ? $essentialdata->stocks : ""; ?>">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pm" style="color:black">P&M</label>
                        <input
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->pm) && !empty($essentialdata->pm) ? "disabled" : ""; ?>
                            name="pm" value="<?php echo isset($essentialdata->pm) ? $essentialdata->pm : ""; ?>"
                            id="pm" placeholder="P&M">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="building" style="color:black">Building </label>
                        <input
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->building) && !empty($essentialdata->building) ? "disabled" : ""; ?>
                            name="building"
                            id="building" value="<?php echo isset($essentialdata->building) ? $essentialdata->building : ""; ?>" placeholder="Building">
                    </div>
                </div>
            </div>
             <div class="row ">
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="total" style="color:black">Total </label>
                        <input
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->total) && !empty($essentialdata->total) ? "disabled" : ""; ?>
                            name="total" value="<?php echo isset($essentialdata->total) ? $essentialdata->total : ""; ?>"
                            id="total" placeholder="Total">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="recovery" style="color:black">Recoveries and Reductions</label>
                        <input
                            class="form-control editable-field"
                            <?php echo isset($essentialdata->recovery) && !empty($essentialdata->recovery) ? "disabled" : ""; ?>
                            name="recovery"
                            id="recovery" placeholder="Recoveries and Reductions" value="<?php echo isset($essentialdata->recovery) ? $essentialdata->recovery : ""; ?>">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="expected_liability" style="color:black">Expected Liability </label>
                        <input class="form-control editable-field" <?php echo isset($essentialdata->expected_liability) && !empty($essentialdata->expected_liability) ? "disabled" : ""; ?> name="expected_liability"id="expected_liability" placeholder="Expected Liability" value="<?php echo isset($essentialdata->expected_liability) ? $essentialdata->expected_liability : ""; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="property_submit">
        </div>
    </form>
</div>
  <!-- Modal Structure -->
  <div id="descImgmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="descImgmodalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="descImgmodalLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Image Upload Input -->
                <div class="form-group">
                    <label for="descImg">Upload Image:</label>
                    <input type="file" class="form-control-file" id="descImg" name="descImg">
                </div>
                <!-- Description Input -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter description"></textarea>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary case_btn" style="background-color: #2BB3C0;" data-dismiss="modal">Close</button>
                <button type="button" style="background-color: #e16123;" id="submitmodaldata" class="btn btn-primary case_btn" style="display: none;">Add</button>
            </div>
        </div>
    </div>
</div>

<div id="observationImgmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="observationImgmodalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="observationImgmodalLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="obdescImg">Upload Image:</label>
                    <input type="file" class="form-control-file" id="obdescImg" name="obdescImg">
                </div>
                <div class="form-group">
                    <label for="obdescription">Description:</label>
                    <textarea class="form-control" id="obdescription" name="obdescription" rows="4" placeholder="Enter description"></textarea>
                </div>
                <div id="observationPreview" style="text-align: center; margin-top: 10px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary case_btn" data-dismiss="modal">Close</button>
                <button type="button" style="background-color: #e16123;"  id="observationmodaldata" class="btn btn-primary case_btn">Add</button>
            </div>
        </div>
    </div>
</div>

<script> 
    $(document).ready(function () {
        displayButtonsOnLoad();
             $('#xlsheetFile').summernote({
                height: 200,  // Set the height of the Summernote editor
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImageToServer(files, function(imageUrl) {
                            $('#xlsheetFile').summernote('insertImage', imageUrl);
                        });
                    },
                    onModalShown: function() {
                        setTimeout(function() {
                            // Apply inline CSS for the backdrop
                            var backdrop = $('.note-popover').find('.modal-backdrop');
                            backdrop[0].style.position = 'fixed';
                            backdrop[0].style.top = '0';
                            backdrop[0].style.right = '0';
                            backdrop[0].style.bottom = '0';
                            backdrop[0].style.left = '0';
                            backdrop[0].style.zIndex = '1040';
                            backdrop[0].style.backgroundColor = 'rgba(0, 0, 0, 0.5)';

                            // Apply inline CSS for the modal
                            $('.note-popover .modal')[0].style.zIndex = '1050';
                        }, 100);  // Delay to ensure modal is fully rendered first
                    },
                    onModalHidden: function() {
                        // Hide the backdrop inline
                        $('.note-popover').find('.modal-backdrop')[0].style.display = 'none';
                    }
                }
            });

        // Example image upload handler
      


        function uploadImageToServer(files, callback) {
            const aid = "<?php echo $aid; ?>";

            if (!aid) {
                console.error('Error: "aid" is not defined.');
                alert('Failed to upload. "aid" parameter is missing.');
                return;
            }

            if (!files || files.length === 0) {
                alert('Please select a file to upload.');
                return;
            }

            var formData = new FormData();
            formData.append('image', files[0]);
            formData.append('aid', aid);

            $.ajax({
                url: '<?php echo base_url("cases/upload_image"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        callback(response.imageUrl);
                    } else {
                        alert('Image upload failed: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Image upload failed:', xhr.responseText);
                    alert('Image upload failed. Please try again.');
                }
            });
        }

        $('#descImg').on('change', function () {
           $('#imgPreviewContainer').empty();
            const files = this.files; 
            if (files.length > 0) {
                Array.from(files).forEach((file, index) => {
                    // Ensure the file is an image
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            // Create an image element for preview
                            const imgPreview = `
                                <div style="display: inline-block; margin: 5px; text-align: center;">
                                    <img src="${e.target.result}" alt="Image Preview" 
                                        style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                    <p style="font-size: 12px;">${file.name}</p>
                                </div>
                                <div style="display: inline-block; margin: 5px; text-align: center;">
                                </div>`;
                            $('#imgPreviewContainer').append(imgPreview);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert(`File ${file.name} is not an image.`);
                    }
                });
            }
        });

        var uploadedData = [];
        $(document).on('click', 'button', function () {
            const buttonId = $(this).attr('id'); 
            const modalType = $(this).data('modal-type'); 
            if (buttonId === 'uploadButton' && modalType === 'cause_loss') {
                $("#descImgmodal .modal-body img").remove();
                $("#description").val('');
                $("#descImg").replaceWith(`
                    <input type="file" class="form-control-file" id="descImg" name="descImg">
                `); 
                $('#descImgmodal').modal('show');
            } else if ($(this).hasClass('uploaded-image-btn')) {
                const aid = "<?php echo $aid; ?>";
                const imageUrl = $(this).data('image-url');
                const index = $(this).data('index');
                const description = $(this).data('description'); 
                const fullImageUrl = imageUrl;
                $("#descImgmodal .modal-body img").remove(); 
                $("#descImgmodal .modal-body").append(`
                    <img src="${imageUrl}" alt="Full Image" style="max-width: 100px; max-height: 100px; display: block; margin: 0 auto;">
                `); 
                $("#description").val(description); 
                $('#descImgmodal').modal('show');
            }
        });
   
        var modalCounter = 1;
        function displayButtonsOnLoad() {
            var essentialdataExists = <?php echo json_encode(isset($essentialdata) ? $essentialdata : null); ?>;
            if (essentialdataExists && essentialdataExists.images) {
                try {
                    var imagesArray = JSON.parse(essentialdataExists.images);
                    imagesArray.forEach((image, index) => {
                        const aid = <?php echo json_encode($aid); ?>;  // PHP variable $aid passed to JavaScript
                        const folderPath = `uploads/${aid}/propertyimage/`;  // Folder path with dynamic $aid
                        const imageUrl = "<?php echo base_url(); ?>" + folderPath + image.file_name; // Construct the full URL with folder

                        const newButton = `
                            <button type="button" class="btn btn-primary uploaded-data-btn uploaded-image-btn" id="uploaded-image-btn"
                                style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;" 
                                data-index="${index}" 
                                data-image-url="${imageUrl}" 
                                data-description="${image.description}">
                                <img src="<?php echo base_url('assets/image.png') ?>" alt="Image" style="width: 35px; height: 35px;">
                            </button>
                        `;

                        $("#uploadedDataContainer").append(newButton);
                    });

                    if (imagesArray.length > 0) {
                        $("#uploadedData").show();
                    }
                } catch (error) {
                    console.error('Error parsing images:', error);
                }
            } else {
                console.log('Images attribute is not available.');
            }
        }

        
        let modalDataArray = []; 
        $('#submitmodaldata').click(function () {
            const index = $('#descImgmodal').data('index'); // Get the index
            const description = $('#description').val(); // Description
            const descImg = $('#descImg')[0].files[0]; // Image file

            if (description && (descImg || modalDataArray[index]?.image)) {
                const updatedImage = descImg || modalDataArray[index]?.image;

                if (index !== undefined && index !== null && modalDataArray[index]) {
                    // Update the existing entry
                    modalDataArray[index] = { description, image: updatedImage };
                } else {
                    // Add a new entry
                    modalDataArray.push({ description, image: updatedImage });
                }

                // Dynamically create and append the new button
                const newButton = `
                    <button type="button" class="btn btn-primary uploaded-data-btn uploaded-image-obbtn"
                        style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <img src="<?php echo base_url('assets/image.png') ?>" alt="Image" style="width: 35px; height: 35px;">
                    </button>
                `;

                // Append the button to the container
                $("#uploadedDataContainer").append(newButton);

                // Close the modal after adding/updating data
                $('#descImgmodal').modal('hide');

                // Log the updated modalDataArray
                console.log('Updated modalDataArray:', modalDataArray);
            } else {
                alert('Please provide a description and image.');
            }
        });


        $("#property_submit").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {   
                $("#generate_ila").hide();
                $('#property_essential').trigger('submit');
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
              
            } else if (editButtonText === "Edit") {               
                $(".editable-field").prop("disabled", false);
                $(".venorbtn").removeClass('disabled').css('opacity', '1');
                $("#generate_ila").show();
                $(this).val("Update");
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
           } else if (editButtonText === "Update") {   
                $("#generate_ila").show();
                $('#property_essential').trigger('submit');
                $(".editable-field").prop("disabled", true);
                $(".venorbtn").addClass('disabled').css('opacity', '0.5');
                $('#show_policy_card, #show_appointment_card, #show_payment_card').removeClass('hidden').addClass('visibility');
                $(this).val("Edit");
            }
        });
   
        $("#property_essential").validate({
            errorClass: 'error',
            errorElement: 'div',
            highlight: function (element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                policy_by: { required: true },
                policy_branch: { required: true },
                policy_user: { required: true },
                policy_mobile: { required: true },
                appoint_by: { required: true },
                appointment_branch_name: { required: true },
                appointment_user_name: { required: true },
                appointment_mobile_num: { required: true },
                payment_by: { required: true },
                payment_branch_name: { required: true },
                payment_user_name: { required: true },
                payment_mobile_num: { required: true },
                case_reference: {
                    required: true,
                    caseReferenceFormat: true
                },
                insured_name: { required: true },
                contact_person_name: { required: true },
                address: { required: true },
                Ofinstruction: { required: true },
                visit_date_time: { required: true },
                insured_activity: { required: true },
                loss_area: { required: true },
                cause_loss: { required: true },
            },
            messages: {
                policy_by: { required: "This field is required" },
                policy_branch: { required: "This field is required" },
                policy_user: { required: "This field is required" },
                policy_mobile: { required: "This field is required" },
                appoint_by: { required: "This field is required" },
                appointment_branch_name: { required: "This field is required" },
                appointment_user_name: { required: "This field is required" },
                appointment_mobile_num: { required: "This field is required" },
                payment_by: { required: "This field is required" },
                payment_branch_name: { required: "This field is required" },
                payment_user_name: { required: "This field is required" },
                payment_mobile_num: { required: "This field is required" },
                case_reference: {
                    required: "This field is required",
                    caseReferenceFormat: "Invalid format! Please enter in the format: VP/I/24/05/115"
                },
                insured_name: { required: "This field is required" },
                contact_person_name: { required: "This field is required" },
                address: { required: "This field is required" },
                Ofinstruction: { required: "This field is required" },
                visit_date_time: { required: "This field is required" },
                insured_activity: { required: "This field is required" },
                loss_area: { required: "This field is required" },
                cause_loss: { required: "This field is required" },
            },
            submitHandler: function (form) {
                // displayButtonsOnLoad();
                // displayobButtonsOnLoad();

                const formdata = new FormData(form);
                // Add additional data
                const aid = "<?php echo $aid; ?>";
                const natureofjob = "<?php echo $natureofjob; ?>";
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                // Ensure modalDataArray is handled correctly
                if (modalDataArray && modalDataArray.length > 0) {
                    modalDataArray.forEach((data, index) => {
                        // Append description if it exists
                        if (data.description) {
                            formdata.append(`descrp[${index}]`, data.description);
                        }
                        // Append image file if it exists
                        if (data.image) {
                            formdata.append(`descImage[${index}]`, data.image);
                        }
                    });
                } else {
                    // Handle case where modalDataArray is empty (retain existing data)
                    formdata.append('descrp', JSON.stringify([])); // Example of appending an empty array
                }

                // Ensure obmodalDataArray is handled correctly
                if (obmodalDataArray && obmodalDataArray.length > 0) {
                    obmodalDataArray.forEach((data, index) => {
                        // Append description if it exists
                        if (data.description) {
                            formdata.append(`obdescrp[${index}]`, data.description);
                        }
                        // Append image file if it exists
                        if (data.image) {
                            formdata.append(`obdescImage[${index}]`, data.image);
                        }
                    });
                } else {
                    // Handle case where obmodalDataArray is empty (retain existing data)
                    formdata.append('obdescrp', JSON.stringify([])); // Example of appending an empty array
                }

                // Debug the form data (can be used for logging)
                for (let pair of formdata.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                // AJAX call to submit the form data
                $.ajax({
                    url: '<?php echo base_url("cases/updatpropertyeessentialdata"); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Disable the submit button to prevent multiple submissions
                        $('#property_submit').prop('disabled', true);
                        $('#submit_loader').show(); // Show loader if you have one
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            // On successful submission, update the UI
                            $('#show_policy_card, #show_appointment_card, #show_payment_card')
                                .removeClass('hidden').addClass('visibility');
                            $(".venor-btn, .venorbtn").addClass("disabled-btn");
                            $('#property_submit').val("Edit"); // Change submit button text to "Edit"
                            $(".editable-field").prop("disabled", true); // Disable editable fields
                            $("#generate_ila").show(); // Show generate ILA button
                            $('.static-row').hide(); // Hide static rows
                        } else {
                            alert('Submission failed. Please try again.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error occurred:', xhr.responseText, status, error);

                        // Handle various types of errors
                        if (xhr.status === 500) {
                            alert('An error occurred on the server. Please try again later.');
                        } else if (xhr.status === 400) {
                            alert('There was a problem with your request. Please check your data and try again.');
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        // Re-enable the submit button and hide the loader after the request is complete
                        $('#property_submit').prop('disabled', false);
                        $('#submit_loader').hide();
                    }
                });
            }
        });

           $.validator.addMethod("caseReferenceFormat", function(value, element) {
                // Define the regex pattern for validation
                const pattern = /^[A-Z]{2}\/[A-Z]{1}(\/{0,2})\/\d{2}\/\d{2}\/\d{3}$/;
                // Test the value against the pattern
                return this.optional(element) || pattern.test(value);
            }, "Please enter in the format: VP/I/24/05/115 or VP/M//24/12/007");


          // var uploadedData = [];
        var obmodalDataArray = [];

        $(document).on('click', 'button', function () {
            const buttonId = $(this).attr('id'); 
            const modalType = $(this).data('modal-type'); 

            if (buttonId === 'uploadobButton' && modalType === 'observation') {
                $("#observationImgmodal .modal-body img").remove();
                $("#obdescription").val('');
                $("#obdescImg").replaceWith(`
                    <input type="file" class="form-control-file" id="obdescImg" name="obdescImg">
                `); 
                $('#observationImgmodal').modal('show');
            } else if ($(this).hasClass('uploaded-image-obbtn')) {
                const aid = "<?php echo $aid; ?>";
                const imageUrl = $(this).data('image-url');
                const index = $(this).data('index');
                const description = $(this).data('description'); 
                const fullImageUrl = '<?php echo base_url('uploads/'); ?>' + aid + '/propertyimage/' + imageUrl;

                $("#observationImgmodal .modal-body img").remove(); 
                $("#observationImgmodal .modal-body").append(`
                    <img src="${fullImageUrl}" alt="Full Image" style="max-width: 100px; max-height: 100px; display: block; margin: 0 auto;">
                `); 
                $("#obdescription").val(description); 
                $('#observationImgmodal').modal('show');
            }
        });

        function displayobButtonsOnLoad() {
               var essentialdataExists = <?php echo json_encode(isset($essentialdata) ? $essentialdata : null); ?>;

            if (essentialdataExists && essentialdataExists.obimages) {
                try {
                    var imagesArray = JSON.parse(essentialdataExists.obimages);
                    imagesArray.forEach((image, index) => {
                        const newButton = `
                            <button type="button" class="btn btn-primary uploaded-data-btn uploaded-image-obbtn"
                                style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;" 
                                data-index="${index}" 
                                data-image-url="${image.file_name}" 
                                data-description="${image.description}">
                                <img src="<?php echo base_url('assets/image.png') ?>" alt="Image" style="width: 35px; height: 35px;">
                            </button>
                        `;

                        $("#observationDataContainer").append(newButton);
                    });

                    if (imagesArray.length > 0) {
                        $("#observationDataContainer").show();
                    }
                } catch (error) {
                    console.error('Error parsing images:', error);
                }
            } else {
                console.log('No images found.');
            }
        }

        $('#observationmodaldata').click(function () {
            const description = $('#obdescription').val().trim(); // Trim any extra whitespace
            const descImg = $('#obdescImg')[0].files[0]; // Get the file from the input

            // Check if description is non-empty and a file is selected
            if (description && descImg) {
                // Optionally, check if the uploaded file is an image
                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validImageTypes.includes(descImg.type)) {
                    alert("Please upload a valid image (JPEG, PNG, or GIF).");
                    return; // Exit function if file type is invalid
                }

                // Push the description and image into the obmodalDataArray
                obmodalDataArray.push({
                    description: description,
                    image: descImg
                });

                // Dynamically create and append the new button
                const newButton = `
                    <button type="button" class="btn btn-primary uploaded-data-btn uploaded-image-obbtn"
                        style="background-color: #fff; border: none; cursor: pointer; padding: 1px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <img src="<?php echo base_url('assets/image.png') ?>" alt="Image" style="width: 35px; height: 35px;">
                    </button>
                `;
                $("#observationDataContainer").append(newButton);

                // Close the modal after adding data
                $('#observationImgmodal').modal('hide');

                // Log the array content to verify the data added
                console.log('Data added:', obmodalDataArray);
            } else {
                alert("Please enter a description and upload an image.");
            }
        });


       displayobButtonsOnLoad();
    });
</script>

 
