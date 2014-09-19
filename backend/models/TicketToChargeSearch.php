<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToCharge;

/**
 * TicketToChargeSearch represents the model behind the search form about `common\models\TicketToCharge`.
 */
class TicketToChargeSearch extends TicketToCharge
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = TicketToCharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['charge_id' => $this->charge_id]);
		
        return $dataProvider;
    }
}
