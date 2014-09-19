<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SeatToTicketType;

/**
 * SeatToTicketTypeSearch represents the model behind the search form about `common\models\SeatToTicketType`.
 */
class SeatToTicketTypeSearch extends SeatToTicketType
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SeatToTicketType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['ticket_type_id' => $this->ticket_type_id]);
		
        return $dataProvider;
    }
}
