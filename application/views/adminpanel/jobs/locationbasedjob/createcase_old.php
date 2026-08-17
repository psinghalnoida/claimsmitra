


<?php $this->load->view('adminpanel/layout/sidebar');?>
<style>
 .scroll-container {
    height: 200px; /* Set the height of the container */
    overflow-y: auto; /* Enable vertical scrollbar */
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


</style>
<!-- Main Container Start -->
<main class="main--container">
<!-- Tab Content Start -->
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab11">
        <section class="page--header" style="margin:15px;">
            <div class="container-fluid" style="padding-right:7px;">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">LOCATION BASED JOB</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                            <li class="breadcrumb-item active"><span>Create new case</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6" style="text-align:right; align-self: center;">
                        <a href="<?php echo base_url('nonlocationoutgoing');?>"  class="btn btn-rounded btn-success">All Cases</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="main--content">
            <div class="container-fluid">
                <div class="row gutter-20">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-content">
                                <div class="form-group row">
                                    <span class="label-text col-lg-3 col-form-label">Nature of Job <a href="javascript:void(0)" id="pricingdata">See Pricing</a></span>
                                        <div class="col-lg-9">
                                            <select name="nature_of_job" id="nature_of_job"   class="form-control">
                                                <?php foreach ($listofjobs as $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['investigator_type'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                </div>
                                <form id="inspectionform"  method="post" enctype="multipart/form-data" style="display:none" >
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Name</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Contact Person Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Mobile</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Contact Person Mobile Number" class="form-control">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Name of Vehicle Owner</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_vehicle_owner" id="name_of_vehicle_owner" placeholder="Name of Vehicle Owner" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Vehicle Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="vehicle_number" id="vehicle_number" placeholder="Vehicle Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="policy_number" id="policy_number" placeholder="Policy Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Location of Survey</span>
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Location of Survey" class="form-control">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-rounded btn-info">Get Location</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Cause of Loss</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="cause_of_loss" id="cause_of_loss" placeholder="Cause of Loss" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Name of Workshop</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_workshop" id="name_of_workshop" placeholder="Name of Workshop (Required only in case of Final Survey)" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Name of Workshop Advisor</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_advisor" id="name_of_advisor" placeholder="Name of Workshop Advisor (Required only in case of Final Survey)" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Instructions</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="instruction" id="instruction" placeholder="Instruction (if any)" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Observations by Surveyor</span>
                                        <div class="col-lg-9">
                                            <textarea type="text" name="observation_by_surveyor" id="observation_by_surveyor" placeholder="Type your text here..." class="form-control"> </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="padding-right:0px">
                                        <button type="button" id="submitDocTranslation" class="btn btn-rounded btn-success">Calculate Amount</button>
                                    </div>
                                </form>

                                <form id="surveyform" method="post" enctype="multipart/form-data" style="display:block">
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Name</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Contact Person Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Mobile</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Contact Person Mobile Number" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Name of Owner of Goods</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_owner_of_goods" id="name_of_owner_of_goods" placeholder="Name of Owner of Goods" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Commodity</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="commodity" id="commodity" placeholder="Commodity" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="policy_number" id="policy_number" placeholder="Policy Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Conveyance</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="conveyance" id="conveyance" placeholder="Conveyance" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Invoice Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="invoice_number" id="invoice_number" placeholder="Invoice Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">GR/BL/AWB/RR Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="gr_br_awb_rr_number" id="gr_br_awb_rr_number" placeholder="GR/BL/AWB/RR Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Location of Survey</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Location of Survey" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-rounded btn-info">Go!</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Cause of Loss</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="cause_of_loss" id="cause_of_loss" placeholder="Cause of Loss" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Instructions</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="instruction" id="instruction" placeholder="Instruction (if any)" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Observations by Surveyor</span>
                                        <div class="col-lg-9">
                                            <textarea type="text" name="observation_by_surveyor" id="observation_by_surveyor" placeholder="Type your text here..." class="form-control"> </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="padding-right:0px">
                                        <button type="button" id="submitDocTranslation" class="btn btn-rounded btn-success">Calculate Amount</button>
                                    </div>
                                </form>

                                <form id="cattlesurveyform" method="post" enctype="multipart/form-data" style="display:block">
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Name</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Full Name" class="form-control" oninput="capitalizeFirstLetter(this);">


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Mobile</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Mobile Number (Please Enter Whatsapp number for further update)" class="form-control" oninput="limitInputLength(this, 10);">

                                            <div id="error_message" style="color: red;"></div>


                                        </div>



                                    </div>


                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Are you available at location?</span>
                                        <div class="col-lg-9">
                                            <select class="form-control" id="available_at_location" name="available_at_location">
                                                <option value="">Select option</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="whatsapp_no" style="display:none">
                                        <span class="label-text col-lg-3 col-form-label">Enter WhatsApp Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Enter Whatsapp Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row" id="vehicle_no">
                                        <span class="label-text col-lg-3 col-form-label">Name of beneficiary</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_beneficiary" id="name_of_beneficiary" placeholder="Name of Beneficiary" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Animal Tag Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="animal_tag_number" id="animal_tag_number" placeholder="Animal Tag Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="policy_number" id="policy_number" placeholder="Policy Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Search Inspector</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="search_inspector" id="search_inspector" placeholder="Search Inspector" class="form-control"autocomplete="new-password">

                                            <input type="hidden" name="inspectorid" id="inspectorid" class="form-control">
                                            <div id="searchResults"></div>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Location of Survey</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Location of Survey" class="form-control">
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Instructions</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="instruction" id="instruction" placeholder="Instruction (if any)" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer" style="padding-right:0px;">
                                        <button type="submit" class="btn btn-rounded btn-success" id="btn_cattle_form">Submit</button>
                                    </div>
                                </form>

                                <form id="investigation" method="post" enctype="multipart/form-data" style="display:block">
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Contact Person Name</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Full Name" class="form-control">
                                        </div>
                                    </div>
                                   <div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Contact Person Mobile</span>
    <div class="col-lg-9">

      <<input type="text" name="contact_person_mobile" id="contact_person_mobile" placeholder="Mobile Number" class="form-control" maxlength="10">



</div>
                                    <div class="form-group row" id="vehicle_no" style="display:none">
                                        <span class="label-text col-lg-3 col-form-label">Name of Employer</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_employer" id="name_of_employer" placeholder="Name of Employer" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Name of Affected Person</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="name_of_affected_person" id="name_of_affected_person" placeholder="Name of Affected Person" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Nature of Assignment</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="nature_of_assignment" id="nature_of_assignment" placeholder="Nature of Assignment" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Policy Number</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="policy_number" id="policy_number" placeholder="Policy Number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Location of Survey</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="location_of_survey" id="location_of_survey" placeholder="Location of Survey" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Instructions</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="instruction" id="instruction" placeholder="Instruction (if any)" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Observations by Surveyor</span>
                                        <div class="col-lg-9">
                                            <textarea type="text" name="observation_by_surveyor" id="observation_by_surveyor" placeholder="Type your text here..." class="form-control"> </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="padding-right:0px;">
                                        <button type="button" class="btn btn-rounded btn-success" id="btn_calculate" disabled>Calculate Amount</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('adminpanel/jobs/modal/pricinglist');?>
<?php $this->load->view('adminpanel/layout/footer');?>
<script>
function limitInputLength(input, maxLength) {
    // Remove non-numeric characters
    input.value = input.value.replace(/[^0-9]/g, '');
    // Limit to maxLength characters
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}
</script>

<script>
    //to start first letter of name capital
function capitalizeFirstLetter(input) {
    var name = input.value;
    // Check if the input is not empty and the first character is a lowercase letter
    if (name && name[0] === name[0].toLowerCase()) {
        // Capitalize the first letter
        input.value = name.charAt(0).toUpperCase() + name.slice(1);
    }
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    //name input field only take alphatic value
     document.getElementById('contact_person_name').addEventListener('input', function () {
        var input = this.value.replace(/[^a-zA-Z\s]/g, ''); // Allow alphabetic characters and spaces
        this.value = input.replace(/\b\w/g, function(char) { // Capitalize the first letter of each word
            return char.toUpperCase();
        });
    });

    document.getElementById('contact_person_name').addEventListener('keypress', function (event) {
        var charCode = event.which ? event.which : event.keyCode;
        if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode !== 32) {
            document.getElementById('error_message').textContent = "Only alphabetic characters and spaces are allowed.";
            return false;
        } else {
            document.getElementById('error_message').textContent = "";
            return true;
        }
    });
</script>



<script type="text/javascript">
$(document).ready(function(){
    $('#search_inspector').on('keyup', function(){
        var search_inspector = $('#search_inspector').val();
        $.ajax({
            url: "<?php echo base_url('cases/search_inspector'); ?>",
            type: "POST",
            dataType: "json",
            data: {search: search_inspector},
         success: function(data) {
    var html = '<div class="scroll-container"><ul>';
    $.each(data, function(index, item) {
        html += '<li class="inspectorOptions" id="'+item.id+ '">' + item.firstname + ' ' + item.lastname + ' ' + item.mobile + '</li>';
    });
    html += '</ul></div>';
    $('#searchResults').html(html);

    // Add event listener to each li element
    $('.inspectorOptions').click(function() {
        // Get the text content of the clicked li element
        var selectedText = $(this).text();
        var selectedId = $(this).attr('id');

        // Set the value of the input field to the selected text
        $('#search_inspector').val(selectedText);
        $('#inspectorid').val(selectedId);

        // Remove all li elements
        $('#searchResults').empty();
    });
}


        });
    });
});

var natureofjob ;
$(document).ready(function(){
    natureofjob = $("#nature_of_job option:selected").text();
    if(natureofjob == 'Motor Pre Insurance Inspection'){
        $('#inspectionform').css("display","block");
        $('#surveyform').css("display","none");
        $('#cattlesurveyform').css("display","none");
        $('#investigation').css("display","none");
    }
});

$('#available_at_location').on('change', function(){
    if($('#available_at_location').val() === "yes"){
        $('#whatsapp_no').css('display','none');
    }else if($('#available_at_location').val() === "no"){
        $('#whatsapp_no').css('display','flex');
    }
});
/* ------------------------------------------------------------------------- *
* SWITCH THE FORM OF NON LOCATION BASED JOB
* ------------------------------------------------------------------------- */
$('#nature_of_job').on('change',function(){
    natureofjob = $("#nature_of_job option:selected").text();
    if(natureofjob == 'Motor Pre Insurance Inspection' || natureofjob == 'Motor Spot Inspection' || natureofjob == 'Motor Final Survey' || natureofjob == 'Motor Theft Case'){
        $('#inspectionform').css("display","block");
        $('#surveyform').css("display","none");
        $('#cattlesurveyform').css("display","none");
        $('#investigation').css("display","none");
    }else if(natureofjob == 'Marine Spot Inspection' || natureofjob == 'Marine Final Survey' || natureofjob == 'Marine Predispatch Survey'){
        $('#surveyform').css("display","block");
        $('#inspectionform').css("display","none");
        $('#cattlesurveyform').css("display","none");
        $('#investigation').css("display","none");
    }else if(natureofjob == 'Cattle Pre Insurance Inspection'){
        $('#cattlesurveyform').css("display","block");
        $('#surveyform').css("display","none");
        $('#inspectionform').css("display","none");
        $('#investigation').css("display","none");
    }else if(natureofjob == 'Death Case Investigation' || natureofjob == 'EB Case Investigation'){
        $('#investigation').css("display","block");
        $('#cattlesurveyform').css("display","none");
        $('#surveyform').css("display","none");
        $('#inspectionform').css("display","none");
    }
});

    $('#cattlesurveyform').validate({
        rules: {
            contact_person_name: {
                required: true
            },
            contact_person_mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            name_of_beneficiary: {
                required: true
            },
            animal_tag_number: {
                required: true
            },
            policy_number: {
                required: true
            },
            available_at_location:{
                required: true
            },
            whatsapp_number:{
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            }
        },
        messages: {
            contact_person_name: {
                required: "Please enter the contact person's name"
            },
            contact_person_mobile: {
                required: "Please enter a mobile number",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Mobile number must be 10 digits",
                digits: "Please enter only digits"
            },
            name_of_beneficiary: {
                required: "Please enter the name of the beneficiary"
            },
            animal_tag_number: {
                required: "Please enter the animal tag number"
            },
            policy_number: {
                required: "Please enter the policy number"
            },
            available_at_location:{
                required: "Please select option"
            },
            whatsapp_number:{
                required: "Please enter a mobile number",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Mobile number must be 10 digits",
                digits: "Please enter only digits"
            }

        },
        submitHandler: function(form) {
            var job = $("#nature_of_job option:selected").val();
            var formData = $('#cattlesurveyform').serializeArray();
            formData.push({ name: 'natureofjob', value: job });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('cases/createlocationcase'); ?>', // Specify your backend endpoint here
                data: formData,
                dataType:'json',
                success: function(response) { 
                if (response.status === 200)
                {
                    var url = 'agreeforterms' + '?' + $.param({natureofjob: response.data.natureofjob,aid: response.data.aid,casetype:response.data.casetype});                    
                    window.location.href = url;
                }else{
                    swal({
                        title: "Failed!",
                        type: "warning",
                        text: response.message,
                        confirmButtonColor: "#D22B2B"
                        });
                }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        }
    });


$('#pricingdata').on('click', function() {
$("#pricinglist").modal('show'); 
/* ------------------------------------------------------------------------- *
* GET PRICING LIST
* ------------------------------------------------------------------------- */
var $recordsListView = $('#pricingtable');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        "serverSide":true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth": true,
        language: {
            searchPlaceholder: "Search Services"
        },
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('pricing'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}
});

$('#pricinglist').on('hidden.bs.modal', function () {
    $('#pricingtable').DataTable().destroy();
});

var totalPdfCount = 0;
var totalPages = 0;
var allfile = [];
$('#doctranslation').on('change', function() {
    if (window.File && window.FileList && window.FileReader) {
        var thumbnailsContainer = $('#translationdoc_thumb');
        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            allfile.push(files[i]);
            var filepath = files[i];
            var fileNameWithoutExtension = filepath.name.split('.').slice(0, -1).join('.');
            if (filepath.type === 'application/pdf') {
                totalPdfCount++;
                pdfjsLib.getDocument(URL.createObjectURL(event.target.files[i])).promise.then(function(pdf) {
                    totalPages += pdf.numPages;
                    updateTotals(totalPdfCount, totalPages);
                });
                var thumbnail = $('<div class="card" style="width: 8rem; text-align:center; margin-left:21px"><a class="image-container" href="' + URL.createObjectURL(event.target.files[i]) + '" ><div class="overlay"><button class="remove-button">Remove</button></div><img class="card-img-top" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF Thumbnail"></a><div class="card-body" style="padding:0px; line-height:initial"><span style="font-size:10px;">' + fileNameWithoutExtension + '</span></div></div>');
                
                thumbnailsContainer.append(thumbnail);
            }
        }
    } else {
        alert("Your browser doesn't support file preview.");
    }
});

// Delete image on click of delete button
$(".translationdoc_thumb").on('click', '.delete-button', function() {
    var index = $(this).data('index');
    $("#docfortranslation")[0].files.splice(index, 1);
    $(this).parent('.image-preview').remove();
});


$("#documenttranslationjobs").validate({
    rules: {
        language_list_from: "required",
        language_list_to: "required",
    },
    messages: {
        language_list_from: "Select Language",
        language_list_to: "Select Language",
    },
    submitHandler: function (form) {
        form.submit();
    }
});

function updateTotals(pdfCount, pageTotal) {
    $('#total-pdf-count').text(pdfCount);
    $('#total-pages').text(pageTotal);
}

$("#submitDocTranslation").on('click',function(event) {
    event.preventDefault();
    if($("#documenttranslationjobs").valid()){
        var form_data = new FormData(document.getElementById('documenttranslationjobs'));
        form_data.append('nature_of_job',document.getElementById('nature_of_job').value);
        for (var i = 0; i < allfile.length; i++) {
            form_data.append('docfortranslation[]', allfile[i]);
        }
        form_data.append('productname','Document Translation');
        form_data.append('totalfile', totalPdfCount);
        form_data.append('totalpages', totalPages);
        $.ajax({
            type: "POST",
            url: "nonlocationcase",
            dataType:"json",
            data: form_data,
            processData:false,
            contentType:false,
            success: function(response) {
                if (response.status === 200)
                {
                    var url = 'agreeforterms' + '?' + $.param({natureofjob: response.data.natureofjob, files: response.data.filedata['total-file'],pages: response.data.filedata['total-pages']});                    
                    window.location.href = url;
                }
                else{
                    swal({
                        title: "Failed!",
                        type: "warning",
                        text: response.message,
                        confirmButtonColor: "#D22B2B"
                        });
                }
            }
        });   
    } 
});

function agreetermsandcondition(){
    if ($('#check_terms').is(':checked')) {
        $('#btn_calculate').prop('disabled', false);
    } else {
        $('#btn_calculate').prop('disabled', true);
    }  
}

function paynow(){
    var amount = $('#total_amount').text();
    $.ajax({
        url: "<?php echo base_url('checkout');?>",
        dataType: "json",
        type: "POST",
        data: {amount:amount},
        success: function(response){
            window.open(response, '_blank');
        }
    })
}

var documents = [];
$('#uploadpdf').on('change', function() {
    if (window.File && window.FileList && window.FileReader) {
        var thumbnailsContainer = $('#pdf_thumb');
        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            documents.push(files[i]);
            var filepath = files[i];
            var fileNameWithoutExtension = filepath.name.split('.').slice(0, -1).join('.');
            if (filepath.type === 'application/pdf') {
                totalPdfCount++;
                pdfjsLib.getDocument(URL.createObjectURL(event.target.files[i])).promise.then(function(pdf) {
                    totalPages += pdf.numPages;
                    updateTotals(totalPdfCount, totalPages);
                });
                var thumbnail = $('<div class="card" style="width: 8rem; text-align:center; margin-left:21px"><a class="image-container" href="' + URL.createObjectURL(event.target.files[i]) + '" ><div class="overlay"><button class="remove-button">Remove</button></div><img class="card-img-top" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF Thumbnail"></a><div class="card-body" style="padding:0px; line-height:initial"><span style="font-size:10px;">' + fileNameWithoutExtension + '</span></div></div>');
                
                thumbnailsContainer.append(thumbnail);
            }
        }
    } else {
        alert("Your browser doesn't support file preview.");
    }
});

$("#otherjobs").validate({
    rules: {
        contact_person_name: "required",
        contact_person_mobile: "required",
        vehicleno: "required",
        pincode: "required"
    },
    messages: {
        contact_person_name: "Enter full name",
        contact_person_mobile: "Enter mobile no",
        vehicleno: "Enter Vehicle no",
        pincode: "Enter pincode"
    },
    submitHandler: function (form) {
        form.submit();
    }
});



$("#btn_calculate").on('click',function(event) {
    event.preventDefault();
    if($("#otherjobs").valid()){
        var form_data = new FormData(document.getElementById('otherjobs'));
        var state = $('#state').val();
        var city = $('#city').val();
        form_data.append('nature_of_job',document.getElementById('nature_of_job').value);
        for (var i = 0; i < documents.length; i++) {
            form_data.append('documents[]', documents[i]);
        }
        form_data.append('state',state);
        form_data.append('city',city);
        $.ajax({
            type: "POST",
            url: "nonlocationothercase",
            dataType:"json",
            data: form_data,
            processData:false,
            contentType:false,
            success: function(response) {
                if (response.status === 200)
                {
                    var url = 'agreeforterms' + '?' + $.param({natureofjob: response.data.natureofjob});                    
                    window.location.href = url;
                }
                else{
                    swal({
                        title: "Failed!",
                        type: "warning",
                        text: response.message,
                        confirmButtonColor: "#D22B2B"
                        });
                }
            }
        });   
    } 
});

/* ------------------------------------------------------------------------- *
* GET NON LOCATION JOB LIST
* ------------------------------------------------------------------------- */
/*$(document).ready(function(){
    $.ajax({
    url: "getnonlocationjob",
    dataType: "json",
    cache: false,
    type: "GET",
    success: function(response){
        $("#nature_of_job").empty();
        $("#nature_of_job").append('<option value="">None Selected</option>');
        for (let i = 0; i < response.data.length; i++) {
            $("#nature_of_job").append('<option value="'+ response.data[i].id +'">'+ response.data[i].investigator_type +'</option>');
        }
    }
    })
});*/

/* ------------------------------------------------------------------------- *
* AUTO POPULATE STATE AND CITY USING PINCODE
* ------------------------------------------------------------------------- */
$(document).ready(function(){
    search_pincode();
    function search_pincode(pincode)
    {
        $.ajax({
        url:"searchpincode",
        method:"POST",
        data:{pincode:pincode},
        dataType:'json',
        success:function(response){
            if(response.status === 200){
                $("#state").val(response.data.State);
                $("#city").val(response.data.City);
            }
        }
        })
    }
    $('#pincode').keyup(function(){
        var search = $(this).val();
        if(search != '' && search.length === 6)
        {
           search_pincode(search);
        }
        else
        {
           search_pincode();
        }
    });
}); 

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#case_tab a[href="' + activeTab + '"]').tab('show');
    }
});

/* ------------------------------------------------------------------------- *
* GET VENDOR LIST
* ------------------------------------------------------------------------- */
var $recordsListView = $('#vendorlist');
if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        columnDefs: [
        {
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }
        ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [[1, 'asc']],
        // Load data from an Ajax source
        /*"ajax": {
            url: "",
            type: "POST",
            dataType:"JSON",
        },*/
    });
}
</script>