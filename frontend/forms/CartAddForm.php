<?php

namespace frontend\forms;

use yii\base\Model;

class CartAddForm extends Model
{
    public $productId;
    public $amount;

    public function rules()
    {
        return [
            [['productId', 'amount'], 'required'],
            [['amount'], 'integer', 'min' => 1],
        ];
    }
}