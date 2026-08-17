<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
    <section class="page--header">
        <div class="container-fluid">
            <div class="row">

                <style type="text/css">
                    
.nav-link{
    padding: 9px 19px !important;
}

                </style>


                <div class="col-lg-6">
                    <h2 class="page--title h5">Comment On Case.......</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                        <li class="breadcrumb-item active"><span>Comment on Case</span></li>
                    </ul>



                     <ul class="nav nav-tabs nav-tabs-line-top" id="profile_tab">
                        <li class="nav-item">
                            <a href="#personal_information" data-toggle="tab" class="nav-link active">View Comment Details</a>
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

$contactas=$caseid;
  foreach ($userdata as $value) {


     $inspector_idd=$value["inspector_idd"];

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

<style type="text/css">
    li{
        
     list-style-type: none;   
    }


</style>
           <div class="row" style="padding:10px;">
         
            <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel">Case Type</label><input readonly type="text" value="<?php echo $value["assignment_name"]; ?>" class="form-control"></div>
             <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel">Case ID</label><input readonly type="text" value="<?php echo $contactas; ?>" class="form-control"></div>
<div class="col-md-12">

<style type="text/css">
      .box {
        display: flex;
       
        flex-direction: column;
        gap: 5px;
        padding:10px;border: 1px solid; margin: 10px; border-radius: 5px;
        max-height: 400px;

        /* Control snap from here */
        overflow-y: auto;
        overscroll-behavior-y: contain;
        scroll-snap-type: y mandatory;
        width: auto;
    }

    .uul > li:last-child {
        scroll-snap-align: start;
    }


</style>

    <div class="box">

<ul style="padding-right: 40px;" id="mydiv" class="uul">

<?php

$current_admin_id=$this->session->userdata('id');


 $sqlchat = "SELECT * FROM claims_chat_real where case_aid='".$contactas."' order by id ASC";

               $queryer_chat = $this->db->query($sqlchat);
                
foreach ($queryer_chat->result() as $chat_real)
{
       
$file_data= $chat_real->file_data;




$magg= $chat_real->msg;
$date_time= $chat_real->date_time;
$sender_id= $chat_real->sender_id;
$receiver_id= $chat_real->receiver_id; 
//if($sender_id==$current_admin_id)

if($sender_id=='A1')
{

$sharmafile = json_decode($file_data, true);
  
if($sharmafile!='')
{
     $fileidd=$sharmafile['file_id'];

   $file_type=$sharmafile['file_type'];

}
?>

    <li>

            <div class="row" style="padding:15px; margin-bottom: 10px">
                <div class="col-md-6"></div>
                <div class="col-md-6" style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; border-top-right-radius: 25px;
   border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;  border-top-left-radius: 25px;border:2px solid #22358e;">
    <?php

if($sharmafile!='')
{


if($file_type=='image')
{
     $filelink=$sharmafile['file_name'];

 

    ?>
                    <img  style="height: 50px; width: 100px; margin: 10px;" src="../<?php echo $filelink;?>">  

                    <?php
                    }

                }
                else
                {

                }
                    ?>         
                     <p style="padding-left:10px;"><?php echo $magg;?>
                

                <div align="right" style="padding-right:20px;">
                    - <small><em><?php echo $date_time;?></em></small>
                </div>
            </p>
                </div>


            </div>

           
        </li>


<?php

}
else
{
    ?>
      Inspector..
<li style="border-bottom:1px dotted #ccc;padding-top:8px; border-top-right-radius: 25px;
   border-top-left-radius: 25px; margin-bottom: 10px;
  
     border-bottom-right-radius: 25px;border:2px solid #22358e;list-style-type: none; padding-left:8px; padding-right:8px; width: 50%;">

            <p style="padding-left:10px;"><?php echo $magg;?>
                <div align="right">
                    - <small style="padding-right:20px;"><em><?php echo $date_time;?></em></small>
                </div>
            </p>
        </li>

    <?php
}


}

?>




        


     
</ul>

    </div>


</div>

<div class="container" style="padding:15px;margin: 5px;">
 
<form  id="commentform" method="post" enctype="multipart/form-data" >
  <div class="col-md-3">
    <input type="hidden" name="inspector_idd" value="<?php echo $inspector_idd; ?>">
    <input type="hidden" name="current_admin_id" id="current_admin_id" value="A1">
    <!--  <input type="hidden" name="current_admin_id" id="current_admin_id" value="<?php echo $current_admin_id;?>"> -->
      <input type="hidden" id="file_type" name="file_type">
      <input type="hidden" name="case_id" id="case_aid" value="<?php echo $contactas; ?>">

<input type="hidden" id="file_id" name="file_id">

<input type="hidden" id="file_name" name="file_name"><!-- 
<img alt="" src="" 
        style="height: 85px; width: 198px; margin: 10px; display: none;" id="imgClickAndChange"/> -->

          <span  style="height: 85px; width: 198px; margin: 10px;" id="myP"></span>
  </div>  

<textarea class="form-control" name="comment" id="comment" required></textarea>
<div class="col-md-12" style="margin-top: 10px; text-align: right;">
 <button class="btn btn-success" type="submit">Add Comment</button>
</div>
</form>






<script type="text/javascript">
    

$('#commentform').on('submit',function(e){

 var admin=document.getElementById("current_admin_id").value;
  var case_aid=document.getElementById("case_aid").value;



//console.log(nature_id);
  e.preventDefault(); 
    var form = $(this);
    var formdata = form.serialize();
console.log(formdata);
    $.ajax({
        type: "POST",
        url: "../add_coooemnt/"+case_aid,
        data: {formdata:formdata}, 
        dataType:'json',
        success: function(data)
        {
            console.log(data);
            if(data.status === 200){
                swal({
                title:"Success",
                type: "success",
                text: data.message,
                confirmButtonColor: "#04AA6D"
                },function(result) {
                    if(result){
                      $("#mydiv").load(location.href + " #mydiv");

document.getElementById("myP").innerHTML='';
document.getElementById("comment").value='';

                    }
                });
            }
        }
    });

});

</script>


</div>
     <!--        <?php


foreach ($jobdd as $key => $value) {






            ?>

            <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel"><?php echo $key;?></label><input readonly type="text" class="form-control" value="<?php echo $value;?>"></div>




            <?php

        }
            ?>  -->

        <!--     <div class="col-md-12" style="padding-top:10px; margin-top: 10px;"><label class="label viewlabel">Case Location</label><input readonly type="text" value="<?php echo $location;?>" class="form-control"></div>


 <div class="col-md-12" style="padding-top:5px;"><label class="label viewlabel">Inspector Name</label><input readonly type="text" value="<?php echo $inspname;?>" class="form-control"></div>

              <div class="col-md-12" style="padding-top:5px;"><label class="label viewlabel">Observations by Surveyor</label><input readonly type="text" value="<?php echo $report;?>" class="form-control"></div>
 -->

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
$file_id= $rower_bank->file_id;
$file_type= $rower_bank->file_type; 



?>


<div class="col-md-4">
    <img  class="responsive" style="width:500px; height: 250px;margin: 5px;"  src="../<?php echo $file_name; ?>">

<div class="col" style="text-align:center;">
    <button type="submit"  name="fileddd" onclick="fileselect('<?php echo $file_id;?>','<?php echo $file_name;?>','<?php echo $file_type; ?>')" class="btn btn-sm btn-success">Select Me</button>


</div>
</div>


<?php
}
?>
</div>
 </div>
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
$file_id= $rower_bank->file_id;
$file_type= $rower_bank->file_type; 

?>


<div class="col-md-4">
   
<video width="320" height="240" controls>
  <source src="../<?php echo $file_name; ?>" type="video/mp4">
 
</video>
<div class="col" style="text-align:center;">
    <button type="submit"  name="fileddd" onclick="fileselect('<?php echo $file_id;?>','<?php echo $file_name;?>','<?php echo $file_type; ?>')" class="btn btn-sm btn-success">Select Me</button>


</div>

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

<script type="text/javascript">
  function fileselect(id,name,file_type)
  {
           
           console.log(id);
           console.log(name);
      
       
        document.getElementById("file_type").value=file_type;
             document.getElementById("file_id").value=id;
            document.getElementById("file_name").value=name;

            //document.getElementById('imgClickAndChange').style.display = 'block';


            // document.getElementById("imgClickAndChange").src = '../'+name;

if(file_type=='image')
{

document.getElementById("myP").innerHTML="<img  style='height: 85px; width: 198px; margin: 10px;' src=../"+name+">";
}
else if(file_type=='video')
{
 document.getElementById("myP").innerHTML="<video style='height: 85px; width: 198px; margin: 10px;' controls> <source src=../"+name+" type='video/mp4'></video>";   
}

//document.getElementById("myP").innerHTML="<video controls><source src='' type='video/mp4'></video>";


                swal({
                title:"Success",
                type: "success",
                text: "File Select Successfull",
                confirmButtonColor: "#04AA6D"
                
                });
            

}
              


</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

<?php $this->load->view('adminpanel/layout/footer'); ?>

