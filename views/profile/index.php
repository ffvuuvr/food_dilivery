<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $orders app\models\Order[] */

$this->title = 'Профиль';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Мои заказы. Просмотр и управление вашими заказами.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'профиль, мои заказы, история заказов, отменить заказ',
]);
?>
<style>

    .order-card {
        border: 1px solid rgba(255, 198, 22, 0.5);
        border-radius: 10px;
        transition: transform 0.6s;
        margin-bottom: 20px;
    }

    .order-card:hover {
        transform: scale(1.02);
    }

    .order-header {
        background-color: rgba(255, 198, 22, 0.75);
        color: #000000;
        font-weight: bold;
        text-align: center;
        padding: 15px;
    }

    .order-body {
        background-color: white;
        color: #333;
        padding: 20px;
    }


</style>
<div class="container mt-5">
    <h2 class="mb-4">Мои заказы</h2>

    <?php if (empty($orders)): ?>
        <div class="alert alert-warning">У вас нет активных заказов.</div>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card order-card">
                <div class="card-header order-header">
                    Заказ #<?= Html::encode($order->id) ?>
                </div>
                <div class="card-body order-body">
                    <p><strong>Статус:</strong> <?= Html::encode($order->getStatus()) ?></p>
                    <p><strong>Общая стоимость:</strong> <?= Html::encode($order->total_price) ?> ₽</p>
                    <p><strong>Адрес:</strong> <?= Html::encode($order->address) ?></p>
                    <p><strong>Дата оформления:</strong> <?= Yii::$app->formatter->asDatetime($order->created_at, 'php:d.m.Y | H:i') ?></p>
                    <form action="<?= yii\helpers\Url::to(['order/cancel', 'id' => $order->id]) ?>" method="post">
                        <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <button type="submit" class="cafe-button">Отменить заказ</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
