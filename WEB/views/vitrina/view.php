<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vitrina */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Vitrinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
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
        <br />
        <?= DetailView::widget([
        'model' => $model,
            'attributes' => [
                [
                    'attribute'=>'idioma',
                    'value'=>$model->idiomaFk->nombre.' ('.$model->idiomaFk->abreviacion.')',
                ],
                'titulo',
                [
                    'attribute'=>'fecha',
                    'value'=> Yii::$app->formatter->asDatetime($model->fecha, "php:d-m-Y H:i:s"),
                ],
                [
                    'attribute'=>'imagen',
                    'value'=> isset($model->imagen) ? Yii::$app->request->baseUrl.'/images/vitrina/'.$model->imagen : '(no definido)',
                    'format' =>  isset($model->imagen) ? ['image',['width'=>'200']] : null,
                ],
            ],
        ]) ?>
        </div>
    </div>
</div>