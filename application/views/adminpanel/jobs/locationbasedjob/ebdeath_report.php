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
            margin: 60px 28px 70px 30px;
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

        /* Show page numbers from the second page */
        body {
            counter-reset: page 1;
        }

        .pagenum::after {
            content: "Page " counter(page);
        }

        body {
            font-family: 'New Cicle', sans-serif;

        }

        

        .date {
            padding-top: 0px;
            margin-top: 0px;
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
            margin-top: 0px;
        }

        .report-date {
            float: right;
            font-size: 13px;
            font-weight: 600;
            margin-top: 0px;
        }

        .table-title {
            background-color: rgb(243, 243, 243);
            margin-bottom: 0px;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 13px;
            margin-top: 10px;
        }

        .report-header {
            height: 50px;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 0px;
            padding-top: 0px;
        }

        .header {
            display: flex;
            justify-content: space-between;

        }

        .text-center {
            text-align: center;
        }
         .no-border {
            border-collapse: collapse;
            border: none;
        }
        .no-border td, .no-border th {
            border: none;
        }
         .flyleaf {
            margin-left: 10px;
            margin-right: 10px;
            margin-top: -6px;
            margin-bottom: -5px;
        }

    </style>
</head>

<body>
    <div class="flyleaf">
        <div class="letterhead">
            <?php if (isset($letterheadUrl)) : ?>
                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/" . $letterheadUrl)); ?>"
                    alt="Embedded Image" style="width: 100%;">
            <?php else : ?>
                <p style="color: red;"><?php echo $letterheadUrl ?></p>
            <?php endif; ?>
        </div>
       
        <div class="imgheader">
            <table >
                <tbody class="no-border">
                    <tr class="px-1" style="background-color: rgb(243, 243, 243);color:#000;height:30px;">
                        <td  class="px-1" style="width:100%; vertical-align: top;padding-bottom:2px;"><b>Case Reference: <?php echo $essentialData['case_reference']; ?></b></td>
                        <td  class="px-1" style="width:2%; vertical-align: top; text-align: right;padding-bottom:2px;">
                            
                             <b>Date: <?php echo $essentialData['date_of_report']; ?></b> 
                            
                        </td>
                    </tr>
                    <tr>
                        <td style="width:80%; height:150px; padding-top:30px;vertical-align: top;">
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
                                <p style="color: black;font-size:13px;">
                                    To,<br>
                                    <?php echo $essentialData['policy_by']; ?><br>
                                    <?php echo $firstLine . '<br>' . $secondLine; ?>
                                </p>
                        </td>
                        <td style="width:20%; vertical-align: top; text-align: right;">
                            <table style="margin: auto;">
                                
                                <tr>
                                    <td colspan="2" style="text-align: right; font-size: 12px; ">
                                        <span><?php echo $username; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right;">
                                        <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width: 115px; height: 115px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="color: red; text-align: center; font-size: 10px;">
                                        <span>For Photos Scan Here</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; text-align: center;">
                                        <a href="<?php echo base_url('viewmedia/' . $essentialData['aid']); ?>" 
                                           target="_blank"
                                           style="display: block; width: 90%; text-decoration: none; background-color: #007bff; color: white; padding: 2px; font-size: 10px;">
                                           View
                                        </a>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <a href="<?php echo base_url('downloadmedia/' . $essentialData['aid']); ?>" 
                                           style="display: block; width: 90%; text-decoration: none; background-color: #28a745; color: white; padding: 2px; font-size: 10px;">
                                           Download
                                        </a>
                                    </td>
                                </tr>

                            </table>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="head" style="margin-bottom:5px;">
            <p class="text-center" style="margin:0px;font-weight: 600;font-size:13px;">
                INVESTIGATION REPORT OF ACCIDENT<br>
                PERTAINING TO THE <?php echo isset($essentialData['policytype']) ? strtoupper($essentialData['policytype']) : '' ?> POLICY
                CLAIM OF <br>
                <?php echo isset($caseData['injured_name']) ? strtoupper($caseData['injured_name']) : ''; ?>
                <?php echo isset($caseData['father_name']) ? ' S/O '.strtoupper($caseData['father_name']) : ''; ?>
                <br>
                INSURED: <?php echo isset($caseData['insured_name']) ? strtoupper($caseData['insured_name']) : ''; ?><br>
                POLICY NO.: <?php echo isset($caseData['policyNumber']) ? strtoupper($caseData['policyNumber']) : ''; ?><br>
                DOA: <?php echo isset($caseData['accident_date']) ? strtoupper($caseData['accident_date']) : ''; ?><br>
                DOD.: <?php echo isset($caseData['death_date']) ? strtoupper($caseData['death_date']) : ''; ?>
            </p>
            <p class="text-center" style="text-transform: capitalize;">
                (Private And Confidential 
                For The Use Of Insurers Only)
            </p>
            <p style="padding: 5px 10px 5px 5px; margin: 0;font-size:13px; text-align: justify; white-space: normal; word-wrap: break-word; max-width: 100%;"><?php echo isset($caseData['headline']) ? $caseData['headline'] : '' ?></p>
            <p class="text-center" style="font-weight: 600;margin:0px;font-size:20px;"> EB Death Case Investigation</p>
        </div>
        <p class="text-center p-0 m-0" style="font-weight: 600;font-size:18px;">Part A</p>
        <h6 class="table-title" style="margin-top: 2px;">A. Insurance Particulars</h6>
        <table>
            <tbody>
                <?php $counter = 1; ?>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width:30%;">Policy No. and Validity date</th>
                    <th colspan="6">
                        <?php
                        if (!empty($caseData['policyNumber'])) {
                            echo "<strong>" . $caseData['policyNumber'] . "</strong>";

                            if (!empty($caseData['policyNumberfrom']) || !empty($caseData['policyNumberto'])) {
                                echo "<br>( From ";
                                echo !empty($caseData['policyNumberfrom']) ? "<strong>" . $caseData['policyNumberfrom'] . "</strong>" : '';
                                echo (!empty($caseData['policyNumberfrom']) && !empty($caseData['policyNumberto'])) ? " to " : '';
                                echo !empty($caseData['policyNumberto']) ? "<strong>" . $caseData['policyNumberto'] . "</strong>" : '';
                                echo " )";
                            }
                        }
                        ?>
                    </th>

                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width:30%;">Policy Issuing office</th>
                    <th colspan="6">
                        <?php 
                        echo isset($caseData['policyissuing_office']) 
                            ? nl2br($caseData['policyissuing_office']) 
                            : ''; 
                        ?>
                    </th>

                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++; ?></th>
                    <th style="width: 30%;">Name of Insured</th>
                    <th colspan="6">
                         <?php 
                        echo isset($caseData['insured_name']) 
                            ? nl2br($caseData['insured_name']) 
                            : ''; 
                        ?>
                    </th>
                </tr>

                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width:30%;">Members / Sum Insured as per policy</th>
                    <th colspan="6"><?php echo isset($caseData['sum_insured']) ? $caseData['sum_insured'] : '' ?></th>
                </tr>
            </tbody>
        </table>
        <h6 class="table-title">B. Details of Accident</h6>
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="padding: 5px; text-align: left;font-size:13px;">
                     <b> About the insured: </b> <?php echo isset($caseData['insured_detail']) ? $caseData['insured_detail'] : '' ?>
                    </th>
                </tr>
                <?php $counter = 1; ?>
                <tr>
                    <th style="padding: 5px; text-align: left;font-size:13px;">
                        <?php echo $counter++ . ". Detailed Incidence with Date and Time"; ?>
                    </th>
                </tr>
                <tr>
                    <th style="padding: 5px 10px 5px 5px; margin: 0; text-align: justify; white-space: normal; word-wrap: break-word; max-width: 100%;">
                        <?php
                        if (!empty($caseData['detailed_incidence'])) {
                            echo nl2br($caseData['detailed_incidence']); // Preserve paragraph formatting

                           
                        } else {
                            echo "No detailed incidence available.";
                        }
                        ?>
                    </th>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width:30%;"> Date, Day, Time and Place of accident</th>
                    <th colspan="6">
                        <?php
                            $accidentDate  = $caseData['accident_date']  ?? '';
                            $accidentDay   = $caseData['accident_day']   ?? '';
                            $accidentTime  = $caseData['accident_time']  ?? '';
                            $accidentPlace = $caseData['accident_place'] ?? '';

                            $accidentDetails = [];

                            if ($accidentDate)  $accidentDetails[] = $accidentDate;
                            if ($accidentDay)   $accidentDetails[] = $accidentDay;
                            if ($accidentTime)  $accidentDetails[] = $accidentTime;
                            if ($accidentPlace) $accidentDetails[] = $accidentPlace;

                            echo $accidentDetails 
                                ? implode(" , ", $accidentDetails) 
                                : "No accident details available";
                        ?>
                    </th>

                </tr>

                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 47%;"> Police Report No. & Police station</th>
                    <th colspan="6">
                    <?php
                    $firNo = isset($caseData['policereport_number']) ? $caseData['policereport_number'] : '';
                    $reportDate = isset($caseData['report_date']) ? $caseData['report_date'] : '';
                    $policeStation = isset($caseData['policestation']) ? $caseData['policestation'] : '';
                    $reportBy = isset($caseData['report_by']) ? $caseData['report_by'] : '';

                    // Build the final string conditionally
                    $output = '';
                    if (!empty($firNo)) {
                        $output .= "FIR No. $firNo";
                    }
                    if (!empty($reportDate)) {
                        $output .= (!empty($output) ? ", " : "") . "Date $reportDate";
                    }
                    if (!empty($policeStation)) {
                        $output .= (!empty($output) ? " at " : "") . "$policeStation";
                    }
                    if (!empty($reportBy)) {
                        $output .= (!empty($output) ? " by " : "") . "$reportBy";
                    }

                    echo $output;
                    ?>
                </th>

                </tr>


            </tbody>
        </table>
        <p class="text-center p-0 m-0" style="font-weight: 600;font-size:18px;">Part B</p>
        <h6 class="table-title" style="margin-top: 2px;">A. About Claimant / Insured</h6>
        <table>
            <tbody>
                <?php $counter = 1; ?>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Claimant name and relation with insured</th>
                    <th colspan="6">
                        <?php
                            echo isset($caseData['claimant_name']) ? $caseData['claimant_name'] . ' ' : '';
                            echo isset($caseData['claimant_relation']) ? $caseData['claimant_relation'] . ' ' : '';
                            echo isset($caseData['injured_name']) ? $caseData['injured_name'] : '';
                        ?>
                    </th>

                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Name and address of deceased / Injured</th>
                    <th colspan="6">
                        <?php
                            echo isset($caseData['injured_name']) ? $caseData['injured_name'] . '<br>' : '';
                            echo isset($caseData['injured_address']) ? $caseData['injured_address'] : '';
                        ?>
                    </th>

                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Name of father</th>
                    <th colspan="6"><?php echo isset($caseData['father_name']) ? $caseData['father_name'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Age of deceased / verification</th>
                    <th colspan="6"> <?php 
                        echo isset($caseData['deceased_verification']) 
                            ? nl2br($caseData['deceased_verification']) 
                            : ''; 
                        ?></th>

                </tr>

                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Name and address of employer</th>
                    <th colspan="6">
                        <?php
                            echo isset($caseData['employer_name']) ? $caseData['employer_name'] . '<br>' : '';
                            echo isset($caseData['employer_address']) ? $caseData['employer_address'] : '';
                        ?>
                    </th>

                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Is the address of claimant verified</th>
                    <th colspan="6"><?php echo isset($caseData['verified_claimant']) ? $caseData['verified_claimant'] : '' ?></th>
                </tr>

            </tbody>
        </table>
        <h6 class="table-title" style="page-break-inside: avoid;">B. Marital / Family Status</h6>
        <table>
            <tbody>
                <?php $counter = 1; ?>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++; ?></th>
                    <th style="width: 40%;">Name of Nominee</th>
                    <th colspan="6">
                        <?php echo isset($caseData['nominee_name']) ? "<strong>" . $caseData['nominee_name'] . "</strong>" : ''; ?>
                    </th>
                </tr>

                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Is he / she nominee and dependent</th>
                    <th colspan="6"><?php echo isset($caseData['nominee_dependent']) ? $caseData['nominee_dependent'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Has the widow / widower remarried</th>
                    <th colspan="6"><?php echo isset($caseData['remarried']) ? $caseData['remarried'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Are any children as legal heirs</th>
                    <th colspan="6"><?php echo isset($caseData['child_legal_heirs']) ? $caseData['child_legal_heirs'] : '' ?></th>
                </tr>



            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++; ?></th>
                    <th style="width: 30%;">Name and Age of all LRs</th>
                    <th colspan="6">
                        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                            <thead>
                                <tr>
                                    <th class="border border-dark p-2 fw-bold">Name</th>
                                    <th class="border border-dark p-2 fw-bold">Age</th>
                                    <th class="border border-dark p-2 fw-bold">Gender</th>
                                    <th class="border border-dark p-2 fw-bold">Relation</th>
                                    <th class="border border-dark p-2 fw-bold">Dependency</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($caseData['lrs']) && is_array($caseData['lrs'])) {
                                    foreach ($caseData['lrs'] as $lr) { ?>
                                        <tr>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($lr['name']); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($lr['age']); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($lr['sex']); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($lr['relation']); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($lr['dependency']); ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" style="border: 1px solid black; padding: 5px; text-align: center;">No LR data available</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </th>
                </tr>

            </tbody>
        </table>
        <h6 class="table-title" style="page-break-inside: avoid;">C. Income Status</h6>
        <table>
            <tbody>
                <?php $counter = 1; ?>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Source of Income/s and level of income - copy of IT return</th>
                    <th colspan="6"><?php echo isset($caseData['income_source']) ? $caseData['income_source'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">If the deceased was businessman will the buisness run without him</th>
                    <th colspan="6"><?php echo isset($caseData['business_run_without_him']) ? $caseData['business_run_without_him'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Was the widow / widower dependent</th>
                    <th colspan="6"><?php echo isset($caseData['widow_dependency']) ? $caseData['widow_dependency'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Status of employment of legal heir</th>
                    <th colspan="6"><?php echo isset($caseData['employment_legal_heir']) ? $caseData['employment_legal_heir'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Will the family get pension and amount</th>
                    <th colspan="6"><?php echo isset($caseData['pension_amount']) ? $caseData['pension_amount'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Documents of employment available</th>
                    <th colspan="6"><?php echo isset($caseData['empleyment_availability']) ? $caseData['empleyment_availability'] : '' ?></th>
                </tr>

            </tbody>
        </table>
        <h6 class="table-title" style="page-break-inside: avoid;">D. Details of Death / Injury Circumtances </h6>
        <table>
            <tbody>
                <?php $counter = 1; ?>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Did the Person die and was the death instant</th>
                    <th colspan="6"><?php echo isset($caseData['death_reason']) ? $caseData['death_reason'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">If no after how many days and in which hospital / treated in which hospital</th>
                    <th colspan="6"><?php echo isset($caseData['treatment']) ? $caseData['treatment'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Was the motor accident the proximate cause of death / injury </th>
                    <th colspan="6"><?php echo isset($caseData['motor_accident']) ? $caseData['motor_accident'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Hospital file reference / MLC No. </th>
                    <th colspan="6"><?php echo isset($caseData['hospital_file']) ? $caseData['hospital_file'] : '' ?></th>
                </tr>

                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">If injury only, discharged after how many days and with what recommendations</th>
                    <th colspan="6"><?php echo isset($caseData['injury_recommandations']) ? $caseData['injury_recommandations'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Has the hospital records been verified</th>
                    <th colspan="6"><?php echo isset($caseData['hospital_records']) ? $caseData['hospital_records'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Approximate medical expenses</th>
                    <th colspan="6"><?php echo isset($caseData['approximate_expense']) ? $caseData['approximate_expense'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">Post Mortem report attached </th>
                    <th colspan="6"><?php echo isset($caseData['pmr_attached']) ? $caseData['pmr_attached'] : '' ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;"><?php echo $counter++ ?></th>
                    <th style="width: 40%;">History of intoxicant consumption leading to above accident</th>
                    <th colspan="6"><?php echo isset($caseData['intoxicant_history']) ? $caseData['intoxicant_history'] : '' ?></th>
                </tr>
            </tbody>
        </table>

        <!-- Display Statements Before Conclusion -->
        <?php $counter = 1; ?>
        <h6 class="table-title mt-2" style="page-break-inside: avoid;">E. Special Information if any, about accident / brief report </h6>
        <?php if (!empty($caseData['statements'])): ?>
            <?php foreach ($caseData['statements'] as $statement): ?>

                <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;  ">

                    <tbody>
                        <tr>
                            <th style="width: 100%; padding: 5px 10px 5px 5px; text-align: justify; white-space: normal; word-wrap: break-word; max-width: 100%;">
                                <strong>
                                    <?php echo $counter++ . ". " . (!empty($statement['heading']) ? $statement['heading'] : 'No Heading'); ?>:
                                </strong>
                                <?php echo !empty($statement['statement']) ? $statement['statement'] : 'No Statement'; ?>
                            </th>
                        </tr>


                        <?php if (!empty($statement['images'])): ?>
                            <tr>
                                <th style="width: 100%; padding: 2px;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <?php
                                                $imageCount = count($statement['images']); // Count total images
                                                $imageCounter = 0;

                                                foreach ($statement['images'] as $image):
                                                    // Convert Image to Base64
                                                    $imagePath = str_replace("https://www.claimsmitra.com/", "", $image); // Adjust path
                                                    if (file_exists($imagePath) && is_readable($imagePath)) {
                                                        $imageData = file_get_contents($imagePath);
                                                        $base64Image = base64_encode($imageData);
                                                        $mimeType = mime_content_type($imagePath);
                                                        $imageSrc = "data:$mimeType;base64,$base64Image";
                                                    } else {
                                                        $imageSrc = "data:image/png;base64," . base64_encode(file_get_contents("placeholder.png")); // Fallback image
                                                        error_log("Image not found: " . $imagePath);
                                                    }

                                                    // If only one image, center it with a max width
                                                    $colWidth = ($imageCount == 1) ? "100%" : "50%";
                                                    $imageStyle = ($imageCount == 1) ? "width: 250px; height: 250px; display: block; margin: auto;" : "width: 100%; height: 250px;";
                                                ?>
                                                    <th style="width: <?php echo $colWidth; ?>; text-align: center; border: none;">
                                                        <img src="<?php echo $imageSrc; ?>" alt="Statement Image" style="<?php echo $imageStyle; ?>">
                                                    </th>
                                                    <?php
                                                    $imageCounter++;
                                                    if ($imageCounter % 2 == 0 && $imageCount > 1): // Start a new row after every two images
                                                    ?>
                                            </tr>
                                            <tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </th>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- Annexures - All in a Single Table -->
        <?php if (!empty($caseData['annexures'])): ?>
            <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                <tbody>
                     <tr>
                        <th class="fw-normal"><strong>Annexure</strong></th>
                        <th class="text-center fw-normal"><strong>No. of Page</strong></th>
                        <th class="text-center fw-normal"><strong>Original</strong></th>
                    </tr>
                    <?php foreach ($caseData['annexures'] as $annexure): ?>
                        <tr>
                            <td><?php echo $annexure['text']; ?></td>
                            <td class="text-center"><?php echo !empty($annexure['page_number']) ? $annexure['page_number'] : '-'; ?></td>
                            <td class="text-center"><?php echo !empty($annexure['yes_no']) ? $annexure['yes_no'] : 'NA'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if (!empty($caseData['conclusion'])): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <th style="width: 100%; padding: 5px; text-align: left;font-size:13px;background-color: rgb(243, 243, 243);">
                            <strong><?php echo $counter++ . ". Conclusion"; ?></strong>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 100%; padding:  5px 10px 5px 5px; text-align: justify; white-space: normal; word-wrap: break-word;">
                            <?php echo nl2br($caseData['conclusion']); ?>
                        </th>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if (!empty($caseData['loss_calculation'])): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <th style="width: 100%; padding: 5px; text-align: left; border-bottom: none;font-size:13px;background-color: rgb(243, 243, 243);">
                            <strong><?php echo $counter++ . ". Loss Calculation"; ?></strong>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 100%; padding:  5px 10px 5px 5px; text-align: justify; white-space: normal; word-wrap: break-word;">
                            <?php echo nl2br($caseData['loss_calculation']); ?>
                        </th>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if (!empty($caseData['disclaimer'])): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <th style="width: 100%; padding:  5px ; border-bottom: none;font-size:13px;;background-color: rgb(243, 243, 243);">
                            <strong>Disclaimer</strong>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 100%; padding:  5px 10px 5px 5px; text-align: justify; white-space: normal; word-wrap: break-word;">
                            <?php echo nl2br($caseData['disclaimer']); ?>
                        </th>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <div style="margin-top: 40px; text-align: right;">
            <p style="font-size: 13px;">
                <?php if (!empty($companyname['companyName'])) { ?>
                    <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
                <?php } ?>
               
            </p>

            <h5 style="font-size: 13px; margin-top: 40px;font-weight: 400;">Authorized Signatory</h5>
        </div>

    </div>

    
</body>

</html>