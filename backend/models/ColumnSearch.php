<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Column;

/**
 * ColumnSearch represents the model behind the search form about `common\models\Column`.
 */
class ColumnSearch extends Column
{
    public $from_model_id;
	public $to_model_id;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Column::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('help', $this->help);
		$query->andFilterGoogleStyle('label', $this->label);
		if(!is_null($this->from_model_id) && $this->from_model_id != '') $query->andWhere('`model_id` >= :from_model_id', [':from_model_id' => $this->from_model_id]);
		if(!is_null($this->to_model_id) && $this->to_model_id != '') $query->andWhere('`model_id` <= :to_model_id', [':to_model_id' => $this->to_model_id]);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
