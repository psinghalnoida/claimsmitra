<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
    <section class="page--header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="page--title h5">Work sharma. View.......</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                        <li class="breadcrumb-item active"><span>Translation job View</span></li>
                    </ul>

                     <ul class="nav nav-tabs nav-tabs-line-top" id="profile_tab">
                        <li class="nav-item">
                            <a href="#personal_information" data-toggle="tab" class="nav-link active">View Case Details</a>
                        </li>
                   
                        <li class="nav-item">
                            <a href="#image_information" data-toggle="tab" class="nav-link">All Images</a>
                        </li>
                        <li class="nav-item">
                            <a href="#video_information" data-toggle="tab" class="nav-link">All VIdeos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#document_information" data-toggle="tab" class="nav-link">All Documents</a>
                        </li>
                       
              
                    </ul>

                </div>

                   





                <div class="col-lg-6" style="padding-top:6px">
                    <!-- Summary Widget Start -->
                    <div class="summary--widget" style="text-align: right;">
                        <div class="summary--item">
                            <button  onclick="history.back()" data-toggle="modal" class="btn btn-rounded btn-info"> << Back</button>


                        </div>
                    </div>
                    <!-- Summary Widget End -->
                </div>
            </div>
        </div>
    </section>

    <style type="text/css">
        
.btn{
    border-radius: 5px !important;
}
.viewlabel{
    
color: #696969;
font-weight: 700 !important;
}

    </style>
    <section class="tab-content">
 
         <div class="panel tab-pane fade  show active" id="personal_information">
          
          <?php

  $contactas=$case_idd;

  foreach ($userdata as $value) {

  //  $contactas=$value["aid"];

    $report=$value["inspector_report"];

    $location=$value["location"];


$inspector_f_name=$value["inspector_f_name"];
$inspector_l_name=$value["inspector_l_name"];

$inspname=$inspector_f_name.$inspector_l_name;

$jobdd= json_decode($value["jobdata"]);

/*   foreach ($jobdd as $key => $value) {  // another way to get keys and values.
    echo $key .' ' . $value;
    echo "</br>";
}
*/





          ?>


<div class="col-md-12">

   <a href="<?php echo base_url(('edit_live_case_details/'.$contactas)); ?>">
 <button class="btn btn-primary  btn-sm mr-1" style="background:#6777ef;" data-toggle="tooltip"  data-original-title="Edit" ><i class="fas fa-pencil-alt"></i></button></a>

</div>
           <div class="row" style="padding:10px;">
         
            <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel">Case Type</label><input readonly type="text" value="<?php echo $value["assignment_name"]; ?>" class="form-control"></div>

            <?php


foreach ($jobdd as $key => $value) {






            ?>

            <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel"><?php echo $key;?></label><input readonly type="text" class="form-control" value="<?php echo $value;?>"></div>




            <?php

        }
            ?> 

            <div class="col-md-12" style="padding-top:10px; margin-top: 10px;"><label class="label viewlabel">Case Location</label><input readonly type="text" value="<?php echo $location;?>" class="form-control"></div>


 <div class="col-md-12" style="padding-top:5px;"><label class="label viewlabel">Inspector Name</label><input readonly type="text" value="<?php echo $inspname;?>" class="form-control"></div>

              <div class="col-md-12" style="padding-top:5px;"><label class="label viewlabel">Observations by Surveyor</label><input readonly type="text" value="<?php echo $report;?>" class="form-control"></div>


           </div>


<?php
}
//normal information end
?>

</div>


<div class="panel tab-pane fade" id="image_information">
    <div class="row" style="padding:20px;">
        <div class="col-md-12">
    <h5>Photos</h5>
</div>
<?php
                                       
     $sql = "SELECT * FROM claims_job_file where case_aid='".$contactas."' and file_type='image'";

               $queryer_bank = $this->db->query($sql);
                
foreach ($queryer_bank->result() as $rower_bank)
{
       

$file_name= $rower_bank->file_name; 
$file_idd= $rower_bank->file_id; 



?>


<div class="col-md-4">
    <img  id="myImg<?php echo $file_idd; ?>" onclick="bigimg(<?php echo $file_idd; ?>)"  class="responsive" style="width:500px; height: 250px;margin: 5px; cursor: pointer;"  src="../<?php echo $file_name; ?>">

</div>

<?php
}
?>
</div>
 </div>


<!-- The Modal -->
<div id="myModal" class="modal" style="background:#00000094;">
  <span class="close" style="padding: 5px;
    font-size: 41px;
    color: #fff;
    opacity: 11;">&times;</span>
  <img class="modal-content" id="img01" style="max-height: 700px;
    text-align: center;
    ">
  <div id="caption"></div>
</div>

<script>
// Get the modal
    function bigimg(idd)
    {
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg"+idd);
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

  modal.style.display = "block";
  modalImg.src = img.src;
  captionText.innerHTML = this.alt;

}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var modal = document.getElementById("myModal");

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}


</script>

 <div class="panel tab-pane fade" id="video_information">
    <div class="row" style="padding:20px;">
        <div class="col-md-12">
    <h5>Videos</h5>
</div>
<?php
                                       
     $sql = "SELECT * FROM claims_job_file where case_aid='".$contactas."' and file_type='video'";

               $queryer_bank = $this->db->query($sql);
                
foreach ($queryer_bank->result() as $rower_bank)
{
       

$file_name= $rower_bank->file_name; 



?>


<div class="col-md-4">
   
<video width="320" height="240" controls>
  <source src="../<?php echo $file_name; ?>" type="video/mp4">
 
</video>
</div>

<?php
}
?>
</div>
 </div>



 <div class="panel tab-pane fade" id="document_information">
    <div class="row" style="padding:20px;">
        <div class="col-md-12">
    <h5>Documents</h5>
</div>
<?php
                                       
     $sql = "SELECT * FROM claims_job_file where case_aid='".$contactas."' and file_type='pdf'";

               $queryer_bank = $this->db->query($sql);
                
foreach ($queryer_bank->result() as $rower_bank)
{
       

$file_name= $rower_bank->file_name; 



?>


<div class="col-md-12">


   <iframe
    src="../<?php echo $file_name; ?>"
 
    scrolling="auto"
    height="600px"
    width="100%"
></iframe>
</div>

<?php
}
?>
</div>
 </div>

</section>





<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

<?php $this->load->view('adminpanel/layout/footer'); ?>

