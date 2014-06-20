<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToCharge;

/**
 * TicketToSeatToChargeSearch represents the model behind the search form about `common\models\TicketToSeatToCharge`.
 */
class TicketToSeatToChargeSearch extends TicketToSeatToCharge
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'ticket_to_seat_id', 'charge_id'], 'integer'],
        ];
    }

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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'ticket_to_seat_id' => $this->ticket_to_seat_id,
            'charge_id' => $this->charge_id,
        ]);

        return $dataProvider;
    }
}
