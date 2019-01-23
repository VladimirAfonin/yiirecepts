<?php

namespace frontend\controllers;


use shop\entities\Order;
use yii\db\Query;
use yii\helpers\{
    VarDumper, Html
};
use yii\web\Controller;

class CryptoController extends Controller
{
    public function actionTest()
    {
        $newOrder = new Order();
        $newOrder->client = "Vladimir";
        $newOrder->total = 400;
        $newOrder->encrypted_field = 'very-secret-info';
        $newOrder->save();

        $findOrder = Order::findOne($newOrder->id);

        return $this->renderContent(Html::ul([
            'New model: ' . VarDumper::dumpAsString($newOrder->attributes),
            'Find model: ' . VarDumper::dumpAsString($findOrder->attributes),
        ]));
    }

    public function actionRaw()
    {
        $row = (new Query())->from('order')->where(['client' => 'Vladimir'])->one();
        return $this->renderContent(Html::ul($row));
    }
}