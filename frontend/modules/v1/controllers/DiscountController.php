<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 19:57
 */

namespace frontend\modules\v1\controllers;

use common\models\City;
use common\models\Promo;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class DiscountController extends V1Controller
{
    public $modelClass = 'common\models\Promo';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function verbs() {
        return ArrayHelper::merge(parent::verbs(), [
            'activate'  => ['PUT'],
        ]);
    }

    public function actionIndex($name){
        if ($name){
            $modelClass = $this->modelClass;
            return $modelClass::find()->where(['like','name',$name])->all();
        }
        throw new BadRequestHttpException('Missing required parameters: name');
    }

    public function actionActivate(){
        if (\Yii::$app->getRequest()->getBodyParams() &&
            isset(\Yii::$app->getRequest()->getBodyParams()['name']) &&
            isset(\Yii::$app->getRequest()->getBodyParams()['city'])
        ){
            $city_id = City::findOne(['name'=>\Yii::$app->getRequest()->getBodyParams()['city']]);
            if (!$city_id) {
                throw new BadRequestHttpException('Not fount city');
            }
            $promo = Promo::findOne(['name'=>\Yii::$app->getRequest()->getBodyParams()['name']]);
            if (!$promo){
                throw new BadRequestHttpException('Not fount discount');
            }
            return $promo->amount;
        }
        throw new BadRequestHttpException('Missing required parameters: name or city');
    }

}
