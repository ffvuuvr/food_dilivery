<?php
namespace app\controllers;

use app\models\Order;
use app\models\User;
use Yii;
use yii\web\Controller;


class ProfileController extends Controller
{
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;
        $user = User::findOne($userId);

        $orders = Order::find()
            ->where(['user_id' => $userId])
            ->andWhere(['!=', 'status', Order::STATUS_CANCELED])
            ->all();

        return $this->render('index', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }


    public function actionEdit()
    {
        $userId = Yii::$app->user->id;
        $user = User::findOne($userId);

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'user' => $user,
        ]);
    }


}
