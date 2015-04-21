<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Patrimonio */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Patrimonios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                        'confirm' => '¿Está seguro que desea eliminar este item?',
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
                    'nombre',
                    [
                        'attribute'=>'descripcion',
                        'format'=>'raw',
                        'value'=>$model->descripcion,
                    ],
                    [
                        'attribute'=>'dirección',
                        'value'=>$model->direccion.' '.$model->coordenadas,
                    ],
                    [
                        'attribute'=>'imagen',
                        'value'=> isset($model->imagen) ? Yii::$app->request->baseUrl.'/images/patrimonio/'.$model->imagen : '(no definido)',
                        'format' =>  isset($model->imagen) ? ['image',['width'=>'200']] : null,
                    ],
                    [
                        'attribute'=>'circuito_fk',
                        'value'=>$model->circuitoFk->nombre,
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>