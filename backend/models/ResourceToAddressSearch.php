<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToAddress;

/**
 * ResourceToAddressSearch represents the model behind the search form about `common\models\ResourceToAddress`.
 */
class ResourceToAddressSearch extends ResourceToAddress
{
    
    public function rules()
    {
        return [
            [['address_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceToAddress::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['address_id' => $this->address_id]);
		
        return $dataProvider;
    }
}
