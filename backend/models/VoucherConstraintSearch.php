<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\VoucherConstraint;

/**
 * VoucherConstraintSearch represents the model behind the search form about `common\models\VoucherConstraint`.
 */
class VoucherConstraintSearch extends VoucherConstraint
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'voucher_id'], 'integer'],
            [['invalid_from', 'invalid_to'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = VoucherConstraint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'voucher_id' => $this->voucher_id,
            'invalid_from' => $this->invalid_from,
            'invalid_to' => $this->invalid_to,
        ]);

        return $dataProvider;
    }
}
