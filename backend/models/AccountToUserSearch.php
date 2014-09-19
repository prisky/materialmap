<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToUser;

/**
 * AccountToUserSearch represents the model behind the search form about `common\models\AccountToUser`.
 */
class AccountToUserSearch extends AccountToUser
{
    public $from_immediate;
	public $to_immediate;
	public $from_newsletter;
	public $to_newsletter;
	public $from_rate;
	public $to_rate;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AccountToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		if(!is_null($this->from_immediate) && $this->from_immediate != '') $query->andWhere('`immediate` >= :from_immediate', [':from_immediate' => $this->from_immediate]);
		if(!is_null($this->to_immediate) && $this->to_immediate != '') $query->andWhere('`immediate` <= :to_immediate', [':to_immediate' => $this->to_immediate]);
		if(!is_null($this->from_newsletter) && $this->from_newsletter != '') $query->andWhere('`newsletter` >= :from_newsletter', [':from_newsletter' => $this->from_newsletter]);
		if(!is_null($this->to_newsletter) && $this->to_newsletter != '') $query->andWhere('`newsletter` <= :to_newsletter', [':to_newsletter' => $this->to_newsletter]);
		if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
		if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
		$query->andFilterWhere(['user_id' => $this->user_id]);
		
        return $dataProvider;
    }
}
