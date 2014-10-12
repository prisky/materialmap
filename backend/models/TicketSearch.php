<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Ticket;

/**
 * TicketSearch represents the model behind the search form about `common\models\Ticket`.
 */
class TicketSearch extends Ticket
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
        $query = Ticket::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['ticket_type_id' => $this->ticket_type_id]);
        if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
        if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);

        return $dataProvider;
    }
}
