<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\FileHelper;

class CleanController extends Controller
{
    public $assetPaths = [
        '@backend/web/assets',
        '@frontend/web/assets'
    ];
    public $runtimePaths = [
        '@backend/runtime',
        '@frontend/runtime',
        '@console/runtime',
    ];

    /**
     * Remove assets folder's
     * @throws \yii\base\ErrorException
     */
    public function actionAssets()
    {
        foreach ((array)$this->assetPaths as $assetPath) {
            $this->cleanDir($assetPath);
        }
        $this->stdout('Done' . PHP_EOL);
    }

    /**
     * Remove runtime folders
     * @throws \yii\base\ErrorException
     */
    public function actionRuntime()
    {
        foreach ((array)$this->runtimePaths as $runtimePath) {
            $this->cleanDir($runtimePath);
        }
        $this->stdout('Done' . PHP_EOL);
    }

    /**
     * @param $path
     * @throws \yii\base\ErrorException
     */
    private function cleanDir($path)
    {
        $iterator = new \DirectoryIterator(\Yii::getAlias($path));
        foreach ($iterator as $sub) {
            if (!$sub->isDot() && $sub->isDir()) {
                $this->stdout('Removed ' . $sub->getPathname() . PHP_EOL);
                FileHelper::removeDirectory($sub->getPathname());
            }
        }
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        $out = 'Clean command allows you to clean up various temporary data Yii and an application are generatin' . PHP_EOL;
        return $out . parent::getHelp();
    }
}