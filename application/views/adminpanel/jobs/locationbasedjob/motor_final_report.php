<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre Inspection Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @page {
            counter-increment: page;
            margin: 60px 0px;
        }

        @page :first {
            @top-right {
                content: none;
                /* Hide page number on the first page */
            }
        }

        @page {
            @top-right {
                content: "Page " counter(page);
                visibility: hidden;
            }
        }
        
        footer {
            position: fixed;
            bottom: 0;
            left: 20px;
            right: 20px;
        }

        .sub-table {
            width: 60%;
        }

        .sub-table th {
            font-size: 11px;
            width: 60%;
        }

        .sub-table td {
            font-size: 11px;
            width: 60%;
        }

       
        .page-break {
            page-break-after: always;
        }

        .date {
            padding-top: 0px;
            margin-top: 0px;
        }

        .header_img {
            width: 698px;
            height: 250px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding-left: 3px;
            font-weight: 400;
            font-size: 13px;
        }

        th {
            border: 1px solid #000;
            text-align: left;
            padding-left: 3px;
            font-weight: 400;
            font-size: 13px;
        }

        .reprtNumber {
            float: left;
            font-size: 13px;
            font-weight: 600;
        }

        .report-date {
            float: right;
            font-size: 13px;
            font-weight: 600;
        }

        .card-container {
            border: 1px solid black;
            padding: 0;
            margin-top: 10px;
        }

        .card-title {
            font-weight: 500;
            color: black;
            background-color: #e3e3e3;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
            margin-top: 0px;
            font-size: 16px;
            padding-bottom: 0px;
            padding: 4px;
        }

        .card-text {
            font-size: 13px;
            padding: 5px;
            margin-top: 0px;
            padding-top: 0px;
        }

        .table-title {
            background-color: #e3e3e3;
            margin-bottom: 0px;
            padding: 2px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 16px;
            margin-top: 10px;
        }

        .reprtNumber {
            float: left;
            font-size: 15px;
            font-weight: 600;
            margin-top: 0px;
        }

        .report-date {
            float: right;
            font-size: 15px;
            font-weight: 600;
            margin-top: 0px;

        }

        .report-header {
            height: 50px;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 0px;
            padding-top: 0px;
        }

        .enlosures {
            text-align: center;
            width: 50px;
        }

        .seriel_no {
            text-align: center;
            width: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .page-number::after {
            content: counter(page);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
        }

        .center {
            text-align: center;
            flex-grow: 1;
        }

        .right {
            text-align: right;
        }

        @media print {
            #reportDiv {
                position: fixed;
                top: 0;
                width: 100%;
                background: #fff;
                padding: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }

            body {
                padding-top: 50px;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <div class="container">



        <div class="letterhead">
            <?php if (isset($letterheadUrl)) : ?>
                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/" . $letterheadUrl)); ?>"
                    alt="Embedded Image" style="width: 730px; height: 40%;">
            <?php else : ?>
                <p style="color: red;"><?php echo $letterheadUrl ?></p>
            <?php endif; ?>
        </div>
        <div class="referencenum-reportdate">
            <div class="report-header">
                <p class="reprtNumber">Case Reference: <?php echo $essentialData['case_reference']; ?></p>
                <p class="report-date">Date: <?php echo $essentialData['date_of_report']; ?></p>
            </div>
        </div>
        <div class="header">
            <div style="width: 100%;">
                <div style="float: left; width: 50%; ">
                    <?php
                    // Check if policy_branch exists
                    $policyBranch = $essentialData['policy_branch'];
                    $splitPosition = strpos(wordwrap($policyBranch, 40), "\n");

                    // Split the policy branch at the defined position
                    if ($splitPosition !== false) {
                        $firstLine = substr($policyBranch, 0, $splitPosition);
                        $secondLine = substr($policyBranch, $splitPosition);
                    } else {
                        // If no split position, fallback to original text
                        $firstLine = $policyBranch;
                        $secondLine = '';
                    }
                    ?>
                    <p style="color: black;font-size:14px;">
                        To,<br>
                        <?php echo $essentialData['policy_by']; ?><br>
                        <?php echo $firstLine . '<br>' . $secondLine; ?>
                    </p>
                </div>

                <div style="float: left; width: 48%; text-align: right; margin-top: -30px;">
                    <span><?php echo $username; ?></span>
                </div>

                <div style="color: red; text-align: right; font-size: 10px;">
                    <span>For Photos Scan Here</span>
                </div>

                <div style="text-align: right;">
                    <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width: 100px; height: 100px;">
                </div>
                <div style="text-align: right; padding-right: 20px">
                    <span style="font-size: 10px;">
                        <a style="padding-left: 30%; margin-top: 10px;" href="<?php echo base_url('downloadmedia/' . $essentialData['aid']); ?>" alt="download report">Download</a>
                    </span>
                    <span style="font-size: 10px;">
                        <a style="margin-top: 20px;" href="<?php echo base_url('viewmedia/' . $essentialData['aid']); ?>" alt="download report" target="_blank">View</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="head" style="margin-bottom:5px;">

            <p class="text-center" style="font-weight: 600;margin:0px;font-size:20px;"> Motor Spot Report</p>
        </div>

        <table>
            <tbody>
                <tr>
                    <th style="width: 30%;">Claim for vehicle registration number</th>
                    <th colspan="4"><?php echo !empty($essentialData['vehicle_number']) ? htmlspecialchars($essentialData['vehicle_number'], ENT_QUOTES, 'UTF-8') : 'NA'; ?></th>
                </tr>
                <tr>
                    <th style="width: 25%;">Insured</th>
                    <th colspan="4"><?php echo isset($essentialData['insured_name']) && !empty($essentialData['insured_name']) ? htmlspecialchars($essentialData['insured_name']) : 'NA'; ?></th>
                </tr>
                <tr>

                    <th>Date of accident</th>
                    <th><?php echo !empty($caseData['date_of_incident']) ? htmlspecialchars($caseData['date_of_incident'], ENT_QUOTES, 'UTF-8') : 'NA'; ?></th>
                    <th style="width: 15%;">Policy No.</th>
                    <th colspan="2" style="width: 35%;"><?php echo !empty($essentialData['policyNumber']) ? htmlspecialchars($essentialData['policyNumber'], ENT_QUOTES, 'UTF-8') : 'NA'; ?></th>
                </tr>

                <tr>
                    <th>Claim No.</th>
                    <th colspan="4"><?php echo !empty($essentialData['claim_no']) ? htmlspecialchars($essentialData['claim_no'], ENT_QUOTES, 'UTF-8') : 'NA'; ?></th>
                </tr>

            </tbody>
        </table>

        <h6 class="text-center table-title">Insurance Particulars</h6>
        <table>
            <tbody>
                <tr>
                    <th style="width: 25%;">Insurers</th>
                    <th colspan="4"><?php echo isset($essentialData['policy_by']) && !empty($essentialData['policy_by']) ? htmlspecialchars($essentialData['policy_by']) : 'NA'; ?></th>

                </tr>
                <tr>
                    <th style="width: 25%;">Insured</th>
                    <th colspan="4"><?php echo isset($essentialData['insured_name']) && !empty($essentialData['insured_name']) ? htmlspecialchars($essentialData['insured_name']) : 'NA'; ?></th>
                </tr>

                <tr>
                    <th>Address of Insured</th>
                    <th><?php echo isset($essentialData['insured_address']) && !empty($essentialData['insured_address']) ? htmlspecialchars($essentialData['insured_address']) : 'NA'; ?></th>
                    <th>Registered Owner</th>
                    <th colspan="2"><?php echo isset($essentialData['registered_owner']) && !empty($essentialData['registered_owner']) ? htmlspecialchars($essentialData['registered_owner']) : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Policy Number</th>
                    <th><?php echo !empty($essentialData['policyNumber']) ? htmlspecialchars($essentialData['policyNumber'], ENT_QUOTES, 'UTF-8') : 'NA'; ?></th>
                    <th>Period of Insurance</th>
                    <th colspan="2"><?php echo ' From ' .  $essentialData['insurancefromtime'] . '  ' . $essentialData['insurancefrom'] .  ' To ' . $essentialData['insuranceto'] ?></th>
                </tr>
                <tr>
                    <th>Financers (if any)</th>
                    <th><?php echo isset($essentialData['financers']) && !empty($essentialData['financers']) ? htmlspecialchars($essentialData['financers']) : 'NA'; ?></th>
                    <th>Sum Insured</th>
                    <th colspan="2"><?php echo isset($essentialData['sum_insured']) && !empty($essentialData['sum_insured']) ? htmlspecialchars($essentialData['sum_insured']) : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Appointed by</th>
                    <th colspan="4"><?php echo isset($essentialData['appoint_by']) && !empty($essentialData['appoint_by']) ? htmlspecialchars($essentialData['appoint_by']) : 'NA'; ?> </th>
                </tr>
            </tbody>
        </table>

        <h6 class="text-center table-title">Vehicle Particulars</h6>
        <table>
            <tbody>
                <tr>
                    <th style="width: 25%;">Registration No.</th>
                    <th style="width: 25%;"><?php echo isset($essentialData['register_no']) ? $essentialData['register_no'] : 'NA'; ?></th>
                    <th style="width: 25%;">Date of Registration</th>
                    <th style="width: 25%;" colspan="2"><?php echo isset($caseData['registration_date']) ? $caseData['registration_date'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Chassis No.</th>
                    <th><?php echo isset($caseData['chasis_no']) ? $caseData['chasis_no'] : 'NA'; ?></th>
                    <th>Engine No.</th>
                    <th colspan="2"><?php echo isset($caseData['engine_no']) ? $caseData['engine_no'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Make / Model</th>
                    <th><?php echo isset($caseData['make_model']) ? $caseData['make_model'] : 'NA'; ?></th>
                    <th>Type of Body</th>
                    <th colspan="2"><?php echo isset($caseData['body_type']) ? $caseData['body_type'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Tax Paid Up To</th>
                    <th><?php echo isset($caseData['tax_paid']) ? $caseData['tax_paid'] : 'NA'; ?></th>
                    <th>Class of Vehicle</th>
                    <th colspan="2"><?php echo isset($caseData['vehicle_classText']) ? $caseData['vehicle_classText'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>ULW</th>
                    <th><?php echo isset($caseData['ulw']) ? $caseData['ulw'] : 'NA'; ?></th>
                    <th>RLW</th>
                    <th colspan="2"><?php echo isset($caseData['rlw']) ? $caseData['rlw'] : 'NA'; ?></th>
                </tr>

                <tr>
                    <th>Carrying Capacity</th>
                    <th><?php echo isset($caseData['carrying_capacity']) ? $caseData['carrying_capacity'] : 'NA'; ?></th>
                    <th>Pre Accident Condition</th>
                    <th colspan="2"><?php echo isset($caseData['pre_acccident']) ? $caseData['pre_acccident'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Fitness Certificate No.</th>
                    <th><?php echo isset($caseData['fitness_certificate_no']) ? $caseData['fitness_certificate_no'] : 'NA'; ?></th>
                    <th>Valid Up to</th>
                    <th colspan="2"><?php echo isset($caseData['valid_up_to']) ? $caseData['valid_up_to'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Permit No.</th>
                    <th><?php echo isset($caseData['permit_no']) ? $caseData['permit_no'] : 'NA'; ?></th>
                    <th>Permit From</th>
                    <th colspan="2"><?php echo isset($caseData['permit_validityfrom']) ? $caseData['permit_validityfrom'] : 'NA'; ?></th>

                </tr>
                <tr>
                    <th>Type of Permit</th>
                    <th><?php echo isset($caseData['permit_type']) ? $caseData['permit_type'] : 'NA'; ?></th>
                    <th>Valid Up to</th>
                    <th colspan="2"><?php echo isset($caseData['permit_validity']) ? $caseData['permit_validity'] : 'NA'; ?></th>
                </tr>

                <tr>
                    <th>Authorization </th>
                    <th><?php echo isset($caseData['authorization']) ? $caseData['authorization'] : 'NA'; ?></th>
                    <th>Authorization From </th>
                    <th colspan="2"><?php echo isset($caseData['authorization_from']) ? $caseData['authorization_from'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Authorization Validity </th>
                    <th><?php echo isset($caseData['autharity_validity']) ? $caseData['autharity_validity'] : 'NA'; ?></th>
                    <th>Whether valid for the state in which the accident took place?</th>
                    <th colspan="2"><?php echo isset($caseData['whether_valid']) ? $caseData['whether_valid'] : 'NA'; ?></th>

                </tr>


                <tr>
                    <th>Route/Area of Operation</th>
                    <th><?php echo isset($caseData['area_of_operation']) ? $caseData['area_of_operation'] : 'NA'; ?></th>
                    <th>PUC</th>
                    <th colspan="2"><?php echo isset($caseData['puc']) ? $caseData['puc'] : 'NA'; ?></th>
                </tr>
            </tbody>
        </table>

        <h6 class="text-center table-title">Documents Verification</h6>
        <table>
            <tbody>
                <tr>
                    <th style="width: 25%;">RC</th>
                    <th style="width: 25%;"><?php echo isset($caseData['rcText']) && !empty($caseData['rcText']) ? htmlspecialchars($caseData['rcText']) : 'NA'; ?></th>
                    <th style="width: 25%;">Goods/Passenger Tax</th>
                    <th style="width: 25%;" colspan="2"><?php echo isset($caseData['goods_taxText']) && !empty($caseData['goods_taxText']) ? htmlspecialchars($caseData['goods_taxText']) : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Fitness</th>
                    <th><?php echo isset($caseData['fitnessText']) && !empty($caseData['fitnessText']) ? htmlspecialchars($caseData['fitnessText']) : 'NA'; ?></th>
                    <th>Permit</th>
                    <th colspan="2"><?php echo isset($caseData['permitText']) && !empty($caseData['permitText']) ? htmlspecialchars($caseData['permitText']) : 'NA'; ?></th>
                </tr>
            </tbody>
        </table>

        <h6 class="text-center table-title">Driver’s Particulars</h6>
        <table>
            <tbody>
                <tr>
                    <th style="width: 25%;">Name of Driver</th>
                    <th style="width: 25%;"><?php echo isset($caseData['name_of_driver']) ? $caseData['name_of_driver'] : 'NA'; ?></th>
                    <th style="width: 25%;">Driving License No.</th>
                    <th style="width: 25%;" colspan="2"><?php echo isset($caseData['driving_license_no']) ? $caseData['driving_license_no'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Date of issue</th>
                    <th><?php echo isset($caseData['dl_issuedate']) ? $caseData['dl_issuedate'] : 'NA'; ?></th>
                    <th>Date of Birth</th>
                    <th colspan="2"><?php echo isset($caseData['dob']) ? $caseData['dob'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Valid Up to: </th>
                    <th><?php echo isset($caseData['dl_valid']) ? $caseData['dl_valid'] : 'NA'; ?></th>
                    <th>Issuing Authority</th>
                    <th colspan="2"><?php echo isset($caseData['issuing_authority']) ? $caseData['issuing_authority'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Type of License </th>
                    <th><?php echo isset($caseData['license_type']) ? $caseData['license_type'] : 'NA'; ?></th>
                    <th>Type of vehicle allowed to drive</th>
                    <th colspan="2"><?php echo isset($caseData['type_of_vehicle_allowed']) ? $caseData['type_of_vehicle_allowed'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Driving License Verified</th>
                    <th><?php echo isset($caseData['verified_driving_license']) ? $caseData['verified_driving_license'] : 'NA'; ?></th>
                    <th>Endorse</th>
                    <th colspan="2"><?php echo isset($caseData['endorse']) ? $caseData['endorse'] : 'NA'; ?></th>

                </tr>
                <!-- <tr>
                    <th>Badge No.</th>
                    <th colspan="4"><?php echo isset($caseData['badge_no']) ? $caseData['badge_no'] : 'NA'; ?></th>
                </tr> -->
            </tbody>
        </table>

        <h6 class="text-center table-title">Accident Particulars</h6>
        <table>
            <tbody>
                <tr>
                    <th style="width: 25%;">Place of accident</th>
                    <th style="width: 25%;"><?php echo isset($caseData['place_of_accident']) ? $caseData['place_of_accident'] : 'NA'; ?></th>
                    <th style="width: 25%;">Date and time of accident</th>
                    <th style="width: 25%;" colspan="2"><?php echo isset($caseData['date_of_incident'], $caseData['time_of_incident']) ? $caseData['date_of_incident'] . ' ' . $caseData['time_of_incident'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Date of allotment of inspection</th>
                    <th><?php echo isset($caseData['survey_allotment_date']) ? $caseData['survey_allotment_date'] : 'NA'; ?></th>
                    <th>Date of Survey</th>
                    <th colspan="2"><?php echo isset($caseData['survey_date']) ? $caseData['survey_date'] : 'NA'; ?></th>
                </tr>
                <tr>
                    <th>Place of Inspection</th>
                    <th colspan="4"><?php echo isset($caseData['place_of_inspection']) ? $caseData['place_of_inspection'] : 'NA'; ?></th>
                </tr>
            </tbody>
        </table>

        <h6 class="text-center table-title">Police Report</h6>
        <table>
            <tbody>
                <tr>
                    <th style="width: 25%;">Has accident been reported to police</th>
                    <th style="width: 25%;"><?php echo isset($caseData['has_accidenty']) ? $caseData['has_accidenty'] : 'NA'; ?></th>
                    <th style="width: 25%;">If Yes, FIR/DD No.</th>
                    <th style="width: 25%;" colspan="2"><?php echo isset($caseData['if_yes']) ? $caseData['if_yes'] : 'NA'; ?></th>
                </tr>

            </tbody>
        </table>

        <?php if (!empty($caseData['third_party_particulars'])): ?>
            <div class="card " style="page-break-inside: avoid; border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Third Party Particulars</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['third_party_particulars'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['loan_challan'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Load Challan</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['loan_challan'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['cause_nature_accident'])): ?>
            <div class="card " style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Cause and nature of accident</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['cause_nature_accident'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['particulars_loss_damage'])): ?>
            <div class="card " style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Particulars of loss / Damage</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['particulars_loss_damage'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['show_cabin'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container">
                    <h6 class="card-title" style="margin-bottom: 2px;">Front Show / Cabin </h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['show_cabin'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['load_body']) && in_array($caseData['load_body'], ['Tractor', 'Bus'])): ?>
            <div class="card" id="load_body_card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Load Body:</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['load_body'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['cooling_system'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Cooling System</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['cooling_system'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['steering_system'])): ?>
            <div class="card " style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Steering System</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['steering_system'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['suspension'])): ?>
            <div class="card " style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Suspension</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['suspension'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['electrical_system'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Electrical System:</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['electrical_system'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['engine_transmission'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Engine & Transmission System</h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['engine_transmission'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['axles_chassis'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Axles & Chassis: </h6>
                    <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['axles_chassis'])); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($caseData['sb1']) || !empty($caseData['sb2'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <?php if (!empty($caseData['sb1'])): ?>
                        <h6 class="card-title" style="margin-bottom: 2px;">Others: </h6>
                        <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['sb1'])); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($caseData['sb2'])): ?>
                        <p class="card-text" style="margin-bottom: 2px;"><?php echo nl2br(htmlspecialchars($caseData['sb2'])); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($caseData['remarks'])): ?>
            <div class="card" style="page-break-inside: avoid;border:none;">
                <div class="card-container mt-2">
                    <h6 class="card-title" style="margin-bottom: 2px;">Remarks : </h6>
                    <p class="card-text" style="margin-bottom: 2px;">
                        <?php

                        echo nl2br(htmlspecialchars($caseData['remarks']));
                        ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <p style="font-size: 16px;"> This report is issued without prejudice, in respect of cause, nature and extent of
            loss / damage and subject to terms and conditions of the insurance policy insurers admitting liability</p>

        <div style="margin-top: 40px; text-align: right;">
            <p style="font-size: 16px;">
                <?php if (!empty($companyname['companyName'])) { ?>
                    <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
                <?php } ?>
                <br>
            </p>

            <h5 style="font-size: 16px; margin-top: 40px;">Authorized Signatory</h5>
        </div>

    </div>
    </div>

</body>

</html>