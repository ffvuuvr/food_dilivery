<?php

namespace app\controllers;

use app\models\Cafe;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;

class CafeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Cafe::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $cafes = $query->orderBy('name')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('index', [
            'cafes' => $cafes,
            'pagination' => $pagination,
        ]);
    }


    public function actionView($id)
    {
        $cafe = Cafe::findOne($id);
        $context = [
            'cafe' => $cafe
        ];
        return $this->render('view', $context);
    }


}
