<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "p_product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $content
 * @property int $price
 * @property int $active
 *
 * @property AttributeValue[] $attributeValues
 * @property Attribute[] $attributes0
 * @property PCategory $category
 * @property ProductTag[] $productTags
 * @property Tag[] $tags
 */
class PProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'p_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'price', 'active'], 'integer'],
            [['name', 'price'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'content' => 'Content',
            'price' => 'Price',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('attribute_value', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('product_tag', ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\query\PProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\query\PProductQuery(get_called_class());
    }
}
