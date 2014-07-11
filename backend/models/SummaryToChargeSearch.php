<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToCharge;

/**
 * SummaryToChargeSearch represents the model behind the search form about `common\models\SummaryToCharge`.
 */
class SummaryToChargeSearch extends SummaryToCharge
{
    
    public function rules()
    {
        return [
            [['charge_id'], 'integer']        ];
    }

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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['charge_id' => $this->charge_id]);
		
        return $dataProvider;
    }
}
