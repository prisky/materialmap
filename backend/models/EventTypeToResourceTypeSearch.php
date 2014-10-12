<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventTypeToResourceType;

/**
 * EventTypeToResourceTypeSearch represents the model behind the search form about `common\models\EventTypeToResourceType`.
 */
class EventTypeToResourceTypeSearch extends EventTypeToResourceType
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = EventTypeToResourceType::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['resource_type_id' => $this->resource_type_id]);

        return $dataProvider;
    }
}
