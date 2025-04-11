<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\RegisterForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Зарегистрируйте новый аккаунт.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'регистрация, создать аккаунт, новый пользователь',
]);

?>

<style>
    .site-login {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-form-container {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>



<div class="site-login">
    <div class="card login-form-container" style="width: 100%; max-width: 1200px;">
        <div class="card-body">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-12 form-control'],
                    'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'surname')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '+7(999)-999-99-99',
            ]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>
            <div class="form-group text-center">
                <?= Html::submitButton('Войти', ['class' => 'cafe-button', 'name' => 'login-button', 'style' => 'width: 20vh;']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>










