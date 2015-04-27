<?php 
use yii\helpers\Html;

$this->title = 'Barrio italia - Historia';
?>

<div id="contenedor-elbarrio">
	<div class="botones-barrio-movil">
		<?php
			echo Html::a('<div class="cada-boton-barrio-movil"><p>Historia</p></div>', ['site/elbarrio']) 
		?>
		<?php
			echo Html::a('<div class="cada-boton-barrio-movil"><p>Como llegar</p></div>', ['site/comollegar']) 
		?>
		<?php
			echo Html::a('<div class="cada-boton-barrio-movil"><p>Arriendos</p></div>', ['site/arriendos']) 
		?>
		<?php
			echo Html::a('<div class="cada-boton-barrio-movil"><p>Trabaja con nosotros</p></div>', ['site/trabaja']) 
		?>
		<?php
			echo Html::a('<div class="cada-boton-barrio-movil"><p>Eventos</p></div>', ['site/eventos']) 
		?>
	</div>
	<h3 class="h3-movil">HISTORIA</h3>
	<div class='puntos-separadores no-mostrar'></div>
	<div class="info-elbarrio">

		<div class="info-historia">

			<h3>El Barrio</h3>
			<p>Barrio Italia es hoy un paseo obligado para los ciudadanos que buscan encantarse con la vidas 
				de barrio. Un lugar donde conviven a diario talleres de anticuarios, tiendas de diseño y 
				decoración, talleres mecánicos, restaurantes, galerías de arte, centros comunitarios, 
				colegios, un museo, una universidad y una serie de lugares típicos de un barrio: el almacén 
				de la esquina, la carnicería, la reparadora de calzado, el taller de bicicletas, entre otros.
			</p>
			<p>Te invitamos a recorrer sus calles y a descubrir el encanto del Barrio Italia.</p>

			<br>

			<h3>Historia</h3>
			<p>Barrio Italia es la denominación común que se da al sector que rodea a la Avenida Italia, 
				que es parte de las comunas de Providencia y Ñuñoa. El nombre está ligado a la construcción 
				del famoso y otrora muy concurrido Teatro Italia.
			</p>
			<p>Sus orígenes los encontramos a principios del siglo XX, específicamente entre los 
				años 1910 y 1940 cuando comenzó a desarrollarse en el sector una fuerte actividad 
				industrial y comercial, que vino acompañada de una consolidación del  sector como 
				residencial, con los servicios y actividades correspondientes.
			</p>

			<br>

			<h3>El Patrimonio</h3>
			<p>En el Barrio Italia encontramos una serie de lugares emblemáticos que nos muestran la 
				historia y el desarrollo del barrio, desde sus inicios como parcelas de agrado, pasando 
				por el período industrial, la construcción de viviendas sociales y de recintos educacionales, 
				la consolidación de un barrio residencial hasta convertirse en los últimos años en un 
				interesante centro de diseño, gastronomía, comercio y cultura.
			</p>
		</div>

		<div class="contenedor-fotos-historia">
			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/historia-1.jpg', $options = ['width'=>'100%', "id"=>"margen-fotos-historia"]); ?>
			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/historia-2.jpg', $options = ['width'=>'100%', "id"=>"margen-fotos-historia"]); ?>
			<?php echo Html::img(Yii::$app->request->baseUrl.'/images/historia-3.jpg', $options = ['width'=>'100%']); ?>
		</div>
	</div>
	<div class='menu-elbarrio'>
		<?= Yii::$app->funciones->menu_elbarrio() ?>
	</div>
</div>