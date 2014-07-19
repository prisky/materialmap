<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventToResourceToExtraToTicket;

/**
 * EventToResourceToExtraToTicketSearch represents the model behind the search form about `common\models\EventToResourceToExtraToTicket`.
 */
class EventToResourceToExtraToTicketSearch extends EventToResourceToExtraToTicket
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['quantity'], 'safe'],
			[['ticket_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventToResourceToExtraToTicket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterGoogleStyle('quantity', $this->quantity);
		$query->andFilterWhere(['ticket_id' => $this->ticket_id]);
		
        return $dataProvider;
    }
}
