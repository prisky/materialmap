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
            [['booking_id'], 'integer']        ];
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
		
        return $dataProvider;
    }
}
