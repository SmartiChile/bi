<?php 
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

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

				<?php if($ruta != NULL && $tiendas != null): ?>
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

<?php if($tiendas != null): ?>
<script  type="text/javascript">
    function initialize() {
        map = new google.maps.Map(document.getElementById('mapa-rutas'), mapOptions);
        directionsService = new google.maps.DirectionsService();
        var ruta = [
		  <?php foreach($tiendas as $tienda): ?>
		 		new google.maps.LatLng(<?= Yii::$app->funciones->coordenadasOK($tienda->tiendaFk->localFk->coordenadas) ?>), 
		  <?php endforeach; ?>
		];

        var location1 = new google.maps.LatLng(-33.445351, -70.621175);
        var location2 = new google.maps.LatLng(-33.443990, -70.625746);
        var location3 = new google.maps.LatLng(-33.447804, -70.624630);
        var location4 = new google.maps.LatLng(-33.447526, -70.619877);

        //var centro = new google.maps.LatLng(-33.445351, -70.621175);

        var mapOptions = {
          zoom:7,
          center: location1,
        };

        <?php 
        	$c = count($tiendas) - 1;
        	foreach($tiendas as $t=>$tienda):
        ?>
        directionsDisplay<?= $t ?> = new google.maps.DirectionsRenderer();
        calcularRuta(directionsDisplay<?= $t ?>, ruta[<?= ($t) ?>], ruta[<?= $c == 0 ? $t : $t+1 ?>]);
        <?php endforeach; ?>
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
<?php endif; ?>