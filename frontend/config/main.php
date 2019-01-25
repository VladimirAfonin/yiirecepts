<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', '\common\bootstrap\SetUp'],
    /* 'container' => [
         'singletons' => [
             'shop\ShoppingCart',
         ],
     ],*/
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl'=>'',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey'],
            'enableCsrfValidation' => true,
            'parsers' => [
                'application/json' => '\yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
            // 'timeout' => 200,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//                '' => 'site/index',
//                '<_action:[\w\-]+>' => 'site/<_action>',
//                '<_controller:[\w\-]+>' => '<_controller>/index',
//                '<_controller:[\w\-]+>/<id:\d+>' => '<_controller>/view',
//                '<_controller:[\w\-]+>/<_action:[\w\-]+>' => '<_controller>/<_action>',
//                '<_controller:[\w\-]+>/<_id:\d+>/<_action:[\w\-]+>' => '<_controller>/<_action>',
//
//            ],
//        ],
        'backendUrlManager' => require __DIR__ . '/../../backend/config/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/urlManager.php',
        'urlManager' => function () {
            return Yii::$app->get('frontendUrlManager');
        },
    ],
    'modules' => [
        'v1' => [
            'class' => 'frontend\modules\v1\Module'
        ],
        'v2' => [
            'class' => 'frontend\modules\v2\Module'
        ],
    ],
    'params' => $params,
];
