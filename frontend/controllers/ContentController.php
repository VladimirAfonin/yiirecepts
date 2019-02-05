<?php

namespace frontend\controllers;

use common\filters\AgreementFilter;
use common\models\AgreementForm;
use common\services\AgreementChecker;
use yii\web\Controller;

class ContentController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => AgreementFilter::class,
                'only' => ['index'],
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAgreement()
    {
        $model = new AgreementForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $checker = new AgreementChecker();
            $checker->allowAccess();
            return $this->redirect(['index']);
        } else {
            return $this->render('agreement', [
                'model' => $model
            ]);
        }
    }
}