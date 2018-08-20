<?php

namespace console\controllers;

use yii\console\Controller;
use Ramsey\Uuid\Uuid;

class UuidController extends Controller
{
    public function actionGenerate()
    {
        $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
        $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
        $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
        $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
    }
}