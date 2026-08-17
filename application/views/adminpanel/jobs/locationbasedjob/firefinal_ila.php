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
       <?php if (isset($letterheadUrl)) : ?>
         <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/" . $letterheadUrl)); ?>" alt="Embedded Image" style="width: 710px;height:24%"> <!---keep the width 710px----->
       <?php else : ?>
      <p style="color: red;"><?php echo $letterheadUrl ?></p>
      <?php endif; ?>
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
    <td style="border: none; width: 90%;">
        <?php
        function splitIntoLines($text, $maxLength = 40) {
            $wrappedText = wordwrap($text, $maxLength, "\n", true);
            return explode("\n", $wrappedText);
        }

        $appointBy = isset($essentialData['appoint_by']) ? trim($essentialData['appoint_by']) : '';
        $appointByLines = splitIntoLines($appointBy);

        $policyBranch = isset($essentialData['appointment_branch_name']) ? trim($essentialData['appointment_branch_name']) : '';
        $policyBranchLines = splitIntoLines($policyBranch);
        ?>

        <p style="color: black; margin: 0;">
            To,<br>
            Claims Manager<br>
            <?= htmlspecialchars($appointByLines[0], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php if (!empty($appointByLines[1])): ?>
                <?= htmlspecialchars($appointByLines[1], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php endif; ?>
            <?= htmlspecialchars($policyBranchLines[0], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php if (!empty($policyBranchLines[1])): ?>
                <?= htmlspecialchars($policyBranchLines[1], ENT_QUOTES, 'UTF-8'); ?>
            <?php endif; ?>
        </p>
    </td>

    <td style="border: none">
        <span style="font-size:10px; color:red; text-align:center">For Photos Scan Here</span>
        <img src="data:image/png;base64,<?= $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">
    </td>
</tr>

            </tbody>
        </table>

        <p class="text-center " style="background-color: white;text-align: center;font-size: 14px;">FIRST STATUS REPORT / INTERIM REPORT</p>

        
        <table>
            <tbody>
                <tr>  
                    <th class="key-heading">Insurers</th>
                    <th colspan="6"><?php echo $essentialData['policy_by']; ?><br><?php echo 'Address: ' .$essentialData['policy_branch']; ?><br></th>
                </tr>
            
                <tr>  
                    <th class="key-heading">Name and Address of Insured</th>
                    <th colspan="6"><?php echo $essentialData['insured_name']. ' , '.$essentialData['address']; ?></th>
                </tr>
                <tr>
                    
                    <th class="key-heading">Contact Person</th>
                    <th ><?php echo $essentialData['contact_person_name']; ?></th>
                    <th class="key-heading">Contact Person Mobile</th>
                    <th colspan="4"><?php echo $essentialData['contact_person_mobile']; ?></th>
                </tr>
                
                <tr>
                    <th class="key-heading">Date & Time of Instruction</th>
                    <th colspan="6">
                        <?php
                        $intimationDetails = [];

                        if (!empty($essentialData['Ofinstruction'])) {
                            $intimationDetails[] = $essentialData['Ofinstruction'];
                        }
                        if (!empty($essentialData['instruction_time'])) {
                            $intimationDetails[] = $essentialData['instruction_time'];
                        }
                       

                        echo !empty($intimationDetails) ? implode(' | ', $intimationDetails) : 'N/A';
                        ?>
                    </th>
                </tr>

               <tr>
                    <th class="key-heading">Date & Time of Visit</th>
                    <th colspan="6">
                        <?php
                        $visitDetails = [];

                        if (!empty($essentialData['visit_date'])) {
                            $visitDetails[] = $essentialData['visit_date'];
                        }
                        if (!empty($essentialData['visit_time'])) {
                            $visitDetails[] = $essentialData['visit_time'];
                        }
                        if (!empty($essentialData['visit_text'])) {
                            $visitDetails[] = $essentialData['visit_text'];
                        }

                        echo !empty($visitDetails) ? implode(' | ', $visitDetails) : 'N/A';
                        ?>
                    </th>
                </tr>
                 <tr>
                    <th class="key-heading">Date & Time of loss</th>
                    <th colspan="6">
                        <?php
                        $lossDetails = [];

                        if (!empty($essentialData['loss_data'])) {
                            $lossDetails[] = $essentialData['loss_data'];
                        }
                        if (!empty($essentialData['loss_time'])) {
                            $lossDetails[] = $essentialData['loss_time'];
                        }
                        if (!empty($essentialData['loss_date_text'])) {
                            $lossDetails[] = $essentialData['loss_date_text'];
                        }

                        echo !empty($lossDetails) ? implode(' | ', $lossDetails) : 'N/A';
                        ?>
                    </th>
                </tr>


               
                <tr>
                    <th class="key-heading">Place of Loss</th>
                    <th colspan="6"><?php echo $essentialData['survey_place']; ?></th>
                </tr>
                <tr>
                    <th class="key-heading">Policy Number</th>
                    <th colspan="6"><?php echo $essentialData['policyNumber']; ?></th>
                </tr>
               <tr>
                    <th class="key-heading">Policy Type</th>
                    <?php if (!empty($essentialData['policytype']) && strtolower($essentialData['policytype']) === 'other'): ?>
                        <th colspan="6"><?php echo htmlspecialchars($essentialData['otherPolicyType']); ?></th>
                    <?php else: ?>
                        <th colspan="6"><?php echo htmlspecialchars($essentialData['policytype']); ?></th>
                    <?php endif; ?>
                </tr>


               

                <tr>                 
                    <th  class="key-heading" colspan="7" >Activities of insured (In Brief )</th> 
                </tr>
                <tr>                 
                    <th colspan="7" style="justify-content: center;"><?php echo $essentialData['insured_activity']; ?></th> 
                </tr>
                <tr>
                    <th class="key-heading">Area of Loss (Machine/Stock/FFF/Builidng etc)</th>
                    <th colspan="6"><?php echo $essentialData['loss_area']; ?></th>
                </tr>
                <tr>    
                    <th colspan="7" class="key-heading">Cause of Loss, Its origin & nature & extent of loss</th>
                </tr>
                <tr><th colspan="7"><?php echo $essentialData['cause_loss']; ?></th></tr>
             <?php
                if (!empty($essentialData['images'])) {
                    $imageFiles = json_decode($essentialData['images'], true);

                    if (is_array($imageFiles) && !empty($imageFiles)) {
                        $uploadFolder = './uploads/' . $aid . '/propertyimage/';

                        if (is_dir($uploadFolder)) {
                            $imageCount = count($imageFiles);
                            $displayedImages = 0;

                            echo '<tr>'; // Start first row

                            foreach ($imageFiles as $imageData) {
                                if (is_array($imageData) && isset($imageData['file_name'], $imageData['description'])) {
                                    $imageFile = htmlspecialchars($imageData['file_name']);
                                    $description = htmlspecialchars($imageData['description']);
                                    $imagePath = $uploadFolder . $imageFile;

                                    if (file_exists($imagePath) && is_readable($imagePath) && getimagesize($imagePath)) {
                                        $base64Image = base64_encode(file_get_contents($imagePath));
                                        $imageSrc = 'data:image/jpeg;base64,' . $base64Image;

                                        // If only one image, center it across full row
                                        if ($imageCount === 1) {
                                            // echo '<td colspan="2" style="padding: 10px; text-align: center;">';
                                            // echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="max-width: 330px; max-height: 320px; margin-bottom: 5px;">';
                                            // echo '<p style="font-size: 12px; margin-top: 5px;">' . $description . '</p>';
                                            // echo '</td>';
                                             echo '<tr style="page-break-inside: avoid;">';
                                    echo '<td colspan="7" style="padding: 10px; text-align: center;">';
                                    echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="max-width: 330px; max-height: 320px; margin-bottom: 5px;">';
                                    echo '<p style="font-size: 12px; margin-top: 5px;">' . $description . '</p>';
                                    echo '</td>';
                                    echo '</tr>';

                                            break; // Stop the loop after one image
                                        } else {
                                            // Start a new row every two images
                                            if ($displayedImages > 0 && $displayedImages % 2 == 0) {
                                                echo '</tr><tr>';
                                            }

                                            // Display images side by side (max 2 per row)
                                            echo '<td style="padding: 10px; text-align: center; width: 50%;">';
                                            echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="max-width: 330px; max-height: 320px; margin-bottom: 5px;">';
                                            echo '<p style="font-size: 12px; margin-top: 5px;">' . $description . '</p>';
                                            echo '</td>';

                                            $displayedImages++;
                                        }
                                    }
                                }
                            }
                            echo '</tr>'; // Close last row
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
                if (!empty($essentialData['obimages'])) {
                $imageFiles = json_decode($essentialData['obimages'], true);

                // Ensure JSON decoding was successful and result is an array
                if (is_array($imageFiles) && !empty($imageFiles)) {
                    $uploadFolder = './uploads/' . $aid . '/propertyimage/';

                    if (is_dir($uploadFolder)) {
                        $hasImages = false; // Flag to check if any valid image exists

                        foreach ($imageFiles as $imageData) {
                            // Ensure $imageData is an array and contains the expected keys
                            if (is_array($imageData) && isset($imageData['file_name'], $imageData['description'])) {
                                $imageFile = htmlspecialchars($imageData['file_name']);
                                $description = htmlspecialchars($imageData['description']);
                                $imagePath = $uploadFolder . $imageFile;

                                // Check if file exists and is a valid image
                                if (file_exists($imagePath) && is_readable($imagePath) && getimagesize($imagePath)) {
                                    $base64Image = base64_encode(file_get_contents($imagePath));
                                    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;

                                    // Render the image within a table row
                                    echo '<tr style="page-break-inside: avoid;">';
                                    echo '<td colspan="7" style="padding: 10px; text-align: center;">';
                                    echo '<img src="' . $imageSrc . '" alt="Uploaded Image" style="max-width: 330px; max-height: 320px; margin-bottom: 5px;">';
                                    echo '<p style="font-size: 12px; margin-top: 5px;">' . $description . '</p>';
                                    echo '</td>';
                                    echo '</tr>';

                                    $hasImages = true;
                                }
                            }
                        }

                        // If no valid images were found, show a message
                        if (!$hasImages) {
                            echo '<tr><td colspan="7" style="text-align:center;">No valid images available.</td></tr>';
                        }
                    }
                 } 
                } 
                ?>

               

                <?php if (!empty($essentialData['xlsheetFile'])): ?>
                <tr>
                    <th colspan="7"><?php echo htmlspecialchars($essentialData['xlsheetFile'], ENT_QUOTES, 'UTF-8'); ?></th>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div style="padding-top: 20px;">
            <table >
                <thead>
                        <tr>
                            <td style="width:30%;">
                                <table style="width:100%;">
                                    <tbody style="width:100%;">
                                        <?php if (isset($essentialData['stocks'])): ?>
                                        <tr>
                                            <td style="padding-top: 20px;width:50%;">Stocks</td>
                                            <td style="padding-top: 20px;width:50%;"><?php echo htmlspecialchars($essentialData['stocks']); ?></td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php if (isset($essentialData['pm'])): ?>
                                        <tr>
                                            <td>P&M</td>
                                            <td><?php echo htmlspecialchars($essentialData['pm']); ?></td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php if (isset($essentialData['building'])): ?>
                                        <tr>
                                            <td>Building</td>
                                            <td><?php echo htmlspecialchars($essentialData['building']); ?></td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php if (isset($essentialData['total'])): ?>
                                        <tr>
                                            <td>Total</td>
                                            <td><?php echo htmlspecialchars($essentialData['total']); ?></td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php if (isset($essentialData['recovery'])): ?>
                                        <tr>
                                            <td>Recoveries and Reductions</td>
                                            <td><?php echo htmlspecialchars($essentialData['recovery']); ?></td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php if (isset($essentialData['expected_liability'])): ?>
                                        <tr>
                                            <td>Expected Liability</td>
                                            <td><?php echo htmlspecialchars($essentialData['expected_liability']); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </td>

                            <?php if (!empty($essentialData['remark'])): ?>
                            <td colspan="2" style="vertical-align: top; padding-left: 20px;"><b>Remark:</b>
                                <?php echo nl2br(htmlspecialchars($essentialData['remark'], ENT_QUOTES, 'UTF-8')); ?>
                            </td>
                            <?php endif; ?>
                        </tr>

                </thead>
         </table>
        </div>
          <p style="font-size: 14px;">ISSUED WITHOUT PREJUDICE</p>
          <p style="font-size: 14px;">FOR VP SINGHAL and CO ISLA LTD <br><br><br><br>(SURVEYORS)</p>
    </div>

</body>

</html>