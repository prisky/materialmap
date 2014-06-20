<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentVoucherConstraint;

/**
 * PercentVoucherConstraintSearch represents the model behind the search form about `common\models\PercentVoucherConstraint`.
 */
class PercentVoucherConstraintSearch extends PercentVoucherConstraint
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'percent_voucher_id'], 'integer'],
            [['invalid_from', 'invalaid_to'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = PercentVoucherConstraint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'percent_voucher_id' => $this->percent_voucher_id,
            'invalid_from' => $this->invalid_from,
            'invalaid_to' => $this->invalaid_to,
        ]);

        return $dataProvider;
    }
}
