<div class="form-group row" style="padding: 0px 31px;">
    <div class="col-md-12 form-inline" id="radio_profession">
        
    </div>
</div>
<br>
<form action="#" id="surveyor_form" style="display: none;padding: 0px 31px;" method="post" enctype="multipart/form-data" >

    <div class="form-group row">
        <div class="col-lg-12">
            <input type="text" name="Search" id="search_text" placeholder="Search SLA" class="form-control">
        </div>
    </div>
    <div id="surveyor_detail">
        
    </div>

    <div class="modal-footer" style="border-top:none">
        <button type="button" class="btn btn-sm btn-rounded btn-success" id="btn_save_sla">Save</button>
    </div>
</form>
<form id="agent_form" style="display: none;padding: 0px 31px;" method="post" enctype="multipart/form-data">
    <?php $this->load->view('adminpanel/setting/modal/select_insurance'); ?>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Licence Number <span style="color:red">*</span></span>
        <div class="col-lg-9">
            <input type="text" name="licence_number" id="licence_number" class="form-control" placeholder="Licence number" required>
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label" for="date_picker">Licence Validity <span style="color:red">*</span></span>
        <div class="col-lg-9">
            <input type="date" name="licence_validity" id="date_picker" class="form-control" required>
        </div>
    </div>

    <div class="modal-footer" style="border-top:none">
        <button type="submit" class="btn btn-sm btn-rounded btn-success" id="btn_save_agent">Save</button>
    </div>
</form>
<form id="investigator_form" style="display: none;padding: 0px 31px;" method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <span class="label-text col-lg-2 col-form-label">Investigator <span style="color:red">*</span></span>
        <div class="col-lg-12" id="investigator_list" style="display:grid; grid-template-columns: 1fr 1fr 1fr;">
            
        </div>
    </div>
    <div id="language" style="display:none">
        <div class="form-group row">
            <span class="label-text col-lg-2 col-form-label">Language <span style="color:red">*</span></span>
            <div class="col-lg-12" id="language_list" style="display:grid; grid-template-columns: 1fr 1fr 1fr;">
                <label class="form-check">
                    <input type="checkbox" name="hindi" id="hindi" value="Hindi" class="form-check-input" >
                    <span class="form-check-label">Hindi</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="assamese" id="assamese" value="Assamese" class="form-check-input">
                    <span class="form-check-label">Assamese</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="bengali" id="bengali" value="Bengali" class="form-check-input" >
                    <span class="form-check-label">Bengali</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="gujarati" id="gujarati" value="Gujarati" class="form-check-input">
                    <span class="form-check-label">Gujarati</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="kannada" id="kannada" value="Kannada" class="form-check-input" >
                    <span class="form-check-label">Kannada</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="urdu" id="urdu" value="Urdu" class="form-check-input">
                    <span class="form-check-label">Urdu</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="malayalam" id="malayalam" value="Malayalam" class="form-check-input" >
                    <span class="form-check-label">Malayalam</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="marathi" id="marathi" value="Marathi" class="form-check-input">
                    <span class="form-check-label">Marathi</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="punjabi" id="punjabi" value="Punjabi / Guru mukhi" class="form-check-input" >
                    <span class="form-check-label">Punjabi / Guru mukhi</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="tamil" id="tamil" value="Tamil" class="form-check-input">
                    <span class="form-check-label">Tamil</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="telugu" id="telugu" value="Telugu" class="form-check-input" >
                    <span class="form-check-label">Telugu</span>
                </label>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="border-top:none">
        <button type="submit" class="btn btn-sm btn-rounded btn-success" id="btn_save_investigator">Save</button>
    </div>
</form>

<form id="surveyor_buyer_form" style="display: none;padding: 0px 31px;" method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Select Category</span>
        <div class="col-lg-9">
            <script type="text/javascript">
                $(document).ready(function() {       
                    $('#salvage_buyer_category_list').multiselect({       
                        nonSelectedText: 'Select Category',
                        buttonWidth: '100%',
                        enableFiltering: true,
                        includeSelectAllOption: true,
                        maxHeight: 200, 
                        buttonTextAlignment: 'left',
                        enableCaseInsensitiveFiltering: true,           
                    });
                });
            </script>
            <select type="select" name="category" id="salvage_buyer_category_list" class="form-control" required>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Select Sub Category</span>
        <div class="col-lg-9">
            <script type="text/javascript">
                $(document).ready(function() {       
                    $('#salvage_buyer_subcategory_list').multiselect({       
                        nonSelectedText: 'Select Sub Category',
                        buttonWidth: '100%',
                        enableFiltering: true,
                        includeSelectAllOption: true,
                        maxHeight: 200, 
                        buttonTextAlignment: 'left',
                        enableCaseInsensitiveFiltering: true,           
                    });
                });
            </script>
            <select name="sub_category" multiple="multiple" id="salvage_buyer_subcategory_list" class="form-control" required>
                
            </select>
        </div>
    </div>
    
   <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Buy Range</span>
        <div class="col-lg-9">
            <script type="text/javascript">
                $(document).ready(function() {       
                    $('#range_list').multiselect({       
                        nonSelectedText: 'Select Buy Range',
                        buttonWidth: '100%',
                        enableFiltering: true,
                        includeSelectAllOption: true,
                        maxHeight: 200,
                        buttonTextAlignment: 'left',
                        enableCaseInsensitiveFiltering: true,               
                    });
                });
            </script>
            <select name="buyer_range" id="range_list" class="form-control" required>
                <option value="1 lakh">Upto Rs. 1 Lakh</option>
                <option value="5 lakh">Upto Rs. 5 Lakh</option>
                <option value="50 lakh">Upto Rs. 50 Lakh</option>
                <option value="unlimited">Unlimited</option>
                <option value="unlimited_above_1lakh">Unlimited above Rs. 1 Lakh</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Select Region</span>
        <div class="col-lg-9">
            <script type="text/javascript">
                $(document).ready(function(){       
                    $('#state_list').multiselect({       
                        nonSelectedText: 'Select State',
                        buttonWidth: '100%',
                        enableFiltering: true,
                        includeSelectAllOption: true,
                        maxHeight: 200, 
                        buttonTextAlignment: 'left',
                        enableCaseInsensitiveFiltering: true,           
                    });
                });
            </script>
            <select name="region" multiple="multiple" id="state_list" class="form-control" required>
                
            </select>
        </div>
    </div>

    <div id='other_licence'>
        <div class="form-group row">
            <span class="label-text col-lg-3 col-form-label">Others</span>
            <div class="col-lg-9">
                <input type="text" name="other_salvage" id="other_salvage" class="form-control" placeholder="Others">
            </div>
        </div>
    </div>
    <div class="modal-footer" style="border-top:none">
        <button type="submit" class="btn btn-sm btn-rounded btn-success" id="btn_save_investigator">Save</button>
    </div>
</form>
        