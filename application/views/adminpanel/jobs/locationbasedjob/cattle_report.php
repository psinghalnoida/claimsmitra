<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre Inspection Report</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pdf.css">
    <link href="http://fonts.cdnfonts.com/css/new-cicle" rel="stylesheet">
    <link href="https://playground.anychart.com/ranRPTdv/iframe" rel="canonical">
    <style>
        .page-break {
            page-break-before: always; /* Forces the section to start on a new page */
        }
        @page {
            counter-increment: page;
            margin: 50px 28px 60px 30px;
        }

        .flyleaf {
            page-break-after: always;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: -6px;
            margin-bottom: -5px;
        }

        .page-break {
            page-break-after: always;
        }

        .report-header {
            height: 50px;
            border-collapse: collapse;
            font-size: 11px;
            top: 0;
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
            font-size: 14px;
        }

        th {
            border: 1px solid #000;
            text-align: left;
            padding-left: 3px;
            font-weight: 400;
            font-size: 14px;
        }

        .reprtNumber {
            float: left;
            font-size: 15px;
            font-weight: 700;
        }

        .report-date {
            float: right;
            font-size: 15px;
            font-weight: 700;
        }

        .card-container {
            border: 1px solid black;
            padding: 0;
            margin-top: 25px;
        }

        .card-title {
            font-weight: 600;
            color: black;
            background-color: #e3e3e3;
            border-bottom: 1px solid black;
            margin-top: 0px;
            font-size: 16px;
            padding-bottom: 0px;
            padding: 4px;
        }

        .card-text {
            font-size: 15px;
            padding: 5px;
            margin-top: 0px;
            padding-top: 0px;
        }

        .table-title {
            background-color: #e3e3e3;
            margin-bottom: 0px;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 15px;
            margin-top: 25px;
        }

        .head {
            width: 50%;
            margin: 0px;
        }

        .enlosures {
            text-align: center;
            width: 50px;
        }

        .seriel_no {
            text-align: center;
            width: 30px;
        }
                 .no-border {
            border-collapse: collapse;
            border: none;
        }
        .no-border td, .no-border th {
            border: none;
        }
    </style>
</head>

<body>
    <div class="flyleaf ">
        
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
                                <p style="color: black;font-size:14px;">
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
        <div class="head" style="text-align: center; width:100%; margin-bottom: 10px;margin-top: -15px;">
            <h3 style="font-weight: 700; font-size:20px; margin-top:0px;"> Cattle Investigation Report</h3>
        </div>
        <table style="background-color: #fff; margin-top:-20px;">
            <tbody>
                <tr>
                    <th>Name of Owner</th>
                    <td colspan="2"><?php echo !empty($essentialData['insured_name']) ? $essentialData['insured_name'] : $essentialData['nameofowner']; ?>
                      </td>
                    <th>Date of Death</th>
                    <td colspan="2"><?php echo $essentialData['dateOfDeath'] ?></td>
                    <th>TAG No.</th>
                    <td colspan="2"><?php echo $essentialData['tagNumber'] ?></td>
                </tr>
            </tbody>
        </table>
        <h6 class="table-title" style="margin-top:10px;">A. About Animal, Owner and Insurance</h6>
        <table>
            <tbody>
                <tr style="border-right:1px solid black;">
                    <th style="width:30%;">Name of Insured</th>
                    <td style="width:20%;"><?php echo !empty($essentialData['insured_name']) ? $essentialData['insured_name'] : $essentialData['nameofowner']; ?></td>
                    <th style="width:25%;">Address Of Insured</th>
                    <td style="border-right:1px solid black;width:20%;"><?php echo $caseData['address_of_insured'] ?></td>
                </tr>
                <tr>
                    <th>Aadhar No.</th>
                    <td><?php echo $caseData['aadhar_number'] ?></td>
                    <th>Pan Card No.</th>
                    <td><?php echo $caseData['pan_number'] ?></td>
                </tr>
                <tr>
                    <th>District</th>
                    <td><?php echo $essentialData['district'] ?></td>
                    <th>State</th>
                    <td><?php echo $essentialData['state'] ?></td>
                </tr>
                <tr>
                    <th>Family ID No.</th>
                    <td><?php echo $caseData['familyIDNumber'] ?></td>
                    <th>Date of Issuance of Family id</th>
                    <!-- <td><?php echo $caseData['dateofInsurance'] ?></td> -->
                    <td> <?php echo isset($caseData['dateofInsurance']) ? $caseData['dateofInsurance'] : '' ?>

                </tr>
                <tr>
                    <th>Contact No.</th>
                    <td><?php echo !empty($essentialData['contact_person_mobile']) ? $essentialData['contact_person_mobile'] : ($essentialData['ContactNumber'] ?? ''); ?></td>
                    <th>Category of Insured</th>
                    <td><?php echo $caseData['insuredCategory'] ?></td>
                </tr>
                <tr>
                    <th>Date of disease</th>
                    <td><?php echo $essentialData['dateOfDisease'] ?></td>
                    <th>Cattle Buried</th>
                    <td><?php echo $essentialData['cattle_buried'] ?></td>
                </tr>
                <!--<tr>
                    <th>Tag Tempered </th>
                    <td colspan="3"><?php echo $essentialData['tag_tempered'] ?></td>
                </tr> -->
                <tr>
                    <th>Health Cert. No</th>
                    <td><?php echo $caseData['HelthCertificate'] ?></td>
                    <th>Health Cert. Issuance Date</th>
                    <td><?php echo $caseData['healthDatePicker'] ?></td>
                </tr>
                <tr>
                    <th style="width:20%">Policy No.</th>
                    <td style="width:30%"><?php echo $caseData['policyNumber'] ?></td>
                    <th style="width:20%">Period of Coverage</th>
                    <td style="width:30%">
                    <?php
                    // Check if both `periodOfCoverage` and `periodCovTo` are set
                    $periodOfCoverage = isset($essentialData['periodOfCoverage']) ? $essentialData['periodOfCoverage'] : 'N/A';
                    $periodCovTo = isset($caseData['periodCovTo']) ? $caseData['periodCovTo'] : 'N/A';

                    echo $periodOfCoverage . " To " . $periodCovTo;
                    ?>
                    </td>

                </tr>
                <tr>
                    <th>Sum insured in Health Certificate</th>
                    <td><?php echo $caseData['amount1'] ?></td>
                    <th>Premium Paid by Insured</th>
                    <td><?php echo $caseData['amount2'] ?></td>
                </tr>
                <tr>
                    <th>Milking Capacity in Health Certificate</th>
                    <td col><?php echo $caseData['milkingCapacity'] ?></td>
                    <th>Health cert. issued by doctor(Name of Dr.)</th>
                    <td><?php echo $caseData['doctorName'] ?></td>
                </tr>
                <tr>
                    <th>Type of Animal</th>
                    <td><?php echo $essentialData['typeOfAnimal'] ?></td>
                    <th>Breed</th>
                    <td><?php echo $caseData['breed'] ?></td>
                </tr>
                <tr>
                    <th>Birth/Natural Mark</th>
                    <td><?php echo $caseData['birthNaturalMark'] ?></td>
                    <th>Sex</th>
                    <td><?php echo $caseData['Gender'] ?></td>
                </tr>

                <tr>
                    <th>Total No. of Animal in family</th>
                    <td><?php echo $caseData['totalAnimal'] ?></td>
                    <th>Total No. of Animal insured in the scheme</th>
                    <td><?php echo $caseData['totalAnimalInsured'] ?></td>
                </tr>

            </tbody>
        </table>
        <div class="page-break">
            <h6 class="table-title" style="margin-top:10px;">B. Bank Detail</h6>
            <table>
                <tbody>
                    <tr style="border-top:none;">
                        <th style="width:27%;">If any loan taken for animal</th>
                        <td style="width:23%;"><?php echo $caseData['anyLoanTaken']; ?></td>
                        <th style="width:27%;">Individual Family/Animal Dairy </th>
                        <td style="width:20%;" colspan="3"><?php echo isset($caseData['individualFamily']) ? $caseData['individualFamily'] : 'NA' ?></td>
                    </tr>

                    <tr>
                        <th>Loan Running</th>
                        <td><?php echo $caseData['loanRunning'] ?></td>
                        <th>Name & address of bank of owner where claim will be paid</th>
                        <td colspan="3"><?php echo $caseData['accountNumberInput'] ?></td>
                    </tr>
                    <tr style="border-top:none;">
                        <th style="width:25%;border-top:none;">
                            <?php if ($caseData['loanRunning'] == 'Yes') {
                                echo 'Loan';
                            } else {
                                echo 'Saving';
                            }  ?>
                            Account No.</th>
                        <td style="width:21%;border-top:none;"><?php echo $caseData['accountNumber_saving_account'] ?></td>
                        <th style="width: 25%;border-top:none;">IFSC Code</th>
                        <td style="width: 21%;border-top:none;" colspan="3"><?php echo $caseData['ifscCode'] ?></td>
                    </tr>
                    <tr>
                        <th>Name Of account Holder as per bank records</th>
                        <td><?php echo $caseData['accountHolder'] ?></td>
                        <th>Bank Details as per</th>
                        <td colspan="3"><?php echo $caseData['bankDetails'] ?></td>
                    </tr>
                </tbody>
            </table>
        
        <h6 class="text-center table-title" style="margin-top:10px;">C. About cause of Loss, Treatment and Fitness of animal before death
        </h6>
        <table>
            <tr>
                <th style="width:25%">Date of Disease start</th>
                <td style="width:25%"><?php echo $essentialData['dateOfDisease'] ?></td>
                <th style="width:25%;">Date and Time of death</th>
                <td  colspan="6"><?php echo $essentialData['dateOfDeath'] . ' ' . $essentialData['timeOfDeath']; ?></td>
            </tr>
            <tr>
                <th>Survey Date & Time</th>
                <td><?php echo $essentialData['dateOfSurvey'] . ' ' . $essentialData['timeOfSurvey'] ?></td>
                <th style="border-right: 1px solid black;">Days between policy and disease start</th>
                <td colspan="6"> <?php echo $essentialData['days_between_policy_and_disease'] ?></td>
            </tr>
            <tr>
                <td>Survey Conducted Same day of Death</td>
                <td <?php if ($essentialData['SurveyConducted'] == "Yes") { ?> colspan="8" <?php } ?>; ?> <?php echo $essentialData['SurveyConducted']; ?></td>
                <?php if ($essentialData['SurveyConducted'] != "Yes") { ?>
                    <td>Why survey not conducted same day?</td>
                    <?php if ($essentialData['whysurveyNotConducted'] === "surveylateconducted_1") {
                        echo $whysurveynotconducted = "Received late intimation";
                    } elseif ($essentialData['whysurveyNotConducted'] === "surveylateconducted_2") {
                        echo $whysurveynotconducted = "Owner not available";
                    } elseif ($essentialData['whysurveyNotConducted'] === "surveylateconducted_3") {
                        echo $whysurveynotconducted = "Weather not permitting";
                    } elseif ($essentialData['whysurveyNotConducted'] === "surveylateconducted_4") {
                        echo $whysurveynotconducted = "Animal not available / already buried";
                    } ?>
                    <td colspan="6"><?php echo $whysurveynotconducted . ' ' . "hence same day survey could not be arranged."; ?>

                    </td>
                <?php } ?>
            </tr>
            <tr>
                <th>Death / Disablement</th>
                <td><?php echo $essentialData['deathOrDisablement'] ?></td>
                <th>Disposal of animal carcass</th>
                <td colspan="6"><?php echo $caseData['animalDisposal'] ?></td>
            </tr>
            <?php if ($caseData['pmr'] === "Yes") { ?>
                <tr>
                    <th>Disease/ Reason of Death</th>
                    <td><?php echo $caseData['reason_of_death'] ?></td>
                    <th>Post Mortem Date & Time</th>
                    <td colspan="6"><?php echo isset($caseData['dateTimePostMortem']) ? $caseData['dateTimePostMortem'] . ' ' . $caseData['pmr_time'] : 'NA'; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th>Date of last Calving</th>
                <td><?php echo $caseData['calvingDate'] ?></td>
                <th>Pregnant</th>
                <td colspan="6"><?php echo $caseData['pregnant'] ?></td>
            </tr>
            <?php if ($caseData['pmr'] === "Yes") { ?>
                <tr>
                    <th> Name of Dr. who conducted PMR</th>
                    <td><?php echo isset($caseData['nameOfdoctor']) ? $caseData['nameOfdoctor'] : 'NA'; ?></td>

                    <th>Mobile number of doctor</th>
                    <td colspan="6"><?php echo isset($caseData['doctorContactNumber']) ? $caseData['doctorContactNumber'] : 'NA'; ?></td>
                </tr>
                <tr>
                    <th>Type of animal as per PMR</th>
                    <td><?php echo isset($essentialData['typeOfAnimal']) ? $essentialData['typeOfAnimal'] : 'NA'; ?></td>
                    <th>Breed as per PMR</th>
                    <td colspan="6"><?php echo isset($caseData['breed']) ? $caseData['breed'] : 'NA'; ?></td>
                </tr>
                <tr>
                    <th>Age of animal as per PMR</th>
                    <td><?php echo $caseData['ageOfAnimal'] ?></td>
                    <th>Tag No. as per PMR</th>
                    <td colspan="6"><?php echo $caseData['tagAsPerPMR'] ?></td>
                </tr>

                <tr>
                    <th>Cause of Death in PMR</th>
                    <td><?php echo $caseData['causeOfDeathAsPerPMR'] ?></td>
                    <th>Cause of death as per insured statement</th>
                    <td colspan="6"><?php echo $caseData['causeOfDeathAsPerInsured'] ?></td>
                </tr>
            <?php } ?>
            <?php if ($caseData['treatment_chart'] === "Yes") { ?>
                <tr>
                    <th>Treatment start date</th>
                    <td><?php echo isset($caseData['treatmentDate']) ? $caseData['treatmentDate'] : 'NA'; ?></td>
                    <th>Who administered treatment</th>
                    <td colspan="6"><?php echo isset($caseData['whoAdministeredTreatment']) ? $caseData['whoAdministeredTreatment'] : 'NA'; ?></td>
                </tr>
                <tr>
                    <th>Treatment Administered</th>
                    <td><?php echo isset($caseData['administeredTreatment']) ? $caseData['administeredTreatment'] : 'NA'; ?></td>
                    <th>The Treatment administered seems to be satisfactory and sufficient</th>
                    <td colspan="6"><?php echo $caseData['satisfactory_and_sufficient'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th> Health </th>
                <td><?php echo $caseData['physicalHealthText'] ?></td>
                <th>Expected market value of Animal</th>
                <td colspan="6"><?php echo $caseData['physicalHealthOfAnimal'] ?></td>
            </tr>
            <tr>
                <th>If animal was purchased , Date & amount of purchase of animal</th>
                <td><?php echo $caseData['dateAndAmountOfPurchase'] ?></td>
                <th>Any Disability/special marks observed in animal</th>
                <td colspan="6"><?php echo $caseData['anyDisavility'] ?></td>
            </tr>
        </table>
        <table>
            <tr style="border-top:none;">
                <th style="border-top:none;">Clean PMR</th>
                <td style="width:26%;border-top:none;"><?php echo isset($caseData['clean_pmr']) ? $caseData['clean_pmr'] : 'NA'; ?></td>
            </tr>
        </table>

        <h6 class="table-title" style="margin-top:10px;">D. Statement of insured</h6>
        <table>
            <tbody>
                <tr style="border-right:1px solid black;">
                    <td style="border-right:1px solid black;width:20%;"><p class="card-text" style="margin-bottom: 2px;"><?php echo $caseData['statement_of_insured'] ?></p></td>
                </tr>
            </tbody>
        </table>

        <h6 class="table-title" style="margin-top:10px;">E. Statement of villagers</h6>
        <table>
            <tbody>
                <tr style="border-right:1px solid black;">
                    <td style="border-right:1px solid black;width:20%;"><p class="card-text" style="margin-bottom: 2px;"><?php echo $caseData['statement_of_villagers'] ?>
                            </p></td>
                </tr>
            </tbody>
        </table>

        <h6 class="table-title" style="margin-top:10px;">F. Statement of two authorized person on form</h6>
        <table>
            <tbody>
                <tr style="border-right:1px solid black;">
                    <td style="border-right:1px solid black;width:20%;"><p class="card-text" style="margin-bottom: 2px;"><?php echo $caseData['statement_of_two_authorized'] ?></p></td>
                </tr>
            </tbody>
        </table>
        </div>
        <h6 class="text-center table-title" style="margin-top:10px;">G. Observation/Conclusion Of Investigator</h6>
        <table>
            <tbody>
                <tr>
                    <td class="seriel_no">1.</td>
                    <th>The animal bearing the above tag was insured with underwriters as stated above. We have checked and matched the tag number and other details as per the policy. However, the live animal photos were not seen by us. Kindly verify the animal before settling the claim.</th>
                    <td class="enlosures"><?php echo $caseData['observation_1'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">2.</td>
                    <th>As per our observations, the animal was living in good condition with proper food and shelter. There is no contributory negligence on the part of the owner in the alleged death of the animal.</th>
                    <td class="enlosures"><?php echo $caseData['observation_2'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">3.</td>
                    <th>The details of the death (date and time, cause of death, etc.) as informed by the insured were found to be correct in our investigation.</th>
                    <td class="enlosures"><?php echo $caseData['observation_3'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">4.</td>
                    <th>Proper and timely treatment was administered to animal</th>
                    <td class="enlosures"><?php echo $caseData['observation_4'] ?></td>
                    <!-- <td class="enlosures">Data Not found</td> -->
                </tr>
                <tr>
                    <td class="seriel_no">5.</td>
                    <th>Our investigator personally visited the place of death and investigated the case. His selfie is also attached. Additionally, we have attached a photo of the animal attendant/owner taken by us.</th>
                    <td class="enlosures">
                        <?php echo $caseData['observation_5'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="seriel_no">6.</td>
                    <th style="border-right:1px solid black;">The tag was present in the ear of the dead animal and was intact. It was cut in our presence and retained by the owner for verification by the doctor.</th>
                    <td class="enlosures"> <?php echo $caseData['observation_6'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">7.</td>
                    <th>Our photos were taken with GPS coordinates, along with a date and time stamp, to the best of our technical capabilities.</th>
                    <td class="enlosures" style="border-top:1px solid black"><?php echo $caseData['observation_7'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">8.</td>
                    <th>The tag has been collected and is currently being attached with this report.</th>
                    <td class="enlosures"><?php echo $caseData['observation_8'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">9.</td>
                    <th style="border-right:1px solid black;">The animal carcass was available for investigation, and the body was not deteriorated.</th>
                    <td class="enlosures"><?php echo $caseData['observation_9'] ?></td>
                    <!-- <td>Not found</td> -->
                </tr>
            </tbody>
        </table>
        <?php
        // Check if $caseData is set and is an array
        if (isset($caseData) && is_array($caseData)) {
        // Check if 'remarkObservation' exists and is not empty
        if (isset($caseData['remarkObservation']) && !empty($caseData['remarkObservation'])) {
            // Extract and format the remarkObservation for HTML output
            $remarkObservation = $caseData['remarkObservation'];
            $remarkObservationFormatted = nl2br(htmlspecialchars($remarkObservation, ENT_QUOTES, 'UTF-8'));
        } else {
            // Handle the case where 'remarkObservation' is not set or is empty
            $remarkObservationFormatted = 'No remarks available.';
        }
        } else {
        // Handle the case where $caseData is not properly set
        $remarkObservationFormatted = 'Error: Data not available.';
        }
        ?>    <!-- <div class="page-break"></div> -->
        <?php if (!empty($remarkObservationFormatted)): ?>
            <h6 class="table-title" style="margin-top:10px;">H. Remarks About Observation</h6>
            <table>
                <tbody>
                    <tr style="border-right:1px solid black;">
                        <td style="border-right:1px solid black;width:20%;"><p class="card-text">
                                <?php echo $remarkObservationFormatted; ?>
                            </p></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

       <h6 class="table-title" style="margin-top:10px;">I. Photographs</h6>

        <?php if (!empty($images)) : ?>
            <table class="tablesaw table-striped table-bordered table-hover photographs">
                <?php $index = 0; ?>
                <?php foreach ($images as $img) { ?>
                    <?php if ($index % 2 == 0) : ?>
                        <tr>
                        <?php endif; ?>
                        <td style="width:50%;">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents('uploads/' .  $aid . '/images/' . $img)); ?>" 
                                 style="width:100%; max-height:240px;" 
                                 alt="Image <?php echo $index + 1; ?>">
                        </td>
                        <?php if ($index % 2 != 0 || $index == count($images) - 1) : ?>
                        </tr>
                    <?php endif; ?>
                    <?php $index++; ?>
                <?php } ?>
            </table>
        <?php else : ?>
            <p style="text-align:center; font-weight:bold; color:#777;">No photos available</p>
        <?php endif; ?>

       
        <p style="font-size: 16px;"> This report is issued without prejudice, in respect of cause, nature and extent of
            loss / damage and subject to terms and conditions of the insurance policy insurers admitting liability</p>

        <div style="margin-top: 0px; text-align: right;">
    <h5 style="font-size: 16px;">
       <?php if (!empty($companyname['companyName'])) { ?>
                       <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php } ?>
        <br><br><br><br><br>
        <span style="font-weight: 400;">Authorized Signatory and Stamp</span>
    </h5>

</div>

    </div>
</body>

</html>