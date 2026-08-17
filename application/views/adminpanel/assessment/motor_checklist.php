<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pre Inspection Report</title>
   
    <style>
      body {
        margin-top: -10px;
        margin-left: -25px;
        margin-right: -25px;
        margin-bottom: -5px;
        overflow: hidden;
      }

      .flyleaf {
        margin: 10px;
      }

      /* .page-break {
                        page-break-after: always;
                    } */

      .header {
        height: 50px;
        border-collapse: collapse;
        font-size: 8px;
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
        font-size: 8px;
        font-weight: 600;
        margin: 0px;
        padding: 0px;
      }

      .date {
        float: right;
        font-size: 8px;
        font-weight: 600;
        margin: 0px;
        padding: 0px;
      }

      .card-body {
        border: 1px solid black;
        padding: 0;
        margin-top: 10px;
      }

      .photographs > td {
        width: 50%;
      }

      td > img {
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
        font-size: 8px;
        padding: 5px;
        margin-top: 0px;
        padding-top: 0px;
      }

      .table-title {
       
        margin-bottom: 0px;
        padding: 2px;
        border: 1px solid black;
        border-bottom: none;
        text-align: center;
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
      th {
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
      .bold {
        font-weight: 600;
        font-size: 8px;
       
      }
    </style>
  </head>

  <body>
    <div class="flyleaf m-4">
      <h2 class="table-title" style="margin-top: 2px;font-size:10px;">
        V.P. SINGHAL & CO.ISLA PVT. LTD.
      </h2>
      <table>
        <tr>
          <th style="width: 20%">Case Reference</th>
          <th style="width: 20%"><?php echo isset($essentialData['case_reference']) ? htmlspecialchars($essentialData['case_reference']) : ''; ?></th>
          <th style="width: 20%"></th>
          <th style="width: 20%">Date</th>
          <th colspan="5" style="width: 20%"><?php echo isset($essentialData['date_of_report']) ? htmlspecialchars($essentialData['date_of_report']) : ''; ?></th>
        </tr>
        <tr>
          <td style="width: 20%">Vehicle Number</td>
          <td style="width: 20%"><?php echo isset($essentialData['vehicle_number']) ? htmlspecialchars($essentialData['vehicle_number']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">Driver Name</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essentialData['name_of_driver']) ? htmlspecialchars($essentialData['name_of_driver']) : ''; ?></td>
        </tr>
        <tr>
          <td style="width: 20%">Policy Number</td>
          <td style="width: 20%"><?php echo isset($essentialData['policyNumber']) ? htmlspecialchars($essentialData['policyNumber']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">DL Number</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essentialData['driving_license_no']) ? htmlspecialchars($essentialData['driving_license_no']) : ''; ?></td>
        </tr>
        <tr>
          <td style="width: 20%">Date of Loss</td>
          <td style="width: 20%"><?php echo isset($essentialData['date_of_incident']) ? htmlspecialchars($essentialData['date_of_incident']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">Badge Number</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essentialData['badge_number']) ? htmlspecialchars($essentialData['badge_number']) : ''; ?></td>
        </tr>
        <tr>
          <td style="width: 20%">Place of Loss</td>
          <td style="width: 20%"><?php echo isset($essentialData['place_of_accident']) ? htmlspecialchars($essentialData['place_of_accident']) : ''; ?></td>
          <td style="width: 20%"></td>
          <td style="width: 20%">RC/DL/Badge Verified</td>
          <td colspan="5" style="width: 20%"><?php echo isset($essentialData['verification_from_rto']) ? htmlspecialchars($essentialData['verification_from_rto']) : ''; ?></td>
        </tr>


        <tr>
          <td style="width: 20%">Cause of Loss</td>
          <td colspan="8">
            <?php echo isset($essentialData['cause_loss']) ? htmlspecialchars($essentialData['cause_loss']) : ''; ?>
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
          <th style="width: 20%;border-top:none"><?php echo isset($essentialData['driving_license_no']) ? htmlspecialchars($essentialData['driving_license_no']) : ''; ?></th>

          <th style="width: 20%;border-top:none"><?php echo isset($essentialData['policy_by']) ? htmlspecialchars($essentialData['policy_by']) : ''; ?></th>
          <th colspan="5" style="width: 20%;border-top:none">DEPOT</th>
          <th colspan="5" style="width: 20%;border-top:none">Naraina Delhi</th>
        </tr>
      </table>
  
      <table>
        <tr>
          <th style="width: 20%;border-top:none" >CLAIM NO.</th>
          <th style="width: 20%;border-top:none"></th>

          <th style="width: 10%;border-top:none"></th>
          <th style="width: 10%;border-top:none"></th>
          <th colspan="5" style="width: 20%;border-top:none">AIR NO</th>
          <th colspan="5" style="width: 20%;border-top:none; text-align:center"><?php echo isset($essentialData['claim_no']) ? htmlspecialchars($essentialData['claim_no']) : ''; ?></th>
        </tr>
        <tr>
          <th style="width: 20%">Particulars</th>
          <th style="width: 20%">Exprenses incurred</th>

          <th style="width: 10%">GrossAmount Considered by Insurance</th>
          <th style="width: 10%">Depreciation</th>
          <th colspan="5" style="width: 20%">Net Amount</th>
          <th colspan="5" style="width: 20%">
            Amount not considered by insurance
          </th>
        </tr>
        <tr>
          <td style="width: 20%">Material</td>
          <td style="width: 20% ; text-align:right ; text-align:right">18,252</td>

          <td style="width: 10% ; text-align:right">13,678</td>
          <td style="width: 10%; text-align:center">-</td>
          <td colspan="5" style="width: 20% ; text-align:right">13,678</td>
          <td colspan="5" style="width: 20% ; text-align:right">4,574</td>
        </tr>
      
        <tr>
          <td style="width: 20% ">Labour</td>
          <td style="width: 20% ; text-align:right">7,816</td>

          <td style="width: 10% ; text-align:right">4,416</td>
          <td style="width: 10% ; text-align:center">-</td>
          <td colspan="5" style="width: 20% ; text-align:right">4,416</td>
          <td colspan="5" style="width: 20% ; text-align:right">3,400</td>
        </tr>
        <tr>
          <td style="width: 20%">Less</td>
          <td style="width: 20%"></td>

          <td style="width: 10%"></td>
          <td style="width: 10% ; text-align:center">-</td>
          <td colspan="5" style="width: 20%"></td>
          <td colspan="5" style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 20%">Salavage</td>
          <td style="width: 20%"></td>

          <td style="width: 10%"></td>
          <td style="width: 10%"></td>
          <td colspan="5" style="width: 20% ; text-align:right">(4)</td>
          <td colspan="5" style="width: 20%"></td>
        </tr>

        <tr>
          <td style="width: 20%">Policy excess</td>
          <td style="width: 20%"></td>

          <td style="width: 10%"></td>
          <td style="width: 10%"></td>
          <td colspan="5" style="width: 20%; text-align:right">(1500)</td>
          <td colspan="5" style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 20%">Net Amount to be received</td>
          <td style="width: 20%"></td>

          <td style="width: 10%"></td>
          <td style="width: 10%"></td>
          <td colspan="5" style="width: 20%"></td>
          <td colspan="5" style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 20%">Total</td>
          <td style="width: 20%; text-align:right">26,069</td>
          <td style="width: 10%; text-align:right">18,094</td>
          <td style="width: 10%"></td>
          <td colspan="5" style="width: 20%; text-align:right">16,590</td>
          <td colspan="5" style="width: 20%"></td>
        </tr>
      </table>
    </div>
  </body>
</html>
