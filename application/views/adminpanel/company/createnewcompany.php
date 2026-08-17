<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<!-- Main Container Start -->
<main class="main--container">
<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Company</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span>Create Company</span></li>
                </ul>
            </div>
            <div class="col-lg-6" style="text-align:right;">
                <a href="<?php echo base_url('company'); ?>"  class="btn btn-rounded btn-success">All Company</a>
            </div>
        </div>
    </div>
</section>
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-12">
            <!-- Panel Start -->
            <div class="panel">
                <div class="panel-content">
                    <form id="companyform" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Profession</span>
                            <div class="col-lg-9">
                                <div class="profile--panel" style="text-align: left;">
                                    <ul class="info nav" style="line-height:25px;padding:0px;font-size:14px;">
                                        <li>
                                            <i style="color:red; font-size:12px">*Can select only one</i>
                                            <?php foreach ($regulated as $key => $value) { ?>
                                                <div class="col-md-10">
                                                    <label class="form-check mr-3">
                                                        <input type="checkbox" name="regulated" value="1" onClick="ckChange(this)" id="<?php echo $value['profession'] ?>"  class="form-check-input">
                                                        <span class="form-check-label" style="font-weight: 400;"><?php echo $value['profession'] ?></span>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <i style="color:red; font-size:12px">*Can select more than one</i>
                                            <?php foreach ($unregulated as $key => $value) { ?>
                                                <div class="col-md-10">
                                                    <label class="form-check mr-3">
                                                        <input type="checkbox" name="unregulated" value="1" id="<?php echo $value['profession'] ?>"  class="form-check-input">
                                                        <span class="form-check-label" style="font-weight: 400;"><?php echo $value['profession'] ?></span>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                            <i style="color:green; font-size:12px">If suitable profession not found leave blank</i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Company Name</span>
                            <div class="col-lg-9">
                                <input type="text" style="text-transform:capitalize" name="companyName" id="companyName" placeholder="Company Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">PAN Number</span>
                            <div class="col-lg-9">
                                <input type="text" style="text-transform:uppercase" name="panNumber" id="panNumber" placeholder="PAN Number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">CIN Number</span>
                            <div class="col-lg-9">
                                <input type="text" style="text-transform:uppercase" name="cinNumber" id="cinNumber" placeholder="CIN Number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Company Website</span>
                            <div class="col-lg-9">
                                <input type="text" style="text-transform:lowercase;" name="companyWebsite" id="companyWebsite" placeholder="Company Website" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Company Admin</span>
                            <div class="col-md-5" >
                                <label class="form-check mr-3">
                                    <input type="checkbox" name="companyadmin" id="companyadmin" value="1" class="form-check-input">
                                    <span class="form-check-label">Do you want to add company admin?</span>
                                </label>
                            </div>
                        </div>

                        <div id="companyadminform" style="display:none">
                            <div class="form-group row">
                                <span class="label-text col-lg-3 col-form-label">Phone Number</span>
                                <div class="col-lg-9">
                                    <input type="text" name="adminPhone" id="adminPhone" placeholder="Phone Number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-rounded btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of the non location based job modal -->
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script>
/* ------------------------------------------------------------------------- *
* TOGGLE CASE ON ADD COMPANY ADMIN
* ------------------------------------------------------------------------- */
$(document).ready(function() {
    $("#companyadmin").click(function() {
        if( $(this).is(':checked')) {
            $("#companyadminform").show();
        } else {
            $("#companyadminform").hide();
        }
    });                 
});
/* ------------------------------------------------------------------------- *
* CHECK REGULATED PROFESSION
* ------------------------------------------------------------------------- */
function ckChange(ckType){
    var ckName = document.getElementsByName(ckType.name);
    var checked = document.getElementById(ckType.id);

    if (checked.checked) {
        for(var i=0; i < ckName.length; i++){

            if(!ckName[i].checked){
                ckName[i].disabled = true;
            }else{
                ckName[i].disabled = false;
            }
        } 
    }
    else {
        for(var i=0; i < ckName.length; i++){
            ckName[i].disabled = false;
        } 
    }    
}
/* ------------------------------------------------------------------------- *
* CREATE NEW COMPANY FORM VALIDATION
* ------------------------------------------------------------------------- */
$('form[id="companyform"]').validate({  
    rules: {  
      panNumber: 'required',  
      companyName: 'required',  
      cinNumber: 'required',  
      companyWebsite: {  
        required: true,  
        url: true,  
      } 
    },  
    messages: {  
      panNumber: 'This field is required',  
      companyName: 'This field is required',  
      cinNumber: 'This field is required',  
      companyWebsite: 'Enter a valid url',
    },  
    submitHandler: function(form) {  
      $.ajax({
        url: "createcompany",
        cache: false,
        dataType: "json",
        type:"POST",
        data:$("#companyform").serialize(),
        success: function(response) {
           
            }
        });
    }  
});   

/* ------------------------------------------------------------------------- *
* PAN CARD VALIDATION
* ------------------------------------------------------------------------- */
$('#panNumber').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
        load_data(search);
    }
    else
    {
        load_data();
    }
});
function load_data(query)
{
    $.ajax({
        url:"validatePanCard",
        method:"POST",
        dataType: "json",
        data:{query:query},
        success:function(response){
            console.log(respone);
        }
    });
}
</script>