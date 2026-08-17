<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Non Location Based Job</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span><?php echo $case; ?></span></li>
                </ul>
            </div>
            <?php if($case == "Outgoing case"){ ?>
            <div class="col-lg-6" style="text-align:right; align-self: center; padding-right:7px;">
                <a href="<?php echo base_url('nonlocationcase'); ?>"  class="btn btn-rounded btn-success">Create new case</a>
            </div>
            <?php }?>
        </div>
    </div>
</section>