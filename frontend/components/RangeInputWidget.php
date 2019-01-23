<?php

namespace frontend\components;

use yii\base\{
    Model, Widget
};
use yii\helpers\Html;


class RangeInputWidget extends Widget
{
    public $model;
    public $attributeFrom;
    public $attributeTo;
    public $htmlOptions = [];

    protected function hasModel()
    {
        return $this->model instanceof Model && $this->attributeFrom !== null && $this->attributeTo !== null;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function run()
    {
        if (!$this->hasModel()) {
            throw new \Exception('Model must be set');
        }

        return Html::activeTextInput($this->model, $this->attributeFrom, $this->htmlOptions) .
            ' &rarr; ' .
            Html::activeTextInput($this->model, $this->attributeTo, $this->htmlOptions);
    }
}