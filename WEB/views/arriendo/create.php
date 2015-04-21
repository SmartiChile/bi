<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Arriendo */

$this->title = 'Crear Arriendo';
$this->params['breadcrumbs'][] = ['label' => 'Panel de administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Arriendos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arriendo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
