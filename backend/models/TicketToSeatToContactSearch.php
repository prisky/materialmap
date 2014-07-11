<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToContact;

/**
 * TicketToSeatToContactSearch represents the model behind the search form about `common\models\TicketToSeatToContact`.
 */
class TicketToSeatToContactSearch extends TicketToSeatToContact
{
    
    public function rules()
    {
        return [
            [['contact_id', 'ticket_to_seat_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeatToContact::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
