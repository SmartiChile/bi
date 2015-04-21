<?php
use yii\helpers\Html;

$this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->params['domainName'].'site/imagen?i='.$model->pk]);
$this->registerMetaTag(['name' => 'og:tittle', 'content' => 'Barrio Italia']);
$this->registerMetaTag(['name' => 'og:description', 'content' => $model->titulo]);
$this->registerMetaTag(['name' => 'og:image', 'content' =>Yii::$app->params['domainName'].'/images/vitrina/'.$model->imagen]);

$this->title = 'Barrio Italia - '.$model->titulo;

?>



<div class="contenedor-vitrina">
	<br />
	<h3>BARRIO ITALIA</h3>
	<div class="puntos-separadores"></div>
	<div id="imagen_part">
		<?= Html::img(Yii::$app->request->baseUrl.'/images/vitrina/'.$model->imagen) ?>
		<div id="imagen-top-titulo">
			<p><?= $model->titulo ?></p>
			<div id="social-imagen"><?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face-vitrina.png'), 'http://www.facebook.com/sharer.php?u='.Yii::$app->params['domainName'].'site/imagen?i='.$model->pk, $options = ["onclick"=>"goclicky(this); return false;", 'target'=>'_blank']); ?></div>
		</div>
	</div>
</div>