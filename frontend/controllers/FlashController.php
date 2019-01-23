<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class FlashController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?'],
                        'actions' => ['index', 'success', 'error']
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    Yii::$app->session->setFlash('error', 'This is section only for registered users.');
                    $this->redirect(['index']);
                },
            ],
        ];
    }

    public function actionUser()
    {
        return $this->render('user');
    }

    public function actionSuccess()
    {
        Yii::$app->session->setFlash('success', 'is OK!');
        $this->redirect(['index']);
    }

    public function actionError()
    {
        Yii::$app->session->setFlash('error', 'Not OK!');
        $this->redirect(['index']);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}