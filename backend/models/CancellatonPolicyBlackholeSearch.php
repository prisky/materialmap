<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CancellatonPolicyBlackhole;

/**
 * CancellatonPolicyBlackholeSearch represents the model behind the search form about `common\models\CancellatonPolicyBlackhole`.
 */
class CancellatonPolicyBlackholeSearch extends CancellatonPolicyBlackhole
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = CancellatonPolicyBlackhole::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		
        return $dataProvider;
    }
}
