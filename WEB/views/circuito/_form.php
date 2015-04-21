<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\redactor\RedactorModule;
use yii\helpers\ArrayHelper;
use kartik\widgets\RangeInput;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 


/* @var $this yii\web\View */
/* @var $model app\models\Circuito */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Circuito' : 'Modificar Circuito <b>'.$model->nombre.'</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...']) ?>

        <?= $form->field($model, 'nombre', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-pencil"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w60', 'placeholder'=>'Ingrese un nombre para el circuito']) ?>

        <?= $form->field($model, 'color')->widget(\kartik\widgets\ColorInput::classname(), ['options' => ['placeholder'=>'Seleccione un color', 'class'=>'w40']])->hint(''); ?>

        <?= $form->field($model, 'descripcion')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'lang' => 'es',
                    'plugins' => ['clips', 'fontcolor'],
                    'minHeight' => 280,

                ]
            ])
        ?>

        <div class="form-group field-circuito-posicion required rang">
            <label class="col-sm-3 control-label" for="circuito-posicion">Posicion</label>
            <div class="col-sm-9">
                <?= RangeInput::widget(['model' => $model, 'value'=>20, 'attribute' => 'posicion', 'options' => ['placeholder' => 'Posición (1 - 6)'], 'html5Options' => ['min' => 1, 'max' => 6], 'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-sort"></i>']]]); ?>
            </div>
        </div>       

        <div>
            <?= $form->field($model, 'icono')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false, 'browseLabel' => 'Archivo','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->icono != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/circuitos/'.$model->icono, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => 'Archivo','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/circuitos/'.$model->imagen, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>