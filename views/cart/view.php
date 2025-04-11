<?php

use yii\helpers\Html;

$this->title = 'Корзина';

$this->registerMetaTag(['name' => 'description', 'content' => 'Просмотр вашей корзины покупок перед оформлением заказа.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'корзина, покупки, оформление заказа, еда']);
?>


<style>
    .cart-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 20px auto;
    }

    .cart-title {
        color: #343a40;
        font-size: 2.5em;
        text-align: center;
        margin-bottom: 20px;
    }

    .cart-card {
        margin-bottom: 20px;
        border: 1px solid rgba(255, 198, 22, 0.75);
        border-radius: 10px;
        padding: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .cart-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .cart-actions {
        width: 100%;
        justify-content: space-between;
        margin-top: 10px;
    }


    .cart-price {
        font-size: 1.2em;
        margin-top: 7px;
        color: #495057;
    }

.cart-card-title {
        flex-grow: 1;
        font-size: 1.5em;
        color: #495057;
    }

    .cart-actions {
        display: flex;
        align-items: center;
    }

    .cart-button {
        background-color: rgba(255, 198, 22, 0.75);
        color: #f18e85;
        border: none;
        margin: 0 7px;
        padding: 3px 12px;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .cart-button:hover {
        background-color: rgba(255, 198, 22, 0.5);
    }

    .empty-cart-message {
        text-align: center;
        color: #dc3545;
        font-size: 1.2em;
        margin-top: 20px;
    }

    .total-price {
        text-align: right;
        font-size: 1.5em;
        margin-top: 20px;
        color: #343a40;
    }

     .cart-card-img {
         width: 80px;
         height: 80px;
         object-fit: cover;
         border-radius: 5px;
         margin-right: 10px;
     }

    @media (max-width: 768px) {
        .cart-card {
            flex-direction: column;
        }

        .cart-card-title {
            font-size: 1.5em;
        }

        .cart-button {
            padding: 10px;
            font-size: 1.2em;
            flex: 1;
        }
    }

    @media (max-width: 480px) {
        .cart-button {
            padding: 8px;
            font-size: 1em;
        }

        .cart-title {
            font-size: 1.5em;
        }
        .checkout-button {
            margin-top: 4vh;
        }
</style>

<div class="cart-container">
    <h1 class="cart-title mb-4"><?= Html::encode($this->title) ?></h1>
    <?php if (empty($cartItems)): ?>
        <p class="empty-cart-message">Ваша корзина пуста.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($cartItems as $item): ?>
                <div class="col-md-6">
                    <div class="cart-card">
                        <div class="cart-actions">
                            <?= Html::img("@web/uploads/food/".$item->food->image, [
                                'class'=> 'cart-card-img',
                                'alt' => Html::encode($item->food->name)
                            ]) ?>
                            <div class="cart-card-title" style="margin-right: 4px;">
                                <?= Html::encode($item->food->name) ?>
                            </div>
                            <?= Html::beginForm(['cart/update-quantity', 'id' => $item->id], 'post') ?>
                            <button type="submit" name="action" value="decrease" class="cart-button">-</button>
                            <?= Html::encode($item->quantity) ?>
                            <button type="submit" name="action" value="increase" class="cart-button">+</button>
                            <?= Html::endForm() ?>
                        </div>
                        <div class="cart-price">
                            <?= Html::encode($item->food->price * $item->quantity) ?> ₽
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="total-price mt-3">
            Общая сумма: <?= Html::encode(array_sum(array_map(function($item) {
                return $item->food->price * $item->quantity;
            }, $cartItems))) ?> ₽
        </div>
        <div class="checkout-button">
            <?= Html::a('Оформить заказ', ['cart/checkout'], ['class' => 'cafe-button']) ?>
        </div>
    <?php endif; ?>
</div>