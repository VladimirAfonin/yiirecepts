<?php

namespace frontend\controllers;

use frontend\models\Account;
use frontend\models\AccountArticle;
use yii\caching\DbDependency;
use yii\caching\TagDependency;
use yii\web\Controller;

class SessionChainController extends Controller
{
    public function behaviors()
    {
        return [
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 24 * 3600 * 365, // 1 year
                'dependency' => [
                    'class' => 'yii\caching\ChainedDependency',
                    'dependencies' => [
                        new TagDependency(['tags' => ['articles']]),
                        new DbDependency(['sql' => 'SELECT MAX(id) FROM ' . Account::tableName()])
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $total = Account::find()->sum('amount');
        $articles = AccountArticle::find()->orderBy('id DESC')->limit(5)->all();

        return $this->render('index', [
            'total' => $total,
            'articles' => $articles
        ]);
    }

    /**
     *
     */
    public function actionRandomOperation()
    {
        $rec = new Account();
        $rec->amount = rand(-1000, 1000);
        $rec->save();

        echo 'OK';
    }

    /**
     *
     */
    public function actionRandomArticle()
    {
        $n = rand(0, 1000);
        $article = new AccountArticle();
        $article->title = 'Title #' . $n;
        $article->text = 'Text #' . $n;
        $article->save();

        TagDependency::invalidate(\Yii::$app->cache, 'articles');

        echo 'OK';
    }
}