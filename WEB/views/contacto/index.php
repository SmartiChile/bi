<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

$this->title = 'Contactos';
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
        <?php yii\widgets\Pjax::begin(['id' => 'vitrina_grid']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'email:email',
                [
                    'header' => 'Fecha y Hora',
                    'attribute' => 'fechayhora',
                    'value' => function ($data) {
                        return Yii::$app->formatter->asDatetime($data->fechayhora, "php:d-m-Y H:i:s");;
                    },
                ],
                [
                    'header' => 'Desde',
                    'attribute' => 'tipo',
                    'value' => function ($data) {
                        
                        if($data == 0)
                            return 'Desde Contacto';

                        if($data == 1)
                            return 'Desde Trabaja con nosotros';
                    },
                ],
                // 'adjunto',

                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}','header'=>'Acciones', 'contentOptions' => ['style' => 'width:70px;']],
            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>