<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToTicketToSeat;

/**
 * SurveyResultToTicketToSeatSearch represents the model behind the search form about `common\models\SurveyResultToTicketToSeat`.
 */
class SurveyResultToTicketToSeatSearch extends SurveyResultToTicketToSeat
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SurveyResultToTicketToSeat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
