<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeat;

/**
 * TicketToSeatSearch represents the model behind the search form about `common\models\TicketToSeat`.
 */
class TicketToSeatSearch extends TicketToSeat
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = TicketToSeat::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['seat_id' => $this->seat_id]);

        return $dataProvider;
    }
}
