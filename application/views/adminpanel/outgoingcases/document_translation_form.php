<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<section class="main--content" style="min-height:100vh; padding-top:0px;">
    <div class="container-fluid">
        <div class="row gutter-20">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-content mt-3">
                       <form id="documenttranslationjobs" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="encrypted_data" value="<?= $url ?>">

                        <!-- Language From -->
                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Language From &nbsp;<span style="color:red">*</span></span>
                            <div class="col-lg-9">
                                <select name="language_list_from" id="language_list_from" class="form-control">
                                    <option value="">None Selected</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Assamese">Assamese</option>
                                    <option value="Bengali">Bengali</option>
                                    <option value="Gujarati">Gujarati</option>
                                    <option value="Kannada">Kannada</option>
                                    <option value="Urdu">Urdu</option>
                                    <option value="Malayalam">Malayalam</option>
                                    <option value="Marathi">Marathi</option>
                                    <option value="Odia">Odia</option>
                                    <option value="Punjabi / Guru mukhi">Punjabi / Guru mukhi</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="Telugu">Telugu</option>
                                </select>
                                <div id="error_language_from" class="error-message"></div>
                            </div>
                        </div>

                        <!-- Language To -->
                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Language To &nbsp;<span style="color:red">*</span></span>
                            <div class="col-lg-9">
                                <select name="language_list_to" id="language_list_to" class="form-control">
                                    <option value="">None Selected</option>
                                    <option value="English">English</option>
                                </select>
                                <div id="error_language_to" class="error-message"></div>
                            </div>
                        </div>

                        <!-- Case Reference -->
                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Case Reference &nbsp;<span style="color:red">*</span></span>
                            <div class="col-lg-9">
                                <input type="text" name="case_reference" id="case_reference" placeholder="Case Reference" class="form-control">
                                <div id="error_case_reference" class="error-message"></div>
                            </div>
                        </div>

                        <!-- Upload File -->
                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label">Upload File <span style="color:red">*</span></span>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input type="file" id="doctranslation" name="doctranslation" class="custom-file-input form-control" multiple='multiple'>
                                    <label class="custom-file-label" id="doctranslation_error" for="customFile">Choose file</label>
                                </div>
                                <div id="translationdoc_thumb" style="display:flex;"></div>
                                <div id="error_doctranslation" class="error-message"></div>
                            </div>
                        </div>

                        <!-- Terms Agreement -->
                        <div class="form-group row">
                            <span class="label-text col-lg-3 col-form-label"></span>
                            <div class="col-lg-7" style="top:7px;">
                                <label class="form-check">
                                    <input type="checkbox" name="agree" id="check_terms"  value="1" class="form-check-input">
                                    <span class="form-check-label">Yes, I agree to the <a href="<?php echo base_url('dashboard/termsofservice'); ?>" target="_blank">Terms of Service</a></span>
                                </label>
                            </div>
                        </div>

                        <input type="hidden" class="natureofjob" name="natureofjob" value="8" placeholder="Nature of Job">

                        <div class="modal-footer" style="padding-right:0px">
                            <button type="button" id="submitDocTranslation" class="btn btn-rounded btn-success" disabled>Submit</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('adminpanel/layout/footer');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>


<script type="text/javascript">
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.worker.min.js';

var totalPdfCount = 0;
var totalPages = 0;
var allfile = [];

$('#doctranslation').on('change', function(event) {
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

                // Create the thumbnail card with Bootstrap classes and inline styles
                var thumbnail = $('<div class="card" style="width: 6rem; margin-right: 10px; margin-bottom: 10px;">' + 
                                    '<a class="image-container" href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' + 
                                        '<div class="overlay" style="position: absolute; top: 0; right: 0; background-color: rgba(0, 0, 0, 0.5); width: 100%; height: 100%;">' + 
                                            '<button class="remove-button btn btn-danger" style="position: absolute; top: 5px; right: 5px; font-size: 12px;">Remove</button>' +
                                        '</div>' + 
                                        '<img class="card-img-top" src="<?php echo base_url('assets/thumbnails/pdf_thumb.png'); ?>" alt="PDF Thumbnail" style="width: 100%; height: auto;">' + 
                                    '</a>' + 
                                    '<div class="card-body p-1" style="text-align: center; line-height: initial;">' + 
                                        '<span style="font-size: 10px;">' + fileNameWithoutExtension + '</span>' + 
                                    '</div>' + 
                                  '</div>');
                
                thumbnailsContainer.append(thumbnail);
            }
        }
    } else {
        alert("Your browser doesn't support file preview.");
    }
});




$(document).ready(function () {
    $('#case_reference').on('input', function () {
        this.value = this.value.toUpperCase();
    });

    function validateForm() {
        const languageFrom = $('#language_list_from').val().trim();
        const languageTo = $('#language_list_to').val().trim();
        const caseRef = $('#case_reference').val().trim();
        const fileInput = $('#doctranslation').get(0).files.length > 0;
        const agreed = $('#check_terms').is(':checked');

        // Enable the button only if all are filled
        if (languageFrom && languageTo && caseRef && fileInput && agreed) {
            $('#submitDocTranslation').prop('disabled', false);
        } else {
            $('#submitDocTranslation').prop('disabled', true);
        }
    }

    // Run validation on form element changes
    $('#language_list_from, #language_list_to, #case_reference, #doctranslation, #check_terms').on('change keyup', validateForm);

    $("#submitDocTranslation").click(function() {
        // Trigger form validation before submitting the form
        $("#documenttranslationjobs").submit();
    });

   $("#documenttranslationjobs").validate({
    errorClass: 'error',
    errorElement: 'div',
    highlight: function(element) {
        $(element).addClass('is-invalid');
        $(element).closest('.form-group').find('.error-message').show();
    },
    unhighlight: function(element) {
        $(element).removeClass('is-invalid');
        $(element).closest('.form-group').find('.error-message').hide();
    },
    rules: {
        language_list_from: { required: true },
        language_list_to: { required: true },
        case_reference: { required: true },
        doctranslation: {
            required: true,
            filesize: 5000000 // 5MB
        },
        agree: { required: true }
    },
    messages: {
        language_list_from: "Please select a language from.",
        language_list_to: "Please select a language to.",
        case_reference: "Please enter a case reference.",
        doctranslation: {
            required: "Please upload a document.",
            filesize: "The file size should not exceed 5MB."
        },
        agree: "You must agree to the Terms of Service."
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") === "doctranslation") {
            error.insertAfter("#doctranslation_error");
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault(); // Stop default form submit

        var form_data = new FormData(form);

        // Add custom fields
        form_data.append('productname', 'Document Translation');
        form_data.append('totalfile', totalPdfCount); // defined elsewhere
        form_data.append('totalpages', totalPages);   // defined elsewhere

        // Add files manually
        for (var i = 0; i < allfile.length; i++) { 
            form_data.append('docfortranslation[]', allfile[i]);
        }

        // Send data using AJAX
        $.ajax({
            url: '<?= base_url('documents_translation'); ?>',
            type: 'POST',
            data: form_data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 200) {
                   
                    var encryptedUrl = response.data.url;

                  
                    $('.success-alert').fadeIn();

                    setTimeout(function() {
                        $('.success-alert').fadeOut('slow');
                        window.location.href = "<?= base_url('calculateamount'); ?>?data=" + encodeURIComponent(encryptedUrl);
                    }, 1000);

                } else {
                    $("#error_message").text(response.message).css('color', 'red').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $("#error_message").text('Something went wrong. Please try again.').css('color', 'red').show();
            }
        });
    }
});


// Custom file size validation
$.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param);
}, 'File size must be less than {0} bytes');


    // Optionally, display file name when a file is selected
    $("#doctranslation").on("change", function (event) {
        var fileName = event.target.files[0].name;
        $("#doctranslation_error").text(fileName);
    });
});


function updateTotals(pdfCount, pageTotal) {
    $('#total-pdf-count').text(pdfCount);
    $('#total-pages').text(pageTotal);
}


// Function to extract text from PDF using PDF.js
function extractPdfContent(file) {
    const reader = new FileReader();

    // Display loading indicator (e.g., show a spinner)
    $("#pdfLoader").show();  // Assuming there's a loading spinner with ID pdfLoader

    reader.onload = function(event) {
        const arrayBuffer = event.target.result;

        // Check if the file is empty (optional, but a good practice)
        if (arrayBuffer.byteLength === 0) {
            $("#error_doctranslation").text("Please upload a valid PDF.").show();
            $("#pdfLoader").hide(); // Hide loading spinner
            return;
        }

        // Using PDF.js to load the PDF
        pdfjsLib.getDocument(arrayBuffer).promise.then(function(pdf) {
            const numPages = pdf.numPages;
            let pagePromises = [];

            // Loop through each page and extract text
            for (let pageNumber = 1; pageNumber <= numPages; pageNumber++) {
                pagePromises.push(
                    pdf.getPage(pageNumber).then(function(page) {
                        return page.getTextContent().then(function(textContent) {
                            let pageText = textContent.items.map(item => item.str).join(' ');

                            // Display extracted text for the page (you can modify this as needed)
                            console.log(`Page ${pageNumber} content:`, pageText);
                            
                            // Optionally append the text to a div on the page for user feedback
                            $("#extractedText").append(`<p>Page ${pageNumber}: ${pageText}</p>`);
                        });
                    })
                );
            }

            // Wait for all pages to be processed
            Promise.all(pagePromises).then(function() {
                console.log('All pages processed');
                $("#pdfLoader").hide(); // Hide loading spinner when done
            });

        }, function(error) {
            console.error('Error loading PDF:', error);
            $("#error_doctranslation").text("There was an error processing the PDF.").show();
            $("#pdfLoader").hide(); // Hide loading spinner on error
        });
    };

    reader.onerror = function(error) {
        console.error('Error reading file:', error);
        $("#error_doctranslation").text("Error reading the file. Please try again.").show();
        $("#pdfLoader").hide(); // Hide loading spinner if file read fails
    };

    reader.readAsArrayBuffer(file);
}



var documents = [];
$('#uploadpdf').on('change', function(event) {
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



</script>