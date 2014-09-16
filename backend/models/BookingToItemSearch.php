<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\BookingToItem;

/**
 * BookingToItemSearch represents the model behind the search form about `common\models\BookingToItem`.
 */
class BookingToItemSearch extends BookingToItem
{
    public $from_amount;
	public $to_amount;
	
    public function rules()
    {
        return [
            [['amount', 'from_amount', 'to_amount'], 'number'],
			[['event_type_id', 'field_set_id', 'item_group_id', 'item_id'], 'integer'],
			[['quantity'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = BookingToItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_amount) && $this->from_amount != '') $query->andWhere('`amount` >= :from_amount', [':from_amount' => $this->from_amount]);
		if(!is_null($this->to_amount) && $this->to_amount != '') $query->andWhere('`amount` <= :to_amount', [':to_amount' => $this->to_amount]);
		$query->andFilterWhere(['event_type_id' => $this->event_type_id]);
		$query->andFilterWhere(['field_set_id' => $this->field_set_id]);
		$query->andFilterWhere(['item_group_id' => $this->item_group_id]);
		$query->andFilterWhere(['item_id' => $this->item_id]);
		$query->andFilterGoogleStyle('quantity', $this->quantity);
		
        return $dataProvider;
    }
}
