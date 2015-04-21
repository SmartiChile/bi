<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Oferta' : 'Modificar Oferta: <b>'.$model->tiendaFk->nombre.' <'.$model->descuento.'%></b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'idioma_fk')->dropDownList(ArrayHelper::map(app\models\Idioma::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Idioma ...', 'required'=>true]) ?>

        <?= $form->field($model, 'tienda_fk')->dropDownList(ArrayHelper::map(app\models\Tienda::find()->all(), 'pk', 'nombre'), ['class'=>'w40', 'prompt'=>'Seleccione Tienda ...', 'required'=>true]) ?>

        <?= $form->field($model, 'descuento', ['addon' => ['prepend' => ['content'=>'%']]])->textInput(['class'=>'w30']) ?>

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
                        'attribute' => 'termino',
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


        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>