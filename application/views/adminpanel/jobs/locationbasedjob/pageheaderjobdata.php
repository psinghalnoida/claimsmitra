<style>
    .panel-contents {
        display: none;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.5s ease-out;
        
    }

    .panel-contents.open {
        display: block;
        max-height: 500px;
        /* Adjust this value based on the content height */
    }

    .collapsed-content {
        display: block;
        width: 100%;
    }

    .collapsed-content.hidden {
        display: none;
    }
    .pageheadertable th,td{
        color:#696969;
        font-size:13px;
    }
</style>




<div class="container-fluid mt-3" style="margin-bottom:15px;">
    <div class="card shadow-sm" style="padding:0px;">
        <!-- <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="cursor:pointer;" id="togglePanel">
            <h5 class="mb-0">Case Summary</h5>
        </div> -->

        <div class="panel-heading">
            <h3 class="panel-title">Case Summary</h3>
        </div>

        <div class="card-body" id="casePanel" style="border-top:none; padding: 0px 15px 15px 15px;">
            <div class="row">
                <!-- Left Table -->
                <div class="col-md-6">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>AID</th>
                            <td><?php echo htmlspecialchars($aid ?? 'NA'); ?></td>
                        </tr>
                        <tr>
                            <th>Contact Person Name</th>
                            <td><?php echo htmlspecialchars($casedata->contact_person_name ?? 'NA'); ?></td>
                        </tr>
                        <tr>
                            <th>Contact Person Mobile</th>
                            <td><?php echo htmlspecialchars($casedata->contact_person_mobile ?? 'NA'); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge badge-warning">Pending</span></td>
                        </tr>
                    </table>
                </div>

                <!-- Right Table -->
                <div class="col-md-6">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th><?php echo isset($casedata->insured_name) ? 'Name of Beneficiary' : 'Name of Consignee'; ?></th>
                            <td><?php echo htmlspecialchars($casedata->insured_name ?? $casedata->name_of_consignee ?? 'NA'); ?></td>
                        </tr>
                        <tr>
                            <th>
                                <?php
                                if (isset($casedata->loss_item)) echo 'Loss Item';
                                elseif (isset($casedata->name_of_commodity)) echo 'Commodity';
                                elseif (isset($casedata->vehicle_number)) echo 'Vehicle Number';
                                else echo 'Tag Number';
                                ?>
                            </th>
                            <td><?php echo htmlspecialchars(
                                $casedata->loss_item ?? 
                                $casedata->name_of_commodity ?? 
                                $casedata->vehicle_number ?? 
                                $casedata->tag_vehicle ?? 'NA'
                            ); ?></td>
                        </tr>
                        <tr>
                            <th>Policy Number</th>
                            <td><?php echo htmlspecialchars($casedata->policyNumber ?? $casedata->cause_loss ?? 'NA'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php if (!empty($aid) && isset($casedata)) {
                $wfClass = workflow_assignment_class($casedata);
                $wfIla = workflow_requires_ila($casedata);
                $wfLor = workflow_requires_lor($casedata);
                $wfTat = workflow_submission_tat_days($casedata);
            ?>
            <form id="jobWorkflowFlags" class="mt-2">
                <input type="hidden" name="aid" value="<?php echo htmlspecialchars($aid); ?>">
                <div class="row">
                    <div class="col-md-3">
                        <label style="font-size:13px;">Class</label>
                        <select name="assignment_class" class="form-control form-control-sm">
                            <option value="REG" <?php echo $wfClass === 'REG' ? 'selected' : ''; ?>>REG — ILA/LOR mandatory</option>
                            <option value="STY" <?php echo $wfClass === 'STY' ? 'selected' : ''; ?>>STY — template / mark</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label style="font-size:13px;">ILA (3 days from ack)</label>
                        <select name="send_ila" class="form-control form-control-sm">
                            <option value="1" <?php echo $wfIla ? 'selected' : ''; ?>>Mandatory</option>
                            <option value="0" <?php echo !$wfIla ? 'selected' : ''; ?>>Skip (STY)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label style="font-size:13px;">LOR (24 hours from ack)</label>
                        <select name="send_lor" class="form-control form-control-sm">
                            <option value="1" <?php echo $wfLor ? 'selected' : ''; ?>>Mandatory</option>
                            <option value="0" <?php echo !$wfLor ? 'selected' : ''; ?>>Skip (STY)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label style="font-size:13px;">TAT to dispatch</label>
                        <div class="d-flex">
                            <select name="submission_tat_days" class="form-control form-control-sm">
                                <option value="5" <?php echo $wfTat === 5 ? 'selected' : ''; ?>>5 days</option>
                                <option value="15" <?php echo $wfTat === 15 ? 'selected' : ''; ?>>15 days</option>
                                <option value="30" <?php echo $wfTat === 30 ? 'selected' : ''; ?>>30 days</option>
                            </select>
                            <button type="button" class="btn btn-sm btn-info ml-1" id="saveWorkflowFlags">Save</button>
                        </div>
                    </div>
                </div>
                <p class="text-muted mb-0 mt-1" style="font-size:12px;">Clock starts at acknowledgement. REG cannot skip ILA/LOR. STY follows template unless you mark here after receipt.</p>
            </form>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    $('#togglePanel').click(function(){
        $('#casePanel').slideToggle();
    });
</script>

<script>
    $(document).ready(function() {
        const $dropdownToggler = $('.dropdown-toggler');
        const $collapsedContent = $('.collapsed-content');
        const $panelContent = $('.panel-contents');
        const $chevronIcon = $dropdownToggler.find('i');

        $dropdownToggler.on('click', function() {
            if ($collapsedContent.hasClass('hidden')) {
                $collapsedContent.hide().removeClass('hidden').slideDown(500);
                $panelContent.slideUp(500, function() {
                    $panelContent.removeClass('open');
                });
                $chevronIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            } else {
                $collapsedContent.slideUp(500, function() {
                    $collapsedContent.addClass('hidden');
                });
                $panelContent.hide().addClass('open').slideDown(500); 
                $chevronIcon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
        });


        // Optional: Hide the panel content if clicking outside of it
        $(document).on('click', function(event) {
            if (!$dropdownToggler.is(event.target) && !$dropdownToggler.has(event.target).length &&
                !$panelContent.is(event.target) && !$panelContent.has(event.target).length &&
                !$collapsedContent.is(event.target) && !$collapsedContent.has(event.target).length) {
                $collapsedContent.removeClass('hidden');
                $panelContent.removeClass('open');
                $chevronIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
        });

        $('#saveWorkflowFlags').on('click', function() {
            $.ajax({
                url: '<?php echo base_url('assignment/save_job_workflow_flags'); ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#jobWorkflowFlags').serialize(),
                success: function(res) {
                    if (res.status === 'success') {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon: 'success', title: 'TAT and ILA/LOR saved', timer: 1500, showConfirmButton: false });
                        } else {
                            alert('Saved');
                        }
                    }
                }
            });
        });
    });
</script>