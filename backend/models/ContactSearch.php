<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Contact;

/**
 * ContactSearch represents the model behind the search form about `common\models\Contact`.
 */
class ContactSearch extends Contact
{
    public $from_town_city_id;
    public $to_town_city_id;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Contact::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('first_name', $this->first_name);
        $query->andFilterGoogleStyle('last_name', $this->last_name);
        $query->andFilterGoogleStyle('email', $this->email);
        $query->andFilterGoogleStyle('phone_mobile', $this->phone_mobile);
        if(!is_null($this->from_town_city_id) && $this->from_town_city_id != '') $query->andWhere('`town_city_id` >= :from_town_city_id', [':from_town_city_id' => $this->from_town_city_id]);
        if(!is_null($this->to_town_city_id) && $this->to_town_city_id != '') $query->andWhere('`town_city_id` <= :to_town_city_id', [':to_town_city_id' => $this->to_town_city_id]);
        $query->andFilterGoogleStyle('post_code', $this->post_code);
        $query->andFilterGoogleStyle('address_line1', $this->address_line1);
        $query->andFilterGoogleStyle('address_line2', $this->address_line2);

        return $dataProvider;
    }
}
