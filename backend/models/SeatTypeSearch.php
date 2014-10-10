<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SeatType;

/**
 * SeatTypeSearch represents the model behind the search form about `common\models\SeatType`.
 */
class SeatTypeSearch extends SeatType
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SeatType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
