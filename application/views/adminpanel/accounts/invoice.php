<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre Inspection Report - Tax Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="http://fonts.cdnfonts.com/css/new-cicle" rel="stylesheet">
    <style>
        .responsive-table {
            width: 100%;
            overflow-x: auto;
        }
        body {
            padding: 0;
            margin: 0;
            font-family: Arial, sans-serif; 
        }
        .header {
            height: 50px;
            border-collapse: collapse;
            font-size: 11px;
            top:0;
        }
        footer {
            position: fixed;
            bottom: 0;
            left: 0px;
            right: 0px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            border: 1px solid #000;
            padding-left: 3px;
            font-size: 11px;
        }
        th {
            border: 1px solid #000;
            text-align: left;
            padding-left: 3px;
            font-weight: 400;
            font-size: 12px;
        }
        .table-title {
            background-color: #e3e3e3;
            margin-bottom: 0px;
            padding: 4px;
            border: 1px solid black;
            border-bottom: none;
            font-size: 12px;
            margin-top: 10px;
            text-align:center;
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
            margin: 0 ;
            padding: 0;
            display: contents;
        }
        .left-sequence{
            width: 5%; 
            text-align:center;
        }
        .key-heading{
            font-weight: bold;
            width: 30%;
        }
        .table-cell-heading{
            font-size:13px;
        }
        .table-cell{
            font-size:12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('assets/Letterhead_2023_New_jpg.png')); ?>" alt="Embedded Image" style="width: 710px;height:24%"> <!---keep the width 710px----->
        <h4 style="font-weight: 600; text-align: center; background-color:rgb(180, 171, 171);padding:5px;">TAX INVOICE</h4>
        <table>
            <tbody>               
                <tr> 
                    <th><b>Invoice No:</b> </th>
                    <td><b>D20240233</b></td>
                    <th><b>TI Date: </b></th>
                    <td><b>24/06/2024</b></td>
                </tr>
                <tr>
                    <th><b>Billed to:</b> </th>
                    <td><b>GSTN</b></td>
                    <th><b>Report Submitted to </b></th>
                    <td><b>Billing Id</b></td>
                </tr>
                <tr>
                    <th>The New India Assurance Company Ltd. </th>
                    <td>06AAACN4165C2LU</td>
                    <th>The New India Assurance Company Ltd.</th>
                    <td>1D14014037</td>
                </tr>
                <tr>
                    <th>NH-5-R/2,NIT Faridabad,Near Badshan Khan chawk , Faridabad - 121001 , Faridabad , Haryana</th>
                    <td></td>
                    <th>NH-5-R/2,NIT Faridabad,Near Badshan Khan chawk , Faridabad - 121001 , Faridabad , Haryana</th>
                    <td>I-342267</td>
                </tr>
                <tr>
                    <th><b>Our Reference</b></th>
                    <td colspan="3">VP/I/24/04/171</td>
                </tr>   
            </tbody>
        </table>
        <table style="margin-top:1px;">
            <tbody>
                <tr>
                    <th>Case Reference</th>
                    <td><b>Investigation / Cattle Death Item Surveyed:106234/470127</b></td>              
                </tr>
                <tr>
                    <th>Name of Insured</th>
                    <td>Mr. Jai Singh</td>
                </tr>
                <tr>
                    <th>Policy No.</th>
                    <td>3127004723270011193</td>
                </tr>
                <tr>
                    <th>Date of loss</th>
                    <td>25/04/2024</td>
                </tr>
                <tr>
                    <th>Claim No.</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:1px;">
            <tbody>
                <tr>
                    <th><b>Item  Head</b></th>
                    <th><b>Description</b></th>
                    <th><b>SAC</b></th>
                    <th><b>Rate(Rs.)</b></th>
                    <th><b>Qty</b></th>
                    <th><b>Amount(Rs.)</b></th>
                </tr>
                <tr>
                    <td>Survey Fee</td>
                    <td></td>
                    <td>997162</td>
                    <td>1500 / Per Day</td>
                    <td>1</td>
                    <td style="text-align:right">1500.00</td>
                </tr>
                <tr>
                    <td>Conveyance Local</td>
                    <td></td>
                    <td>997162</td>
                    <td>1000 / Per Day</td>
                    <td>1</td>
                    <td style="text-align:right">1000.00</td>
                </tr>
                <tr>
                    <td>Sub Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">2500.00</td>
                </tr>
                <tr>
                    <td>IGST</td>
                    <td>07AACCV8440J1Z2</td>
                    <td></td>
                    <td>@</td>
                    <td>18.00%</td>
                    <td style="text-align:right">450.00</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">2950.00</td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">2950.00</td>
                </tr>
                <tr>
                    <td colspan="6">RUPEES Two Thousand Nine Hundred and Fifty ONLY</td>
                </tr>
            </tbody>
        </table>
        <div style="border-box:box-sizing; border:1px solid black; margin-top:5px;">
            <p style="float:right;font-size:11px;">(Space for Rubber Stamp)</p>
            <table style="width:45%; margin:2px;" >
                <tbody>
                    <tr>
                        <th class="text-center"><b>Please Note as Under</b></th> 
                    </tr>
                    <tr>  
                        <th style="height:15px;"></th>
                    </tr>
                    <tr>
                        <th>Kindly make payment/cheque in the name of <hr style="margin:2px;border-color: black; width:80%;">  <b>VP Singhal & Company ISLA Pvt. Ltd</b> </th>
                    </tr>
                    <tr>
                        <th style="height:15px;"></th>
                    </tr>
                    <tr>
                        <th>A/c. No. 06512000002715, IFS Code : HDFC0000651, MICR No. 110240112</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <table style="margin-top:1px;">
            <tbody>
                <tr>
                    <td style="text-align:right;"><b>VP Singhal & Company ISLA Pvt. Ltd</b></td>
                </tr>
                <tr>
                    <td style="text-align:right;">Authorised Signatory</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>