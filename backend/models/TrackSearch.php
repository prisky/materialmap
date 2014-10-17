<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Track;

/**
 * TrackSearch represents the model behind the search form about `common\models\Track`.
 */
class TrackSearch extends Track
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Track::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('longitude', $this->longitude);
        $query->andFilterGoogleStyle('latitude', $this->latitude);

        return $dataProvider;
    }
}
