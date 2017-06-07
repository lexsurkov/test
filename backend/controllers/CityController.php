<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 22:36
 */

namespace backend\controllers;


use backend\models\search\CitySearch;
use common\models\City;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class CityController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $searchModel = new CitySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query = $dataProvider->query->orderBy('name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
        $model = City::findOne($id);

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
        $model = new City();

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

    public function actionDelete($id){
        $models = City::findAll($id);
        foreach ($models as $model){
            $model->delete();
        }
        return $this->redirect(Url::toRoute('index'));
    }
}