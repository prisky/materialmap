<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Contact;

/**
 * ContactSearch represents the model behind the search form about `common\models\Contact`.
 */
class ContactSearch extends Contact
{
    
    public function rules()
    {
        return [
            [['email', 'first_name', 'last_name', 'phone_mobile'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Contact::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('email', $this->email);
		$query->andFilterGoogleStyle('first_name', $this->first_name);
		$query->andFilterGoogleStyle('last_name', $this->last_name);
		$query->andFilterGoogleStyle('phone_mobile', $this->phone_mobile);
		
        return $dataProvider;
    }
}
