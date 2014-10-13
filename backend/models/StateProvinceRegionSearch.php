<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\StateProvinceRegion;

/**
 * StateProvinceRegionSearch represents the model behind the search form about `common\models\StateProvinceRegion`.
 */
class StateProvinceRegionSearch extends StateProvinceRegion
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = StateProvinceRegion::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);

        return $dataProvider;
    }
}
