<?php
use yii\helpers\Html;
use kartik\widgets\StarRating;
use yii\helpers\Url;

$this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->params['domainName'].'site/tienda?t='.$model->pk]);
$this->registerMetaTag(['name' => 'og:tittle', 'content' => 'Barrio Italia']);
$this->registerMetaTag(['name' => 'og:description', 'content' => Yii::$app->funciones->quitarTags($model->descripcion)]);
$this->registerMetaTag(['name' => 'og:image', 'content' =>Yii::$app->params['domainName'].'/images/tienda/'.$model->imagen1]);

$this->registerJs('
			 $(function() {
				$(".image").click(function() {
				var image = $(this).attr("rel");
				$("#image").hide();
				$("#image").fadeIn("slow");
				$("#image").html("<img src= "+ image +" />");
				return false;
					});
				});

		$("#rat").on("rating.change", function(event, value, caption) {
		    $.ajax({
                type: "POST",
                data: ({
                	r : value,
                	t : '.$model->pk.'
                }),
                url: "'.Url::to(['site/ratingtienda']).'",
                success: function(data) {
                	 $("#rat").rating("refresh", {
                	 	disabled: true, 
                	 	showClear: false
                	 });
                },
            });
		});

		$("#alert").on("closed.bs.alert")

		
');

$this->registerJs('

		$(".ruta-like").click(function(){
				   	$.ajax({
		                type: "POST",
		                data: ({
		                	t : '.$model->pk.'
		                }),
		                url: "'.Url::to(['site/agregaruta']).'",
		                success: function(data) {
		                	if(data == 1){

		                		document.getElementById("ruta").src = "'.Yii::$app->request->baseUrl.'/images/ico-ruta2.png";
		                		document.getElementById("alert").style.display = "block";
		                		$(".ruta-like").off("click");
		                	}
		                	else
		                		alert("No agregado");
		                },
		            });
		}); 
');

$this->title = 'Tienda - '.$model->nombre;
?>

<style type="text/css">
    .container{
    	padding: 0 !important;
    	margin: 0 !important;
    }
</style>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'en_EN' : 'es_LA' ?>/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="contenedor-n">
	<br>
	<h3 class="h3-movil margen-container">TIENDAS - <?php echo $model->nombre;?></h3>

	<div class="puntos-separadores no-mostrar"></div>

	<div class="banner-tienda">
		<div class="logotipo-tienda">
			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->logotipo, ['width'=>'100%']);?>
		</div>
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->banner, ['width'=>'100%']);?>
	</div>

	<div class="contenido-tienda">
		<div class="display-tienda">
			<div class="imagenes-tienda">
				<div id="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen1, ['width' => '100%']); ?>
				</div>
				<?php 
				if ($model->imagen1 != NULL)
					{
						?>
						<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen1 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen1, ['class' => 'thumb2']); ?>
						</a>
						<?php
					}
				?>
				<?php 
				if ($model->imagen2 != NULL)
					{
						?>
						<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen2 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen2, ['class' => 'thumb2']); ?>
						</a>
						<?php
					}
				?>
				<?php 
				if ($model->imagen3 != NULL)
					{
						?>
						<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen3 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen3, ['class' => 'thumb2']); ?>
						</a>
						<?php
					}
				?>
				<?php 
				if ($model->imagen4 != NULL)
					{
						?>
						<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen4 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen4, ['class' => 'thumb2']); ?>
						</a>
						<?php
					}
				?>
				<?php 
				if ($model->imagen5 != NULL)
					{
						?>
						<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen5 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$model->imagen5, ['class' => 'thumb2']); ?>
						</a>
						<?php
					}
				?>
			</div>
			<div class="info-tienda">
				<div class="head-tienda">
					<h3><?php echo $model->nombre; ?></h3>


					<?php if(!Yii::$app->user->isGuest && Yii::$app->funciones->rutaActiva(Yii::$app->user->identity->pk)): ?>
	                    <?php if(Yii::$app->funciones->perteneceRuta(Yii::$app->user->identity->pk, $model->pk)): ?>
	                        <?= Yii::$app->user->isGuest ? " ": "<div class='ruta-head-tienda'>".Html::img(Yii::$app->request->baseUrl.'/images/ico-ruta2.png', ['width'=>'100%', 'class'=>'tool', 'title'=>'En mi ruta', 'id'=>'enruta'])."</div>"; ?>
						<?php else: ?>
	                        <?= Yii::$app->user->isGuest ? " ": "<div class='ruta-head-tienda'>".Html::img(Yii::$app->request->baseUrl.'/images/ico-ruta2-no.png', ['width'=>'100%', 'class'=>'tool ruta-like', 'title'=>'Agregar a mi ruta', 'id'=>'ruta'])."</div>"; ?>
						<?php endif; ?>
	                <?php endif; ?>

					<?php 
						foreach($ofertas as $oferta)
						{
							if (Yii::$app->funciones->enOferta($model->pk) == 1):?>
								<div class="oferta-head-tienda">
									<?php echo Html::img(Yii::$app->request->baseUrl.'/images/ico-sale.png', ['width'=>'100%', 'class'=>'tool', 'title'=> round($oferta->descuento)."%<br>".Yii::$app->funciones->quitarTags($oferta->descripcion)]);?>
								</div>
							<?php endif ?>
					<?php
						}
					?>
					<div class="rating-head-tienda">
                        			<?php
										echo StarRating::widget([
										    'name' => 'rating_21',
										    'id' => 'rat',
										    'value' => $model->rating,
										    'pluginOptions' => [
										    	'size' => 'sm',
										        'showClear' => false,
										        'showCaption' => false,
										    ],
										]);
									?>
                    </div>
				</div>

				<div class="alert alert-success alert-dismissible fade in alerta" role="alert" id="alert">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			      <strong>Excelente!</strong> Tienda agregada a tú ruta. Para revisar tu ruta da clic <?php echo Html::a("aquí", ['site/mipanel'], ['class'=>'alert-link']);?>
			    </div>

				<div class="descripcion-tienda">
					<?php echo $model->descripcion; ?>
				</div>
				<div class="contenedor-compartir-tienda">
					<div class="cada-red-compartir">
						<div class="fb-share-button" data-href="<?= Yii::$app->params['domainName'].$idioma->abreviacion.'/site/tienda/'.$model->pk ?>" data-layout="button_count"></div>
					</div>
					<div class="cada-red-compartir">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= Yii::$app->params['domainName'].'site/tienda?t='.$model->pk ?>" data-via="somositalia" data-lang="<?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'en' : 'es' ?>" data-hashtags="barrioitalia">Twittear</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
				</div>
				<div class="sub-informacion-tienda">
					<div class="sub-info-tienda">
						<?php if ($model->sitio_web != NULL){ ?>
							<p><i class="glyphicon glyphicon-globe"></i> <?php echo $model->sitio_web; ?></p>
						<?php } ?>
						<p><i class="glyphicon glyphicon-earphone"></i> <?php echo $model->telefono; ?></p>
						<p><i class="glyphicon glyphicon-map-marker"></i> <?php echo $model->localFk->direccion.", ".$model->numeracion; ?></p>
						<p><i class="glyphicon glyphicon-calendar"></i> <?php echo $model->horario; ?></p>
					</div>
					<div class="sub-redes-tienda">
						<div class="contenedor-red-tienda">
							<?php 
							if ($model->tripadvisor != NULL)
							{
								?>
								<div class="icono-red-tienda"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tripad-black.png', ['width'=>'100%', 'class'=>'tool', 'title'=>$model->tripadvisor]),'http://'.$model->tripadvisor, ['target'=>'_black']); ?>
								</div>
								<?php
							}
							?>
							<?php
							if($model->pinterest != NULL)
							{
								?>
								<div class="icono-red-tienda"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-pint-black.png', ['width'=>'100%', 'class'=>'tool', 'title'=>$model->pinterest]),'http://'.$model->pinterest, ['target'=>'_black']); ?>
								</div>
								<?php
							}
							?>
							<?php
							if($model->googleplus != NULL)
							{
								?>
								<div class="icono-red-tienda"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-google-black.png', ['width'=>'100%', 'class'=>'tool', 'title'=>$model->googleplus]),'http://'.$model->googleplus, ['target'=>'_black']); ?>
								</div>
								<?php
							}
							?>
							<?php
							if($model->instagram != NULL)
							{
								?>
								<div class="icono-red-tienda"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta-black.png', ['width'=>'100%', 'class'=>'tool', 'title'=>$model->instagram]), 'http://'.$model->instagram, ['target'=>'_black']); ?>
								</div>
								<?php 
							}
							?>
							<?php
							if($model->twitter != NULL)
							{
								?>
								<div class="icono-red-tienda"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw-black.png', ['width'=>'100%', 'class'=>'tool', 'title'=>$model->twitter]),'http://'.$model->twitter, ['target'=>'_black']); ?>
								</div>
								<?php
							}
							?>
							<?php
							if($model->facebook != NULL)
							{
								?>
								<div class="icono-red-tienda"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face-black.png', ['width'=>'100%', 'class'=>'tool', 'title'=>$model->facebook]),'http://'.$model->facebook, ['target'=>'_black']); ?>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<?php 
					if($servicios != NULL):?>
					<div class="servicios-cada-tienda">
						<?php
							foreach($servicios as $servicio)
							{
								?>
								<div class="servicio-tienda">
									<?php
										echo Html::img(Yii::$app->request->baseUrl.'/images/servicios/'.$servicio->servicioFk->icono, ['width'=>'100%', 'class'=>'tool', 'title'=> $servicio->servicioFk->nombre]);
									?>
								</div>
								<?php
							}
						?>
					</div>
					<?php endif ?>
				
				<?php 
					$tags = Yii::$app->funciones->tagsTienda($model->tags);
					if($tags[0] != '')
					{
						echo "<h4>Tags</h4>";
						foreach($tags as $tag)
						{
							echo Html::a("<div class='tag-tienda'><p>".$tag."</p></div>", ['site/tiendas', 'b'=> $tag]);
						}
					}
					
				?>

			</div>
		</div>
	</div>
</div>