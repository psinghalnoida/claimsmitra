<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
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
                                    <table id="incomingcase" class="table table-bordered table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>AID / Created Date</th>
                                                <th>Creator / Mobile</th>
                                                <th>Assigner / Mobile</th>
                                                <th>Nature of Assignment / Job Data</th>
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
        </section>
    </div>
</div>
<?php $this->load->view('adminpanel/layout/footer');?>    
<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET INCOMING CASE LIST
* ------------------------------------------------------------------------- */
var $recordsListView = $('#runningcase');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        "serverSide":true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        language: {
            searchPlaceholder: "Search running case"
        },
        order: [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('nonlocationincomingjobs'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}
</script>