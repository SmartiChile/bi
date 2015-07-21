<?php

namespace app\controllers;

use Yii;
use app\models\Tienda;
use app\models\Servicio;
use app\models\Tiendaxservicio;
use app\models\TiendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

/**
 * TiendaController implements the CRUD actions for Tienda model.
 */
class TiendaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                    [
                        'allow' => Yii::$app->funciones->isAdmin(),
                    ],
                ],
            ], 
        ];
    }

    /**
     * Lists all Tienda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TiendaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tienda model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tienda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Tienda();
        $servicios = Servicio::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $image1 = $model->uploadImagen1();
            $image2 = $model->uploadImagen2();
            $image3 = $model->uploadImagen3();
            $image4 = $model->uploadImagen4();
            $image5 = $model->uploadImagen5();
            $logotipo = $model->uploadLogotipo();

            Yii::$app->funciones->InsertarTags($model->tags, $model->idioma_fk);

            if($model->numeracion == "")
                $model->numeracion = null;

            $model->sitio_web = str_replace("http://", "", $model->sitio_web);
            $model->sitio_web = str_replace("https://", "", $model->sitio_web);

            $model->facebook = str_replace("http://", "", $model->facebook);
            $model->facebook = str_replace("https://", "", $model->facebook);

            $model->twitter = str_replace("http://", "", $model->twitter);
            $model->twitter = str_replace("https://", "", $model->twitter);

            $model->instagram = str_replace("http://", "", $model->instagram);
            $model->instagram = str_replace("https://", "", $model->instagram);

            $model->googleplus = str_replace("http://", "", $model->googleplus);
            $model->googleplus = str_replace("https://", "", $model->googleplus);

            $model->pinterest = str_replace("http://", "", $model->pinterest);
            $model->pinterest = str_replace("https://", "", $model->pinterest);

            if($model->save()){

                foreach($servicios as $servicio){
                    if($_POST['servicio'.$servicio->pk] == 1){
                        $txs = new Tiendaxservicio;
                        $txs->tienda_fk = $model->pk;
                        $txs->servicio_fk = $servicio->pk;
                        $txs->save();
                    }
                }

                if ($image1 !== false) {
                    $path1 = $model->getImagen1File();
                    $image1->saveAs($path1);
                }

                if ($image2 !== false) {
                    $path2 = $model->getImagen2File();
                    $image2->saveAs($path2);
                }

                if ($image3 !== false) {
                    $path3 = $model->getImagen3File();
                    $image3->saveAs($path3);
                }

                if ($image4 !== false) {
                    $path4 = $model->getImagen4File();
                    $image4->saveAs($path4);
                }

                if ($image5 !== false) {
                    $path5 = $model->getImagen5File();
                    $image5->saveAs($path5); 
                }

                if ($logotipo !== false) {
                    $path6 = $model->getLogotipoFile();
                    $logotipo->saveAs($path6);
                }

                return $this->redirect(['view', 'id' => $model->pk]);    
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'servicios' => $servicios,
            ]);
        }
    }

    /**
     * Updates an existing Tienda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $servicios = Servicio::find()->all();
        $imagen1Vieja = $model->imagen1;
        $imagen2Vieja = $model->imagen2;
        $imagen3Vieja = $model->imagen3;
        $imagen4Vieja = $model->imagen4;
        $imagen5Vieja = $model->imagen5;
        $logotipoViejo = $model->logotipo;
        $path_imagen1Vieja = $model->getImagen1File();
        $path_imagen2Vieja = $model->getImagen2File();
        $path_imagen3Vieja = $model->getImagen3File();
        $path_imagen4Vieja = $model->getImagen4File();
        $path_imagen5Vieja = $model->getImagen5File();
        $path_logotipoViejo = $model->getLogotipoFile();


        if ($model->load(Yii::$app->request->post())) {

            $image1 = $model->uploadImagen1();
            $image2 = $model->uploadImagen2();
            $image3 = $model->uploadImagen3();
            $image4 = $model->uploadImagen4();
            $image5 = $model->uploadImagen5();
            $logotipo = $model->uploadLogotipo();

            if($model->numeracion == "")
                $model->numeracion = null;

            $model->sitio_web = str_replace("http://", "", $model->sitio_web);
            $model->sitio_web = str_replace("https://", "", $model->sitio_web);

            $model->facebook = str_replace("http://", "", $model->facebook);
            $model->facebook = str_replace("https://", "", $model->facebook);

            $model->twitter = str_replace("http://", "", $model->twitter);
            $model->twitter = str_replace("https://", "", $model->twitter);

            $model->instagram = str_replace("http://", "", $model->instagram);
            $model->instagram = str_replace("https://", "", $model->instagram);

            $model->googleplus = str_replace("http://", "", $model->googleplus);
            $model->googleplus = str_replace("https://", "", $model->googleplus);

            $model->pinterest = str_replace("http://", "", $model->pinterest);
            $model->pinterest = str_replace("https://", "", $model->pinterest);


            if ($image1 === false) {
                $model->imagen1 = $imagen1Vieja;
            }

            if ($image2 === false) {
                $model->imagen2 = $imagen2Vieja;
            }

            if ($image3 === false) {
                $model->imagen3 = $imagen3Vieja;
            }

            if ($image4 === false) {
                $model->imagen4 = $imagen4Vieja;
            }

            if ($image5 === false) {
                $model->imagen5 = $imagen5Vieja;
            }

            if ($logotipo === false) {
                $model->logotipo = $logotipoViejo;
            }


            Yii::$app->funciones->InsertarTags($model->tags, $model->idioma_fk);

            if($model->save()){

                Tiendaxservicio::deleteAll(['tienda_fk'=>$model->pk]);

                foreach($servicios as $servicio){
                    if($_POST['servicio'.$servicio->pk] == 1){
                        $txs = new Tiendaxservicio;
                        $txs->tienda_fk = $model->pk;
                        $txs->servicio_fk = $servicio->pk;
                        $txs->save();
                    }
                }

                if ($image1 !== false) {
                    if($imagen1Vieja != null)
                        unlink($path_imagen1Vieja);
                    $path_imagen = $model->getImagen1File();
                    $image1->saveAs($path_imagen);
                }

                if ($image2 !== false) {
                    if($imagen2Vieja != null)
                        unlink($path_imagen2Vieja);
                    $path_imagen = $model->getImagen2File();
                    $image2->saveAs($path_imagen);
                }

                if ($image3 !== false) {
                    if($imagen3Vieja != null)
                        unlink($path_imagen3Vieja);
                    $path_imagen = $model->getImagen3File();
                    $image3->saveAs($path_imagen);
                }

                if ($image4 !== false) {
                    if($imagen4Vieja != null)
                        unlink($path_imagen4Vieja);
                    $path_imagen = $model->getImagen4File();
                    $image4->saveAs($path_imagen);
                }

                if ($image5 !== false) {
                    if($imagen5Vieja != null)
                        unlink($path_imagen5Vieja);
                    $path_imagen = $model->getImagen5File();
                    $image5->saveAs($path_imagen);
                }

                if ($logotipo !== false) {
                    if($logotipoViejo != null)
                        unlink($path_logotipoViejo);
                    $path6 = $model->getLogotipoFile();
                    $logotipo->saveAs($path6);
                }

                return $this->redirect(['view', 'id' => $model->pk]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'servicios' => $servicios,
            ]);
        }
    }

    /**
     * Deletes an existing Tienda model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            if (!$model->deleteImagen1() || !$model->deleteImagen2() || !$model->deleteImagen3() || !$model->deleteImagen4() || !$model->deleteImagen5() || !$model->deleteLogotipo()) {
                Yii::$app->session->setFlash('error', 'Error al eliminar las imagenes del item.');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Tienda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tienda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tienda::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
