<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Renting' : 'Arriendos');
?>



<div class="contenedor-elbarrio">
	<h3 class="h3-movil"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'RENTING' : 'ARRIENDOS' ?></h3>
	<div class='puntos-separadores no-mostrar'></div>

	<div class="informacion-elbarrio">

		<div class='menu-elbarrio'>
			<?= Yii::$app->funciones->menu_elbarrio($idioma->abreviacion) ?>
		</div>

		<div class="informacion-cada-barrio">

<div class="contenedor-arriendos">

		<?php
			if($arriendos == null){
				echo ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? '<br/> Sorry , no leases found.' : '<br/> Lo sentimos, no hay arriendos publicados aún.';
			}
		?>

		<?php foreach ($arriendos as $arriendo): ?>
					<div class="info-cada-arriendo">
						<div class="img-arriendo" >
							<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$arriendo->imagen1, ['width' => '100%']), ['/site/arriendo', 'lan' => $idioma->abreviacion, 'id' => $arriendo->pk]); ?>
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
								<?php echo Html::a(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'More ...' : 'Ver más', ['/site/arriendo', 'lan' => $idioma->abreviacion, 'id' => $arriendo->pk]); ?>
								<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-more.png', $options = ['width'=>'20%', "id"=>"float-icono-mas-arriendo"]), ['/site/arriendo', 'lan' => $idioma->abreviacion, 'id' => $arriendo->pk]); ?>
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

	</div>

</div>