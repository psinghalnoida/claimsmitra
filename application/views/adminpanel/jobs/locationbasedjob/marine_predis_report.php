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

        @page {
            counter-increment: page;
            margin: 50px 28px 60px 30px;
        }

        .flyleaf {

            margin-left: 10px;
            margin-right: 10px;

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
            font-size: 13px;
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
            padding: 3px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 13px;
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
                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/". $letterheadUrl)); ?>"
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
<p style="font-size: 16px;text-align: center;font-weight: 500;padding:2px;margin:0px;"> Pre Dispatch Survey Report</p>
<p style="font-size: 13px;text-align: center;font-weight: 500;padding:2px;margin:4px;"> In Respect of consignment of  <?php echo  $essentialData['consignment'] ?></p>


<div class="mt-4" style="text-align: center;">
    <table class="mt-4" style="width: 70%; margin: 0 auto; border-collapse: collapse;">
        <tbody>
            <?php
                // Check if invoice data is available
            if (!empty($essentialData['invoices'])) {
                    // Loop through each invoice entry
                foreach ($essentialData['invoices'] as $invoice) {
                        // Ensure that all necessary fields are present and safe for output
                    $invoicenumber = isset($invoice['invoicenumber']) ? htmlspecialchars($invoice['invoicenumber']) : 'NA';
                    $invoicedate = isset($invoice['invoicedate']) ? date('d-m-Y', strtotime($invoice['invoicedate'])) : 'NA';

                    echo '<tr>';
                    echo '<td class="table-cell-heading">Invoice Number</td>';
                    echo '<td class="table-cell">' . $invoicenumber . '</td>';
                    echo '<td class="table-cell-heading">Invoice Date</td>';
                    echo '<td class="table-cell">' . $invoicedate . '</td>';
                    echo '</tr>';
                }
            } else {
                    // Display message if no invoice data
                echo '<tr><td colspan="4" style="text-align: center;">No Invoice data available</td></tr>';
            }
            ?>

            <tr>
                <th class="table-cell-heading">B/L NO.</th>
                <th class="table-cell"><?php echo $caseData['bol_no']; ?></th>
                <th class="table-cell-heading">B/L Date</th>
                <th class="table-cell"><?php echo $caseData['bol_date']; ?></th>
            </tr>

            <tr>
                <th class="table-cell-heading">BE NO.</th>
                <th class="table-cell"><?php echo $caseData['be_no']; ?></th>
                <th class="table-cell-heading">BE Date</th>
                <th class="table-cell"><?php echo $caseData['be_date']; ?></th>
            </tr>
        </tbody>
    </table>

</div>
    <p style="font-size: 13px;"> We Have Carried out the pre dispatch survey of the consignment and wish to report as under:</p>

<p class="table-title" style="margin-top:10px;">A. Details of Consignment</p>

<table style="background-color: #fff;">
    <tbody> 
        <?php $consignment = 1; ?>

        <tr>
            <th style="width:5%;"><?php echo $consignment++; ?></th>
            <td style="width:35%;">Consignment</td>
            <th><?php echo !empty($essentialData['consignment']) ? $essentialData['consignment'] : 'NA'; ?></th>
        </tr>

        <tr>
            <th><?php echo $consignment++; ?></th>
            <td >Gross Weight / No of Package</td>
            <th><?php echo !empty($caseData['gross_weight']) ? $caseData['gross_weight'] : 'NA'; ?></th>
        </tr>

        <tr>
            <th><?php echo $consignment++; ?></th>
            <td >Marks and Number</td>
            <th><?php echo !empty($caseData['marks_number']) ? $caseData['marks_number'] : 'NA'; ?></th>
        </tr>

        <tr>
            <th ><?php echo $consignment++; ?></th>
            <td >Packing</td>
            <th><?php echo !empty($caseData['packing']) ? $caseData['packing'] : 'NA'; ?></th>
        </tr>
    </tbody>
</table>

<p class="table-title" style="margin-top:10px;">B. Details of Oversees Transit</p>

<table style="background-color: #fff;">
    <tbody> 
       <?php $oversees = 1; ?>

       <?php if (isset($caseData['cargo_type']) && $caseData['cargo_type'] == 2): ?>
        <!-- Case for Export Cargo (cargo_type = 2) -->
        <tr>
            <th style="width:5%;"><?php echo $oversees++; ?></th>
            <td style="width:35%;">Ex - to</td>
            <th>
                <?php 
                echo (!empty($caseData['oversees_ex_to']) ? $caseData['oversees_ex_to'] : 'NA') . 
                ' To ' . 
                (!empty($essentialData['survey_place']) ? $essentialData['survey_place'] : 'NA'); 
                ?>
            </th>
        </tr>

    <?php elseif (isset($caseData['cargo_type']) && $caseData['cargo_type'] == 1): ?>
        <!-- Case for Import Cargo (cargo_type = 1) -->
        <tr>
            <th ><?php echo $oversees++; ?></th>
            <td >Ex - to</td>
            <th>
                <?php 
                echo (!empty($essentialData['survey_place']) ? $essentialData['survey_place'] : 'NA') . 
                ' To ' . 
                (!empty($caseData['oversees_ex_to']) ? $caseData['oversees_ex_to'] : 'NA'); 
                ?>
            </th>
        </tr>

    <?php else: ?>
        <!-- If no radio button is selected -->
        <tr>
            <th colspan="3" style="text-align: center; color: red;">
                Please select one Cargo type .
            </th>
        </tr>
    <?php endif; ?>

    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td>Consignor / Supplier</td>
        <th><?php echo !empty($caseData['consignor']) ? $caseData['consignor'] : 'NA'; ?></th>
    </tr>

    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Receiver</td>
        <th><?php echo !empty($caseData['reciever']) ? $caseData['reciever'] : 'NA'; ?></th>
    </tr>

    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Supplier's Invoice Number</td>
        <th><?php echo !empty($caseData['supplier_inv_no']) ? $caseData['supplier_inv_no'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Sound Assessable Value</td>
        <th><?php echo !empty($caseData['assessable_value']) ? $caseData['assessable_value'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Sound Duty Value</td>
        <th><?php echo !empty($caseData['soundduty_value']) ? $caseData['soundduty_value'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Country of origin</td>
        <th><?php echo !empty($caseData['country_origin']) ? $caseData['country_origin'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td>HAWB Number</td>
        <th><?php echo !empty($caseData['hawb_no']) ? $caseData['hawb_no'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th><?php echo $oversees++; ?></th>
        <td>MAWB Number</td>
        <th><?php echo !empty($caseData['mawb_no']) ? $caseData['mawb_no'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Date of Dispatch</td>
        <th><?php echo !empty($caseData['dispatch_date']) ? $caseData['dispatch_date'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Date of receipt at Customs</td>
        <th><?php echo !empty($caseData['reciept_date']) ? $caseData['reciept_date'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Date of dispatch from Customs</td>
        <th><?php echo !empty($caseData['dispatch_date_customs']) ? $caseData['dispatch_date_customs'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Bill of entry number</td>
        <th><?php echo !empty($caseData['entry_number']) ? $caseData['entry_number'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >CHA</td>
        <th><?php echo !empty($caseData['packing']) ? $caseData['packing'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $oversees++; ?></th>
        <td >Container No</td>
        <th><?php echo !empty($caseData['container']) ? $caseData['container'] : 'NA'; ?></th>
    </tr>
</tbody>
</table>

<p class="table-title" style="margin-top:10px;">C. Details of Inland Transit</p>

<table style="background-color: #fff;">
    <tbody> 
       <?php $inland = 1; ?>

       <?php if (isset($caseData['cargo_type']) && $caseData['cargo_type'] == 2): ?>
        <!-- Case for Export Cargo (cargo_type = 2) -->
        <tr>
            <th style="width:5%;"><?php echo $inland++; ?></th>
            <td style="width:35%;">Ex - to</td>
            <th>
                <?php 
                echo (!empty($essentialData['survey_place']) ? $essentialData['survey_place'] : 'NA') . 
                ' To ' . 
                (!empty($essentialData['inspection_place']) ? $essentialData['inspection_place'] : 'NA'); 
                ?>
            </th>
        </tr>

    <?php elseif (isset($caseData['cargo_type']) && $caseData['cargo_type'] == 1): ?>
        <!-- Case for Import Cargo (cargo_type = 1) -->
        <tr>
            <th ><?php echo $inland++; ?></th>
            <td >Ex - to</td>
            <th>
                <?php 
                echo (!empty($essentialData['inspection_place']) ? $essentialData['inspection_place'] : 'NA') . 
                ' To ' . 
                (!empty($essentialData['survey_place']) ? $essentialData['survey_place'] : 'NA'); 
                ?>
            </th>
        </tr>

    <?php else: ?>
        <!-- If no radio button is selected -->
        <tr>
            <th colspan="3" style="text-align: center; color: red;">
                Please select one Cargo type .
            </th>
        </tr>
    <?php endif; ?>

    <tr>
        <th ><?php echo $inland++; ?></th>
        <td>Consignor</td>
        <th><?php echo !empty($caseData['inland_ex_to']) ? $caseData['consignor'] : 'NA'; ?></th>
    </tr>

    <tr>
        <th ><?php echo $inland++; ?></th>
        <td >Consignee</td>
        <th><?php echo !empty($caseData['consignee']) ? $caseData['consignee'] : 'NA'; ?></th>
    </tr>

    <tr>
        <th ><?php echo $inland++; ?></th>
        <td >Carrier</td>
        <th><?php echo !empty($caseData['carrier']) ? $caseData['carrier'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $inland++; ?></th>
        <td >Mode of dispatch / Truck Number</td>
        <th><?php echo !empty($caseData['dispatch_mode']) ? $caseData['dispatch_mode'] : 'NA'; ?></th>
    </tr>

</tbody>
</table>
<p class="table-title" style="margin-top:10px;">D. Survey / Observation</p>


<table style="background-color: #fff; ">
    <tbody> 
       <?php $observation = 1; ?>
       <tr>
        <th style="width:5%;"><?php echo $observation++; ?></th>
        <td style="width:35%;">Survey Application </td>
        <th><?php echo !empty($essentialData['insured_name']) ? $essentialData['insured_name'] : 'NA'; ?></th>
    </tr>

    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Date and Place of survey</td>
        <th>
            <?php 
            echo (!empty($essentialData['survey_data']) ? $essentialData['survey_data'] : 'NA') . ' ' . 
            (!empty($essentialData['survey_place']) ? $essentialData['survey_place'] : 'NA'); 
            ?>
        </th>

    </tr>

    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Date of expected Dispatch</td>
        <th><?php echo !empty($caseData['expected_dispatch']) ? $caseData['expected_dispatch'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Condition of Consignment at the time of dispatch</td>
        <th><?php echo !empty($caseData['consignment_condition']) ? $caseData['consignment_condition'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Whethe rectification required</td>
        <th><?php echo !empty($caseData['rectification']) ? $caseData['rectification'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Is special condition required for dispatch like use of refrigerated van etc.</td>
        <th><?php echo !empty($caseData['refrigerated']) ? $caseData['refrigerated'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Custom Examined Packets</td>
        <th><?php echo !empty($caseData['examined_packets']) ? $caseData['examined_packets'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Photo arranged / Number</td>
        <th><?php echo !empty($caseData['photo_arranged']) ? $caseData['photo_arranged'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Documents available </td>
        <th><?php echo !empty($caseData['available_docs']) ? $caseData['available_docs'] : 'NA'; ?></th>
    </tr>
    <tr>
        <th ><?php echo $observation++; ?></th>
        <td >Special remarks </td>
        <th><?php echo !empty($caseData['remarks']) ? $caseData['remarks'] : 'NA'; ?></th>
    </tr>

</tbody>
</table>

<p class="table-title" style="margin-top:10px;">I. Photographs</p>

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

<p style="font-size: 13px; text-align: justify;">
   <?php echo !empty(htmlspecialchars_decode($caseData['disclaimer'])) ? $caseData['disclaimer'] : 'NA'; ?>
</p>



<div style="margin-top: 0px; text-align: right;">
    <h5 style="font-size: 13px;">
     <?php if (!empty($companyname['companyName'])) { ?>
         <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
     <?php } ?>
     <br><br><br><br><br>
     <p  style="font-size: 13px;">Authorized Signatory and Stamp</p>
 </h5>

</div>

</div>
</body>

</html>