<?php

namespace app\controllers;

use app\models\Food;
use app\models\Cart;  // Add this line!
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class FoodController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $model = Food::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('Такое блюдо не найдено.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionAddToCart() {
        $foodId = Yii::$app->request->post('id');

        if ($foodId) {
            $foodId = (int)$foodId;
            $userId = Yii::$app->user->id;

            $cartItem = Cart::findOne(['user_id' => $userId, 'food_id' => $foodId]);

            if ($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new Cart();
                $cartItem->user_id = $userId;
                $cartItem->food_id = $foodId;
                $cartItem->quantity = 1;
            }

            if ($cartItem->save()) {
                Yii::$app->session->setFlash('warning', 'Товар добавлен в корзину.');
                return $this->redirect(['cart/view']);
            } else {
                Yii::error("Failed to save cart item: " . var_export($cartItem->errors, true), __METHOD__);
                Yii::$app->session->setFlash('error', 'Не удалось добавить товар в корзину.');
                return $this->redirect(['food/view', 'id' => $foodId]);
            }
        }

        throw new BadRequestHttpException('Некорректный запрос.');
    }
}