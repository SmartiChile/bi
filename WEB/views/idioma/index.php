<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IdiomaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = 'Idiomas';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">
        <h1><?= Html::encode($this->title) ?></h1>
        <hr />
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a('Agregar Idioma', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'abreviacion',
                'posicion',
                [
                    'header' => '¿Activo?',
                    'attribute' => 'activo',
                    'value' => function ($data) {
                        return $data->activo == 1 ? 'Sí' : 'No';
                    },
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}','header'=>'Acciones', 'contentOptions' => ['style' => 'width:70px;']],
            ],
        ]); ?>
    </div>
</div>