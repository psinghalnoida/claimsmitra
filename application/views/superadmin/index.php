<?php $this->load->view('adminpanel/layout/head'); ?>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Login Page Start -->
        <div class="m-account-w" data-bg-img="<?php echo base_url();?>assets/img/account/wrapper-bg.jpg">
            <div class="m-account" style="max-width:920px;">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Login Content Start -->
                        <div class="m-account--content-w" data-bg-img="<?php echo base_url();?>assets/img/account/content-bg.jpg">                             
                            <div class="m-account--content">
                                <h2 class="h2">Welcome to Claims Mitra</h2>
                                <p></p>
                            </div>
                        </div>
                        <!-- Login Content End -->
                    </div>
                    <div class="col-md-6">
                        <!-- Login Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="<?php echo base_url();?>assets/img/account/logo.png" alt="">
                                    <h2 class="h2">Claims Mitra</h2>
                                </div>
                                <!-- Logo End -->
                                <form id="userLogin" action="<?php echo base_url('admin'); ?>" method="post" enctype="multipart/form-data">
                                    
                                    <div class="email_mobile" style="display: block;">
                                        <label class="m-account--title">Login to your account</label>
                                        <div id="alert_message_login"></div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="mobileoremail" id="loginmobile" placeholder="Mobile number" class="form-control" onfocus="this.removeAttribute('readonly');" readonly >
                                            </div>
                                        </div>
                                        <div class="m-account--actions">
                                            <button type="button" id="login_next" class="btn btn-block btn-rounded btn-info">Next</button>
                                        </div>
                                    </div>
                                    <div class="passcode" style="display: none;">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-md-6">
                                                <div class="text-center mb-4" id="loginpasscode" data-autosubmit="true">
                                                    <h5>Enter four digit passcode</h5>
                                                    <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-1" name="passcode-1" maxlength="1" class="otpfield" data-next="passcode-2" autocomplete="off">
                                                    <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-2" name="passcode-2" maxlength="1" class="otpfield" data-next="passcode-3" data-previous="passcode-1" autocomplete="off">
                                                    <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-3" name="passcode-3" maxlength="1" class="otpfield" data-next="passcode-4" data-previous="passcode-2" autocomplete="off"> 
                                                    <input type="Password" style="background-color:#1b2223; color:white;" id="passcode-4" name="passcode-4" maxlength="1" class="otpfield" data-previous="passcode-3" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="overflow:auto; margin-top: 16px;">
                                            <button type="submit" id="login" class="btn btn-block btn-rounded btn-info">Login</button>
                                        </div>
                                        <div style="text-align:center; margin-top:27px">
                                            <a href="<?php echo site_url('userforgotpassword');?>" class="btn-link">Forgot Passcode?</a>
                                        </div>
                                    </div>
                                    <div class="m-account--footer">
                                        <p>&copy; 2022 Claims Mitra</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Page End -->
    </div>
    <!-- Wrapper End -->


<div id="departmentModal" class="modal fade" style="margin-left: 17px;">
    <div class="modal-dialog" style="margin:0px;max-width:100%;width: 100vw;height:100vh;position: fixed;top: 0;left: 0; bottom:0; right:0">
        <div class="modal-content">
            <div class="modal-body" style="height:100vh;align-self:center;">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-size:20px;">Add Department</h3>
                </div>
                <div class="col-lg-12"  id="departmentContent">
                    <div id="departmentCheckboxes">
                        <p>No departments found.</p>
                    </div>
                    
                    <div style="text-align:end">
                        <button type="button" class="btn btn-rounded btn-success " id="nxtBtn">Next</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!------------Modal for department section End----------------->



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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>

<script>

    // starting name with capital letter
$(document).ready(function() {
    $('input[name="firstname"]').on('input', function() {
        var value = $(this).val();
        var capitalizedValue = value.charAt(0).toUpperCase() + value.slice(1);
        $(this).val(capitalizedValue);
    });
});

$(document).ready(function() {
    $('input[name="lastname"]').on('input', function() {
        var value = $(this).val();
        var capitalizedValue = value.charAt(0).toUpperCase() + value.slice(1);
        $(this).val(capitalizedValue);
    });
});


$('#login_next').on('click',function(e){
    var iti = window.intlTelInputGlobals.getInstance(mobileInputField);
    var input = iti.getNumber();
    var re = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
    var is_mobile = re.test(input);
    $.ajax({
        url: 'mobile_exist',
        method:"POST",
        dataType:"json",
        data: {mobileoremail:input},
        success: function(response){
           if(response.status === 200){
            $(".email_mobile").css("display", "none");
            $(".passcode").css("display", "block");
           }else{
            $('#alert_message_login').append('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
           }
        }
    })
});


// TO ALLOW ENTER KEY TO WORK AS NEXT BUTTON FOR LOGIN (BY NANDINI)
// $(document).ready(function() {
//     function handleLogin() {
//         var iti = window.intlTelInputGlobals.getInstance(mobileInputField);
//         var input = iti.getNumber();
//         var re = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
//         var is_mobile = re.test(input);

//         if (!is_mobile) {
//             $('#alert_message_login').html('<div class="alert alert-danger" role="alert">Invalid mobile number</div>');
//             return;
//         }

//         $.ajax({
//             url: 'mobile_exist',
//             method: "POST",
//             dataType: "json",
//             data: { mobileoremail: input },
//             success: function(response) {
//                 if (response.status === 200) {
//                     $(".email_mobile").css("display", "none");
//                     $(".passcode").css("display", "block");
//                 } else {
//                     $('#alert_message_login').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
//                 }
//             }
//         });
//     }

//     // Click event for the button
//     $('#login_next').on('click', function(e) {
//         handleLogin();
//     });

//     // Enter key press event on the input field
//     $('#userLogin').on('keydown', function(e) {
//         if (e.key === "Enter" || e.which === 13) {  // Handles both modern and older browsers
//             e.preventDefault(); // Prevent form submission
//             handleLogin();
//         }
//     });
// });


// validation on mobile number while register a user(BY NANDINI)
$('#mobile').on('input', function () {
    let value = $(this).val();

    // Check for non-digit characters
    if (/[^0-9]/.test(value)) {
        $('#alert_message_registration').html(
            '<div class="alert alert-danger" role="alert">Please enter digits only!</div>'
        );
        setTimeout(() => {
            $('#alert_message_registration').html('');
        }, 3000);

        // Remove invalid characters
        $(this).val(value.replace(/[^0-9]/g, ''));
    } else if (value.length > 10) {
        $('#alert_message_registration').html(
            '<div class="alert alert-danger" role="alert">Phone number cannot exceed 10 digits!</div>'
        );
        setTimeout(() => {
            $('#alert_message_registration').html('');
        }, 3000);
        // Trim the input to 10 digits
        $(this).val(value.slice(0, 10));
    }
});

// mobile validation while login (BY NANDINI)
$('#loginmobile').on('input', function () {
    let value = $(this).val();

    // Check for non-digit characters
    if (/[^0-9]/.test(value)) {
        $('#alert_message_login').html(
            '<div class="alert alert-danger" role="alert">Please enter digits only!</div>'
        );
        setTimeout(() => {
            $('#alert_message_login').html('');
        }, 3000);

        // Remove invalid characters
        $(this).val(value.replace(/[^0-9]/g, ''));
    } else if (value.length > 10) {
        $('#alert_message_login').html(
            '<div class="alert alert-danger" role="alert">Mobile number cannot exceed 10 digits!</div>'
        );
        setTimeout(() => {
            $('#alert_message_login').html('');
        }, 3000);

        // Trim the input to 10 digits
        $(this).val(value.slice(0, 10));
    }
});
$(document).ready(function() {
    // $('#login').on('click', function(e) {
    //     e.preventDefault(); // Prevent default action (if inside a form)

    //     var iti = window.intlTelInputGlobals.getInstance(mobileInputField);
    //     var input = iti.getNumber();
    //     var passcode = [
    //         document.getElementById("passcode-1").value,
    //         document.getElementById("passcode-2").value,
    //         document.getElementById("passcode-3").value,
    //         document.getElementById("passcode-4").value
    //     ].join("");

    //     $.ajax({
    //         url: 'user_login',
    //         method: "POST",
    //         dataType: "json",
    //         data: { mobileoremail: input, passcode: passcode },
    //         success: function(response) {
    //             if (response.status === 200) {
    //                 $('#alert_message_login').append('<div class="alert alert-success" role="alert">' + response.message + '</div>');
    //                 setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
    //                 var company = response.data.defaultcompany;
    //                 var department = response.data.defaultdepartment;
    //                 var userrole = response.data.usertype;
    //                 var url = 'incomingassignment?company=' + encodeURIComponent(company) + 
    //                         '&department=' + encodeURIComponent(department) + 
    //                         '&userrole=' + encodeURIComponent(userrole);
    //                 // var url = 'incomingassignment' + '?' + $.param({company: response.data.defaultcompany, department: response.data.defaultdepartment, userrole: response.data.usertype});                    
    //                 window.location.href = url;
    //             } else {
    //                 swal({
    //                     title: "Failed",
    //                     type: "warning",
    //                     text: response.message,
    //                     confirmButtonColor: "#D22B2B"
    //                 });
    //             }
    //             // if (response.status === 200) {
    //             //     $('#alert_message_login').append('<div class="alert alert-success" role="alert">' + response.message + '</div>');
    //             //     setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
    //             //     if (response.isAdmin) {
    //             //         if (response.departments && response.departments.length > 0) {
    //             //             var departmentsHtml = '<form id="departmentForm">';
    //             //             response.departments.forEach(function(department) {
    //             //                 departmentsHtml += `
    //             //                     <div class="form-check">
    //             //                         <input class="form-check-input department-checkbox" type="checkbox" value="${department.id}" id="department${department.id}">
    //             //                         <label class="form-check-label" style="color: #6c757d;" for="department${department.id}">${department.department}</label>
    //             //                     </div>`;
    //             //             });
    //             //             departmentsHtml += '</form>';
    //             //             $('#departmentCheckboxes').html(departmentsHtml);
    //             //         } else {
    //             //             $('#departmentCheckboxes').html('<p>No departments found.</p>');
    //             //         }
    //             //         $('#departmentModal').modal('show');
    //             //     } else {
    //             //         if(response.data['useragent'] === "desktop"){
    //             //             $('#alert_message_login').append('<div class="alert alert-success" role="alert">' + response.message + '</div>');
    //             //             setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
    //             //             var url = 'incomingassignment' + '?' + $.param({company: response.data.defaultcompany, department: response.data.defaultdepartment});                    
    //             //             window.location.href = url;
    //             //         }else if(response.data['useragent'] === "mobile"){
    //             //             window.location.href = "quicksurveylist";
    //             //         }
    //             //     }
    //             // } else {
    //             //     swal({
    //             //         title: "Failed",
    //             //         type: "warning",
    //             //         text: response.message,
    //             //         confirmButtonColor: "#D22B2B"
    //             //     });
    //             // }
    //         }
    //     });
    // });

    $('#nxtBtn').on('click', function() {
        var selectedDepartments = [];
        $('.department-checkbox:checked').each(function() {
            selectedDepartments.push($(this).val());
        });
       
        if (selectedDepartments.length > 0) {
            $.ajax({
                url: 'saveDepartments',
                method: 'POST',
                dataType: 'json',
                data: {
                    department_ids: selectedDepartments.join(','),
                },
                success: function(response) {
                    if (response.status === 200) {
                        window.location.href = "profilemanagement";
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function() {
                    alert("Error saving selected departments.");
                }
            });
        } else {
            alert("Please select at least one department.");
        }
    });
});

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "none";
    } 
    else if(n == 1) {
        document.getElementById("heading1").innerHTML  = "OTP Verification";
        document.getElementById("verifyBtn").style.display = "none";
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "none";
    }else{
        document.getElementById("heading1").innerHTML  = "Passcode";
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("prevBtn").style.display = "none";
    }
    if (n == (x.length - 1)) {
        document.getElementById("submitBtn").style.display = "inline";
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("prevBtn").style.display = "inline";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
        document.getElementById("submitBtn").style.display = "none";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n === 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value === "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
      return valid; // return the valid status
    }

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
}
  //... and adds the "active" class to the current step:
x[n].className += " active";
}

/**
 * ###Input Field validation 
 * validate mobile number
 */
$('#verifyBtn').on('click',function(e){
    if(currentTab === 0){
        var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
        var input = iti.getNumber();
        console.log(input);
        var re = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[7896]\d{9}$/;

        var is_mobile = re.test(input);
        console.log(is_mobile);
        if(!is_mobile){
            $('#mobile_error').html("Enter valid mobile no!");
        }else{
            $('#mobile_error').html("");
            $.ajax({
                url: 'mobilevarification',
                method:"POST",
                dataType:"json",
                data: {mobile:input},
                success: function(response){
                    if(response.status === 200){
                        $('.js-timeout').text('2:00');
                        nextPrev(1);
                        resendTimer();
                    }else if(response.status === 201){
                        $('#alert_message_registration').append('<div id=\"alert_registration\" class="alert alert-danger" role="alert">'+response.message+'</div>');
                        setTimeout(function() { $("#alert_registration").remove(); }, 3000);
                    }
                }
            });
        }
    }
});

/**
 * Mobile field with country code
 */
const phoneInputField = document.querySelector("#mobile");
const phoneInput = window.intlTelInput(phoneInputField, {
    utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    initialCountry: 'auto',
    geoIpLookup: function(callback) {
        callback('in');
    }
});

/**
 * Mobile field with country code
 */
const mobileInputField = document.querySelector("#loginmobile");
const mobileInput = window.intlTelInput(mobileInputField, {
   utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    initialCountry: 'auto',
    geoIpLookup: function(callback) {
    callback('in');
    }
});

function resendTimer(){
    var interval;
    var resend = document.getElementById("resend");
    interval = setInterval( function() {
      var timer = $('.js-timeout').text();
      timer = timer.split(':');
      var minutes = timer[0];
      var seconds = timer[1];
      seconds -= 1;
      if (minutes < 0) return;
      else if (seconds < 0 && minutes != 0) {
          minutes -= 1;
          seconds = 59;
      }
      else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;
      $('.js-timeout').html(minutes + ':' + seconds);
      if (minutes == 0 && seconds == 0) {
        clearInterval(interval);
        resend.style.display = 'block';
    }    
}, 1000);
}

function IsEmail(email) {
    var regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}


function validatePhone(mobile) {
    var a = document.getElementById(txtPhone).value;
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}

function changeMobileNumber(){
    $('.otpverification').css('display','none');
    document.getElementById('mobile').disabled = false;
    document.getElementById('verifyBtn').style.display = "inline";
}

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
            } else {
                if(parent.data('autosubmit')) {
                    otpverification();
                }
            }
        }
    });
});

$('#loginpasscode').find('input').each(function() {
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

/**
 * OTP Verification
 * */
function otpverification(){
    const otp = [document.getElementById("digit-1").value, document.getElementById("digit-2").value, document.getElementById("digit-3").value, document.getElementById("digit-4").value].join("");    var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
    var input = iti.getNumber();
    $.ajax({
        url: 'otpverification',
        method:"POST",
        dataType:"json",
        data: {mobile:input, otp:otp},
        success: function(response){
            if(response.status === 200){
                $('.otpverification').css('display','none');
                $('.mobileField').css('display','none');
                swal({
                     title: "Success!",
                     type: "success",
                     text: response.message,
                     confirmButtonColor: "#04AA6D"
                  },function(result) {
                    if(result){
                       nextPrev(1);
                    }
                  });
            }else if(response.status === 403){
                swal("Failed", response.message, "warning");
            }
        }
    });
}

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

/**
 * User Registration 
 **/
$("#regForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var passcode = [document.getElementById("passcode_1").value, document.getElementById("passcode_2").value, document.getElementById("passcode_3").value, document.getElementById("passcode_4").value].join("");    
    var confpasscode = [document.getElementById("confpasscode-1").value, document.getElementById("confpasscode-2").value, document.getElementById("confpasscode-3").value, document.getElementById("confpasscode-4").value].join("");    
    var form = $(this);
    var formdata = form.serialize();
    var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
    var input = iti.getNumber();
    if(passcode == confpasscode){
    $.ajax({
        type: "POST",
        url: "user_registration",
        data: {formdata: formdata, mobile: input, passcode: passcode}, // serializes the form's elements.
        dataType:'json',
        success: function(data)
        {
            if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                       window.location.href = "home";
                    }
                });
            }
        }
    });
    }else{
        swal({
            title:"Failed",
            type: "warning",
            text: "Passcode and Confirm passcode does not match!",
            confirmButtonColor: "#D22B2B"
            });
    }
});
</script>