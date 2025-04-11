<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cart[] $cartItems */
/** @var app\models\OrderForm $model */

$this->title = 'Оформление заказа';


$this->registerMetaTag(['name' => 'description', 'content' => 'Оформление заказа в кафе']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'заказ, кафе, доставка, оформление заказа']);
?>

<div class="checkout-container container mt-4" style="width: 70%;">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php if ((empty($cartItems) && !Yii::$app->session->has('comboOrder'))): ?>
        <p class="text-center">Ваша корзина пуста.</p>
    <?php else: ?>

        <?php $form = ActiveForm::begin(['action' => ['cart/place-order'], 'method' => 'post']); ?>
        <div class="form-group">
            <label for="address">Введите адрес доставки:</label>
            <?= $form->field($model, 'address')->textInput(['id' => 'address', 'class' => 'form-control'])->label(false) ?>
        </div>

        <div>
            <h3 class="mt-4">Ваш заказ:</h3>
            <ul class="list-group">
                <?php
                $hasCombo = false;
                if (Yii::$app->session->has('comboOrder')) {
                    $comboOrderData = Yii::$app->session->get('comboOrder');
                    if ($comboOrderData) {
                        $foodIds = json_decode($comboOrderData['food_ids'], true);
                        $comboName = "Комбо-меню (";
                        if (is_array($foodIds)) {
                            $foods = appmodelsFood::find()->where(['id' => $foodIds])->all();

                            $foodNames = [];
                            foreach ($foods as $food) {
                                $foodNames[] = Html::encode($food->name);
                            }
                            $comboName .= implode(", ", $foodNames) . ")";
                        } else {
                            $comboName .= "Неизвестные продукты)";
                        }

                        echo '<li class="list-group-item">';
                        echo Html::encode($comboName) . ' - 1 шт.';
                        echo '</li>';
                        $hasCombo = true;
                    }
                }

                if (!empty($cartItems)) {
                    foreach ($cartItems as $item) {
                        echo '<li class="list-group-item">';
                        echo Html::encode($item->food->name) . ' - ' . Html::encode($item->quantity) . ' шт.';
                        if ($item->food->image) {
                            echo Html::img("@web/uploads/food/" . $item->food->image, [
                                'alt' => Html::encode($item->food->name),
                                'class' => 'food-image-class'
                            ]);
                        }
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>

        <div class="form-group mt-4">
            <?= Html::submitButton('Оформить заказ', ['class' => 'cafe-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>

