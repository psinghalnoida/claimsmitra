<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Billing Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBK4vTxKQbTJl50wL8B3B7M+/T4SXLW1m1rc20yGmkH2C2w5CmM1wv9NUD3" crossorigin="anonymous">
    <style>
        .reprtNumber {
            float: left;
            font-size: 15px;

            padding: 0px;
            margin: 0px;
        }

        .header {
            height: 50px;
            border-collapse: collapse;
            font-size: 9%;
        }

        .date {
            padding-top: 0px;
            margin-top: 0px;
        }

        @page {
            margin: 30px 30px 60px 30px;
        }

        .flyleaf {
           
            margin-left: 10px;
            margin-right: 10px;

        }

        .header {
            height: 50px;
            border-collapse: collapse;
            font-size: 9px;
            top: 0;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0px;
            right: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #000;
            padding-left: 3px;
            font-size: 11px;
        }

        th {
            text-align: left;
            font-size: 12px;
        }

        .table-title {
            background-color: #e3e3e3;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 12px;
            text-align: center;
        }

        .container {
            margin: 0;
            padding: 0;
            display: contents;
        }

        .key-heading {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .border-top-none {
            border-top: none;
        }

        /* .element {
            border: 1px solid black;
            border-top: none;
        } */

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="flyleaf">
        < <?php if (!empty($letterheadUrl)) : ?>
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/" . $letterheadUrl)); ?>" alt="Embedded Image" style="width:100%;"> <!---keep the width 710px----->
        <?php else : ?>
            <p style="color: red;"><?php echo $letterheadUrl ?></p>
        <?php endif; ?>

        <div style="background-color: white; width: 100%; padding: 3px 0;margin-top:5px;">
            <p style="text-align: center; margin: 0; font-size:13px;"><b>RECEIVABLE INVOICE<b></p>
        </div>

        <div class="imgheader" style="border-style: dotted; border-color:black;border-width: thin; padding: 2px;font-size: 18px; ">
            <table class="">
                <tbody>
                    <tr>
                        <td style="width:55%; align-self: center; height: 10px"><b>Bill to:</b></td>
                        <td style="width:25%; align-self: center;height: 10px">
                            <?php if (!empty($billingData->billing_id) && $billingData->billing_id !== "NA") : ?>
                                <b>Billing Id:</b> <?php echo htmlspecialchars($billingData->billing_id, ENT_QUOTES, 'UTF-8'); ?>
                            <?php endif; ?>

                        </td>
                        <td class="border-top-none" rowspan="5" style="position: relative; text-align: center; padding: 0; vertical-align: top; width: 20%;">
                            <div style="border-top: 1px solid black; height: 120px; display: flex; align-items: center; justify-content: center;padding:0px 5px;">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:25%; align-self:center;">
                            <?php echo htmlspecialchars($billingData->billing_payment_by ?? '-'); ?><br>
                            <?php echo htmlspecialchars($billingData->billing_branch_name ?? '-'); ?><br>
                        </td>
                        <td style="width:25%; align-self:center;">
                            <b>GSTIN:</b> <?php echo isset($billingData->billing_gst) ? htmlspecialchars($billingData->billing_gst) : '-'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Report Submitted to:</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo htmlspecialchars($shippingData->shipping_payment_by ?? '-'); ?><br>
                            <?php echo htmlspecialchars($shippingData->shipping_branch_name ?? '-'); ?><br>
                            <b> Name: </b> <?php echo htmlspecialchars($shippingData->shipping_user_name ?? '-'); ?> <b> Mob No: </b> <?php echo htmlspecialchars($shippingData->shipping_mobile_num ?? '-'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:55%;"><b>Our Reference :</b> <?php echo htmlspecialchars($essentialData['case_reference']); ?></td>
                        <td style="width:25%;align-self: center;height: 10px;"><b>Date:</b> <?php echo date("d-m-Y"); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="border: 1px solid black; padding: 2px;margin-top:5px; ">
            <table>
                <tbody>
                    <tr>
                        <th style="width:17.5%">Type of Case</th>
                        <td colspan="3">
                            <?php if (!empty($investigator_type)) { ?>
                                <?php echo htmlspecialchars($investigator_type); ?>
                            <?php }  ?>

                        </td>
                    </tr>

                    <?php if ((isset($essentialData['insured_name']) && !empty($essentialData['insured_name'])) || isset($caseData['insured_name'])): ?>
                        <tr>
                            <th>Name of Insured</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['insured_name']) && !empty($essentialData['insured_name'])
                                    ? htmlspecialchars_decode(trim($essentialData['insured_name']))
                                    : (isset($caseData['insured_name']) ? htmlspecialchars_decode(trim($caseData['insured_name'])) : '');
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ((isset($essentialData['visitdate']) && !empty($essentialData['visitdate'])) || isset($caseData['visitdate'])): ?>
                        <tr>
                            <th>Date of Visit</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['visitdate']) && !empty($essentialData['visitdate'])
                                    ? htmlspecialchars_decode(trim($essentialData['visitdate']))
                                    : (isset($caseData['visitdate']) ? htmlspecialchars_decode(trim($caseData['visitdate'])) : '');
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>



                    <?php if (
                        (isset($essentialData['vehicle_number']) && !empty($essentialData['vehicle_number'])) ||
                        (isset($caseData['vehicle_number']) && !empty($caseData['vehicle_number'])) ||
                        (isset($jobData['vehicle_number']) && !empty($jobData['vehicle_number']))
                    ): ?>
                        <tr>
                            <th>Vehicle number</th>
                            <th colspan="3">
                                <?php
                                echo isset($essentialData['vehicle_number']) && !empty($essentialData['vehicle_number'])
                                    ? htmlspecialchars($essentialData['vehicle_number'])
                                    : (isset($caseData['vehicle_number']) && !empty($caseData['vehicle_number'])
                                        ? htmlspecialchars($caseData['vehicle_number'])
                                        : (isset($jobData['vehicle_number']) ? $jobData['vehicle_number'] : ''));
                                ?>
                            </th>
                        </tr>
                    <?php endif; ?>


                    <?php if (
                        (isset($essentialData['loss_data']) && !empty($essentialData['loss_data'])) ||
                        (isset($caseData['loss_data']) && !empty($caseData['loss_data'])) ||
                        (isset($jobData['loss_data']) && !empty($jobData['loss_data']))
                    ): ?>
                        <tr>
                            <th>Date of Loss</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['loss_data']) && !empty($essentialData['loss_data'])
                                    ? htmlspecialchars($essentialData['loss_data'])
                                    : (isset($caseData['loss_data']) && !empty($caseData['loss_data'])
                                        ? htmlspecialchars($caseData['loss_data'])
                                        : (isset($jobData['loss_data']) ? $jobData['loss_data'] : ''));
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>




                    <?php if (
                        (isset($essentialData['policyNumber']) && !empty($essentialData['policyNumber'])) ||
                        (isset($caseData['policyNumber']) && !empty($caseData['policyNumber'])) ||
                        (isset($jobData['policyNumber']) && !empty($jobData['policyNumber']))
                    ): ?>
                        <tr>
                            <th>Policy No.</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['policyNumber']) && !empty($essentialData['policyNumber'])
                                    ? htmlspecialchars($essentialData['policyNumber'])
                                    : (isset($caseData['policyNumber']) && !empty($caseData['policyNumber'])
                                        ? htmlspecialchars($caseData['policyNumber'])
                                        : (isset($jobData['policyNumber']) ? $jobData['policyNumber'] : ''));
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>


                    <?php if (
                        (isset($essentialData['tagNumber']) && !empty($essentialData['tagNumber'])) ||
                        (isset($caseData['tagNumber']) && !empty($caseData['tagNumber'])) ||
                        (isset($jobData['tagNumber']) && !empty($jobData['tagNumber']))
                    ): ?>
                        <tr>
                            <th>Tag No.</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['tagNumber']) && !empty($essentialData['tagNumber'])
                                    ? htmlspecialchars($essentialData['tagNumber'])
                                    : (isset($caseData['tagNumber']) && !empty($caseData['tagNumber'])
                                        ? htmlspecialchars($caseData['tagNumber'])
                                        : (isset($jobData['tagNumber']) ? $jobData['tagNumber'] : ''));
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if (
                        (isset($essentialData['dateOfDeath']) && !empty($essentialData['dateOfDeath'])) ||
                        (isset($caseData['dateOfDeath']) && !empty($caseData['dateOfDeath'])) ||
                        (isset($jobData['dateOfDeath']) && !empty($jobData['dateOfDeath']))
                    ): ?>
                        <tr>
                            <th>Date of Death</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['dateOfDeath']) && !empty($essentialData['dateOfDeath'])
                                    ? htmlspecialchars($essentialData['dateOfDeath'])
                                    : (isset($caseData['dateOfDeath']) && !empty($caseData['dateOfDeath'])
                                        ? htmlspecialchars($caseData['dateOfDeath'])
                                        : (isset($jobData['dateOfDeath']) ? $jobData['dateOfDeath'] : ''));
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>




                    <?php if (
                        (isset($essentialData['survey_date']) && !empty($essentialData['survey_date'])) ||
                        (isset($caseData['survey_date']) && !empty($caseData['survey_date'])) ||
                        (isset($jobData['survey_date']) && !empty($jobData['survey_date']))
                    ): ?>
                        <tr>
                            <th>Date of Survey</th>
                            <td colspan="3">
                                <?php
                                echo isset($essentialData['survey_date']) && !empty($essentialData['survey_date'])
                                    ? htmlspecialchars($essentialData['survey_date'])
                                    : (isset($caseData['survey_date']) && !empty($caseData['survey_date'])
                                        ? htmlspecialchars($caseData['survey_date'])
                                        : (isset($jobData['survey_date']) ? $jobData['survey_date'] : ''));
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>





                    <?php if (isset($essentialData['claim_no'])): ?>
                        <tr>
                            <th>Claim No.</th>
                            <td colspan="3"><?php echo htmlspecialchars($essentialData['claim_no']); ?></td>
                        </tr>
                    <?php endif; ?>



                    <?php
                    // Function to format date to dd-mm-yy
                    function formatDate($date)
                    {
                        if (!empty($date)) {
                            $dateObj = DateTime::createFromFormat('Y-m-d', $date); // assuming the date is in Y-m-d format
                            if ($dateObj) {
                                return $dateObj->format('d-m-Y');
                            }
                        }
                        return 'NA'; // Return 'NA' if no date exists or it’s invalid
                    }

                    if (isset($natureofjob)) {
                        // Check for natureofjob 63 and 66
                        if ($natureofjob == 63 || $natureofjob == 66) {
                            // Check if invoices exist
                            if (!empty($essentialData['invoices']) && is_array($essentialData['invoices'])) {
                                foreach ($essentialData['invoices'] as $invoice) {
                                    $invoiceNumber = isset($invoice['invoicenumber']) ? htmlspecialchars($invoice['invoicenumber']) : 'NA';
                                    $invoicedate = isset($invoice['invoicedate']) ? htmlspecialchars($invoice['invoicedate']) : 'NA';
                                    $grNumber = isset($invoice['grnumber']) ? htmlspecialchars($invoice['grnumber']) : null;
                                    $grdate = isset($invoice['grdate']) ? htmlspecialchars($invoice['grdate']) : 'NA';
                    ?>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <td><?php echo $invoiceNumber; ?></td>
                                        <th>Invoice Date</th>
                                        <td><?php echo formatDate($invoicedate); ?></td>
                                    </tr>
                                    <?php if ($grNumber) { ?>
                                        <tr>
                                            <th>GR Number</th>
                                            <td><?php echo $grNumber; ?></td>
                                            <th>GR Date</th>
                                            <td><?php echo formatDate($grdate); ?></td>
                                        </tr>
                                    <?php } ?>
                    <?php
                                }
                            }
                        }
                    }
                    ?>





                    <?php if (
                        isset($essentialData['date_of_incident']) || isset($essentialData['time_of_incident']) ||
                        isset($caseData['date_of_incident']) || isset($caseData['time_of_incident'])
                    ): ?>
                        <tr>
                            <th>Date of Loss</th>
                            <td colspan="3">
                                <?php
                                // Check for 'date_of_incident' and 'time_of_incident' in both arrays
                                $dateOfIncident = isset($essentialData['date_of_incident'])
                                    ? htmlspecialchars($essentialData['date_of_incident'])
                                    : (isset($caseData['date_of_incident'])
                                        ? htmlspecialchars($caseData['date_of_incident'])
                                        : '-');

                                echo $dateOfIncident;
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>



                </tbody>
            </table>
        </div>


        <div style="border: 1px solid black; padding: 2px;margin-top:5px; ">
            <table style="">
                <tbody>
                    <tr>
                        <th style="width:17.5%"><b>Item</b></th>
                        <th><b>Description</b></th>
                        <th style="text-align:right;width:7%;text-align:center;"><b>SAC</b></th>
                        <th style="text-align:right;width:15.5%;text-align:center;"><b>Rate(Rs.)</b></th>
                        <th style="text-align:right;width:7%;text-align:center;"><b>Qty</b></th>
                        <th style="text-align:right;width:12.5%"><b>Amount(Rs.)</b></th>
                    </tr>
                    <?php if (!empty($invoicedata)): ?>
                        <?php foreach ($invoicedata as $invoice): ?>
                            <tr>
                                <td style="font-size:12px;"><?php echo htmlspecialchars($invoice->item); ?></th>
                                <td><?php echo htmlspecialchars($invoice->description); ?></td>
                                <td style="text-align:center;">997162</td>
                                <td style="text-align:center;">
                                    <?php echo htmlspecialchars($invoice->rate); ?>
                                    <?php echo $invoice->uom === "N/A" ? '' : ' / ' . htmlspecialchars($invoice->uom); ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo $invoice->uom === "N/A" ? '' : htmlspecialchars($invoice->qty); ?>
                                </td>

                                <td style="text-align:right"><?php echo htmlspecialchars($invoice->amount); ?></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                    <tr>
                        <th>Sub Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th style="text-align:right"><?php echo isset($amount->sub_total) ? htmlspecialchars($amount->sub_total) : '-'; ?></th>
                    </tr>
                    <?php
                    $currencyCode = $currency->currency_conversion ?? '';
                    $showGst = !in_array($currencyCode, ['NPR', 'USD']);
                    $gstAmount = isset($taxData->calculatedgst) ? (float)$taxData->calculatedgst : 0;
                    $totalAmount = isset($amount->total) ? (float)$amount->total : 0;
                    $finalTotal = $showGst ? $totalAmount : ($totalAmount - $gstAmount);
                    ?>

                    <?php if ($showGst && isset($taxData->gst_number, $billingData->billing_gst, $taxData->calculatedgst)): ?>
                        <?php
                        $gstPrefix = substr(trim($taxData->gst_number), 0, 2);
                        $billingPrefix = substr(trim($billingData->billing_gst), 0, 2);
                        ?>

                        <?php if ($gstPrefix === $billingPrefix): ?>
                            <!-- Intra-state Transaction (CGST + SGST) -->
                            <tr>
                                <th>SGST</th>
                                <td><?php echo htmlspecialchars($taxData->gst_number ?? '-'); ?></td>
                                <td></td>
                                <td style="text-align:center;">@</td>
                                <td style="text-align:center"><?php echo htmlspecialchars($taxData->sgst_percentage ?? '-') . '%'; ?></td>
                                <td style="text-align:right">
                                    <?php
                                    $sgstAmount = $gstAmount / 2;
                                    echo number_format($sgstAmount, 2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>CGST</th>
                                <td><?php echo htmlspecialchars($taxData->gst_number ?? '-'); ?></td>
                                <td></td>
                                <td style="text-align:center;">@</td>
                                <td style="text-align:center"><?php echo htmlspecialchars($taxData->cgst_percentage ?? '-') . '%'; ?></td>
                                <td style="text-align:right">
                                    <?php
                                    $cgstAmount = $gstAmount / 2;
                                    echo number_format($cgstAmount, 2);
                                    ?>
                                </td>
                            </tr>

                        <?php elseif ($taxData->igst_percentage > 0 || !empty($gstAmount) || empty($taxData->gst_number)): ?>
                            <?php if ($gstAmount > 0): ?>
                                <!-- Inter-state Transaction (IGST) -->
                                <tr>
                                    <th>IGST</th>
                                    <td><?php echo htmlspecialchars($taxData->gst_number ?? '-'); ?></td>
                                    <td></td>
                                    <td style="text-align:center;">@</td>
                                    <td style="text-align:center"><?php echo htmlspecialchars($taxData->igst_percentage ?? '-') . '%'; ?></td>
                                    <td style="text-align:right">
                                        <?php echo number_format($gstAmount, 2); ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <!-- Show message when calculated HST (IGST) is 0.00 -->
                                <tr>
                                    <td colspan="6" style="text-align:left; color: black; font-weight: bold;">
                                        No GST applicable
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Final Total -->
                    <tr>
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th style="text-align:right">
                            <?php echo number_format($finalTotal, 2); ?>
                        </th>
                    </tr>

                    <?php if (!empty($additionaldata)): ?>
                        <?php foreach ($additionaldata as $additional): ?>
                            <tr>
                                <td style="font-size:12px;"><?php echo htmlspecialchars($additional->item); ?></td>
                                <td style="font-size:12px;"><?php echo htmlspecialchars($additional->description); ?></td>
                                <td style="text-align:center;">997162</td>
                                <td style="text-align:center;">
                                    <?php echo htmlspecialchars($additional->rate); ?>
                                    <?php echo $additional->uom === "N/A" ? '' : ' / ' . htmlspecialchars($additional->uom); ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo $additional->uom === "N/A" ? '' : htmlspecialchars($additional->qty); ?>
                                </td>

                                <td style="text-align:right"><?php echo htmlspecialchars($additional->amount); ?></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>

                    <?php
                    $grandTotal = isset($amount->grandtotal) ? (float)$amount->grandtotal : 0;
                    $adjustedGrandTotal = $showGst ? $grandTotal : ($grandTotal - $gstAmount);
                    ?>

                    <tr>
                        <th>Grand Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:center"><?php echo'INR'; ?></td>
                        <th style="text-align:right">
                            <?php echo number_format((float)$adjustedGrandTotal, 2); ?>
                        </th>

                    </tr>

                    <?php
                    $showConversionRow = false;
                    if (in_array($currency->currency_conversion ?? '', ['USD', 'NPR'])):
                        $showConversionRow = true;
                    ?>
                    <tr>
                        <th>Currency Converted</th>
                        <td><?php echo '1 INR To ' . htmlspecialchars($currency->currency_value) . ' ' . $currency->currency_conversion; ?></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:center"><?php echo htmlspecialchars($currency->currency_conversion); ?></td>
                        <th style="text-align:right">
                            <?php
                            $currencyCode = $currency->currency_conversion ?? '';
                            $currencyValue = isset($currency->currency_value) ? (float)$currency->currency_value : 1;
                            $multipliedAmount = round($currencyValue * $adjustedGrandTotal, 2);
                            echo number_format($multipliedAmount, 2);
                            ?>
                        </th>
                    </tr>
                    <?php endif; ?>


                    <tr>
                    <td colspan="6">
                        <?php
                        $currencyCode = strtoupper($currency->currency_conversion ?? '');
                        $currencyValue = isset($currency->currency_value) ? (float)$currency->currency_value : 1;
                        $showGst = !in_array($currencyCode, ['NPR', 'USD']);

                        $gstAmount = isset($taxData->calculatedgst) ? (float)$taxData->calculatedgst : 0;
                        $grandTotalINR = isset($amount->grandtotal) ? (float)$amount->grandtotal : 0;

                        if ($currencyCode === 'INR') {
                            $convertedAmount = round($grandTotalINR, 2);
                        } else {
                            $baseAmount = $showGst ? $grandTotalINR : ($grandTotalINR - $gstAmount);
                            $convertedAmount = round($currencyValue * $baseAmount, 2);
                        }

                        // Split into whole and decimal parts
                        $parts = explode('.', number_format($convertedAmount, 2, '.', ''));
                        $main = intval($parts[0]);
                        $fraction = intval($parts[1]);

                        $unit = $currencyCode === 'INR' ? 'Rupees' : $currencyCode;
                        $subUnit = $currencyCode === 'INR' ? 'Paisa' : 'Paisa';

                        if ($main === 0 && $fraction === 0) {
                            echo "Only Zero " . $unit;
                        } else {
                            $mainWords = $main > 0 ? numberToWords($main) . " " . $unit : "";
                            $fractionWords = $fraction > 0 ? " and " . numberToWords($fraction) . " " . $subUnit : "";
                            echo "Only " . $mainWords . $fractionWords;
                        }
                        ?>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>
        <div class="element" style="border: 1px solid black;margin-top:5px;padding-right:4px;">
            <table style="width: 100%; margin: 2px;">
                <tbody>
                    <tr>

                        <th width="45%" class="text-center"><b>Please Note as Under</b></th>
                        <th rowspan="4" style=" border-bottom: none;"></th>
                    </tr>
                    <tr>
                        <th style=" height: 10px;border-bottom:none;font-weight: 400;">Kindly make payment/cheque in the name of </th>
                    </tr>
                    <tr>
                        <?php if ($companyid == 1578): ?> <th>RAHUL SAXENA</th>
                        <?php elseif ($companyid == 97): ?>
                            <th>VP Singhal & Company ISLA Pvt. Ltd</th>
                        <?php elseif ($companyid == 1553): ?>
                            <th>Pragati Risk & Management Partners</th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th style="height: 10px; border-bottom: none; font-weight: 400;">
                             <?php if ($companyid == 1578): ?>
                                 <b>Account No:</b> 10470100017111 ,
                                 <b>IFSC Code:</b> BARB0SHACAN
                             <?php elseif ($companyid == 97): ?>
                                 <b>Account No:</b> 06512000002715,
                                 <b>IFSC Code:</b> HDFC000065
                                 <!-- <b>MICR Code:</b>  -->
                             <?php elseif ($companyid == 1553): ?>
                                 <b>Account No:</b> 71720200000323,
                                 <b>IFSC Code:</b> BARB0DBSAFD,  
                             <?php endif; ?>
                         </th>
                    </tr>

                    <tr>
                        <th style="text-align: left;"></th>
                        <th style="text-align: right; font-size: 12px;border-top:none;padding-right:5px"><span style="font-weight: 400;">(Space for rubber stamp)</span><br><br>
                            <?php if ($companyid == 1578): ?> RAHUL SAXENA
                            <?php elseif ($companyid == 97): ?>
                                VP Singhal & Company ISLA Pvt. Ltd
                            <?php elseif ($companyid == 1553): ?>
                                Pragati Risk & Management Partners
                            <?php endif; ?>
                            <br><span style="font-weight: 400;">Authorized Signatory and Stamp</span>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- <table >
            <tbody>
                <tr >
                    <td class="border-top-none" style="text-align:right;"><b>VP Singhal & Company ISLA Pvt. Ltd</b></td>
                </tr>
                <tr>
                    <td style="text-align:right;">Authorised Signatory and Stamp</td>
                </tr>
            </tbody>
        </table> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybEdyC4Zq6xL6N7Yyfs64LOeckmOG5GjqyU0qKX1Qe6S8f3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-8Ttb7BBT6j8W9a3ka2M8E4pMf6HzLHG75T+ODFQFmU1IYPb7LZX49jSm3nGH0p6T" crossorigin="anonymous"></script>
</body>

</html>