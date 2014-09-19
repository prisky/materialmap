<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToCharge;

/**
 * SummaryToChargeSearch represents the model behind the search form about `common\models\SummaryToCharge`.
 */
class SummaryToChargeSearch extends SummaryToCharge
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToCharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['charge_id' => $this->charge_id]);
		
        return $dataProvider;
    }
}
