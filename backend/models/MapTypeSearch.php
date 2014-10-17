<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MapType;

/**
 * MapTypeSearch represents the model behind the search form about `common\models\MapType`.
 */
class MapTypeSearch extends MapType
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = MapType::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);

        return $dataProvider;
    }
}
