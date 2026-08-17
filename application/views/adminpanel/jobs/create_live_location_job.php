<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Live Location Based  Job</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
           
                <div class="form-group row">
                    <span class="label-text col-lg-3 col-form-label">Nature of Job</span>
                        <div class="col-lg-9">
                            <select   onchange="subformopen(this.value)"  name="nature_of_job" id="nature_of_job"  class="form-control">
                                <option>------Live Location-------</option>
                                <option value="26">Motor Pre Insurance Inspection</option>
                                 <option value="27">Motor Spot Inspection</option>
                                  <option value="28">Motor Final Survey</option>
                                        <option value="29">Motor Theft Case</option>



                                         <option value="30">Marine Spot Inspection</option>
                                <option value="31">Marine Pre Dispatch Inspection</option>
                                 <option value="32">Marine Final Survey</option>
                               <!--  <option value="33">Marine Pre Dispatch Inspection</option> -->

                                <option value="34">Cattle Pre Insurance Inspection</option>
                                <option value="35">Cattle Spot Inspection</option>


                                <option value="36">Death Case Investigation</option>
                                <option value="37"> Death EB Case Investigation</option>
                               
                                    
                            </select>
                        </div>
                </div> 

  <div class="form-group row"   id="first" style=" padding: 5px;
    border: 1px solid;
    border-radius: 10px; display: none;">
     <form id="createtranslationjob_1" class="row" method="post" enctype="multipart/form-data">
  
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Contact Person</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="motor_name_contact_person" required></div>
       
<div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Mobile of Contact Person</label> <span style="color:red">*</span>
        <input type="tel" minlength="10" pattern="[789][0-9]{9}" class="form-control" name="motor_mobile_contact_person"  required ></div>

  <div class="col-md-6" style="padding-bottom:5px;" id="prevehicle_type"> <label class="label-text">Type of Vehicle</label> <span style="color:red">*</span> 

         <select   name="Vehicle_type" id="Vehicle_type"  class="form-control">
                                <option value="">------Select-------</option>
                                 <option value="Two_wheeler">Two wheeler</option>
                                  <option value="Four_wheeler">Four wheeler</option>
                                  <option value="commercial">Commercial</option>
                                    <option value="Excavator">Excavator</option>

                               
                                    
                            </select>
                        </div>
        
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Vehicle Owner</label> 
        <input type="text" class="form-control" name="motor_name_vehicle_owner"></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Vehicle Number</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="motor_vehicle_number" pattern="[A-Z0-9]{2,}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter without Space" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Policy Number</label>
        <input type="text" class="form-control" name="motor_policy_number"></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Location of survey to be done</label>
        <input type="text" class="form-control" name="motor_location"></div>

              <div class="col-md-6" style="padding-bottom:5px;" id="pre_case_of_locess"> <label class="label-text">Cause of Loss</label>
        <input type="text" class="form-control" name="motor_cause_of_Loss"></div>



        <div class="col-md-6" style="padding-bottom:5px;" id="motor_workshop"> <label class="label-text">Name of Workshop</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="motor_name_of_work_shop"></div>
        <div class="col-md-6" style="padding-bottom:5px;" id="motor_workshop_advisor"> <label class="label-text">Name of Workshop Advisor</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="motor_name_workshop_advisor"></div>



        <div class="col-md-12" style="padding-bottom:5px;"> <label class="label-text">Instructions </label>
        <input type="text" class="form-control" name="motor_instruction"></div>

<!-- <div class="container" style="width:100%">
    <div class="col">
         <div class="form-group row">
                    <span class="label-text col-lg-3 col-form-label">Upload File</span>
                        <div class="col-md-3">
                            <label class="filelabel">
                                <i class="fa fa-paperclip">
                                </i>
                                <span class="title">
                                    Add File
                                </span>
                                <input  id="uploadpdfadad" name="uploadpdfadad" type="file"/>
                            </label>
                         </div>               
                        <div id="pdf-loader" style="display:none">Loading Preview ..</div>
                        <div class="col-md-3" id="pdf_listing" style="display:none">
                            <div class="panel" style="box-shadow:0 1px 5px rgb(0 0 0 / 34%)">
                                <div class="miniStats--panel">
                                    <div class="miniStats--body" style="padding:0">
                                        <button type="submit" style="position:absolute" class="close AClass">
                                            <div style="text-align:center; background-color:#7c6e6e; width:26px;height:26px;border-radius:30px; ">
                                                <span>&times;</span>
                                            </div>
                                        </button>
                                        <canvas id="pdf-preview" style="width:160px; height:43px;"></canvas>
                                        <div class="text-white bg-green" style="padding-left:5px; font-size:11px; border-radius:0 0 4px 4px" id="total-page">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>  

            </div> -->
        <div class="col" style="text-align: right;">
  <div class="modal-footer" >
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-success">Save</button>
                </div>
            </div>
            </form>
      
  </div>



    <div class="form-group row"   id="second" style=" padding: 5px;
    border: 1px solid;
    border-radius: 10px; display: none;">
   <form id="createtranslationjob2" class="row" method="post" enctype="multipart/form-data">
  
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Contact Person</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="marine_name_contact_person" required></div>
       
<div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Mobile of Contact Person</label> <span style="color:red">*</span>
        <input type="tel" minlength="10" pattern="[789][0-9]{9}" class="form-control" name="marine_mobile_contact_person" required></div>

        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Owner of Goods</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="marine_name_owner_goods" required></div>


        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Commodity</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="marine_commodity" required></div>
      
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Policy Number</label>
        <input type="text" class="form-control" name="marine_policy_number"></div>

          <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Conveyance</label> <span style="color:red">*</span>

 <select   name="marine_conveyance" id="marine_conveyance"  class="form-control" required>
                                <option value="">------Conveyance-------</option>
                         
                                <option value="Road">Road</option>
                                  <option value="Sea"> Sea</option>
                                    <option value="Rail">Rail</option>
                                  <option value="Air"> Air</option>
                                    <option value="Multimode"> Multimode</option>

                               
                                    
                            </select>

      </div>

          <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Invoice Number</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="marine_invoice_number" required></div>

          <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">GR/BL/AWB/RR Number</label> <span style="color:red">*  (Atleast one)</span>
        <input type="text" class="form-control" name="marine_gr_bl_awb_rr_number" placeholder="GR/BL/AWB/RR Number" required></div>


        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Location of survey to be done</label>
        <input type="text" class="form-control" name="marine_location"></div>

        <div class="col-md-6" style="padding-bottom:5px;" id="marrcase"> <label class="label-text">Cause of Loss</label>
        <input type="text" class="form-control" name="marine_cause_of_Loss"></div>

        <div class="col-md-12" style="padding-bottom:5px;"> <label class="label-text">Instructions </label>
        <input type="text" class="form-control" name="marine_instruction" ></div>

        <div class="col" style="text-align:right;">
  <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-success">Save</button>
                </div>
            </div>
            </form>
      
  </div>


    <div class="form-group row"   id="third" style=" padding: 5px;
    border: 1px solid;
    border-radius: 10px; display: none;">
   <form id="createtranslationjob3" class="row" method="post" enctype="multipart/form-data">
  
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Contact Person</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="cattle_name_contact_person" required></div>
       
<div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Mobile of Contact Person</label> <span style="color:red">*</span>
        <input type="tel" minlength="10" pattern="[789][0-9]{9}" class="form-control" name="cattle_mobile_contact_person" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Beneficiary</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="cattle_name_beneficiary" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Animal Tag Number</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="cattle_animal_tag_number" pattern="[A-Z0-9]{2,}" onkeyup="this.value = this.value.toUpperCase();" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Policy Number</label>
        <input type="text" class="form-control" name="cattle_policy_number" ></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Location of survey to be done</label>
        <input type="text" class="form-control" name="cattle_location"></div>

        <div class="col-md-12" style="padding-bottom:5px;"> <label class="label-text">Instructions </label>
        <input type="text" class="form-control" name="cattle_instruction"></div>

         <div class="col" style="text-align:right;">
  <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-success">Save</button>
                </div>
            </div>
            </form>
  </div>

    <div class="form-group row"   id="forth" style=" padding: 5px;
    border: 1px solid;
    border-radius: 10px; display: none;">
   <form id="createtranslationjob4" class="row" method="post" enctype="multipart/form-data">
  
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Contact Person</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="death_name_contact_person" required></div>
       
<div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Mobile of Contact Person</label> <span style="color:red">*</span>
        <input type="tel" minlength="10" pattern="[789][0-9]{9}" class="form-control" name="death_mobile_contact_person" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Employer</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="death_name_of_employer" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Name of Affected person</label> <span style="color:red">*</span>
        <input type="text" class="form-control" name="death_name_of_affected_person" required></div>
        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Nature of Assignment</label> <span style="color:red">*</span>

 <select   name="death_nature_of_assignment" id="death_nature_of_assignment"  class="form-control" required>
                                <option value="">------Nature Of Assignment-------</option>
                             
                                <option value="Death_Case">Death Case</option>
                                  <option value="Injury_Case"> Injury Case</option>
                                    <option value=" Bill_Verifications"> Bill Verifications</option>

                               
                                    
                            </select>


   </div>

        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Policy Number</label>
        <input type="text" class="form-control" name="death_policy_number"></div>

        <div class="col-md-6" style="padding-bottom:5px;"> <label class="label-text">Location of survey to be done</label>
        <input type="text" class="form-control" name="death_location"></div>

        <div class="col-md-12" style="padding-bottom:5px;"> <label class="label-text">Instructions </label>
        <input type="text" class="form-control" name="death_instruction"></div>

        <div class="col" style="text-align:right;">
  <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-success">Save</button>
                </div>
            </div>
    </form>    
  </div>
 

              
          
        </div>
    </div>
</div>


<script>
    function subformopen(id)
    {
        console.log(id);
if(id==26||id==27||id==28||id==29)
{

    document.getElementById("first").style.display="flex";
     document.getElementById("second").style.display="none";
      document.getElementById("third").style.display="none";
       document.getElementById("forth").style.display="none";

if(id==26)
{
 document.getElementById("Vehicle_type").required = true;
  document.getElementById("pre_case_of_locess").style.display="none";
   document.getElementById("prevehicle_type").style.display="block";


}
else
{
      document.getElementById("Vehicle_type").required = false;
      document.getElementById("pre_case_of_locess").style.display="block";
        document.getElementById("prevehicle_type").style.display="none";

}

if(id==28)
{
  document.getElementById("motor_workshop").style.display="block";
    document.getElementById("motor_workshop_advisor").style.display="block";


}
else
{
      document.getElementById("motor_workshop").style.display="none";
        document.getElementById("motor_workshop_advisor").style.display="none";

}


}
else if(id==30||id==31||id==32||id==33)
{


     document.getElementById("first").style.display="none";
     document.getElementById("second").style.display="flex";
      document.getElementById("third").style.display="none";
       document.getElementById("forth").style.display="none";

if(id==31)
{
    
     document.getElementById("marrcase").style.display="none";
}
else
{
     document.getElementById("marrcase").style.display="block";


}


}
else if(id==34||id==35)
{

   document.getElementById("first").style.display="none";
     document.getElementById("second").style.display="none";
      document.getElementById("third").style.display="flex";
       document.getElementById("forth").style.display="none";

}
else if(id==36||id==37)
{


   document.getElementById("first").style.display="none";
     document.getElementById("second").style.display="none";
      document.getElementById("third").style.display="none";
       document.getElementById("forth").style.display="flex";

}
else
{
     document.getElementById("first").style.display="none";
}

    }

</script>