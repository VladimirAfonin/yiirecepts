<?php
return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'identityCookie' => new \yii\helpers\ReplaceArrayValue(['name' => '_identity', 'httpOnly' => true]),
        ],
        /*'request' => [
            'cookieValidationKey' => 'test',
        ],*/
    ],
];
