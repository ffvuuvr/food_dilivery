<?php

use app\models\Cafe;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CafeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Список ресторанов');
?>

<div class="container">
<div class="cafe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="mt-4" style="margin-bottom: 2vh;">
        <?= Html::a(Yii::t('app', 'Добавить ресторан'), ['create'], ['class' => 'cafe-button']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'type',
            'desc',
            'phone',
            'address',
            'image',
            'rate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cafe $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
</div></div>


