<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Reseller;

/**
 * ResellerSearch represents the model behind the search form about `common\models\Reseller`.
 */
class ResellerSearch extends Reseller
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
        $query = Reseller::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		$query->andFilterGoogleStyle('trial_days', $this->trial_days);
		$query->andFilterGoogleStyle('expiry_days', $this->expiry_days);
		if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
		if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
		
        return $dataProvider;
    }
}
