<?php

use yii\db\Migration;

/**
 * Handles the creation of table `name`.
 */
class m181112_180225_create_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('name', [
            'id' => $this->primaryKey(),
            'user' => $this->string(15)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('name');
    }
}
