<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Address;

/**
 * AddressSearch represents the model behind the search form about `common\models\Address`.
 */
class AddressSearch extends Address
{
    
    public function rules()
    {
        return [
            [['address_line1', 'address_line2', 'post_code'], 'safe'],
			[['town_city_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Address::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('address_line1', $this->address_line1);
		$query->andFilterGoogleStyle('address_line2', $this->address_line2);
		$query->andFilterGoogleStyle('post_code', $this->post_code);
		$query->andFilterWhere(['town_city_id' => $this->town_city_id]);
		
        return $dataProvider;
    }
}
