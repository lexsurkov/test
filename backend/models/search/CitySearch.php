<?php

/**
 * Created by PhpStorm.
 * User: surkov
 * Date: 06.06.17
 * Time: 22:38
 */
namespace backend\models\search;

use common\models\City;
use yii\data\ActiveDataProvider;

class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['name', 'safe'],
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
            'city.id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'city.name', $this->name]);

        return $dataProvider;
    }

}