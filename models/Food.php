<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $desc
 * @property string|null $image
 * @property string|null $type
 * @property int|null $price
 * @property int|null $cafe_id
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'cafe_id'], 'integer'],
            [['name', 'desc', 'type'], 'string', 'max' => 255],
            ['image', 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'desc' => Yii::t('app', 'Состав'),
            'image' => Yii::t('app', 'Изображение'),
            'price' => Yii::t('app', 'Цена'),
            'cafe_id' => Yii::t('app', 'Кафе'),
            'type' => Yii::t('app', 'Тип'),
        ];
    }

    public function getTypeName()
    {
        $types = [
            'main' => 'Основное блюдо',
            'side' => 'Гарнир',
            'drink' => 'Напиток',
        ];

        if (isset($types[$this->type])) {
            return $types[$this->type];
        } else {
            Yii::error("Неизвестный тип: " . $this->type);
            return $this->type;
        }
    }
    public function getFoodTypes()
    {
        return [
            'main' => 'Основное блюдо',
            'side' => 'Гарнир',
            'drink' => 'Напиток',
        ];
    }


}
