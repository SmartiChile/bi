<?php
use yii\helpers\Html;
$this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->params['domainName'].'site/arriendo?a='.$model->pk]);
$this->registerMetaTag(['name' => 'og:tittle', 'content' => 'Barrio Italia']);
$this->registerMetaTag(['name' => 'og:description', 'content' => Yii::$app->funciones->quitarTags($model->descripcion)]);
$this->registerMetaTag(['name' => 'og:image', 'content' =>Yii::$app->params['domainName'].'/images/arriendos/'.$model->imagen1]);

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
');

$this->title = 'Arriendo - '.$model->titulo;
?>

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
	<h3 class="h3-movil">ARRIENDOS</h3>
	<div class="puntos-separadores no-mostrar"></div>
	<div class="contenido-n">
		<div class="imagen-na">
			<div id="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen1, $options = ['width' => '100%']); ?>
			</div>
			<?php 
				if ($model->imagen1 != NULL)
					{
						?>
						<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen1 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen1, $options = ['class' => 'thumb']); ?>
						</a>
						<?php
					}
			?>
			<?php 
				if($model->imagen2 != NULL)
				{
					?>
					<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen2 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen2, $options = ['class' => 'thumb']); ?>
					</a>
					<?php
				}
			?>

			<?php 
				if($model->imagen3 !== NULL)
				{
					?>
					<a href="#" rel="<?php echo Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen3 ?>" class="image"><?php echo Html::img(Yii::$app->request->baseUrl.'/images/arriendos/'.$model->imagen3, $options = ['class' => 'thumb']); ?>
					</a>
					<?php
				}
			?>
		</div>
		<div class="info-n">
			<h3>
			<?php 
				echo $model->titulo;
			?>
			</h3>
			<?php echo $model->descripcion; ?>
			<p><i class="glyphicon glyphicon-map-marker"></i> <strong><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Address:' : 'Dirección:' ?></strong> <?php echo $model->direccion; ?></p>
			<p><i class="glyphicon glyphicon-earphone"></i> <strong><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Phone:' : 'Teléfono:' ?></strong> <?php echo $model->telefono; ?></p>
			<p><i class="glyphicon glyphicon-envelope"></i> <strong>E-mail:</strong> <?php echo $model->email; ?></p>
			<p><i class="glyphicon glyphicon-user"></i> <strong><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Contact:' : 'Contacto:' ?></strong> <?php echo $model->nombre_contacto; ?></p>
			
			<div class="contenedor-compartir-noticias">
				<div class="cada-red-compartir">
					<div class="fb-share-button" data-href="<?= Yii::$app->params['domainName'].'site/arriendo?a='.$model->pk ?>" data-layout="button_count"></div>
				</div>
				<div class="cada-red-compartir" id="margen-compartir-tw">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= Yii::$app->params['domainName'].'site/arriendo?a='.$model->pk ?>" data-via="somositalia" data-lang="<?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'en' : 'es' ?>" data-hashtags="barrioitalia">Twittear</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
			</div>
		</div>
	</div>
</div>
