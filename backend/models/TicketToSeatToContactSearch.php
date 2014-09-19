<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToContact;

/**
 * TicketToSeatToContactSearch represents the model behind the search form about `common\models\TicketToSeatToContact`.
 */
class TicketToSeatToContactSearch extends TicketToSeatToContact
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = TicketToSeatToContact::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
