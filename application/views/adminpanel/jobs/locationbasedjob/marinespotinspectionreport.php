<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre Inspection Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="http://fonts.cdnfonts.com/css/new-cicle" rel="stylesheet">

    <style>
        table {
            max-width: 100%;
            width: 100%;
            font-size: 10px;
        }

        th,
        td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .responsive-table {
            width: 100%;
            overflow-x: auto;
            font-size: 10px;
            max-width: 100%;
        }

        body {
            font-family: 'New Cicle', sans-serif;
            /* margin-top: -10px; */
            margin-left: -25px;
            margin-right: -25px;
            margin-bottom: -10px;
            margin-top: -25px;
        }

        .header {
            height: 50px;
            border-collapse: collapse;
            font-size: 11px;
            top: 0;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0px;
            right: 0px;
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

        .flyleaf {
            page-break-after: always;
            margin-left: 5px;
            margin-right: 5px;
        }

        .page-break {
            page-break-after: always;
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
            font-size: 14px;
            font-weight: 600;
        }

        /* .date {
            padding-top: 0px;
            margin-top: 0px;
        } */

        .report-date {
            float: right;
            font-size: 14px;
            font-weight: 600;
        }

        .card-container {
            border: 1px solid black;
            padding: 0;
        }

        .card-title {
            font-weight: 600;
            color: black;
            background-color: #e3e3e3;
            border-bottom: 1px solid black;
            margin-top: 0px;
            font-size: 15px;
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
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        .enlosures {
            text-align: center;
            width: 50px;
        }

        .seriel_no {
            text-align: center;
            width: 30px;
        }

        .container {
            max-width: 1100px;
            margin: 0;
            padding: 0;
            display: contents;
        }

        .left-sequence {
            width: 5%;
            text-align: center;
        }

        .key-heading {
            font-weight: bold;
            width: 30%;
        }

        .table-cell-heading {
            font-size: 14px;
            font-weight: bold;
        }

        .table-cell {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container ">
        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 760px;height:25%">
        <table>
            <tbody>
                <tr>
                    <th style="border: none">Report No: <?php echo $essentialData['case_reference']; ?></th>
                    <!-- <th style="border: none; font-weight:600">INTERIM LOSS ADVISE<br><span style="font-size:12px;">Claims Ref. No.</span></th> -->
                    <th style="border: none; text-align:right">Date: <?php echo date('d-m-Y', strtotime($essentialData['date_of_report'])); ?><br><span><?php echo $username; ?></span></th>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody style="padding:30px">
                <tr>
                    <td style="border: none; width:90%; self-align:center;">
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

                        <p style="color: black;">
                            To,<br>
                            Claims Manager<br>
                            <?php echo $essentialData['policy_by']; ?><br>
                            <?php echo $firstLine . '<br>' . $secondLine; ?>
                        </p>
                    </td>
                    <td style="border: none">
                        <span style="font-size:10px; color:red; text-align:center">For Photos Scan Here</span>
                        <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">
                        <!-- <span style="font-size:10px;"><a style="padding-left:30%" href="<?php echo base_url('downloadmedia/' . $essentialData['aid'] . ''); ?>" alt="download report">Download</a></span> -->
                    </td>
                </tr>
            </tbody>
        </table>
        <h6 class="text-center table-title">Marine Spot ILA</h6>
        <table>
            <tbody>
                <tr>
                    <th class="left-sequence">a</th>
                    <th class="key-heading">Insured / Client</th>
                    <th colspan="6"><?php echo $essentialData['insured_name']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">b</th>
                    <th class="key-heading">Consignee</th>
                    <th colspan="6"><?php echo $essentialData['name_of_consignee']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">c</th>
                    <th class="key-heading">Consignor</th>
                    <th colspan="6"><?php echo $essentialData['consignor']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">d</th>
                    <th class="key-heading">Cargo Damaged</th>
                    <th colspan="6"><?php echo $essentialData['cargo']; ?></th>

                </tr>
                <tr>
                    <th class="left-sequence">e</th>
                    <th class="key-heading">Policy Number</th>
                    <th colspan="6"><?php echo $essentialData['policyNumber']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">f</th>
                    <th class="key-heading">Survey allotment date</th>
                    <th colspan="6"><?php echo $essentialData['survey_allotment_date']; ?></th>

                </tr>
                <tr>
                    <th class="left-sequence">g</th>
                    <th class="key-heading">Survey Date</th>
                    <th colspan="6"><?php echo $essentialData['survey_date']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">h</th>
                    <th class="key-heading">Type of Damage</th>
                    <th colspan="6"><?php echo $essentialData['type_of_loss']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">i</th>
                    <th class="key-heading">Cause of Loss</th>
                    <th colspan="6"><?php echo $essentialData['cause_loss']; ?></th>
                </tr>

                <tr>
                    <th class="left-sequence">j</th>
                    <th class="key-heading">GR Number</th>
                    <th colspan="6">
                        <table>
                            <thead>
                                <tr>
                                    <th class="table-cell-heading">GR Number</th>
                                    <th class="table-cell-heading">GR Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if GR data is available
                                if (!empty($essentialData['gr'])) {
                                    // Loop through each GR entry
                                    foreach ($essentialData['gr'] as $gr) {
                                        // Ensure that all necessary fields are present and safe for output
                                        $grnumber = isset($gr['grnumber']) ? htmlspecialchars($gr['grnumber']) : 'NA';
                                        $grdate = isset($gr['grdate']) ? date('d-m-Y', strtotime($gr['grdate'])) : 'NA';
                                        echo '<tr>';
                                        echo '<td class="table-cell">' . $grnumber . '</td>';
                                        echo '<td class="table-cell">' . $grdate . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    // Display message if no GR data
                                    echo '<tr><td colspan="2">No GR data available</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </th>
                </tr>

                <tr>
                    <th class="left-sequence">k</th>
                    <th class="key-heading">STN / Invoice No.</th>
                    <th colspan="6">
                        <table>
                            <thead>
                                <tr>
                                    <th class="table-cell-heading">Invoice Number</th>
                                    <th class="table-cell-heading">Invoice Date</th>
                                    <th class="table-cell-heading">Invoice Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if invoice data is available
                                if (!empty($essentialData['invoices'])) {
                                    // Loop through each invoice entry
                                    foreach ($essentialData['invoices'] as $invoice) {
                                        // Ensure that all necessary fields are present and safe for output
                                        $invoicenumber = isset($invoice['invoicenumber']) ? htmlspecialchars($invoice['invoicenumber']) : 'NA';
                                        $invoicedate = isset($invoice['invoicedate']) ? date('d-m-Y', strtotime($invoice['invoicedate'])) : 'NA';
                                        $invoicevalue = isset($invoice['invoicevalue']) ? htmlspecialchars($invoice['invoicevalue']) : 'NA';

                                        echo '<tr>';
                                        echo '<td class="table-cell">' . $invoicenumber . '</td>';
                                        echo '<td class="table-cell">' . $invoicedate . '</td>';
                                        echo '<td class="table-cell">' . $invoicevalue . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    // Display message if no invoice data
                                    echo '<tr><td colspan="3">No Invoice data available</td></tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </th>
                </tr>

                <tr>
                    <th class="left-sequence">l</th>
                    <th class="key-heading">Packing description</th>
                    <th colspan="6"><?php echo $essentialData['packing_description']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">m</th>
                    <th class="key-heading">Claimant's representative during Survey</th>
                    <th style="width:20%"><?php echo $essentialData['claimant_representative']; ?></th>
                    <th class="key-heading">Mobile No.</th>
                    <th colspan="4"><?php echo $essentialData['representative_mobile']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">n</th>
                    <th class="key-heading">Survey place</th>
                    <th colspan="6"><?php echo $essentialData['survey_place']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">o</th>
                    <th class="key-heading">Date of Loss</th>
                    <th colspan="6"><?php echo $essentialData['loss_data']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence">p</th>
                    <th class="key-heading">Total consignment value</th>
                    <th colspan="6">Rs. <?php echo $essentialData['consignment_value']; ?></th>

                </tr>

                <tr>
                    <th class="left-sequence">q</th>
                    <th class="key-heading">Estimated Loss</th>
                    <th colspan="6">Rs. <?php echo $essentialData['estimated_amount']; ?></th>
                </tr>

                <tr>
                    <th class="left-sequence">r</th>
                    <th class="key-heading"> Salvage amount
                        <?php
                        if ($essentialData['lumsum'] == 'Percentage') {
                            echo "/ " . htmlspecialchars($essentialData['salvage_amount']);
                        }
                        ?></th>
                    <th> <?php
                            $salvage = $essentialData['salvage_amount'];
                            // $consignmentValue = floatval(str_replace(',', '', $essentialData['consignment_value']));
                            $estimatedLoss = floatval(str_replace(',', '', $essentialData['estimated_amount']));
                            if (strpos($salvage, '%') !== false) {
                                // Remove the "%" symbol and calculate the percentage
                                $percentage = floatval(str_replace('%', '', $salvage));
                                $result = ($estimatedLoss * $percentage) / 100;
                                echo "Rs. " . number_format($result, 2);
                            } elseif ($salvage === "NA") {
                                echo "Rs. " . number_format($estimatedLoss, 2);
                            } elseif (is_numeric($salvage)) {
                                echo "Rs. " . number_format(floatval($salvage), 2);
                            } else {
                                echo "Rs. " . number_format(floatval($salvage), 2);
                            }
                            ?></th>
                    <th class="key-heading">Loss amount net of salvage</th>
                    <th colspan="4">
                         <?php
                        $salvage = $essentialData['salvage_amount'];
                        // $consignmentValue = floatval(str_replace(',', '', $essentialData['consignment_value']));
                        $estimatedLoss = floatval(str_replace(',', '', $essentialData['estimated_amount']));
                        if (strpos($salvage, '%') !== false) {
                            // Remove the "%" symbol and calculate the percentage
                            $percentage = floatval(str_replace('%', '', $salvage));
                            $result = ($estimatedLoss * $percentage) / 100;
                            $netamount = $estimatedLoss -  $result;
                            echo "Rs. " . number_format($netamount, 2);
                        } elseif ($salvage === "NA") {
                            echo "Rs. " . number_format($estimatedLoss, 2);
                        } elseif (is_numeric($salvage)) {
                            echo "Rs. " . number_format($estimatedLoss - floatval($salvage), 2);
                        } else {
                            echo "Rs. " . number_format(floatval($salvage), 2);
                        }
                        ?>
                    </th>
                </tr>
                <?php if (isset($essentialData['claim_assessment'])) { ?>
                    <tr>
                        <th class="left-sequence">s</th>
                        <th class="key-heading">Further action</th>
                        <th colspan="6"><?php echo $essentialData['claim_assessment']; ?></th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- <h6 class="text-center table-title">Assessment</h6>
        <div class="responsive-table">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $essentialData['claim_assessment']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4" style="float: right;">
            <h5 >V.P. Singhal & Co ISLA Pvt. Ltd</h5><br>
            <h5 style="float: right;">(surveyors & Assessors)</h5>
        </div>
        <footer>
            <table>
                <tbody>
                    <tr>
                        <th style="text-align:center">
                            V.P. Singhal & Co. ISLA Pvt. Ltd
                        </th>
                    </tr>
                </tbody>
            </table>
        </footer> -->

    </div>

</body>

</html>