<?php
namespace app\controllers;

use app\models\Order;
use app\models\OrderForm;
use Yii;
use yii\web\Controller;
use app\models\Cart;

class CartController extends Controller
{
    public function actionAdd($foodId)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;
        Cart::addToCart($foodId, $userId);

        return $this->redirect(['cart/view']);
    }

    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;
        $cartItems = Cart::find()->where(['user_id' => $userId])->with('food')->all();

        return $this->render('view', ['cartItems' => $cartItems]);
    }

    public function actionRemove($id)
    {
        $cartItem = Cart::findOne($id);
        if ($cartItem && $cartItem->user_id == Yii::$app->user->id) {
            $cartItem->delete();
        }
        return $this->redirect(['cart/view']);
    }

    public function actionUpdateQuantity($id)
    {
        $cartItem = Cart::findOne($id);
        if ($cartItem && $cartItem->user_id == Yii::$app->user->id) {
            if (Yii::$app->request->post('action') === 'increase') {
                $cartItem->quantity += 1;
            } elseif (Yii::$app->request->post('action') === 'decrease') {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                } else {
                    $cartItem->delete();
                    return $this->redirect(['cart/view']);
                }
            }
            $cartItem->save();
        }
        return $this->redirect(['cart/view']);
    }

    public function actionCheckout()
    {
        $model = new OrderForm();

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $userId = Yii::$app->user->id;
        $cartItems = Cart::find()->where(['user_id' => $userId])->with('food')->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $totalPrice = array_reduce($cartItems, function ($carry, $item) {
                return $carry + ($item->food->price * $item->quantity);
            }, 0);

            $order = Order::createOrder($userId, $model->address, $totalPrice);

            if ($order) {
                Cart::deleteAll(['user_id' => $userId]);

                return $this->redirect(['profile/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при оформлении заказа.');
            }
        }

        return $this->render('checkout', [
            'model' => $model,
            'cartItems' => $cartItems,
        ]);
    }


    public function actionPlaceOrder()
    {
        $model = new OrderForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if (Yii::$app->session->has('comboOrder')) {
                $comboOrderData = Yii::$app->session->get('comboOrder');
            }

            if ($model->validate()) {
                $order = new Order();
                $order->attributes = $comboOrderData;
                $order->address = $model->address;
                $order->scenario = Order::SCENARIO_DEFAULT;

                if ($order->save()) {
                    Yii::$app->session->remove('comboOrder');
                    Yii::$app->session->setFlash('warning', 'Заказ оформлен!');
                    return $this->redirect(['profile/index']);
                } else {

                }
            } else {
                return $this->redirect(['cart/checkout']);
            }
        }
    }
}