<?php

namespace frontend\modules\v1\controllers;

use shop\entities\Film;
use yii\rest\ActiveController;

class FilmController extends ActiveController
{
    public $modelClass = Film::class;


}