
<div id="alert_message">
</div>
<form id="company_form" method="post" enctype="multipart/form-data" style="padding: 0px 31px;">
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Profession</span>
        <div class="col-lg-9">
            <select name="select_profession" id="select_profession" class="form-control">
        
                 
            </select>
        </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Company Name</span>
        <div class="col-lg-9">
            <input type="text" placeholder="Company Name" name="companyName" id="companyName" class="form-control">
        </div>
    </div>
    <input type="hidden" id="cid" name="cid">

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">CIN Number</span>
        <div class="col-lg-9">
            <input type="text" placeholder="CIN Number"  name="cinNumber" id="cinNumber"  class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Licence Number</span>
        <div class="col-lg-9">
            <input type="text" placeholder="Licence Number"  name="licenceNumber" id="licenceNumber"  class="form-control">
        </div>
    </div>

    <!-- <div class="form-group row">
        <div class="col-lg-12">
            <div class="custom-file">
            <span style="color:#e16123">Note: To create new "my company" either of following documents should be submitted</span>
            </div>
        </div>
    </div> -->

    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Upload Licence Image<span style="color:red">*</span></span>
        <div class="col-lg-9">
            <div class="custom-file">
                <input type="file" id="licenceimage" name="licenceimage" class="custom-file-input form-control"  onchange="showImage()">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
    </div>
    <div class="form-group row" style="margin-top: 20px; margin-left: 24%">
        <div class="col-lg-9">
            <div id="licence_thumb" class="pdf_thumb">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" onclick="savecompany()" class="btn btn-sm btn-rounded btn-success" id="btn_save_company">Submit</button>
    </div>
</form>
<script>
    function showImage() {
        var input = document.getElementById('licenceimage'); // File input
        var previewSection = document.getElementById('licence_thumb'); // Container for the image preview

        // Clear any existing images
        previewSection.innerHTML = '';

        // Check if a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Display the selected image
                previewSection.innerHTML = '<img id="upload_document" src="' + e.target.result + '" class="thumb-image" style="max-width: 100%; cursor: pointer;" onclick="zoomImage()"/>';
            };

            // Read the selected file as a DataURL
            reader.readAsDataURL(input.files[0]);
        } else {
            // Clear the preview if no file is selected
            previewSection.innerHTML = '';
        }
    }

</script>