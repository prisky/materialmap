<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SmsToCharge;

/**
 * SmsToChargeSearch represents the model behind the search form about `common\models\SmsToCharge`.
 */
class SmsToChargeSearch extends SmsToCharge
{
    
    public function rules()
    {
        return [
            [['charge_id', 'sms_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SmsToCharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['charge_id' => $this->charge_id]);
		$query->andFilterWhere(['sms_id' => $this->sms_id]);
		
        return $dataProvider;
    }
}
