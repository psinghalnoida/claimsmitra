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
        @page {
            counter-increment: page;
            margin: 60px 28px 60px 30px;
        }

        .flyleaf {
            page-break-after: always;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: -10px;
            margin-bottom: -5px;
        }


        table {
            max-width: 100%;
            width: 100%;
            font-size: 12px;
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
            font-size: 12px;
            max-width: 100%;
        }

        /* body {
            padding: 0;
            margin: 0;

        } */

        .header {
            height: 50px;
            border-collapse: collapse;
            font-size: 12px;
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
            font-size: 12px;
            width: 60%;
        }

        .sub-table td {
            font-size: 12px;
            width: 60%;
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
            font-size: 12px;
        }

        th {
            border: 1px solid #000;
            text-align: left;
            padding-left: 3px;
            font-weight: 400;
            font-size: 12px;
        }

        .reprtNumber {
            float: left;
            font-size: 12px;
            font-weight: 600;
        }

        /* .date {
            padding-top: 0px;
            margin-top: 0px;
        } */

        .report-date {
            float: right;
            font-size: 12px;
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
            font-size: 12px;
            padding-bottom: 0px;
            padding: 4px;
        }

        .card-text {
            font-size: 12px;
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
            font-size: 12px;
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

       
        .left-sequence {
            width: 5%;
            text-align: center;
        }

        .key-heading {
            font-weight: bold;
            width: 30%;
        }

        .table-cell-heading {
            font-size: 12px;
            font-weight: bold;
        }

        .table-cell {
            font-size: 12px;
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
                                $policyBranch = $essentialData['appointment_branch_name'];
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
                                    <?php echo $essentialData['appoint_by']; ?><br>
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
        <h6 class="text-center table-title">Marine Final ILA</h6>
        <table>
            <tbody>
                <tr>
                    <?php $counter = 1; ?>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Insured / Client</th>
                    <th colspan="6"><?php echo $essentialData['insured_name']; ?></th>
                </tr>
                 <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Insurer</th>
                    <th colspan="6"><?php echo $essentialData['policy_by']; ?></th>
                </tr>
                 <?php if (!empty($essentialData['broker_no'])) { ?>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Broker Reference No.</th>
                    <th colspan="6"><?php echo $essentialData['broker_no']; ?></th>
                </tr>
                <?php } ?>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Consignee</th>
                    <th colspan="6"><?php echo $essentialData['name_of_consignee']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Consignor</th>
                    <th colspan="6"><?php echo $essentialData['consignor']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Cargo Damaged</th>
                    <th colspan="6"><?php echo $essentialData['cargo']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Policy Number</th>
                    <th colspan="6"><?php echo isset($essentialData['policyNumber']) && !empty($essentialData['policyNumber']) ? $essentialData['policyNumber'] : 'N/A'; ?>
                    </th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Survey allotment date</th>
                    <th colspan="6"><?php echo $essentialData['survey_allotment_date']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Survey Date</th>
                    <th colspan="6"><?php echo $essentialData['survey_date']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Type of Damage</th>
                    <th colspan="6"><?php echo $essentialData['type_of_loss']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Cause of Loss</th>
                    <th colspan="6"><?php echo isset($essentialData['cause_loss']) && !empty($essentialData['cause_loss']) ? $essentialData['cause_loss'] : 'N/A'; ?>
                    </th>
                </tr>
                <!-- <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
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
                                
                                if (!empty($essentialData['gr'])) {
                                  
                                    foreach ($essentialData['gr'] as $gr) {
                                        
                                        $grnumber = isset($gr['grnumber']) ? htmlspecialchars($gr['grnumber']) : 'NA';
                                        $grdate = isset($gr['grdate']) ? strtotime($gr['grdate']) ? date('d-m-Y', strtotime($gr['grdate'])) : 'NA' : 'NA';

                                        echo '<tr>';
                                        echo '<td class="table-cell">' . $grnumber . '</td>';
                                        echo '<td class="table-cell">' . $grdate . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                  
                                    echo '<tr><td colspan="2" style="text-align:center; color: #999;">No GR data available</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                    </th>
                </tr> -->

                 <?php
                $validGRs = [];
                if (!empty($essentialData['gr']) && is_array($essentialData['gr'])) {
                    foreach ($essentialData['gr'] as $gr) {
                        $grnumber = trim($gr['grnumber'] ?? '');
                        $grdate = trim($gr['grdate'] ?? '');

                        if ($grnumber !== '' && strtolower($grnumber) !== 'na' && $grnumber !== null &&
                            $grdate !== '' && strtolower($grdate) !== 'na' && $grdate !== null) {
                            $validGRs[] = [
                                'grnumber' => htmlspecialchars($grnumber),
                                'grdate' => strtotime($grdate) ? date('d-m-Y', strtotime($grdate)) : 'NA'
                            ];
                        }
                    }
                }

                if (!empty($validGRs)) {
                ?>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
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
                                <?php foreach ($validGRs as $gr) { ?>
                                    <tr>
                                        <td class="table-cell"><?php echo $gr['grnumber']; ?></td>
                                        <td class="table-cell"><?php echo $gr['grdate']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </th>
                </tr>
                <?php } ?>

                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
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
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Packing description</th>
                    <th colspan="6"><?php echo $essentialData['packing_description']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Claimant's representative during Survey</th>
                    <th style="width:20%"><?php echo $essentialData['claimant_representative']; ?></th>
                    <th class="key-heading">Mobile No.</th>
                    <th colspan="4"><?php echo $essentialData['representative_mobile']; ?></th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Survey place</th>
                    <th style="width:20%"><?php echo $essentialData['survey_place']; ?></th>
                    <th class="key-heading">Pincode</th>
                    <th colspan="4"><?php echo isset($essentialData['pincode']) && !empty($essentialData['pincode']) ? $essentialData['pincode'] : 'N/A'; ?>
                    </th>
                </tr>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Date of Loss</th>
                    <th colspan="6">
                        <?php
                        echo isset($essentialData['loss_date_text']) && !empty($essentialData['loss_date_text']) 
                            ? $essentialData['loss_date_text'] 
                            : (isset($essentialData['loss_data']) && !empty($essentialData['loss_data']) 
                                ? $essentialData['loss_data'] 
                                : 'N/A');
                        ?>
                    </th>

                </tr>
                <?php if (isset($essentialData['print_estimated_amt']) && $essentialData['print_estimated_amt'] == 1): ?>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Total consignment value</th>
                    <th colspan="6">Rs. <?php echo $essentialData['consignment_value']; ?></th>
                </tr>
              <?php endif; ?>
                
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Estimated Loss / Liability</th>
                    <th colspan="6">Rs. <?php echo isset($essentialData['estimated_amount']) ? formatRupees($essentialData['estimated_amount']) : 'NA'; ?></th>
                </tr>
                  <?php
                    $estimatedLoss = isset($essentialData['estimated_amount']) ? floatval(str_replace(',', '', $essentialData['estimated_amount'])) : null;
                    $salvage = isset($essentialData['salvage_amount']) ? $essentialData['salvage_amount'] : null;
                    if ($estimatedLoss !== null && $salvage !== null):
                  ?>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <?php if (isset($essentialData['print_salvage_amt']) && $essentialData['print_salvage_amt'] == 1): ?>
                        <th class="key-heading">
                            Salvage amount 
                            <?php
                            if ($essentialData['lumsum'] == 'Percentage') {
                                echo " / " . htmlspecialchars($essentialData['salvage_amount']);
                            }
                            ?>
                        </th>
                        <th>
                            <?php
                            if (strpos($salvage, '%') !== false) {
                                // Remove the "%" symbol and calculate the percentage
                                $percentage = floatval(str_replace('%', '', $salvage));
                                $result = ($estimatedLoss * $percentage) / 100;
                                echo "Rs. " . formatRupees($result);
                            } elseif ($salvage === "NA") {
                                echo "Rs. " . formatRupees($estimatedLoss);
                            } elseif (is_numeric($salvage)) {
                                echo "Rs. " . formatRupees(floatval($salvage));
                            } else {
                                echo "Rs. " . formatRupees(floatval($salvage));
                            }
                            ?>
                        </th>
                    <?php endif; ?>

                    <!-- Loss amount net of salvage -->
                    <th class="key-heading">Loss amount net of salvage</th>
                    <th colspan="<?php echo (isset($essentialData['print_salvage_amt']) && $essentialData['print_salvage_amt'] == 1) ? '4' : '6'; ?>">
                        <?php
                            if (strpos($salvage, '%') !== false) {
                                // Remove the "%" symbol and calculate the percentage
                                $percentage = floatval(str_replace('%', '', $salvage));
                                $result = ($estimatedLoss * $percentage) / 100;
                                $netamount = $estimatedLoss - $result;
                                echo "Rs. " . formatRupees($netamount);
                            } elseif ($salvage === "NA") {
                                echo "Rs. " . formatRupees($estimatedLoss);
                            } elseif (is_numeric($salvage)) {
                                echo "Rs. " . formatRupees($estimatedLoss - floatval($salvage));
                            } else {
                                echo "Rs. " . formatRupees(floatval($salvage));
                            }
                        ?>
                    </th>
                </tr>

               <?php endif; ?>

              <?php if (!empty($essentialData['claim_assessment'])) { ?>
                <tr>
                    <th class="left-sequence"><?php echo $counter++; ?></th>
                    <th class="key-heading">Further action</th>
                    <th colspan="6"><?php echo htmlspecialchars_decode(strip_tags($essentialData['claim_assessment'])); ?></th>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
            <?php
               function formatRupees($value) {
                    // Ensure the value is numeric
                    if (!is_numeric($value)) {
                        return $value;  // Return the value as it is if it's not a number
                    }

                    // Convert the value to a string
                    $value = (string)$value;

                    // Split the value into integer and decimal parts
                    $value_parts = explode('.', $value);
                    $integer_part = $value_parts[0];
                    $decimal_part = isset($value_parts[1]) ? $value_parts[1] : '';

                    // Apply Indian Numbering System formatting to the integer part
                    if (strlen($integer_part) > 3) {
                        // Split the integer part from the right
                        $last_three = substr($integer_part, -3);  // Last three digits
                        $rest = substr($integer_part, 0, strlen($integer_part) - 3);  // Remaining digits

                        // Apply comma after every two digits in the rest of the integer part
                        $rest = preg_replace('/(?<=\d)(?=(\d{2})+(?!\d))/', ',', $rest);

                        // Combine the formatted integer part with the last three digits
                        $integer_part = $rest . ',' . $last_three;
                    }

                    // Combine the formatted integer part with the decimal part (if any)
                    if ($decimal_part) {
                        return $integer_part . '.' . $decimal_part;
                    }

                    return $integer_part;
                }
            ?>

    </div>

<script>
   $(document).ready(function() {
    // Loop through each 'th' or 'td' with class 'left-sequence' and set the sequence as numbers
    $('th.left-sequence, td.left-sequence').each(function(index) {
        $(this).text(index + 1); // Adding sequence starting from 1
    });
});


</script>
</body>

</html>