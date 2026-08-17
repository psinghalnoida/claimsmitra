<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<!-- Tab Content Start -->
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab11">
        <section class="page--header">
            <div class="container-fluid" style="padding-right:7px;">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">CREATE NEW FORM FIELD</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                            <li class="breadcrumb-item active"><span>Form Fields</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6" style="text-align:right; align-self: center;">
                        <a href="<?php echo base_url('nonlocationoutgoing');?>"  class="btn btn-rounded btn-success">All Fields</a>
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
                                    <span class="label-text col-lg-3 col-form-label">Nature of Job</span>
                                        <div class="col-lg-9">
                                            <select name="nature_of_job" id="nature_of_job"   class="form-control">
                                                <?php foreach ($listofjobs as $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['investigator_type'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                </div>

                                <form id="createfield" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Field Name</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="field_name" id="field_name" placeholder="Field Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Key Name</span>
                                        <div class="col-lg-9">
                                            <input type="text" name="key_name" id="key_name" placeholder="Key Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-lg-3 col-form-label">Mandatory</span>

                                        <div class="col-lg-9 form-inline"  style="top:7px;">
                                            <label class="form-radio mr-3">
                                                <input type="radio" name="mandatory" value="1" class="form-radio-input">
                                                <span class="form-radio-label">Yes</span>
                                            </label>

                                            <label class="form-radio">
                                                <input type="radio" name="mandatory" value="0" class="form-radio-input" checked="">
                                                <span class="form-radio-label">No</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="modal-footer" style="padding-right:0px;">
                                        <button type="button" class="btn btn-rounded btn-success" id="btn_create">Create Field</button>
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
<script type="text/javascript">
    $("#createfield").validate({
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

    $("#btn_create").on('click',function(event) {
        event.preventDefault();
        if($("#createfield").valid()){
            var form_data = new FormData(document.getElementById('createfield'));
            form_data.append('nature_of_job',document.getElementById('nature_of_job').text());
            $.ajax({
                type: "POST",
                url: "createnewfield",
                dataType:"json",
                data: form_data,
                processData:false,
                contentType:false,
                success: function(response) {
                    if (response.status === 200)
                    {
                        /*var url = 'agreeforterms' + '?' + $.param({natureofjob: response.data.natureofjob, files: response.data.filedata['total-file'],pages: response.data.filedata['total-pages']});                    
                        window.location.href = url;*/
                    }
                    else{
                        /*swal({
                            title: "Failed!",
                            type: "warning",
                            text: response.message,
                            confirmButtonColor: "#D22B2B"
                            });*/
                    }
                }
            });   
        } 
    });

</script>