<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\RfidTag;

/**
 * RfidTagSearch represents the model behind the search form about `common\models\RfidTag`.
 */
class RfidTagSearch extends RfidTag
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = RfidTag::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['activation' => $this->activation]);
        $query->andFilterGoogleStyle('name_plate', $this->name_plate);
        $query->andFilterGoogleStyle('commodity_code', $this->commodity_code);
        $query->andFilterGoogleStyle('latitude', $this->latitude);
        $query->andFilterGoogleStyle('longitude', $this->longitude);

        return $dataProvider;
    }
}
