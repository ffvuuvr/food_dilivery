<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public static function tableName()
    {
        return 'cart';
    }

    public function rules()
    {
        return [
            [['food_id', 'user_id', 'quantity'], 'required'],
            [['food_id', 'user_id', 'quantity'], 'integer'],
            ['quantity', 'integer', 'min' => 1],
        ];
    }

    public function getFood()
    {
        return $this->hasOne(Food::class, ['id' => 'food_id']);
    }

    public static function addToCart($foodId, $userId)
    {
        // Метод find() теперь доступен
        $cartItem = self::find()->where(['food_id' => $foodId, 'user_id' => $userId])->one();

        if ($cartItem) {
            $cartItem->quantity += 1;
            return $cartItem->save();
        } else {
            $cartItem = new self();
            $cartItem->food_id = $foodId;
            $cartItem->user_id = $userId;
            $cartItem->quantity = 1;
            return $cartItem->save();
        }
    }


}