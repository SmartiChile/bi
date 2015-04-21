<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Barrio italia - Arriendos';
?>



<div id="contenedor-elbarrio">
	<h3>ARRIENDOS</h3>
	<div class='puntos-separadores'></div>
	<div class="info-elbarrio">

		<div class="contenedor-arriendos">

		<?php
			if($arriendos == null){
				echo '<br/> Lo sentimos, no hay arriendo publicados aún.';
			}
		?>

		<?php foreach ($arriendos as $arriendo): ?>
					<div class="info-cada-arriendo">
						<div class="img-arriendo" >
							<?php echo Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$arriendo->imagen1, ['width' => '100%']); ?>
						</div>
						<div class="info-arriendo">
							<div class="contenido-info-arriendo">
								<h3><?php echo $arriendo->titulo; ?></h3>
								<?php
									$descripcion = Yii::$app->funciones->quitarTags($arriendo->descripcion); 
								?>
								<p><?php echo substr($descripcion, 0, 220)."..."; ?></p>
								<div class="iconos-info-arriendo">
									<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-tel.png', $options = ['width' => '3%', "id" => "float-iconos"]); ?>
									<p><?php echo $arriendo->telefono; ?></p>
									<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-direccion.png', $options = ['width' => '3%', "id" => "float-iconos"]); ?>
									<p><?php echo $arriendo->direccion; ?></p>
								</div>
							</div>
							<div class="botones-ver-mas-arriendo">
								<?php echo Html::a("<p>ver más</p>", ['/site/arriendo?a='.$arriendo->pk]); ?>
								<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'20%', "id"=>"float-icono-mas-arriendo"]), ['/site/arriendo?a='.$arriendo->pk]); ?>
							</div>
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
	<div class='menu-elbarrio'>
		<?= Yii::$app->funciones->menu_elbarrio() ?>
	</div>
</div>