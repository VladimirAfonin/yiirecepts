<?php

namespace frontend\controllers;


use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\helpers\HtmlPurifier;

class XssController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
//                        'actions' => ['*']
                    ]
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $username = \Yii::$app->request->get('username', 'nobody');

        return $this->renderContent(Html::tag('h3', Html::encode('Hello, ' . $username)));
    }

    /**
     * @return string
     */
    public function actionIndexPure()
    {
        $username = \Yii::$app->request->get('username', 'nobody');
        $content = Html::tag('h3', 'Hello, ' . $username);
        return $this->renderContent(HTMLPurifier::process($content));
    }
}