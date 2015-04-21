<?php
	use yii\helpers\Html;
	use app\models\Local;

	$locales = Local::find()->joinWith(['tiendas'])->all();

	foreach ($locales as $local) {
		echo $local->pk.' ';
		foreach($local->tiendas as $l){
			echo $l->pk.' ';
		}
		echo '<hr />';
	}
	
?>


