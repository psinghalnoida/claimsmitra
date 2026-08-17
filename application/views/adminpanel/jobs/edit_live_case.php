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
    <section class="main--content">
        <div class="panel">
          
          <?php

  foreach ($userdata as $value) {

     $contactas=$value["claims_aid"];

    $natureofjob=$value["natureofjob"];

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

           <div class="row" style="padding:10px;">
         
            <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel">Case Type</label><input readonly type="text" value="<?php echo $value["assignment_name"]; ?>" class="form-control"></div>

              <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel">Case Id</label><input readonly type="text" value="<?php echo $contactas; ?>" class="form-control"></div>

             <form  action="<?php echo base_url(); ?>update_live_case/<?php echo $contactas;?>" method="post" class="row" style="padding:20px;" enctype="multipart/form-data">

            <?php


foreach ($jobdd as $key => $value) {






            ?>

            <div class="col-md-6" style="padding-top:5px;"><label class="label viewlabel"><?php echo $key;?></label><input  type="text" class="form-control"  name ="<?php echo $key;?>" value="<?php echo $value;?>"></div>




            <?php

        }
            ?> 

<div class="col-md-12" style="margin-top: 10px;">
 <button class="btn btn-danger" type="submit">Update</button>
</div>
</form>
            <div class="col-md-12" style="padding-top:10px; margin-top: 10px;"><label class="label viewlabel">Case Location</label><input  type="text" value="<?php echo $location;?>" class="form-control" readonly></div>


 <div class="col-md-12" style="padding-top:5px;"><label class="label viewlabel">Inspector Name</label><input readonly  type="text" value="<?php echo $inspname;?>" class="form-control"></div>

              <div class="col-md-12" style="padding-top:5px;"><label class="label viewlabel">Inspector Report</label><input  type="text" value="<?php echo $report;?>" class="form-control" readonly></div>


           </div>


<?php
}

?>


        </div>
    </section>

<script type="text/javascript">
    


$('#caseedit').on('submit',function(e){

 var nature_id=document.getElementById("nature_of_job").value;
console.log(nature_id);
  e.preventDefault(); 
    var form = $(this);
    var formdata = form.serialize();
    $.ajax({
        type: "POST",
        url: "job/tanslation_insert",
        data: {formdata: formdata,nature_id:nature_id}, 
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
                       window.location.href = "translation";
                    }
                });
            }
        }
    });

});

</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

<?php $this->load->view('adminpanel/layout/footer'); ?>

