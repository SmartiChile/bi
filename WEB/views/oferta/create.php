<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = 'Crear Oferta';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/inicio']];
$this->params['breadcrumbs'][] = ['label' => 'Ofertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oferta-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
