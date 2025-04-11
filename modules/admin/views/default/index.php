<?php
use yii\helpers\Html;

$this->title = 'Админ-панель';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Админ-панель. Панель администратора.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'админ, администратор, панель админа',
]);
?>
<div class="container">
    <h1 class="admin-title text-center"><?= Html::encode($this->title) ?></h1>

    <div class="admin-buttons">
        <?= Html::a('Управление ресторанами', ['cafe/index'], ['class' => 'cafe-button']) ?>
        <?= Html::a('Управление блюдами', ['food/index'], ['class' => 'cafe-button']) ?>
    </div>
</div>

<style>
    .admin-title {
        font-size: 2.5em;
        margin-bottom: 30px;
    }

    .admin-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .cafe-button {
        display: inline-block;

        font-size: 1.5em;
    }

    @media (max-width: 768px) {
        .admin-title {
            font-size: 2em;
        }

        .cafe-button {
            font-size: 1.2em;
            padding: 10px 20px;
        }
    }
</style>
