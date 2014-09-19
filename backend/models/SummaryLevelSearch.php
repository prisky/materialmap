<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryLevel;

/**
 * SummaryLevelSearch represents the model behind the search form about `common\models\SummaryLevel`.
 */
class SummaryLevelSearch extends SummaryLevel
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		
        return $dataProvider;
    }
}
