<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 22:31
 */
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Промокоды';
$this->params['breadcrumbs'][] = $this->title;

?>

<p>
    <?= Html::a('Добавить промокод', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        [
            'attribute' => 'date_begin',
            'value' => function ($model) {
                return $model->date_begin;
            },
            'filter' => \yii\jui\DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'date_begin',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'attribute' => 'date_end',
            'value' => function ($model) {
                return $model->date_end;
            },
            'filter' => \yii\jui\DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'date_end',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        'amount',
        [
            'attribute' => 'city_id',
            'value' => function ($model) {
                return ($model->city_id == null || !isset(\common\models\City::getNameList()[$model->city_id]))
                    ? '<span class="not-set">' . '(not set)' . '</span>'
                    : \common\models\City::getNameList()[$model->city_id];
            },
            'filter' => \common\models\City::getNameList(),
            'format' => 'html',
        ],
        [
            'attribute' => 'status',
            'value' => function ($model) {
                return ($model->status == null || !isset(\common\models\Promo::getStatusList()[$model->status]))
                    ? '<span class="not-set">' . '(not set)' . '</span>'
                    : \common\models\Promo::getStatusList()[$model->status];
            },
            'filter' => \common\models\Promo::getStatusList(),
            'format' => 'html',
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
