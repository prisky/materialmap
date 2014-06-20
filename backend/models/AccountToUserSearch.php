<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToUser;

/**
 * AccountToUserSearch represents the model behind the search form about `common\models\AccountToUser`.
 */
class AccountToUserSearch extends AccountToUser
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'user_id', 'immediate', 'deleted'], 'integer'],
            [['rate'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AccountToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'user_id' => $this->user_id,
            'rate' => $this->rate,
            'immediate' => $this->immediate,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
