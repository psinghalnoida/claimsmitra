<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre Inspection Report</title>
    <link href="http://fonts.cdnfonts.com/css/new-cicle" rel="stylesheet">
    <link href="https://playground.anychart.com/ranRPTdv/iframe" rel="canonical">
    <style>
         @page {
            margin: 30px 30px 60px 30px;
        }
        body {
         overflow: hidden;
        }

        
        .flyleaf {
            page-break-after: avoid;
            margin-left: 5px;
            margin-right: 5px;
        }

        .header {
            height: 50px;
            border-collapse: collapse;
            font-size: 11px;
        }

        .date {
            padding-top: 0px;
            margin-top: 0px;
        }

        .header {
            top: 0;
        }

        .header_img {
            width: 698px;
            height: 250px;
        }


        .footer-vpsinghal {
            text-align: center;
        }

        .reprtNumber {
            float: left;
            font-size: 12px;
            font-weight: 600;
            margin: 0px;
            padding: 0px;
        }

        .date {
            float: right;
            font-size: 15px;
            font-weight: 600;
            margin: 0px;
            padding: 0px;
        }

        .card-body {
            border: 1px solid black;
            padding: 0;
            margin-top: 10px;
        }

        .photographs>td {
            width: 50%;
        }

        td>img {
            width: 100%;
            height: 20%;
        }

        .card-title {
            font-weight: 600;
            color: black;
            background-color: #e3e3e3;
            padding: 5px;
            border-bottom: 1px solid black;
            margin-top: 0px;
            font-size: 12px;
            padding-bottom: 0px;
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
            padding: 2px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 12px;
            margin-top: 10px;
        }

        .head {
            width: 40%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 3px;
            font-size: 13px;
        }

        .table {

            padding: 1px 10px;
        }

        .row {
            width: 100%;
            overflow: hidden;
            margin: 10px auto;
        }

        .col {
            float: left;
            margin: 1px;
            padding: 10px;
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

        <div class="head" style="text-align:right;margin-left:25%; margin-top:-30px; ">
            <h3 style="font-weight: 600; margin-bottom: 1px;">MARINE PRE DISPATCH </h3>
        </div>
        
        <table>
              <tr>
                <td style="width:25%;">Contact Person Name / Mobile </td>
                <td colspan="6">
                    <?php
                        echo ($essentialData['salutation'] !== 'Other' ? $essentialData['salutation'].' ' : '');
                        echo $essentialData['contact_person_name'].' ('.$essentialData['contact_person_mobile'].')';
                    ?>
                </td>
            </tr>

            <tr>
                <td >Case Reference</td>
                <td colspan="6"><?php echo $essentialData['case_reference']; ?></td>
            </tr>
            <tr>
                <td >Date of survey</td>
                <td colspan="6"><?php echo $essentialData['survey_data']; ?></td>
            </tr>
            <tr>
                <td >Place of survey</td>
                <td colspan="6"><?php echo $essentialData['survey_place']; ?></td>
            </tr>
             <tr>
                <td >Consignment</td>
                <td colspan="6"><?php echo $essentialData['consignment']; ?></td>
            </tr>
            <tr>
                <td >Type of Policy </td>
                <td colspan="6">
                    <?php 
                    // Check if the selected policy type is 'Other'
                    if (isset($essentialData['policytype']) && $essentialData['policytype'] === 'Other') {
                        // Display otherPolicyType or otherOtherPolicyType if they exist
                        echo !empty($essentialData['otherPolicyType']) 
                            ? htmlspecialchars($essentialData['otherPolicyType']) 
                            : (!empty($essentialData['otherOtherPolicyType']) 
                                ? htmlspecialchars($essentialData['otherOtherPolicyType']) 
                                : 'Other');
                    } else {
                        // Display the selected policy type
                        echo htmlspecialchars($essentialData['policytype'] ?? 'N/A');
                    }
                    ?>
                </td>
                
            </tr>
            
             <tr> 
                <td>Name of Insured</td>
                <td colspan="6"><?php echo $essentialData['insured_name'].' ('.$essentialData['address'].')'; ?></td>
            </tr>
          
          
            <tr>
                <td>Final destination</td>
                <td colspan="6"><?php echo $essentialData['inspection_place']; ?></td>
                
            </tr>

            <tr>
                <td >STN / Invoice No.</th>
                <td colspan="6" style="padding: 0; ">
                    <table >
                        <thead>
                            <tr>
                                <td >Invoice Number</th>
                                <td >Invoice Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($essentialData['invoices'])) {
                                foreach ($essentialData['invoices'] as $invoice) {
                                    $invoicenumber = isset($invoice['invoicenumber']) ? htmlspecialchars($invoice['invoicenumber']) : 'NA';
                                    $invoicedate = isset($invoice['invoicedate']) ? date('d-m-Y', strtotime($invoice['invoicedate'])) : 'NA';

                                    echo '<tr>';
                                    echo '<td style="border: 1px solid black; padding: 5px;">' . $invoicenumber . '</td>';
                                    echo '<td style="border: 1px solid black; padding: 5px;">' . $invoicedate . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>


            <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remark</td>
                    <td colspan="6"><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>

        </table>
        
           <?php 
                $imageFound = false;

                if (!empty($images)) {
                    foreach ($images as $img) { 
                        $imagePath = 'uploads/' .  $aid . '/images/' . $img;
                        if (file_exists($imagePath) && is_readable($imagePath)) {
                            $imageFound = true;
                            break; // Exit loop early as we found a valid image
                        }
                    }
                }

                if ($imageFound): ?>
                    <h6 class="table-title">Photographs</h6>
                    <table class="tablesaw table-striped table-bordered table-hover photographs">
                        <tbody>
                            <tr>
                                <?php 
                                foreach ($images as $img) { 
                                    $imagePath = 'uploads/' .  $aid . '/images/' . $img;
                                    if (file_exists($imagePath) && is_readable($imagePath)) {
                                        $base64Image = base64_encode(file_get_contents($imagePath));
                                        ?>
                                        <td style="width:50%;">
                                            <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="JPG Image" style="width:100%;height:20%;">
                                        </td>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

     </div>
</body>

</html>