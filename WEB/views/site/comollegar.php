<?php 
use yii\helpers\Html;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'How to arrive' : 'Como llegar');
?>

<div class="contenedor-elbarrio">
	<h3 class="h3-movil"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'HOW TO ARRIVE' : 'COMO LLEGAR' ?></h3>
	<div class='puntos-separadores no-mostrar'></div>
	
	<div class="informacion-elbarrio">

		<div class='menu-elbarrio'>
			<?= Yii::$app->funciones->menu_elbarrio($idioma->abreviacion) ?>
		</div>

		<div class="informacion-cada-barrio">
			<div class="contenedor-como-llegar" id="imprimir">
				<?php echo Html::img($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? Yii::$app->request->baseUrl.'/images/mapa-acc-en.svg' : Yii::$app->request->baseUrl.'/images/mapa-acc.svg', $options = ['width'=>'100%']); ?>
			</div>
			<div class="boton-imprimir-mapa" id="boton-imprimir">
				<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=> ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'Print' : 'Imprmir mapa']), "javascript:imprSelec('imprimir')"); ?>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	function imprSelec(imprimir){
		var ficha = document.getElementById(imprimir);
		var ventimp = window.open(' ','popimpr');
		ventimp.document.write(ficha.innerHTML);
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}
</script>