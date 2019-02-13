<?php

namespace frontend\controllers;

use shop\entities\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SmartyController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['articles'],
                'lastModified' => function ($action, $params) {
                    return Article::find()->max('updated_at');
                }
            ],
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['view'],
                'etagSeed' => function ($action, $params) {
                    $article = $this->findModel(\Yii::$app->request->get('id'));
                    return serialize([$article->name, $article->description]);
                }
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index.tpl', ['name' => 'Bond']);
    }

    /**
     * @return string
     */
    public function actionArticles()
    {
        $articles = Article::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render('articles', ['articles' => $articles]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $article = $this->findModel($id);
        return $this->render('view', ['article' => $article]);
    }

    /**
     * @param $id
     * @return null|Article
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist');
        }
    }
}