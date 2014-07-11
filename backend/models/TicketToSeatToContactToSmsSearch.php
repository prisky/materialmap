<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToContactToSms;

/**
 * TicketToSeatToContactToSmsSearch represents the model behind the search form about `common\models\TicketToSeatToContactToSms`.
 */
class TicketToSeatToContactToSmsSearch extends TicketToSeatToContactToSms
{
    
    public function rules()
    {
        return [
            [['sms_id', 'ticket_to_seat_to_contact_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeatToContactToSms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['sms_id' => $this->sms_id]);
		$query->andFilterWhere(['ticket_to_seat_to_contact_id' => $this->ticket_to_seat_to_contact_id]);
		
        return $dataProvider;
    }
}
