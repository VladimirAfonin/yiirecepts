<?php

namespace common\filters;

use common\services\AgreementChecker;
use yii\base\ActionFilter;

class AgreementFilter extends ActionFilter
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $checker = new AgreementChecker();

        if (!$checker->isAllowed()) {
            \Yii::$app->response->redirect(['/content/agreement'])->send();
            return false;
        }

        return true;
    }
}