<?php

namespace app\controllers;

use Yii;
use app\models\Noticia;
use app\models\NoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller
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
     * Lists all Noticia models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        if($id != 0 && $id != 1){
            $id = 0;
        }

        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->searchPrensa(Yii::$app->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=>$id
        ]);
    }

    /**
     * Displays a single Noticia model.
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
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {

        if($id != 0 && $id != 1){
            $id = 0;
        }

        $model = new Noticia();

        if ($model->load(Yii::$app->request->post())) {

            $image = $model->uploadImagen();
            $model->prensa = $id;
            $model->referencia = str_replace("http://", "", $model->referencia);
            $model->referencia = str_replace("https://", "", $model->referencia);
            
            if($model->save()){

                if ($image !== false) {
                    $path = $model->getImagenFile();
                    $image->saveAs($path);
                }

                return $this->redirect(['view', 'id' => $model->pk]);   
            }
        }

        return $this->render('create', ['model' => $model, 'id'=>$id]);
    }

    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagenVieja = $model->imagen;
        $path_imagenVieja = $model->getImagenFile();
        $id = $model->prensa;

        if ($model->load(Yii::$app->request->post())) {

            $imagen = $model->uploadImagen();

            if ($imagen === false) {
                $model->imagen = $imagenVieja;
            }

            $model->referencia = str_replace("http://", "", $model->referencia);
            $model->referencia = str_replace("https://", "", $model->referencia);

            if($model->save()){

                if ($imagen !== false) {
                    if($imagenVieja != null)
                        unlink($path_imagenVieja);
                    $path_imagen = $model->getImagenFile();
                    $imagen->saveAs($path_imagen);
                }

                return $this->redirect(['view', 'id' => $model->pk]);
            }
        }
        return $this->render('update', ['model' => $model, 'id'=>$id]);
    }

    /**
     * Deletes an existing Noticia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            if (!$model->deleteImagen()) {
                Yii::$app->session->setFlash('error', 'Error al eliminar las imagenes del item.');
            }
        }
        return $this->redirect(['index', 'id'=>$model->prensa]);
    }

    /**
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
