<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Food $model */

$this->title = $model->name;

\yii\web\YiiAsset::register($this);
?>
<div class="food-view">
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'cafe-button']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены что хотите удалить?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'desc',
            'image',
            'price',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return $model->getTypeName();
                },
            ],
            'cafe_id',
        ],
    ]) ?>



</div>
</div>
