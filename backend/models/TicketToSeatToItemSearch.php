<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToItem;

/**
 * TicketToSeatToItemSearch represents the model behind the search form about `common\models\TicketToSeatToItem`.
 */
class TicketToSeatToItemSearch extends TicketToSeatToItem
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
        $query = TicketToSeatToItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['item_id' => $this->item_id]);
		$query->andFilterGoogleStyle('quantity', $this->quantity);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
