<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToAccountToUser;

/**
 * SummaryToAccountToUserSearch represents the model behind the search form about `common\models\SummaryToAccountToUser`.
 */
class SummaryToAccountToUserSearch extends SummaryToAccountToUser
{
    public $from_rate;
	public $to_rate;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToAccountToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['account_to_user_id' => $this->account_to_user_id]);
		$query->andFilterWhere(['invoice_id' => $this->invoice_id]);
		if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
		if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
		
        return $dataProvider;
    }
}
