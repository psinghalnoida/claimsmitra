<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<?php $this->load->view('adminpanel/layout/case-sidebar');?>
<style>
.modal-body{
    padding:20px;
}
</style>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata'); ?>
        </div>
    </div>
    <section class="panel records--body" style="border: 1px solid #E5E4E2; margin-left: 15px;margin-right:15px; margin-bottom:65px;">
        <div class="title">
            <h6 class="h6">Survey Fee</h6>
            <a href="#" class="btn btn-rounded btn-outline-secondary"><b>Balance:</b></a>
        </div>
        <div class="panel-heading">
            <form id="surveyFee">
            <input type="hidden" name="aid" id="aid" value="<?php echo $aid; ?>">
            <div class="row">
                <label class="mr-4 mt-2">
                    <select name="operation" id="operation"class="form-control" >
                        <option value="1" disable>Select an option</option>
                        <option value="Add">Add</option> 
                        <option value="Less" class="operation less">Less</option>
                    </select>    
                </label>
                <label class="mr-4  mb-3 ">
                    <input type="tel" name="amount" id="amount" placeholder="Enter Amount" class="form-control">
                </label>
                <label class="mr-4 mb-3">
                    <input type="date" name="date" id="date" class="form-control editable-field">
                </label>   
                <label class="mr-4 mb-3 ">
                    <select name="description" id="description" class="form-control" >
                        <option value="1" disable>Select an option</option>
                    </select> 
                </label>
            </div>
            <div class="btn-group float-right">             
                <a href="#" id="submitFee" class="btn btn-success m-1">Submit</a>
                <a href="#" class="btn btn-default m-1">Cancel</a>
            </div>  
            </form>
        </div>
        <section>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <div id="manual">
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <span class="label-text">Receivable Invoice</span>
                            <a href="#TIModal" class="btn btn-rounded btn-default float-right" data-toggle="modal">Case Close</a>
                            <hr>
                        </label>
                    </div>
                </div>
                <!----------------------------TI Modal for Case Close--------------------------------->
                <div id="TIModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tax Invoice</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="form-group row modal-body">
                                <span class="label-text col-md-3 col-form-label text-md-left">TDS Rate:</span>
                                <div class="col-md-9 mt-1">
                                    <input type="text" name="text" class="form-control">
                                </div>
                                <span class="label-text col-md-3 col-form-label text-md-left">Total Receipt:</span>
                                <div class="col-md-9 mt-1">
                                    <input type="text" name="text" class="form-control">
                                </div>
                                <span class="label-text col-md-3 col-form-label text-md-left">Remaining:</span>
                                <div class="col-md-9 mt-1">
                                    <input type="text" name="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!----------------------------END--------------------------------->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <span class="label-text">Tax Invoice</span>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">
                                            <button type="button" class="btn btn-rounded btn-default" id="addBtn">Create TI</button>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">
                                            <span class="label-text">Total Amount:</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        <label for=""> 
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--------------------For Create-TI(button) Input boxes---------------------->
                            <div id="tables">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <br><br><br>
    </section>
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script type="text/javascript">
    // code for operation button functionality
    document.addEventListener('DOMContentLoaded', function() {
        var operationSelect = document.getElementById('operation');
        var optionsSelect = document.getElementById('description');
        operationSelect.addEventListener('change', function() {
            var selectedValue = operationSelect.value;
            var optionsSelect = document.getElementById('description');
            optionsSelect.innerHTML = '';
            if (selectedValue === 'Add') { // Add
                var option1 = new Option('Survey Fee');
                var option2 = new Option('Expenses');
                optionsSelect.add(option1);
                optionsSelect.add(option2);
            } 
            else if (selectedValue === 'Less') { // Less
                var option1 = new Option('TDS');
                var option2 = new Option('Cash');
                var option3 = new Option('Check/DD');
                var option4 = new Option('NEFT');
                var option5 = new Option('Round Off');
                var option6 = new Option('Bad Debt');
                var option7 = new Option('Deduction');
                var option8 = new Option('Discount');
                optionsSelect.add(option1);
                optionsSelect.add(option2);
                optionsSelect.add(option3);
                optionsSelect.add(option4);
                optionsSelect.add(option5);
                optionsSelect.add(option6);
                optionsSelect.add(option7);
                optionsSelect.add(option8);
            }
        });
        var fieldsAppended = false; 
        $("#addBtn").on("click", function() {
            if (!fieldsAppended) {
                addNewfield();
                fieldsAppended = true;
            } else {
                removeFields();
                fieldsAppended = false; 
            }
        });
        function addNewfield() {
            var newRow = `
                <input type="text" class="form-control mb-2" name="ti_number" id="ti_number"  placeholder="TI Number">
                <input type="date" class="form-control mb-2" placeholder="TI Date">
                <button type="button" class="btn btn-rounded btn-info float-right submit-btn">Submit</button>
            `;
            $("#tables").append(newRow);
        }
        function removeFields() {
            $("#tables").empty(); 
        } 
        // code for inserting Survey Fee to database
        $('#submitFee').click(function(e) {
            e.preventDefault();
            var formData = $('#surveyFee').serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('cases/saveSurveyFeeData'); ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#surveyFee')[0].reset();
                        fetchRecord();
                    } else {
                        console.error('Failed to save data:', response.message);
                    }
                },                
            });
        });      
        function fetchRecord() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('cases/getSurveyFeeRecordByAid/') ?>' + encodeURIComponent('<?php echo $aid; ?>'),
                dataType: 'json',
                success: function(records) {
                    if (records && records.length > 0) {
                        var recordHtml = '<div class="card" style="box-shadow: 0 4px 8px rgba(0,0,0,0.1);">';
                        recordHtml += '<div class="">';
                        recordHtml += '<h5 class=""><b>Manual</b></h5>';
                        recordHtml += '<hr>';
                        var totalAmount = 0; 
                        for (var i = 0; i < records.length; i++) {
                            var record = records[i];
                            var amount = parseFloat(record.amount);
                            recordHtml += '<div class="row mb-2">';
                            recordHtml += '<div class="col-lg-1 delete-record" style="color: red; font-size: 12px; cursor: pointer;" data-id="' + record.id + '">';
                            recordHtml += '<i class="fas fa-trash delete-icon"></i>';
                            recordHtml += '</div>';
                            recordHtml += '<div class="col-lg-2" style="font-size: 12px;">' + record.operation + '</div>';
                            recordHtml += '<div class="col-lg-5" style="font-size: 12px;">';
                            recordHtml += '<p><b>Remark:</b> ' + record.description + '</p>';
                            recordHtml += '<p style="margin-top: -15px;"><b>Date:</b> ' + record.date + '</p>';
                            recordHtml += '</div>';
                            recordHtml += '<div class="col-lg-3 amount" style="font-size: 12px;">' + amount + '</div>';
                            recordHtml += '</div>';

                            if (record.operation.toLowerCase() === 'add') {
                                totalAmount += amount;
                            } else if (record.operation.toLowerCase() === 'less') {
                                totalAmount -= amount;
                            }
                        }
                        recordHtml += '<hr>';
                        recordHtml += '<div class="row mt-3">';
                        recordHtml += '<div class="col-lg-12 text-right"><b>Total Amount:</b> <span id="totalAmount">' + totalAmount + '</span></div>';
                        recordHtml += '</div>';
                        recordHtml += '</div>';
                        recordHtml += '</div>';
                        $('#manual').html(recordHtml);
                    } else {
                        $('#manual').html('<span class="label-text">Manual</span><hr><span class="label-text">Total Amount:</span>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch records:', error);
                }
            });
        }
        fetchRecord();     
        $('#manual').on('click', '.delete-record', function() {
            var recordId = $(this).data('id');
            deletesurvey(recordId);
        });
        function deletesurvey(id) {
            $.ajax({
                url: "<?php echo base_url('cases/deleteSurveyFee'); ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(response) {
                    if (response && response.success) {
                        updateTotalAmount();
                    } else {
                        console.error("Failed to delete:", response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }
        function updateTotalAmount() {
            var totalAmount = 0;
            $('.amount').each(function() {
                var amount = parseFloat($(this).text());
                totalAmount += amount;
            });
            $('#totalAmount').text(totalAmount.toFixed(2));
        }
    });
</script>
