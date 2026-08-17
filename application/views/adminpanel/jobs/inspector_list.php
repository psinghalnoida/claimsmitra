<?php $this->load->view('adminpanel/layout/sidebar'); ?> 
<main class="main--container">
<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Inspector</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span>Inspector</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="main--content">
    <div class="panel">
        <div class="records--list" data-title="Users">
<div class="col-md-12" style="padding: 15px;">
 <input type="text" style="border-radius: 20px; padding: 10px;" id="myInput" placeholder="Search .." title="Type in a name">

</div>
        <div class="col-md-2">
       <label>Case ID</label>
       <input type="text" style="padding: 3px;border: none" name="caseidd" id="case_idd" readonly value="<?php echo $case_id;?>">
             </div>

             <table id="recordsListView">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Assign</th>
                       
                    </tr>
                </thead>
                <?php foreach ($userdata as $value) { ?>
                <tbody>
                  
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['firstname'] ?></td>
                    <td><?php echo $value['mobile'] ?></td>
                    <td><?php echo $value['email'] ?></td>
                    <td>

                        <button class="btn btn-sm-success" style="border-radius:10px" onclick="asignme(<?php echo $value['id'];?>)"  data-toggle="tooltip"  data-original-title="Asign Me"><i class="fa fa-flag" aria-hidden="true"></i></button></td>
                    
                </tbody>
                <?php } ?>
            </table>




            <script>

/*var $rows = $('#recordsListView tbody');
$('#myInput').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});*/
///submit


function asignme(idd){
 var nature_id=document.getElementById('case_idd').value;
console.log(nature_id);
   $.ajax({
        type: "POST",
        url: "../asign_to_inspector/"+idd,
         data: {case_id:nature_id}, 
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
                       window.location.href = "../live_location_based";
                    }
                });
            }
        }
    });
};

</script>
        </div>
    </div>
</section>
<!-- Large Modal Start -->
<div id="viewuser" class="modal fade" style="margin-left: 17px;">
    <div class="modal-dialog" style="max-width:100%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h1>Welcome To Claimsmitra</h1>
                <form id="regForm" action="">
                  <!-- One "tab" for each step in the form: -->
                  <div class="tab" style="width:100%;">
                    <label style="margin-bottom: 10px;">Enter Mobile Number</label>
                    <p><input id="mobile" placeholder="Mobile Number" oninput="this.className = ''" name="mobileno">
                        <button type="button" id="verifyBtn" onclick="verifyNumber()">Verify</button>
                    </p>
                    <div style="display:none">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-6">
                            <div class="text-center mb-4">
                                <h5>Please enter the 4-digit verification code we sent via SMS:</h5>
                                <input id="mobile" class="otpfield"  name="mobileno">
                                <input id="mobile" class="otpfield"  name="mobileno">
                                <input id="mobile" class="otpfield"  name="mobileno">
                                <input id="mobile" class="otpfield"  name="mobileno">
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-6">
                            <div class="text-center mb-4">
                                <h5>Don't receive the code? Resend in <span class="js-timeout"> 2:00</span></h5>
                                
                            </div>
                        </div>        
                    </div>
                    <div class="row align-items-center" id="resend" style="display:none" >
                        <div class="col-lg-12 col-md-6">
                            <div class="text-center mb-4">
                                <button type="button" id="resendBtn" >Resend</button>
                            </div>
                        </div>        
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-6">
                            <div class="text-center mb-4">
                                <a href="">Change Mobile Number?</a>
                            </div>
                        </div>        
                    </div>
                    </div>
                  </div>
                  <div class="tab">
                    <label style="margin-bottom: 10px;">Enter Full Name</label>
                    <p>
                        <select oninput="this.className = ''" name="salutation">
                            <option>Select Salutation</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Ms.">Ms.</option>
                        </select>
                    </p>
                    <p><input placeholder="First name" oninput="this.className = ''" name="fname"></p>
                    <p><input placeholder="Last name" oninput="this.className = ''" name="lname"></p>
                  </div>
                  <div class="tab">
                    <label style="margin-bottom: 10px;">Contact Info</label>
                    <p><input placeholder="E-mail" oninput="this.className = ''" name="email"></p>
                    <p><input placeholder="Address" oninput="this.className = ''" name="address"></p>
                  </div>
                  <div class="tab">
                    <label style="margin-bottom: 10px;">KYC Documents</label>
                    <p><input placeholder="PAN Number" oninput="this.className = ''" name="pan_number"></p>
                    <p><input placeholder="Aadhar Number" oninput="this.className = ''" name="adhar_number"></p>
                  </div>
                  <div style="overflow:auto; margin-top: 40px;">
                    <div style="float:right;">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                  </div>
                  <!-- Circles which indicates the steps of the form: -->
                  <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Large Modal End -->
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script>
    var $recordsList = $('.records--list');
    $recordsListView = $('#recordsListView');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
       
        responsive: true,
        processing: true,
       
        language: {
            "lengthMenu": "View _MENU_ records"
        },
        dom: '<"topbar"<"toolbar"><"right"li>><"table-responsive"t>p',
       
        
       
    });
   
}


    
</script>
