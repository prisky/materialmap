<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountrySearch represents the model behind the search form about `common\models\Country`.
 */
class CountrySearch extends Country
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Country::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('code', $this->code);
		$query->andFilterGoogleStyle('currency_code', $this->currency_code);
		$query->andFilterGoogleStyle('currency_symbol', $this->currency_symbol);
		$query->andFilterGoogleStyle('phone_prefix', $this->phone_prefix);
		$query->andFilterGoogleStyle('tax_name', $this->tax_name);
		
        return $dataProvider;
    }
}
