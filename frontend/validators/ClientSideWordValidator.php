<?php

namespace frontend\validators;

use yii\validators\Validator;

class ClientSideWordValidator extends Validator
{
    public $size = 10;
    public $message = 'The number of words  must be less than {size}';
    public $clientMessage = 'ClientSide: The number or words must be less than {size}';

    /**
     * @param mixed $value
     * @return array|null
     */
    public function validateValue($value)
    {
        preg_match_all('#(\w+)#i', $value, $matches);
        if (count($matches[0]) > $this->size) {
            return [$this->message, ['size' => $this->size]];
        }
    }

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     * @param \yii\web\View $view
     * @return null|string
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $clientMessage = strtr($this->clientMessage, ['{size}' => $this->size]);

        return <<<JS
            if(value.split(/\w+/gi).length > $this->size) {
                messages.push("$clientMessage");
            }
JS;
    }
}