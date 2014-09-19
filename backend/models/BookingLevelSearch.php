<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\BookingLevel;

/**
 * BookingLevelSearch represents the model behind the search form about `common\models\BookingLevel`.
 */
class BookingLevelSearch extends BookingLevel
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = BookingLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		
        return $dataProvider;
    }
}
