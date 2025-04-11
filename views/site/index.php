<?php

/** @var yii\web\View $this */
/* @var $foods app\models\Food[] */

use yii\helpers\Html;

$this->title = 'FoodDelivery';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Закажите вкусную еду с доставкой прямо сейчас! Широкий выбор блюд на любой вкус.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'доставка еды, заказать еду, онлайн заказ, ресторан, меню, еда на дом',
]);

$cafes = \app\models\Cafe::find()->limit(3)->all();
?>
<main class="main">
    <div class="container">
        <section class="promo">
            <h1 class="promo-title">Онлайн-сервис<br>доставки еды на дом</h1>
            <p class="promo-text">
                Ваша любимая еда на расстоянии одного клика! Еда, которая приходит к вам
            </p>
        </section>

        <section class="restaurantas">
            <div class="section-heading">
                <h2 class="section-title">Рестораны</h2>
            </div>
            <div class="row mt-5">
                <?php if (!empty($cafes)): foreach ($cafes as $cafe): ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="<?= \yii\helpers\Url::to(['cafe/view', 'id' => $cafe->id]) ?>" class="card h-100">
                            <div class="card-img-wrapper">
                                <div class="card-hover-overlay"></div>
                                <?= Html::img("@web/uploads/cafe/".$cafe->image, ['class'=> 'card-img-top']) ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="card-heading d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><?= \yii\helpers\Html::encode($cafe->name) ?></h3>
                                    <span class="card-tag tag"> <?= \yii\helpers\Html::encode($cafe->type) ?></span>
                                </div>
                                <div class="card-info d-flex justify-content-between align-items-center mt-auto text-center">
                                    <div class="raiting">
                                        <span class="raiting-star">🟊 <?= $cafe->rate ?></span>
                                    </div>
                                    <div class="price">
                                        <span class="phone-icon">&#9742;</span> <?= $cafe->phone ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; else: ?>
                    <p>Рестораны не найдены.</p>
                <?php endif; ?>
            </div>
            <h2 class="mt-4">Новинки</h2>
            <div class="row mt-5">
                <?php foreach ($foods as $food): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?= Yii::getAlias('@web/uploads/food/' . $food->image) ?>" class="card-img-top" alt="<?= Html::encode($food->name) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= Html::encode($food->name) ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="mt-4 text-center">
                <?= Html::a('Попробуй новое', ['site/random-food'], ['class' => 'new-button']) ?>
            </p>
        </section>
    </div>
</main>
