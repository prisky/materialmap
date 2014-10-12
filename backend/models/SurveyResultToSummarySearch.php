<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToSummary;

/**
 * SurveyResultToSummarySearch represents the model behind the search form about `common\models\SurveyResultToSummary`.
 */
class SurveyResultToSummarySearch extends SurveyResultToSummary
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SurveyResultToSummary::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['account_id' => $this->account_id]);
        $query->andFilterWhere(['summary_id' => $this->summary_id]);
        $query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
        $query->andFilterGoogleStyle('custom_value', $this->custom_value);

        return $dataProvider;
    }
}
