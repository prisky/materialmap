<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Reader;

/**
 * ReaderSearch represents the model behind the search form about `common\models\Reader`.
 */
class ReaderSearch extends Reader
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Reader::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterWhere(['activation' => $this->activation]);

        return $dataProvider;
    }
}
