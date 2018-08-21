<?php

namespace frontend\components;

use yii\base\ActionFilter;
use yii\web\HttpException;
use Yii;

class CustomFilter extends ActionFilter
{
    const WORK_TIME_BEGIN = 10;
    const WORK_TIME_END = 18;

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws HttpException
     */
    public function beforeAction($action)
    {
        if (!$this->canBeDisplayed()) {
            $error = 'This page works from ' . self::WORK_TIME_BEGIN . ' to ' . self::WORK_TIME_END . ' hours.';
            throw new HttpException(403, $error);
        }
        return parent::beforeAction($action);
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        if (Yii::$app->request->url == 'post/index') {
            Yii::debug("this is the post page.");
        }
        return parent::afterAction($action, $result);
    }

    /**
     * @return bool
     */
    protected function canBeDisplayed()
    {
        $hours = date('G');
//        var_dump($hours); exit('exit');
        return $hours >= self::WORK_TIME_BEGIN && $hours <= self::WORK_TIME_END;
    }
}