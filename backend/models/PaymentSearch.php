<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `common\models\Payment`.
 */
class PaymentSearch extends Payment
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'summary_id', 'payment_gateway_id'], 'integer'],
            [['amount'], 'number'],
            [['uniqueid'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Payment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'summary_id' => $this->summary_id,
            'payment_gateway_id' => $this->payment_gateway_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'uniqueid', $this->uniqueid]);

        return $dataProvider;
    }
}
