<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountrySearch represents the model behind the search form about `common\models\Country`.
 */
class CountrySearch extends Country
{
    
    public function rules()
    {
        return [
            [['code', 'currency_code', 'currency_symbol', 'name', 'phone_prefix', 'tax_name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Country::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['like', 'code', $this->code]);
		$query->andFilterWhere(['like', 'currency_code', $this->currency_code]);
		$query->andFilterWhere(['like', 'currency_symbol', $this->currency_symbol]);
		$query->andFilterWhere(['like', 'name', $this->name]);
		$query->andFilterWhere(['like', 'phone_prefix', $this->phone_prefix]);
		$query->andFilterWhere(['like', 'tax_name', $this->tax_name]);
		
        return $dataProvider;
    }
}
