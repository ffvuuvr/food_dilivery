<?php
use yii\helpers\Html;

$this->title = 'Мои заказы';
$this->registerMetaTag(['name' => 'description', 'content' => 'Список моих заказов. Просмотр и управление статусами заказов.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'заказы, мои заказы, управление заказами']);
?>
<div class="courier-index">
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th>Номер заказа</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= Html::encode($order->id) ?></td>
                <td><?= Html::encode($order->getStatus()) ?></td>
                <td>
                    <?= Html::a('Изменить статус', ['change-status', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<style>
    .btn-primary{
        background-color: rgb(241, 142, 133);
        color: white;
        border: none;
    }
    .btn-primary:hover {
        background-color: rgba(255, 198, 22, 0.75);
    }
</style>