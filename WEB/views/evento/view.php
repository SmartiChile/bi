<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
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
                            'attribute'=>'idioma_fk',
                            'value'=>isset($model->idioma_fk) ? $model->idiomaFk->nombre.' ('.$model->idiomaFk->abreviacion.')' : '(no definido)',
                        ],
                        'titulo',
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
                            'attribute'=>'fin',
                            'value'=> Yii::$app->formatter->asDatetime($model->fin, "php:d-m-Y H:i:s"),
                        ],
                        [
                            'attribute'=>'imagen',
                            'value'=> isset($model->imagen) ? Yii::$app->request->baseUrl.'/images/eventos/'.$model->imagen : '(no definido)',
                            'format' => isset($model->imagen) ? ['image',['width'=>'200']] : null,
                        ],
                    ],
                ]) 
            ?>
        </div>
    </div>
</div>