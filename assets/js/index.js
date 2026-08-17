$("#update_kyc").click(function(event) {
    event.preventDefault();
    var form_data = new FormData($('#kyc_document')[0]);
    jQuery.ajax({
        type: "POST",
        url: "update_kyc_document",
        data: form_data,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response.status);
            if (response.status === 200 )
            {
            //document.getElementById("add_bank").reset();
            }
        }
    }); 
});






/**
 * Created by Arpit Singh Dated: 01-07-2022
 * Claims Mitra Index.js file
 */
/*function policybyid(data){
    var policyid = data;
    $.ajax({
        url: 'getpolicydata',
        method:"POST",
        dataType:'json',
        data: {id:policyid},
        success: function(response){
            console.log(response);
        }
    });
}*/




 /*$(document).ready(function() {
    $("#pincode").keyup(function() {
        var el = document.getElementById('pincode').value;
        if (el.length === 6) {
            $.ajax({
                url: "https://postalpincode.in/api/pincode/"+el,
                cache: false,
                dataType: "json",
                type: "GET",
                success: function(result, success) {

                    console.log(result);
                    /*$("#city").val(result.city);
                    $("#state").val(result.state);*/
                /*}
            });
        }
    });
});*/





 /**
 * Created by Arpit Singh Dated: 01-07-2022
 * User Login using Ajax.
 */
/*$('#userLogin').on('submit',function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        url: 'user_login',
        method:"POST",
        dataType:"json",
        data: data,
        success: function(response){
            if(response.status === 200){
                $('#alert_message_login').append('<div class="alert alert-success" role="alert">'+response.message+'</div>');
                setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
                window.location.href = "dashboard";   
            }else{
                $('#alert_message_login').append('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
                setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
            }
        }
    })
});*/

/**
 * Created by Arpit Singh Dated: 29-11-2022
 * User List using Ajax.
 */


/**
 * Created by Arpit Singh Dated: 29-11-2022
 * Policy List using Ajax.
 */
$(document).ready(function(){
    $('#policylist').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": 'policylist',
            "type": "POST"
        },
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
    });
});
/**
 * Created by Arpit Singh Dated: 01-07-2022
 * User Registration using ajax.
 */
/*$('#accountVerification').on('submit', function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        url: 'accountverification',
        method:"POST",
        dataType:"json",
        data: data,
        success: function(response){
         if(response.message === 'error'){
            $('#salutation_error').html(response.data.salutation_error);
            $('#firstname_error').html(response.data.firstname_error);
            $('#email_error').html(response.data.email_error);
            $('#mobile_error').html(response.data.mobile_error);
            $('#password_error').html(response.data.password_error);
            $('#terms_error').html(response.data.terms_error);
        }else if(response.message === 'failed'){
            $('#error').html(response.data);
        }else if(response.message === 'success'){
            $("#userRegistration").hide();
            $("#sendActivationmail").show();
        }
    }
});
});*/






/**
 * toggle case
 * select occupation
 */
$(function() {
    $(document).ready(function() {
        $("#checkIndividual").click(function(event) {
            $("#addressformPanel").show();
            $("#companyformPanel").hide();
        });

        $("#checkEnterprise").click(function(event){
            $("#addressformPanel").hide();
            $("#companyformPanel").show();
        });
    });
});
