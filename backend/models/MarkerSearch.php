<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Marker;

/**
 * MarkerSearch represents the model behind the search form about `common\models\Marker`.
 */
class MarkerSearch extends Marker
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Marker::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('latitude', $this->latitude);
        $query->andFilterGoogleStyle('longitude', $this->longitude);

        return $dataProvider;
    }
}
