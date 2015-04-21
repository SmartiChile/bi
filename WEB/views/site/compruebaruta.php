<?php 
use yii\helpers\Html;

$this->title = 'Comprobar ruta';
?>

<div class="contenedor-vitrina">
	<br>
	<h3>COMPROBAR RUTA</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-crea-tu-ruta">
		<h3><?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre) ?> tienes una ruta en curso, ¿Que deseas hacer?</h3>

		<div class="contenedor-botones-ruta2">
		<?php 
			$boton = "<div class='boton-comenzar-ruta2'><h5>SEGUIR LA MISMA RUTA</h5></div>";
			echo Html::a($boton, ['site/tiendas']);
		?>
		<?php 
			$boton = "<div class='boton-comenzar-ruta2'><h5>COMENZAR UNA NUEVA RUTA</h5></div>";
			echo Html::a($boton, ['site/eliminaruta']);
		?>
		</div>
		
	</div>
</div>