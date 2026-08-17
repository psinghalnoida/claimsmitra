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
        @page {
            margin-bottom: 20px;
        }

        @page {
            counter-increment: page;
            margin: 60px 40px;
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
            font-size: 13px;
        }

        th {
            border: 1px solid #000;
            text-align: left;
            padding-left: 3px;
            font-weight: 400;
            font-size: 13px;
        }

        .reprtNumber {
            float: left;
            font-size: 15px;
            font-weight: 600;
        }

        .report-date {
            float: right;
            font-size: 15px;
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
            font-size: 13px;
            padding-bottom: 0px;
            padding: 4px;
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
            font-size: 13px;
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
            font-size: 13px;
            font-weight: bold;
        }

        .table-cell {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="letterhead">
            <?php if (isset($letterheadUrl)) : ?>
                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/" . $letterheadUrl)); ?>"
                    alt="Embedded Image" style="width: 730px; height: 40%;">
            <?php else : ?>
                <p style="color: red;"><?php echo $letterheadUrl ?></p>
            <?php endif; ?>
        </div>
        <table>
            <tbody>
                <tr>
                    <th style="border: none;font-size: 15px;">Report No: <?php echo $essentialData['case_reference']; ?></th>
                    <th style="border: none; text-align:right;font-size: 15px;">Date: <?php echo date('d-m-Y', strtotime($essentialData['date_of_report'])); ?><br><span><?php echo $username; ?></span></th>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody style="padding:30px">
                <tr>
                    <td style="border: none; width:90%;font-size: 15px; ">
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
                        <p style="color: black;font-size:14px;">
                            To,<br>
                            <?php echo $essentialData['appoint_by']; ?><br>
                            <?php echo $firstLine . '<br>' . $secondLine; ?>
                        </p>
                    </td>

                    <td style="border: none">
                        <span style="font-size:10px; color:red; text-align:center">For Photos Scan Here</span>
                        <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="text-center m-1" style="background-color: white;text-align: center;">FIRST STATUS REPORT</p>
        <p class="text-center " style="border: 1px solid black;background-color: white;text-align: center;font-size: 14px;">INTERM REPORT</p>

        <table>
            <tbody>
                <tr>
                    <th class="key-heading">Insurers</th>
                    <th colspan="6"><?php echo $essentialData['policy_by']; ?><br><?php echo 'Address: ' . $essentialData['policy_branch']; ?><br></th>
                </tr>
                <tr>
                    <th class="key-heading">Name and Address of Insured</th>
                    <th colspan="6"><?php echo $essentialData['insured_name'] . ' , ' . $essentialData['address']; ?></th>
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
                    <th colspan="6"><?php echo $essentialData['visit_date'].' at '.$essentialData['visit_time']; ?></th>
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
                    <th class="key-heading" colspan="7">Activities of insured (In Brief )</th>
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
                <tr>
                    <th colspan="7"><?php echo htmlspecialchars($essentialData['cause_loss'], ENT_QUOTES, 'UTF-8'); ?></th>
                </tr>



                <?php
                // Retrieve observation statements as an associative array (using imgdescrps)
                $obsStatements = isset($essentialData['imgdescrps']) ? $essentialData['imgdescrps'] : [];

                        if (!empty($obsStatements)):
                            foreach ($obsStatements as $statement):
                                if (!empty($statement['images'])):
                        ?>
                            <tr>
                                <td colspan="7">
                                    <!-- Table for a single observation statement -->
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
                                        <tbody>
                                            <!-- Row for statement text -->
                                            <tr>
                                                <td colspan="7" style="padding: 5px 10px; text-align: justify; font-weight: bold;">
                                                    <?php echo !empty($statement['statement']) ? htmlspecialchars($statement['statement']) : ''; ?>
                                                </td>
                                            </tr>
                                            <!-- Row for images -->
                                            <tr>
                                                <td colspan="7" style="padding: 2px;">
                                                    <table style="width: 100%; border-collapse: collapse;">
                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                $imageCount = count($statement['images']);
                                                                $imageCounter = 0;
                                                                foreach ($statement['images'] as $image):
                                                                    // Convert URL to relative path
                                                                    $imagePath = parse_url($image, PHP_URL_PATH);
                                                                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;

                                                                    if (file_exists($absolutePath) && is_readable($absolutePath)) {
                                                                        $imageData = file_get_contents($absolutePath);
                                                                        $base64Image = base64_encode($imageData);
                                                                        $mimeType = mime_content_type($absolutePath);
                                                                        $imageSrc = "data:$mimeType;base64,$base64Image";
                                                                    } else {
                                                                        // Use a placeholder image if file not found or unreadable
                                                                        $placeholder = $_SERVER['DOCUMENT_ROOT'] . "/placeholder.png";
                                                                        $imageSrc = "data:image/png;base64," . base64_encode(file_get_contents($placeholder));
                                                                        error_log("Image not found: " . $absolutePath);
                                                                    }

                                                                    // Set column width and style based on number of images
                                                                    $colWidth = ($imageCount == 1) ? "100%" : "50%";
                                                                    $imageStyle = ($imageCount == 1)
                                                                        ? "width: 250px; height: 250px; display: block; margin: auto;"
                                                                        : "width: 100%; height: 250px;";
                                                                ?>
                                                                    <td style="width: <?php echo $colWidth; ?>; text-align: center; border: none;">
                                                                        <img src="<?php echo $imageSrc; ?>" alt="Observation Image" style="<?php echo $imageStyle; ?>">
                                                                    </td>
                                                                    <?php
                                                                    $imageCounter++;
                                                                    // After every 2 images, start a new table row, if there are more images
                                                                    if ($imageCounter % 2 == 0 && $imageCounter < $imageCount):
                                                                    ?>
                                                            </tr>
                                                            <tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                
                endif;
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
                // Retrieve observation statements as an associative array (using imgdescrps)
                $obsStatements = isset($essentialData['imgobdescrp']) ? $essentialData['imgobdescrp'] : [];

                        if (!empty($obsStatements)):
                            foreach ($obsStatements as $statement):
                                if (!empty($statement['images'])):
                        ?>
                            <tr>
                                <td colspan="7">
                                    <!-- Table for a single observation statement -->
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
                                        <tbody>
                                            <!-- Row for statement text -->
                                            <tr>
                                                <td colspan="7" style="padding: 5px 10px; text-align: justify; font-weight: bold;">
                                                    <?php echo !empty($statement['statement']) ? htmlspecialchars($statement['statement']) : ''; ?>
                                                </td>
                                            </tr>
                                            <!-- Row for images -->
                                            <tr>
                                                <td colspan="7" style="padding: 2px;">
                                                    <table style="width: 100%; border-collapse: collapse;">
                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                $imageCount = count($statement['images']);
                                                                $imageCounter = 0;
                                                                foreach ($statement['images'] as $image):
                                                                    // Convert URL to relative path
                                                                    $imagePath = parse_url($image, PHP_URL_PATH);
                                                                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;

                                                                    if (file_exists($absolutePath) && is_readable($absolutePath)) {
                                                                        $imageData = file_get_contents($absolutePath);
                                                                        $base64Image = base64_encode($imageData);
                                                                        $mimeType = mime_content_type($absolutePath);
                                                                        $imageSrc = "data:$mimeType;base64,$base64Image";
                                                                    } else {
                                                                        // Use a placeholder image if file not found or unreadable
                                                                        $placeholder = $_SERVER['DOCUMENT_ROOT'] . "/placeholder.png";
                                                                        $imageSrc = "data:image/png;base64," . base64_encode(file_get_contents($placeholder));
                                                                        error_log("Image not found: " . $absolutePath);
                                                                    }

                                                                    // Set column width and style based on number of images
                                                                    $colWidth = ($imageCount == 1) ? "100%" : "50%";
                                                                    $imageStyle = ($imageCount == 1)
                                                                        ? "width: 250px; height: 250px; display: block; margin: auto;"
                                                                        : "width: 100%; height: 250px;";
                                                                ?>
                                                                    <td style="width: <?php echo $colWidth; ?>; text-align: center; border: none;">
                                                                        <img src="<?php echo $imageSrc; ?>" alt="Observation Image" style="<?php echo $imageStyle; ?>">
                                                                    </td>
                                                                    <?php
                                                                    $imageCounter++;
                                                                    // After every 2 images, start a new table row, if there are more images
                                                                    if ($imageCounter % 2 == 0 && $imageCounter < $imageCount):
                                                                    ?>
                                                            </tr>
                                                            <tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                endif;
                ?>

                <tr>
                    <td colspan="7">
                        <table style="width:40%;">
                            <tbody style="width:40%;">
                                <?php if (!empty($essentialData['stocks'])): ?>
                                    <tr>
                                        <td>Stocks</td>
                                        <td><?php echo $essentialData['stocks']; ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($essentialData['stocks'])): ?>

                                    <tr>
                                        <td>P&M</td>
                                        <td><?php echo $essentialData['pm']; ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($essentialData['stocks'])): ?>
                                    <tr>
                                        <td>Building</td>
                                        <td><?php echo $essentialData['building']; ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($essentialData['stocks'])): ?>
                                    <tr>
                                        <td>Total</td>
                                        <td><?php echo $essentialData['total']; ?></td>
                                    </tr>
                                <?php endif; ?>


                                <?php if (!empty($essentialData['stocks'])): ?>
                                    <tr>
                                        <td>Recoveries and Reductions</td>
                                        <td><?php echo $essentialData['recovery']; ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($essentialData['stocks'])): ?>

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
        <div style="margin-top: 40px; text-align: right;">
            <p style="font-size: 16px;">
                <?php if (!empty($companyname['companyName'])) { ?>
                    <?php echo htmlspecialchars($companyname['companyName'], ENT_QUOTES, 'UTF-8'); ?>
                <?php } ?>
                <br>
            </p>

            <h5 style="font-size: 16px; margin-top: 40px;">Authorized Signatory</h5>
        </div>
    </div>

</body>

</html>