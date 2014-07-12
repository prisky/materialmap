<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventToResourceToExtraToSummary;

/**
 * EventToResourceToExtraToSummarySearch represents the model behind the search form about `common\models\EventToResourceToExtraToSummary`.
 */
class EventToResourceToExtraToSummarySearch extends EventToResourceToExtraToSummary
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['event_to_resource_to_extra_id', 'summary_id'], 'integer'],
			[['quantity'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventToResourceToExtraToSummary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['event_to_resource_to_extra_id' => $this->event_to_resource_to_extra_id]);
		$query->andFilterGoogleStyle('quantity', $this->quantity);
		$query->andFilterWhere(['summary_id' => $this->summary_id]);
		
        return $dataProvider;
    }
}
