<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\redactor\RedactorModule;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\checkbox\CheckboxX;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 

/* @var $this yii\web\View */
/* @var $model app\models\Tienda */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Tienda' : 'Modificar Tienda <b>'.$model->nombre.'</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 1, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...', 'required'=>true]) ?>

        <?= $form->field($model, 'circuito_fk')->dropDownList(ArrayHelper::map(app\models\Circuito::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Circuito ...']) ?>

        <?= 
            $form->field($model, 'local_fk')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(app\models\Local::find()->all(), 'pk', 'direccion'),
                'options' => ['placeholder' => 'Seleccione Local ...', 'class'=>'w60'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); 
        ?>

        <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255, 'class'=>'w60', 'placeholder' => 'Ingrese un nombre para la tienda']) ?>

        <?= $form->field($model, 'numeracion')->textInput(['maxlength' => 10, 'class'=>'w40', 'placeholder' => 'Ingrese la numeración de la tienda']) ?>

        <?= $form->field($model, 'telefono')->textInput(['maxlength' => 255, 'class'=>'w40', 'placeholder' => 'Ingrese teléfono de la tienda']) ?>

        <div class="form-group field-tienda-servicio required">
            <label class="col-sm-1 control-label" for="tienda-telefono">Servicios:</label>
            <br />
            <div class="col-sm-11">
            <?php foreach($servicios as $servicio): ?>
                <label for="s_5"><?= $servicio->nombre ?></label>
                <?= CheckboxX::widget([
                    'name'=>'servicio'.$servicio->pk,
                    'options'=>['id'=>'servicio'.$servicio->pk],
                    'pluginOptions'=>['threeState'=>false, 'size'=>'sm'],
                    'value' => Yii::$app->funciones->servicioTienda($servicio->pk, $model->pk),
                ]);?>
            <?php endforeach; ?>
            </div>
        </div>

        <?= $form->field($model, 'descripcion')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'lang' => 'es',
                    'plugins' => ['clips', 'fontcolor'],
                    'minHeight' => 280,
                    'placeholder' => 'Ingrese una descripción para la tienda'

                ]
            ])
        ?>
        
        <?= $form->field($model, 'horario')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ej: Lu a Vi: 12:00 a 23:00 h, Sá: 11:00 a 23:00 h']) ?>

        <?= $form->field($model, 'sitio_web')->textInput(['maxlength' => 255, 'class'=>'w60', 'placeholder' => 'Ingrese sitio web de la tienda. Ej: www.google.cl']) ?>      

        <?= $form->field($model, 'facebook')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese Facebook de la tienda (opcional)']) ?>

        <?= $form->field($model, 'twitter')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese Twitter de la tienda (opcional)']) ?>

        <?= $form->field($model, 'instagram')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese Instagram de la tienda (opcional)']) ?>

        <?= $form->field($model, 'googleplus')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese Googleplus de la tienda (opcional)']) ?>

        <?= $form->field($model, 'pinterest')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese Pinterest de la tienda (opcional)']) ?>

        <?= $form->field($model, 'tripadvisor')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ingrese tripadvisor de la tienda (opcional)']) ?>

        <?= $form->field($model, 'tags')->textInput(['maxlength' => 255, 'class'=>'w50', 'placeholder' => 'Ej: cafe te capuccino (separados por espacio)']) ?>  

        <div>
            <?= $form->field($model, 'imagen1')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen1 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen1, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen2')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen2 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen2, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen3')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen3 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen3, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen4')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen4 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen4, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'imagen5')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*'],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->imagen5 != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen5, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>

        <div>
            <?= $form->field($model, 'logotipo')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => 'image/*', 'required'=>$model->isNewRecord ? true : false],'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false,'browseLabel' => '','removeLabel' => '','mainClass' => 'input-group-md', 'initialPreview' => (!$model->isNewRecord && $model->logotipo != null) ? [Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->logotipo, ['class'=>'file-preview-image'])] : false]]); ?>
        </div>


        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>