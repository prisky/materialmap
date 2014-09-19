<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToCharge;

/**
 * TicketToSeatToChargeSearch represents the model behind the search form about `common\models\TicketToSeatToCharge`.
 */
class TicketToSeatToChargeSearch extends TicketToSeatToCharge
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeatToCharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['charge_id' => $this->charge_id]);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
