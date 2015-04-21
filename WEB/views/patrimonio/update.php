<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patrimonio */

$this->title = 'Modificar Patrimonio: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Patrimonios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="patrimonio-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
