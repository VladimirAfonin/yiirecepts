<?php

namespace console\controllers;

use yii\console\Controller;

class ExchangeController extends Controller
{
    public function actionRun($from, $to, $amount, $date = null)
    {
        $this->stdout('Starting...');
        $this->stdout(\Yii::$app->exchange->getRate($from, $to, $amount, $date = null));
        $this->stdout('End.');
    }
}