<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  width: 45px;
  height: 20px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<!-- Main Container Start -->
<main class="main--container" >
<!-- Tab Content Start -->
<div class="tab-content" style="min-height:100vh;padding:0px;">
    <div class="tab-pane fade show active" id="tab11">  
        <section class="main--content">
            <div class="row gutter-20" style="margin:5px">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="row" style="padding-left:30px; color: black;">
                                        <h4>Terms and conditions</h4>
                                    </div>
                                    <ul style="margin-left: 50px; text-align:justify; font-size: 15px;">
                                        <li>The assignment acceptance is subject to availability of the professional for the job. If no professional found the payment collected will be refunded 100% in next 2 days.</li>
                                        <li>At this stage you are paying 50% advance of expected / tentative bill amount. Rest to be paid before you are able to download the report.</li>
                                        <li>There is a lookup period of 7 days from the date of assignment completion followed by final payment and downloading of the report. In this period of 7 days you can dispute the report.  The professional will be available to chat with you directly so that you may resolve the matter within 7 days. If no dispute is raised within 7 days the professional will receive his dues from us.</li>
                                        <li>The first draft after full payment will come with watermark “Draft Report”. You have to approve the report to download the report without watermark.</li>
                                        <li>If the dispute is not resolved in 7 days, you may ask for extension of next 7 days or ask for refund. In any case, only 50% refund is allowable to you as the professional still needs to be paid for the time and effort.</li>
                                        <li>The bill will be raised by us for the services. You may update your company details in the profile section to avail the benefit of ITC of GST. </li>
                                    </ul> 
                                </div>    
                               <div class="col-lg-6 col-md-6">
                                    <div class="row align-items-center justify-content-between mb-3" style="color: black; padding: 0 20px;">
                                        <div class="col-md-auto">
                                            <h4 class="mb-3">Pricing (<span style="color:red" id="aid"><?php echo $aid; ?></span>)</h4>
                                        </div>
                                        <div class="col-md-auto d-flex align-items-center">
                                            <span id="toggle-label" class="mr-2 mb-3">Partial Payment</span>
                                            <label class="switch mb-0">
                                                <input type="checkbox" id="paymentToggle">
                                                <span class="slider round"></span>
                                            </label>
                                            <input type="hidden" name="payment_type" id="payment_type" value="partial">
                                        </div>
                                    </div>

                                    <!-- Hidden input to store actual value -->
                                   <input type="hidden" name="payment_type" id="payment_type" value="partial">

                                    <div class="row">
                                        <div class="panel" style="width:100%; border-radius: 0;box-shadow: none;">
                                            <div class="panel-body" style="padding-top:0px">
                                                <div class="table-responsive">
                                                    <div class="invoice--order">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Assignment Name</th>
                                                                    <th>Rate</th>
                                                                    <?php if ($natureofjob == 8): ?>
                                                                        <th>Total Pages</th>
                                                                    <?php else: ?>
                                                                        <th>Unit</th>
                                                                    <?php endif; ?>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td id="product"><?= htmlspecialchars($casename); ?></td>
                                                                    <td id="rate"><?= htmlspecialchars($rate); ?></td>
                                                                    <td id="total-pages"><?= htmlspecialchars($totalpages); ?></td>
                                                                    <td id="total-amount"><?= htmlspecialchars($totalamount); ?></td>
                                                                </tr>
                                                                <tr id="partial-payment-row">
                                                                    <td colspan="3"><strong class="partial-payment">Partial Payment (50%)</strong></td>
                                                                    <td id="partially-amount"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3"><strong>Service Charge (5%)</strong></td>
                                                                    <td id="servicecharge"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3"><strong>GST (18%)</strong></td>
                                                                    <td id="gst"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3"><strong>Total Amount</strong></td>
                                                                    <td id="total"><strong></strong></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <!-- Your HTML content with the button -->
                                        <div class="col-lg-6">
                                            <label class="form-check">
                                               <input type="checkbox" name="checkbox" onclick="agreetermsandcondition()" id="check_terms" value="1" class="form-check-input">
                                                <span class="form-check-label">
                                                Yes, I agree to the 
                                                <a href="<?php echo base_url('dashboard/termsofservice'); ?>" target="_blank">Terms of Service</a>
                                              </span>
                                            </label>
                                        </div>

                                       <div class="col-lg-6" style="text-align: -webkit-right;">
                                         <form action="https://stage-securepay.sabpaisa.in/SabPaisa/sabPaisaInit?v=1"method="post">
                                                <?php 
                                                $totalAmount = $checkoutdata['amount'] + $checkoutdata['gst'];
                                                ?>
                                                <input type="hidden" name="encData" value="<?php echo $checkoutdata['encryptedData']; ?>" id="frm1">
                                                <input type="hidden" name="clientCode" value ="<?php echo $checkoutdata['clientCode']; ?>" id="frm2">
                                                <input type="hidden" name="payable_amount" value="<?php echo "₹ " . number_format($totalAmount, 2, '.', ','); ?>" id="frm3">
                                                <div class="col-lg-6" style="text-align:right;">
                                                    <button type="submit" class="btn btn-sm btn-rounded btn-success" id="btn_pay"  id="submitButton" disabled>
                                                        Pay INR <span id="partially_amount"></span>
                                                    </button>
                                                </div>  
                                         </form>
                                       </div>
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




<?php $this->load->view('adminpanel/layout/footer'); ?>

<script type="text/javascript">
    function agreetermsandcondition() {
        $('#btn_pay').prop('disabled', !$('#check_terms').is(':checked'));
    }

    $(document).ready(function () {
        const rate = "<?= htmlspecialchars($rate); ?>".replace(/,/g, '');
        const perPageCost = parseFloat(rate) || 0;
        const totalPages = parseFloat("<?= htmlspecialchars($totalpages); ?>") || 0;
        const jobType = "<?= htmlspecialchars($casename); ?>";
        let unit = (jobType === "Document Translation") ? totalPages : 1;
        let result = unit * perPageCost;

        function updateAmounts() {
            let paymentType = $('#payment_type').val();
            let partialAmount = (paymentType === 'partial') ? result / 2 : result;

            if (paymentType === 'partial') {
                $('#partial-payment-row').show();
                $('.partial-payment').text('Partial Payment (50%)');
                $('#partially-amount').text(partialAmount.toFixed(2));
            } else {
                $('#partial-payment-row').show(); // Or `.hide()` based on your preference
                $('.partial-payment').text('Full Payment (100%)');
                $('#partially-amount').text(partialAmount.toFixed(2));
            }

            let serviceCharge = (partialAmount * 5) / 100;
            let gst = ((partialAmount + serviceCharge) * 18) / 100;
            let total = partialAmount + serviceCharge + gst;

            $("#servicecharge").text(serviceCharge.toFixed(2));
            $("#gst").text(gst.toFixed(2));
            $("#total-amount").text(result.toFixed(2));
            $("#total").text(total.toFixed(2));
            $("#partially_amount").text(total.toFixed(2));
        }

        // Toggle switch listener
        $('#paymentToggle').change(function () {
            let isFull = $(this).is(':checked');
            let paymentType = isFull ? 'full' : 'partial';
            $('#payment_type').val(paymentType);
            console.log(paymentType);
            $('#toggle-label').text(isFull ? 'Full Payment' : 'Partial Payment');
            updateAmounts();
        });

        // Initial UI update
        updateAmounts();

        // Terms checkbox handler
        $('#check_termsandcondition').on('change', function () {
            $('#btn_pay').prop('disabled', !$(this).is(':checked'));
        });

        // Payment button click
        $('#btn_pay').on('click', function () {
            paynow();
        });

        function paynow() {
            const amount = $('#partially_amount').text().trim();
            const product = $('#product').text().trim();
            const aid = $('#aid').text().trim();
            const partial_amount = $('#partially-amount').text().trim();
            const gst = $('#gst').text().trim();
            const casetype = <?= json_encode($casetype); ?>;

            $.ajax({
                url: "<?php echo base_url('checkout'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    amount: amount,
                    product: product,
                    aid: aid,
                    partial_amount: partial_amount,
                    gst: gst,
                    casetype: casetype
                },
                success: function (response) {
                    // handle redirect or show success message
                },
                error: function (xhr, status, error) {
                   
                    console.error("Error:", error);
                }
            });
        }
    });
</script>


