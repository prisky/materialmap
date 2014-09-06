<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentVoucherConstraint;

/**
 * PercentVoucherConstraintSearch represents the model behind the search form about `common\models\PercentVoucherConstraint`.
 */
class PercentVoucherConstraintSearch extends PercentVoucherConstraint
{
    public $from_invalaid_to;
	public $to_invalaid_to;
	public $from_invalid_from;
	public $to_invalid_from;
	
    public function rules()
    {
        return [
            [['invalaid_to', 'from_invalaid_to', 'to_invalaid_to', 'invalid_from', 'from_invalid_from', 'to_invalid_from'], 'number']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = PercentVoucherConstraint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_invalaid_to) && $this->from_invalaid_to != '') $query->andWhere('`invalaid_to` >= :from_invalaid_to', [':from_invalaid_to' => $this->from_invalaid_to]);
		if(!is_null($this->to_invalaid_to) && $this->to_invalaid_to != '') $query->andWhere('`invalaid_to` <= :to_invalaid_to', [':to_invalaid_to' => $this->to_invalaid_to]);
		if(!is_null($this->from_invalid_from) && $this->from_invalid_from != '') $query->andWhere('`invalid_from` >= :from_invalid_from', [':from_invalid_from' => $this->from_invalid_from]);
		if(!is_null($this->to_invalid_from) && $this->to_invalid_from != '') $query->andWhere('`invalid_from` <= :to_invalid_from', [':to_invalid_from' => $this->to_invalid_from]);
		
        return $dataProvider;
    }
}
