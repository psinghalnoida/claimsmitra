<style>
    /* General styling for image containers */
    .item {
        position: relative;
        overflow: hidden;
    }

    .thumb {
        position: relative;
        width: 100%;
        height: auto;
    }

    /* Image styling */
    .thumb img {
        width: 100%;
        height: auto;
        object-fit: cover;
        /* Cover the container while maintaining aspect ratio */
    }

    .counter {
        color: #fff;
        font-size: 25px;
        font-weight: 700
    }

    /* Adjust the container height based on aspect ratio */
    @media (min-aspect-ratio: 16/9) {
        .thumb {
            height: auto;
        }
    }

    @media (max-aspect-ratio: 16/9) {
        .thumb {
            height: 50vh;
        }
    }

    .modal-header {
        border-bottom: 1px solid #d7d2d2;
    }

    #newimageUpload,
    #newvideoUpload,
    #newdocumentImgUpload {
        float: right;
        background-color: #2bb3c0;
        color: #fff;
        border: 1px solid #2bb3c0;
    }

    .white-icon {
        filter: brightness(0) invert(1);
    }

    #progressModal .modal-content {
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
</style>

<section class="main--content">
    <div class="row gutter-20">
        <div class="col-lg-12">
            <div class="panel mb-0">
                <div class="panel-heading">
                    <h3 class="panel-title">Media</h3>
                </div>
                <div class="container-fluid" style="margin-bottom:15px;">
                    <div class="row">

                        <!-- Images Card -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding-right:0px;">
                            <div class="card shadow-sm h-100" style="padding:0px;">
                                <div class="card-header text-white bg-primary py-2">
                                    <h5 class="mb-0 d-flex align-items-center" style="margin-left:10px;">
                                        <img src="<?php echo base_url('assets/img/media/image.png'); ?>" alt="img" style="max-width:25px; margin-right:8px;">
                                        <b>Images</b>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="d-flex justify-content-between align-items-center">
                                        Total Media Files:
                                        <span class="badge bg-primary text-white" style="border-radius:4px;">3/300</span>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!-- Videos Card -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding-right:0px;">
                            <div class="card shadow-sm h-100" style="padding:0px;">
                                <div class="card-header text-white bg-warning py-2" >
                                    <h5 class="mb-0 d-flex align-items-center" style="margin-left:10px;">
                                        <img src="<?php echo base_url('assets/img/media/video.png'); ?>" alt="img" style="max-width:25px; margin-right:8px;">
                                        <b>Videos</b>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="d-flex justify-content-between align-items-center">
                                        Total Media Files:
                                        <span class="badge bg-warning text-white" style="border-radius:4px;">3/300</span>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Card -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding-right:0px;">
                            <div class="card shadow-sm h-100" style="padding:0px;">
                                <div class="card-header text-white bg-success py-2">
                                    <h5 class="mb-0 d-flex align-items-center" style="margin-left:10px;">
                                        <img src="<?php echo base_url('assets/img/media/doc.png'); ?>" alt="img" style="max-width:25px; margin-right:8px;">
                                        <b>Documents</b>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="d-flex justify-content-between align-items-center">
                                        Total Media Files:
                                        <span class="badge bg-success text-white" style="border-radius:4px;">3/300</span>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!-- Software Card -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding-right:15px;">
                            <div class="card shadow-sm h-100" style="padding:0px;">
                                <div class="card-header text-white bg-dark py-2" >
                                    <h5 class="mb-0 d-flex align-items-center" style="margin-left:10px;">
                                        <img src="<?php echo base_url('assets/img/media/software.png'); ?>" alt="img" style="max-width:25px; margin-right:8px;">
                                        <b>System Driven</b>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="d-flex justify-content-between align-items-center">
                                        Total Media Files:
                                        <span class="badge bg-dark text-white" style="border-radius:4px;">3/300</span>
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Image Modal -->
<div class="modal right fade" id="imageDrawerModal" tabindex="-1" role="dialog" aria-labelledby="imageDrawerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: 0; max-width: 80%; width: 80%; height: 100vh; position: fixed; top: 0; right: 0;">
        <div class="modal-content" style="height: 100%;">
            <button class="btn btn-rounded btn-warning dismiss" data-dismiss="modal" aria-label="Close" style="font-size:25px; position: absolute; right: 10px;">&times;</button>
            <div class="modal-header">
                <h5 class="modal-title">Images</h5>
                <div class="col-lg-6">
                    <input type="file" name="images[]" multiple size="chars" class="newfileUpload" id="newimages" style="display: none;" multiple>
                    <button id="newimageUpload">Image <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></button>
                </div>

                <button id="delete-selected" class="btn btn-danger delete-btn delete-selected" style="display: none; padding: 3px 7px;">Delete</button>
            </div>
            <div class="modal-body">
                <div class="uploadProgressWrapper" id="uploadProgressWrapper" style="width: 100%; margin-top: 10px; display: none;">
                    <div class="progress" style="height: 10px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success progressBar"
                            role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            0%
                        </div>
                    </div>
                    <p id="progressText" class="text-center mt-1 progressText">Uploading...</p>
                </div>
                 <div class="row mb-3">
                    <div class="col-6 mb-2" id="selectAllWrapper">
                        <div class="d-flex align-items-center gap-3">
                            <input type="checkbox" id="selectAllImages" style="width: 25px;">
                            <label for="selectAllImages" class="mb-0">Select All</label>
                        </div>
                    </div>
                    <div class="col-6 mb-2" id="deleteWrapper">
                        <button id="deleteSelectedImages" class="btn btn-sm btn-danger" style="float: right;padding:3px 6px;border:none;display:none;">Delete All</button>
                    </div>
                </div>
                <div class="row" id="imageWrapper">
                    <?php foreach ($caseimages as $index => $image): ?>
                        <div class="col-md-1 col-lg-1 mb-3" style="padding-right:0px;">
                            <div class="item">
                                <div class="thumb">
                                    <a href="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" data-fancybox="images">
                                        <img src="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" alt="" style="max-height:75px;">
                                    </a>
                                    <div class="delete-icon del-icon" data-image="<?php echo $image; ?>" title="Delete Image">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                    <div class="form-check image-checkbox-container" style="display: none;">
                                        <input type="checkbox" class="form-check-input image-checkbox" id="image-<?php echo $index; ?>" data-image="<?php echo $image; ?>">
                                        <label class="form-check-label" for="image-<?php echo $index; ?>"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div class="modal right fade" id="videoDrawerModal" tabindex="-1" role="dialog" aria-labelledby="videoDrawerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: 0; max-width: 80%; width: 80%; height: 100vh; position: fixed; top: 0; right: 0;">
        <div class="modal-content" style="height: 100%; position: relative;">
            <button class="btn btn-rounded btn-warning dismiss" data-dismiss="modal" aria-label="Close" style="font-size:30px; position: absolute; right: 10px;">&times;</button>
            <div class="modal-header" style="overflow: auto;">
                <h5 class="modal-title">Videos</h5>
                <div class="col-lg-6">
                    <input type="file" name="videos[]" multiple size="chars" class="newfileUpload" id="newvideos" accept=".mp4" style="display: none;">
                    <button id="newvideoUpload">Video <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></button>
                </div>

                <!--  <div id="actions-container" class="d-flex align-items-center" style="margin-left: auto;">
                    <button class="btn btn-danger delete-btn delete-selected" style="display: none;">Delete</button>
                    <div class="form-check m-1">
                        <input type="checkbox" class="form-check-input select-all" id="select-all">
                    </div>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="uploadProgressWrapper" id="uploadProgressWrapper" style="width: 100%; margin-top: 10px; display: none;">
                    <div class="progress" style="height: 10px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success progressBar"
                            role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            0%
                        </div>
                    </div>
                    <p id="progressText" class="text-center mt-1 progressText">Uploading...</p>
                </div>
                 <div class="row mb-3">
                    <div class="col-6 mb-2" id="selectVideoWrapper">
                        <div class="d-flex align-items-center gap-3">
                            <input type="checkbox" id="selectAllVideo" style="width: 25px;">
                            <label for="selectAllVideo" class="mb-0">Select All</label>
                        </div>
                    </div>
                    <div class="col-6 mb-2" id="deleteVideoWrapper">
                        <button id="deleteSelectedVideos" class="btn btn-sm btn-danger" style="float: right;padding:3px 6px;border:none;display:none;">Delete All</button>
                    </div>
                </div>
                <div class="row" id="videoWrapper">
                    <?php foreach ($casevideos as $index => $video): ?>
                        <div class="col-md-2 col-lg-2 mb-3">
                            <div class="item">
                                <div class="thumb">
                                    <video class="thumbnail" width="100%" height="150px">
                                        <source src="<?php echo base_url('uploads/' . $aid . '/videos/' . $video); ?>" type="video/mp4">
                                    </video>
                                    <div class="delete-icon del-vid" data-video="<?php echo $video; ?>" title="Delete Video" style ="top:11%;left:2%;">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                    <div class="form-check video-checkbox-container" style="display: none;">
                                        <input type="checkbox" class="form-check-input video-checkbox" id="video-<?php echo $index; ?>" data-video="<?php echo $video; ?>">
                                        <label class="form-check-label" for="video-<?php echo $index; ?>"  style="margin-top:-55%;margin-left:89%"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Documents Modal -->
<div class="modal right fade" id="docDrawerModal" tabindex="-1" role="dialog" aria-labelledby="docDrawerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: 0; max-width: 80%; width: 80%; height: 100vh; position: fixed; top: 0; right: 0;">
        <div class="modal-content" style="height: 100%; position: relative;">
            <button class="btn btn-rounded btn-warning dismiss" data-dismiss="modal" aria-label="Close" style="font-size:30px; position: absolute; right: 10px;">&times;</button>
            <div class="modal-header">
                <h5 class="modal-title">Documents</h5>
                <div class="col-lg-6">
                    <input type="file" name="documents[]" multiple class="newfileUpload" id="newdocuments" accept=".pdf, .jpg, .jpeg, .png" style="display: none;">
                    <button id="newdocumentImgUpload">Document <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></button>
                </div>
                <!-- Progress Bar (Initially Hidden) -->


            </div>
            <div class="modal-body">
                <div class="uploadProgressWrapper" id="uploadProgressWrapper" style="width: 100%; margin-top: 10px; display: none;">
                    <div class="progress" style="height: 10px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success progressBar"
                            role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            0%
                        </div>
                    </div>
                    <p id="progressText" class="text-center mt-1 progressText">Uploading...</p>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-2" id="selectDocsWrapper">
                        <div class="d-flex align-items-center gap-3">
                            <input type="checkbox" id="selectAllDocs" style="width: 25px;">
                            <label for="selectAllDocs" class="mb-0">Select All</label>
                        </div>
                    </div>
                    <div class="col-6 mb-2" id="deleteDocsWrapper">
                        <button id="deleteSelectedDocs" class="btn btn-sm btn-danger" style="float: right;padding:3px 6px;border:none;display:none;">Delete All</button>
                    </div>
                </div>
                <div class="row" id="selectDocsWrapper">
                    <?php foreach ($casedocuments as $index => $document) { ?>
                        <?php $fileExtension = pathinfo($document, PATHINFO_EXTENSION); ?>
                        <div class="col-md-1 col-lg-1 mb-3" style="padding-right:0px;">
                            <div class="item">
                                <div class="thumb">
                                    <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                        <a href="<?php echo base_url('uploads/' . $aid . '/documents/' . $document); ?>" data-fancybox="documents">
                                            <img class="img-responsive" src="<?php echo base_url('uploads/' . $aid . '/documents/' . $document); ?>" alt="Image" style="max-height: 111px;">
                                        </a>
                                    <?php } else if ($fileExtension == 'pdf') { ?>
                                        <a href="<?php echo base_url('uploads/' . $aid . '/documents/' . $document); ?>" target="_blank">
                                            <img class="img-responsive pdf-thumb" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF" style="height:111px;width:90px;">
                                        </a>
                                    <?php } ?>
                                    <div class="file-name" style="font-size: 12px; margin-top: 2px; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo truncateFileName(basename($document), 30); ?>
                                    </div>
                                    <div class="delete-icon del-doc" data-document="<?php echo $document; ?>" title="Delete Document" style="background-color:rgb(211 214 219 / 83%);">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                    <div class="form-check document-checkbox-container" style="display: none;">
                                        <input type="checkbox" class="form-check-input document-checkbox" id="document-<?php echo $index; ?>" data-document="<?php echo $document; ?>" aria-label="Select document <?php echo $index + 1; ?>">
                                        <label class="form-check-label" for="document-<?php echo $index; ?>" style="margin-top: -112%;margin-left: 62%;"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports Modal -->
<div class="modal right fade" id="sysDrawerModal" tabindex="-1" role="dialog" aria-labelledby="sysDrawerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: 0; max-width: 80%; width: 80%; height: 100vh; position: fixed; top: 0; right: 0;">
        <div class="modal-content" style="height: 100%;">
            <button class="btn btn-rounded btn-warning dismiss" data-dismiss="modal" aria-label="Close" style="font-size:30px;">&times;</button>
            <div class="modal-header">
                <h5 class="modal-title">System Generated Documents and Reports</h5>
                <div id="actions-container" class="d-flex justify-content-end">
                    <!-- Delete button -->
                    <!-- <button id="delete-selected-reports" class="btn btn-danger me-2 delete-btn delete-selected" style="display: none;">Delete</button> -->
                    <!-- Select All Checkbox -->
                    <!-- <div class="form-check m-1">
                    <input type="checkbox" class="form-check-input select-all" id="select-all-reports">
                    <label class="form-check-label" for="select-all">Select All</label>
                </div> -->
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($casereports as $index => $report) { ?>
                        <?php $fileExtension = pathinfo($report, PATHINFO_EXTENSION); ?>
                        <div class="col-md-1 col-lg-1 mb-3" style="padding-right:0px;">
                            <div class="item">
                                <div class="thumb">
                                    <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                        <a href="<?php echo base_url('uploads/' . $aid . '/reports/' . $report); ?>" data-fancybox="images">
                                            <img class="img-responsive" src="<?php echo base_url('uploads/' . $aid . '/reports/' . $report); ?>" alt="Image" style="max-height: 106px;">
                                        </a>
                                    <?php } else if ($fileExtension == 'pdf') { ?>
                                        <a href="<?php echo base_url('uploads/' . $aid . '/reports/' . $report); ?>" target="_blank">
                                            <img class="img-responsive pdf-thumb" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF" style="height:111px;width:90px;">
                                        </a>
                                    <?php } ?>
                                    <div class="file-name" style="font-size: 12px; margin-top: 2px; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo truncateFileName(basename($report), 30); ?>
                                    </div>
                                    <div class="delete-icon del-rep" data-report="<?php echo $report; ?>" title="Delete Report" style="background-color:rgb(211 214 219 / 83%);">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                    <div class="form-check report-checkbox-container" style="display: none;">
                                        <input type="checkbox" class="form-check-input report-checkbox" id="report-<?php echo $index; ?>" data-report="<?php echo $report; ?>">
                                        <label class="form-check-label" for="report-<?php echo $index; ?>"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="select_images" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row gutter-20">
                    <div class="col-lg-12">
                        <div class="panel">
                            <div id="error-message" style="color: red; display: none;"></div>
                            <div id="success-message" style="color: green; display: none;"></div>
                            <div class="panel-content">
                                <div class="row">
                                    <?php $index = 1; ?>
                                    <?php foreach ($caseimages as $index => $image) { ?>
                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 mb-3" style="display:flex">
                                            <input type="checkbox" name="image[]" value="<?php echo $image; ?>" class="image-checkbox" id="checkbox_<?php echo $index; ?>" style="align-self:baseline" />
                                            <div class="card border-bottom" style="width:1000%;">
                                                <a href="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" data-fancybox="images">
                                                    <div class="card-img-container">
                                                        <img src="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="card-img-top" alt="Image <?php echo $index; ?>" style="width:125px;height:100px;">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php $index++; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" target="_blank" class="btn btn-success" id="saveImages">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Videos</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="customCloseButton">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.875rem 1.25rem;">
                <div class="carousel">
                    <video id="videoPlayer" style="width:100%; height:80vh; background-color: black;" class="img-fluid" controls>
                        <source id="videoSource" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Progress Modal -->
<!-- <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center p-4">
      <h5>Uploading Images...</h5>
      <div class="progress mt-3 w-100">
        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info"
             role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100">0%</div>
      </div>
      <div id="progressText" class="mt-2 small text-muted">Please wait...</div>
    </div>
  </div>
</div> -->


<script>
    // <!-- Show Modals -->
    $(document).ready(function() {


        /* ------------------------------------------------------------------------- *  
         * SELECT AND DELETE ALL IMAGES 
         * ------------------------------------------------------------------------- */

        if ($('.row#imageWrapper .col-md-1').length === 0) {
            // Hide Select All and Delete button if no images
            $('#selectAllWrapper').hide();
            $('#deleteWrapper').hide();
        }

        // Select/Deselect all checkboxes
        $('#selectAllImages').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.image-checkbox-container').show(); // Make sure checkboxes are visible
            $('.image-checkbox').prop('checked', isChecked);
            toggleDeleteButton(); // Show/hide delete button
        });

        // When any individual image checkbox is changed
        $(document).on('change', '.image-checkbox', function() {
            toggleDeleteButton();
        });

        // Function to show/hide Delete All button
        function toggleDeleteButton() {
            const anyChecked = $('.image-checkbox:checked').length > 0;
            $('#deleteSelectedImages').toggle(anyChecked);
        }

        $('#deleteSelectedImages').on('click', function() {
            var selectedImages = $('.image-checkbox:checked').map(function() {
                return $(this).data('image');
            }).get();

            if (selectedImages.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Images Selected',
                    text: 'Please select at least one image to delete.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover these images!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_images'); ?>',
                        type: 'POST',
                        data: {
                            images: selectedImages,
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                selectedImages.forEach(function(img) {
                                    $('.image-checkbox[data-image="' + img + '"]').closest('.col-md-1').remove();
                                });
                                $('#selectAllWrapper').hide();
                                $('#deleteWrapper').hide();

                                Swal.fire('Deleted!', 'Selected images have been deleted.', 'success');
                                $('#deleteSelectedImages').hide();
                                $('#selectAllImages').prop('checked', false);
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the images.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the images.', 'error');
                        }
                    });
                }
            });
        });


        /* ------------------------------------------------------------------------- *  
         * SELECT AND DELETE ALL VIDEOS 
         * ------------------------------------------------------------------------- */

        // Hide select & delete controls if no videos exist
        if ($('#videoWrapper .col-md-2').length === 0) {
            $('#selectVideoWrapper').hide();
            $('#deleteVideoWrapper').hide();
        }

        // Select/Deselect all checkboxes
        $('#selectAllVideo').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.video-checkbox-container').show(); // Ensure checkboxes are visible
            $('.video-checkbox').prop('checked', isChecked);
            videoDeleteButton();
        });

        // Individual checkbox selection handling
        $(document).on('change', '.video-checkbox', function() {
            videoDeleteButton();

            // Sync the "Select All" checkbox based on individual selections
            const total = $('.video-checkbox').length;
            const checked = $('.video-checkbox:checked').length;
            $('#selectAllVideo').prop('checked', total === checked);
        });

        // Toggle Delete All button visibility
        function videoDeleteButton() {
            const anyChecked = $('.video-checkbox:checked').length > 0;
            $('#deleteSelectedVideos').toggle(anyChecked);
        }

        // Delete selected videos
        $('#deleteSelectedVideos').on('click', function() {
            const selectedVideos = $('.video-checkbox:checked').map(function() {
                return $(this).data('video');
            }).get();

            if (selectedVideos.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Videos Selected',
                    text: 'Please select at least one video to delete.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover these videos!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_videos'); ?>',
                        type: 'POST',
                        data: {
                            videos: selectedVideos,
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                selectedVideos.forEach(function(video) {
                                    $('.video-checkbox[data-video="' + video + '"]').closest('.col-md-2').remove();
                                });

                                Swal.fire('Deleted!', 'Selected videos have been deleted.', 'success');
                                $('#deleteSelectedVideos').hide();
                                $('#selectAllVideo').prop('checked', false);

                                // Hide controls if no videos left
                                if ($('#videoWrapper .col-md-2').length === 0) {
                                    $('#selectVideoWrapper').hide();
                                    $('#deleteVideoWrapper').hide();
                                }
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the videos.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the videos.', 'error');
                        }
                    });
                }
            });
        });

        /* ------------------------------------------------------------------------- *  
         * SELECT AND DELETE ALL DOCUMENTS 
         * ------------------------------------------------------------------------- */

        // Check if there are no documents initially
        checkIfNoDocuments();

        // Function to check if there are any documents and toggle UI elements accordingly
        function checkIfNoDocuments() {
            const noDocs = $('#docDrawerModal .modal-body .col-md-1').length === 0;
            $('#selectDocsWrapper, #deleteDocsWrapper').toggle(!noDocs);
        }

        // Select/Deselect all document checkboxes
        $('#selectAllDocs').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.document-checkbox-container').show(); // Show checkboxes
            $('.document-checkbox').prop('checked', isChecked);
            toggleDeleteDocsButton(); // Update delete button visibility
        });

        // Individual document checkbox change event
        $(document).on('change', '.document-checkbox', function() {
            toggleDeleteDocsButton();
        });

        // Show/Hide delete button based on selected checkboxes
        function toggleDeleteDocsButton() {
            const anyChecked = $('.document-checkbox:checked').length > 0;
            $('#deleteSelectedDocs').toggle(anyChecked);
        }

        // Handle Delete All Documents button click
        $('#deleteSelectedDocs').on('click', function() {
            var selectedDocuments = $('.document-checkbox:checked').map(function() {
                return $(this).data('document');
            }).get();

            if (selectedDocuments.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Documents Selected',
                    text: 'Please select at least one document to delete.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover these documents!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_documents'); ?>',
                        type: 'POST',
                        data: {
                            documents: selectedDocuments,
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                selectedDocuments.forEach(function(doc) {
                                    $('.document-checkbox[data-document="' + doc + '"]').closest('.col-md-1').remove();
                                });

                                Swal.fire('Deleted!', 'Selected documents have been deleted.', 'success');
                                $('#deleteSelectedDocs').hide();
                                $('#selectAllDocs').prop('checked', false);
                                checkIfNoDocuments(); // Re-check and hide controls if none left
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the documents.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the documents.', 'error');
                        }
                    });
                }
            });
        });


        $('#newimageUpload').click(function() {
            $('#newimages').click();
        });

        $('#newimages').on('change', function() {
            var files = this.files;
            var formData = new FormData();
            var aid = "<?php echo $aid; ?>";

            $.each(files, function(i, file) {
                formData.append('images[]', file);
            });

            formData.append('aid', aid);
            formData.append('filetype', "images");

            // Show progress bar
            $('.uploadProgressWrapper').show();
            $('.progressBar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
            $('.progressText').text('Starting upload...');

            $.ajax({
                url: '<?php echo base_url('cases/uploadimages'); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            var percentComplete = Math.round((e.loaded / e.total) * 100);
                            $('.progressBar').css('width', percentComplete + '%')
                                .attr('aria-valuenow', percentComplete)
                                .text(percentComplete + '%');
                            $('.progressText').text('Uploading ' + percentComplete + '%');
                        }
                    });
                    return xhr;
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('.progressText').text('Upload complete! Refreshing...');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        $('.progressText').text('Upload failed.');
                        alert(response.message || 'Upload failed.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Upload failed.', error);
                    $('.progressText').text('Upload failed.');
                },
                complete: function() {
                    setTimeout(() => {
                        $('.uploadProgressWrapper').fadeOut();
                    }, 2000);
                }
            });
        });

        // <!-- UPLOAD VIDEOS-->

        $('#newvideoUpload').click(function() {
            $('#newvideos').click();
        });

        $('#newvideos').on('change', function() {
            var files = this.files;
            var formData = new FormData();
            var aid = "<?php echo $aid; ?>";

            $.each(files, function(i, file) {
                formData.append('videos[]', file);
            });

            formData.append('aid', aid);
            formData.append('filetype', "videos");

            // Show progress bar
            $('.uploadProgressWrapper').show();
            $('.progressBar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
            $('.progressText').text('Starting upload...');

            $.ajax({
                url: '<?php echo base_url('cases/uploadvideos'); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            var percentComplete = Math.round((e.loaded / e.total) * 100);
                            $('.progressBar').css('width', percentComplete + '%')
                                .attr('aria-valuenow', percentComplete)
                                .text(percentComplete + '%');
                            $('.progressText').text('Uploading ' + percentComplete + '%');
                        }
                    });
                    return xhr;
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('.progressText').text('Upload complete! Refreshing...');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        $('.progressText').text('Upload failed.');
                        alert(response.message || 'Upload failed.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Upload failed.', error);
                    $('.progressText').text('Upload failed.');
                },
                complete: function() {
                    setTimeout(() => {
                        $('.uploadProgressWrapper').fadeOut();
                    }, 2000);
                }
            });
        });




        // <!-- UPLOAD DOCUMENTS-->

        $('#newdocumentImgUpload').click(function() {
            $('#newdocuments').click();
        });

        $('#newdocuments').on('change', function() {
            var files = this.files;
            var formData = new FormData();
            var aid = "<?php echo $aid; ?>";

            $.each(files, function(i, file) {
                formData.append('documents[]', file);
            });

            formData.append('aid', aid);
            formData.append('filetype', "documents");

            // Show progress bar
            $('.uploadProgressWrapper').show();
            $('.progressBar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
            $('.progressText').text('Starting upload...');

            $.ajax({
                url: '<?php echo base_url('cases/uploaddocuments'); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            var percentComplete = Math.round((e.loaded / e.total) * 100);
                            $('.progressBar').css('width', percentComplete + '%')
                                .attr('aria-valuenow', percentComplete)
                                .text(percentComplete + '%');
                            $('.progressText').text('Uploading ' + percentComplete + '%');
                        }
                    });
                    return xhr;
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('.progressText').text('Upload complete! Refreshing...');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        $('.progressText').text('Upload failed.');
                        alert(response.message || 'Upload failed.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Upload failed.', error);
                    $('.progressText').text('Upload failed.');
                },
                complete: function() {
                    setTimeout(() => {
                        $('.uploadProgressWrapper').fadeOut();
                    }, 2000);
                }
            });
        });



        <?php
        // Function to truncate the file name
        function truncateFileName($fileName, $maxLength = 30)
        {
            return (strlen($fileName) > $maxLength) ? substr($fileName, 0, $maxLength) . '...' : $fileName;
        }
        ?>



        $('#imageDrawerButton').click(function(e) {
            e.preventDefault(); // Prevent default action
            e.stopPropagation(); // Stop event propagation
            $('#imageDrawerModal').modal('show');
            // Initialize Fancybox
        });
        $('#imageDrawerModal').on('hidden.bs.modal', function() {
            $('#openDrawerButton').show();
        });

        $('#videoDrawerButton').click(function(e) {
            e.preventDefault(); // Prevent default action
            e.stopPropagation(); // Stop event propagation
            $('#videoDrawerModal').modal('show');
        });

        $('#videoDrawerModal').on('hidden.bs.modal', function() {
            $('#openDrawerButton').show();
        });

        $('#docDrawerButton').click(function(e) {
            e.preventDefault(); // Prevent default action
            e.stopPropagation(); // Stop event propagation
            $('#docDrawerModal').modal('show');

        });

        $('#docDrawerModal').on('hidden.bs.modal', function() {
            $('#openDrawerButton').show();
        });

        $('#sysDrawerButton').click(function(e) {
            e.preventDefault(); // Prevent default action
            e.stopPropagation(); // Stop event propagation
            $('#sysDrawerModal').modal('show');
        });

        $('#sysDrawerModal').on('hidden.bs.modal', function() {
            $('#openDrawerButton').show();
        });
    });

    $(document).ready(function() {
        $('[data-fancybox="images"]').fancybox({
            loop: true,
            buttons: [
                'slideShow',
                'thumbs',
                'rotateLeft',
                'rotateRight',
                'close'
            ],
            animationEffect: "fade",
            transitionEffect: "slide",
            transitionDuration: 500,
            infobar: false,
            arrows: true,
            clickContent: false,
            clickSlide: false
        });

        // Show the checkboxes when "Select" is clicked
        $('#select-button').on('click', function() {
            $('.image-checkbox-container').show();
        });

        // Handle "Select All" checkbox
        $(document).on('change', '.select-all', function() {
            var isChecked = $(this).is(':checked');
            $('.image-checkbox').prop('checked', isChecked);
            updateControlsVisibility();
            updateDeleteButton();
        });

        // Handle individual checkbox change
        $(document).on('change', '.image-checkbox', function() {
            var allChecked = $('.image-checkbox').length === $('.image-checkbox:checked').length;
            $('.select-all').prop('checked', allChecked);
            updateDeleteButton();
        });

        // Update delete button visibility based on selected checkboxes
        function updateDeleteButton() {
            $('.delete-selected').toggle($('.image-checkbox:checked').length > 0);
        }

        // Handle delete button click for multiple images
        $('.delete-selected').on('click', function() {
            var selectedImages = $('.image-checkbox:checked').map(function() {
                return $(this).data('image');
            }).get();

            if (selectedImages.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Images Selected',
                    text: 'Please select at least one image to delete.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover these images!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_images'); ?>',
                        type: 'POST',
                        data: {
                            images: selectedImages,
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $('.image-checkbox:checked').closest('.col-md-1').remove();
                                Swal.fire('Deleted!', 'Selected images have been deleted.', 'success');
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the images.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the images.', 'error');
                        }
                    });
                }
            });
        });

        // Handle individual image deletion
        $(document).on('click', '.delete-icon', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var image = $(this).data('image');
            var $imageContainer = $(this).closest('.col-md-1');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_images'); ?>',
                        type: 'POST',
                        data: {
                            images: [image],
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $imageContainer.remove();
                                Swal.fire('Deleted!', 'The image has been deleted.', 'success');
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the image.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the image.', 'error');
                        }
                    });
                }
            });
        });

        // Function to update control visibility
        function updateControlsVisibility() {
            var hasImages = $('.col-md-1').length > 0;
            $('#actions-container').toggle(hasImages);
            $('.image-checkbox-container').toggle($('.select-all').is(':checked'));
        }

        // Initial check on page load
        updateControlsVisibility();

    });


    // <!--Delete Video Script-->
    $(document).ready(function() {
        // Function to update video source and load it
        function updateVideo(videoUrl) {
            $('#videoSource').attr('src', videoUrl);
            $('#videoPlayer').get(0).load();
        }

        // Click event for video thumbnails
        $(document).on('click', '.thumbnail', function() {
            var videoUrl = $(this).data('video');
            updateVideo(videoUrl);
            $('#videoDrawerModal').modal('show');
        });

        // Click event for deleting individual videos
        $(document).on('click', '.del-vid', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var video = $(this).data('video');
            var $videoCard = $(this).closest('.col-md-2');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this video!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_videos'); ?>',
                        type: 'POST',
                        data: {
                            videos: [video], // Send video as an array
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $videoCard.remove(); // Remove video card from DOM
                                updateControlsVisibility(); // Update controls visibility
                                Swal.fire('Deleted!', 'Your video has been deleted.', 'success');
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the video.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the video.', 'error');
                        }
                    });
                }
            });
        });

        // Function to update the visibility of control elements
        function updateControlsVisibility() {
            var hasVideos = $('.col-md-2').length > 0;
            $('#actions-container').toggle(hasVideos); // Toggle delete and select-all controls
            var anyChecked = $('.video-checkbox:checked').length > 0;
            $('.delete-selected').toggle(anyChecked); // Toggle bulk delete button
        }

        // Handle "Select All" checkbox for videos
        $(document).on('change', '#select-all', function() {
            var isChecked = $(this).is(':checked');
            $('.video-checkbox').prop('checked', isChecked);
            updateDeleteButton(); // Update delete button visibility
        });

        // Handle individual video checkbox change
        $(document).on('change', '.video-checkbox', function() {
            var allChecked = $('.video-checkbox').length === $('.video-checkbox:checked').length;
            $('#select-all').prop('checked', allChecked);
            updateDeleteButton(); // Update delete button visibility
        });

        // Update delete button visibility based on selected checkboxes
        function updateDeleteButton() {
            $('#delete-selected').toggle($('.video-checkbox:checked').length > 0);
        }

        // Handle bulk delete for selected videos
        $(document).on('click', '#delete-selected', function() {
            var selectedVideos = $('.video-checkbox:checked').map(function() {
                return $(this).data('video');
            }).get();

            if (selectedVideos.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No videos selected',
                    text: 'Please select at least one video to delete.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover these videos!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_videos'); ?>',
                        type: 'POST',
                        data: {
                            videos: selectedVideos, // Send selected videos as an array
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $('.video-checkbox:checked').closest('.col-md-2').remove(); // Remove selected videos
                                updateControlsVisibility(); // Update controls visibility
                                Swal.fire('Deleted!', 'The selected videos have been deleted.', 'success');
                            } else {
                                Swal.fire('Failed!', response.message || 'Failed to delete the videos.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire('Error!', 'An error occurred while deleting the videos.', 'error');
                        }
                    });
                }
            });
        });

        // Initial control visibility check
        updateControlsVisibility();
    });

    // <!--Delete Documents  Script-->
    $(document).ready(function() {
        // Initialize Fancybox for documents
        $('[data-fancybox="documents"]').fancybox({
            loop: true,
            buttons: [
                'slideShow',
                'thumbs',
                'rotateLeft',
                'rotateRight',
                'close'
            ],
            animationEffect: "fade",
            transitionEffect: "slide",
            transitionDuration: 500,
            infobar: false,
            arrows: true,
            clickContent: false,
            clickSlide: false
        });

        // Function to toggle visibility of control elements
        function updateControlsVisibility() {
            var hasDocuments = $('.col-md-1').length > 0; // Check if any documents exist
            $('#actions-container').toggle(hasDocuments); // Show actions container if documents exist
            var anyChecked = $('.document-checkbox:checked').length > 0;
            $('.document-checkbox-container').toggle(hasDocuments && $('#select-all').is(':checked'));
            $('.delete-selected').toggle(anyChecked); // Show delete button if any checkbox is checked
        }

        // Handle individual document deletion
        $(document).on('click', '.del-doc', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var document = $(this).data('document');
            var $card = $(this).closest('.col-md-1'); // Adjust class if needed

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this document!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_documents'); ?>',
                        type: 'POST',
                        data: {
                            documents: [document],
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $card.remove(); // Remove the document card from the DOM
                                updateControlsVisibility(); // Update control visibility
                                updateDeleteButton(); // Update delete button visibility
                                Swal.fire(
                                    'Deleted!',
                                    'Your document has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message || 'Failed to delete the document.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the document: ' + xhr.responseText,
                                'error'
                            );
                        }
                    });
                }
            });
        });

        // Handle "Select All" checkbox
        $(document).on('change', '#select-all', function() {
            var isChecked = $(this).is(':checked');
            $('.document-checkbox').prop('checked', isChecked);
            $('.document-checkbox-container').toggle(isChecked); // Show checkboxes if 'Select All' is checked
            $('.delete-selected').toggle(isChecked); // Show delete button if 'Select All' is checked
            updateDeleteButton(); // Update delete button visibility
        });

        // Handle individual checkbox change
        $(document).on('change', '.document-checkbox', function() {
            var allChecked = $('.document-checkbox').length === $('.document-checkbox:checked').length;
            $('#select-all').prop('checked', allChecked); // Update 'Select All' checkbox state
            updateDeleteButton(); // Update delete button visibility
        });

        // Update delete button visibility based on selected checkboxes
        function updateDeleteButton() {
            $('.delete-selected').toggle($('.document-checkbox:checked').length > 0);
        }

        // Handle delete button click for bulk deletion
        $(document).on('click', '.delete-selected', function() {
            var selectedDocuments = $('.document-checkbox:checked').map(function() {
                return $(this).data('document');
            }).get();

            if (selectedDocuments.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No document selected',
                    text: 'Please select at least one document to delete.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover these documents!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_documents'); ?>',
                        type: 'POST',
                        data: {
                            documents: selectedDocuments, // Send as an array
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $('.document-checkbox:checked').closest('.col-md-1').remove(); // Adjust class if needed
                                updateControlsVisibility(); // Update control visibility
                                updateDeleteButton(); // Update delete button visibility
                                Swal.fire(
                                    'Deleted!',
                                    'The selected documents have been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message || 'Failed to delete the documents.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the documents: ' + xhr.responseText,
                                'error'
                            );
                        }
                    });
                }
            });
        });

        // Initial check on page load
        updateControlsVisibility();
    });

    // <!--Delete Sysytem Generated Script-->
    $(document).ready(function() {
        // Handle "Select All" checkbox for reports
        $(document).on('change', '#select-all-reports', function() {
            var isChecked = $(this).is(':checked');
            $('.report-checkbox[data-report]').prop('checked', isChecked);
            updateDeleteButtonForReports(); // Update delete button visibility
        });

        // Handle individual checkbox change for reports
        $(document).on('change', '.report-checkbox[data-report]', function() {
            var allChecked = $('.report-checkbox[data-report]').length === $('.report-checkbox[data-report]:checked').length;
            $('#select-all-reports').prop('checked', allChecked);
            updateDeleteButtonForReports(); // Update delete button visibility
        });

        // Update delete button visibility based on selected checkboxes for reports
        function updateDeleteButtonForReports() {
            // Show the delete button only if at least one checkbox is checked
            $('#delete-selected-reports').toggle($('.report-checkbox[data-report]:checked').length > 0);
        }

        // Handle delete button click for reports
        $(document).on('click', '.del-rep', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var report = $(this).data('report'); // Use 'report' for the delete functionality
            var $reportCard = $(this).closest('.col-md-1'); // Adjust class for report card

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this report!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('cases/delete_reports'); ?>',
                        type: 'POST',
                        data: {
                            reports: [report], // Send the report to delete as an array
                            aid: "<?php echo $aid; ?>" // Assuming aid is available
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $reportCard.remove(); // Remove the report card element from the DOM
                                updateDeleteButtonForReports(); // Update delete button visibility
                                Swal.fire(
                                    'Deleted!',
                                    'Your report has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message || 'Failed to delete the report.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the report.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>