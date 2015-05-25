<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 use yii\authclient\widgets\AuthChoice;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Barrio Italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Log in' : 'Ingreso');
?>
<div class="site-login">
    <div class='<?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'ingresa-con-en' : '') ?> login'>
            <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-negro.png', $options = ['class'=>'login-lg-negro no-mostrar']); ?>
            <?php $authAuthChoice = AuthChoice::begin([
                  'id'=>'redes',
                  'baseAuthUrl' => [$idioma->abreviacion.'/site/auth', ]
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

          <?php if (Yii::$app->session->hasFlash('restaurar_exito')): ?>
            <div class="alert alert-success ">
              <?php echo Yii::$app->session->getFlash('restaurar_exito') ?>
            </div>
          <?php endif; ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Username (E-mail)' : 'Nombre de usuario (correo electrónico)')]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Password' : 'Contraseña')]) ?>

            <?php

            /* $form->field($model, 'rememberMe', [
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() */ 

            ?>
            <div class="form-group">
                    <?= Html::submitButton(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'LOG IN' : 'INICIAR SESIÓN'), ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
            <div class="login-registro">
                <p><?= Html::a(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Forgot your password?' : '¿Olvidaste tu contraseña?'), ['site/recuperar', 'lan'=>$idioma->abreviacion]) ?></p>
                <p><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? "Don't have an account?" : "¿No tienes cuenta?") ?> <?= Html::a(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Sign up' : 'Regístrate'), ['site/registro', 'lan'=>$idioma->abreviacion]) ?></p>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
