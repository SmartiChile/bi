<?php

namespace app\controllers;

use Yii;
use app\models\Circuito;
use app\models\CircuitoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CircuitoController implements the CRUD actions for Circuito model.
 */
class CircuitoController extends Controller
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
     * Lists all Circuito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CircuitoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Circuito model.
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
     * Creates a new Circuito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Circuito();
        $model->posicion = Circuito::find()->max('posicion')+1; 

        if ($model->load(Yii::$app->request->post())) {

                
             $image = $model->uploadImagen();
             $icono = $model->uploadIcono();
             $model->nombre = strtoupper($model->nombre);

            if($model->save()){

                    if ($image !== false) {
                        $path = $model->getImagenFile();
                        $image->saveAs($path);
                    }

                    if ($icono !== false) {
                        $path_icono = $model->getIconoFile();
                        $icono->saveAs($path_icono);
                    }

                    return $this->redirect(['view', 'id' => $model->pk]);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Circuito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagenVieja = $model->imagen;
        $iconoViejo = $model->icono;
        $path_imagenVieja = $model->getImagenFile();
        $path_iconoViejo = $model->getIconoFile();

        if ($model->load(Yii::$app->request->post())) {

            $imagen = $model->uploadImagen();
            $icono = $model->uploadIcono();
            $model->nombre = strtoupper($model->nombre);

            if ($imagen === false) {
                $model->imagen = $imagenVieja;
            }

            if ($icono === false) {
                $model->icono = $iconoViejo;
            }

            if($model->save()){


                if ($imagen !== false) {
                    if($imagenVieja != null)
                        unlink($path_imagenVieja);
                    $path_imagen = $model->getImagenFile();
                    $imagen->saveAs($path_imagen);
                }

                if ($icono !== false) {
                    if($iconoViejo != null)
                        unlink($path_iconoViejo);
                    $path_ico = $model->getIconoFile();
                    $icono->saveAs($path_ico);
                }

                return $this->redirect(['view', 'id' => $model->pk]);
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Circuito model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            if (!$model->deleteImagen() || !$model->deleteIcono()) {
                Yii::$app->session->setFlash('error', 'Error al eliminar la imagenes del circuito.');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Circuito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Circuito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Circuito::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
