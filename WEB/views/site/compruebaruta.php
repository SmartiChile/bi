<?php 
use yii\helpers\Html;

$this->title = 'Comprobar ruta';
?>

<div class="contenedor-vitrina">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'CHECK ROUTE' : 'COMPROBAR RUTA' ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-crea-tu-ruta">
		<h3><?php echo Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre) ?> <?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'you already have a route, what you want to do?' : 'tienes una ruta en curso, ¿Que deseas hacer?' ?></h3>
		
		<div class="contenedor-botones-ruta2">
		<?php 
			$boton = "<div class='boton-comenzar-ruta2'><h5>".($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'USE THE SAME ROUTE' : 'SEGUIR LA MISMA RUTA')."</h5></div>";
			echo Html::a($boton, ['site/tiendas', 'lan' => $idioma->abreviacion]);
		?>
		<?php 
			$boton = "<div class='boton-comenzar-ruta2'><h5>".($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'START A NEW ROUTE' : 'COMENZAR UNA NUEVA RUTA')."</h5></div>";
			echo Html::a($boton, ['site/eliminaruta', 'lan' => $idioma->abreviacion]);
		?>
		</div>
		
	</div>
</div>