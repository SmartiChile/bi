<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Barrio italia - Eventos';

?>

<div class="contenedor-elbarrio">
	<h3 class="h3-movil">EVENTOS</h3>
	<div class='puntos-separadores no-mostrar'></div>
	
	<div class="informacion-elbarrio">

		<div class='menu-elbarrio'>
			<?= Yii::$app->funciones->menu_elbarrio($idioma->abreviacion) ?>
		</div>

		<div class="informacion-cada-barrio">
				<div class="contenedor-eventos">

				<?php
					if($eventos == null){
						echo ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? '<br /><p>Sorry , no events have been published yet</p>' : '<br /><p>Lo sentimos, no se han publicado eventos aún.</p>';
					}
				?>

				<?php foreach ($eventos as $evento): ?>
					<div class="contenedor-cada-evento">
						<div class="eventos-info1">
							<h3><?php echo $evento->titulo;?> </h3>
							<h6>Inicio: <?php echo Yii::$app->formatter->asDatetime($evento->inicio, "php:d-m-Y H:i:s")?></h6>
							<h6>Termino: <?php echo Yii::$app->formatter->asDatetime($evento->fin, "php:d-m-Y H:i:s")?></h6>
						</div>
						<div class="eventos-info2">
							<?php
								$descripcion = Yii::$app->funciones->quitarTags($evento->descripcion); 
							?>
							<p><?php echo substr($descripcion, 0, 200)."..."; ?></p>
						</div>
						<div class="eventos-info3">
							<?php echo Html::a("<p>ver más</p>", ['/site/evento?e='.$evento->pk]); ?>
							<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'20%', "id"=>"margen-ver-mas-info3"]), ['/site/evento?e='.$evento->pk]); ?>
						</div>
					</div>
				<?php endforeach; ?>

				<?php 
					echo LinkPager::widget([
						'pagination' => $pages2,
						'options' => [
								   	'class'=> 'paginacion-noticias'
							]
						]);
				?>
				</div>
			</div>
	</div>
</div>