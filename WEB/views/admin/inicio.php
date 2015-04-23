<?php
/* @var $this yii\web\View */
use kartik\widgets\SideNav;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = 'Panel de administración';
$this->params['breadcrumbs'][] = 'Panel de Administración';

$rol = Yii::$app->funciones->decToRol(Yii::$app->user->identity->rol);
?>


<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">
       <div class="contenido-inicio-panel">
       		<div class="contenedor-info-admin">
	       		<div class="imagen-admin">
	       			<?php 
	       				if($_SESSION['face'] == 1){
	       					echo Html::img('//graph.facebook.com/'.$_SESSION['facebook']['id'].'/picture?type=large', ['width' => '100%']);
	       				}
	       				else{
	       					echo Html::img(Yii::$app->request->baseUrl.'/images/imagen-admin.jpg', ['width' => '100%']);
	       				}
	       			?>
	       		</div>
	       		<div class="informacion-admin">
	       			<h3><strong>Usuario:</strong> <?php echo Yii::$app->user->identity->username; ?></h3>
	       			<h4><strong>Nombre:</strong> <?php echo Yii::$app->user->identity->nombre; ?></h4>
	       			<p><strong>Tipo:</strong> <?php if($_SESSION['face'] == 0) echo "Registrado en la web"; else echo "Ingreso mediante Facebook";?></p>
	       			<p><strong>Administrador:</strong> <?= $rol['administrador'] == 1 ? "Sí" : "No" ?></p>
	       			<p><strong>Usuario:</strong> <?= $rol['usuario'] == 1 ? "Sí" : "No" ?></p>
	       			<br>

	       			<?php
	       				if($_SESSION['face'] == 0)
	       					echo Html::a('<p><strong>Cambiar contraseña</strong></p>', ['site/cambiarpass']); 
	       			?>
	       		</div>
       		</div>
       		<h3>Tags con más frecuencia</h3>
			<div class="grafico-admin">
				<?php
					echo Highcharts::widget([
					   'options' => [
					   	  'chart' => ['type' => 'column'],
					   	  'credits' => ['enabled' => false],
					      'title' => ['text' => 'Tags más frecuentes'],
					      'xAxis' => [
					         'categories' => $x,
					      	],
					      'yAxis' => [
					         'title' => ['text' => 'Frecuencia']
					      	],
					      'series' => [
					         ['name' => 'Frecuencia', 'data' => $y, 'color' => '#337ab7'],
					      ]
					   ]
					]);
				?>
			</div>
       </div>

    </div>
</div>
