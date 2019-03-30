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
    private $_tagsArray;

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
            [['tagsArray'], 'safe'],
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

    /**
     * getter for virtual property tags
     *
     * @return array
     */
    public function getTagsArray()
    {
        if ($this->_tagsArray === null) {
            $this->_tagsArray = $this->getTags()->select('id')->column();
        }
        return $this->_tagsArray;
    }

    /**
     * @param $value
     */
    public function setTagsArray($value)
    {
        $this->_tagsArray = (array)$value;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->updateTags();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * logic for tags [slowly]
     */
    /*public function updateTags()
    {
        $currentTagIds = $this->getTags()->select('id')->column();
        $newTagIds = $this->getTagsArray();

        foreach (array_filter(array_diff($newTagIds, $currentTagIds)) as $tagId) {
            if ($tag = Tag::findOne($tagId)) {
                $this->link('tags', $tag);
            }
        }

        foreach (array_filter(array_diff($currentTagIds, $newTagIds)) as $tagId) {
            if ($tag = Tag::findOne($tagId)) {
                $this->unlink('tags', $tag, true);
            }
        }
    }*/

    /**
     * [faster]
     * @throws \yii\db\Exception
     */
    public function updateTags()
    {
        $currentTagIds = $this->getTags()->select('id')->column();
        $newTagIds = $this->getTagsArray();

        $toInsert = [];
        foreach (array_filter(array_diff($newTagIds, $currentTagIds)) as $tagId) {
            $toInsert[] = ['product_id' => $this->id, 'tag_id' => $tagId];
        }

        if ($toInsert) {
            ProductTag::getDb()
                ->createCommand()
                ->batchInsert(ProductTag::tableName(), ['product_id', 'tag_id'], $toInsert)
                ->execute();
        }

        if ($toRemove = array_filter(array_diff($currentTagIds, $newTagIds))) {
            ProductTag::deleteAll(['product_id' => $this->id, 'tag_id' => $toRemove]);
        }
    }
}
