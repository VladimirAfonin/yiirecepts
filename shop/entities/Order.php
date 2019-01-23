<?php

namespace shop\entities;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $client
 * @property double $total
 * @property resource $encrypted_field
 */
class Order extends \yii\db\ActiveRecord
{
    public $encrypted_field_temp;

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'encrypted_field',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'encrypted_field',
                ],
                'value' => function ($event) {
                    $event->sender->encrypted_field_temp = $event->sender->encrypted_field;
                    return \Yii::$app->security->encryptByKey($event->sender->encrypted_field, \Yii::$app->params['key']);
                },
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_INSERT => 'encrypted_field',
                    ActiveRecord::EVENT_AFTER_UPDATE => 'encrypted_field',
                ],
                'value' => function ($event) {
                    return $event->sender->encrypted_field_temp;
                },
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'encrypted_field',
                ],
                'value' => function ($event) {
                    return \Yii::$app->security->decryptByKey($event->sender->encrypted_field, \Yii::$app->params['key']);
                },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client', 'total', 'encrypted_field'], 'required'],
            [['total'], 'number'],
            [['encrypted_field'], 'string'],
            [['client'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client' => 'Client',
            'total' => 'Total',
            'encrypted_field' => 'Encrypted Field',
        ];
    }
}
