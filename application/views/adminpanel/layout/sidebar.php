<?php $this->load->view('adminpanel/layout/header'); ?>
<style>
    #companySelect option{
        background-color: #151515;
        height:30px;
        font-size:11px;
        color: white;
    }

    #departmentSelect option{
        background-color: #151515;
        height:30px;
        font-size:11px;
        color: white;
    }
</style>
<aside class="sidebar" data-trigger="scrollbar">
    <!-- Sidebar Profile Start -->
    <div class="sidebar--profile" style="padding-bottom: 0px; padding-top:1px;">
        <div class="profile--name">
            <a href="#" class="btn-link"><?php echo $this->session->userdata('firstname'). ' ' . $this->session->userdata('lastname'); ?></a>
        </div>
        <?php $session_data = $this->session->userdata('companysetting'); ?>
        <div class="user-type">
           
        </div>
        <div class="col-md-12">
            <div class="panel" style="background-color: #151515;">
                <div class="panel-content departmentcompany" style="border-top:none">
                    <div class="form-group row">
                        <div class="col-md-12">
                                <!-- COMPANY DROPDOWN -->
                                <select id="companyDropdown" name="companyDropdown" class="form-control" style="background-color: #151515;height:30px;  font-size:11px;color: white;">
                                </select>

                                <!-- DEPARTMENT DROPDOWN -->
                                <div id="departmentArea" style=" margin-top: 10px;">
                                    <select id="departmentDropdown" name="departmentDropdown" class="form-control" style="background-color: #151515;height:30px; font-size:11px;color: white;">
                                    </select>
                                </div>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <div class="col-md-12">
                            <select name="departmentSelect" id="departmentSelect" class="form-control" style="background-color: #151515;height:30px; font-size:11px;color: white;">
                                
                            </select>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar Profile End -->
    <!-- Sidebar Navigation Start -->
    <div class="sidebar--nav" id="sidebar-view">

    </div>
    <!-- Sidebar Navigation End -->
</aside>