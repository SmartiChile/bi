<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Contacto';
?>

<div class="contenedor-mapa">
	<br>
	<h3>CONTACTO</h3>
	<div class="puntos-separadores"></div>

	<?php 
        $form = ActiveForm::begin([
            'id' => 'login-form-horizontal',
            'options'=>['enctype'=>'multipart/form-data', 'method'=>'post'],
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); 
    ?>

    <div class="mensaje-exito-contacto">
    <?php if (Yii::$app->session->hasFlash('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo Yii::$app->session->getFlash('mensaje') ?>
        </div>
    <?php endif; ?>
    </div>

    <div class="formulario-contacto">
        <div class="cada-input-contacto">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255, 'class'=>'form-control input-contacto', 'placeholder'=>'Nombre', 'required'=>true])->label(false) ?>
        </div>
        <div class="cada-input-contacto">
            <?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'class'=>'form-control input-contacto', 'placeholder'=>'Email', 'required'=>true])->label(false) ?>
        </div>
        <div class="cada-input-contacto" id="input-contacto2">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => 255, 'class'=>'form-control input-contacto', 'placeholder'=>'Teléfono', 'required'=>true])->label(false) ?>
        </div>
            <?= $form->field($model, 'mensaje')->textarea(['class'=>'form-control textarea-contacto ', 'placeholder'=>'Mensaje', 'required'=>true])->label(false) ?>
            <?= Html::submitButton('Enviar', ['class' => 'boton-enviar-contacto envia-contacto']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
