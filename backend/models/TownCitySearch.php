<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TownCity;

/**
 * TownCitySearch represents the model behind the search form about `common\models\TownCity`.
 */
class TownCitySearch extends TownCity
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = TownCity::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterWhere(['state_province_region' => $this->state_province_region]);

        return $dataProvider;
    }
}
