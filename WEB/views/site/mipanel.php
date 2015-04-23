<?php 
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<style type="text/css">
	@media print{
	  #mapa-rutas{
	  	width: 100% !important;
	  	display: block !important; 
	  }

	  .footer-final, .menu-mis-rutas, #banner, .tiendas-ruta-usuario, .no-imprimir{
	  	display: none;
	  }

	  @page { 
	  	size: landscape; 
	  }
	}
</style>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<div class="contenedor-elbarrio">
	<br>
	<h3 class="no-imprimir">Bienvenido(a) <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);?> - Ruta actual</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario() ?>
		</div>
		<div class="info-mis-rutas" id="imprimir-mapa">
			<h3>Ruta actual</h3>
			<div class="contenedor-info-rutas">

				<?php if($ruta != NULL && $tiendas != null): ?>
					<div id="imprimir" class="mapa-mis-rutas">
						<div id="mapa-rutas"></div>
					</div>
					<div class="boton-imprimir-mapa no-imprimir">
						<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=>'Imprimir ruta', 'onclick' => 'return imprimir();'])); ?>
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

<script>
	function imprimir(){
		window.print();
	}
</script>

<?php if($tiendas != null): ?>
<script  type="text/javascript">
    function initialize() {
    	var ruta = [
		  <?php foreach($tiendas as $tienda): ?>
		 		new google.maps.LatLng(<?= Yii::$app->funciones->coordenadasOK($tienda->tiendaFk->localFk->coordenadas) ?>), 
		  <?php endforeach; ?>
		];
    	var mapOptions = {
          center: ruta[0],
          zoom: 16,
        };
        map = new google.maps.Map(document.getElementById('mapa-rutas'), mapOptions);
        directionsService = new google.maps.DirectionsService();
        
        <?php 
        	$c = count($tiendas) - 1;
        	foreach($tiendas as $t=>$tienda):
        ?>
        directionsDisplay<?= $t ?> = new google.maps.DirectionsRenderer({preserveViewport: true});
        calcularRuta(directionsDisplay<?= $t ?>, ruta[<?= ($t) ?>], ruta[<?= $c == 0 ? $t : $t+1 ?>]);
        <?php endforeach; ?>
    }

      function calcularRuta(dirDisplay, start, end){
          dirDisplay.setMap(map);
          var request = {
            origin: start, 
            destination: end,
            optimizeWaypoints: true,
            travelMode: google.maps.DirectionsTravelMode.WALKING,
          };
          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              dirDisplay.setDirections(response);
            }
          });
      }

	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php endif; ?>
