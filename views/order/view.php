<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $order */

$this->title = 'Заказ #' . $order->id;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Информация о заказе #' . Html::encode($order->id) . '. Адрес доставки: ' . Html::encode($order->address) . ', статус: ' . Html::encode($order->getStatus()) . ', итоговая цена: ' . Html::encode($order->total_price) . ' ₽',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'заказ, номер заказа, статус заказа, адрес доставки, итоговая цена, ' . Html::encode($order->id),
]);

?>

<div class="container mt-4" style="width: 70%">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Адрес доставки:</strong> <?= Html::encode($order->address) ?></p>
            <p class="card-text"><strong>Статус заказа:</strong> <?= Html::encode($order->getStatus()) ?></p>
            <p class="card-text"><strong>Итоговая цена:</strong> <?= Html::encode($order->total_price) ?> ₽</p>
            <p class="card-text"><strong>Дата оформления:</strong> <?= Html::encode($order->created_at) ?></p>
        </div>
    </div>
</div>
