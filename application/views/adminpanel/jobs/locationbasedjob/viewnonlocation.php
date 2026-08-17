<?php $this->load->view('adminpanel/layout/sidebar');?>
<?php $this->load->view('adminpanel/layout/right-sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab10">
        <?php $this->load->view('adminpanel/jobs/nonlocationbasedjob/heading');?>
        <section class="page--header" style="width:100%;border: 1px solid #E5E4E2;border-radius: 50px; background-color:#ffe4e1;">
            <div class="container-fluid">
                <div class="row">
                    <?php foreach ($casedata as $val) { ?>
                    <table style="width:50%">
                        <tr>
                        <th>AID:</th>
                        <td><?php echo $val['aid'] ?></td>
                        </tr>
                        <tr>
                        <th>Nature of assignment</th>
                        <td><?php echo $val['investigator_type'] ?></td>
                        </tr>
                        <tr>
                        <th>Details of assignment </th>
                        <td> <?php echo $val['jobdata'] ?> </td>
                        </tr>
                    </table>
                    <table style="width:50%">
                        <tr>
                        <th>Date of assignment:</th>
                        <td> <?php echo $val['createdat'] ?> </td>
                        </tr>
                        <tr>
                        <th>Creator / Inspector :</th>
                        <td><?php echo $val['salutation']." ".$val['firstname']." ".$val['lastname']?></td>
                        </tr>
                        <tr>
                        <th>Status :</th>
                        <td>
                            <a href="#">
                                <span class="label label-warning"><?php echo $val['status'] ?></span>
                            </a>
                        </td>
                        </tr>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="main--content"  >
            <div class="row gutter-20">
                <div class="col-xl-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <?php if(isset($view)){?>
                                    <?php if($view == "View Outgoing Case") {?>    
                                        Outgoing Documents
                                    <?php } else{?>
                                        Incoming Documents
                                    <?php } ?>
                                <?php }?>
                            </h3>
                        </div>
                        <div class="panel-chart">
                            <div class="container">
                                <div class="row photos">
                                    <table id="incomingcase" class="table table-bordered table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>File Name</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($casedata as $value) { ?>
                                                <?php $i = 1;?>
                                                <?php foreach (explode(',',$value['docs']) as $doc) { ?>
                                                    <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo trim($doc); ?></td>
                                                    <td><div class="col-lg-3"><a href="<?php echo base_url('assets/upload/'.trim($doc).''); ?>" data-lightbox="photos"><img class="img-fluid" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>"></a></div></td>
                                                    </tr>
                                                <?php $i++;?>
                                                <?php } ?>
                                            <?php } ?>    
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div style="text-align:left;">
                                <h3 class="panel-title">
                                <?php if(isset($view)){?>
                                    <?php if($view == "View Outgoing Case") {?>    
                                        Incoming Report
                                    <?php } else{?>
                                        Outgoing Report
                                    <?php } ?>
                                <?php }?>    
                                </h3>
                            </div>
                            <?php if(isset($view)){?>
                                <?php if($view == "View Incoming Case"){ ?>
                                    <div style="text-align:right;">
                                        <a href="javascript:void(0)" id="upload-files" class="nav-link">
                                            <i class="fa fa-upload"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php }?>
                        </div>            
                        <div class="panel-chart">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $this->load->view('adminpanel/jobs/modal/upload_files');?>
<?php $this->load->view('adminpanel/layout/footer');?>    
<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET INCOMING CASE LIST
* ------------------------------------------------------------------------- */
$("#upload-files").click(function() {
    $("#uploadfiles").modal('show');
});

$('input[id="uploadreport"]').on('change', function() {
    for (var i = 0; i < this.files.length; i++) {
        var fr = new FileReader();
        fr.onload = function(e) {
        $('#report_thumb').append('<a href="' + e.target.result + '"><img src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" width="50px" height="50px"/></a>');
        }
        fr.readAsDataURL(this.files[i]);
    }
});


$(document).ready(function() {
    // Set the target date and time for the countdown (e.g., December 31, 2023, 23:59:59).
    var targetDate = new Date("2023-12-31T23:59:59").getTime();

    var interval = setInterval(function() {
        var now = new Date().getTime();
        var timeRemaining = targetDate - now;

        if (timeRemaining <= 0) {
            clearInterval(interval);
            $("#timer").html("<p>Countdown expired!</p>");
            return;
        }

        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        //var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        $("#days").text(days < 10 ? "0" + days : days);
        $("#hours").text(hours < 10 ? "0" + hours : hours);
        $("#minutes").text(minutes < 10 ? "0" + minutes : minutes);
        //$("#seconds").text(seconds < 10 ? "0" + seconds : seconds);
    }, 1000);
});
</script>