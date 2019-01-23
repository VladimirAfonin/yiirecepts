<?php

namespace frontend\components;

use yii\captcha\CaptchaAction;

class MathCaptchaAction extends CaptchaAction
{
    /**
     * @param string $code
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    protected function renderImage($code)
    {
        return parent::renderImage($this->getText($code));
    }

    /**
     * @return int|string
     */
    protected function generateVerifyCode()
    {
        return mt_rand((int)$this->minLength, (int)$this->maxLength);
    }

    /**
     * @param $code
     * @return string
     */
    protected function getText($code)
    {
        $code = (int)$code;
        $rand = mt_rand(1, $code - 1);
        $op = mt_rand(0, 1);
        if ($op) {
            return $code - $rand . " + " . $rand; // [2 + 8] -> (10 - 8( + 8))
        } else {
            return $code + $rand . " - " . " " . $rand;
        }
    }
}