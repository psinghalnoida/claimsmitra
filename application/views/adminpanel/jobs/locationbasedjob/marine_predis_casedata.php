<div class="panel mt-4" id="caseForm">
    <form id="marine_predispatch_casedata" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">CASE DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?> 
                    <a href="<?php echo base_url('generatepdf/' . $aid . '/' . $companyid); ?>" target="_blank" class="btn case_btn">Generate Report</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Report" data-toggle="modal" href="javascript:void(0)" id="report_images" style="padding-right: 5px; margin-right:8px;">Report Images <i class="fa-solid fa-upload"></i></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;"> 
          <div class="row">
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="bol_no" style="color:black">B/L NO.  &nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->bol_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->bol_no) && !empty($reportdata->bol_no) ? $reportdata->bol_no : (isset($reportdata->entry_number) ? $reportdata->entry_number : ""); ?>"  name="bol_no" placeholder="B/L NO">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group">
                    <label for="bol_date" style="color:black">
                        B/L Date &nbsp;<span style="color:red">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control case-field  bol_date" <?php echo isset($reportdata->bol_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->bol_date) ? $reportdata->bol_date : ""; ?>" id="bol_date" name="bol_date" placeholder="B/L Date">
                        <div class="input-group-append case-field disabledbtn ">
                            <span class="input-group-text bol_date_btn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
             </div>
         </div>
          <div class="row">
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="be_no" style="color:black">BE NO.  &nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->be_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->be_no) ? $reportdata->be_no : ""; ?>"  name="be_no" placeholder="BE NO.">
                </div>
              </div>

              <div class="col-xl-4 col-md-4">
                <div class="form-group">
                    <label for="bol_date" style="color:black">
                       BE Date &nbsp;<span style="color:red">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control case-field be_date" <?php echo isset($reportdata->be_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->be_date) ? $reportdata->be_date : ""; ?>" id="be_date" name="be_date" placeholder="BE Date">
                        <div class="input-group-append case-field disabledbtn ">
                            <span class="input-group-text be_date_btn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
           </div>

          <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Details of Consignment</h4>
          <div class="row">
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="gross_weight" style="color:black">Gross Weight  / No of Package &nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->gross_weight) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->gross_weight) ? $reportdata->gross_weight : ""; ?>"  name="gross_weight" placeholder="Gross Weight  / No of Package">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="marks_number" style="color:black">Marks and Number &nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->marks_number) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->marks_number) ? $reportdata->marks_number : ""; ?>"  name="marks_number" placeholder="Marks and Number">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="packing" style="color:black">Packing </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->packing) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->packing) ? $reportdata->packing : ""; ?>"  name="packing" placeholder="Packing">
                </div>
              </div>
          </div>
          <div class="d-flex align-items-center justify-content-between p-2" style="background-color:#f3f3f3; color:black; font-size:12px;">
                <h4 class="mb-0" style="font-size:14px;">Details of Oversees Transit</h4>

              <div class="d-flex align-items-center" style="gap:10px;">
                <div class="d-flex align-items-center me-3" style="gap:2px;">
                    <input type="radio" id="import" name="cargo_type" value="1" class="me-1 case-field" style="width: 16px; height: 16px;"
                        <?php echo isset($reportdata->cargo_type) && $reportdata->cargo_type == 1 ? 'checked' : ''; ?>
                        <?php echo isset($reportdata->cargo_type) ? 'disabled' : ''; ?>>
                    <label for="import" class="mb-0">Import Cargo</label>
                </div>

                <div class="d-flex align-items-center me-3" style="gap:2px;">
                    <input type="radio" id="export" name="cargo_type" value="2" class="me-1 case-field" style="width: 16px; height: 16px;"
                        <?php echo isset($reportdata->cargo_type) && $reportdata->cargo_type == 2 ? 'checked' : ''; ?>
                        <?php echo isset($reportdata->cargo_type) ? 'disabled' : ''; ?>>
                    <label for="export" class="mb-0">Export Cargo</label>
                </div>
            </div>
          </div>
          <div class="row">
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="oversees_ex_to" style="color:black">Ex To </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->oversees_ex_to) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->oversees_ex_to) ? $reportdata->oversees_ex_to : ""; ?>"  name="oversees_ex_to" placeholder="Ex To">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="consignor" style="color:black">Consignor/Supplier</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->consignor) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->consignor) ? $reportdata->consignor : ""; ?>"  name="consignor" placeholder="Consignor">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="reciever" style="color:black">
                        Reciever</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->reciever) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->reciever) ? $reportdata->reciever : ""; ?>"  name="reciever" placeholder="Reciever">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="supplier_inv_no" style="color:black">
                        Supplier's Invoice Number</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->supplier_inv_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->supplier_inv_no) ? $reportdata->supplier_inv_no : ""; ?>"  name="supplier_inv_no" placeholder="Supplier's Invoice Number">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="assessable_value" style="color:black">
                        Sound Assessable Value</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->assessable_value) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->assessable_value) ? $reportdata->assessable_value : ""; ?>"  name="assessable_value" placeholder=" Sound Assessable Value">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="assessable_value" style="color:black">
                        Sound duty value</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->soundduty_value) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->soundduty_value) ? $reportdata->soundduty_value : ""; ?>"  name="soundduty_value" placeholder="Sound duty value">
                </div>
              </div>
                <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="country_origin" style="color:black">
                        Country of origin</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->country_origin) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->country_origin) ? $reportdata->country_origin : ""; ?>"  name="country_origin" placeholder="Country of origin">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="hawb_no" style="color:black">
                       HAWB Number</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->hawb_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->hawb_no) ? $reportdata->hawb_no : ""; ?>"  name="hawb_no" placeholder="HAWB Number">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="mawb_no" style="color:black">
                       MAWB Number</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->mawb_no) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->mawb_no) ? $reportdata->mawb_no : ""; ?>"  name="mawb_no" placeholder="MAWB Number">
                </div>
              </div>
              
              <div class="col-xl-4 col-md-4">
                <div class="form-group">
                    <label for="bol_date" style="color:black">
                       Date of dispatch &nbsp;<span style="color:red">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control case-field dispatch_date" <?php echo isset($reportdata->dispatch_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dispatch_date) ? $reportdata->dispatch_date : ""; ?>" id="dispatch_date" name="dispatch_date" placeholder="Date of dispatch">
                        <div class="input-group-append case-field disabledbtn ">
                            <span class="input-group-text dispatch_date_btn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
             

              <div class="col-xl-4 col-md-4">
                <div class="form-group">
                    <label for="bol_date" style="color:black">
                        Date of reciept from customs &nbsp;<span style="color:red">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control case-field reciept_date" <?php echo isset($reportdata->reciept_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->reciept_date) ? $reportdata->reciept_date : ""; ?>" id="reciept_date" name="reciept_date" placeholder="Date of reciept from customs">
                        <div class="input-group-append case-field disabledbtn ">
                            <span class="input-group-text reciept_date_btn" style="cursor: pointer;">
                                <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>

               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="entry_number" style="color:black">
                       Bill of entry number</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->entry_number) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->bol_no) && !empty($reportdata->bol_no) ? $reportdata->bol_no : (isset($reportdata->entry_number) ? $reportdata->entry_number : ""); ?>"  name="entry_number" placeholder="Bill of entry number">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="cha" style="color:black">
                       CHA</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->cha) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->cha) ? $reportdata->cha : ""; ?>"  name="cha" placeholder="CHA">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="container" style="color:black">
                       Container </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->container) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->container) ? $reportdata->container : ""; ?>"  name="container" placeholder="Container">
                </div>
              </div>
               
          </div>
          <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Details of Inland Transit</h4>
          <div class="row">
           
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="inland_ex_to" style="color:black">
                     Consignor </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->consignor) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->consignor) ? $reportdata->consignor : ""; ?>"  name="inland_ex_to" placeholder="Consignor">
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="consignee" style="color:black">
                     Consignee  </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->consignee) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->consignee) ? $reportdata->consignee : ""; ?>"  name="consignee" placeholder="Consignee">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="carrier" style="color:black">
                     Carrier  </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->carrier) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->carrier) ? $reportdata->carrier : ""; ?>"  name="carrier" placeholder="carrier">
                </div>
              </div>
               <div class="col-xl-4 col-md-4">
                <div class="form-group ">
                    <label for="dispatch_mode" style="color:black">
                     Mode of dispatch / Truck Number  </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->dispatch_mode) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dispatch_mode) ? $reportdata->dispatch_mode : ""; ?>"  name="dispatch_mode" placeholder="Mode of dispatch / Truck Number">
                </div>
              </div>
          </div>
          <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Survey / Observation</h4>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="consignment_condition" style="color:black">Condition of Consignment at the time of dispatch</label>
                        <textarea class="form-control case-field" 
                          id="consignment_condition" name="consignment_condition" rows="5" 
                          <?php echo isset($reportdata->consignment_condition) ? "disabled" : ""; ?>><?php echo isset($reportdata->consignment_condition) ? htmlspecialchars($reportdata->consignment_condition) : ""; ?></textarea>
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="bol_date" style="color:black">
                            Date of expected dispatch &nbsp;<span style="color:red">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control case-field expected_dispatch" <?php echo isset($reportdata->expected_dispatch) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->expected_dispatch) ? $reportdata->reciept_date : ""; ?>" id="expected_dispatch" name="expected_dispatch" placeholder="Date of expected dispatch">
                            <div class="input-group-append case-field disabledbtn ">
                                <span class="input-group-text expected_dispatch_btn" style="cursor: pointer;">
                                    <i class="fa fa-calendar" style="font-size: 15px; color:#fff;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-xl-4 col-md-4">
                 <div class="form-group ">
                    <label for="rectification" style="color:black">
                    Whether rectification required </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->rectification) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->rectification) ? $reportdata->rectification : ""; ?>"  name="rectification" placeholder="Whether rectification required">
                </div>
               </div>
                <div class="col-xl-4 col-md-4">
                 <div class="form-group ">
                    <label for="refrigerated" style="color:black">
                   Is Special Condition required for dispatch like use of refrigerated van etc. </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->refrigerated) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->refrigerated) ? $reportdata->refrigerated : ""; ?>"  name="refrigerated" placeholder="Is Special Condition required for dispatch like use of refrigerated van etc.">
                </div>
               </div>
                <div class="col-xl-4 col-md-4">
                 <div class="form-group ">
                    <label for="examined_packets" style="color:black">
                   Custom Examined Packets </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->examined_packets) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->examined_packets) ? $reportdata->examined_packets : ""; ?>"  name="examined_packets" placeholder="Custom Examined Packets">
                </div>
               </div>
                <div class="col-xl-4 col-md-4">
                 <div class="form-group ">
                    <label for="photo_arranged" style="color:black">
                   Photo arranged / Number </label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->photo_arranged) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->photo_arranged) ? $reportdata->photo_arranged : ""; ?>"  name="photo_arranged" placeholder="Photo arranged / Number">
                </div>
               </div>
               <div class="col-xl-4 col-md-4">
                 <div class="form-group ">
                    <label for="available_docs" style="color:black">
                   Documents available</label>
                    <input type="text" class="form-control case-field " <?php echo isset($reportdata->available_docs) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->available_docs) ? $reportdata->available_docs : ""; ?>"  name="available_docs" placeholder="Documents available">
                </div>
               </div>
            </div>
                 
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remarks" style="color:black">Special Remark (if any)</label>
                        <textarea class="form-control case-field" 
                          id="remarks" name="remarks" rows="5" 
                          <?php echo isset($reportdata->remarks) ? "disabled" : ""; ?>><?php echo isset($reportdata->remarks) ? htmlspecialchars_decode($reportdata->remarks) : ""; ?></textarea>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="remarks" style="color:black">Disclaimer</label>
                        <textarea class="form-control case-field" 
                          id="disclaimer" name="disclaimer" rows="5" 
                          <?php echo isset($reportdata->disclaimer) ? "disabled" : ""; ?>><?php echo isset($reportdata->disclaimer) ? htmlspecialchars_decode($reportdata->disclaimer) : "We have hence carried out above supervisory discharge / pre-dispatch survey for consideration of all concerned. This certificate does not imply that goods have been checked for their fitness and have been tried and tested, but this is a physical inspection report only highlighting the condition of 'said to contain' goods at the time of further dispatch. Similarly we have not valued these goods. The new item to be valued & insured for invoice amount. Second-hand items (if any) to be valued as per suggestion of insured. Please use own discretion in this regard."; ?>
                              
                          </textarea>
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end mt-4" style="padding-bottom:10px;">
                <input class="btn case_btn" value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button" id="marine_predispatch_casedata_submit">
            </div>
        </div>
    </form>
</div>






