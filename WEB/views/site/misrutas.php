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
	<h3>Bienvenido(a) <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);?> - Mis Rutas</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario() ?>
		</div>
		<div class="info-mis-rutas">
			<h3>Historia de rutas</h3>
			<div class="tiendas-ruta-usuario">
				<?php yii\widgets\Pjax::begin(['id' => 'usuario_ruta']) ?>
				        <?= GridView::widget([
				            'dataProvider' => $dataProvider,
				            'columns' => [
				                ['class' => 'yii\grid\SerialColumn'],

				                [
				                    'header' => 'Identificador',
				                    'attribute' => 'pk',
				                    'value' => function ($data) {
				                        return "Ruta ID: ".$data->pk.", Propietario: ".$data->usuarioFk->nombre." <".$data->usuarioFk->username.">";
				                    },
				                ],

				                [
				                    'header' => 'Terminada',
				                    'attribute' => 'terminada',
				                    'value' => function ($data) {
				                        if($data->terminada == 1)
				                        	return 'Sí';
				                        else
				                        	return 'No';
				                    },
				                ],

				                [
				                	'class' => 'yii\grid\ActionColumn', 
				                	'template' => '{view} {delete}',
				                	'header'=>'Acciones',
				                	'contentOptions' => ['style' => 'width:70px;'],
				                	'buttons' => [
									    'view' => function ($url, $model) {
									        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->getUrlManager()->createUrl(['site/ruta', 'id' => $model->pk]), [
									                    'title' => Yii::t('app', 'Ver'),
									        ]);
									    },
									    'delete' => function ($url, $model) {
									        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->getUrlManager()->createUrl(['site/delruta', 'id' => $model->pk]), ['title' => Yii::t('app', 'Delete'), 'data-method'=>'post']);
									    }
									],
				                ],
				            ],
				        ]); ?>
			</div>
		</div>
	</div>
	
</div>

