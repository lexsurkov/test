<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 22:31
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Promo */
/* @var $form yii\widgets\ActiveForm */


$disabled = false;
if (isset($model->status) && $model->status==\common\models\Promo::STATUS_NO_ACTIVE){
    $disabled = true;
}
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'date_begin')->widget(DatePicker::className(),[
        'dateFormat' => 'php:Y-m-d',
        'options' => [
            'class' => 'form-control',
            'disabled'=>$disabled,
        ],
    ]) ?>
    <?= $form->field($model,'date_end')->widget(DatePicker::className(),[
        'dateFormat' => 'php:Y-m-d',
        'options' => [
            'class' => 'form-control',
            'disabled'=>$disabled,
        ],
    ]) ?>
    <?= $form->field($model, 'amount')->textInput([
        'type' => 'number',
        'step'=>'any',
        'disabled'=>$disabled,
    ]) ?>
    <?= $form->field($model, 'city_id')->dropDownList(\common\models\City::getNameList(),[
        'disabled'=>$disabled,
    ]) ?>
    <?= $form->field($model, 'name')->textInput([
        'maxlength' => true,
        'disabled'=>$disabled,
    ]) ?>
    <?php if (!$model->isNewRecord):?>
        <?= $form->field($model, 'status')->dropDownList(\common\models\Promo::getStatusList()) ?>
    <?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
