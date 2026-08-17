<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"><style>
    .fileUpload{
    display: block;
    visibility: hidden;
    width: 0;
    height: 0;
}
#imageUpload, #videoUpload,#documentImgUpload{
    float: right;
    background-color: #2bb3c0;
    color: #fff;
    border: 1px solid #2bb3c0;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<section class="page--header" style="margin:15px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">New Assignment</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard'); ?>">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span><?php echo $view; ?></span></li>
                </ul>
            </div>
            <?php if($view == "Case Data"){ ?>
            <div class="col-lg-6" >
                <div class="d-flex justify-content-end">
                    <a href="<?php echo base_url('locationoutgoing'); ?>" class="btn btn-rounded btn-success">All Cases</a>
                </div>
            </div>
            <?php } ?>
            <?php if($view == "Outgoing case"){ ?>
            <div class="col-lg-6" style="text-align:right; align-self: center; padding-right:7px;">
                <a href="<?php echo base_url('locationcase'); ?>"  class="btn btn-rounded btn-success">Create new case</a>
            </div>
            <?php } else if($view == "Case Data"){?>
                <div class="col-lg-6" style="text-align:right; align-self: center; padding-right:7px;">
                    
                </div>
            <?php }else if($view == "Images"){?>
                <div class="col-lg-6">
                    <input type="file" name="images[]" multiple size="chars" class="fileUpload" id="images" style="display: none;" multiple>
                    <button id="imageUpload">Image <i class="fa-solid fa-upload"></i></button> 
               </div>
            <?php }else if($view == "Videos"){?>
                    <div class="col-lg-6">
                        <input type="file" name="videos[]" multiple size="chars" class="fileUpload" id="videos" accept=".mp4"  style="display: none;">
                        <button id="videoUpload">Video <i class="fa-solid fa-upload"></i></button> 
                    </div>
            <?php }else if($view == "Documents"){?>
            <div class="col-lg-6">
                <input type="file" name="documents[]" multiple class="fileUpload" id="documents" accept=".pdf, .jpg, .jpeg, .png" style="display: none;">
                <button id="documentImgUpload">Document <i class="fa-solid fa-upload"></i></button> 
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<script>
$('button').click(function(){
    $('input').click();
});
</script>


