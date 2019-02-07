<?php

namespace frontend\modules\log\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class LogHelper
{
    /**
     * @param $level
     * @return string
     */
    public static function levelLabel($level)
    {
        $classes = [
            'error' => 'danger',
            'warning' => 'warning',
            'info' => 'primary',
            'trace' => 'default',
            'profile' => 'success',
            'profile begin' => 'info',
            'profile end' => 'info',
        ];

        $class = ArrayHelper::getValue($classes, $level, 'default');

        return Html::tag('span', Html::encode($level), ['class' => 'label label-' . $class]);
    }
}