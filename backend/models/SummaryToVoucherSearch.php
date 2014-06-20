<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToVoucher;

/**
 * SummaryToVoucherSearch represents the model behind the search form about `common\models\SummaryToVoucher`.
 */
class SummaryToVoucherSearch extends SummaryToVoucher
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'summary_id', 'voucher_id'], 'integer'],
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
        $query = SummaryToVoucher::find();

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
            'voucher_id' => $this->voucher_id,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
