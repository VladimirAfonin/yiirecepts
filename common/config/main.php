<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['log', '\common\bootstrap\SetUp'],
    'components' => [
        'cache' => [
//            'class' => 'yii\caching\FileCache',
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true,
//            'cachePath' => '@common/runtime/cache',
        ],
        'cart' => [
            'class' => 'shop\ShoppingCart',
            'sessionKey' => 'primary-cart',
        ],
    ],
];
