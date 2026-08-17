<?php $this->load->view('adminpanel/layout/header'); ?>
<!-- Sidebar Start -->
<style>
    .sidebar--nav ul li a {
        color: black;
    }
</style>
<aside class="sidebar" style="background-color: #ffe4e1;">
    <div class="sidebar--nav">
        <ul>
            <li>
                <a href="#">More Action</a>
                <ul>
                    <li><a href="<?php echo base_url('viewcasedetail?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') . ''); ?>"><i class="fa fa-eye"></i>View Case</a></li>
                    <li><a href="<?php echo base_url('viewlor?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') . ''); ?>"><i class="fa fa-list-alt"></i>Prepare LOR</a></li>
                    <li><a href="<?php echo base_url('prepareemail?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') . ''); ?>"><i class="fa fa-envelope"></i>Email</a></li>
                    <?php if (!isset($assignmentType) || $assignmentType != 'outgoing') { ?>
                        <li>
                            <a href="<?php echo base_url('billing?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data')); ?>">
                                <i class="fa fa-credit-card"></i>Invoice
                            </a>
                        </li>
                    <?php } ?>
                    <li><a href="" id="openShareCaseModal" data-toggle="modal" data-target="#share_case"><i class="fa fa-share"></i>Give Case Access</a></li>
                    <li><a href="<?php echo base_url('dispatch?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') . ''); ?>"><i class="fa fa-paper-plane"></i>Dispatch</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<div id="share_case" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="shareCaseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareCaseLabel">Share Case : <span style="color:green"><?php echo $aid; ?></span></h5>
                <a class="close" onclick="closeModalFunction()">&times;</a>
            </div>
            <div class="modal-body">
                <form method="post" id="sharecase">
                    <div class="form-group">
                        <label>
                            <span class="label-text">Mobile Number</span>
                            <input type="text" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number..." class="form-control">
                        </label>
                    </div>
                    <div style="text-align: right;">
                        <button type="submit" class="btn btn-success">Share</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function closeModalFunction() {
        $('#share_case').modal('hide');
    }

    var assignmentType = <?= json_encode($assignmentType) ?>;
    console.log(assignmentType);
</script>
<!-- Sidebar End -->