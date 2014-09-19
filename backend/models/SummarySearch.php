<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Summary;

/**
 * SummarySearch represents the model behind the search form about `common\models\Summary`.
 */
class SummarySearch extends Summary
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Summary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		
        return $dataProvider;
    }
}
