<?php

use yii\helpers\Html;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$rol = Yii::$app->funciones->DecToRol($model->rol);
?>

<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Usuario' : 'Modificar Usuario <b>'.$model->username.'</b>' ?></h1>

        <hr />

        <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

        <?= $form->field($model, 'nombre', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-pencil"></i>']]])->textInput(['maxlength' => 255, 'class'=>'w70', 'placeholder' => 'Ingrese su nombre']) ?>

        <?= $form->field($model, 'username', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]])->textInput(['maxlength' => 255, 'readonly'=>$model->isNewRecord ? false : true, 'class'=>'w50', 'placeholder' => 'Ingrese un nombre de usuario']) ?>

        <?= $form->field($model, 'password', ['addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-ruble"></i>']]])->passwordInput(['maxlength' => 255, 'class'=>'w40', 'required'=>$model->isNewRecord ? true : false, 'placeholder' => 'Ingrese una contraseña']) ?>

        <div class="form-group field-usuario-roles required">
            <label class="col-sm-3 control-label" for="usuario-nombre">Roles</label>
            <div class="col-sm-9">
                <?= CheckboxX::widget([
                    'name'=>'admin',
                    'value' => $rol['administrador'],
                    'options'=>['id'=>'admin'],
                    'pluginOptions'=>['threeState'=>false, 'size'=>'sm']
                ]);?>
                <label for="s_5">Administrador</label>
                <span style="border-left: 1px solid #ddd; margin:0 15px 0 11px;"></span>
                <?= CheckboxX::widget([
                    'name'=>'usuario',
                    'value' => $rol['usuario'],
                    'options'=>['id'=>'usuario'],
                    'pluginOptions'=>['threeState'=>false, 'size'=>'sm'],
                ]);?>   
                <label for="s_2">Usuario (Crear rutas, agregar tiendas a rutas, etc)</label>
            </div>
        </div>        
        
        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>