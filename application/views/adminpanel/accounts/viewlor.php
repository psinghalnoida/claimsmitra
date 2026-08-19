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
    .question-box.received {
        background: #f3f8f4;
        opacity: 0.75;
    }
   
   
</style>
<?php
$lorRow = isset($lorRow) && is_array($lorRow) ? $lorRow : array();
$lorParties = isset($lorParties) && is_array($lorParties) ? $lorParties : array();
$ourRef = isset($ourRef) ? $ourRef : $aid;
$lorReminderDays = !empty($lorReminderDays) ? $lorReminderDays : array(3, 7, 14, 30);
$appointmentSubject = $lorRow['appointment_subject'] ?? '';
$mailSubjectPrefill = !empty($lorRow['mail_subject']) ? $lorRow['mail_subject'] : '';
$freqSelected = (int) ($lorRow['reminder_frequency_days'] ?? 7);
$nextDueOn = $lorRow['next_due_on'] ?? '';
?>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <!-- <?php $this->load->view('adminpanel/jobs/locationbasedjob/heading');?> -->
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata');?>
        </div>
    </div>
    <section class="main--content" style="border: 1px solid #E5E4E2; margin-left: 15px;margin-right:15px;padding-top: 0px;">
        <?php if (isset($requiresLor) && !$requiresLor) { ?>
        <div class="alert alert-info" style="margin:15px;">This job’s <strong>field template</strong> says skip LOR. You can still prepare one if the insurer asks, but it is not required on the path.</div>
        <?php } ?>
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
                        <h3 class="panel-title">Appointment mail &amp; people</h3>
                    </div>
                    <div class="panel-content">
                        <p class="text-muted" style="font-size:13px;">Paste the appointment mail (Subject, To, Cc, Bcc). We store the people so you can pick To / Cc / Bcc each send. Subject stays the appointment thread plus our ref.</p>
                        <textarea id="appointmentPaste" class="form-control mb-2" rows="5" placeholder="Subject: ...&#10;To: name@insurer.com, Jane &lt;jane@broker.com&gt;&#10;Cc: desk@office.com"></textarea>
                        <button type="button" class="btn btn-rounded btn-info mb-3" id="parseAppointmentBtn">Parse &amp; save people</button>
                        <div class="d-flex mb-2">
                            <span class="label-text col-md-4 col-form-label">Appointment subject</span>
                            <div class="col-md-8">
                                <input type="text" id="appointment_subject" class="form-control" value="<?php echo htmlspecialchars($appointmentSubject, ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <span class="label-text col-md-4 col-form-label">Our ref</span>
                            <div class="col-md-8">
                                <input type="text" id="our_ref" class="form-control" value="<?php echo htmlspecialchars($ourRef, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                            </div>
                        </div>
                        <table class="table table-bordered" id="emailTable">
                            <thead>
                                <tr>
                                    <th><b>To</b></th>
                                    <th><b>Cc</b></th>
                                    <th><b>Bcc</b></th>
                                    <th><b>Name / role</b></th>
                                    <th><b>Email</b></th>
                                </tr>
                            </thead>
                            <tbody id="emailTableBody"></tbody>
                        </table>
                        <button class="btn btn-rounded btn-default mt-1" data-toggle="modal" data-target="#addmailmodal">Add Email</button>
                        <button type="button" class="btn btn-rounded btn-success mt-1" id="savePartiesBtn">Save To / Cc / Bcc</button>
                    </div>
                </div>
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
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Appointment subject / Our Ref" required value="<?php echo htmlspecialchars($mailSubjectPrefill, ENT_QUOTES, 'UTF-8'); ?>">
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

                        <div class="form-group mt-2">
                            <label>Remind me on dashboard every</label>
                            <div class="d-flex">
                                <select id="frequencyInput" name="frequency_days" class="form-control" style="max-width:160px;">
                                    <?php foreach ($lorReminderDays as $d) { ?>
                                        <option value="<?php echo (int) $d; ?>" <?php echo ($freqSelected === (int) $d) ? 'selected' : ''; ?>><?php echo (int) $d; ?> days</option>
                                    <?php } ?>
                                </select>
                                <button type="button" class="btn btn-rounded btn-info ml-2" id="saveReminderBtn">Save reminder</button>
                            </div>
                            <p class="text-muted mt-2" style="font-size:13px;">When due, this file shows on the dashboard. Open it, tick documents received, then send LOR for what is still pending. We do not auto-email.</p>
                            <p id="nextDueLabel" style="font-size:13px;"><?php echo $nextDueOn ? ('Next dashboard reminder: ' . htmlspecialchars($nextDueOn, ENT_QUOTES, 'UTF-8')) : 'No reminder set yet.'; ?></p>
                        </div>
                        <button type="submit" class="btn btn-rounded btn-success float-right" onclick="submitForm()" >Send pending LOR</button>
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

        function appendEmailRow(name, email, sendAs) {
            sendAs = sendAs || 'cc';
            const rowKey = email.replace(/"/g, '');
            const newRow = `
                <tr data-email="${rowKey}">
                    <td><input type="radio" name="sendas-${rowKey}" class="radio-to" value="to" ${sendAs === 'to' ? 'checked' : ''}></td>
                    <td><input type="radio" name="sendas-${rowKey}" class="radio-cc" value="cc" ${sendAs === 'cc' ? 'checked' : ''}></td>
                    <td><input type="radio" name="sendas-${rowKey}" class="radio-bcc" value="bcc" ${sendAs === 'bcc' ? 'checked' : ''}></td>
                    <td class="party-name">${name || ''}</td>
                    <td class="party-email">${email}</td>
                </tr>
            `;
            $('#emailTableBody').append(newRow);
        }

        function renderParties(parties) {
            $('#emailTableBody').empty();
            (parties || []).forEach(function (p) {
                appendEmailRow(p.name || p.header_kind || p.role || '', p.email, p.send_as);
            });
        }

        function collectPartiesFromTable() {
            var parties = [];
            $('#emailTableBody tr').each(function () {
                var email = $(this).find('.party-email').text().trim();
                var name = $(this).find('.party-name').text().trim();
                var sendAs = $(this).find('input[type=radio]:checked').val() || 'cc';
                if (email) {
                    parties.push({ name: name, email: email, send_as: sendAs, header_kind: name });
                }
            });
            return parties;
        }

        function collectSentTo() {
            var sentTo = [];
            collectPartiesFromTable().forEach(function (p) {
                if (p.send_as === 'none') {
                    return;
                }
                var row = { role: p.name };
                row[p.send_as] = p.email;
                sentTo.push(row);
            });
            return sentTo;
        }

        var initialLorParties = <?php echo json_encode($lorParties); ?>;
        renderParties(initialLorParties);


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
            var row = `<tr data-email="${email}">
                <td><input type="radio" name="sendas-${email}" class="radio-to" value="to" checked></td>
                <td><input type="radio" name="sendas-${email}" class="radio-cc" value="cc"></td>
                <td><input type="radio" name="sendas-${email}" class="radio-bcc" value="bcc"></td>
                <td class="party-name">${role}</td>
                <td class="party-email">${email}</td>
            </tr>`;
            $('#emailTableBody').append(row);

            // Close modal and reset the form
            $('#addmailmodal').modal('hide');
            $('#userRole').val('');
            $('#userEmail').val('');
        });
        

        function submitForm() {
            var aid = '<?php echo $aid; ?>';  
            var sentTo = collectSentTo();
            var Subject = $('#subject').val(); 
            var dateOfLetter = $('#date_of_letter').val(); 
            var specialNote = document.getElementById('specialNoteTextarea').value; 
            var emailBody = $('#questionsTextarea').val().replace(/\n/g, '<br>');
            if (specialNote) {
                emailBody += "<br><strong>Special Note:</strong><br>" + specialNote.replace(/\n/g, '<br>');  
            }

            if (sentTo.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing receivers',
                    text: 'Mark at least one person as To, Cc, or Bcc.'
                });
                return;
            }
            var hasTo = sentTo.some(function (r) { return !!r.to; });
            if (!hasTo) {
                Swal.fire({
                    icon: 'error',
                    title: 'Need a To address',
                    text: 'Mark one person as To. Others can be Cc or Bcc.'
                });
                return;
            }

            $.ajax({
                url: '<?php echo base_url('assignment/submit_viewlor'); ?>',
                type: 'POST',
                data: {
                    aid: aid,
                    sent_to: JSON.stringify(sentTo),
                    special_note: specialNote,
                    subject: Subject,
                    appointment_subject: $('#appointment_subject').val(),
                    date_of_letter: dateOfLetter,
                    frequency_days: $('#frequencyInput').val(),
                    email_body: emailBody
                },
                success: function (response) {
                   var res = JSON.parse(response);
                    if (res.status === 'success') {
                        var sentToEmails = sentTo.map(item => item.to || item.cc).filter(email => email).join(', ');
                        console.log('Emails to be sent:', sentToEmails);
                        Swal.fire({
                            icon: 'success',
                            title: 'LOR sent (pending docs only)',
                            html: `${sentToEmails}<br><small>Next dashboard reminder: ${res.next_due_on || ''}</small>`,
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
                                const received = !!(item && item.received);
                                const receivedChecked = received ? 'checked' : '';
                                const receivedClass = received ? ' received' : '';
                                const deleteIcon = `<i class="fas fa-trash" style="cursor:pointer;color:red;" onclick="deleteQuestion('${questionId}', ${index}, ${i})"></i>`;

                                questionsHTML +=`
                                <div class="input-group" style="pointer-events: none; cursor: none;"  id="mainContainer">
                                    <div class="question-box${receivedClass}" id="question-box-${questionId}">
                                        <div style="border-right: 2px solid black; pointer-events: auto; cursor: auto;">
                                                <label class="form-check" style="margin:0;">
                                                    <input type="checkbox" class="form-check-input received-check" data-id="${questionId}" ${receivedChecked}>
                                                    <span class="form-check-label" style="font-size:11px;">Received</span>
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
                                if (!received) {
                                    questionsText += `${questionCount}. ${description}\n`;
                                    questionCount++;
                                }
                                // <div class="input-group">
                                //                 <div class="input-group-append">
                                //                     <span class="input-group-text">.00</span>
                                //                 </div>
                                //                 <input type="text" name="text" class="form-control">

                                //                 <div class="input-group-append">
                                //                     <span class="input-group-text">${deleteIcon}</span>
                                //                 </div>
                                //         </div>
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
                bindReceivedChecks();
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

    $('#parseAppointmentBtn').on('click', function () {
        $.ajax({
            url: '<?php echo base_url('assignment/parse_appointment_mail'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { aid: aid, raw: $('#appointmentPaste').val() },
            success: function (res) {
                if (res.status === 'success') {
                    $('#appointment_subject').val(res.subject || '');
                    $('#subject').val(res.mail_subject || '');
                    $('#our_ref').val(res.our_ref || '');
                    renderParties(res.parties || []);
                    Swal.fire({ icon: 'success', title: 'People saved', text: (res.parties || []).length + ' address(es) from the appointment mail.' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Could not parse', text: res.message || '' });
                }
            }
        });
    });

    $('#savePartiesBtn').on('click', function () {
        $.ajax({
            url: '<?php echo base_url('assignment/save_lor_parties'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { aid: aid, parties: JSON.stringify(collectPartiesFromTable()) },
            success: function (res) {
                if (res.status === 'success') {
                    Swal.fire({ icon: 'success', title: 'To / Cc / Bcc saved' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Save failed', text: res.message || '' });
                }
            }
        });
    });

    $('#saveReminderBtn').on('click', function () {
        $.ajax({
            url: '<?php echo base_url('assignment/save_lor_reminder'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { aid: aid, frequency_days: $('#frequencyInput').val() },
            success: function (res) {
                if (res.status === 'success') {
                    $('#nextDueLabel').text('Next dashboard reminder: ' + res.next_due_on);
                    Swal.fire({ icon: 'success', title: 'Reminder set', text: 'Due on the dashboard on ' + res.next_due_on });
                } else {
                    Swal.fire({ icon: 'error', title: 'Could not save reminder', text: res.message || '' });
                }
            }
        });
    });

    function bindReceivedChecks() {
        $('.received-check').off('change').on('change', function () {
            var box = $(this);
            var qid = box.data('id');
            var received = box.is(':checked') ? 1 : 0;
            $.ajax({
                url: '<?php echo base_url('assignment/mark_lor_received'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { aid: aid, question_id: qid, received: received },
                success: function (res) {
                    $('#question-box-' + qid).toggleClass('received', !!received);
                    rebuildPendingPreview(res.pending || []);
                }
            });
        });
    }

    function rebuildPendingPreview(pendingList) {
        if (!pendingList) {
            return;
        }
        var username = '<?php echo addslashes($this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname')); ?>';
        var currentDate = new Date().toISOString().split('T')[0];
        var text = headerText;
        pendingList.forEach(function (desc, i) {
            text += (i + 1) + '. ' + desc + '\n';
        });
        text += footerText + '\n' + username + '\nDate: ' + currentDate;
        $('#questionsTextarea').val(text.trim());
    }


    
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
    