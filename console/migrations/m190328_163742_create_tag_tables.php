<?php

use yii\db\Migration;

/**
 * Class m190328_163742_create_tag_tables
 */
class m190328_163742_create_tag_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('product_tag', [
            'product_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-product_tag', 'product_tag', ['product_id', 'tag_id']);

        $this->addForeignKey('fk-product_tag-product', 'product_tag', 'product_id', 'p_product', 'id', 'CASCADE');
        $this->addForeignKey('fk-product_tag-tag', 'product_tag', 'tag_id', 'tag', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_tag');
        $this->dropTable('tag');
    }
}
