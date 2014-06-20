<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Charge;

/**
 * ChargeSearch represents the model behind the search form about `common\models\Charge`.
 */
class ChargeSearch extends Charge
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Charge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
