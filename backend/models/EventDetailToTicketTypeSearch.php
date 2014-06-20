<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventDetailToTicketType;

/**
 * EventDetailToTicketTypeSearch represents the model behind the search form about `common\models\EventDetailToTicketType`.
 */
class EventDetailToTicketTypeSearch extends EventDetailToTicketType
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'event_detail_id', 'ticket_type_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventDetailToTicketType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'event_detail_id' => $this->event_detail_id,
            'ticket_type_id' => $this->ticket_type_id,
        ]);

        return $dataProvider;
    }
}
