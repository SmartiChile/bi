<?php 
use yii\helpers\Html;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Create your route' : 'Crea tu ruta');
?>

<div class="contenedor-vitrina">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'CREATE YOUR ROUTE' : 'CREA TU RUTA' ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-crea-tu-ruta">
		<h3><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Here you will be able to find shops, restaurants, coffee shops, galleries and all the places and services you need to locate in Barrio Italia. In addition, you will find:' : 'Aquí podrás encontrar tiendas, restaurant, café, galerías y todo lo que necesites de Barrio Italia. A demás podrás:' ?></h3>

		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-search.png', ['width'=>'100%', 'class'=>'ico-ruta', 'id'=>'ico-ruta'])?><h4><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Search for the place you want to visit.' : 'Buscar el lugar que quieres visitar.' ?></h4>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-like.png', ['width'=>'100%', 'class'=>'ico-ruta'])?><h4><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Choose places and print your route.' : 'Seleccionar lugares e imprimir tu ruta.' ?></h4>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-star.png', ['width'=>'100%', 'class'=>'ico-ruta'])?><h4><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Appraise and know the experiences of previous visitors.' : 'Evaluar y conocer las experiencias de los visitantes.' ?></h4>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-info.png', ['width'=>'100%', 'class'=>'ico-ruta'])?><h4><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Know well every single detail of the place you want to visit.' : 'Conocer cada detalle del lugar a visitar.' ?></h4>

		<?php 
			$boton = "<div class='boton-comenzar-ruta'><h4>".($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'BEGIN' : 'COMENZAR')."</h4></div>";
			echo Html::a($boton, ['site/inicioruta', 'lan'=>$idioma->abreviacion]);
		?>
		
	</div>
</div>