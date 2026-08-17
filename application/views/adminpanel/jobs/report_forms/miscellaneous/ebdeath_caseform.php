<style>
    .custom-modal-width {
        max-width: 1000px;
    }

    #selectebdeathimages.modal {
        z-index: 1070 !important;
    }

    #selectebdeathimages.modal .modal-backdrop {
        z-index: 1060 !important;
    }

    .dimmed {
        filter: brightness(70%);
        transition: filter 0.1s ease;
    }
</style>
<div class="panel mt-4" id="caseForm">
    <form id="ebdeathcase" method="post" enctype="multipart/form-data">
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
            <h4 class="pl-2 mt-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Insurance Particulars</h4>
            <div class="row ">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="headline" style="color:black">
                            Head line &nbsp;<span style="color:red">*</span>
                        </label>
                        <textarea class="form-control case-field"
                            <?php echo isset($reportdata->headline) ? "disabled" : ""; ?>
                            id="headline"
                            name="headline"
                            placeholder="Headline"><?php echo isset($reportdata->headline) ? htmlspecialchars($reportdata->headline) : "In accordance with the instruction received from the office on the date 18/11/2024 to carry out the detailed investigation in to the case in question, we have conducted the investigation thereafter and have visited at various places and verified various necessary documents, obtained details from various sources and having obtained the necessary information/ documents, submit our report as under:"; ?></textarea>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4 ">
                    <div class="form-group">
                        <label for="policyNumber" style="color:black">Policy Number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->policyNumber) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policyNumber) && !empty($reportdata->policyNumber)
                                                                                                                                                                ? $reportdata->policyNumber
                                                                                                                                                                : (isset($essentialdata->policyNumber) ? $essentialdata->policyNumber : ""); ?>" id="policyNumber" name="policyNumber" placeholder="Policy Number">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policyNumberfrom" style="color:black">Policy Number(From) </label>
                        <input type="text" class="form-control case-field policyNumberfrom" <?php echo isset($reportdata->policyNumberfrom) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policyNumberfrom) && !empty($reportdata->policyNumberfrom)
                                                                                                                                                                                    ? $reportdata->policyNumberfrom
                                                                                                                                                                                    : (isset($essentialdata->policyNumberfrom) ? $essentialdata->policyNumberfrom : ""); ?>" id="policyNumberfrom" name="policyNumberfrom" placeholder="From">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="policyNumberto" style="color:black">Policy Number(To) </label>
                        <input type="text" class="form-control case-field policyNumberto" <?php echo isset($reportdata->policyNumberto) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policyNumberto) && !empty($reportdata->policyNumberto)
                                                                                                                                                                                ? $reportdata->policyNumberto
                                                                                                                                                                                : (isset($essentialdata->policyNumberto) ? $essentialdata->policyNumberto : ""); ?>" id="policyNumberto" name="policyNumberto" placeholder="To">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policyissuing_office" style="color:black">Policy Issuing office &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->policyissuing_office) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policyissuing_office) ? $reportdata->policyissuing_office : ""; ?>" id="policyissuing_office" name="policyissuing_office" placeholder="Policy Issuing office">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Name of Insured &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->insured_name) ? $reportdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Name  of Insured">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="sum_insured" style="color:black">Members / Sum Insured as per policy &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->sum_insured) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->sum_insured) ? $reportdata->sum_insured : ""; ?>" id="sum_insured" name="sum_insured" placeholder="Members/Sum Insured as per policy">
                    </div>
                </div>
            </div>
            <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Details of Accident</h4>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="detailed_incidence" style="color:black">Detailed Incidence &nbsp;<span style="color:red">*</span></label>
                        <textarea type="text" class="form-control case-field" <?php echo isset($reportdata->detailed_incidence) ? "disabled" : "enable"; ?> id="detailed_incidence" name="detailed_incidence" placeholder="Detailed Incidence"><?php echo isset($reportdata->detailed_incidence) ? $reportdata->detailed_incidence : ""; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_detail" style="color:black">About Insured</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_detail) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->insured_detail) ? $reportdata->insured_detail : ""; ?>" id="insured_detail" name="insured_detail" placeholder="About Insured">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="detailed_incidencedate" style="color:black">Detailed Incidence Date</label>
                        <input type="text" class="form-control case-field selectdate" <?php echo isset($reportdata->detailed_incidencedate) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->detailed_incidencedate) ? $reportdata->detailed_incidencedate : ""; ?>" id="detailed_incidencedate" name="detailed_incidencedate" placeholder="Detailed Incidence Date">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="detailed_incidencetime" style="color:black">Detailed Incidence Time</label>
                        <input type="text" class="form-control case-field selecttime" <?php echo isset($reportdata->detailed_incidencetime) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->detailed_incidencetime) ? $reportdata->detailed_incidencetime : ""; ?>" id="detailed_incidencetime" name="detailed_incidencetime" placeholder="Detailed Incidence Time">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="accident_date" style="color:black">Date of accident</label>
                        <input type="text" class="form-control case-field selectdate" <?php echo isset($reportdata->accident_date) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accident_date) ? $reportdata->accident_date : ""; ?>" id="accident_date" name="accident_date" placeholder="Date of accident">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="accident_day" style="color:black">Day of accident</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->accident_day) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accident_day) ? $reportdata->accident_day : ""; ?>" id="accident_day" name="accident_day" placeholder="Day of accident">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="accident_time" style="color:black">Time of accident</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->accident_time) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accident_time) ? $reportdata->accident_time : ""; ?>" id="accident_time" name="accident_time" placeholder="Time of accident">
                    </div>
                </div>
                <div class="col-xl-2 col-md-2">
                    <div class="form-group">
                        <label for="accident_place" style="color:black">Place of accident</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->accident_place) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->accident_place) ? $reportdata->detailed_incidencetime : ""; ?>" id="accident_place" name="accident_place" placeholder="Place of accident">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policereport_number" style="color:black">Police report number &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->policereport_number) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policereport_number) ? $reportdata->policereport_number : ""; ?>" id="policereport_number" name="policereport_number" placeholder="Police report number">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="policestation" style="color:black">Police station</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->policestation) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->policestation) ? $reportdata->policestation : ""; ?>" id="policestation" name="policestation" placeholder="Police station">
                    </div>
                </div>
            </div>
            <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">About Claimant / Insured</h4>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claimant_name" style="color:black">Claimant Name &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->claimant_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->claimant_name) ? $reportdata->claimant_name : ""; ?>" id="claimant_name" name="claimant_name" placeholder="Claimant Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claimant_relation" style="color:black">Claimant relation &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="claimant_relation" name="claimant_relation" <?php echo isset($reportdata->claimant_relation) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="S/O" <?php echo ($reportdata->claimant_relation ?? '') == 'S/O' ? 'selected' : ''; ?>>S/O</option>
                            <option value="D/O" <?php echo ($reportdata->claimant_relation ?? '') == 'D/O' ? 'selected' : ''; ?>>D/O</option>
                            <option value="W/O" <?php echo ($reportdata->claimant_relation ?? '') == 'W/O' ? 'selected' : ''; ?>>W/O</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="injured_name" style="color:black">Injured Name &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->injured_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->claimant_relation) ? $reportdata->injured_name : ""; ?>" id="injured_name" name="injured_name" placeholder="Injured Name ">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="injured_address" style="color:black">Injured address &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->injured_address) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->injured_address) ? $reportdata->injured_address : ""; ?>" id="injured_address" name="injured_address" placeholder="Injured address">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="father_name" style="color:black">Father Name &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->father_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->father_name) ? $reportdata->father_name : ""; ?>" id="father_name" name="father_name" placeholder="Father Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="deceased_verification" style="color:black">Age of deceased / Verification &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->deceased_verification) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->deceased_verification) ? $reportdata->deceased_verification : ""; ?>" id="deceased_verification" name="deceased_verification" placeholder="Age of deceased / Verification">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="employer_name" style="color:black">Employer Name</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->employer_name) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->employer_name) ? $reportdata->employer_name : ""; ?>" id="employer_name" name="employer_name" placeholder="Employer Name">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="employer_address" style="color:black">Employer address</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->employer_address) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->employer_address) ? $reportdata->employer_address : ""; ?>" id="employer_address" name="employer_address" placeholder="Employer address">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group ">
                        <label for="verified_claimant" style="color:black">Is the address of claimant verified ?</label>
                        <select class="form-control case-field" id="verified_claimant" name="verified_claimant" <?php echo isset($reportdata->verified_claimant) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->verified_claimant ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->verified_claimant ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->business_run_without_him ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
            </div>
            <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Marital / Family Status</h4>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nominee_name" style="color:black">Name of Nominee &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            <?php echo isset($reportdata->nominee_name) ? "disabled" : "enable"; ?>
                            value="<?php echo isset($reportdata->nominee_name) ? $reportdata->nominee_name : ""; ?>"
                            id="nominee_name" name="nominee_name" placeholder="Name of Nominee">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="nominee_dependent" style="color:black">Is he / she nominee and dependent ?</label>
                        <select class="form-control case-field" id="nominee_dependent" name="nominee_dependent" required
                            <?php echo isset($reportdata->nominee_dependent) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->nominee_dependent ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->nominee_dependent ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="remarried" style="color:black">How the widow / widower remarried &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="remarried" name="remarried" required
                            <?php echo isset($reportdata->remarried) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->remarried ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->remarried ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->remarried ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="child_legal_heirs" style="color:black">Are any children as legal heirs &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            <?php echo isset($reportdata->child_legal_heirs) ? "disabled" : "enable"; ?>
                            value="<?php echo isset($reportdata->child_legal_heirs) ? $reportdata->child_legal_heirs : ""; ?>"
                            id="child_legal_heirs" name="child_legal_heirs" placeholder="Are any children as legal heirs">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        <label style="color:black">Name and Age of all LRs</label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="lr_table">
                                <thead>
                                    <tr>
                                        <td class="text-center" style="color:black;font-size:12px;">Name</td>
                                        <td class="text-center" style="color:black;font-size:12px;">Age</td>
                                        <td class="text-center" style="color:black;font-size:12px;">Sex</td>
                                        <td class="text-center" style="color:black;font-size:12px;">Relation</td>
                                        <td class="text-center" style="color:black;font-size:12px;">Dependency On Deceased</td>
                                        <td class="text-center" style="color:black;font-size:12px;">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="all_lrs">
                                    <tr class="lr-entry">
                                        <td><input type="text" class="form-control case-field lr_name" name="lr_name[]" placeholder="Name"></td>
                                        <td><input type="text" class="form-control case-field lr_age" name="lr_age[]" placeholder="Age"></td>
                                        <td><input type="text" class="form-control case-field lr_sex" name="lr_sex[]" placeholder="Sex"></td>
                                        <td><input type="text" class="form-control case-field lr_relation" name="lr_relation[]" placeholder="Relation"></td>
                                        <td><input type="text" class="form-control case-field lr_dependency" name="lr_dependency[]" placeholder="Dependency On Deceased"></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-success addlrs"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Income status</h4>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="income_source" style="color:black">Source of Income and level of income - copy of IT return &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->income_source) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->income_source) ? $reportdata->income_source : ""; ?>" id="income_source" name="income_source" placeholder="Source of Income and level of income - copy of IT return">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="business_run_without_him" style="color:black">If the deceased was businessman will the business run without him &nbsp;<span style="color:red">*</span></label>
                        <select class="form-control case-field" id="business_run_without_him" name="business_run_without_him" required <?php echo isset($reportdata->business_run_without_him) ? 'disabled' : ''; ?>>
                            <option value="">Select</option>
                            <option value="Yes" <?php echo ($reportdata->business_run_without_him ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($reportdata->business_run_without_him ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="NA" <?php echo ($reportdata->business_run_without_him ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="employment_legal_heir" style="color:black">Status of employment of legal heir &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->employment_legal_heir) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->employment_legal_heir) ? $reportdata->employment_legal_heir : ""; ?>" id="employment_legal_heir" name="employment_legal_heir" placeholder="Status of employment of legal heir">

                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pension_amount" style="color:black">Will the family get pension and amount &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pension_amount) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->pension_amount) ? $reportdata->pension_amount : ""; ?>" id="pension_amount" name="pension_amount" placeholder="Will the family get pension and amount">

                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="empleyment_availability" style="color:black">Documents of employment available &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->empleyment_availability) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->empleyment_availability) ? $reportdata->empleyment_availability : ""; ?>" id="empleyment_availability" name="empleyment_availability" placeholder="Documents of employment available">

                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="widow_dependency" style="color:black">Was the widow / widower dependent &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->widow_dependency) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->widow_dependency) ? $reportdata->widow_dependency : ""; ?>" id="widow_dependency" name="widow_dependency" placeholder="Was the widow / widower dependent">
                    </div>
                </div>
            </div>

            <h4 class="pl-2" style="color:black;font-size: 14px;background-color:#f3f3f3;">Details of Death / Injury circumtances</h4>
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="death_reason" style="color:black">Did the person die and was the death instant? &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->death_reason) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->death_reason) ? $reportdata->income_source : ""; ?>" id="death_reason" name="death_reason" placeholder="did the person die and was the death instant">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="treatment" style="color:black">If no after how many days and in which hospital / treated in which hospital &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->treatment) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->treatment) ? $reportdata->treatment : ""; ?>" id="treatment" name="treatment" placeholder="If no after how many days and in which hospital / treated in which hospital">
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="motor_accident" style="color:black">Was the motor accident the proximate cause of death / injury &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->motor_accident) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->motor_accident) ? $reportdata->motor_accident : ""; ?>" id="motor_accident" name="motor_accident" placeholder="Was the motor accident the proximate cause of death / injury">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="hospital_file" style="color:black">Hospital file reference / MLC No. &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->hospital_file) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->hospital_file) ? $reportdata->hospital_file : ""; ?>" id="hospital_file" name="hospital_file" placeholder="Hospital file reference / MLC No.">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="injury_recommandations" style="color:black">If injury only, discharged after how many days and with what recommandations &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->injury_recommandations) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->injury_recommandations) ? $reportdata->injury_recommandations : ""; ?>" id="injury_recommandations" name="injury_recommandations" placeholder="If injury only, discharged after how many days and with what recommandations">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="hospital_records" style="color:black">Has the hospital records been verified &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->hospital_records) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->hospital_records) ? $reportdata->hospital_records : ""; ?>" id="hospital_records" name="hospital_records" placeholder="Has the hospital records been verified">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="approximate_expense" style="color:black">Approximate medical expense &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->approximate_expense) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->approximate_expense) ? $reportdata->approximate_expense : ""; ?>" id="approximate_expense" name="approximate_expense" placeholder="Approximate medical expense">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pmr_attached" style="color:black">Post Mortem report attached &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pmr_attached) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->pmr_attached) ? $reportdata->pmr_attached : ""; ?>" id="pmr_attached" name="pmr_attached" placeholder="Post Mortem report attached">
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="intoxicant_history" style="color:black">History of Intoxicant consumption leading to above accident &nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->intoxicant_history) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->intoxicant_history) ? $reportdata->intoxicant_history : ""; ?>" id="intoxicant_history" name="intoxicant_history" placeholder="History of Intoxicant consumption leading to above accident">
                    </div>
                </div>
            </div>
            <!-- Trigger Button -->
            <div style="display: flex; justify-content: space-between; align-items: center; color:black;font-size: 14px;background-color:#f3f3f3;margin: 0">
                <h4 class="pl-2" style="color:black;font-size: 14px;margin: 0">Brief report</h4>
                <button type="button" class="btn case_btn addstatement" data-toggle="modal" data-target="#specialInfoModal">Add statement</button>
            </div>
            <!-- List of Statements -->
            <div id="statementsList" class="mt-3"></div>


            <!-- Special Information Modal -->
            <div class="modal fade" id="specialInfoModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg custom-modal-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Special Information / Brief Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- User Input for Heading -->
                            <div class="mb-3">
                                <label for="specialInfoHeading" class="form-label">Enter Heading:</label>
                                <input type="text" class="form-control" id="specialInfoHeading" placeholder="Enter heading here...">
                            </div>
                            <!-- Summernote Editor -->
                            <div class="mb-3">
                                <label for="specialInfoEditor" class="form-label">Write your statement:</label>
                                <textarea class="form-control" id="specialInfoEditor"></textarea>
                            </div>
                            <!-- File Upload Section -->
                            <div class="mb-3">
                                <label class="form-label">Attach a photo:</label>
                                <input type="file" id="fileUpload" accept="image/*" multiple style="display: none;">

                                <!-- Upload Images Button -->
                                <a class="btn case_btn open-modal" data-title="Statement" data-toggle="modal" type="button"
                                    href="javascript:void(0)" id="uploadpropTrigger">Upload Images
                                </a>

                                <!-- Display Selected File Names -->
                                <p id="selectedFiles" style="margin-top: 10px; font-size: 14px; color: #555;"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary case_btn" data-dismiss="modal" style="background-color:#CA571F;">Close</button>
                            <button type="button" class="btn btn-secondary case_btn" id="saveSpecialInfo">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="annexureContainer" class="mt-2">
                <div class="row annexure-row">
                    <div class="col-xl-12 col-md-12">
                        <div class="form-group">
                            <label style="color:black">Annexure <span class="annexureLabel">1</span></label>
                            <div class="d-flex">
                                <!-- Annexure Input -->
                                <input type="text" class="form-control case-field annexure-input"
                                    name="annexures[]" placeholder="">

                                <!-- Page Number Input -->
                                <input type="number" class="form-control ml-2 page-number-input  case-field"
                                    name="page_numbers[]" placeholder="Page No." style="width: 100px;">

                                <!-- Yes/No Dropdown -->
                                <select class="form-control ml-2 annexure-yes-no  case-field"
                                    name="annexure_yes_no[]" style="width: 80px;">
                                    <option disabled>Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                                <!-- Remove Button -->
                                <button type="button" class="btn btn-success ml-2 addAnnexure"
                                    style="width: 100px; height:39px;">
                                    <i class="fa fa-plus" style="font-size: 15px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="conclusion" style="color:black">Conclusion</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->conclusion) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->conclusion) ? $reportdata->conclusion : ""; ?>" id="conclusion" name="conclusion" placeholder="Conclusion">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="loss_calculation" style="color:black">Loss Calculation</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->loss_calculation) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->loss_calculation) ? $reportdata->loss_calculation : ""; ?>" id="loss_calculation" name="loss_calculation" placeholder="Loss Calculation">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="disclaimer" style="color:black">Disclaimer</label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->disclaimer) ? "disabled" : "enable"; ?> value="<?php echo isset($reportdata->disclaimer) ? $reportdata->disclaimer : ""; ?>" id="disclaimer" name="disclaimer" placeholder="Disclaimer">
                    </div>
                </div>
            </div>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button" id="ebdeathcase_submit">
            </div>
        </div>
    </form>
</div>
<div id="selectebdeathimages" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row gutter-20">
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">
                                    <?php $index = 1; ?>
                                    <?php foreach ($caseimages as $index => $image) { ?>
                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 mb-3" style="display:flex">
                                            <input type="checkbox" name="image[]" value="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="image-checkbox" id="checkbox_<?php echo $index; ?>" style="align-self:baseline" />
                                            <div class="card border-bottom" style="width:1000%;">
                                                <a href="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" data-fancybox="images">
                                                    <div class="card-img-container">
                                                        <img src="<?php echo base_url('uploads/' . $aid . '/images/' . $image); ?>" class="card-img-top" alt="Image <?php echo $index; ?>" style="width:125px;height:100px;">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php $index++; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" target="_blank" class="btn btn-success" id="savebdeathimages">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    function applyEditMode() {
        let buttonText = $("#ebdeathcase_submit").val();
        if (buttonText === "Edit") {
            $(".statementcard").css("background-color", "#e9ecef"); // Grey background
            $(".edit-statement, .delete-statement, .addstatement, .addAnnexure, .removeAnnexure, .addlrs,.removelrs").prop("disabled", true);

            // Disable Fancybox and reduce opacity
            $(".view-img").removeAttr("data-fancybox").addClass("disabled-img").css("opacity", "0.5");
        } else {
            resetCardColors();
        }
    }

    function resetCardColors() {
        $(".statementcard").css("background-color", ""); // Reset background color
        $(".edit-statement, .delete-statement, .addstatement, .addAnnexure, .removeAnnexure,.addlrs,.removelrs").prop("disabled", false);

        // Restore Fancybox and reset opacity
        $(".view-img").each(function() {
            let index = $(this).closest(".statementcard").data("index");
            $(this).attr("data-fancybox", `gallery-${index}`).removeClass("disabled-img").css("opacity", "1");
        });
    }
    $(document).ready(function() {

        /* ------------------------------------------------------------------------- *  
         * ADD AGE OF LRS
         * ------------------------------------------------------------------------- */

        // Function to add a new LR entry row
        $(document).on("click", ".addlrs", function() {
            let newRow = `
            <tr class="lr-entry">
                <td><input type="text" class="form-control case-field lr_name" name="lr_name[]" placeholder="Name"></td>
                <td><input type="text" class="form-control case-field lr_age" name="lr_age[]" placeholder="Age"></td>
                <td><input type="text" class="form-control case-field lr_sex" name="lr_sex[]" placeholder="Sex"></td>
                <td><input type="text" class="form-control case-field lr_relation" name="lr_relation[]" placeholder="Relation"></td>
                <td><input type="text" class="form-control case-field lr_dependency" name="lr_dependency[]" placeholder="Dependency On Deceased"></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-danger removelrs"><i class="fa fa-minus"></i></button>
                </td>
            </tr>
            `;

            $("#all_lrs").append(newRow);
        });

        $(document).on("click", ".removelrs", function() {
            $(this).closest("tr").remove();
        });

        var lrs = <?php echo json_encode(isset($reportdata->lrs) ? $reportdata->lrs : 'NA'); ?>;
        console.log(lrs);

        if (lrs !== 'NA' && lrs !== null) {
            disableFields = true;
            populatelrs(lrs, disableFields);
        }

        function populatelrs(data, disableFields) {
            const lrsList = $('#all_lrs');
            lrsList.empty();

            const lrsArray = Array.isArray(data) ? data : [data];

            lrsArray.forEach((item, index) => {
                let newlrs = `
            <tr class="lr-entry">
                <td><input type="text" class="form-control case-field lr_name" name="lr_name[]" placeholder="Name" value="${item.name || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field lr_age" name="lr_age[]" placeholder="Age" value="${item.age || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field lr_sex" name="lr_sex[]" placeholder="Sex" value="${item.sex || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field lr_relation" name="lr_relation[]" placeholder="Relation" value="${item.relation || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td><input type="text" class="form-control case-field lr_dependency" name="lr_dependency[]" placeholder="Dependency On Deceased" value="${item.dependency || ''}" ${disableFields ? 'disabled' : ''}></td>
                <td style="text-align: center;">
                    ${index === 0 ? `<button type="button" class="btn btn-success addlrs"><i class="fa fa-plus"></i></button>` : ''}
                    ${index !== 0 ? `<button type="button" class="btn btn-warning removelrs"><i class="fa fa-times"></i></button>` : ''}
                </td>
            </tr>
            `;
                lrsList.append(newlrs);
            });
        }

        /* ------------------------------------------------------------------------- *  
         * ADD ANNEXURE (KAJAL)
         * ------------------------------------------------------------------------- */
        // Function to add a new annexure
        $(document).on("click", ".addAnnexure", function() {
            var container = $("#annexureContainer");
            var annexureCount = $(".annexure-row").length + 1; // Count existing annexures

            var newRow = ` 
            <div class="row annexure-row">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label style="color:black">Annexure <span class="annexureLabel">${annexureCount}</span></label>
                        <div class="d-flex">
                            <!-- Annexure Input -->
                            <input type="text" class="form-control case-field annexure-input" 
                                name="annexures[]" placeholder="" >
                            
                            <!-- Page Number Input -->
                            <input type="number" class="form-control ml-2 page-number-input  case-field" 
                                name="page_numbers[]" placeholder="Page No." style="width: 100px;">
                            
                            <!-- Yes/No Dropdown -->
                            <select class="form-control ml-2 annexure-yes-no  case-field" 
                                name="annexure_yes_no[]" style="width: 80px;">
                                <option disabled>Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                            <!-- Remove Button -->
                            <div class="col-lg-1" style="text-align:end; align-self:end">
                                <button type="button" class="btn btn-warning  removeAnnexure" 
                                    style="width: 100px; height:39px;">
                                    <i class="fa fa-times" style="font-size: 15px;"></i>
                                </button>
                             </div>
                        </div>
                    </div>
                </div>
            </div>`;

            container.append(newRow);
        });

        // Function to remove an annexure
        $(document).on("click", ".removeAnnexure", function() {
            $(this).closest(".annexure-row").remove();
            updateAnnexureNumbers();
        });

        // Update annexure numbering dynamically
        function updateAnnexureNumbers() {
            $(".annexure-row").each(function(index) {
                $(this).find(".annexureLabel").text(index + 1);
            });
        }

        // Fetch annexure data from PHP
        var annexures = <?php echo json_encode(isset($reportdata->annexures) ? $reportdata->annexures : 'NA'); ?>;
        console.log(annexures);

        if (annexures !== 'NA' && annexures !== null) {
            disableFields = true; // Disable fields if data exists
            populateAnnexures(annexures, disableFields);
        }

        // Function to populate annexures from JSON data
        function populateAnnexures(data, disableFields) {
            const annexuresList = $('#annexureContainer');
            annexuresList.empty(); // Clear existing content

            // Convert array of strings into array of objects if necessary
            const annexureArray = Array.isArray(data) ?
                data.map(item => (typeof item === "object" ? item : {
                    annexures: item,
                    page_number: '', // Default empty page number
                    yes_no: '' // Default empty for "Select"
                })) : [{
                    annexures: data,
                    page_number: '',
                    yes_no: ''
                }];

            annexureArray.forEach((annexure, index) => {
                let newAnnexureRow = `
                <div class="row annexure-row">
                    <div class="col-xl-12 col-md-12">
                        <div class="form-group">
                            <label style="color:black">Annexure <span class="annexureLabel">${index + 1}</span></label>
                            <div class="d-flex">
                                <!-- Annexure Input -->
                                <input type="text" class="form-control case-field annexure-input" 
                                    value="${annexure.text || ''}" name="annexures[]" 
                                    placeholder="" ${disableFields ? 'disabled' : ''}>

                                <!-- Page Number Input -->
                                <input type="number" class="form-control ml-2 page-number-input case-field" 
                                    name="page_numbers[]" value="${annexure.page_number || ''}" 
                                    placeholder="Page No." style="width: 100px;" ${disableFields ? 'disabled' : ''}>

                                <!-- Yes/No Dropdown -->
                                <select class="form-control ml-2 annexure-yes-no case-field" name="annexure_yes_no[]" 
                                    style="width: 80px;" ${disableFields ? 'disabled' : ''}>
                                    <option value="" ${!annexure.yes_no ? 'selected' : ''}>Select</option>
                                    <option value="Yes" ${annexure.yes_no === 'Yes' ? 'selected' : ''}>Yes</option>
                                    <option value="No" ${annexure.yes_no === 'No' ? 'selected' : ''}>No</option>
                                </select>

                                <!-- Action Buttons -->
                                <div class="col-lg-1" style="text-align:end; align-self:end">
                                    ${index === 0 ? 
                                        '<button type="button" class="btn btn-success addAnnexure" style="width:100%;height:39px;"><i class="fa fa-plus" style="font-size: 15px;"></i></button>' : 
                                        '<button type="button" class="btn btn-warning removeAnnexure" style="width:100%;height:39px;"><i class="fa fa-times" style="font-size: 15px;"></i></button>'}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                annexuresList.append(newAnnexureRow);
            });
        }


        /* ------------------------------------------------------------------------- *  
         * ADD STATEMENT 
         * ------------------------------------------------------------------------- */

        var statements = <?php echo json_encode(isset($reportdata->statements) ? $reportdata->statements : 'NA'); ?>;
        console.log(statements);

        if (statements !== 'NA' && statements !== null) {
            disableFields = true; // Disable fields if data exists
            populatestatements(statements, disableFields);
        }

        function populatestatements(data, disableFields) {
            const statementsList = $('#statementsList');
            statementsList.empty();

            // Ensure data is an array
            const statementsArray = Array.isArray(data) ? data : [data];

            statementsArray.forEach((statement, index) => {
                let imagesHtml = "";
                if (statement.images && statement.images.length > 0) {
                    statement.images.forEach((imgSrc) => {
                        imagesHtml += `<a href="${imgSrc}" class="view-img" data-fancybox="gallery-${index}" data-caption="${statement.heading || ''}">
                                      <img src="${imgSrc}" class="img-thumbnail small-img" 
                                      style="width: 50px; height: 50px; object-fit: cover; margin-left: 5px;">
                                   </a>`;
                    });
                }

                let jsonData = JSON.stringify(statement);
                let newStatement = `
                <div class="statementcard card mt-2 p-2 shadow-sm position-relative" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3">
                            <button class="btn btn-sm text-white edit-statement px-2 py-1" data-index="${index}" 
                                style="background-color:#2BB3C0;">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger delete-statement ml-2 px-2 py-1"  data-index="${index}">
                                Delete
                            </button>
                        </div>
                        <div class="d-flex gap-2">${imagesHtml}</div> <!-- Images displayed here -->
                    </div>
                    <input type="hidden" name="statementData[]" value='${jsonData}'>
                    <p class="fw-bold mb-0"><b>${statement.heading || ''} </b></p>
                    <p class="statement-text">${statement.statement || ''}</p>
                </div>
                `;

                statementsList.append(newStatement);
            });

            // Enable drag & drop sorting
            statementsList.sortable({
                placeholder: "sortable-placeholder",
                update: function(event, ui) {
                    updateStatementOrder();
                }
            }).disableSelection();
        }

        // Function to update order after sorting
        function updateStatementOrder() {
            let updatedOrder = [];
            $('.statementcard').each(function(index) {
                let data = JSON.parse($(this).find('input[name="statementData[]"]').val());
                updatedOrder.push(data);
            });
            console.log("Updated Order:", updatedOrder);
            // You can send this order to the server via AJAX if needed
        }


        $(document).off('click', '.delete-statement').on('click', '.delete-statement', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index');

            Swal.fire({
                title: "Are you sure?",
                text: "This statement will be removed!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`div[data-index="${index}"]`).remove();
                    Swal.fire("Deleted!", "The statement has been removed.", "success");
                }
            });
        });

        // Handle Edit Button Click
        $(document).off('click', '.edit-statement').on('click', '.edit-statement', function(event) {
            event.stopPropagation();
            event.preventDefault();

            let index = $(this).data('index'); // Get index of the clicked statement
            let statementData = $(`div[data-index="${index}"] input[name="statementData[]"]`).val();
            console.log(statementData);

            if (statementData) {
                let statement = JSON.parse(statementData);
                // Ensure the heading and statement are assigned correctly
                let headingValue = statement.heading ? statement.heading : '';
                let statementValue = statement.statement ? statement.statement : '';

                $('#specialInfoHeading').val(headingValue);
                $('#specialInfoEditor').val(statementValue);

                // Store index in modal for tracking edits
                $('#specialInfoModal').data('editIndex', index);

                // Clear previous images and populate new ones with delete icons
                $('#selectedFiles').html('');
                if (statement.images && statement.images.length > 0) {
                    statement.images.forEach((imgSrc, imgIndex) => {
                        $('#selectedFiles').append(`
                                <div class="position-relative d-inline-block">
                                    <img src="${imgSrc}" class="img-thumbnail"
                                        style="width: 100px; height: 100px; object-fit: cover; margin: 5px;">
                                    <button class="btn btn-sm btn-danger delete-image-modal" data-img-index="${imgIndex}"
                                            style="background-color: transparent;position: absolute;top: 7px;right: 7px;border-radius: 50%;padding: 2px 5px;font-size: 19px;border:none;">
                                        X
                                    </button>
                                </div>
                            `);
                    });
                }

                // Show modal
                $('#specialInfoModal').modal('show');
            }
        });

        $(document).off('click', '.delete-image-modal').on('click', '.delete-image-modal', function() {
            $(this).parent().remove(); // Remove the image container when delete icon is clicked
        });


        // Handle Save Button Click
        $('#saveSpecialInfo').on('click', function() {
            let heading = $('#specialInfoHeading').val().trim();
            let statement = $('#specialInfoEditor').val().trim();
            let imagesHtml = '';
            let imagesArray = [];

            // Validation: Ensure heading and statement are not empty
            if (heading === "" || statement === "") {
                Swal.fire("Incomplete Information", "Please enter a heading and statement before saving.", "warning");
                return;
            }

            // Extract images
            $('#selectedFiles img').each(function() {
                let imgSrc = $(this).attr('src');
                imagesHtml += ` <a href="${imgSrc}" class="view-img" >
                                      <img src="${imgSrc}" class="img-thumbnail small-img" 
                                      style="width: 50px; height: 50px; object-fit: cover; margin-left: 5px;">
                                   </a> `;

                imagesArray.push(imgSrc);
            });

            // Create JSON object
            let statementData = {
                heading: heading,
                statement: statement,
                images: imagesArray
            };
            let jsonData = JSON.stringify(statementData);

            // Check if editing an existing statement
            let editIndex = $('#specialInfoModal').data('editIndex');
            if (editIndex !== undefined) {
                let card = $(`.card[data-index="${editIndex}"]`);
                card.find('input[name="statementData[]"]').val(jsonData);

                // Update heading, statement, and images
                card.find('.fw-bold').html(`<b>${heading}</b>`);
                card.find('.statement-text').text(statement);
                card.find('.d-flex.gap-2').html(imagesHtml);
            } else {
                // Create a new statement card
                let newIndex = $('.statementcard').length;
                let newStatement = `
                <div class="statementcard card mt-2 p-2 shadow-sm position-relative" data-index="${newIndex}">
                   
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3">
                            <button class="btn btn-sm text-white edit-statement px-2 py-1" data-index="${newIndex}" 
                                style="background-color:#2BB3C0;">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger delete-statement ml-2 px-2 py-1"  data-index="${newIndex}">
                                Delete
                            </button>
                        </div>
                        <div class="d-flex gap-2">${imagesHtml}</div> <!-- Images displayed here -->
                    </div>
                    <input type="hidden" name="statementData[]" value='${jsonData}'>
                    <p class="fw-bold"><b>${heading}</b></p>
                    <p class="statement-text mt-2">${statement}</p>
                </div>
                `;

                // Append the new statement
                $('#statementsList').append(newStatement);
            }

            // Clear input fields and close modal
            $('#specialInfoHeading').val('');
            $('#specialInfoEditor').val('');
            $('#selectedFiles').html('');
            $('#specialInfoModal').modal('hide');
            $('#selectebdeathimages').modal('hide');
            $('#select_images').modal('hide');
        });

        $('#savebdeathimages').on('click', function() {
            let selectedImages = [];

            // Get all checked checkboxes
            $('.image-checkbox:checked').each(function() {
                selectedImages.push($(this).val()); // Store image URL
            });

            if (selectedImages.length === 0) {
                Swal.fire("No images selected!", "Please select at least one image.", "warning");
                return;
            }

            // Generate image previews
            let imageHtml = '';
            selectedImages.forEach(function(src) {
                imageHtml += `<img src="${src}" class="selected-image-preview" style="width:80px; height:80px; margin-right:5px; border-radius:5px;">`;
            });

            // Append to `#selectedFiles`
            $('#selectedFiles').html(imageHtml);

            // Close the current modal
            $('#selectebdeathimages').modal('hide');
            $('#select_images').modal('hide');
        });


        // Open modal on button click
        $('#uploadpropTrigger').on('click', function(event) {
            event.stopPropagation(); // Prevent bubbling up
            event.preventDefault(); // Prevent any default action
            console.log('Opening Image Modal');

            // Hide other modals before opening the correct one
            $('#select_images').modal('hide');
            $('#selectebdeathimages').modal('show');
        });


        $('#selectebdeathimages').on('show.bs.modal', function() {
            // Add dim effect to the parent modal's content
            $('#specialInfoModal .modal-content').addClass('dimmed');
        });

        // When the inner modal is hidden:
        $('#selectebdeathimages').on('hidden.bs.modal', function() {
            // Remove dim effect from the parent modal's content
            $('#specialInfoModal .modal-content').removeClass('dimmed');
        });
        
        $('#specialInfoModal').on('hidden.bs.modal', function() {
            $('#select_images').modal('hide');
            $('#selectebdeathimages').modal('hide');
        });


        applyEditMode();

        /* ------------------------------------------------------------------------- *  
         * SUBMIT EBDEATH CASE FORM
         * ------------------------------------------------------------------------- */

        $("#ebdeathcase_submit").click(function() {
            var buttonText = $(this).val();
            if (buttonText === "Submit") {
                $('#ebdeathcase').trigger('submit');
            } else if (buttonText === "Edit") {
                $(".case-field").prop("disabled", false);
                $(".edit-statement").prop("disabled", false);
                $(".delete-statement").prop("disabled", false);
                $(".addstatement").prop("disabled", false);
                $(".addAnnexure").prop("disabled", false);
                $(".removeAnnexure").prop("disabled", false);
                $(this).val("Update");
                resetCardColors(); // Restore original colors
            } else if (buttonText === "Update") {
                $('#ebdeathcase').trigger('submit');
            }
        });

        $("#ebdeathcase").validate({
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
                policyNumber: {
                    required: true,
                },
                policyissuing_office: {
                    required: true,
                },
                insured_name: {
                    required: true,
                },
                sum_insured: {
                    required: true,
                },
                detailed_incidence: {
                    required: true,
                },
                policereport_number: {
                    required: true,
                },
                claimant_name: {
                    required: true,
                },
                claimant_relation: {
                    required: true,
                },
                injured_name: {
                    required: true,
                },
                injured_address: {
                    required: true,
                },
                father_name: {
                    required: true,
                },
                deceased_verification: {
                    required: true,
                },
                nominee_name: {
                    required: true,
                },
                nominee_dependent: {
                    required: true,
                },
                remarried: {
                    required: true,
                },
                child_legal_heirs: {
                    required: true,
                },
                lrs_name: {
                    required: true,
                },
                lrs_age: {
                    required: true,
                },
                income_source: {
                    required: true,
                },
                business_run_without_him: {
                    required: true,
                },
                employment_legal_heir: {
                    required: true,
                },
                pension_amount: {
                    required: true,
                },
                empleyment_availability: {
                    required: true,
                },
                death_reason: {
                    required: true,
                },
                treatment: {
                    required: true,
                },
                widow_dependency: {
                    required: true,
                },
                hospital_file: {
                    required: true,
                },
                injury_recommandations: {
                    required: true,
                },
                hospital_records: {
                    required: true,
                },
                approximate_expense: {
                    required: true,
                },
                pmr_attached: {
                    required: true,
                },
                intoxicant_history: {
                    required: true,
                },
            },

            messages: {
                policyNumber: "This field is required.",
                policyissuing_office: "This field is required.",
                insured_name: "This field is required.",
                sum_insured: "This field is required.",
                detailed_incidence: "This field is required.",
                policereport_number: "This field is required.",
                claimant_name: "This field is required.",
                claimant_relation: "This field is required.",
                injured_name: "This field is required.",
                injured_address: "This field is required.",
                father_name: "This field is required.",
                deceased_verification: "This field is required.",
                nominee_name: "This field is required.",
                nominee_dependent: "This field is required.",
                remarried: "This field is required.",
                child_legal_heirs: "This field is required.",
                lrs_name: "This field is required.",
                lrs_age: "This field is required.",
                income_source: "This field is required.",
                business_run_without_him: "This field is required.",
                employment_legal_heir: "This field is required.",
                pension_amount: "This field is required.",
                empleyment_availability: "This field is required.",
                death_reason: "This field is required.",
                treatment: "This field is required.",
                widow_dependency: "This field is required.",
                hospital_file: "This field is required.",
                injury_recommandations: "This field is required.",
                hospital_records: "This field is required.",
                approximate_expense: "This field is required.",
                pmr_attached: "This field is required.",
                intoxicant_history: "This field is required."
            },

            submitHandler: function(form) {
                event.preventDefault(); // Prevent default button action

                // Create FormData object
                var formData = new FormData(form);

                // Append additional data
                var aid = "<?php echo $aid; ?>";
                formData.append('aid', aid);

                $("#all_lrs .lr-entry").each(function(index, element) {
                    let lr_name = $(element).find(".lr_name").val();
                    let lr_age = $(element).find(".lr_age").val();
                    let lr_sex = $(element).find(".lr_sex").val();
                    let lr_relation = $(element).find(".lr_relation").val();
                    let lr_dependency = $(element).find(".lr_dependency").val();

                    formData.append(`lrs[${index}][name]`, lr_name);
                    formData.append(`lrs[${index}][age]`, lr_age);
                    formData.append(`lrs[${index}][sex]`, lr_sex);
                    formData.append(`lrs[${index}][relation]`, lr_relation);
                    formData.append(`lrs[${index}][dependency]`, lr_dependency);
                });

                $("#statementsList .card").each(function(index, element) {
                    let statementData = $(element).find("input[name='statementData[]']").val();
                    let heading = $(element).find("p.fw-bold b").text().replace(":", "").trim();
                    let statement = $(element).find(".statement-text").text().trim();

                    // Extract images
                    let images = [];
                    $(element).find("img").each(function(imgIndex, imgElement) {
                        let imageSrc = $(imgElement).attr("src");
                        if (imageSrc) {
                            images.push(imageSrc);
                        }
                    });
                    formData.append(`statements[${index}][heading]`, heading);
                    formData.append(`statements[${index}][statement]`, statement);

                    // Append images if available
                    images.forEach((imageSrc, imgIndex) => {
                        formData.append(`statements[${index}][images][${imgIndex}]`, imageSrc);
                    });
                });

                // Append annexure data correctly
                $("#annexureContainer .annexure-row").each(function(index, element) {
                    let annexureText = $(element).find(".annexure-input").val();
                    let pageNumber = $(element).find(".page-number-input").val();
                    let yesNoSelection = $(element).find(".annexure-yes-no").val();

                    formData.append(`annexures[${index}][text]`, annexureText);
                    formData.append(`annexures[${index}][page_number]`, pageNumber);
                    formData.append(`annexures[${index}][yes_no]`, yesNoSelection);
                });



                // AJAX request to updatecasedata endpoint
                $.ajax({
                    url: "<?php echo base_url('updateebdeathcasedata') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false, // Important: Prevent jQuery from converting FormData into a string
                    contentType: false, // Important: Prevent jQuery from setting content-type header
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            $('#ebdeathcase_submit').val("Edit");
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

        // Delete Statement
        $("#statementsList").on("click", ".deleteStatement", function() {
            $(this).closest(".card").remove();
        });

        // Prevent clicking disabled images
        $(document).on("click", ".disabled-img", function(e) {
            e.preventDefault(); // Stop Fancybox from opening
        });

    });
</script>