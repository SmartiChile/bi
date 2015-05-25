<?php
use yii\helpers\Html;
$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Mapa' : 'Mapa');
?>

<div class="contenedor-mapa">
	<br>
	<h3 class="h3-mapa"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'MAP' : 'MAPA') ?></h3>
	<div class="puntos-separadores no-mostrar"></div>

	<div class="mapa-map" id="imprimir">
		<?php echo Html::img(Yii::$app->request->baseUrl.'/images/mapa-acc.svg', $options = ['width'=>'100%']); ?>
	</div>
	<div class="boton-imprimir-mapa">
		<?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-print.png', ['width'=>'100%', 'class'=>'tool', 'title'=>'Imprimir mapa']), "javascript:imprSelec('imprimir')"); ?>
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
