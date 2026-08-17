<?php $this->load->view('adminpanel/layout/sidebar'); ?> 
<!-- Main Container Start -->
<main class="main--container">            
    <section class="main--content" style="margin-top: 15px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Panel Start -->
                    <div class="panel" style="padding-bottom:15px;">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Profile</h3>
                        </div>
                        <ul class="nav nav-tabs nav-tabs-line-top" id="profile_tab" style="padding-left:15px; padding-right:15px;">
                            <li class="nav-item">
                                <a href="<?php echo base_url('profilemanagement?' . 'data=' . urlencode($this->input->get('data')) . '&tab=' . urlencode($this->encryption->encrypt('personal_information'))); ?>" 
                                class="nav-link <?= ($active_tab == 'personal_information') ? 'active' : '' ?>">Personal Information</a>
                            </li>
                            <?php if($this->session->userdata('usertype') !== "ADMINISTRATOR") { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('profilemanagement?' . 'data=' . urlencode($this->input->get('data')) . '&tab=' . urlencode($this->encryption->encrypt('bank_information'))); ?>" 
                                    class="nav-link <?= ($active_tab == 'bank_information') ? 'active' : '' ?>">Bank Information</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('profilemanagement?' . 'data=' . urlencode($this->input->get('data')) . '&tab=' . urlencode($this->encryption->encrypt('kyc_documents'))); ?>" 
                                    class="nav-link <?= ($active_tab == 'kyc_documents') ? 'active' : '' ?>">KYC Documents</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('profilemanagement?' . 'data=' . urlencode($this->input->get('data')) . '&tab=' . urlencode($this->encryption->encrypt('licence'))); ?>" 
                                    class="nav-link <?= ($active_tab == 'licence') ? 'active' : '' ?>">Licence</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('profilemanagement?' . 'data=' . urlencode($this->input->get('data')) . '&tab=' . urlencode($this->encryption->encrypt('corporate'))); ?>" 
                                    class="nav-link <?= ($active_tab == 'corporate') ? 'active' : '' ?>">Corporate</a>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content" style="margin-left:15px; margin-right:15px;" id="updateProfileSection">
                            <div class="tab-pane fade <?= ($active_tab == 'personal_information') ? 'show active' : '' ?>" id="personal_information">
                                <?php foreach ($user_data as $value) { ?>
                                    <form id="updateProfile" method="post" enctype="multipart/form-data"> 

                                        <!--USER PROFILE PHOTO -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group" style="text-align:center; padding-top:15px;">
                                                    <label for="profile_image_upload">
                                                    <?php
                                                        $profilePhoto = $value['profilephoto'];
                                                        $imagePath = !empty($profilePhoto) ? $profilePhoto : base_url('assets/profile/user.png'); 
                                                        ?>
                                                        <img id="profile_image_preview" src="<?php echo $imagePath; ?>" alt="" style="width: 108px; height: 108px; border-radius: 50%; object-fit: cover;" class="ml-2">
                                                        <i class="fas fa-camera mt-4" id="camera_icon"></i>
                                                        <input type="file" id="upload_image" accept="image/*" style="display: none;">
                                                        <div class="row">
                                                            <div class="col-lg-12" style="padding-top:10px;">
                                                                <h4><?php echo $value['salutation'].' '.$value['firstname'].' '.$value['lastname'] ?></h4>  
                                                            </div>
                                                        </div>
                                                        <!-- Active/Deactive status -->
                                                        
                                                        <?php if($value['is_active'] != 0){ ?>
                                                            <span class="label-text" id="status" style="color: green; display: block; text-align: center;">Active</span>
                                                        <?php } else { ?>
                                                            <span class="label-text" id="status" style="color: red; display: block; text-align: center;">Deactive</span>
                                                        <?php } ?>
                                                            
                                                    </label>
                                                    <input type="file" id="profile_image_upload" name="profilephoto" style="display: none;" disabled>
                                                </div>
                                            </div>
                                        </div>
                                            

                                        <!-- Cropper modal -->
                                        <div id="cropperModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" inert>
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cropperModalLabel">Crop Image</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span inert>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <img id="cropperImage" src="" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-primary" id="crop_button">Crop</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="successMessage" style="display: none;" class="alert alert-success" role="alert">
                                            Data Updated successfully!
                                        </div>
                                        <div class="panel-content" >
                                            <div class="form-group row" >
                                                <span class="label-text col-lg-3 col-form-label">Salutation <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <select name="salutation" disabled class="form-control">
                                                        <option value="">Nothing Selected</option>
                                                        <option value="Mr." <?php if($value['salutation'] == "Mr.") echo 'selected="selected"'; ?> >Mr.</option>
                                                        <option value="Mrs." <?php if($value['salutation'] == "Mrs.") echo 'selected="selected"'; ?>>Mrs.</option>
                                                        <option value="Ms." <?php if($value['salutation'] == "Ms.") echo 'selected="selected"'; ?>>Ms.</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">First Name <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="firstname" disabled value="<?php echo $value['firstname'] ?>" id="firstname" placeholder="First Name" class="form-control" oninput="capitalization(this)" required >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Last Name</span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="lastname" disabled value="<?php echo $value['lastname'] ?>" id="lastname" placeholder="Last Name" class="form-control" oninput="capitalization(this)">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Email <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="email" value="<?php echo $value['email'] ?>" id="email" placeholder="Email" disabled class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Mobile <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="mobile" value="<?php echo $value['mobile'] ?>" id="mobile" placeholder="Mobile" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Alternate Mobile</span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="alt_mobile" disabled value="<?php echo isset($value['alt_mobile']) ? htmlspecialchars($value['alt_mobile']) : ''; ?>" id="alt_mobile" placeholder="Alternate Mobile" class="form-control"  maxlength="10" pattern="[0-9]*" >
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Pincode <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                   <input type="text" id="pincode" name="pincode" value="<?php echo isset($value['pincode']) ? htmlspecialchars($value['pincode']) : ''; ?>" placeholder="Pincode" class="form-control" maxlength="6" disabled>

                                                    <span id="pincodeError" style="color: red; display: none;">Please enter a valid 6-digit pincode.</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">State <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <input type="text" id="state" name="state" disabled value="<?php echo isset($value['state']) ? htmlspecialchars($value['state']) : ''; ?>" id="state" placeholder="State" class="form-control" disabled >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">City <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <input type="text" id="city" name="city" disabled value="<?php echo isset($value['city']) ? htmlspecialchars($value['city']) : ''; ?>" id="city" placeholder="City" class="form-control" disabled  oninput ="capitalization(this)">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <span class="label-text col-lg-3 col-form-label">Address <span style="color:red">*</span></span>
                                                <div class="col-lg-9">
                                                    <input type="text" name="address" disabled value="<?php echo isset($value['address']) ? htmlspecialchars($value['address']) : ''; ?>" id="address" placeholder="Address" class="form-control" required>
                                                </div>
                                            </div>

                                            
                                            <div class="row">
                                                <div class="col-lg-3 offset-lg-3">
                                                    <input type="submit" name="submit" id="update_profile" value="Edit" class="btn btn-sm btn-rounded btn-success">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    
                                    </form>
                                <?php } ?>
                            </div>

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade <?= ($active_tab == 'bank_information') ? 'show active' : '' ?>" id="bank_information" >
                                <div class="nav-item dropdown nav--user online" style="text-align:right">
                                    <button id="bankAction"  data-toggle="dropdown" class="btn btn-rounded btn-success " style="margin:10px 16px 0px 0px">Action<i class="fa fa-angle-down" style="margin-left: 5px;"></i></button>
                                    <div class="dropdown-menu" id="bank" style="width:auto;">
                                        <a href="<?php echo base_url('profilemanagement?tab='. urlencode($this->encryption->encrypt('bank_information')). '&option=' . urlencode($this->encryption->encrypt('addbanking'))); ?>" id="add_bank" class="dropdown-item"  onclick="addbank('add_bank', event)"><i class="fas fa-list"></i> Add bank</a>
                                        <a href="<?php echo base_url('profilemanagement?tab='. urlencode($this->encryption->encrypt('bank_information')). '&option=' . urlencode($this->encryption->encrypt('fetchbanking'))); ?>" id="all_bank" class="dropdown-item"  onclick="addbank('all_bank', event)"><i class="fas fa-external-link-alt"></i> All bank </a>
                                        <!-- <a href="javascript:void(0)" onclick="addbank(this.id);" id="all_bank" class="dropdown-item" ><i class="fas fa-external-link-alt"></i> All bank </a> -->
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center" id="listofbank">
                                    <?php if (isset($bank_data) && !empty($bank_data)) { ?>
                                        <?php foreach ($bank_data as $value) { ?>
                                            <div class="col-lg-4 col-md-6" id="bank-card-<?php echo $value['id']; ?>">
                                                <div class="pricing--item text-center mb-2 active">
                                                    <span class="pricing--text text-white bg-orange " style=" display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:180px;"><?php echo $value['bankname']; ?></span>
                                                    <div class="text-left" style="display: flex; justify-content: space-between;">
                                                        <a href="javascript:void(0)" title="Edit" onclick="edit_bank(<?php echo $value['id']; ?>)"><i class="fa fa-edit" style="font-size:15px"></i></a>
                                                        <a href="javascript:void(0)" title="Delete" style="float:right" onclick="deletebank(<?php echo $value['id']; ?>);"><i class="fa fa-trash" style="font-size:15px"></i></a>
                                                    </div>
                                                    <br>
                                                    <div class="img" style="margin-top: 25px;">
                                                        <a href="<?php echo base_url('./assets/upload/'.$value['chequecopy']); ?>" data-fancybox="zoom">
                                                            <img src="<?php echo base_url('./assets/upload/'.$value['chequecopy']); ?>" alt="img" style="width: 140px; height: 80px;">
                                                        </a>
                                                    </div>
                                                    <div class="pricing--header text-center">
                                                        <span>A/C number</span><h6 class="h6 text-uppercase"><?php echo $value['accountno']; ?></h6>
                                                    </div>
                                                    <div class="pricing--features">
                                                        <ul class="list-unstyled ">
                                                            <li class="d-flex justify-content-between "><strong>Account Type</strong><?php echo $value['accounttype']; ?></li>
                                                            <li class="d-flex justify-content-between mt-0"><strong>IFSC Code</strong><?php echo $value['ifsccode']; ?></li>
                                                            <li class="d-flex justify-content-between mt-0"><strong>MICR Code</strong><?php echo $value['micrcode']; ?></li>
                                                            <li class="d-flex justify-content-between mt-0"><strong>UPI id</strong><?php echo $value['upi']; ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="wrapper" style="Width:100%">
                                            <div class="m-error m-error-500">
                                                <div class="m-error--content">
                                                    <div class="m-error--title">
                                                        <img src="<?php echo base_url('assets/img/favicon/museum.png'); ?>" style="width:25%;height:25%">
                                                    </div>
                                                    <div class="m-error--desc">
                                                        <h2 class="h2" style="color:#00000059">No Bank Account Found.</h2>
                                                        <!-- <p>Sorry, we couldn't find the page you are looking for...</p>
                                                        <div class="m-error--search">
                                                            <a href="index.html" class="btn btn-block btn-rounded btn-info">Go Back To Dashboard</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row align-items-center" id="addnewbank" style="display: none;">
                                    <?php $this->load->view('adminpanel/setting/modal/addbank');?>
                                </div>
                            </div> 
                            <!-- Tab Pane End -->

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade <?= ($active_tab == 'kyc_documents') ? 'show active' : '' ?>" id="kyc_documents">
                                <div class="nav-item dropdown nav--user online" style="text-align:right">
                                    <button id="btnSave" data-toggle="dropdown" class="btn btn-rounded btn-success" style="margin:10px 16px 0px 0px">Action Kyc<i class="fa fa-angle-down" style="margin-left: 5px;"></i></button>
                                    <div class="dropdown-menu" style="width:auto;">
                                        <a href="javascript:void(0)" onclick="adddocument('add_documents');" class="dropdown-item"><i class="fas fa-list"></i> Add Kyc </a>
                                        <a href="javascript:void(0)" onclick="adddocument('all_documents');" class="dropdown-item"><i class="fas fa-external-link-alt"></i> All Kyc </a>
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center" id="listofdocument">
                                    <?php if ($kycdocument_data != false) { ?>
                                        <?php foreach ($kycdocument_data as $value) { ?>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="pricing--item text-center mb-2 active"  id="card-<?php echo $value['id']; ?>">
                                                    <span class="pricing--text text-white bg-orange"><?php echo $value['document_type'] ?></span>
                                                    <div class="text-left">
                                                        <a href="javascript:void(0)" title="Edit" onclick="edit_kyc_document('<?php echo $value['id'] ?>')" id="<?php echo $value['id'] ?>"><i class="fa fa-edit" style="font-size:15px"></i></a>
                                                        <a href="javascript:void(0)" style="float:right" onclick="deletedocument('<?php echo $value['id'] ?>')" id="<?php echo $value['id'] ?>"><i class="fa fa-trash" style="font-size:15px"></i></a>

                                                    </div>
                                                    <br>
                                                    <div class="img" style="margin-top: 15px;">
                                                        <a href="<?php echo base_url('./assets/upload/'.$value['document_image']); ?>" data-fancybox="zoom">
                                                            <img src="<?php echo base_url('./assets/upload/'.$value['document_image']); ?>" alt="img" style="width: 140px; height: 80px;">
                                                        </a>
                                                    </div>
                                                    <div class="pricing--header pb-0">
                                                        <h5 class="h5"><?php echo $value['document_no'] ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="wrapper" style="Width:100%">
                                            <div class="m-error m-error-500">
                                                <div class="m-error--content">
                                                    <div class="m-error--title">
                                                        <img src="<?php echo base_url('assets/img/favicon/kyc.png'); ?>" style="width:25%;height:25%">
                                                    </div>
                                                    <div class="m-error--desc">
                                                        <h2 class="h2" style="color:#00000059">No KYC Document Found.</h2>
                                                        <!-- <p>Sorry, we couldn't find the page you are looking for...</p>
                                                        <div class="m-error--search">
                                                            <a href="index.html" class="btn btn-block btn-rounded btn-info">Go Back To Dashboard</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            
                                <div class="row align-items-center" id="addnewdocument" style="display:none;">
                                    <?php $this->load->view('adminpanel/setting/modal/adddocument');?>
                                </div>
                            </div>
                            <!-- Tab Pane End -->

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade <?= ($active_tab == 'licence') ? 'show active' : '' ?>" id="licence">
                                <div class="row">
                                    <!-- <div class="col-md-9">
                                        <div class="col-md-2" style="text-align:center;">
                                            <img src='<?php echo base_url('assets/thumbnails/badge.png'); ?>'>
                                        </div>
                                        <div class="col-md-2" style="text-align:center;">
                                            <span style="font-weight: 600;">SLA25645</span>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12" style="text-align: end;">
                                        <button id="add_licence" onclick="addlicence(this.id);" style="margin:10px 16px 0px 0px" class="btn btn-rounded btn-success">Add Licence</button>
                                    </div>
                                </div>
                                <br>
                                
                                <div class="" id="listoflicence">
                                <?php if($agent_data != false && $investigator_data != false && $salvage_trader_data != false){ ?>
                                    <?php foreach ($profession as $value) { ?>
                                        <?php if($value['profession'] == "Agent" && $agent_data != false){ ?>
                                            <div class="row align-items-center">
                                                <div id="accordion01" style="width: 100%;padding:2px 31px;">
                                                    <div class="card col-12" style="">
                                                        <div class="card-header">
                                                            <h6 class="h6">
                                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#<?php echo $value['profession'] ?>"><?php echo $value['profession'] ?></button>
                                                            </h6>
                                                        </div>
                                                        <div id="<?php echo $value['profession'] ?>" class="collapse" data-parent="#accordion01">
                                                            <div style="width:100%; padding-top:10px">
                                                                <div class="row flex-wrap hidden-md-up">
                                                                    <?php foreach ($agent_data as $value) { ?>
                                                                        <div class="col-lg-3 col-md-6">
                                                                            <div class="card" style="background-color: aliceblue;">
                                                                                <div class="card-block">
                                                                                <h5 class="card-title" style="font-weight: 600;display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:-webkit-fill-available;"><?php echo $value['companyName'] ?></h5>
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <h6 class="card-subtitle text-muted"><strong>Licence Number: </strong><?php echo $value['licenceno'] ?>
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-4" style="text-align: end;">
                                                                                        <a href="#collapsedata<?php echo $value['id'] ?>" style="font-size:12px" data-toggle="collapse"><span>...More</span></a>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="pricing--features collapse multi-collapse" id="collapsedata<?php echo $value['id'] ?>">
                                                                                    <p class="card-text p-y-1"><strong>Valid till : </strong><?php echo $value['licenceValidity'] ?></p>
                                                                                </div>
                                                                                <a href="#" onclick="edit_agent('<?php echo $value['id'] ?>')" class="card-link" >Edit</a>
                                                                                <a href="#" onclick="deleteagent('<?php echo $value['id'] ?>')" class="card-link">Delete</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        <?php } else if($value['profession'] == "Professional" && $investigator_data != false){ ?>     
                                            <div class="row align-items-center" id="listofprofession">
                                                <div id="accordion01" style="width: 100%; padding:2px 31px;">
                                                    <div class="card col-12">
                                                        <div class="card-header">
                                                            <h6 class="h6">
                                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#<?php echo $value['profession'] ?>"><?php echo $value['profession'] ?></button>
                                                            </h6>
                                                        </div>
                                                        <div id="<?php echo $value['profession'] ?>" class="collapse" data-parent="#accordion01">
                                                            <div style="width:100%; padding-top:10px">
                                                                <div class="row flex-wrap hidden-md-up">
                                                                    <?php foreach ($investigator_data as $data) { ?>
                                                                        <?php foreach ($data['investigator'] as $investigatorvalue) { ?>
                                                                            <div class="col-lg-3 col-md-6" style="min-height: 100px; padding-right:0px;">
                                                                                <div class="card" style="background-color: honeydew;">
                                                                                    <div class="card-block">
                                                                                    <h5 class="card-title" style="font-weight: 600;display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:-webkit-fill-available;"><?php echo $investigatorvalue; ?></h5>
                                                                                    <div class="row" >
                                                                                    <?php if($investigatorvalue == " Document Translation"){ ?>
                                                                                        <div class="col-md-12">
                                                                                            <p class="card-text p-y-1"><strong>Language : </strong><?php echo $data['language']; ?></p>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    </div>
                                                                                    <?php if($investigatorvalue == " Document Translation"){ ?>
                                                                                        <a href="#" class="card-link">Edit</a>
                                                                                    <?php } ?>
                                                                                    <a href="#" class="card-link" onclick="deleteprofession('<?php echo $value['id'] ?>')">Delete</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        <?php } else if($value['profession'] == "Salvage Trader" && $salvage_trader_data != false){ ?>
                                            <div class="row align-items-center" id="listofsalvagetrader">
                                                <div id="accordion01" style="width: 100%; padding:2px 31px;">
                                                    <div class="card col-12">
                                                        <div class="card-header">
                                                            <h6 class="h6">
                                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#<?php echo str_replace(' ', '_', $value['profession']); ?>"><?php echo $value['profession'] ?></button>
                                                            </h6>
                                                        </div>
                                                        <div id="<?php echo str_replace(' ', '_', $value['profession']); ?>" class="collapse" data-parent="#accordion01">
                                                            <div style="width:100%; padding-top:10px">
                                                                <div class="row flex-wrap hidden-md-up">
                                                                    <?php foreach ($salvage_trader_data as $trader) { ?>
                                                                        <div class="col-lg-3 col-md-6" style="min-height: 100px; padding-right:0px;">
                                                                            <div class="card" style="background-color: bisque;">
                                                                                <div class="card-block">
                                                                                <h5 class="card-title" style="font-weight: 600;display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:-webkit-fill-available;"><?php echo $trader['salvage_buyer_catergory'] ?></h5>
                                                                                
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <h6 class="card-subtitle text-muted"><strong>Trader Range : </strong><?php echo $trader['buyer_range'] ?>
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-4" style="text-align: end;">
                                                                                        <a href="#collapsedata<?php echo $trader['id'] ?>" style="font-size:12px" data-toggle="collapse"><span>...More</span></a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="pricing--features collapse multi-collapse" id="collapsedata<?php echo $trader['id'] ?>">
                                                                                    <p class="card-text p-0"><strong>Sub Category : </strong>
                                                                                        <?php foreach ($trader['subcategory'] as $subcategory) { ?>
                                                                                            <?php echo $subcategory['sub_category_name'].","; ?>
                                                                                        <?php } ?>
                                                                                    </p>
                                                                                    <p class="card-text p-0"><strong>Region : </strong>
                                                                                        <?php foreach ($trader['region'] as $region) { ?>
                                                                                            <?php echo $region['name'].","; ?>
                                                                                        <?php } ?>
                                                                                    </p>
                                                                                </div>
                                                                                <a href="#" class="edit_salvage_btn card-link" data-id="<?php echo $trader['id']; ?>">Edit</a>
                                                                                <a href="#" onclick="deletetrader('<?php echo $trader['id'] ?>')" class="card-link">Delete</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php } else { ?>
                                        <div class="wrapper" style="Width:100%">
                                            <div class="m-error m-error-500">
                                                <div class="m-error--content">
                                                    <div class="m-error--title">
                                                        <img src="<?php echo base_url('assets/img/favicon/licence.png'); ?>" style="width:25%;height:25%">
                                                    </div>
                                                    <div class="m-error--desc">
                                                        <h2 class="h2" style="color:#00000059">No Licence Found.</h2>
                                                        <!-- <p>Sorry, we couldn't find the page you are looking for...</p>
                                                        <div class="m-error--search">
                                                            <a href="index.html" class="btn btn-block btn-rounded btn-info">Go Back To Dashboard</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row align-items-center" id="addnewlicence" style="display: none;">
                                    <?php $this->load->view('adminpanel/setting/modal/addlicence');?>
                                </div>
                            </div>
                            <!-- Tab Pane End -->

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade <?= ($active_tab == 'corporate') ? 'show active' : '' ?>" id="corporate">
                                <div class="nav-item dropdown nav--user online" style="text-align:right">
                                    <a href="javascript:void(0)" data-toggle="dropdown" style="margin:10px 16px 0px 0px" class="btn btn-rounded btn-success ">Connect with my company <i class="fa fa-angle-down" style="margin-left: 5px;"></i></a>
                                    <div class="dropdown-menu" id="company_action" style="width:auto;">
                                        <a href="javascript:void(0)" onclick="addcompany(this.id);" id="add_company" class="dropdown-item"><i class="fa fa-building"></i> Create new company for me</a>
                                        <a href="javascript:void(0)" onclick="addcompany(this.id);" id="connect_with_existing" class="dropdown-item"><i class="fas fa-external-link-alt"></i> Find my company</a>
                                    </div>
                                                                       
                                </div>
                                
                                <br>
                                <div class="row align-items-center" id="listofcompany">
                                    <!-- <div class="col-lg-4 col-md-6">
                                        <div class="pricing--item text-center mb-2 active">
                                            <span class="pricing--text text-white bg-orange">Company Name</span>
                                            <div class="text-left">
                                                <a href="javascript:void(0)" title="Edit" onclick="edit_corporate(this.id)" id=""><i class="fa fa-edit" style="font-size:15px"></i></a>
                                                <a href="javascript:void(0)" style="float:right" class="" id="" onclick="deletebank(this.id);"><i class="fa fa-trash" style="font-size:15px"></i></a>
                                            </div>
                                            <br>
                                            <div class="pricing--header text-center">

                                            <span>A/C number</span><h4 class="h4 text-uppercase">Branch Name</h4>
                                            </div>
                                                
                                            <div class="pricing--features">
                                                <ul class="list-unstyled">
                                                    <li class="text-left"><strong>CIN number</strong><br></li>
                                                    <li class="text-left"><strong>licence image</strong><br></li>
                                                    <li class="text-left"><strong>license number</strong><br></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div> -->
                                </div> 
                                <div class="row align-items-center" id="addnewcompany" style="display: none;">
                                    <?php $this->load->view('adminpanel/setting/modal/addcompany');?>
                                </div>
                                <div class="row align-items-center" id="connectwithcompany" style="display: none;">
                                    <?php $this->load->view('adminpanel/setting/modal/connect_with_company');?>
                                </div>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                    </div>
                    <!-- Panel End -->
                </div>
            </div>
        </div>
    </section>

    <div id="imageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="crop_image" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="crop_and_upload">Crop & Upload</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('adminpanel/setting/modal/editagent');?>
    <?php $this->load->view('adminpanel/setting/modal/editsalvage');?>
    <?php $this->load->view('adminpanel/setting/modal/addbranch');?>
    <!-- Modal End -->
    <?php $this->load->view('adminpanel/layout/footer'); ?>
    
<script type="text/javascript">
//Find My Company
$(document).ready(function() {
    var cropper;
    var image = document.getElementById('crop_image');
    // Click camera icon to trigger file input
    $('#camera_icon').click(function() {
        $('#upload_image').click();
    });

    // When user selects an image
    $('#upload_image').change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image.src = url;
            $('#imageModal').modal('show');
        };

        if (files && files.length > 0) {
            var reader = new FileReader();
            reader.onload = function(event) {
                done(event.target.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });


    // Initialize Cropper.js when modal opens
    $('#imageModal').on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 2,
            preview: '.preview',
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    // Crop and upload image
    $('#crop_and_upload').click(function() {
        var canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300
        });

        canvas.toBlob(function(blob) {
            const file = new File([blob], "profile_image.png", { type: "image/png" });
            const formData = new FormData();
            formData.append("profile_photo", file);

            $.ajax({
                url: "<?php echo base_url('uploadProfilePhoto') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#imageModal').modal('hide');
                    $('#profile_image_preview').attr('src', response.image_url);
                }
            });
        });
    });



    $('select[id="choose_profession"]').on('change', function() {
        var professionId = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('companybyprofessionid');?>",
            dataType: "json",
            data: { profession: professionId },
            success: function(response) {
                $("#choose_company").html('');
                $("#choose_company").append('<option value="">Nothing Selected</option>'); 
                $.each(response.data, function(i, val) {                
                    $("#choose_company").append("<option value='" + val.cid + "'>" + val.companyName + "</option>"); 
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });

    var dataTable = null;
    $('#choose_company').change(function() {
        var selectedCategory = $(this).val();
        populateParentcompanyData(selectedCategory);
        
        if (selectedCategory !== '') {
            if (dataTable) {
                dataTable.destroy();
            }

            dataTable = $('#branchdata').DataTable({
                "serverSide": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "order": [],
                language: {
                    searchPlaceholder: "Search Branch"
                },
                "ajax": {
                    url: '<?= base_url('branches') ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data: function(d) {
                        d.select_company = selectedCategory;    
                    }
                }, 
            });
            $('#datatableContainer').show();
        } else {
            $('#datatableContainer').hide();
        }
    });   
});

function populateParentcompanyData(selectedCategory) {
    $.ajax({
        url: "<?php echo base_url('companybyid') ?>", // Ensure this URL is correct
        method: "POST",
        data: { company: selectedCategory },
        dataType: 'json',
        success: function(response) {
            var html = '';
            $("#parent_company").html("");
            if (response.status === 200 && Array.isArray(response.data)) {
                $.each(response.data, function(i, val) {
                    html += '<section class="page--header" style="width:100%;border: 1px solid #E5E4E2;border-radius: 15px;">' +
                                '<div class="container-fluid">' +
                                    '<div class="row">' +
                                        '<div class="col-lg-12" style="text-align:center;">' +
                                            '<table style="width:100%">' +
                                                '<tr>' +
                                                '<td style="font-size:14px;">' + val.companyName + '</td>' +
                                                '</tr>' +
                                            '</table>' +
                                        '</div>' +
                                    '</div></br>' +
                                    '<div class="row">' +
                                        '<table style="width:50%">' +
                                            '<tr>' +
                                            '<th>CID:</th>' +
                                            '<td>' + val.cid + '</td>' +
                                            '</tr>' +
                                            '<tr>' +
                                            '<th>Licence No:</th>' +
                                            '<td>' + val.licenceNo + '</td>' +
                                            '</tr>' +
                                            '<tr>' +
                                            '<th>Website:</th>' +
                                            '<td>' + val.website + '</td>' +
                                            '</tr>' +
                                        '</table>' +
                                        '<table style="width:50%">' +
                                            '<tr>' +
                                            '<th>Profession:</th>' +
                                            '<td>' + val.profession + '</td>' +
                                            '</tr>' +
                                            '<tr>' +
                                            '<th>Status:</th>' +
                                            '<td>' + val.status + '</td>' +
                                            '</tr>' +
                                            '<tr>' +
                                            '<th></th>' +
                                            '<td style="text-align:right;"><a href="javascript:void(0)" data-id="' + val.cid + '" data-toggle="modal" data-target="#addbranch" class="btn btn-rounded btn-success add-branch">Add new branch</a></td>' +
                                            '</tr>' +
                                        '</table>' +
                                    '</div>' +
                                '</div>' +
                            '</section>' +
                            '</br>';
                });
                $("#parent_company").prepend(html);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching parent company data:", status, error);
        }
    });
}
$(document).on("click", ".add-branch", function () {
    var cid = $(this).data('id');
    $("#cid").val(cid);
});

function addnewbranch() {
    var cidValue = $("#cid").val(); // Get the cid value
    var form_data = new FormData();
    var other_data = $('#add_branch').serializeArray();

    $.each(other_data, function(key, input) {
        form_data.append(input.name, input.value);
    });
    form_data.append('cid', cidValue);

    jQuery.ajax({
        url: "addbranch",
        cache: false,
        dataType: "json",
        processData: false,
        contentType: false,
        type: "POST",
        data: form_data,
        success: function(response) {
            if (response.status === 200) {
                $('#addbranch').modal('hide');
                $('#add_branch')[0].reset();
                var newBranchData = {
                    bid: response.data.bid,
                    gst: response.data.gst,
                    address: response.data.address,
                    pincode: response.data.pincode,
                    state: response.data.state,
                    city: response.data.city
                };
                // Show DataTable if hidden
                $('#datatableContainer').show();
                $('#branchdata').DataTable().row.add(newBranchData).draw();
            } else {
                alert("Failed to add branch: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error adding branch:", status, error);
        }
    });
}


   
// /* ------------------------------------------------------------------------- *
// * DROPDOWN FOR CORPORATE
// * ------------------------------------------------------------------------- */

$(document).ready(function(){
    $('#company_action').html('');
    $('#company_action').append('<a href="javascript:void(0)" onclick="addcompany(this.id);" id="add_company" class="dropdown-item"><i class="fa fa-building"></i> Create new company for me</a><a href="javascript:void(0)" onclick="addcompany(this.id);" id="connect_with_existing" class="dropdown-item"><i class="fas fa-external-link-alt"></i> Find my company</a>'); 
    fetchCompanyDetails();
});


// /* ------------------------------------------------------------------------- *
// * UPDATE USER PROFILE
// * ------------------------------------------------------------------------- */


// /* ----------------------Number and Pincode ------------------------------- */

document.getElementById("pincode").addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, '');
});
document.addEventListener("DOMContentLoaded", function() {
    var altMobileInput = document.getElementById("alt_mobile");
    if (altMobileInput) {
        altMobileInput.addEventListener("input", function() {
            this.value = this.value.replace(/\D/g, '');
        });
    }
});



// /* ----------------------Pincode Error------------------------------- */

document.getElementById("pincode").addEventListener("input", function() {
    var pincode = this.value;
    var pincodeError = document.getElementById("pincodeError");
    if (pincode.length < 6) {
        pincodeError.style.display = "inline";
        } else {
        pincodeError.style.display = "none";
    }
});

// $(document).ready(function() {
//     $('#updateProfile').on('submit', function(e) {
//         e.preventDefault();
        
//         var buttontype = document.getElementById('update_profile').value;
//         document.getElementById("update_profile").value = "Update";

//         if (buttontype === "Edit") {
//             var input = document.getElementById("updateProfile").getElementsByTagName('input');
//             var select = document.getElementById("updateProfile").getElementsByTagName('select');
            
//             // Enable the fields for editing
//             for (var i = 0; i < input.length; i++) {
//                 if (input[i].name === "mobile") {
//                     input[i].disabled = true;
//                 } else {
//                     input[i].disabled = false;
//                 }
//             }
            
//             for (var i = 0; i < select.length; i++) {
//                 select[i].disabled = false;
//             }

//         } else if (buttontype === "Update") {
//             var status = document.getElementById("status").innerText;
//             var is_active = (status === "Active") ? 1 : 0;

//             // Prepare the form data for submission
//             $('#mobile').removeAttr('disabled');
//             $('#email').removeAttr('disabled');

//             var data = $(this).serializeArray();

//             $('#mobile').attr('disabled', 'disabled');
//             $('#email').attr('disabled', 'disabled');

//             // Add the active status to the form data
//             data.push({
//                 name: "is_active",
//                 value: is_active
//             });

//             // Immediately set all fields to readonly mode when the Update button is clicked
//             var input = document.getElementById("updateProfile").getElementsByTagName('input');
//             var select = document.getElementById("updateProfile").getElementsByTagName('select');

//             for (var i = 0; i < input.length; i++) {
//                 input[i].disabled = true;
//             }

//             for (var i = 0; i < select.length; i++) {
//                 select[i].disabled = true;
//             }
//             // $('#profile_image_preview').attr('src', canvas.toDataURL());
//             // Perform the AJAX request to update the details
//             $.ajax({
//                 url: 'user_profile_update',
//                 method: "POST",
//                 dataType: "json",
//                 data: data,
//                 success: function(response) {
//                     if (response.status === 200) {
//                         // Show success message with sliding effect
//                         $('#successMessage').slideDown(300, function() {
//                             // Scroll to the success message
//                             $('html, body').animate({
//                                 scrollTop: $('#successMessage').offset().top - ($(window).height() / 2)
//                             }, 800);
//                         }).delay(2000).slideUp(300);

//                         // Change button back to 'Edit' after successful update
//                         document.getElementById("update_profile").value = "Edit";

//                         // Update the fields with new values (if necessary)
//                         for (var i = 0; i < input.length; i++) {
//                             if (input[i].name !== "submit") {
//                                 input[i].value = data.find(d => d.name === input[i].name)?.value || input[i].value;
//                                 input[i].disabled = true; // Keep inputs disabled
//                             }
//                         }

//                         for (var i = 0; i < select.length; i++) {
//                             select[i].disabled = true;
//                         }

//                         // Optionally update status dynamically
//                         document.getElementById("status").innerText = response.data.is_active ? "Active" : "Deactive";
//                         document.getElementById("status").style.color = response.data.is_active ? "green" : "red";
//                     } else {
//                         $('#alert_message_login').append('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
//                         setTimeout(function() {
//                             $("#alert_message_login").hide();
//                         }, 5000);
//                     }
//                 }
//             });
//         }
//     });
// });

$(document).ready(function() {
    $('#updateProfile').on('submit', function(e) {
        e.preventDefault();
        
        var buttontype = document.getElementById('update_profile').value;
        document.getElementById("update_profile").value = "Update";

        if (buttontype === "Edit") {
            var input = document.getElementById("updateProfile").getElementsByTagName('input');
            var select = document.getElementById("updateProfile").getElementsByTagName('select');
            
            // Enable the fields for editing
            for (var i = 0; i < input.length; i++) {
                if (input[i].name === "mobile") {
                    input[i].disabled = true;
                } else {
                    input[i].disabled = false;
                }
            }
            
            for (var i = 0; i < select.length; i++) {
                select[i].disabled = false;
            }

        } else if (buttontype === "Update") {
            var status = document.getElementById("status").innerText;
            var is_active = (status === "Active") ? 1 : 0;

            // Prepare the form data for submission
            $('#mobile').removeAttr('disabled');
            $('#email').removeAttr('disabled');

            var data = $(this).serializeArray();

            $('#mobile').attr('disabled', 'disabled');
            $('#email').attr('disabled', 'disabled');

            // Add the active status to the form data
            data.push({
                name: "is_active",
                value: is_active
            });

            // Immediately set all fields to readonly mode when the Update button is clicked
            var input = document.getElementById("updateProfile").getElementsByTagName('input');
            var select = document.getElementById("updateProfile").getElementsByTagName('select');

            for (var i = 0; i < input.length; i++) {
                input[i].disabled = true;
            }

            for (var i = 0; i < select.length; i++) {
                select[i].disabled = true;
            }

            // Perform the AJAX request to update the details
            $.ajax({
                url: 'user_profile_update',
                method: "POST",
                dataType: "json",
                data: data,
                success: function(response) {
                    if (response.status === 200) {
                        // Show success message with sliding effect
                        $('#successMessage').slideDown(300, function() {
                            // Scroll to the success message
                            $('html, body').animate({
                                scrollTop: $('#successMessage').offset().top - ($(window).height() / 2)
                            }, 800);
                        }).delay(2000).slideUp(300);

                        // Change button back to 'Edit' after successful update
                        document.getElementById("update_profile").value = "Edit";

                        // Update the fields with new values (if necessary)
                        for (var i = 0; i < input.length; i++) {
                            if (input[i].name !== "submit") {
                                input[i].value = data.find(d => d.name === input[i].name)?.value || input[i].value;
                                input[i].disabled = true; // Keep inputs disabled
                            }
                        }

                        for (var i = 0; i < select.length; i++) {
                            select[i].disabled = true;
                        }

                        // Optionally update status dynamically
                        document.getElementById("status").innerText = response.data.is_active ? "Active" : "Deactive";
                        document.getElementById("status").style.color = response.data.is_active ? "green" : "red";
                    } else {
                        $('#alert_message_login').append('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                        setTimeout(function() {
                            $("#alert_message_login").hide();
                        }, 5000);
                    }
                }
            });
        }
    });
});  

// /* ------------------------------------------------------------------------- *
// * LIVE SEARCH PINCODE
// * ------------------------------------------------------------------------- */
$(document).ready(function(){
    search_pincode();
    function search_pincode(pincode)
        {
        $.ajax({
        url:"searchpincode",
        method:"POST",
        data:{pincode:pincode},
        dataType:'json',
        success:function(response){
            if(response.status === 200){
                $("#state").val(response.data.State);
                $("#city").val(response.data.City);
            }
        }
    })
}

$('#pincode').keyup(function(){
    var search = $(this).val();
        if(search != '' && search.length === 6)
        {
            search_pincode(search);
        }
            else
        {
            search_pincode();
        }
    });
});

    // FOR SELECTING PROFILE PHOTO 

    // document.getElementById('profile_image_upload').addEventListener('change', function(event) {
    //     var file = event.target.files[0];
    //     var reader = new FileReader();

    //     reader.onload = function(e) {
    //         var img = document.getElementById('profile_image_preview');
    //         img.src = e.target.result;
    //     };

    //     reader.readAsDataURL(file);
    // });


    function edit_bank(id) {
        var profileImageUpload = document.getElementById('profile_image_upload');
        profileImageUpload.style.display = 'block';
    }


//for crop image 
// $(document).ready(function() {
//     var cropper;

//     $('#profile_image_upload').on('change', function(e) {
//         var files = e.target.files;
//         var reader = new FileReader();

//         reader.onload = function(event) {
//             $('#cropperImage').attr('src', event.target.result);
//             $('#cropperModal').modal('show');
//             if (cropper) {
//                 cropper.destroy();
//             }
//             cropper = new Cropper(document.getElementById('cropperImage'), {
//                 aspectRatio: 1,
//                 viewMode: 1,
//                 preview: '.img-preview',
//                 autoCropArea: 0.8,
//             });
//         };
//         reader.readAsDataURL(files[0]);
//     });

//     $('#crop_button').on('click', function() {
//         var canvas = cropper.getCroppedCanvas({
//             width: 500,
//             height: 500,
//         });

//         // Update the image in the original div
//         $('#profile_image_preview').attr('src', canvas.toDataURL());

//         // Close the cropper modal
//         $('#cropperModal').modal('hide');
//     });
// });

// $(document).ready(function(){
//   // Open modal when clicking on image
//   $('[data-fancybox="zoom"]').on('click', function() {
//     var imgSrc = $(this).attr('href');
//     $('#zoomedImg').attr('src', imgSrc);
//     $('#customImageViewer').show();
//   });
  

//   // Close modal when clicking on close button (cross sign)
//   $('.close').on('click', function() {
//     $('#customImageViewer').hide();
//   });

//   // Close modal when clicking outside of the image
//   $(window).on('click', function(event) {
//     if (event.target == document.getElementById('customImageViewer')) {
//       $('#customImageViewer').hide();
//     }
//   });
// });







// //To capitalize first value
function capitalization(input) {
    var name = input.value;
    if (name && name[0] === name[0].toLowerCase()) {
        input.value = name.charAt(0).toUpperCase() + name.slice(1);
    }
}


// /* ------------------------------------------------------------------------- *
// * IMAGE PREVIEW BEFORE UPLOAD
// * ------------------------------------------------------------------------- */
$(document).ready(function() {
    $("#cancelCheque").on('change', function() {
    //Get count of selected files
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#image_thumb");
    image_holder.empty();
    if (extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            //loop for each file selected for uploaded.
            for (var i = 0; i < countFiles; i++) 
            {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image"
                    }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
            }
        } else {
        alert("This browser does not support FileReader.");
        }
    } else {
        alert("Pls select only images");
        }
    });
});


// /* ------------------------------------------------------------------------- *
// * CRUD BANK ACCOUNT
// * ------------------------------------------------------------------------- */
var save_method = "add";
function addbank(id,event) {
    event.preventDefault();
    var button = document.getElementById('btn_save_bank'); // Get the button element
    if (id === "add_bank") {
        document.getElementById('addnewbank').style.display = 'block';
        document.getElementById('listofbank').style.display = 'none';
        save_method = "add"; 
        // Set button text to "Add Bank"
        button.innerText = "Add Bank"; 
        
        // Reset the form fields if necessary
        document.getElementById("add_new_bank").reset();
        banklist();
    } else if (id === "all_bank") {
        document.getElementById('listofbank').style.display = 'flex';
        document.getElementById('addnewbank').style.display = 'none';
        save_method = "update"; 
        // Set button text to "Update" for existing banks
        button.innerText = "Update"; 
        fetchAllBankDetails(); 
    }  
}



function fetchAllBankDetails() {
    $.ajax({
        url: "<?php echo base_url('home/fetchBankDetails'); ?>",
        type: "GET",
        data: {
            tab: "<?php echo urlencode($this->encryption->encrypt('bank_information')); ?>",
            option: "<?php echo urlencode($this->encryption->encrypt('fetchbanking')); ?>"
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === 200) {
                let bankDetailsHtml = '';
                response.data.forEach(function (value) {
                    bankDetailsHtml += `
                        <div class="col-lg-4 col-md-6">
                            <div class="pricing--item text-center mb-2 active">
                                <span class="pricing--text text-white bg-orange" style=" display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:180px;">${value.bankname}</span>
                                <div class="text-left" style="display: flex; justify-content: space-between;">
                                    <a href="javascript:void(0)" title="Edit" onclick="edit_bank('${value.id}')" id="${value.id}"><i class="fa fa-edit" style="font-size:15px"></i></a>
                                    <a href="javascript:void(0)" style="float:right" class="${value.id}" id="${value.id}" onclick="deletebank('${value.id}');"><i class="fa fa-trash" style="font-size:15px"></i></a>
                                </div>
                                <br>
                                <div class="img" style="margin-top: 25px;">
                                    <a href="${value.chequecopy ? '<?php echo base_url('./assets/upload/'); ?>' + value.chequecopy : '#'}" data-fancybox="zoom">
                                        <img src="${value.chequecopy ? '<?php echo base_url('./assets/upload/'); ?>' + value.chequecopy : '<?php echo base_url('./assets/upload/default.jpg'); ?>'}" alt="img" style="width: 140px; height: 80px;">
                                    </a>
                                </div>
                                <div class="pricing--header text-center">
                                    <span>A/C number</span><h6 class="h6 text-uppercase">${value.accountno}</h6>
                                </div>
                                <div class="pricing--features ">
                                    <ul class="list-unstyled">
                                        <li class="d-flex justify-content-between"><strong>Account Type</strong>${value.accounttype}</li>
                                        <li class="d-flex justify-content-between"><strong>IFSC Code</strong>${value.ifsccode}</li>
                                        <li class="d-flex justify-content-between"><strong>MICR Code</strong>${value.micrcode}</li>
                                        <li class="d-flex justify-content-between"><strong>UPI id</strong>${value.upi}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $("#listofbank").html(bankDetailsHtml); // Update the bank list with response
                document.getElementById('listofbank').style.display = 'flex'; // Show the bank list
                
            } else {
                $("#listofbank").html(''); // Clear previous data
            
            }
        },
        error: function () {
            alert("Error fetching bank details.");
        }
    });
}


// /**
//  * @save bank account
//  */
function savebank() {
    $('#btn_save_bank').text('saving...'); 
    $('#btn_save_bank').attr('disabled', true); 
    var bankform  = document.getElementById('add_bank');
    var url;
    if (save_method == 'add') {
        url = "home/addNewBank";
    } else {
        url = "home/updateBank";
    }

    var form_data = new FormData(document.getElementById('add_new_bank'));
    var file_data = $('input[type="file"]')[0].files;
    for (var i = 0; i < file_data.length; i++) {
        form_data.append("cancelCheque", file_data[i]);
    }
    jQuery.ajax({
        type: "POST",
        url: url,
        data: form_data,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === 200) {
                
                fetchAllBankDetails();
                $('#add_new_bank').hide();
                
            } else {
                swal({
                    title: "Failed",
                    type: "warning",
                    text: response.message,
                    confirmButtonColor: "#D22B2B"
                });
            }
            $('#btn_save_bank').text(save_method === 'add' ? 'Add Bank' : 'Update'); 
            $('#btn_save_bank').attr('disabled', false);
        }
    
    });
}


/**
* @bank account list
*/
function banklist(){
    $.ajax({
        url: "getbanklist",
        cache: false,
        dataType: "json",
        type: "GET",
        success: function(response) {
            $("#bank_name").html("");
            $("#bank_name").append('<option value="">Nothing Selected</option>');
            if(response.status === 200){
                for (let i = 0; i < response.data.length; i++) {
                    $("#bank_name").append(response.data[i]);
                } 
            }
        }
    });
}


/**
 * @edit bank account
 */

// Function to edit bank
function edit_bank(id) {
    save_method = 'update';
    $(this).find('form').trigger('reset');
    $('#image_thumb').html(""); // Clear any existing image preview
    document.getElementById('addnewbank').style.display = 'block';
    document.getElementById('listofbank').style.display = 'none';
    banklist();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "getbankdetailbyid", // Ensure this URL is correct and properly linked to your controller
        data: {
            bankid: id,
        },
        success: function(response) {
            if (response.status == 200) {
                // Populate the form fields
                $('#bid').val(id);
                $('#bank_name').val(response.data.bankId);
                $('#account_type').val(response.data.accounttype);
                $('#account_number').val(response.data.accountno);
                $('#ifsc_code').val(response.data.ifsc_code);
                $('#micr_code').val(response.data.micrcode);
                $('#upi').val(response.data.upi);

                // Display the cheque copy image if it exists
                if (response.data.chequecopy) {
                    var imageUrl =response.data.chequecopy;
                    $('#image_thumb').html('<img id="upload_cancel_cheque" src="' + imageUrl + '" class="thumb-image" alt="Cancel Cheque">');
                    $('#image_preview_section').show(); // Show the image preview section
                } else {
                    // Hide the preview section if there's no image
                    $('#image_preview_section').hide();
                }
            } else {
                console.error('Failed to retrieve bank details');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error occurred: ' + error);
        }
    });
}


/**
* @delete bank account
*/


function deletebank(id) {
    // SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete this bank account?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms, proceed with the AJAX request
            $.ajax({
                url: "<?php echo base_url('home/deleteBankAccount'); ?>",
                type: "POST",
                cache: false,
                data: {
                    id: id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' // Add CSRF token here
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === 200) {
                        // Remove the bank account from the UI
                        $('#bank-card-' + id).remove();
                        fetchAllBankDetails(); // Optionally refresh the list
                        Swal.fire(
                            'Deleted!',
                            'The bank account has been deleted.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'An error occurred while processing your request.',
                        'error'
                    );
                }
            });
        } else {
            // User canceled the deletion
            Swal.fire(
                'Cancelled',
                'The bank account was not deleted.',
                'info'
            );
        }
    });
}


// /* ------------------------------------------------------------------------- *
// * CRUD KYC DOCUMENTS
// * ------------------------------------------------------------------------- */
var save_document; 

    var documentCount = 0;

    // Update the button state
    function updateButtonState() {
        var btnSaveButton = document.getElementById('btnSave');

        if (documentCount < 2) {
            btnSaveButton.disabled = false; // Enable the button
            } else {
            btnSaveButton.disabled = true; // Disable the button
        }
    }

    // Call this function to increment the document count
    function incrementDocumentCount() {
        documentCount++;
        updateButtonState();
    }

    // Call this function to decrement the document count
    function decrementDocumentCount() {
        documentCount--;
        updateButtonState();
    }

    function adddocument(id) {
        // if (id === "add_documents" && documentCount < 2) {
        if (id === "add_documents") {
            save_document = 'add'; 
            document.getElementById('addnewdocument').style.display = 'block';
            document.getElementById('listofdocument').style.display = 'none';
        //   kycdocumentlist(); // You can call any function or perform actions here
        //   incrementDocumentCount(); // Increment the document count
        } else if (id === "all_documents") {
        // Customize this condition as needed to identify the kyc_document section
            save_document = 'update';
            document.getElementById('listofdocument').style.display = 'flex';
            document.getElementById('addnewdocument').style.display = 'none';
        }
    }


/**    
 * @save kyc document
 */
// save_document = 'add'; 

    function edit_kyc_document(id) {
        $('#add_new_document').trigger('reset'); // Reset the form
        $('#image_document').html(""); // Clear any existing image
        document.getElementById('addnewdocument').style.display = 'block';
        document.getElementById('listofdocument').style.display = 'none';

        // Change the save button text to "Update"
        $('#btn_document_save').text('Update'); 
        save_document = 'update'; // Set the save_document variable to 'update'

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "getkycdetailbyid", // Fetch document data by ID
            data: { documentId: id },
            success: function(response) {
                if (response.status == 200) {
                    var documentType = response.data[0].document_type;
                    
                    // Show the appropriate form based on document type
                    if (documentType === "PAN Card") {
                        showPanCardForm();
                    } else if (documentType === "Aadhar Card") {
                        showAadharCardForm();
                    }

                    // Populate the form fields with the retrieved data
                    $('#id').val(id); // Set the ID field for updating
                    $('#document_type').val(documentType).prop('disabled', true);
                    $('#pan_document_no').val(response.data[0].document_no);
                    $('#adhar_document_no').val(response.data[0].document_no);
                    $('#document_name').val(response.data[0].documentName);
                    
                    // If there's an existing document image, display it
                    if (response.data[0].document_image) {
                        $('#image_document').append('<img id="upload_document" src="' + response.data[0].document_image + '" class="thumb-image">');
                    }
                }
            },
            error: function() {
                alert("An error occurred while fetching document details.");
            }
        });
    }

    function savedocument() {
        $('#btn_document_save').text('Saving...'); // Change button text to "Saving..."
        $('#btn_document_save').attr('disabled', true); // Disable button

        var document_type = document.getElementById('document_type').value;
        var form_data = new FormData(document.getElementById('add_new_document'));
        form_data.append('document_type', document_type);

        // Check if there are files selected
        var file_data = document.getElementById('kycdocument').files;

        // Append file to FormData if a file is provided
        if (file_data.length > 0) {
            for (var i = 0; i < file_data.length; i++) {
                form_data.append("kyc_document", file_data[i]); // Append selected file
            }
        }

        var url = '';
        var document_no;

        // Validate document type and set url accordingly
        if (document_type === "PAN Card") {
            document_no = document.getElementById('pan_document_no').value;
            form_data.append('pan_no', document_no);
            url = (save_document === 'add') ? "home/add_pan" : "home/updateKycDocument";
        } else if (document_type === "Aadhar Card") {
            document_no = document.getElementById('adhar_document_no').value;
            form_data.append('aadhar_no', document_no);
            url = (save_document === 'add') ? "home/add_aadhar_card" : "home/updateKycDocument";
        } else {
            alert("Please select a document type.");
            resetButton();
            return; // Exit the function
        }

        // Append the document ID for update
        if (save_document === 'update') {
            form_data.append('id', $('#id').val()); // Ensure this is correctly set
        }

        // Perform the AJAX call
        $.ajax({
            type: "POST",
            url: url,
            data: form_data,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 200) {
                   
                    swal({
                        title: "Success",
                        type: "success",
                        text: response.message,
                        confirmButtonColor: "#04AA6D"
                    }, function(result) {
                        if (result) {
                            $('#addnewdocument').modal('hide'); // Close modal on success
                        }
                    });
                } else {
                    swal({
                        title: "Failed",
                        type: "warning",
                        text: response.message,
                        confirmButtonColor: "#D22B2B"
                    });
                }
            },
            complete: function() {
                resetButton(); // Reset button state
            }
        });
    }

    // Helper function to reset button state
    function resetButton() {
        $('#btn_document_save').text(save_document === 'add' ? 'Save' : 'Update');
        $('#btn_document_save').removeAttr('disabled');
    }



    function showPanCardForm() {
        document.getElementById("pan_card").style.display = "block";
        document.getElementById("aadhar_card").style.display = "none";
        document.getElementById("document").style.display = "block";
    }

    function showAadharCardForm() {
        document.getElementById("aadhar_card").style.display = "block";
        document.getElementById("pan_card").style.display = "none";
        document.getElementById("document").style.display = "block";
    }

    function hideAllForms() {
        document.getElementById("aadhar_card").style.display = "none";
        document.getElementById("pan_card").style.display = "none";
        document.getElementById("document").style.display = "none";
    }



    $(document).ready(function() {
        $("#kycdocument").on('change', function() {
            //Get count of selected files
            var countFiles = $(this)[0].files.length;
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_doc = $("#image_document");
            image_doc.empty();
            if (extn == "jpg" || extn == "jpeg") {
                if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) 
                {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-document"
                    }).appendTo(image_doc);
                    }
                    image_doc.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
                } else {
                alert("This browser does not support FileReader.");
                }
                } else {
                alert("Pls select only images");
                }
            });
        });

    // @Kyc delete document
    function deletedocument(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this document?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, proceed with the AJAX request
                $.ajax({
                    type: "POST",
                    url: "home/deleteKycAccount",
                    data: { id: id },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 200) {
                            $('#card-' + id).remove();
                            Swal.fire("Success", response.message, "success");
                        } else {
                            Swal.fire("Failed", response.message, "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire("Error", "An error occurred while deleting the document.", "error");
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled',
                    'The document was not deleted.',
                    'info'
                );
            }
        });
    }



// /* @licence
//  * 
//  */

function deleteprofession(value, id) {
    $.ajax({
        url: "deleteprofession",
        type: "POST",
        data: { id: id, value: value },
        cache: false,
        success: function(dataResult) {
            console.log(dataResult);
            swal({
                title: "Success",
                type: "success",
                text: "Profession deleted successfully!",
                confirmButtonColor: "#04AA6D"
            }).then(function() {
                banklist();
            });
        },
        error: function(xhr, status, error) {
            swal({
                title: "Failed",
                type: "warning",
                text: "Failed to delete the profession!",
                confirmButtonColor: "#D22B2B"
            });
        }
    });    
}


// function edit_agent(id){
//     save_method = 'update';
//     $('.form-group').removeClass('has-error'); 
//     $('.help-block').empty();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         url: "getagentbyId",
//         data: {agentid : id},              
//         success: function(response) {
//             $('#insurance_company').val("");
//             $('#licence_number').val("");
//             $('#date_picker').val("");
//             if (response.status === 200 )
//                 console.log(response);
//             {      
//                 $('[name="id"]').val(response.data.id);
//                 $('#insurance_company option[value="'+response.data.companyId+'"]').attr("selected", "selected");
//                 $('#edit_licence_number').val(response.data.licenceno);
//                 $('#edit_date_picker').val(response.data.licenceValidity);
//                 getInsuranceCompany();
//                 $('#edit_agent').modal('show'); 
//                 $('.modal-title').text('Edit Agent');
//             }
//         }
//     });
// }

function edit_agent(id) {
    save_method = 'update';
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty();

    // Fetch agent details
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "getagentbyId",
        data: { agentid: id },
        success: function(response) {
            if (response.status === 200) {
                $('[name="id"]').val(response.data.id);
                $('#edit_insurance_company').val(response.data.companyName);
                $('#edit_licence_number').val(response.data.licenceno);
                $('#edit_date_picker').val(response.data.licenceValidity);
                $('#edit_agent').modal('show');
                    $('.modal-title').text('Edit Agent');
                getInsuranceCompany();
                // setTimeout(function() {
                //     $('#insurance_company').val(response.data.companyId); 
                //     $('#edit_agent').modal('show');
                //     $('.modal-title').text('Edit Agent');
                // }, 100); 
            }
        }
    });
}

function deleteagent(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete this agent?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Home/deleteagent/'); ?>" + id,
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $('#collapsedata' + id).closest('.col-lg-3').remove();
                        Swal.fire(
                            'Deleted!',
                            'The agent has been deleted.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            'Unable to delete the agent.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the agent.',
                        'error'
                    );
                }
            });
        } else {
            // If the user clicks "Cancel", just show a cancellation message or do nothing
            Swal.fire(
                'Cancelled',
                'The agent was not deleted.',
                'info'
            );
        }
    });
}

$(document).on('click', '.edit_salvage_btn', function(e) {
    e.preventDefault();
    const salvageId = $(this).data('id');
    edit_salvage(salvageId);
});

function edit_salvage(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "geteditsalvage",
        data: { salvageid: id },
        success: function(response) {
            if (response.status === 200) {
                $('#edit_salvage').modal('show');
                $('#selected_subcategories').html(response.sub_category.join(', '));
                $('#buyer_range').html(response.buyer_range);
                $('#selected_region').html(response.region.join(', '));
            } else {
                console.log('Error fetching data: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function deletetrader(trader_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete this trader?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Home/deletetrader/'); ?>" + trader_id,
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $('#collapsedata' + trader_id).closest('.col-lg-3').remove();
                        Swal.fire(
                            'Deleted!',
                            'The trader has been deleted.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            'Unable to delete the trader.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the trader.',
                        'error'
                    );
                }
            });
        } else {
            Swal.fire(
                'Cancelled',
                'The trader was not deleted.',
                'info'
            );
        }
    });
}








// $('#licenceimage').on('change', function() {
//     if (window.File && window.FileList && window.FileReader) {
//         var files = event.target.files;
//         $("#licence_thumb").html(""); // Clear the preview container

//         for (var i = 0; i < files.length; i++) {
//             var file = files[i];
//             if (file.type.match('pdf.*')) {
//                 var reader = new FileReader();
//                 reader.onload = function(event) {
//                     var imagePreview = '<a href="' + event.target.result + '" class="image-preview">' +
//                         '<img src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" width="50px" height="50px"/>' +
//                         '<span class="delete-button" data-index="' + i + '">Delete</span>' +
//                         '</a>';
//                     $("#licence_thumb").append(imagePreview);
//                 };
//                 reader.readAsDataURL(file);
//             }
//         }
//     } else {
//         alert("Your browser doesn't support file preview.");
//     }
// });

// // Delete image on click of delete button
// $("#licence_thumb").on('click', '.delete-button', function() {
//     var index = $(this).data('index');
//     $("#licenceimage")[0].files.splice(index, 1);
//     $(this).parent('.image-preview').remove();
// });

// /**
//  * add new company  
//  */


function savecompany() {
    $('#btn_save_company').text('Saving...');
    $('#btn_save_company').attr('disabled', true);
    var url = save_method == 'update' ? "company/updatecompanybyuser" : "createcompanybyuser";
    var form_data = new FormData(document.getElementById('company_form')); // Changed to the company form ID
    var file_data = $('#licenceimage')[0].files; // Target the licence image input
    for (var i = 0; i < file_data.length; i++) {
        form_data.append("licenceimage", file_data[i]); // Append file data
    }

    // AJAX request to handle form submission
    jQuery.ajax({
        type: "POST",
        url: url,
        data: form_data,
        dataType: "json",
        processData: false, // Required for file upload
        contentType: false, // Required for file upload
        success: function (response) {
            if (response.status === 200) {
                fetchCompanyDetails();
                $('#cid').val(response.cid);
               
            } else {
                // Error message if response status is not 200
                swal({
                    title: "Failed",
                    type: "warning",
                    text: response.message,
                    confirmButtonColor: "#D22B2B"
                });
            }
            
            // Reset button after operation completes
            $('#btn_save_company').text('Submit');
            $('#btn_save_company').attr('disabled', false);
        },
        error: function (xhr, status, error) {
            // Handle error response
            swal({
                title: "Error",
                text: "Something went wrong. Please try again.",
                type: "error",
                confirmButtonColor: "#D22B2B"
            });

            // Reset button after operation completes
            $('#btn_save_company').text('Submit');
            $('#btn_save_company').attr('disabled', false);
        }
    });
}
//fetchcompany code with image fetching
// function fetchCompanyDetails() {
//     $.ajax({
//         type: "POST",
//         url: "company/getcompanybyuserId", // URL for fetching company details
//         dataType: "json",
//         success: function (response) {
//             console.log(response);  // Check the response in the console.
//             if (response.status === 200) {
//                 // Only manipulate the company list, not other elements like dropdown
//                 $('#listofcompany').empty();  // Clear the previous company list
                
//                 var companyData = response.data;
                
//                 // Loop through the company data and generate HTML dynamically
//                 companyData.forEach(function(company) {
//                     var companyCardHTML = `
//                         <div class="col-lg-4 col-md-6">
//                             <div class="pricing--item text-center mb-2 active" id="card-${company.id}">
//                                 <span class="pricing--text text-white bg-orange">${company.companyName}</span>
//                                 <div class="text-left">
//                                     <a href="javascript:void(0)" title="Edit" onclick="edit_corporate(${company.id})" id="edit_${company.id}">
//                                         <i class="fa fa-edit" style="font-size:15px"></i>
//                                     </a>
//                                     <a href="javascript:void(0)" style="float:right" onclick="deleteCompany(${company.id})" id="delete_${company.id}">
//                                         <i class="fa fa-trash" style="font-size:15px"></i>
//                                     </a>
//                                 </div>
//                                 <br>
//                                 <div class="img" style="margin-top: 15px;">
//                                     <a href="${company.licenceImage ? '<?php echo base_url("./assets/upload/"); ?>' + company.licenceImage : '#'}" data-fancybox="zoom">
//                                         <img src="${company.licenceImage ? '<?php echo base_url("./assets/upload/"); ?>' + company.licenceImage : ''}" alt="img" style="width: 140px; height: 80px;">
//                                     </a>
//                                 </div>
//                                 <div class="pricing--header pb-0">
//                                     <ul class="list-unstyled">
//                                         <li class="d-flex justify-content-between"><strong>Profession</strong>${company.professions}</li>
//                                         <li class="d-flex justify-content-between"><strong>CID Number</strong>${company.cid}</li>
//                                         <li class="d-flex justify-content-between"><strong>CIN Number</strong>${company.cinNo}</li>
//                                         <li class="d-flex justify-content-between"><strong>Licence Number</strong>${company.licenceNo}</li>
//                                     </ul>
                        
//                                 </div>
                                
//                             </div>
//                         </div>`;
                    
//                     // Append the card to the list of companies
//                     $('#listofcompany').append(companyCardHTML);
//                 });
//             } else {
//                 // Show error message if status is not 200
//                 swal({
//                     title: "Error",
//                     text: response.message,
//                     type: "error",
//                     confirmButtonColor: "#D22B2B"
//                 });
//             }
//         },
//         error: function (xhr, status, error) {
//             // Show a generic error message in case of failure
//             swal({
//                 title: "Error",
//                 text: "Could not fetch company details.",
//                 type: "error",
//                 confirmButtonColor: "#D22B2B"
//             });
//         }
//     });
// }

function fetchCompanyDetails() {
    $.ajax({
        type: "POST",
        url: "company/getcompanybyuserId",
        dataType: "json",
        success: function (response) {
            if (response.status === 200) {
                $('#listofcompany').empty(); 
                var companyData = response.data;
                companyData.forEach(function(company) {
                    var companyCardHTML = `
                        <div class="col-lg-4 col-md-6">
                            <div class="pricing--item text-center mb-2 active" id="card-${company.id}">
                                <span class="pricing--text text-white bg-orange" style=" display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:180px;">${company.companyName}</span>
                                <div class="text-left">
                                    <a href="javascript:void(0)" title="Edit" onclick="edit_corporate(${company.id})" id="edit_${company.id}">
                                        <i class="fa fa-edit" style="font-size:15px"></i>
                                    </a>
                                    <a href="javascript:void(0)" style="float:right" onclick="deleteCompany(${company.id})" id="delete_${company.id}">
                                        <i class="fa fa-trash" style="font-size:15px"></i>
                                    </a>
                                </div>
                                <br>
                                <div class="pricing--header pb-0">
                                    <ul class="list-unstyled">
                                        <li class="d-flex justify-content-between"><strong>Profession</strong>${company.professions}</li>
                                        <li class="d-flex justify-content-between"><strong>CID Number</strong>${company.cid}</li>
                                        <li class="d-flex justify-content-between"><strong>CIN Number</strong>${company.cinNo}</li>
                                        <li class="d-flex justify-content-between"><strong>Licence Number</strong>${company.licenceNo}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>`;
                    $('#listofcompany').append(companyCardHTML);
                });
            } else {
                swal({
                    title: "Error",
                    text: response.message,
                    type: "error",
                    confirmButtonColor: "#D22B2B"
                });
            }
        },
        error: function (xhr, status, error) {
            swal({
                title: "Error",
                text: "Could not fetch company details.",
                type: "error",
                confirmButtonColor: "#D22B2B"
            });
        }
    });
}

function edit_corporate(id) {
    $('#company_form').trigger('reset');
    document.getElementById('addnewcompany').style.display = 'block';
    document.getElementById('listofcompany').style.display = 'none';
    document.getElementById('connectwithcompany').style.display = 'none';

    // Change the save button text to "Update"
    $('#btn_save_company').text('Update');
    save_method = 'update'; // Set the save_document variable to 'update'

    // Fetch company details
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "company/editcompanydetailsbyid",
        data: { companyId: id },
        success: function(response) {
            if (response.status == 200) {
                var company = response.data[0];
                $('#companyName').val(company.companyName);
                $('#cinNumber').val(company.cinNo);
                $('#licenceNumber').val(company.licenceNo);
                $('#cid').val(company.cid);
                // If there's an existing document image, display it
                if (company.licenceImage) {
                    $('#licence_thumb').html('<img id="upload_document" src="<?php echo base_url("./assets/upload/"); ?>' + company.licenceImage + '" class="thumb-image" style="width: 140px; height: 80px;">');
                }

                // Fetch professions to populate the dropdown
                $.ajax({
                    type: "GET",
                    url: "profession",
                    dataType: "json",
                    success: function(professions) {
                        // Clear existing options
                        $('#select_profession').empty().append('<option value="">Select Profession</option>');

                        // Populate the dropdown with professions
                        $.each(professions.data, function(index, profession) {
                            $('#select_profession').append('<option value="' + profession.id + '">' + profession.profession + '</option>');
                        });

                        // Handle multiple profession IDs
                        var professionIds = company.professionId.split(','); 
                        $('#select_profession').val(professionIds); 
                    },
                    error: function() {
                        alert("An error occurred while fetching professions.");
                    }
                });

            } else {
                alert("Failed to fetch company details. Please try again.");
            }
        },
        error: function() {
            alert("An error occurred while fetching document details.");
        }
    });
}


function deleteCompany(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete this company?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "company/deleteCompany",
                data: { companyId: id },
                dataType: "json",
                success: function (response) {
                    if (response.status === 200) {
                        $(`#card-${id}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                        Swal.fire("Deleted!", response.message, "success");
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire("Error", "Could not delete the company.", "error");
                }
            });
        } else {
            Swal.fire(
                'Cancelled',
                'The company was not deleted.',
                'info'
            );
        }
    });
}



function addlicence(id){
    if(id === "add_licence"){
        getProfession();
        document.getElementById('add_licence').innerHTML = "Show all Licence";
        document.getElementById('add_licence').id = 'all_licence';
        document.getElementById('addnewlicence').style.display = 'block';
        document.getElementById('listoflicence').style.display = 'none';
    }else if(id === "all_licence"){
        document.getElementById('all_licence').innerHTML = "Add Licence";
        document.getElementById('all_licence').id = 'add_licence'; 
        document.getElementById('listoflicence').style.display = 'block';
        document.getElementById('addnewlicence').style.display = 'none';
    }
}


function addcompany(id){
    if(id === "add_company"){
        getProfession();
        document.getElementById('addnewcompany').style.display = 'block';
        document.getElementById('listofcompany').style.display = 'none';
        document.getElementById('connectwithcompany').style.display = 'none';
        $('#company_action').html('');
        $('#company_action').append('<a href="javascript:void(0)" onclick="addcompany(this.id);" id="show_all_company" class="dropdown-item"><i class="fas fa-list"></i> Show all my companies</a><a href="javascript:void(0)" onclick="addcompany(this.id);" id="connect_with_existing" class="dropdown-item"><i class="fas fa-external-link-alt"></i> Find my company</a>');
    }else if(id === "show_all_company"){
        document.getElementById('listofcompany').style.display = 'block';
        document.getElementById('addnewcompany').style.display = 'none';
        document.getElementById('connectwithcompany').style.display = 'none';
        $('#company_action').html('');
        $('#company_action').append('<a href="javascript:void(0)" onclick="addcompany(this.id);" id="add_company" class="dropdown-item"><i class="fa fa-building"></i> Create new company for me</a><a href="javascript:void(0)" onclick="addcompany(this.id);" id="connect_with_existing" class="dropdown-item"><i class="fas fa-external-link-alt"></i> Find my company</a>'); 
    }else if(id === "connect_with_existing"){
        getProfession();
        document.getElementById('listofcompany').style.display = 'none';
        document.getElementById('addnewcompany').style.display = 'none';
        document.getElementById('connectwithcompany').style.display = 'block';
        $('#company_action').html('');
        $('#company_action').append('<a href="javascript:void(0)" onclick="addcompany(this.id);" id="add_company" class="dropdown-item"><i class="fa fa-building"></i> Create new company for me</a><a href="javascript:void(0)" onclick="addcompany(this.id);" id="show_all_company" class="dropdown-item"><i class="fas fa-list"></i> Show all my companies</a>'); 
    }
}

// /*$(document).ready(function(){
// $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
//     localStorage.setItem('activeTab', $(e.target).attr('href'));
// });
// var activeTab = localStorage.getItem('activeTab');
// if(activeTab){
//     $('#profile_tab a[href="' + activeTab + '"]').tab('show');
// }
// });*/







$(document).ready(function() { 
    if (window.File && window.FileList && window.FileReader) 
    {
        $(".image-file").on("change", function(e) 
      {
        var file = e.target.files,
        imagefiles = $(".image-file")[0].files;
        var i = 0;
        $.each(imagefiles, function(index, value){
          var f = file[i];
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            $('<div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px; margin-top:20px">' +
              '<img style="width: 100%; height: 80%%;" name="upload_cancel_cheque"  src="' + e.target.result + '" class="prescriptions">'+
              '<button type="button" style="margin-top:20px" class="btn btn-sm btn-rounded btn-danger remove">Remove</button>'+
              '<input type="hidden" name="upload_cancel_cheque" value="' + e.target.result + '">' +
              '<input type="hidden" name="imageName" value="' + value.name + '">' +
              '</div>').insertAfter("#selected-images");
            $(".remove").click(function(){
                $(this).parent(".pip").remove();
            });
        });
          fileReader.readAsDataURL(f);
          i++;
      });
    });
    } else {
        alert("Your browser doesn't support to File API")
    }
});




// /**
//  * Edit bank detail
//  * Change title of modal
// */

// /**
//  * Edit document detail
//  * Change title of modal
// */
// $('#add_documents').on('shown.bs.modal', function(e){
//     const buttonId = e.relatedTarget.id;
//     if(buttonId === "add_documents"){
//         $('#document_title').text("Add Document");
//         $('#btn_document_save').text("Save");

//     }else if(buttonId === "edit_documents"){
//         $('#document_title').text("Edit Document");
//         $('#btn_document_save').text("Update");
//         var documentid = e.relatedTarget.className;
//         getkycdocumentlist();
//         $.ajax({
//             type: "POST",
//             dataType: "json",
//             url: "getdocumentbyid",
//             data: {documentid:documentid},              
//             success: function(response) {
//                 if (response.status === 200 )
//                 {
//                     $.each(response.data, function(i, val) {
//                         $('#document_no').val(val.document_no);
//                         $('#document_type option[value="'+val.document_type+'"]').attr("selected", "selected");
//                     });
//                 }
//             }
//         });
//     }      
// });

/**
 * Add new document
 * switch document form
*/

function select_document(value){
    if(value === "PAN Card"){
        document.getElementById("pan_card").style.display = "block";
        document.getElementById("document").style.display = "block";
        document.getElementById("aadhar_card").style.display = "none";
    
    }else if(value === "Aadhar Card"){
        document.getElementById("aadhar_card").style.display = "block";
        document.getElementById("document").style.display = "block";
        document.getElementById("pan_card").style.display = "none";
        
    }else if(value === ""){
        document.getElementById("aadhar_card").style.display = "none";
        document.getElementById("document").style.display = "none";
        document.getElementById("pan_card").style.display = "none";
    }
}

// Call the function on document type change
// $('#document_type').change(updateDocumentNo);

// Call the function on page load to set the initial value
// updateDocumentNo();

// /**
//  * add new document  
//  */
// /*$("#submit_document").on('submit',function(event) {
//     event.preventDefault();
//     var form_data;
//     var document_type = document.getElementById('document_type').value;
//     var gst_no = document.getElementById('gst_no').value;
//     var pan_no = document.getElementById('pan_no').value;
//     var aadhar_no = document.getElementById('aadhar_no').value;
//     var pan_card = $('#upload_pan_card').prop('files')[0];
//     var aadhar_card = $('#upload_aadharcard_certificate').prop('files')[0];
//     var gst_certificate = $('#upload_gst_certificate').prop('files')[0];

//     if(document_type === "GST Number"){
//         form_data = new FormData();
//         form_data.append('gst_no',gst_no);
//         form_data.append('upload_gst_certificate',gst_certificate);
//         jQuery.ajax({
//             type: "POST",
//             url: "save_gst",
//             data: form_data,
//             dataType: "json",
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//                 if (response.status === 200 )
//                 {
//                     document.getElementById("submit_document").reset();
//                     $('#alert_message_document').append('<div class="alert alert-success" role="alert">'+response.message+'</div>');
//                     setTimeout(function() { $("#alert_message_document").hide(); }, 5000);
//                 }
//                 else{
//                     $('#alert_message_document').append('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
//                     setTimeout(function() { $("#alert_message_document").hide(); }, 5000);
//                 }
//             }
//         });
//     }else if(document_type === "PAN Card"){
//         form_data = new FormData();
//         form_data.append('pan_no',pan_no);
//         form_data.append('upload_pan_card',pan_card);
//         jQuery.ajax({
//             type: "POST",
//             url: "save_pan",
//             data: form_data,
//             dataType: "json",
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//                 if (response.status === 200 )
//                 {
//                     document.getElementById("submit_document").reset();
//                     $('#alert_message_document').append('<div class="alert alert-success" role="alert">'+response.message+'</div>');
//                     setTimeout(function() { $("#alert_message_document").hide(); }, 5000);
//                 }
//                 else{
//                     $('#alert_message_document').append('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
//                     setTimeout(function() { $("#alert_message_document").hide(); }, 5000);
//                 }
//             }
//         });
//     } else if(document_type === "Aadhar Card"){
//         form_data = new FormData();
//         form_data.append('aadhar_no',aadhar_no);
//         form_data.append('upload_aadharcard',aadhar_card);
//         jQuery.ajax({
//             type: "POST",
//             url: "save_aadhar_card",
//             data: form_data,
//             dataType: "json",
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//                 if (response.status === 200 )
//                 {
//                     document.getElementById("submit_document").reset();
//                     $('#alert_message_document').append('<div class="alert alert-success" role="alert">'+response.message+'</div>');
//                     setTimeout(function() { $("#alert_message_document").hide(); }, 5000);
//                 }
//                 else{
//                     $('#alert_message_document').append('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
//                     setTimeout(function() { $("#alert_message_document").hide(); }, 5000);
//                 }
//             }
//         });
//     }
// }); */

    $("#agent_form").on('submit',function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "save_new_agent",
            dataType:"json",
            data: $('#agent_form').serialize(),
            success: function(response) {
                if (response.status === 200 )
                {
                    swal({
                        title: "Success!",
                        type: "success",
                        text: response.message,
                        confirmButtonColor: "#04AA6D"
                        },function(result) {
                            if(result){
                                window.location.reload();
                            }
                        });
                }
                else{
                    swal({
                        title: "Failed!",
                        type: "warning",
                        text: response.message,
                        confirmButtonColor: "#D22B2B"
                    });
                }
            }
        }); 
    });

    $("#surveyor_buyer_form").on('submit',function(event) {
        event.preventDefault();
        var category = $('#salvage_buyer_category_list').val();
        var subcategory = $('#salvage_buyer_subcategory_list').val();
        var range_list = $('#range_list').val();
        var state_list = $('#state_list').val();
        var others = $('#other_salvage').val();
        $.ajax({
            type: "POST",
            url: "save_new_salvage_buyer",
            dataType:"json",
            data: {category:category,subcategory:subcategory,range_list:range_list,state_list:state_list,others:others},
            success: function(response) {
                if (response.status === 200 )
                {
                    swal({
                        title: "Success!",
                        type: "success",
                        text: response.message,
                        confirmButtonColor: "#04AA6D"
                        },
                        function(result) 
                        {
                            if(result){
                                window.location.reload();
                            }
                        });
                }
                else{
                    swal({
                        title: "Failed!",
                        type: "warning",
                        text: response.message,
                        confirmButtonColor: "#D22B2B"
                        });
                }
            }
        }); 
    });
    // $("#edit_surveyor_buyer_form").on('submit', function(event) {
    //     event.preventDefault();
    //     var id = $('#edit_surveyor_buyer_form').data('id'); // Assuming you store the ID in a data attribute
    //     var category = $('#salvage_buyer_category_list').val();
    //     var subcategory = $('#salvage_buyer_subcategory_list').val();
    //     var range_list = $('#range_list').val();
    //     var state_list = $('#state_list').val();
    //     var others = $('#other_salvage').val();

    //     $.ajax({
    //         type: "POST",
    //         url: "update_salvage_buyer",  // Update URL
    //         dataType: "json",
    //         data: {
    //             id: id,
    //             category: category,
    //             subcategory: subcategory,
    //             range_list: range_list,
    //             state_list: state_list,
    //             others: others
    //         },
    //         success: function(response) {
    //             if (response.status === 200) {
    //                 swal({
    //                     title: "Success!",
    //                     type: "success",
    //                     text: response.message,
    //                     confirmButtonColor: "#04AA6D"
    //                 }, function(result) {
    //                     if (result) {
    //                         window.location.reload();
    //                     }
    //                 });
    //             } else {
    //                 swal({
    //                     title: "Failed!",
    //                     type: "warning",
    //                     text: response.message,
    //                     confirmButtonColor: "#D22B2B"
    //                 });
    //             }
    //         }
    //     });
    // });


    $("#investigator_form").on('submit',function(event) {
        event.preventDefault();
        var language = [];
        var investigator = [];
        var others;
        $('#language_list').find('input').each(function() {
            type = $(this).attr('type');
            id = $(this).attr('id');
            if(type === "checkbox" && $('#' + id).is(":checked")){
                value = $('#' + id).val();
                language.push(value);
            }
        });

        $('#investigator_list').find('input').each(function() {
            type = $(this).attr('type');
            id = $(this).attr('id');
            if(type === "checkbox" && $('#' + id).is(":checked")){
                value = $('#' + id).val();
                investigator.push(value);
            }
        });
        others = $("#other_investigator").val();
        $.ajax({
            type: "POST",
            url: "save_new_investigator",
            dataType:"json",
            data: {others:others, language:language, investigator:investigator},
            success: function(response) {
                if (response.status === 200 )
                {
                    swal({
                            title: "Success!",
                            type: "success",
                            text: response.message,
                            confirmButtonColor: "#04AA6D"
                            },function(result) {
                                if(result){
                                    window.location.reload();
                                }
                            });
                }
                else{
                    swal({
                            title: "Failed!",
                            type: "warning",
                            text: response.message,
                            confirmButtonColor: "#D22B2B"
                            });
                }
            }
        }); 
    });


    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();
        }
    });
    function load_data(query){
        document.getElementById('surveyor_detail').style.display = "inline";
        if(query){
            $.ajax({
                url:"fetchsla",
                method:"POST",
                dataType: "json",
                data:{query:query},
                success:function(response){
                    var html = '';
                    $("#surveyor_detail").html("");
                    if(response != null){
                        $.each(response, function(i, val) {
                            html += '<div class="row">'+ 
                            '<div class="col-md-6">'+
                            '<h4 class="subtitle" style="color:black; margin-left:12px;">Personal Information</h4>'+
                            '<table class="table table-simple">'+
                            '<tbody>'+
                            '<tr>'+
                            '<td>SLA number:</td>'+
                            '<th>'+val.ind_sla_no_bap_format+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Surveyor Name:</td>'+
                            '<th>'+val.ind_surveyor_name+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Mobile:</td>'+
                            '<th>'+val.mobile_no+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Email:</td>'+
                            '<th>'+val.email_addr+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Address:</td>'+
                            '<th>'+val.addr_line1 +' '+val.addr_line2 +' '+val.addr_line3+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>City:</td>'+
                            '<th>'+val.city_name+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>District:</td>'+
                            '<th>'+val.dist_name+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>State:</td>'+
                            '<th>'+val.state_name+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Pincode:</td>'+
                            '<th>'+val.addr_pin+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>IIISLA Membership:</td>'+
                            '<th>'+val.iiisla_membership_no+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Effective Date:</td>'+
                            '<th>'+val.license_effective_date+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Expiry Date:</td>'+
                            '<th>'+val.license_expiry_date+'</th>'+
                            '</tr>'+
                            '</tbody>'+
                            '</table>'+
                            '</div>'+

                            '<div class="col-md-6">'+
                            '<h4 class="subtitle" style="color:black; margin-left:12px;">SLA Information</h4>'+
                            '<table class="table table-simple">'+
                            '<tbody>'+
                            '<tr>'+
                            '<td>Crop:</td>'+
                            '<th>'+(val.crop !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Engineering:</td>'+
                            '<th>'+(val.engineering !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Fire:</td>'+
                            '<th>'+(val.fire !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>LOP:</td>'+
                            '<th>'+(val.lop !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Marine Cargo:</td>'+
                            '<th>'+(val.marinecargo !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Marine hull:</td>'+
                            '<th>'+(val.marinehull !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Miscellaneous:</td>'+
                            '<th>'+(val.misc !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Motor:</td>'+
                            '<th>'+(val.motor !=0 ? "Yes":"No")+'</th>'+
                            '</tr>'+
                            '</tbody>'+
                            '</table>'+           
                            '</div>'+
                            '</div>';
                            $("#surveyor_detail").append(html);
                        });
                    }else{
                        $("#surveyor_detail").append('<label style=\"margin:auto; text-align:center\"><span> No data</span></label>');
                    }   
                }
            });
        }else{
            $("#surveyor_detail").html("");
        }
    }

    $(".sla-licence").on("change", function(e) {
        var file = e.target.files,
        imagefiles = $(".sla-licence")[0].files;
        var i = 0;
        $.each(imagefiles, function(index, value){
            var f = file[i];
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                $('<div class="sla col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px; margin-top:20px">' +
                '<img style="width: 100%; height: 80%%;"  src="' + e.target.result + '" class="prescriptions">'+
                '<button type="button" style="margin-top:20px" class="btn btn-sm btn-rounded btn-danger remove">Remove</button>'+
                '<input type="hidden" name="upload_sla_licence" value="' + e.target.result + '">' +
                '<input type="hidden" name="imageName" value="' + value.name + '">' +
                '</div>').insertAfter("#selected-sla-images");
                $(".remove").click(function(){
                    $(this).parent(".sla").remove();
                });
            });
            fileReader.readAsDataURL(f);
            i++;
        });
    });

    function checkinvestigator(id){
        var investigator = document.getElementById('investigator' + id).value;
        var invest = document.getElementById('investigator' + id);
        if(investigator === "Document Translation" && invest.checked){
            document.getElementById("language").style.display = "block";
        }else if(investigator === "Document Translation" && !invest.checked){
            document.getElementById("language").style.display = "none";
        }
    }



// /**
//  * add new investigator detail  
//  */
/*$("#investigator_form").on('submit',function(event) {
    event.preventDefault();
    var investigator = [];
    var language = [];
    var other = document.getElementById('others').value;
    for (var investigate of document.getElementById('investigator_list').options) {
        if (investigate.selected) {
            investigator.push(investigate.text);
      }
    } 
    for (var lang of document.getElementById('language_list').options) {
        if (lang.selected) {
            language.push(lang.text);
      }
    }
    $.ajax({
        type: "POST",
        url: "save_new_investigator",
        data: {investigators:investigator,languages:language, others:other},
        success: function(response) {
            if (response.status === 200 )
            {
                document.getElementById("agent_form").reset();
                $('#alert_message').append('<div class="alert alert-success" role="alert">'+response.message+'</div>');
                setTimeout(function() { $("#alert_message").hide(); }, 3000);
            }
            else{
                $('#alert_message').append('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
                setTimeout(function() { $("#alert_message").hide(); }, 3000);
            }
        }
    }); 
}); */

    function getProfession(){
        $.ajax({
            url: "profession",
            cache: false,
            dataType: "json",
            type: "GET",
            success: function(response) {
                $("#select_profession").html('');
                $("#choose_profession").html('');
                $("#radio_profession").html('');
                $("#select_profession").append('<option value="">Nothing Selected</option>'); 
                $("#choose_profession").append('<option value="">Nothing Selected</option>'); 
                $.each(response.data, function(i, val) {   
                    if(val.profession === "Surveyor" || val.profession === "Agent" || val.profession === "Professional" || val.profession === "Salvage Trader"){
                        $("#radio_profession").append("<label class=\"form-radio\" style=\"margin-right:auto\"><input type=\"radio\" onchange=\"selectprofession(this.id)\" name=\"select_profession\" id="+i+"_profession"+" value="+ $.trim(val.profession)+" class=\"form-radio-input\"><span class=\"form-radio-label\">"+ val.profession+"</span></label>");
                    }if(val.profession != "Admin"){
                        $("#select_profession").append("<option value=" + val.id + ">" + val.profession+ "</option>");
                        $("#choose_profession").append("<option value=" + val.id + ">" + val.profession+ "</option>");
                    }   
                });
            }
        });
    }

    function getCompany(){
        $.ajax({
            url: "companies",
            cache: false,
            dataType: "json",
            type: "GET",
            success: function(response) {
                $("#select_company").html('');
                $("#select_company").append('<option value="">Nothing Selected</option>'); 
                $.each(response.data, function(i, val) {                
                    if(val.profession != "Admin"){
                        $("#select_company").append("<option value=" + val.id + ">" + val.corp_company_name+ "</option>");
                    }   
                });
            }
        });
    }

    function isValid_CIN_Number(id) {
        // Regex to check valid
        // CIN Number
        var str = document.getElementById(id).value;
        let regex = new RegExp(/^([LUu]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/);
    
        // if str
        // is empty return false
        if (str == null) {
            //return "false";
            alert("Field Empty");
        }
    
        // Return true if the str
        // matched the ReGex
        if (regex.test(str) == true) {
            // return "true";
            alert("Valid CIN Number");
        }
        else {
            // return "false";
            alert("CIN number not valid");
        }
    }

// function isValid_PAN_Number(id) {
//     var str = document.getElementById(id).value;
//     var regex = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;

//     if (str.match(regex)) {
//         alert("Valid PAN number");
//     }
//     else {
//         alert("Invalid PAN number");
//         $(pan).val("");
//     }
// }

    $('select[id="select_company"]').on('change', function() {
        var professionId = $(this).val();
        if(professionId === "others"){
            document.getElementById("create_new_company").style.display="block";
        }else{
            var companyid = document.getElementById('select_company').value;
            $.ajax({
                type: "POST",
                url: "companydetail",
                dataType: "json",
                data: {companyid : companyid },
                success: function (response) {
                    if(response.status === 200){
                        
                    }
                }
            });
            document.getElementById("create_new_company").style.display="none";
        }
    });

    function selectprofession(id){
        var profession = document.getElementById(id).value;
        if(profession === "Surveyor"){
            document.getElementById("surveyor_form").style.display = "block";
            document.getElementById("agent_form").style.display = "none";
            document.getElementById("surveyor_detail").style.display = "none";
            document.getElementById("investigator_form").style.display = "none";
            document.getElementById("surveyor_buyer_form").style.display = "none";
            
        }else if(profession === "Agent"){
            document.getElementById("agent_form").style.display = "block";
            document.getElementById("surveyor_form").style.display = "none";
            document.getElementById("investigator_form").style.display = "none";
            document.getElementById("surveyor_detail").style.display = "none";
            document.getElementById("surveyor_buyer_form").style.display = "none";
            getInsuranceCompany();
            
        }else if(profession === "Professional"){
            document.getElementById("investigator_form").style.display = "block";
            document.getElementById("surveyor_buyer_form").style.display = "none";
            document.getElementById("agent_form").style.display = "none";
            document.getElementById("surveyor_form").style.display = "none";
            document.getElementById("surveyor_detail").style.display = "none";
            getinvestigatorlist();       
        }else if(profession === "Salvage"){
            
            document.getElementById("surveyor_buyer_form").style.display = "block";
            document.getElementById("investigator_form").style.display = "none";
            document.getElementById("agent_form").style.display = "none";
            document.getElementById("surveyor_form").style.display = "none";
            document.getElementById("surveyor_detail").style.display = "none";  
            getbuyercategorylist();   
            getstate();
        }
    }


    function getinvestigatorlist() {
        $.ajax({
            type: "GET",
            url: "investigatorlist",
            dataType:"json",
            success: function(response) {
                console.log(response);
                $("#investigator_list").html("");
                for (let i = 0; i < response.data.length; i++) {
                    $("#investigator_list").append(response.data[i]);
                }
            }
        });
    }

    function getbuyercategorylist() {
            $.ajax({
                type: "GET",
                url: "salvagebuyercategorylist",
                dataType:"json",
                success: function(response) {
                    $("#salvage_buyer_category_list").html("");
                    for (let i = 0; i < response.data.length; i++) {
                        $("#salvage_buyer_category_list").append(response.data[i]);
                    }
                    $('#salvage_buyer_category_list').multiselect('rebuild');
                }
            });
    }

    $("#salvage_buyer_category_list").on("change", function(e) {
        var category =  document.getElementById("salvage_buyer_category_list").value;
        if(category != ""){
            $.ajax({
                type: "POST",
                url: "salvagesubcategory",
                data: {category:category},
                dataType:"json",
                success: function(response) {
                
                    $("#salvage_buyer_subcategory_list").html("");
                    for (let i = 0; i < response.data.length; i++) {
                        $("#salvage_buyer_subcategory_list").append(response.data[i]);
                    }
                    $('#salvage_buyer_subcategory_list').multiselect('rebuild');
                }
            });
        }
    });

    function getstate() {
        $.ajax({
            type: "GET",
            url: "state",
            dataType:"json",
            success: function(response) {
                $("#state_list").html("");
                for (let i = 0; i < response.data.length; i++) {
                    $("#state_list").append(response.data[i]);
                }
                $('#state_list').multiselect('rebuild');
            }
        });
    }

    function getInsuranceCompany(){
        var professionId = 2;
        $.ajax({
            type: "POST",
            url: "companybyprofessionid",
            dataType: "json",
            data: {profession : professionId },
            success: function (response) {
                $("#insurance_company").html('');
                $("#insurance_company").append('<option value="">Nothing Selected</option>'); 
                $.each(response.data, function(i, val) {                
                    $("#insurance_company").append("<option value=" + val.id + ">" + val.companyName+ "</option>"); 
                });
            }
        });
    }
    

// $(document).ready(function() { 
//     if (window.File && window.FileList && window.FileReader) 
//     {
//       $(".upload-file").on("change", function(e) 
//       {
//         var file = e.target.files,
//         imagefiles = $(".upload-file")[0].files;
//         var i = 0;
//         $.each(imagefiles, function(index, value){
//           var f = file[i];
//           var fileReader = new FileReader();
//           fileReader.onload = (function(e) {
//             $('<div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px; margin-top:20px">' +
//               '<iframe src="' + e.target.result + '" style="width: 100px; height: 100px;border: none;"></iframe>'+
//               '<button type="button" style="margin-top:20px" class="btn btn-sm btn-rounded btn-danger remove">Remove</button>'+
//               '<input type="hidden" name="upload_file" value="' + e.target.result + '">' +
//               '<input type="hidden" name="imageName" value="' + value.name + '">' +
//               '</div>').insertAfter("#selected-pdf");
//             $(".remove").click(function(){
//                 $(this).parent(".pip").remove();
//             });
//         });
//           fileReader.readAsDataURL(f);
//           i++;
//       });
//     });
//   } else {
//       alert("Your browser doesn't support to File API")
//   }
// });



</script>