<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToTicket;

/**
 * SurveyResultToTicketSearch represents the model behind the search form about `common\models\SurveyResultToTicket`.
 */
class SurveyResultToTicketSearch extends SurveyResultToTicket
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyResultToTicket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['ticket_id' => $this->ticket_id]);
		
        return $dataProvider;
    }
}
