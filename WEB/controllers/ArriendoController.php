<?php

namespace app\controllers;

use Yii;
use app\models\Arriendo;
use app\models\ArriendoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArriendoController implements the CRUD actions for Arriendo model.
 */
class ArriendoController extends Controller
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
     * Lists all Arriendo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArriendoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Arriendo model.
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
     * Creates a new Arriendo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Arriendo();

        if ($model->load(Yii::$app->request->post())) {

            $image1 = $model->uploadImagen1();
            $image2 = $model->uploadImagen2();
            $image3 = $model->uploadImagen3();

            if($model->save()){

                if ($image1 !== false) {
                    $path = $model->getImagen1File();
                    $image1->saveAs($path);
                }
                if ($image2 !== false) {
                    $path = $model->getImagen2File();
                    $image2->saveAs($path);
                }
                if ($image3 !== false) {
                    $path = $model->getImagen3File();
                    $image3->saveAs($path);
                }

                return $this->redirect(['view', 'id' => $model->pk]);   
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Arriendo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $imagen1Vieja = $model->imagen1;
        $imagen2Vieja = $model->imagen2;
        $imagen3Vieja = $model->imagen3;
        $path_imagen1Vieja = $model->getImagen1File();
        $path_imagen2Vieja = $model->getImagen2File();
        $path_imagen3Vieja = $model->getImagen3File();


        if ($model->load(Yii::$app->request->post())) {

            $imagen1 = $model->uploadImagen1();
            $imagen2 = $model->uploadImagen2();
            $imagen3 = $model->uploadImagen3();
            
            if ($imagen1 === false) {
                $model->imagen1 = $imagen1Vieja;
            }

            if ($imagen2 === false) {
                $model->imagen2 = $imagen2Vieja;
            }

            if ($imagen3 === false) {
                $model->imagen3 = $imagen3Vieja;
            }

            if($model->save()){

                if ($imagen1 !== false) {
                    if($imagen1Vieja != null)
                        unlink($path_imagen1Vieja);
                    $path_imagen = $model->getImagen1File();
                    $imagen1->saveAs($path_imagen);
                }

                if ($imagen2 !== false) {
                    if($imagen2Vieja != null)
                        unlink($path_imagen2Vieja);
                    $path_imagen = $model->getImagen2File();
                    $imagen2->saveAs($path_imagen);
                }

                if ($imagen3 !== false) {
                    if($imagen3Vieja != null)
                        unlink($path_imagen3Vieja);
                    $path_imagen = $model->getImagen3File();
                    $imagen3->saveAs($path_imagen);
                }

                return $this->redirect(['view', 'id' => $model->pk]);
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Arriendo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
            $model = $this->findModel($id);

            if ($model->delete()) {
                if (!$model->deleteImagen1() || !$model->deleteImagen2() || !$model->deleteImagen3()) {
                    Yii::$app->session->setFlash('error', 'Error al eliminar las imagenes del arriendo.');
                }
            }
            return $this->redirect(['index']);
    }

    /**
     * Finds the Arriendo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Arriendo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Arriendo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
