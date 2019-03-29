<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m190328_162131_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('p_product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'content' => $this->text(),
            'price' => $this->integer()->notNull(),
            'active' => $this->smallInteger(1)->notNull()->defaultValue(0),
        ]);

        $this->createIndex('idx-product-category_id', 'p_product', 'category_id');
        $this->createIndex('idx-product-active', 'p_product', 'active');

        $this->addForeignKey('fk-product-category', 'p_product', 'category_id', 'p_category', 'id', 'SET NULL', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('p_product');
    }
}
