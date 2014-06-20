<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Voucher;

/**
 * VoucherSearch represents the model behind the search form about `common\models\Voucher`.
 */
class VoucherSearch extends Voucher
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
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
        $query = Voucher::find();

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

        $query->andFilterWhere(['like', 'uniqueid', $this->uniqueid]);

        return $dataProvider;
    }
}
