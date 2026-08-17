<?php $this->load->view('adminpanel/layout/sidebar');?>
<main class="main--container" style="padding-top:103px;">
    <div class="tab-content" style="padding:0px; height:100vh;">
        <div class="tab-pane fade show active" id="tab10">
            <section class="page--header" style="margin:15px">
                <div class="container-fluid">
                    <div class="panel" style="box-shadow:unset">
                        <form id="quicksurvey_form" method="post" enctype="multipart/form-data">
                            <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
                                <!-- FORM START -->
                                <div class="row my-3">  
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="companyName" style="color: black;">Name of Company &nbsp;<span style="color:red">*</label>
                                              <select class="form-control editable-field" id="companyName" name="companyName" required >
                                                <option selected disabled>Select Company</option>
                                                <option value="97">V P SINGHAL & COM INSURANCE SURVEYORS & LOSS ASSESSORS PRIVATE LIMITED</option>
                                            </select>
                                        </div>
                                    </div>  
                                </div>
                                <div class="row my-3">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="beneficiaryname" style="color:black">Name of Beneficiary &nbsp;<span style="color:red">*</span></label>
                                            <input type="text" class="form-control editable-field "  value="" name="beneficiaryname" id="beneficiaryname" placeholder="Enter your district" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row my-3">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="form-group">
                                            <label for="itemnumber" style="color:black">Tag Number &nbsp;<span style="color:red">*</span></label>
                                            <input type="text" class="form-control editable-field "  value="" name="itemnumber" id="itemnumber" placeholder="Enter your district" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                    <input class="btn case_btn" type="button" value="submit" id="quicksurvey_submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section> 
        </div>
    </div>
<?php $this->load->view('adminpanel/layout/footer');?> 


<script>
     
$("#quicksurvey_form").validate({
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
        companyName: {
            required: true
        },
        beneficiaryname: {
            required: true
        },
        itemnumber: {
            required: true
        }
    },
    messages: {
        companyName: {
            required: "Please select a company."
        },
        beneficiaryname: {
            required: "Please enter the beneficiary name."
        },
        itemnumber: {
            required: "Please enter the tag number."
        }
    },
    submitHandler: function (form) {
        var formData = new FormData($(form)[0]);
        $('#quicksurvey_submit').prop('disabled', true);
        $.ajax({
            url: '<?php echo base_url('quicksurveycase'); ?>', 
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function (response) {
                console.log('Server response:', response);
                if (response.status === 200) {
                    // Show success alert
                    $('#success-alert').show();

                    setTimeout(function () {
                        $('#success-alert').fadeOut('slow');

                        window.location.href = "<?php echo base_url('quicksurveylist'); ?>"; // Adjust the redirect URL as needed
                    }, 1000);

                    console.log("Form submitted successfully.");
                } else {
                    alert(response.message || 'Failed to process the data.');
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", xhr.responseText);
                alert("An error occurred while submitting the form. Please try again.");
            },
            complete: function () {
                // Re-enable the submit button
                $('#quicksurvey_submit').prop('disabled', false);
            }
        });
    }
});

// Trigger form submission
$('#quicksurvey_submit').on('click', function () {
    $("#quicksurvey_form").submit();
});

</script>
