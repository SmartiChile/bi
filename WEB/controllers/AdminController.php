<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;
use app\models\Tag;

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
        $tags = Tag::find()->orderBy(['frecuencia' => SORT_DESC])->limit(10)->all();
        foreach($tags as $tag){
            $x[] = $tag->palabra;
            $y[] = $tag->frecuencia;
        }

        if($x == NULL) $x[] = 'hola';
        return $this->render('inicio', [
            'x' => $x,
            'y' => $y
        ]);
    }

}
