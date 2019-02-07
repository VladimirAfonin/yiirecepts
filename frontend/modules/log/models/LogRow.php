<?php

namespace frontend\modules\log\models;

use yii\base\BaseObject;

class LogRow extends BaseObject
{
    public $time;
    public $ip;
    public $userId;
    public $sessionId;
    public $level;
    public $category;
    public $text;
}