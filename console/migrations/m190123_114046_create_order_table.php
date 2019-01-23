<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m190123_114046_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'client' => $this->string()->notNull(),
            'total' => $this->float()->notNull(),
            'encrypted_field' => 'BLOB NOT NULL'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');
    }
}
