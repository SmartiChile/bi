<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;

class AdminController extends \yii\web\Controller
{

	public function behaviors()
    {
        return [
            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['inicio'],
                        'rules' => [
                            [
                                'allow' => Yii::$app->funciones->isAdmin(),
                            ],
                        ],
                    ],  
        ];
    }

    public function actionInicio()
    {
        return $this->render('inicio');
    }

}
