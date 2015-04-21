<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = 'Usuarios'
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
            <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php yii\widgets\Pjax::begin(['id' => 'arriendos_grid']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Mostrando <b>{begin}</b>-<b>{end}</b> de <b>{count}</b> registros",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'username:email',
                'nombre',
                [
                    'header' => 'Rol',
                    'attribute' => 'rol',
                    'value' => function ($data) {
                        if($data->rol == 0){
                            return 'Sin Rol';
                        }
                        if($data->rol == 1){
                            return 'Usuario';
                        }
                        if($data->rol == 2){
                            return 'Administrador';
                        }
                        if($data->rol == 3){
                            return 'Administrador y Usuario';
                        }
                    },
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}','header'=>'Acciones', 'contentOptions' => ['style' => 'width:75px;']],
            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>