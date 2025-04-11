<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComboMenu */
/* @var $form yii\widgets\ActiveForm */

$this->registerMetaTag(['name' => 'description', 'content' => 'Создайте собственное комбо-меню, выбрав основное блюдо, гарнир и напиток.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'комбо-меню, основное блюдо, гарнир, напиток, заказ еды']);
?>

<div class="combo-menu-create">
    <div class="container">

        <h1>Создать комбо-меню</h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'main_dish_id')->dropDownList(
            yii\helpers\ArrayHelper::map($mainDishes, 'id', 'name'),
            ['prompt' => 'Выберите основное блюдо']
        ) ?>

        <?= $form->field($model, 'side_dish_id')->dropDownList(
            yii\helpers\ArrayHelper::map($sideDishes, 'id', 'name'),
            ['prompt' => 'Выберите гарнир', 'options' => [null => ['disabled' => true]]]
        ) ?>

        <?= $form->field($model, 'drink_id')->dropDownList(
            yii\helpers\ArrayHelper::map($drinks, 'id', 'name'),
            ['prompt' => 'Выберите напиток', 'options' => [null => ['disabled' => true]]]
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Оформить заказ', ['class' => 'cafe-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
