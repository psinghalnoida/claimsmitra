<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab10">
        <?php $this->load->view('adminpanel/jobs/nonlocationbasedjob/heading');?>
        <section class="main--content"  >
            <div class="row gutter-20">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-12">
                                    <form id="company_form" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Profession</span>
                                            <div class="col-lg-9">
                                                <select name="choose_profession" id="choose_profession" class="form-control">
                                                    <option value="">Nothing Selected</option>    
                                                    <?php foreach ($profession as $value) { ?>
                                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['profession']; ?></option>
                                                    <?php } ?>                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-lg-3 col-form-label">Company Name</span>
                                            <div class="col-lg-9">
                                                <select name="select_company" id="select_company" class="form-control">
                                                    <option value="">Nothing Selected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="datatableContainer" style="display:none">
                                            <table id="branchdata" class="table table-bordered table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>BID</th>
                                                        <th>GST</th>
                                                        <th>Address</th>
                                                        <th>Pincode</th>
                                                        <th>State</th>
                                                        <th>City</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>      
                                        </div>

                                        <!-- <div class="form-group row" id="parent_company" style="display:none">
                                            <div class="invoice--order">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>CID</th>
                                                            <th>Company Name</th>
                                                            <th>CIN No</th>
                                                            <th>Licence No</th>
                                                            <th>Profession</th>
                                                            <th>Website</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="company_data">
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> -->
                                    </form>             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script type="text/javascript">
$('select[id="choose_profession"]').on('change', function() {
    var professionId = $(this).val();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('companybyprofessionid');?>",
        dataType: "json",
        data: {profession : professionId },
        success: function (response) {
            $("#select_company").html('');
            $("#select_company").append('<option value="">Nothing Selected</option>'); 
            $.each(response.data, function(i, val) {                
                $("#select_company").append("<option value=" + val.cid + ">" + val.companyName+ "</option>"); 
            });
            
        }
    });
});
/*$('select[id="select_company"]').on('change', function() {
    var companyid = $(this).val();
    var html = '';
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('companybyid');?>",
        data: {company:companyid},
        dataType: "json",
        success: function (response) {
            $("#company_data").html("");
            if(response.status == 200){
                $("#parent_company").css("display", "block");
                $.each(response.data, function(i, val) {
                    html += '<tr>'+
                                '<td>'+ val.cid +'</td>'+
                                '<td>'+ val.companyName +'</td>'+
                                '<td>'+ val.cinNo +'</td>'+
                                '<td>'+ val.licenceNo +'</td>'+
                                '<td>'+ val.profession +'</td>'+
                                '<td>'+ val.website +'</td>'+
                            '</tr>';
                });    
                $("#company_data").append(html);
            }
        }
    });
});*/

$(document).ready(function() {
    var dataTable = null;
    $('#select_company').change(function() {
        var selectedCategory = $(this).val();
        if (selectedCategory !== '') {
            if (dataTable) {
                dataTable.destroy();
            }

                // Initialize DataTable for the first time
                dataTable = $('#branchdata').DataTable({
                    "serverSide":true,
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "order": [],
                    
                    "ajax": {
                        url: '<?= base_url('branches') ?>',
                        type: 'POST',
                        dataType: "JSON",
                        data: function(d) {
                            d.select_company = selectedCategory;
                        }
                    },
                    
                });
            // Show the DataTable container
            $('#datatableContainer').show();
        } else {
            // Hide the DataTable container when no option is selected
            $('#datatableContainer').hide();
        }
    });
});
</script>



