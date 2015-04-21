<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */

    if($model->prensa == 0)
        $this->title = 'Noticia: '.$model->titulo;
    else
        $this->title = 'Prensa: '.$model->titulo;



$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index', 'id'=>$model->prensa]];
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
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute'=>'idioma',
                    'value'=>$model->idiomaFk->nombre.' ('.$model->idiomaFk->abreviacion.')',
                ],
                'titulo',
                [
                    'attribute'=>'descripcion',
                    'format'=>'raw',
                    'value'=>$model->descripcion,
                ],
                'referencia',
                [
                    'attribute'=>'fecha',
                    'value'=> Yii::$app->formatter->asDatetime($model->fecha, "php:d-m-Y H:i:s"),
                ],
                [
                    'attribute'=>'destacada',
                    'value'=>$model->destacada == 1 ? 'Sí' : 'No',
                ],
                [
                    'attribute'=>'imagen',
                    'value'=>  isset($model->imagen) ? Yii::$app->request->baseUrl.'/images/noticias/'.$model->imagen : '(no definido)',
                    'format' => isset($model->imagen) ? ['image',['width'=>'200']] : null,
                ]
            ],
        ]) ?>
        </div>
    </div>
</div>