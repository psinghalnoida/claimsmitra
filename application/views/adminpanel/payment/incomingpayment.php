<?php $this->load->view('adminpanel/layout/sidebar');?>

<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/payment/heading');?>
            <section class="main--content" style="padding-top:0px;">
                <div class="container-fluid" style="padding-bottom: 35px;">  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="incoming_payment" class="table table-bordered table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>AID</th>
                                                        <th>Nature of Job</th>
                                                        <th>Total Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Balance Amount</th>
                                                        <th>Total TDS</th>
                                                        <th>Created At</th>
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

let table = new DataTable('#incoming_payment', {
    "serverSide":true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "autoWidth": true,
    language: {
        searchPlaceholder: "Search AID",
        "lengthMenu": "View _MENU_ records"
    },
    "order": [],
    // Load data from an Ajax source
    "ajax": {
        url: "<?php echo base_url('getallpaymentrecord'); ?>",
        type: "POST",
        dataType:"JSON",
    },
});
</script>