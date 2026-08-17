<?php $this->load->view('adminpanel/layout/sidebar'); ?> 
<main class="main--container">
<script type="text/javascript" 
        src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
  
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    </script>

<style type="text/css">
    .dataTables_wrapper{
        padding: 15px;
    }


</style>

  <ul class="nav nav-tabs nav-tabs-line-top">


        <li class="nav-item">

         <a href="<?php echo base_url('live_location_based');?>"  class="nav-link <?php if($case_type=='running_case') { echo 'active'; } ?>">Running Cases</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('completed_case');?>"  class="nav-link <?php if($case_type=='completed_case') { echo 'active'; } ?> ">Completed Cases</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('deleted_case');?>" class="nav-link <?php if($case_type=='deleted_case') { echo 'active'; } ?> ">Deleted Case</a>
        </li>
    </ul>

<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Live Location Based</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span>Live Location Based</span></li>
                </ul>
            </div>

             <div class="col-lg-6" style="padding-top:6px">
                    <!-- Summary Widget Start -->
                    <div class="summary--widget">
                    <!--     <div class="summary--item">
                            <a href="#job_based_on" data-toggle="modal" class="btn btn-rounded btn-success">Create new job</a>

                              
                        </div> -->
                    </div>
                    <!-- Summary Widget End -->
                </div>
        </div>
       
</div>
</section>
<section class="main--content">
    <div class="panel">
        <div class="records--list" data-title="Users">
             <table id="recordsListView_live_sharma">
                <thead>
                    <tr>
                      
                        <th>AID</th>
                            <th>Nature Of Assignment</th>
                              <th>User</th>
                            
                             <th>Assignor</th>
                             <th>Inspector </th>
                              <th>Location</th>
                               <th>Status</th>
                               <th>location share</th>
                                <th>Action</th>
                    </tr>
                </thead>
                  <tbody>
                 <?php
$id=1;
 $case_type;
                                 foreach ($userdata as $value) {

 $assigned_by=$value["assigned_by"];

  $assigned_to=$value["assigned_to"];



   $assigned_by_mob=$value["assigned_by_mob"];

  $assigned_to_mob=$value["assigned_to_mob"];








 $case_aid=$value["claims_aid"];

    $contactas=$value["jobdata"];

$sharma = json_decode($contactas, true);
 $creatorname=$sharma['name_contact_person'];
 $creatorcontact=$sharma['mobile_contact_person'];

$sts=$value['case_status'];
$realsts='';
if($sts==0)
{
$realsts='Pending';
}
else if($sts==1)
{
$realsts='Accepted';
}
else if($sts==2)
{
$realsts='Running';

}
else if($sts==3)
{

$realsts='Waiting';
}
else if($sts==4)
{
$realsts='Archive';

}
else if($sts==5)
{
$realsts='Rejected';

}
else if($sts==6)
{
$realsts='Completed';

}

else 
{
$realsts='';

}





                                  ?>




                <tr>
                 
                     <td><?php echo $case_aid ?></td>
                    <td><?php echo $value['assignment_name'] ?></td>
                     <td><p> <?php echo $creatorname;?></p><p><?php echo $creatorcontact;?></p></td>
                 

                   <td><p> <?php echo $assigned_by;?></p><p><?php echo $assigned_by_mob;?></p></td>

                     <td><p> <?php echo $assigned_to;?></p><p><?php echo $assigned_to_mob;?></p></td>


                           
                     
                       <td style="width: 180px;"><?php echo $value['location'] ?></td>
                      
                        <td><?php echo $realsts; ?></td>
                        <td>

                           

                           <!--  <button type="button" style="padding: 3px 10px;margin: 2px;"  onclick="myFunction(<?php echo $value['claimsid'] ?>)" class="btn btn-sm-success">copy</button> -->
                            
<?php


$hashed_idd = password_hash($value['claimsid'], PASSWORD_DEFAULT);






?>
   </br>                         
                         
 <button type="button" class="btn btn-sm-success" onclick="open_share_location_box('<?php echo  $hashed_idd;?>','<?php echo base_url();?>');">Location</button>
<!-- <input type="text" style="width:50px; padding:0px" id="url<?php echo$value['claimsid'] ?>" value="http://localhost/inspection/arpit_code/newclaimsmitra/location.php?hashtoken=<?php echo $hashed_idd;?>"> -->


          
                             





                        </td>

 <td> 


 <a href="<?php echo base_url(('view_live_case_details/'.$value['claims_aid'] )); ?>">
    <button class="btn btn-info btn-sm mr-1"  data-toggle="tooltip"  data-original-title="View" ><i class="fas fa-eye"></i></button></a>


<a href="<?php echo base_url(('comment/'.$value['claims_aid'] )); ?>">
    <button class="btn btn-sm-success btn-sm"  data-toggle="tooltip"  data-original-title="comment" > <i class="far fa-comment" aria-hidden="true"></i></button></a>



<a href="<?php echo base_url(('assign_inspector_list/'.$value['claims_aid'] )); ?>">
    <button class="btn btn-sm-success btn-sm"  data-toggle="tooltip"  data-original-title="Assign Inspector" ><i class="fa fa-paper-plane" aria-hidden="true"></i></button></a>

<?php  if($sts==0 && $case_type!='deleted_case')
{


?>
 <button class="btn btn-danger btn-sm mr-1" onclick="delete_casee(<?php echo $value['claims_aid'];?>)"  data-toggle="tooltip"  data-original-title="Delete"><i class="fas fa-trash"></i></button>
<?php
}

?>

  </td>
                
                   
                </tr>
                <?php 

$id++;
            } ?> 

             </tbody> 
            </table>
        </div>
    </div>
</section>



<script type="text/javascript">
  

</script>
 <div id="job_based_on" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/job_based_on');?>
    </div>


 <div id="live_creation_jobs" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/create_live_location_job');?>
    </div>




 <div id="locationaaa" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/live_share_location');?>
    </div>





 <div id="non_location" class="modal fade">
        <?php $this->load->view('adminpanel/jobs/non_location_based');?>
    </div>




<!-- Large Modal End -->
<?php $this->load->view('adminpanel/layout/footer'); ?>


     <script>
  
        // Initialize the DataTable
        $(document).ready(function () {
            $('#recordsListView_live_sharma').DataTable({
                  searching: true
            });
        });
    </script>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/live_location_based.js"></script>  

    <script src="<?php echo base_url();?>assets/js/location_based.js"></script>
