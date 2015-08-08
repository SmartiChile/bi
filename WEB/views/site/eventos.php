<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Events' : 'Eventos');

?>

<div class="contenedor-prensa">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'EVENTS' : 'EVENTOS' ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-prensa">

		<?php if($eventos == null) : ?>
			<?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? '<p>Sorry, there are no published events yet.</p>' : '<p>Lo sentimos, no se han publicado eventos aún.</p>' ?>
		<?php endif; ?>

		<?php foreach ($eventos as $evento): ?>
			<div class="cada-noticia">

				<div class="img-noticia">
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/eventos/'.$evento->imagen, $options = ['width' => '100%']), ['/site/evento', 'lan' => $idioma->abreviacion, 'id' => $evento->pk]); ?>
				</div>

				<div class="info-noticia">
					<?php echo Html::a('<h3>'.$evento->titulo.'</h3>', ['/site/evento', 'lan' => $idioma->abreviacion, 'id' => $evento->pk]); ?>
					<?php
						$descripcion = Yii::$app->funciones->quitarTags($evento->descripcion); 
					?>
					<p><?php echo substr($descripcion, 0, 700)."..."; ?></p>
				</div>

				<div class="ver-mas-noticias">
					<?php echo Html::a("<p>".($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'More' : 'Ver Más')."</p>", ['/site/evento', 'lan' => $idioma->abreviacion, 'id' => $evento->pk]); ?>
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'15%', "id"=>"float-iconos"]), ['/site/evento', 'lan' => $idioma->abreviacion, 'id' => $evento->pk]); ?>
				</div>

			</div>
		<?php endforeach; ?>

	</div>

<?php

	echo LinkPager::widget([
	   'pagination' => $pages2,
	   'options' => [
	   		'class'=> 'paginacion-noticias'
	   		]
	 ]);
?>

</div>