<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Idioma */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Idiomas', 'url' => ['index']];
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
                        'confirm' => '¿Está seguro que quiere eliminar este item?',
                        'method' => 'post',
                    ],
                ]) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nombre',
                'abreviacion',
                'posicion',
                [
                    'attribute'=>'fecha',
                    'value'=> $model->activo == 0 ? 'No' : 'Sí',
                ],
            ],
        ]) ?>
        </div>
    </div>
</div>