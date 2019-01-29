<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', '\common\bootstrap\SetUp'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'fixtureDataPath' => '@common/tests/fixtures',
            'templatePath' => '@common/tests/templates',
            'namespace' => 'common\tests\fixtures',
            // 'useFileTransport' => false,
          ],
        'faker_fixture' => [
            'class'           => 'yii\faker\FixtureController',
            'namespace'       => 'common\fixtures',
            'fixtureDataPath' => '@common/tests/_data',
            'templatePath'    => '@common/fixtures/templates',
            'providers' => [
                'common\fixtures\providers\UserStatus'
            ],
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

        ],
        'backendUrlManager' => require __DIR__ . '/../../backend/config/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/../../frontend/config/urlManager.php',
        /*'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],*/
    ],
    'params' => $params,
];
