<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToTicket;

/**
 * SurveyResultToTicketSearch represents the model behind the search form about `common\models\SurveyResultToTicket`.
 */
class SurveyResultToTicketSearch extends SurveyResultToTicket
{
    
    public function rules()
    {
        return [
            [['ticket_id'], 'integer']        ];
    }

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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['ticket_id' => $this->ticket_id]);
		
        return $dataProvider;
    }
}
