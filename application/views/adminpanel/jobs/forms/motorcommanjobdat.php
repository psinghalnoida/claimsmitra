<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Type of Vehicle</span>
   <div class="col-lg-3">
        <select class="form-control" name="prvt_cmrcl">
            <option value="">Select option</option>
            <option value="Private">Private</option>
            <option value="Commercial">Commercial</option>
        </select>
        <div id="error_message" style="color: red;"></div>
    </div>

    <div class="col-lg-6">
        <select class="form-control type_of_vehicle" id="type_of_vehicle" name="type_of_vehicle">
            <option value="">Select option</option>
        </select>
    </div>

</div>
<div class="form-group row">
    <span class="label-text col-lg-3 col-form-label">Vehicle No.</span>
    <div class="col-lg-9">
        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" placeholder="Vehicle No.">
    </div>
</div>
<div class="form-group row" id="other_type_container" style="display:none;">
    <span class="label-text col-lg-3 col-form-label">Specify Other Type of Vehicle</span>
    <div class="col-lg-9">
        <input type="text" class="form-control" id="other_type" name="other_type" placeholder="Specify Other Type of Vehicle">
    </div>
</div>
<?php
if (isset($natureofjob) && in_array($natureofjob, [1, 2, 3, 4])) {
?>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of Registered Owner</span>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="registered_owner" name="registered_owner" placeholder="Name of Registered Owner">
        </div>
    </div>
<?php
} else {
?>
    <div class="form-group row">
        <span class="label-text col-lg-3 col-form-label">Name of Insured</span>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="insured_name" name="insured_name" placeholder="Name of Insured">
        </div>
    </div>
<?php
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        const vehicleOptions = {
            private: `
                <option value="">Select option</option>
                <option value="motor_car">Motor Car</option>
                <option value="Tractor">Tractor</option>
                <option value="motor_cycle">Motor Cycle</option>
                <option value="other">Other</option>
            `,
            commercial: `
                <option value="">Select option</option>
                <option value="motor_cab">Motor Cab</option>
                <option value="Tractor">Tractor</option>
                <option value="motor_cycle">Motor Cycle</option>
                <option value="construction_equipment">Construction Equipment</option>
                <option value="goods_carrier">Goods and Carrier</option>
                <option value="Bus">Bus</option>
                <option value="other">Other</option>
            `
        };

        $('select[name="prvt_cmrcl"]').on('change', function () {
            const selected = $(this).val().toLowerCase();
            if (selected === "private") {
                $('#type_of_vehicle').html(vehicleOptions.private);
            } else if (selected === "commercial") {
                $('#type_of_vehicle').html(vehicleOptions.commercial);
            } else {
                $('#type_of_vehicle').html('<option value="">Select option</option>');
            }
        });
    });

</script>