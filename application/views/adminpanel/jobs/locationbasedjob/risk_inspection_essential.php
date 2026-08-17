<div class="panel pb-4">
    <form id="risk_inspection_essentialform" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">ESSENTIAL DATA</h3>
            <div class="dropdown">
                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                <div class="button d-flex justify-content-end">
                    <a class="btn case_btn" type="button" target="_blank" style="display: <?php echo isset($essentialdata) ? "block" : "none"; ?>;" href="<?php echo base_url('cases/generate_ila/' . $aid . '/' . $companyid); ?>" id="generate_ila" style="padding-right: 5px; margin-right:8px;">Generate ILA</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo ILA" data-toggle="modal" href="javascript:void(0)" id="photo_sheet" style="padding-right: 5px; margin-right:8px;">ILA Images <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn open-modal" type="button" data-title="Photo Sheet" data-toggle="modal" href="javascript:void(0)" id="photo_ila" style="padding-right: 5px; margin-right:8px;">Photo Sheet <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                    <a class="btn case_btn" type="button" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" id="download_media" style="padding-right: 5px; margin-right:8px;">Download Media</a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <?php $this->load->view("adminpanel/jobs/include/vendor") ?>
            <div class="row ">
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="salutation" style="color:black">Salutation<span style="color:red">*</span></label>
                        <?php
                        $salutation = $essentialdata->salutation ?? $jobdata->salutation ?? '';
                        // Disable if a value exists
                        
                        ?>
                        <select class="form-control salutation editable-field" id="salutation" name="salutation" >
                            <option value="">Select Salutation</option>
                            <option value="Mr" <?= ($salutation == 'Mr') ? 'selected' : ''; ?>>Mr.</option>
                            <option value="Ms" <?= ($salutation == 'Ms') ? 'selected' : ''; ?>>Ms.</option>
                            <option value="Mrs" <?= ($salutation == 'Mrs') ? 'selected' : ''; ?>>Mrs.</option>
                            <option value="Other" <?= ($salutation == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_name" style="color:black">Contact Person Name<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_name) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_name) && !empty($essentialdata->contact_person_name)? $essentialdata->contact_person_name : (isset($jobdata->contact_person_name) ? $jobdata->contact_person_name : ""); ?>" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="contact_person_mobile" style="color:black">Contact Person Mobile<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->contact_person_mobile) ? "disabled" : ""; ?> value="<?php echo isset($essentialdata->contact_person_mobile) && !empty($essentialdata->contact_person_mobile)? $essentialdata->contact_person_mobile : (isset($jobdata->contact_person_mobile) ? $jobdata->contact_person_mobile : ""); ?>" id="contact_person_mobile" name="contact_person_mobile" placeholder="Contact Person Mobile" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nameInput" style="color:black">Case Reference &nbsp;<span style="color:red">*</span></label>
                        <input 
                        type="text" 
                        class="form-control editable-field" 
                        <?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) ? "disabled" : ""; ?> 
                        value="<?php echo isset($essentialdata->case_reference) && !empty($essentialdata->case_reference) 
                                        ? $essentialdata->case_reference 
                                        : (isset($jobdata->case_reference) ? $jobdata->case_reference : ""); ?>" 
                        name="case_reference" 
                        id="case_reference" 
                        placeholder="Case Reference">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Insured / Proposed</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insured_name) && !empty($essentialdata->insured_name)
                          ? $essentialdata->insured_name : (isset($jobdata->insured_name) ? $jobdata->insured_name : ""); ?>" id="insured_name" name="insured_name" placeholder="Name of Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_report" style="color: black;">Date of report &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->date_of_report) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->date_of_report) ? format_date($essentialdata->date_of_report, 'd-m-Y') : ""; ?>" id="date_of_report" name="date_of_report" placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Address of risk</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->address) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->address) && !empty($essentialdata->address)
                          ? $essentialdata->address : (isset($jobdata->address) ? $jobdata->address : ""); ?>" id="address" name="address" placeholder="Address of risk">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="visitdate" style="color:black">Date of Visit</label>
                        <input type="text" class="form-control editable-field appointment_date" <?php echo isset($essentialdata->visitdate) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->visitdate) && !empty($essentialdata->visitdate)
                          ? $essentialdata->visitdate : (isset($jobdata->visitdate) ? $jobdata->visitdate : ""); ?>" id="visitdate" name="visitdate" placeholder="Date of Visit">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black">Sum Insured</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->sum_insured) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->sum_insured) && !empty($essentialdata->sum_insured)
                          ? $essentialdata->sum_insured : (isset($jobdata->sum_insured) ? $jobdata->sum_insured : ""); ?>" id="sum_insured" name="sum_insured" placeholder="Sum Insured">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="risk_proposed" style="color:black">Type of risk proposed</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->risk_proposed) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->risk_proposed) && !empty($essentialdata->risk_proposed)
                          ? $essentialdata->risk_proposed : (isset($jobdata->risk_proposed) ? $jobdata->risk_proposed : ""); ?>" id="risk_proposed" name="risk_proposed" placeholder="Type of risk proposed">
                    </div>
                </div>
                 <!-- <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="valuation_type" style="color:black">Type of inspection</label>
                        
                         <?php
                        $salutation = $essentialdata->valuation_type ?? $jobdata->valuation_type ?? '';
                        ?>
                        <select class="form-control salutation editable-field" id="salutation" name="valuation_type" >
                            <option value="">Select Salutation</option>
                            <option value="Fire" <?= ($valuation_type == 'Fire') ? 'selected' : ''; ?>>Fire</option>
                            <option value="Engineering" <?= ($valuation_type == 'Engineering') ? 'selected' : ''; ?>>Engineering</option>
                            <option value="Project" <?= ($valuation_type == 'Project') ? 'selected' : ''; ?>>Project</option>
                        </select>
                    </div>
                </div> -->
                  
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insurer" style="color:black">Insurer</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->insurer) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->insurer) && !empty($essentialdata->insurer)
                          ? $essentialdata->insurer : (isset($jobdata->insurer) ? $jobdata->insurer : ""); ?>" id="insurer" name="insurer" placeholder="Insurer">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="broker_no" style="color:black">Broker No.</label>
                        <input type="text" class="form-control editable-field" <?php echo isset($essentialdata->broker_no) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->broker_no) && !empty($essentialdata->broker_no)
                          ? $essentialdata->broker_no : (isset($jobdata->broker_no) ? $jobdata->broker_no : ""); ?>" id="broker_no" name="broker_no" placeholder="Broker No.">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks</label>
                        <textarea class="form-control editable-field" <?php echo isset($essentialdata->remark) ? "disabled" : ""; ?> id="remark" placeholder="Remarks" name="remark"><?php echo isset($essentialdata->remark) ? htmlspecialchars($essentialdata->remark) : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn toggle-edit" type="button" value="<?php echo isset($essentialdata) ? "Edit" : "Next"; ?>" id="riskinspection_submit_btn">
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
       $("#riskinspection_submit_btn").click(function() {
            var editButtonText = $(this).val();
            if (editButtonText === "Next") {
                $("#generate_ila").css('display', 'none');
                $('#risk_inspection_essentialform').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Edit") {
                $(".venorbtn").removeClass('disabled');
                $(".venorbtn").css('opacity', '1');
                $(".editable-field").prop("disabled", false);
                $("#generate_ila").css('display', 'block');
                $(this).val("Update");
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            } else if (editButtonText === "Update") {
                $(".venorbtn").addClass('disabled');
                $(".venorbtn").css('opacity', '0.5');
                // Submit the form
                $("#generate_ila").css('display', 'block');
                $('#risk_inspection_essentialform').trigger('submit');
                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                $('#show_payment_card').removeClass('hidden').addClass('visibility');
            }
        });

        if ($("#riskinspection_submit_btn").val() === "Edit") {
          $(".disabledbtn").addClass('disabled-btn');
          $(".editable-field").prop("disabled", true);
          $('.other_proposer_policy').css('display', 'block');
          $('.visitdate').css('display', 'block');
        }else{
            $('.other_proposer_policy').css('display', 'none');
            $('.visitdate').css('display', 'none');
        }

       $("#risk_inspection_essentialform").validate({
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
                case_reference: {
                    required: true
                },
                 salutation: {
                    required: true
                },
                 contact_person_name: {
                    required: true
                },
                 contact_person_mobile: {
                    required: true
                }
                
            },
            messages: {
                case_reference: "Case reference is required",
                salutation: "This Field is required",
                contact_person_name: "This Field is required",
                contact_person_mobile: "This Field is required" 
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
                var aid = "<?php echo $aid; ?>";
                var natureofjob = "<?php echo $natureofjob; ?>";
                var formdata = new FormData(form);
                formdata.append('aid', aid);
                formdata.append('natureofjob', natureofjob);

                $.ajax({
                    url: '<?php echo base_url('assetsessential'); ?>',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            if ($('#show_policy_card').length) {
                                $('#show_policy_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_appointment_card').length) {
                                $('#show_appointment_card').removeClass('hidden').addClass('visibility');
                            }
                            if ($('#show_payment_card').length) {
                                $('#show_payment_card').removeClass('hidden').addClass('visibility');
                            }
                            $(".venor-btn").addClass("disabled-btn");
                            $(".venorbtn").addClass("disabled-btn");
                            $('#assets_valuation_submit').val("Edit");
                            $(".editable-field").prop("disabled", true);
                            $("#generate_ila").css('display', 'block');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred during the AJAX request:', error);
                    }
                });
            }
         });
     });
</script>

