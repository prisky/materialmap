<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceTypeToMessageToUser;

/**
 * ResourceTypeToMessageToUserSearch represents the model behind the search form about `common\models\ResourceTypeToMessageToUser`.
 */
class ResourceTypeToMessageToUserSearch extends ResourceTypeToMessageToUser
{
    public $from_user_id;
	public $to_user_id;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceTypeToMessageToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		if(!is_null($this->from_user_id) && $this->from_user_id != '') $query->andWhere('`user_id` >= :from_user_id', [':from_user_id' => $this->from_user_id]);
		if(!is_null($this->to_user_id) && $this->to_user_id != '') $query->andWhere('`user_id` <= :to_user_id', [':to_user_id' => $this->to_user_id]);
		
        return $dataProvider;
    }
}
