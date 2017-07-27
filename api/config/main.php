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
    'modules'=>[
        'v3' => [
            'class' => 'api\modules\v3\Module',
            'basePath' => '@app/modules/v3',
        ]
    ],
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
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v3\user'],
                '' => 'site/index',
                '<controller:[\w-]+>/<action:[\w-]+>'=>'<controller>/<action>',
                'POST <controller:[\w-]+>s' => '<controller>/create', // 'mode' => UrlRule::PARSING_ONLY will be implicit here
                '<controller:[\w-]+>s'      => '<controller>/index',
                'PUT <controller:[\w-]+>/<id:\d+>'    => '<controller>/update',// 'mode' => UrlRule::PARSING_ONLY will be implicit here
                'DELETE <controller:[\w-]+>/<id:\d+>' => '<controller>/delete', // 'mode' => UrlRule::PARSING_ONLY will be implicit here
                '<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w-]+>s/create' => '<controller>/create',
                '<controller:[\w-]+>/<id:\d+>/<action:update|delete>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
