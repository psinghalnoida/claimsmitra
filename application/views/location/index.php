<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>Share Live Location</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="<?php echo base_url(); ?>favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/morris.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-jvectormap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/horizontal-timeline.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ion.rangeSlider.skinFlat.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

</head>
<body>
    <div class="wrapper">
        <main class="main--container" style="padding: 0px;">
            <section class="main--content">
      <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="align-self: center;">Share Current Location</h3>
            <div style="text-align: right;">
                <button class="btn btn-rounded btn-success" id="getCurrentLocationBtn">Current Location</button>
            </div>
        </div>
        <div class="form-group row" style="margin-left: 5px; margin-right: 5px;">
            <div class="col-md-12" style="position: relative;">
                <input type="text" name="searchlocation" id="searchlocation" placeholder="Search Location..." class="form-control">
                 <button class="btn btn-outline-secondary" type="button" id="clearSearch" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: transparent; border: none;"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="panel-content">
            <div id="map" style="height: 400px; width: 100%;">
                <!-- Map will be displayed here -->
            </div>
        </div>
        <div class="panel-footer pb-4" style="text-align: center;">
            <button type="submit" class="btn btn-rounded submit-btn" style="background-color: #E16123;color: #fff; width: 130px;font-size:17px;">Submit</button>
            <button type="button" class="btn btn-rounded" style="background-color:#808080;color: #fff; width: 130px;font-size: 17px;">Cancel</button>
        </div>
        <!-- <input type="hidden" id="currentLatitude" name="currentLatitude">
        <input type="hidden" id="currentLongitude" name="currentLongitude">
        <input type="hidden" id="searchLatitude" name="searchLatitude">
        <input type="hidden" id="searchLongitude" name="searchLongitude"> -->
            <div id="currentLatitude"></div>
            <div id="currentLongitude"></div>
            <div id="searchLatitude"></div>
            <div id="searchLongitude"></div>
            <!--  <div id="markerLatitude"></div>
            <div id="markerLongitude"></div> -->
    </div>
</section>
</main>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-jvectormap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/horizontal-timeline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.steps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dropzone.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ion.rangeSlider.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBKTLjJ3rqRm_qVpjVn9gP-efBlO1ivdCo&q="></script>




       <!-- // Add event listener to the submit button -->
<script>
    $(document).ready(function() {
        getCurrentLocation();
    });
    
    $(document).ready(function() {
        // Function to initialize Google Maps Places Autocomplete
        function initializeAutocomplete() {
            var input = document.getElementById('searchlocation');
            var options = {
                types: ['geocode']
            };
            var autocomplete = new google.maps.places.Autocomplete(input, options);
        }

        // Initialize Autocomplete when the document is ready
        initializeAutocomplete();
    });
    $(document).ready(function() {
        // Add listener when a place is selected from Autocomplete
        $(document).on('place_changed', '#searchlocation', function() {
            // Get the selected place from the Autocomplete object
            var place = $('#searchlocation').getPlace();
            if (!place.geometry) {
                window.alert("No details available for input: '" + input.value + "'");
                return;
            }

            // If the place has a geometry, then pan the map to it
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
                map.panToBounds(place.geometry.viewport); // Smoothly pan to the selected location
            } else {
                map.panTo(place.geometry.location); // Smoothly pan to the selected location
                map.setZoom(50); // Zoom in to a certain level
            }

            // Set marker position to the selected place
            marker.setPosition(place.geometry.location);

            // Update latitude and longitude display elements
            $('#searchLatitude').text("searchLatitude: " + place.geometry.location.lat());
            $('#searchLongitude').text("searchLongitude: " + place.geometry.location.lng());
        });
    });
        var map;
        var marker;
        var current_latitude;
        var current_longitude;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {});
            marker = new google.maps.Marker({
                map: map,
                draggable: true, // Allow marker to be dragged
            });

            // Add event listener for click on the map
            map.addListener('click', function (event) {
                // Set marker position to clicked location
                marker.setPosition(event.latLng);

                // Update latitude and longitude display elements
                var currentLocation = event.latLng;
                $('#currentLatitude').text("Current Latitude: " + currentLocation.lat());
                $('#currentLongitude').text("Current Longitude: " + currentLocation.lng());

                // Reverse geocoding to update address input field
                reverseGeocode(currentLocation);
            });

            // Add event listener for marker dragend
            marker.addListener('dragend', function () {
                // Get marker position
                var position = marker.getPosition();

                // Reverse geocoding to update address input field
                reverseGeocode(position);
            });

            // Initialize Autocomplete
            var input = document.getElementById('searchlocation');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            // Add listener when a place is selected from Autocomplete
            autocomplete.addListener('place_changed', function () {
                // Get the selected place from the Autocomplete object
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + input.value + "'");
                    return;
                }

                // If the place has a geometry, then center the map on it
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17); // Zoom in to a certain level
                }

                // Set marker position to the selected place
                marker.setPosition(place.geometry.location);

                // Update latitude and longitude display elements
                // $('#searchLatitude').text("Select Address Latitude: " + place.geometry.location.lat());
                // $('#searchLongitude').text("Select Address Longitude: " + place.geometry.location.lng());
                current_latitude = place.geometry.location.lat();
                current_longitude = place.geometry.location.lng();
            });

            // Add click event listener to the "Current Location" button
            $('#getCurrentLocationBtn').on('click', getCurrentLocation);

            // Show current location on map when the page loads
            getCurrentLocation();
        }

        //onload method for current location
        function getCurrentLocation() {
            // Check if Geolocation is supported by the browser
            if ("geolocation" in navigator) {
                // Get the current position
                navigator.geolocation.getCurrentPosition(function (position) {
                    var currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Pan the map smoothly to the current location
                    map.panTo(currentLocation);

                    // Optionally, adjust zoom level
                    map.setZoom(17);

                    // Set marker position to the current location
                    marker.setPosition(currentLocation);

                    // Update latitude and longitude display elements
                    // $('#currentLatitude').text("Current Latitude: " + currentLocation.lat);
                    // $('#currentLongitude').text("Current Longitude: " + currentLocation.lng);

                    current_latitude = currentLocation.lat;
                    current_longitude = currentLocation.lng;
                    // Update current location input field
                    $('#searchlocation').val("Current Location");

                    // Reverse geocoding to update address input field
                    reverseGeocode(currentLocation);
                }, function (error) {
                    window.alert('Error: The Geolocation service failed. ' + error.message);
                });
            } else {
                // Browser doesn't support Geolocation
                window.alert('Error: Your browser doesn\'t support Geolocation.');
            }
        }

        function reverseGeocode(location) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'location': location }, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        // Update input field with address
                        $('#searchlocation').val(results[0].formatted_address);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }

        // Trigger initialization of map when the page loads
        initMap();

        $('.submit-btn').on('click', function(event) {
            event.preventDefault(); // Prevent the form from submitting
            var aid = '<?php echo $aid; ?>';
            var casetype = '<?php echo $casetype; ?>';
            var latitude = current_latitude;
            var longitude = current_longitude;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cases/storelocation'); ?>",
                dataType:"json",
                data: {latitude:latitude,longitude:longitude,casetype:casetype,aid:aid},

                success: function(response) {
                    if (response)
                    {
                        window.location.href = "<?php echo base_url('thankyou'); ?>";
                    }
                }
            });   
        });


       //For Removing text of input field
    $(document).ready(function() {
        $('#clearSearch').click(function() {
            $('#searchlocation').val('');
        });
    });

</script>


</body>
</html>
