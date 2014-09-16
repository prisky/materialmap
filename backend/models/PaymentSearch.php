<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `common\models\Payment`.
 */
class PaymentSearch extends Payment
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['contact_id', 'payment_gateway_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Payment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		$query->andFilterWhere(['payment_gateway_id' => $this->payment_gateway_id]);
		
        return $dataProvider;
    }
}
