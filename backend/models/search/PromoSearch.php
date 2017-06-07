<?php
/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 23:57
 */

namespace backend\models\search;

use common\models\Promo;
use yii\data\ActiveDataProvider;

class PromoSearch extends Promo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['date_begin', 'date_end', 'amount', 'city_id', 'name'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'promo.id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'promo.name', $this->name]);

        return $dataProvider;
    }

}