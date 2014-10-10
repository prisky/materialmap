<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentVoucher;

/**
 * PercentVoucherSearch represents the model behind the search form about `common\models\PercentVoucher`.
 */
class PercentVoucherSearch extends PercentVoucher
{
    public $from_rate;
	public $to_rate;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = PercentVoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
		if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
		
        return $dataProvider;
    }
}
