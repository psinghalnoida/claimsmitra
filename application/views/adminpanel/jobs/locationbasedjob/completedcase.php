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
                                        <table id="completedcase" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>AID / Created Date</th>
                                                    <th>Case Reference</th>
                                                    <th>Case Handler</th>
                                                    <th>Nature of Assignment</th>
                                                    <th>Status</th>
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
<!-- Tab Content End -->

<!-- Load job based modal -->

<!-- End of the job based modal -->
<?php $this->load->view('adminpanel/layout/footer');?>    
<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET INCOMING CASE LIST
* ------------------------------------------------------------------------- */

completedcase = $('#completedcase').DataTable({
    "serverSide": true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": true,
    language: {
        searchPlaceholder: "Search Completed Case"
    },
    order: [],
    "ajax": {
        url: "<?php echo base_url('compaletedassignment'); ?>",
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



// var $recordsListView = $('#completedcase');

// if ( $recordsListView.length ) {
//     $recordsListView.DataTable({
//         "serverSide":true,
//         "paging": true,
//         "lengthChange": true,
//         "searching": true,
//         "ordering": true,
//         "info": true,
//         "autoWidth": true,
        
//         language: {
//             "lengthMenu": "View _MENU_ records"
//         },
//         order: [],
//         // Load data from an Ajax source
//         "ajax": {
//             url: "<?php echo base_url('cases/getlocationcompletedjobs'); ?>",
//             type: "POST",
//             dataType:"JSON",
//         },
        
//     });
// }
</script>