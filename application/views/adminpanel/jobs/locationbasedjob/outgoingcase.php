
<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container" >
<div class="tab-content">
    <div class="tab-pane fade show active" id="tab10">
        <section class="main--content" style="min-height: 100vh;padding-top: 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel" style="margin-top:15px;">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="locationoutgoingcase" class="table table-bordered table-hover" style="width:100%;overflow-wrap: anywhere;">
                                            <thead>
                                                <tr>
                                                    <th>References</th>
                                                    <th>Investigator / Surveyor</th>
                                                    <th>Assignment Data</th>
                                                    <!-- <th>Visit Detail / Media</th> -->
                                                    <th >Status </th>
                                                    <th class="not-sortable">Action </th>
                                                </tr>
                                            </thead>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="cancel_case" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-transform:none">Are you sure do you want to cancel this case?<span style="color:green" hidden id="modal_aid"></span></h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body" id="cancelForm">
                <div class="form-group" >
                    <input type="hidden" name="aid" id="aid">
                    <label for="cancel_reason">
                        <span class="label-text">Why do you want to cancel ?</span>
                        <input type="text" id="cancel_reason" name="cancel_reason" required placeholder="Give Reason..." class="form-control">
                    </label>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="savereason" class="btn btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('adminpanel/layout/footer');?>
<script>
    outcomingcases = $('#locationoutgoingcase').DataTable({
        "serverSide": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        language: {
            searchPlaceholder: "Search Incoming Case"
        },
        order: [],
        "ajax": {
            url: "<?php echo base_url('outgoingassignment'); ?>",
            type: "POST",
            dataType: "JSON",
            data: function (d) {
                d.company = companyid;
                d.department = departmentid;
                d.user_role = user_role;

            },
            error: function(xhr, error, thrown) {
                console.log(xhr.responseText);
            }
        }
    });
</script>
