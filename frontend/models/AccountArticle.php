<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "account_article".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 */
class AccountArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/account', 'ID'),
            'title' => Yii::t('app/account', 'Title'),
            'text' => Yii::t('app/account', 'Text'),
        ];
    }
}
