<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Arriendo */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Arriendos', 'url' => ['index']];
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
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
        </p>
            <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'titulo',
                        [
                            'attribute'=>'idioma',
                            'value'=>$model->idiomaFk->nombre.' ('.$model->idiomaFk->abreviacion.')',
                        ],
                        [
                            'attribute'=>'descripcion',
                            'format'=>'raw',
                            'value'=>$model->descripcion,
                        ],
                        'direccion',
                        'telefono',
                        'email:email',
                        'nombre_contacto',
                        [
                            'attribute'=>'imagen1',
                            'value'=> isset($model->imagen1) ? Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen1 : '(no definido)',
                            'format' => isset($model->imagen1) ? ['image',['width'=>'200']] : null,
                        ],
                        [
                            'attribute'=>'imagen2',
                            'value'=> isset($model->imagen2) ? Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen2 : '(no definido)',
                            'format' => isset($model->imagen2) ? ['image',['width'=>'200']] : null,
                        ],
                        [
                            'attribute'=>'imagen3',
                            'value'=> isset($model->imagen3) ? Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen3 : '(no definido)',
                            'format' => isset($model->imagen3) ? ['image',['width'=>'200']] : null,
                        ],
                    ],
                ]) 
            ?>
        </div>
    </div>
</div>