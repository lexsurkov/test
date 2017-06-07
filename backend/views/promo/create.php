<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 22:31
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Promo */

$this->title = $model->isNewRecord ? 'Добавить промокод' : 'Обновить промокод';
$this->params['breadcrumbs'][] = ['label' => 'Promo code', 'url'=> ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
