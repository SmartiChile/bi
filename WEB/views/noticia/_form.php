<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\redactor\RedactorModule;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear ' . ($id == 0 ? 'Noticia' : 'articulo de prensa') : 'Modificar '.($id == 0 ? 'Noticia' : 'articulo de prensa: ').'<b>"'.$model->titulo.'"</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...']) ?>

        <?= $form->field($model, 'titulo', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-pencil"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese un título para la noticia']) ?>

        <?= $form->field($model, 'descripcion')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'lang' => 'es',
                    'plugins' => ['clips', 'fontcolor'],
                    'minHeight' => 280,
                    'placeholder' => 'Ingrese una descripción para la noticia'

                ]
            ])
        ?>

        <?= $form->field($model, 'referencia', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-share-alt"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ej: www.google.cl']) ?>

        <?= $form->field($model, 'destacada')->widget(SwitchInput::classname(), ['pluginOptions' => ['onText' => 'Sí','offText' => 'No',]]); ?>

        <?= $form->field($model, 'imagen')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false, 'browseLabel' => 'Archivo', 'removeLabel' => '', 'mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/noticias/'.$model->imagen, ['class'=>'file-preview-image'])] : false]]); ?>

        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
