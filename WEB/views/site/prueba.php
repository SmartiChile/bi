<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$this->title = 'prueba';
?>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>


    <div id="panel">
    <b>Start: </b>
    <select id="start" onchange="calcRoute();">
      <option value="Santa Isabel 300, Santiago, Chile">Chicago</option>
      <option value="Italia 987, Santiago, Chile">St Louis</option>
      <option value="Italia 1301, Santiago, Chile">Joplin, MO</option>
    </select>
    <b>End: </b>
    <select id="end" onchange="calcRoute();">
      <option value="Santa Isabel 300, Santiago, Chile">Chicago</option>
      <option value="Italia 987, Santiago, Chile">St Louis</option>
      <option value="Italia 1301, Santiago, Chile">Joplin, MO</option>
    </select>
    </div>
    <div id="map-canvas"></div>

<script>
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
  var mapOptions = {
    zoom:7,
    center: chicago
  };
  calcRoute("Santa Isabel 300, Santiago, Chile","Italia 987, Santiago, Chile");
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
}

function calcRoute(start, end) {
  var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.TravelMode.WALKING,
	  optimizeWaypoints: true,
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
