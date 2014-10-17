<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CommodityCode;

/**
 * CommodityCodeSearch represents the model behind the search form about `common\models\CommodityCode`.
 */
class CommodityCodeSearch extends CommodityCode
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = CommodityCode::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('code', $this->code);
        $query->andFilterGoogleStyle('description', $this->description);
        $query->andFilterGoogleStyle('purchase_description', $this->purchase_description);

        return $dataProvider;
    }
}
