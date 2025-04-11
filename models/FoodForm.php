<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * FoodForm is the model behind the food creation form.
 */
class FoodForm extends Model
{
    public $name;
    public $desc;
    public $price;
    public $image;
    public $cafe_id;
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'desc', 'cafe_id', 'type'], 'string', 'max' => 255],
            [['price'], 'integer'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => false],
            ['image', 'safe'],
        ];
    }

    public function saveFood()
    {
        if ($this->validate()) {
            if ($this->image) {
                $imagePath = 'uploads/food/' . $this->image->baseName . '.' . $this->image->extension;
                if ($this->image->saveAs($imagePath)) {
                    $this->image = $this->image->baseName . '.' . $this->image->extension;
                } else {
                    Yii::error('Ошибка при сохранении изображения');
                    return false;
                }
            }

            $food = new Food();
            $food->name = $this->name;
            $food->desc = $this->desc;
            $food->price = $this->price;
            $food->type = $this->type;
            $food->cafe_id = $this->cafe_id;
            if (isset($this->image)) {
                $food->image = $this->image;
            }

            if ($food->save()) {
                return true;
            } else {
                Yii::error('Ошибка при сохранении в базу данных: ' . json_encode($food->getErrors()));
                return false;
            }
        }

        Yii::error('Ошибки валидации: ' . json_encode($this->getErrors()));
        return false;
    }

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
    public function getFoodTypes()
    {
        return [
            'main' => 'Основное блюдо',
            'side' => 'Гарнир',
            'drink' => 'Напиток',
        ];
    }
}