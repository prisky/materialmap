<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TownCity;

/**
 * TownCitySearch represents the model behind the search form about `common\models\TownCity`.
 */
class TownCitySearch extends TownCity
{
    
    public function rules()
    {
        return [
            [['name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TownCity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
