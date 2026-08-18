<!-- <?php $this->load->view('adminpanel/layout/sidebar'); ?> -->
<?php $this->load->view('adminpanel/layout/case-sidebar');?>

<main class="main--container" style="padding-top:103px;">
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata'); ?>
        </div>
    </div>

    <section id="dispatchForm" class="panel" style="border: 1px solid #E5E4E2;padding-bottom:10px; margin-left: 15px; margin-right:15px; margin-bottom:15px;min-height:100vh">
        <div class="panel-heading ">
            <h3 class="panel-title">Dispatch</h3>
        </div>
        <div class="panel-content ">
        <form id="dispatchDataForm" method="post">
            <input type="hidden" name="aid" id="aid" value="<?php echo $aid; ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Dispatch Mode: <span style="color:red">*</span></span>
                                <select name="dispatchmode" id="dispatchmode" class="form-control">
                                    <option disabled selected>Select Dispatch Mode</option>
                                    <option value="1">Physical handover</option>
                                    <option value="2">Post</option>
                                    <option value="3">Online portal submission</option>
                                    <option value="4">Email</option>
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4" id="tracking_number">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Tracking Number: <span style="color:red">*</span></span>
                                <input type="text" name="tracking_no" id="tracking_no" placeholder="Tracking Number" class="form-control">
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Dispatch to: <span style="color:red">*</span></span>
                                <select name="dispatch_to" id="dispatch_to" class="form-control" required>
                                    <option disabled selected value="">Select office</option>
                                    <option value="pay_office">Paying office</option>
                                    <option value="other_office">Other concerned office</option>
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Dispatch Date: <span style="color:red">*</span></span>
                                <input type="date" name="dispatchdate" id="dispatchdate" class="form-control editable-field">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Description: <span style="color:red">*</span></span>
                                <input type="text" name="description" id="description" placeholder="Portal ref, email address, recipient, or other office name" class="form-control">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align:end">
                        <div class="form-group">
                            <button type="button" class="btn btn-success m-1">Submit</button>
                        </div>
                    </div>
                </div>
        </form>
        </div> 
        <div id="recordsContainer" style="margin-left:15px;">
        
        </div>               
    </section>
   
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script type="text/javascript">
    $("#dispatchDataForm").on("submit", function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: "<?php echo base_url('dispatch') ?>", // Controller method URL
            type: "POST",
            data: $(this).serialize(), // Serialize form data
            dataType: "json",
            success: function(response) {
                // if (response.status === "success") {
                //     $("#message").html('<div class="alert alert-success">' + response.message + '</div>');
                //     $("#dispatchDataForm")[0].reset(); // Reset form
                // } else {
                //     $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
                // }
            },
            error: function(xhr, status, error) {
                $("#message").html('<div class="alert alert-danger">Something went wrong! Please try again.</div>');
            }
        });
    });




    $(document).ready(function() {
        // Initially hide the tracking number field
        $('#tracking_number').closest('div').hide();
        $('#dispatchmode').change(function() {
            if ($(this).val() == '2') {
                $('#tracking_number').closest('div').show();
            } else { 
                $('#tracking_number').closest('div').hide();
                $('#tracking_no').val(''); 
            }
        });
    
        
        fetchLatestRecord();
    });

    function fetchLatestRecord() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('cases/getLatestRecordByAid/') ?>' + encodeURIComponent('<?php echo $aid; ?>'),
                dataType: 'json',
                success: function(record) {
                    if (record) {
                        // Map the numeric value of dispatchmode to its text value
                        var dispatchModeText = '';
                        switch(record.dispatchmode) {
                            case '1':
                                dispatchModeText = 'Physical handover';
                                break;
                            case '2':
                                dispatchModeText = 'Post';
                                break;
                            case '3':
                                dispatchModeText = 'Online portal';
                                break;
                            case '4':
                                dispatchModeText = 'Email';
                                break;
                            default:
                                dispatchModeText = 'Unknown';
                        }
                        var recordHtml = '<div class="col-md-4 p-0 mb-2">';
                        recordHtml += '<div class="card" style="background: #2BB3C0;color:white;box-shadow: 0 4px 8px rgb(255, 255, 255);">';
                        recordHtml += '<div class="">';
                        recordHtml += '<div class="d-flex justify-content-between align-items-center mb-3">';
                        recordHtml += '<h5 class="ml-1"><b>Dispatch Detail</b></h5>';
                        recordHtml += '</div>'; 
                        recordHtml += '<p class="card-text"><b>Dispatch Mode:</b> ' + dispatchModeText  + '</p>';
                        // Add Tracking ID only if Dispatch Mode is '2' (Dispatch By Post)
                        if (record.dispatchmode == '2') {
                            recordHtml += '<p class="card-text"><b>Tracking ID:</b> ' + (record.tracking_no || 'N/A') + '</p>';
                        }
                        recordHtml += '<p class="card-text"><b>Description:</b> ' + record.description + '</p>';
                        recordHtml += '<p class="card-text"><b>Dispatch Date:</b> ' + record.dispatchdate + '</p>';
                        recordHtml += '</div>';
                        recordHtml += '</div>'; 
                        $('#recordsContainer').html(recordHtml).show();
                    } else {
                        $('#recordsContainer').empty().hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch latest record:', error);   
                }
            });
        }
</script>