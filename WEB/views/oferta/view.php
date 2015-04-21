<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = $model->tiendaFk->nombre.'<'.$model->descuento.'%>';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Ofertas', 'url' => ['index']];
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
                        'confirm' => '¿Está seguro que desea eliminar este item?',
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
                    [
                        'attribute'=>'tienda_fk',
                        'value'=>$model->tiendaFk->nombre,
                    ],
                    [
                        'attribute'=>'descuento',
                        'value'=>$model->descuento.' %',
                    ],
                    [
                        'attribute'=>'descripcion',
                        'format'=>'raw',
                        'value'=>$model->descripcion,
                    ],
                    [
                        'attribute'=>'inicio',
                        'value'=> Yii::$app->formatter->asDatetime($model->inicio, "php:d-m-Y H:i:s"),
                    ],
                    [
                        'attribute'=>'inicio',
                        'value'=> Yii::$app->formatter->asDatetime($model->termino, "php:d-m-Y H:i:s"),
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>