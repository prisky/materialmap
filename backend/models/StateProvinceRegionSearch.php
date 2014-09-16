<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\StateProvinceRegion;

/**
 * StateProvinceRegionSearch represents the model behind the search form about `common\models\StateProvinceRegion`.
 */
class StateProvinceRegionSearch extends StateProvinceRegion
{
    
    public function rules()
    {
        return [
            [['country_id', 'name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = StateProvinceRegion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('country_id', $this->country_id);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
