<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['title', 'category_id', 'sub_category_id'], 'required'],
            [['category_id'], 'exist', 'targetAttribute' => 'id', 'targetClass' => 'frontend\models\Category'],
            [['sub_category_id'], 'exist', 'targetAttribute' => 'id', 'targetClass' => 'frontend\models\Category'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'category_id' => 'Category',
            'sub_category_id' => 'Sub category',
        ];
    }
}