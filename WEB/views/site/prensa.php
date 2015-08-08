<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Press' : 'Prensa');
?>

<div class="contenedor-prensa">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'PRESS' : 'PRENSA' ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-prensa">

		<?php if($prensa == null) : ?>
				<?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? '<p>Sorry, there are no published news press yet.</p>' : '<p>Lo sentimos, no se han publicado articulos de prensa aún.</p>' ?>
		<?php endif; ?>

		<?php foreach ($prensa as $p): ?>
			<div class="cada-prensa">
				<?php echo Html::a('<h3>'.$p->titulo.'</h3>', ['/site/infoprensa', 'lan' => $idioma->abreviacion, 'id' => $p->pk]); ?>
				<div class="cada-prensa-imagen">
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/noticias/'.$p->imagen, $options = ['width' => '100%']), ['/site/infoprensa', 'lan' => $idioma->abreviacion, 'id' => $p->pk]); ?>
				</div>
				<?php
					$descripcion = Yii::$app->funciones->quitarTags($p->descripcion); 
				?>
				<p><?php echo substr($descripcion, 0, 330)."..."; ?></p>
				<div class="ver-mas-prensa">
					<?php echo Html::a("<p>".($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'More' : 'Ver más')."</p>", ['/site/infoprensa', 'lan' => $idioma->abreviacion, 'id' => $p->pk]); ?>
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'30%', "id"=>"float-iconos"]), ['/site/infoprensa', 'lan' => $idioma->abreviacion, 'id' => $p->pk]); ?>
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
