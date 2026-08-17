<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<?php $this->load->view('adminpanel/layout/case-sidebar');?>
<style>
    .table {
        font-size: 14px; 
    }
    
    .table td, .table th {
        padding: 4px 8px; 
    }

    .table td {
        line-height: 1.2;
    }
    .reminder-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; 
        margin-top: 10px;
       
    }
    .reminder-item {
        position: relative; 
        flex: 0 0 150px;
    }
    .reminder-input {
        border: 1px solid #ccc;
        padding: 5px;
        padding-right: 30px; 
        border-radius: 5px;
        width: 150px; 
        margin-right: 5px;
        font-size:12px;
    }
    .remove-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: red;
    }
    .toggle-switch {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .toggle-switch input {
        display: none;
    }

    .slider {
        position: relative;
        width: 33px;
        height: 20px;
        background-color: #ccc;
        border-radius: 20px;
        transition: background-color 0.2s;
        margin-right: 10px;
    }

    .slider:before {
        content: "";
        position: absolute;
        width: 14px;
        height: 15px;
        border-radius: 50%;
        background-color: white;
        left: 2px;
        bottom: 2px;
        transition: transform 0.2s;
    }

    input:checked + .slider {
        background-color: #e16123;
    }

    input:checked + .slider:before {
        transform: translateX(15px);
    }

    .question-box {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        /* width:100%;
        transition: background-color 0.3s; */
    }
   
   
</style>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <!-- <?php $this->load->view('adminpanel/jobs/locationbasedjob/heading');?> -->
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata');?>
        </div>
    </div>
    <section class="main--content" style="border: 1px solid #E5E4E2; margin-left: 15px;margin-right:15px;padding-top: 0px;">
        <div class="row gutter-20">
            <div class="col-md-5 pr-1">
                <div class="panel pb-5 mb-3">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            LOR TITLE
                        </h3> 
                    </div>
                    <div class="panel-content">
                        <div class="questions-container" id="questionsContainer" name="questions"></div>
                        <a href="<?php echo base_url('preparelor?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') .''); ?>" id="lorBankBtn">
                            <button class="btn btn-rounded btn-success float-right mt-2" 
                               >
                                LOR Bank
                            </button>
                        </a>

                        <button class="btn btn-rounded btn-info float-right mt-2 mr-2" data-toggle="modal" data-target="#addLorTitle">Add New Title</button>
                        <button class="btn btn-rounded btn-default float-right mt-2 mr-2" id="editButton" onclick="addRemove()" >Edit</button>
                    </div>

                    <!--------------------Modal for add LOR Title--------------------->
                    <div id="addLorTitle" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Lor Title</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body ">
                                    <div class="col-md-12 mt-1 mb-4">
                                        <input type="text" id="newQuestion" class="form-control" placeholder="type here...">
                                    </div>

                                    <div class=" d-flex justify-content-end">
                                        <button type="button" id="saveQuestionBtn" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel pb-5">
                    <div class="panel-heading">
                        <h3 class="panel-title">Send To</h3>
                        <button class="btn btn-rounded btn-default float-right mt-1" data-toggle="modal" data-target="#addmailmodal">Add Email</button>  
                    </div>
                  
                    <div class="panel-content">
                        <table class="table table-bordered"id="emailTable" style="display:none">
                            <thead>
                                <tr>
                                    <th><b>To</b></th>
                                    <th><b>Cc</b></th>
                                    <th><b>Role</b></th>
                                    <th><b>Email</b></th>
                                </tr>
                            </thead>
                            <tbody id="emailTableBody">
                                <!-- <tr>
                                    <td><input type="checkbox" class="checkbox-to"></td>
                                    <td><input type="checkbox" class="checkbox-cc"></td>
                                    <td>Insurer</td>
                                    <td>insurer@gmail.com</td>
                                </tr> -->
                            </tbody>
                        </table>
                       
                         <!-- <div id="lorSentMessage" <?php echo ($lorStatus == 1) ? '' : 'style="display:none;"'; ?>>
                            Lor has been sent to: <span id="sentEmails"></span>
                        </div> -->
                                
                        <!-- Modal for Add Email -->
                        <div id="addmailmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Email</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex">
                                            <span class="label-text col-md-3 col-form-label ">Role:</span>
                                            <div class="col-md-7 form-group ">
                                                <select id="userRole" name="select" class="form-control">
                                                    <option value="other">Other</option>
                                                    <option value="Internal Inspector">Internal Inspector</option>
                                                    <option value="External Inspector">External Inspector</option>
                                                    <option value="Reporting">Reporting</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <span class="label-text col-md-3 col-form-label">Access Mail:</span>
                                            <div class="col-md-7">
                                                <input type="email" id="userEmail" name="email" class="form-control" placeholder="email@example.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3" style="align-self:flex-end;">
                                        <button type="button" class="btn btn-default mr-1" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="showTable()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7"> 
                <div class="panel pb-5">
                    <div class="panel-heading d-flex pl-0 pr-0">
                        <h3 class="panel-title col-md-6">
                            LOR Preview
                        </h3> 
                        <div class="form-group col-md-6 d-flex" style="align-items: baseline;">
                            <span class="label-text col-form-label" style="padding-right:20px;font-size:14px;"><b>Translate</b></span>
                            <select id="language-selector" name="select" class="form-control">
                                <option value="">Select Language</option>
                                <option data-language="en">English</option>
                                <!-- <option data-language="hi">Hindi</option>
                                <option data-language="bn">Bengali</option>
                                <option data-language="gu">Gujarati</option>
                                <option data-language="kn">Kannada</option>
                                <option data-language="ml">Malayalam</option>
                                <option data-language="mr">Marathi</option>
                                <option data-language="pa">Punjabi</option>
                                <option data-language="ta">Tamil</option>
                                <option data-language="te">Telugu</option> -->
                            </select>
                        </div>
                    </div>
                    
                    <div class="panel-content">
                        <form id="mailForm" method="POST" action="<?php echo base_url('assignment/preview_pdf'); ?>" target="_blank"> 
                            <input type="hidden" name="aid" value="<?php echo $aid; ?>">
                            <div class="d-flex mb-2">
                                <span class="label-text col-md-2 col-form-label">Subject:</span>
                                <div class="col-md-10">
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Mail Subject" required>
                                </div>
                            </div>
                            <textarea class="form-control" id="questionsTextarea" rows="15" style="white-space: wrap;" name="questions"></textarea>
                            <div class="form-group mt-2 row">
                                <div class="col-md-10 form-inline">
                                    <label class="form-check">
                                        <input type="checkbox" value="specialNote" class="form-check-input" id="specialNoteRadio" onclick="toggleSpecialNote();">
                                        <span class="form-check-label">Special Note</span>
                                    </label>
                                </div>        
                                <div class="col-md-2 row">
                                    <button type="submit" class="btn btn-rounded btn-success float-right" id="previewButton">Preview</button>
                                </div>                         
                            </div>

                            <div class="form-group mt-2 row" id="specialNoteContainer" style="display: none;">
                                <div class="col-md-12">
                                    <label for="specialNoteTextarea">Please enter your special note:</label>
                                    <textarea id="specialNoteTextarea" class="form-control" rows="4" name="special_note"></textarea>
                                </div>                               
                            </div>
                        </form>
                        
                        <div class="form-group">
                            <div class="mt-2">
                                <label for="date_of_letter">Date of Letter</label>
                                <input type="date" id="date_of_letter" name="date_of_letter" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                            </div>
                        </div>

                        <div class="form-group mt-2 row">
                            <span class="label-text col-md-12 col-form-label">Send Mail</span>
                            <div class="col-md-12 form-inline">
                                <label class="form-check mr-5">
                                    <input type="checkbox" name="sent_today" id="sent_today" value="1" class="form-check-input">
                                    <span class="form-check-label">Send Mail Today</span>
                                </label>
                                <label class="form-check mr-5">
                                    <input type="checkbox" name="mail_automation" value="2" id="mail_automation_checkbox" class="form-check-input">
                                    <span class="form-check-label">Mail Automation</span>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="autoMailToggle" style="display:none;" disabled>
                                    <div class="slider round" ></div>
                                    <span style="font-size:14px;">Auto Mail Send</span>
                                </label>
                            </div>
                        </div>
                        <div id="mail_automation" style="display:none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            <span class="label-text">Date of Next Reminder</span>
                                            <input type="date" id="datenextreminder" name="" class="form-control" required>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="autoMailFields" style="display: none;">
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <span class="label-text">Frequency(day)</span>
                                            <input type="number" id="frequencyInput" name="frequency" class="form-control" min="1" max="30" required>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <span class="label-text">Number of reminder</span>
                                            <input type="number" id="reminderCountInput" name="reminderCount" class="form-control" min="1" max="25" required>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="color:green;">
                                    Next Reminder Dates
                                    <div id="reminderContainer" class="reminder-container"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="nextReminderField" style="display: none;" class="row"> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Date of Next Reminder</span>
                                        <input type="date" id="nextReminderInput" name="nextReminder" class="form-control" required>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- <button type="submit" class="btn btn-rounded btn-success float-right" id="mailsend">Submit</button> -->
                        <button type="submit" class="btn btn-rounded btn-success float-right" onclick="submitForm()" >Submit</button>
                    </div>
                </div>   
            </div>   
        </div>
    </section>
    
    
    <?php $this->load->view('adminpanel/layout/footer');?>
    <script type="text/javascript">

    // Define header content as plain text for textarea
    var headerText =`Dear Sir/Madam,
    This is continuation to the appointment in the case on 04/04/2023 regarding the insurance claim lodged by you. Please note the requirements in this case as under.
    \n`;
    // Define footer content without username and date
    var footerText = `
    This is a computer-generated communication sent to you on behalf of VP Singhal and Co ISLA Pvt Ltd.\nIssued without prejudice.\n
    All communications are privileged and for use by intended persons only.\n
    Thanking You\n`;
   
        $(document).ready(function () {
            $('#language-selector').on('change', function () {
                const targetLang = $('#language-selector').val();
                const textToTranslate = $('#questionsTextarea').val();

                if (!targetLang) {
                    alert('Please select a language.');
                    return;
                }

                if (!textToTranslate.trim()) {
                    alert('Please enter text to translate.');
                    return;
                }

                // Make AJAX call to the CodeIgniter controller
                $.ajax({
                    url: "<?php echo base_url('setting/translate_text'); ?>", 
                    type: "POST",
                    dataType: "json",
                    data: {
                        text: textToTranslate,
                        source: "en",
                        target: targetLang
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#questionsTextarea').val(response.translated_text);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Detailed error handling
                        console.error('AJAX Error: ' + status + ': ' + error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });


    function showTable() {
    $('#emailTable').show();
    }
        function showAlert(message) {
            alert(message);
        }
        function clearInputs(...inputs) {
            inputs.forEach(input => input.value = '');
        }

        function appendEmailRow(role, email) {
            const newRow = ` 
                <tr>
                    <td><input type="checkbox"></td>
                    <td><input type="checkbox"></td>
                    <td style="width: 9%">${role}</td>
                    <td style="width: 9%">${email}</td>
                </tr>
            `;
            $('#emailTableBody').append(newRow);
        }


        //reset add email modal fields
        $('#addmailmodal').on('show.bs.modal', function () {
            $('#userRole').val('other'); 
            $('#userEmail').val('');     
        });

        // Function to add email from the modal to the table      
        $('#submitBtn').click(function () {
            var role = $('#userRole').val();  
            var email = $('#userEmail').val().trim();
            
            // Regular expression for email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Validation
            if (!role) {
                alert('Please select a role.');
                return;
            }
            if (!email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Email',
                    text: 'Please enter an email address.'
                });
                return;
            }
            if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.'
                });
                return;
            }

            // If validation passes, append the new row
            var row = `<tr>
                <td><input type="checkbox" class="checkbox-to"></td>
                <td><input type="checkbox" class="checkbox-cc"></td>
                <td style="width: 9%">${role}</td>
                <td style="width: 9%" >${email}</td>
            </tr>`;
            $('#emailTableBody').append(row);

            // Close modal and reset the form
            $('#addmailmodal').modal('hide');
            $('#userRole').val('');
            $('#userEmail').val('');
        });
        

        function submitForm() {
            var aid = '<?php echo $aid; ?>';  
            var sentTo = [];  
            var Subject = $('#subject').val(); 
            var dateOfLetter = $('#date_of_letter').val(); 
            var questions = $('#questionsTextarea').val().split('\n');
            var questionsText =questions.join('\n');
            var emailBody = questionsText.replace(/\n/g, '<br>');
            // const formData = $('#mailForm').serialize();
            console.log(Subject)
            $('#emailTableBody tr').each(function () {
                var toChecked = $(this).find('.checkbox-to').is(':checked');
                var ccChecked = $(this).find('.checkbox-cc').is(':checked');
                var role = $(this).find('td').eq(2).text().trim();  
                var email = $(this).find('td').eq(3).text().trim(); 
                var row = {}; 

                if (toChecked) {
                    row.to = email;
                }

                if (ccChecked) {
                    row.cc = email;
                }

                if (toChecked || ccChecked) {
                    row.role = role;
                    sentTo.push(row);  
                }
            
            });

            var sentToJson = JSON.stringify(sentTo);
            // Check if `sentTo` is empty
            if (sentTo.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Receivers Information',
                    text: 'Please select at least one receiver before submitting the form.'
                });
                return; // Stop the form submission process
            }

        
            var specialNote = document.getElementById('specialNoteTextarea').value; 
           
            if (specialNote) {
                emailBody += "<br><strong>Special Note:</strong><br>" + specialNote.replace(/\n/g, '<br>');  
            }

            // emailBody += "<br><br>" + footerText.replace(/\n/g, '<br>');

            var Subject = $('#subject').val(); 
            var dateOfLetter = $('#date_of_letter').val(); 

            // Get the values for the auto mail settings if enabled
            var autoMailEnabled = $('#autoMailToggle').is(':checked');
            var automailFix = null;

            var sendtoday = $('#sent_today').is(':checked');
            var sentDate = sendtoday ? new Date().toISOString().split('T')[0] : null;

            if ($('#mail_automation_checkbox').is(':checked')) {
                var nextReminderDate = $('#datenextreminder').val(); 
            } else {
                var nextReminderDate = null; 
            }

            if (autoMailEnabled) {
                // Calculate the reminder dates
                var reminderDates = calculateReminders();
                automailFix = {
                    frequency: $('#frequencyInput').val(),
                    reminderCount: $('#reminderCountInput').val(),
                    reminderDates: reminderDates
                };
            }
            $.ajax({
                url: '<?php echo base_url('assignment/submit_viewlor'); ?>',
                type: 'POST',
                data: {
                    aid: aid,
                    sent_to: sentToJson,
                    special_note: specialNote,
                    subject: Subject,
                    date_of_letter: dateOfLetter,
                    automail_fix: JSON.stringify(automailFix),
                    sent_date: sentDate,
                    mail_automation: nextReminderDate,
                    questions: JSON.stringify(questions) ,
                    email_body: emailBody
                    
                },
                success: function (response) {
                   var res = JSON.parse(response);
                    if (res.status === 'success') {
                        var sentToEmails = sentTo.map(item => item.to || item.cc).filter(email => email).join(', ');
                        console.log('Emails to be sent:', sentToEmails);
                        Swal.fire({
                            icon: 'success',
                            title: 'LOR Sent Successfully to:',
                            html: `${sentToEmails}`,
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Submission Failed',
                            text: res.message
                        });
                    }
                },

                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);  
                }
            });
        }
        
        function toggleSpecialNote() {
            const specialNoteContainer = document.getElementById('specialNoteContainer');
            specialNoteContainer.style.display = specialNoteContainer.style.display === 'none' ? 'block' : 'none';
        }
        
        // Reminder calculations
        function calculateReminders() {
            const frequency = parseInt(document.getElementById('frequencyInput').value);
            const numberOfReminders = parseInt(document.getElementById('reminderCountInput').value);
            const reminderContainer = document.getElementById('reminderContainer');
            reminderContainer.innerHTML = ''; 
            let reminderDates = []; 
            if (frequency && numberOfReminders) {
                const today = new Date();
                for (let i = 1; i <= numberOfReminders; i++) {
                    const reminderDate = new Date(today);
                    reminderDate.setDate(today.getDate() + (i * frequency)); 
                    const formattedDate = reminderDate.toISOString().split('T')[0]; 
                    reminderDates.push(formattedDate);
                    const reminderItem = createReminderItem(formattedDate); 
                    reminderContainer.appendChild(reminderItem);
                }
            }
            return reminderDates; 
        }

        // Function to create a reminder item
        function createReminderItem(formattedDate) {
            const reminderItem = document.createElement('div');
            reminderItem.className = 'reminder-item';

            // Create input field for the reminder date
            const reminderInput = document.createElement('input');
            reminderInput.type = 'text';
            reminderInput.value = formattedDate;
            reminderInput.className = 'reminder-input';
            reminderInput.readOnly = true;

            // Create a cross icon to remove the reminder
            const removeIcon = document.createElement('span');
            removeIcon.innerHTML = '<i class="fa fa-times remove-icon"></i>';
            removeIcon.onclick = function() {
                reminderItem.remove(); 
            };

            // Append the input and icon to the reminder item
            reminderItem.appendChild(reminderInput);
            reminderItem.appendChild(removeIcon);
            return reminderItem;
        }

        // Attach event listeners for input changes to calculate reminders
        document.getElementById('frequencyInput').addEventListener('input', calculateReminders);
        document.getElementById('reminderCountInput').addEventListener('input', calculateReminders);
        document.getElementById('specialNoteRadio').addEventListener('change', function() {
            document.getElementById('specialNoteContainer').style.display = this.checked ? 'block' : 'none';
        });

        // to fetch question ids from URL
        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
            var results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
      
        $('#autoMailToggle').change(function() {
            if ($(this).is(':checked') && $('#mail_automation_checkbox').is(':checked')) {
                $('#autoMailFields').show();
                $('#nextReminderField').hide();
                $('#mail_automation').hide();
            } else {
                $('#autoMailFields').hide();
                $('#nextReminderField').hide();
                $('#mail_automation').hide();
            }
        });

        $('#mail_automation_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#mail_automation').slideDown(); 
                $('#autoMailToggle').prop('disabled', false);
            } else {
                $('#mail_automation').slideUp(); 
                $('#autoMailToggle').prop('disabled', true); 
                $('#autoMailFields').hide();
                $('#nextReminderField').hide(); 
                $('#mail_automation').hide();
                $('#autoMailToggle').prop('checked', false);
            }
        });


    // function addRemove(){
    //     const myDiv =document.getElementById('mainContainer');
    //     const deleteIcon =document.getElementById('delete-button');
    //     $('.question-box').each(function () {
    //             myDiv.style.pointerEvents = 'auto';
    //         myDiv.style.cursor = 'auto';
    //         deleteIcon.style.pointerEvents = 'auto';
    //         deleteIcon.style.cursor = 'auto';
    //         });
    // }

$(document).ready(function () {
    var aid = '<?php echo $aid; ?>';
    var questionIds = getParameterByName('question_ids');
    var selectedQuestionIds = questionIds ? questionIds.split(',') : [];
    var fixedContent = $('#questionsTextarea').val();
    var questionCount = 1;

    // Fetch questions from the server
    $.ajax({
        url: "<?php echo base_url('assignment/fetchInsertedQuestions/'); ?>" + aid,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                var questions = response.questions;
                var questionsHTML = '';
                var questionsText = headerText;
                var username = response.username; 
                var currentDate = new Date().toISOString().split('T')[0];
                footerText += `\n${username}\nDate: ${currentDate}`;

                if (questions && questions.length > 0) {
                    $.each(questions, function (index, question) {
                        let descriptions = [];

                        if (Array.isArray(question.description)) {
                            descriptions = question.description;
                        } else if (typeof question.lor === "string") {
                            try {
                                descriptions = JSON.parse(question.lor);
                            } catch (error) {
                                console.error('Failed to parse lor:', error);
                            }
                        }

                        $.each(descriptions, function (i, item) {
                            const description = typeof item === "string" ? item : item.description;
                            const questionId = item.id || question.id;
                            if (typeof description === "string" && description.trim()) {
                                const deleteIcon = `<i class="fas fa-trash" style="cursor:pointer;color:red;" onclick="deleteQuestion('${questionId}', ${index}, ${i})"></i>`;
                                // questionsHTML += `
                                // <div class="input-group">
                                //     <div class="question-box" id="question-box-${questionId}">
                                //         <label class="form-check">
                                //             <input type="checkbox" value="${description}" class="form-check-input">
                                //             <span class="form-check-label question-text" contenteditable="true" id="question-text-${questionId}">
                                //                 ${description} ${deleteIcon}
                                //             </span>
                                //         </label>
                                //         <input type="hidden" value="${questionId}" />
                                //     </div>
                                // `;

                                questionsHTML +=`
                                <div class="input-group" style="pointer-events: none; cursor: none;"  id="mainContainer">
                                    <div class="question-box" id="question-box-${questionId}">
                                        <div style="border-right: 2px solid black;">
                                                <label class="form-check">
                                                    <input type="checkbox" value="${description}" class="form-check-input">
                                                    <span class="form-check-label question-text" contenteditable="false" id="question-text-${questionId}">                
                                                    </span>
                                                </label>
                                         </div>
                                        <div style="margin:0px 20px 0px 20px;">
                                            <label class="form-chec question-text" contenteditable="false" id="question-text-${questionId}">
                                                    ${description} 
                                            </label>
                                        </div>
                                        <div style="border-left: 2px solid black; " id="delete-button">
                                            <div style="margin-left:10px;" >${deleteIcon}</div>
                                         </div> 
                                        <input type="hidden" value="${questionId}" />
                                    </div>
                                `;
                                // <div class="input-group">
                                //                 <div class="input-group-append">
                                //                     <span class="input-group-text">.00</span>
                                //                 </div>
                                //                 <input type="text" name="text" class="form-control">

                                //                 <div class="input-group-append">
                                //                     <span class="input-group-text">${deleteIcon}</span>
                                //                 </div>
                                //         </div>
                                questionsText += `${questionCount}. ${description}\n`;
                                questionCount++;
                            }
                        });
                    });
                   
                    questionsText += footerText;
                    // questionsText += specialNote + "\n" + footerText;
                    $('#questionsTextarea').val(fixedContent + '\n' + questionsText.trim());
                   
                } else {
                    questionsText += `No questions found.\n${footerText}`;
                    $('#questionsTextarea').val(fixedContent + '\n' + questionsText.trim());
                }

                $('#questionsContainer').html(questionsHTML);
            } else {
                console.error('Failed to fetch questions:', response.message);
            }

        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while fetching the questions.');
        }
    });
    
    // Handle edit button click
    $('#editButton').on('click', function () {
        var isEditing = $(this).text().trim() === 'Save';
        var updatedQuestions = [];
        if (isEditing){
            $(this).text('Edit');
            $('.question-text').attr('contenteditable', 'false');
            //this is for lock the questiontext of container added by anish mukharjee
            const myDiv =document.getElementById('mainContainer'); 
            myDiv.style.pointerEvents = 'none';
            myDiv.style.cursor = 'none';
            var updatedQuestionsText = headerText;
            var questionCount = 1;

            $('.question-box').each(function () {
                var updatedText = $(this).find('.question-text').text().trim();
                var questionId = $(this).find('input[type="hidden"]').val(); 
                if (updatedText) {
                    updatedQuestions.push({ id: questionId, description: updatedText });
                    updatedQuestionsText += `${questionCount}. ${updatedText}\n`;
                    questionCount++;
                }
            });

            updatedQuestionsText += footerText; 
            $('#questionsTextarea').val(updatedQuestionsText.trim());

            $.ajax({
                url: "<?php echo base_url('assignment/updatequestions'); ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    aid: aid,
                    description: updatedQuestions,
                }),
                success: function (response) {
                    if (response.status === 'success') {
                        // console.log('Questions updated successfully.');
                    } else {
                        // console.log('Questions not updated successfully.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while updating the questions.');
                }
            });
            location.reload();
        } else {
            $(this).text('Save');
            $('.question-text').attr('contenteditable', 'true');
            //this is for unlock the question of maincontainer by anish mukharjee
            const myDiv =document.getElementById('mainContainer');
            myDiv.style.pointerEvents = 'auto';
            myDiv.style.cursor = 'auto';
            $('.question-box').each(function() { //added this
            $(this).css('pointer-events', 'auto'); //added this
            $(this).css('cursor', 'auto');  //added this
            });
            
        }
    });

    // Handle saving new questions
    // $('#saveQuestionBtn').on('click', function () {
    //     var newQuestion = $('#newQuestion').val().trim();
    //     var uid = '<?php echo $this->session->userdata('id'); ?>';
        
    //     if (newQuestion) {
    //         $.ajax({
    //             url: 'assignment/addnewtitle',
    //             type: 'POST',
    //             data: {
    //                 aid: aid,
    //                 uid: uid,
    //                 newQuestion: newQuestion,  
    //             },
    //             dataType: "json",
    //             success: function (response) {
    //                 if (response.success) {
    //                     addQuestionToUI(newQuestion);
                        
    //                     $('#newQuestion').val('');
    //                     $('#addLorTitle').modal('hide');
    //                 } else {
    //                     alert(response.error || 'An error occurred while saving the question.');
    //                 }
    //             },
    //             error: function () {
    //                 alert('Error saving question to the database.');
    //             }
    //         });
    //     } else {
    //         alert("Please enter a valid question before saving.");
    //     }
    // });


    //updated Handle saving new questions by anish mukharjee
    // Handle saving new LOR title
    $('#saveQuestionBtn').on('click', function () {
        var newQuestion = $('#newQuestion').val().trim();
        var uid = '<?php echo $this->session->userdata('id'); ?>';

        if (newQuestion) {
            $.ajax({
                url: 'assignment/addnewtitle',
                type: 'POST',
                data: {
                    aid: aid,
                    uid: uid,
                    newLorTitle: newQuestion, // Changed the parameter name to be more specific
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        addQuestionToUI(newQuestion); // Keep this for UI update
                        $('#newQuestion').val('');
                        $('#addLorTitle').modal('hide');
                    } else {
                        alert(response.error || 'An error occurred while saving the LOR title.');
                    }
                },
                error: function () {
                    alert('Error saving LOR title to the database.');
                }
            });
        } else {
            alert("Please enter a valid title before saving.");
        }
    });

    
    // function addQuestionToUI(newQuestion) {
    //     if (newQuestion && newQuestion.trim()) {
    //         var questionHTML = `
    //             <div class="question-box">
    //                 <label class="form-check">
    //                     <input type="checkbox" value="${newQuestion}" class="form-check-input">
    //                     <span class="form-check-label question-text" contenteditable="true">
    //                         ${newQuestion}  
    //                     </span>
    //                 </label>
    //             </div>
    //         `;
    //         $('#questionsContainer').append(questionHTML);

    //         var textareaContent = $('#questionsTextarea').val().trim();
    //         var footerStartIndex = textareaContent.indexOf(footerText.trim());

    //         if (footerStartIndex === -1) {
    //             textareaContent += `\n${questionCount}. ${newQuestion}`;
    //         } else {
    //             var beforeFooter = textareaContent.substring(0, footerStartIndex).trim();
    //             var afterFooter = textareaContent.substring(footerStartIndex);

    //             var updatedQuestions = beforeFooter.split('\n').filter(line => line.match(/^\d+\./));
    //             questionCount = updatedQuestions.length + 1;

    //             beforeFooter += `\n${questionCount}. ${newQuestion}`;
    //             textareaContent = beforeFooter.trim() + '\n' + afterFooter.trim();
    //         }

    //         $('#questionsTextarea').val(textareaContent);
    //         questionCount++;
    //     }
        
    // }
});

//this function is modified for add delete button on ui by anish mukharjee
function addQuestionToUI(newQuestion) {
    if (newQuestion && newQuestion.trim()) {
        const questionId = 'q' + new Date().getTime(); // Unique ID for new question
        const deleteIcon = `<i class="fas fa-trash" style="cursor:pointer;color:red;" onclick="deleteQuestion('${questionId}')"></i>`;
        
        const questionHTML = `
            <div class="question-box" id="question-box-${questionId}">
                <label class="form-check">
                    <input type="checkbox" value="${newQuestion}" class="form-check-input">
                    <span class="form-check-label question-text" contenteditable="true" id="question-text-${questionId}">
                        ${newQuestion} ${deleteIcon}
                    </span>
                </label>
                <input type="hidden" value="${questionId}" />
            </div>
        `;

        $('#questionsContainer').append(questionHTML);

        let textareaContent = $('#questionsTextarea').val().trim();
        let footerStartIndex = textareaContent.indexOf(footerText.trim());

        if (footerStartIndex === -1) {
            textareaContent += `\n${questionCount}. ${newQuestion}`;
        } else {
            let beforeFooter = textareaContent.substring(0, footerStartIndex).trim();
            let afterFooter = textareaContent.substring(footerStartIndex);

            let updatedQuestions = beforeFooter.split('\n').filter(line => line.match(/^\d+\./));
            questionCount = updatedQuestions.length + 1;

            beforeFooter += `\n${questionCount}. ${newQuestion}`;
            textareaContent = beforeFooter.trim() + '\n' + afterFooter.trim();
        }

        $('#questionsTextarea').val(textareaContent);
        questionCount++;
    }
    location.reload();
}


// function deleteQuestion(questionId, questionIndex, descriptionIndex) {
//     var aid = '<?php echo $aid; ?>';
//     var requestData = {
//         aid: aid,
//         question_id: questionId,
//     };
//     $.ajax({
//         url: "<?php echo base_url('assignment/deleteQuestion'); ?>",
//         type: "POST",
//         contentType: "application/json",
//         data: JSON.stringify(requestData),
//         success: function(response) {
//             $('#question-box-' + questionId).remove();
//             location.reload();
//         },
//         error: function(xhr, status, error) {
//             console.error('Error:', error);
//             alert('An error occurred while deleting the question.');
//         }
//     });
// }

//this function is updated for delete button by anish mukharjee
function deleteQuestion(questionId, questionIndex = null, descriptionIndex = null) {
    // If questionId starts with 'q' and is not numeric, treat it as client-only
    if (questionId.startsWith('q')) {
        // Remove from DOM
        $('#question-box-' + questionId).remove();

        // Optionally remove from textarea
        let currentText = $('#questionsTextarea').val();
        let lines = currentText.split('\n').filter(line => !line.includes(questionId));
        $('#questionsTextarea').val(lines.join('\n'));
        return; // No need to call the server
    }

    var aid = '<?php echo $aid; ?>';
    var requestData = {
        aid: aid,
        question_id: questionId,
    };

    $.ajax({
        url: "<?php echo base_url('assignment/deleteQuestion'); ?>",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(requestData),
        success: function(response) {
            $('#question-box-' + questionId).remove();
             
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while deleting the question.');
        }
    });
}

    </script>
    