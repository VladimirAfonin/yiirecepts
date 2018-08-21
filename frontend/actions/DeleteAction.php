<?php

namespace frontend\actions;

use yii\base\Action;
use yii\web\NotFoundHttpException;

class DeleteAction extends Action
{
    public $modelClass;

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        $class = $this->modelClass;
        if (($model = $class::findOne($id)) === null) {
            throw new NotFoundHttpException('the requested page does not exist.');
        }
        $model->delete();

        return $this->controller->redirect(['post/index']);
    }
}