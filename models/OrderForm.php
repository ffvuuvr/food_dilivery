<?php
namespace app\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
    public $address;

    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'Пользователь'),
            'total_price' => Yii::t('app', 'Общая стоимость'),
            'address' => Yii::t('app', 'Адрес'),
        ];
    }
}