
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
/* ------------------------------------------------------------------------- *
* GET NON LOCATION JOB LIST
* ------------------------------------------------------------------------- */
$('#non_location_job').on('click',function(e){
    $.ajax({
    url: "job/getnonlocationjob",
    dataType: "json",
    cache: false,
    type: "GET",
    success: function(response){
        $("#nature_of_job_location").empty();
        //$("#nature_of_job").append('<option value="">None Selected</option>');
        for (let i = 0; i < response.data.length; i++) {
            $("#nature_of_job_location").append('<option value="'+ response.data[i].id +'">'+ response.data[i].investigator_type +'</option>');
        }
    }
    })
});
/* ------------------------------------------------------------------------- *
* GET INVESTIGATOR LIST ON CHANGE THE LANGUAGE
* ------------------------------------------------------------------------- */
$('#language_list_from').on('change',function(e){
var language = document.getElementById('language_list_from').value;
    $.ajax({
        url: "job/findtranslator",
        dataType: "json",
        type: "POST",
        data: {language:language},
        success: function(response){
            $("#assign_to").empty();
            if(response.status == 200){
                $('#assign_to').append("<option value=''>None Selected</option>");
                $.each(response.data, function(i, data) {
                    $('#assign_to').append("<option value='" + data.userId + "'>" + data.firstname + "</option>");
                });

            }else if(response.status == 404){
                $('#assign_to').append("<option value=''>"+ response.message +"</option>");
            }
        }
    })
});
/* ------------------------------------------------------------------------- *
* HIDE NON LOCATION BASED MODAL
* ------------------------------------------------------------------------- */
$("#non_location").on("hidden.bs.modal", function () {
    $(':input', this).val('');
    $('#createtranslationjob').css("display","none");
    $('#createdeathjob').css("display","block");
});
/* ------------------------------------------------------------------------- *
* SWITCH THE FORM OF NON LOCATION BASED JOB
* ------------------------------------------------------------------------- */
$('#nature_of_job_location').on('change',function(){
    var natureofjob = $("#nature_of_job_location option:selected").text();
    if(natureofjob == 'Document Translation'){
        $('#createtranslationjob_location').css("display","block");
        $('#createdeathjob').css("display","none");
    }else{
        $('#createtranslationjob_location').css("display","none");
        $('#createdeathjob').css("display","block");
    }
});
/* ------------------------------------------------------------------------- *
* SUMMERNOTE TEXT EDITOR
* ------------------------------------------------------------------------- */
$('#summernote').summernote({
    tabsize: 2,
    height: 700,
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'hr']],
    ['help', ['help']]
    ],
});

/* ------------------------------------------------------------------------- *
* INCOMMING CASE RECORDS LIST
* ------------------------------------------------------------------------- */
var  $recordsListView = $('#recordsListView');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        responsive: true,
        processing: true,
       // serverSide: true,
        language: {
            "lengthMenu": "View _MENU_ records"
        },
        dom: '<"topbar"<"toolbar"><"right"li>><"table-responsive"t>p',
        order: [],
        // Load data from an Ajax source
      /*  "ajax": {
            url: "<?php echo base_url('job/incomingcase'); ?>",
            type: "POST",
            dataType:"JSON",
        },*/
        columnDefs: [
            {
                targets: [0,3,4],
                orderable: false
            }
        ]
    });
}

/* ------------------------------------------------------------------------- *
* COMPLETED CASE RECORDS LIST
* ------------------------------------------------------------------------- */
var $recordsList = $('.records--list'),
    $recordsListView = $('#outgoing_cases');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        responsive: true,
        processing: true,
        //serverSide: true,
        language: {
            "lengthMenu": "View _MENU_ records"
        },
        dom: '<"topbar"<"toolbar"><"right"li>><"table-responsive"t>p',
        order: [],
        // Load data from an Ajax source
       /* "ajax": {
            url: "<?php echo base_url('job/incomingcase'); ?>",
            type: "POST",
        },*/
        columnDefs: [
            {
                targets: [0,3,4],
                orderable: false
            }
        ]
    });
   // $recordsList.find('.toolbar').append('<a href="#job_based_on" data-toggle="modal" class="btn btn-rounded btn-success">Create new job</a>');
}
/* ------------------------------------------------------------------------- *
* CREATE TRANSLATION JOB FORM VALIDATION
* ------------------------------------------------------------------------- */
$('form[id="createtranslationjob_location"]').validate({
    rules: {
        language_list_from: 'required',
        language_list_to: 'required',
        assign_to: 'required',
        language_list_from: {
            required: true,
        },
        language_list_to: {
            required: true,
        },
        assign_to: {
            required: true,
        },
    },
    messages: {
        language_list_from: 'This field is required',
        language_list_to: 'This field is required',
        assign_to: 'This field is required',
    },
    submitHandler: function(form) {
        form.submit();
    }
});
/* ------------------------------------------------------------------------- *
* CREATE TRANSLATION JOB FORM SUBMIT
* ------------------------------------------------------------------------- */
$('#createtranslationjob_location').on('submit',function(e){
    $('#pdf-file').rules("add",
    {
        required: true,
        extension: "pdf",
        messages: {
            required: "Please upload file",
            extension: "Please upload file in these format only (pdf)"
        }
    });
    e.preventDefault();
    var form_data = new FormData($('#createtranslationjob_location')[0]);
    $.ajax({
        url: "job/createjob",
        dataType: "json",
        type: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        success: function(response){
            if(response.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: response.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                    window.location.href = "dashboard";
                    }
                });
            }
        }
    });
});

/* ------------------------------------------------------------------------- *
* CREATE THUMBNAIL PREVIEW OF PDF BEFORE UPLOAD. PDF FILE ON CHANGE
* ------------------------------------------------------------------------- */
$("#pdf-file").on('change', function() {
    // user selected PDF
    var file = this.files[0];

    // allowed MIME types
    var mime_types = [ 'application/pdf' ];

    // validate whether PDF
    if(mime_types.indexOf(file.type) == -1) {
        alert('Error : Incorrect file type');
        return;
    }

    // validate file size
    if(file.size > 10*1024*1024) {
        alert('Error : Exceeded size 10MB');
        return;
    }

    // validation is successful

    // hide upload dialog
    //document.querySelector("#upload-dialog").style.display = 'none';

    // show the PDF preview loader
    document.querySelector("#pdf-loader").style.display = 'inline-block';

    // object url of PDF
    _OBJECT_URL = URL.createObjectURL(file)

    // send the object url of the pdf to the PDF preview function
    showPDF(_OBJECT_URL);
});
// will hold the PDF handle returned by PDF.JS API
var _PDF_DOC;

// PDF.JS renders PDF in a <canvas> element
var _CANVAS = document.querySelector('#pdf-preview');

// will hold object url of chosen PDF
var _OBJECT_URL;

/* ------------------------------------------------------------------------- *
* SHOW PDF FILE.
* ------------------------------------------------------------------------- */
function showPDF(pdf_url) {
    pdfjsLib.getDocument({ url: pdf_url }).then(function(pdf_doc) {
        _PDF_DOC = pdf_doc;
        pagenum = pdf_doc.numPages;
        // show the first page of PDF
        showPage(1,pagenum);
        // destroy previous object url
        URL.revokeObjectURL(_OBJECT_URL);
    }).catch(function(error) {
        // error reason
        alert(error.message);
    });;
}

/* ------------------------------------------------------------------------- *
* SHOW TOTAL PAGE NUMBER IN PDF FILE.
* ------------------------------------------------------------------------- */
function showPage(page_no,total_page) {
    _PDF_DOC.getPage(page_no).then(function(page) {
        // set the scale of viewport
        var scale_required = _CANVAS.width / page.getViewport(1).width;

        // get viewport of the page at required scale
        var viewport = page.getViewport(scale_required);

        // set canvas height
        _CANVAS.height = viewport.height;

        var renderContext = {
            canvasContext: _CANVAS.getContext('2d'),
            viewport: viewport
        };

        // render the page contents in the canvas
        page.render(renderContext).then(function() {
            document.getElementById("pdf_listing").style.display = 'inline-block';
            document.getElementById("pdf-loader").style.display = 'none';
            document.getElementById("total-page").innerHTML = total_page + " pages . PDF";
        });
    });
}