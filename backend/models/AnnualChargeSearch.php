<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AnnualCharge;

/**
 * AnnualChargeSearch represents the model behind the search form about `common\models\AnnualCharge`.
 */
class AnnualChargeSearch extends AnnualCharge
{
    
    public function rules()
    {
        return [
                    ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AnnualCharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		
        return $dataProvider;
    }
}
