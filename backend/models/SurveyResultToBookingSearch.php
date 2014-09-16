<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToBooking;

/**
 * SurveyResultToBookingSearch represents the model behind the search form about `common\models\SurveyResultToBooking`.
 */
class SurveyResultToBookingSearch extends SurveyResultToBooking
{
    
    public function rules()
    {
        return [
            [['booking_id', 'custom_field_id', 'field_set_id', 'survey_id'], 'integer'],
			[['custom_value'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyResultToBooking::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['booking_id' => $this->booking_id]);
		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['field_set_id' => $this->field_set_id]);
		$query->andFilterWhere(['survey_id' => $this->survey_id]);
		
        return $dataProvider;
    }
}
