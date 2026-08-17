<!-- Main Footer Start -->
<!-- Add this to your HTML head section -->
<footer class="main--footer main--footer-dark" style="min-height: 260px;">
    <div class="row" style="border-bottom-style: solid;border-width: 1px;border-color: grey; padding-bottom: 40px;">
        <div class="col-xl-4 col-md-6">
            <div class="panel" style="margin-bottom:0px;background-color:transparent">
                <div class="panel-heading" style="color:white;margin-left:.4rem">
                    <h3>About Us</h3>
                </div>
                <div class="row">
                    <ul style="list-style:none;margin-right:3rem;color:white;line-height:2rem;">
                        <li>
                            <p style="font-size: 16px; text-align: justify; line-height:initial;">Insurance industry is booming and we are ready to serve it. We have served it for last 50 years and we have lived the changes from pre nationalisation era to large AI driven technology. We bring you a bouquet of services which we hope will help you boost your claims processes. We are looking for service partners and investments both.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6" >
            <div class="panel" style="margin-bottom: 0px;background-color:transparent"> 
                <div class="panel-heading" style="color:white;margin-left:1.2rem">
                    <h3>Useful Links</h3>
                </div>
                <ul style="list-style:none;line-height:2rem;font-size: 16px;">
                    <li><a href="<?php echo base_url('web/termsandcondition'); ?>" target="_blank" style="color:white">Terms and conditions</a></li>
                    <li><a href="<?php echo base_url('web/privacypolicy'); ?>" target="_blank" style="color:white">Privacy policy</a></li>
                    <li><a href="<?php echo base_url('web/refundpolicy'); ?>" target="_blank" style="color:white">Refund policy</a></li>
                </ul>
            </div>      
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="panel" style="margin-bottom: 0px;background-color:transparent">
                <div class="panel-heading" style="color:white">
                    <h3>Contact Us</h3>
                </div>
                <div class="row"style="color:white;line-height:2rem;font-size: 16px;">
                    <ul style="list-style:none">
                        <li>
                            <i class="fa fa-map-marker" aria-hidden="true" style="margin-right:.4rem"></i>
                                <span>43, KC green avenue old haibatpur <br>opposite gaur city 201301</span>
                        </li>
                        <li>
                            <i class="far fa-envelope" style="margin-right:.4rem"></i>
                            support@claimsmitra.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6" style="text-align:right">
            <div class="panel" style="margin-bottom: 0px;background-color:transparent"> 
                <a class="nav-link " href="https://alpha.claimsmitra.com/oldclaimsmitra/" target="_blank"> 
                    <button class="btn btn-rounded btn-danger" style="border:none"> Member Hub </button>
                </a>
            </div>      
        </div>
    </div>
    <div class="row" style="color:white;padding-top: 6px;">
        <div class="col-md-12 text-center">
            <span style="padding-top: 20px;">
                &copy;  2023 by Adwiti Technocrats Pvt. Ltd.    All rights reserved. 
            </span>
        </div>
    </div>
</footer>
    <!-- Main Footer End -->
</main>
<!-- Main Container End -->
</div>
<!-- Wrapper End -->
<!-- Scripts -->

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap4-toggle.min.js"></script>
<script src="<?php echo base_url();?>assets/js/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>assets/js/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/js/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-jvectormap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-jvectormap-world-mill.min.js"></script>
<script src="<?php echo base_url();?>assets/js/horizontal-timeline.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.steps.min.js"></script>

<script src="<?php echo base_url();?>assets/datatables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>assets/datatables/DataTables-1.13.4/js/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>

<script src="<?php echo base_url();?>assets/js/main.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url();?>assets/js/ion.rangeSlider.min.js"></script>


<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sweetalert-init.js"></script>

<script src="<?php echo base_url();?>assets/js/intlTelInput.min.js"></script>

<script src="<?php echo base_url();?>assets/js/jquery.countdown.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.countdown-init.js"></script>

<script>
    window.addEventListener("scroll", function () {
        let header = document.querySelector(".navbar-fixed");
        if (window.scrollY > 50) {
            header.style.backgroundColor = "#232a2b"; // Change to your desired color
            header.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.2)"; // Add shadow for effect
        } else {
            header.style.backgroundColor = "transparent"; 
            header.style.boxShadow = "0 0px 0px rgba(0, 0, 0, 0)"; // Remove shadow when at top
        }
    });
</script>
</body>
</html>