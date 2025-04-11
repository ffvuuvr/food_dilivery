<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cafe}}`.
 */
class m250305_133118_create_cafe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cafe}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->string(),
            'desc' => $this->string(),
            'phone' => $this->string(),
            'address' => $this->string(),
            'image' => $this->string(256),
            'rate' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cafe}}');
    }
}
