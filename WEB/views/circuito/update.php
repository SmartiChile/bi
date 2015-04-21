<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Circuito */

$this->title = 'Modificar Circuito: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Circuitos', 'url' => ['circuito/index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="circuito-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
