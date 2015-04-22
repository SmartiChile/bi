<?php 
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<div class="contenedor-elbarrio">
	<br>
	<h3>Bienvenido(a) <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);?> - Ruta actual</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario() ?>
		</div>
		<div class="info-mis-rutas">
			<h3>Ruta actual</h3>
			<div class="contenedor-info-rutas">

					

				<?php if($ruta != NULL): ?>
					<div class="mapa-mis-rutas">
						<div id="mapa-rutas"></div>
					</div>
					<div class="boton-imprimir-mapa">
						<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=>'Imprimir ruta']), "javascript:imprSelec('mapa-rutas')"); ?>
					</div>
					<br /><br />
					<br /><br />
				<div class="tiendas-ruta-usuario">
				        <?= GridView::widget([
				            'dataProvider' => $dataProvider,
				            'columns' => [
				                ['class' => 'yii\grid\SerialColumn'],

				                [
				                    'header' => 'Tienda',
				                    'attribute' => 'tienda_fk',
				                    'value' => function ($data) {
				                        return $data->tiendaFk->nombre;
				                    },
				                ],
				                [
				                    'header' => 'Dirección',
				                    'attribute' => 'tienda_fk',
				                    'value' => function ($data) {
				                        return $data->tiendaFk->localFk->direccion;
				                    },
				                ],
				                [
				                    'header' => 'Teléfono',
				                    'attribute' => 'tienda_fk',
				                    'value' => function ($data) {
				                        return $data->tiendaFk->telefono;
				                    },
				                ],

				                [
				                	'class' => 'yii\grid\ActionColumn', 
				                	'template' => '{view} {delete}',
				                	'header'=>'Acciones',
				                	'contentOptions' => ['style' => 'width:70px;'],
				                	'buttons' => [
									    'view' => function ($url, $model) {
									        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['site/tienda', 't'=>$model->tienda_fk], ['title' => Yii::t('app', 'Ver'),]);
									    },
									    'delete' => function ($url, $model) {
									        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->getUrlManager()->createUrl(['site/delcontenidoruta', 'id' => $model->pk, 'v' => 1]), ['title' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('yii', '¿Está seguro que desea eliminar este item?'), 'data-method'=>'post']);
									    }
									],
				                ],
				            ],
				        ]); ?>
				</div>
				<?php else: ?>
						<p>No tiene ruta actual en este momento.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	function imprSelec(imprimir){
		var ficha = document.getElementById(imprimir);
		var ventimp = window.open(' ','popimpr');
		ventimp.document.write(ficha.innerHTML);
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
}
</script>

<?php 
	if($ruta != NULL):
?>
<script type="text/javascript">
    function initialize() {
      	var marcadores = [
      		<?php 
      			foreach($tiendas as $tienda){
      				echo "['".$tienda->tiendaFk->nombre."', ".Yii::$app->funciones->coordenadasOK($tienda->tiendaFk->localFk->coordenadas)."],";
      			}
      		?>
      	];

      	var map = new google.maps.Map(document.getElementById('mapa-rutas'), {
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
            infowindow.setContent(marcadores[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
    }

   	var ruta = [
   		<?php
   			foreach($tiendas as $tienda)
   			{
				echo "new google.maps.LatLng(".Yii::$app->funciones->coordenadasOK($tienda->tiendaFk->localFk->coordenadas)."),";
			} 
   		?>
    ];

   	var lineas = new google.maps.Polyline({        
    	path: ruta,
		map: map, 
		strokeColor: '#F33', 
		strokeWeight: 4,  
		strokeOpacity: 0.7, 
		clickable: false     
		});       
    }

    google.maps.event.addDomListener(window, 'load', initialize);   
</script>
<?php endif ?>