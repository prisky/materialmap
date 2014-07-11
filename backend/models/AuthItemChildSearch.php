<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AuthItemChild;

/**
 * AuthItemChildSearch represents the model behind the search form about `common\models\AuthItemChild`.
 */
class AuthItemChildSearch extends AuthItemChild
{
    
    public function rules()
    {
        return [
            [['parent'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthItemChild::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['like', 'parent', $this->parent]);
		
        return $dataProvider;
    }
}
