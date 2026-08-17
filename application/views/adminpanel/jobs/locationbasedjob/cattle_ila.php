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
    </style>
</head>

<body>
    <div class="flyleaf">

     
          <?php if (isset($letterheadUrl)) : ?>
         <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("assets/" . $letterheadUrl)); ?>" alt="Embedded Image" style="width: 745px;height:24%"> <!---keep the width 710px----->
       <?php else : ?>
      <p style="color: red;"><?php echo $letterheadUrl ?></p>
      <?php endif; ?>

        <div class="header">
            <p class="reprtNumber">Report No. <?php echo $essentialData['case_reference']; ?></p>
            <p class="date">Date:<?php echo $essentialData['date_of_report']; ?> 
        </p>
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
        <div class="head" style="text-align:right;margin-left:15%; margin-top:-30px; ">
            <h3 style="font-weight: 600; margin-bottom: 1px;"> Cattle ILA</h3>
        </div>
        <h6 class="table-title" style="margin-top: 2px;">About Animal, Owner and Insurance</h6>
        <table>
            <tr>
                <td style="width:25%">Name of Owner</td>
                <td style="width:25%"><?php echo !empty($essentialData['insured_name']) ? $essentialData['insured_name'] : ($essentialData['nameofowner'] ?? ''); ?>
                </td>
                <td style="width:25%">City : <?php echo $essentialData['district']; ?></td>
                <td colspan="5" style="width:25%">State : <?php echo $essentialData['state']; ?></td>
            </tr>
            <tr>
                <td style="width:100px">Type of Animal</td>
                <td><?php echo $essentialData['typeOfAnimal']; ?></td>
                <td>TAG No.</td>
                <td colspan="5"><?php echo $essentialData['tagNumber']; ?></td>
            </tr>
            <tr>
                <td style="width:150px">Period of Coverage From</td>
                <td style="width:25%"><?php echo $essentialData['periodOfCoverage']; ?></td>
                <td>Date of Disease</td>>
                <td colspan="5"><?php echo $essentialData['dateOfDisease']; ?></td>
            </tr>
            <tr>
                <td style="width:30%">Date and Time of Death</td>
                <td style="width:20%"><?php echo $essentialData['dateOfDeath'] . ' ' . $essentialData['timeOfDeath']; ?></td>
                <td>Date and Time of Survey</td>
                <td colspan="5"><?php echo $essentialData['dateOfSurvey'] . ' ' . $essentialData['timeOfSurvey']; ?></td>
            </tr>
            <tr>
                <td>Death / Disablement</td>
                <td><?php echo $essentialData['deathOrDisablement']; ?></td>
                <td>Days Between Policy and Disease Start</td>
                <td colspan="5">
                    <?php
                    echo $essentialData['days_between_policy_and_disease'] . ' ';
                    if ($essentialData['days_between_policy_and_disease'] <= 21) {
                        echo '(Breach of policy)'; // Replace this with the actual text or HTML you want to display
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Tag Tempered</td>
                <td>
                    <?php
                    echo $essentialData['tag_tempered'] . ' ';
                    if ($essentialData['tag_tempered'] == "Yes") {
                        echo '(Breach of policy)'; // Replace this with the actual text or HTML you want to display
                    }
                    ?>
                </td>
                <td>Cattle Buried</td>
                <td colspan="5"><?php echo $essentialData['cattle_buried']; ?></td>
            </tr>
            <tr>
                <td style="width:30%">Survey Conducted Same day of Death</td>
                <td <?php if ($essentialData['SurveyConducted'] == "Yes") { ?> colspan="7" <?php } ?>; ?> <?php echo $essentialData['SurveyConducted']; ?></td>
                <?php if ($essentialData['SurveyConducted'] != "Yes") { ?>
                    <td style="width:30%">Why survey not conducted same day?</td>
                    <?php if ($essentialData['whysurveyNotConducted'] === "surveylateconducted_1") {
                        echo $whysurveynotconducted = "Received late intimation";
                    } elseif ($essentialData['whysurveyNotConducted'] === "surveylateconducted_2") {
                        echo $whysurveynotconducted = "Owner not available";
                    } elseif ($essentialData['whysurveyNotConducted'] === "surveylateconducted_3") {
                        echo $whysurveynotconducted = "Weather not permitting";
                    } elseif ($essentialData['whysurveyNotConducted'] === "surveylateconducted_4") {
                        echo $whysurveynotconducted = "Animal not available / already buried";
                    } ?>
                    <td colspan="5"><?php echo $whysurveynotconducted . ' ' . "hence same day survey could not be arranged."; ?>

                    </td>
                <?php } ?>

            </tr>
            <?php if (!empty($essentialData['remark'])) { ?>
                <tr>
                    <td>Remark</td>
                    <td colspan="7"><?php echo $essentialData['remark']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <h6 class="table-title">Photographs</h6>
            <?php if (!empty($images)): ?>
            <table class="tablesaw table-striped table-bordered table-hover photographs">
                <tbody>
                    <tr>
                        <?php foreach ($images as $img): ?>
                            <?php
                            // Define the image path
                            $imagePath = 'uploads/' .  $aid . '/images/' . $img;

                            // Check if the file exists and is readable
                            if (file_exists($imagePath) && is_readable($imagePath)) {
                                $base64Image = base64_encode(file_get_contents($imagePath));
                                $imageSrc = "data:image/jpeg;base64,{$base64Image}";
                            } else {
                                $imageSrc = ''; // No image found
                            }
                            ?>
                            <td style="width:50%;">
                                <?php if (!empty($imageSrc)): ?>
                                    <img src="<?php echo $imageSrc; ?>" alt="JPG Image" style="width:100%;height:20%;">
                                <?php else: ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p>No photos available.</p>
        <?php endif; ?>
    </div>
</body>

</html>