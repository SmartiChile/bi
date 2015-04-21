<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

$this->title = 'Contacto';
?>

<div class="contenedor-mapa">
	<br>
	<h3>CONTACTO</h3>
	<div class="puntos-separadores"></div>

	<?php 
        $form = ActiveForm::begin([
            'id' => 'login-form-horizontal', 
            'options'=>['enctype'=>'multipart/form-data'],
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); 
    ?>


</div>
