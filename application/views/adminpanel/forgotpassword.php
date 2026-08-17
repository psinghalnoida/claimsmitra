<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>Claims Mitra | Forgot Password</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/morris.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-jvectormap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/horizontal-timeline.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dropzone.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert-overrides.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ion.rangeSlider.skinFlat.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/steps.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    
    <!-- Page Level Stylesheets -->

    <style type="text/css">
        .title{
          margin-top:20px;
          font-size:20px;
          text-align: center;
          color: #2bb3c0;
        }

        .customBtn{
          border-radius:0px;
          padding:10px;
        }

        .otp{
          display:inline-block;
          width:50px;
          height:50px;
          text-align:center;
        }
    </style>

</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Forgot Password Page Start -->
        <div class="m-account-w" data-bg-img="<?php echo base_url();?>assets/img/account/wrapper-bg.jpg">
            <div class="m-account" style="max-width:920px">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Forgot Password Content Start -->
                        <div class="m-account--content-w" data-bg-img="<?php echo base_url();?>assets/img/account/content-bg.jpg">
                            <div class="m-account--content">
                                <h2 class="h2">Have an account?</h2>
                                <a href="<?php echo base_url('home');?>" class="btn btn-rounded">Login Now</a>
                            </div>
                        </div>
                        <!-- Forgot Password Content End -->
                    </div>

                    <div class="col-md-6">
                        <!-- Forgot Password Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                               <!-- Logo Start -->
                                <div class="logo">
                                    <img src="<?php echo base_url();?>assets/img/account/logo.png" alt="">
                                    <h2 class="h2">Claims Mitra</h2>
                                </div>
                                <!-- Logo End -->
                            <form id="forgotForm" method="post" style="background-color: #1b2223; width: 100%; margin: 0px; padding: 0px;">
                                <label class="m-account--title">Forgot Passcode?</label>
                                <div class="mobile_email" style="display: block;">
                                    <div id="alert_message_registration">
                                    </div>
                                    <label style="margin-bottom: 10px;">Enter Mobile Number</label>
                                    <p>
                                        <input type="text" id="mobile" name="mobile" placeholder="Mobile Number" class="form-control" onfocus="this.removeAttribute('readonly');" readonly >
                                    </p>
                                    <div style="overflow:auto; margin-top: 40px;">
                                        <button type="button" id="forgot_password" class="btn btn-block btn-rounded btn-info">Send OTP</button>
                                    </div>
                                </div>
                                <div class="otpverification" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-md-6">
                                            <div class="text-center mb-4" id="fourdigitotp" data-autosubmit="true">
                                                <h5>Please enter the 4-digit verification code we sent via SMS:</h5>
                                                <input type="text" style="background-color:#1b2223; color:white;" id="digit-1" name="digit-1" maxlength="1" class="otpfield" data-next="digit-2">
                                                <input type="text" style="background-color:#1b2223; color:white;" id="digit-2" name="digit-2" maxlength="1" class="otpfield" data-next="digit-3" data-previous="digit-1">
                                                <input type="text" style="background-color:#1b2223; color:white;" id="digit-3" name="digit-3" maxlength="1" class="otpfield" data-next="digit-4" data-previous="digit-2">
                                                <input type="text" style="background-color:#1b2223; color:white;" id="digit-4" name="digit-4" maxlength="1" class="otpfield" data-previous="digit-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-md-6">
                                            <div class="text-center mb-4">
                                                <h5>Don't receive the code? Resend in <span class="js-timeout"> 2:00</span></h5>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="row align-items-center" id="resend" style="display:none" >
                                        <div class="col-lg-12 col-md-6">
                                            <div class="text-center mb-4">
                                                <button type="button" id="resendBtn" >Resend</button>
                                            </div>
                                        </div>        
                                    </div>
                                    <div style="overflow:auto; margin-top: 40px;">
                                        <button type="button" id="otp_verify" class="btn btn-block btn-rounded btn-info">Verify OTP</button>
                                    </div>
                                </div>

                                <div class="passcode" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-md-6">
                                            <div class="text-center mb-4" id="passcode" data-autosubmit="true">
                                                <h5>Enter four digit passcode</h5>
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-1" name="passcode-1" maxlength="1" class="otpfield" data-next="passcode-2">
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-2" name="passcode-2" maxlength="1" class="otpfield" data-next="passcode-3" data-previous="passcode-1">
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-3" name="passcode-3" maxlength="1" class="otpfield" data-next="passcode-4" data-previous="passcode-2">
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-4" name="passcode-4" maxlength="1" class="otpfield" data-previous="passcode-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-md-6">
                                            <div class="text-center mb-4" id="confpasscode" data-autosubmit="true">
                                                <h5>Confirm passcode</h5>
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="confpasscode-1" name="confpasscode-1" maxlength="1" class="otpfield" data-next="confpasscode-2">
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="confpasscode-2" name="confpasscode-2" maxlength="1" class="otpfield" data-next="confpasscode-3" data-previous="confpasscode-1">
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="confpasscode-3" name="confpasscode-3" maxlength="1" class="otpfield" data-next="confpasscode-4" data-previous="confpasscode-2">
                                                <input type="Password" style="background-color:#1b2223; color:white;" id="confpasscode-4" name="confpasscode-4" maxlength="1" class="otpfield" data-previous="confpasscode-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="overflow:auto; margin-top: 40px;">
                                        <button type="button" id="reset_passcode" class="btn btn-block btn-rounded btn-info">Reset Passcode</button>
                                    </div>
                                </div>
                            </form>
                                <div class="m-account--footer">
                                    <p>&copy; 2022 Claims Mitra</p>
                                </div>
                                
                            </div>
                        </div>
                        <!-- Forgot Password Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Forgot Password Page End -->
    </div>
    <!-- Wrapper End -->
    <!-- Scripts -->
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/raphael.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/morris.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-jvectormap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/horizontal-timeline.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.steps.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dropzone.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/ion.rangeSlider.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
    <script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/sweetalert-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
/**
 * Mobile field with country code
 */
const phoneInputField = document.querySelector("#mobile");
const phoneInput = window.intlTelInput(phoneInputField, {
   utilsScript:
   "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    onlyCountries: ["in"], // Restrict to India only
    initialCountry: "in", // Set default country to India
    // separateDialCode: true, // Show the dial code separately
    nationalMode: false, // Use full international number format
   geoIpLookup: function(callback) {
    callback('in');
}
});
$('#forgot_password').on('click',function(e){
    var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
    var input = iti.getNumber();
    $.ajax({
        url: 'userforgotpassword',
        method:"POST",
        dataType:"json",
        data: {mobileoremail:input},
        success: function(response){
           if(response.status === 200){
            $(".mobile_email").css("display", "none");
            $(".otpverification").css("display", "block");
            }else{
            swal({
                title:"Failed",
                type: "warning",
                text: response.message,
                confirmButtonColor: "#D22B2B"
                });
            }
        }
    })
});
$('#otp_verify').on('click',function(e){
    var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
    var input = iti.getNumber();
    var otp = [document.getElementById("digit-1").value, document.getElementById("digit-2").value, document.getElementById("digit-3").value, document.getElementById("digit-4").value].join("");    
    $.ajax({
        url: 'otpverification',
        method:"POST",
        dataType:"json",
        data: {mobile:input, otp:otp},
        success: function(response){
            if(response.status === 200){
                $(".otpverification").css("display", "none");
                $(".passcode").css("display", "block");
            }else{
                swal({
                title:"Failed",
                type: "warning",
                text: response.message,
                confirmButtonColor: "#D22B2B"
                });
            }
        }
    })
});

$('#reset_passcode').on('click',function(e){
    var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
    var input = iti.getNumber();
    console.log(input);
    var passcode = [document.getElementById("passcode-1").value, document.getElementById("passcode-2").value, document.getElementById("passcode-3").value, document.getElementById("passcode-4").value].join("");    
    var confpasscode = [document.getElementById("confpasscode-1").value, document.getElementById("confpasscode-2").value, document.getElementById("confpasscode-3").value, document.getElementById("confpasscode-4").value].join("");    
    if(passcode === confpasscode){
    $.ajax({
        url: 'resetPasscode',
        method:"POST",
        dataType:"json",
        data: {mobileoremail:input, passcode:passcode},
        success: function(response){
            if(response.status === 200 ){
                swal({
                    title:"Success",
                    type: "success",
                    text: response.message,
                    confirmButtonColor: "#04AA6D"
                    },function(result) {
                    if(result){
                       window.location.href = "home";
                    }
                  });
            }else{
                swal({
                    title:"Failed",
                    type: "warning",
                    text: response.message,
                    confirmButtonColor: "#D22B2B"
                    });
            }
        }
    })
    }else{
        swal({
            title:"Failed",
            type: "warning",
            text: "Password and Confirm Password doesn't match!",
            confirmButtonColor: "#D22B2B"
            });
    }
});

$('#fourdigitotp').find('input').each(function() {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function(e) {
        var parent = $($(this).parent());

        if(e.keyCode === 8 || e.keyCode === 37) {
            var prev = parent.find('input#' + $(this).data('previous'));
            
            if(prev.length) {
                $(prev).select();
            }
        } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
            var next = parent.find('input#' + $(this).data('next'));
            
            if(next.length) {
                $(next).select();
            } 
        }
    });
});

$('#passcode').find('input').each(function() {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function(e) {
        var parent = $($(this).parent());

        if(e.keyCode === 8 || e.keyCode === 37) {
            var prev = parent.find('input#' + $(this).data('previous'));
            
            if(prev.length) {
                $(prev).select();
            }
        } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
            var next = parent.find('input#' + $(this).data('next'));
            
            if(next.length) {
                $(next).select();
            } 
        }
    });
});

$('#confpasscode').find('input').each(function() {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function(e) {
        var parent = $($(this).parent());

        if(e.keyCode === 8 || e.keyCode === 37) {
            var prev = parent.find('input#' + $(this).data('previous'));
            
            if(prev.length) {
                $(prev).select();
            }
        } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
            var next = parent.find('input#' + $(this).data('next'));
            
            if(next.length) {
                $(next).select();
            } 
        }
    });
});
</script>
</body>
</html>
