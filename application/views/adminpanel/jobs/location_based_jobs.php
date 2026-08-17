<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">

    <!-- Tabs Nav Start -->
    <ul class="nav nav-tabs nav-tabs-line-top">
        <li class="nav-item">
            <a href="#tab10" data-toggle="tab" class="nav-link active">Incoming Cases</a>
        </li>
        <li class="nav-item">
            <a href="#tab11" data-toggle="tab" class="nav-link">Outgoing Cases</a>
        </li>
        <li class="nav-item">
            <a href="#tab12" data-toggle="tab" class="nav-link">Completed</a>
        </li>
    </ul>
    <!-- Tabs Nav End -->

    <!-- Tab Content Start -->
    <div class="tab-content" style="padding:0px;">
        <!-- Wrapper Start -->
        <div class="tab-pane fade show active" id="tab10">
            <section class="main--content" style="padding:0px;" >
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list">
                        <table id="recordsListView" style="width:100%">
                            <thead>
                                <tr>
                                    <th>AID</th>
                                    <th>Creator</th>
                                    <th>Mobile</th>
                                    <th>Nature of Assignment</th>
                                    <th>Location</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Records List End -->
                    </div>
            </section>
        </div>
        <!-- Wrapper End -->

        <!-- Wrapper Start -->
        <div class="tab-pane fade show" id="tab11">
            <section class="main--content" style="padding:0px;" >
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list">
                        <table id="outgoing_cases" style="width:100%">
                            <thead>
                                <tr>
                                    <th>AID</th>
                                    <th>Inspector</th>
                                    <th>Mobile</th>
                                    <th>Nature of Assignment</th>
                                    <th>Location</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
        </div>
        <!-- Wrapper End -->
    </div>
    <!-- Tab Content End -->

    <!-- Load job based modal -->
    

 <div id="job_based_on" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/job_based_on');?>
    </div>


 <div id="live_creation_jobs" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/create_live_location_job');?>
    </div>




 <div id="locationaaa" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/live_share_location');?>
    </div>





<div id="non_location" class="modal fade">
    <?php $this->load->view('adminpanel/jobs/non_location_based');?>
</div>

    
    <!-- End of the non location based job modal -->
<?php $this->load->view('adminpanel/layout/footer');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/live_location_based.js"></script>  
<script src="<?php echo base_url();?>assets/js/location_based.js"></script>