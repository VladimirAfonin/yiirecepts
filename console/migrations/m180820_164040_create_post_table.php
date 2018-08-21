<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m180820_164040_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
        ], $tableOptions);

        // add data
        for ($i = 1; $i < 7; $i++) {
            $this->insert('{{%post}}', [
                'title' => 'Test article #' . $i,
                'content' => 'Lorem ipsum dolor sit amet, consecteur adipiscing',
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
