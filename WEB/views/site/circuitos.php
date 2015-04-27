<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Circuito';
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


<div class="contenedor-circuitos">
	<br>
	<h3 class="h3-movil">CIRCUITOS</h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenedor-completo-circuitos">

		<?php
			foreach ($circuitos as $circuito)
			{
				?>
				<a href='<?= Yii::$app->request->baseUrl.'/site/circuito?c='."$circuito->pk" ?>'>
					<div class="cada-circuito" style="background-color:<?php echo $circuito->color?>;">
						<?php echo Html::img(Yii::$app->request->baseUrl.'/images/circuitos/'.$circuito->icono, ['']); ?>
						<h3><?php echo $circuito->nombre; ?></h3>
						<?php
							 $descripcion = Yii::$app->funciones->quitarTags($circuito->descripcion); 
						?>
						<p><?php echo substr($descripcion, 0, 130)."..."; ?></p>
					</div>
				</a>
			<?php 
			} 
		?>
	</div>

	<div class="mapa-circuitos">
		<div id="mapa"></div>
	</div>

</div>

<script type="text/javascript">
    function initialize() {
      var marcadores = [
            <?php 
              foreach($locales as $local)
              {
                echo "[[";
                foreach($local->tiendas as $tienda)
                {
                    echo "['".$tienda->pk."', '".$tienda->nombre."', '".Yii::$app->request->baseUrl.'/images/tiendas/'.$tienda->imagen1."', '".$tienda->rating."', '".$local->direccion."', '".$tienda->numeracion."', '".$tienda->horario."', '', '".$tienda->telefono."', '".$tienda->circuitoFk->color."',], ";
                }
                echo "],".Yii::$app->funciones->coordenadasOK($local->coordenadas)."],";
              }
              foreach($patrimonios as $patrimonio)
              {
                  $descripcion = Yii::$app->funciones->quitarTags($patrimonio->descripcion); 
                  echo "[[['".$patrimonio->pk."', '".$patrimonio->nombre."', '".Yii::$app->request->baseUrl.'/images/patrimonio/'.$patrimonio->imagen."', '', '".$patrimonio->direccion."', '".substr($descripcion, 0, 100)."...', 'k21+', '', '',], ], ".Yii::$app->funciones->coordenadasOK($patrimonio->coordenadas)."],";
              }
            ?>
      ];
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 16,
        scrollwheel: false,
        center: new google.maps.LatLng(-33.445798, -70.624008),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var pinColor = "d4d5d5";
      var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor, 
      	new google.maps.Size(21, 34), 
      	new google.maps.Point(0,0), 
      	new google.maps.Point(10, 34));
      var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow", 
      	new google.maps.Size(40, 37), 
      	new google.maps.Point(0, 0), 
      	new google.maps.Point(12, 35));
      
      var infowindow = new google.maps.InfoWindow();
      var marker, i;

      for (i = 0; i < marcadores.length; i++) {  
          marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map,
          icon: pinImage, 
          shadow: pinShadow
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            var contenido = "<div class='marker-mapa'>";
            for(k = 0; k < marcadores[i][0].length; k++)
            {
              if(marcadores[i][0][k][6] == 'k21+')
                {
                  contenido = contenido + "<div class=cada-marker><div class=imagen-marker-mapa><a href='<?= Url::toRoute('site/patrimonio') ?>?p="+ marcadores[i][0][k][0] +"'><img src='" + marcadores[i][0][k][2] + "' width='100%' /></a></div><div class=contenido-marker-mapa><a id=cambiar_color_tienda href='<?= Url::toRoute('site/patrimonio') ?>?p="+ marcadores[i][0][k][0] +"'><h4>" + marcadores[i][0][k][1] + "</h4></a><h6>"+ marcadores[i][0][k][4] + "</h6><p>"+ marcadores[i][0][k][5] +"</p></div></div>";
                }
                else
                {
                    contenido = contenido + "<div class=cada-marker><div class=imagen-marker-mapa><a href='<?= Url::toRoute('site/tienda') ?>?t="+ marcadores[i][0][k][0] +"'><img src='" + marcadores[i][0][k][2] + "' width='100%' /></a></div><div class=contenido-marker-mapa><a id=cambiar_color_tienda href='<?= Url::toRoute('site/tienda') ?>?t="+ marcadores[i][0][k][0] +"'><h4>" + marcadores[i][0][k][1] + "</h4></a><h6>"+ marcadores[i][0][k][4] + ", "+ marcadores[i][0][k][5]+"</h6><p><i class='glyphicon glyphicon-calendar'></i> "+ marcadores[i][0][k][6] + "</p><p><i class='glyphicon glyphicon-earphone'></i> "+ marcadores[i][0][k][8] +"</p></div></div>";
                }
            }
            contenido = contenido + "</div>";
            infowindow.setContent(contenido);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
