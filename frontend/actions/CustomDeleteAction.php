<?php

namespace frontend\actions;

use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;


class CustomDeleteAction extends Action
{
    public $modelClass;
    public $redirectTo = ['index'];

    public function init()
    {
        if(empty($this->modelClass)) {
            throw new InvalidConfigException('Empty model class.');
        }
        parent::init();
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
    public function run($id)
    {
        if(!\Yii::$app->getRequest()->getIsPost()) {
            throw new MethodNotAllowedHttpException('Method not allowed.');
        }

        $model = $this->findModel($id);
        $model->delete();

        return $this->controller->redirect($this->redirectTo);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        $class = $this->modelClass;
        if (($model = $class::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Page does not exist.');
        }
    }
}