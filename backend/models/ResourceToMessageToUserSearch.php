<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToMessageToUser;

/**
 * ResourceToMessageToUserSearch represents the model behind the search form about `common\models\ResourceToMessageToUser`.
 */
class ResourceToMessageToUserSearch extends ResourceToMessageToUser
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'resource_to_message', 'user_id'], 'integer'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'resource_to_message' => $this->resource_to_message,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
