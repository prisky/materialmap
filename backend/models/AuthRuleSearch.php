<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AuthRule;

/**
 * AuthRuleSearch represents the model behind the search form about `common\models\AuthRule`.
 */
class AuthRuleSearch extends AuthRule
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = AuthRule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		
        return $dataProvider;
    }
}
