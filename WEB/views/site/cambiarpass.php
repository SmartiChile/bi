<?php 
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

$this->title = 'Mi Panel: '.Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<div class="contenedor-elbarrio">
	<br>
	<h3 class="h3-movil">Bienvenido(a) <?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre);?> - Cambiar contraseña</h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-mis-rutas">
		<div class='menu-mis-rutas'>
			<?= Yii::$app->funciones->menu_usuario() ?>
		</div>
		<div class="info-mis-rutas">
			<h3>Cambiar contraseña</h3>
			<div class="contenedor-cambio-pass">

				<?php if (Yii::$app->session->hasFlash('error')): ?>
		            <div class="alert alert-danger ">
		              Se produjeron los siguientes errores al enviar el formulario:
		              <ul>
		                  <li><?php echo Yii::$app->session->getFlash('error') ?></li>
		              </ul>
		            </div>
	          	<?php endif; ?>

	          	<?php if (Yii::$app->session->hasFlash('correcto')): ?>
		            <div class="alert alert-success">
						<?php echo Yii::$app->session->getFlash('correcto') ?>
					</div>
	          	<?php endif; ?>

				<?php 
		            $form = ActiveForm::begin([
		                'id' => 'login-form-horizontal',
		                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
		            ]); 
		        ?>

			        <?= $form->field($model, 'nombre', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-pencil"></i>']]])->textInput(['maxlength' => 255, 'readonly'=>$model->isNewRecord ? false : true]) ?>

			        <?= $form->field($model, 'username', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]])->textInput(['maxlength' => 255, 'readonly'=>$model->isNewRecord ? false : true]) ?>

			        <?= $form->field($model, 'password', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-ruble"></i>']], ])->passwordInput(['maxlength' => 255, 'class'=>'w40', 'placeholder'=>'Contraseña actual', 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres'])->label("Contraseña actual") ?>

			        <div class="form-group field-usuario-password2">
				        <label class="col-sm-3 control-label" for="usuario-password">Contraseña nueva</label>
				        <div class="col-sm-9">
				            <?= Html::passwordInput('password1','', ['class'=>'form-control w40', 'placeholder'=>'Nueva contraseña', 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres']) ?>
				            <br />
				        </div>
				    </div>
				    <div class="form-group field-usuario-password2">
				        <label class="col-sm-3 control-label" for="usuario-password">Repetir contraseña</label>
				        <div class="col-sm-9">
				            <?= Html::passwordInput('password2','', ['class'=>'form-control w40', 'placeholder'=>'Repetir Contraseña', 'required'=>true, 'pattern'=>'.{6,24}', 'title'=>'El campo es obligatorio y debe contener entre 6 y 24 caracteres']) ?>
				        </div>
				    </div>

		        <div class="form-group botones-panel form-group-cambiar">
		            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn boton-cambiar btn-primary ' : 'btn btn-primary']) ?>
		        </div>

		        <?php ActiveForm::end(); ?>
			</div>
		</div>

	</div>


</div>
