<style>

</style>

<!-- Your PHP code and HTML structure -->
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
                                <div class="panel-content ml-2 mr-2">
                                    <!-- Container for Select All and Delete button -->
                                    <div id="actions-container" class="d-flex justify-content-between align-items-center " style="display: none;">
                                        <!-- Select All Checkbox and Select Label -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-2">
                                                <input type="checkbox" class="form-check-input select-all" id="select-all" style="width: 15px; height: 15px;">
                                                <label class="form-check-label mt-0" for="select-all" style="color: #E16123; font-weight: 600;">Select All</label>
                                            </div>
                                            <!-- <label id="select-button" style="color: #E16123; font-weight: 600; margin-left: 10px;">Select</label> -->
                                        </div>

                                        <!-- Delete button -->
                                        <button id="delete-selected" class="btn btn-danger delete-btn delete-selected" style="display: none; padding: 3px 7px;">Delete</button>
                                    </div>
                                    <!-- Your HTML structure -->
                                    <div class="row gallery ">
                                        <?php foreach ($caseimages as $index => $image): ?>
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-1 mb-3 mt-2">
                                                <!-- <div class="card" style="height: 100%; width: 100%;"> -->
                                                <a href="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" data-fancybox="images">
                                                    <div class="card-img-container">
                                                        <img src="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="card-img-top" alt="Image <?php echo $index; ?>" style="height:100%;">
                                                        <!-- Delete icon -->

                                                    </div>
                                                </a>
                                                <div class="delete-icon" data-image="<?php echo $image; ?>" title="Delete Image">
                                                    <i class="fa fa-trash"></i> <!-- FontAwesome trash icon -->
                                                </div>
                                                <!-- </div> -->
                                                <div class="form-check image-checkbox-container" style="right:8%;top:-2%;display: none;">
                                                    <input type="checkbox" class="form-check-input image-checkbox" id="image-<?php echo $index; ?>" data-image="<?php echo $image; ?>">
                                                    <label class="form-check-label" for="image-<?php echo $index; ?>"></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>


<?php $this->load->view('adminpanel/jobs/locationbasedjob/progressbar'); ?>
<?php $this->load->view('adminpanel/layout/footer'); ?>


<!-- Script to initialize Fancybox -->
<script>
    $(document).ready(function() {
        // Initialize Fancybox
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

        // Function to toggle visibility of control elements
        function updateControlsVisibility() {
            var hasImages = $('.card').length > 0;
            $('#actions-container').toggle(hasImages);
        }

        // Initial check on page load
        updateControlsVisibility();

        // Handle image upload
        $('#images').on('change', function() {
            var files = this.files;
            var formData = new FormData();
            var aid = "<?php echo $aid; ?>";

            $.each(files, function(i, file) {
                formData.append('images[]', file);
            });

            formData.append('aid', aid);
            formData.append('filetype', "images");

            $('#progressModal').modal('show');

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
                            $('#progressBar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete).text(percentComplete + '%');
                        }
                    });
                    return xhr;
                },
                success: function(response) {
                    if (response.status == 200) {
                        location.reload(); // Refresh page to update gallery
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

        // Show the checkboxes when "Select" is clicked
        $('#select-button').on('click', function() {
            $('.image-checkbox-container').show();
        });

        function updateControlsVisibility() {
            var hasImages = $('.col-lg-1').length > 0; // Check if there are image columns
            $('#actions-container').toggle(hasImages); // Show/Hide actions container based on image presence

            // Show/Hide image-checkbox-container based on "Select All" checkbox status
            $('.image-checkbox-container').toggle($('.select-all').is(':checked'));
        }

        // Initial check on page load
        updateControlsVisibility();

        // Handle "Select All" checkbox
        $(document).on('change', '.select-all', function() {
            var isChecked = $(this).is(':checked');
            $('.image-checkbox').prop('checked', isChecked); // Check/Uncheck all checkboxes
            $('.image-checkbox').each(function() {
                $(this).trigger('change'); // Trigger change event to handle overlay display
            });
            updateControlsVisibility(); // Update visibility of control elements
            updateDeleteButton(); // Update delete button visibility
        });

        // Handle individual checkbox change
        $(document).on('change', '.image-checkbox', function() {
            var allChecked = $('.image-checkbox').length === $('.image-checkbox:checked').length;
            $('.select-all').prop('checked', allChecked); // Update "Select All" checkbox status

            // Toggle checkmark overlay
            if ($(this).is(':checked')) {
                $(this).siblings('.checkmark-overlay').show();
            } else {
                $(this).siblings('.checkmark-overlay').hide();
            }

            updateDeleteButton(); // Update delete button visibility
        });

        // Update delete button visibility based on selected checkboxes
        function updateDeleteButton() {
            $('.delete-selected').toggle($('.image-checkbox:checked').length > 0);
        }

        // Handle delete button click
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
                            images: selectedImages, // Send as an array
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $('.image-checkbox:checked').closest('.col-6').remove();
                                updateControlsVisibility(); // Update control visibility
                                Swal.fire(
                                    'Deleted!',
                                    'Selected images have been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message || 'Failed to delete the images.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the images.',
                                'error'
                            );
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
            var $card = $(this).closest('.col-6');

            // Show SweetAlert2 confirmation dialog
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
                            images: [image], // Send the image as an array
                            aid: "<?php echo $aid; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $card.remove(); // Remove the image card
                                updateControlsVisibility(); // Update control visibility
                                Swal.fire(
                                    'Deleted!',
                                    'The image has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message || 'Failed to delete the image.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Deletion failed.', error);
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

</script>