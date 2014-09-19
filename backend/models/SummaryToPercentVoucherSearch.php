<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToPercentVoucher;

/**
 * SummaryToPercentVoucherSearch represents the model behind the search form about `common\models\SummaryToPercentVoucher`.
 */
class SummaryToPercentVoucherSearch extends SummaryToPercentVoucher
{
    
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

        $this->setAttributes($params);

		$query->andFilterWhere(['percent_voucher_id' => $this->percent_voucher_id]);
		
        return $dataProvider;
    }
}
