<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\StateProvince;

/**
 * StateProvinceSearch represents the model behind the search form about `common\models\StateProvince`.
 */
class StateProvinceSearch extends StateProvince
{
    public function rules()
    {
        return [
            [['id', 'country_id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = StateProvince::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
