<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 24.04.17
 * Time: 21:46
 */

namespace api\v1\models\clients;

use yii\helpers\ArrayHelper;

class Facebook extends \yii\authclient\clients\Facebook
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->scope = implode(' ', [
            'public_profile',
        ]);
        $this->attributeNames = ArrayHelper::merge($this->attributeNames,[
            'first_name',
            'last_name',
            'cover',
            'picture.type(large)',
        ]);
    }

    public function getUserEmail()
    {
        return isset($this->getUserAttributes()['email'])
            ? $this->getUserAttributes()['email']
            : null;
    }

    public function getImageUrl()
    {
        $url = null;
        if (isset($this->getUserAttributes()['picture']['data']['url'])){
            $_url = $this->getUserAttributes()['picture']['data']['url'];
            $url = $_url; //explode("?",$_url)[0];
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