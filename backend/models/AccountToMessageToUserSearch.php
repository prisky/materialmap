<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToMessageToUser;

/**
 * AccountToMessageToUserSearch represents the model behind the search form about `common\models\AccountToMessageToUser`.
 */
class AccountToMessageToUserSearch extends AccountToMessageToUser
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'account_to_message', 'user_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AccountToMessageToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'account_to_message' => $this->account_to_message,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
