<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToPaymentGateway;

/**
 * AccountToPaymentGatewaySearch represents the model behind the search form about `common\models\AccountToPaymentGateway`.
 */
class AccountToPaymentGatewaySearch extends AccountToPaymentGateway
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AccountToPaymentGateway::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['payment_gateway_id' => $this->payment_gateway_id]);
		
        return $dataProvider;
    }
}
