<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Prensa';
?>

<div class="contenedor-prensa">
	<br>
	<h3>PRENSA</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-prensa">

		<?php
			if($prensa == null){
				echo 'Lo sentimos, no se han publicado articulos de prensa aún.';
			}
		?>

		<?php foreach ($prensa as $p): ?>
			<div class="cada-prensa">
				<?php echo Html::a('<h3>'.$p->titulo.'</h3>', ['/site/infoprensa?p='.$p->pk]); ?>
				<div class="cada-prensa-imagen">
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/noticias/'.$p->imagen, $options = ['width' => '100%']), ['/site/infoprensa?p='.$p->pk]); ?>
				</div>
				<?php
					$descripcion = Yii::$app->funciones->quitarTags($p->descripcion); 
				?>
				<p><?php echo substr($descripcion, 0, 330)."..."; ?></p>
				<div class="ver-mas-prensa">
					<?php echo Html::a("<p>ver más</p>", ['/site/infoprensa?p='.$p->pk]); ?>
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'30%', "id"=>"float-iconos"]), ['/site/infoprensa?p='.$p->pk]); ?>
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
