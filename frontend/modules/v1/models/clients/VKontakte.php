<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 24.04.17
 * Time: 18:23
 */

namespace api\v1\models\clients;

use yii\helpers\ArrayHelper;

class VKontakte extends \yii\authclient\clients\VKontakte
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->scope = implode(' ', [
            'email',
            //'offline',
        ]);
        $this->attributeNames = ArrayHelper::merge($this->attributeNames,['photo_max']);
    }

    public function getUserEmail()
    {
        return $this->getAccessToken()->getParam('email');
    }

    public function getImageUrl()
    {
        $url = null;
        if (isset($this->getUserAttributes()['photo_max'])){
            $_url = $this->getUserAttributes()['photo_max'];
            $url = explode("?",$_url)[0];
        }
        return $url;
    }

    public function getUserName()
    {
        return isset($this->getUserAttributes()['first_name'])
            ? $this->getUserAttributes()['first_name']
            : null;
    }

    public function getUserSurname()
    {
        return isset($this->getUserAttributes()['last_name'])
            ? $this->getUserAttributes()['last_name']
            : null;
    }

}
