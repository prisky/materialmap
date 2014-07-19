<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToVoucher;

/**
 * SummaryToVoucherSearch represents the model behind the search form about `common\models\SummaryToVoucher`.
 */
class SummaryToVoucherSearch extends SummaryToVoucher
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['summary_id', 'voucher_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToVoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['summary_id' => $this->summary_id]);
		$query->andFilterWhere(['voucher_id' => $this->voucher_id]);
		
        return $dataProvider;
    }
}
