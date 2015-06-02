<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Usuario;
use app\models\Circuito;
use app\models\Contacto;
use app\models\Evento;
use app\models\Tag;
use app\models\Arriendo;
use app\models\Idioma;
use app\models\Vitrina;
use app\models\Noticia;
use app\models\Local;
use app\models\Tienda;
use app\models\TiendaXServicio;
use app\models\Oferta;
use app\models\Ruta;
use app\models\RutaSearch;
use app\models\RutaContenido;
use app\models\RutacontenidoSearch;
use app\models\Patrimonio;
use yii\db\Expression;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\rbac\DbManager;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'misrutas', 'ruta', 'cambiarpass'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [   
                        'actions' => ['mipanel', 'misrutas', 'ruta'],
                        'allow' => Yii::$app->funciones->isUser(),
                    ],
                    [
                        'actions' => ['cambiarpass'],
                        'allow' => Yii::$app->funciones->isUser() && !Yii::$app->funciones->isFacebookUser(),
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delcontenidoruta' => ['post'],
                    'delruta' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => Yii::$app->funciones->creareturn(),
            ],
        ];
    }

    public function actionIndex($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        $noticias = Noticia::find()->where(["prensa"=>0, "destacada"=>1, 'idioma_fk'=>$idioma->pk])->limit(3)->orderBy(["pk"=>SORT_DESC])->all();
        $eventos = Evento::find()->where(['idioma_fk'=>$idioma->pk])->orderBy(["pk"=>SORT_DESC])->limit(4)->all();
        $circuitos = Circuito::find()->where(['idioma_fk'=>$idioma->pk])->orderBy(["posicion"=>SORT_ASC])->all();
        return $this->render('index', [
                'circuitos'=>$circuitos,
                'eventos'=>$eventos,
                'noticias'=>$noticias,
                'idioma' => $idioma,
            ]);
    }

    public function actionLogin($lan = 'es')
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post())){
            $user = User::findByUsername($model->username);
            if(isset($user)){
                if(Yii::$app->security->validatePassword($model->password, $user->password)){
                    Yii::$app->user->login($user,0);
                    $_SESSION["face"] = 0;
                    return $this->goBack();
                }else{
                    return $this->render('login', [
                    'model' => $model,
                    'idioma' => $idioma,
                ]);
                }
            }else{
                return $this->render('login', [
                    'model' => $model,
                    'idioma' => $idioma,
                ]);
            }
        }else{
            return $this->render('login', [
                'model' => $model,
                'idioma' => $idioma,
            ]);
        }
    }

    public function actionLogout($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        Yii::$app->user->logout();

        return $this->redirect(['site/index', 'lan'=>$idioma->abreviacion]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTag($id)
    {
        $tag = Tag::find()->where(['idioma_fk' => $id])->orderBy(['frecuencia'=>'RAND()'])->asArray()->limit(35)->all();
        //echo json_encode($tag);
        echo \yii\helpers\Json::encode($tag);
    }

    public function actionElbarrio($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        return $this->render('historia', ['idioma' => $idioma]);
    }

    public function actionComollegar($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        return $this->render('comollegar', ['idioma' => $idioma]);
    }

    public function actionArriendos($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        $query = Arriendo::find()->orderBy(["pk"=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
            'pageParam' => 'p',
            ]);
        
        $arriendos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('arriendos', ['arriendos'=>$arriendos, 'pages'=>$pages, 'idioma' => $idioma]);
    }

    public function actionEventos($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        $query2 = Evento::find()->orderBy(["pk"=>SORT_DESC]);
        $countQuery2 = clone $query2;
        $pages2 = new Pagination([
            'totalCount' => $countQuery2->count(),
            'defaultPageSize' => 5,
        ]);

        $eventos = $query2->offset($pages2->offset)
                ->limit($pages2->limit)
                ->all();

        return $this->render('eventos', ['eventos'=>$eventos, 'pages2'=>$pages2, 'idioma' => $idioma]);
    }

    public function actionMapa($lan = 'es')
    {
        $idioma = Idioma::find()->where(["abreviacion"=>$lan])->one();
        return $this->render('mapa', ['idioma' => $idioma]);
    }

    public function actionVitrina($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $query = Vitrina::find()->where(['idioma_fk' => $idioma->pk])->orderBy(["pk"=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 12,
        ]);

        $vitrinas = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('vitrina', [
                'vitrinas'=>$vitrinas,
                'pages' => $pages,
                'idioma' => $idioma
            ]);
    }

    public function actionCircuitos($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $circuitos = Circuito::find()->where(['idioma_fk' => $idioma->pk])->orderBy(["posicion"=>SORT_ASC])->all();
        $locales = Local::find()->joinWith(['tiendas'])->all();
        $patrimonios = Patrimonio::find()->all();
        return $this->render('circuitos', [
                'circuitos'=>$circuitos,
                'locales'=>$locales,
                'patrimonios'=>$patrimonios,
                'idioma' => $idioma,
            ]);
    }

    public function actionPrensa($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $query = Noticia::find()->where(["prensa"=>1, 'idioma_fk' => $idioma->pk])->orderBy(["pk"=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 6,
            ]);
        
        $prensa = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('prensa', [
             'prensa' => $prensa,
             'pages' => $pages,
             'idioma' => $idioma,
        ]);
    }

    public function actionNoticias($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $query = Noticia::find()->where(["prensa"=>0, 'idioma_fk' => $idioma->pk])->orderBy(["pk"=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
            ]);
        
        $noticias = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('noticias', [
             'noticias' => $noticias,
             'pages' => $pages,
             'idioma' => $idioma,
        ]);

        /*$noticias = Noticia::find()->where(["prensa"=>0])->orderBy(["pk"=>SORT_ASC])->all();
        return $this->render('noticias', [
                'noticias'=>$noticias,
            ]);*/
    }

    public function actionNoticia($id, $lan = 'es')
    {
        $n = (int) $id;
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        return $this->render('noticia', [
            'model' => Noticia::findOne($n),
            'idioma' => $idioma,
        ]);
    }

    public function actionInfoprensa($id)
    {
        $p = $id;
        return $this->render('infoprensa', [
            'model' => Noticia::findOne($p),
        ]);
    }

    public function actionEvento($id)
    {
        $e = $id;
        return $this->render('evento', [
            'model' => Evento::findOne($e),
        ]);
    }

    public function actionCircuito($id, $lan = 'es')
    {
        $c = $id;
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $circuitos = Circuito::find()->where(['idioma_fk' => $idioma->pk])->orderBy(["posicion"=>SORT_ASC])->all();
        $locales = Local::find()->joinWith(['tiendas'])->where(['tienda.circuito_fk' => $c, 'idioma_fk' => $idioma->pk])->all();
        $patrimonios = Patrimonio::find()->where(["circuito_fk"=>$c])->all();
        $tiendas = Tienda::find()->where(["circuito_fk"=>$c])->all();
        return $this->render('circuito', [
            'model' => Circuito::findOne($c),
            'circuitos' => $circuitos,
            'locales' => $locales,
            'tiendas' => $tiendas,
            'patrimonios' => $patrimonios,
            'idioma' => $idioma,
            ]);
    }

    public function actionPatrimonio($id)
    {
        $p = $id;
        return $this->render('patrimonio', [
                'model' => Patrimonio::findOne($p),
            ]);
    }

    public function actionArriendo($id, $lan = 'es')
    {
        $a = $id;
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        return $this->render('arriendo', [
            'model' => Arriendo::findOne($a),
            'idioma' => $idioma
        ]);
    }

    public function actionCreaturuta($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        return $this->render('creaturuta', ['idioma' => $idioma]);
    }

    public function actionTiendas($lan = 'es')
    {
        $tag = '';
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        if(isset($_GET['b'])){
            $tag = $_GET['b'];
            $query = Tienda::find()->where('idioma_fk = '.$idioma->pk.' AND (tags LIKE :substr OR nombre LIKE :substr)', [':substr' => '%'.$tag.'%'])->orderBy(["pk"=>SORT_DESC]);
            $model_tag = Tag::find()->where(['palabra'=>$tag])->one();
            if(isset($model_tag)){
                $model_tag->frecuencia = $model_tag->frecuencia + 1;
                $model_tag->save();
            }
        }else{
            $b = "";
            $query = Tienda::find()->where(['idioma_fk' => $idioma->pk])->orderBy(["pk"=>SORT_DESC]);
        }

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 9,
            ]);
        
        $tiendas = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('tiendas', [
             'tiendas' => $tiendas,
             'pages' => $pages,
             'b' => $tag,
             'idioma' => $idioma,
        ]);
    }

    public function actionTienda($id, $lan = 'es')
    {
        $t = $id;
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        if(Yii::$app->user->isGuest){
            $ofertas = Oferta::find()->where(['tienda_fk' => $t])->all();
            $servicios = TiendaXServicio::find()->where(['tienda_fk' => $t])->all();
            return $this->render('tienda', [
            'model' => Tienda::findOne($t),
            'ofertas'=> $ofertas,
            'servicios' => $servicios,
            'idioma' => $idioma,
            ]);
        }
        else{
            $usuario = Yii::$app->user->identity->pk;
            $ruta = Ruta::find()->where(['usuario_fk' => $usuario, 'terminada' => 0])->one();
            if($ruta != NULL){
                $rutas = RutaContenido::find()->where(['ruta_fk' => $ruta->pk])->all();
            }
            else{
                $rutas = NULL;
            }
            $ofertas = Oferta::find()->where(['tienda_fk' => $t])->all();
            $servicios = TiendaxServicio::find()->where(['tienda_fk' => $t])->all();
            return $this->render('tienda', [
            'model' => Tienda::findOne($t),
            'ofertas'=> $ofertas,
            'servicios' => $servicios,
            'rutas' => $rutas,
            'idioma' => $idioma,
            ]);
        }
    }

    public function actionContacto()
    {
        $model = new Contacto;
        if ($model->load(Yii::$app->request->post())) {
            $model->ip = Yii::$app->funciones->getRealIP();
            $model->tipo = "0";
            if($model->save()){
                $mensaje = 'Se ha enviado un mensaje desde la sección Contacto con la siguiente información <br /><br /> Nombre: '.$model->nombre.' <br /> Email: '.$model->email.' <br /> Teléfono: '.$model->telefono.' <br /><br /> Mensaje:'.$model->mensaje.'';

                Yii::$app->mailer->compose()
                    ->setFrom('noreply@barrioitalia.cl')
                    ->setTo('dreck01@gmail.com')
                    ->setSubject('Mensaje desde Contacto Barrio Italia')
                    ->setHtmlBody($mensaje)
                    ->send();

                $model->nombre = '';
                $model->telefono = '';
                $model->email = '';
                $model->mensaje = '';
                Yii::$app->getSession()->setFlash('mensaje', 'Muchas gracias! Nuestros administradores se pondrán en contacto contigo a la brevedad.');
            }
        }
        return $this->render('contacto', ['model' => $model]);
    }

    public function actionTrabaja($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $model = new Contacto;
        if ($model->load(Yii::$app->request->post())) {

            $model->ip = Yii::$app->funciones->getRealIP();
            $model->tipo = "1";

            $adjunto = $model->uploadAdjunto();

            if($model->save()){

                if ($adjunto !== false) {
                    $path = $model->getAdjuntoFile();
                    $adjunto->saveAs($path);
                }

                $mensaje = 'Se ha enviado un mensaje desde la sección Trabaja con nosotros con la siguiente información <br /><br /> Nombre: '.$model->nombre.' <br /> Email: '.$model->email.' <br /> Teléfono: '.$model->telefono.' <br /><br /> Mensaje:'.$model->mensaje.'';

                Yii::$app->mailer->compose()
                    ->setFrom('noreply@barrioitalia.cl')
                    ->setTo('dreck01@gmail.com')
                    ->setSubject('Mensaje desde Trabaja con nosotros Barrio Italia')
                    ->attach('../web/images/adjunto/'.$model->adjunto)
                    ->setHtmlBody($mensaje)
                    ->send();

                $model->nombre = '';
                $model->email = '';
                $model->telefono = '';
                $model->adjunto = '';
                $model->mensaje = '';
                if($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en')
                    Yii::$app->getSession()->setFlash('mensaje', 'Muchas gracias! Nuestros administradores se pondrán en contacto contigo a la brevedad.');
                else
                    Yii::$app->getSession()->setFlash('mensaje', 'Thank You! We will get back to you as soon as possible.');

            }
        }

        return $this->render('trabaja', ['model' => $model, 'idioma' => $idioma]);
    }


    public function actionMipanel($lan = 'es'){
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $usuario = Yii::$app->user->identity->pk;
        $ruta_actual = Ruta::find()->where(['usuario_fk' => $usuario, 'terminada' => 0])->one();

        if(!isset($ruta_actual)){
            $tiendas = NULL;
            $searchModel = null;
            $dataProvider = null;
        }
        else{
            $tiendas = RutaContenido::find()->where(['ruta_fk' => $ruta_actual->pk])->all();
            $searchModel = new RutacontenidoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ruta_actual->pk);
        }   

        return $this->render('mipanel', [
                'ruta' => $ruta_actual,
                'tiendas' => $tiendas,
                'dataProvider' => $dataProvider,
                'idioma' => $idioma,
        ]);
        
    }

    public function actionMisrutas($lan = 'es'){
        $usuario = Yii::$app->user->identity->pk;
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $searchModel = new RutaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $usuario);
        
        return $this->render('misrutas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'idioma' => $idioma
            ]);
    }

    public function actionCambiarpass($lan = 'es'){
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        $model = Usuario::findOne(Yii::$app->user->identity->pk);
        $antigua = $model->password;

        if ($model->load(Yii::$app->request->post())) {
            
            if(Yii::$app->security->validatePassword($model->password, $antigua)){
                if($_POST['password1'] == $_POST['password2']){

                    $model->password = $_POST['password1'];

                    if($model->save()){
                        Yii::$app->getSession()->setFlash('correcto', 'Se ha realizado el cambio de contraseña correctamente.');
                    }
                }else{
                    Yii::$app->getSession()->setFlash('error', 'Las contraseñas no son iguales.');
                }
            }else{
                Yii::$app->getSession()->setFlash('error', 'Contraseña actual erronea.');
            }
        }
        $model->password = "";
        return $this->render('cambiarpass', ['model' => $model, 'idioma' => $idioma]);
    }

    public function actionRecuperar($lan = 'es')
    {
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        if(isset($_POST['email'])){
            $correo = $_POST['email'];
            $user = Usuario::find()->where(['username'=>$correo])->one();
            if(isset($user)){

                $token = Yii::$app->security->generateRandomString();
                $user->token = $token;
                if($user->save()){
                    $mensaje = 'Hola '.$user->nombre.', <br /><br />Has ingresado una solicitud para la recuperación de tu contraseña del portal de Barrio Italia. Como medida de precaución y seguridad, se ha enviado este correo electrónico con el fin de restaurar tu contraseña.
                    <br /><br />Si no has ingresado ninguna solicitud para la restauración de tu contraseña ignora este mensaje.
                    <br /><br />Para restaurar tu contraseña sigue el siguiente enlace: '.Yii::$app->params['domainName'].'/site/restaurar?token='.$token;

                    Yii::$app->mailer->compose()
                         ->setFrom('noreply@barrioitalia.cl')
                         ->setTo($correo)
                         ->setSubject('Restauración de Contraseña')
                         ->setHtmlBody($mensaje)
                         ->send();
                    Yii::$app->getSession()->setFlash('email_correcto', 'Se ha enviado un correo electrónico a <b>'.$correo.'</b> con las instrucciones necesarias para restablecer tu contraseña.');
                }else{
                    Yii::$app->getSession()->setFlash('email_erroneo', 'No se pudo completar la acción. Intentelo más tarde.');
                }
            }else{
                Yii::$app->getSession()->setFlash('email_erroneo', 'No se registra ningún usuario asociado a la dirección de correo electrónico <b>'.$correo.'</b>');
            } 
        }

        return $this->render('recuperar', ['idioma' => $idioma]);
    }

    public function actionRestaurar($id)
    {
        $token = $id;
        $usuario = Usuario::find()->where(['token'=>$token])->one();

        if(isset($usuario)){
            if($usuario->load(Yii::$app->request->post())){
                if($usuario->password == $_POST['password2']){
                    $usuario->password = $_POST['Usuario']['password'];
                    $usuario->token = null;
                    if($usuario->save()){
                        Yii::$app->getSession()->setFlash('restaurar_exito', 'Contraseña restaurada con éxito');
                        return $this->redirect(['site/login']);
                    }
                }else{
                    Yii::$app->getSession()->setFlash('restaurar_error', 'Las contraseñas no son iguales.');
                }
            }
        }else{
            throw new \yii\web\UnauthorizedHttpException('No estás autorizado para utilizar esta función.');
        }

        $usuario->password = '';

        return $this->render('restaurar', ['model'=>$usuario]);
    }

    public function actionRegistro($lan = 'es')
    {
        $model = new Usuario;
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        if($model->load(Yii::$app->request->post())){
            if($_POST['Usuario']['password'] == $_POST['password2']){
                $model->rol = 1;
                if($model->save()){
                    return $this->redirect(['site/login', 'lan'=>$idioma->abreviacion]);   
                }
            }else{
                Yii::$app->getSession()->setFlash('password', 'Las contraseñas no son iguales.');
            }
        }
        
        return $this->render('registro', ['model'=>$model, 'idioma'=>$idioma]);
    }

    public function actionImagen($id)
    {
        $i = $id;
        $model = Vitrina::findOne($i);
        
        return $this->render('imagen', ['model'=>$model]);
    }


    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $_SESSION['facebook'] = $attributes;
        $_SESSION["face"] = 1;
        $user = User::findByUsername($attributes['email']);
        if(isset($user)){
            Yii::$app->user->login($user,0);
        }else
        {
            $usuario = New Usuario;
            $usuario->username = $attributes['email'];
            $usuario->nombre = $attributes['name'];
            $usuario->rol = 1;
            $usuario->password = "8x:RC_k+:~Y8Z>duccTB";
            if($usuario->save()){
                $user = User::findByUsername($attributes['email']);
                Yii::$app->user->login($user,0);
            }
        }            
    }

    public function actionSmarti(){
        return $this->render('smarti');
    }

    public function actionPrueba(){
        return $this->render('prueba');
    }

    public function actionRatingtienda(){
        $rating = $_POST['r'];
        $tienda = $_POST['t'];
        $model = Tienda::find()->where(['pk'=>$tienda])->one();
        $model->rating = ($model->rating + (int) $rating) / 2;
        $model->save();
    }

    public function actionInicioruta($lan = 'es'){
        $idioma = Idioma::find()->where(['abreviacion' => $lan])->one();
        if(Yii::$app->user->isGuest){
            $this->redirect(['site/login', 'lan' => $idioma->abreviacion]);
            Yii::$app->user->setReturnUrl(['site/inicioruta']);
        }
        else{
            $tiene_ruta = Ruta::find()->where(['usuario_fk' => Yii::$app->user->identity->pk, 'terminada' => 0])->all();
            if($tiene_ruta != NULL){
                return $this->render('compruebaruta');
            }
            else{
                $model = new Ruta;
                $model->usuario_fk = Yii::$app->user->identity->pk;
                $model->terminada = 0;
                if($model->save()){
                    $this->redirect(['site/tiendas']);
                }
                else{
                    $this->redirect(['site/index']);
                }
            }
        }
    }

    public function actionEliminaruta(){
        $rutas = Ruta::find()->where(['usuario_fk' => Yii::$app->user->identity->pk])->all();
            foreach($rutas as $ruta){
                $ruta->terminada = 1;
                $ruta->save();
            }
        $model = new Ruta;
        $model->usuario_fk = Yii::$app->user->identity->pk;
        $model->terminada = 0;
        $model->save();
        $this->redirect(['site/tiendas']);
    }

    public function actionAgregaruta(){
        $tienda = (int) $_POST['t'];
        $usuario = Yii::$app->user->identity->pk;
        $ruta = Ruta::find()->where(['usuario_fk' => $usuario, 'terminada' => 0])->one();
        $ruta_contenido = new RutaContenido;
        $ruta_contenido->ruta_fk = $ruta->pk;
        $ruta_contenido->tienda_fk = $tienda;
        if($ruta_contenido->save())
            echo 1;
        else
            echo 0;
        
    }

    public function actionDelcontenidoruta($id, $v){
        $model = RutaContenido::find()->where(['pk' => $id])->one();
        $model->delete();
        if($v == 1)
            return $this->redirect(['mipanel']);
        else
            return $this->redirect(['ruta', 'id' => $model->ruta_fk]);
    }

    public function actionDelruta($id){
        $model = Ruta::find()->where(['pk' => $id])->one();
        $model->delete();

        return $this->redirect(['misrutas']);
    }

    public function actionRuta($id){
        $model = Ruta::find()->where(['pk' => $id, 'usuario_fk' => Yii::$app->user->identity->pk])->one();

        $searchModel = new RutacontenidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->pk);
        $tiendas = RutaContenido::find()->where(['ruta_fk' => $model->pk])->all();
            
        return $this->render('ruta', ['model'=>$model, 'dataProvider'=>$dataProvider, 'tiendas'=>$tiendas]);
    }
}
