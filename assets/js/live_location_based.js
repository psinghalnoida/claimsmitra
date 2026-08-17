  
  function open_share_location_box(x,url)
  {



     var element = document.getElementById("locationaaa");
   element.style.display='block';
   element.style.background='#0000008f';
   element.classList.add("show");
document.getElementById('hashcode').value=""+url+"location.php?hashtoken="+x;

}

function modelclose()
{
     var element = document.getElementById("locationaaa");
   element.style.display='none';

   element.classList.remove("show");
}







function myFunction(idd) {
    console.log(idd);
  var copyText = document.getElementById("url"+idd);
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  
 /* var tooltip = document.getElementById("myTooltip"+idd);
  tooltip.innerHTML = "Copied:";*/
  document.getElementById("myTooltip"+idd).style.display = "block";

}






/* ------------------------------------------------------------------------- *
* INCOMMING CASE RECORDS LIST
* ------------------------------------------------------------------------- */
var $recordsList = $('.records--list');
    $recordsListView = $('#recordsListView_live');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
       
        responsive: true,
        processing: true,
       
        language: {
            "lengthMenu": "View _MENU_ records"
        },
        dom: '<"topbar"<"toolbar"><"right"li>><"table-responsive"t>p',
       
        
       
    });
   
}




$('#createtranslationjob_1').on('submit',function(e){

 var nature_id=document.getElementById("nature_of_job").value;
console.log(nature_id);

 //e.preventDefault(); // avoid to execute the actual submit of the form.
  //  var form = $(this);
   // var formdata = form.serialize();

  e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var formdata = form.serialize();
    //var iti = window.intlTelInputGlobals.getInstance(phoneInputField);
   // var input = iti.getNumber();
   // console.log(formdata);
    $.ajax({
        type: "POST",
        url: "job/tanslation_live_insert",
        data: {formdata: formdata,nature_id:nature_id}, // serializes the form's elements.
        dataType:'json',
        success: function(data)
        {
            console.log(data);
            if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){

open_share_location_box(data.data,data.url);

                   //    window.location.href = "live_location_based";
                    }
                });
            }
        }
    });
/**/
});



$('#createtranslationjob2').on('submit',function(e){

 var nature_id=document.getElementById("nature_of_job").value;

  e.preventDefault(); 
    var form = $(this);
    var formdata = form.serialize();

   
    $.ajax({
        type: "POST",
        url: "job/tanslation_live_insert",
        data: {formdata: formdata,nature_id:nature_id}, 
        dataType:'json',
        success: function(data)
        {
            console.log(data);
           if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                        open_share_location_box(data.data,data.url);
                     //  window.location.href = "live_location_based";
                    }
                });
            }
        }
    });

});



function delete_casee(idd){

    $.ajax({
        type: "POST",
        url: "delete_case/"+idd,
        
        dataType:'json',
        success: function(data)
        {
            console.log(data);
           if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                       window.location.href = "live_location_based";
                    }
                });
            }
        }
    });
};



$('#createtranslationjob3').on('submit',function(e){

 var nature_id=document.getElementById("nature_of_job").value;
console.log(nature_id);
  e.preventDefault(); 
    var form = $(this);
    var formdata = form.serialize();
    $.ajax({
        type: "POST",
        url: "job/tanslation_live_insert",
        data: {formdata: formdata,nature_id:nature_id}, 
        dataType:'json',
        success: function(data)
        {
            console.log(data);
            if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                        open_share_location_box(data.data,data.url);
                      // window.location.href = "live_location_based";
                    }
                });
            }
        }
    });

});

$('#createtranslationjob4').on('submit',function(e){

 var nature_id=document.getElementById("nature_of_job").value;
console.log(nature_id);
  e.preventDefault(); 
    var form = $(this);
    var formdata = form.serialize();
    $.ajax({
        type: "POST",
        url: "job/tanslation_live_insert",
        data: {formdata: formdata,nature_id:nature_id}, 
        dataType:'json',
        success: function(data)
        {
            console.log(data);
            if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                        open_share_location_box(data.data,data.url);
                     //  window.location.href = "live_location_based";
                    }
                });
            }
        }
    });

});

$('#non_location_job').on('click',function(e){


    $.ajax({
    url: "job/getnonlocationjob",
    dataType: "json",
    cache: false,
    type: "GET",
    success: function(response){
        console.log(response);
        $("#nature_of_job_location").empty();
        //$("#nature_of_job").append('<option value="">None Selected</option>');
        for (let i = 0; i < response.data.length; i++) {
            $("#nature_of_job_location").append('<option value="'+ response.data[i].id +'">'+ response.data[i].investigator_type +'</option>');
        }
    }
    })
});