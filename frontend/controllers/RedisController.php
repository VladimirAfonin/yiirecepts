<?php

namespace frontend\controllers;


use frontend\models\CustomerRedis;
use yii\web\Controller;

class RedisController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->redis->executeCommand('hmset', ['test_collection', 'key1', 'val1', 'key2', 'val2']);

        /*$redisC = new CustomerRedis();
        $redisC->name = 'test';
        $redisC->save();*/

        // find by query
//        $customer = CustomerRedis::find()->where(['name' => 'test'])->one();

        // AR -> where(), limit(), offset(), indexBy()
    }

}