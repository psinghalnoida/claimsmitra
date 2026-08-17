<?php $this->load->view('adminpanel/layout/sidebar');?>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/heading');?>
            <section class="main--content">
                <div class="container-fluid">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content panel-activity">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="quicksurvey" class="table table-bordered table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>AID / Created Date</th>
                                                        <th>Case Reference</th>
                                                        <th>Assign to / Mobile</th>
                                                        <th>Nature of Assignment / Job data</th>
                                                        <th>Location</th>
                                                        <th>Media Files</th>
                                                        <th>Status</th>
                                                        <th class="not-sortable">Actions</th>
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
<?php $this->load->view('adminpanel/layout/footer');?>    

<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET QUICK SURVEY CASE LIST
* ------------------------------------------------------------------------- */
var $ourgointcases = $('#quicksurvey');

if ( $ourgointcases.length) {
    $ourgointcases.DataTable({
        "serverSide":true,
        "paging": true,
        "fixedHeader": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        language: {
            searchPlaceholder: "Search Quick Survey",
            "lengthMenu": "View _MENU_ records"
        },
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('quicksurvey'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}
</script>