<?php

namespace app\components;
 
 
use Yii;
use yii\helpers\Html;
use yii\base\Component;
use yii\base\InvalidConfigException;
use kartik\widgets\SideNav;
use app\models\Idioma;
use app\models\Tag;
use app\models\Tiendaxservicio;
use app\models\Ruta;
use app\models\RutaContenido;
use app\models\Oferta;
use app\models\Tienda;

class funciones extends Component
{
	 public function menu_panel()
	 {
	  	return SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'heading' => 'Pandel de Administración',
                'encodeLabels' => false,
                'items' => [
                    [
                        'url' => ['admin/inicio'],
                        'label' => 'Inicio',
                        'icon' => 'home'
                    ],
                    [
                        'label' => 'Circuitos',
                        'icon' => 'globe',
                        'url' => ['circuito/index'],
                    ],
                    [
                        'label' => 'Eventos',
                        'icon' => 'calendar',
                        'url' => ['evento/index'],
                    ],
                    [
                        'label' => 'Arriendos',
                        'icon' => 'pushpin',
                        'url' => ['arriendo/index'],
                    ],
                    [
                        'label' => 'Noticias',
                        'icon' => 'bullhorn',
                        'url' => ['noticia/index', 'id'=>0],
                    ],
                    [
                        'label' => 'Prensa',
                        'icon' => 'camera',
                        'url' => ['noticia/index', 'id'=>1],
                    ],
                    [
                        'label' => 'Usuarios',
                        'icon' => 'user',
                        'url' => ['usuario/index'],
                    ],
                    [
                        'label' => 'Ofertas',
                        'icon' => 'shopping-cart',
                        'url' => ['oferta/index'],
                    ],
                    [
                        'label' => 'Vitrina',
                        'icon' => 'picture',
                        'url' => ['vitrina/index'],
                    ],
                    [
                        'label' => 'Contacto',
                        'icon' => 'envelope',
                        'url' => ['contacto/index'],
                    ],
                    [   
                        'label' => 'Idiomas',
                        'icon' => 'info-sign',
                        'url' => ['idioma/index'],
                    ],
                    [
                        'label' => 'Servicios',
                        'icon' => 'credit-card',
                        'url' => ['servicio/index'],
                    ],
                    [
                        'label' => 'Lugares',
                        'icon' => 'shopping-cart',
                        'items' => [
                            ['label' => 'Locales', 'icon'=>'map-marker', 'url' => ['local/index']],
                            ['label' => 'Tiendas', 'icon'=>'tent', 'url' => ['tienda/index']],
                            ['label' => 'Patrimonios', 'icon'=>'tower', 'url' => ['patrimonio/index']],
                        ],
                    ],
                ],
            ]);
	 }

     public function menu_elbarrio($lan)
     {
        if($lan == 'en' || $lan == 'EN'){
            return SideNav::widget([
                    'type' => SideNav::TYPE_DEFAULT,
                    'items' => [
                        [
                            'url' => ['site/elbarrio', 'lan'=>$lan],
                            'label' => 'History',
                            'icon' => 'book'
                        ],
                        [
                            'url' => ['site/mapa', 'lan'=>$lan],
                            'label' => 'How to arrive',
                            'icon' => 'map-marker'
                        ],
                        [
                            'url' => ['site/arriendos', 'lan'=>$lan],
                            'label' => 'Renting',
                            'icon' => 'pushpin'
                        ],
                        [
                            'url' => ['site/trabaja', 'lan'=>$lan],
                            'label' => 'Get a job with us',
                            'icon' => 'briefcase'
                        ],
                        [
                            'url' => ['site/noticias', 'lan'=>$lan],
                            'label' => 'New',
                            'icon' => 'calendar'
                        ],
                    ],
                ]);
        }else{
            return SideNav::widget([
                    'type' => SideNav::TYPE_DEFAULT,
                    'items' => [
                        [
                            'url' => ['site/elbarrio', 'lan'=>$lan],
                            'label' => 'Historia',
                            'icon' => 'book'
                        ],
                        [
                            'url' => ['site/mapa', 'lan'=>$lan],
                            'label' => 'Como llegar',
                            'icon' => 'map-marker'
                        ],
                        [
                            'url' => ['site/arriendos', 'lan'=>$lan],
                            'label' => 'Arriendos',
                            'icon' => 'pushpin'
                        ],
                        [
                            'url' => ['site/trabaja', 'lan'=>$lan],
                            'label' => 'Trabaja con nosotros',
                            'icon' => 'briefcase'
                        ],
                        [
                            'url' => ['site/noticias', 'lan'=>$lan],
                            'label' => 'Noticias',
                            'icon' => 'calendar'
                        ],
                    ],
                ]);
        }
     }

     public function menu_web($lan){
        if($lan == 'en' || $lan == 'EN'){
            return [
                [1=>"Home", 2=>'site/index'],
                [1=>"The Neighborhood", 2=>'site/elbarrio'],
                [1=>"Gallery", 2=>'site/vitrina'],
                [1=>"Map", 2=>'site/mapa'],
                [1=>"Circuits", 2=>'site/circuitos'],
                [1=>"Stores", 2=>'site/tiendas'],
                [1=>"Press", 2=>'site/prensa'],
                [1=>"Events", 2=>'site/eventos'],
                [1=>"Create your route", 2=>'site/creaturuta'],
            ];
        }else{
            return [
                [1=>"Inicio", 2=>'site/index'],
                [1=>"El Barrio", 2=>'site/elbarrio'],
                [1=>"Vitrina", 2=>'site/vitrina'],
                [1=>"Mapa", 2=>'site/mapa'],
                [1=>"Circuitos", 2=>'site/circuitos'],
                [1=>"Tiendas", 2=>'site/tiendas'],
                [1=>"Prensa", 2=>'site/prensa'],
                [1=>"Eventos", 2=>'site/eventos'],
                [1=>"Crea tu ruta", 2=>'site/creaturuta'],
            ];
        }

        
     }

     public function menu_usuario($lan)
     {
        if($lan == 'en' || $lan == 'EN'){
            return SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'items' => [
                    [
                        'url' => ['site/mipanel', 'lan'=>$lan],
                        'label' => 'Current Route',
                        'icon' => 'heart'
                    ],
                    [
                        'url' => ['site/misrutas', 'lan'=>$lan],
                        'label' => 'My Routes',
                        'icon' => 'map-marker'
                    ],
                    [
                        'url' => ['site/cambiarpass', 'lan'=>$lan],
                        'label' => 'Change password',
                        'icon' => 'lock',
                        'visible' => $_SESSION['face'] == 0 ? true : false,
                    ],
                ],
            ]);
        }else{
            return SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'items' => [
                    [
                        'url' => ['site/mipanel', 'lan'=>$lan],
                        'label' => 'Ruta actual',
                        'icon' => 'heart'
                    ],
                    [
                        'url' => ['site/misrutas', 'lan'=>$lan],
                        'label' => 'Mis rutas',
                        'icon' => 'map-marker'
                    ],
                    [
                        'url' => ['site/cambiarpass', 'lan'=>$lan],
                        'label' => 'Cambiar contraseña',
                        'icon' => 'lock',
                        'visible' => $_SESSION['face'] == 0 ? true : false,
                    ],
                ],
            ]);
        }
     }

    public function rolesToDec($rolBin) {   //en base a un numero binario, se calcula el rol en numero decimal
        $rol['usuario'] = $rolBin % 10;   //para guardar en base de datos. ej: 1011 = 11.
        $rolBin = $rolBin / 10;
        $rol['administrador'] = $rolBin % 10;
        $rolBin = $rolBin / 10;
        return (int) (pow(2, 1) * $rol['administrador'] + pow(2, 0) * $rol['usuario']);
    }

    public function DecToRol($dec){
        $roles['usuario'] = $dec % 2;
        $dec = $dec / 2;
        $roles['administrador'] = $dec % 2;
        return $roles;
    }

    public function quitarTags($string, $length=NULL)
    {
        if ($length == NULL)
        {
            $length = 1000;
        }
        $stringDisplay = substr(strip_tags($string), 0, $length);
        return $stringDisplay;
    }

    public function idiomas(){
        $idiomas = Idioma::find()->where(['activo'=>1])->orderBy(["posicion"=>SORT_ASC])->all();
        $cantidad = count($idiomas);

        foreach ($idiomas as $key => $idioma) {
            echo Html::a($idioma->abreviacion, ['site/index', 'lan'=>$idioma->abreviacion]);
            if($key < ($cantidad - 1)){
                echo ' | ';
            }
        }

    }

    public function coordenadasOK($string)
    {
        $string = str_replace("(", "", $string);
        $string = str_replace(")", "", $string);
        $cadena = explode(',', $string);
        return $cadena[0].",".$cadena[1];
    }

    public function eliminarColor($cadena)
    {
        $cadena = str_replace('#', '', $cadena);
        return $cadena;
    }

    public function tagsTienda($cadena)
    {
        $tag =  explode(' ', $cadena);
        return $tag;
    }

    public function nombreUser($string)
    {
        $cadena = explode(' ', $string);
        return $cadena[0];
    }

    public function adaptarFecha($fecha){
    $cadena = explode(' ', $fecha);
    return $cadena[0];
    }

    public function enOferta($tienda){
        date_default_timezone_set('America/Santiago');
        $fecha_actual = date('Y-m-d H:i:s');
        $ofertas = Oferta::find()->where('tienda_fk = '.$tienda.' AND inicio <= "'.$fecha_actual.'" AND termino >= "'.$fecha_actual.'"')->all();
        if($ofertas == NULL)
            return 0;
        else
            return 1;
    }

    public function nTiendas($local){
        $tiendas = Tienda::find()->where(['local_fk' => $local])->count();
        return $tiendas;
    }

    public function InsertarTags($tags, $idioma){
        $array_tag = explode(' ',$tags);
        foreach($array_tag as $tag){
            $model = Tag::find()->where(['palabra'=>$tag])->one();
            if(isset($model)){
                $model->frecuencia = $model->frecuencia + 1;
                $model->save();
            }else{
                $model = new Tag;
                $model->palabra = $tag;
                $model->frecuencia = 1;
                $model->idioma_fk = $idioma;
                $model->save();
            }
        }

    }

    public function getRealIP()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }
        else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }
   

    public function servicioTienda($servicio, $tienda){
        $model = Tiendaxservicio::find()->where(['servicio_fk' => $servicio, 'tienda_fk' => $tienda])->one();
        if(isset($model)){
            return true;
        }else{
            return false;
        }
    }

    public function isAdmin(){
        if(!Yii::$app->user->isGuest){
            $usuario = Yii::$app->funciones->DecToRol(Yii::$app->user->identity->rol);
            if($usuario['administrador'] == 1)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }

    public function isUser(){
        if(!Yii::$app->user->isGuest){
            $usuario = Yii::$app->funciones->DecToRol(Yii::$app->user->identity->rol);
            if($usuario['usuario'] == 1)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }

    public function isFacebookUser(){
        if($_SESSION['face'] == 1){
            return true;
        }else{
            return false;
        }
    }

    public function rutaActiva($usuario){
        $ruta = Ruta::find()->where(['usuario_fk' => $usuario, 'terminada' => 0])->one();
        if(isset($ruta)){
            return true;
        }else{
            return false;
        }
    }

    public function perteneceRuta($usuario, $tienda){
        $ruta = Ruta::find()->where(['usuario_fk' => $usuario, 'terminada' => 0])->one();
        if(isset($ruta)){
            $contenido = RutaContenido::find()->where(['ruta_fk' => $ruta->pk, 'tienda_fk' => $tienda])->one();
            if(isset($contenido)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function creareturn($lan){
        $ruta = Yii::$app->getUser()->getReturnUrl();
        $r = explode('/', $ruta);
        $final = '';
        $aux = 0;
        foreach ($r as $v) {
            if($v == 'inicioruta')
                $aux = 1;
            if($v != 'site')
                $final = $final . $v . '/';
            else
                $final = $final.$lan.'/'.$v . '/';
        }

        if($aux != 0)
            return substr($final, 0, -1);
        else
            return 'index';
    }
}