<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Просмотр блюд';

$this->registerMetaTag(['name' => 'description', 'content' => 'Просмотр блюд в кафе ' . Html::encode($cafe->name)]);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'кафе, блюда, добавление в корзину' . Html::encode($cafe->name)]);

$foods = app\models\Food::find()->where(['cafe_id' => $cafe->id])->all();
?>
<main class="main">
    <div class="container">
        <section class="cafe-section">
            <div class="cafe-section-heading">
                <h2 class="cafe-section-title"><?= Html::encode($cafe->name) ?></h2>
                <p class="cafe-section-text mt-3"><?= Html::encode($cafe->desc) ?></p>
                <div class="cafe-card-info">
                    <div class="cafe-raiting">
                        <span class="cafe-raiting-star">🟊 <?= $cafe->rate ?></span>
                    </div>
                    <div class="cafe-price p-4"><?= Html::encode($cafe->address) ?></div>
                    <div class="cafe-category"><?= Html::encode($cafe->type) ?></div>
                </div>
                <div class="form-group mt-3">
                    <?= Html::a('Создать комбо-меню', ['combo-menu/create', 'cafeId' => $cafe->id], ['class' => 'cafe-button']) ?>
                </div>
            </div>
            <div class="cafe-cards">
                <?php foreach ($foods as $food): ?>
                    <div class="cafe-card wow fadeInUp" data-wow-delay="0.2s">
                        <?= Html::img("@web/uploads/food/" . $food->image, [
                            'class'=> 'cafe-card-img',
                            'alt' => Html::encode($food->name . ' - ' . $food->desc)
                        ]) ?>
                        <div class="cafe-card-text">
                            <div class="cafe-card-heading">
                                <h3 class="cafe-card-title"><?= Html::encode($food->name) ?></h3>
                            </div>
                            <div class="cafe-card-info">
                                <div class="cafe-ingredients"><?= Html::encode($food->desc) ?></div>
                            </div>
                            <div class="cafe-card-buttons">
                                <?php
                                echo Html::beginForm(['cart/add', 'foodId' => $food->id], 'post'); ?>
                                <button type="submit" class="cafe-button">
                                    <span class="cafe-button-text">В корзину</span>
                                    <img src="" alt="" class="cafe-button-image">
                                </button>
                                <?php echo Html::endForm(); ?>
                                <strong class="cafe-card-price"><?= Html::encode($food->price) ?> ₽</strong>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>
