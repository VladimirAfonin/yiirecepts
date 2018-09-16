<?php

return [
    'class' => 'yii\web\UrlManager',
    'scriptUrl' => '/index.php',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        'cart' => 'shop/cart/index',
        'users' => 'shop/index',
        'flash' => 'flash/index',

        '<_action:[\w\-]+>' => 'site/<_action>',
        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<_a:[\w\-]+>/<view:[\w\-]+>' => '<_c>/<_a>',
    ],
];