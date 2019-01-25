<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_allowance`.
 */
class m190125_064713_create_user_allowance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_allowance', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'allowed_number_requests' => $this->integer(10)->notNull(),
            'last_check_time' => $this->integer(10)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_allowance');
    }
}
