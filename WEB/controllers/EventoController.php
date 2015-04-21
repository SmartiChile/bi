<?php

namespace app\controllers;

use Yii;
use app\models\Evento;
use app\models\EventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
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
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evento model.
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
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evento();
        $model->inicio = date("d-m-Y 00:00");
        $model->fin = date('d-m-Y 00:00',mktime(0,0,0,date('m'),date('d')+1,date('Y')));

        if ($model->load(Yii::$app->request->post())) {

            $model->inicio = date('Y-m-d H:i', strtotime($model->inicio));
            $model->fin = date('Y-m-d H:i', strtotime($model->fin));
            $image = $model->uploadImagen();

            if($model->save()){

                if ($image !== false) {
                    $path = $model->getImagenFile();
                    $image->saveAs($path);
                }

                return $this->redirect(['view', 'id' => $model->pk]);   
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Evento model.
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

            $model->inicio = date('Y-m-d H:i', strtotime($model->inicio));
            $model->fin = date('Y-m-d H:i', strtotime($model->fin));
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
        }
        return $this->render('update', ['model' => $model]);
    }


    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            if (!$model->deleteImagen()) {
                Yii::$app->session->setFlash('error', 'Error al eliminar las imagenes del evento.');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
