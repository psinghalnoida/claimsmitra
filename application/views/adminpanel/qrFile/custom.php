<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script> 
        <!-- Fancybox core CSS file -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

        <!-- Fancybox core JS file -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script> 
    <style>
          /* Custom CSS for Fancybox arrows */
    .fancybox-navigation {
        width: 60px; /* Adjust the width of the arrows */
        height: 120px; /* Adjust the height of the arrows */
    }

    .fancybox-arrow {
        width: 100%;
        height: 100%;
        background-color: rgba(255, 0, 0, 0.5); /* Adjust the background color */
    }

    .fancybox-arrow:hover {
        background-color: rgba(255, 255, 0, 0.5); /* Adjust the background color on hover */
    }

    .fancybox-arrow:before {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px; /* Adjust the size of the arrow */
        height: 20px; /* Adjust the size of the arrow */
        border: solid white; /* Adjust the arrow color */
        border-width: 0 2px 2px 0;
    }

    .fancybox-nav {
        width: 60px; /* Adjust the width of the arrows */
        height: 120px; /* Adjust the height of the arrows */
    }
        body{
            background-color:rgb(243, 243, 243);
        }
        .images-grid,
        .videos-grid
       {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 12px;
            margin-bottom: 12px;
        }

        .images-grid img {
            width: 100%;
height: auto; 
       }

       .videos-grid video {
            width: 100%;
            height: auto; 
        }

        .docs-grid object {
            width: 100%;
            height: 300px;
        }

        .pdf-thumbnail {
         width: 81px;   
        }

        .row img {
            gap: 12px;
        }
        /* .header{
            background-color:black;
        } */
    </style>
</head>

<body>
    <header style="background-color: #151515; padding: 10px; width: 100%; z-index: 1000; position: sticky; top: 0;margin-bottom:12px;">
        <div class="row">
            <div class="col-3">
                <p style="color: #fff;font-size: 10px;">
                    Insured Name: 
                    <?php 
                        echo isset($casedata['nameofowner']) && !empty($casedata['nameofowner']) 
                            ? $casedata->nameofowner 
                            : (isset($casedata['insured_name']) && !empty($casedata['insured_name']) 
                                ? $casedata['insured_name']
                                : 'N/A'); 
                    ?>
                </p>
                <?php 
                    if ((isset($casedata['tagNumber']) && !empty($casedata['tagNumber'])) || (isset($casedata['cargo']) && !empty($casedata['cargo']))) { 
                    ?>
                        <p style="color: #fff;font-size: 10px;">
                            Tag Number: 
                            <?php 
                                echo isset($casedata['tagNumber']) && !empty($casedata['tagNumber']) 
                                    ? $casedata['tagNumber'] 
                                    : $casedata['cargo']; 
                            ?>
                        </p>
                    <?php 
                    } 
                    ?>

                    <?php 
                if (isset($casedata['vehicle_no']) && !empty($casedata['vehicle_no'])) { 
                ?>
                    <p style="color: #fff; font-size: 10px;">
                        Vehicle Number: 
                        <?php echo $casedata['vehicle_no']; ?>
                    </p>
                <?php 
                } 
                ?>


            </div>  
            <div class="col-6">
                <img src="<?php echo base_url(); ?>assets/img/account/logo.png" alt="Logo" 
                     style="height: 30px; width: 28px; margin-right: 10px; display: block; margin: 0 auto;">
                <p class="text-center" style="color: white; margin: 0; font-size: 20px;">Claims Mitra</p>
            </div>
            <div class="col-3">
                <p style="color: #fff; font-size: 10px;">
                    Date of Loss: 
                    <br>
                    <?php 
                        echo isset($casedata['dateOfDisease']) && !empty($casedata['dateOfDisease']) 
                            ? $casedata['dateOfDisease'] 
                            : (isset($casedata['loss_data']) && !empty($casedata['loss_data']) 
                                ? $casedata['loss_data'] 
                                : 'N/A'); 
                    ?>
                </p>
                <!-- <a href="<?php echo base_url('cases'); ?>">Share Case</a> -->
            </div>  
        </div>

    </header>

    <div class="container">
   <!-- <div class="header">
    <img src="assets/img/" alt=""><span style="color: white;">Claims Mitra</span>
   </div> -->
        
        <!-- Image grid -->
        <!-- <h4 class="text-center m-4">Images </h4> -->
        <div class="images-grid">
            <?php foreach ($caseimages as $images) { ?>
            <div class=" col-sm">
                <img src="<?php echo base_url('uploads/'.$aid.'/images/'.$images); ?>" alt="" data-fancybox="images">
            </div>
            <?php } ?>
        </div>
        


        <!-- Video Grid -->
        <!-- <h4 class="text-center m-4">Videos </h4> -->
        <div class="videos-grid">
            <?php foreach ($casevideos as $video) { ?>
            <div class="col-sm">
            <video class="thumbnail" width="100%" height="auto" controls data-video="<?php echo base_url('uploads/' . $aid . '/videos/' . $video); ?>" >
           
            <source src="<?php echo base_url('uploads/' . $aid . '/videos/' . $video); ?>" type="video/mp4">
            </video>
            </div>
            <?php } ?>
        </div>



        <!-- Documents Grid -->
        <h4 class="text-center m-4">Documents </h4>
        <div class="row mb-4">
            <?php foreach ($casedocuments as $document) { ?>
                <?php $fileExtension = pathinfo($document, PATHINFO_EXTENSION); ?>
                    <?php if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])){ ?>
                        <div class="col-4 col-sm-12 col-md-3 col-lg mt-2">
                            <a href="<?php echo base_url('uploads/'.$aid.'/documents/'.$document.''); ?>" target="_blank" data-fancybox="images">
                                <img src="<?php echo base_url('uploads/'.$aid.'/documents/'.$document.''); ?>" class="pdf-thumbnail" alt="Document 1">
                            </a>
                        </div>
                    <?php } else if($fileExtension == 'pdf'){ ?>
                        <div class="col-4 col-sm-12 col-md-3 col-lg mt-2">
                            <a href="<?php echo base_url('uploads/'.$aid.'/documents/'.$document.''); ?>" target="_blank">
                                <img src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" class="pdf-thumbnail" alt="Document 1" width="200px">
                                <div class="demo-gallery-poster">
                                    <img src="https://sachinchoolur.github.io/lightgallery.js/static/img/zoom.png">
                                </div>
                            </a>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>




    <!-- VIDEO VIEWER -->
    <!-- <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" >Videos</h1>
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
</div> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script>
        // for images
                $(document).ready(function() {
                    $('[data-fancybox="images"]').fancybox({
                        loop: true, // Enable looping through images
                        buttons: [
                            'slideShow',
                            'thumbs',
                            'rotateLeft', // Add custom rotateLeft button
                            'rotateRight', // Add custom rotateRight button
                            'close'
                        ],
                        animationEffect: "fade",
                        transitionEffect: "slide", 
                        transitionDuration: 500, // Duration of the slide animation in milliseconds
                        infobar: false, // Disable the bottom bar showing image count and caption
                        arrows: true, // Enable navigation arrows
                        clickContent: false, // Disable navigation by clicking the content
                        clickSlide: false, // Disable navigation by clicking the slide
                        
                    });
                });

                //for videos

                 $(document).ready(function() {
                // Function to update video source and load it
                function updateVideo(videoUrl) {
                    $('#videoSource').attr('src', videoUrl);
                    $('#videoPlayer').get(0).load();
                }

                // Click event for thumbnails
                $('.thumbnail').click(function() {
                    var videoUrl = $(this).data('video');
                    updateVideo(videoUrl);
                    $('#videoModal').modal('show');
                });

                // Click event for pause video
                $(document).on('click', function(e) {
                    // Check if the clicked element is outside the modal or in the modal header
                    if ($(e.target).closest('.modal').length === 0 || $(e.target).closest('.modal-header').length > 0) {
                        $('#videoPlayer').trigger('pause');
                    }
                });

                // Listen for video entering fullscreen mode
                $('#videoPlayer').on('fullscreenchange', function(e) {
                    var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement;
                    if (fullscreenElement && fullscreenElement === $('#videoPlayer')[0]) {
                        // Video entered fullscreen mode, play the video
                        $('#videoPlayer').get(0).play();
                    } else {
                        // Video exited fullscreen mode, pause the video
                        $('#videoPlayer').get(0).pause();
                    }
                });

                $('#videos').on('change', function() {
                    var files = this.files;
                    var formData = new FormData();
                    var aid = "<?php echo $aid; ?>";

                    for (var i = 0; i < files.length; i++) {
                        formData.append('videos[]', files[i]);
                    }
                    formData.append('aid',aid);
                    formData.append('filetype',"videos");

                    $.ajax({
                        url: '<?php echo base_url('cases/uploadvideos'); ?>', // Replace with your server upload URL
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType:'json',
                        success: function(response) {
                            var html;
                            if(response.status == 200){
                            location.reload();
                            }
                            // Handle success response
                        },
                        error: function(xhr, status, error) {
                            console.error('Upload failed.', error);
                            // Handle error response
                        }
                    });
                });
            });

    </script> -->
    <script>
    // Get the close button element
    var closeButton = document.getElementById('closeModalButton');

    // Add click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Hide the modal when the close button is clicked
        $('#videoModal').modal('hide');
    });
</script>
</body>
</html>