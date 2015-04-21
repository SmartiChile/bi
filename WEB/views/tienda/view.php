<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tienda */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css');

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$servicios = app\models\Tiendaxservicio::find()->where(['tienda_fk'=>$model->pk])->all();
$servicios_tienda = '';
foreach ($servicios as $servicio_tienda) {
    $servicios_tienda = $servicios_tienda . ' <b>' . $servicio_tienda->servicioFk->nombre . '</b>';
}

?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">
        <h1><?= Html::encode($this->title) ?></h1>
        <hr />
        <p>
            <?= Html::a('Modificar', ['update', 'id' => $model->pk], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Borrar', ['delete', 'id' => $model->pk], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Está seguro que quiere eliminar este item?',
                        'method' => 'post',
                    ],
                ]) ?>
        </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'idioma',
                        'value'=>$model->idiomaFk->nombre.' ('.$model->idiomaFk->abreviacion.')',
                    ],
                    [
                        'attribute'=>'circuito_fk',
                        'value'=>$model->circuitoFk->nombre,
                    ],
                    [
                        'attribute'=>'local_fk',
                        'value'=>$model->localFk->direccion.' '.$model->localFk->coordenadas,
                    ],
                    'nombre',
                    [
                        'attribute'=>'descripcion',
                        'format'=>'raw',
                        'value'=>$model->descripcion,
                    ],
                    'numeracion',
                    'rating',
                    'tags',
                    [
                        'attribute'=>'banner',
                        'value'=> isset($model->banner) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->banner : '(no definido)',
                        'format' =>  isset($model->banner) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'imagen1',
                        'value'=> isset($model->imagen1) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen1 : '(no definido)',
                        'format' =>  isset($model->imagen1) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'imagen2',
                        'value'=> isset($model->imagen2) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen2 : '(no definido)',
                        'format' =>  isset($model->imagen2) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'imagen3',
                        'value'=> isset($model->imagen3) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen3 : '(no definido)',
                        'format' =>  isset($model->imagen3) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'imagen4',
                        'value'=> isset($model->imagen4) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen4 : '(no definido)',
                        'format' =>  isset($model->imagen4) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'imagen5',
                        'value'=> isset($model->imagen5) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen5 : '(no definido)',
                        'format' =>  isset($model->imagen5) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'logotipo',
                        'value'=> isset($model->logotipo) ? Yii::$app->request->baseUrl.'/images/tiendas/'.$model->logotipo : '(no definido)',
                        'format' =>  isset($model->logotipo) ? ['image',['width'=>'100']] : null,
                    ],
                    'telefono',
                    'horario_inicio',
                    'horario_fin',
                    'sitio_web',
                    'facebook',
                    'twitter',
                    'instagram',
                    'googleplus',
                    'pinterest',
                    'tripadvisor',
                    [
                        'attribute'=>'Servicios',
                        'format'=>'raw',
                        'value'=> $servicios_tienda,
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>