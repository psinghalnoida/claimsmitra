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
            font-size: 14px;
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
        <div class="head" style="text-align:right;margin-left:15%; margin-top:-30px; ">
            <h3 style="font-weight: 400; margin-bottom: 1px;">Assets Valuation</h3>
        </div>
        <table>
            
            
            <?php if (!empty($essentialData['contact_person_name'])) { ?>
                <tr>
                    <td style="width: 25%;">Contact Person Name / Mobile </td>
                    <td><?php echo $essentialData['salutation'].' '.$essentialData['contact_person_name'].' ( '.$essentialData['contact_person_mobile'].' ) '; ?></td>
                </tr>
            <?php } ?>

            <?php if (!empty($essentialData['proposer'])) { ?>
                <tr>
                    <td>Proposer  </td>
                    <td ><?php echo $essentialData['proposer']; ?></td>
                </tr>
            <?php } ?>

           <?php if (!empty($essentialData['proposer_policy'])) { ?>
                <tr>
                    <td>Proposer Policy</td>
                    <td>
                        <?php 
                        if ($essentialData['proposer_policy'] == 'Other') {
                            echo $essentialData['other_proposer_policy']; 
                        } else {
                            echo $essentialData['proposer_policy'];
                        } 
                        ?>                    
                    </td>
                </tr>
            <?php } ?>


            <?php if (!empty($essentialData['insured_name'])) { ?>
                <tr>
                    <td>Name of proposer</td>
                    <td ><?php echo $essentialData['insured_name']; ?></td>
                </tr>
            <?php } ?>

              <?php if (!empty($essentialData['address'])) { ?>
                <tr>
                    <td>Address of Risk</td>
                    <td ><?php echo $essentialData['address']; ?></td>
                </tr>
            <?php } ?>
           
             <?php if (!empty($essentialData['appointment_date'])) { ?>
                <tr>
                    <td>Date of appointment</td>
                    <td ><?php echo $essentialData['appointment_date']; ?></td>
                </tr>
            <?php } ?>
             <?php if (!empty($essentialData['valuation_type'])) { ?>
                <tr>
                    <td>Type of Valuation</td>
                    <td ><?php echo $essentialData['valuation_type']; ?></td>
                </tr>
            <?php } ?>
             <?php if (!empty($essentialData['visitdate'])) { ?>
                <tr>
                    <td>Date of visit</td>
                    <td ><?php echo $essentialData['visitdate']; ?></td>
                </tr>
            <?php } ?>
            <?php if (!empty($essentialData['asset_value'])) { ?>
                <tr>
                    <td>Approx asset value</td>
                    <td ><?php echo $essentialData['asset_value']; ?></td>
                </tr>
            <?php } ?>
              <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remarks</td>
                    <td ><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>
        </table>
       
    </div>
</body>

</html>