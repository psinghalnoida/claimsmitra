<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<?php $this->load->view('adminpanel/layout/case-sidebar');?>

<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <?php $this->load->view('adminpanel/jobs/locationbasedjob/pageheaderjobdata'); ?>
        </div>
    </div>

    <section class="main--content" style="border: 1px solid #E5E4E2; margin-left: 15px;margin-right:15px;padding-top: 0px;">
        <div class="row gutter-20">
            <div class="col-lg-12">
                <div class="panel pb-5" >
                    <div class="panel-heading row">
                        <h3 class="panel-title col-lg-7">
                            LOR Bank
                        </h3>
                        <!----------------------search bar---------------------------->
                        <div class="input-group col-lg-5">
                            <input type="text" id="searchInput" name="text" class="form-control" placeholder="Search here...">
                        </div>
                        
                    </div>
                    <div class="panel-content "  >
                        <ul class="nav nav-tabs nav-tabs-line" >
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="motor-tab" class=" nav-link active">Motor</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="marine-tab" class=" nav-link">Marine</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="fire-tab" class="nav-link">Fire</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="mbd-tab" class="nav-link ">MBD</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="project-tab" class="nav-link">Project</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="fraud-tab" class="nav-link">Fraud/Fidelity</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="burglary-tab" class="nav-link">Burglary</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="atm-tab" class="nav-link">ATM</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="all-tab" class="nav-link">ALL</a>
                            </li>
                        </ul>
                    </div>
                    <div id="motorContent" >
                    </div>
                    <button id="submitButton" class="btn btn-rounded btn-success float-right mr-3 ">Submit</button>
                
                </div>
            </div>
        </div>
    </section> 

<?php $this->load->view('adminpanel/layout/footer'); ?>
<script type="text/javascript">
    
   
// $(document).ready(function() {
//     var selectedQuestions = []; 
//     function fetchDescription(department) {
//         $.ajax({
//             type: 'GET',
//             url: 'assignment/fetchQuestions',
//             dataType: 'json',
//             data: { department: department },
//             success: function(response) {
//                 var html = '';
//                 html += '<div class="form-group row" style="background-color: #f0f0f0 ;margin-left:15px;margin-right:15px; padding-top:5px; padding-bottom:5px;">';
//                 html += '<div class="col-md-12">';
//                 html += '<label class="form-check ">';
//                 html += '<input type="checkbox" class="form-check-input float-top checkbox-select-all" data-department="'+ department +'" style="font-size: 10px;">';
//                 html += '<span class="form-check-label text-muted">Select All</span>';
//                 html += '</label>';
//                 html += '</div>';
//                 html += '</div>';

//                 $.each(response, function(index, item) {
//                     html += '<div class="form-group row" style="margin-left:15px; margin-right:15px;">';
//                     html += '<div class="col-md-12">';
//                     html += '<label class="form-check">';
//                     html += '<input type="checkbox" class="form-check-input float-top checkbox-item" name="checkbox[]" ';
//                     html += 'value="' + item.description + '" data-id="' + item.id + '" data-department="' + department + '">';
//                     html += '<span class="form-check-label">' + item.description + '</span>';
//                     html += '</label>';
//                     html += '</div>';
//                     html += '</div>';
//                 });

//                 $('#motorContent').html(html);

//                 $('.checkbox-select-all[data-department="'+ department +'"]').on('change', function() {
//                     var isChecked = $(this).prop('checked');
//                     $('.checkbox-item[data-department="'+ department +'"]').prop('checked', isChecked);
//                     updateSelectedQuestions();
//                 });

//                 $('.checkbox-item[data-department="'+ department +'"]').on('change', function() {
//                     updateSelectedQuestions();
//                 });

//                 setupSearch();
//             },
//             error: function(xhr, status, error) {
//                 console.error('Failed to fetch records:', error);
//                 $('#motorContent').html('<p>Error fetching data.</p>');
//             }
//         });
//     }
//     function updateSelectedQuestions() {
//         $('.checkbox-item:checked').each(function() {
//             var description = $(this).val();  
//             var id = $(this).data('id');
//             var department = $(this).data('department');
//             var existing = selectedQuestions.find(item => item.id === id);
//             if (!existing) {
//                 selectedQuestions.push({ id: id, description: description, department: department });
//             }
//         });
//     }
//     function setupSearch() {
//         $('#searchInput').on('input', function() {
//             const query = $(this).val().toLowerCase();
//             $('.checkbox-item').each(function() {
//                 const itemText = $(this).next('span').text().toLowerCase();
//                 $(this).closest('.form-group').toggle(itemText.includes(query));
//             });
//         });
//     }

//     $('#submitButton').on('click', function(e) {
//         e.preventDefault();
        
//         if (selectedQuestions.length > 0) {
//             var aid = '<?php echo $aid; ?>';
//             var uid = '<?php echo $this->session->userdata('id'); ?>'; 
//             $.ajax({
//                 url: "<?php echo base_url('assignment/submit_lor'); ?>",
//                 type: "POST",
//                 data: {
//                     aid: aid,
//                     uid: uid,
//                     questions_json: JSON.stringify(selectedQuestions)
//                 },
//                 dataType: "json",
//                 success: function(response) {
//                     if (response.status === 'success') {
                        
//                         // var redirectUrl = "<?php echo base_url('viewlor?q='); ?>" + btoa('<?php echo $this->encryption->encrypt($aid); ?>');
//                         var redirectUrl = "<?php echo base_url('viewlor?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') .''); ?>" ;
//                         window.location.href = redirectUrl;  
//                     } else {
//                         console.error('Submission failed:', response.message);
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error('Error:', error);
//                     alert('An error occurred while submitting the questions.');
//                 }
//             });
//         } else {
//             Swal.fire({
//                     icon: 'error',
//                     title: 'Missing Question',
//                     text: 'Please select at least one question.'
//                 });
//                 return;
//             // alert('Please select at least one question.');
//         }
//     });

//     // Initially fetch questions for the first department (for example 'motor')
//     fetchDescription('motor');
//     $('#marine-tab').on('click', function(e) { e.preventDefault(); fetchDescription('marine'); });
//     $('#fire-tab').on('click', function(e) { e.preventDefault(); fetchDescription('fire'); });
//     $('#mbd-tab').on('click', function(e) { e.preventDefault(); fetchDescription('mbd'); });
//     $('#project-tab').on('click', function(e) { e.preventDefault(); fetchDescription('project'); });
//     $('#fraud-tab').on('click', function(e) { e.preventDefault(); fetchDescription('fraud'); });
//     $('#burglary-tab').on('click', function(e) { e.preventDefault(); fetchDescription('burglary'); });
//     $('#atm-tab').on('click', function(e) { e.preventDefault(); fetchDescription('atm'); });
//     $('#all-tab').on('click', function(e) { e.preventDefault(); fetchDescription('all'); });
// });

$(document).ready(function() {
    var selectedQuestions = {};
    function fetchDescription(department) {
        $.ajax({
            type: 'GET',
            url: 'assignment/fetchQuestions',
            dataType: 'json',
            data: { department: department },
            success: function(response) {
                var html = '';
                html += '<div class="form-group row" style="background-color: #f0f0f0 ;margin-left:15px;margin-right:15px; padding-top:5px; padding-bottom:5px;">';
                html += '<div class="col-md-12">';
                html += '<label class="form-check ">';
                html += '<input type="checkbox" class="form-check-input float-top checkbox-select-all" data-department="'+ department +'" style="font-size: 10px;">';
                html += '<span class="form-check-label text-muted">Select All</span>';
                html += '</label>';
                html += '</div>';
                html += '</div>';

                $.each(response, function(index, item) {
                    html += '<div class="form-group row" style="margin-left:15px; margin-right:15px;">';
                    html += '<div class="col-md-12">';
                    html += '<label class="form-check">';
                    html += '<input type="checkbox" class="form-check-input float-top checkbox-item" name="checkbox[]" ';
                    html += 'value="' + item.description + '" data-id="' + item.id + '" data-department="' + department + '">';
                    html += '<span class="form-check-label">' + item.description + '</span>';
                    html += '</label>';
                    html += '</div>';
                    html += '</div>';
                });

                $('#motorContent').html(html);

                // Handle Select All checkbox change event
                $('.checkbox-select-all[data-department="'+ department +'"]').on('change', function() {
                    var isChecked = $(this).prop('checked');
                    $('.checkbox-item[data-department="'+ department +'"]').prop('checked', isChecked);
                    updateSelectedQuestions(department); // Update for this department
                });

                // Handle individual checkbox change event
                $('.checkbox-item[data-department="'+ department +'"]').on('change', function() {
                    updateSelectedQuestions(department); // Update for this department
                });

                setupSearch();
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch records:', error);
                $('#motorContent').html('<p>Error fetching data.</p>');
            }
        });
    }

    // Update the selectedQuestions object based on checkbox states
    function updateSelectedQuestions(department) {
        // If department is not yet in selectedQuestions, initialize it
        if (!selectedQuestions[department]) {
            selectedQuestions[department] = [];
        }

        // Reset the department's selected questions
        selectedQuestions[department] = [];

        // Loop through all checkboxes for this department and add selected ones
        $('.checkbox-item[data-department="'+ department +'"]:checked').each(function() {
            var description = $(this).val();
            var id = $(this).data('id');
            selectedQuestions[department].push({ id: id, description: description });
        });
    }

    // Setup search functionality for descriptions
    function setupSearch() {
        $('#searchInput').on('input', function() {
            const query = $(this).val().toLowerCase();
            $('.checkbox-item').each(function() {
                const itemText = $(this).next('span').text().toLowerCase();
                $(this).closest('.form-group').toggle(itemText.includes(query));
            });
        });
    }

    // Submit button click event
    $('#submitButton').on('click', function(e) {
        e.preventDefault();
        
        // Collect all selected questions from all departments
        var allSelectedQuestions = [];
        for (var department in selectedQuestions) {
            allSelectedQuestions = allSelectedQuestions.concat(selectedQuestions[department]);
        }

        if (allSelectedQuestions.length > 0) {
            var aid = '<?php echo $aid; ?>';
            var uid = '<?php echo $this->session->userdata('id'); ?>'; 
            $.ajax({
                url: "<?php echo base_url('assignment/submit_lor'); ?>",
                type: "POST",
                data: {
                    aid: aid,
                    uid: uid,
                    questions_json: JSON.stringify(allSelectedQuestions)
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        var redirectUrl = "<?php echo base_url('viewlor?q=' . base64_encode($this->encryption->encrypt($aid)) . '&data=' . $this->input->get('data') .''); ?>" ;
                        window.location.href = redirectUrl;  
                    } else {
                        console.error('Submission failed:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the questions.');
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Missing Question',
                text: 'Please select at least one question.'
            });
            return;
        }
    });

    // Initially fetch questions for the first department (for example 'motor')
    fetchDescription('motor');
    $('#marine-tab').on('click', function(e) { e.preventDefault(); fetchDescription('marine'); });
    $('#fire-tab').on('click', function(e) { e.preventDefault(); fetchDescription('fire'); });
    $('#mbd-tab').on('click', function(e) { e.preventDefault(); fetchDescription('mbd'); });
    $('#project-tab').on('click', function(e) { e.preventDefault(); fetchDescription('project'); });
    $('#fraud-tab').on('click', function(e) { e.preventDefault(); fetchDescription('fraud'); });
    $('#burglary-tab').on('click', function(e) { e.preventDefault(); fetchDescription('burglary'); });
    $('#atm-tab').on('click', function(e) { e.preventDefault(); fetchDescription('atm'); });
    $('#all-tab').on('click', function(e) { e.preventDefault(); fetchDescription('all'); });
});


</script>