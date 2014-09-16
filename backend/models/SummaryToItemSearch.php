<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToItem;

/**
 * SummaryToItemSearch represents the model behind the search form about `common\models\SummaryToItem`.
 */
class SummaryToItemSearch extends SummaryToItem
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['field_set_id', 'item_group_id', 'item_id', 'summary_id'], 'integer'],
			[['quantity'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['field_set_id' => $this->field_set_id]);
		$query->andFilterWhere(['item_group_id' => $this->item_group_id]);
		$query->andFilterWhere(['item_id' => $this->item_id]);
		$query->andFilterGoogleStyle('quantity', $this->quantity);
		$query->andFilterWhere(['summary_id' => $this->summary_id]);
		
        return $dataProvider;
    }
}
