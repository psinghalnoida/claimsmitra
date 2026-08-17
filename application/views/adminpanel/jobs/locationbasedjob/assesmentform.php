<form id="assessment" method="post">
  <div class="modal-body">
    <div id="partsContainer">
      <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Type of parts 1</span>
        <div class="col-lg-5 particularselection">
          <select class="form-control option dynamicSelect" name="parts[]">
            <option value="">Select Part</option>
            <option value="Metal">Metal</option>
            <option value="Rubber">Rubber</option>
            <option value="Glass">Glass</option>
            <option value="IMT">IMT</option>
            <option value="Composite / Fiber">Composite / Fiber</option>
            <option value="Second Hand">Second Hand</option>
            <option value="others">Others</option>
          </select>
        </div>
        <div class="col-lg-2 othersBox  py-0 px-0" style="display:none">
          <input type="text" name="other_parts[]" placeholder="Enter other part type" class="form-control  custom-other-input ">
        </div>
        <div class="col-lg-2 ">
          <input type="text" name="dpn[]" placeholder="Dpn" class="form-control dpn">
        </div>
        <div class="col-lg-1" style="align-self:center">
          <button type="button" onclick="addMoreParts()" class="btn btn-rounded btn-success">
            <i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <span class="label-text col-lg-3 col-form-label text-md-left py-0">Salvage</span>
      <div class="col-lg-4 form-inline">
        <label class="form-radio mr-3">
          <input type="radio" name="radio02" value="1" class="form-radio-input" onclick="addSalvageCol(this)">
          <span class="form-radio-label">Parts Wise</span>
        </label>

        <label class="form-radio">
          <input type="radio" name="radio02" value="2" class="form-radio-input" onclick="addSalvageCol(this)">
          <span class="form-radio-label">Lumpsum</span>
        </label>
      </div>
      <div class="col-lg-2 form-inline mt-2" id="lumpsumField" style="display: none;">
        <input type="text" class="form-control" name="lumpsum_value" placeholder="Enter lumpsum value">
      </div>
    </div>

    <div class="form-group row">
      <span class="label-text col-lg-3 col-form-label">Towing Estimated</span>
      <div class="col-lg-6">
        <input type="text" name="towing_estimated" id="towing_estimated" placeholder="Amount" class="form-control towing_estimated">
      </div>
    </div>

    <div class="form-group row">
      <span class="label-text col-lg-3 col-form-label">Towing Allowed</span>
      <div class="col-lg-6">
        <input type="text" name="towing_allowed" id="towing_allowed" placeholder="Amount" class="form-control towing_allowed">
      </div>
    </div>

    <div class="form-group row">
      <span class="label-text col-lg-3 col-form-label">Nil. Dep</span>
      <div class="col-lg-6">
        <select class="form-control" name="nil_dep">
          <option value="">Select</option>
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <span class="label-text col-lg-3 col-form-label">Imposed Excess</span>
      <div class="col-lg-6">
        <input type="text" name="imposed_excess" id="imposed_excess" placeholder="Amount" class="form-control imposed_excess">
      </div>
    </div>

    <div class="form-group row">
      <span class="label-text col-lg-3 col-form-label">Normal Excess</span>
      <div class="col-lg-6">
        <input type="text" name="normal_excess" id="normal_excess" placeholder="Amount" class="form-control normal_excess">
      </div>
    </div>

    <div class="form-group row">
  <span class="label-text col-lg-3 col-form-label">GST on Labour</span>
  <div class="col-lg-8">
    <div class="form-check form-check-inline">
      <input class="form-check-input" name="labour[]" type="checkbox" id="estimatelabour" value="estimate" checked>
      <label class="form-check-label" for="estimatelabour" style="color: #696969;">Estimate</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" name="labour[]" type="checkbox" id="billlabour" value="bill" checked>
      <label class="form-check-label" for="billlabour" style="color: #696969;">Bill</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" name="labour[]" type="checkbox" id="assessedlabour" value="assessed" checked>
      <label class="form-check-label" for="assessedlabour" style="color: #696969;">Assessed</label>
    </div>
  </div>
</div>

<div class="form-group row">
  <span class="label-text col-lg-3 col-form-label">GST on Parts</span>
  <div class="col-lg-8">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="gstparts[]" id="estimatepart" value="estimate" checked>
      <label class="form-check-label" for="estimatepart" style="color: #696969;">Estimate</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="gstparts[]" id="billpart" value="bill" checked>
      <label class="form-check-label" for="billpart" style="color: #696969;">Bill</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="gstparts[]" id="assessedpart" value="assessed" checked>
      <label class="form-check-label" for="assessedpart" style="color: #696969;">Assessed</label>
    </div>
  </div>
</div>

    <input type="hidden" name="form_mode" value="create" class="form_mode">
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success assesment_submitdata" >Save</button>
  </div>
</form>


