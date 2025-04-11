<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Изменение статуса заказа: ' . $order->id;
$this->registerMetaTag(['name' => 'description', 'content' => 'Измените статус заказа с ID: ' . $order->id]);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'изменение статуса, заказ, управление заказами']);
?>
<div class="change-status">
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="order-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($order, 'status')->dropDownList([
            '0' => 'В обработке',
            '1' => 'Завершен',
            '2' => 'Отменен',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'cafe-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div></div>
