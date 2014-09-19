<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResultToBooking;

/**
 * SurveyResultToBookingSearch represents the model behind the search form about `common\models\SurveyResultToBooking`.
 */
class SurveyResultToBookingSearch extends SurveyResultToBooking
{
    public $from_booking_id;
	public $to_booking_id;
	
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

        $this->setAttributes($params);

		if(!is_null($this->from_booking_id) && $this->from_booking_id != '') $query->andWhere('`booking_id` >= :from_booking_id', [':from_booking_id' => $this->from_booking_id]);
		if(!is_null($this->to_booking_id) && $this->to_booking_id != '') $query->andWhere('`booking_id` <= :to_booking_id', [':to_booking_id' => $this->to_booking_id]);
		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		
        return $dataProvider;
    }
}
