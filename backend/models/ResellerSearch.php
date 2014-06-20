<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Reseller;

/**
 * ResellerSearch represents the model behind the search form about `common\models\Reseller`.
 */
class ResellerSearch extends Reseller
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'trial_days', 'expiry_days', 'child_admin'], 'integer'],
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
        $query = Reseller::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'trial_days' => $this->trial_days,
            'expiry_days' => $this->expiry_days,
            'rate' => $this->rate,
            'child_admin' => $this->child_admin,
        ]);

        return $dataProvider;
    }
}
