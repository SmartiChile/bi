<?php

namespace app\controllers;

use Yii;
use app\models\Patrimonio;
use app\models\PatrimonioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatrimonioController implements the CRUD actions for Patrimonio model.
 */
class PatrimonioController extends Controller
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
     * Lists all Patrimonio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatrimonioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patrimonio model.
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
     * Creates a new Patrimonio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patrimonio();

        if ($model->load(Yii::$app->request->post())) {

            $image = $model->uploadImagen();

            if(isset($_POST['latlng_manual'])){
                $model->coordenadas = $_POST['coordenadas2'];
            }

            if($model->save()){

                if ($image !== false) {
                    $path = $model->getImagenFile();
                    $image->saveAs($path);
                }

                return $this->redirect(['view', 'id' => $model->pk]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Patrimonio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagenVieja = $model->imagen;
        $path_imagenVieja = $model->getImagenFile();

        if ($model->load(Yii::$app->request->post())) {

            $imagen = $model->uploadImagen();

            if ($imagen === false) {
                $model->imagen = $imagenVieja;
            }

            if($model->save()){

                if ($imagen !== false) {
                    if($imagenVieja != null)
                        unlink($path_imagenVieja);
                    $path_imagen = $model->getImagenFile();
                    $imagen->saveAs($path_imagen);
                }

                return $this->redirect(['view', 'id' => $model->pk]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patrimonio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            if (!$model->deleteImagen()) {
                Yii::$app->session->setFlash('error', 'Error al eliminar la imagenes del patrimonio.');
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Patrimonio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patrimonio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patrimonio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
