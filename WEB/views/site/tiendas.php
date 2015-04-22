<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\widgets\ActiveForm;
use kartik\widgets\StarRating;
use yii\helpers\Url;

$this->title = 'Barrio italia - Tiendas';

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
	<h3>TIENDAS</h3>
	<div class="puntos-separadores"></div>

	<div class="contenido-prensa">
		<div class="contenedor-buscador-tienda-tiendas">
			<div class="buscador-tienda-tiendas">
			    <div class="buscador">
		                <?php 
		                    $form = ActiveForm::begin([
		                        'id' => 'login-form-inline', 
		                        'type' => ActiveForm::TYPE_INLINE,
		                        'method' => 'get',
		                    ]); 
		                ?>
		                    <?= Html::textInput('b', $b, ['class'=>'form-control', 'placeholder'=>'Palabra Clave']) ?>
		                    <?= Html::submitButton('Buscar', ['class' => 'buscar-tienda']) ?>
		                <?php ActiveForm::end(); ?>
		        </div>
	        </div>
        </div>

        <?php
			if($tiendas == null){
				echo 'Lo sentimos, no se han registrado tiendas aún.';
			}
		?>

		<?php foreach($tiendas as $tienda): ?>
				    <div class="cada-tienda-tiendas">
				    <?php 
				    if (Yii::$app->funciones->enOferta($tienda->pk) == 1)
				    	echo Html::img(Yii::$app->request->baseUrl.'/images/ribbon.svg', ['class'=>'tile-hot-ribbon']);
				    ?>
                        <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/tiendas/'.$tienda->imagen1, $options = ['width'=>'100%']),['site/tienda?t='.$tienda->pk]); ?>
                        <div class="informacion-tienda-tiendas">
                        	<div class="textos-tienda-tiendas">
                        		<h3><?php echo Html::a($tienda->nombre, ['site/tienda?t='.$tienda->pk]); ?></h3>
                        		<h4><?php echo $tienda->circuitoFk->nombre;?></h4>
                        	</div>
                        	<div class="iconos-tienda-tiendas">
                        		<?php if(!Yii::$app->user->isGuest && Yii::$app->funciones->rutaActiva(Yii::$app->user->identity->pk)): ?>
	                        		<?php if(Yii::$app->funciones->perteneceRuta(Yii::$app->user->identity->pk, $tienda->pk)): ?>
	                        			<?= Yii::$app->user->isGuest ? " ": "<div class='icono-ruta-tienda'>".Html::img(Yii::$app->request->baseUrl.'/images/ico-ruta.png', ['class'=>'tool', 'title'=>'En mi ruta', 'data-like' => $tienda->pk, 'id'=>'ruta'])."</div>"; ?>
	                        		<?php else: ?>
	                        			<?= Yii::$app->user->isGuest ? " ": "<div class='icono-ruta-tienda'>".Html::img(Yii::$app->request->baseUrl.'/images/ico-ruta-no.png', ['class'=>'tool ruta-like idlike'.$tienda->pk, 'title'=>'Agregar a ruta', 'data-like' => $tienda->pk, 'id'=>'ruta'])."</div>"; ?>
	                        		<?php endif; ?>
	                        	<?php endif; ?>
                        		<div class="rating-tienda">
                        			<?php
										echo StarRating::widget([
										    'name' => 'rating_21',
										    'value' => $tienda->rating,
										    'pluginOptions' => [
										    	'size' => 'sm',
										        'showClear' => false,
										        'showCaption' => false,
										        'readonly' => true,
										    ],
										]);
									?>
                        		</div>
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