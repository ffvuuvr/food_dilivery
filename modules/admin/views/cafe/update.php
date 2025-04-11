<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cafe $model */

$this->title = Yii::t('app', 'Редактировать: {name}', [
    'name' => $model->name,
]);
?>
<div class="cafe-update">
    <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div></div>
