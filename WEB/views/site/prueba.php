<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$this->title = 'prueba';
?>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<div id="map-canvas"></div>


<script type="text/javascript">
      function initialize() {

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var location1 = new google.maps.LatLng(-33.445351, -70.621175);
        var location2 = new google.maps.LatLng(-33.443990, -70.625746);
        var location3 = new google.maps.LatLng(-33.447804, -70.624630);
        var location4 = new google.maps.LatLng(-33.447526, -70.619877);

        //var centro = new google.maps.LatLng(-33.445351, -70.621175);

        var mapOptions = {
          zoom:7,
          center: location1,
        };

        directionsService = new google.maps.DirectionsService();

        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: false,
            suppressInfoWindows: true
          });

        directionsDisplay2 = new google.maps.DirectionsRenderer({
          suppressMarkers: false,
          suppressInfoWindows: true
        });

        directionsDisplay3 = new google.maps.DirectionsRenderer({
          suppressMarkers: false,
          suppressInfoWindows: true
        });

        calcularRuta(directionsDisplay, location1, location2);

        calcularRuta(directionsDisplay2, location2, location3);

        calcularRuta(directionsDisplay3, location3, location4);
      }

      function calcularRuta(dirDisplay, start, end){
          
          dirDisplay.setMap(map);

          var request = {
            origin: start, 
            destination: end,
            travelMode: google.maps.DirectionsTravelMode.WALKING
          };
          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              dirDisplay.setDirections(response);
            }
          });
      }
google.maps.event.addDomListener(window, 'load', initialize);
</script>
