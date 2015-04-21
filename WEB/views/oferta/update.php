<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = 'Modificar Oferta: ' . ' ' . $model->tiendaFk->nombre.'<'.$model->descuento.'%>';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Ofertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tiendaFk->nombre.'<'.$model->descuento.'%>', 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="oferta-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
