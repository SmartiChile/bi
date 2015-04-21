<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Circuito */

$this->title = 'Crear Circuito';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Circuitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="circuito-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
