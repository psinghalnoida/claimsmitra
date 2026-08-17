
<form id="add_new_document" method="post" enctype="multipart/form-data" style="padding: 0px 31px;"> 
    <input type="hidden" id="id" name="id"> 
    <div class="form-group row m-3">
        <span class="label-text col-lg-3 col-form-label">Document Type</span>
        <div class="col-lg-9">
            <select  name="document_type" id="document_type" onchange="select_document(this.value);" class="form-control">
                <option value="">Select Document Type</option>
                <option value="PAN Card">PAN Card</option>
                <option value="Aadhar Card">Aadhar Card</option>
            </select>
        </div>
    </div>
    <div id="pan_card" style="display:none">
        <div class="form-group row m-3"> 
            <span class="label-text col-lg-3 col-form-label">PAN Number</span>
            <div class="col-lg-9">
                <input type="text" name="document_no" id="pan_document_no" placeholder="PAN Number" class="form-control">
            </div>
        </div>
    </div>

    <div id="aadhar_card" style="display:none" >
        <div class="form-group row m-3">
            <span class="label-text col-lg-3 col-form-label">Aadhar Number</span>
            <div class="col-lg-9">
                <input type="text" name="document_no" id="adhar_document_no" placeholder="Aadhar Number" class="form-control">
            </div>
        </div>
    </div>
    <div id="document" style="display:none">
        <div class="form-group row m-3" >
            <span class="label-text col-lg-3 col-form-label">Upload Document</span>
            <div class="col-lg-9">
                <div class="custom-file">
                    <input type="file" id="kycdocument" name="kycdocument" class="custom-file-input form-control image-file" accept="image/png, image/jpeg" >
                    <label class="custom-file-label" for="kycdocument">Choose file</label>
                </div>
            </div>
        </div>

        <div class="form-group row" style="margin-top: 20px; margin-left: 25.5%;">
            <div class="col-lg-8">
                <div id="image_document">
                    <!-- <input type="file" id="kycdocument" name="kycdocument" class="custom-file-input form-control image-file" accept="image/png, image/jpeg"> -->
                
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal-footer">
        <button type="button" onclick="savedocument();" class="btn btn-sm btn-rounded btn-success" id="btn_document_save"  style="align:left; margin-right: 15px;">Save</button>
    </div>
</form>

<script>
    // function showPreview() {
    //     var input = document.getElementById('kycdocument'); // File input
    //     var previewSection = document.getElementById('image_document'); // Container for the image preview

    //     // Clear any existing images
    //     previewSection.innerHTML = '';

    //     // Check if a file is selected
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function(e) {
    //             // Display the selected image
    //             previewSection.innerHTML = '<img id="upload_document" src="' + e.target.result + '" class="thumb-image" style="max-width: 100%; cursor: pointer;" onclick="zoomImage()"/>';
    //         };

    //         // Read the selected file as a DataURL
    //         reader.readAsDataURL(input.files[0]);
    //     } else {
    //         // Clear the preview if no file is selected
    //         previewSection.innerHTML = '';
    //     }
    // }

</script>