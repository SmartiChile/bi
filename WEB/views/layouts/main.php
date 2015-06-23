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
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Home' : 'Inicio', 'url' => ['site/index', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'The Neighborhood' : 'El Barrio', 'url' => ['site/elbarrio', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Gallery' : 'Vitrina', 'url' => ['/site/vitrina', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Map' : 'Mapa', 'url' => ['site/mapa', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Circuits' : 'Circuitos', 'url' => ['site/circuitos', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Stores' : 'Tiendas', 'url' => ['site/tiendas', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Press' : 'Prensa', 'url' => ['site/prensa', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'News' : 'Noticias', 'url' => ['site/noticias', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Create your route' : 'Crea tu ruta', 'url' => ['site/creaturuta', 'lan' => $idioma]],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Contact' : 'Contacto', 'url' => ['site/contacto', 'lan' => $idioma]],
                      ['label' => '<hr class="hr-menu">'],
                      (Yii::$app->user->isGuest ? ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Enter' : 'Ingresar', 'url' => ['site/login']] : ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Account' : 'Mi Panel', 'url' => ['site/mipanel', 'lan' => $idioma]]),
                      (Yii::$app->funciones->isAdmin() ? ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Administration Panel' : 'Panel de administración', 'url' => ['admin/inicio', 'lan' => $idioma]] : '' ),
                      (Yii::$app->funciones->isUser() ? ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Logout' : 'Salir', 'url' => ['site/logout', 'lan' => $idioma], 'linkOptions' => ['data-method' => 'post']] : '' ),
                      ['label' => '<hr class="hr-menu">'],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'Spanish' : 'Español', 'url' => ['site/index', 'lan' => 'ES']],
                      ['label' => ($idioma == 'en' || $idioma == 'EN') ? 'English' : 'Inglés', 'url' => ['site/index', 'lan' => 'EN']],
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
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/lg-top.png', $options = ['width'=>'100%']), ['site/index', 'lan'=>$idioma]); ?>
            </div>

            <div id="social">
                <div class="idioma"><?= Yii::$app->funciones->Idiomas(); ?><br /></div>
                <?php if(!Yii::$app->user->isGuest):?>
                <div class="flecha-perfil">
                    <ul>
                      <li>
                        <button class="btn btn-default btn-xs " type="button" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                        <ul class='usuario-menu'>
                            <li><?php echo Yii::$app->funciones->isUser() ? Html::a('<i class="glyphicon glyphicon-cog"></i> '.($idioma == 'en' || $idioma == 'EN' ? 'Account' : 'Mi panel'), ['site/mipanel', 'lan'=>$idioma]) : '' ?></li>
                            <li><?php echo Yii::$app->funciones->isAdmin() ? Html::a('<i class="glyphicon glyphicon-cog"></i> '.($idioma == 'en' || $idioma == 'EN' ? 'Administration panel' : 'Panel de Administración'), ['admin/inicio', 'lan'=>$idioma]) : '' ?></li>
                            <li><hr /></li>
                            <li><?php echo Html::a('<i class="glyphicon glyphicon-off margen-off"></i> '.($idioma == 'en' || $idioma == 'EN' ? 'Logout' : 'Salir'), ['site/logout', 'lan'=>$idioma], ['data-method' => 'post']); ?></li>
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
                <?= Yii::$app->user->isGuest ? Html::a(($idioma == 'EN' || $idioma == 'en') ? 'Enter' : 'Ingresar', ['site/login', 'lan'=>$idioma]).' / '.Html::a(($idioma == 'EN' || $idioma == 'en') ? 'Register' : 'Regístrate', ['site/registro', 'lan'=>$idioma]) : ($idioma == 'EN' || $idioma == 'en' ? 'Hi, ' : 'Hola, ') .Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre) ?></div>
                <div class="redes-socials">
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-pt.png', $options = ['width'=>'100%']), 'https://www.pinterest.com/pin/323062973242162992/', ['target'=>'_black']); ?>
                    </div>
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw.png', $options = ['width'=>'100%']), 'https://twitter.com/somositalia', ['target' =>'_black']); ?>
                    </div>
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta.png', $options = ['width'=>'100%']), '#', ['target' =>'_black']); ?>
                    </div>
                    <div class="red-top">
                         <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-youtube.png', $options = ['width'=>'100%']), 'https://www.youtube.com/channel/UCJeQLd9ZsbrJpQ1mgzbNtnQ', ['target' =>'_black']); ?>
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
                 <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face-movil.png', $options = ['width'=>'100%']), 'https://www.facebook.com/AsociacionBarrioItalia', ['target'=>'_black']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-you-movil.png', $options = ['width'=>'100%']), 'https://www.youtube.com/channel/UCJeQLd9ZsbrJpQ1mgzbNtnQ', ['target' =>'_black']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw-movil.png', $options = ['width'=>'100%']), 'https://twitter.com/somositalia', ['target' =>'_black']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta-movil.png', $options = ['width'=>'100%']), ['#']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-pt-movil.png', $options = ['width'=>'100%']), 'https://www.pinterest.com/pin/323062973242162992/', ['target'=>'_black']); ?>
            </div>
            <div class="cada-red-movil">
                <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-contacto-movil.png', $options = ['width'=>'100%']), ['site/contacto']); ?>
            </div>
        </div>
        
        <div class="footer-uno">
            <div class="contenido-izquierda-footer-uno">
                <div class="info-izquierda-footer">
                    <div class="lg-corfo">
                        <p><?= $idioma == 'en' || $idioma == 'EN' ? 'Supported by:' : 'Apoya:' ?></p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-corfo.png', $options = ['width'=>'100%']); ?>
                    </div>
                    <div class="lg-min">
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-min.png', $options = ['width' => '100%']); ?>
                    </div>
                    <div class="lg-apri">
                        <p><?= $idioma == 'en' || $idioma == 'EN' ? 'Organized by:' : 'Organiza:' ?></p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-apri.png', $options = ['width' => '100%']); ?>
                    </div>
                    <div class="lg-ag">
                        <p><?= $idioma == 'en' || $idioma == 'EN' ? 'Administered by:' : 'Administra:' ?></p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-ag.png', $options = ['width' => '100%']); ?>
                    </div>
                    <div class="lg-nuevet">
                        <p><?= $idioma == 'en' || $idioma == 'EN' ? 'Powered by:' : 'Desarrollo Web:' ?></p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-nuevet.png', $options = ['width' => '100%']); ?>
                    </div>
                </div>
            </div>
            <div class="contenido-derecha-footer-uno">
                <div class="tabla-footer">
                    <table border="0" width="20%">
                        <tr>
                          <td><h5><?= $idioma == 'en' || $idioma == 'EN' ? 'THE NEIGHBORHOOD' : 'EL BARRIO' ?></h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>History</p>' : '<p>Historia</p>', ['site/elbarrio', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>How to arrive</p>' : '<p>Como llegar</p>', ['site/comollegar', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Renting</p>' : '<p>Arriendos</p>', ['site/arriendos', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Get a job with us</p>' : '<p>Trabaja con nosotros</p>', ['site/trabaja', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Events</p>' : '<p>Eventos</p>', ['site/eventos', 'lan' => $idioma]); ?></td>
                        </tr>
                    </table>
                    <table border="0" width="18%">
                        <tr>
                          <td><h5>BARRIO ITALIA</h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Gallery</p>' : '<p>Vitrina</p>', ['site/vitrina', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Map</p>' : '<p>Mapa</p>', ['site/mapa', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Circuits</p>' : '<p>Circuitos</p>', ['site/circuitos', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Stores</p>' : '<p>Tiendas</p>', ['site/tiendas', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Contact</p>' : '<p>Contacto</p>', ['site/contacto', 'lan' => $idioma]); ?></td>
                        </tr>
                    </table>
                    <table border="0" width="12%">
                        <tr>
                          <td><h5><?= $idioma == 'en' || $idioma == 'EN' ? 'NEWS' : 'NOTICIAS' ?></h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>News</p>' : '<p>Noticias</p>', ['site/noticias', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Press</p>' : '<p>Prensa</p>', ['site/prensa', 'lan' => $idioma]); ?></td>
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
                          <td><h5><?= $idioma == 'en' || $idioma == 'EN' ? '<p>MY NEIGHBORHOOD</p>' : '<p>MI BARRIO</p>' ?></h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Create your route</p>' : '<p>Crea tu ruta</p>', ['site/creaturuta', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                            if(!Yii::$app->user->isGuest)
                                echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>My Panel</p>' : '<p>Mi Panel</p>', ['site/mipanel', 'lan' => $idioma]); 
                          ?>
                          </td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                            if(!Yii::$app->user->isGuest)
                                echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Routes History</p>' : '<p>Historial de rutas</p>', ['site/misrutas', 'lan' => $idioma]); 
                            ?>
                          </td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                            if(!Yii::$app->user->isGuest){
                                if($_SESSION['face'] == 0)
                                echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Change Password</p>' : '<p>Cambiar Contraseña</p>', ['site/cambiarpass', 'lan' => $idioma]);
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
                          <td><h5><?= $idioma == 'en' || $idioma == 'EN' ? 'REGISTER' : 'REGISTRO' ?></h5></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Enter</p>' : '<p>Ingresar</p>', ['site/login', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top"><?php echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Register</p>' : '<p>Registro</p>', ['site/registro', 'lan' => $idioma]); ?></td>
                        </tr>
                        <tr valign="top">
                          <td valign="top">
                          <?php 
                          if(Yii::$app->user->isGuest) 
                                    echo Html::a($idioma == 'en' || $idioma == 'EN' ? '<p>Forgot your password?</p>' : '<p>¿Olvidaste tu contraseña?</p>', ['site/recuperar', 'lan' => $idioma]);
                            ?>
                          </td>
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
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-contacto.png', $options = ['width'=>'100%', 'class'=>'ico-contacto-footer']), ['site/contacto', 'lan' => $idioma]); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-pt.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), 'https://www.pinterest.com/pin/323062973242162992/', ['target'=>'_black']); ?>                    
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-tw.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), 'https://twitter.com/somositalia', ['target' =>'_black']); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-insta.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), '#'); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-youtube.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), 'https://www.youtube.com/channel/UCJeQLd9ZsbrJpQ1mgzbNtnQ', ['target' =>'_black']); ?>
                    <?php echo Html::a(Html::img(Yii::$app->request->baseUrl.'/images/ico-face.png', $options = ['width'=>'100%', 'class'=>'ico-red-footer']), 'https://www.facebook.com/AsociacionBarrioItalia', ['target'=>'_black']); ?>
        </div>

    </footer>


<?php $this->endBody() ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
</html>
<?php $this->endPage() ?>
