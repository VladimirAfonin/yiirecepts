<?php

use yii\db\Migration;

/**
 * Handles the creation of table `film`.
 */
class m190123_140250_create_film_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('film', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64)->notNull(),
            'release_year' => $this->integer(4)->notNull()
        ]);

        $this->batchInsert('film', ['id', 'title', 'release_year'], [
            [1, 'Interstellar', 2014],
            [2, 'Harry Potter', 2001],
            [3, 'Back to the future', 1985],
            [4, 'Blade runner', 1982],
            [5, 'Dallas club', 2013],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('film');
    }
}
