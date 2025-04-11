<?php
namespace app\controllers;

use Yii;
use app\models\Order;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class OrderController extends Controller
{
    public function actionView($id)
    {
        $order = Order::findOne($id);
        if ($order === null) {
            throw new NotFoundHttpException("Заказ не найден.");
        }

        return $this->render('view', [
            'order' => $order,
        ]);
    }
    public function actionCancel($id)
    {
        $order = Order::findOne($id);

        if ($order && $order->cancelOrder()) {
            Yii::$app->session->setFlash('warning', 'Заказ успешно отменен.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось отменить заказ.');
        }

        return $this->redirect(['profile/index']);
    }

}