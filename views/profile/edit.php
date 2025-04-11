<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = 'Редактировать профиль';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput() ?>
    <?= $form->field($user, 'name')->textInput() ?>
    <?= $form->field($user, 'surname')->textInput() ?>
    <?= $form->field($user, 'phone')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '+7(999)-999-99-99',
    ]) ?>
    <?= $form->field($user, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
