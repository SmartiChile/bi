<?php 
use yii\helpers\Html;

$this->title = 'Crea tu ruta';
?>

<div class="contenedor-vitrina">
	<br>
	<h3 class="h3-movil">CREA TU RUTA</h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-crea-tu-ruta">
		<h3>Aquí podrás encontrar tiendas, restaurant, café, galerías y todo lo que necesites de Barrio Italia. A demás podrás:</h3>

		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-search.png', ['width'=>'100%', 
		'class'=>'ico-ruta', 'id'=>'ico-ruta'])?><h4>Buscar el lugar que quieres visitar.</h4>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-like.png', ['width'=>'100%', 'class'=>'ico-ruta'])?><h4>Seleccionar lugares e imprimir tu ruta.</h4>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-star.png', ['width'=>'100%', 'class'=>'ico-ruta'])?><h4>Evaluar y conocer las experiencias de los visitantes.</h4>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-info.png', ['width'=>'100%', 'class'=>'ico-ruta'])?><h4>Conocer cada detalle del lugar a visitar.</h4>

		<?php 
			$boton = "<div class='boton-comenzar-ruta'><h4>COMENZAR</h4></div>";
			echo Html::a($boton, ['site/inicioruta']);
		?>
		
	</div>
</div>