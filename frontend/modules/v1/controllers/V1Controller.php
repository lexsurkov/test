<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 18:34
 */

namespace frontend\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class V1Controller extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        //$behaviors['authenticator']['class'] = HttpBearerAuth::className();
        return $behaviors;
    }
}


