<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\RfidModel;

/**
 * RfidModelSearch represents the model behind the search form about `common\models\RfidModel`.
 */
class RfidModelSearch extends RfidModel
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = RfidModel::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);

        return $dataProvider;
    }
}
