<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        if (Yii::$app->user->identity->is_admin != 1) {
            throw new ForbiddenHttpException('У вас нет доступа к этой странице.');
        }

        return true;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
