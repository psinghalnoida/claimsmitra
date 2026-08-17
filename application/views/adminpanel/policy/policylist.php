<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Policy</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Policy Wallet</a></li>
                    <li class="breadcrumb-item active"><span>Policy</span></li>
                </ul>
            </div>

            <div class="col-lg-6">
                <div class="summary--widget">
                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>
                        <p class="summary--title">This Month</p>
                        <p class="summary--stats text-green">2,371,527</p>
                    </div>
                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>
                        <p class="summary--title">Last Month</p>
                        <p class="summary--stats text-orange">2,527,371</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main--content">
    <div class="panel">
        <div class="records--list" data-title="User Listing">
            <table id="policylist">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Insured Name</th>
                        <th class="not-sortable">Policy No</th>
                        <th>Type of Policy</th>
                        <th>Policy Start Date</th>
                        <th>Policy End Date</th>
                        <th>Premiun</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="not-sortable">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<!-- Large Modal Start -->
<div id="largeModal" class="modal fade" style="margin-left: 17px;">
    <div class="modal-dialog" style="max-width:100%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <section class="main--content">
                    <div class="panel">
                        <div class="app_wrapper row">
                            <div class="app_sidebar col-lg-6">
                                <!-- Image Slider Start-->
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                                  <div class="carousel-inner">
                                    <div class="carousel-item active">
                                      <img class="d-block w-100" src="<?php echo base_url();?>assets/img/avatars/test1.svg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo base_url();?>assets/img/avatars/test2.svg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="<?php echo base_url();?>assets/img/avatars/test3.svg" alt="Third slide">
                                    </div>
                                  </div>
                                  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                                <!-- Image Slider End-->
                            </div>
                            <div class="app_content col-lg-6">
                                <!-- Policy Form  --->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- Large Modal End -->
<?php $this->load->view('adminpanel/layout/footer'); ?>

