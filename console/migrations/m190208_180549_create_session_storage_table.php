<?php

use yii\db\Migration;

/**
 * Handles the creation of table `session_storage`.
 */
class m190208_180549_create_session_storage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('session', [
            'id' => $this->primaryKey(),
            'expire' => $this->integer(),
            'data' => 'BLOB'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('session');
    }
}
