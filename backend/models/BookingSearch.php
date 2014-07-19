<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Booking;

/**
 * BookingSearch represents the model behind the search form about `common\models\Booking`.
 */
class BookingSearch extends Booking
{
    
    public function rules()
    {
        return [
            [['event_id', 'summary_id'], 'integer'],
			[['status'], 'number']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Booking::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['event_id' => $this->event_id]);
		$query->andFilterWhere(['status' => $this->status]);
		$query->andFilterWhere(['summary_id' => $this->summary_id]);
		
        return $dataProvider;
    }
}
