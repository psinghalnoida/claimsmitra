<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Pdf</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="http://fonts.cdnfonts.com/css/new-cicle" rel="stylesheet">
</head>
<style>
    .header {
        top:0;
        border-collapse: collapse;
    }
    .receiver{
        float: left;
        margin: 0px;
        padding: 0px;
        flex: 1;
        white-space: normal; 
        word-wrap: break-word;
    }
    .date {
        float: right;
        margin: 0px;
        padding: 0px;
    }
</style>
<body>
    <div class="container">
        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 710px;">
        <div id="emailContent">
            <div class="header" >
                <p class="receiver">Reference No.: <?php
                    if (!empty($essentialData['insured_name'])) {
                       echo $essentialData['insured_name'];
                    } else {
                        echo 'No recipients selected.';
                    }
                    ?>
                </p>
                
                <p class="date">Date: <?php echo date('d.m.Y'); ?></p>
            </div>
            <br>
            <div class="header" >
                <p class="receiver">To: <?php
                    if (!empty($essentialData['insured_name'])) {
                       echo $essentialData['insured_name'];
                    } else {
                        echo 'No recipients selected.';
                    }
                    ?>
                </p>
            </div>
            <table style="width: 100%; border-collapse: collapse;margin-top:50px;">
                <tbody>
                    <tr>
                        <td style="width:40%">
                            Subject : Letter of requirement loss under <?php echo $essentialData['otherPolicyType']; ?>, Policy No. <?php echo isset($essentialData['policyNumber']) && !empty($essentialData['policyNumber'])
                                    ? htmlspecialchars($essentialData['policyNumber'])
                                    : (isset($jobData['policyNumber']) ? htmlspecialchars($jobData['policyNumber']) : '');
                                ?>, Date of loss <?php
                                echo $essentialData['loss_data'];
                                ?>
                        </td>
                    </tr>
                    <?php if (isset($essentialData['date_of_incident']) || isset($essentialData['time_of_incident'])): ?>
                        <tr style="font-style: italic;font-size:13px;">
                            <td></td>
                            <td style="">Date of loss</td>
                            <td style=""><?php
                                $dateOfIncident = isset($essentialData['date_of_incident']) ? htmlspecialchars($essentialData['date_of_incident']) : '-';
                                $timeOfIncident = isset($essentialData['time_of_incident']) ? htmlspecialchars($essentialData['time_of_incident']) : '-';
                                echo $dateOfIncident . ' ' . $timeOfIncident;
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if (isset($essentialData['loss_item']) && !empty($essentialData['loss_item']) || isset($jobData['loss_item'])): ?>
                        <tr style="font-style: italic;font-size:13px;">
                            <td></td>
                            <td style="">Loss Item</td>
                            <td style=""><?php echo isset($essentialData['loss_item']) && !empty($essentialData['policyNumber'])
                                    ? htmlspecialchars($essentialData['loss_item'])
                                    : (isset($jobData['loss_item']) ? htmlspecialchars($jobData['loss_item']) : '');
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if (isset($essentialData['tagNumber']) && !empty($essentialData['tagNumber']) || isset($jobData['tagNumber'])): ?>
                        <tr style="font-style: italic;font-size:13px;">
                            <td></td>
                            <td style="">Tag Number</td>
                            <td style=""><?php echo isset($essentialData['tagNumber']) && !empty($essentialData['tagNumber'])
                                ? htmlspecialchars($essentialData['tagNumber'])
                                : (isset($caseData['tagNumber']) ? htmlspecialchars($caseData['tagNumber']) : 'Not available');
                            ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
          
            <?php if (!empty($formattedQuestions)): ?>
                <p><?php echo $formattedQuestions; ?></p>
            <?php endif; ?>

            <?php if (!empty($specialNote)): ?>
                <p><strong>Special Note:</strong></p>
                <p><?php echo $specialNote; ?></p>
            <?php endif; ?>

            <br>
           
        </div>
    </div>
</body>
</html>
