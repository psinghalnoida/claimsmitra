

<?php $this->load->view('adminpanel/layout/sidebar'); ?>

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
                              <h2>SabPaisa Payment Response</h2>
                                <pre>
                                <?php print_r($response); ?>
                                </pre>  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $this->load->view('adminpanel/layout/footer'); ?>