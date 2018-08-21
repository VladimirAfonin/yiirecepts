<?php

namespace frontend\controllers;

use frontend\actions\CreateAction;
use frontend\actions\DeleteAction;
use frontend\actions\IndexAction;
use frontend\actions\ViewAction;
use shop\entities\Post;
use yii\web\Controller;

class PostController extends Controller
{
    public $modelClass = Post::class;

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
        ];
    }

}