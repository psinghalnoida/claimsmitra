<?php $this->load->view('adminpanel/layout/sidebar'); ?> 
<main class="main--container">
<section class="page--header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page--title h5">Surveyors</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                    <li class="breadcrumb-item active"><span>Surveyors</span></li>
                </ul>
            </div>
            <div class="col-lg-6" style="text-align:right;">
                <a href="<?php echo base_url('createcompany'); ?>"  class="btn btn-rounded btn-success">Create new surveyor</a>
            </div>
        </div>
    </div>
</section>
<section class="main--content">
    <div class="container-fluid">   
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="userlist" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th class="not-sortable">Actions</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
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
<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET USERS LIST
* ------------------------------------------------------------------------- */
var $recordsListView = $('#userlist');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        "serverSide":true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        
        language: {
            "lengthMenu": "View _MENU_ records"
        },
        order: [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('users/getuserslist'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}
</script>    
