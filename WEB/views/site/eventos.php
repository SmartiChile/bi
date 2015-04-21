<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Barrio italia - Eventos';

?>

<div id="contenedor-elbarrio">
	<h3>EVENTOS</h3>
	<div class='puntos-separadores'></div>
	<div class="info-elbarrio">

		<div class="contenedor-eventos">

			<?php
				if($eventos == null){
					echo '<br/> Lo sentimos, no hay eventos publicados aún.';
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
	<div class='menu-elbarrio'>
		<?= Yii::$app->funciones->menu_elbarrio() ?>
	</div>
</div>