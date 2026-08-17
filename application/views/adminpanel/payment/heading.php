<section class="page--header" style="margin:15px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5"><?php echo $case; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span><?php echo $case; ?></span></li>
                </ul>
            </div>
            <?php if($case == "Outgoing case"){ ?>
            <div class="col-lg-6" style="text-align:right; align-self: center; padding-right:7px;">
                <a href="<?php echo base_url('nonlocationcase'); ?>"  class="btn btn-rounded btn-success">Create new case</a>
            </div>
            <?php } else if($case == "Wallet"){ ?>
            <div class="col-lg-6" style="text-align:right; align-self: center; padding-right:7px;">
                <a href="<?php echo base_url('addmoney'); ?>"  class="btn btn-rounded btn-success">Add Money</a>
            </div>
            <?php } ?>
            <?php if(isset($view)){?>
                <div class="col-lg-6" style="text-align:right;">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="countdown">
                                <div class="countdown-item">
                                    <span id="days" class="countdown-number">00</span>
                                    <span class="countdown-label">Days</span>
                                </div>
                                <div class="countdown-item">
                                    <span id="hours" class="countdown-number">00</span>
                                    <span class="countdown-label">Hours</span>
                                </div>
                                <div class="countdown-item">
                                    <span id="minutes" class="countdown-number">00</span>
                                    <span class="countdown-label">Minutes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>