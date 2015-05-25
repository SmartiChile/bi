<?php 
use yii\helpers\Html;

$this->title = 'Barrio italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'History' : 'Historia');
?>

<div class="contenedor-elbarrio">
	<h3 class="h3-movil"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'HISTORY' : 'HISTORIA' ?></h3>
	<div class='puntos-separadores no-mostrar'></div>
	<div class="informacion-elbarrio">

		<div class='menu-elbarrio'>
			<?= Yii::$app->funciones->menu_elbarrio($idioma->abreviacion) ?>
		</div>

		<div class="informacion-cada-barrio">
			<div class="info-historia">

				<h3><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'The Neighborhood' : 'El Barrio' ?></h3>
				<?php if($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en'): ?>
					<p>Barrio Italia is nowadays a recommended walk and a must for all the tourists who are looking for being captivated with the lives of this place, where antique shops, designer and decoration stores, garages, restaurants, art galleries, community centers, schools, a university, a museum, and a range of typical places that can be found in any given neighborhood, such as the corner store, the butcher’s, the footwear maintenance and the bicycle workshop among many others, live alongside each other on a daily basis.</p>
					<p>We would like to invite you to go through its streets and also discover the charm of Barrio Italia.</p>
				<?php else: ?>
					<p>Barrio Italia es hoy un paseo obligado para los ciudadanos que buscan encantarse con la vidas de barrio. Un lugar donde conviven a diario talleres de anticuarios, tiendas de diseño y decoración, talleres mecánicos, restaurantes, galerías de arte, centros comunitarios, colegios, un museo, una universidad y una serie de lugares típicos de un barrio: el almacén de la esquina, la carnicería, la reparadora de calzado, el taller de bicicletas, entre otros.</p>
					<p>Te invitamos a recorrer sus calles y a descubrir el encanto del Barrio Italia.</p>
				<?php endif; ?>
				<br>
				<h3><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'History' : 'Historia' ?></h3>
				<?php if($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en'): ?>
					<p>Barrio Italia is the common name given to the whole area that surrounds Avenida Italia Street, which is part of Providencia and Ñuñoa municipalities. This avenue was named like that after the construction of the famous and once quite visited Teatro Italia.</p>
					<p>Its origins date back to the beginning of the 20TH century, more exactly between the years 1910 and 1940, the time when an intense commercial and industrial activity started to develop, which was accompanied by the consolidation and strengthening of this area as a residential sector with all the services and activities related.</p>
				<?php else: ?>
					<p>Barrio Italia es la denominación común que se da al sector que rodea a la Avenida Italia, que es parte de las comunas de Providencia y Ñuñoa. El nombre está ligado a la construcción del famoso y otrora muy concurrido Teatro Italia.</p>
					<p>Sus orígenes los encontramos a principios del siglo XX, específicamente entre los años 1910 y 1940 cuando comenzó a desarrollarse en el sector una fuerte actividad industrial y comercial, que vino acompañada de una consolidación del  sector como residencial, con los servicios y actividades correspondientes.</p>
				<?php endif; ?>
				<br>
				<h3><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'The heritage' : 'El Patrimonio' ?></h3>
				

				<?php if($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en'): ?>
					<p>In Barrio Italia there are a number of landmarks that represent the history and development of the neighborhood, since its very beginnings as country houses, going trough the industrial period, the construction of social housing and educational premises, the consolidation as a domestic sector to finally become into an interesting center for design, cuisine, trade and culture.</p>
				<?php else: ?>
					<p>En el Barrio Italia encontramos una serie de lugares emblemáticos que nos muestran la historia y el desarrollo del barrio, desde sus inicios como parcelas de agrado, pasando por el período industrial, la construcción de viviendas sociales y de recintos educacionales, la consolidación de un barrio residencial hasta convertirse en los últimos años en un interesante centro de diseño, gastronomía, comercio y cultura.</p>
				<?php endif; ?>
			</div>

			<div class="contenedor-fotos-historia">
				<?php echo Html::img(Yii::$app->request->baseUrl.'/images/historia-1.jpg', $options = ['width'=>'100%', "id"=>"margen-fotos-historia"]); ?>
				<?php echo Html::img(Yii::$app->request->baseUrl.'/images/historia-2.jpg', $options = ['width'=>'100%', "id"=>"margen-fotos-historia"]); ?>
				<?php echo Html::img(Yii::$app->request->baseUrl.'/images/historia-3.jpg', $options = ['width'=>'100%']); ?>
			</div>
		</div>

	</div>

</div>