<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190120_065505_create_category_and_product_tables
 */
class m190120_065505_create_category_and_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable('product', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'sub_category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('category', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_product_category_id', 'product', 'category_id', 'category', 'id');
        $this->addForeignKey('fk_product_sub_category_id', 'product', 'category_id', 'category', 'id');

        $this->batchInsert('category', ['id', 'title'], [
            [1, 'Tv, Audio/video'],
            [2, 'Photo'],
            [3, 'Video']
        ]);

        $this->batchInsert('category', ['category_id', 'title'], [
            [1, 'TV'],
            [1, 'Acoustic system'],
            [2, 'Cameras'],
            [2, 'Flashes and lenses'],
            [3, 'Video cams'],
            [3, 'Action cams'],
            [3, 'Accessories'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
        $this->dropTable('category');
    }

}
