<?php

use app\models\Cafe;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Food $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="food-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput()?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(
        $model->getFoodTypes(),
        ['prompt' => 'Выберите тип']
    ) ?>


    <?= $form->field($model, 'cafe_id')->dropDownList(
        Cafe::getCafeList(),
        ['prompt' => 'Выберите кафе']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'cafe-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
