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
        body {
            font-family: 'New Cicle', sans-serif;
            /* margin-top: -10px; */
            margin-left: -25px;
            margin-right: -25px;
            margin-bottom: -10px;
            margin-top: -25px;
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
            font-size: 10px;
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

        .container {
            max-width: 1100px;
            margin: 0;
            padding: 0;
            display: contents;
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
    </style>
</head>

<body>
    <div class="container ">
        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 760px;height:25%">
        <table>
            <tbody>
                <tr>
                    <th style="border: none">Report No: <?php echo $essentialData['case_reference']; ?></th>
                    <th style="border: none; text-align:right">Date: <?php echo date('d-m-Y', strtotime($essentialData['date_of_report'])); ?><br><span><?php echo $username; ?></span></th>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody style="padding:30px">
                <tr>
                    <td style="border: none; width:90%; ">
                        <?php
                        // Function to split text into two lines
                        function splitIntoLines($text, $maxLength = 40) {
                            $wrappedText = wordwrap($text, $maxLength, "\n", true);
                            $lines = explode("\n", $wrappedText);
                            return [
                                isset($lines[0]) ? $lines[0] : '',
                                isset($lines[1]) ? $lines[1] : ''
                            ];
                        }

                        // Process appoint_by
                        $appointBy = isset($essentialData['appoint_by']) ? $essentialData['appoint_by'] : '';
                        list($appointByFirstLine, $appointBySecondLine) = splitIntoLines($appointBy);

                        // Process appointment_branch_name
                        $policyBranch = isset($essentialData['appointment_branch_name']) ? $essentialData['appointment_branch_name'] : '';
                        list($policyBranchFirstLine, $policyBranchSecondLine) = splitIntoLines($policyBranch);
                        ?>

                        <p style="color: black; margin: 0;">
                            To,<br>
                            Claims Manager<br>
                            <?php echo htmlspecialchars($appointByFirstLine, ENT_QUOTES, 'UTF-8'); ?><br>
                            <?php echo htmlspecialchars($appointBySecondLine, ENT_QUOTES, 'UTF-8'); ?><br>
                            <?php echo htmlspecialchars($policyBranchFirstLine, ENT_QUOTES, 'UTF-8'); ?><br>
                            <?php echo htmlspecialchars($policyBranchSecondLine, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </td>

                    <td style="border: none">
                        <span style="font-size:10px; color:red; text-align:center">For Photos Scan Here</span>
                        <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="text-center" style="background-color: white;text-align: center;margin-bottom: -8px;">FIRST STATUS REPORT</p>

        <p class="text-center " style="border: 1px solid black;background-color: white;text-align: center;font-size: 14px;">INTERM REPORT</p>

        
        <table>
            <tbody>
                <tr>  
                    <th class="key-heading">Insurers</th>
                    <th colspan="6"><?php echo $essentialData['policy_by']; ?><br><?php echo 'Address: ' .$essentialData['policy_branch']; ?><br></th>
                </tr>
              
               <?php
                    if (isset($essentialData['xlsheetFile']) && !empty($essentialData['xlsheetFile'])) {
                        // Extract the image URL from the xlsheetFile field
                        preg_match('/src="([^"]+)"/', $essentialData['xlsheetFile'], $matches);
                        $imageUrl = $matches[1] ?? null;

                        if ($imageUrl) {
                            // Get the image content and convert it to base64
                            $imageContent = file_get_contents($imageUrl);
                            if ($imageContent) {
                                $base64Image = base64_encode($imageContent);
                                $imageSrc = 'data:image/jpeg;base64,' . $base64Image; // Adjust MIME type if necessary

                                // Render the entire structure only if data exists
                                echo '<tr>';
                                echo '<th colspan="7" style="padding: 10px; text-align: center; width: 100%;">';
                                echo '<table style="width: 100%; table-layout: fixed;">';
                                echo '<tr>';
                                echo '<th class="key-heading">Policy No.</th>';
                                echo '<th colspan="6">As under:</th>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td style="padding: 10px; text-align: center; width: 100%;">';
                                echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="width: 100%; height: auto; margin-bottom: 5px;">'; // Adjust image size to fit
                                echo '</td>';
                                echo '</tr>';
                                echo '</table>';
                                echo '</th>';
                                echo '</tr>';
                            }
                        }
                    }
                ?>



                <tr>  
                    <th class="key-heading">Name and Address of Insured</th>
                    <th colspan="6"><?php echo $essentialData['insured_name']. ' , '.$essentialData['address']; ?></th>
                </tr>
                <tr>
                    
                    <th class="key-heading">Contact Persion</th>
                    <th colspan="6"><?php echo $essentialData['contact_person_name']; ?></th>
                </tr>
                <tr>
                   
                    <th class="key-heading">Time & Date Ofinstruction</th>
                    <th colspan="6"><?php echo $essentialData['Ofinstruction']; ?></th>
                </tr>
                <tr>
                   
                    <th class="key-heading">Time & Date of Visit</th>
                    <th colspan="6"><?php echo $essentialData['visit_date_time']; ?></th>
                </tr>
                <tr>
                   
                    <th class="key-heading">Date of loss</th>
                    <th colspan="6"><?php echo $essentialData['loss_data']; ?>
                   </th>
                </tr>
                <tr>
                   
                    <th class="key-heading">Place of Loss</th>
                    <th colspan="6"><?php echo $essentialData['loss_area']; ?></th>
                </tr>
                <tr>                 
                    <th  class="key-heading" colspan="7" >Activities of insured (In Brief )</th> 
                </tr>
                <tr>                 
                    <th colspan="7"><?php echo $essentialData['insured_activity']; ?></th> 
                </tr>
                <tr>
                    <th class="key-heading">Area of Loss (Machine/Stock/FFF/Builidng etc)</th>
                    <th colspan="6"><?php echo $essentialData['loss_area']; ?></th>
                </tr>

                <tr>    
                    <th colspan="7" class="key-heading">Cause of Loss, Its origin & nature & extent of loss</th>

                </tr>
                <tr><th colspan="7"><?php echo $essentialData['cause_loss']; ?></th>
                </tr>
               <?php
                if (isset($essentialData['images'])) {
                    $imageFiles = json_decode($essentialData['images'], true);

                    if (!empty($imageFiles)) {
                        $uploadFolder = './uploads/' . $aid . '/propertyimage/';

                        if (is_dir($uploadFolder)) {
                            foreach ($imageFiles as $imageData) {
                                $imageFile = $imageData['file_name'];
                                $description = $imageData['description'];
                                $imagePath = $uploadFolder . $imageFile;

                                if (file_exists($imagePath) && is_readable($imagePath)) {
                                    $base64Image = base64_encode(file_get_contents($imagePath));
                                    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;

                                    // Render each image within a table row
                                    echo '<tr>';
                                    echo '<td colspan="7" style="padding: 10px; text-align: center;">';
                                    echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="max-width: 330px; max-height: 320px; margin-bottom: 5px;">';
                                    echo '<p style="font-size: 12px; margin-top: 5px;">' . htmlspecialchars($description) . '</p>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    }
                }
                ?>
               <?php if (isset($essentialData['observation']) && !empty($essentialData['observation'])): ?>

                <tr>   
                    <th colspan="7" class="key-heading">Observations</th>
                </tr>
                <tr>   
                    <th colspan="7"><?php echo htmlspecialchars($essentialData['observation'], ENT_QUOTES, 'UTF-8'); ?></th> 
                </tr>   
                <?php endif; ?>
  

             <?php
                if (isset($essentialData['obimages'])) {
                    $imageFiles = json_decode($essentialData['obimages'], true);

                    if (!empty($imageFiles)) {
                        $uploadFolder = './uploads/' . $aid . '/propertyimage/';

                        if (is_dir($uploadFolder)) {
                            foreach ($imageFiles as $imageData) {
                                $imageFile = $imageData['file_name'];
                                $description = $imageData['description'];
                                $imagePath = $uploadFolder . $imageFile;

                                if (file_exists($imagePath) && is_readable($imagePath)) {
                                    $base64Image = base64_encode(file_get_contents($imagePath));
                                    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;

                                    // Render image row
                                    echo '<tr style="page-break-inside: avoid;">';
                                    echo '<td colspan="7" style="padding: 10px; text-align: center;">';
                                    echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="max-width: 330px; max-height: 320px; margin-bottom: 5px;">';
                                    echo '<p style="font-size: 12px; margin-top: 5px;">' . htmlspecialchars($description) . '</p>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    }
                }
                ?>


                <tr>
                    <td colspan="7" >
                        <table style="width:40%;">
                            <tbody style="width:40%;">
                               <!--  <tr>
                                    <td></td>
                                    <td>Loss</td>
                                </tr> -->
                               <?php if (isset($essentialData['stocks'])): ?>
                                <tr>
                                    <td>Stocks</td>
                                    <td><?php echo $essentialData['stocks']; ?></td>
                                </tr>
                                <?php endif; ?>

                               <?php if (isset($essentialData['stocks'])): ?>

                                <tr>
                                    <td>P&M</td>
                                    <td><?php echo $essentialData['pm']; ?></td>
                                </tr>
                                 <?php endif; ?>

                                <?php if (isset($essentialData['stocks'])): ?>
                                <tr>
                                    <td>Building</td>
                                    <td><?php echo $essentialData['building']; ?></td>
                                </tr>
                                 <?php endif; ?>

                                <?php if (isset($essentialData['stocks'])): ?>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $essentialData['total']; ?></td>
                                </tr>
                                 <?php endif; ?>


                                <?php if (isset($essentialData['stocks'])): ?>
                                <tr>
                                    <td>Recoveries and Reductions</td>
                                    <td><?php echo $essentialData['recovery']; ?></td>
                                </tr>
                                 <?php endif; ?>
                                 <?php if (isset($essentialData['stocks'])): ?>

                                <tr>
                                    <td>Expected Liability</td>
                                    <td><?php echo $essentialData['expected_liability']; ?></td>
                                </tr>
                                 <?php endif; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
          <p style="font-size: 14px;">ISSUED WITHOUT PREJUDICE</p>
          <p style="font-size: 14px;">FOR VP SINGHAL and CO ISLA (P) LTD <br><br><br><br><br><br> (SURVEYORS)</p>
         

    </div>

</body>

</html>