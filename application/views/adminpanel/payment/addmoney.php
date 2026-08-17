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
                                        <form id="cattlesurveyform" method="post" enctype="multipart/form-data" style="display:block">
                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Payment Mode</span>
                                                <div class="col-lg-9">
                                                <select class="form-control" id="payment_mode" name="payment_mode">
                                                    <option value="">Select option</option>
                                                    <option value="online">Online</option>
                                                    <option value="offline">Offline</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label location_of_survey">Amount (In INR)</span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="amount" id="amount" placeholder="Amount in INR" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="padding-right:0px;">
                                                <button type="submit" class="btn btn-rounded btn-success" id="add_money">Add Money</button>
                                            </div>
                                            </form>
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


</script>