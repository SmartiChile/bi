<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
if(isset($_GET['lan'])){
  $idioma = $_GET['lan'];
}else{
  $idioma = 'es';
}

$menu = Yii::$app->funciones->menu_web($idioma);



$this->registerCssFile(Yii::$app->request->baseUrl.'/css/barrioitalia.css');
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/media1.css'); 
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/media2.css'); 
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/media3.css'); 
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/media4.css'); 
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/media5.css');
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/tooltipster.css');


$this->registerJs('
    $(document).ready(function() {
             $(".tool").tooltipster();
        });
');


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href=<?php echo Yii::$app->request->baseUrl.'/images/favicon.ico' ?>>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript">
        function goclicky(meh)
        {
            var x = screen.width/2 - 700/2;
            var y = screen.height/2 - 450/2;
            window.open(meh.href, 'sharegplus','height=485,width=570,left='+x+',top='+y);
        }    
    </script>
</head>

<?php $this->beginBody() ?>
    <div class="wrap">
        <div class="franja-menu-movil">
            <?php
            NavBar::begin(['brandLabel' => '', 'options' => ['class' => 'navbar-inverse']]);
                echo Nav::widget([
                    'encodeLabels' => false,
                    'items' => [
                      ['label' => 'Inicio', 'url' => ['/site/index']],
                      ['label' => 'El Barrio', 'url' => ['/site/elbarrio']],
                      ['label' => 'Vitrina', 'url' => ['/site/vitrina']],
                      ['label' => 'Mapa', 'url' => ['/site/mapa']],
                      ['label' => 'Circuitos', 'url' => ['/site/circuitos']],
                      ['label' => 'Tiendas', 'url' => ['/site/tiendas']],
                      ['label' => 'Prensa', 'url' => ['/site/prensa']],
                      ['label' => 'Noticias', 'url' => ['/site/noticias']],
                      ['label' => 'Crea tu ruta', 'url' => ['/site/creaturuta']],
                      ['label' => 'Contacto', 'url' => ['/site/contacto']],
                      ['label' => '<hr class="hr-menu">'],
                      (Yii::$app->user->isGuest ? ['label' => 'Ingresar', 'url' => ['/site/login']] : ['label' => 'Mi Panel', 'url' => ['/site/mipanel']]),
                      (Yii::$app->funciones->isAdmin() ? ['label' => 'Panel de administración', 'url' => ['/admin/inicio']] : '' ),
                      (Yii::$app->funciones->isUser() ? ['label' => 'Salir', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']] : '' ),
                      ['label' => '<hr class="hr-menu">'],
                      ['label' => 'Español', 'url' => ['#']],
                      ['label' => 'Ingles', 'url' => ['#']],
                  ],
                ]);
            NavBar::end();
            ?>
        </div>
        <div class="logotipo-movil">
            <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/lg-top-movil.png', ['width'=>'100%']), ['site/index']); ?>
        </div>

        <div id="banner">

            <div id="frase-top">
                <h1><?= ($idioma == 'en' || $idioma == 'EN') ? 'Welcome to' : 'Bienvenido a'?></h1>
                <h1><strong>Barrio Italia</strong></h1>
            </div>

            <div id="play-top">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/home-play.png', $options = ['width'=>'100%']), 'https://www.youtube.com/embed/wjIwk01dP-A', ['rel'=>'shadowbox; width=1500; height=844']); ?>
            </div>

            <div id="logotipo-top">
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/lg-top.png', $options = ['width'=>'100%']), ['site/index']); ?>
            </div>

            <div id="social">
                <div class="idioma"><?= Yii::$app->funciones->Idiomas(); ?><br /></div>
                <?php if(!Yii::$app->user->isGuest):?>
                <div class="flecha-perfil">
                    <ul>
                      <li>
                        <button class="btn btn-default btn-xs " type="button" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                        <ul>
                            <li><?php echo Yii::$app->funciones->isUser() ? Html::a('<i class="glyphicon glyphicon-cog"></i> Mi Panel', ['site/mipanel']) : '' ?></li>
                            <li><?php echo Yii::$app->funciones->isAdmin() ? Html::a('<i class="glyphicon glyphicon-cog"></i> Panel de Administración', ['admin/inicio']) : '' ?></li>
                            <li><hr /></li>
                            <li><?php echo Html::a('<i class="glyphicon glyphicon-off margen-off"></i> Salir', ['site/logout'], ['data-method' => 'post']); ?></li>
                        </ul>
                      </li>
                    </ul>
                </div>
                <?php endif ?>
                <div class="perfil">
                    <?php
                    if(!Yii::$app->user->isGuest){
                        if($_SESSION['face'] == 1)
                            echo Html::img('//graph.facebook.com/'.$_SESSION['facebook']['id'].'/picture?width=50&height=50', ['class'=> 'imagen-circular']);
                        else
                            echo "<i class='glyphicon glyphicon-user'></i> ";
                    }
                    ?>
                <?= Yii::$app->user->isGuest ? Html::a(($idioma == 'EN' || $idioma == 'en') ? 'Enter' : 'Ingresar', ['site/login']).' / '.Html::a(($idioma == 'EN' || $idioma == 'en') ? 'Register' : 'Regístrate', ['site/registro']) : ($idioma == 'EN' || $idioma == 'en' ? 'Hi, ' : 'Hola, ') .Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre) ?></div>
                <div class="redes-socials">
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw.png', $options = ['width'=>'100%']), 'https://twitter.com/somositalia', ['target' =>'_black']); ?>
                    </div>
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta.png', $options = ['width'=>'100%']), '#'); ?>
                    </div>
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-youtube.png', $options = ['width'=>'100%']), '#'); ?>
                    </div>
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face.png', $options = ['width'=>'100%']), 'https://www.facebook.com/AsociacionBarrioItalia', ['target'=>'_black']); ?>
                    </div>
                </div>

            </div>

            
            <?= Html::img(Yii::$app->request->baseUrl.'/images/banner-2.jpg', ['class'=>'img_banner2']); ?>
            <video autoplay class="VideoInicial" id="videoInicio" loop preload="auto">
                    <source src="<?php echo Yii::$app->request->baseUrl.'/images/video-bi.mov'?>" type="video/webm">
                    <source src="<?php echo Yii::$app->request->baseUrl.'/images/video-bi.mp4'?>" type="video/mp4">
            </video>
            <div class="overVideo"></div>
            <nav id="menu-usuario">
                    <ul>
                        <?php foreach($menu as $link): ?>
                            <li><?= Html::a($link[1], [$link[2], 'lan' => $idioma]); ?></li>
                        <?php endforeach; ?>
                    </ul>
            </nav>
        </div>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer-final">
        <div class="contenedor-colores-completo">
            <div class="color1-home"></div>
            <div class="color2-home"></div>
            <div class="color3-home"></div>
            <div class="color4-home"></div>
            <div class="color5-home"></div>
            <div class="color6-home"></div>
        </div>

        <div class="footer-movil">
            <div class="cada-red-movil">
                 <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face-movil.png', $options = ['width'=>'100%']), ['#']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-you-movil.png', $options = ['width'=>'100%']), ['#']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw-movil.png', $options = ['width'=>'100%']), ['#']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta-movil.png', $options = ['width'=>'100%']), ['#']); ?>
            </div>
        </div>
        
        <div class="footer-uno">
            <div class="contenido-izquierda-footer-uno">
                <div class="info-izquierda-footer">
                    <div class="lg-corfo">
                        <p>Apoya:</p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-corfo.png', $options = ['width'=>'100%']); ?>
                    </div>
                    <div class="lg-min">
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-min.png', $options = ['width' => '100%']); ?>
                    </div>
                    <div class="lg-apri">
                        <p>Organiza:</p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-apri.png', $options = ['width' => '100%']); ?>
                    </div>
                    <div class="lg-ag">
                        <p>Administra:</p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-ag.png', $options = ['width' => '100%']); ?>
                    </div>
                    <div class="lg-nuevet">
                        <p>Desarrollo Web:</p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-nuevet.png', $options = ['width' => '100%']); ?>
                    </div>
                </div>
            </div>
            <div class="contenido-derecha-footer-uno">
                <div class="tabla-footer">
                    <table border="0" width="15%">
                        <tr>
                          <td><h5>EL BARRIO</h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Historia</p>', ['site/elbarrio']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Como llegar</p>', ['site/comollegar']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Arriendos</p>', ['site/arriendos']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Trabaja con nosotros</p>', ['site/trabaja']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Eventos</p>', ['site/eventos']); ?></td>
                        </tr>
                    </table>
                    <table border="0" width="18%">
                        <tr>
                          <td><h5>BARRIO ITALIA</h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Vitrina</p>', ['site/vitrina']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Mapa</p>', ['site/mapa']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Circuitos</p>', ['site/circuitos']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Tiendas</p>', ['site/tiendas']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Contacto</p>', ['site/contacto']); ?></td>
                        </tr>
                    </table>
                    <table border="0" width="12%">
                        <tr>
                          <td><h5>NOTICIAS</h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Noticias</p>', ['site/noticias']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Prensa</p>', ['site/prensa']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"></td>
                        </tr>
                    </table>
                    <table border="0" width="16%">
                        <tr>
                          <td><h5>MI BARRIO</h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Crea tu ruta</p>', ['site/creaturuta']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                            if(!Yii::$app->user->isGuest)
                                echo Html::a('<p>Ruta actual</p>', ['site/mipanel']); 
                          ?>
                          </td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                            if(!Yii::$app->user->isGuest)
                                echo Html::a('<p>Historial de rutas</p>', ['site/misrutas']); 
                            ?>
                          </td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                            if(!Yii::$app->user->isGuest){
                                if($_SESSION['face'] == 0)
                                echo Html::a('<p>Cambiar contraseña</p>', ['site/cambiarpass']);
                            }
                          ?>
                          </td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">&nbsp;</td>
                        </tr>
                    </table>
                    <table border="0">
                        <tr>
                          <td><h5>REGISTRO</h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Ingresar</p>', ['site/login']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>Registrate</p>', ['site/registro']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a('<p>¿Olvidaste tu contraseña?</p>', ['site/recuperar']); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="footer-dos">
                <div class='contacto-footer'>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-contacto.png', $options = ['width'=>'100%', 'class'=>'ico-contacto-footer']), ['site/contacto']); ?>                    
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), '#'); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), '#'); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-youtube.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), '#'); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), '#'); ?>
        </div>

    </footer>


<?php $this->endBody() ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
</html>
<?php $this->endPage() ?>
