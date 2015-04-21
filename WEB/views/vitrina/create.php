<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vitrina */

$this->title = 'Crear Vitrina';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Vitrina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vitrina-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
