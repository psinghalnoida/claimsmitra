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
                                <div class="panel-content ml-2 mr-2" >
                                    <div id="actions-container" class="d-flex justify-content-between align-items-center" style="display: none;">
                                        <!-- Delete button -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-2">
                                                <input type="checkbox" class="form-check-input" id="select-all" style="width: 15px; height: 15px;">
                                                <label class="form-check-label mt-0" for="select-all" style="color: #E16123; font-weight: 600;">Select All</label>
                                            </div>
                                            <!-- <label id="select-button" style="color: #E16123; font-weight: 600; margin-left: 10px;">Select</label> -->
                                        </div>
                                        <button id="delete-selected" class="btn btn-danger me-2 delete-btn" style="display: none;padding: 3px 7px;" disabled>Delete</button>
                                    </div>
                                    <hr>
                                    <!-- Video Gallery -->
                                    <div class="row mt-2">
                                        <?php foreach ($casevideos as $index => $video) { ?>
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-1 mb-3 " width="100%" height="126px">
                                                <video class="thumbnail" width="100%" controls height="126px" data-video="<?php echo base_url('uploads/' . $aid . '/videos/' . $video); ?>">
                                                    <source src="<?php echo base_url('uploads/' . $aid . '/videos/' . $video); ?>" type="video/mp4" >
                                                </video>
                                                <div class="delete-icon" data-video="<?php echo $video; ?>" title="Delete Video" style="padding: 2px 7px;">
                                                    <i class="fa fa-trash"></i> <!-- FontAwesome trash icon -->
                                                </div>
                                                <div class="form-check video-checkbox-container" style="right:8%;top:-2%;display:none;">
                                                    <input type="checkbox" class="form-check-input video-checkbox" id="video-<?php echo $index; ?>" data-video="<?php echo $video; ?>">
                                                    <label class="form-check-label" for="video-<?php echo $index; ?>"></label>
                                                </div>
                                            </div>
                                        <?php } ?>
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

    <!-- Modal Structure -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="width:100%">
                <div class="modal-header">
                    <h1 class="modal-title">Videos</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

    <script>
        $(document).ready(function() {
            function updateVideo(videoUrl) {
                $('#videoSource').attr('src', videoUrl);
                $('#videoPlayer').get(0).load();
            }

            $(document).on('click', '.thumbnail', function() {
                var videoUrl = $(this).data('video');
                updateVideo(videoUrl);
                $('#videoModal').modal('show');
            });

            $('#select-button').on('click', function() {
                $('.video-checkbox-container').show();
            });

            $(document).on('click', '.delete-icon', function(event) {
                event.preventDefault();
                event.stopPropagation();

                var video = $(this).data('video');
                var $videoCard = $(this).closest('.col-6'); // Adjust selector if needed

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
                                videos: [video], // Send the video as an array
                                aid: "<?php echo $aid; ?>"
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 200) {
                                    $videoCard.remove(); // Remove the video card element from the DOM
                                    updateControlsVisibility(); // Update control visibility
                                    Swal.fire(
                                        'Deleted!',
                                        'Your video has been deleted.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        response.message || 'Failed to delete the video.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Deletion failed.', error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the video.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            function updateControlsVisibility() {
                var hasVideos = $('.col-6').length > 0; // Check if there are video columns
                $('#actions-container').toggle(hasVideos); // Show/Hide actions container based on video presence
                $('#delete-selected').prop('disabled', !hasVideos); // Enable/Disable delete button based on video presence

                // Show/Hide image-checkbox-container based on "Select All" checkbox status
                $('.video-checkbox-container').toggle($('#select-all').is(':checked'));
            }

            // Initial check on page load
            updateControlsVisibility();

            $('#videos').on('change', function() {
                var files = this.files;
                var formData = new FormData();
                var aid = "<?php echo $aid; ?>";

                $.each(files, function(i, file) {
                    formData.append('videos[]', file);
                });

                formData.append('aid', aid);
                formData.append('filetype', "videos");
                $('#progressModal').modal('show');

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
                                $('#progressBar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete).text(percentComplete + '%');
                            }
                        });
                        return xhr;
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            location.reload(); // Optionally, you can update the DOM directly if you want to avoid reloading
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

            $('#select-all').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.video-checkbox').prop('checked', isChecked); // Check/Uncheck all checkboxes
                $('.video-checkbox').each(function() {
                    $(this).trigger('change'); // Trigger change event to handle overlay display
                });
                updateControlsVisibility(); // Update visibility of control elements
                updateDeleteButton(); // Update delete button visibility
            });

            $(document).on('change', '.video-checkbox', function() {
                var allChecked = $('.video-checkbox').length === $('.video-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
                updateDeleteButton(); // Update delete button visibility
            });

            function updateDeleteButton() {
                $('#delete-selected').toggle($('.video-checkbox:checked').length > 0);
            }

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
                                videos: selectedVideos, // Send as an array
                                aid: "<?php echo $aid; ?>"
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 200) {
                                    $('.video-checkbox:checked').closest('.col-6').remove(); // Adjust selector if needed
                                    updateControlsVisibility(); // Update control visibility
                                    Swal.fire(
                                        'Deleted!',
                                        'The selected videos have been deleted.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        response.message || 'Failed to delete the videos.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Deletion failed.', error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the videos.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
