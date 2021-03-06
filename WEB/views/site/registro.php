<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
$this->title = 'Barrio Italia - Registro';

?>

<div class='form-login'>
	<div class='<?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'registrate-con-en' : 'registrate-con') ?> login'>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-negro.png', $options = ['class'=>'registro-lg-negro no-mostrar']); ?>
            <?php $authAuthChoice = AuthChoice::begin([
                  'id'=>'redes',
                  'baseAuthUrl' => ['site/auth']
            ]); ?>
          <ul>
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
              <li><?php $authAuthChoice->clientLink($client) ?></li>
            <?php endforeach; ?>
          </ul>
          <?php AuthChoice::end(); ?>
          <strong class='login-line'>o</strong>

          <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

            <?php if (Yii::$app->session->hasFlash('password')): ?>
            <div class="alert alert-danger ">
              Se produjeron los siguientes errores al intentar registrar la cuenta:
              <ul>
                  <li><?php echo Yii::$app->session->getFlash('password') ?></li>
              </ul>
            </div>
          <?php endif; ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'E-mail (Username)' : 'Correo electrónico (Nombre de usuario)'), 'required'=>true]) ?>

			     <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Name' : 'Nombre Completo'), 'required'=>true]) ?>

			     <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Password' : 'Contraseña'), 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres']) ?>

			     <?= Html::passwordInput('password2','', ['class'=>'form-login-input separador', 'placeholder'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Repeat password' : 'Repetir Contraseña'), 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres']) ?>
            <div class="form-group">
                    <?= Html::submitButton(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'SIGN UP' : 'REGÍSTRATE'), ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>

            <div class="login-registro">
                <p><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Already have an account?' : '¿Ya tiene una cuenta?') ?> <?= Html::a(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Log in' : 'Inicia sesión'), ['site/login']) ?></p>
            </div>
	</div>
</div>