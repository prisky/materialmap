<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PurchaseOrder;

/**
 * PurchaseOrderSearch represents the model behind the search form about `common\models\PurchaseOrder`.
 */
class PurchaseOrderSearch extends PurchaseOrder
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = PurchaseOrder::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterGoogleStyle('construction_work_pack', $this->construction_work_pack);

        return $dataProvider;
    }
}
