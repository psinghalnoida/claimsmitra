<!DOCTYPE html>
<!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->


<html>
  <head>
    <title>Places Search Box</title>





    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
  <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
          href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  /**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
/* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
#map {
  height: 100%;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
.gmnoprint{
  display: none;
}

#pac-input {
  height: 50px;
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;

}

.mapstyle{

}
@media only screen and (max-width: 600px) {
 #pac-input {
   left: 0px !important;
  }

.mapstyle{
  height: 250px !important;
  
}
}


#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}


</style>

  </head>
  <body  oncontextmenu="return false;">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php


$hasid=$_GET['hashtoken'];


if (isset($_POST['action'])){
$address=$_POST['address'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$hashtoken=$_POST['hashcde'];




if($address=='' && $latitude!='')
{




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDqDvj4CpFPG614lwfOw_nifvThJn9AWec',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
 $response;
    /*$www=json_decode($response, TRUE);*/


   $response[0];
  $www=json_decode($response, TRUE);

foreach($www['results'] as $result) {
  $wwwaa= $result["formatted_address"];
// echo json_encode($wwwaa, TRUE);




}


  echo "<script>swal({

  title: 'Search Your Location',
  
    type: 'warning',

});</script>";
}

else if($address!='' && $latitude!='')
{

$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$baseurl= $config['base_url']; 


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseurl.'Api/claims_job_locatioon',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('aid' => $hashtoken,'location' =>$address,'latitude' => $latitude,'longitude' =>$longitude),
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=cg9fh4ouaq2gsvea885erc1moappon64'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
 $response;
 $www=json_decode($response, TRUE);


 $successmsg= json_encode($www['success'], TRUE);

if($successmsg=='true')
{
  echo "<script>swal({

  title: 'Successfully Update Location',
  
    type: 'warning',

});</script>";
} 
else
{
  echo "<script>swal({

  title: 'For this case location already shared',
  
    type: 'warning',

});</script>";
}








}

else
{

  echo "<script>swal({

  title: 'Search Your Location',
  
    type: 'warning',

});</script>";
}








}



?>


    <div class="row">
      <div class="col-md-6">
        <div class="row"> <input class="form-control"
      id="pac-input"
      class="controls"
      type="text"
      placeholder="Search  your Location"
    /></div>

    <div id="map" class="mapstyle" style="height: 500px; width: 100%;"></div>


      </div>
      <div class="col-md-6">
        
<form  method="post">
<?php $config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
 $config['base_url']; ?>
      <textarea  style="height: 150px; width:250px;" name="address" class="form-control" id="address" readonly></textarea>
       <input type="hidden" name="hashcde" value="<?php echo $hasid;?>">
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">


<button type="submit" name="action" style="margin:10px;" class="btn btn-success">Confirm Location</button>
</form>
      </div>
    </div>
 

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>

    <script type="text/javascript">
      /**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
// @ts-nocheck TODO remove when fixed
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initAutocomplete() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8688, lng: 151.2195 },
    zoom: 13,
    mapTypeId: "roadmap",
     draggableCursor: 'pointer'
  });
  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };

      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          
          title: place.name,
          position: place.geometry.location,
        })



      );


    //  console.log(place.formatted_address);
    //   console.log(place.adr_address);
 console.log(place.geometry.location.toJSON());  
//Latitude and longitude............
document.getElementById("latitude").value=place.geometry.location.toJSON().lat;
document.getElementById("longitude").value=place.geometry.location.toJSON().lng;



var rs=document.getElementById("pac-input").value;
//console.log(rs);
document.getElementById("address").value=rs;
//type location...............

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);


  });

  map.addListener("click", (event) => {

    addMarker(event.latLng);
  });






function addMarker(position) {
deleteMarkers();
  const marker = new google.maps.Marker({
    position,
    map,

  });

console.log(position.toJSON());
var pp=position.toJSON();
var clicklat=position.toJSON().lat;
var clicklng=position.toJSON().lng;
//


document.getElementById("latitude").value=clicklat;
document.getElementById("longitude").value=clicklng;


  const Http = new XMLHttpRequest();
var reverce="https://maps.googleapis.com/maps/api/geocode/json?latlng="+clicklat+","+clicklng+"&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDqDvj4CpFPG614lwfOw_nifvThJn9AWec";
console.log(reverce);     

 Http.open("GET", reverce);
      Http.send();

      Http.onreadystatechange = e => {


const text = Http.responseText;
console.log(text);
  var www=JSON.parse(text);
console.log(www.plus_code["compound_code"]);
var locc='';
if(www.results!='')
{
 locc=www.results[0]["formatted_address"];
}
else
{
 locc=www.plus_code["compound_code"];

}


var tip_location=locc;
document.getElementById("address").value=tip_location;
}


  markers.push(marker);
}

function setMapOnAll(map) {
  for (let i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function deleteMarkers() {
 setMapOnAll(null);
  markers = [];
}




let   infoWindow;




  infoWindow = new google.maps.InfoWindow();

  if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };


var clicklat=position.coords.latitude;
var clicklng=position.coords.longitude;


document.getElementById("latitude").value=clicklat;
document.getElementById("longitude").value=clicklng;


  const Http = new XMLHttpRequest();
var reverce="https://maps.googleapis.com/maps/api/geocode/json?latlng="+clicklat+","+clicklng+"&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDqDvj4CpFPG614lwfOw_nifvThJn9AWec";
console.log(reverce);     

 Http.open("GET", reverce);
      Http.send();

      Http.onreadystatechange = e => {


const text = Http.responseText;
console.log(text);
  var www=JSON.parse(text);



var tip_location=www.results[0]["formatted_address"];
document.getElementById("address").value=tip_location;
}



   var marker = new google.maps.Marker({
      position: pos,
      map: map,
       icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
    }
   });
         // infoWindow.setPosition(pos);
          //infoWindow.setContent("Location found.");
          //infoWindow.open(map);
          map.setCenter(pos);


        },

        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
  } 



}





window.initAutocomplete = initAutocomplete;


    </script>
  </body>
</html>
