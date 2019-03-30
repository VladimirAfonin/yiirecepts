<?php

namespace frontend\models\query;

use frontend\models\PCategory;

/**
 * This is the ActiveQuery class for [[\frontend\models\PProduct]].
 *
 * @see \frontend\models\PProduct
 */
class PProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\PProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function forCategory($id)
    {
        $ids = [$id];
        $childrenIds = [$id];
        while ($childrenIds = PCategory::find()->select('id')->andWhere(['parent_id' => $childrenIds])->column()) {
            $ids = array_merge($ids, $childrenIds);
        }
        return $this->andWhere(['category_id' => array_unique($ids)]);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\PProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
