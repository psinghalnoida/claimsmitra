<style type="text/css">
    tr.edit-table  td {
      font-size: 12px;
      padding: .4px;
      font-weight: 200;
    }
    .input-border{
        border: none;
    }

</style>
<div class="panel mt-4" id="caseForm">
    <form id="risk_inspection_casedata" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">CASE DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?> 
                    <a href="<?php echo base_url('generatepdf/' . $aid . '/' . $companyid); ?>" target="_blank" class="btn case_btn">Generate Report</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Report" data-toggle="modal" href="javascript:void(0)" id="report_images" style="padding-right: 5px; margin-right:8px;">Report Images <img src="<?php echo base_url('assets/upload.png'); ?>" alt="" style="max-height:20px;color:#fff;" class="white-icon"></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;"> 
            <div class="row">
             <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_address" style="color:black">Address of Insured <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_address) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->insured_address) ? $reportdata->insured_address : ""; ?>" id="insured_address" name="insured_address" placeholder="Address of Insured">
                    </div>
                </div>
                
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insured_accompanied" style="color:black">Person Accompanied <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_accompanied) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->insured_accompanied) ? $reportdata->insured_accompanied : ""; ?>" id="insured_accompanied" name="insured_accompanied" placeholder="Person Accompanied">
                    </div>
                </div> 
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="general" style="color:black">General <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->general) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->general) ? $reportdata->general : ""; ?>" id="general" name="general" placeholder="General">
                    </div>
                </div> 
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="planet_name" style="color:black">Name of Plant <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->planet_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->planet_name) ? $reportdata->planet_name : ""; ?>" id="planet_name" name="planet_name" placeholder="Name of Plant">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="location" style="color:black">Location <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->location) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->location) ? $reportdata->location : ""; ?>" id="location" name="location" placeholder="Location">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="plant_contruction" style="color:black">Plant Construction Year and Period <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->plant_contruction) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->plant_contruction) ? $reportdata->plant_contruction : ""; ?>" id="plant_contruction" name="plant_contruction" placeholder="Plant Construction Year and Period">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="plant_area" style="color:black">Area of Plant</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->plant_area) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->plant_area) ? $reportdata->plant_area : ""; ?>" id="plant_area" name="plant_area" placeholder="Area of Plant">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="certification" style="color:black">Certification like ISO etc.</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->certification) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->certification) ? $reportdata->certification : ""; ?>" id="certification" name="certification" placeholder="Certification like ISO">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="expiring_policy" style="color:black">Expiring Policy Details (Business Interruption)</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->expiring_policy) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->expiring_policy) ? $reportdata->expiring_policy : ""; ?>" id="expiring_policy" name="expiring_policy" placeholder="Expiring Policy Details">
                    </div>
                </div>
                  <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="brief_description" style="color:black">Brief description of the manufacturing process</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->brief_description) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->brief_description) ? $reportdata->brief_description : ""; ?>" id="brief_description" name="brief_description" placeholder="Brief description of the manufacturing process">
                    </div>
                </div>
            </div>

            
              <div class="row">
                <div class="col-xl-6 mt-2">
                    <div class="form-group">                       
                          <div class="table-responsive">
                             <table class="table table-bordered" id="feas_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th   style="color:black;font-size:12px;width:15%;">Water Underground</th>
                                        <th  style="color:black;font-size:12px;" colspan="4">Capicity: Ltr</td>
                                    </tr>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:15%">Fire Cylinders / Make</th>
                                        <th  style="color:black;font-size:12px;width:10%">Type</th>
                                        <th  style="color:black;font-size:12px;width:10%">Capicity</th>
                                        <th colspan="2"  style="color:black;font-size:12px;width:10%">No.</th>
                                        
                                    </tr>
                                </thead>
                                 <tbody id="all_feas">
                                    <tr class="feas-entry edit-table">
                                        <td><input type="text" class="form-control case-field underground_fire_cylinders input-border" name="underground_fire_cylinders[]" placeholder="Fire Cylinders"></td>
                                        <td><input type="text" class="form-control case-field type input-border" name="type[]" placeholder="Type"></td>
                                        <td><input type="text" class="form-control case-field capicity input-border" name="capicity[]" placeholder="Capicity"></td>
                                        <td><input type="text" class="form-control case-field no input-border" name="no[]" placeholder="No."></td>
                                        <td style="text-align: center;"><button type="button" class="btn btn-success addfaes" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="col-xl-6 mt-2">
                    <div class="form-group">
                          
                          <div class="table-responsive">
                             <table class="table table-bordered" id="overhead_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th   style="color:black;font-size:12px;width:15%;">Water Overhead</th>
                                        <th  style="color:black;font-size:12px;" colspan="4">Capicity: Ltr</td>
                                    </tr>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:15%">Fire Cylinders / Make</th>
                                        <th  style="color:black;font-size:12px;width:10%">Type</th>
                                        <th  style="color:black;font-size:12px;width:10%">Capicity</th>
                                        <th colspan="2" style="color:black;font-size:12px;width:10%">No.</th>
                                       
                                    </tr>
                                </thead>
                                 <tbody id="all_overhead">
                                    <tr class="overhead-entry edit-table">
                                        <td><input type="text" class="form-control case-field fire_cylinders_overhead input-border" name="fire_cylinders_overhead[]" placeholder="Fire Cylinders"></td>

                                        <td><input type="text" class="form-control case-field type_overhead input-border" name="type_overhead[]" placeholder="Type"></td>
                                        <td><input type="text" class="form-control case-field capicity_overhead input-border" name="capicity_overhead[]" placeholder="Capicity"></td>
                                        <td><input type="text" class="form-control case-field no__overhead input-border" name="no__overhead[]" placeholder="No."></td>
                                        <td style="text-align: center;"><button type="button" class="btn btn-success addoverhead" style="margin-top:6px;"><i class="fa fa-plus" ></i></button>
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="form-group">
                        <label for="expiring_policy" style="color:black">Hydrant System</label>
                       <input type="text" class="form-control case-field hydrant_system" name="hydrant_system" placeholder="Hydrant System" value="<?php echo isset($reportdata->hydrant_system) ? $reportdata->hydrant_system : ""; ?>">
                    </div>
                </div>
                  <div class="col-xl-3 col-md-3">
                    <div class="form-group">
                        <label for="safety_adequate" style="color:black">Is the fire safety adequate (Y/N)</label>
                        <input type="text" class="form-control case-field safety_adequate" name="safety_adequate" placeholder="Is the fire safety adequate (Y/N)" value="<?php echo isset($reportdata->safety_adequate) ? $reportdata->safety_adequate : ""; ?>">
                    </div>
                </div>

                  <div class="col-xl-3 col-md-3">
                    <div class="form-group">
                        <label for="single_multi" style="color:black">No of Stand (Single / Multi)</label>
                       <input type="text" class="form-control case-field single_multi" name="single_multi" placeholder="No of Stand (Single / Multi)" value="<?php echo isset($reportdata->single_multi) ? $reportdata->single_multi : ""; ?>">
                    </div>
                </div>
                  <div class="col-xl-3 col-md-3">
                    <div class="form-group">
                        <label for="working_status" style="color:black">Working Status of FEA</label>
                        <input type="text" class="form-control case-field working_status" name="working_status" placeholder="Working Status of FEA" value="<?php echo isset($reportdata->working_status) ? $reportdata->working_status : ""; ?>">
                    </div>
                </div>
        
                <div class="col-xl-12 mt-2">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="pwr_table">
                            <thead>
                                <tr class="edit-table">
                                    <th  style="color:black;font-size:12px;width:25%">Description</th>
                                    <th  style="color:black;font-size:12px;width:25%">PWR</th>
                                    <th  style="color:black;font-size:12px;width:25%">Head</th>
                                    <th colspan="2"  style="color:black;font-size:12px;width:25%">LPS</th>
                                </tr>
                            </thead>
                             <tbody id="all_pwr">
                                <tr class="pwr-entry edit-table ">
                                    <td><input type="text" class="form-control case-field main_pump input-border" name="main_pump[]" placeholder="Description"></td>
                                    <td><input type="text" class="form-control case-field pwr input-border" name="pwr[]" placeholder="PWR"></td>
                                    <td><input type="text" class="form-control case-field head input-border" name="head[]" placeholder="Head"></td>
                                    <td><input type="text" class="form-control case-field lps input-border" name="lps[]" placeholder="LPS"></td>
                                    <td style="text-align: center;"><button type="button" class="btn btn-success addpwr input-border" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tbody> 
                        </table>
                     </div>
                </div>
                <div class="col-xl-12 mt-2">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="feas_table">
                            <thead>
                                <tr class="edit-table">
                                    <th  style="color:black;font-size:12px;width:25%">No. of Sprinkles Points</th>
                                    <th  style="color:black;font-size:12px;width:25%">Factory</th>
                                    <th  style="color:black;font-size:12px;width:25%">Gdwn</th>
                                    <th colspan="2"   style="color:black;font-size:12px;width:25%">Utility</th>    
                                </tr>
                               
                            </thead>
                             <tbody >
                                <tr class=" edit-table ">
                                    <td><input type="text" class="form-control case-field fire_cylinders_overhead input-border" name="sprinkles_points[]" placeholder="No. of Sprinkles Points"></td>
                                    <td><input type="text" class="form-control case-field type_overhead input-border" name="type_overhead[]" placeholder="Factory"></td>
                                    <td><input type="text" class="form-control case-field capicity_overhead input-border" name="capicity_overhead[]" placeholder="Gdwn"></td>
                                    <td style="width:10%"><input type="text" class="form-control case-field no__overhead input-border" name="no__overhead[]" placeholder="Utility"></td>
                                    
                                </tr>
                               
                            </tbody> 
                        </table>
                     </div>
                </div>
                    
            </div>

             <div class="row mt-2">
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="noc_fir" style="color:black">Fir NOC (Y/N)</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->noc_fir) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->noc_fir) ? $reportdata->noc_fir : ""; ?>" id="noc_fir" name="noc_fir" placeholder="Fir NOC (Y/N)">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="railway_crossing" style="color:black">Railway Crossing</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->railway_crossing) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->railway_crossing) ? $reportdata->railway_crossing : ""; ?>" id="railway_crossing" name="railway_crossing" placeholder="Railway Crossing">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="housekeeping" style="color:black">Housekeeping</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->housekeeping) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->housekeeping) ? $reportdata->housekeeping : ""; ?>" id="housekeeping" name="housekeeping" placeholder="Housekeeping">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="housekeeping" style="color:black">Availability of 24 X 7 security guard & other management</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->housekeeping) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->housekeeping) ? $reportdata->housekeeping : ""; ?>" id="housekeeping" name="housekeeping" placeholder="Housekeeping">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="cctv" style="color:black">CCTV</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->cctv) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->cctv) ? $reportdata->cctv : ""; ?>" id="cctv" name="cctv" placeholder="CCTV">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="run_shift" style="color:black">No. of shift run</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->run_shift) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->run_shift) ? $reportdata->run_shift : ""; ?>" id="run_shift" name="run_shift" placeholder="No. of shift run">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="boundary_wall" style="color:black">Boundary wall</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->boundary_wall) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->boundary_wall) ? $reportdata->boundary_wall : ""; ?>" id="boundary_wall" name="boundary_wall" placeholder="Boundary wall">
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-xl-12 col-md-12 ">
                    <div class="form-group">
                        <label for="fire_protection" style="color:black">Fire Protection system inspection and maintanance (Specify the procedure and frequency for inspection and maintenance (Visual inspection , checking, cleaning and testing) of entire  firewater system (pump & drivers, tank, piping and valves, sprinkler, deluge, foam system)</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->fire_protection) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->fire_protection) ? $reportdata->fire_protection : ""; ?>" id="fire_protection" name="fire_protection" placeholder="">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12 ">
                     <div class="table-responsive">
                            <table class="table table-bordered" id="storage_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:30%">Descrption</th>
                                        <th  style="color:black;font-size:12px;width:30%">Raw Materials</th>
                                        <th colspan="2" style="color:black;font-size:12px;width:30%">Finished Goods</th>
                                    </tr>
                                </thead>
                                 <tbody id="all_storage">
                                    <tr class="storage-entry edit-table">
                                        <td><input type="text" class="form-control case-field descrption input-border" name="descrption[]" placeholder="Descrption"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="raw[]" placeholder="Raw Materials"></td>
                                        <td><input type="text" class="form-control case-field capicity input-border" name="capicity[]" placeholder="Finished Goods"></td>
                                        <td style="text-align: center;"><button type="button" class="btn btn-success addstorage" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                </div>

                <div class="col-xl-12 col-md-12 ">
                    <div class="form-group">
                        <label for="raw_material" style="color:black"> Storage of Raw Materials - 1) Open ,  2) Warehouses</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->raw_material) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->raw_material) ? $reportdata->raw_material : ""; ?>" id="raw_material" name="raw_material" placeholder="Storage of Raw Materials">
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 ">
                    <div class="form-group">
                        <label for="boundary_wall" style="color:black">Any other material information increasing or decreasing the risk exposure including exposure to AOG perils</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->aog) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->aog) ? $reportdata->aog : ""; ?>" id="aog" name="aog" placeholder="Any other material information increasing or decreasing the risk exposure including exposure to AOG perils">
                    </div>
                </div>
                  <div class="col-xl-12 col-md-12 ">
                    <div class="form-group">
                        <label for="boundary_wall" style="color:black">Stock height of bagged / packed material - give details</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->aog) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->aog) ? $reportdata->aog : ""; ?>" id="aog" name="aog" placeholder="Stock height of bagged / packed material - give details">
                    </div>
                </div>

                  <div class="col-xl-12 col-md-12 ">
                    <label for="boundary_wall" style="color:black">No. of storage blocks - Description & Type of construction</label>
                     <div class="table-responsive">
                            <table class="table table-bordered" id="construction_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:20%">Floor</th>
                                        <th  style="color:black;font-size:12px;width:20%">Type of construction </th>
                                        <th  style="color:black;font-size:12px;width:20%">Occupancy</th>
                                        <th  style="color:black;font-size:12px;width:15%">Hazard (Light / High)</th>
                                        <th colspan="2"  style="color:black;font-size:12px;width:15%">Remark (if any)</th>
                                    </tr>
                                </thead>
                                 <tbody id="all_construction">
                                    <tr class="construction-entry edit-table">
                                        <td><input type="text" class="form-control case-field floor input-border" name="floor[]" placeholder="Floor"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="construction[]" placeholder="Type of construction "></td>
                                        <td><input type="text" class="form-control case-field occupancy input-border" name="occupancy[]" placeholder="Occupancy"></td>
                                        <td><input type="text" class="form-control case-field hazard input-border" name="hazard[]" placeholder="Hazard (Light / High)"></td>
                                        <td><input type="text" class="form-control case-field remark input-border" name="remark[]" placeholder="Remark (if any)"></td>
                                        <td style="text-align: center;"><button type="button" class="btn btn-success addconstruction" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                  </div>

                <div class="col-xl-12 col-md-12 ">
                    <div class="form-group">
                        <label for="production_block" style="color:black">Segregated from production blocks / attached</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->production_block) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->production_block) ? $reportdata->production_block : ""; ?>" id="production_block" name="production_block" placeholder="Segregated from production blocks / attached">
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 ">
                    <div class="form-group">
                        <label for="production_block" style="color:black">Give details of electrical installations / equipment provided for lighting in warehouses</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->production_block) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->production_block) ? $reportdata->production_block : ""; ?>" id="production_block" name="production_block" placeholder="Give details of electrical installations / equipment provided for lighting in warehouses">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="indtl_resdnl" style="color:black">Type (Indtl / Resdnl)</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->indtl_resdnl) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->indtl_resdnl) ? $reportdata->indtl_resdnl : ""; ?>" id="indtl_resdnl" name="indtl_resdnl" placeholder="Type (Indtl / Resdnl)">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="kva_connection" style="color:black">Connection KVA</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->kva_connection) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->kva_connection) ? $reportdata->kva_connection : ""; ?>" id="kva_connection" name="kva_connection" placeholder="Connection KVA">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="flame_wiring" style="color:black">Flame Proof of wiring (Y/N)</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->flame_wiring) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->flame_wiring) ? $reportdata->flame_wiring : ""; ?>" id="flame_wiring" name="flame_wiring" placeholder="Flame Proof of wiring (Y/N)">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="flame_wiring" style="color:black">Static Discharge (Y/N)  </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->flame_wiring) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->flame_wiring) ? $reportdata->flame_wiring : ""; ?>" id="flame_wiring" name="flame_wiring" placeholder="Flame Proof of wiring (Y/N)">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="temporary_connection" style="color:black">Temporary Connection </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->temporary_connection) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->temporary_connection) ? $reportdata->temporary_connection : ""; ?>" id="temporary_connection" name="temporary_connection" placeholder="Temporary Connection">
                    </div>
                </div>
                 <div class="col-xl-2 col-md-2 ">
                    <div class="form-group">
                        <label for="ht_protection" style="color:black">Protection on Transformer HT</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ht_protection) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ht_protection) ? $reportdata->ht_protection : ""; ?>" id="ht_protection" name="ht_protection" placeholder="Protection on Transformer HT">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 ">
                    <div class="form-group">
                        <label for="lt_protection" style="color:black">Protection on Transformer LT</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->lt_protection) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->lt_protection) ? $reportdata->lt_protection : ""; ?>" id="lt_protection" name="lt_protection" placeholder="Protection on Transformer LT">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pit_earthing" style="color:black">Earthing Pit (Y/N)</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pit_earthing) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->pit_earthing) ? $reportdata->pit_earthing : ""; ?>" id="pit_earthing" name="pit_earthing" placeholder="Earthing Pit (Y/N)">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="lighting_conductor" style="color:black">Lightning Conductor</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->lighting_conductor) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->lighting_conductor) ? $reportdata->lighting_conductor : ""; ?>" id="lighting_conductor" name="lighting_conductor" placeholder="Lightning Conductor">
                    </div>
                </div>
                <!-- <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="electrical_isolator" style="color:black">Location of electrical isolator for the warehouse</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->electrical_isolator) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->electrical_isolator) ? $reportdata->electrical_isolator : ""; ?>" id="electrical_isolator" name="electrical_isolator" placeholder="Location of electrical isolator for the warehouse">
                    </div>
                </div> -->
                <div class="col-xl-12 col-md-12 "> 
                     <div class="table-responsive">
                            <table class="table table-bordered" id="transformer_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:20%">Transformer (Indoor / Outdoor)</th>
                                        <th  style="color:black;font-size:12px;width:10%">KVA</th>
                                        <th  style="color:black;font-size:12px;width:10%">Incoming</th>
                                        <th  style="color:black;font-size:12px;width:10%">Outgoing</th>
                                        <th  style="color:black;font-size:12px;width:15%">Make</th>
                                        <th  style="color:black;font-size:12px;width:10%">Year</th>
                                        <th  style="color:black;font-size:12px;width:10%">Oil Check</th>
                                        <th colspan="2"  style="color:black;font-size:12px;width:15%">Oil Capicity</th>
                                    </tr>
                                </thead>
                                 <tbody id="all_transformer">
                                    <tr class="transformer-entry edit-table">
                                        <td><input type="text" class="form-control case-field floor input-border" name="transformer[]" placeholder="Transformer (Indoor / Outdoor)"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="kva[]" placeholder="KVA"></td>
                                        <td><input type="text" class="form-control case-field occupancy input-border" name="incoming[]" placeholder="Incoming"></td>
                                        <td><input type="text" class="form-control case-field hazard input-border" name="outgoing[]" placeholder="Outgoing"></td>
                                        <td><input type="text" class="form-control case-field make input-border" name="make[]" placeholder="Make"></td>
                                        <td><input type="text" class="form-control case-field year input-border" name="year[]" placeholder="Year"></td>
                                        <td><input type="text" class="form-control case-field oil_chk input-border" name="oil_chk[]" placeholder="Oil Check"></td>
                                        <td><input type="text" class="form-control case-field oil_cpcty input-border" name="oil_cpcty[]" placeholder="Oil Capicity"></td>
                                        <td style="text-align: center;"><button type="button" class="btn btn-success addtransformer" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                  </div>
                   <div class="col-xl-12 col-md-12 "> 
                     <div class="table-responsive">
                            <table class="table table-bordered" id="dgset_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:20%">DG Set / Make </th>
                                        <th  style="color:black;font-size:12px;width:10%">KVA</th>
                                        <th  style="color:black;font-size:12px;width:10%">Year</th>
                                        <th  style="color:black;font-size:12px;width:10%">Condition</th>
                                        <th  style="color:black;font-size:12px;width:15%">DG Set / Make </th>
                                        <th  style="color:black;font-size:12px;width:10%">KVA</th>
                                        <th  style="color:black;font-size:12px;width:10%">Year</th>
                                        <th  colspan="2" style="color:black;font-size:12px;width:15%">Condition</th>
                                    </tr>
                                </thead>
                                 <tbody id="all_dgset">
                                  <tr class="dgset-entry edit-table">
                                        <td><input type="text" class="form-control case-field input-border" name="dg_make1[]" placeholder="DG Set / Make"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_kva1[]" placeholder="KVA"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_year1[]" placeholder="Year"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_condition1[]" placeholder="Condition"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_make2[]" placeholder="DG Set / Make"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_kva2[]" placeholder="KVA"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_year2[]" placeholder="Year"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="dg_condition2[]" placeholder="Condition"></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-success adddgset" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>

                                    
                                </tbody> 
                            </table>
                        </div>
                  </div>
              

               <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="electrical_isolator" style="color:black">Location of electrical isolator for the warehouse</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->electrical_isolator) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->electrical_isolator) ? $reportdata->electrical_isolator : ""; ?>" id="electrical_isolator" name="electrical_isolator" placeholder="Location of electrical isolator for the warehouse">
                    </div>
               </div>

               <div class="col-xl-12 col-md-12 ">
                    <label for="electrical_isolator" style="color:black">Loss Details ( Last Proceding 5 years from current year )</label>
                     <div class="table-responsive">
                            <table class="table table-bordered" id="lossdetail_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th  style="color:black;font-size:12px;width:25%">Year </th>
                                        <th  style="color:black;font-size:12px;width:25%">Insurer Name</th>
                                        <th  style="color:black;font-size:12px;width:25%">Premium Paid</th>
                                        <th colspan="2"  style="color:black;font-size:12px;width:25%">Claim Outstanding</th>
                                    </tr>
                                </thead>
                                 <tbody id="all_lossdetail">
                                  <tr class="lossdetail-entry edit-table">
                                        <td><input type="text" class="form-control case-field input-border" name="year[]" placeholder="Year"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="insurer[]" placeholder="Insurer Name"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="premium[]" placeholder="Premium Paid"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="claim[]" placeholder="Claim Outstanding"></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-success addlossdetail" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                  </div>
              

                <div class="col-xl-12 col-md-12 mt-2">
                    <label for="electrical_isolator" style="color:black">PML</label>
                       <div class="table-responsive">
                            <table class="table table-bordered" id="pml_table">
                                <thead>
                                    <tr class="edit-table">
                                        <th style="color:black;font-size:12px;width:20%">Risk Head</th>
                                        <th style="color:black;font-size:12px;width:20%">Approx. Sum Insured</th>
                                        <th style="color:black;font-size:12px;width:20%">Adequacy (Yes / No)</th>
                                        <th style="color:black;font-size:12px;width:10%">Loss Spread (%)</th>
                                        <th style="color:black;font-size:12px;width:10%">Loss Extent (%)</th>
                                        <th colspan="2" style="color:black;font-size:12px;width:20%">Loss Amount (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody id="all_pml">
                                    <tr class="pml-entry edit-table">
                                        <td><input type="text" class="form-control case-field input-border" name="risk_head[]" placeholder="Risk Head"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="sum_insured[]" placeholder="Approx. Sum Insured"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="adequacy[]" placeholder="Adequacy (Yes / No)"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="loss_spread[]" placeholder="Loss Spread (%)"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="loss_extent[]" placeholder="Loss Extent (%)"></td>
                                        <td><input type="text" class="form-control case-field input-border" name="loss_amount[]" placeholder="Loss Amount (Rs.)"></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-success addpml" style="margin-top:6px;"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
              


                <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="fire_extinguish" style="color:black">Fire Extinguishing Appliances</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->fire_extinguish) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->fire_extinguish) ? $reportdata->fire_extinguish : ""; ?>" id="fire_extinguish" name="fire_extinguish" placeholder="Fire Extinguishing Appliances">
                    </div>
               </div>

                <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="storage" style="color:black">Storage</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->storage) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->storage) ? $reportdata->storage : ""; ?>" id="storage" name="storage" placeholder="storage">
                    </div>
               </div>

                <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="housekeeping" style="color:black">Housekeeping</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->housekeeping) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->housekeeping) ? $reportdata->housekeeping : ""; ?>" id="housekeeping" name="housekeeping" placeholder="Housekeeping">
                    </div>
               </div>

                <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="electrical_installations" style="color:black">Electrical Installations</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->electrical_installations) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->electrical_installations) ? $reportdata->electrical_installations : ""; ?>" id="electrical_installations" name="electrical_installations" placeholder="Electrical Installations">
                    </div>
               </div>

                <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="records" style="color:black">Records / Accounts</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->records) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->records) ? $reportdata->records : ""; ?>" id="records" name="records" placeholder="Records / Accounts">
                    </div>
               </div>

                 <div class="col-xl-12 col-md-12 mt-2"> 
                    <div class="form-group">
                        <label for="remark" style="color:black">Remarks</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->remark) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->remark) ? $reportdata->remark : ""; ?>" id="remark" name="remark" placeholder="Remarks">
                    </div>
               </div>

            </div>
               
            <div class="button d-flex justify-content-end mt-4" style="padding-bottom:10px;">
                <input class="btn case_btn" value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button" id="risk_inspection_casesubmit">
            </div>
        </div>
    </form>
</div>
<script>
     /* ------------------------------------------------------------------------- *  
      *Add Water Underground (KAJAL)
      * ------------------------------------------------------------------------- */
       $(document).on("click", ".addfaes", function() {
            let newRow = `
                <tr class="feas-entry edit-table">
                    <td><input type="text" class="form-control case-field underground_fire_cylinders input-border" name="underground_fire_cylinders[]" placeholder="Fire Cylinders"></td>
                    <td><input type="text" class="form-control case-field type input-border" name="type[]" placeholder="Type"></td>
                    <td><input type="text" class="form-control case-field capicity input-border" name="capicity[]" placeholder="Capicity"></td>
                    <td><input type="text" class="form-control case-field no input-border" name="no[]" placeholder="No."></td>
                    <td style="text-align: center;"><button type="button" class="btn btn-danger removefeas" style="margin-top:6px;"><i class="fa fa-minus"></i></button></td>
               </tr>
            `;

            $("#all_feas").append(newRow);
        });

        $(document).on("click", ".removefeas", function() {
            $(this).closest("tr").remove();
        });


        var feas = <?php echo json_encode(isset($reportdata->feas) ? $reportdata->feas : 'NA'); ?>;
        console.log(feas);

        if (feas !== 'NA' && feas !== null) {
            disableFields = true;
            populatefeas(feas, disableFields);
        }

       function populatefeas(data, disableFields) {
            const feasList = $('#all_feas');
            feasList.empty();

            const feasArray = Array.isArray(data) ? data : [data];

            feasArray.forEach((item, index) => {
                let newfeas = `
                    <tr class="feas-entry edit-table">
                        <td><input type="text" class="form-control case-field underground_fire_cylinders input-border" name="underground_fire_cylinders[]" placeholder="Fire Cylinders"  value="${item.underground_fire_cylinders || ''}" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field type input-border" name="type[]" placeholder="Type" value="${item.type || ''}" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field capicity input-border" name="capicity[]" placeholder="Capicity" value="${item.capicity || ''}" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field no input-border" name="no[]" placeholder="No." value="${item.no || ''}" ${disableFields ? 'disabled' : ''}></td>
                        <td style="text-align: center;">
                            ${index === 0 ? `<button type="button" class="btn btn-success addfaes" style="margin-top:6px;"><i class="fa fa-plus"></i></button>` : ''}
                            ${index !== 0 ? `<button type="button" class="btn btn-danger removefeas" style="margin-top:6px;"><i class="fa fa-minus"></i></button>` : ''}
                        </td>               
                    </tr>
                `;
                feasList.append(newfeas);  // Correct here
            });
        }



     /* ------------------------------------------------------------------------- *  
      *Add Water Overhead (KAJAL)
      * ------------------------------------------------------------------------- */
      
    $(document).on("click", ".addoverhead", function () {
        let newRow = `
            <tr class="overhead-entry edit-table">
                <td><input type="text" class="form-control case-field fire_cylinders_overhead input-border" name="fire_cylinders_overhead[]" placeholder="Fire Cylinders"></td>
                <td><input type="text" class="form-control case-field type_overhead input-border" name="type_overhead[]" placeholder="Type"></td>
                <td><input type="text" class="form-control case-field capicity_overhead input-border" name="capicity_overhead[]" placeholder="Capicity"></td>
                <td><input type="text" class="form-control case-field no__overhead input-border" name="no__overhead[]" placeholder="No."></td>
                <td style="text-align: center;"><button type="button" class="btn btn-danger removeoverhead" style="margin-top:6px;"><i class="fa fa-minus"></i></button></td>
            </tr>
        `;
        $("#all_overhead").append(newRow);
    });

    // Remove Overhead Row
    $(document).on("click", ".removeoverhead", function () {
        $(this).closest("tr").remove();
    });

function populateoverhead(data, disableFields) {
    const overheadList = $('#all_overhead');
    overheadList.empty();

    const overheadArray = Array.isArray(data) ? data : [data];

    overheadArray.forEach((item, index) => {
        let newOverhead = `
            <tr class="overhead-entry edit-table">
                <td><input type="text" class="form-control case-field fire_cylinders_overhead input-border" name="fire_cylinders_overhead[]" placeholder="Fire Cylinders" value="${item.fire_cylinders_overhead || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field type_overhead input-border" name="type_overhead[]" placeholder="Type" value="${item.type_overhead || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field capicity_overhead input-border" name="capicity_overhead[]" placeholder="Capicity" value="${item.capicity_overhead || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field no__overhead input-border" name="no__overhead[]" placeholder="No." value="${item.no__overhead || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 ? `<button type="button" class="btn btn-success addoverhead"><i class="fa fa-plus"></i></button>` : `<button type="button" class="btn btn-warning removeoverhead" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                </td>
            </tr>
        `;
        overheadList.append(newOverhead);
    });
}
var overhead = <?php echo json_encode(isset($reportdata->overhead) ? $reportdata->overhead : 'NA'); ?>;
console.log(overhead);

if (overhead !== 'NA' && overhead !== null) {
    disableFields = true;
    populateoverhead(overhead, disableFields);
}


     /* ------------------------------------------------------------------------- *  
      *Add PWR (KAJAL)
      * ------------------------------------------------------------------------- */

// Add PWR Row
$(document).on("click", ".addpwr", function () {
    let newRow = `
        <tr class="pwr-entry edit-table">
            <td><input type="text" class="form-control case-field main_pump input-border" name="main_pump[]" ></td>
            <td><input type="text" class="form-control case-field pwr input-border" name="pwr[]" placeholder="PWR"></td>
            <td><input type="text" class="form-control case-field head input-border" name="head[]" placeholder="Head"></td>
            <td><input type="text" class="form-control case-field lps input-border" name="lps[]" placeholder="LPS"></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-danger removepwr" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;
    $("#all_pwr").append(newRow);
});

// Remove PWR Row
$(document).on("click", ".removepwr", function () {
    $(this).closest("tr").remove();
});

function populatepwr(data, disableFields) {
    const pwrList = $('#all_pwr');
    pwrList.empty();

    const pwrArray = Array.isArray(data) ? data : [data];

    pwrArray.forEach((item, index) => {
        let newPwr = `
            <tr class="pwr-entry edit-table">
                <td><input type="text" class="form-control case-field main_pump input-border" name="main_pump[]"  value="${item.main_pump || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field pwr input-border" name="pwr[]" placeholder="PWR" value="${item.pwr || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field head input-border" name="head[]" placeholder="Head" value="${item.head || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field lps input-border" name="lps[]" placeholder="LPS" value="${item.lps || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 ? `<button type="button" class="btn btn-success addpwr" style="margin-top:6px;"><i class="fa fa-plus"></i></button>` : `<button type="button" class="btn btn-warning removepwr" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                </td>
            </tr>
        `;
        pwrList.append(newPwr);
    });
}


var pwr = <?php echo json_encode(isset($reportdata->pwr) ? $reportdata->pwr : 'NA'); ?>;
console.log(pwr);

if (pwr !== 'NA' && pwr !== null) {
    disableFields = true;
    populatepwr(pwr, disableFields);
}




     /* ------------------------------------------------------------------------- *  
      *ADD STORAGE ROW (KAJAL)
      * ------------------------------------------------------------------------- */
// Add Storage Row
$(document).on("click", ".addstorage", function () {
    let newRow = `
        <tr class="storage-entry edit-table">
            <td><input type="text" class="form-control case-field descrption input-border" name="descrption[]" placeholder="Descrption"></td>
            <td><input type="text" class="form-control case-field input-border" name="raw[]" placeholder="Raw Materials"></td>
            <td><input type="text" class="form-control case-field capicity input-border" name="capicity[]" placeholder="Finished Goods"></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-danger removestorage" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;
    $("#all_storage").append(newRow);
});

// Remove Storage Row
$(document).on("click", ".removestorage", function () {
    $(this).closest("tr").remove();
});

function populatestorage(data, disableFields) {
    const storageList = $('#all_storage');
    storageList.empty();

    const storageArray = Array.isArray(data) ? data : [data];

    storageArray.forEach((item, index) => {
        let newStorage = `
            <tr class="storage-entry edit-table">
                <td><input type="text" class="form-control case-field descrption input-border" name="descrption[]" placeholder="Descrption" value="${item.descrption || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="raw[]" placeholder="Raw Materials" value="${item.raw || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field capicity input-border" name="capicity[]" placeholder="Finished Goods" value="${item.capicity || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 ? `<button type="button" class="btn btn-success addstorage" style="margin-top:6px;"><i class="fa fa-plus"></i></button>` : `<button type="button" class="btn btn-warning removestorage" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                </td>
            </tr>
        `;
        storageList.append(newStorage);
    });
}

var storage = <?php echo json_encode(isset($reportdata->storage) ? $reportdata->storage : 'NA'); ?>;
console.log(storage);

if (storage !== 'NA' && storage !== null) {
    disableFields = true;
    populatestorage(storage, disableFields);
}


      /* ------------------------------------------------------------------------- *  
      *ADD CONSTRUCTION ROW (KAJAL)
      * ------------------------------------------------------------------------- */
// Add new construction row
$(document).on("click", ".addconstruction", function () {
    let newRow = `
        <tr class="construction-entry edit-table">
            <td><input type="text" class="form-control case-field floor input-border" name="floor[]" placeholder="Floor"></td>
            <td><input type="text" class="form-control case-field input-border" name="construction[]" placeholder="Type of construction"></td>
            <td><input type="text" class="form-control case-field occupancy input-border" name="occupancy[]" placeholder="Occupancy"></td>
            <td><input type="text" class="form-control case-field hazard input-border" name="hazard[]" placeholder="Hazard (Light / High)"></td>
            <td><input type="text" class="form-control case-field remark input-border" name="remark[]" placeholder="Remark (if any)"></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-danger removeconstruction" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;
    $("#all_construction").append(newRow);
});

// Remove construction row
$(document).on("click", ".removeconstruction", function () {
    $(this).closest("tr").remove();
});


function populateconstruction(data, disableFields) {
    const constructionList = $('#all_construction');
    constructionList.empty();

    const constructionArray = Array.isArray(data) ? data : [data];

    constructionArray.forEach((item, index) => {
        let newRow = `
            <tr class="construction-entry edit-table">
                <td><input type="text" class="form-control case-field floor input-border" name="floor[]" placeholder="Floor" value="${item.floor || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="construction[]" placeholder="Type of construction" value="${item.construction || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field occupancy input-border" name="occupancy[]" placeholder="Occupancy" value="${item.occupancy || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field hazard input-border" name="hazard[]" placeholder="Hazard (Light / High)" value="${item.hazard || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field remark input-border" name="remark[]" placeholder="Remark (if any)" value="${item.remark || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 ? `<button type="button" class="btn btn-success addconstruction" style="margin-top:6px;"><i class="fa fa-plus"></i></button>` : `<button type="button" class="btn btn-warning removeconstruction" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                </td>
            </tr>
        `;
        constructionList.append(newRow);
    });
}

var construction = <?php echo json_encode(isset($reportdata->construction) ? $reportdata->construction : 'NA'); ?>;
console.log(construction);

if (construction !== 'NA' && construction !== null) {
    disableFields = true;
    populateconstruction(construction, disableFields);
}



    /* ------------------------------------------------------------------------- *  
      *ADD TRANSFORMER ROW (KAJAL)
      * ------------------------------------------------------------------------- */
// Add new transformer row
$(document).on("click", ".addtransformer", function () {
    let newRow = `
        <tr class="transformer-entry edit-table">
            <td><input type="text" class="form-control case-field floor input-border" name="transformer[]" placeholder="Transformer (Indoor / Outdoor)"></td>
            <td><input type="text" class="form-control case-field input-border" name="kva[]" placeholder="KVA"></td>
            <td><input type="text" class="form-control case-field occupancy input-border" name="incoming[]" placeholder="Incoming"></td>
            <td><input type="text" class="form-control case-field hazard input-border" name="outgoing[]" placeholder="Outgoing"></td>
            <td><input type="text" class="form-control case-field make input-border" name="make[]" placeholder="Make"></td>
            <td><input type="text" class="form-control case-field year input-border" name="year[]" placeholder="Year"></td>
            <td><input type="text" class="form-control case-field oil_chk input-border" name="oil_chk[]" placeholder="Oil Check"></td>
            <td><input type="text" class="form-control case-field oil_cpcty input-border" name="oil_cpcty[]" placeholder="Oil Capicity"></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-danger removetransformer" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;
    $("#all_transformer").append(newRow);
});

// Remove transformer row
$(document).on("click", ".removetransformer", function () {
    $(this).closest("tr").remove();
});

function populatetransformer(data, disableFields) {
    const transformerList = $('#all_transformer');
    transformerList.empty();

    const transformerArray = Array.isArray(data) ? data : [data];

    transformerArray.forEach((item, index) => {
        let newRow = `
            <tr class="transformer-entry edit-table">
                <td><input type="text" class="form-control case-field floor input-border" name="transformer[]" placeholder="Transformer (Indoor / Outdoor)" value="${item.transformer || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="kva[]" placeholder="KVA" value="${item.kva || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field occupancy input-border" name="incoming[]" placeholder="Incoming" value="${item.incoming || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field hazard input-border" name="outgoing[]" placeholder="Outgoing" value="${item.outgoing || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field make input-border" name="make[]" placeholder="Make" value="${item.make || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field year input-border" name="year[]" placeholder="Year" value="${item.year || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field oil_chk input-border" name="oil_chk[]" placeholder="Oil Check" value="${item.oil_chk || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field oil_cpcty input-border" name="oil_cpcty[]" placeholder="Oil Capicity" value="${item.oil_cpcty || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 
                        ? `<button type="button" class="btn btn-success addtransformer" style="margin-top:6px;"><i class="fa fa-plus"></i></button>`
                        : `<button type="button" class="btn btn-warning removetransformer" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                </td>
            </tr>
        `;
        transformerList.append(newRow);
    });
}

var transformer = <?php echo json_encode(isset($reportdata->transformer) ? $reportdata->transformer : 'NA'); ?>;
console.log(transformer);

if (transformer !== 'NA' && transformer !== null) {
    disableFields = true;
    populatetransformer(transformer, disableFields);
}


  /* ------------------------------------------------------------------------- *  
      *ADD DG SET ROW (KAJAL)
      * ------------------------------------------------------------------------- */
// Add new DG set row
$(document).on("click", ".adddgset", function () {
    let newRow = `
        <tr class="dgset-entry edit-table">
            <td><input type="text" class="form-control case-field input-border" name="dg_make1[]" placeholder="DG Set / Make"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_kva1[]" placeholder="KVA"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_year1[]" placeholder="Year"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_condition1[]" placeholder="Condition"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_make2[]" placeholder="DG Set / Make"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_kva2[]" placeholder="KVA"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_year2[]" placeholder="Year"></td>
            <td><input type="text" class="form-control case-field input-border" name="dg_condition2[]" placeholder="Condition"></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-danger removedgset" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;
    $("#all_dgset").append(newRow);
});

// Remove DG set row
$(document).on("click", ".removedgset", function () {
    $(this).closest("tr").remove();
});

function populatedgset(data, disableFields) {
    const dgsetList = $('#all_dgset');
    dgsetList.empty();

    const dgArray = Array.isArray(data) ? data : [data];

    dgArray.forEach((item, index) => {
        let newRow = `
            <tr class="dgset-entry edit-table">
                <td><input type="text" class="form-control case-field input-border" name="dg_make1[]" value="${item.dg_make1 || ''}" placeholder="DG Set / Make" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_kva1[]" value="${item.dg_kva1 || ''}" placeholder="KVA" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_year1[]" value="${item.dg_year1 || ''}" placeholder="Year" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_condition1[]" value="${item.dg_condition1 || ''}" placeholder="Condition" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_make2[]" value="${item.dg_make2 || ''}" placeholder="DG Set / Make" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_kva2[]" value="${item.dg_kva2 || ''}" placeholder="KVA" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_year2[]" value="${item.dg_year2 || ''}" placeholder="Year" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field input-border" name="dg_condition2[]" value="${item.dg_condition2 || ''}" placeholder="Condition" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 
                        ? `<button type="button" class="btn btn-success adddgset" style="margin-top:6px;"><i class="fa fa-plus"></i></button>`
                        : `<button type="button" class="btn btn-warning removedgset" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                </td>
            </tr>
        `;
        dgsetList.append(newRow);
    });
}

var dgset = <?php echo json_encode(isset($reportdata->dgset) ? $reportdata->dgset : 'NA'); ?>;
if (dgset !== 'NA' && dgset !== null) {
    disableFields = true;
    populatedgset(dgset, disableFields);
}



     /* ------------------------------------------------------------------------- *  
      *ADD LOSS DETAILS ROW (KAJAL)
      * ------------------------------------------------------------------------- */
    // Add new Loss Detail row
    $(document).on("click", ".addlossdetail", function () {
        let newRow = `
            <tr class="lossdetail-entry edit-table">
                <td><input type="text" class="form-control case-field input-border" name="year[]" placeholder="Year"></td>
                <td><input type="text" class="form-control case-field input-border" name="insurer[]" placeholder="Insurer Name"></td>
                <td><input type="text" class="form-control case-field input-border" name="premium[]" placeholder="Premium Paid"></td>
                <td><input type="text" class="form-control case-field input-border" name="claim[]" placeholder="Claim Outstanding"></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-danger removelossdetail" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
                </td>
            </tr>
        `;
        $("#all_lossdetail").append(newRow);
    });

    // Remove row
    $(document).on("click", ".removelossdetail", function () {
        $(this).closest("tr").remove();
    });

    function populatelossdetail(data, disableFields) {
        const lossList = $('#all_lossdetail');
        lossList.empty();

        const lossArray = Array.isArray(data) ? data : [data];

        lossArray.forEach((item, index) => {
            let newRow = `
                <tr class="lossdetail-entry edit-table">
                    <td><input type="text" class="form-control case-field input-border" name="year[]" value="${item.year || ''}" placeholder="Year" ${disableFields ? 'disabled' : ''}></td>
                    <td><input type="text" class="form-control case-field input-border" name="insurer[]" value="${item.insurer || ''}" placeholder="Insurer Name" ${disableFields ? 'disabled' : ''}></td>
                    <td><input type="text" class="form-control case-field input-border" name="premium[]" value="${item.premium || ''}" placeholder="Premium Paid" ${disableFields ? 'disabled' : ''}></td>
                    <td><input type="text" class="form-control case-field input-border" name="claim[]" value="${item.claim || ''}" placeholder="Claim Outstanding" ${disableFields ? 'disabled' : ''}></td>
                    <td style="text-align: center;">
                        ${index === 0
                            ? `<button type="button" class="btn btn-success addlossdetail" style="margin-top:6px;"><i class="fa fa-plus"></i></button>`
                            : `<button type="button" class="btn btn-warning removelossdetail" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                    </td>
                </tr>
            `;
            lossList.append(newRow);
        });
    }

    var lossdetail = <?php echo json_encode(isset($reportdata->lossdetail) ? $reportdata->lossdetail : 'NA'); ?>;
    if (lossdetail !== 'NA' && lossdetail !== null) {
        disableFields = true;
        populatelossdetail(lossdetail, disableFields);
    }


     /* ------------------------------------------------------------------------- *  
      *ADD PML DETAILS ROW (KAJAL)
      * ------------------------------------------------------------------------- */


        // Add new PML row
        $(document).on("click", ".addpml", function () {
            let newRow = `
                <tr class="pml-entry edit-table">
                    <td><input type="text" class="form-control case-field input-border" name="risk_head[]" placeholder="Risk Head"></td>
                    <td><input type="text" class="form-control case-field input-border" name="sum_insured[]" placeholder="Approx. Sum Insured"></td>
                    <td><input type="text" class="form-control case-field input-border" name="adequacy[]" placeholder="Adequacy (Yes / No)"></td>
                    <td><input type="text" class="form-control case-field input-border" name="loss_spread[]" placeholder="Loss Spread (%)"></td>
                    <td><input type="text" class="form-control case-field input-border" name="loss_extent[]" placeholder="Loss Extent (%)"></td>
                    <td><input type="text" class="form-control case-field input-border" name="loss_amount[]" placeholder="Loss Amount (Rs.)"></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-danger removepml" style="margin-top:6px;"><i class="fa fa-minus"></i></button>
                    </td>
                </tr>
            `;
            $("#all_pml").append(newRow);
        });

        // Remove PML row
        $(document).on("click", ".removepml", function () {
            $(this).closest("tr").remove();
        });

        function populatepml(data, disableFields) {
            const pmlList = $('#all_pml');
            pmlList.empty();

            const pmlArray = Array.isArray(data) ? data : [data];

            pmlArray.forEach((item, index) => {
                let newRow = `
                    <tr class="pml-entry edit-table">
                        <td><input type="text" class="form-control case-field input-border" name="risk_head[]" value="${item.risk_head || ''}" placeholder="Risk Head" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field input-border" name="sum_insured[]" value="${item.sum_insured || ''}" placeholder="Approx. Sum Insured" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field input-border" name="adequacy[]" value="${item.adequacy || ''}" placeholder="Adequacy (Yes / No)" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field input-border" name="loss_spread[]" value="${item.loss_spread || ''}" placeholder="Loss Spread (%)" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field input-border" name="loss_extent[]" value="${item.loss_extent || ''}" placeholder="Loss Extent (%)" ${disableFields ? 'disabled' : ''}></td>
                        <td><input type="text" class="form-control case-field input-border" name="loss_amount[]" value="${item.loss_amount || ''}" placeholder="Loss Amount (Rs.)" ${disableFields ? 'disabled' : ''}></td>
                        <td style="text-align: center;">
                            ${index === 0
                                ? `<button type="button" class="btn btn-success addpml" style="margin-top:6px;"><i class="fa fa-plus"></i></button>`
                                : `<button type="button" class="btn btn-danger removepml" style="margin-top:6px;"><i class="fa fa-minus"></i></button>`}
                        </td>
                    </tr>
                `;
                pmlList.append(newRow);
            });
        }

        var pml = <?php echo json_encode(isset($reportdata->pml) ? $reportdata->pml : 'NA'); ?>;
        if (pml !== 'NA' && pml !== null) {
            disableFields = true;
            populatepml(pml, disableFields);
        }


      /* ------------------------------------------------------------------------- *  
      *ADD PML DETAILS ROW (KAJAL)
      * ------------------------------------------------------------------------- */

    $(document).ready(function() {
       $("#risk_inspection_casesubmit").click(function() {
            var buttonText = $(this).val();
            if (buttonText === "Submit") {
                $('#risk_inspection_casedata').trigger('submit');
                $(".statementcard").css("background-color", "#e9ecef"); // Grey background
                $(".edit-statement, .delete-statement, .addstatement, .addAnnexure, .removeAnnexure, .addlrs,.removelrs").prop("disabled", true);
                // Disable Fancybox and reduce opacity
                $(".view-img").removeAttr("data-fancybox").addClass("disabled-img").css("opacity", "0.5");
            } else if (buttonText === "Edit") {
                $(".case-field").prop("disabled", false);
                $(".edit-statement").prop("disabled", false);
                $(".delete-statement").prop("disabled", false);
                $(".addstatement").prop("disabled", false);
                $(".addAnnexure").prop("disabled", false);
                $(".removeAnnexure").prop("disabled", false);
                $(this).val("Update");
                resetCardColors(); // Restore original colors
            }else if (buttonText === "Update") {
                $('#risk_inspection_casedata').trigger('submit');
                $(".statementcard").css("background-color", "#e9ecef"); // Grey background
                $(".edit-statement, .delete-statement, .addstatement, .addAnnexure, .removeAnnexure, .addlrs,.removelrs").prop("disabled", true);
                // Disable Fancybox and reduce opacity
                $(".view-img").removeAttr("data-fancybox").addClass("disabled-img").css("opacity", "0.5");
                $(this).val("Edit");
            }
        });


        $("#risk_inspection_casedata").validate({
            errorClass: 'error', // Define error class for styling
            errorElement: 'div', // Use 'div' to show error messages
            highlight: function(element) {
                $(element).addClass('is-invalid'); // Add invalid class for styling
                $(element).closest('.form-group').find('.error-message').show(); // Show error message
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid'); // Remove invalid class
                $(element).closest('.form-group').find('.error-message').hide(); // Hide error message
            },
            rules: {
                insured_address: {
                    required: true,
                },
                insured_accompanied: {
                    required: true,
                },
                general: {
                    required: true,
                },
                planet_name: {
                    required: true,
                },
                plant_contruction: {
                    required: true,
                },
                location: {
                    required: true
                }
              
            },

            messages: {
                policyNumber: "This field is required.",
                insured_accompanied: "This field is required.",
                general: "This field is required.",
                planet_name: "This field is required.",
                plant_contruction: "This field is required.",
                location: "This field is required."
               
            },

            submitHandler: function(form) {
                event.preventDefault(); // Prevent default button action

                // Create FormData object
                var formData = new FormData(form);

                // Append additional data
                var aid = "<?php echo $aid; ?>";
                formData.append('aid', aid);

                $("#all_feas .feas-entry").each(function(index, element) {
                    let cylinders = $(element).find(".underground_fire_cylinders").val();
                    let type = $(element).find(".type").val(); // removed extra space here
                    let capicity = $(element).find(".capicity").val();
                    let no = $(element).find(".no").val();

                    formData.append(`feas[${index}][cylinders]`, cylinders);
                    formData.append(`feas[${index}][type]`, type);
                    formData.append(`feas[${index}][capicity]`, capicity);
                    formData.append(`feas[${index}][no]`, no);
                });


                $("#all_overhead .overhead-entry").each(function(index, element) {
                    let cylinders = $(element).find(".fire_cylinders_overhead").val();
                    let type = $(element).find(".type_overhead").val();
                    let capicity = $(element).find(".capicity_overhead").val();
                    let no = $(element).find(".no__overhead").val();

                    formData.append(`overhead[${index}][cylinders]`, cylinders);
                    formData.append(`overhead[${index}][type]`, type);
                    formData.append(`overhead[${index}][capicity]`, capicity);
                    formData.append(`overhead[${index}][no]`, no);
                });

                $("#all_pwr .pwr-entry").each(function(index, element) {
                    let mainPump = $(element).find(".main_pump").val();
                    let pwr = $(element).find(".pwr").val();
                    let head = $(element).find(".head").val();
                    let lps = $(element).find(".lps").val();

                    formData.append(`pwr[${index}][main_pump]`, mainPump);
                    formData.append(`pwr[${index}][pwr]`, pwr);
                    formData.append(`pwr[${index}][head]`, head);
                    formData.append(`pwr[${index}][lps]`, lps);
                });

                $("#all_storage .storage-entry").each(function(index, element) {
                    let descrption = $(element).find(".descrption").val();
                    let raw = $(element).find("input[name='raw[]']").val();
                    let capicity = $(element).find("input[name='capicity[]']").val();

                    formData.append(`storage[${index}][descrption]`, descrption);
                    formData.append(`storage[${index}][raw]`, raw);
                    formData.append(`storage[${index}][capicity]`, capicity);
                });

               $("#all_construction .construction-entry").each(function(index, element) {
                    let floor = $(element).find(".floor").val();
                    let construction = $(element).find("input[name='construction[]']").val();
                    let occupancy = $(element).find(".occupancy").val();
                    let hazard = $(element).find(".hazard").val();
                    let remark = $(element).find(".remark").val();

                    formData.append(`construction[${index}][floor]`, floor);
                    formData.append(`construction[${index}][construction]`, construction);
                    formData.append(`construction[${index}][occupancy]`, occupancy);
                    formData.append(`construction[${index}][hazard]`, hazard);
                    formData.append(`construction[${index}][remark]`, remark);
                });

                $("#all_transformer .transformer-entry").each(function(index, element) {
                    let transformer = $(element).find("input[name='transformer[]']").val();
                    let kva = $(element).find("input[name='kva[]']").val();
                    let incoming = $(element).find("input[name='incoming[]']").val();
                    let outgoing = $(element).find("input[name='outgoing[]']").val();
                    let make = $(element).find(".make").val();
                    let year = $(element).find(".year").val();
                    let oil_chk = $(element).find(".oil_chk").val();
                    let oil_cpcty = $(element).find(".oil_cpcty").val();

                    formData.append(`transformer[${index}][transformer]`, transformer);
                    formData.append(`transformer[${index}][kva]`, kva);
                    formData.append(`transformer[${index}][incoming]`, incoming);
                    formData.append(`transformer[${index}][outgoing]`, outgoing);
                    formData.append(`transformer[${index}][make]`, make);
                    formData.append(`transformer[${index}][year]`, year);
                    formData.append(`transformer[${index}][oil_chk]`, oil_chk);
                    formData.append(`transformer[${index}][oil_cpcty]`, oil_cpcty);
                });

                $("#all_dgset .dgset-entry").each(function(index, element) {
                    let dg_make1 = $(element).find("input[name='dg_make1[]']").val();
                    let dg_kva1 = $(element).find("input[name='dg_kva1[]']").val();
                    let dg_year1 = $(element).find("input[name='dg_year1[]']").val();
                    let dg_condition1 = $(element).find("input[name='dg_condition1[]']").val();
                    let dg_make2 = $(element).find("input[name='dg_make2[]']").val();
                    let dg_kva2 = $(element).find("input[name='dg_kva2[]']").val();
                    let dg_year2 = $(element).find("input[name='dg_year2[]']").val();
                    let dg_condition2 = $(element).find("input[name='dg_condition2[]']").val();

                    formData.append(`dgset[${index}][dg_make1]`, dg_make1);
                    formData.append(`dgset[${index}][dg_kva1]`, dg_kva1);
                    formData.append(`dgset[${index}][dg_year1]`, dg_year1);
                    formData.append(`dgset[${index}][dg_condition1]`, dg_condition1);
                    formData.append(`dgset[${index}][dg_make2]`, dg_make2);
                    formData.append(`dgset[${index}][dg_kva2]`, dg_kva2);
                    formData.append(`dgset[${index}][dg_year2]`, dg_year2);
                    formData.append(`dgset[${index}][dg_condition2]`, dg_condition2);
                });
                
                $("#all_lossdetail .lossdetail-entry").each(function(index, element) {
                    let year = $(element).find("input[name='year[]']").val();
                    let insurer = $(element).find("input[name='insurer[]']").val();
                    let premium = $(element).find("input[name='premium[]']").val();
                    let claim = $(element).find("input[name='claim[]']").val();

                    formData.append(`lossdetail[${index}][year]`, year);
                    formData.append(`lossdetail[${index}][insurer]`, insurer);
                    formData.append(`lossdetail[${index}][premium]`, premium);
                    formData.append(`lossdetail[${index}][claim]`, claim);
                });

               $("#all_pml .pml-entry").each(function(index, element) {
                    let risk_head = $(element).find("input[name='risk_head[]']").val();
                    let sum_insured = $(element).find("input[name='sum_insured[]']").val();
                    let adequacy = $(element).find("input[name='adequacy[]']").val();
                    let loss_spread = $(element).find("input[name='loss_spread[]']").val();
                    let loss_extent = $(element).find("input[name='loss_extent[]']").val();
                    let loss_amount = $(element).find("input[name='loss_amount[]']").val();

                    formData.append(`pml[${index}][risk_head]`, risk_head);
                    formData.append(`pml[${index}][sum_insured]`, sum_insured);
                    formData.append(`pml[${index}][adequacy]`, adequacy);
                    formData.append(`pml[${index}][loss_spread]`, loss_spread);
                    formData.append(`pml[${index}][loss_extent]`, loss_extent);
                    formData.append(`pml[${index}][loss_amount]`, loss_amount);
                });

               
                // AJAX request to updatecasedata endpoint
                $.ajax({
                    url: "<?php echo base_url('riskinspection') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false, // Important: Prevent jQuery from converting FormData into a string
                    contentType: false, // Important: Prevent jQuery from setting content-type header
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            $('#risk_inspection_casesubmit').val("Edit");
                            $(".case-field").prop("disabled", true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error as needed
                    }
                });
            }

        });
    });


</script>


