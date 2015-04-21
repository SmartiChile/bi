<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArriendoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = 'Arriendos';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
    $.pjax.reload({container:"#arriendos_grid"});
');

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
            <?= Html::a('Crear Arriendo', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php yii\widgets\Pjax::begin(['id' => 'arriendos_grid']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Mostrando <b>{begin}</b>-<b>{end}</b> de <b>{count}</b> registros",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre_contacto',
                'titulo',
                'direccion',
                'telefono',
                [
                    'header' => 'Idioma',
                    'attribute' => 'idioma_fk',
                    'value' => function ($data) {
                            return $data->idiomaFk->nombre.' ('.$data->idiomaFk->abreviacion.')';
                    },
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}','header'=>'Acciones', 'contentOptions' => ['style' => 'width:70px;']],
            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
