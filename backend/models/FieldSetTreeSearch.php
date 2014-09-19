<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\FieldSetTree;

/**
 * FieldSetTreeSearch represents the model behind the search form about `common\models\FieldSetTree`.
 */
class FieldSetTreeSearch extends FieldSetTree
{
    public $from_depth;
	public $to_depth;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = FieldSetTree::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['child_id' => $this->child_id]);
		if(!is_null($this->from_depth) && $this->from_depth != '') $query->andWhere('`depth` >= :from_depth', [':from_depth' => $this->from_depth]);
		if(!is_null($this->to_depth) && $this->to_depth != '') $query->andWhere('`depth` <= :to_depth', [':to_depth' => $this->to_depth]);
		
        return $dataProvider;
    }
}
