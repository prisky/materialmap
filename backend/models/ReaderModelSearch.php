<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ReaderModel;

/**
 * ReaderModelSearch represents the model behind the search form about `common\models\ReaderModel`.
 */
class ReaderModelSearch extends ReaderModel
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = ReaderModel::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);

        return $dataProvider;
    }
}
