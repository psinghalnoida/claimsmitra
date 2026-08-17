<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<!-- Main Container Start -->
<main class="main--container">
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-12">
            <!-- Panel Start -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $companydata['companyName'] ?></h3>
                </div>
                <div class="panel-content">
                    <div class="row flex-nowrap mx-0">
                        <!-- Tabs Nav Start -->
                        <ul class="nav nav-tabs nav-tabs-line-left flex-column col-lg-3">
                            <li class="nav-item">
                                <a href="#tab13" data-toggle="tab" class="nav-link active">Company Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab14" data-toggle="tab" class="nav-link">Admin Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab15" data-toggle="tab" class="nav-link">Users</a>
                            </li>
                        </ul>
                        <!-- Tabs Nav End -->
                        <!-- Tab Content Start -->
                        <div class="tab-content col">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab13">
                                <!-- Main Content Start -->
                                <section class="main--content">
                                    <div class="row gutter-20">
                                        <div class="col-md-12">
                                            <!-- Panel Start -->
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Company Profile</h3>
                                                </div>
                                                <div class="panel-content">
                                                    <form id="editCompany" method="post">
                                                    <div class="form-group">
                                                        <label>
                                                            <span class="label-text">Company Name</span>
                                                            <input type="text" name="companyName" value="<?php echo $companydata['companyName'] ?>" class="form-control" disabled>
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>
                                                            <span class="label-text">Profession</span>
                                                            <script type="text/javascript">
                                                                $(document).ready(function() {       
                                                                    $('#select_profession').multiselect({       
                                                                        nonSelectedText: 'Select Profession',
                                                                        buttonWidth: '100%',
                                                                        enableFiltering: true,
                                                                        multiselect:true,
                                                                        includeSelectAllOption: true,
                                                                        maxHeight: 200, 
                                                                        buttonTextAlignment: 'left',
                                                                        enableCaseInsensitiveFiltering: true,           
                                                                    });
                                                                });
                                                            </script>
                                                            <select name="profession" id="select_profession" class="form-control" required multiple disabled>
                                                                <?php foreach ($professionlist as $value) { 
                                                                    if($value['profession'] != "Admin"){
                                                                        $selected = in_array($value['id'],explode(",",$companydata['professionId'])) ? " selected " : null;
                                                                        echo "<option value='".$value['id']."' $selected>".$value['profession']."</option>";
                                                                    }
                                                                } ?>
                                                            </select>
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>
                                                            <span class="label-text">PAN Number</span>
                                                            <input type="text" value="<?php echo $companydata['panNo'] ?>" name="panNo" disabled class="form-control">
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>
                                                            <span class="label-text">CIN Number</span>
                                                            <input type="text" value="<?php echo $companydata['cinNo'] ?>" name="cinNo" disabled class="form-control">
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>
                                                            <span class="label-text">Website</span>
                                                            <input type="text" value="<?php echo $companydata['website'] ?>" name="website" id="website" class="form-control" disabled>
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-rounded btn-primary" id="edit_company"  onclick="editCompanyProfile();">Edit</button>
                                                        <button type="submit" class="btn btn-rounded btn-success">Approve</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Panel End -->
                                        </div>
                                    </div>
                                </section>
                                <!-- Main Content End -->
                            </div>
                            <!-- Tab Pane End -->

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade" id="tab14">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil ex quas, nostrum. Officia suscipit possimus inventore adipisci corporis?</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptatum voluptas quas debitis ex sit incidunt repudiandae pariatur?</p>
                            </div>
                            <!-- Tab Pane End -->

                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade" id="tab15">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil ex quas, nostrum. Officia suscipit possimus inventore adipisci corporis?</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptatum voluptas quas debitis ex sit incidunt repudiandae pariatur?</p>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of the non location based job modal -->
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script>
/**
 * Edit company data   
 */
function editCompanyProfile(){
    var buttontype = document.getElementById('edit_company').innerHTML;
    if(buttontype === "Edit"){
        document.getElementById("edit_company").innerHTML = "Update";
        $("#editCompany :input").prop("disabled", false);
    }else if(buttontype === "Update"){
        
    }
}
</script>