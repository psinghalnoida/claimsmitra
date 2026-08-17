<script type="text/javascript">

    let invoiceCounter = 1; // Starts from 1 because one row already exists

    function addMoreInvoice() {
        const $container = $('.invoiceContainer');
        invoiceCounter = $container.children('.form-group.row').length + 1;

        const $newRow = $(`
            <div class="form-group row">
                <span class="label-text col-lg-3 col-form-label">Invoice ${invoiceCounter}</span>
                <div class="col-lg-3">
                    <input type="text" name="invoicenumber[]" placeholder="Invoice Number" class="form-control">
                </div>
                <div class="col-lg-2">
                    <input type="date" name="invoicedate[]" placeholder="Invoice Date" class="form-control">
                </div>
                <div class="col-lg-3">
                    <input type="file" name="addinvoice[]" class="form-control">
                </div>
                <div class="col-lg-1" style="align-self:center">
                    <button type="button" class="btn btn-rounded btn-warning remove-invoice-btn"><i class="fa fa-times"></i></button>
                </div>
            </div>
        `);

        $container.append($newRow);
    }

    function search_pincode(pincode) {
        $.ajax({
            url: "searchpincode", // Ensure this URL is correct
            method: "POST",
            data: {
                pincode: pincode
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    const city = response.data.City || '';
                    const state = response.data.State || '';
                    $(".city").val(`${city}`);
                    $(".state").val(`${state}`);
                    $(".address").val(`${city}, ${state}`);
                } else {
                    $(".address").val('');
                }
            },
            error: function(xhr, status, error) {
                $(".address").val(''); // Clear the address field on error
            }
        });
    }

    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    $(document).ready(function () {

        $(document).on('input', 'input[name="case_reference"]', function () {
            this.value = this.value.toUpperCase();
        });


       $('.selectdate').datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: 0, // disables future dates (0 means today)
            changeYear: true,
            changeMonth: true,
            yearRange: '1900:+10',
            defaultDate: new Date(), // sets default date in the picker popup
            onSelect: function(selectedDate, instance) {}
        });


        $('#search_inspector').on('focus keyup', function() {
            var companyid = "<?php echo $defaultcompany; ?>";  
            var search_inspector = $('#search_inspector').val();
            var ajaxUrl, requestData;

            if (companyid != "0") {
                ajaxUrl = "<?php echo base_url('cases/search_inspector'); ?>";
                requestData = { search: search_inspector };
            } else {
                ajaxUrl = "<?php echo base_url('cases/search_inspector_individual'); ?>";
                requestData = { search: search_inspector };
            }

            $.ajax({
                url: ajaxUrl,
                type: "POST",
                dataType: "json",
                data: requestData,
                success: function(data) {
                    var html = '<div class="scroll-container"><ul>';
                    
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            html += '<li class="inspectorOptions" id="' + item.id + '">' + item.firstname + ' ' + item.lastname + ' ' + item.mobile + '</li>';
                        });
                    } else {
                        html += '<li class="noResults">No records found</li>';
                    }
                    
                    html += '</ul></div>';
                    $('#searchResults').html(html).show(); // Show results when input is clicked

                    // Click event for selecting an option
                    $('.inspectorOptions').click(function() {
                        var selectedText = $(this).text();
                        var selectedId = $(this).attr('id');

                        $('#search_inspector').val(selectedText);
                        $('#inspectorid').val(selectedId);
                        $('#departmentid').val(selectedId);
                        $('#companyid').val(selectedId);

                        $('#searchResults').empty(); // Hide options after selection
                    });
                }
            });
        });

        // Hide dropdown when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('#search_inspector, #searchResults').length) {
                $('#searchResults').hide();
            }
        });


        $.validator.addMethod("caseReferenceExists", function(value, element) {
            let isValid = false;

            // Perform synchronous AJAX validation
            $.ajax({
                url: "<?php echo base_url('checkoutgoingreferenceexist'); ?>", // Backend endpoint
                type: "POST",
                data: {
                    case_reference: value
                }, // Send the input value
                async: false, // Synchronous to wait for response
                dataType: "json",
                success: function(response) {
                    
                    isValid = !response.exists; // Valid if it does not exist
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error); // Debug errors
                    isValid = false; // Mark invalid on error
                }
            });

            return this.optional(element) || isValid;
        }, "This case reference already exists.");

        $('#vehicle_number,.vehicle_number').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });

        $('.capitalizefirstletter').on('input', function() {
            var currentVal = $(this).val();
            var newVal = capitalizeFirstLetter(currentVal);
            $(this).val(newVal);
        });

        $('.location_of_survey').keyup(function() {
            var pincode = $(this).val();
            if (pincode.length === 6) { // Only trigger search if pincode is 6 digits long
                search_pincode(pincode);
            } else {
                // Optionally handle cases where pincode is not 6 digits
                $(".address").val(''); // Clear the address field if pincode length is incorrect
            }
        });

        // Show/hide WhatsApp number based on "available_at_location"
        $('.available_at_location').change(function () {
            if ($(this).val() === 'no') {
                $('.whatsapp_no').show();
            } else {
                $('.whatsapp_no').hide();
                $('.whatsapp_number').val('');
            }
        });

       // Add custom validation method: only uppercase letters, numbers, / and - allowed
        $.validator.addMethod("caseReferenceFormat", function (value, element) {
            return this.optional(element) || /^[A-Z0-9\/\-]+$/.test(value);
        }, "Only uppercase letters, numbers, slashes, and hyphens are allowed.");

        // Common validation rules
        const commonValidationRules = {
            case_reference: {
                required: true,
                caseReferenceExists: true,
                caseReferenceFormat: true
            },
            contact_person_name: {
                required: true
            },
            salutation: {
                required: true
            },
            address: {
                required: true
            },
            policy_number: {
                required: true
            },
            location_of_survey: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            contact_person_mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            search_inspector: {
                required: true
            },
            state: {
                required: true
            },
            whatsapp_number: {
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            claim_handler: {
                required: true
            },
            available_at_location: {
                required: true
            },
            payment_type: {
                required: true
            },
            affected_person: {
                required: true
            },
            vehicle_number: {
                required: true
            },
            loss_data: {
                required: true
            },
            consignor: {
                required: true
            },
            valuation_type: {
                required: true
            },
            firm_name: {
                required: true
            }

        };

        // Initialize form validation dynamically
        function initializeFormValidation(formSelector, submitUrl, additionalRules = {}) {
            $(formSelector).validate({
                errorClass: 'error-message',
                errorElement: 'div',
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                invalidHandler: function (form, validator) {
                    if (validator.errorList.length) {
                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top - 100
                        }, 500);
                    }
                },
                rules: Object.assign({}, commonValidationRules, additionalRules),
                messages: {
                    case_reference: {
                        required: "This field is required.",
                        caseReferenceExists: "This case reference already exists.",
                        caseReferenceFormat: "Only uppercase letters, numbers, slashes, and hyphens are allowed."
                    },
                    contact_person_name: "Please enter the Contact Person Name.",
                    salutation: "This field is required.",
                    policy_number: "Please enter the Policy Number.",
                    contact_person_mobile: {
                        required: "Please enter the Contact Person Mobile.",
                        digits: "Please enter a valid mobile number.",
                        minlength: "Mobile number must be 10 digits.",
                        maxlength: "Mobile number must be 10 digits."
                    },
                    address: {
                        required: "This field is required."
                    },
                    state: {
                        required: "This field is required."
                    },
                    location_of_survey: {
                        required: "Please enter the Pincode.",
                        digits: "Please enter only numbers.",
                        minlength: "Pincode must be 6 digits.",
                        maxlength: "Pincode must be 6 digits."
                    },
                    whatsapp_number: {
                        digits: "Please enter a valid mobile number.",
                        minlength: "Mobile number must be 10 digits.",
                        maxlength: "Mobile number must be 10 digits."
                    },
                    claim_handler: {
                        required: "This field is required."
                    },
                    available_at_location: {
                        required: "This field is required."
                    },
                    payment_type: {
                        required: "This field is required."
                    },
                    affected_person: {
                        required: "This field is required."
                    },
                    vehicle_number: {
                        required: "This field is required."
                    },
                    loss_data: {
                        required: "This field is required."
                    },
                    consignor: {
                        required: "This field is required."
                    },
                    valuation_type: {
                        required: "This field is required."
                    },
                    firm_name: {
                        required: "This field is required."
                    }
                },
                submitHandler: function (form) {
                    let formData = new FormData(form);

                    // Additional processing
                    let natureOfJob = $('.natureofjob').val();
                    if (natureOfJob) {
                        formData.append('natureofjob', natureOfJob);
                    } else {
                        alert("Nature of job is missing.");
                        return;
                    }

                    let typeOfVehicle = $('.type_of_vehicle option:selected').text().trim();
                    formData.append('type_of_vehicle', typeOfVehicle);

                    let causeloss = $('.cause_loss option:selected').text().trim();
                    formData.append('cause_loss', causeloss);

                    $('.invoiceContainer .row').each(function (index, element) {
                        var invoicenumber = $(element).find('[name="invoicenumber[]"]').val();
                        var invoicedate = $(element).find('[name="invoicedate[]"]').val();

                        formData.append(`invoices[${index}][invoicenumber]`, invoicenumber || '');
                        formData.append(`invoices[${index}][invoicedate]`, invoicedate || '');
                    });

                    $(form).find('button[type="submit"]').prop('disabled', true);

                    $.ajax({
                        url: submitUrl, // Dynamic URL
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status === 200) {
                                let encryptedUrl = response.data.url;

                                console.log(encryptedUrl);

                                $('.success-alert').fadeIn();

                                setTimeout(function () {
                                    $('.success-alert').fadeOut('slow');
                                    window.location.href = "<?= base_url('calculateamount'); ?>?data=" + encodeURIComponent(encryptedUrl);
                                }, 1000);
                            } else {
                                $("#error_message").text(response.message).css('color', 'red').show();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            $("#error_message").text('Something went wrong. Please try again.').css('color', 'red').show();
                        }
                    });
                }
            });
        }

        // Handle form submit button clicks
        function handleFormSubmit(buttonSelector, formSelector, actionValue) {
            $(document).on('click', buttonSelector, function (e) {
                e.preventDefault();
                $('.button_action').val(actionValue);
                $(formSelector).submit();
            });
        }

        // Form definitions
        const formMappings = [
            {
                form: '#ebdeathform_indivi',
                buttons: ['#ebdeathform_indivi_with_form'],
                actions: ['with_form'],
                url: '<?= base_url('ebdeath_indivi'); ?>',
                additionalRules: {
                    policy_number: { required: true }
                }
            },
            {
                form: '#motorspotindiviform',
                buttons: ['#motorspotindivi_with_form'],
                actions: ['with_form'],
                url: '<?= base_url('motorspotsurvey_indivi'); ?>',
                additionalRules: {
                    policy_number: { required: true }
                }
            },
            {
                form: '#assetvaluation_indivi',
                buttons: ['#assetvaluation_indivi_with_form'],
                actions: ['with_form'],
                url: '<?= base_url('assetvaluation_indivi'); ?>',
                additionalRules: {
                    policy_number: { required: true }
                }
            },
            {
                form: '#marinepredis_indiv',
                buttons: ['#marinepredis_indiv_form'],
                actions: ['with_form'],
                url: '<?= base_url('marinepredis_indivi'); ?>',
                additionalRules: {
                    policy_number: { required: true }
                }
            }
        ];

        // Initialize validations and button handlers
        formMappings.forEach(({ form, buttons, actions, url, additionalRules }) => {
            initializeFormValidation(form, url, additionalRules || {});
            buttons.forEach((btn, index) => {
                handleFormSubmit(btn, form, actions[index]);
            });
        });

        // Show/hide fields based on 'type_of_vehicle'
        $('.type_of_vehicle').change(function() {
            if ($(this).val() === 'other') {
                $('.other_type_container').show();
            } else {
                $('.other_type_container').hide();
            }
        });


        function updateInvoiceLabels() {
            invoiceCounter = 1;
            $('.invoiceContainer .form-group.row').each(function () {
                $(this).find('.label-text').text(`Invoice ${invoiceCounter}`);
                invoiceCounter++;
            });
        }

        // Remove invoice row on button click
        $(document).on('click', '.remove-invoice-btn', function () {
            $(this).closest('.form-group.row').remove();
            updateInvoiceLabels();
        });

    });

       
</script>
