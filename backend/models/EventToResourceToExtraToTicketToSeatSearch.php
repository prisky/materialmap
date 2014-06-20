<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventToResourceToExtraToTicketToSeat;

/**
 * EventToResourceToExtraToTicketToSeatSearch represents the model behind the search form about `common\models\EventToResourceToExtraToTicketToSeat`.
 */
class EventToResourceToExtraToTicketToSeatSearch extends EventToResourceToExtraToTicketToSeat
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'event_to_resource_to_extra_id', 'ticket_to_seat_id', 'quantity'], 'integer'],
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
        $query = EventToResourceToExtraToTicketToSeat::find();

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
            'ticket_to_seat_id' => $this->ticket_to_seat_id,
            'amount' => $this->amount,
            'quantity' => $this->quantity,
        ]);

        return $dataProvider;
    }
}
