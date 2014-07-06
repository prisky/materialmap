<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventToResourceToExtraToSummary;

/**
 * EventToResourceToExtraToSummarySearch represents the model behind the search form about `common\models\EventToResourceToExtraToSummary`.
 */
class EventToResourceToExtraToSummarySearch extends EventToResourceToExtraToSummary
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'event_to_resource_to_extra_id', 'summary_id', 'quantity'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventToResourceToExtraToSummary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'event_to_resource_to_extra_id' => $this->event_to_resource_to_extra_id,
            'summary_id' => $this->summary_id,
            'amount' => $this->amount,
            'quantity' => $this->quantity,
        ]);

        return $dataProvider;
    }
}