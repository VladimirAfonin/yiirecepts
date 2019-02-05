<?php

namespace common\services;

use yii\web\Cookie;

class AgreementChecker
{
    public function isAllowed()
    {
        return \Yii::$app->request->cookies->has('agree');
    }

    public function allowAccess()
    {
        \Yii::$app->response->cookies->add(new Cookie([
            'name' => 'agree',
            'value' => 'on',
            'expire' => time() + 1800, // half hour
        ]));
    }
}