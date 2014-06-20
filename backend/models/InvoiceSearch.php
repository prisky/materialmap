<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form about `common\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    public function rules()
    {
        return [
            [['id', 'account_to_user_id'], 'integer'],
            [['invoiced', 'paid'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Invoice::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_to_user_id' => $this->account_to_user_id,
            'invoiced' => $this->invoiced,
            'paid' => $this->paid,
        ]);

        return $dataProvider;
    }
}
