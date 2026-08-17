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

        .table-title {
            background-color: #e3e3e3;
            margin-bottom: 0px;
            padding: 2px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 12px;
            margin-top: 10px;
        }

        th {
            border: 1px solid black;
            font-size: 12px;
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
        .container {
        width: 40%;
        margin: auto;
      }

      .bg {
        background-color: #99cb00;
      }
      .bottom {
        width: 53%;

        background-color: #99cb00;
        display: flex;
        margin-left: 30%;
        flex-direction: column;
        justify-content: space-between;
      }

      .bottomTable {
        position: fixed;
        bottom: 0;
        right: 0;
        border-collapse: collapse;
        border: 2px solid black; /* Outer border */
        background-color: white; /* Optional for visibility */
      }

      .bottomTable td {
        border: 1px solid black; /* Inner cell borders */
        padding: 5px;
      }
      .center {
        text-align: center;
      }
      .assessmenttable th,
        .assessmenttable td,
        .assessmenttable tr {
          border: none;
        }


    </style>
</head>

<body>
    <div class="flyleaf">
        <div class="imgheader">
            <table>
                <tbody>
                    <tr style="background-color: rgb(243, 243, 243); border:none; color:#000;height:30px;">
                        <td><b> <?= $essential_data['case_reference'] ?? 'N/A' ?></b></td>
                        <td style="text-align:right;">
                            <b> <?= $essential_data['vehicle_number'] ?? 'N/A' ?></b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="border: none;width:25%"></th>
                    <th style="border: none;width:25%"></th>
                    <th style="border: none;width:25%"></th>
                    <th style="border: none;width:25%;text-align:right;color:red;" colspan= "6">All Amount in INR</th>
                </tr>
            </thead>
        </table>
        <div class="imgheader" style="margin-top:15px;">
            <?php echo $assessment_rows  ?>
            <?php echo $assessment_summary   ?>
        </div>
        <div class="imgheader">
            <p><u><b>Net Assessed Loss</b></u></p>
            <p>Based on details provided above, lowest liability under subject policy of insurance works out as above.
                The assessment of loss, as detailed above is subject to terms and conditions of the policy of insurance.</p>
        </div>

        <div class="imgheader">
            <p><b>For V.P. Singhal & Co. ISLA (P) Ltd.</b></p>
            <br>
            <br>
            <p><b>Surveyor & Loss Assessors</b></p>
        </div>

        <h2 class="table-title" style="margin-top: 2px;font-size:14px;page-break-before: always;text-align: center;">
        V.P. SINGHAL & CO.ISLA PVT. LTD.
      </h2>
      <table >
        <tr>
          <th style="width: 20%">Case Reference</th>
          <th style="width: 20%"><?php echo isset($essential_data['case_reference']) ? htmlspecialchars($essential_data['case_reference']) : ''; ?></th>
          <th style="width: 20%"></th>
          <th style="width: 20%">Date</th>
          <th colspan="5" style="width: 20%"><?php echo isset($essential_data['date_of_report']) ? htmlspecialchars($essential_data['date_of_report']) : ''; ?></th>
        </tr>
        <tr>
          <td style="width: 20%">Vehicle Number</td>
          <td style="width: 20%"><?php echo isset($essential_data['vehicle_number']) ? htmlspecialchars($essential_data['vehicle_number']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">Driver Name</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essential_data['name_of_driver']) ? htmlspecialchars($essential_data['name_of_driver']) : ''; ?></td>
        </tr>
        <tr>
          <td style="width: 20%">Policy Number</td>
          <td style="width: 20%"><?php echo isset($essential_data['policyNumber']) ? htmlspecialchars($essential_data['policyNumber']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">DL Number</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essential_data['driving_license_no']) ? htmlspecialchars($essential_data['driving_license_no']) : ''; ?></td>
        </tr>
        <tr>
          <td style="width: 20%">Date of Loss</td>
          <td style="width: 20%"><?php echo isset($essential_data['date_of_incident']) ? htmlspecialchars($essential_data['date_of_incident']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">Badge Number</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essential_data['badge_number']) ? htmlspecialchars($essential_data['badge_number']) : ''; ?></td>
        </tr>
        <tr>
          <td style="width: 20%">Place of Loss</td>
          <td style="width: 20%"><?php echo isset($essential_data['place_of_accident']) ? htmlspecialchars($essential_data['place_of_accident']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">RC/DL/Badge Verified</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essential_data['verification_from_rto']) ? htmlspecialchars($essential_data['verification_from_rto']) : ''; ?></td>
        </tr>


        <tr>
          <td style="width: 20%">Cause of Loss</td>
          <td colspan="8">
            <?php echo isset($essential_data['cause_loss']) ? htmlspecialchars($essential_data['cause_loss']) : ''; ?>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <th style="width: 20%;border-top:none;height: 20px;"></th>
  
        </tr>
      </table>
      <table>
        <tr>
          <th style="width: 20%;border-top:none">BUS NO</th>
          <th style="width: 20%;border-top:none"><?php echo isset($essential_data['vehicle_number']) ? htmlspecialchars($essential_data['vehicle_number']) : ''; ?></th>

          <th style="width: 20%;border-top:none"><?php echo isset($essential_data['policy_by']) ? htmlspecialchars($essential_data['policy_by']) : ''; ?></th>
          <th colspan="5" style="width: 20%;border-top:none">DEPOT</th>
          <th colspan="5" style="width: 20%;border-top:none"><?php echo isset($essential_data['depot']) ? htmlspecialchars($essential_data['depot']) : ''; ?></th>
        </tr>
      </table>
  
      <table>
        <tr>
          <th style="width: 20%;border-top:none" >CLAIM NO.</th>
          <th style="width: 20%;border-top:none"></th>

          <th style="width: 10%;border-top:none"></th>
          <th style="width: 10%;border-top:none"></th>
          <th colspan="5" style="width: 20%;border-top:none">AIR NO</th>
          <th colspan="5" style="width: 20%;border-top:none; text-align:center"><?php echo isset($essential_data['claim_no']) ? htmlspecialchars($essential_data['claim_no']) : ''; ?></th>
        </tr>
    </table>

         <div class="imgheader" style="margin-top:15px;">
            <?php echo $assessment_checklist    ?>
        </div>
    </div>

     <div class="flyleaf" style="page-break-before: always;">
      <h2 class="table-title" style="margin-top: 2px">
        CLAIM COMPUTATION FOR BUS <?php echo isset($essential_data['vehicle_number']) ? htmlspecialchars($essential_data['vehicle_number']) : ''; ?>
      </h2>
       <?php echo $assessment_computation;?>
    </div>
    

</body>

</html>