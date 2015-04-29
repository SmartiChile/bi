<?php 
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Barrio italia - Trabaja con Nosotros';
?>



<div class="contenedor-elbarrio">
	<h3 class="h3-movil">TRABAJA CON NOSOTROS</h3>
	<div class='puntos-separadores no-mostrar'></div>
	
    <div class="informacion-elbarrio">

        <div class='menu-elbarrio'>
             <?= Yii::$app->funciones->menu_elbarrio($idioma->abreviacion) ?>
        </div>

        <div class="informacion-cada-barrio">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'login-form-horizontal',
                    'options'=>['enctype'=>'multipart/form-data', 'method'=>'post'],
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
                ]); 
            ?>

            <div class="mensaje-exito-trabaja">
                <?php if (Yii::$app->session->hasFlash('mensaje')): ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?php echo Yii::$app->session->getFlash('mensaje') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="formulario-trabaja">
                <div class="cada-formulario-trabaja">
                    <div>
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255, 'class'=>'form-control input-trabaja', 'placeholder'=>'Nombre', 'required'=>true])->label(false) ?>
                    </div>
                    <div>
                        <?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'class'=>'form-control input-trabaja', 'placeholder'=>'Email', 'required'=>true])->label(false) ?>
                    </div>
                    <div>
                        <?= $form->field($model, 'telefono')->textInput(['maxlength' => 255, 'class'=>'form-control input-trabaja', 'placeholder'=>'Teléfono', 'required'=>true])->label(false) ?>
                    </div>
                </div>
                <div class="cada-formulario-trabaja">
                    <div>
                        <?= $form->field($model, 'adjunto')->widget(FileInput::classname(), ['options' => ['multiple' => false, 'accept' => '.pdf, .doc, .docx'], 'pluginOptions' => ['showUpload' => false, 'browseLabel' => 'Archivo', 'removeLabel' => '','mainClass' => 'input-group-md']])->label(false); ?>
                    </div>
                    <div class="margen-area-trabaja">
                        <?= $form->field($model, 'mensaje')->textarea(['class'=>'form-control textarea-trabaja ', 'placeholder'=>'Mensaje, Cargo, Pretención de renta', 'required'=>true])->label(false) ?>
                     </div>
                     <?= Html::submitButton('Enviar', ['class' => 'boton-enviar-trabaja']) ?>
                </div>
            </div>

    <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>