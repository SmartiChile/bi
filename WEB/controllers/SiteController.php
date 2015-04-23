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
use app\models\Vitrina;
use app\models\Noticia;
use app\models\Local;
use app\models\Tienda;
use app\models\TiendaxServicio;
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
            ],
        ];
    }

    public function actionIndex()
    {
        $noticias = Noticia::find()->where(["prensa"=>0, "destacada"=>1])->limit(3)->orderBy(["pk"=>SORT_DESC])->all();
        $eventos = Evento::find()->orderBy(["pk"=>SORT_DESC])->limit(4)->all();
        $circuitos = Circuito::find()->orderBy(["posicion"=>SORT_ASC])->all();
        return $this->render('index', [
                'circuitos'=>$circuitos,
                'eventos'=>$eventos,
                'noticias'=>$noticias,
            ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
                ]);
                }
            }else{
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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

    public function actionTag()
    {
        $tag = Tag::find()->orderBy(['frecuencia'=>'RAND()'])->asArray()->limit(35)->all();
        //echo json_encode($tag);
        echo \yii\helpers\Json::encode($tag);
    }

    public function actionElbarrio()
    {
        return $this->render('historia');
    }

    public function actionComollegar()
    {
        return $this->render('comollegar');
    }

    public function actionArriendos()
    {

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

        return $this->render('arriendos', ['arriendos'=>$arriendos, 'pages'=>$pages]);
    }

    public function actionEventos()
    {

        $query2 = Evento::find()->orderBy(["pk"=>SORT_DESC]);
        $countQuery2 = clone $query2;
        $pages2 = new Pagination([
            'totalCount' => $countQuery2->count(),
            'defaultPageSize' => 5,
        ]);

        $eventos = $query2->offset($pages2->offset)
                ->limit($pages2->limit)
                ->all();

        return $this->render('eventos', ['eventos'=>$eventos, 'pages2'=>$pages2]);
    }

    public function actionMapa()
    {
        return $this->render('mapa');
    }

    public function actionVitrina()
    {
        $query = Vitrina::find()->orderBy(["pk"=>SORT_DESC]);
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
                'pages' => $pages
            ]);
    }

    public function actionCircuitos()
    {

        $circuitos = Circuito::find()->orderBy(["posicion"=>SORT_ASC])->all();
        $locales = Local::find()->joinWith(['tiendas'])->all();
        $patrimonios = Patrimonio::find()->all();
        return $this->render('circuitos', [
                'circuitos'=>$circuitos,
                'locales'=>$locales,
                'patrimonios'=>$patrimonios,
            ]);
    }

    public function actionPrensa()
    {
        $query = Noticia::find()->where(["prensa"=>1])->orderBy(["pk"=>SORT_DESC]);
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
        ]);
    }

    public function actionNoticias()
    {
        $query = Noticia::find()->where(["prensa"=>0])->orderBy(["pk"=>SORT_DESC]);
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
        ]);

        /*$noticias = Noticia::find()->where(["prensa"=>0])->orderBy(["pk"=>SORT_ASC])->all();
        return $this->render('noticias', [
                'noticias'=>$noticias,
            ]);*/
    }

    public function actionNoticia($n)
    {
        return $this->render('noticia', [
            'model' => Noticia::findOne($n),
        ]);
    }

    public function actionInfoprensa($p)
    {
        return $this->render('infoprensa', [
            'model' => Noticia::findOne($p),
        ]);
    }

    public function actionEvento($e)
    {
        return $this->render('evento', [
            'model' => Evento::findOne($e),
        ]);
    }

    public function actionCircuito($c)
    {
        $circuitos = Circuito::find()->orderBy(["posicion"=>SORT_ASC])->all();
        $locales = Local::find()->joinWith(['tiendas'])->where(['tienda.circuito_fk' => $c])->all();
        $patrimonios = Patrimonio::find()->where(["circuito_fk"=>$c])->all();
        $tiendas = Tienda::find()->where(["circuito_fk"=>$c])->all();
        return $this->render('circuito', [
            'model' => Circuito::findOne($c),
            'circuitos' => $circuitos,
            'locales' => $locales,
            'tiendas' => $tiendas,
            'patrimonios' => $patrimonios,
            ]);
    }

    public function actionPatrimonio($p)
    {
        return $this->render('patrimonio', [
                'model' => Patrimonio::findOne($p),
            ]);
    }

    public function actionArriendo($a)
    {
        return $this->render('arriendo', [
            'model' => Arriendo::findOne($a),
        ]);
    }

    public function actionCreaturuta()
    {
        return $this->render('creaturuta');
    }

    public function actionTiendas()
    {
        if(isset($_GET['b'])){
            $b = $_GET['b'];
            $query = Tienda::find()->where('tags LIKE :substr OR nombre LIKE :substr', array(':substr' => '%'.$b.'%'))->orderBy(["pk"=>SORT_DESC]);
        }else{
            $b = "";
            $query = Tienda::find()->orderBy(["pk"=>SORT_DESC]);
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
             'b' => $b,
        ]);
    }

    public function actionTienda($t)
    {
        if(Yii::$app->user->isGuest){
            $ofertas = Oferta::find()->where(['tienda_fk' => $t])->all();
            $servicios = TiendaxServicio::find()->where(['tienda_fk' => $t])->all();
            return $this->render('tienda', [
            'model' => Tienda::findOne($t),
            'ofertas'=> $ofertas,
            'servicios' => $servicios,
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
            'rutas' => $rutas
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

    public function actionTrabaja()
    {
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

                $mensaje = 'Se ha enviado un mensaje desde la sección Contacto con la siguiente información <br /><br /> Nombre: '.$model->nombre.' <br /> Email: '.$model->email.' <br /> Teléfono: '.$model->telefono.' <br /><br /> Mensaje:'.$model->mensaje.'';

                Yii::$app->mailer->compose()
                    ->setFrom('noreply@barrioitalia.cl')
                    ->setTo('dreck01@gmail.com')
                    ->setSubject('Mensaje desde Trabaja con nosotros Barrio Italia')
                    ->setHtmlBody($mensaje)
                    ->send();

                $model->nombre = '';
                $model->email = '';
                $model->telefono = '';
                $model->adjunto = '';
                $model->mensaje = '';
                Yii::$app->getSession()->setFlash('mensaje', 'Muchas gracias! Nuestros administradores se pondrán en contacto contigo a la brevedad.');
            }
        }

        return $this->render('trabaja', ['model' => $model]);
    }


    public function actionMipanel(){

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
        ]);
        
    }

    public function actionMisrutas(){
        $usuario = Yii::$app->user->identity->pk;
        
        $searchModel = new RutaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $usuario);
        
        return $this->render('misrutas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    public function actionCambiarpass(){
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
        return $this->render('cambiarpass', ['model' => $model,]);
    }

    public function actionRecuperar()
    {
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

        return $this->render('recuperar');
    }

    public function actionRestaurar($token)
    {
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

    public function actionRegistro()
    {
        $model = new Usuario;

        if($model->load(Yii::$app->request->post())){
            if($_POST['Usuario']['password'] == $_POST['password2']){
                $model->rol = 1;
                if($model->save()){
                    return $this->redirect(['site/login']);   
                }
            }else{
                Yii::$app->getSession()->setFlash('password', 'Las contraseñas no son iguales.');
            }
        }
        
        return $this->render('registro', ['model'=>$model]);
    }

    public function actionImagen($i)
    {
        $model = Vitrina::findOne($i);
        
        return $this->render('imagen', ['model'=>$model]);
    }


    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        //$_SESSION['facebook'] = $attributes;
        $_SESSION["face"] = 1;
        $user = User::findByUsername($attributes['email']);
        if(isset($user)){
            Yii::$app->user->login($user,0);
        }else
        {
            $usuario = New Usuario;
            $usuario->username = $attributes['email'];
            $usuario->nombre = $attributes['first_name'];
            $usuario->rol = 1;
            $usuario->password = "8x:RC_k+:~Y8Z>duccTB";
            if($usuario->save()){
                $user = User::findByUsername($attributes['email']);
                Yii::$app->user->login($user,0);
            }
        }            
    }

    public function actionSmarti(){
        echo Yii::$app->funciones->rolesToDec(1);
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

    public function actionInicioruta(){
        if(Yii::$app->user->isGuest){
            $this->redirect(['site/login']);
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
