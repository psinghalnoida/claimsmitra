<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container" style="height:100vh;">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <div class="container-fluid">
                <?php if ($natureofjob === 1) { ?>
                    <?php $this->load->view('adminpanel/jobs/templates/essentialdata/motorvehicletheft'); ?>
                <?php } else if ($natureofjob === 2) { ?>
                    <!-- Add view for natureofjob 2 -->
                <?php } else if ($natureofjob === 3) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_tp_essential'); ?>
                <?php } else if ($natureofjob === 4) { ?>
                    <!-- Add view for natureofjob 4 -->
                <?php } else if ($natureofjob === 5) { ?>
                    <!-- Add view for natureofjob 5 -->
                <?php } else if ($natureofjob === 6) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/fire_investigation_essential'); ?>
                    <!-- Add view for natureofjob 6 -->
                <?php } else if ($natureofjob === 7) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_cargo_essential'); ?>
                <?php } else if ($natureofjob === 8) { ?>
                    <!-- Add view for natureofjob 8 -->
                <?php } else if ($natureofjob === 9) { ?>
                    <!-- Add view for natureofjob 9 -->
                <?php } else if ($natureofjob === 10) { ?>
                    <!-- Add view for natureofjob 10 -->
                <?php } else if ($natureofjob === 11) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/mediclaim_investigation_essential'); ?>
                <?php } else if ($natureofjob === 12) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/ebdeathcase_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/ebdeathcase_casedata'); ?>
                <?php } else if ($natureofjob === 13) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/paclaim_essential'); ?>
                <?php } else if ($natureofjob === 14) { ?>
                    <!-- Add view for natureofjob 14 -->
                <?php } else if ($natureofjob === 15) { ?>
                    <!-- Add view for natureofjob 15 -->
                <?php } else if ($natureofjob === 16) { ?>
                    <!-- Add view for natureofjob 16 -->
                <?php } else if ($natureofjob === 17) { ?>
                    <!-- Add view for natureofjob 17 -->
                <?php } else if ($natureofjob === 18) { ?>
                    <!-- Add view for natureofjob 18 -->
                <?php } else if ($natureofjob === 19) { ?>
                    <!-- Add view for natureofjob 19 -->
                <?php } else if ($natureofjob === 20) { ?>
                    <!-- Add view for natureofjob 20 -->
                <?php } else if ($natureofjob === 21) { ?>
                    <!-- Add view for natureofjob 21 -->
                <?php } else if ($natureofjob === 22) { ?>
                    <!-- Add view for natureofjob 22 -->
                <?php } else if ($natureofjob === 23) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_prein_essential'); ?>
                    <!-- Add view for natureofjob 23 -->
                <?php } else if ($natureofjob === 24) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_predispatch_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_predis_casedata'); ?>
                <?php } else if ($natureofjob === 61) { ?>
                    <!-- Add view for natureofjob 61 -->
                <?php } else if ($natureofjob === 62) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_spot_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/motor_spot_casedata'); ?>
                <?php } else if ($natureofjob === 63) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marinespotinspection'); ?>
                <?php } else if ($natureofjob === 64) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/cattleessentialform'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/caseform'); ?>
                <?php } else if ($natureofjob === 65) { ?>
                    <?php $this->load->view('adminpanel/jobs/templates/essentialdata/motorfinalessential'); ?>
                <?php } else if ($natureofjob === 66) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marinefinal_essential'); ?>
                <?php } else if ($natureofjob === 67) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/fire_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 68) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/lop_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 69) { ?>
                    <!-- Not Complete-->
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/aviation_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 70) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/miscellaneous_final_essential'); ?>
                <?php } else if ($natureofjob === 71) { ?>
                    <!-- Add view for natureofjob 71 -->
                <?php } else if ($natureofjob === 72) { ?>
                    <!-- Not Complete-->
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/marine_hull_final_survey'); ?>
                <?php } else if ($natureofjob === 73) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/engeneering_final_survey_essential'); ?>
                <?php } else if ($natureofjob === 74) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/fire_insurance_pre_inspection'); ?>
                <?php } else if ($natureofjob === 75) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/engineering_preins_essential'); ?>
                <?php } else if ($natureofjob === 76) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/project_pre_inspection_essential'); ?>
                <?php } else if ($natureofjob === 77) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/assets_valuation_essential'); ?>
                <?php } else if ($natureofjob === 78) { ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/risk_inspection_essential'); ?>
                    <?php $this->load->view('adminpanel/jobs/locationbasedjob/risk_inspection_casedata'); ?>

                    <!-- Add view for natureofjob 76 -->
                <?php } ?>
            </div>
        </div>
    </div>

    <?php $this->load->view('adminpanel/layout/footer'); ?>
    <script>
        $(document).ready(function() {
            function capitalizeAllLetters(string) {
                return (string || '').toUpperCase();
            }
            $('.vehicle_no, .policyNumber, .fir_no, .case_reference').on('input', function() {
                const $this = $(this);
                const newVal = capitalizeAllLetters($this.val());
                $this.val(newVal);
            });

            $('.date_of_incident, .fir_date ,.registration_date, .insurancefrom, .insuranceto, .valid_up_to, .date_of_birth, .docs_validity, #date_of_theft,#date_intimation,#valid_up_to,#date_of_issue,#permit_date_of_issue,.grdate,.invoicedate, #survey_date,#loss_data,#consignment_date,.select_survey_date,.date_of_accident, .property_survey_date, .date_of_loss, #date_of_report, .date_of_report, #date_of_incident,#fir_date,#dateOfDisease,#report_date,#family_id,#health_issuance_date,#diseaseDate,#treatmentDate,#dateTimePostMortem, #dateTimePostMortem,.period_of_insurancemotor_final_essential_data, .appointment_date,.appointmentdate,#accident_date,#death_date,.policyNumberfrom,.policyNumberto').datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: null,
                changeYear: true,
                changeMonth: true,
                yearRange: '1900:+10',
                defaultDate: new Date(), // sets default date in the picker popup
                onSelect: function(selectedDate, instance) {}
            });

            function initializeDatepicker(buttonSelector, inputSelector) {
                $(document).on("click", buttonSelector, function(e) {
                    e.preventDefault();

                    // Initialize datepicker when clicking the button
                    $(inputSelector).datepicker({
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                        autoclose: true
                    }).datepicker("show");
                });

                // Allow manual typing in input field
                $(document).on("focus", inputSelector, function() {
                    $(this).off("focus"); // Prevent automatic reopening of datepicker
                });

                // Keep manually typed or selected date without reopening the datepicker
                $(document).on("change", inputSelector, function() {
                    let selectedDate = $(this).val();
                    $(this).val(selectedDate);
                });
            }

            initializeDatepicker(".fir_datebtn", ".fir_date");
            initializeDatepicker(".fir_datebtn", ".fir_date");
            initializeDatepicker(".register_datebtn", ".register_date");
            initializeDatepicker(".ofinstruction_btn", ".ofinstruction");
            initializeDatepicker(".permit_validity_btn", ".permitvalidity");
            initializeDatepicker(".authorization_from_btn", ".authorization_from");
            initializeDatepicker(".autharity_validity_btn", ".autharity_validity");
            initializeDatepicker(".pucdatebtn", ".pucdate");
            initializeDatepicker(".dateofsurveybtn", ".date_of_survey");
            initializeDatepicker(".dl_issuedatebtn", ".dl_issuedate");
            initializeDatepicker(".dlvaliditybtn", ".dlvalidity");
            initializeDatepicker(".dobbtn", ".dob");
            initializeDatepicker(".policy_number_to_btn", ".policy_number_to");
            initializeDatepicker(".policy_number_from_btn", ".policy_number_from");
            initializeDatepicker(".visit_date_btn", ".visit_date");
            initializeDatepicker(".permit_validity_from_btn", ".permit_validity_from");
            initializeDatepicker(".bol_date_btn", ".bol_date");
            initializeDatepicker(".be_date_btn", ".be_date");
            initializeDatepicker(".dispatch_date_btn", ".dispatch_date");
            initializeDatepicker(".reciept_date_btn", ".reciept_date");
            initializeDatepicker(".expected_dispatch_btn", ".expected_dispatch");
            initializeDatepicker(".report_date_btn", ".dateofreport");

            /* ------------------------------------------------------------------------- *
             * FIRST LETTER CAPITAL (KAJAL)
             * ------------------------------------------------------------------------- */
            // Function to capitalize the first letter of a string
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Event handler for input 
            $('.insured_name, .contact_person_name, .registered_owner,.police_station_name').on('input', function() {
                var currentVal = $(this).val();
                var newVal = capitalizeFirstLetter(currentVal);
                $(this).val(newVal);
            });

            $('#vehicle_number').on('input', function() {
                $(this).val($(this).val().toUpperCase());
            });

            $("#motor_theft_submit").click(function() {
                var editButtonText = $(this).val();
                if (editButtonText === "Next") {
                    $("#generate_ila").css('display', 'none');
                    $('#motor_theft_essential_form').trigger('submit');
                    $('#show_policy_card').removeClass('hidden').addClass('visibility');
                    $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                    $('#show_payment_card').removeClass('hidden').addClass('visibility');
                    $(".disabledbtn").addClass('disabled-btn');
                } else if (editButtonText === "Edit") {
                    $(".editable-field").prop("disabled", false);
                    $("#generate_ila").css('display', 'block');
                    $(this).val("Update");
                    $(".venorbtn").removeClass('disabled');
                    $(".venorbtn").css('opacity', '1');
                    $('#show_policy_card').removeClass('hidden').addClass('visibility');
                    $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                    $('#show_payment_card').removeClass('hidden').addClass('visibility');
                    $(".disabledbtn").removeClass('disabled-btn');
                } else if (editButtonText === "Update") {
                    $(".venorbtn").addClass('disabled');
                    $(".venorbtn").css('opacity', '0.5');
                    // Submit the form
                    $("#generate_ila").css('display', 'block');
                    $('#motor_theft_essential_form').trigger('submit');
                    $('#show_policy_card').removeClass('hidden').addClass('visibility');
                    $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                    $('#show_payment_card').removeClass('hidden').addClass('visibility');
                    $(".disabledbtn").addClass('disabled-btn');
                }

            });

            $("#motor_theft_essential_form").validate({
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
                        required: true,
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
                        required: true,
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
                        required: true,
                    },
                    case_reference: {
                        required: true
                    },
                    date_of_report: {
                        required: true
                    },
                    insurer: {
                        required: true
                    },
                    vehicle_no: {
                        required: true
                    },
                    account: {
                        required: true
                    },
                    policy_number: {
                        required: true
                    },
                    period_of_insurance: {
                        required: true
                    },
                    idv: {
                        required: true
                    },
                    register_no: {
                        required: true
                    },
                    registered_owner: {
                        required: true
                    },
                    time_of_incident: {
                        required: true
                    },
                    date_of_incident: {
                        required: true
                    },
                    brief_narration: {
                        required: true
                    },
                    fir_date: {
                        required: true
                    },
                    fir_no: {
                        required: true
                    },
                    police_station_name: {
                        required: true
                    },
                    appointment_date: {
                        required: true
                    },

                    vehicle_owner: {
                        required: true
                    },
                    name_of_insured: {
                        required: true
                    },
                    property_remarks: {
                        required: false // Optional field, adjust as needed
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
                        required: "This field is required",

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
                        required: "This field is required",

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
                        required: "This field is required",

                    },
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
                        required: "This field is required",

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
                        required: "This field is required",

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
                        required: "This field is required",

                    },
                    case_reference: {
                        required: "Please enter the Case Reference."
                    },
                    date_of_report: {
                        required: "Please select the Date of Report."
                    },
                    insurer: {
                        required: "Please select Insurance Company."
                    },
                    vehicle_no: {
                        required: "Please enter the Vehicle No."
                    },
                    account: {
                        required: "Please enter the Account."
                    },
                    policy_number: {
                        required: "Please enter the Policy Number."
                    },
                    period_of_insurance: {
                        required: "Please enter the Period of Insurance."
                    },
                    idv: {
                        required: "Please enter the IDV."
                    },
                    register_no: {
                        required: "Please enter the Register No."
                    },
                    registered_owner: {
                        required: "Please enter the Registered Owner."
                    },
                    time_of_incident: {
                        required: "Please enter Time of Incident."
                    },
                    date_of_incident: {
                        required: "Please enter the Date of Incident."
                    },
                    brief_narration: {
                        required: "Please enter the Brief narration of Incident."
                    },
                    fir_date: {
                        required: "Please select FIR date."
                    },
                    fir_no: {
                        required: "Please select FIR no."
                    },
                    police_station_name: {
                        required: "Please enter the Name of Police Station."
                    },
                    appointment_date: {
                        required: "Please enter the Date of Appointment."
                    },
                    vehicle_owner: {
                        required: "Please enter the Name of vehicle owner."
                    },
                    name_of_insured: {
                        required: "Please enter the Name of insured."
                    },
                    property_remarks: {
                        required: "Please enter Remarks."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.closest(".input-group").length) {
                        // Append the error after the input-group
                        element.closest(".input-group").after(error);
                    } else {
                        // Default placement
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var natureofjob = "<?php echo $natureofjob; ?>";
                    var formdata = new FormData();

                    // Collect all inputs from .essentialdata
                    var essentialObj = {};
                    $('.essentialdata').find('input[name], select[name], textarea[name]').each(function() {
                        const name = $(this).attr('name');
                        const type = $(this).attr('type');
                        if (!name) return;

                        if (type === 'checkbox') {
                            if (!essentialObj[name]) essentialObj[name] = [];
                            if ($(this).is(':checked')) essentialObj[name].push($(this).val());
                        } else if (type === 'radio') {
                            if ($(this).is(':checked')) essentialObj[name] = $(this).val();
                        } else {
                            essentialObj[name] = $(this).val();
                        }
                    });

                    // Collect all inputs from .casedata
                    var caseObj = {};
                    $('.casedata').find('input[name], select[name], textarea[name]').each(function() {
                        const name = $(this).attr('name');
                        const type = $(this).attr('type');
                        if (!name) return;

                        if (type === 'checkbox') {
                            if (!caseObj[name]) caseObj[name] = [];
                            if ($(this).is(':checked')) caseObj[name].push($(this).val());
                        } else if (type === 'radio') {
                            if ($(this).is(':checked')) caseObj[name] = $(this).val();
                        } else {
                            caseObj[name] = $(this).val();
                        }
                    });

                    // Append data
                    formdata.append('natureofjob', natureofjob);
                    formdata.append('essentialdata', JSON.stringify(essentialObj));
                    formdata.append('casedata', JSON.stringify(caseObj));

                    // Append ID if in edit mode
                    var existingId = $('[name="id"]').val();
                    if (existingId) {
                        formdata.append('id', existingId);
                    }

                    // AJAX call
                    $.ajax({
                        url: '<?php echo base_url('motortheftsessentialtemplate'); ?>',
                        type: 'POST',
                        data: formdata,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            const toastContainer = document.getElementById("toastContainer");
                            if (toastContainer) toastContainer.style.display = "block";

                            if (response.status == 200) {
                                if (toastContainer) {
                                    toastContainer.style.backgroundColor = "#d4edda";
                                    toastContainer.style.borderRadius = "6px";
                                    toastContainer.style.padding = "10px";
                                }

                                Toast.create("Success", response.message, TOAST_STATUS.SUCCESS, 4000);

                                $('#show_policy_card, #show_appointment_card, #show_payment_card')
                                    .removeClass('hidden')
                                    .addClass('visibility');

                                $(".venor-btn, .venorbtn").addClass("disabled-btn");
                                $('#motor_theft_submit').val("Edit");
                                $(".editable-field").prop("disabled", true);
                                $("#generate_ila").css('display', 'block');

                                if (response.id && !$('[name="id"]').length) {
                                    $('<input>').attr({
                                        type: 'hidden',
                                        name: 'id',
                                        value: response.id
                                    }).appendTo('#motor_theft_essential_form');
                                }

                            } else {
                                if (toastContainer) {
                                    toastContainer.style.backgroundColor = "#f8d7da";
                                    toastContainer.style.borderRadius = "6px";
                                    toastContainer.style.padding = "10px";
                                }
                                Toast.create("Error", response.message || "Something went wrong.", TOAST_STATUS.DANGER, 4000);
                            }

                            document.addEventListener("hidden.bs.toast", function() {
                                if (toastContainer && toastContainer.querySelectorAll(".toast.show").length === 0) {
                                    toastContainer.style.backgroundColor = "transparent";
                                    toastContainer.style.padding = "0";
                                    toastContainer.style.borderRadius = "0";
                                    toastContainer.style.display = "none";
                                }
                            });
                        },

                        error: function(xhr, status, error) {
                            console.error('Error occurred: ', error);
                        }
                    });
                }

            });


            /* ------------------------------------------------------------------------- *  
             * MOTOR FINAL ESSENTIAL FORM (KAJAL)
             * ------------------------------------------------------------------------- */

            $("#motor_final_submit").click(function() {
                var editButtonText = $(this).val();
                if (editButtonText === "Next") {
                    $(".disabledbtn").addClass('disabled-btn');
                    $("#generate_ila").css('display', 'none');
                    $('#motor_final_essential_data').trigger('submit');
                    $('#show_policy_card').removeClass('hidden').addClass('visibility');
                    $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                    $('#show_payment_card').removeClass('hidden').addClass('visibility');
                } else if (editButtonText === "Edit") {
                    $(".disabledbtn").removeClass('disabled-btn');
                    $(".venorbtn").removeClass('disabled');
                    $(".venorbtn").css('opacity', '1');
                    $(".editable-field").prop("disabled", false);
                    $("#generate_ila").css('display', 'block');
                    $(this).val("Update");
                    $('#show_policy_card').removeClass('hidden').addClass('visibility');
                    $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                    $('#show_payment_card').removeClass('hidden').addClass('visibility');
                } else if (editButtonText === "Update") {
                    $(".disabledbtn").addClass('disabled-btn');
                    $(".venorbtn").addClass('disabled');
                    $(".venorbtn").css('opacity', '0.5');
                    // Submit the form
                    $("#generate_ila").css('display', 'block');
                    $('#motor_final_essential_data').trigger('submit');
                    $('#show_policy_card').removeClass('hidden').addClass('visibility');
                    $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                    $('#show_payment_card').removeClass('hidden').addClass('visibility');
                }
            });

            if ($("#motor_final_essential_data").val() === "Edit") {
                $(".disabledbtn").addClass('disabled-btn');
                $(".editable-field").prop("disabled", true);
            }

            $("#motor_final_essential_data").validate({
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
                        required: true,
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
                        required: true,
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
                        required: true,
                    },
                    // Existing fields
                    case_reference: {
                        required: true
                    },
                    insurancefrom: {
                        required: true
                    },
                    insuranceto: {
                        required: true
                    },
                    any_fir: {
                        required: true
                    },

                    date_of_report: {
                        required: true
                    },
                    insured_name: {
                        required: true
                    },
                    policyNumber: {
                        required: true
                    },
                    sum_insured: {
                        required: true
                    },
                    register_no: {
                        required: true
                    },
                    make_model: {
                        required: true
                    },
                    name_of_driver: {
                        required: true
                    },
                    driving_license_no: {
                        required: true
                    },
                    place_of_accident: {
                        required: true
                    },
                    date_of_incident: {
                        required: true
                    },

                    survey_allotment_date: {
                        required: true
                    },
                    survey_date: {
                        required: true
                    },
                    survey_place: {
                        required: true
                    },
                    place_of_repairer: {
                        required: true
                    },
                    estimated_loss: {
                        required: true
                    },
                    reported_tp_loss: {
                        required: true
                    },
                    spot_survey_details: {
                        required: true
                    },

                    // New: Payment fields
                    payment_method: {
                        required: true
                    },
                    payment_reference: {
                        required: true
                    },
                    payment_date: {
                        required: true
                    },
                    payment_amount: {
                        required: true,
                        number: true
                    },

                    // New: Vendor fields
                    vendor_name: {
                        required: true
                    },
                    vendor_contact: {
                        required: true
                    },
                    vendor_address: {
                        required: true
                    },

                    // New: Appointment fields
                    appointment_date: {
                        required: true
                    },
                    appointment_time: {
                        required: true
                    },
                    appointment_location: {
                        required: true
                    }
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
                        required: "This field is required",

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
                        required: "This field is required",

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
                        required: "This field is required",

                    },
                    // Existing field messages
                    case_reference: "This field is required",

                    insuranceto: "This field is required",
                    insurancefrom: "This field is required",
                    any_fir: "This field is required",
                    date_of_report: "This field is required",
                    insured_name: "This field is required",
                    policyNumber: "This field is required",
                    sum_insured: "This field is required",
                    register_no: "This field is required",
                    make_model: "This field is required",
                    name_of_driver: "This field is required",
                    driving_license_no: "This field is required",
                    place_of_accident: "This field is required",
                    date_of_incident: "This field is required",
                    survey_allotment_date: "This field is required",
                    survey_date: "This field is required",
                    survey_place: "This field is required",
                    place_of_repairer: "This field is required",
                    estimated_loss: "This field is required",
                    reported_tp_loss: "This field is required",
                    spot_survey_details: "This field is required",

                    // New: Payment field messages
                    payment_method: "Please select a payment method",
                    payment_reference: "Please enter the payment reference",
                    payment_date: "Please select the payment date",
                    payment_amount: {
                        required: "Please enter the payment amount",
                        number: "Please enter a valid number"
                    },

                    // New: Vendor field messages
                    vendor_name: "Please enter the vendor name",
                    vendor_contact: "Please enter the vendor contact details",
                    vendor_address: "Please enter the vendor address",

                    // New: Appointment field messages
                    appointment_date: "Please select the appointment date",
                    appointment_time: "Please select the appointment time",
                    appointment_location: "Please enter the appointment location"
                },
                errorPlacement: function(error, element) {
                    if (element.closest(".input-group").length) {
                        // Append the error after the input-group
                        element.closest(".input-group").after(error);
                    } else {
                        // Default placement
                        error.insertAfter(element);
                    }
                },

                submitHandler: function(form) {
                    var natureofjob = "<?php echo $natureofjob; ?>";
                    console.log(natureofjob);
                    var formdata = new FormData();
                    var template_name = $('.template_name').text();
                     console.log(template_name);
                    // Collect all inputs from .essentialdata
                    var essentialObj = {};
                    $('.essentialdata').find('input[name], select[name], textarea[name]').each(function() {
                        const name = $(this).attr('name');
                        const type = $(this).attr('type');
                        if (!name) return;

                        if (type === 'checkbox') {
                            if (!essentialObj[name]) essentialObj[name] = [];
                            if ($(this).is(':checked')) essentialObj[name].push($(this).val());
                        } else if (type === 'radio') {
                            if ($(this).is(':checked')) essentialObj[name] = $(this).val();
                        } else {
                            essentialObj[name] = $(this).val();
                        }
                    });

                    // Collect all inputs from .casedata
                    var caseObj = {};
                    $('.casedata').find('input[name], select[name], textarea[name]').each(function() {
                        const name = $(this).attr('name');
                        const type = $(this).attr('type');
                        if (!name) return;

                        if (type === 'checkbox') {
                            if (!caseObj[name]) caseObj[name] = [];
                            if ($(this).is(':checked')) caseObj[name].push($(this).val());
                        } else if (type === 'radio') {
                            if ($(this).is(':checked')) caseObj[name] = $(this).val();
                        } else {
                            caseObj[name] = $(this).val();
                        }
                    });

                    // Append data
                    formdata.append('natureofjob', natureofjob);
                    formdata.append('template_name', template_name);
                    formdata.append('essentialdata', JSON.stringify(essentialObj));
                    formdata.append('casedata', JSON.stringify(caseObj));

                    // Append ID if in edit mode
                    var existingId = $('[name="id"]').val();
                    if (existingId) {
                        formdata.append('id', existingId);
                    }

                    // AJAX call
                    $.ajax({
                        url: '<?php echo base_url('motortheftsessentialtemplate'); ?>',
                        type: 'POST',
                        data: formdata,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            const toastContainer = document.getElementById("toastContainer");
                            if (toastContainer) toastContainer.style.display = "block";

                            if (response.status == 200) {
                                if (toastContainer) {
                                    toastContainer.style.backgroundColor = "#d4edda";
                                    toastContainer.style.borderRadius = "6px";
                                    toastContainer.style.padding = "10px";
                                }

                                Toast.create("Success", response.message, TOAST_STATUS.SUCCESS, 4000);

                                $('#show_policy_card, #show_appointment_card, #show_payment_card')
                                    .removeClass('hidden')
                                    .addClass('visibility');

                                $(".venor-btn, .venorbtn").addClass("disabled-btn");
                                $('#motor_theft_submit').val("Edit");
                                $(".editable-field").prop("disabled", true);
                                $("#generate_ila").css('display', 'block');

                                if (response.id && !$('[name="id"]').length) {
                                    $('<input>').attr({
                                        type: 'hidden',
                                        name: 'id',
                                        value: response.id
                                    }).appendTo('#motor_theft_essential_form');
                                }

                            } else {
                                if (toastContainer) {
                                    toastContainer.style.backgroundColor = "#f8d7da";
                                    toastContainer.style.borderRadius = "6px";
                                    toastContainer.style.padding = "10px";
                                }
                                Toast.create("Error", response.message || "Something went wrong.", TOAST_STATUS.DANGER, 4000);
                            }

                            document.addEventListener("hidden.bs.toast", function() {
                                if (toastContainer && toastContainer.querySelectorAll(".toast.show").length === 0) {
                                    toastContainer.style.backgroundColor = "transparent";
                                    toastContainer.style.padding = "0";
                                    toastContainer.style.borderRadius = "0";
                                    toastContainer.style.display = "none";
                                }
                            });
                        },

                        error: function(xhr, status, error) {
                            console.error('Error occurred: ', error);
                        }
                    });
                }
            });


        });
    </script>