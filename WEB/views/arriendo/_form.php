<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\redactor\RedactorModule;

/* @var $this yii\web\View */
/* @var $model app\models\Arriendo */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Arriendo' : 'Modificar Arriendo <b>"'.$model->titulo.'"</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...']) ?>

        <?= $form->field($model, 'titulo', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-pencil"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w60', 'placeholder' => 'Ingrese un título para el arriendo']) ?>

        <?= $form->field($model, 'descripcion')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'lang' => 'es',
                    'plugins' => ['clips', 'fontcolor'],
                    'minHeight' => 280,
                    'placeholder' => 'Ingrese una descripción para el arriendo',

                ]
            ])
        ?>

        <?= $form->field($model, 'direccion', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-home"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Dirección del arriendo']) ?>

        <?= $form->field($model, 'telefono', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Teléfono de contacto']) ?>

        <?= $form->field($model, 'email', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-envelope"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Email de contacto']) ?>

        <?= $form->field($model, 'nombre_contacto', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-comment"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Nombre de contacto']) ?>

        <div>
            <?= $form->field($model, 'imagen1')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false, 'browseLabel' => 'Archivo', 'removeLabel' => '', 'mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen1 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen1, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen2')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => 'Archivo','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen2 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen2, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen3')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => 'Archivo','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen3 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen3, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>