<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 29.01.2019
 * Time: 9:49
 */

namespace console\controllers;

use yii\console\Controller;

class MailController extends Controller
{

    public function actionSend()
    {
        \Yii::$app->mailer->compose()
            ->setTo('afonin006@gmail.com')
            ->setFrom(['from@yii-book.app' => \Yii::$app->name])
            ->setSubject('My test message')
            ->setTextBody('my text body')
            ->attach(\Yii::getAlias('@frontend/README.md'))
            ->send();
    }

}