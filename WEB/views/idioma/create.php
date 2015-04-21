<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Idioma */

$this->title = 'Create Idioma';
$this->params['breadcrumbs'][] = ['label' => 'Idiomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="idioma-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
