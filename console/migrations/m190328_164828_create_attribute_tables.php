<?php

use yii\db\Migration;

/**
 * Class m190328_164828_create_attribute_tables
 */
class m190328_164828_create_attribute_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attribute', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('attribute_value', [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
        ]);

        $this->addPrimaryKey('pk-attribute-value', 'attribute_value', ['product_id', 'attribute_id']);

        $this->addForeignKey('fk-value_product', 'attribute_value', 'product_id', 'p_product', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-value_attribute', 'attribute_value', 'attribute_id', 'attribute', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attribute_value');
        $this->dropTable('attribute');
    }
}
