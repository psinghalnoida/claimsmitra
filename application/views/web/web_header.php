<div class="wrapper">
    <header class="navbar navbar-fixed" style="background-color: transparent; min-height:95px; box-shadow: 0 0px 0px rgba(0, 0, 0, 0);">
        <div class="navbar--header" style="background-color: transparent;">
            <div class="logo">
                <img style="height:30px;height: 30px;display: block;margin-left: auto; margin-right: auto; width: 12%" src="<?php echo base_url();?>assets/img/account/logo.png" alt="">
                <h3 style="text-align:center;color:white" class="h3">Claims Mitra</h3>
            </div>
        </div>
        <div class="navbar--nav ml-auto" style="margin-right: 38px;">
            <?php if($this->session->userdata('isLogin') == "loggedIn"){ ?>

                <ul class="nav">
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-bell"></i>
                            <span class="badge text-white bg-blue">7</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="mailbox_inbox.html" class="nav-link">
                            <i class="fa fa-envelope"></i>
                            <span class="badge text-white bg-blue">4</span>
                        </a>
                    </li>    -->
                    <li class="nav-item dropdown nav--user online">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <?php if($this->session->userdata('profilephoto') != null || $this->session->userdata('profilephoto') != ""){?>
                                <img src="<?php echo $this->session->userdata('profilephoto');  ?>" alt="" class="rounded-circle">
                            <?php }else{ ?>
                                <img src="<?php echo base_url('assets/profile/user.png');  ?>" alt="" class="rounded-circle">
                            <?php } ?>
                            <span><?php echo $this->session->userdata('firstname'); ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if($this->session->userdata('profession') !== "Admin") { ?>
                            <li>
                                <a href="<?php echo base_url();?>user_profile"><i class="far fa-user"></i>Profile</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>dashboard"><i class="far fa-user"></i>Dashboard</a>
                            </li>
                            <?php } ?>
                            <!-- <li><a href="mailbox_inbox.html"><i class="far fa-envelope"></i>Inbox</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li> -->
                            <li class="dropdown-divider"></li>
                            <!-- <li><a href="<?php echo base_url('dashboardlock');?>"><i class="fa fa-lock"></i>Lock Screen</a></li> -->
                            <li><a href="<?php echo base_url('user_logout');?>"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php }else{ ?>
                <a class="btn btn-block btn-rounded btn-info" style="border:none" href="<?php echo base_url('home');?>" class="" >Sign In</a>
            <?php } ?>      
        </div>
    </header>
    