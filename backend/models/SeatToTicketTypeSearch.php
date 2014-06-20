<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SeatToTicketType;

/**
 * SeatToTicketTypeSearch represents the model behind the search form about `common\models\SeatToTicketType`.
 */
class SeatToTicketTypeSearch extends SeatToTicketType
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'seat_id', 'ticket_type_id', 'deleted'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SeatToTicketType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'seat_id' => $this->seat_id,
            'ticket_type_id' => $this->ticket_type_id,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
