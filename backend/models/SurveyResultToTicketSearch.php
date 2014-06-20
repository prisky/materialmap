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
            [['id', 'account_id', 'survey_result_id', 'ticket_id'], 'integer'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'survey_result_id' => $this->survey_result_id,
            'ticket_id' => $this->ticket_id,
        ]);

        return $dataProvider;
    }
}
