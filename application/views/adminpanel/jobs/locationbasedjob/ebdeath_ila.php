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
            margin: 60px 30px;
        }

        .flyleaf {
            page-break-after: always;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: -6px;
        }

        .photographs>td {
            width: 50%;
        }

        td>img {
            width: 100%;
            height: 20%;
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
        <div class="head" style="text-align:right;margin-left:20%; margin-top:-30px; ">
            <h3 style="font-weight: 500; margin-bottom: 1px;"> EB DEATH ILA</h3>
        </div>

        <table>
            <tr>
                <td style="width:10%">Case Reference</td>
                <td  colspan="7"><?php echo $essentialData['case_reference']; ?></td>  
            </tr>
            <tr>
                <td >Date of report</td>
                <td  colspan="7"><?php echo $essentialData['date_of_report']; ?></td>
            </tr>
             <tr>
               <td >Type of Policy </td>
                <td  colspan="7">
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
                <td>Policy Number</td>>
                <td  colspan="7">
                    <?php
                    echo isset($essentialData['policyNumber']) ? $essentialData['policyNumber'] : '';
                    echo isset($essentialData['policyName']) ? ' - ' . $essentialData['policyName'] : '';
                    if (!empty($essentialData['policyNumberfrom']) && !empty($essentialData['policyNumberto'])) {
                        echo " (Valid from: " . $essentialData['policyNumberfrom'] . " to " . $essentialData['policyNumberto'] . ")";
                    }
                    ?>
                </td>
            </tr>
             <tr>
                 <td style="width:30%">Insured Name</td>
                <td  colspan="7"> <?php echo $essentialData['insured_name']; ?></td>
            </tr>
            <tr>
                <td>Contact Person Name</td>
                <td  colspan="7">
                    <?php
                    echo isset($essentialData['salutation']) ? $essentialData['salutation'] . ' ' : '';
                    echo isset($essentialData['contact_person_name']) ? $essentialData['contact_person_name'] : '';
                    ?>
                </td>
            </tr>
             <tr>
                 <td>Address </td>
                <td colspan="7"><?php echo $essentialData['address']; ?></td>
            </tr>
            <tr>
                <td>Name of affected person</td>
                <td colspan="7"><?php echo $essentialData['affected_person']; ?></td>
            </tr>
             <tr>
                <td>Loss Amount</td>
                <td colspan="7"><?php echo $essentialData['loss_amt']; ?></td>
            </tr>
            <tr> 
                <td>Cause of loss</td>
                <td  colspan="7"><?php echo $essentialData['cause_loss']; ?></td>
            </tr>
             <tr>               
               <td>FIR</td>
               <td  colspan="7"><?php echo $essentialData['fir']; ?></td>
            </tr>

            <tr>               
                <td>Date & Time of Loss</td>
                <td  colspan="7">
                    <?php
                    echo isset($essentialData['loss_data']) ? $essentialData['loss_data'] : 'N/A';
                    echo isset($essentialData['loss_time']) ? ' at ' . $essentialData['loss_time'] : '';
                    if (!empty($essentialData['loss_date_text'])) {
                        echo ' (' . $essentialData['loss_date_text'] . ')';
                    }
                    ?>
                </td>
            </tr>

            <tr>               
              <td>Reason of Inspection</td>
              <td  colspan="7"><?php echo $essentialData['cause_inspection']; ?></td>
            </tr>
            <tr>
                <td>Place of Inspection</td>
                <td  colspan="7">
                    <?php echo $essentialData['inspection_place']; ?>
                </td>
            </tr>

            <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remark</td>
                    <td colspan="7"><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php if (!empty($images)) { 
            $hasValidImages = false; // Flag to check if at least one valid image exists
            $imageRows = ''; // Store valid image rows
            foreach ($images as $img) {
                $imagePath = 'uploads/' . $aid . '/images/' . $img;
                if (file_exists($imagePath) && is_readable($imagePath)) {
                    $base64Image = base64_encode(file_get_contents($imagePath));
                    $imageRows .= '<td style="width:50%;"><img src="data:image/jpeg;base64,' . $base64Image . '" alt="JPG Image" style="width:100%;height:30%;"></td>';
                    $hasValidImages = true;
                } else {
                    error_log("Error: Image not accessible - " . $imagePath);
                }
            }
            
            if ($hasValidImages) { ?>
                <h6 class="table-title">Photographs</h6>
                <table class="tablesaw table-striped table-bordered table-hover photographs">
                    <tbody>
                        <tr>
                            <?php echo $imageRows; ?>
                        </tr>
                    </tbody>
                </table>
            <?php } 
        } ?>

    </div>
</body>

</html>