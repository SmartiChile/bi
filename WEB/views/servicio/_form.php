<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Servicio */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Servicio' : 'Modificar Servicio ' . '<b>"'.$model->nombre.'"</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...']) ?>

	    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255, 'class'=>'w60', 'placeholder' => 'Ingrese un nombre de servicio. Ej: Redcompra']) ?>

	    <?= $form->field($model, 'icono')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->icono != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/servicios/'.$model->icono, ['class'=>'file-preview-image'])] : false]]); ?>

        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
