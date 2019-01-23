<?php

namespace frontend\controllers;

use frontend\components\MyAccessRule;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;

class AccessController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                //we will override the default rule config with the new 'MyAccessRule' class
                'ruleConfig' => [
                    'class' => MyAccessRule::class,
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['auth-only'],
                        'roles' => [User::ROLE_USER]
                    ],
                    [
                        'allow' => true,
                        'actions' => ['ip'],
                        'ips' => ['127.0.0.1']
                    ],
                    /*[
                        'allow' => true,
                        'actions' => ['user'],
                        'roles' => [User::ROLE_ADMIN]
                    ],*/
                    [
                        'allow' => true,
                        'actions' => ['user'],
                        'matchCallback' => function ($rule, $action) {
                            return preg_match('/MSIE 9/', $_SERVER['HTTP_USER_AGENT']) !== false;
                        },
                    ],
                    [
                        'allow' => false,
                    ]

                ],
            ],
        ];
    }

    public function actionAuthOnly()
    {
        echo "Looks like you are authorized to run me.";
    }

    public function actionIp()
    {
        echo "Your IP is in our list. Lucky you!";
    }

    public function actionUser()
    {
        echo "You're the right man. Welcome!";
    }
}