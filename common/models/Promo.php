<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 23:36
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * This is the model class for table "promo".
 * @property integer $id
 * @property integer $date_begin
 * @property integer $date_end
 * @property float $amount
 * @property integer $city_id
 * @property string $name
 * @property integer $status
 */
class Promo extends ActiveRecord
{
    const STATUS_NO_ACTIVE = 1;
    const STATUS_ACTIVE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%promo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_begin', 'date_end', 'amount', 'city_id', 'name'], 'required', 'message'=>'Поле обязательно для заполнения'],
            ['city_id','integer'],
            ['name', 'string'],
            ['name', 'match', 'pattern'=>'/^[a-zA-Z]+$/', 'message'=>'Только латинские буквы'],
            [['date_begin', 'date_end'],'safe'],
            [['date_begin','date_end'],'validatePeriod'],
            ['amount', 'number'],
            ['status', 'default','value'=>self::STATUS_NO_ACTIVE],
            ['status', 'in', 'range' => [1, 2]]
        ];
    }

    public function validatePeriod($attribute, $params){
        if ($this->date_begin>=$this->date_end){
            $this->addError($attribute, 'Дата окончания периода должна быть больше даты начала периода');
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'date_begin' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'amount' => 'Сумма',
            'city_id' => 'Тарифная зона',
            'name'    => 'Наименование',
            'status'    => 'Статус',
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_NO_ACTIVE => 'Не активен',
            self::STATUS_ACTIVE => 'Активен',
        ];
    }

    public function fields()
    {
        return [
            'date_begin',
            'date_end',
            'amount',
            'city' => function($model){
                return City::findOne(['id'=>$model->city_id])->name;
            },
            'status' => function($model){
                return self::getStatusList()[$model->status];
            },
        ];
    }


}