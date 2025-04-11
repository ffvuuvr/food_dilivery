<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELED = 2;

    const SCENARIO_COMBO_CREATE = 'combo_create';
    const SCENARIO_DEFAULT = 'default';

    public $food_ids;

    public static function tableName()
    {
        return 'orders';
    }


    public function rules()
    {
        return [
            [['user_id', 'address', 'total_price'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['total_price'], 'number'],
            ['food_ids', 'safe'],
            [['address'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_PENDING],
        ];
    }

    public static function createOrder($userId, $address, $totalPrice)
    {
        $order = new Order();
        $order->user_id = $userId;
        $order->address = $address;
        $order->total_price = $totalPrice;
        $order->status = self::STATUS_PENDING;

        return $order->save() ? $order : null;
    }


    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'Пользователь'),
            'total_price' => Yii::t('app', 'Общая стоимость'),
            'address' => Yii::t('app', 'Адрес'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    public function getStatus()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'В обработке';
            case self::STATUS_COMPLETED:
                return 'Завершен';
            case self::STATUS_CANCELED:
                return 'Отменен';
            default:
                return 'Неизвестный статус';
        }
    }
    public function cancelOrder()
    {
        $this->status = self::STATUS_CANCELED;
        return $this->save();
    }
}
