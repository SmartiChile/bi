<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css');

    if($id == 0)
        $this->title = 'Noticias';
    else
        $this->title = 'Prensa';

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
            <?= Html::a($id == 0 ? 'Crear Noticia' : 'Crear articulo de prensa', ['create', 'id'=>$id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php yii\widgets\Pjax::begin(['id' => 'arriendos_grid']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Mostrando <b>{begin}</b>-<b>{end}</b> de <b>{count}</b> registros",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'titulo',
                'referencia',
                [
                    'header' => 'Fecha',
                    'attribute' => 'fecha',
                    'value' => function ($data) {
                        return Yii::$app->formatter->asDatetime($data->fecha, "php:d-m-Y H:i:s");;
                    },
                    ],
                [
                    'header' => 'Idioma',
                    'attribute' => 'idioma_fk',
                    'value' => function ($data) {
                            return $data->idiomaFk->nombre.' ('.$data->idiomaFk->abreviacion.')';
                    },
                ],
                [
                    'header' => 'Destacada',
                    'attribute' => 'destacada',
                    'value' => function ($data) {
                            return $data->destacada == 1 ? 'Sí' : 'No';
                    },
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}','header'=>'Acciones', 'contentOptions' => ['style' => 'width:70px;']],
            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>