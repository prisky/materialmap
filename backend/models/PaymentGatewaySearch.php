<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PaymentGateway;

/**
 * PaymentGatewaySearch represents the model behind the search form about `common\models\PaymentGateway`.
 */
class PaymentGatewaySearch extends PaymentGateway
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = PaymentGateway::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterWhere(['account_id' => $this->account_id]);
        $query->andFilterGoogleStyle('api_url', $this->api_url);
        $query->andFilterGoogleStyle('api_username', $this->api_username);

        return $dataProvider;
    }
}
