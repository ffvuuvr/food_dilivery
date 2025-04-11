<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Food $model */

$this->title = $model->name;
$this->registerMetaTag(['name' => 'description', 'content' => Html::encode($model->desc)]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Html::encode($model->getTypeName() . ', ' . $model->name)]);
?>
<div class="container food-view">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <div class="row mt-5 align-items-center">
        <div class="col-md-6 d-flex justify-content-center">
            <img src="<?= Yii::getAlias('@web/uploads/food/' . $model->image) ?>"
                 class="img-fluid rounded"
                 alt="<?= Html::encode($model->name) ?>"
                 style="max-width: 100%; height: auto; max-height: 300px; object-fit: cover;">
        </div>
        <div class="col-md-6">
            <p><strong>Тип:</strong> <?= Html::encode($model->getTypeName()) ?></p>
            <p><strong>Описание:</strong> <?= Html::encode($model->desc) ?></p>
            <p><strong>Цена:</strong> <?= Html::encode($model->price) ?> ₽</p>
            <?php $form = ActiveForm::begin(['action' => ['food/add-to-cart'], 'method' => 'post']); ?>
            <?= Html::hiddenInput('id', $model->id) ?>
            <?= Html::submitButton('Добавить в корзину', ['class' => 'cafe-button btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>