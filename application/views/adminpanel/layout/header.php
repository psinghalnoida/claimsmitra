<?php $this->load->view('adminpanel/layout/head'); ?>
<!-- Wrapper Start -->
<div class="wrapper">
    <header class="navbar navbar-fixed">
        <div class="navbar--header">
            <div class="logo">
                <a href="javascript:void(0);">
                    <img style="height:30px;height: 30px;display: block;margin-left: auto; margin-right: auto; width: 12%" src="<?php echo base_url(); ?>assets/img/account/logo.png" alt="">
                    <h3 style="text-align:center; color:white;" class="h3"><a href="javascript:void(0);">Claims Mitra</a></h3>
                </a>
            </div>
            <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!-- <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
            <i class="fa fa-bars"></i>
        </a> -->

        <div class="center-alert-container">
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Success!</strong> Job data has been created successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="navbar--search">
            <!-- <h2 class="page--title h5"><?php echo $view; ?></h2> -->
            <ul class="breadcrumb">
                <li class="breadcrumb-item h5"><span id="companyName"></span></li>
                <li class="breadcrumb-item active h5"><span id="departmentName"></span></li>
                <!-- <li class="breadcrumb-item active h5"><span><?php echo $view; ?></span></li> -->
            </ul>
        </div>
        
        <div class="navbar--nav ml-auto">
            <ul class="nav">
                <li class="nav-item dropdown nav--user online">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <?php if ($this->session->userdata('profilephoto') != null || $this->session->userdata('profilephoto') != "") { ?>
                            <img src="<?php echo $this->session->userdata('profilephoto');  ?>" alt="" class="rounded-circle">
                        <?php } else { ?>
                            <img src="<?php echo base_url('assets/profile/user.png');  ?>" alt="" class="rounded-circle">
                        <?php } ?>
                        <span><?php echo $this->session->userdata('firstname'); ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($this->session->userdata('profession') !== "Admin") { ?>
                            <li>
                                <!-- <a href="<?php echo base_url('profilemanagement?tab=personal_information') ?>"><i class="far fa-user"></i>Profile</a> -->
                                <a href="<?php echo base_url('profilemanagement?' . 'data=' . $this->input->get('data') .''); ?>"><i class="far fa-user"></i>Profile</a>

                            </li>
                        <?php } ?>
                        <li class="dropdown-divider"></li>
                        <li><a href="<?php echo base_url('user_logout'); ?>"><i class="fa fa-power-off"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <!-- Navbar End -->