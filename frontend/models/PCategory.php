<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "p_category".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 *
 * @property PCategory $parent
 * @property PCategory[] $pCategories
 * @property PProduct[] $pProducts
 */
class PCategory extends \yii\db\ActiveRecord
{
    public $products_count;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'p_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'products_count'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => PCategory::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(PCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPCategories()
    {
        return $this->hasMany(PCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPProducts()
    {
        return $this->hasMany(PProduct::className(), ['category_id' => 'id']);
    }
}
