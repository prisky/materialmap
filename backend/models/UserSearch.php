<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
	
    public function rules()
    {
        return [
            [['auth_key'], 'safe'],
			[['contact_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('auth_key', $this->auth_key);
		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		
        return $dataProvider;
    }
}
