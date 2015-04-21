<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
$this->title = 'Barrio Italia - Restaurar Contraseña';

?>

<div class='form-login'>
	<div class='registrate-con login'>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-negro.png', $options = ['class'=>'registro-lg-negro']); ?>
          <strong class='login-line'>o</strong>

          <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

           <p>Ingrese la información solicitada en el siguiente formulario para la restauración de su contraseña.</p><br />

           <?php if (Yii::$app->session->hasFlash('restaurar_error')): ?>
              <div class="alert alert-danger ">
                  <?php echo Yii::$app->session->getFlash('restaurar_error') ?>
              </div>
           <?php endif; ?>

			     <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>'Contraseña', 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres']) ?>

			     <?= Html::passwordInput('password2','', ['class'=>'form-login-input separador', 'placeholder'=>'Repetir Contraseña', 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres']) ?>
            <div class="form-group">
                    <?= Html::submitButton('RESTAURAR CONTRASEÑA', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
	</div>
</div>