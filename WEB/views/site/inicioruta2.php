<?php 
use yii\helpers\Html;

$this->title = 'Crea tu ruta';
?>

<div class="contenedor-vitrina">
	<br>
	<h3>CREA TU RUTA</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-crea-tu-ruta">
		<h3>Aquí podrás encontrar tiendas, restaurant, café, galerías y todo lo que necesites de Barrio Italia. A demás podrás:</h3>

		
		<?php 
			$boton = "<div class='boton-comenzar-ruta'><h4>COMENZAR</h4></div>";
			echo Html::a($boton, ['site/inicioruta']);
		?>
		
	</div>
</div>