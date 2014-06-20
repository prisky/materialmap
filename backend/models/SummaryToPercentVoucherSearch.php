<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToPercentVoucher;

/**
 * SummaryToPercentVoucherSearch represents the model behind the search form about `common\models\SummaryToPercentVoucher`.
 */
class SummaryToPercentVoucherSearch extends SummaryToPercentVoucher
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'summary_id', 'percent_voucher_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToPercentVoucher::find();

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
            'percent_voucher_id' => $this->percent_voucher_id,
        ]);

        return $dataProvider;
    }
}
