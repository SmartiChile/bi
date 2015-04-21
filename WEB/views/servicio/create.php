<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Servicio */

$this->title = 'Crear Servicio';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="servicio-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
