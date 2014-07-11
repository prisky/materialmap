<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PaymentGateway;

/**
 * PaymentGatewaySearch represents the model behind the search form about `common\models\PaymentGateway`.
 */
class PaymentGatewaySearch extends PaymentGateway
{
    
    public function rules()
    {
        return [
            [['name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = PaymentGateway::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['like', 'name', $this->name]);
		
        return $dataProvider;
    }
}
