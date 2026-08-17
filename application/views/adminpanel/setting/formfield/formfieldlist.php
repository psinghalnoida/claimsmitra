<?php $this->load->view('adminpanel/layout/sidebar');?>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/setting/formfield/heading');?>
            <section class="main--content">
                <div class="container-fluid">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content panel-activity">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="locationoutgoingcase" class="table table-bordered table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Form Name</th>
                                                        <th>Field Name</th>
                                                        <th>Key Name</th>
                                                        <th>Mandatory</th>
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
* GET OUTGOING CASE LIST
* ------------------------------------------------------------------------- */
var $ourgointcases = $('#locationoutgoingcase');

if ( $ourgointcases.length ) {
    $ourgointcases.DataTable({
        "serverSide":true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        language: {
            searchPlaceholder: "Search Outgoing Case",
            "lengthMenu": "View _MENU_ records"
        },
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('locationoutgoingjobs'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}
</script>