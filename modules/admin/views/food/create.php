<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Food $model */

$this->title = Yii::t('app', 'Добавить блюдо');
?>
<div class="food-create">
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
