<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Barrio Italia - Recuperar contraseña';
?>

<div class='form-recuperar-password'>
	<?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-negro.png', $options = ['class'=>'recuperar-lg-negro no-mostrar']); ?>
	<h3><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Reset Password' : 'Restablecer Contraseña' ?></h3>
	<hr />
    <?php if (Yii::$app->session->hasFlash('email_correcto')): ?>
        <div class="alert alert-success ">
            <?php echo Yii::$app->session->getFlash('email_correcto') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('email_erroneo')): ?>
        <div class="alert alert-danger ">
            <?php echo Yii::$app->session->getFlash('email_erroneo') ?>
        </div>
    <?php endif; ?>
    <?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? "<p>Enter your <b>Username</b> (E-mail), We'll send you an email with your username and a link to reset your password.</p>" : '<p>Ingresa tu <b>Usuario</b> (correo electrónico) que utilizaste al momento de registrarte. Te enviaremos un correo electronico a dicho usuario con un enlace para restrablecer tu contraseña.</p>' ?>
          <?php $form = ActiveForm::begin([
                'id' => 'recuperar-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                ],
            ]); ?>

            <?= Html::textInput('email','', ['class'=>'form-login-input form-login-input', 'placeholder'=>'Dirección de correo electronico']) ?>

			<div class="form-group">
                    <?= Html::submitButton('ENVIAR', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
</div>