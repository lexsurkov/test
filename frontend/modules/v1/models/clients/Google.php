<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 22.04.17
 * Time: 20:10
 */

namespace api\v1\models\clients;

class Google extends \yii\authclient\clients\Google {

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->scope = implode(' ', [
            'profile',
            'email',
            //'https://www.googleapis.com/auth/drive',
        ]);
    }

    public function getUserEmail()
    {
        return isset($this->getUserAttributes()['emails'][0]['value'])
            ? $this->getUserAttributes()['emails'][0]['value']
            : null;
    }

    public function getImageUrl()
    {
        $url = null;
        if (isset($this->getUserAttributes()['image']['url'])){
            $_url = $this->getUserAttributes()['image']['url'];
            $url = explode("?",$_url)[0];
        }
        return $url;
    }

    public function getUserName()
    {
        return isset($this->getUserAttributes()['name']['givenName'])
            ? $this->getUserAttributes()['name']['givenName']
            : null;
    }

    public function getUserSurname()
    {
        return isset($this->getUserAttributes()['name']['familyName'])
            ? $this->getUserAttributes()['name']['familyName']
            : null;
    }

}