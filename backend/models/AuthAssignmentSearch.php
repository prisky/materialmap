<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form about `common\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{
    public $from_created_at;
	public $to_created_at;
	
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
			[['item_name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthAssignment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_created_at) && $this->from_created_at != '') $query->andWhere('`created_at` >= :from_created_at', [':from_created_at' => $this->from_created_at]);
		if(!is_null($this->to_created_at) && $this->to_created_at != '') $query->andWhere('`created_at` <= :to_created_at', [':to_created_at' => $this->to_created_at]);
		$query->andFilterWhere(['like', 'item_name', $this->item_name]);
		
        return $dataProvider;
    }
}
