<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Reseller;

/**
 * ResellerSearch represents the model behind the search form about `common\models\Reseller`.
 */
class ResellerSearch extends Reseller
{
    public $from_child_admin;
	public $to_child_admin;
	public $from_rate;
	public $to_rate;
	
    public function rules()
    {
        return [
            [['child_admin'], 'boolean'],
			[['expiry_days', 'trial_days'], 'safe'],
			[['rate', 'from_rate', 'to_rate'], 'number']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Reseller::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_child_admin) && $this->from_child_admin != '') $query->andWhere('`child_admin` >= :from_child_admin', [':from_child_admin' => $this->from_child_admin]);
		if(!is_null($this->to_child_admin) && $this->to_child_admin != '') $query->andWhere('`child_admin` <= :to_child_admin', [':to_child_admin' => $this->to_child_admin]);
		$query->andFilterWhere(['like', 'expiry_days', $this->expiry_days]);
		if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
		if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
		$query->andFilterWhere(['like', 'trial_days', $this->trial_days]);
		
        return $dataProvider;
    }
}
