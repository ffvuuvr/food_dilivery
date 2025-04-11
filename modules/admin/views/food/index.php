<?php

use app\models\Food;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FoodSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Блюда');
?>
<div class="food-index">
    <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="mt-4" style="margin-bottom: 2vh;">
        <?= Html::a(Yii::t('app', 'Добавить блюдо'), ['create'], ['class' => 'cafe-button']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'cafe_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Food $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div></div>
