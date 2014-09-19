<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ItemInventory;

/**
 * ItemInventorySearch represents the model behind the search form about `common\models\ItemInventory`.
 */
class ItemInventorySearch extends ItemInventory
{
    public $from_received;
	public $to_received;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ItemInventory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('quantity', $this->quantity);
		if(!is_null($this->from_received) && $this->from_received != '') $query->andWhere('`received` >= :from_received', [':from_received' => $this->from_received]);
		if(!is_null($this->to_received) && $this->to_received != '') $query->andWhere('`received` <= :to_received', [':to_received' => $this->to_received]);
		
        return $dataProvider;
    }
}
