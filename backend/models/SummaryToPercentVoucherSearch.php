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
            [['percent_voucher_id', 'summary_id'], 'integer']        ];
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

		$query->andFilterWhere(['percent_voucher_id' => $this->percent_voucher_id]);
		$query->andFilterWhere(['summary_id' => $this->summary_id]);
		
        return $dataProvider;
    }
}
