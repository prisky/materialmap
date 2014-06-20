<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventToResourceToExtra;

/**
 * EventToResourceToExtraSearch represents the model behind the search form about `common\models\EventToResourceToExtra`.
 */
class EventToResourceToExtraSearch extends EventToResourceToExtra
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'event_id', 'resource_to_extra_id', 'deleted'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventToResourceToExtra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'event_id' => $this->event_id,
            'resource_to_extra_id' => $this->resource_to_extra_id,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
