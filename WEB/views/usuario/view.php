<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
?>

<div id="contenedor_panel">
    <?= $_SESSION["p"] ?>
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

        <?php
                if($model->rol == 0){
                    $rol = 'Sin Rol';
                }
                if($model->rol == 1){
                    $rol = 'Usuario';
                }
                if($model->rol == 2){
                    $rol = 'Administrador';
                }
                if($model->rol == 3){
                    $rol = 'Administrador y Usuario';
                }
        ?>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username:email',
                'nombre',
                [
                    'header' => 'Rol',
                    'attribute' => 'rol',
                    'value' => $rol,
                ],
            ],
        ]) ?>
        </div>
    </div>
</div>