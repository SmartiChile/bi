<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'New' : 'Noticias');

?>

<div class="contenedor-elbarrio">
	<h3 class="h3-movil">NOTICIAS</h3>
	<div class='puntos-separadores no-mostrar'></div>
	
	<div class="informacion-elbarrio">

		<div class='menu-elbarrio'>
			<?= Yii::$app->funciones->menu_elbarrio($idioma->abreviacion) ?>
		</div>

		<div class="informacion-cada-barrio">
				<div class="contenedor-eventos">

				<?php
					if($noticias == null){
						echo ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? '<br /><p>Sorry , no new have been published yet</p>' : '<br /><p>Lo sentimos, no se han publicado noticias aún.</p>';
					}
				?>

				<?php foreach ($noticias as $noticia): ?>
					<div class="contenedor-cada-evento">
						<div class="eventos-info1">
							<h3><?php echo $noticia->titulo;?> </h3>
							<h6><?php echo Yii::$app->formatter->asDatetime($noticia->fecha, "php:d-m-Y H:i:s")?></h6>
						</div>
						<div class="eventos-info2">
							<?php
								$descripcion = Yii::$app->funciones->quitarTags($noticia->descripcion); 
							?>
							<p><?php echo substr($descripcion, 0, 200)."..."; ?></p>
						</div>
						<div class="eventos-info3">
							<?php echo Html::a(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? '<p>More</p>' : '<p>Ver más</p>', ['/site/noticia', 'lan' => $idioma->abreviacion, 'id' => $noticia->pk]); ?>
							<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'20%', "id"=>"margen-ver-mas-info3"]), ['/site/noticia', 'lan' => $idioma->abreviacion, 'id' => $noticia->pk]); ?>
						</div>
					</div>
				<?php endforeach; ?>

				<?php 
					echo LinkPager::widget([
						'pagination' => $pages,
						'options' => [
								   	'class'=> 'paginacion-noticias'
							]
						]);
				?>
				</div>
			</div>
	</div>
</div>