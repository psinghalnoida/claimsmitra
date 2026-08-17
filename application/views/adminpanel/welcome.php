<?php $this->load->view('adminpanel/layout/head'); ?>
    <!-- Wrapper Start -->
        <div class="wrapper">
            <div class="m-account-w" data-bg-img="<?php echo base_url();?>assets/img/account/wrapper-bg.jpg">
                <div class="col-md-12">
                    <!-- Panel Start -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h1 class="content_align">Welcome to Claims Mitra</h1>
                        </div>
                    <div class="panel-content">
                        <!-- Form Group Start -->
                        <div class="form-group row">
                            <span class="label-text col-md-4 col-form-label text-md-right">Please state your profession</span>
                                <div id="selectProfession" class="col-md-4">
                                    <select  class="form-control">
                                        <option value="">Select Profession</option>
                                        <option value="abc">Surveyor</option>
                                        <option value="xyz">Insurer</option>    
                                        <option value="xyz">Insured</option>    
                                        <option value="xyz">Broker</option>    
                                        <option value="xyz">Agent</option>    
                                        <option value="xyz">Workshop</option>    
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <span class="label-text col-md-4 col-form-label text-md-right">Please confirm your employment</span>
                                <div id="selectProfession" class="col-md-4">
                                    <select  class="form-control">
                                        <option value="">Select Employment</option>
                                        <option value="abc">Freelancer</option>
                                        <option value="xyz">Employee</option>      
                                    </select>
                                </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <!-- Panel End -->
            </div> 
        </div>
        </div>
    <!-- Wrapper End -->
<?php $this->load->view('adminpanel/layout/foot'); ?>
    