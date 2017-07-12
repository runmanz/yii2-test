<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                ],
                'db' => [
                    'class' => 'yii\log\DbTarget',
                ],
                /*[
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],*/
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            //'suffix' => '.html',
            'rules' => [
                //['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                '' => 'site/index',
                '<controller:[\w-]+>/<action:[\w-]+>'=>'<controller>/<action>',
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                '<controller:(post|comment)>/<id:\d+>' => '<controller>/view',
                '<controller:(post|comment)>s' => '<controller>/index',
                //'http://<user:[\w-]+>api.cn/<lang:[\w-]+>/profile' => 'user/profile',
            ],
        ],
    ],
    'params' => $params,
];
