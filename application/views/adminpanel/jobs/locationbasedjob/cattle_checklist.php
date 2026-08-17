<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .page-break {
                page-break-after: always;
            }

            .print-table {
                display: block !important;
            }
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        body {
            font-family: 'New Cicle', sans-serif;
            margin-top: -40px;
            margin-left: -25px;
            margin-right: -25px;
            margin-bottom: -10px;
        }

        th,
        td {
            border: 1px solid black;
            font-size: 13px;
            text-align: left;
            padding-left: 5px;
        }

        th {
            font-weight: 400;
        }

        .yes {
            padding-left: 0px;
        }

        .header {
            display: flex;
            justify-content: center;
        }

        .remove-top-border {
            border-top: none;
        }

        .table-title {
            background-color: #F0F0F0;
            margin-bottom: 0px;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 15px;
        }
        .text-center{
            text-align: center;
        }
       
    </style>
</head>

<body>
    <main>
        <div class="container" style="max-width:1078px;">
            
                <p class="text-center pt-2" style="font-weight: 600;"> <?php if (!empty($companyname['companyName'])) { ?>
                       <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php } ?>
                        
                    </p>
                    <p class="text-center " style="font-weight: 600;">Self Check List</p>
            </div>

            <div>
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 25%;">Type of Animal</th>
                            <td style="width: 20%;"><?php echo $essentialData['typeOfAnimal'] ?></td>
                            <td style="background-color: #F0F0F0; width: 45%;" colspan="6" class="text-center">Period of
                                Coverage
                            </td>
                        </tr>
                        <tr>
                            <th>Policy Number</th>
                            <td><?php echo $caseData['policyNumber'] ?></td>
                            <td colspan="5" class="text-center" style="width: 25%;">From</td>
                            <td class="text-center" style="width: 20%;">To</td>

                        </tr>
                        <tr>
                            <th rowspan="2">Health Certificate Number</th>
                            <td rowspan="2"><?php echo $caseData['HelthCertificate'] ?></td>
                            <th class="text-center" colspan="5"><?php echo $essentialData['periodOfCoverage'];?></th>
                            <th class="text-center"><?php echo $caseData['periodCovTo'] ?></th>
                        </tr>
                        <tr>
                            <th class="text-center" rowspan="" style="width:35%;">Days between insurance and death:</th>
                            <td class="text-center" colspan="5"><?php echo $essentialData['days_between_policy_and_disease'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 25%;background-color: #F0F0F0;" class="remove-top-border" rowspan="2">Date & Time of Death</th>
                            <th style="width: 20%;background-color: #F0F0F0;" class="remove-top-border">As per PMR</th>
                            <th style="width: 25%;background-color: #F0F0F0;" class="remove-top-border">As per Surveyor</th>
                            <th style="width: 20%;background-color: #F0F0F0;" class="remove-top-border" colspan="6">As per Beneficiary</th>
                        </tr>
                        <tr>
                            <td><?php echo $essentialData['dateOfDeath'].' '.$essentialData['timeOfDeath'] ?></td>
                            <td><?php echo $essentialData['dateOfDeath'].' '.$essentialData['timeOfDeath'] ?></td>
                            <td colspan="6"><?php echo $essentialData['dateOfDeath'].' '.$essentialData['timeOfDeath'] ?></td>
                        </tr>
                       <?php if (!empty($caseData['dateTimePostMortem']) && !empty($caseData['pmr_time'])): ?>
                            <tr>
                                <th>Date & Time of PMR</th>
                                <td>
                                    <?php echo $caseData['dateTimePostMortem'] . ' ' . $caseData['pmr_time']; ?>
                                </td>
                                <th>Date of Issue of PMR</th>
                                <th colspan="6">
                                    <?php echo $caseData['dateTimePostMortem'] . ' ' . $caseData['pmr_time']; ?>
                                </th>
                            </tr>
                        <?php else: ?>
                            <!-- Row is hidden, no need to output anything here -->
                        <?php endif; ?>


                        <tr>
                            <th>VS Signature on PMR</th>
                            <td><?php echo $caseData['vs_signature_on_pmr'] ?></td>
                            <th>VS Stamp on PMR?</th>
                            <td colspan="6"><?php echo $caseData['vs_stamp_on_pmr'] ?></td>
                        </tr>
                        <tr>
                            <th>Treatment chart available?</th>
                            <td><?php echo $caseData['treatment_chart'] ?></td>
                            <th>Period of Treatment(Days)</th>
                            <td colspan="6"><?php echo $caseData['period_of_treatment_days'] ?></td>
                        </tr>
                        <tr>
                            <th class="remove-top-border" rowspan="2" style="background-color: #F0F0F0;">Tag Number is correct</th>
                            <th class="remove-top-border" style="background-color: #F0F0F0;">As per Policy</th>
                            <th class="remove-top-border" style="background-color: #F0F0F0;">Health Certificate</th>
                            <th class="remove-top-border" colspan="6" style="background-color: #F0F0F0;">PMR</th>
                        </tr>
                        <tr>
                            <td><?php echo $caseData['tag_number_as_per_policy'] ?></td>
                            <td><?php echo $caseData['health_certificate_option'] ?></td>
                            <td colspan="6"><?php echo $caseData['pmr_option'] ?></td>
                        </tr>
                        <tr>
                            <th class="remove-top-border">Signed by Tehsildar?</th>
                            <td><?php echo $caseData['signed_by_tehsildar'] ?></td>
                            <th class="remove-top-border">Claims form Signed by Sarpanch?</th>
                            <td colspan="6"><?php echo $caseData['signed_by_sarpanch'] ?></td>
                        </tr>
                        <tr>
                            <th>Tag number </th>
                            <td><?php echo $essentialData['tagNumber'] ?></td>
                            <th>Dead Animal Photos Attached?</th>
                            <td colspan="6"><?php echo $caseData['dead_animal_photo_attached'] ?></td>
                        </tr>

                        <tr>
                            <th>Aadhar Number as per policy</th>
                            <td colspan="8"><?php echo $caseData['aadhar_number'] ?></td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <th>Particulars</th>
                            <th colspan="8">As per HC</th>

                        </tr>
                        <tr>
                            <th>Sum Insured</th>
                            <td colspan="8"><?php echo $caseData['amount1'] ?></td>

                        </tr>
                        <tr>
                            <th>Color</th>
                            <td colspan="8"><?php echo $caseData['birthNaturalMark'] ?></td>

                        </tr>
                        <tr>
                            <th>Age</th>
                            <td colspan="8"><?php echo isset($caseData['ageperhc']) && !empty($caseData['ageperhc']) ? $caseData['ageperhc'] : 'N/A'; ?>
</td>

                        </tr>
                        <tr>
                            <th>Insured Name</th>
                            <td colspan="8"><?php echo !empty($essentialData['insured_name']) ? $essentialData['insured_name'] : ($essentialData['nameofowner'] ?? ''); ?></td>

                        </tr>
                        <tr>
                            <th>Scheme Premium</th>
                            <td colspan="8"><?php echo $caseData['amount2'] ?></td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <th class="text-center" colspan="9">Bank Details of Beneficiary</th>
                        </tr>
                        <tr>
                            <th>Bank Name and Branch</th>
                            <td colspan="8"><?php echo $caseData['accountNumberInput'] ?></td>
                            
                        </tr>
                        <tr>
                            <th>Account Holder Name</th>
                            <td colspan="8"><?php echo $caseData['accountHolder'] ?></td>
                        </tr>
                        <tr>
                            <th>Account No.</th>
                            <td colspan="8"><?php echo $caseData['accountNumber_saving_account'] ?></td>
                           
                        </tr>
                        <tr>
                             <th>IFSC Code</th>
                            <td colspan="8"><?php echo $caseData['ifscCode'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       

        <h6 class="text-center table-title">Documents Attached</h6>
        <table>
            <tbody>
                <tr>
                    <td class="seriel_no">1.</td>
                    <th>Policy Copy</th>
                    <td class="enlosures"><?php echo $caseData['policy_copy'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">2.</td>
                    <th>Health Certificate</th>
                    <td class="enlosures"><?php echo $caseData['health_certificate'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">3.</td>
                    <th>Claim Intimation Letter</th>
                    <td class="enlosures"><?php echo $caseData['claim_intimation_letter'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">4.</td>
                    <th>Discharge Voucher</th>
                    <td class="enlosures"><?php echo $caseData['discharge_voucher'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">5.</td>
                    <th>SC Certificate</th>
                    <td class="enlosures"><?php echo $caseData['sc_certificate'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">6.</td>
                    <th>A/C Number with NEFT Details with IFSC Code</th>
                    <td class="enlosures"><?php echo $caseData['account_number'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">7.</td>
                    <th>PMR with signature & stamp</th>
                    <td class="enlosures"><?php echo $caseData['pmr_with_signature'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">8.</td>
                    <th>Treatment chart (if illness above 2 days)</th>
                    <td class="enlosures"><?php echo $caseData['treatment_chart'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">9.</td>
                    <th>Statement of Insured</th>
                    <td class="enlosures"><?php echo $caseData['insured_statement'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">10.</td>
                    <th>Claim form with signature & stamp minimum two goverment officiers (Doctor Signature & stamp
                    is mandatory)</th>
                    <td class="enlosures"><?php echo $caseData['claim_form_with_signature'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">11.</td>
                    <th>Copy of Aadhar Card of insured</th>
                    <td class="enlosures"><?php echo $caseData['copy_of_adhar_card'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">12.</td>
                    <th>Photo of dead animal with date</th>
                    <td class="enlosures"><?php echo $caseData['photo_of_dead'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">13.</td>
                    <th>Investigator report with signature & stamp</th>
                    <td class="enlosures"><?php echo $caseData['investigator_report'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">14.</td>
                    <th>Tag Available</th>
                    <td class="enlosures"><?php echo $caseData['tag_available'] ?></td>
                </tr>
                <tr>
                    <td class="seriel_no">15.</td>
                    <th>Fir Attached</th>
                    <td class="enlosures"><?php echo $caseData['fir_attached'] ?></td>
                </tr>
                
            </tbody>
        </table>
    </main>
    <div class="container" style="max-width: 1078px;">
        <footer class="page-footer mt-4">
           <div>
                <p class="text-center pt-2" style="font-weight: 600;">  
                  
                    <?php if (!empty($companyname['companyName'])) { ?>
                       <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php } ?>

                </p>
                <p class="text-center" style="font-weight: 600;">Cattle Claims</p>
            </div>

        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>