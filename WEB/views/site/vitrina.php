<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/justifiedGallery.css');
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/swipebox.css');
$this->registerJs('
		$("#swipeboxExample").justifiedGallery({
		    lastRow : "nojustify", 
		    rowHeight : 170, 
		    rel : "gallery2",
		    margins : 2
		}).on("jg.complete", function () {
		    $(".vitrina-light").swipebox();
		});
');

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Gallery' : 'Vitrina');
?>



<div class="contenedor-vitrina">
	<br>
	<h3 class="h3-movil"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Gallery' : 'Vitrina.') ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

		<div class="galeria-vitrina" id="swipeboxExample">

			<?php
				if($vitrinas == null){
					echo ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Sorry, No images in the gallery' : 'Lo sentiemos, no se han publicado imagenes en la galería aún.');
				}
			?>

			<?php foreach ($vitrinas as $key => $vitrina): ?>
				<div>
					<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/vitrina/'.$vitrina->imagen, $options = ['alt'=>$vitrina->titulo, 'title'=>$vitrina->titulo]), ['/images/vitrina/'.$vitrina->imagen], ['class'=>'vitrina-light']); ?>
					<div class="social-link">
						<div class="cada-social">
							<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face-vitrina.png', $options = ['width' => '100%']), 'http://www.facebook.com/sharer.php?u='.Yii::$app->params['domainName'].$idioma->abreviacion.'/site/imagen/'.$vitrina->pk, $options = ["onclick"=>"goclicky(this); return false;", 'target'=>'_blank']); ?>
						</div>
						<div class="cada-social">
							<a href="//es.pinterest.com/pin/create/button/?url=<?php echo Yii::$app->params['domainName'].'site/vitrina' ?>&media=<?php echo Yii::$app->params['domainName'].'images/vitrina/'.$vitrina->imagen ?>&description=<?php echo $vitrina->titulo ?>" data-pin-do="buttonPin" data-pin-shape="round" data-pin-height="32"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_32.png" /></a>
						</div>
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

<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
