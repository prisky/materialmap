<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CancellationPolicy;

/**
 * CancellationPolicySearch represents the model behind the search form about `common\models\CancellationPolicy`.
 */
class CancellationPolicySearch extends CancellationPolicy
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'days'], 'integer'],
            [['begin', 'finish'], 'safe'],
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
        $query = CancellationPolicy::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'begin' => $this->begin,
            'finish' => $this->finish,
            'days' => $this->days,
            'rate' => $this->rate,
            'base_fee' => $this->base_fee,
        ]);

        return $dataProvider;
    }
}
