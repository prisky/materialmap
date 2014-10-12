<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\StandardSetup;

/**
 * StandardSetupSearch represents the model behind the search form about `common\models\StandardSetup`.
 */
class StandardSetupSearch extends StandardSetup
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = StandardSetup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['reseller_id' => $this->reseller_id]);
		
        return $dataProvider;
    }
}
