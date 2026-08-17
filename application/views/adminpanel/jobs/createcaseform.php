<?php $this->load->view('adminpanel/layout/sidebar'); ?>

<style>
    .center-alert-container {
        display: flex;
        justify-content: center;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        width: 100%;
    }

    /* Style for the alert itself */
    #success-alert {
        width: auto;
        max-width: 90%;
        padding: 15px;
    }

    .scroll-container ul li {
        cursor: pointer;
    }

    .scroll-container {
        height: 200px;
        overflow-y: auto;
    }

    .scroll-container ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .scroll-container ul li {
        cursor: pointer;
    }

    .inspectorOptions {
        background-color: #b8b8b514;
        padding: 5px;
        border-bottom: 1px solid white;
    }

    .searchInspectorResults {
        position: absolute;
        background: #ffffff;
        border-radius: 4px;
        max-height: 129px;
        overflow-y: auto;
        width: 97.5%;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .searchInspectorResults ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .searchInspectorResults li {
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .searchInspectorResults li:hover {
        background-color: #f0f0f0;
    }

    .searchInspectorResults li.no-results {
        color: #999;
        text-align: center;
        padding: 10px;
    }
</style>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Tab Content Start -->
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab11">
            <section class="main--content" style="min-height:100vh; padding-top:0px;">
                <div class="container-fluid">
                    <div class="row gutter-20">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content mt-3">
                                    <input type="hidden" class="natureofjob" name="natureofjob" value="<?php echo intval($natureofjob); ?>">
                                    <?php $this->load->view('adminpanel/jobs/forms/' . $formname . ''); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php $this->load->view('adminpanel/jobs/modal/pricinglist'); ?>
    <?php $this->load->view('adminpanel/layout/footer'); ?>
    <script>
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

        $(document).ready(function() {
         
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


            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Event handler for input 
            $('.contact_person_name,.name_of_beneficiary,.name_of_insured,.name_of_consignee,.name_of_workshop,.name_of_advisor').on('input', function() {
                var currentVal = $(this).val();
                var newVal = capitalizeFirstLetter(currentVal);
                $(this).val(newVal);
            });

            // Show/hide fields based on the value of 'available_at_location'
            $('.available_at_location').change(function() {
                if ($(this).val() === 'no') {
                    $('.whatsapp_no').show();
                } else {
                    $('.whatsapp_no').hide();
                }
            });

            // Show/hide fields based on 'type_of_vehicle'
            $('#type_of_vehicle').change(function() {
                if ($(this).val() === 'other') {
                    $('#other_type_container').show();
                } else {
                    $('#other_type_container').hide();
                }
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
            
            // Reset button click event
            $('#btn_reset_form').on('click', function(e) {
                // Optional: Add any custom reset logic here
                // For example, you might want to clear any custom dynamic content
                $('#searchResults').empty(); // Clear search results
                $('.nature_of_job').empty(); // Clear nature of job table

                // Reset form fields to their default values
                $('#cattlesurveyform')[0].reset();
                $('#misscellaneousform')[0].reset();
                $('#marinespotform')[0].reset();

            });

             /* ------------------------------------------------------------------------- *
             * VALIDATE CASE REFERENCE
             * ------------------------------------------------------------------------- */

            $(document).on('keyup', 'input[name="case_reference"]', function() {
                $(this).val($(this).val().toUpperCase());
            }); 
             
            $.validator.addMethod("caseReferenceFormat", function(value, element) {
             return true; // Always return true, allowing any input
            }, "Invalid format! Recommended format");


           $.validator.addMethod("caseReferenceExists", function(value, element) {
            let isValid = false;

            // Perform synchronous AJAX validation
            $.ajax({
                url: "<?php echo base_url('checkreferenceexist'); ?>", // Backend endpoint
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

            $('#vehicle_number').on('input', function() {
                $(this).val($(this).val().toUpperCase());
            });

              $.validator.addMethod("atLeastOneFilled", function(value, element, params) {
                // Check if either the consignor or consignee is filled
                const consigneeFilled = $('#name_of_consignee').val().trim() !== "";
                const consignorFilled = $('#consignor').val().trim() !== "";
                const insuredFilled = $('#insured_name').val().trim() !== "";
                return consigneeFilled || consignorFilled || insuredFilled;
            }, "Please fill in at least one of the fields: Name of Consignee or Name of Consignor.");


            // Common validation rules for shared fields
            const commonValidationRules = {
                case_reference: {
                    required: true,
                    caseReferenceExists: true
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
                address: {
                    required: true
                },
                claim_handler: {
                    required: true
                }
            };

            // Function to initialize form validation dynamically
            function initializeFormValidation(formSelector, additionalRules = {}) {
                $(formSelector).validate({
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
                    rules: Object.assign({}, commonValidationRules, additionalRules),
                    messages: {
                        case_reference: {
                            required: "This field is required.",
                            caseReferenceExists: "This case reference already exists."
                        },
                        contact_person_name: "Please enter the Contact Person Name.",
                        policy_number: "Please enter the Policy Number.",
                        contact_person_mobile: {
                            required: "Please enter the Contact Person Mobile.",
                            digits: "Please enter a valid mobile number.",
                            minlength: "Mobile number must be 10 digits.",
                            maxlength: "Mobile number must be 10 digits."
                        },

                        address: {
                            required: "This field is required.",
                        },
                        state: {
                            required: "This field is required.",
                        },
                        location_of_survey: {
                            required: "Please enter the Pincode.",
                            digits: "Please enter only numbers.",
                            minlength: "Pincode number must be 6 digits.",
                            maxlength: "Pincode number must be 6 digits."
                        },
                        whatsapp_number: {
                            digits: "Please enter a valid mobile number.",
                            minlength: "Mobile number must be 10 digits.",
                            maxlength: "Mobile number must be 10 digits."
                        },
                        address: {
                            required: "This field is required."
                        },
                        claim_handler: {
                            required: "This field is required."
                        }
                    },
                    submitHandler: function(form) {
                        let formData = new FormData(form);

                        // Additional data processing
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

                        $('#invoiceContainer .row').each(function(index, element) {
                            // Collect invoice number and date within the current row
                            var invoicenumber = $(element).find('[name="invoicenumber[]"]').val();
                            var invoicedate = $(element).find('[name="invoicedate[]"]').val();

                            // Append to FormData
                            formData.append('invoices[' + index + '][invoicenumber]', invoicenumber || '');
                            formData.append('invoices[' + index + '][invoicedate]', invoicedate || '');
                        });
                        // Disable the submit button to prevent duplicate submissions
                        $(form).find('button[type="submit"]').prop('disabled', true);

                        // Perform AJAX request
                        $.ajax({
                            url: '<?php echo base_url('jobdata'); ?>?data=' + encodeURIComponent('<?php echo $url; ?>'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.status === 200) {
                                    $('#success-alert').show();
                                    setTimeout(function() {
                                        $('#success-alert').fadeOut('slow');
                                        window.location.href = "<?php echo base_url('incomingassignment'); ?>?data=" + encodeURIComponent(response.data);
                                    }, 1000);
                                } else {
                                    alert(response.message || 'Failed to process the data.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: ", xhr.responseText);
                                alert("An error occurred while submitting the form. Please try again.");
                            },
                            complete: function() {
                                // Re-enable submit button
                                $(form).find('button[type="submit"]').prop('disabled', false);
                            }
                        });
                    }
                });
            }

            // Apply validation to all forms
            $(document).ready(function() {
                // Array of form IDs
                const formIds = [
                    'cattlesurveyform', 'misscellaneousform', 'marinespotform', 'marinefinalform',
                    'motorfinalform', 'motorspotform', 'motorvehicleform', 'engineeringform',
                    'firefinalform', 'agricultureform', 'aviationfinalform', 'backgroundcheckform',
                    'cattlepreform', 'ebdeathform', 'engineerpreform', 'fireforensicform',
                    'fireinsuranceform', 'forensicaccountingform', 'handwritingform',
                    'legalopinionform', 'lopfinalform', 'marinecargoform', 'marinehullform',
                    'marineclaimrecoveryform', 'marinepredisform', 'mediclaimform',
                    'medicalopinionform', 'motorforensicform', 'motorodform', 'motortpform',
                    'motorpreinsuform', 'pa_claim', 'projectpreform', 'salvagerecoveryform',
                    'technicalaccountsform', 'technicalengineerform', 'technicalinsuranceform',
                    'motorvehiclevalueform', 'fireinvestigationform','assetsvaluationform','risk_inspection'
                ];

                // Loop through all the forms by IDs
                formIds.forEach(formId => {
                    const formSelector = `#${formId}`;
                    let additionalRules = {};

                    // Customize validation rules for specific forms
                    if (formId === 'cattlesurveyform') {
                        additionalRules = {
                            animal_tag_number: {
                                required: true
                            }
                        };
                    } else if (formId === 'misscellaneousform') {
                        additionalRules = {
                            policyNumber: {
                                required: true
                            }
                        };
                    } else if (formId === 'marinefinalform') {
                        additionalRules = {
                            name_of_consignee: {
                                required: function() {
                                    return $('#consignor').val().trim() === "" && $('#insured_name').val().trim() === "";
                                }
                            },
                            consignor: {
                                required: function() {
                                    return $('#name_of_consignee').val().trim() === "" && $('#insured_name').val().trim() === "";
                                },
                                atLeastOneFilled: true
                            },
                            insured_name: {
                                required: function() {
                                    return $('#consignor').val().trim() === "" && $('#name_of_consignee').val().trim() === "";
                                },
                                atLeastOneFilled: true
                            }
                        };
                    }
                    initializeFormValidation(formSelector, additionalRules);
                });
            });


            function handleFormSubmit(buttonSelector, formSelector, actionValue) {
                $(document).on('click', buttonSelector, function(e) {
                    e.preventDefault();
                    $('.button_action').val(actionValue);
                    $(formSelector).submit();
                });
            }

            const formMappings = [{
                    form: '#marinepredisform',
                    buttons: ['#btn_marinepredis_form', '#btn_marinepredis_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#misscellaneousform',
                    buttons: ['#btn_misscellaneous_form', '#btn_misscellaneous_without_form'],
                    actions: ['with_payment', 'without_payment']
                },
                {
                    form: '#cattlesurveyform',
                    buttons: ['#btn_cattle_form', '#btn_cattle_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#marinespotform',
                    buttons: ['#btn_marinespot_form', '#btn_marinespot_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#marinefinalform',
                    buttons: ['#btn_marinefinal_form', '#btn_marinefinal_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#motorfinalform',
                    buttons: ['#btn_motorfinal_form', '#btn_motorfinal_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#motorspotform',
                    buttons: ['#btn_motorspot_form', '#btn_motorspot_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#motorvehicleform',
                    buttons: ['#btn_motorvehicle_form', '#btn_motorvehicle_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#engineeringform',
                    buttons: ['#btn_engineering_form', '#btn_engineering_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#firefinalform',
                    buttons: ['.btn-submit-with-form', '.btn-submit-without-form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#agricultureform',
                    buttons: ['#btn_agriculture_form', '#btn_agriculture_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#aviationfinalform',
                    buttons: ['#btn_aviationfinal_form', '#btn_aviationfinal_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#backgroundcheckform',
                    buttons: ['#btn_backgroundcheck_form', '#btn_backgroundcheck_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#fireinsuranceform',
                    buttons: ['#btn_fireinsurance_form', '#btn_fireinsurance_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#mediclaimform',
                    buttons: ['#btn_mediclaim_form', '#btn_mediclaim_without_form'],
                    actions: ['with_form', 'without_form']
                },
                {
                    form: '#technicalinsuranceform',
                    buttons: ['#btn_technicalinsurance_form', '#btn_technicalinsurance_without_form'],
                    actions: ['with_form', 'without_form']
                },
                 {
                    form: '#assetsvaluationform',
                    buttons: ['#assets_valuation_form', '#assets_valuation_without_form'],
                    actions: ['with_form', 'without_form']
                },
                 {
                    form: '#risk_inspection',
                    buttons: ['#btn_risk_inspectio_form', '#btn_risk_inspectio_without_form'],
                    actions: ['with_form', 'without_form']
                }
            ];

            // Loop through mappings to assign event handlers dynamically
            formMappings.forEach(({
                form,
                buttons,
                actions
            }) => {
                handleFormSubmit(buttons[0], form, actions[0]);
                handleFormSubmit(buttons[1], form, actions[1]);
            });

    });
    </script>