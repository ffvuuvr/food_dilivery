<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food}}`.
 */
class m250305_133445_create_food_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'desc'=> $this->string(),
            'image' => $this->string(256),
            'price' => $this->integer(),
            'cafe_id' => $this->integer(),
        ]);
        $this->addColumn('{{%food}}', 'type', "ENUM('main', 'side', 'drink') NOT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%food}}', 'type');
    }
}
