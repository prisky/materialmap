<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventDetail;

/**
 * EventDetailSearch represents the model behind the search form about `common\models\EventDetail`.
 */
class EventDetailSearch extends EventDetail
{
    public $from_deposit;
	public $to_deposit;
	
    public function rules()
    {
        return [
            [['deposit'], 'number'],
			[['deposit_hours', 'name', 'private_note', 'seats_max', 'seats_min', 'seats_min_hours', 'tooltip'], 'safe'],
			[['resource_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_deposit) && $this->from_deposit != '') $query->andWhere('`deposit` >= :from_deposit', [':from_deposit' => $this->from_deposit]);
		if(!is_null($this->to_deposit) && $this->to_deposit != '') $query->andWhere('`deposit` <= :to_deposit', [':to_deposit' => $this->to_deposit]);
		$query->andFilterWhere(['like', 'deposit_hours', $this->deposit_hours]);
		$query->andFilterWhere(['like', 'name', $this->name]);
		$query->andFilterWhere(['like', 'private_note', $this->private_note]);
		$query->andFilterWhere(['resource_id' => $this->resource_id]);
		$query->andFilterWhere(['like', 'seats_max', $this->seats_max]);
		$query->andFilterWhere(['like', 'seats_min', $this->seats_min]);
		$query->andFilterWhere(['like', 'seats_min_hours', $this->seats_min_hours]);
		$query->andFilterWhere(['like', 'tooltip', $this->tooltip]);
		
        return $dataProvider;
    }
}
