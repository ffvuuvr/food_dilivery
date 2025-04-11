<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $surname;
    public $password_repeat;
    public $phone;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'phone', 'surname', 'name'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['username', 'unique', 'targetClass'=>'app\models\User', 'message'=>'Данный логин уже занят!'],
            ['phone', 'unique', 'targetClass'=>'app\models\User', 'message'=>'Данный номер телефона уже зарегистрирован!'],
            ['password', 'string', 'min'=>7],
            ['password_repeat', 'compare', 'compareAttribute'=>'password'],
        ];
    }

    public function AttributeLabels() {
        return [
            'username'=>'Логин',
            'phone'=>'Номер телефона',
            'name'=>'Имя',
            'surname'=>'Фамилия',
            'password'=>'Пароль',
            'password_repeat'=>'Повтор пароля',
            'rememberMe'=>'Запомнить меня',
        ];
    }

    public function register()
    {
        if (!$this->validate()){
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->HashPassword($this->password);
        return $user->save() ? $user : null;
    }
}
