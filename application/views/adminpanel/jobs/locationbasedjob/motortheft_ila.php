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
            margin-top: -35px;
            margin-left: -25px;
            margin-right: -25px;
            /* margin-bottom: -10px; */

        }

        .footer {
            position: fixed;
        }

        tr {
            height: 20px;
        }

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
            font-size: 15px;
            font-weight: 600;
            padding: 0px;
            margin: 0px;
        }

        .date {
            float: right;
            font-size: 15px;
            font-weight: 600;
            padding: 0px;
            margin: 0px;
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
            font-size: 14px;
            padding-bottom: 0px;
        }

        .card-text {
            font-size: 14px;
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
            padding: 2px;
            font-size: 13px;
        }


        /* div {
        background: rgba(0, 0, 0, 0.07);
        } */

        .table {
            padding: 1px 10px;
        }

        .row {
            width: 100%;
            overflow: hidden;
            margin: 10px auto;
        }

        .col {
            /* //float: left; un-comment to float the DIVs */
            margin: 1px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="flyleaf">

        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 750px;height:24%">
        <div class="header">
            <p class="reprtNumber">Case Reference <?php echo $essentialData['case_reference']; ?></p>
            <p class="date">Date:<?php echo $essentialData['date_of_report']; ?></p>
        </div>

        <div style="width: 100%;">
            <div style="float: left; width: 50%;">
                
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

                        <p style="color: black;">
                            To,<br>
                            The Senior Divisional Manager<br>
                            <?php echo $essentialData['appoint_by']; ?><br>
                            <?php echo $firstLine . '<br>' . $secondLine; ?>
                        </p>
            </div>
            <div style="float:left;width: 50%;color:red;text-align: right;margin-top:-15px; font-size:10px;">
                <span>For Photos Scan Here</span>
            </div>
            <div style="float:left;width: 50%;text-align: right;">
                <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">

            </div>
            <div style="text-align: center;margin-left:-100px;">
                <span style="font-size:10px;"><a style="padding-left:30%; maring-top:20px;" href="<?php echo base_url('downloadmedia/' . $aid . ''); ?>" alt="download report">Download</a></span>
                <span style="font-size:10px;"><a style="maring-top:20px;" target="_blank" href="<?php echo base_url('viewmedia/' . $aid . ''); ?>" alt="download report">View</a></span>
            </div>

        </div>
        <div class="head" style="text-align:right;margin-left:15%; margin-top:-10px; margin-bottom:10px">
            <h3 style="font-weight: 600;"> Motor Theft ILA</h3>
        </div>
        <table>
            <tr>
                <td style="width:200px">Vehicle No.</td>
                <td colspan="6"> <?php echo $essentialData['vehicle_number']; ?></td>
               
            </tr>
            <tr>
                 <td style="width:25%">Policy By</td>
                <td colspan="6"> <?php echo $essentialData['policy_by']; ?></td>
            </tr>
            <tr>
                <td style="width:100px">Policy Number</td>
                <td colspan="6"> <?php echo $essentialData['policyNumber']; ?></td>
               
            </tr>
            <tr>
                 <td>Period of Insurance</td>
                <td colspan="6"> <?php echo $essentialData['insurancefrom'] . 'To' . $essentialData['insuranceto'] ; ?></td>
            </tr>
            <tr>
                <td >IDV</td>
                <td colspan="6"> <?php echo $essentialData['idv']; ?></td>
               <!--  <td>Registration No</td>>
                <td colspan="5"> <?php echo $essentialData['register_no']; ?></td> -->
            </tr>

            <tr>
                <td >Registered Owner</td>
                <td  colspan="6" > <?php echo $essentialData['registered_owner']; ?></td>
                
            </tr>
             <tr>
                <td>Date & Time of Incident</td>
                <td colspan="6"> <?php echo $essentialData['date_of_incident']; ?> at <?php echo $essentialData['time_of_incident']; ?></td>
            </tr>
            <tr>
                <td>FIR No. </td>
                <td colspan="6"> <?php echo $essentialData['fir_no']; ?> </td>
                
            </tr>
            <tr>
                <td>FIR Date</td>
                <td colspan="6"> <?php echo $essentialData['fir_date']; ?></td>
            </tr>

            <tr>
                <td>Name of Police Station</td>
                <td colspan="6"> <?php echo $essentialData['police_station_name']; ?></td>
                
            </tr>

            <tr>
               <td>Date of Appointment </td>
                <td colspan="6"> <?php echo $essentialData['appointment_date']; ?></td> 
            </tr>
            <tr>
                <td style="width:30%">Name of vehicle owner</td>
                <td colspan="6"> <?php echo $essentialData['insured_name']; ?></td>
                
            </tr>
            <tr>
               <td>Brief narration of Incident as per claim papers</td>
                <td colspan="6"> <?php echo $essentialData['brief_narration']; ?></td> 
            </tr>
            <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remark</td>
                    <td colspan="6"><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>
        </table>
       <!--  <h6 class="table-title">Photographs</h6>
        <?php if (!empty($images)): ?>
                <table class="tablesaw table-striped table-bordered table-hover photographs">
                    <tbody>
                        <tr>
                            <?php foreach ($images as $img) { ?>
                                <?php
                                // Ensure image file exists and is readable
                                $imagePath = 'uploads/' . $aid . '/images/' . $img;
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
            </table>
        <?php else: ?>
            <p>No images available to display.</p>
        <?php endif; ?> -->
    </div>
</body>

</html>