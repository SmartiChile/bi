<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Arriendo */

$this->title = 'Modificar Arriendo: ' . ' "' . $model->titulo. '"';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Arriendos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="arriendo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
