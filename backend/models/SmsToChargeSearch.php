<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SmsToCharge;

/**
 * SmsToChargeSearch represents the model behind the search form about `common\models\SmsToCharge`.
 */
class SmsToChargeSearch extends SmsToCharge
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SmsToCharge::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['charge_id' => $this->charge_id]);

        return $dataProvider;
    }
}
