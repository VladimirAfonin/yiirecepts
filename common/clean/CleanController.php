<?php

namespace common\clean;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;

class CleanController extends Controller
{
    public $assetPaths = []; // ['@app/web/assets'];
    public $runtimePaths = []; // ['@runtime'];
    public $caches = ['cache'];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'assets' => ['post'],
                    'runtime' => ['post'],
                    'cache' => ['post'],
                ],
            ],

        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('@common/cleaner/views/index');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionAssets()
    {
        foreach ((array)$this->assetPaths as $path) {
            $this->cleanDir($path);
            \Yii::$app->session->addFlash('cleaner', "Assets path $path is cleaned");
        }
        return $this->redirect('/clean/index');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionRuntime()
    {
        foreach ((array)$this->runtimePaths as $path) {
            $this->cleanDir($path);
            \Yii::$app->session->addFlash('cleaner', "Runtime path {$path} is cleaned.");
        }
        return $this->redirect('/clean/index');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionCache()
    {
        foreach ((array)$this->caches as $cache) {
            \Yii::$app->get($cache)->flush();
            \Yii::$app->session->addFlash('cleaner', "Cache $cache is cleaned.");
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $dir
     */
    private function cleanDir($dir)
    {
        $iterator = new \DirectoryIterator(\Yii::getAlias($dir));

        foreach ($iterator as $sub) {
            if (!$sub->isDot() && $sub->isDir()) {
                FileHelper::removeDirectory($sub->getPathname());
            }
        }
    }
}