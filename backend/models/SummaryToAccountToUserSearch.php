<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToAccountToUser;

/**
 * SummaryToAccountToUserSearch represents the model behind the search form about `common\models\SummaryToAccountToUser`.
 */
class SummaryToAccountToUserSearch extends SummaryToAccountToUser
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'user_id', 'summary_id', 'account_to_user_id', 'invoice_id'], 'integer'],
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
        $query = SummaryToAccountToUser::find();

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
            'summary_id' => $this->summary_id,
            'account_to_user_id' => $this->account_to_user_id,
            'invoice_id' => $this->invoice_id,
            'rate' => $this->rate,
        ]);

        return $dataProvider;
    }
}
