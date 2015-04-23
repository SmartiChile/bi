<?php
/* @var $this yii\web\View */
use kartik\widgets\SideNav;
use yii\helpers\Html;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = 'Panel de administración';
$this->params['breadcrumbs'][] = 'Panel de Administración';
?>


<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">
       <div class="contenido-inicio-panel">
       		<div class="contenedor-info-admin">
	       		<div class="imagen-admin">
	       			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/imagen-admin.jpg', ['width' => '100%']); ?>
	       		</div>
	       		<div class="informacion-admin">
	       			<h3><strong>Username:</strong> <?php echo Yii::$app->user->identity->username; ?></h3>
	       			<h4><strong>Nombre:</strong> <?php echo Yii::$app->user->identity->nombre; ?></h4>
	       			<p><strong>Tipo:</strong> <?php if($_SESSION['face'] == 0) echo "Registrado en la web"; else echo "Ingreso mediante Facebook";?></p>
	       			<p><strong>Rol:</strong> Ver Rol</p>
	       			<br>

	       			<?php
	       				if($_SESSION['face'] == 0)
	       					echo Html::a('<p><strong>Cambiar contraseña</strong></p>', ['site/cambiarpass']); 
	       			?>
	       		</div>
       		</div>
       		<h3>Tags con mas frecuencia</h3>
			<div class="grafico-admin">
				
			</div>
       </div>

    </div>
</div>
