<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m250306_135755_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'food_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->defaultValue(1),
        ]);

        $this->addForeignKey(
            'fk-cart-food_id',
            'cart',
            'food_id',
            'food',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cart-user_id',
            'cart',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-cart-food_id', 'cart');
        $this->dropForeignKey('fk-cart-user_id', 'cart');
        $this->dropTable('cart');
    }
}
