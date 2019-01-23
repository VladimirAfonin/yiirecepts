<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use frontend\models\{
    Category, Product
};
use yii\web\HttpException;
use yii\helpers\{
    Json, ArrayHelper
};

class DropdownController extends Controller
{
    public $t;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['get-sub-categories', 'index'],
                        'allow' => true,
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * add csrf validation to $.ajax request:
     * in <head></head> section add <?= Html::csrfMetaTags(); ?>
     * var csrfToken = $('meta[name="csrf-token"]').attr("content");
     *   $.ajax({
     *   url: 'requestUrl',
     *   type: 'post',
     *   dataType: 'json',
     *   data: {param1: param1, _csrf: csrfToken},
     *   });
     *
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        // disable for specific action:
        //  $this->enableCsrfValidation = ($action->id !== "index");

        // disable for all actions in controller
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionGetSubCategories($id)
    {
        if (!\Yii::$app->request->isAjax) {
            throw new HttpException(400, 'Only ajax request allowed');
        }
        return Json::encode(Category::getSubCategories($id));
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new Product();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            \Yii::$app->session->setFlash('success', 'model was saved.');
        }

        return $this->render('index', ['model' => $model]);
    }
}