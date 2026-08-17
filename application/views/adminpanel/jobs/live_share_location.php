<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
           <a  href="live_location_based"> <div class="col" style="text-align:right; color: red; cursor: pointer;">X</div></a>
            <div class="row">

                <div class="col-12">
                    <a href="#" data-target="#non_location" id="non_location_job" data-toggle="modal" data-dismiss="modal">
                        <div class="weather--panel text-black box_content" style="border:1px solid;">
                            <div class="weather--title">
                                <span>Live Location Based</span>
                            </div>
                           
                        </div>
                    </a>

                    <div class="col" style="margin: 5px;">
                        <label>Location</label>
                        <input type="text" class="form-control" value="" id="hashcode">

                    </div>
                    <div class="col" style="text-align: right;">
                        
                    <button class="btn btn-success" onclick="cpy_location()" id="button">Copy</button>
                    <a href="live_location_based"> <button class="btn btn-danger">Close</button></a>
                    </div>
                </div>
             
                         
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    

function cpy_location() {
   
  var copyText = document.getElementById("hashcode");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  
  $("#button").text('Copied');

 /* var tooltip = document.getElementById("myTooltip"+idd);
  tooltip.innerHTML = "Copied:";*/
 // document.getElementById("myTooltip"+idd).style.display = "block";

}

</script>