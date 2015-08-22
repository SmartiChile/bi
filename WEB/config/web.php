<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'es',
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '540617242747874',
                    'clientSecret' => '7960f8deeee975c3a1950630face5ce1',
                ],
            ],
        ],
        'funciones' => [
            'class' => 'app\components\funciones',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Mzh_kLzpaM-YmeZj2C0Iqa-UYqryBa-x',
        ],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => array(
                '<lan:\w+>/<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<lan:\w+>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<lan:\w+>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],  
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.barrioitalia.com',
                'username' => 'noreply@barrioitalia.com',
                'password' => 'Smarti.barrioitalia123',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
