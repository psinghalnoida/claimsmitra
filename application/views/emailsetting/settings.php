<style>
   
    .modal-backdrop {
        z-index: 1051 !important;
        display:none!important;
    }
   
</style>
<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
    <section class="main--content" style="padding-top:0px;">
        <div class="col-md-12" style="padding-top:0px;">         
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Email configuration</h3>
                </div>
                <div class="panel-content">
                <form id="email-config-form" autocomplete="off">
                    <input type="text" style="display:none">
                    <input type="password" style="display:none">
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Host:</span>
                        <div class="col-lg-10">
                            <input type="text" name="smtp_host" placeholder="Enter Your Host Name" class="form-control">  
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Port:</span>
                        <div class="col-lg-10">
                            <input type="text" name="smtp_port" placeholder="Enter Your Port Number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Encryption Type:</span>
                        <div class="col-lg-10">
                            <select name="smtp_crypto" class="form-control">
                                <option value="">Select Type</option>
                                <option value="ssl">SSL</option>
                                <option value="tls">TLS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Username:</span>
                        <div class="col-lg-10">
                            <input type="text" name="smtp_user" placeholder="Enter Your Username" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Password:</span>
                        <div class="col-lg-10">
                            <input type="password" name="smtp_pass" placeholder="Enter Your Password" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Test Email Address:</span>
                        <div class="col-lg-10">
                            <input type="email" name="to_email" placeholder="Enter Your Testing Email" class="form-control" >
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-right">
                            <button type="button" id="connect-button" class="btn btn-rounded btn-default">Connect</button>
                            <button type="submit" id="save-button" class="btn btn-rounded btn-success" disabled>Save</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="panel" style="padding-top:0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Template</h3>
                </div>
                <div class="panel-content">
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Template Name:</span>
                        <div class="col-lg-10">
                            <input type="text"  id="inputText" placeholder="Write here" class="form-control">  
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-2 col-form-label">Body:</span>
                        <div class="col-lg-10">
                            <textarea class="form-control" row="3" id="summernote">
                            </textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-right">
                            <button type="button" class="btn btn-rounded btn-success savebody">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('adminpanel/layout/footer'); ?>
    <script type="text/javascript">
 
        $(document).ready(function() {
            $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js',

            function(){
                $('#summernote').summernote();
            });

            $('#summernote').summernote({
                height: 200,
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i]);
                        }
                    }
                }  
            });


            // Function to upload image
            function uploadImage(file) {
                var formData = new FormData();
                formData.append('image', file);
                $.ajax({
                    url: "<?php echo base_url('assignment/uploadImage'); ?>", // Server-side endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var res = JSON.parse(response.trim());
                        if (res.status === 'success') {
                            $('#summernote').summernote('insertImage', res.image_url); // Insert image into Summernote
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error uploading image:', error);
                        alert('An error occurred while uploading the image.');
                    }
                });
            }

        
            $('.savebody').on('click', function() {
                var templateName = $('#inputText').val();
                var templateBody = $('#summernote').val();

                if (templateName && templateBody) {
                    // Create a temporary DOM element to manipulate the content
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = templateBody;

                    // Loop through all images and update their src to only include the file name
                    var images = tempDiv.querySelectorAll('img');
                    images.forEach(function(img) {
                        var src = img.getAttribute('src');
                        if (src) {
                            var fileName = src.split('/').pop(); // Extract the file name
                            img.setAttribute('src', fileName);  // Replace the src with the file name
                        }
                    });

                    // Get the updated content
                    var updatedTemplateBody = tempDiv.innerHTML;

                    // Send the data to the server
                    $.ajax({
                        url: "<?php echo base_url('assignment/saveTemplate'); ?>",
                        type: 'POST',
                        data: {
                            template_name: templateName,
                            template_body: updatedTemplateBody
                        },
                        success: function(response) {
                            var res = JSON.parse(response.trim());
                            if (res.status === 'success') {
                                $('#inputText').val('');
                                $('#summernote').summernote('reset');
                                $('.button-line').hide();
                            } else {
                                alert(res.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        }
                    });
                } else {
                    alert('Please fill out both fields.');
                }
            });


        });

    
        $(document).ready(function() {

            $('input').on('focus', function() {
                $(this).attr('autocomplete', 'off');
            });

            $('#connect-button').click(function() {
                let formData = $('#email-config-form').serialize();
                $('#connect-button').prop('disabled', true).text('Testing...');
                $('#save-button').prop('disabled', true);
                $.ajax({
                    url: 'email/send_email',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // let data = JSON.parse(response);
                        // if (data.success) {
                            alert('Email test successful!');
                            $('#save-button').prop('disabled', false);
                        // } else {
                        //     alert('Email test failed: ' + data.message);
                        // }
                        
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    },
                    complete: function() {
                        $('#connect-button').prop('disabled', false).text('Connect');
                    }
                });
            });

            $('#email-config-form').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: 'email/save_email',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (response.success) {
                            // alert('Configuration saved successfully!');
                            
                        } else {
                            // alert('Error saving configuration: ' + data.message);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            });
        });

    
</script>