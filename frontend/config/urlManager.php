<?php

return [
    'class' => 'yii\web\UrlManager',
    'scriptUrl' => '/index.php',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // for rest api:
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => ['v1/super-films' => 'v1/film'],
//            'controller' => 'film',
//            'pluralize' => false // 'film' to 'films' in request url
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => ['v2/super-films' => 'v2/film'],
        ],

        '' => 'site/index',
        'cart' => 'shop/cart/index',
        'users' => 'shop/index',
        'flash' => 'flash/index',

        'clean' => '/clean/index',
        'customer' => '/customer/index',
        'redis' => '/redis/index',
        'chart' => '/chart/index',

        '<_action:[\w\-]+>' => 'site/<_action>',
        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<_a:[\w\-]+>/<view:[\w\-]+>' => '<_c>/<_a>',
    ],
];