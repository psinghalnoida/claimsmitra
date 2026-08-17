<div class="panel">
    <form id="motor_theft_case_form" method="post" enctype="multipart/form-data">
        <div class="panel-heading case_form_heading">
            <h3 class="panel-title">
                Case DATA
            </h3>
            <div class="dropdown">
                <div class="button d-flex justify-content-end">
                    <a href="<?php echo base_url('generatepdf/' . $aid . ''); ?>" target="_blank" class="btn case_btn">Generate Report</a>
                    <a class="btn case_btn open-modal" type="button" data-title="Report" data-toggle="modal" href="javascript:void(0)" id="report_images" style="padding-right: 5px; margin-right:8px;">Report Images <i class="fa fa-file"></i></a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="padding-top:0px; padding-bottom: 0px;">
            <div class="row my-3">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="insured_name" style="color:black">Insured Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->insured_name) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->insured_name) ? $reportdata->insured_name : ""; ?>" id="insured_name" name="insured_name" placeholder="Insured Name" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="claim_number" style="color:black">Claim Number <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->claim_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->claim_number) ? $reportdata->claim_number : ""; ?>" id="claim_number" name="claim_number" placeholder="Claim Number" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="endorsement_details" style="color:black">Endorsement details, if any: <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->endorsement_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->endorsement_details) ? $reportdata->endorsement_details : ""; ?>" id="policyNumber" name="endorsement_details" placeholder="Endorsement details" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="break_in_insurance" style="color:black">Break-in insurance details, if any: <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->break_in_insurance) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->break_in_insurance) ? $reportdata->break_in_insurance : ""; ?>" id="break_in_insurance" name="break_in_insurance" placeholder="Break-in insurance details" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pre_inspection_details" style="color:black">Pre inspection details, if any: <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pre_inspection_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->pre_inspection_details) ? $reportdata->pre_inspection_details : ""; ?>" id="pre_inspection_details" name="pre_inspection_details" placeholder="Pre inspection details" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="chasis_number" style="color:black">Chasis number<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->chasis_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->chasis_number) ? $reportdata->chasis_number : ""; ?>" id="chasis_number" name="chasis_number" placeholder="Chasis number" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="engine_number" style="color:black">Engine number <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->engine_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->engine_number) ? $reportdata->engine_number : ""; ?>" id="engine_number" name="engine_number" placeholder="Engine number" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="make_modal" style="color:black">Make/Model <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" id="make_modal" <?php echo isset($reportdata->make_modal) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->make_modal) ? $reportdata->make_modal : ""; ?>" id="make_modal" name="make_modal" placeholder="Make/Model" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="year_of_manufacture" style="color:black">Year of Manufacture <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->year_of_manufacture) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->year_of_manufacture) ? $reportdata->year_of_manufacture : ""; ?>" id="year_of_manufacture" name="year_of_manufacture" placeholder="Year of Manufacture" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="colour" style="color:black">Colour <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->colour) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->colour) ? $reportdata->colour : ""; ?>" id="colour" name="colour" placeholder="Colour" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="seatig_capacity" style="color:black">Seating Capacity / GVW <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" id="seatig_capacity" <?php echo isset($reportdata->seatig_capacity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->seatig_capacity) ? $reportdata->seatig_capacity : ""; ?>" id="seatig_capacity" name="seatig_capacity" placeholder="Seating Capacity / GVW" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="tax_paid_up_to" style="color:black">Tax Paid up to <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->tax_paid_up_to) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->tax_paid_up_to) ? $reportdata->tax_paid_up_to : ""; ?>" id="tax_paid_up_to" name="tax_paid_up_to" placeholder="Tax Paid up to" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="validity" style="color:black">Fitness Certificate Validity<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->validity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->validity) ? $reportdata->validity : ""; ?>" id="validity" name="validity" placeholder="Fitness Certificate Validity" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="hypothecation_details" style="color:black">Hypothecation details, if any:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->hypothecation_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->hypothecation_details) ? $reportdata->hypothecation_details : ""; ?>" id="hypothecation_details" name="hypothecation_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="rc_issuing_authority" style="color:black">RC Issuing authority <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->rc_issuing_authority) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->rc_issuing_authority) ? $reportdata->rc_issuing_authority : ""; ?>" id="rc_issuing_authority" name="rc_issuing_authority" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_number" style="color:black">Permit number <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_number) ? $reportdata->permit_number : ""; ?>" id="permit_number" name="permit_number" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_date_of_issue" style="color:black">Permit date of issue<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_date_of_issue) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_date_of_issue) ? $reportdata->permit_date_of_issue : ""; ?>" id="permit_date_of_issue" name="permit_date_of_issue" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_period_of_validity" style="color:black"> Permit Period of validity<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_period_of_validity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_period_of_validity) ? $reportdata->permit_period_of_validity : ""; ?>" id="permit_period_of_validity" name="permit_period_of_validity" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_type" style="color:black">Permit Type<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_type) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_type) ? $reportdata->permit_type : ""; ?>" id="permit_type" name="permit_type" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_area" style="color:black">Permit area<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_area) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_area) ? $reportdata->permit_area : ""; ?>" id="permit_area" name="permit_area" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_number" style="color:black">Permit authorization number<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_authorization_number) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_number) ? $reportdata->permit_authorization_number : ""; ?>" id="permit_authorization_number" name="permit_authorization_number" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_date_of_issue" style="color:black">Permit authorization date of issue<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_authorization_date_of_issue) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_date_of_issue) ? $reportdata->permit_authorization_date_of_issue : ""; ?>" id="permit_authorization_date_of_issue" name="permit_authorization_date_of_issue" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_period_of_validity" style="color:black">Permit authorization period of validity <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_authorization_period_of_validity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_period_of_validity) ? $reportdata->permit_authorization_period_of_validity : ""; ?>" id="permit_authorization_period_of_validity" name="permit_authorization_period_of_validity" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="permit_authorization_area" style="color:black">Permit authorization area<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->permit_authorization_area) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->permit_authorization_area) ? $reportdata->permit_authorization_area : ""; ?>" id="permit_authorization_area" name="permit_authorization_area" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="Whether_theft_details" style="color:black">Whether theft details are enclosed in the RC RTO record?(Y/N)<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->Whether_theft_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->Whether_theft_details) ? $reportdata->Whether_theft_details : ""; ?>" id="Whether_theft_details" name="Whether_theft_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="last_vehicle_user" style="color:black">Name of Last user of vehicle <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->last_vehicle_user) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->last_vehicle_user) ? $reportdata->last_vehicle_user : ""; ?>" id="last_vehicle_user" name="last_vehicle_user" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="relationship_with_insured" style="color:black">Relationship with insured <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->relationship_with_insured) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->relationship_with_insured) ? $reportdata->relationship_with_insured : ""; ?>" id="relationship_with_insured" name="relationship_with_insured" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="occupation" style="color:black">Occupation<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->occupation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->occupation) ? $reportdata->occupation : ""; ?>" id="occupation" name="occupation" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="address" style="color:black">Address<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->address) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->address) ? $reportdata->address : ""; ?>" id="address" name="address" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="financing_type" style="color:black">Financing type -Lease/HPA etc<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->financing_type) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->financing_type) ? $reportdata->financing_type : ""; ?>" id="financing_type" name="financing_type" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_loan_advanced" style="color:black">Type of loan Advanced - Pvt or Commercial:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->type_of_loan_advanced) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->type_of_loan_advanced) ? $reportdata->type_of_loan_advanced : ""; ?>" id="type_of_loan_advanced" name="type_of_loan_advanced" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="details_of_Loan_repayment" style="color:black">Details of Loan repayment(latest):<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->details_of_Loan_repayment) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_Loan_repayment) ? $reportdata->details_of_Loan_repayment : ""; ?>" id="details_of_Loan_repayment" name="details_of_Loan_repayment" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="outstanding_amount" style="color:black">Outstanding Amount<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->outstanding_amount) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->outstanding_amount) ? $reportdata->outstanding_amount : ""; ?>" id="outstanding_amount" name="outstanding_amount" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vehicle_was_seized" style="color:black">Whether vehicle was seized?<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->vehicle_was_seized) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->vehicle_was_seized) ? $reportdata->vehicle_was_seized : ""; ?>" id="vehicle_was_seized" name="vehicle_was_seized" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="original_key" style="color:black">Whether original key(s) retained by financier?<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->original_key) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->original_key) ? $reportdata->original_key : ""; ?>" id="original_key" name="original_key" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="any_irregulaity_noticed" style="color:black">Any irregulaity noticed in loan repayment?<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->any_irregulaity_noticed) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->any_irregulaity_noticed) ? $reportdata->any_irregulaity_noticed : ""; ?>" id="any_irregulaity_noticed" name="any_irregulaity_noticed" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="name_of_driver" style="color:black">Name of driver<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->name_of_driver) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->name_of_driver) ? $reportdata->name_of_driver : ""; ?>" id="name_of_driver" name="name_of_driver" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="driving_license_details" style="color:black">Driving License details with all previous DL particulars:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->driving_license_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->driving_license_details) ? $reportdata->driving_license_details : ""; ?>" id="driving_license_details" name="driving_license_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_issue" style="color:black">Date of issue:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->date_of_issue) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_of_issue) ? $reportdata->date_of_issue : ""; ?>" id="date_of_issue" name="date_of_issue" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="valid_up_to" style="color:black">Valid up to:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->valid_up_to) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->valid_up_to) ? $reportdata->valid_up_to : ""; ?>" id="valid_up_to" name="valid_up_to" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="type_of_vehicle" style="color:black">Type of vehicle authorized to drive:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->type_of_vehicle) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->type_of_vehicle) ? $reportdata->type_of_vehicle : ""; ?>" id="type_of_vehicle" name="type_of_vehicle" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="issue_authority" style="color:black">Issue Authority<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->issue_authority) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->issue_authority) ? $reportdata->issue_authority : ""; ?>" id="issue_authority" name="issue_authority" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="verification_status" style="color:black">Verification status<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->verification_status) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->verification_status) ? $reportdata->verification_status : ""; ?>" id="verification_status" name="verification_status" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="details_of_location" style="color:black">Details of location from where the vehicle was stolen / snatched<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->details_of_location) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_location) ? $reportdata->details_of_location : ""; ?>" id="details_of_location" name="details_of_location" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_intimation" style="color:black">Date of intimation of loss to insured by the driver/ last user<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->date_intimation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_intimation) ? $reportdata->date_intimation : ""; ?>" id="date_intimation" name="date_intimation" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="time_intimation" style="color:black"> Time of intimation of loss to insured by the driver/ last user<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->time_intimation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->time_intimation) ? $reportdata->time_intimation : ""; ?>" id="time_intimation" name="time_intimation" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="by_the_complainant" style="color:black">Date of intimation of loss to police by the complainant <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->by_the_complainant) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->by_the_complainant) ? $reportdata->by_the_complainant : ""; ?>" id="by_the_complainant" name="by_the_complainant" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="time_by_the_complainant" style="color:black">Time of intimation of loss to police by the complainant <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->time_by_the_complainant) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->time_by_the_complainant) ? $reportdata->time_by_the_complainant : ""; ?>" id="time_by_the_complainant" name="time_by_the_complainant" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="narration_of_incident" style="color:black">Brief narration of incident as per police investigation:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->narration_of_incident) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->narration_of_incident) ? $reportdata->narration_of_incident : ""; ?>" id="narration_of_incident" name="narration_of_incident" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="police_station" style="color:black">Police station and other independant checks:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->police_station) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->police_station) ? $reportdata->police_station : ""; ?>" id="police_station" name="police_station" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="verification_from_insured" style="color:black">Verification from insured /driver/last user: <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->verification_from_insured) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->verification_from_insured) ? $reportdata->verification_from_insured : ""; ?>" id="verification_from_insured" name="verification_from_insured" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="Verification_at_spot" style="color:black">Verification at spot along with photographs:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->Verification_at_spot) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->Verification_at_spot) ? $reportdata->Verification_at_spot : ""; ?>" id="Verification_at_spot" name="Verification_at_spot" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="locking_system" style="color:black">Type of locking system<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->locking_system) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->locking_system) ? $reportdata->locking_system : ""; ?>" id="locking_system" name="locking_system" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="possession_of_keys" style="color:black">Possession of Keys <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->possession_of_keys) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->possession_of_keys) ? $reportdata->possession_of_keys : ""; ?>" id="possession_of_keys" name="possession_of_keys" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="no_of_keys" style="color:black">No of keys<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->no_of_keys) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->no_of_keys) ? $reportdata->no_of_keys : ""; ?>" id="no_of_keys" name="no_of_keys" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="irregularity_noted" style="color:black">Comments on any irregularity noted:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->irregularity_noted) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->irregularity_noted) ? $reportdata->irregularity_noted : ""; ?>" id="irregularity_noted" name="irregularity_noted" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="ipc_section" style="color:black">IPC section mentioned in the FIR<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->ipc_section) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->ipc_section) ? $reportdata->ipc_section : ""; ?>" id="ipc_section" name="ipc_section" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="investigation_officer" style="color:black">Name of Investigation Officer<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->investigation_officer) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->investigation_officer) ? $reportdata->investigation_officer : ""; ?>" id="investigation_officer" name="investigation_officer" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="fir_lodged" style="color:black">Fir Lodged By:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->fir_lodged) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->fir_lodged) ? $reportdata->fir_lodged : ""; ?>" id="fir_lodged" name="fir_lodged" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="property_involved" style="color:black">Property Involved<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->property_involved) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->property_involved) ? $reportdata->property_involved : ""; ?>" id="property_involved" name="property_involved" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="police_final_report" style="color:black">Police final report(FR) No. and Date<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->police_final_report) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->police_final_report) ? $reportdata->police_final_report : ""; ?>" id="police_final_report" name="police_final_report" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="vis_a_vis" style="color:black">In Case of change in section(s) vis-a-vis the FIR reason to be provided:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->vis_a_vis) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->vis_a_vis) ? $reportdata->vis_a_vis : ""; ?>" id="vis_a_vis" name="vis_a_vis" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="comments_on_any_irregularity" style="color:black">Comments on any irregularity noted:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->comments_on_any_irregularity) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->comments_on_any_irregularity) ? $reportdata->comments_on_any_irregularity : ""; ?>" id="comments_on_any_irregularity" name="comments_on_any_irregularity" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="pcr_100_report_details" style="color:black">PCR 100 no. report details:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->pcr_100_report_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->pcr_100_report_details) ? $reportdata->pcr_100_report_details : ""; ?>" id="pcr_100_report_details" name="pcr_100_report_details" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="gd_entry_details" style="color:black">GD Entry details<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->gd_entry_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->gd_entry_details) ? $reportdata->gd_entry_details : ""; ?>" id="gd_entry_details" name="gd_entry_details" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="details_of_wireless" style="color:black">Details of wireless messaged flashed by police:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->details_of_wireless) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_wireless) ? $reportdata->details_of_wireless : ""; ?>" id="details_of_wireless" name="details_of_wireless" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="other_details" style="color:black">other details, it any:<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->other_details) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->other_details) ? $reportdata->other_details : ""; ?>" id="other_details" name="other_details" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="status_of_vehicle" style="color:black">Status of the vehicle as per report & date :(copy of report to be provided)<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->status_of_vehicle) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->status_of_vehicle) ? $reportdata->status_of_vehicle : ""; ?>" id="status_of_vehicle" name="status_of_vehicle" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="date_of_theft" style="color:black">Date of Theft :<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->date_of_theft) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->date_of_theft) ? $reportdata->date_of_theft : ""; ?>" id="date_of_theft" name="date_of_theft" placeholder="" required>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="fir_date" style="color:black">Date of FIR/ intimation to Police and delay, if any : <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->fir_date) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->fir_date) ? $reportdata->fir_date : ""; ?>"  name="fir_date" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="intimation_date" style="color:black">Date of Intimation to Insurer and delay, if any :<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->intimation_date) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->intimation_date) ? $reportdata->intimation_date : ""; ?>" id="intimation_date" name="intimation_date" placeholder="" required>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="comments" style="color:black">Comments (on the aspect of delay in intimating the Police & Insurer) : <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->comments) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->comments) ? $reportdata->comments : ""; ?>" id="comments" name="comments" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="details_with_proof_of_intimation" style="color:black">If yes, details with proof of intimation (postal receipt/postal order to be collected) :<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->details_with_proof_of_intimation) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_with_proof_of_intimation) ? $reportdata->details_with_proof_of_intimation : ""; ?>" id="details_with_proof_of_intimation" name="details_with_proof_of_intimation" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="details_of_ownership" style="color:black">Details of all transfer of ownership, if any, from the date of first purchase registration: <span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->details_of_ownership) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->details_of_ownership) ? $reportdata->details_of_ownership : ""; ?>" id="details_of_ownership" name="details_of_ownership" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="loaded_commercial_vehicles" style="color:black">For loaded commercial vehicles, verify the Marine policy details against the claim status, and review the Goods Receipt from the transporter and the invoice from the consignor.<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->loaded_commercial_vehicles) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->loaded_commercial_vehicles) ? $reportdata->loaded_commercial_vehicles : ""; ?>" id="loaded_commercial_vehicles" name="loaded_commercial_vehicles" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="intimated_to_rto" style="color:black">Whether intimated to RTO (Y/N):(Proof of intimation along with RTO acknowledgement to be collected)<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->intimated_to_rto) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->intimated_to_rto) ? $reportdata->intimated_to_rto : ""; ?>" id="intimated_to_rto" name="intimated_to_rto" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="last_user_mentioned" style="color:black">Verify if the driver or last user listed in the claim form or intimation matches the one mentioned in the FIR. If there is a discrepancy, obtain clarification.<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->last_user_mentioned) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->last_user_mentioned) ? $reportdata->last_user_mentioned : ""; ?>" id="last_user_mentioned" name="last_user_mentioned" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="whether_fr_accepted" style="color:black">Has the FR (Final Report) been accepted by the court? (Y/N) If yes, provide the date of acceptance. If not, has the court taken cognizance of the charge sheet? If so, include brief details of the order passed and the date.<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->whether_fr_accepted) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->whether_fr_accepted) ? $reportdata->whether_fr_accepted : ""; ?>" id="whether_fr_accepted" name="whether_fr_accepted" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="proof_of_existence" style="color:black">Proof of the vehicle's existence before the theft can be collected through the following: servicing records, petrol pump bills, toll booth records, consignment delivery documents, load challans, and statements from people who last saw the vehicle before it was stolen<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field" <?php echo isset($reportdata->proof_of_existence) ? "disabled" : ""; ?> value="<?php echo isset($reportdata->proof_of_existence) ? $reportdata->proof_of_existence : ""; ?>" id="proof_of_existence" name="proof_of_existence" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="violation_aspects" style="color:black">Violation Aspects<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            id="violation_aspects" name="violation_aspects"
                            placeholder=""
                            value="<?php echo isset($reportdata->violation_aspects) ? htmlspecialchars($reportdata->violation_aspects) : ""; ?>"
                            <?php echo isset($reportdata->violation_aspects) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="references" style="color:black">References (Reference to NCDRC/SC judgements in relation to the current claim may be made)<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            id="references" name="references"
                            placeholder=""
                            value="<?php echo isset($reportdata->references) ? htmlspecialchars($reportdata->references) : ""; ?>"
                            <?php echo isset($reportdata->references) ? "disabled" : ""; ?>>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="case_summary" style="color:black">Case Summary<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            id="case_summary" name="case_summary"
                            placeholder=""
                            value="<?php echo isset($reportdata->case_summary) ? htmlspecialchars($reportdata->case_summary) : ""; ?>"
                            <?php echo isset($reportdata->case_summary) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="conclusion" style="color:black">Conclusion (Reference to NCDRC/SC judgements in relation to the current claim may be made)<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            id="conclusion" name="conclusion"
                            placeholder=""
                            value="<?php echo isset($reportdata->conclusion) ? htmlspecialchars($reportdata->conclusion) : ""; ?>"
                            <?php echo isset($reportdata->conclusion) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                        <label for="annexures" style="color:black">Annexures (Reference to NCDRC/SC judgements in relation to the current claim may be made)<span style="color:red">*</span></label>
                        <input type="text" class="form-control case-field"
                            id="annexures" name="annexures"
                            placeholder=""
                            value="<?php echo isset($reportdata->annexures) ? htmlspecialchars($reportdata->annexures) : ""; ?>"
                            <?php echo isset($reportdata->annexures) ? "disabled" : ""; ?> required>
                    </div>
                </div>
            </div>
            <table id="documents_attached" style="width: 100%;" border="1" class="mt-4">
                <tbody>
                    <tr>
                        <td><label class="ml-2" for="date_of_loss" style="color:black">Tax whether paid up to the date of loss? &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="date_of_loss" name="date_of_loss" required <?php echo isset($reportdata->date_of_loss) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->date_of_loss ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->date_of_loss ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->date_of_loss ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="fitness_date" style="color:black">Fitness Certificate,whether Fitness is valid on the date of loss? &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="fitness_date" name="fitness_date" required <?php echo isset($reportdata->fitness_date) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->fitness_date ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->fitness_date ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->fitness_date ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="permit_whether" style="color:black">Permit, Whether place of loss falls within the permitted area? &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="permit_whether" name="permit_whether" required <?php echo isset($reportdata->permit_whether) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->permit_whether ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->permit_whether ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->permit_whether ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="whether_the_vehicle" style="color:black">Whether the vehicle was used for the purpose , as stated in the permit? &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="whether_the_vehicle" name="whether_the_vehicle" required <?php echo isset($reportdata->whether_the_vehicle) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->whether_the_vehicle ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->whether_the_vehicle ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->whether_the_vehicle ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="whether_registered_owner" style="color:black">Whether registered owner and insured name are the name?(Y/N) In case of any discrepancy explanation to be provided &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="whether_registered_owner" name="whether_registered_owner" required <?php echo isset($reportdata->whether_registered_owner) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->whether_registered_owner ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->whether_registered_owner ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->whether_registered_owner ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="engine_and_chasis_number" style="color:black">Are the engine and chassis numbers the same on the RC, policy, and purchase invoice? (Y/N) If there are any discrepancies, clarification should be obtained from the insured. &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="engine_and_chasis_number" name="engine_and_chasis_number" required <?php echo isset($reportdata->engine_and_chasis_number) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->engine_and_chasis_number ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->engine_and_chasis_number ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->engine_and_chasis_number ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="submitted_by_the_insured_to_insurer" style="color:black">Whether Submitted by the insured to insurer?(Y/N) &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="submitted_by_the_insured_to_insurer" name="submitted_by_the_insured_to_insurer" required <?php echo isset($reportdata->submitted_by_the_insured_to_insurer) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->submitted_by_the_insured_to_insurer ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->submitted_by_the_insured_to_insurer ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->submitted_by_the_insured_to_insurer ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="collected_from_insurer" style="color:black">If not submitted, Wheather collected from insurer?(Y/N) &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="collected_from_insurer" name="collected_from_insurer" required <?php echo isset($reportdata->collected_from_insurer) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->collected_from_insurer ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->collected_from_insurer ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->collected_from_insurer ?? '') == 'NA' ? 'selected' : ''; ?>>NA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="ml-2" for="intimated_ncrb" style="color:black">Whether intimated to NCRB: (Y/N) &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="intimated_ncrb" name="intimated_ncrb" required <?php echo isset($reportdata->intimated_ncrb) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="Yes" <?php echo ($reportdata->intimated_ncrb ?? '') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($reportdata->intimated_ncrb ?? '') == 'No' ? 'selected' : ''; ?>>No</option>
                                <option value="NA" <?php echo ($reportdata->intimated_ncrb ?? '') == 'NA' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="ml-2" for="noc_status" style="color:black">>NOC Status(Y/N) &nbsp;<span style="color:red">*</span></label></td>
                        <td style="width:10%; align-self: center;">
                            <select class="form-control case-field" id="noc_status" name="noc_status" required <?php echo isset($reportdata->noc_status) ? 'disabled' : ''; ?>>
                                <option value="">Select</option>
                                <option value="yes" <?php echo ($reportdata->noc_status ?? '') == 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo ($reportdata->noc_status ?? '') == 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </td>
                    </tr>


                </tbody>
            </table>
            <div class="button d-flex justify-content-end" style="padding-bottom:10px;">
                <input class="btn case_btn" value="<?php echo isset($reportdata) ? "Edit" : "Submit"; ?>" type="button" id="motor_theft_case_submit">
            </div>
        </div>
    </form>
</div>