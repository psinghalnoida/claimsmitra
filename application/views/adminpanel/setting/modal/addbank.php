<style>
#image_thumb {
    text-align: center;
}

#previewImage {
    max-width: 100%;
    cursor: pointer;
}

#previewImage:hover {
    transform: scale(1.1); 
    transition: transform 0.2s ease-in-out; 
}

</style>

<form id="add_new_bank" method="post" enctype="multipart/form-data" style="padding: 0px 31px;"> 
    <input type="hidden" value="" name="id"  id= "bid"/>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Account Type <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <select name="account_type" id="account_type" class="form-control" required>
                <option value="">Nothing Selected</option>
                <option value="Saving">Saving</option>
                <option value="Current">Current</option>
            </select>
        </div>
    </div>

    <div class="form-group row" >
        <label class="col-lg-4 col-form-label">Bank Name <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <select name="bank" id="bank_name" class="form-control" required>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Account Number <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <input type="text" name="account_number" id="account_number" placeholder="Account Number" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">IFSC Code <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <input type="text" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">MICR Code <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <input type="text" name="micr_code" id="micr_code" placeholder="MICR Code" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">UPI <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <input type="text" name="upi" id="upi" placeholder="UPI" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Upload Cancel Cheque <span style="color:red">*</span></label>
        <div class="col-lg-8">
            <div class="custom-file">
                <input type="file" id="cancelCheque" name="cancelCheque" class="custom-file-input form-control" accept="image/*" required onchange="showPreview()" >
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="image_preview_section" style="margin-top: 20px; margin-left: 33%;display:none;">
        <div class="col-lg-8">
            <div id="image_thumb">
                <img id="previewImage" style="max-width: 100%; cursor: pointer;" />
            </div>
        </div>
    </div>

    
    <div class="modal-footer">
       
        <button type="button"  class="btn btn-sm btn-rounded btn-info" onclick="resetForm()">Cancel</button>
        <button type="button" onclick="savebank()" class="btn btn-sm btn-rounded btn-success" id="btn_save_bank">Update</button>
    </div>
</form>

<script >
    
    function showPreview() {
        var input = document.getElementById('cancelCheque');
        var preview = document.getElementById('previewImage');
        var previewSection = document.getElementById('image_preview_section');

        // Check if a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Check if preview exists
                if (preview) {
                    // Display the selected image
                    preview.src = e.target.result;
                    // Show the preview section
                    previewSection.style.display = 'block';
                } else {
                    console.error("Error: Preview element not found.");
                }
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // Clear the preview if no file is selected
            if (preview) {
                preview.src = '';
                previewSection.style.display = 'none';
            }
        }
    }

    function resetForm() {
        document.getElementById('add_new_bank').reset(); 
        document.getElementById('previewImage').src = '';
        document.getElementById('image_preview_section').style.display = 'none'; 
    }
</script>

