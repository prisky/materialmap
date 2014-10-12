<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\FieldSet;

/**
 * FieldSetSearch represents the model behind the search form about `common\models\FieldSet`.
 */
class FieldSetSearch extends FieldSet
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = FieldSet::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);


        return $dataProvider;
    }
}
