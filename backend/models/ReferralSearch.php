<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Referral;

/**
 * ReferralSearch represents the model behind the search form about `common\models\Referral`.
 */
class ReferralSearch extends Referral
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'first_referrer_user_id', 'summary_to_account_to_user_id', 'account_to_user_id', 'invoice_id'], 'integer'],
            [['rate'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Referral::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'first_referrer_user_id' => $this->first_referrer_user_id,
            'summary_to_account_to_user_id' => $this->summary_to_account_to_user_id,
            'account_to_user_id' => $this->account_to_user_id,
            'invoice_id' => $this->invoice_id,
            'rate' => $this->rate,
        ]);

        return $dataProvider;
    }
}
