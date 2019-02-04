<?php

namespace frontend\models;

use shop\entities\Order;
use yii\redis\ActiveRecord;

class CustomerRedis extends ActiveRecord
{
    public function attributes()
    {
        return ['id', 'name', 'address', 'registration_date'];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }
}