<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\widgets\ActiveForm;
use kartik\widgets\StarRating;
use yii\helpers\Url;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Stores' : 'Tiendas');

$this->registerJs('
		$(".ruta-like").click(function(){
					var tienda = $(this).attr("data-like");
					$(".idlike"+tienda).off("click");
				   	$.ajax({
		                type: "POST",
		                data: ({
		                	t : tienda,
		                }),
		                url: "'.Url::to(['site/agregaruta']).'",
		                success: function(data) {
		                	if(data == 1){
		                		$(".idlike" + tienda).attr("src", "'.Yii::$app->request->baseUrl.'/images/ico-ruta.png");
		                	}
		                	else
		                		alert("No agregado");
		                },
		            });
		}); 
');

?>

<div class="contenedor-prensa">
	<br>
	<h3 class="h3-movil"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'STORES' : 'TIENDAS' ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="contenido-prensa">
		<div class="contenedor-buscador-tienda-tiendas">
			<?php 
				echo Yii::$app->funciones->isUser() ? Html::a('<div class="boton-ver-mi-ruta"><h2>'.($idioma == 'en' || $idioma == 'EN' ? 'SEE MY ROUTE' : 'VER MI RUTA').'</h2></div>', ['site/mipanel', 'lan'=>$idioma->abreviacion]) : '';
			?>
			
			<div class="buscador-tienda-tiendas">
				<div class="buscador">
					<?php 
		                    $form = ActiveForm::begin([
		                        'id' => 'login-form-inline',
		                        'type' => ActiveForm::TYPE_INLINE,
		                        'method' => 'get',
		                    ]); 
		                ?>
		                    <?= Html::textInput('b', $b, ['class'=>'form-control', 'placeholder'=>$idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Keyword' : 'Palabra Clave']) ?>
		                    <?= Html::submitButton($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Search' : 'Buscar', ['class' => 'buscar-tienda']) ?>
		                <?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>

		<?php if($tiendas == null) : ?>
				<?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? '<p>Sorry, no matches were found with the search criteria.</p>' : '<p>Lo sentimos, no se han encontrado coincidencias con los criterios de búsqueda.</p>' ?>
		<?php endif; ?>

		<?php foreach($tiendas as $tienda): ?>
			<h3 class="h3-movil" id="no-mostrar"><?= $tienda->nombre ?></h3>
			<div class="cada-tienda-tiendas">
				<?php 
				    if (Yii::$app->funciones->enOferta($tienda->pk) == 1)
				    	echo Html::img(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? Yii::$app->request->baseUrl.'/images/ribbon-en.svg' : Yii::$app->request->baseUrl.'/images/ribbon.svg', ['class'=>'tile-hot-ribbon']);
				?>
				<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$tienda->imagen1, $options = ['width'=>'100%']),['site/tienda', 'id'=>$tienda->pk, 'lan' => $idioma->abreviacion]); ?>

				<div class="informacion-tienda-tiendas">
					<div class="textos-tienda-tiendas">
                        <h3><?php echo Html::a($tienda->nombre, ['site/tienda', 'id'=>$tienda->pk, 'lan' => $idioma->abreviacion]); ?></h3>
                        <h4><?php echo $tienda->circuitoFk->nombre;?></h4>
                    </div>
                    <div class="iconos-tienda-tiendas">
                    	<?php if(!Yii::$app->user->isGuest && Yii::$app->funciones->rutaActiva(Yii::$app->user->identity->pk)): ?>
	                    <?php if(Yii::$app->funciones->perteneceRuta(Yii::$app->user->identity->pk, $tienda->pk)): ?>
	                    <?= Yii::$app->user->isGuest ? " ": "<div class='icono-ruta-tienda'>".Html::img(Yii::$app->request->baseUrl.'/images/ico-ruta.png', ['class'=>'tool', 'title'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'On my route' : 'En mi ruta', 'data-like' => $tienda->pk, 'id'=>'ruta'])."</div>"; ?>
	                    <?php else: ?>
	                    <?= Yii::$app->user->isGuest ? " ": "<div class='icono-ruta-tienda'>".Html::img(Yii::$app->request->baseUrl.'/images/ico-ruta-no.png', ['class'=>'tool ruta-like idlike'.$tienda->pk, 'title'=>($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Add to my route' : 'Agregar a ruta', 'data-like' => $tienda->pk, 'id'=>'ruta'])."</div>"; ?>
	                    <?php endif; ?>
	                    <?php endif; ?>

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