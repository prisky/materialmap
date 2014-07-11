<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentPromotion;

/**
 * PercentPromotionSearch represents the model behind the search form about `common\models\PercentPromotion`.
 */
class PercentPromotionSearch extends PercentPromotion
{
    public $from_rate;
	public $to_rate;
	
    public function rules()
    {
        return [
            [['rate', 'from_rate', 'to_rate'], 'number']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = PercentPromotion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
		if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
		
        return $dataProvider;
    }
}
