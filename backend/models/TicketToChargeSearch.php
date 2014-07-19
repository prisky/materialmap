<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToCharge;

/**
 * TicketToChargeSearch represents the model behind the search form about `common\models\TicketToCharge`.
 */
class TicketToChargeSearch extends TicketToCharge
{
    
    public function rules()
    {
        return [
            [['charge_id', 'ticket_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToCharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['charge_id' => $this->charge_id]);
		$query->andFilterWhere(['ticket_id' => $this->ticket_id]);
		
        return $dataProvider;
    }
}
