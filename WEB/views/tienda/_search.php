<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiendaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tienda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'numeracion') ?>

    <?= $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'imagen1') ?>

    <?php // echo $form->field($model, 'imagen2') ?>

    <?php // echo $form->field($model, 'imagen3') ?>

    <?php // echo $form->field($model, 'imagen4') ?>

    <?php // echo $form->field($model, 'imagen5') ?>

    <?php // echo $form->field($model, 'logotipo') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'horario_inicio') ?>

    <?php // echo $form->field($model, 'horario_fin') ?>

    <?php // echo $form->field($model, 'sitio_web') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'twitter') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'googleplus') ?>

    <?php // echo $form->field($model, 'pinterest') ?>

    <?php // echo $form->field($model, 'tripadvisor') ?>

    <?php // echo $form->field($model, 'local_fk') ?>

    <?php // echo $form->field($model, 'circuito_fk') ?>

    <?php // echo $form->field($model, 'idioma_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
