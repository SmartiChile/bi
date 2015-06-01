<?php
use yii\helpers\Html;
$this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->params['domainName'].'site/evento?e='.$model->pk]);
$this->registerMetaTag(['name' => 'og:tittle', 'content' => 'Barrio Italia']);
$this->registerMetaTag(['name' => 'og:description', 'content' => Yii::$app->funciones->quitarTags($model->descripcion)]);
$this->registerMetaTag(['name' => 'og:image', 'content' =>Yii::$app->params['domainName'].'/images/eventos/'.$model->imagen]);
$this->title = 'Evento - '.$model->titulo;

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
	<h3 class="h3-movil">EVENTOS</h3>
	<div class="puntos-separadores no-mostrar"></div>
	<div class="contenido-n">
		<div class="imagen-n">
			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/eventos/'.$model->imagen, $options = ['width' => '100%']); ?>
		</div>
		<div class="info-n">
			<h3><?php echo $model->titulo;?></h3>
			<h5><i class="glyphicon glyphicon-calendar"></i> <?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Start:' : 'Inicio:' ?> <?php echo Yii::$app->formatter->asDatetime($model->inicio, "php:d-m-Y H:i:s"); ?> | <?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'End:' : 'Termino:' ?> <?php echo Yii::$app->formatter->asDatetime($model->fin, "php:d-m-Y H:i:s") ?></h5>
			<?php echo $model->descripcion; ?>
			<div class="contenedor-compartir-noticias">
				<div class="cada-red-compartir">
					<div class="fb-share-button" data-href="<?= Yii::$app->params['domainName'].'site/evento?e='.$model->pk ?>" data-layout="button_count"></div>
				</div>
				<div class="cada-red-compartir" id="margen-compartir-tw">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= Yii::$app->params['domainName'].'site/evento?e='.$model->pk ?>" data-via="somositalia" data-lang="<?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'en' : 'es' ?>" data-hashtags="barrioitalia">Twittear</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
			</div>
		</div>
	</div>
</div>