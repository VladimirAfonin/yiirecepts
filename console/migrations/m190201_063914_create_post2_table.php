<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post2`.
 */
class m190201_063914_create_post2_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post2', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content_markdown' => $this->text(),
            'content_html' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post2');
    }
}
