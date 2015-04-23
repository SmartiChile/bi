<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Idioma */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Idioma' : 'Modificar Idioma: <b>'.$model->nombre.'</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255, 'class'=>'w60', 'placeholder' => 'Ingrese un nombre para el idioma']) ?>

	    <?= $form->field($model, 'abreviacion')->textInput(['maxlength' => 5, 'class'=>'w20', 'placeholder' => 'Ej: ES']) ?>

	    <?= $form->field($model, 'posicion')->textInput(['maxlength' => 1, 'class'=>'w20', 'placeholder' => 'Ej: 3']) ?>

	    <?= $form->field($model, 'activo')->widget(SwitchInput::classname(), ['pluginOptions' => ['onText' => 'Sí','offText' => 'No',]]); ?>

	    <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>