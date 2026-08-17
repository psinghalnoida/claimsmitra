<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container" >
<div class="tab-content">
    <div class="tab-pane fade show active" id="tab10">
        <!-- <?php $this->load->view('adminpanel/jobs/locationbasedjob/heading');?> -->
        <section class="main--content" style="min-height: 100vh;padding-top: 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel" style="margin-top:15px;">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="ti_request" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Assignment ID</th>
                                                    <th>Nature of Assignment / Case Handler</th>
                                                    <th>Billing To</th> 
                                                    <th>Billing Amount</th>
                                                    <th>TI Number / TI Date</th>
                                                    <th>Status</th>
                                                    <th class="not-sortable">Actions</th>
                                                </tr>
                                            </thead>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- <div id="vCenteredModal" class="modal fade" style="background-color:#00000091">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generate_ti"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="submitti"  method="post">
                    <input type="hidden" id="aid" name="aid" class="form-control" multiple='multiple'>
                    <div class="form-group row">
                        <span class="label-text col-lg-3 col-form-label">Tax Invoice Number<span style="color:red">*</span></span>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="text" id="ti_number" name="ti_number" class="form-control" multiple='multiple'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-3 col-form-label">Tax Invoice Date<span style="color:red">*</span></span>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="text" id="ti_datetime" name="ti_datetime" class="form-control" multiple='multiple'>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-success" id="submitButton">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<div id="submit_ti" class="modal fade" style="background-color:#00000091">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generate_ti"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body pt-0">
                <input type="hidden" id="aid" name="aid">
                <table class="table table-bordered billdata">
                    <tbody>
                        <tr>
                            <td><b>Bill To: </b>
                                <span id="billing_payment_by"></span><span id="billing_branch_name"></span><br>
                                <b>Billing GST</b>:<span id="billing_gst"></span><br>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered details">
                    <tbody>
                        <tr><th>Subject Matter</th><td><p id="natureofjob"></p></td></tr>
                        <tr><th>Name of Insured</th><td><p id="insured_name"></p></td></tr>
                        <tr><th>Date of Loss</th><td><p id="loss_data"></p></td></tr>
                        <tr><th>Policy Number</th><td><p id="policyNumber"></p></td></tr>
                        <tr><th>Claim Number</th><td><p id="insured_name"></p></td></tr>
                        <tr><th>Date of Survey</th><td><p id="survey_date"></p></td></tr>
                        <tr><th>Invoice Number</th><td><p id="invoicenumber"></p></td></tr>
                        <tr><th>Invoice Date</th><td><p id="invoicedate"></p></td></tr>
                        <tr><th>Billing ID</th><td><p id="billing_id"></p></td></tr>
                    </tbody>
                </table>
            
                <table class="table table-bordered details">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Rate (Rs.)</th>
                            <th>Qty</th>
                            <th>Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody id="invoice-table-body"> 
                    </tbody>
                </table> 
                <h5 id="invoice-additional-table-header"></h5> 
                <table class="table table-bordered details">
                    <tbody id="invoice-additional-table-body"></tbody>
                </table>

                <table class="table table-bordered details">
                    <thead>
                        <tr>
                            <th>Sub Total</th>
                            <th>IGST</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>Total</th>
                            <th>Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><p id="sub_total"></p></td>
                            <td><p id="igst_percentage"></p></td>
                            <td><p id="cgst_percentage"></p></td>
                            <td><p id="sgst_percentage"></p></td>
                            <td><p id="total"></p></td>
                            <td><p id="grandtotal"></p></td>
                        </tr>
                        <tr id="gst-row">
                            <th>GST Number:</th>
                            <td colspan="4">
                                <select id="gst_select" class="form-control">
                                    <option id="gst_number" value="">Select GST Number</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <form id="submitti"  method="post">
                    <input type="hidden" id="aid" name="aid" class="form-control" multiple='multiple'>
                    <input type="hidden" id="hidden_gst_data" name="gst_data">

                    <div class="form-group row">
                        <span class="label-text col-lg-3 col-form-label">Tax Invoice Number<span style="color:red">*</span></span>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="text" id="ti_number" name="ti_number" class="form-control" placeholder="Enter Tax Invoice Number" multiple='multiple'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-lg-3 col-form-label">Tax Invoice Date<span style="color:red">*</span></span>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="date" id="ti_datetime" name="ti_datetime" class="form-control" multiple='multiple'>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-success" id="submitButton">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>


<div id="add_receipt" class="modal fade" style="background-color:#00000091">
    <div class="modal-dialog" style="max-width:1200px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addpayment"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color:#ebebea; padding:0px 15px;">
                <section class="main--content">
                    <div class="row gutter-20">
                        <div class="col-xl-12 col-md-6">
                            <div class="panel" style="margin-top:15px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Received Payment
                                    </h3> 
                                </div>
                                <div class="panel-content" id="received_payment">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Tax Invoice
                                    </h3> 
                                </div>
                                <div class="panel-content" id="tax_invoice">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Add Payment
                                    </h3> 
                                </div>
                                <div class="panel-content">
                                    <form id="addPaymentForm" method="post">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Payment Mode</span>
                                                <select name="payment_mode" class="form-control">
                                                    <option value="">Select Payment Mode</option>
                                                    <option value="cheque">Cheque</option>
                                                    <option value="neft">NEFT/ RTGS</option>
                                                    <option value="dd">Demand Draft</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Reference Number</span>
                                                <input type="text" name="reference_number" placeholder="UTR number / Any reference number" class="form-control">
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Amount</span>
                                                <input type="text" name="amount" id="amount" placeholder="Amount" class="form-control">
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Date</span>
                                                <input type="date" name="payment_date" placeholder="Payment Date" class="form-control">
                                            </label>
                                        </div>

                                        <div class="form-group pt-1 pb-1">
                                            <label class="form-check">
                                                <input type="checkbox" name="final_payment" value="1" class="form-check-input">
                                                <span class="form-check-label">Is this final payment ?</span>
                                            </label>

                                            <label class="form-check">
                                                <input type="checkbox" name="tds_deduct" value="1" class="form-check-input">
                                                <span class="form-check-label">TDS Deduct</span>
                                            </label>
                                        </div>

                                        <input type="submit" value="Add Payment" id="add_payment" class="btn btn-sm btn-rounded btn-success">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> 
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('adminpanel/layout/footer');?>
<script>
    tirequest = $('#ti_request').DataTable({
        "serverSide": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        language: {
            searchPlaceholder: "Search Tax Invoice Request"
        },
        order: [],
        "ajax": {
            url: "<?php echo base_url('taxinvoicerequest'); ?>",
            type: "POST",
            dataType: "JSON",
            data: function (d) {
                d.company = companyid;
                d.department = departmentid;
                d.user_role = user_role;
            }
        }
    });


    function add_receipt(aid) {
        $('#aid').val(aid);
        
        $.ajax({
            url: "<?php echo base_url('taxinvoice'); ?>", 
            type: 'POST',
            data: {'aid':aid}, 
            dataType: 'json',
            success: function (response) {
                var text = "Add Receipt (<span id='caseid'>" + aid + "</span>)";
                $('#addpayment').html(text);
                
                var receivedPayment = '';
                $("#received_payment").html("");
                receivedPayment += '';
                $("#received_payment").append(receivedPayment);

                var invoice = '';
                $("#tax_invoice").html("");
                invoice += '<table class="table table-bordered billdata">'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td><b>Bill To: </b>'+
                                            '<span id="billing_payment_by">'+(response.data.billing_data.bill_to.billing_payment_by)+'</span><br><b>Billing Address: </b><span id="billing_branch_name">'+(response.data.billing_data.bill_to.billing_branch_name)+'</span><br>'+
                                            '<b>Billing GST</b>: <span id="billing_gst">'+(response.data.billing_data.bill_to.billing_gst)+'</span><br>'+
                                        '</td>'+
                                        
                                    '</tr>'+
                                '</tbody>'+
                            '</table>'+
                            '<table class="table table-bordered details">' +
                                '<tbody>' +
                                    '<tr>' +
                                        '<th>Billing Amount</th>';
                                            invoice += '<td>' + (response.data.billing_data.sub_total 
                                                                ? new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.data.billing_data.sub_total) 
                                                                : '₹0.00') + '</td>';
                                            var taxamount = parseFloat(response.data.billing_data.total) - parseFloat(response.data.billing_data.sub_total);
                                            invoice += '</tr>' +
                                                '<tr>' +
                                                    '<th>Tax Amount</th>';
                                            invoice += '<td>' + (taxamount 
                                                                ? new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(taxamount) 
                                                                : '₹0.00') + '</td>';
                                            invoice += '</tr>' +
                                                '<tr>' +
                                                    '<th>Total Amount</th>';
                                            invoice += '<td>' + (response.data.billing_data.total 
                                                                ? new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.data.billing_data.total) 
                                                                : '₹0.00') + '</td>';

                                            invoice += '</tr>' +
                                                '<tr>' +
                                                    '<th>Additional Expenses</th>';
                                            invoice += '<td>' + (response.data.billing_data.additional_expenses 
                                                                ? new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.data.billing_data.additional_expenses) 
                                                                : '₹0.00') + '</td>';
                                            invoice += '</tr>' +
                                                '<tr>' +
                                                    '<th>Total Amount</th>';
                                            invoice += '<td>' + (response.data.billing_data.grandtotal 
                                                                ? new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.data.billing_data.grandtotal) 
                                                                : '₹0.00') + '</td>';
                                            invoice += '</tr>' +
                                                '</tbody>' +
                                                '</table>';
                    $("#tax_invoice").append(invoice);
                $('#add_receipt').modal('show');
            },
            error: function () {
                alert('An error occurred while submitting the form.');
            }
        });
    }

    

    $("#addPaymentForm").submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        let formData = $("#addPaymentForm").serializeArray();
        let aid = $('#caseid').text();
        formData.push({ name: "aid", value: aid });
        if(aid != "" || aid != null){
            $.ajax({
                url: "<?php echo base_url('addpayment') ?>", // Change to your controller
                type: "POST",
                data: $.param(formData), // Serialize form data
                dataType: "json",
                beforeSend: function() {
                    $("#add_payment").prop("disabled", true).val("Processing...");
                },
                success: function(response) {
                    $("#add_payment").prop("disabled", false).val("Add Payment");

                    if (response.status === "error") {
                        $.each(response.errors, function(field, message) {
                            console.log(field);
                            $("[name='" + field + "']").after("<span class='error-message text-danger'>" + message + "</span>");
                        });
                    } else if (response.status === "success") {
                        alert("Payment added successfully!");
                        $("#addPaymentForm")[0].reset(); // Reset form after success
                    }
                },
                error: function(xhr, status, error) {
                    $("#add_payment").prop("disabled", false).val("Add Payment");
                    alert("Something went wrong! Please try again.");
                }
            });
        }else{
            alert("Something wrong!");
        }
    });


    // $(document).on('click', '.generateti', function() {
    //     // Get the value from the button's data attribute
    //     var value = $(this).data('value');
    //     console.log(value);
        
    //     // Update the modal content
    //     var text = "Generate Tax Invoice Number (" + value + ")";
    //     $('#aid').val(value);
    //     $('#generate_ti').text(text);
    // });

    // $(document).ready(function () {
    //     $('#submitButton').on('click', function (e) {
    //         e.preventDefault(); // Prevent the default form submission

    //         // Gather form data
    //         var formData = $('#submitti').serialize();

    //         // AJAX request
    //         $.ajax({
    //             url: 'savetinumber', // Update with your CodeIgniter URL
    //             type: 'POST',
    //             data: formData,
    //             dataType: 'json',
    //             success: function (response) {
    //                 if (response.status == 'success') {
    //                     alert('Form submitted successfully!');
    //                     $('#submitti')[0].reset(); // Reset the form
    //                 } else {
    //                     alert('Error: ' + response.message);
    //                 }
    //             },
    //             error: function () {
    //                 alert('An error occurred while submitting the form.');
    //             }
    //         });
    //     });
    // });

    /* ------------------------------------------------------------------------- *
     * Getting GST Number dynamically (By Nandini)
     * ------------------------------------------------------------------------- */

    var defaultCompany = "<?php echo $defaultcompany; ?>";
    var selectedBranchId = "<?php echo $billing_data['branchid'] ?? ''; ?>";

    $.ajax({
        url: '<?php echo base_url("billing/get_gstnumber"); ?>',
        method: 'GET',
        data: {
            companyId: defaultCompany
        },
        success: function(response) {
            // console.log(response);
            if (typeof response === 'string') {
                response = JSON.parse(response);
            }
            if (response && response.gstnumbers) {
                var gstSelect = $("#gst_select");
                gstSelect.empty();  
                response.gstnumbers.forEach(function(item) {
                    var selectedAttr = (item.id == selectedBranchId) ? 'selected' : ''; 
                    gstSelect.append('<option value="' + item.id + '" ' + selectedAttr + ' style="font-size:14px;">' + item.gst + '</option>');
                });
            }

        },
        error: function(xhr, status, error) {
            console.error("Error fetching GST numbers:", error);
        }
    });

    function submit_ti(aid) {
        // console.log("Aid from submit button:", aid);
        $('#aid').val(aid);
        $.ajax({
            url: "<?php echo base_url('receivable_invoice'); ?>", 
            type: 'POST',
            data: {'aid':aid}, 
            dataType: 'json',
            success: function (response) {
                // console.log(response); 
                var text = "Create Tax Invoice Number (" + aid + ")";
                $('#aid').val(aid); 
                $('#generate_ti').text(text);
              
                var essentialdata = response.data.essentialdata;
                // console.log(essentialdata);
                // Check and populate the HTML elements in the modal or elsewhere in your page
                if (essentialdata) {
                    // Check and populate each table cell only if the data exists and is not considered invalid
                    if (essentialdata.insured_name && essentialdata.insured_name !== "NA" && essentialdata.insured_name !== "") {
                        $('#insured_name').text(essentialdata.insured_name);
                    } else {
                        $('tr:has(th:contains("Name of Insured"))').remove();
                    }

                    if (essentialdata.loss_data && essentialdata.loss_data !== "NA" && essentialdata.loss_data !== "") {
                        $('#loss_data').text(essentialdata.loss_data);
                    } else {
                        $('tr:has(th:contains("Date of Loss"))').remove();
                    }

                    if (essentialdata.policyNumber && essentialdata.policyNumber !== "NA" && essentialdata.policyNumber !== "") {
                        $('#policyNumber').text(essentialdata.policyNumber);
                    } else {
                        $('tr:has(th:contains("Policy Number"))').remove();
                    }

                    if (essentialdata.claim_number && essentialdata.claim_number !== "NA" && essentialdata.claim_number !== "") {
                        $('#claim_number').text(essentialdata.claim_number);
                    } else {
                        $('tr:has(th:contains("Claim Number"))').remove();
                    }

                    if (essentialdata.survey_date && essentialdata.survey_date !== "NA" && essentialdata.survey_date !== "") {
                        $('#survey_date').text(essentialdata.survey_date);
                    } else {
                        $('tr:has(th:contains("Date of Survey"))').remove();
                    }

                    if (essentialdata.invoicenumber && essentialdata.invoicenumber !== "NA" && essentialdata.invoicenumber !== "") {
                        $('#invoicenumber').text(essentialdata.invoicenumber);
                    } else {
                        $('tr:has(th:contains("Invoice Number"))').remove();
                    }

                    if (essentialdata.invoicedate && essentialdata.invoicedate !== "NA" && essentialdata.invoicedate !== "") {
                        $('#invoicedate').text(essentialdata.invoicedate);
                    } else {
                        $('tr:has(th:contains("Invoice Date"))').remove();
                    }

                    // if (essentialdata.natureofjob && essentialdata.natureofjob !== "NA" && essentialdata.natureofjob !== "") {
                    //     $('#natureofjob').text(essentialdata.natureofjob);
                    // } else {
                    //     $('tr:has(th:contains("Nature of Job"))').remove();
                    // }
                   

                    const natureOfJobNames = {
                        1 : "Motor Vehicle Theft",
                        7 : "MARINE CARGO INVESTIGATION",
                        12: "MARINE PRE DISPATCH",
                        13: "PA Claim / EB Injury Investigation",
                        23: "Motor Pre Insurance Inspection",
                        24: "Marine Pre Disptach Inspection ",
                        61: "Cattle Pre Insurance Inspection",
                        62: "MOTOR SPOT INSPECTION",
                        63: "MARINE SPOT INSPECTION",
                        64: "CATTLE SPOT INSPECTION",
                        65: "MOTOR FINAL INSPECTION",
                        67: "FIRE FINAL SURVEY",
                        66: "MARINE FINAL SURVEY",
                        70: "MISCELLANEOUS FINAL SURVEY",
                        75: "ENGINEERING PRE INSPECTION",
                        76: "Project Pre Inspection"
                    };

                    // Check if essentialdata.natureofjob is a valid ID and is not "NA" or empty
                    if (essentialdata.natureofjob && essentialdata.natureofjob !== "NA" && essentialdata.natureofjob !== "") {
                        const natureOfJobName = natureOfJobNames[essentialdata.natureofjob] || "Unknown nature of job"; 
                        $('#natureofjob').text(natureOfJobName);
                    } else {
                        $('tr:has(th:contains("Nature of Job"))').remove();
                    }

                }

                // fetching billing_data
                var billing_data = response.data.billing_data;  
                // console.log(billing_data);
                if (billing_data) {
                    $('#sub_total').text(billing_data.sub_total);  
                    $('#total').text(billing_data.total);         
                    $('#grandtotal').text(billing_data.grandtotal);  
                    $('#branchid').text(billing_data.branchid); 

                    if (billing_data && billing_data.bill_to){
                        $('#bill_to').text(billing_data.bill_to);
                        $('#billing_branch_name').text(billing_data.bill_to.billing_branch_name);
                        $('#billing_gst').text(billing_data.bill_to.billing_gst);
                        $('#billing_payment_by').text(billing_data.bill_to.billing_payment_by);
                        $('#billing_id').text(billing_data.bill_to.billing_id);
                    }else {
                        // console.log("No Bill To data available.");
                    }

                    if (billing_data && billing_data.ship_to){
                        $('#ship_to').text(billing_data.ship_to);  
                        $('#shipping_branch_name').text(billing_data.ship_to.shipping_branch_name);
                        $('#shipping_mobile_num').text(billing_data.ship_to.shipping_mobile_num);
                        $('#shipping_payment_by').text(billing_data.ship_to.shipping_payment_by);
                        $('#shipping_user_name').text(billing_data.ship_to.shipping_user_name);
                    }else {
                        // console.log("No Ship To data available.");
                    }
                    if (billing_data && billing_data.bill_to && billing_data.bill_to.billing_id) {
                        var billingId = billing_data.bill_to.billing_id;
                        if (billingId && billingId.trim() !== "") {
                            $('#billing_id').text(billingId);  
                            $('tr:has(th:contains("Billing ID"))').show(); 
                        } else {
                            $('tr:has(th:contains("Billing ID"))').hide(); 
                        }
                    } else {
                        $('tr:has(th:contains("Billing ID"))').hide(); 
                    }

                    // if (billing_data && billing_data.tax) {
                    //     var tax = billing_data.tax;
                    //     if (tax.gst_number) {
                    //         $('#gst_number').text(tax.gst_number);
                    //     }
                    //     $('#gst_select').on('change', function() {
                    //         var gst1 = $('#billing_gst').text().trim(); 
                    //         var gst2 = $('#gst_select option:selected').text().trim(); 
                    //         var branchId = $('#gst_select option:selected').val();

                    //         // Assuming tax is an object containing the gst_percentage and other tax details.
                    //         var taxData = {
                    //             gst_number: gst2, 
                    //             gst_percentage: tax.gst_percentage, 
                    //             cgst_percentage: 0,
                    //             sgst_percentage: 0,
                    //             igst_percentage: 0,
                    //             calculatedgst: tax.calculatedgst,
                    //             branchid: branchId
                    //         };

                    //         // Extract state codes (first 2 characters) from gst1 and gst2
                    //         const stateCode1 = gst1.substring(0, 2);
                    //         const stateCode2 = gst2.substring(0, 2);

                    //         if (stateCode1 === stateCode2) {
                    //             // Intra-state: Show CGST and SGST (Half GST each)
                    //             const halfGST = (tax.gst_percentage / 2).toFixed(2);

                    //             // Show CGST and SGST if they are greater than 0
                    //             if (tax.gst_percentage > 0) {
                    //                 // Set the values for CGST and SGST as half of the GST percentage
                    //                 $('#cgst_percentage').text(halfGST + '%').show();
                    //                 $('#cgst_percentage').closest('td').show();
                    //                 $('th:contains("CGST")').show();
                    //                 taxData.cgst_percentage = halfGST;

                    //                 $('#sgst_percentage').text(halfGST + '%').show();
                    //                 $('#sgst_percentage').closest('td').show();
                    //                 $('th:contains("SGST")').show();
                    //                 taxData.sgst_percentage = halfGST;
                    //             } else {
                    //                 // Hide CGST and SGST fields if GST percentage is 0 or invalid
                    //                 $('#cgst_percentage').closest('td').hide();
                    //                 $('th:contains("CGST")').hide();

                    //                 $('#sgst_percentage').closest('td').hide();
                    //                 $('th:contains("SGST")').hide();
                    //             }

                    //             // Hide IGST fields for intra-state
                    //             $('#igst_percentage').text('').hide();
                    //             $('#igst_percentage').closest('td').hide();
                    //             $('th:contains("IGST")').hide();
                    //             taxData.igst_percentage = 0;

                    //         } else {
                    //             // Inter-state: Show IGST only
                    //             const igstPercentage = tax.gst_percentage;

                    //             if (igstPercentage > 0) {
                    //                 $('#igst_percentage').text(igstPercentage + '%').show();
                    //                 $('#igst_percentage').closest('td').show();
                    //                 $('th:contains("IGST")').show();
                    //                 taxData.igst_percentage = igstPercentage;
                    //             } else {
                    //                 $('#igst_percentage').closest('td').hide();
                    //                 $('th:contains("IGST")').hide();
                    //             }

                    //             // Hide CGST and SGST fields for inter-state
                    //             $('#cgst_percentage').closest('td').hide();
                    //             $('#sgst_percentage').closest('td').hide();
                    //             $('th:contains("CGST")').hide();
                    //             $('th:contains("SGST")').hide();
                    //         }
                    //         $('#hidden_gst_data').val(JSON.stringify(taxData));
                    //     });

                    //     $(document).ready(function() {
                    //         $('#gst_select').trigger('change');
                    //     });

                    // } else {
                    //     console.log("No Tax data available.");
                    // }
                    if (billing_data && billing_data.tax) {
                        var tax = billing_data.tax;
                        var gstNumber = tax.gst_number; // GST number fetched from billing_data.tax

                        // Set the gst_number in the DOM (e.g., if needed for some other purpose)
                        $('#gst_number').text(gstNumber);

                        // Store the selected GST number initially
                        var selectedGstNumber = gstNumber;

                        // Handle the 'change' event of the GST dropdown
                        $('#gst_select').on('change', function() {
                            var gst1 = $('#billing_gst').text().trim(); 
                            var gst2 = $('#gst_select option:selected').text().trim(); 
                            var branchId = $('#gst_select option:selected').val();

                            // Assuming tax is an object containing the gst_percentage and other tax details
                            var taxData = {
                                gst_number: gst2, 
                                gst_percentage: tax.gst_percentage, 
                                cgst_percentage: 0,
                                sgst_percentage: 0,
                                igst_percentage: 0,
                                calculatedgst: tax.calculatedgst,
                                branchid: branchId
                            };

                            // Extract state codes (first 2 characters) from gst1 and gst2
                            const stateCode1 = gst1.substring(0, 2);
                            const stateCode2 = gst2.substring(0, 2);

                            // Handle Intra-state and Inter-state logic for GST percentages
                            if (stateCode1 === stateCode2) {
                                // Intra-state: Show CGST and SGST (Half GST each)
                                const halfGST = (tax.gst_percentage / 2).toFixed(2);

                                if (tax.gst_percentage > 0) {
                                    $('#cgst_percentage').text(halfGST + '%').show();
                                    $('#sgst_percentage').text(halfGST + '%').show();
                                    taxData.cgst_percentage = halfGST;
                                    taxData.sgst_percentage = halfGST;
                                } else {
                                    $('#cgst_percentage').closest('td').hide();
                                    $('#sgst_percentage').closest('td').hide();
                                }

                                // Hide IGST for intra-state
                                $('#igst_percentage').closest('td').hide();
                                taxData.igst_percentage = 0;
                            } else {
                                // Inter-state: Show IGST only
                                const igstPercentage = tax.gst_percentage;

                                if (igstPercentage > 0) {
                                    $('#igst_percentage').text(igstPercentage + '%').show();
                                    taxData.igst_percentage = igstPercentage;
                                } else {
                                    $('#igst_percentage').closest('td').hide();
                                }

                                // Hide CGST and SGST for inter-state
                                $('#cgst_percentage').closest('td').hide();
                                $('#sgst_percentage').closest('td').hide();
                            }

                            // Store the updated tax data (for further processing)
                            $('#hidden_gst_data').val(JSON.stringify(taxData));
                        });

                        // Trigger the change event on page load to initialize
                        $(document).ready(function() {
                            // Re-populate the dropdown and set the selected option
                            $.ajax({
                                url: '<?php echo base_url("billing/get_gstnumber"); ?>',
                                method: 'GET',
                                data: {
                                    companyId: "<?php echo $defaultcompany; ?>"
                                },
                                success: function(response) {
                                    if (typeof response === 'string') {
                                        response = JSON.parse(response);
                                    }
                                    if (response && response.gstnumbers) {
                                        var gstSelect = $("#gst_select");
                                        gstSelect.empty();  // Clear existing options

                                        // Loop through GST numbers and append them to the dropdown
                                        response.gstnumbers.forEach(function(item) {
                                            var selectedAttr = (item.gst === selectedGstNumber) ? 'selected' : '';  // Match with the selected GST
                                            gstSelect.append('<option value="' + item.id + '" ' + selectedAttr + ' style="font-size:14px;">' + item.gst + '</option>');
                                        });
                                    }
                                    // Trigger change on dropdown after population
                                    $('#gst_select').trigger('change');
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error fetching GST numbers:", error);
                                }
                            });
                        });
                    } else {
                        // console.log("No Tax data available.");
                    }
                } else {
                    // console.log("No billing data available.");
                }

                // Check if additional_expenses exists and contains data
                if (billing_data && billing_data.additional_expenses && billing_data.additional_expenses.length > 0) {
                    var tableRows = '';
                    var additionalExpensesHeader = "<h6>Additional Expenses</h6>";
                    $('#invoice-additional-table-header').html(additionalExpensesHeader); 
                    billing_data.additional_expenses.forEach(function(expense) {
                        var row = "<tr>";
                        row += `<td>${expense.item}</td>`;
                        row += `<td>${expense.description}</td>`;  // Always include description (even if empty)
                        row += `<td>${expense.rate}</td><td>${expense.qty}</td><td>${expense.amount}</td></tr>`;
                        
                        // Append the row to the tableRows string
                        tableRows += row;
                    });

                    // Update the table body with all the additional expense rows
                    $('#invoice-additional-table-body').html(tableRows);
                } else {
                    // console.log("No additional expenses data available.");
                }

                if (billing_data && billing_data.invoice && billing_data.invoice.length > 0) {
                    var tableRows = ''; // Initialize an empty string to build the rows

                    // Loop through all invoice items to build the rows
                    billing_data.invoice.forEach(function(invoice) {
                        var row = "<tr>";
                        row += `<td>${invoice.item}</td>`;
                        row += `<td>${invoice.description}</td>`;  // Always include description (even if empty)
                        row += `<td>${invoice.rate}</td><td>${invoice.qty}</td><td>${invoice.amount}</td></tr>`;
                        
                        // Append the row to the tableRows string
                        tableRows += row;
                    });

                    // Update the table body with all the rows
                    $('#invoice-table-body').html(tableRows);

                    // Update the table header to always include the Description column
                    var headerRow = "<tr><th>Item</th><th>Description</th><th>Rate (Rs.)</th><th>Qty</th><th>Amount (Rs.)</th></tr>";
                    
                    // Update the table header with the new header row
                    $('#invoice-table-header').html(headerRow);

                } else {
                    // console.log("No invoice data available.");
                }
                $('#submit_ti').modal('show');
            },
            error: function () {
                alert('An error occurred while submitting the form.');
            }
        });
    }

    $(document).ready(function () {
        $('#submitButton').on('click', function (e) {
            e.preventDefault();
            var formData = $('#submitti').serialize();
            var aid = $('#aid').val(); 
            
            var taxData = $('#hidden_gst_data').val();
            var branchId = $('#gst_select option:selected').val();
            if (!taxData) {
                alert('Tax data is missing.');
                return;
            }
            formData += '&branchid=' + branchId;
            formData += '&aid=' + aid; 
            $.ajax({
                url: 'savetinumber', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'success') {
                        alert('Form submitted successfully!');
                        $('#submitti')[0].reset();
                        $('#submit_ti').modal('hide');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An error occurred while submitting the form.');
                }
            });
        });
    });
   
   // Function to decode HTML entities
    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }
</script>