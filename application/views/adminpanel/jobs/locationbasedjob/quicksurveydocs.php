<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/heading'); ?>
            <section class="main--content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content">
                                    <div id="actions-container" class="d-flex justify-content-between mb-3">
                                        <!-- Delete button -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-2">
                                                <input type="checkbox" class="form-check-input select-all" id="select-all" style="width: 15px; height: 15px;">
                                                <label class="form-check-label mt-0" for="select-all" style="color: #E16123; font-weight: 600;">Select All</label>
                                            </div>
                                        </div>
                                        <!-- Delete button -->
                                        <button id="delete-selected" class="btn btn-danger delete-btn delete-selected" style="display: none; padding: 3px 7px;">Delete</button>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="cont">
                                                <div class="page-head">
                                                    <div class="demo-gallery">
                                                       <ul id="lightgallery">
                                                            <?php foreach ($quicksurveydocs as $index => $document) { ?>
                                                                <?php $fileExtension = pathinfo($document, PATHINFO_EXTENSION); ?>
                                                                <li class="gallery-item" style="width:88px; height: 105px;">
                                                                    <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                                                        <a href="<?php echo base_url('quicksurvey/' . $directoryname . '/documents/' . $document); ?>" data-fancybox="images">
                                                                            <img class="img-responsive" src="<?php echo base_url('quicksurvey/' . $directoryname . '/documents/' . $document); ?>" alt="Image">
                                                                        </a>
                                                                    <?php } else if ($fileExtension == 'pdf') { ?>
                                                                        <a href="<?php echo base_url('quicksurvey/' . $directoryname . '/documents/' . $document); ?>" target="_blank">
                                                                            <img class="img-responsive pdf-thumb" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF" style="height:100px;width:100px;">
                                                                            <div class="demo-gallery-poster">
                                                                                <img src="https://sachinchoolur.github.io/lightgallery.js/static/img/zoom.png" alt="Zoom">
                                                                            </div>
                                                                        </a>
                                                                    <?php } ?>

                                                                    <div class="delete-icon" data-document="<?php echo $document; ?>" title="Delete Document" style="right:60%;">
                                                                        <i class="fa fa-trash"></i>
                                                                    </div>

                                                                    <div class="form-check image-checkbox-container" style="top:0;right:-12%;">
                                                                        <input type="checkbox" class="form-check-input image-checkbox" id="documents-<?php echo $index; ?>" data-document="<?php echo $document; ?>">
                                                                        <label class="form-check-label" for="documents-<?php echo $index; ?>"></label>
                                                                    </div>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <?php $this->load->view('adminpanel/jobs/locationbasedjob/progressbar'); ?>
    <?php $this->load->view('adminpanel/layout/footer'); ?>
    <!-- Script to initialize Fancybox for the Image Gallery -->
    <script>
        $(document).ready(function() {
           $('#documents').on('change', function() {
                var files = this.files;
                var formData = new FormData();
                var directoryname = "<?php echo $directoryname; ?>"; // Updated from $aid to $directoryname

                // Append files to FormData
                for (var i = 0; i < files.length; i++) {
                    formData.append('documents[]', files[i]);
                }

                // Append additional data to FormData
                formData.append('directoryname', directoryname); // Changed from 'aid' to 'directoryname'
                formData.append('filetype', "documents");

                $('#progressModal').modal('show');

                // Perform the AJAX request
                $.ajax({
                    url: '<?php echo base_url('cases/uploadquicksurveydocuments'); ?>', // Server-side upload URL
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
                                $('#progressBar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete).text(percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            location.reload(); // Reload page upon successful upload
                        } else {
                            alert(response.message || 'Upload failed.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Upload failed.', error);
                    },
                    complete: function() {
                        $('#progressModal').modal('hide');
                    }
                });
            });

            // Initialize Fancybox
            $('[data-fancybox="images"]').fancybox({
                loop: true,
                buttons: [
                    'slideShow',
                    'thumbs',
                    'close'
                ],
                animationEffect: "fade",
                transitionEffect: "slide",
                transitionDuration: 500,
                infobar: false,
                arrows: true,
                clickContent: false,
                clickSlide: false,
            });

            // Select/Deselect all functionality
            $('#select-all').on('change', function() {
                $('.image-checkbox').prop('checked', this.checked);
                toggleDeleteButton();
            });

            // Toggle delete button visibility
            $('.image-checkbox').on('change', function() {
                toggleDeleteButton();
            });

          

            // Function to toggle the delete button based on selection
            function toggleDeleteButton() {
                var anyChecked = $('.image-checkbox:checked').length > 0;
                $('#delete-selected').toggle(anyChecked);
                $('#actions-container').toggle(anyChecked);
            }

          

        });
    </script>