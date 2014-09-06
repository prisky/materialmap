<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Contact;

/**
 * ContactSearch represents the model behind the search form about `common\models\Contact`.
 */
class ContactSearch extends Contact
{
    public $from_verified;
	public $to_verified;
	
    public function rules()
    {
        return [
            [['address_line1', 'address_line2', 'email', 'first_name', 'last_name', 'phone_mobile', 'post_code'], 'safe'],
			[['town_city_id'], 'integer'],
			[['verified', 'from_verified', 'to_verified'], 'number']        ];
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

		$query->andFilterGoogleStyle('address_line1', $this->address_line1);
		$query->andFilterGoogleStyle('address_line2', $this->address_line2);
		$query->andFilterGoogleStyle('email', $this->email);
		$query->andFilterGoogleStyle('first_name', $this->first_name);
		$query->andFilterGoogleStyle('last_name', $this->last_name);
		$query->andFilterGoogleStyle('phone_mobile', $this->phone_mobile);
		$query->andFilterGoogleStyle('post_code', $this->post_code);
		$query->andFilterWhere(['town_city_id' => $this->town_city_id]);
		if(!is_null($this->from_verified) && $this->from_verified != '') $query->andWhere('`verified` >= :from_verified', [':from_verified' => $this->from_verified]);
		if(!is_null($this->to_verified) && $this->to_verified != '') $query->andWhere('`verified` <= :to_verified', [':to_verified' => $this->to_verified]);
		
        return $dataProvider;
    }
}
