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
            size: A4;
            margin: 10mm;
        }

        * {
            page-break-before: auto;
            page-break-after: auto;
            page-break-inside: auto;
        }

        body {
            font-family: 'New Cicle', sans-serif;
            /*margin-top: -10px;*/
            margin-left: -25px;
            margin-right: -25px;
            margin-bottom: -10px;
        }

        footer {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 50px;
            bottom: 0px;
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

        .table {
            padding: 1px 10px;
        }

        .row {
            width: 100%;
            overflow: hidden;
            margin: 10px auto;
        }

        .col {
            
            margin: 1px;
            padding: 10px;
        }

        .flyleaf {
            overflow: hidden;
           
        }
    </style>
</head>

<body>
    <div class="flyleaf">
    <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 760px;">
    <div class="header">
            <p class="reprtNumber">Case Reference <?php echo $essentialData['case_reference']; ?></p>
            <p class="date">Date:<?php echo $essentialData['date_of_report']; ?></p>
        </div>
        <div style="width: 100%;">
            <div style="float: left; width: 50%;">
                <p style="color: black; margin-bottom: 0px;">To,<br>The Senior Divisional Manager <br> New India
                    Assurance Company
                    Limited<br>
                    Divisional Office Badshah Khan Chowk, <br> Faridabad.
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
        <div class="head" style="text-align:right;margin-left:15%;margin-bottom:5px;">
            <h3 style="font-weight: 600;margin:0px;"> Motor Spot ILA</h3>
        </div>
        <table>
            <tbody>
                <tr>
                    <td style="width: 28%;">Ref. No. </td>
                    <td style="width: 25%;">
                        <?php echo $essentialData['case_reference']; ?>
                    </td>
                    <td style="width: 22%;">Insured Name: </td>
                    <td style="width: 25%;">
                        <?php echo $essentialData['insured_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Vehicle No. </td>
                    <td><?php echo $essentialData['vehicle_number']; ?></td>
                    <td>Date of Loss: </td>
                    <td><?php echo $essentialData['date_of_incident']; ?></td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top: 10px;">
            <tr>
                <td style="width:28%">Vehicle Regn No. Make & Model</td>
                <td colspan="7" style="width:25%"> <?php echo $essentialData['register_no'] . ' ' . $essentialData['make_model']; ?></td>
            </tr>

            <tr>
                <td>Date and Time of accident</td>
                <td colspan="7"> <?php echo $essentialData['date_of_incident'] . ' ' . $essentialData['time_of_incident'] . ' ' . $essentialData['place_of_accident']; ?></td>

            </tr>
            <tr>
                <td>Policy number /Sum Insured</td>
                <td colspan="7">
                    <?php echo $essentialData['policyNumber'] . '<br>' . $essentialData['sum_insured']; ?>
                </td>
            </tr>
            <tr>
                <td>Name of Driver</td>
                <td > <?php echo $essentialData['name_of_driver']; ?></td>
                <td>Driving License No.</td>
                <td colspan="5"> <?php echo $essentialData['driving_license_no']; ?></td>
            </tr>
            
            <tr>
                <td style="width:28%">Date of allotment of survey </td>
                <td style="width:25%"> <?php echo $essentialData['survey_allotment_date']; ?></td>
                <td style="width:25%">Survey Date</td>
                <td colspan="5" style="width:25%"> <?php echo $essentialData['survey_date']; ?>
                </td>
            </tr>
            <tr>
                <td>Place of survey</td>
                <td > <?php echo $essentialData['survey_place']; ?></td>
                <td>Place of repair / will be repaired</td>
                <td colspan="5"> <?php echo $essentialData['place_of_repairer']; ?></td>

            </tr>
           
            <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remark</td>
                    <td colspan="7"><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <h6 class="table-title" style="margin-top:10px;">Photographs</h6>
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
        <?php endif; ?>
    </div>
</body>

</html>