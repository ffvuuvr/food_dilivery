<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\models\Order;

class CourierController extends Controller
{
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->is_courier != 1) {
            throw new NotFoundHttpException('Страница не найдена.');
        }


        $orders = Order::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('index', [
            'orders' => $orders,
        ]);
    }

    public function actionChangeStatus($id)
    {

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->is_courier != 1) {
            throw new NotFoundHttpException('Страница не найдена.');
        }

        $order = Order::findOne($id);
        if (!$order || $order->user_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('Заказ не найден.');
        }


        if ($order->load(Yii::$app->request->post()) && $order->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('change-status', [
            'order' => $order,
        ]);
    }
}
