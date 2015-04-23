<?php 
use yii\helpers\Html;

$this->title = 'Barrio italia - Como llegar';
?>
<div id="contenedor-elbarrio">
	<h3>COMO LLEGAR</h3>
	<div class='puntos-separadores'></div>
	<div class="info-elbarrio">

		<div class="contenedor-como-llegar" id="imprimir">
			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/mapa-acc.svg'); ?>
		</div>
		<div class="boton-imprimir-mapa" id="boton-imprimir">
			<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=>'Imprimir mapa']), "javascript:imprSelec('imprimir')"); ?>
		</div>
		
	</div>
	<div class='menu-elbarrio'>
		<?= Yii::$app->funciones->menu_elbarrio() ?>
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