<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CancellatonPolicyBlackhole;

/**
 * CancellatonPolicyBlackholeSearch represents the model behind the search form about `common\models\CancellatonPolicyBlackhole`.
 */
class CancellatonPolicyBlackholeSearch extends CancellatonPolicyBlackhole
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'cancellation_policy_id', 'days'], 'integer'],
            [['rate', 'base_fee'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = CancellatonPolicyBlackhole::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'cancellation_policy_id' => $this->cancellation_policy_id,
            'days' => $this->days,
            'rate' => $this->rate,
            'base_fee' => $this->base_fee,
        ]);

        return $dataProvider;
    }
}
