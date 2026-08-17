<?php $this->load->view('adminpanel/layout/head'); ?>
<div class="wrapper">
    <div class="m-account-w" data-bg-img="assets/img/account/wrapper-bg.jpg">
        <div class="m-account m-account-lock">
            <!-- Forgot Password Form Start -->
            <div class="m-account--form-w">
                <div class="m-account--form m-account--lock">
                    <div class="m-account--user">
                        <?php if($this->session->userdata('profilephoto') != null || $this->session->userdata('profilephoto') != ""){?>
                        <img src="<?php echo base_url('assets/profile/'.$this->session->userdata('profilephoto').'');  ?>">
                        <?php }else{ ?>
                            <img src="<?php echo base_url('assets/profile/user.png');  ?>">
                        <?php } ?>

                        <h3 class="h3"><?php echo $this->session->userdata('firstname')." ".$this->session->userdata('lastname') ?><i class="fa fa-unlock"></i></h3>
                    </div>

                    <form id="userLogin" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="fas fa-key"></i>
                                </div>
                                 <input type="hidden" name="email" placeholder="Username" class="form-control" autocomplete="off" value="<?php echo $this->session->userdata('email')?>">
                                <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-rounded btn-info">Unlock</button>
                        </div>

                        <div class="m-account--footer">
                            <p>&copy; 2018 ThemeLooks</p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Forgot Password Form End -->
        </div>
    </div>
</div>
<?php $this->load->view('adminpanel/layout/footer'); ?>