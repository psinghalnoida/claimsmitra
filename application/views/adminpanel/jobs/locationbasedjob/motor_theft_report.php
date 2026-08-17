<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Death Format</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
             font-family: 'New Cicle', sans-serif;
        }
        footer {
            position: fixed;
            bottom: 10px;
            left: 40px;
            right: 35px;
        }

        .container img {
            max-width: 100%;
        }

        .report-header {
            height: 20px;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 0px;
            padding-top: 0px;
        }

        .reprtNumber {
            float: left;
            font-size: 15px;
            font-weight: 600;
            margin-top: 0px;
        }

        .report-date {
            float: right;
            font-size: 15px;
            font-weight: 600;
            margin-top: 0px;

        }

        body {
            font-family: 'New Cicle', sans-serif;
            margin-top: -30px;
            margin-left: -15px;
            margin-right: -15px;
            margin-bottom: -20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid black;

        }

        .subheader {
            display: flex;
            justify-content: space-between;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            font-size: 14px;
            text-align: left;
            padding-left: 8px;
            font-weight: 400;
        }

        .table-title {
            background-color: #e3e3e3;
            margin-bottom: 0px;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 14px;
        }

        p {
            font-size: 16px;
            margin: 0px;
        }

        .table-title {
            background-color: #e3e3e3;
            margin-bottom: 0px;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 760px;">

        <div class="report-header">
            <p class="reprtNumber">Case Reference <?php echo $essentialData['case_reference']; ?></p>
            <p class="report-date">Date:<?php echo $essentialData['date_of_report']; ?></p>
        </div>


        <div class="mt-4" style="width: 100%;">
            <div style="float: left; width: 50%;">
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
            <div style="float:left;width: 48%;text-align: right;">
                <span><?php echo $username; ?></span>
            </div>
            <div style="color:red;text-align: right; font-size:10px;">
                <span>For Photos Scan Here</span>
            </div>
            <div style="text-align: right;">
                <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" style="width:100px; height:100px;">
            </div>
            <div style="text-align: right;padding-right:20px">
                <span style="font-size:10px;"><a style="padding-left:30%; maring-top:20px;" href="<?php echo base_url('downloadmedia/' . $essentialData['aid'] . ''); ?>" alt="download report">Download</a></span>
                <span style="font-size:10px;"><a style="maring-top:20px;" href="<?php echo base_url('viewmedia/' . $essentialData['aid'] . ''); ?>" alt="download report" target="_blank">View</a></span>
            </div>
        </div>
        <div class="head" style="text-align: center; width:100%;">
            <h3 style="font-weight: 500;margin:0px; margin-bottom:2px;">Motor Theft / Snatching Claim
                Investigation Report</h3>
        </div>
        <table class="mt-2">
            <tbody>
                <tr style="background-color: #c7c6c6;">
                    <th class="text-center;" style="width: 53.1%;">A. POLICY PARTICULARS</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Insured </th>
                    <th><?php echo $caseData['insured_name'] ?></th>
                </tr>
                <tr>
                    <th>Claim No. : </th>
                    <th><?php echo $caseData['claim_number'] ?></th>
                </tr>
                <tr>
                    <th>Endorsement details, if any :</th>
                    <th><?php echo $caseData['endorsement_details'] ?></th>
                </tr>
                <tr>
                    <th>Break-in Insurance details, if any</th>
                    <th><?php echo $caseData['break_in_insurance'] ?></th>
                </tr>
                <tr>
                    <th>Pre-Inspection details, if any</th>
                    <th><?php echo $caseData['pre_inspection_details'] ?></th>
                </tr>

                <tr style="background-color: #c7c6c6;">
                    <th class="text-center;" style="width: 50%;">B. VEHICLE PARTICULARS</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Chassis No. :</th>
                    <th><?php echo $caseData['chasis_number'] ?></th>
                </tr>
                <tr>
                    <th>Engine No. :</th>
                    <th><?php echo $caseData['engine_number'] ?></th>
                </tr>
                <tr>
                    <th>Make/Model :</th>
                    <th><?php echo $caseData['make_modal'] ?></th>
                </tr>
                <tr>
                    <th>Year of Manufacture :</th>
                    <th><?php echo $caseData['year_of_manufacture'] ?></th>
                </tr>
                <tr>
                    <th>Colour :</th>
                    <th><?php echo $caseData['colour'] ?></th>
                </tr>
                <tr>
                    <th>Seating Capacity / GVW :</th>
                    <th><?php echo $caseData['seatig_capacity'] ?></th>
                </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <th rowspan="2" style="width: 10%;">Tax</th>
                <th style="width: 42.7%;">Paid up to :</th>
                <th><?php echo $caseData['tax_paid_up_to'] ?></th>
            </tr>
            <tr>
                <th>Whether paid up to the date of loss? (Y/N)</th>
                <th><?php echo $caseData['date_of_loss'] ?></th>
            </tr>
            <tr>
                <th rowspan="2" style="width: 10%;">Fitness Certificate</th>
                <th>Validity :</th>
                <th><?php echo $caseData['validity'] ?></th>
            </tr>
            <tr>
                <th>Whether Fitness is valid on the date of loss? (Y/N)</th>
                <th><?php echo $caseData['fitness_date'] ?></th>
            </tr>
        </table>

        <table>
            <tr>
                <th class="text-center;" style="width: 53.1%;border-top: 0px;">Details of all Transfer of ownerships, if any, from the
                    date of first purchase/ registration :</th>
                <th><?php echo $caseData['details_of_ownership'] ?></th>
            </tr>
            <tr>
                <th>Hypothecation details, if any :</th>
                <th><?php echo $caseData['hypothecation_details'] ?></th>
            </tr>
            <tr>
                <th>RC Issuing Authority :</th>
                <th><?php echo $caseData['rc_issuing_authority'] ?></th>
            </tr>
        </table>

        <table>
            <tr>
                <th rowspan="2" style="width: 7%;">Permit</th>
                <th rowspan="2" style="width: 7%;">Details :</th>
                <th style="width: 12%;">No.</th>
                <th style="width: 12%;">Date of issue</th>
                <th style="width: 15%;">Period of validity</th>
                <th style="width: 10%;">Type</th>
                <th style="width: 15%;">Area</th>
            </tr>
            <tr>
                <th style="height: 25px;"><?php echo $caseData['permit_number'] ?></th>
                <th><?php echo $caseData['permit_date_of_issue'] ?></th>
                <th><?php echo $caseData['permit_period_of_validity'] ?></th>
                <th><?php echo $caseData['permit_type'] ?></th>
                <th><?php echo $caseData['permit_area'] ?></th>
            </tr>

        </table>
        <table>
            <tr>
                <!-- <th style="width: 10%;"></th> -->
                <th style="width: 70%;">Whether place of loss falls within the Permitted area? (Y/N)</th>
                <th><?php echo $caseData['permit_whether'] ?></th>
            </tr>
            <tr>
                <!-- <th style="width: 10%;"></th> -->
                <th>Whether the vehicle was used for the purpose, as stated in the Permit? (Y/N)</th>
                <th><?php echo $caseData['whether_the_vehicle'] ?></th>
            </tr>
        </table>
        <table>
            <tr>
                <th rowspan="2" style="width: 13%;">Permit Authorization :</th>
                <th style="width: 10%;">No.</th>
                <th style="width: 15%;">Date of issue</th>
                <th style="width: 15%;">Period of validity</th>
                <th style="width: 10%;">Area</th>
            </tr>
            <tr>
                <th style="height: 25px;"><?php echo $caseData['permit_authorization_number'] ?></th>
                <th><?php echo $caseData['permit_authorization_date_of_issue'] ?></th>
                <th><?php echo $caseData['permit_authorization_period_of_validity'] ?></th>
                <th><?php echo $caseData['permit_authorization_area'] ?></th>
            </tr>
        </table>


        <table>
            <tr>
                <th rowspan="3" style="width: 10%;">Comments: </th>
                <th style="width: 70%;">Whether Registered Owner and Insured’s name are the same? (Y/N)
                    In case of any discrepancy, explanation to be provided.
                </th>
                <th><?php echo $caseData['whether_registered_owner'] ?></th>
            </tr>
            <tr>
                <th>Whether Engine & Chassis No’s in RC, Policy & Purchase Invoice are the same? (Y/N)
                    In case of any difference, clarification to be obtained from the insured.
                </th>
                <th><?php echo $caseData['engine_and_chasis_number'] ?></th>
            </tr>
            <tr>
                <th>Whether theft details are endorsed in the RC / RTO records? (Y/N)
                </th>
                <th><?php echo $caseData['Whether_theft_details'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">C. DETAILS OF LAST USER OF VEHICLE
                    (BEFORE THEFT)</th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Name of Last user of vehicle :</th>
                <th><?php echo $caseData['last_vehicle_user'] ?></th>
            </tr>
            <tr>
                <th>Relation with insured :</th>
                <th><?php echo $caseData['relationship_with_insured'] ?></th>
            </tr>
            <tr>
                <th>Occupation :</th>
                <th><?php echo $caseData['occupation'] ?></th>
            </tr>
            <tr>
                <th>Address :</th>
                <th><?php echo $caseData['address'] ?></th>
            </tr>
        </table>
        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;">D. FINANCIER’S DETAILS</th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Financing Type – Lease/ HPA etc. :</th>
                <th><?php echo $caseData['financing_type'] ?></th>
            </tr>
            <tr>
                <th>Type of loan advanced – Pvt. or Commercial :</th>
                <th><?php echo $caseData['type_of_loan_advanced'] ?></th>
            </tr>
            <tr>
                <th>Details of Loan Repayment (latest) : </th>
                <th><?php echo $caseData['details_of_Loan_repayment'] ?></th>
            </tr>
            <tr>
                <th>Outstanding Amount :</th>
                <th><?php echo $caseData['outstanding_amount'] ?></th>
            </tr>
            <tr>
                <th>Whether vehicle was seized?</th>
                <th><?php echo $caseData['vehicle_was_seized'] ?></th>
            </tr>
            <tr>
                <th>Whether original key(s) retained by financier?</th>
                <th><?php echo $caseData['original_key'] ?></th>
            </tr>
            <tr>
                <th>NOC status (Y/N)</th>
                <th><?php echo $caseData['noc_status'] ?></th>
            </tr>

        </table>
        <table>
            <tr>
                <th style="width: 10%;border-top: 0;">Comments </th>
                <th style="width: 43.1%;border-top: 0;">Any irregularity noticed in loan repayment?</th>
                <th style="border-top: 0;"><?php echo $caseData['any_irregulaity_noticed'] ?></th>
            </tr>
        </table>


        <table>
            <tr style="background-color: #c7c6c6;border-top: 0;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;">E. DRIVER DETAILS</th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Name of driver :</th>
                <th><?php echo $caseData['name_of_driver'] ?></th>
            </tr>
            <tr>
                <th>Driving License Details with all previous DL particulars :</th>
                <th><?php echo $caseData['driving_license_details'] ?></th>
            </tr>
            <tr>
                <th>Date of Issue : </th>
                <th><?php echo $caseData['date_of_issue'] ?></th>
            </tr>
            <tr>
                <th>Valid up to :</th>
                <th><?php echo $caseData['valid_up_to'] ?></th>
            </tr>
            <tr>
                <th>Type of vehicles authorized to drive :</th>
                <th><?php echo $caseData['type_of_vehicle'] ?></th>
            </tr>
            <tr>
                <th>Issuing Authority :</th>
                <th><?php echo $caseData['issue_authority'] ?></th>
            </tr>
            <tr>
                <th>Verification Status :</th>
                <th><?php echo $caseData['verification_status'] ?></th>
            </tr>

        </table>
        <table>
            <tr>
                <th style="width: 10%;">Comments </th>
                <th style="width: 70%;">Check if the driver/last user mentioned in the claim form/ intimation is the
                    same as that mentioned in the FIR. In case of any discrepancy, clarification </th>
                <th><?php echo $caseData['last_user_mentioned'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;"> F. INCIDENT DETAILS</th>
                <th style="border-top: 0;"></th>
            </tr>

            <tr>
                <th>Details of location from where the vehicle was stolen / snatched :</th>
                <th><?php echo $caseData['details_of_location'] ?></th>
            </tr>
        </table>
        <table>
            <tr>
                <th rowspan="2" style="width: 10%;border-top: 0;">Date & time of intimation of loss to </th>
                <th style="width: 43.1%;border-top: 0;">Insured by the driver/ last user : </th>
                <th style="border-top: 0;"><?php echo $caseData['date_intimation'] ?> <?php echo $caseData['time_intimation'] ?></th>
            </tr>
            <tr>
                <th>Police by the complainant :</th>
                <th><?php echo $caseData['by_the_complainant'] ?> <?php echo $caseData['time_by_the_complainant'] ?></th>

            </tr>
        </table>

        <table>
            <tr>
                <th style="width: 55%;">Brief narration of Incident as per police Investigation :</th>
                <th><?php echo $caseData['narration_of_incident'] ?></th>
            </tr>

        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;"> G. ENVIRONMENTAL </th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Police Station and other Independent Checks :</th>
                <th><?php echo $caseData['police_station'] ?></th>
            </tr>
            <tr>
                <th>Verification from Insured/ Driver/ last user :</th>
                <th><?php echo $caseData['verification_from_insured'] ?></th>
            </tr>
            <tr>
                <th>Verification at spot along with photographs : </th>
                <th><?php echo $caseData['Verification_at_spot'] ?></th>
            </tr>
            <tr>
                <th>In case of loaded commercial vehicles, verification of Marine policy details with claim status/Goods
                    Receipts from Transporter/Invoice from the consignor :</th>
                <th><?php echo $caseData['loaded_commercial_vehicles'] ?></th>
            </tr>
        </table>


        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">H. POSSESSION OF KEYS AND LOCKING SYSTEM
                </th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Type of Locking System :</th>
                <th><?php echo $caseData['locking_system'] ?></th>
            </tr>
            <tr>
                <th>Possession of keys : </th>
                <th><?php echo $caseData['possession_of_keys'] ?></th>
            </tr>
            <tr>
                <th>No. of keys :</th>
                <th><?php echo $caseData['no_of_keys'] ?></th>
            </tr>
            <tr>
                <th>Whether submitted by the insured to insurer? (Y/N)</th>
                <th><?php echo $caseData['submitted_by_the_insured_to_insurer'] ?></th>
            </tr>
            <tr>
                <th>If not submitted, whether collected from insured? (Y/N)</th>
                <th><?php echo $caseData['collected_from_insurer'] ?></th>
            </tr>
            <tr>
                <th>Comments on any irregularity noted :</th>
                <th><?php echo $caseData['irregularity_noted'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">I. VERIFICATION OF POLICE RECORDS</th>
                <th></th>
            </tr>

            <tr>
                <th>IPC Sections mentioned in the FIR:</th>
                <th><?php echo $caseData['ipc_section'] ?></th>
            </tr>
            <tr>
                <th>Name of Investigating Officer :</th>
                <th><?php echo $caseData['investigation_officer'] ?></th>
            </tr>
            <tr>
                <th>FIR Lodged by :</th>
                <th><?php echo $caseData['fir_lodged'] ?></th>
            </tr>
            <tr>
                <th>Property Involved :</th>
                <th><?php echo $caseData['property_involved'] ?></th>
            </tr>
            <tr>
                <th>Police Final Report (FR) No. & Date :</th>
                <th><?php echo $caseData['police_final_report'] ?></th>
            </tr>

            <tr>
                <th>In case of change in section(s) vis-à-vis the FIR, reasons to be provided :</th>
                <th><?php echo $caseData['vis_a_vis'] ?></th>
            </tr>
            <tr>
                <th>Whether FR accepted by Court (Y/N) & Date of acceptance; OR
                    the Court has taken cognizance of the charge-sheet with brief details of Order passed and date:
                </th>
                <th><?php echo $caseData['whether_fr_accepted'] ?></th>
            </tr>
            <tr>
                <th>Comments on any irregularity noted :</th>
                <th><?php echo $caseData['comments_on_any_irregularity'] ?></th>
            </tr>
        </table>


        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;">J. IN CASE OF DELAYED FIR</th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>PCR 100 no. report details :</th>
                <th><?php echo $caseData['pcr_100_report_details'] ?></th>
            </tr>
            <tr>
                <th>GD Entry details :</th>
                <th><?php echo $caseData['gd_entry_details'] ?></th>
            </tr>
            <tr>
                <th>Details of wireless messaged flashed by Police :</th>
                <th><?php echo $caseData['details_of_wireless'] ?></th>
            </tr>
            <tr>
                <th>Other details, if any :</th>
                <th><?php echo $caseData['other_details'] ?></th>
            </tr>

        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">K. NCRB STATUS</th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Whether intimated to NCRB : (Y/N)</th>
                <th><?php echo $caseData['intimated_ncrb'] ?></th>
            </tr>
            <tr>
                <th>If yes, details with proof of intimation (postal receipt/postal order to be collected) :</th>
                <th><?php echo $caseData['details_with_proof_of_intimation'] ?></th>
            </tr>
            <tr>
                <th>Status of the vehicle as per report & date :
                    (copy of report to be provided)</th>
                <th><?php echo $caseData['status_of_vehicle'] ?></th>
            </tr>
        </table>
        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;">L. OTHER DETAILS</th>
                <th style="border-top: 0;"></th>
            </tr>
            <!-- <tr>
                <th>If all vehicular documents are verified from the RTO/Govt. website (Y/N) :</th>
                <th></th>
            </tr>
            <tr>
                <th>Documents verified :</th>
                <th></th>
            </tr> -->
            <tr>
                <th>Whether intimated to RTO (Y/N) :
                    (Proof of intimation along with RTO acknowledgement to be collected)
                </th>

                <th><?php echo $caseData['intimated_to_rto'] ?></th>
            </tr>
            <tr>
                <th>Proof of Existence of Vehicle before theft to be collected :
                    (e.g. servicing records of vehicle/ petrol pump bills, records in toll booths, consignment delivered before loss, load challan, statements of people who had last seen the vehicle just before theft)
                </th>
                <th><?php echo $caseData['proof_of_existence'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;border-top: 0;"> M. DELAY ASPECTS</th>
                <th style="border-top: 0;"></th>
            </tr>
            <tr>
                <th>Date of Theft :</th>
                <th><?php echo $caseData['date_of_theft'] ?></th>
            </tr>
            <tr>
                <th>Date of FIR/ intimation to Police and delay, if any : </th>
                <th><?php echo $caseData['fir_date'] ?></th>
            </tr>
            <tr>
                <th>Date of Intimation to Insurer and delay, if any :</th>
                <th><?php echo $caseData['intimation_date'] ?></th>
            </tr>
            <tr>
                <th>Comments (on the aspect of delay in intimating the Police & Insurer) :</th>
                <th><?php echo $caseData['comments'] ?></th>
            </tr>
        </table>
        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">N. VIOLATION ASPECTS</th>
            </tr>
            <tr>
                <th style="height: 50px;"><?php echo $caseData['violation_aspects'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">O. REFERENCES
                    (Reference to NCDRC/SC judgements in relation to the current claim may be made)
                </th>
            </tr>
            <tr>
                <th style="height: 50px;"><?php echo $caseData['references'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">P. CASE SUMMARY
                </th>
            </tr>
            <tr>
                <th><?php echo $caseData['case_summary'] ?></th>
            </tr>
        </table>

        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">Q. CONCLUSION
                    (Reference to NCDRC/SC judgements in relation to the current claim may be made)
                </th>
            </tr>
            <tr>
                <th>
                    <?php echo $caseData['conclusion'] ?>
                </th>
            </tr>
        </table>


        <table>
            <tr style="background-color: #c7c6c6;">
                <th class="text-center;" style="width: 53.1%;">R. ANNEXURES
                    (Reference to NCDRC/SC judgements in relation to the current claim may be made)
                </th>
            </tr>
            <tr>
                <th style="height: 50px;"><?php echo $caseData['annexures'] ?></th>
            </tr>
        </table>
         <h6 class="table-title" style="margin-top:10px;">I. Photographs</h6>
          <table class="tablesaw table-striped table-bordered table-hover photographs">
            <?php $index = 0; ?>
            <?php foreach ($images as $img) { ?>
                <?php if ($index % 2 == 0) : ?>
                    <tr>
                    <?php endif; ?>
                    <td style="width:50%;">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents('uploads/' .  $aid . '/images/' . $img)); ?>" style="width:100%; max-height:240px;" alt="Image <?php echo $index + 1; ?>">
                    </td>
                    <?php if ($index % 2 != 0 || $index == count($images) - 1) : ?>
                    </tr>
                <?php endif; ?>
                <?php $index++; ?>
            <?php } ?> 
        </table>
        <h5 style="margin-top: 20px;">For Pragati Risk & Management Partners</h5><br>
        <h5>(Investigators) </h5>   
    </div>
</body>
</html>