<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$menu = Yii::$app->funciones->menu_web();
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
        <div id="banner">

            <div id="frase-top">
                <h1>Bienvenido a</h1>
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
                <div class="perfil"><i class="glyphicon glyphicon-user"></i> <?= Yii::$app->user->isGuest ? Html::a('Ingresar', ['site/login']).' / '.Html::a('Registrate', ['site/registro']) : 
                'Hola, ' .Yii::$app->funciones->nombreUser(Yii::$app->user->identity->nombre).'<div class="btn-group"><button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu" role="menu">
                        <li>'.(Yii::$app->funciones->isUser() ? Html::a('<i class="glyphicon glyphicon-cog"></i> Mi Panel', ['site/mipanel']) : '').'</li>
                        <li>'.(Yii::$app->funciones->isAdmin() ? Html::a('<i class="glyphicon glyphicon-cog"></i> Panel de Administración', ['admin/inicio']) : '').'</li>
                        <li class="divider"></li>
                        <li>'.Html::a('<i class="glyphicon glyphicon-off margen-off"></i> Salir', ['site/logout'], ['data-method' => 'post']).'</li>
                    </ul>
                </div>' ?></div>
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
            </video>
            <div class="overVideo"></div>
            <nav id="menu-usuario">
                    <ul>
                        <?php foreach($menu as $link): ?>
                            <li><?= Html::a($link[1], [$link[2]]); ?></li>
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


    <div class="contenedor-colores-completo">
            <div class="color1-home"></div>
            <div class="color2-home"></div>
            <div class="color3-home"></div>
            <div class="color4-home"></div>
            <div class="color5-home"></div>
            <div class="color6-home"></div>
        </div>

    <footer class="footer-final">

        <div class="footer-uno">
            <div class="contenido-izquierda-footer-uno">
                <div class="info-izquierda-footer">
                    <div class="lg-corfo">
                        <p>Proyecto apoyado por:</p>
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
                        <p>Desarrolla:</p>
                        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/lg-nuevet.png', $options = ['width' => '100%']); ?>
                    </div>
                </div>
            </div>
            <div class="contenido-derecha-footer-uno">
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
