<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class CafeForm extends Model
{
    public $name;
    public $type;
    public $desc;
    public $phone;
    public $address;
    public $image;
    public $rate;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'type', 'desc', 'phone', 'address', 'rate'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => false],
            ['image', 'safe'],
        ];
    }
    public function saveCafe()
    {
        if ($this->validate()) {
            if ($this->image) {
                $imagePath = 'uploads/cafe/' . $this->image->baseName . '.' . $this->image->extension;
                if ($this->image->saveAs($imagePath)) {
                    $this->image = $this->image->baseName . '.' . $this->image->extension;
                } else {
                    Yii::error('Ошибка при сохранении изображения');
                    return false;
                }
            }

            $cafe = new Cafe();
            $cafe->name = $this->name;
            $cafe->type = $this->type;
            $cafe->desc = $this->desc;
            $cafe->phone = $this->phone;
            $cafe->address = $this->address;
            if (isset($this->image)) {
                $cafe->image = $this->image;
            }
            $cafe->rate = $this->rate;

            if ($cafe->save()) {
                return true;
            } else {
                Yii::error('Ошибка при сохранении в базу данных: ' . json_encode($cafe->getErrors()));
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
            'type' => Yii::t('app', 'Тип'),
            'desc' => Yii::t('app', 'Описание'),
            'phone' => Yii::t('app', 'Номер телефона'),
            'address' => Yii::t('app', 'Адрес'),
            'image' => Yii::t('app', 'Изображение'),
            'rate' => Yii::t('app', 'Рейтинг'),
        ];
    }
}
