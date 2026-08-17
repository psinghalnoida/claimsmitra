<div id="alert_message">
</div>
<form id="company_form" method="post" enctype="multipart/form-data"   style="padding: 0px 31px;">
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Profession</span>
        <div class="col-lg-9">
            <select name="choose_profession" id="choose_profession" class="form-control">
                <option value="">Nothing Selected</option>    
                <?php foreach ($profession as $value) { ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['profession']; ?></option>
                <?php } ?>                                  
            </select>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Company Name</span>
        <div class="col-lg-9">
            <select name="choose_company" id="choose_company" class="form-control">
                <option value="">Nothing Selected</option>
                
            </select>
        </div>
    </div>
    <div id="parent_company">

    </div>
    <div id="datatableContainer" style="display:none">
        <table id="branchdata" class="table table-bordered table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>BID</th>
                    <th>GST</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>      
    </div>  
</form>   
