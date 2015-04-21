<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\redactor\RedactorModule;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Evento' : 'Modificar Evento: <b>'.$model->titulo.'</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...', 'required'=>true]) ?>

        <?= $form->field($model, 'titulo', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-pencil"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w60']) ?>

        <?= $form->field($model, 'descripcion')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'lang' => 'es',
                    'plugins' => ['clips', 'fontcolor'],
                    'minHeight' => 280,

                ]
            ])
        ?>
        <div class="form-group field-evento-inicio required">
            <label class="col-sm-3 control-label" for="evento-inicio">Inicio</label>
            <div class="col-sm-9">
                <?php 
                    echo DateTimePicker::widget([
                        'model' => $model,
                        'attribute' => 'inicio',
                        'language' => 'es',
                        'removeButton' => false,
                        'options' => ['placeholder' => 'Fecha de inicio', 'class'=>'w30', 'readonly'=>true],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'dd-mm-yyyy hh:ii',
                        ]
                    ]);
                ?>
            </div>
        </div>
        <div class="form-group field-evento-inicio required">
            <label class="col-sm-3 control-label" for="evento-inicio">Termino</label>
            <div class="col-sm-9">
                <?php 
                    echo DateTimePicker::widget([
                        'model' => $model,
                        'attribute' => 'fin',
                        'language' => 'es',
                        'removeButton' => false,
                        'options' => ['placeholder' => 'Fecha de inicio', 'class'=>'w30', 'readonly'=>true],
                        'pluginOptions' => [

                            'autoclose'=>true,
                            'format' => 'dd-mm-yyyy hh:ii',
                        ]
                    ]);
                ?>
            </div>
        </div>

        <?= $form->field($model, 'imagen')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => 'Archivo','removeLabel' => '', 'mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/eventos/'.$model->imagen, ['class'=>'file-preview-image'])] : false]]); ?>

        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>