<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 use yii\authclient\widgets\AuthChoice;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Barrio Italia - Ingreso';
?>
<div class="site-login">
    <div class='login'>
            <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-negro.png', $options = ['class'=>'login-lg-negro']); ?>
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

          <?php if (Yii::$app->session->hasFlash('restaurar_exito')): ?>
            <div class="alert alert-success ">
              <?php echo Yii::$app->session->getFlash('restaurar_exito') ?>
            </div>
          <?php endif; ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>'Nombre de usuario (correo electrónico)']) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'class'=>'form-login-input', 'placeholder'=>'Contraseña']) ?>

            <?php

            /* $form->field($model, 'rememberMe', [
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() */ 

            ?>
            <div class="form-group">
                    <?= Html::submitButton('INICIAR SESIÓN', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
            <div class="login-registro">
                <p><?= Html::a('¿Olvidaste tu contraseña?', ['site/recuperar']) ?></p>
                <p>¿No tienes cuenta? <?= Html::a('Regístrate', ['site/registro']) ?></p>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
