<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketType;

/**
 * TicketTypeSearch represents the model behind the search form about `common\models\TicketType`.
 */
class TicketTypeSearch extends TicketType
{
    public $from_amount;
	public $to_amount;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = TicketType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterGoogleStyle('booking_max', $this->booking_max);
		$query->andFilterGoogleStyle('comment', $this->comment);
		$query->andFilterGoogleStyle('event_max', $this->event_max);
		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('seats', $this->seats);
		
        return $dataProvider;
    }
}
