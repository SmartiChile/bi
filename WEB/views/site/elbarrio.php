<?php
use kartik\tabs\TabsX;
$this->title = 'El Barrio';


$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-book"></i> Historia',
        'content'=>$this->render('historia'),
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-map-marker"></i> Como Llegar',
        'content'=>$this->render('comollegar'),
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-pushpin"></i> Arriendos',
        'content'=>$this->render('arriendos', ['arriendos'=>$arriendos, 'pages'=>$pages]),
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-briefcase"></i> Trabaja con nosotros',
        'content'=>$this->render('trabaja'),
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-calendar"></i> Próximos Eventos',
        'content'=>$this->render('eventos', ['eventos'=>$eventos, 'pages2'=>$pages2]),
    ],
];

?>


<div id="elbarrio_contenedor">
	<h3>EL BARRIO</h3>
	<div class="puntos-separadores"></div>
	<br />
	<?php 

	echo TabsX::widget([
	    'items'=>$items,
	    'position'=>TabsX::POS_LEFT,
	    'bordered'=>false,
	    'encodeLabels'=>false
	]);

	?>

</div>