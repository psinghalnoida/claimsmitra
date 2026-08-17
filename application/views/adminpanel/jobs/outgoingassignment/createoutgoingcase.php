<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Tab Content Start -->
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab11">
            <section class="main--content" style="padding-top: 15px; padding-left:15px; padding-right:15px; min-height: 100vh;">
                <div class="row gutter-20">
                    <div class="col-md-3">
                        <div class="panel">   
                            <div class="miniStats--panel">
                               <a href="<?php echo base_url('ebdeath_indivi?data='.urlencode($url)); ?>">
                                <div class="miniStats--body">
                                    <img src="<?php echo base_url('assets/fender-bender.png'); ?>" alt="" style="width:19%;color:#fff;" class="miniStats--icon">
                                    <p class="miniStats--caption text-blue">4 weeks</p>
                                    <h3 class="miniStats--title h4">Eb Death Case</h3>
                                    <p class="miniStats--num text-blue">5,000 INR <span class="miniStats--caption text-blue">Onwards</span></p>
                                </div>
                               </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="panel"> 
                            <div class="miniStats--panel">
                                <a href="<?php echo base_url('motorspotsurvey_indivi?data='.urlencode($url)); ?>">
                                    <div class="miniStats--body">
                                        <img src="<?php echo base_url('assets/car.png'); ?>" alt="" style="width:17%;color:#fff;" class="miniStats--icon">
                                        <p class="miniStats--caption text-orange">2 days</p>
                                        <h3 class="miniStats--title h4">Motor Spot survey </h3>
                                        <p class="miniStats--num text-orange">3,000 INR <span class="miniStats--caption text-orange">Onwards</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="panel">   
                            <div class="miniStats--panel">
                                <a href="<?php echo base_url('marinepredis_indivi?data='.urlencode($url)); ?>">
                                    <div class="miniStats--body">
                                        <img src="<?php echo base_url('assets/shipping.png'); ?>" alt="" style="width:17%;color:#fff;" class="miniStats--icon">
                                        <p class="miniStats--caption" style="color:#7e017e;">2 weeks</p>
                                        <h3 class="miniStats--title h4">Marine Pre Dispatch</h3>
                                        <p class="miniStats--num" style="color:#7e017e;">3,500 INR <span class="miniStats--caption" style="color:#7e017e;">Onwards</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="panel">    
                            <div class="miniStats--panel">
                               <a href="<?php echo base_url('documents_translation?data='.urlencode($url)); ?>">
                                    <div class="miniStats--body">
                                        <img src="<?php echo base_url('assets/documents.png'); ?>" alt="" style="width:17%;color:#fff;" class="miniStats--icon">
                                        <p class="miniStats--caption text-green" style="color:#CA5555;">2 days</p>
                                        <h3 class="miniStats--title h4">Document Translation</h3>
                                        <p class="miniStats--num" style="color:#CA5555;">250 INR <span class="miniStats--caption" style="color:#CA5555;">Onwards</span></p>
                                    </div>
                                </a>
                            </div>  
                        </div>
                    </div>
                </div>  
                  <div class="row gutter-20">
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="miniStats--panel">
                              <a href="<?php echo base_url('assetvaluation_indivi?data='.urlencode($url)); ?>">
                                <div class="miniStats--body">
                                     <img src="<?php echo base_url('assets/assets.png'); ?>" alt="" style="width:17%;color:#fff;" class="miniStats--icon">
                                    <p class="miniStats--caption text-blue" style="color:#3BD23B;">1 Week</p>
                                    <h3 class="miniStats--title h4">Assets Valuation</h3>
                                    <p class="miniStats--num text-blue" style="color:#3BD23B;">25,000 INR <span class="miniStats--caption" style="color:#3BD23B;">Onwards</span></p>
                                </div>
                            </a>
                            </div> 
                        </div>
                    </div>
                </div>            
            </section>
        </div>
    </div>

    <?php $this->load->view('adminpanel/jobs/modal/pricinglist'); ?>
    <?php $this->load->view('adminpanel/layout/footer'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            var departmentid = '<?php echo $defaultdepartment; ?>';
            getTypeofCase(departmentid);
        });

        $('#search-bar').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            var filteredData = allData.filter(function(item) {
                return item.investigator_type.toLowerCase().includes(searchTerm) ||
                    item.time.toLowerCase().includes(searchTerm);
            });
            renderTable(filteredData);
        });


        function getTypeofCase(departmentid) {
            $.ajax({
                url: "<?php echo base_url('getassignment'); ?>",
                data:{'departmentid' : departmentid},
                dataType: "json",
                type: "POST",
                success: function(response) {
                   var allData = response.data; // Store data globally
                    renderTable(allData); // Render the table with all data
                },
                error: function(xhr, status, error) {
                    // console.error("Error fetching data:", status, error);
                    // Optionally handle the error, e.g., show a message to the user
                }
            });
        }

        function renderTable(data) {
            $("#nature_of_job").empty();
            var tbody = $('<tbody></tbody>');
            for (let i = 0; i < data.length; i++) {
                tbody.append('<tr>' +
                    '<td style="width:0px;">' +
                    '<div class="form-group row" style="display: flex; justify-content: center; align-items: center;">' +
                    '<div class="col-md-10 form-inline custom-radio-label">' +
                    '<label class="mr-3">' +
                    '<input type="radio" class="form-radio-input check_case" name="check_case" value="' + data[i].id + '">' +
                    '<span class="custom-radio"></span>' +
                    '</label>' +
                    '<input type="hidden" class="selected_natureofjo" name="hidden_case_id_' + data[i].id + '" value="' + data[i].id + '">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td style="padding-left:5px; display: flex; justify-content: space-between; align-items: center; width: 100%; border-top: 1px solid #ced4da;border-left:none;border-right:none;border-bottom:none;height:48px;">' +
                    '<label for="observation_4" style="color:black" id="' + data[i].id + '">' + data[i].investigator_type + '</label>' +
                    '<button type="submit" class="btn btn-rounded btn-success next-btn" id="createForm" style="margin-left: auto;margin-right:5px;" disabled>Next</button>' +
                    '</td>' +
                    '</tr>');
            }

            $('#nature_of_job').append(tbody);
            // Event listener: Enable the Next button only for the selected radio button's row
            $(".check_case").on("change", function() {
                $(".next-btn").prop("disabled", true); // Disable all Next buttons
                $(this).closest("tr").find(".next-btn").prop("disabled", false); // Enable the selected row's Next button
            });
        }

        /* ------------------------------------------------------------------------- *
         * GET NON LOCATION JOB LIST
         * ------------------------------------------------------------------------- */


        let invoiceCounter = 0;
        function addMoreInvoice() {
            var container = document.getElementById('invoiceContainer');
            var newRow = document.createElement('div');
            invoiceCounter = container.children.length + 1;
            newRow.className = 'form-group row';
            newRow.innerHTML = `<span class="label-text col-lg-3 col-form-label">Invoice ${invoiceCounter}</span>
                            <div class="col-lg-3">
                                <input type="text" name="invoicenumber[]" placeholder="Invoice Number" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <input type="date" name="invoicedate[]" placeholder="Invoice Date" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <input type="file" name="addinvoice[]" class="form-control">
                            </div>
                            <div class="col-lg-1" style="align-self:center">
                                <button type="button" onclick="removeInvoice(this)" class="btn btn-rounded btn-warning"><i class="fa fa-times"></i></button>
                            </div>`;
            container.appendChild(newRow);
        }

        function removeInvoice(element) {
            var rowToRemove = element.parentNode.parentNode;
            rowToRemove.parentNode.removeChild(rowToRemove);
            updateInvoiceLabels();
        }

        function updateInvoiceLabels() {
            invoiceCounter = 1;
            var invoiceRows = document.querySelectorAll('#invoiceContainer .form-group.row');
            invoiceRows.forEach(row => {
                var label = row.querySelector('.label-text');
                label.textContent = `Invoice ${invoiceCounter}`;
                invoiceCounter++;
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            addMoreInvoice();
            $('.search_inspector').on('keyup', function() {
                var search_inspector = $('.search_inspector').val();

                $.ajax({
                    url: "<?php echo base_url('cases/search_inspector'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        search: search_inspector
                    },
                    success: function(data) {
                        var html = '<div class="scroll-container"><ul>';
                        $.each(data, function(index, item) {
                            html += '<li class="inspectorOptions" id="' + item.id + '">' + item.firstname + ' ' + item.lastname + ' ' + item.mobile + '</li>';
                        });
                        html += '</ul></div>';
                        $('.searchResults').html(html);

                        // Add event listener to each li element
                        $('.inspectorOptions').on('click', function() {
                            // Get the text content of the clicked li element
                            var selectedText = $(this).text();
                            var selectedId = $(this).attr('id');

                            // Set the value of the input field to the selected text
                            $('.search_inspector').val(selectedText);
                            $('.inspectorid').val(selectedId);

                            // Remove all li elements
                            $('.searchResults').empty();
                        });
                    }
                });
            });

        });

        var natureofjob;

        $('#available_at_location').on('change', function() {
            if ($('#available_at_location').val() === "yes") {
                $('#whatsapp_no').css('display', 'none');
            } else if ($('#available_at_location').val() === "no") {
                $('#whatsapp_no').css('display', 'flex');
            }
        });
       
        /* ------------------------------------------------------------------------- *
         * FIRST LETTER CAPITAL
         * ------------------------------------------------------------------------- */
        // Function to capitalize the first letter of a string
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Event handler for input in the contact_person_name field
        $('#contact_person_name,#location_of_survey,#name_of_owner').on('input', function() {
            var currentVal = $(this).val();
            var newVal = capitalizeFirstLetter(currentVal);
            $(this).val(newVal);
        });

        $('#pricingdata').on('click', function() {
            $("#pricinglist").modal('show');
            
            /* ------------------------------------------------------------------------- *
             * GET PRICING LIST
             * ------------------------------------------------------------------------- */
            var $recordsListView = $('#pricingtable');
            if ($recordsListView.length) {
                $recordsListView.DataTable({
                    "serverSide": true,
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "autoWidth": true,
                    language: {
                        searchPlaceholder: "Search Services"
                    },
                    "order": [],
                    // Load data from an Ajax source
                    "ajax": {
                        url: "<?php echo base_url('pricing'); ?>",
                        type: "POST",
                        dataType: "JSON"
                    }
                });
            }

            $('#pricinglist').on('hidden.bs.modal', function() {
                $('#pricingtable').DataTable().destroy();
            });

            var totalPdfCount = 0;
            var totalPages = 0;
            var allfile = [];
            $('#doctranslation').on('change', function() {
                if (window.File && window.FileList && window.FileReader) {
                    var thumbnailsContainer = $('#translationdoc_thumb');
                    var files = event.target.files;
                    for (var i = 0; i < files.length; i++) {
                        allfile.push(files[i]);
                        var filepath = files[i];
                        var fileNameWithoutExtension = filepath.name.split('.').slice(0, -1).join('.');
                        if (filepath.type === 'application/pdf') {
                            totalPdfCount++;
                            pdfjsLib.getDocument(URL.createObjectURL(event.target.files[i])).promise.then(function(pdf) {
                                totalPages += pdf.numPages;
                                updateTotals(totalPdfCount, totalPages);
                            });
                            var thumbnail = $('<div class="card" style="width: 8rem; text-align:center; margin-left:21px"><a class="image-container" href="' + URL.createObjectURL(event.target.files[i]) + '" ><div class="overlay"><button class="remove-button">Remove</button></div><img class="card-img-top" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF Thumbnail"></a><div class="card-body" style="padding:0px; line-height:initial"><span style="font-size:10px;">' + fileNameWithoutExtension + '</span></div></div>');
                            thumbnailsContainer.append(thumbnail);
                        }
                    }
                } else {
                    alert("Your browser doesn't support file preview.");
                }
            });

            // Delete image on click of delete button
            $(".translationdoc_thumb").on('click', '.delete-button', function() {
                var index = $(this).data('index');
                $("#docfortranslation")[0].files.splice(index, 1);
                $(this).parent('.image-preview').remove();
            });

            $("#documenttranslationjobs").validate({
                rules: {
                    language_list_from: "required",
                    language_list_to: "required",
                },
                messages: {
                    language_list_from: "Select Language",
                    language_list_to: "Select Language",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            function updateTotals(pdfCount, pageTotal) {
                $('#total-pdf-count').text(pdfCount);
                $('#total-pages').text(pageTotal);
            }

            // $("#submitDocTranslation").on('click', function(event) {
            //     event.preventDefault();
            //     if ($("#documenttranslationjobs").valid()) {
            //         var form_data = new FormData(document.getElementById('documenttranslationjobs'));
            //         form_data.append('nature_of_job', document.getElementById('nature_of_job').value);
            //         for (var i = 0; i < allfile.length; i++) {
            //             form_data.append('docfortranslation[]', allfile[i]);
            //         }
            //         form_data.append('productname', 'Document Translation');
            //         form_data.append('totalfile', totalPdfCount);
            //         form_data.append('totalpages', totalPages);
            //         $.ajax({
            //             type: "POST",
            //             url: "nonlocationcase",
            //             dataType: "json",
            //             data: form_data,
            //             processData: false,
            //             contentType: false,
            //             success: function(response) {
            //                 if (response.status === 200) {
            //                     var url = 'agreeforterms' + '?' + $.param({
            //                         natureofjob: response.data.natureofjob,
            //                         files: response.data.filedata['total-file'],
            //                         pages: response.data.filedata['total-pages']
            //                     });
            //                     window.location.href = url;
            //                 } else {
            //                     swal({
            //                         title: "Failed!",
            //                         type: "warning",
            //                         text: response.message,
            //                         confirmButtonColor: "#D22B2B"
            //                     });
            //                 }
            //             }
            //         });
            //     }
            // });

            function agreetermsandcondition() {
                if ($('#check_terms').is(':checked')) {
                    $('#btn_calculate').prop('disabled', false);
                } else {
                    $('#btn_calculate').prop('disabled', true);
                }
            }

            function paynow() {
                var amount = $('#total_amount').text();
                $.ajax({
                    url: "<?php echo base_url('checkout'); ?>",
                    dataType: "json",
                    type: "POST",
                    data: {
                        amount: amount
                    },
                    success: function(response) {
                        window.open(response, '_blank');
                    }
                })
            }

            var documents = [];
            $('#uploadpdf').on('change', function() {
                if (window.File && window.FileList && window.FileReader) {
                    var thumbnailsContainer = $('#pdf_thumb');
                    var files = event.target.files;
                    for (var i = 0; i < files.length; i++) {
                        documents.push(files[i]);
                        var filepath = files[i];
                        var fileNameWithoutExtension = filepath.name.split('.').slice(0, -1).join('.');
                        if (filepath.type === 'application/pdf') {
                            totalPdfCount++;
                            pdfjsLib.getDocument(URL.createObjectURL(event.target.files[i])).promise.then(function(pdf) {
                                totalPages += pdf.numPages;
                                updateTotals(totalPdfCount, totalPages);
                            });
                            var thumbnail = $('<div class="card" style="width: 8rem; text-align:center; margin-left:21px"><a class="image-container" href="' + URL.createObjectURL(event.target.files[i]) + '" ><div class="overlay"><button class="remove-button">Remove</button></div><img class="card-img-top" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF Thumbnail"></a><div class="card-body" style="padding:0px; line-height:initial"><span style="font-size:10px;">' + fileNameWithoutExtension + '</span></div></div>');

                            thumbnailsContainer.append(thumbnail);
                        }
                    }
                } else {
                    alert("Your browser doesn't support file preview.");
                }
            });

            $("#otherjobs").validate({
                rules: {
                    contact_person_name: "required",
                    contact_person_mobile: "required",
                    vehicleno: "required",
                    pincode: "required"
                },
                messages: {
                    contact_person_name: "Enter full name",
                    contact_person_mobile: "Enter mobile no",
                    vehicleno: "Enter Vehicle no",
                    pincode: "Enter pincode"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $("#btn_calculate").on('click', function(event) {
                event.preventDefault();
                console.log(companyid);
                console.log(departmentid);
                console.log(user_role);

                if ($("#otherjobs").valid()) {
                    var form_data = new FormData(document.getElementById('otherjobs'));
                    var state = $('#state').val();
                    var city = $('#city').val();
                    form_data.append('nature_of_job', document.getElementById('nature_of_job').value);
                    for (var i = 0; i < documents.length; i++) {
                        form_data.append('documents[]', documents[i]);
                    }
                    form_data.append('state', state);
                    form_data.append('city', city);
                    $.ajax({
                        type: "POST",
                        url: "nonlocationothercase",
                        dataType: "json",
                        data: form_data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status === 200) {
                                var url = 'agreeforterms' + '?' + $.param({
                                    natureofjob: response.data.natureofjob
                                });
                                window.location.href = url;
                            } else {
                                swal({
                                    title: "Failed!",
                                    type: "warning",
                                    text: response.message,
                                    confirmButtonColor: "#D22B2B"
                                });
                            }
                        }
                    });
                }
            });

            /* ------------------------------------------------------------------------- *
             * AUTO POPULATE STATE AND CITY USING PINCODE
             * ------------------------------------------------------------------------- */
            $(document).ready(function() {
                search_pincode();

                function search_pincode(pincode) {
                    $.ajax({
                        url: "searchpincode",
                        method: "POST",
                        data: {
                            pincode: pincode
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 200) {
                                $("#state").val(response.data.State);
                                $("#city").val(response.data.City);
                            }
                        }
                    })
                }

                $('#pincode').keyup(function() {
                    var search = $(this).val();
                    if (search != '' && search.length === 6) {
                        search_pincode(search);
                    } else {
                        search_pincode();
                    }
                });

            });

            $(document).ready(function() {
                $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                    localStorage.setItem('activeTab', $(e.target).attr('href'));
                });
                var activeTab = localStorage.getItem('activeTab');
                if (activeTab) {
                    $('#case_tab a[href="' + activeTab + '"]').tab('show');
                }
            });

            /* ------------------------------------------------------------------------- *
             * GET VENDOR LIST
             * ------------------------------------------------------------------------- */
            var $recordsListView = $('#vendorlist');
            if ($recordsListView.length) {
                $recordsListView.DataTable({
                    columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }],
                    select: {
                        style: 'os',
                        selector: 'td:first-child'
                    },
                    order: [
                        [1, 'asc']
                    ],  
                });
            }
        })
    </script>