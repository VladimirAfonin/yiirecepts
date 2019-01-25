<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_allowance".
 *
 * @property int $user_id
 * @property int $allowed_number_requests
 * @property int $last_check_time
 */
class UserAllowance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_allowance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['allowed_number_requests', 'last_check_time'], 'required'],
            [['allowed_number_requests', 'last_check_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'allowed_number_requests' => 'Allowed Number Requests',
            'last_check_time' => 'Last Check Time',
        ];
    }
}
