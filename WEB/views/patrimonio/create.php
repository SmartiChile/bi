<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Patrimonio */

$this->title = 'Crear Patrimonio';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Patrimonios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrimonio-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
