<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToMessageToUser;

/**
 * ResourceToMessageToUserSearch represents the model behind the search form about `common\models\ResourceToMessageToUser`.
 */
class ResourceToMessageToUserSearch extends ResourceToMessageToUser
{
    public $from_user_id;
	public $to_user_id;
	
    public function rules()
    {
        return [
            [['user_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceToMessageToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_user_id) && $this->from_user_id != '') $query->andWhere('`user_id` >= :from_user_id', [':from_user_id' => $this->from_user_id]);
		if(!is_null($this->to_user_id) && $this->to_user_id != '') $query->andWhere('`user_id` <= :to_user_id', [':to_user_id' => $this->to_user_id]);
		
        return $dataProvider;
    }
}
