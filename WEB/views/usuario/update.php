<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Modificar Usuario: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['usuario/index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="usuario-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
