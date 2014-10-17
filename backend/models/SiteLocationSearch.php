<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SiteLocation;

/**
 * SiteLocationSearch represents the model behind the search form about `common\models\SiteLocation`.
 */
class SiteLocationSearch extends SiteLocation
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SiteLocation::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterGoogleStyle('latitude', $this->latitude);
        $query->andFilterGoogleStyle('longitude', $this->longitude);

        return $dataProvider;
    }
}
