<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<!-- Main Container Start -->
<main class="main--container">
<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Company</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span>Company</span></li>
                </ul>
            </div>
            <div class="col-lg-6" style="text-align:right;">
                <a href="<?php echo base_url('createcompany'); ?>"  class="btn btn-rounded btn-success">Create new company</a>
            </div>
        </div>
    </div>
</section>
<section class="main--content">
    <div class="container-fluid">       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="companylist" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CID</th>
                                    <th>Company Name</th>
                                    <th>Requested By</th>
                                    <th>Phone Number</th>
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
    <!-- Records List End -->
</section>
<!-- End of the non location based job modal -->
<?php $this->load->view('adminpanel/layout/footer'); ?>

<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET CORPORATE LIST
* ------------------------------------------------------------------------- */
var $recordsList = $('.records--list'),
    $recordsListView = $('#companylist');

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
            "lengthMenu": "View _MENU_ records"
        },
        order: [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('company/getcompanylist'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        columnDefs: [
            {
                targets: [0,3,4],
                orderable: false
            }
        ]
    });
    $recordsList.find('.toolbar').append('');
}

</script>