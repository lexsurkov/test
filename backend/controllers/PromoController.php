<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 23:30
 */

namespace backend\controllers;

use backend\models\search\PromoSearch;
use common\models\Promo;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class PromoController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update','delete'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $searchModel = new PromoSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query = $dataProvider->query->orderBy('name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
        $model = Promo::findOne($id);

        if (\Yii::$app->request->post()){
            if ($model->load(\Yii::$app->request->post())){
                if ($model->validate() && $model->save()){
                    return $this->redirect(Url::toRoute('index'));
                }
            }
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }

    public function actionCreate(){
        $model = new Promo();

        if (\Yii::$app->request->post()){
            if ($model->load(\Yii::$app->request->post())){
                if ($model->validate() && $model->save()){
                    return $this->redirect(Url::toRoute('index'));
                }
            }
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }

}