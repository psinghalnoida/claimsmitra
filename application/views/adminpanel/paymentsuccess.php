<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<!-- Tab Content Start -->
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab11">
        <section class="page--header">
            <div class="container-fluid" style="padding-right:6px;">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Payment Success</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                            <li class="breadcrumb-item active"><span>Success</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="main--content" id="mainContent">
            <div class="row gutter-20">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-content" id="panelContent" >
                            <div class="row" id="profilePanel">
                                <div class="profile--panel" >
                                    <div class="img-wrapper" style="padding-top: 30px;">
                                        <div class="img online" >
                                            <img src="<?php echo base_url();?>assets/img/avatars/success.png" alt=""  class="rounded-circle">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="name">
                                        <h3 class="h3" style="color: green;">Payment Success !</h3>
                                    </div>

                                    <div class="role">
                                        <p>Your payment has done</p>
                                    </div>

                                    <div class="action">
                                        <a href="#" class="btn btn-info">Back</a>
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
    // Set the timeout duration in milliseconds (e.g., 5000 for 5 seconds)
    var timeoutDuration = 5000;

    // Set the redirect URL
    var redirectUrl = '<?php echo base_url('nonlocationoutgoing'); ?>'; // Replace with your actual URL

    // Use setTimeout to wait for the specified duration
    setTimeout(function () {
        // Redirect to the specified URL
        window.location.href = redirectUrl;
    }, timeoutDuration);
</script>