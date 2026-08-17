<?php $this->load->view('adminpanel/layout/case-sidebar'); ?>
<style>
    .col-12{
        padding:0;
    }   
</style>
<main class="main--container" >

    <div class="tab-content" >
        <div class="tab-pane fade show active" id="tab10">
            <!-- <?php $this->load->view('adminpanel/jobs/locationbasedjob/heading'); ?> -->
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata'); ?>
        </div>
    </div>

    <section class="main--content" style="border: 1px solid #E5E4E2; margin-left: 10px;margin-right:10px;padding-top: 0px;">
        <div class="row gutter-20">
            <div class="col-md-6 pr-1">
                <!-- Panel Start -->
                <div class="panel pb-4" >
                    <div class="panel-content">
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th><b>To</b></th>
                                    <th><b>Cc</b></th>
                                    <th><b>Role</b></th>
                                    <th><b>Email</b></th>
                                </tr>
                            </thead>
                            <tbody id="emailTableBody">
                                <tr>
                                    <td ><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td>Handler</td>
                                    <td>handler@gmail.com</td>
                                </tr>
                                <tr>
                                    <td class=""><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td>Surveyor</td>
                                    <td>surveyor@gmail.com</td>
                                </tr>
                                <tr>
                                    <td class=""><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td>Insurer</td>
                                    <td>insurer@gmail.com</td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-rounded btn-success float-right mt-2" id="sendEmailButton">Send Email</button>
                        <button class="btn btn-rounded btn-default float-right mt-2 mb-2 mr-2" data-toggle="modal" data-target="#addmailmodal">Add Email</button>
                        <br>
                        <!-- <div id="pdfLinkContainer" style="display: none; padding-top:30px;">
                            <p><a id="pdfLink" href="" target="_blank">NIAC Fire Claim PDF</a></p>
                        </div> -->

                        <!--------------------------MODAL FOR ADD EMAIL-------------------------------->
                        <div id="addmailmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add User Id</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="form-group row modal-body">
                                        <span class="label-text col-md-3 ml-3 col-form-label text-md-left">Role:</span>
                                        <div class="col-md-7 mt-1">
                                            <select id="userRole" name="select" class="form-control" >
                                                <option value="other">Other</option>
                                                <option value="Handler">OS</option>
                                                <option value="Surveyor">Surveyor</option>
                                                <option value="Reporting">Reporting</option>
                                            </select>
                                        </div>
                                        <span class="label-text col-md-3 ml-3 col-form-label text-md-left">Access Mail:</span>
                                        <div class="col-md-7 mt-1">
                                            <input type="text" id="userEmail" name="text" class="form-control" placeholder="@email.com">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" id="submitBtn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="panel">
                    <div class="panel-heading">
                        <div class="form-group">
                            <div class="col-12">
                                <span class="label-text">Template:</span>
                                <select name="select" class="form-control " id="mailtype" style="margin-bottom:10px;"><option value="" disabled >Select Template</option></select>
                                <span class="label-text">Subject:</span>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Write Subject here...">
                            </div>
                        </div>
                    </div>
                    <div class="panel-content">
                        <h6>Message <strong id="templateName"></strong></h6>
                        <textarea class="form-control" row="3" id="summernote" name="message"></textarea>
                        <div class="form-group" style="padding-top:15px;">
                            <div class="col-12">
                                <select name="select" id="choosedoc" class="form-control ">
                                    <option disabled selected>Select Document</option>
                                    <option value="databank">Data Bank</option>
                                    <option value="casephoto">Case Photo</option>
                                    <option value="lordocument">LOR Document</option>
                                    <option value="billdispatch">Bill Dispatch</option>
                                    <option value="autodoc">Autogenerated Document</option>
                                </select>
                                <table id="dataTable" class="table table-bordered mt-3">
                                    <tbody>
                                        <!-- New rows will be added here -->
                                    </tbody>
                                </table>
                            </div>
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
                url: "<?php echo base_url('assignment/uploadImage'); ?>",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var res = JSON.parse(response.trim());
                    if (res.status === 'success') {
                        $('#summernote').summernote('insertImage', res.image_url);
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
        
        // to add mail 
        $('#submitBtn').click(function(){
            var role = $('#userRole').val();
            var email = $('#userEmail').val();
            if (role && email) {
                var newRow = ` 
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td>${role}</td>
                        <td>${email}</td>
                    </tr>
                `;

                $('#emailTableBody').append(newRow);
                $('#userRole').val('');
                $('#userEmail').val('');

                // Optionally, hide the modal after adding
                $('#addmailmodal').modal('hide');
               
            } else {
                alert('Please fill out all fields.');
            }
        });

        // ajax for fetching templates 
        $.ajax({
            url: "<?php echo base_url('assignment/fetchTemplate'); ?>", 
            type: 'GET',
            success: function(response) {
                try {
                    var res = JSON.parse(response.trim());
                    if (res.status === 'success') {
                      
                        var templateDropdown = $('#mailtype');
                        templateDropdown.empty();
                        templateDropdown.append('<option value="">Select Template</option>');
                        res.data.templates.forEach(function(template) {
                            templateDropdown.append('<option value="' + template.templatename + '">' + template.templatename + '</option>');
                            
                        });
                    } else {
                        alert(res.message);
                    }
                } catch (error) {
                    console.error("JSON Parsing Error: ", error);
                   
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                
            }
        });
       

        $('#mailtype').on('change', function() {
            var selectedTemplate = $(this).val();
            var selectedOption = $(this).find('option:selected');
            
            if (selectedTemplate) {
                $.ajax({
                    url: "<?php echo base_url('assignment/fetchTemplate'); ?>", 
                    type: 'POST',
                    data: { template_name: selectedTemplate },
                    success: function(response) {
                        $('#templateName').text('(' + selectedTemplate + ')');
                        try {
                            var res = JSON.parse(response.trim());
                            if (res.status === 'success') {
                                // Set the template body with images (already with full URL paths)
                                $('#summernote').summernote('code', res.data.templateBody);
                            } else {
                                alert(res.message);
                            }
                        } catch (error) {
                            console.error("JSON Parsing Error: ", error);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#templateName').text('');
                        console.error('Error:', error);
                        alert('An error occurred while fetching the template body.');
                    }
                });
            } else {
                $('#summernote').summernote('code', '');
            }
        });


        // to send email
        $('#sendEmailButton').on('click', function() {
            var subject = $('#subject').val();  
            // var message = $('#summernote').val(); 
            var message = $('#summernote').summernote('code'); 
            var recipients = [];
            $('#emailTableBody tr').each(function() {
                var email = $(this).find('td').eq(3).text().trim();
                var toChecked = $(this).find('td').eq(0).find('input[type="checkbox"]').prop('checked');
                var ccChecked = $(this).find('td').eq(1).find('input[type="checkbox"]').prop('checked');
                if (toChecked || ccChecked) {
                    var recipient = {
                        to: toChecked ? email : null, 
                        cc: ccChecked ? email : null  
                    };
                    recipients.push(recipient);
                }
            });

            // Fetch SMTP details dynamically from the server
            $.ajax({
                url: "<?php echo base_url('assignment/emailsend'); ?>", 
                type: 'POST',
                data: {
                    recipients: JSON.stringify(recipients), 
                    subject: subject,
                    message: message
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.success) {
                        $('#sendEmailButton').after('<div id="successMessage" class="alert alert-success mt-2">Email sent successfully!</div>');
                    } else {
                        console.log(response);
                    }
                },
                error: function() {
                    // console.log(response);
                    return false;
                }
            });
        });

    });

</script>