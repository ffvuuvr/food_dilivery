<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class ComboMenu extends ActiveRecord
{
    public $cafe_id;
    public $main_dish_id;
    public $side_dish_id;
    public $drink_id;

    public function rules()
    {
        return [
            [['cafe_id', 'main_dish_id', 'side_dish_id', 'drink_id'], 'required'],
            [['cafe_id', 'main_dish_id', 'side_dish_id', 'drink_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cafe_id' => 'Кафе',
            'main_dish_id' => 'Основное блюдо',
            'side_dish_id' => 'Гарнир',
            'drink_id' => 'Напиток',
        ];
    }
}