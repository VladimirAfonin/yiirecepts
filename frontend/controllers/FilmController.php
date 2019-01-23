<?php

namespace frontend\controllers;

use common\models\User;
use shop\entities\Film;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;


class FilmController extends ActiveController
{
    public $modelClass = Film::class;

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/xml'] = Response::FORMAT_XML;
        return $behaviors;
    }*/

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/xml'] = Response::FORMAT_XML;

        return ArrayHelper::merge($behaviors, [
            'authenticator' => [
                'authMethods' => [
                    'basicAuth' => [
                        'class' => HttpBasicAuth::class,
                        'auth' => function ($username, $password) {
                            $user = User::findByUsername($username);
                            if ($user !== null && $user->validatePassword($password)) {
                                return $user;
                            }
                            return null;
                        }
                    ],
                ]
            ]
        ]);
    }
}