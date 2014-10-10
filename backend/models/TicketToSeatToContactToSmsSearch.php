<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToContactToSms;

/**
 * TicketToSeatToContactToSmsSearch represents the model behind the search form about `common\models\TicketToSeatToContactToSms`.
 */
class TicketToSeatToContactToSmsSearch extends TicketToSeatToContactToSms
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = TicketToSeatToContactToSms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		$query->andFilterWhere(['ticket_to_seat_to_contact_id' => $this->ticket_to_seat_to_contact_id]);
		$query->andFilterWhere(['sms_id' => $this->sms_id]);
		
        return $dataProvider;
    }
}
