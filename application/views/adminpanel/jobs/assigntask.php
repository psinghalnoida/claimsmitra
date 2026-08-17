<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<!-- Tab Content Start -->
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab11">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">NON LOCATION BASED JOB</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                            <li class="breadcrumb-item active"><span>Create new case</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="main--content">
            <div class="row gutter-20">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-12">
                                    <table id="vendorlist" class="table table-bordered table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Full Name</th>
                                                <th>Mobile</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Address</th>
                                                <th class="not-sortable">Pending Jobs</th>
                                                <th class="not-sortable">Action</th>
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
* GET VENDOR LIST
* ------------------------------------------------------------------------- */
var $recordsListView = $('#vendorlist');
if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        "serverSide":true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            url: "vendordetail",
            type: "POST",
            dataType:"json"
        },
    });
}
</script>