<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form about `common\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    public $from_invoiced;
    public $to_invoiced;
    public $from_paid;
    public $to_paid;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Invoice::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['account_to_user_id' => $this->account_to_user_id]);
        if(!is_null($this->from_invoiced) && $this->from_invoiced != '') $query->andWhere('`invoiced` >= :from_invoiced', [':from_invoiced' => $this->from_invoiced]);
        if(!is_null($this->to_invoiced) && $this->to_invoiced != '') $query->andWhere('`invoiced` <= :to_invoiced', [':to_invoiced' => $this->to_invoiced]);
        if(!is_null($this->from_paid) && $this->from_paid != '') $query->andWhere('`paid` >= :from_paid', [':from_paid' => $this->from_paid]);
        if(!is_null($this->to_paid) && $this->to_paid != '') $query->andWhere('`paid` <= :to_paid', [':to_paid' => $this->to_paid]);

        return $dataProvider;
    }
}
