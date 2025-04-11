<?php
namespace app\controllers;

use app\models\Order;
use Yii;
use app\models\ComboMenu;
use app\models\Food;
use yii\web\Controller;

class ComboMenuController extends Controller
{
    public function actionCreate($cafeId)
    {
        $model = new ComboMenu();
        $model->cafe_id = $cafeId;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $foodIds = [$model->main_dish_id, $model->side_dish_id, $model->drink_id];

            $totalPrice = 0;
            foreach ($foodIds as $foodId) {
                $food = Food::findOne($foodId);
                if ($food) {
                    $totalPrice += $food->price;
                } else {
                    Yii::error("Блюдо с ID $foodId не найдено.", 'application');
                    Yii::$app->session->setFlash('error', 'Ошибка: Один из выбранных продуктов не найден.');
                    return $this->redirect(['combo-menu/create', 'cafeId' => $cafeId]);
                }
            }

            $userId = Yii::$app->user->id;
            if (!$userId) {
                Yii::$app->session->setFlash('error', 'Пожалуйста, войдите в систему, чтобы сделать заказ.');
                return $this->redirect(['site/login']);
            }

            $orderData = [
                'user_id' => $userId,
                'total_price' => $totalPrice,
                'status' => Order::STATUS_PENDING,
                'food_ids' => json_encode($foodIds),
            ];

            Yii::$app->session->set('comboOrder', $orderData);
            Yii::$app->session->setFlash('warning', 'Комбо-меню добавлено в корзину.');
            return $this->redirect(['cart/checkout']);
        }

        $mainDishes = Food::find()->where(['type' => 'main', 'cafe_id' => $cafeId])->all();
        $sideDishes = Food::find()->where(['type' => 'side', 'cafe_id' => $cafeId])->all();
        $drinks = Food::find()->where(['type' => 'drink', 'cafe_id' => $cafeId])->all();

        return $this->render('create', [
            'model' => $model,
            'mainDishes' => $mainDishes,
            'sideDishes' => $sideDishes,
            'drinks' => $drinks,
        ]);
    }
}