<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentPromotionConstraint;

/**
 * PercentPromotionConstraintSearch represents the model behind the search form about `common\models\PercentPromotionConstraint`.
 */
class PercentPromotionConstraintSearch extends PercentPromotionConstraint
{
    public $from_invalid_from;
	public $to_invalid_from;
	public $from_invalid_to;
	public $to_invalid_to;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = PercentPromotionConstraint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		if(!is_null($this->from_invalid_from) && $this->from_invalid_from != '') $query->andWhere('`invalid_from` >= :from_invalid_from', [':from_invalid_from' => $this->from_invalid_from]);
		if(!is_null($this->to_invalid_from) && $this->to_invalid_from != '') $query->andWhere('`invalid_from` <= :to_invalid_from', [':to_invalid_from' => $this->to_invalid_from]);
		if(!is_null($this->from_invalid_to) && $this->from_invalid_to != '') $query->andWhere('`invalid_to` >= :from_invalid_to', [':from_invalid_to' => $this->from_invalid_to]);
		if(!is_null($this->to_invalid_to) && $this->to_invalid_to != '') $query->andWhere('`invalid_to` <= :to_invalid_to', [':to_invalid_to' => $this->to_invalid_to]);
		
        return $dataProvider;
    }
}
