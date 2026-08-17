$(document).ready(function() {
    $('#pmr').change(function() {
        updatepmrfield($(this).val());
    });

    // Initial field update
    var pmr_certificate = "<?php echo isset($reportdata) ? $reportdata->pmr : null ?>";
                updatepmrfield(pmr_certificate);

    // Function to update fields based on pmr_certificate value
    function updatepmrfield(pmr_certificate) {
        const fields = $('#additional_field, #additional_fields_2, #additional_fields_3, #cause_of_death_pmr');
        if (pmr_certificate === 'Yes') {
            fields.css('display', 'flex').show();
            } else {
            fields.hide(); // Hide all fields
        }
    }

    /* ------------------------------------------------------------------------- *
     * ON CHANGE TREATMENT CHART FILED HIDE AND SHOW INPUT FIELD(KAJAL)
     * ------------------------------------------------------------------------- */
    $('#treatment_chart').change(function() {
        $('#additional_fields_4').hide();
        updatetreatmentchartfield($(this).val());
    });

    var treatment_chart = "<?php echo isset($reportdata) ? $reportdata->treatment_chart : null ?>";
    updatetreatmentchartfield(treatment_chart);

    function updatetreatmentchartfield(treatment_chart) {
        if (treatment_chart === 'Yes') {
            $('#additional_fields_4').css('display', 'flex');
            $('#additional_fields_4').show();
        } else {
            $('#additional_fields_4').hide();
        }
    }
});