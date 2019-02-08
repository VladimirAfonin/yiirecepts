<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $amount
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'required'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/account', 'ID'),
            'amount' => Yii::t('app/account', 'Amount'),
        ];
    }
}
