<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 02.04.17
 * Time: 19:30
 */

namespace api\v1\models;

use common\models\Profile;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class EmailLoginForm extends Model
{
    public $email;
    public $password;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $this->password = Yii::$app->security->generateRandomString();
        if (!$this->validate()){
            return null;
        }

        $user = User::findByEmail($this->email);
        if (!$user) {
            $user = new User();
            $user->phone = $this->email;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
        }

        if (!$user->save()){
            return null;
        }
        if (!Profile::findOne($user->id)){
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->email = $user->email;
            $profile->save();
        }
        return $user;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
