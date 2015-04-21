<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */

$this->title = 'Modificar Noticia: ' . ' ' . $model->pk;
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => $model->prensa == 0 ? 'Noticia' : 'Prensa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->pk]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="noticia-update">

    <?= $this->render('_form', [
        'model' => $model,
        'id'=>$id,
    ]) ?>

</div>
