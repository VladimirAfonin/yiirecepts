<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `examples`.
 */
class m190208_184346_create_examples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'amount' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL',
        ]);

        $this->createTable('account_article', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('account');
        $this->dropTable('account_article');
    }
}
