<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToSummary;

/**
 * SurveyResultToSummarySearch represents the model behind the search form about `common\models\SurveyResultToSummary`.
 */
class SurveyResultToSummarySearch extends SurveyResultToSummary
{
    
    public function rules()
    {
        return [
            [['survey_result_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyResultToSummary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['survey_result_id' => $this->survey_result_id]);
		
        return $dataProvider;
    }
}
