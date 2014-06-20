<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Ticket;

/**
 * TicketSearch represents the model behind the search form about `common\models\Ticket`.
 */
class TicketSearch extends Ticket
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'booking_id', 'ticket_type_id'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Ticket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'booking_id' => $this->booking_id,
            'ticket_type_id' => $this->ticket_type_id,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
