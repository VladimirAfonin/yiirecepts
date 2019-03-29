<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m190328_161210_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('p_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer(),
        ]);

        $this->createIndex('idx-category_parent_id', 'p_category', 'parent_id');
        $this->addForeignKey('fk-category-parent', 'p_category', 'parent_id', 'p_category', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('p_category');
    }
}
