<?php 
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<style type="text/css">
@media print{
	.menu-mis-rutas, footer,  .h3-movil, .info-mis-rutas h3, .mapas-mis-rutas, #social, #mapa-rutas, .gm-style, .gm-style div, .gmnoprint, .boton-imprimir-mapa, #w0 table thead tr th:last-child, #w0 table tbody tr td:last-child{
		display: none!important;
	}

	.table{
		width: 800px;
		margin: auto!important;
	}

	#w0 table thead tr th{
		background-color: #eee!important;
	}

	#logotipo-top{
		width: 150px;
		margin: 0 auto 0 auto;
		left: 43%!important;
		top: 10%!important;
	}

	a:link:after, a:visited:after {
	    content: "";
	}
}
</style>
<div class="contenedor-elbarrio">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Welcome' : 'Bienvenido(a)' ?> <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre).' > '.($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Current Path' : 'Ruta Actual');?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario($idioma->abreviacion) ?>
		</div>
		<div class="info-mis-rutas">
			<h3><?= ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Current Path' : 'Ruta Actual') ?></h3>
			<div class="contenedor-info-rutas">

				<?php if($ruta != NULL && $tiendas != null): ?>
					<div class="mapa-mis-rutas">
						<div id="mapa-rutas"></div>
					</div>

					<br /><br />
					<br /><br />
				<div class="tiendas-ruta-usuario">
				        <?= GridView::widget([
				            'dataProvider' => $dataProvider,
				            'summary' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Showing' : 'Mostrando')." <b>{begin}</b>-<b>{end}</b> ".($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'of' : 'de')." <b>{count}</b> ".($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Records' : 'Registros'),
				            'columns' => [
				                ['class' => 'yii\grid\SerialColumn'],

				                [
				                    'header' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Store' : 'Tienda'),
				                    'attribute' => 'tienda_fk',
				                    'value' => function ($data) {
				                        return $data->tiendaFk->nombre;
				                    },
				                ],
				                [
				                    'header' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Address' : 'Dirección'),
				                    'attribute' => 'tienda_fk',
				                    'value' => function ($data) {
				                        return $data->tiendaFk->localFk->direccion;
				                    },
				                ],
				                [
				                    'header' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Phone' : 'Teléfono'),
				                    'attribute' => 'tienda_fk',
				                    'value' => function ($data) {
				                        return $data->tiendaFk->telefono;
				                    },
				                ],

				                [
				                	'class' => 'yii\grid\ActionColumn', 
				                	'template' => '{view} {delete}',
				                	'header'=>($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Actions' : 'Acciones'),
				                	'contentOptions' => ['style' => 'width:70px;'],
				                	'buttons' => [
									    'view' => function ($url, $model) {
									        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['site/tienda', 'id'=>$model->tienda_fk, 'lan'=>$_GET['lan']], ['title' => Yii::t('app', 'Ver'),]);
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
						<p><?= ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? "Sorry, You don't have current route" : 'Lo sentimos, No tienes rutas actuales.') ?></p>
				<?php endif; ?>
				<div class="boton-imprimir-mapa">
						<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Print' : 'Imprmir mapa']), "javascript:window.print()"); ?>
				</div>
			</div>
		</div>
	</div>
	
</div>

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
