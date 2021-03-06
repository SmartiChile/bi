<?php 
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<style type="text/css">
	.wrap{
	padding: 0 !important;
}
</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<div class="contenedor-elbarrio">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Welcome' : 'Bienvenido(a)' ?> <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre).' > '.($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'My Routes' : 'Mis Rutas');?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario($idioma->abreviacion) ?>
		</div>
		<div class="info-mis-rutas">
			<h3><?= ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'My Routes' : 'Mis Rutas') ?></h3>
			<div class="tiendas-ruta-usuario">
				<?php yii\widgets\Pjax::begin() ?>
				        <?= GridView::widget([
				        	'options' => ['id' => 'uno'],
				            'dataProvider' => $dataProvider,
				            'summary' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Showing' : 'Mostrando')." <b>{begin}</b>-<b>{end}</b> ".($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'of' : 'de')." <b>{count}</b> ".($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Records' : 'Registros'),
				            'columns' => [
				                ['class' => 'yii\grid\SerialColumn'],

				                [
				                    'header' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'ID' : 'Identificador'),
				                    'attribute' => 'pk',
				                    'value' => function ($data) {
				                        return ($_GET['lan'] == 'en' || $_GET['lan'] == 'EN' ? 'ID Route: ' : 'Ruta ID: ').$data->pk.", ".($_GET['lan'] == 'en' || $_GET['lan'] == 'EN' ? 'Owner: ' : 'Propietario: ').$data->usuarioFk->nombre." <".$data->usuarioFk->username.">";
				                    },
				                ],

				                [
				                    'header' => ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Finished?' : '¿Terminada?'),
				                    'attribute' => 'terminada',
				                    'value' => function ($data) {
				                        if($data->terminada == 1)
				                        	return ($_GET['lan'] == 'en' || $_GET['lan'] == 'EN' ? 'Yes' : 'Sí');
				                        else
				                        	return 'No';
				                    },
				                ],

				                [
				                	'class' => 'yii\grid\ActionColumn', 
				                	'template' => '{view} {delete}',
				                	'header'=> ($idioma->abreviacion == 'en' || $idioma->abreviacion == 'EN' ? 'Actions' : 'Acciones'),
				                	'contentOptions' => ['style' => 'width:70px;'],
				                	'buttons' => [
									    'view' => function ($url, $model) {
									        	return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->getUrlManager()->createUrl(['site/ruta', 'id' => $model->pk, 'lan'=>$_GET['lan']]), [
									                    'title' => Yii::t('app', 'Ver'),
									        ]);
									    },
									    'delete' => function ($url, $model) {
									        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->getUrlManager()->createUrl(['site/delruta', 'id' => $model->pk, 'lan' => $_GET['lan']]), ['title' => Yii::t('app', 'Delete'), 'data-method'=>'post']);
									    }
									],
				                ],
				            ],
				        ]); ?>
			</div>
		</div>
	</div>
	
</div>

