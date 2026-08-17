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
    <form id="property_essential" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . ''); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
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
            <input class="btn case_btn" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="property_submit">
        </div>
    </form>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; color:black;font-size: 14px;background-color:#f3f3f3;margin: 0">
    <h4 class="pl-2" style="color:black;font-size: 14px;margin: 0">Brief report</h4>
    <button type="button" class="btn case_btn addstatement" data-toggle="modal" data-target="#descImgmodal">Add statement</button>
</div>

<!-- Special Information Modal -->
<div class="modal fade" id="descImgmodal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg custom-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Special Information / Brief Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="specialInfoEditor" class="form-label">Write your statement:</label>
                    <textarea class="form-control" id="specialInfoEditor"></textarea>
                </div>
                <!-- File Upload Section -->
                <div class="mb-3">
                    <label class="form-label">Attach a photo:</label>
                    <input type="file" id="fileUpload" accept="image/*" multiple style="display: none;">

                    <!-- Upload Images Button -->
                    <a class="btn case_btn open-modal" data-title="Statement" data-toggle="modal" type="button"
                        href="javascript:void(0)" id="uploadpropTrigger">Upload Images
                    </a>

                    <!-- Display Selected File Names -->
                    <p id="selectedFiles" style="margin-top: 10px; font-size: 14px; color: #555;"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary case_btn" data-dismiss="modal" style="background-color:#CA571F;">Close</button>
                <button type="button" class="btn btn-secondary case_btn" id="saveSpecialInfo">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="selectpropertyimg" class="modal fade">
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
                            <!-- <div id="error-message" style="color: red; display: none;"></div>
                            <div id="success-message" style="color: green; display: none;"></div> -->
                            <div class="panel-content">
                                <div class="row">
                                    <?php $index = 1; ?>
                                    <?php foreach ($caseimages as $index => $image) { ?>
                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 mb-3" style="display:flex">
                                            <input type="checkbox" name="image[]" value="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="image-checkbox" id="checkbox_<?php echo $index; ?>" style="align-self:baseline" />
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
                <button type="button" target="_blank" class="btn btn-success" id="savepropertyimages">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var statements = <?php echo json_encode(isset($reportdata->statements) ? $reportdata->statements : 'NA'); ?>;
        console.log(statements);

        if (statements !== 'NA' && statements !== null) {
            disableFields = true; // Disable fields if data exists
            populatestatements(statements, disableFields);
        }

        function populatestatements(data, disableFields) {
            const statementsList = $('#statementsList');
            statementsList.empty();

            // Ensure data is an array
            const statementsArray = Array.isArray(data) ? data : [data];

            statementsArray.forEach((statement, index) => {
                let imagesHtml = "";
                if (statement.images && statement.images.length > 0) {
                    statement.images.forEach((imgSrc) => {
                        imagesHtml += `<a href="${imgSrc}" class="view-img" data-fancybox="gallery-${index}" data-caption="${statement.heading || ''}">
                                      <img src="${imgSrc}" class="img-thumbnail small-img" 
                                      style="width: 50px; height: 50px; object-fit: cover; margin-left: 5px;">
                                   </a>`;
                    });
                }

                let jsonData = JSON.stringify(statement);
                let newStatement = `
                <div class="statementcard card mt-2 p-2 shadow-sm position-relative" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3">
                            <button class="btn btn-sm text-white edit-statement px-2 py-1" data-index="${index}" 
                                style="background-color:#2BB3C0;">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger delete-statement ml-2 px-2 py-1"  data-index="${index}">
                                Delete
                            </button>
                        </div>
                        <div class="d-flex gap-2">${imagesHtml}</div> <!-- Images displayed here -->
                    </div>
                    <input type="hidden" name="statementData[]" value='${jsonData}'>
                    <p class="fw-bold mb-0"><b>${statement.heading || ''} </b></p>
                    <p class="statement-text">${statement.statement || ''}</p>
                </div>
                `;

                statementsList.append(newStatement);
            });

            // Enable drag & drop sorting
            statementsList.sortable({
                placeholder: "sortable-placeholder",
                update: function(event, ui) {
                    updateStatementOrder();
                }
            }).disableSelection();
        }

        // Function to update order after sorting
        function updateStatementOrder() {
            let updatedOrder = [];
            $('.statementcard').each(function(index) {
                let data = JSON.parse($(this).find('input[name="statementData[]"]').val());
                updatedOrder.push(data);
            });
            console.log("Updated Order:", updatedOrder);
            // You can send this order to the server via AJAX if needed
        }


        $(document).off('click', '.delete-statement').on('click', '.delete-statement', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index');

            Swal.fire({
                title: "Are you sure?",
                text: "This statement will be removed!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`div[data-index="${index}"]`).remove();
                    Swal.fire("Deleted!", "The statement has been removed.", "success");
                }
            });
        });

        // Handle Edit Button Click
        $(document).off('click', '.edit-statement').on('click', '.edit-statement', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index'); // Get index of the clicked statement
            let statementData = $(`div[data-index="${index}"] input[name="statementData[]"]`).val();
            console.log(statementData);

            if (statementData) {
                let statement = JSON.parse(statementData);
                // Ensure the heading and statement are assigned correctly
                let headingValue = statement.heading ? statement.heading : '';
                let statementValue = statement.statement ? statement.statement : '';

                $('#specialInfoHeading').val(headingValue);
                $('#specialInfoEditor').val(statementValue);

                // Store index in modal for tracking edits
                $('#descImgmodal').data('editIndex', index);

                // Clear previous images and populate new ones with delete icons
                $('#selectedFiles').html('');
                if (statement.images && statement.images.length > 0) {
                    statement.images.forEach((imgSrc, imgIndex) => {
                        $('#selectedFiles').append(`
                                <div class="position-relative d-inline-block">
                                    <img src="${imgSrc}" class="img-thumbnail"
                                        style="width: 100px; height: 100px; object-fit: cover; margin: 5px;">
                                    <button class="btn btn-sm btn-danger delete-image-modal" data-img-index="${imgIndex}"
                                            style="background-color: transparent;position: absolute;top: 7px;right: 7px;border-radius: 50%;padding: 2px 5px;font-size: 19px;border:none;">
                                        X
                                    </button>
                                </div>
                            `);
                    });
                }

                // Show modal
                $('#descImgmodal').modal('show');
            }
        });

        $(document).off('click', '.delete-image-modal').on('click', '.delete-image-modal', function() {
            $(this).parent().remove(); // Remove the image container when delete icon is clicked
        });


        // Handle Save Button Click
        $('#saveSpecialInfo').on('click', function() {
            let heading = $('#specialInfoHeading').val().trim();
            let statement = $('#specialInfoEditor').val().trim();
            let imagesHtml = '';
            let imagesArray = [];

            // Validation: Ensure heading and statement are not empty
            if (heading === "" || statement === "") {
                Swal.fire("Incomplete Information", "Please enter a heading and statement before saving.", "warning");
                return;
            }

            // Extract images
            $('#selectedFiles img').each(function() {
                let imgSrc = $(this).attr('src');
                imagesHtml += ` <a href="${imgSrc}" class="view-img" >
                                      <img src="${imgSrc}" class="img-thumbnail small-img" 
                                      style="width: 50px; height: 50px; object-fit: cover; margin-left: 5px;">
                                   </a> `;

                imagesArray.push(imgSrc);
            });

            // Create JSON object
            let statementData = {
                heading: heading,
                statement: statement,
                images: imagesArray
            };
            let jsonData = JSON.stringify(statementData);

            // Check if editing an existing statement
            let editIndex = $('#descImgmodal').data('editIndex');
            if (editIndex !== undefined) {
                let card = $(`.card[data-index="${editIndex}"]`);
                card.find('input[name="statementData[]"]').val(jsonData);

                // Update heading, statement, and images
                card.find('.fw-bold').html(`<b>${heading}</b>`);
                card.find('.statement-text').text(statement);
                card.find('.d-flex.gap-2').html(imagesHtml);
            } else {
                // Create a new statement card
                let newIndex = $('.statementcard').length;
                let newStatement = `
                <div class="statementcard card mt-2 p-2 shadow-sm position-relative" data-index="${newIndex}">
                   
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3">
                            <button class="btn btn-sm text-white edit-statement px-2 py-1" data-index="${newIndex}" 
                                style="background-color:#2BB3C0;">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger delete-statement ml-2 px-2 py-1"  data-index="${newIndex}">
                                Delete
                            </button>
                        </div>
                        <div class="d-flex gap-2">${imagesHtml}</div> <!-- Images displayed here -->
                    </div>
                    <input type="hidden" name="statementData[]" value='${jsonData}'>
                    <p class="fw-bold"><b>${heading}</b></p>
                    <p class="statement-text mt-2">${statement}</p>
                </div>
                `;

                // Append the new statement
                $('#statementsList').append(newStatement);
            }

            // Clear input fields and close modal
            $('#specialInfoHeading').val('');
            $('#specialInfoEditor').val('');
            $('#selectedFiles').html('');
            $('#descImgmodal').modal('hide');
        });

        $('#savebdeathimages').on('click', function() {
            let selectedImages = [];

            // Get all checked checkboxes
            $('.image-checkbox:checked').each(function() {
                selectedImages.push($(this).val()); // Store image URL
            });

            if (selectedImages.length === 0) {
                Swal.fire("No images selected!", "Please select at least one image.", "warning");
                return;
            }

            // Generate image previews
            let imageHtml = '';
            selectedImages.forEach(function(src) {
                imageHtml += `<img src="${src}" class="selected-image-preview" style="width:80px; height:80px; margin-right:5px; border-radius:5px;">`;
            });

            // Append to `#selectedFiles`
            $('#selectedFiles').html(imageHtml);

            // Close the current modal
            $('#selectebdeathimages').modal('hide');
        });

        // Ensure checkboxes reset when modal opens
        $('#selectebdeathimages').on('show.bs.modal', function() {
            $(this).removeAttr('aria-hidden'); // Fix accessibility issue
            $('.image-checkbox').prop('checked', false).attr('disabled', false);
        });

        // Open modal on button click
        $('#uploadpropTrigger').on('click', function(event) {
            event.stopPropagation(); // Prevent bubbling up
            event.preventDefault(); // Prevent any default action
            console.log('Opening Image Modal');

            // Hide other modals before opening the correct one
            $('#select_images').modal('hide');
            $('#selectebdeathimages').modal('show');
        });


        // Ensure proper backdrop removal when modal closes
        $('#selectebdeathimages').on('hidden.bs.modal', function() {
            $(this).attr('aria-hidden', 'true'); // Restore accessibility attribute
            $('.modal-backdrop').remove(); // Remove any remaining backdrops
            $('body').removeClass('modal-open'); // Prevent scrolling issues
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
            highlight: function(element) {
                $(element).addClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').show();
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                $(element).closest('.form-group').find('.error-message').hide();
            },
            rules: {
                policy_by: {
                    required: true
                },
                policy_branch: {
                    required: true
                },
                policy_user: {
                    required: true
                },
                policy_mobile: {
                    required: true
                },
                appoint_by: {
                    required: true
                },
                appointment_branch_name: {
                    required: true
                },
                appointment_user_name: {
                    required: true
                },
                appointment_mobile_num: {
                    required: true
                },
                payment_by: {
                    required: true
                },
                payment_branch_name: {
                    required: true
                },
                payment_user_name: {
                    required: true
                },
                payment_mobile_num: {
                    required: true
                },
                case_reference: {
                    required: true,
                    caseReferenceFormat: true
                },
                insured_name: {
                    required: true
                },
                contact_person_name: {
                    required: true
                },
                address: {
                    required: true
                },
                Ofinstruction: {
                    required: true
                },
                visit_date_time: {
                    required: true
                },
                insured_activity: {
                    required: true
                },
                loss_area: {
                    required: true
                },
                cause_loss: {
                    required: true
                },
            },
            messages: {
                policy_by: {
                    required: "This field is required"
                },
                policy_branch: {
                    required: "This field is required"
                },
                policy_user: {
                    required: "This field is required"
                },
                policy_mobile: {
                    required: "This field is required"
                },
                appoint_by: {
                    required: "This field is required"
                },
                appointment_branch_name: {
                    required: "This field is required"
                },
                appointment_user_name: {
                    required: "This field is required"
                },
                appointment_mobile_num: {
                    required: "This field is required"
                },
                payment_by: {
                    required: "This field is required"
                },
                payment_branch_name: {
                    required: "This field is required"
                },
                payment_user_name: {
                    required: "This field is required"
                },
                payment_mobile_num: {
                    required: "This field is required"
                },
                case_reference: {
                    required: "This field is required",
                    caseReferenceFormat: "Invalid format! Please enter in the format: VP/I/24/05/115"
                },
                insured_name: {
                    required: "This field is required"
                },
                contact_person_name: {
                    required: "This field is required"
                },
                address: {
                    required: "This field is required"
                },
                Ofinstruction: {
                    required: "This field is required"
                },
                visit_date_time: {
                    required: "This field is required"
                },
                insured_activity: {
                    required: "This field is required"
                },
                loss_area: {
                    required: "This field is required"
                },
                cause_loss: {
                    required: "This field is required"
                },
            },
            submitHandler: function(form) {
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
                    success: function(response) {
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
                    error: function(xhr, status, error) {
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

    });
</script>