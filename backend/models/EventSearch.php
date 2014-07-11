<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Event;

/**
 * EventSearch represents the model behind the search form about `common\models\Event`.
 */
class EventSearch extends Event
{
    public $from_end;
	public $to_end;
	public $from_end;
	public $to_end;
	public $from_start;
	public $to_start;
	public $from_start;
	public $to_start;
	
    public function rules()
    {
        return [
            [['end', 'from_end', 'to_end', 'start', 'from_start', 'to_start', 'status'], 'number'],
			[['event_detail_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Event::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_end) && $this->from_end != '') $query->andWhere('`end` >= :from_end', [':from_end' => $this->from_end]);
		if(!is_null($this->to_end) && $this->to_end != '') $query->andWhere('`end` <= :to_end', [':to_end' => $this->to_end]);
		if(!is_null($this->from_end) && $this->from_end != '') $query->andWhere('`end` >= :from_end', [':from_end' => $this->from_end]);
		if(!is_null($this->to_end) && $this->to_end != '') $query->andWhere('`end` <= :to_end', [':to_end' => $this->to_end]);
		$query->andFilterWhere(['event_detail_id' => $this->event_detail_id]);
		if(!is_null($this->from_start) && $this->from_start != '') $query->andWhere('`start` >= :from_start', [':from_start' => $this->from_start]);
		if(!is_null($this->to_start) && $this->to_start != '') $query->andWhere('`start` <= :to_start', [':to_start' => $this->to_start]);
		if(!is_null($this->from_start) && $this->from_start != '') $query->andWhere('`start` >= :from_start', [':from_start' => $this->from_start]);
		if(!is_null($this->to_start) && $this->to_start != '') $query->andWhere('`start` <= :to_start', [':to_start' => $this->to_start]);
		$query->andFilterWhere(['status' => $this->status]);
		
        return $dataProvider;
    }
}
