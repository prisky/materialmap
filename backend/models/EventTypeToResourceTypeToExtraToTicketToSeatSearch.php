<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventTypeToResourceTypeToExtraToTicketToSeat;

/**
 * EventTypeToResourceTypeToExtraToTicketToSeatSearch represents the model behind the search form about `common\models\EventTypeToResourceTypeToExtraToTicketToSeat`.
 */
class EventTypeToResourceTypeToExtraToTicketToSeatSearch extends EventTypeToResourceTypeToExtraToTicketToSeat
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['event_type_to_resource_type_to_extra_id', 'ticket_to_seat_id'], 'integer'],
			[['quantity'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventTypeToResourceTypeToExtraToTicketToSeat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['event_type_to_resource_type_to_extra_id' => $this->event_type_to_resource_type_to_extra_id]);
		$query->andFilterGoogleStyle('quantity', $this->quantity);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
