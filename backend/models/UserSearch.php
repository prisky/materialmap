<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['contact_id' => $this->contact_id]);
        $query->andFilterGoogleStyle('auth_key', $this->auth_key);

        return $dataProvider;
    }
}
