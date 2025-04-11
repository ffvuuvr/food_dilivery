<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250303_083043_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'phone' => $this->string(),
            'password' => $this->string(),
            'authKey' => $this->string(256),
            'is_admin' => $this->boolean()->defaultValue(0),
            'is_courier' => $this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
