<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<!-- Tab Content Start -->
<div class="tab-content" style="padding:0px;">
    <div class="tab-pane fade show active" id="tab11">
        <section class="page--header">
            <div class="container-fluid" style="padding-right:6px;">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">NON LOCATION BASED JOB</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ecommerce.html">Claims Mitra</a></li>
                            <li class="breadcrumb-item active"><span>Terms and conditions</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6" style="text-align:right;">
                        <a href="<?php echo base_url('nonlocationoutgoing');?>"  class="btn btn-rounded btn-success">All Cases</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="main--content">
            <div class="row gutter-20">
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
                                        <li>There is a lookup period of 7 days from the date of final payment and downloading of the report. In this period you can dispute the report. After this the professional will be able to chat with you directly and you may resolve the matter within 7 days. After this only the professional will receive his dues from us.</li>
                                        <li>The first draft after full payment will come with watermark “Draft Report”. You have to approve the report to download the report without watermark.</li>
                                        <li>If the dispute is not resolved in 7 days, you may ask for extension of next 7 days or ask for refund. In any case, only 50% refund is allowable to you as the professional still needs to be paid for the time and effort.</li>
                                        <li>The bill will be raised by us for the services. You may update your company details in the profile section to avail the benefit of ITC of GST.</li>
                                    </ul> 
                                </div>    
                                <div class="col-lg-6 col-md-6">
                                    <div id="parent_company">
                                        <section class="page--header">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="panel" style="width:100%; border-radius: 0;box-shadow: none;">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">
                                                                Pricing
                                                            </h3>
                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table style--2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Case Name</th>
                                                                            <?php  if($costing['investigator_type'] != "Document Translation"){ ?>
                                                                                <th>Total Case</th>
                                                                                <th>Amount Per Case</th>
                                                                            <?php }else{ ?>
                                                                                <th>Total Pages</th>
                                                                                <th>Amount Per Page</th>
                                                                            <?php } ?>
                                                                            <th>Total Amount </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td id="total-pdf-count"><?php echo $costing['investigator_type']; ?></td>
                                                                            <?php  if($costing['investigator_type'] != "Document Translation"){ ?>
                                                                                <td id="total-cases">1</td>
                                                                            <?php }else{ ?>
                                                                                <td id="total-pages"><?php echo $pages; ?></td>
                                                                            <?php } ?>
                                                                            <td id="rate"><?php echo $costing['rate'] ?></td>
                                                                            <td id="total-amount"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                     <div class="col-lg-6">
                                                        <label class="form-check">
                                                            <input type="checkbox" name="checkbox" onclick="agreetermsandcondition()" id="check_terms" value="1" class="form-check-input">
                                                            <span class="form-check-label">Yes, I agree to the <a href="<?php echo base_url('dashboard/termsofservice'); ?>" target="_blank">Terms of Service</a></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6" style="text-align:right;">
                                                        <button type="button" class="btn btn-sm btn-rounded btn-success" onclick="paynow();" disabled id="btn_pay">Pay INR <span id="total_amount"></span></button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </section>
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
<?php $this->load->view('adminpanel/layout/footer');?>
<script type="text/javascript">
$(document).ready(function() {
    var perpagecosting = $('#rate').text() || 0;
    var jobtype = "<?php echo $costing['investigator_type'];  ?>";
    if(jobtype === "Document Translation{"){
        var totalpages = parseFloat($('#total-pages').text()) || 0;
        var result = totalpages * (parseFloat(perpagecosting.replace(/,/g, ''))).toFixed(2);
        $("#total-amount").text(result);
        $("#total_amount").text(result);
    }else{
        var totalcase = parseFloat($('#total-cases').text()) || 0;
        var result = totalcase * (parseFloat(perpagecosting.replace(/,/g, ''))).toFixed(2);
        $("#total-amount").text(result);
        $("#total_amount").text(result);
    }
});
function agreetermsandcondition(){
    if ($('#check_terms').is(':checked')) {
        $('#btn_pay').prop('disabled', false);
    } else {
        $('#btn_pay').prop('disabled', true);
    }
}

function paynow(){
    var amount = $('#total_amount').text();
    $.ajax({
        url: "<?php echo base_url('checkout');?>",
        dataType: "json",
        type: "POST",
        data: {amount:amount},
        success: function(response){
            window.open(response, '_blank');
        }
    })
}
</script>