<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
    <section class="page--header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="page--title h5">Policy</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="ecommerce.html">Policy Wallet</a></li>
                        <li class="breadcrumb-item active"><span>Policy</span></li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <div class="summary--widget">
                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>
                            <p class="summary--title">This Month</p>
                            <p class="summary--stats text-green">2,371,527</p>
                        </div>
                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>
                            <p class="summary--title">Last Month</p>
                            <p class="summary--stats text-orange">2,527,371</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="main--content">
        <div class="panel">
            <div class="records--list" data-title="User Listing">
                <a href="#largeModal" class="btn btn-outline-secondary" data-toggle="modal">View Demo</a>
            </div>
            <div class="records--list" data-title="User Listing">
                <a href="#translation_job" class="btn btn-outline-secondary" data-toggle="modal">Create Job</a>
            </div>
        </div>
    </section>
    <!-- Large Modal Start -->
    <div id="largeModal" class="modal fade" style="padding-right:0px">
        <div class="modal-dialog" style="max-width:100%; margin: 0rem;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Translate Page</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0rem;">
                    <section class="main--content" style="padding: 0rem;">
                        <div class="panel" style="padding: 0rem; background-color: black;">
                            <div class="app_wrapper row">
                                <div class="app_sidebar col-lg-6">
                                    <!-- PDF Viewer Start -->
                                    <embed
                                        src="https://claimsmitra.com/newclaimsmitra/test.pdf#toolbar=1&navpanes=1&scrollbar=1"
                                        width="100%"
                                        height="100%"
                                        type="application/pdf">
                                    </embed>

                                    <!-- PDF Viewer End-->
                                </div>
                                <div class="app_content col-lg-6">
                                    <!-- Text Editor Start  -->
                                    <div class="modal-header" style="min-height: 55px; background-color:#212529;border-radius: 0px;">
                                        <div class="records--list" data-title="User Listing" style="padding-bottom: 0px;">
                                            <a href="#" class="btn btn-rounded btn-success" style="text-transform: inherit;" data-toggle="modal">Save as PDF</a>
                                        </div>
                                        <div class="records--list" data-title="User Listing" style="padding-bottom: 0px;">
                                            <a href="#rejectcase" class="btn btn-rounded btn-danger" style="text-transform: inherit;" data-toggle="modal">Reject</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="mail_message" id="summernote" class="form-control" data-trigger="summernote"></textarea>
                                    </div>
                                    <!-- Text Editor End  -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Large Modal End -->
    <div id="rejectcase" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Page</h5>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form id="reject" method="post" enctype="multipart/form-data"> 
                        <div class="form-group row mt-6">
                            <span class="label-text col-lg-5 col-form-label">Select Reason</span>
                                <div class="col-lg-7">
                                    <select name="select" name="account_type" id="account_type" class="form-control">
                                        <option value="Current">Blank page</option>
                                        <option value="Saving">Page is unreadable</option>
                                        <option value="Current">Clear copy required</option>
                                        <option value="Current">Different language</option>
                                    </select>
                                </div>
                        </div>        
                    </form>
                </div>

                <div class="modal-footer">
                    
                    <div class="records--list" data-title="User Listing" style="padding-bottom: 0px;">
                        <a href="#" class="btn btn-rounded btn-success" data-toggle="modal">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="translation_job" class="modal fade">
<?php $this->load->view('adminpanel/translation/create_job'); ?>
</div>
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script type="text/javascript">
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var imgPath = input.files[0].value;
            
        var ext = $(input).val().split(".").pop().toLowerCase();
        if ($.inArray(ext, ["pdf"]) == -1) {
        MsgBox(
          "Message",
          'Only file with extension ".pdf"  are allowed'
        );
        // $(input).filestyle("clear");
        $(input).val("");
        return;
      } 
      else {
        if (input.files[0].size > 1024000) {
            MsgBox(
            "Message",
            "Uploaded File <b> " +
              input.files[0].name +
              "</b>  " +
              input.files[0].size / 1000 +
              "KB"
            );
            $(input).val("");
            return;
        }
      }
        var image_holder = $("#image-holder");
        image_holder.empty();
        var filename = input.files[0].name;
        var reader = new FileReader();

        reader.onload = function (e) {
      
        // comment - add this code
        // it will use the default image for pdf and other non-image files
        let src = defaultImage;
        if (input.files[0].type.startsWith("image")) src = e.target.result; 
        
      
        $("<img />", {
          src: src,
          class: "thumb-image",
          title: filename,
          width: "100",
          height: "100",
        }).appendTo(image_holder);
      };
      reader.readAsDataURL(input.files[0]);
    }
}


$('#createtranslationjob').on('submit',function(e){
    e.preventDefault();
    var form_data = new FormData($('#createtranslationjob')[0]);
    $.ajax({
        url: "job/tanslation",
        dataType: "json",
        type: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        success: function(response){
            console.log(response);
            /*if(response.status === 200){
                $('#alert_message_login').append('<div class="alert alert-success" role="alert">'+response.message+'</div>');
                setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
            }else{
                $('#alert_message_login').append('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
                setTimeout(function() { $("#alert_message_login").hide(); }, 5000);
            }*/
        }
    })
});

</script>