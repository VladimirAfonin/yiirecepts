<?php

namespace app\models;

use frontend\behaviors\MarkDownBehavior;
use Yii;

/**
 * This is the model class for table "post2".
 *
 * @property int $id
 * @property string $title
 * @property string $content_markdown
 * @property string $content_html
 */
class Post2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post2';
    }

    public function behaviors()
    {
        return [
            'markdown' => [
                'class' => MarkDownBehavior::class,
                'sourceAttribute' => 'content_markdown',
                'targetAttribute' => 'content_html',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content_markdown', 'content_html'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content_markdown' => 'Content Markdown',
            'content_html' => 'Content Html',
        ];
    }
}
