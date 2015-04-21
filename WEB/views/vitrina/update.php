<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vitrina */

$this->title = 'Modificar Vitrina: ' . ' ' . $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Vitrinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="vitrina-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
