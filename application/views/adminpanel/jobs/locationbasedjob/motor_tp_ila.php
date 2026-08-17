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
        body {
            font-family: 'New Cicle', sans-serif;
            /* margin-top: -10px; */
            margin-left: -25px;
            margin-right: -25px;
            margin-bottom: -5px;
        }

        /* footer {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 50px;
            bottom: 0px;

        }
*/

        .flyleaf {
            page-break-after: always;
            margin-left: 5px;
            margin-right: 5px;
        }

        /* .page-break {
            page-break-after: always;
        } */

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
            font-size: 12px;
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
    </style>
</head>

<body>
    <div class="flyleaf">

        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 760px;">
        <div class="header">
            <p class="reprtNumber">Report No. <?php echo $essentialData['case_reference']; ?></p>
            <p class="date">Date:<?php echo $essentialData['date_of_report']; ?></p>
        </div>
        <div style="width: 100%;">
            <div style="float: left; width: 50%;margin-top:-20px;">
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
                    The Senior Divisional Manager <br>
                    <?php echo $essentialData['policy_by']; ?><br>
                    <?php echo $firstLine . '<br>' . $secondLine; ?>
                </p>
            </div>
            <div style="float:left;width: 50%;color:red;text-align: right;margin-top:-30px; font-size:10px;">
                <span>For Photos Scan Here</span>
            </div>
            <div style="float:left;width: 50%;text-align: right; margin-top:-20px;">
                <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">

            </div>
            <div style="text-align: center;margin-left:-100px;margin-top:-10px;">
                <span style="font-size:10px;"><a style="padding-left:30%;" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" alt="download report">Download</a></span>
                <span style="font-size:10px;"><a style="maring-top:20px;" target="_blank" href="<?php echo base_url('viewmedia/' . $aid . ''); ?>" alt="download report">View</a></span>
            </div>

        </div>
        <div class="head" style="text-align:right;margin-left:25%; margin-top:-30px; ">
            <h3 style="font-weight: 600; margin-bottom: 1px;"> MARINE PRE DISPATCH</h3>
        </div>
        
        <table>
            <tr>
                <td style="width:100px">Case Reference</td>
                <td><?php echo $essentialData['case_reference']; ?></td>
                <td>Date of report</td>
                <td colspan="5"><?php echo $essentialData['date_of_report']; ?></td>
            </tr>
            <tr>
                <td style="width:100px">Name of Insured</td>
                <td><?php echo $essentialData['insured_name']; ?></td>
                <td>Sum Insured</td>
                <td colspan="5"><?php echo $essentialData['sum_insured']; ?></td>
            </tr>
            <tr>
                <td style="width:100px">Name of claimant </td>
                <td><?php echo $essentialData['claimant_name']; ?></td>
                <td>Policy Number</td>
                <td colspan="5"><?php echo $essentialData['policyNumber']; ?></td>
            </tr>
            <tr>
                <td style="width:100px">Vehicle Number</td>
                <td><?php echo $essentialData['vehicle_number']; ?></td>
                <td>Cause of Loss</td>
                <td colspan="5"><?php echo $essentialData['cause_loss']; ?></td>
            </tr>
              <tr>
                <td style="width:100px">Date of Loss</td>
                <td><?php echo $essentialData['loss_data']; ?></td>
                <td>Place of Loss</td>
                <td colspan="5"><?php echo $essentialData['loss_place']; ?></td>
            </tr>
            <tr>
                <td style="width:100px">Policy Report </td>
                <td><?php echo $essentialData['policy_report']; ?></td>
                <td>Date of Investigation</td>
                <td colspan="5"><?php echo $essentialData['investigation_date']; ?></td>
            </tr>
             <tr>
                <td style="width:100px">Nature of Loss  </td>
                <td><?php echo $essentialData['natureofloss']; ?></td>
                <td>Type of Policy</td>
                <td colspan="5"><?php 
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
                    ?></td>
            </tr>

            </tr>

            <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remark</td>
                    <td colspan="7"><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>
        </table>
       <!--  <h6 class="table-title">Photographs</h6>
        <table class="tablesaw table-striped table-bordered table-hover photographs">
            <tbody>
                <tr>
                    <?php foreach ($images as $img) { ?>
                        <?php
                        // Ensure image file exists and is readable
                        $imagePath = 'uploads/' .  $aid . '/images/' . $img;
                        if (file_exists($imagePath) && is_readable($imagePath)) {
                            $base64Image = base64_encode(file_get_contents($imagePath));
                        } else {
                            // Handle error: Image not accessible
                            $base64Image = ''; // Placeholder for missing image
                            error_log("Error: Image not accessible - " . $imagePath);
                        }
                        ?>
                        <td style="width:50%;">
                            <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="JPG Image" style="width:100%;height:20%;">
                        </td>
                    <?php } ?>
                </tr>
            </tbody>
        </table> -->
    </div>
</body>

</html>