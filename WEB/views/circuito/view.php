<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Circuito */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Circuitos', 'url' => ['index']];
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
                        'nombre',
                        [
                            'attribute'=>'idioma',
                            'value'=>$model->idiomaFk->nombre.' ('.$model->idiomaFk->abreviacion.')',
                        ],
                        'posicion',
                        [
                            'attribute'=>'descripcion',
                            'format'=>'raw',
                            'value'=>$model->descripcion,
                        ],
                        [
                            'attribute'=>'color',
                            'format'=>'raw',
                            //'value'=>'<div style="background-color: '.$model->color.'; width: 100px; height: 50px;></div>',
                        ],
                        [
                            'attribute'=>'icono',
                            'value'=>isset($model->icono) ? Yii::$app->request->baseUrl.'/images/circuitos/'.$model->icono : '(no definido)',
                            'format' => isset($model->icono) ? ['image',['width'=>'70']] : null,
                        ],
                        [
                            'attribute'=> 'imagen',
                            'value'=> isset($model->imagen) ? Yii::$app->request->baseUrl.'/images/circuitos/'.$model->imagen : '(no definido)',
                            'format' => isset($model->imagen) ? ['image',['width'=>'200']] : null,
                        ],
                    ],
                ]) 
            ?>
        </div>
    </div>
</div>