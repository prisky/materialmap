<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventTypeToFieldSet;

/**
 * EventTypeToFieldSetSearch represents the model behind the search form about `common\models\EventTypeToFieldSet`.
 */
class EventTypeToFieldSetSearch extends EventTypeToFieldSet
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = EventTypeToFieldSet::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['field_set_id' => $this->field_set_id]);

        return $dataProvider;
    }
}
