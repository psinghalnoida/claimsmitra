<style type="text/css">
.records--body {
    padding: 16px 30px 30px;
}

.records--body .title {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    margin: 7px 0 25px;
    padding-bottom: 13px;
    border-bottom: 1px solid #ccc;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}


.records--body .title .btn {
    margin-left: auto;
}

.records--body .subtitle {
    margin-top: 19px;
    margin-bottom: 14px;
    padding: 5px 20px 7px;
    color: #393939;
    background-color: #f8f8f8;
    border-radius: 2px;
}

.records--body .table-simple th,
.records--body .table-simple td {
    padding: 7px 0;
}
thead tr th{
    font-size: 14px;
}
.tab-content {
    padding: 11px 20px 11px;
    border: 1px solid #ebebea;
    border-radius: 4px;
    word-break: break-word;
}

@media (min-width: 576px) {
    .records--body .table-simple th,
    .records--body .table-simple td {
        padding-left: 20px;
        padding-right: 20px;
    }
}
</style>


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
                               
                                <div class="records--body">
                                <!-- Tabs Nav Start -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#live-location" data-toggle="tab" class="nav-link active">Live Location Based </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#non-live" data-toggle="tab" class="nav-link">Non Location Based</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#pincode" data-toggle="tab" class="nav-link">Pincode Based</a>
                                    </li>
                                </ul>
                                <!-- Tabs Nav End -->

                                <!-- Tab Content Start -->
                                <div class="tab-content">
                                    <!-- Tab Pane Start -->
                                    <div class="tab-pane fade show active" id="live-location">
                                       <div class="panel-content panel-activity" style="border-top:none">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="location" class="table table-bordered table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>AID / Created Date</th>
                                                                <th>Assign to / Mobile</th>
                                                                <th>Nature of Assignment / Job data</th>
                                                                <th>Location</th>
                                                                <th>Status</th>
                                                                <th>View Case</th>
                                                                <th class="not-sortable">Actions</th>
                                                            </tr>
                                                        </thead>
                                                    </table>     
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- Tab Pane End -->

                                    <!-- Tab Pane Start -->
                                    <div class="tab-pane fade" id="non-live">
                                       <div class="panel-content panel-activity">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="nonLocation" class="table table-bordered table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>AID / Created Date</th>
                                                                <th>Assign to / Mobile</th>
                                                                <th>Nature of Assignment / Job data</th>
                                                                <th>Location</th>
                                                                <th>Status</th>
                                                                <th>View Case</th>
                                                                <th class="not-sortable">Actions</th>
                                                            </tr>
                                                        </thead>
                                                    </table> 
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- Tab Pane End -->

                                    <!-- Tab Pane Start -->
                                    <div class="tab-pane fade" id="pincode">
                                       <div class="panel-content panel-activity">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="pincodejobs" class="table table-bordered table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>AID / Created Date</th>
                                                                <th>Assign to / Mobile</th>
                                                                <th>Nature of Assignment / Job data</th>
                                                                <th>Location</th>
                                                                <th>Status</th>
                                                                <th>View Case</th>
                                                                <th class="not-sortable">Actions</th>
                                                            </tr>
                                                        </thead>
                                                    </table>    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- Tab Pane End -->
                                 </div>
                                <!-- Tab Content End -->
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
* GET LOCATION OUTGOING CASE LIST
* ------------------------------------------------------------------------- */
var $ourgointcases = $('#location');

if ( $ourgointcases.length ) {
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
            searchPlaceholder: "Search Case"
        },
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('cases/getlivelocationjobs'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}



/* ------------------------------------------------------------------------- *
* GET NON LOCATION OUTGOING CASE LIST
* ------------------------------------------------------------------------- */
var $ourgointcases = $('#nonLocation');

if ( $ourgointcases.length ) {
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
            searchPlaceholder: "Search Case"
        },
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('getalljobs'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}



/* ------------------------------------------------------------------------- *
* GET PINCODE OUTGOING CASE LIST
* ------------------------------------------------------------------------- */
var $ourgointcases = $('#pincodejobs');

if ( $ourgointcases.length ) {
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
            searchPlaceholder: "Search Case"
        },
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('getalljobs'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}
</script>


