<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AuthItem;

/**
 * AuthItemSearch represents the model behind the search form about `common\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{
    public $from_created_at;
	public $to_created_at;
	public $from_type;
	public $to_type;
	public $from_updated_at;
	public $to_updated_at;
	
    public function rules()
    {
        return [
            [['created_at', 'from_created_at', 'to_created_at', 'updated_at', 'from_updated_at', 'to_updated_at'], 'number'],
			[['data', 'description', 'name', 'rule_name'], 'safe'],
			[['type'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_created_at) && $this->from_created_at != '') $query->andWhere('`created_at` >= :from_created_at', [':from_created_at' => $this->from_created_at]);
		if(!is_null($this->to_created_at) && $this->to_created_at != '') $query->andWhere('`created_at` <= :to_created_at', [':to_created_at' => $this->to_created_at]);
		$query->andFilterGoogleStyle('data', $this->data);
		$query->andFilterGoogleStyle('description', $this->description);
		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('rule_name', $this->rule_name);
		if(!is_null($this->from_type) && $this->from_type != '') $query->andWhere('`type` >= :from_type', [':from_type' => $this->from_type]);
		if(!is_null($this->to_type) && $this->to_type != '') $query->andWhere('`type` <= :to_type', [':to_type' => $this->to_type]);
		if(!is_null($this->from_updated_at) && $this->from_updated_at != '') $query->andWhere('`updated_at` >= :from_updated_at', [':from_updated_at' => $this->from_updated_at]);
		if(!is_null($this->to_updated_at) && $this->to_updated_at != '') $query->andWhere('`updated_at` <= :to_updated_at', [':to_updated_at' => $this->to_updated_at]);
		
        return $dataProvider;
    }
}
