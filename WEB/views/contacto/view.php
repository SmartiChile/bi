<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contacto */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

$this->title = $model->nombre.' <'.$model->email.'>';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
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
                    'nombre',
                    'telefono',
                    'email:email',
                    [
                       'attribute'=>'mensaje',
                        'value'=>$model->mensaje,
                    ],
                    'ip',
                    [
                        'attribute'=>'fechayhora',
                        'value'=> Yii::$app->formatter->asDatetime($model->fechayhora, "php:d-m-Y H:i:s"),
                    ],
                    'tipo',
                    'adjunto',
                ],
            ]) ?>
        </div>
    </div>
</div>