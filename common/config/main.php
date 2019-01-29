<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['log', '\common\bootstrap\SetUp'],
    'components' => [
        /*'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://localhost:27017/mydatabase'
        ],*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
//            'class' => 'yii\caching\MemCache',
//            'useMemcached' => true,
            'cachePath' => '@common/runtime/cache',
        ],
        'cart' => [
            'class' => 'shop\ShoppingCart',
            'sessionKey' => 'primary-cart',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'films'],
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function($event) {
                $response = $event->sender;
                if($response->data !== null && Yii::$app->request->get('suppress_response')) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'timestamp' => time(),
                        'path' => Yii::$app->request->getPathInfo(),
                        'data' => $response->data,
                    ];
                }
            },
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'username@gmail.com',
                'password' => 'password',
                'post' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
