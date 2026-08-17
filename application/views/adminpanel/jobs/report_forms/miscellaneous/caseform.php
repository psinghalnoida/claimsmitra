<div class="panel mt-4" id="caseForm">
    <form id="caseDataForm" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">CASE DATA</h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end"> 
                <?php $companyid = isset($defaultcompany) ? $defaultcompany : ''; ?>
                    <a href="<?php echo base_url('generatechecklist/'.$aid.''); ?>" target="_blank"   class="btn checklist_btn case_btn">Generate Checklist</a>
                    
                    <a href="<?php echo base_url('generatepdf/' . $aid . '/' . $companyid); ?>" target="_blank" class="btn case_btn">Generate Report</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Report" data-toggle="modal" href="javascript:void(0)" id="report_images" style="padding-right: 5px; margin-right:8px;">Report Images <i class="fa-solid fa-upload"></i></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <div class="row my-3">
                <div class="col-xl-4 col-md-4" >
                    <div class="form-group ">
                        <label for="aadhar_number" style="color:black">Relation With &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="salutation" name="salutation" required <?php echo isset($reportdata->salutation) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="S/O" <?php echo ($reportdata->salutation ?? '') == 'S/O' ? 'selected' : ''; ?>>S/O</option>
                            <option value="D/O" <?php echo ($reportdata->salutation ?? '') == 'D/O' ? 'selected' : ''; ?>>D/O</option>
                            <option value="W/O" <?php echo ($reportdata->salutation ?? '') == 'W/O' ? 'selected' : ''; ?>>W/O</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                    <label for="aadhar_number" style="color:black">Relative Name &nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control case-field" <?php echo isset($reportdata->guardian_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->guardian_name) ? $reportdata->guardian_name : ""; ?>" id="guardian_name" name="guardian_name" placeholder="Relative Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="aadhar_number" style="color:black">Aadhar Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->aadhar_number) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->aadhar_number) ? $reportdata->aadhar_number : ""; ?>" name="aadhar_number" id="aadhar_number" placeholder="Aadhar Number">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="address_of_insured" style="color:black"> Address of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->address_of_insured) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->address_of_insured) ? $reportdata->address_of_insured : ""; ?>" id="address_of_insured" placeholder="Address of Insured" name="address_of_insured" rows="2"></input>
                    
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="pan_number" style="color:black">PAN Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pan_number) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->pan_number) ? $reportdata->pan_number : ""; ?>" id="pan_number" name="pan_number" placeholder="PAN Number">
                        
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                            <label for="familyIDNumber" style="color:black">Family Id Number  &nbsp;<span style="color:red">*</span></label>
                            <input type="text" class="form-control case-field" <?php echo isset($reportdata->familyIDNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->familyIDNumber) ? $reportdata->familyIDNumber : ""; ?>" name="familyIDNumber" id="familyIDNumber" placeholder="Family Id Number">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="dateofInsurance" style="color:black">Date of Issuance of Family id &nbsp;<span style="color:red">*</span></label>
                            <input type="text"  class="form-control case-field" <?php echo isset($reportdata->dateofInsurance) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dateofInsurance) ? $reportdata->dateofInsurance : ""; ?>" name="dateofInsurance" id="" placeholder="Select Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="insuredCategory" style="color:black">Category of Insured</label>
                        <select class="form-control case-field" <?php echo isset($reportdata->insuredCategory) ? 'disabled' : ''; ?> name="insuredCategory" id="insuredCategory">
                            <option value="" >Select</option>
                            <option value="OBC" <?php echo ($reportdata->insuredCategory ?? '') == 'OBC' ? 'selected' : ''; ?>>OBC</option>
                            <option value="General" <?php echo ($reportdata->insuredCategory ?? '') == 'General' ? 'selected' : ''; ?>>General</option>
                            <option value="SC" <?php echo ($reportdata->insuredCategory ?? '') == 'SC' ? 'selected' : ''; ?>>SC</option>
                            <option value="ST" <?php echo ($reportdata->insuredCategory ?? '') == 'ST' ? 'selected' : ''; ?>>ST</option>

                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="datePicker" style="color:black">Health Cert. Issuance Date &nbsp;<span style="color:red">*</span> </label>
                            <input type="text" class="form-control case-field" <?php echo isset($reportdata->healthDatePicker) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->healthDatePicker) ? $reportdata->healthDatePicker : ""; ?>" name="healthDatePicker" id="health_issuance_date" placeholder="Select Date">
                            
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="HelthCertificate" style="color:black">Health Cert. No &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->HelthCertificate) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->HelthCertificate) ? $reportdata->HelthCertificate : ""; ?>" name="HelthCertificate" id="HelthCertificate" placeholder="Health Cert. No">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->policyNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policyNumber) ? $reportdata->policyNumber : ""; ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                    </div>
                </div>
                 <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="periodOfCoverage" style="color: black;">Period of Coverage &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->periodOfCoverage) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->periodOfCoverage) ? $essentialdata->periodOfCoverage : ""; ?>" id="periodOfCoverage" name="periodOfCoverage" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="periodCovTo" style="color: black;">Period of Coverage To &nbsp;<span style="color:red">*</label>
                        <input type="text" class="form-control case-field " <?php echo isset($reportdata->periodCovTo) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->periodCovTo) ? $reportdata->periodCovTo : ""; ?>" id="periodCovTo" name="periodCovTo" placeholder="Select Date" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="amount1" style="color:black">Sum Insured in Health Certificate &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rs.</span>
                            </div>
                            <input type="text" class="form-control case-field" <?php echo isset($reportdata->amount1) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->amount1) ? $reportdata->amount1 : ""; ?>" name="amount1" id="amount2" placeholder="Enter amount">
                        
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="amount2" style="color:black">Premium Paid By insured (Only Customer Contribution) &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Rs.</span>
                            </div>
                            <input type="text" class="form-control case-field" <?php echo isset($reportdata->amount2) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->amount2) ? $reportdata->amount2 : ""; ?>" name="amount2" id="amount3" placeholder="Enter amount">
                        
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 ">
                    <div class="form-group">
                        <label for="milkingCapacity" style="color:black">Milking Capacity in Health Certificate &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->milkingCapacity) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->milkingCapacity) ? $reportdata->milkingCapacity : ""; ?>" name="milkingCapacity" id="milkingCapacity" placeholder="Milking Capacity in Health Certificate">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 ">
                    <div class="form-group">
                        <label for="milkingCapacity" style="color:black">Age of animal as per HC </label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ageperhc) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ageperhc) ? $reportdata->ageperhc : ""; ?>" name="ageperhc" id="ageperhc" placeholder="As per HC">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="sumInsuredInput" style="color:black">Health Cert. issued by Doctor(Name of Doctor) &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dr.</span>
                            </div>
                            <input type="text" <?php echo isset($reportdata->doctorName) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->doctorName) ? $reportdata->doctorName : ""; ?>" name="doctorName" class="form-control case-field" id="doctorName" placeholder="Name of Doctor">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="breed"  style="color:black">Breed As per Policy &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->breed) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->breed) ? $reportdata->breed : ""; ?>" name="breed" class="form-control case-field" id="breed" placeholder="Breed">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="birthNaturalMark" style="color:black">Birth/Natural Mark &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group " data-provide="datepicker">
                            <input type="text" <?php echo isset($reportdata->birthNaturalMark) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->birthNaturalMark) ? $reportdata->birthNaturalMark : ""; ?>" name="birthNaturalMark" class="form-control case-field" id="datePicker" placeholder="Birth/Natural Mark">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="Gender" style="color:black">Gender &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->Gender) ? 'disabled' : ''; ?> name="Gender" id="Gender">
                            <option value="" selected disabled>Select</option>
                            <option value="Male" <?php echo ($reportdata->Gender ?? '') == 'Male' ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($reportdata->Gender ?? '') == 'Female' ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="totalAnimal" style="color:black">Total Number of Animal in Family &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->totalAnimal) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->totalAnimal) ? $reportdata->totalAnimal : ""; ?>" id="totalAnimal" placeholder="Total Number of Animal in Family" name="totalAnimal">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="totalAnimalInsured" style="color:black">Total Number of Animal Insured /in the scheme &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->totalAnimalInsured) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->totalAnimalInsured) ? $reportdata->totalAnimalInsured : ""; ?>" id="totalAnimalInsured" placeholder="Total Number of Animal Insured /in the scheme" name="totalAnimalInsured">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="anyLoanTaken" style="color:black">If Any Loan Taken For Animal &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->anyLoanTaken) ? 'disabled' : ''; ?> id="anyLoanTaken" name="anyLoanTaken">
                            <option value="" selected disabled>Choose</option>
                            <option value="Yes" <?php echo ($reportdata->anyLoanTaken ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->anyLoanTaken ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="individualFamily" style="color:black">Individual Family/Dairy &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->individualFamily) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->individualFamily) ? $reportdata->individualFamily : ""; ?>" id="individualFamily" placeholder="Individual Family" name="individualFamily">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="nameOfBank" style="color:black">Name of Bank/FI from where loan Taken &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->nameOfBank) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->nameOfBank) ? $reportdata->nameOfBank : ""; ?>" id="nameOfBank" placeholder="Name of Bank/FI from where loan Taken" name="nameOfBank">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loanRunning" style="color:black">Loan Running &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->loanRunning) ? 'disabled' : ''; ?> id="loanRunning" name="loanRunning">
                            <option value="" selected disabled>Choose</option>
                            <option value="Yes" <?php echo ($reportdata->loanRunning ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->loanRunning ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>   
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="accountNumberInput" style="color:black">Name & address of bank of owner where claim will be paid &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->accountNumberInput) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accountNumberInput) ? $reportdata->accountNumberInput : ""; ?>" id="accountNumberInput" placeholder="Account Number(Loan)" name="accountNumberInput">
                    </div>
                </div>
                 <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="accountNumberInput" style="color:black">Account Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->accountNumber_saving_account
                                ) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accountNumber_saving_account
                                ) ? $reportdata->accountNumber_saving_account
                                : ""; ?>" id="accountNumberInput" placeholder="Account Number(Saving Account)" name="accountNumber_saving_account">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="accountHolder" style="color:black">Name Of account holder as per bank records &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->accountHolder) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accountHolder) ? $reportdata->accountHolder : ""; ?>" name="accountHolder" id="accountHolder" placeholder="Name Of Account Holder as per bank records">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" style="color:black">IFSC Code &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ifscCode) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ifscCode) ? $reportdata->ifscCode : ""; ?>" name="ifscCode" id="ifscCode" placeholder="IFSC Code">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="bankDetails" style="color:black">Bank detail as per cheque &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->bankDetails) ? 'disabled' : ''; ?> name="bankDetails" id="bankDetails">
                            <option value="" >Select</option>
                            <option value="Passbook" <?php echo ($reportdata->bankDetails ?? '') == 'Passbook' ? 'selected' : ''; ?>>Passbook</option>
                            <option value="Cheque" <?php echo ($reportdata->bankDetails ?? '') == 'Cheque' ? 'selected' : ''; ?>>Cheque</option>
                            <option value="Certificate" <?php echo ($reportdata->bankDetails ?? '') == 'Certificate' ? 'selected' : ''; ?>>Bank Certificate</option>
                            <option value="NA" <?php echo ($reportdata->bankDetails ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row my-3">   
                <div class="col-xl-4 col-md-4">
                    <!-- <div class="form-group">
                        <label for="datePicker" style="color:black">Date of Disease Start &nbsp;<span style="color:red">*</span></label>
                            <input type="text" class="form-control case-field" <?php echo isset($reportdata->diseaseDate) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->diseaseDate) ? $reportdata->diseaseDate : ""; ?>" name="diseaseDate" id="diseaseDate" placeholder="Select Date">
                    </div> -->
                    <div class="form-group">
                        <label for="dateOfDisease" style="color:black">Date of disease &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control editable-field " <?php echo isset($essentialdata->dateOfDisease) ? "disabled" : "enable"; ?> value="<?php echo isset($essentialdata->dateOfDisease) ? $essentialdata->dateOfDisease : ""; ?>" name="dateOfDisease" id="dateOfDisease" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="animalDisposal" style="color:black">Disposal of Animal carcass (Sold / Buried / Left Useless) &nbsp;<span style="color:red">*</span></label>
                        <input type="text" name="animalDisposal" class="form-control case-field" <?php echo isset($reportdata->animalDisposal) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->animalDisposal) ? $reportdata->animalDisposal : ""; ?>" id="animalDisposal" placeholder="Disposal of Animal carcass ">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="calvingDate" style="color:black">Date of last Calving &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->calvingDate) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->calvingDate) ? $reportdata->calvingDate : ""; ?>" name="calvingDate" class="form-control case-field"  placeholder="Date of last Calving">
                    </div>
                </div>
            </div>
            <div class="row my-3">       
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" style="color:black"> Pregnant &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->pregnant) ? 'disabled' : ''; ?> name="pregnant" id="pregnant">
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->pregnant ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->pregnant ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="pmr" style="color:black"> PMR Certificate &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->pmr) ? 'disabled' : ''; ?> name="pmr" id="pmr">
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->pmr ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->pmr ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->pmr ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="dateTimePostMortem" style="color:black">Disease/ Reason of Death &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->reason_of_death) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->reason_of_death) ? $reportdata->reason_of_death : ""; ?>" name="reason_of_death" class="form-control case-field" id="reason_of_death" placeholder="Reason of Death">
                    </div>
                </div>
            </div>
            <!-- additional field -->
            <div class="row my-3 " id="additional_field">
                <div class="col-xl-2 col-md-2 ">
                    <div class="form-group">
                        <label for="dateTimePostMortem" style="color:black">Post Mortem date &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" <?php echo isset($reportdata->dateTimePostMortem) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dateTimePostMortem) ? $reportdata->dateTimePostMortem : ""; ?>" name="dateTimePostMortem" class="form-control case-field" id="dateTimePostMortem" placeholder="Select Date">
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 ">
                    <div class="form-group">
                        <label for="pmr_time" style="color:black">Post Mortem time &nbsp;<span style="color:red">*</span></label>
                            <input type="text" class="form-control case-field" <?php echo isset($reportdata->pmr_time) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->pmr_time) ? $reportdata->pmr_time : ""; ?>" id="pmr_time" name="pmr_time" required placeholder="Select Time">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="nameOfdoctor" style="color:black">Name of Dr. Who conducted PMR &nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dr.</span>
                            </div>
                            <input type="text" <?php echo isset($reportdata->nameOfdoctor) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->nameOfdoctor) ? $reportdata->nameOfdoctor : ""; ?>" name="nameOfdoctor" class="form-control case-field" id="doctorName" placeholder="Name of Dr. Who conducted PMR">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="doctorContactNumber" style="color:black">Mobile Number of Doctor &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->doctorContactNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->doctorContactNumber) ? $reportdata->doctorContactNumber : ""; ?>" name="doctorContactNumber" class="form-control case-field" id="doctorContactNumber" placeholder="Mobile Number of Doctor">
                    </div>
                </div>
            </div>
            <!-- additional field -->
            <div class="row my-3 "id="additional_fields_2">                                          
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="typeOfanimal" style="color:black">Type Of Animal &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control editable-field" id="typeOfAnimal" name="typeOfAnimal" required <?php echo isset($essentialdata->typeOfAnimal) ? 'disabled' : ''; ?>>
                            <option selected disabled>Choose an animal</option>
                            <option value="Calf" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Calf' ? 'selected' : ''; ?>>Calf</option>
                            <option value="Buff" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Buff' ? 'selected' : ''; ?>>Buff</option>
                            <option value="Cow" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Cow' ? 'selected' : ''; ?>>Cow</option>
                            <option value="Buffalo" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Buffalo' ? 'selected' : ''; ?>>Buffalo</option>
                            <option value="Bull" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Bull' ? 'selected' : ''; ?>>Bull</option>
                            <option value="Horse" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Horse' ? 'selected' : ''; ?>>Horse</option>
                            <option value="Yak" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Yak' ? 'selected' : ''; ?>>Yak</option>
                            <option value="Camel" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Camel' ? 'selected' : ''; ?>>Camel</option>
                            <option value="Donkey" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Donkey' ? 'selected' : ''; ?>>Donkey</option>
                            <option value="Goat" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Goat' ? 'selected' : ''; ?>>Goat</option>
                            <option value="Sheep" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Sheep' ? 'selected' : ''; ?>>Sheep</option>
                            <option value="Pig" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Pig' ? 'selected' : ''; ?>>Pig</option>
                            <option value="Ox" <?php echo ($essentialdata->typeOfAnimal ?? '') == 'Ox' ? 'selected' : ''; ?>>Ox</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="breedAsPerPMR" style="color:black">Breed as per PMR &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->breedAsPerPMR) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->breedAsPerPMR) ? $reportdata->breedAsPerPMR : ""; ?>" name="breedAsPerPMR" class="form-control case-field" id="breedAsPerPMR" placeholder="Breed as per PMR">
                    </div>
                </div>
                
                 <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="ageOfAnimal" style="color:black">Age of Animal as per PMR &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->ageOfAnimal) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->ageOfAnimal) ? $reportdata->ageOfAnimal : ""; ?>" name="ageOfAnimal" class="form-control case-field" id="ageOfAnimal" placeholder="Age of Animal as per PMR">
                    </div>
                </div>
            </div>
            <!-- additional field -->
            <div class="row my-3" id="additional_fields_3">   
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="tagAsPerPMR" style="color:black">Tag No. as per PMR &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->tagAsPerPMR) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->tagAsPerPMR) ? $reportdata->tagAsPerPMR : ""; ?>" name="tagAsPerPMR" class="form-control case-field" id="tagAsPerPMR" placeholder="Tag No. as per PMR">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="milk_capacity" style="color:black">Milk capacity as per PMR &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->milk_capacity) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->milk_capacity) ? $reportdata->milk_capacity : ""; ?>" name="milk_capacity" class="form-control case-field" id="milk_capacity" placeholder="Milk capacity as per PMR">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="clean_pmr" style="color:black">Clean PMR &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->clean_pmr) ? 'disabled' : ''; ?> name="clean_pmr" id="clean_pmr">
                            <option value="" selected disabled>Select</option>
                            <option value="Yes" <?php echo ($reportdata->clean_pmr ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->clean_pmr ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->clean_pmr ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>                                                
                    </div>
                </div>
            </div>
            <div class="row my-3">                                        
                <div class="col-xl-4 col-md-4" >
                    <div class="form-group">
                        <label for="causeOfDeathAsPerPMR" style="color:black">Cause of Death as per PMR &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->causeOfDeathAsPerPMR) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->causeOfDeathAsPerPMR) ? $reportdata->causeOfDeathAsPerPMR : ""; ?>" name="causeOfDeathAsPerPMR" class="form-control case-field" id="causeOfDeathAsPerPMR" placeholder="Cause of Death as per PMR">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="causeOfDeathAsPerInsured" style="color:black">Cause of Death as per Insured Statement &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->causeOfDeathAsPerInsured) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->causeOfDeathAsPerInsured) ? $reportdata->causeOfDeathAsPerInsured : ""; ?>" name="causeOfDeathAsPerInsured" class="form-control case-field" id="causeOfDeathAsPerInsured" placeholder="Cause of Death">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="treatment_chart" style="color:black">Treatment Chart &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->treatment_chart) ? 'disabled' : ''; ?> name="treatment_chart" id="treatment_chart">
                            <option value="" >Select</option>
                            <option value="Yes" <?php echo ($reportdata->treatment_chart ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->treatment_chart ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->treatment_chart ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>                                                
                    </div>
                </div>
            </div>

            <div class="row my-3" id="additional_fields_4">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="treatmentDate" style="color:black">Treatment Start Date &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->treatmentDate) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->treatmentDate) ? $reportdata->treatmentDate : ""; ?>" name="treatmentDate" class="form-control case-field" id="treatmentDate" placeholder="Treatment Start Date">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="whoAdministeredTreatment" style="color:black">Who administered treatment &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->whoAdministeredTreatment) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->whoAdministeredTreatment) ? $reportdata->whoAdministeredTreatment : ""; ?>" name="whoAdministeredTreatment" class="form-control case-field" id="whoAdministeredTreatment" placeholder="Who administered treatment">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="administeredTreatment" style="color:black">Treatment administered &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->administeredTreatment) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->administeredTreatment) ? $reportdata->administeredTreatment : ""; ?>" name="administeredTreatment" class="form-control case-field" id="administeredTreatment" placeholder="Treatment administered">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="satisfactory_and_sufficient" style="color:black">The treatment administered seems to be satisfactory and sufficient &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->satisfactory_and_sufficient) ? 'disabled' : ''; ?> name="satisfactory_and_sufficient" id="satisfactory_and_sufficient" required>
                            <option value="" >Select</option>
                            <option value="Yes" <?php echo ($reportdata->satisfactory_and_sufficient ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->satisfactory_and_sufficient ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->satisfactory_and_sufficient ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row my-3"> 

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="bankIOwnerAddress" style="color:black">Name of Address of Bank Of Owner where Claim will be Paid &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->bankIOwnerAddress) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->bankIOwnerAddress) ? $reportdata->bankIOwnerAddress : ""; ?>" class="form-control case-field" id="bankIOwnerAddress" rows="3" name="bankIOwnerAddress"></input>
                    </div>
                </div> 
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="physicalHealth" style="color:black">Health &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" <?php echo isset($reportdata->physicalHealth) ? 'disabled' : ''; ?> name="physicalHealth" id="physicalHealth" required>
                            <option value="" >Select</option>
                            <option value="physicalHealth_1" <?php echo ($reportdata->physicalHealth ?? '') == 'physicalHealth_1' ? 'selected' : ''; ?>>Good Health</option>
                            <option value="physicalHealth_2" <?php echo ($reportdata->physicalHealth ?? '') == 'physicalHealth_2' ? 'selected' : ''; ?>>Weak in Health</option>
                            <option value="physicalHealth_3" <?php echo ($reportdata->physicalHealth ?? '') == 'physicalHealth_3' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="gapsBetweenTreatment" style="color:black">Gap Between treatments &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->gapsBetweenTreatment) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->gapsBetweenTreatment) ? $reportdata->gapsBetweenTreatment : ""; ?>" name="gapsBetweenTreatment" class="form-control case-field" id="gapsBetweenTreatment" placeholder="Treatment administered">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="dateAndAmountOfPurchase" style="color:black">IF animal was purchased, Date & amount of Purchase of animal &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->dateAndAmountOfPurchase) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->dateAndAmountOfPurchase) ? $reportdata->dateAndAmountOfPurchase : ""; ?>" name="dateAndAmountOfPurchase" class="form-control case-field" id="dateAndAmountOfPurchase" placeholder="IF animal was purchased, Date & amount of Purchase of animal">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="physicalHealthOfAnimal" style="color:black">Expected market value of Animal &nbsp;<span style="color:red">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rs.</span>
                            </div>
                            <input type="text" <?php echo isset($reportdata->physicalHealthOfAnimal) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->physicalHealthOfAnimal) ? $reportdata->physicalHealthOfAnimal : ""; ?>" name="physicalHealthOfAnimal" class="form-control case-field" id="physicalHealthOfAnimal" placeholder="Enter amount">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="anyDisavility" style="color:black">Any Disavility/special marks observed in animal &nbsp;<span style="color:red">*</span></label>
                        <input type="text" <?php echo isset($reportdata->anyDisavility) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->anyDisavility) ? $reportdata->anyDisavility : ""; ?>" name="anyDisavility" class="form-control case-field" id="anyDisavility" placeholder="Any Disavility/special marks observed in animal">
                    </div>
                </div>
            </div>

           <div class="row my-3">
                <!-- Statement of Insured -->
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="statement_of_insured" style="color:black">Statement of Insured &nbsp;<span style="color:red">*</span></label>
                        <textarea 
                            class="form-control case-field" 
                            <?php echo isset($reportdata->statement_of_insured) ? "disabled" : ""; ?> 
                            name="statement_of_insured" 
                            id="statement_of_insured" 
                            rows="2">
                            <?php echo isset($reportdata->statement_of_insured) ? htmlspecialchars($reportdata->statement_of_insured) : "Our investigator has inquired from the above-named claimant/insured, who has confirmed the incident and provided a written statement to that effect. The statement is enclosed."; ?>
                        </textarea>
                    </div>
                </div>

               <!-- Statement of Villagers -->
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="statement_of_villagers" style="color:black">Statement of Villagers &nbsp;<span style="color:red">*</span></label>
                        <textarea 
                            class="form-control case-field" 
                            <?php echo isset($reportdata->statement_of_villagers) ? "disabled" : ""; ?> 
                            name="statement_of_villagers" 
                            id="statement_of_villagers" 
                            rows="2"
                        >
                            <?php echo isset($reportdata->statement_of_villagers) ? htmlspecialchars($reportdata->statement_of_villagers) : "Our investigator has also inquired with the neighbors/villagers, who have confirmed the incident and provided a written statement to that effect. The statement is enclosed."; ?>
                        </textarea>
                    </div>
                </div>

                <!-- Statement of Two Authorized Person -->
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="statement_of_two_authorized" style="color:black">Statement of Two Authorized Person on Form &nbsp;<span style="color:red">*</span></label>
                        <textarea 
                            class="form-control case-field" 
                            <?php echo isset($reportdata->statement_of_two_authorized) ? "disabled" : ""; ?> 
                            name="statement_of_two_authorized" 
                            id="statement_of_two_authorized" 
                            rows="2"
                        >
                            <?php echo isset($reportdata->statement_of_two_authorized) ? htmlspecialchars($reportdata->statement_of_two_authorized) : "Our investigation has further inquired about the above matter. Many witnesses have confirmed the details provided. Signatures of the village sarpanch/block pramukh and doctors were also obtained on the documents, all confirming the circumstances of the loss as explained above. The relevant documents are enclosed."; ?>
                        </textarea>
                    </div>
                </div>
            </div>

            <table id="obesrvationtable" style="width: 100%;" border="1">
                <tbody>
                    <tr>
                    <td><label for="observation_4" class="ml-2" style="color:black">Proper and timely treatment was administered to animal &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->observation_4) ? 'disabled' : ''; ?> name="observation_4" id="observation_4"  >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_4 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_4 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_4 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_1" class="ml-2" style="color:black">The animal bearing above tag was insured with underwriters as above. We have Checked and matched the tag number and other details as per the policy. The live animal photos were however not seen by us. Kindly match the animal before settlement of the calm. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;"><select class="form-control case-field" <?php echo isset($reportdata->observation_1) ? 'disabled' : ''; ?> name="observation_1" id="observation_1">
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_1 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_1 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>  
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_1 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label  for="observation_2" class="ml-2" style="color:black">As per our observations, the animal was living in good condition with proper food and shelter. There is no contribututory negligence of owner in alleged death of the animal. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->observation_2) ? 'disabled' : ''; ?> name="observation_2" id="observation-2" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_2 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_2 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_2 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_3" class="ml-2" style="color:black">Details of Death (Date and time, cause of death, etc) as informed by Insured found correct in our Investigation. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->observation_3) ? 'disabled' : ''; ?> name="observation_3" id="observation-3" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_3 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_3 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_3 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_5" class="ml-2" style="color:black">Our investigator personally visited the place of death and investigated the case. His selfie is also attached. The photo of the animal attendant/Owner also taken by us, attached. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field"  <?php echo isset($reportdata->observation_5) ? 'disabled' : ''; ?> name="observation_5" id="observation-5">
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_5 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No"  class="text-center" <?php echo ($reportdata->observation_5 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_5 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_6" class="ml-2" style="color:black">Tag was present in ear of dead animal & was safe. The same was cut in our presence and retained by the owner for the doctor verification &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control observation_6" <?php echo isset($reportdata->observation_6) ? 'disabled' : ''; ?> name="observation_6" id="observation_6" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_6 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_6 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_6 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_7" class="ml-2" style="color:black">Our Photos were taken with GPS, date and time stamp as far as technically possible. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->observation_7) ? 'disabled' : ''; ?> name="observation_7" id="observation-7">
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_7 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_7 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_7 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_8" class="ml-2" style="color:black">Later tag has been collected and is attached with this report. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->observation_8) ? 'disabled' : ''; ?> name="observation_8" id="observation-8">
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_8 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_8 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_8 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="observation_9" class="ml-2" style="color:black">Animal carcass was available for Investigation. The body was not deteriorated. &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->observation_9) ? 'disabled' : ''; ?> name="observation_9" id="observation_9" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->observation_9 ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->observation_9 ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->observation_9 ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>

                     <tr>
                    <td><label for="vs_signature_on_pmr" class="ml-2" style="color:black">VS Signature on PMR &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->vs_signature_on_pmr) ? 'disabled' : ''; ?> name="vs_signature_on_pmr" id="vs_signature_on_pmr" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->vs_signature_on_pmr ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->vs_signature_on_pmr ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->vs_signature_on_pmr ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>

                    <tr>
                    <td><label for="vs_stamp_on_pmr" class="ml-2" style="color:black">VS Stamp on PMR &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->vs_stamp_on_pmr) ? 'disabled' : ''; ?> name="vs_stamp_on_pmr" id="vs_stamp_on_pmr" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->vs_stamp_on_pmr ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->vs_stamp_on_pmr ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->vs_stamp_on_pmr ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>

                    <tr>
                    <td><label for="period_of_treatment_days" class="ml-2" style="color:black">Period of Treatment Days &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->period_of_treatment_days) ? 'disabled' : ''; ?> name="period_of_treatment_days" id="period_of_treatment_days" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->period_of_treatment_days ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->period_of_treatment_days ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->period_of_treatment_days ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="signed_by_tehsildar" class="ml-2" style="color:black">Signed by Tehsildar &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->signed_by_tehsildar) ? 'disabled' : ''; ?> name="signed_by_tehsildar" id="signed_by_tehsildar" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->signed_by_tehsildar ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->signed_by_tehsildar ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->signed_by_tehsildar ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>

                     <tr>
                    <td><label for="signed_by_sarpanch" class="ml-2" style="color:black">Claims form Signed by Sarpanch &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->signed_by_sarpanch) ? 'disabled' : ''; ?> name="signed_by_sarpanch" id="signed_by_sarpanch" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->signed_by_sarpanch ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->signed_by_sarpanch ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->signed_by_sarpanch ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                     <tr>
                    <td><label for="tag_number_clear" class="ml-2" style="color:black">Tag number is clear &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->tag_number_clear) ? 'disabled' : ''; ?> name="tag_number_clear" id="tag_number_clear" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->tag_number_clear ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->tag_number_clear ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->tag_number_clear ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>

                     <tr>
                    <td><label for="dead_animal_photo_attached" class="ml-2" style="color:black">Dead Animal Photos Attached &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->dead_animal_photo_attached) ? 'disabled' : ''; ?> name="dead_animal_photo_attached" id="dead_animal_photo_attached" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->dead_animal_photo_attached ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->dead_animal_photo_attached ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->dead_animal_photo_attached ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="tag_number_as_per_policy" class="ml-2" style="color:black">Tag Number is Correct As per policy &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->tag_number_as_per_policy) ? 'disabled' : ''; ?> name="tag_number_as_per_policy" id="tag_number_as_per_policy" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->tag_number_as_per_policy ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->dead_animal_photo_attached ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->dead_animal_photo_attached ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                     <tr>
                    <td><label for="health_certificate_option" class="ml-2" style="color:black"> Health Certificate &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->health_certificate_option) ? 'disabled' : ''; ?> name="health_certificate_option" id="health_certificate_option" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->health_certificate_option ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->health_certificate_option ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->health_certificate_option ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                     <tr>
                    <td><label for="pmr_option" class="ml-2" style="color:black">PMR &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->pmr_option) ? 'disabled' : ''; ?> name="pmr_option" id="pmr_option" >
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->pmr_option ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->pmr_option ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->pmr_option ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                </tbody>
            </table>
             <table id="documents_attached" style="width: 100%;" border="1" class="mt-4">
                <tbody>
                    <tr>
                    <td><label class="ml-2" for="policy_copy" style="color:black">Policy Copy &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->policy_copy) ? 'disabled' : ''; ?> name="policy_copy" id="policy_copy" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->policy_copy ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->policy_copy ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->policy_copy ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label class="ml-2" for="health_certificate" style="color:black">Health Certificate &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;"><select class="form-control case-field" <?php echo isset($reportdata->health_certificate) ? 'disabled' : ''; ?> name="health_certificate" id="health_certificate" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->health_certificate ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->health_certificate ?? '') == 'No' ? 'selected' : ''; ?>>No</option>  
                            <option value="NA" class="text-center" <?php echo ($reportdata->health_certificate ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label class="ml-2" for="claim_intimation_letter" style="color:black">Claim Intimation Letter &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->claim_intimation_letter) ? 'disabled' : ''; ?> name="claim_intimation_letter" id="claim_intimation_letter" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->claim_intimation_letter ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->claim_intimation_letter ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->claim_intimation_letter ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label class="ml-2" for="discharge_voucher" style="color:black">Discharge Voucher &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->discharge_voucher) ? 'disabled' : ''; ?> name="discharge_voucher" id="discharge_voucher" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->discharge_voucher ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->discharge_voucher ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->discharge_voucher ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label class="ml-2" for="sc_certificate" style="color:black">SC Certificate &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field"  <?php echo isset($reportdata->sc_certificate) ? 'disabled' : ''; ?> name="sc_certificate" id="sc_certificate" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->sc_certificate ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->sc_certificate ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->sc_certificate ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label  for="account_number" class="ml-2" style="color:black">A/C Number with NEFT Details with IFSC Code &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->account_number) ? 'disabled' : ''; ?> name="account_number" id="account_number" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->account_number ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->account_number ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->account_number ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="pmr_with_signature" class="ml-2" style="color:black">PMR with signature & stamp &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->pmr_with_signature) ? 'disabled' : ''; ?> name="pmr_with_signature" id="pmr_with_signature" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->pmr_with_signature ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->pmr_with_signature ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->pmr_with_signature ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>

                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="treatment_chart_option" class="ml-2" style="color:black">Treatment chart (if illness above 2 days)&nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->treatment_chart_option) ? 'disabled' : ''; ?> name="treatment_chart_option" id="treatment_chart_option" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->treatment_chart_option ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->treatment_chart_option ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->treatment_chart_option ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="insured_statement" class="ml-2" style="color:black">Statement of Insured &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->insured_statement) ? 'disabled' : ''; ?> name="insured_statement" id="insured_statement" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->insured_statement ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->insured_statement ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->insured_statement ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="claim_form_with_signature" class="ml-2" style="color:black">Claim form with signature & stamp minimum two goverment officiers (Doctor Signature & stamp
                    is mandatory)&nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->claim_form_with_signature) ? 'disabled' : ''; ?> name="claim_form_with_signature" id="claim_form_with_signature" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->claim_form_with_signature ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->claim_form_with_signature ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->claim_form_with_signature ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="copy_of_adhar_card" class="ml-2" style="color:black">Copy of Aadhar Card of insured &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->copy_of_adhar_card) ? 'disabled' : ''; ?> name="copy_of_adhar_card" id="copy_of_adhar_card" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->copy_of_adhar_card ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center"  <?php echo ($reportdata->copy_of_adhar_card ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->copy_of_adhar_card ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="photo_of_dead" class="ml-2" style="color:black">Photo of dead animal with date &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->photo_of_dead) ? 'disabled' : ''; ?> name="photo_of_dead" id="photo_of_dead" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->photo_of_dead ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->photo_of_dead ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->photo_of_dead ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="investigator_report" class="ml-2" style="color:black">Investigator report with signature & stamp &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->investigator_report) ? 'disabled' : ''; ?> name="investigator_report" id="investigator_report" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->investigator_report ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->investigator_report ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->investigator_report ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="tag_available" class="ml-2" style="color:black">Tag Available &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->tag_available) ? 'disabled' : ''; ?> name="tag_available" id="tag_available" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->tag_available ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->tag_available ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->tag_available ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                    <td><label for="fir_attached"  class="ml-2" style="color:black">Fir Attached &nbsp;<span style="color:red">*</span></label></td>
                    <td style="width:10%; align-self: center;">
                        <select class="form-control case-field" <?php echo isset($reportdata->fir_attached) ? 'disabled' : ''; ?> name="fir_attached" id="fir_attached" required>
                            <option value="" class="text-center">Select</option>
                            <option value="Yes" class="text-center" <?php echo ($reportdata->fir_attached ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" class="text-center" <?php echo ($reportdata->fir_attached ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" class="text-center" <?php echo ($reportdata->fir_attached ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </td>
                    </tr>
                </tbody>
            </table>
              <div class="row my-3">
                    <div class="col-xl-12 col-md-12">
                        <div class="form-group">
                            <label for="remarkObservation" style="color:black">Remark</label>
                            <textarea 
                                name="remarkObservation" 
                                <?php echo isset($reportdata->remarkObservation) ? "disabled" : ""; ?> 
                                class="form-control case-field" 
                                id="remarkObservation" 
                                rows="2">
                               <?php 
                                if (isset($reportdata->remarkObservation)) {
                                    // Use htmlspecialchars to encode special characters and preserve new lines
                                    echo htmlspecialchars($reportdata->remarkObservation, ENT_QUOTES, 'UTF-8');
                                }
                                ?>
                            </textarea>
                        </div>
                    </div>
                </div>

            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn"  value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button"  id="cattle_submit">
            </div>
        </div>
    </form>
</div>
