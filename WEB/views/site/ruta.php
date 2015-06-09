<?php 
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<div class="contenedor-elbarrio">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Welcome' : 'Bienvenido(a)' ?> <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre).' > '.($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Route' : 'Ruta');?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario($idioma->abreviacion) ?>
		</div>
		<div class="info-mis-rutas">
			<h3>Rutas ID: <?= $model->pk ?></h3>
			<div class="panel-ruta-usuario">
					<div class="mapa-mis-rutas">
						<div id="mapa-rutas"></div>
					</div>
					
					<br /><br />
					<br /><br />
				<div class="tiendas-ruta-usuario" id="imprimir">
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
									        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->getUrlManager()->createUrl(['site/delcontenidoruta', 'id' => $model->pk, 'v' => 2, 'lan' =>$_GET['lan']]), ['title' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('yii', '¿Está seguro que desea eliminar este item?'), 'data-method'=>'post']);
									    }
									],
				                ],
				            ],
				        ]); ?>
				</div>
			</div>
		</div>
					<div class="boton-imprimir-mapa">
						<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=>'Imprimir ruta']), "javascript:imprSelec('imprimir')"); ?>
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