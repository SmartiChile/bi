<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Circuito - '.$model->nombre;
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/jquery.bxslider.css');
$this->registerJs('
		$(".bxslider").bxSlider({
		  minSlides: 3,
		  maxSlides: 12,
		  slideWidth: 60,
		  slideMargin: 50
		});
');
?>

<style type="text/css">
    <?php
        foreach ($circuitos as $circuito) {
            echo ".c_".$circuito->pk.":before{ content:url(".Yii::$app->request->baseUrl."/images/circuitos/".$circuito->icono."); margin: 4.5% 0 0 0; }";
        } 
    ?>

    .container{
    	padding: 0 !important;
    	margin: 0 !important;
    }

</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


<div class="contenedor-circuitos">
	<br>
	<h3 class="h3-movil"><?php echo $model->nombre; ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenedor-botones">
        <?php
                foreach ($circuitos as $circuito) {
                $ruta = Url::toRoute(['site/circuito', 'id'=>$circuito->pk, 'lan'=>$idioma->abreviacion]);
                ?>
                <button type="button" onclick="window.location.href='<?php echo $ruta ?>'" style="background-color:<?php echo $circuito->color; ?>" class="btn-circuito btn-circuito-5 btn-circuito-5b c_<?php echo $circuito->pk; ?>"><span><?php echo "&nbsp;&nbsp;&nbsp;".$circuito->nombre."&nbsp;&nbsp;&nbsp;"; ?></span></button>
                <?php
             } 
        ?>
    </div>
    <div class="info-circuito" style="background-color:<?php echo $model->color; ?>">
    	<div class="slides-tiendas-circuito">
	    	<ul class="bxslider">
			   <?php foreach ($tiendas as $tienda): ?>
                <li><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$tienda->logotipo), ['site/tienda', 'id'=>$tienda->pk, 'lan'=>$idioma->abreviacion], ['class'=>'tool', 'title'=>$tienda->nombre]); ?></li>
          <?php endforeach; ?>
          <?php foreach ($patrimonios as $patrimonio): ?>
                <li><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/patrimonio/icono-patrimonio.png'), ['site/patrimonio?p='.$patrimonio->pk], ['class'=>'tool', 'title'=>$patrimonio->nombre]); ?></li>
          <?php endforeach; ?>
			</ul>
    	</div>
    	<div class="mapa-circuito">
    		<div id="mapa"></div>
    	</div>
    	<div class="contenedor-info-cada-circuito">
	    	<div class="info-cada-circuito">
	    		<div class="informacion-circuito">
	    			<h3><?php echo Html::img(Yii::$app->request->baseUrl.'/images/circuitos/'.$model->icono, ['width'=>'', 'id'=>"margen-icono-circuito"]); ?> <?php echo $model->nombre; ?></h3>
	    			<?php echo $model->descripcion; ?>
	    		</div>
	    		<div class="logotipo-circuito-tienda">
	    			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/circuitos/'.$model->imagen, ['width'=>'100%']); ?>
	    		</div>
	    	</div>
	    </div>
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
                  if($tienda->circuito_fk == $model->pk){
                    echo "['".$tienda->pk."', '".$tienda->nombre."', '".Yii::$app->request->baseUrl.'/images/tiendas/'.$tienda->imagen1."', '".$tienda->rating."', '".$local->direccion."', '".$tienda->numeracion."', '".$tienda->horario."', '', '".$tienda->telefono."',], ";
                  }
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

      var pinColor = "<?php echo Yii::$app->funciones->eliminarColor($model->color)?>";
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
                  contenido = contenido + "<div class=cada-marker><div class=imagen-marker-mapa><a href='<?= Url::toRoute(['site/patrimonio', 'lan' => $idioma->abreviacion]) ?>/"+ marcadores[i][0][k][0] +"'><img src='" + marcadores[i][0][k][2] + "' width='100%' /></a></div><div class=contenido-marker-mapa><a id=cambiar_color_tienda href='<?= Url::toRoute(['site/patrimonio', 'lan' => $idioma->abreviacion]) ?>/"+ marcadores[i][0][k][0] +"'><h4>" + marcadores[i][0][k][1] + "</h4></a><h6>"+ marcadores[i][0][k][4] + "</h6><p>"+ marcadores[i][0][k][5] +"</p></div></div>";
                }
                else
                {
                    contenido = contenido + "<div class=cada-marker><div class=imagen-marker-mapa><a href='<?= Url::toRoute(['site/tienda', 'lan' => $idioma->abreviacion]) ?>/"+ marcadores[i][0][k][0] +"'><img src='" + marcadores[i][0][k][2] + "' width='100%' /></a></div><div class=contenido-marker-mapa><a id=cambiar_color_tienda href='<?= Url::toRoute(['site/tienda', 'lan' => $idioma->abreviacion]) ?>/"+ marcadores[i][0][k][0] +"'><h4>" + marcadores[i][0][k][1] + "</h4></a><h6>"+ marcadores[i][0][k][4] + ", "+ marcadores[i][0][k][5]+"</h6><p><i class='glyphicon glyphicon-calendar'></i> "+ marcadores[i][0][k][6] + "</p><p><i class='glyphicon glyphicon-earphone'></i> "+ marcadores[i][0][k][8] +"</p></div></div>";
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