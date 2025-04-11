<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header" class="custom-header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo1.png', ['alt' => Yii::$app->name, 'class' => 'navbar-brand-img']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            ['label' => 'Рестораны', 'url' => ['/cafe/index']],
            ['label' => 'Регистрация', 'url' => ['/site/register'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Админ-панель', 'url' => ['/admin/default/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin == 1],
            ['label' => 'Для курьера', 'url' => ['/courier/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_courier == 1],

            [
                'label' => 'Профиль',
                'items' => [
                    ['label' => 'Мой профиль', 'url' => ['/profile/index']],
                    [
                        'label' => 'Выйти',
                        'url' => ['/site/logout'],
                        'linkOptions' => [
                            'data-method' => 'post',
                        ],
                    ],
                ],
                'visible' => !Yii::$app->user->isGuest,
            ],

            [
                'label' => '<img class="cart-icon" src="' . Yii::$app->request->baseUrl . '/img/cart.png" alt="Корзина" style="height: 31px; width: 31px; margin-top:-8px;">',
                'url' => ['/cart/view'],
                'visible' => !Yii::$app->user->isGuest,
                'encode' => false
            ],

            Yii::$app->user->isGuest
                ? ['label' => 'Войти', 'url' => ['/site/login']]
                : ''
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 ">

        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/img/logo1.png', ['alt'=>Yii::$app->name, 'class'=>'navbar-brand-img']),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto', 'style'=>'color:black;'],
            'items' => [
                ['label' => 'Рестораны', 'url' => ['/cafe/index']],
                ['label' => 'Регистрация', 'url' => ['/site/register'], 'visible'=>Yii::$app->user->isGuest],
                ['label' => 'Админ-панель', 'url' => ['/admin/default/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin == 1],
                ['label' => 'Для курьера', 'url' => ['/courier/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_courier == 1],
                ['label' => 'Профиль', 'url' => ['/profile/index'], 'visible'=>!Yii::$app->user->isGuest],
            ]
        ]);
        NavBar::end();
        ?>

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

