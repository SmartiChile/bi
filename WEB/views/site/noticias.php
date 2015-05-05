<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Noticias';
?>

<div class="contenedor-prensa">
	<br>
	<h3 class="h3-movil">NOTICIAS</h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-prensa">

		<?php
			if($noticias == null){
				echo 'Lo sentimos, no se han publicado noticias aún.';
			}
		?>

		<?php foreach ($noticias as $noticia): ?>
			<div class="cada-noticia">

				<div class="img-noticia">
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/noticias/'.$noticia->imagen, $options = ['width' => '100%']), ['/site/noticia', 'lan' => $idioma->abreviacion, 'id' => $noticia->pk]); ?>
				</div>

				<div class="info-noticia">
					<?php echo Html::a('<h3>'.$noticia->titulo.'</h3>', ['/site/noticia', 'lan' => $idioma->abreviacion, 'id' => $noticia->pk]); ?>
					<?php
						$descripcion = Yii::$app->funciones->quitarTags($noticia->descripcion); 
					?>
					<p><?php echo substr($descripcion, 0, 700)."..."; ?></p>
				</div>

				<div class="ver-mas-noticias">
					<?php echo Html::a("<p>ver más</p>", ['/site/noticia', 'lan' => $idioma->abreviacion, 'id' => $noticia->pk]); ?>
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'15%', "id"=>"float-iconos"]), ['/site/noticia', 'lan' => $idioma->abreviacion, 'id' => $noticia->pk]); ?>
				</div>

			</div>
		<?php endforeach; ?>

	</div>

<?php

	echo LinkPager::widget([
	   'pagination' => $pages,
	   'options' => [
	   		'class'=> 'paginacion-noticias'
	   		]
	 ]);
?>

</div>