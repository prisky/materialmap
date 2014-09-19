<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventType;

/**
 * EventTypeSearch represents the model behind the search form about `common\models\EventType`.
 */
class EventTypeSearch extends EventType
{
    public $from_deposit;
	public $to_deposit;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = EventType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		if(!is_null($this->from_deposit) && $this->from_deposit != '') $query->andWhere('`deposit` >= :from_deposit', [':from_deposit' => $this->from_deposit]);
		if(!is_null($this->to_deposit) && $this->to_deposit != '') $query->andWhere('`deposit` <= :to_deposit', [':to_deposit' => $this->to_deposit]);
		$query->andFilterGoogleStyle('deposit_hours', $this->deposit_hours);
		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('private_note', $this->private_note);
		$query->andFilterGoogleStyle('seats_max', $this->seats_max);
		$query->andFilterGoogleStyle('seats_min', $this->seats_min);
		$query->andFilterGoogleStyle('seats_min_hours', $this->seats_min_hours);
		$query->andFilterGoogleStyle('tooltip', $this->tooltip);
		
        return $dataProvider;
    }
}
