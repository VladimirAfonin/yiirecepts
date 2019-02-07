<?php

namespace frontend\modules\log\controllers;

use frontend\modules\log\services\LogReaderService;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $reader = new LogReaderService();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $reader->getRows($this->getFile()),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return bool|string
     */
    private function getFile()
    {
        return \Yii::getAlias($this->module->file);
    }
}