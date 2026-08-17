<!-- Your PHP code and HTML structure -->
<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <section class="main--content m-2">
                <div class="row gutter-20 mt-2">
                    <div class="col-lg-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add User</h3>
                            </div>
                            <div class="panel-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active m-2" id="tab01">
                                        <form>
                                            <div class="row my-3">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="add_user" style="color:black">Add user&nbsp;<span style="color:red">*</span></label>
                                                        <select class="form-control editable-field" id="add_user" name="add_user" required>>
                                                            <option value="">Select</option>
                                                            <option value="Death">Option1</option>
                                                            <option value="Disablement">Option2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="user_dept" style="color:black">Select Department &nbsp;<span style="color:red; ">*</span></label>
                                                        <select class="form-control editable-field" id="user_dept" name="user_dept">
                                                            <option value="">Select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                                                <input class="btn case_btn" type="button" value="Submit" id="">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Accordions</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-content">
                                <div class="panel-subtitle">
                                    <h5 class="h5">Collapse without icons</h5>
                                </div>

                                <div id="accordion02">
                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse05">Collapse Group Item #5</button>
                                            </h5>
                                        </div>

                                        <div id="collapse05" class="collapse show" data-parent="#accordion02">
                                            <div class="card-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil ex quas, nostrum. Officia suscipit possimus inventore adipisci corporis?</p>

                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptatum voluptas quas debitis ex sit incidunt repudiandae pariatur?</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse06">Collapse Group Item #6</button>
                                            </h5>
                                        </div>

                                        <div id="collapse06" class="collapse" data-parent="#accordion02">
                                            <div class="card-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil ex quas, nostrum. Officia suscipit possimus inventore adipisci corporis?</p>

                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptatum voluptas quas debitis ex sit incidunt repudiandae pariatur?</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>


<?php $this->load->view('adminpanel/jobs/locationbasedjob/progressbar'); ?>
<?php $this->load->view('adminpanel/layout/footer'); ?>