<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m250306_144618_create_orders_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'address' => $this->string()->notNull(),
            'total_price' => $this->decimal(10, 2)->notNull(),
            'status' => $this->integer()->notNull()->defaultValue('0'),
            'food_ids' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-orders-user_id',
            'orders',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-orders-user_id', 'orders');
        $this->dropTable('orders');
    }
}
