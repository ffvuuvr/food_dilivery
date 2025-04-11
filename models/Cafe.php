<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cafe".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property string|null $desc
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $image
 * @property string|null $rate
 */
class Cafe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cafe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'desc', 'phone', 'address', 'rate'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 256],
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
            'type' => Yii::t('app', 'Тип'),
            'desc' => Yii::t('app', 'Описание'),
            'phone' => Yii::t('app', 'Номер телефона'),
            'address' => Yii::t('app', 'Адрес'),
            'image' => Yii::t('app', 'Изображение'),
            'rate' => Yii::t('app', 'Рейтинг'),
        ];
    }
    public static function getCafeList()
    {
        return ArrayHelper::map(Cafe::find()->all(), 'id', 'name');
    }

}
