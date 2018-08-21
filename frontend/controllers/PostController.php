<?php

namespace frontend\controllers;

use frontend\actions\CreateAction;
use frontend\actions\DeleteAction;
use frontend\actions\IndexAction;
use frontend\actions\ViewAction;
use shop\entities\Post;
use yii\web\Controller;
use frontend\components\CustomFilter;

class PostController extends Controller
{
    public $modelClass = Post::class;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => CustomFilter::class,
                'only' => ['index'],
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass,
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
            ],
            'page' => [
                'class' => 'yii\web\ViewAction',
                'defaultView' => 'contact',
//                'layout' => 'some layout',
//            'viewPrefix' => // for ex.: tutorial/chap1 => pages/tutorial/chap1
            ],
        ];
    }
}