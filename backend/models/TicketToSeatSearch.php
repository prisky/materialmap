<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeat;

/**
 * TicketToSeatSearch represents the model behind the search form about `common\models\TicketToSeat`.
 */
class TicketToSeatSearch extends TicketToSeat
{
    
    public function rules()
    {
        return [
            [['seat_id', 'ticket_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['seat_id' => $this->seat_id]);
		$query->andFilterWhere(['ticket_id' => $this->ticket_id]);
		
        return $dataProvider;
    }
}
