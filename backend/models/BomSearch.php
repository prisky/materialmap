<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Bom;

/**
 * BomSearch represents the model behind the search form about `common\models\Bom`.
 */
class BomSearch extends Bom
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Bom::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['commodity_code_id' => $this->commodity_code_id]);
        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterGoogleStyle('size1', $this->size1);
        $query->andFilterGoogleStyle('size2', $this->size2);
        $query->andFilterGoogleStyle('wbs', $this->wbs);

        return $dataProvider;
    }
}
