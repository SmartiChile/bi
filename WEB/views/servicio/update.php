<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicio */

$this->title = 'Modificar Servicio: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="servicio-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
