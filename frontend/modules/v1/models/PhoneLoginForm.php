<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 18.04.17
 * Time: 11:00
 */

namespace api\v1\models;

use common\models\Profile;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * @SWG\Definition(
 *     required={"phone"},
 *     @SWG\Xml(name="PhoneLoginForm")
 * )
 */
class PhoneLoginForm extends Model
{
    /**
     * @SWG\Property(
     *      property="phone",
     *      type="string",
     *      format="string",
     *      example=401
     * )
     */
    public $phone;
    public $country_code;
    public $password;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['phone', 'trim'],
            ['phone', 'required'],
            //['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['phone', 'string', 'min' => 2, 'max' => 255],
            ['phone', 'udokmeci\yii2PhoneValidator\PhoneValidator','countryAttribute'=>'country_code'],
            ['country_code','string'],
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

    public function login()
    {
        $this->password = Yii::$app->security->generateRandomString();
        if (!$this->validate()){
            return null;
        }

        $user = User::findByPhone($this->phone);
        if (!$user) {
            $user = new User();
            $user->phone = $this->phone;
            //$user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
        }

        if (!$user->save()){
            return null;
        }
        if (!Profile::findOne($user->id)){
            $profile = new Profile();
            $profile->user_id = $user->id;
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
            $this->_user = User::findByPhone($this->phone);
        }

        return $this->_user;
    }
}
